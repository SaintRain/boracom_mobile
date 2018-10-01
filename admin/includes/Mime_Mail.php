<?php
/**
 * Отправка сообщения с поддержкой вложений
 *
 */
class Mime_Mail {

	/**
	 * Внутренние настройки сообщения
	 *
	 * @var array
	 */
	public $parts	= array();

	/**
	 * Адрес получателя
	 *
	 * @var string
	 */
	public $to;

	/**
	 * Имя получателя
	 *
	 * @var string
	 */
	public $toName;

	/**
	 * Адрес отправителя
	 *
	 * @var string
	 */
	public $from;

	/**
	 * Имя отправителя
	 *
	 * @var string
	 */
	public $fromName;

	/**
	 * Адрес отправителя, который реально отправляет сообщение
	 *
	 * @var string
	 */
	public $fromEmailServer;

	/**
	 * Имя отправителя, который реально отправляет сообщение
	 *
	 * @var string
	 */
	public $fromEmailServerName;

	/**
	 * Заголовки сообщения
	 *
	 * @var string
	 */
	public $headers;

	/**
	 * Тема сообщения
	 *
	 * @var string
	 */
	public $subject;

	/**
	 * Текст сообщения
	 *
	 * @var string
	 */
	public $body;

	/**
	 * Объект для отправки почты
	 *
	 * @var object
	 */
	public  $mail;

	/**
	 * Объект для работы через POP3
	 *
	 * @var object
	 */
	public  $pop;


	

	/**
	 * Конструктор класса
	 *
	 * @param string $to
	 * @param string $toName
	 * @param string $from
	 * @param string $fromName
	 * @param string $subject
	 * @param string $body
	 */
	function __construct($to, $toName='', $from, $fromName='', $subject='', $body='') {

		if ($toName=='') {
			$toName		= $to;
		}

		if ($fromName=='')		{
			$fromName	= $from;
		}

		if (SETTINGS_EMAIL_TYPE=='smtp') {
			$this->fromEmailServer		= SETTINGS_EMAIL_USERNAME;
			$this->fromEmailServerName	= SETTINGS_EMAIL_CAPTION;
		}
		else {
			$this->fromEmailServer		= $from;
			$this->fromEmailServerName	= $fromName;
		}


		$this->to 			=  $to;
		$this->toName 		=  $toName;
		$this->from 		=  $from;
		$this->fromName		=  $fromName;
		$this->subject 		=  $subject;
		
		$this->body 		=  	preg_replace("/\\+/i",'',$body);

		$this->setMethotSend();
	}


	
	/**
	 * Устанавливает соединение
	 *
	 */
	function setMethotSend() {
		require_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/PHPMailer/class.phpmailer.php');

		if (SETTINGS_EMAIL_TYPE=='pop3') {
			require_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/PHPMailer/class.pop3.php');
			$this->pop = new POP3();
			$this->pop->Authorise(SETTINGS_EMAIL_HOST, SETTINGS_EMAIL_PORT, 10, SETTINGS_EMAIL_USERNAME, SETTINGS_EMAIL_PASSWORD, 0);
		}

		if (SETTINGS_EMAIL_TYPE=='smtp' || SETTINGS_EMAIL_TYPE=='pop3') {
			$this->mail    				= new PHPMailer();
			$this->mail->SMTPDebug  = 1;
			$this->mail->IsSMTP();

			if (SETTINGS_EMAIL_TYPE=='smtp') {
				$this->mail->SMTPAuth      	= true;                  // включаем авторизацию
				$this->mail->SMTPKeepAlive 	= true;                  // оставляем соединение открытым
			}

			if (SETTINGS_EMAIL_SSL)	{
				$this->mail->SMTPSecure = 'ssl';
			}

			$this->mail->Host          = SETTINGS_EMAIL_HOST;
			$this->mail->Port          = SETTINGS_EMAIL_PORT;
			$this->mail->Username      = SETTINGS_EMAIL_USERNAME;
			$this->mail->Password      = SETTINGS_EMAIL_PASSWORD;
		}
		else {
			$this->mail    				= new PHPMailer();
		}
	}

	

	/**
	 * Проверка соединения
	 *
	 * @return unknown
	 */
	function isConnect() {
		require_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/PHPMailer/class.smtp.php';

		try {
			$res=$this->mail->SmtpConnect();
		}
		catch (phpmailerException $e) {
			$res=false;
		}
		return $res;
	}


	/**
	 * Функция добавления файла в сообщение
	 *
	 * @param путь к файлу $path
	 * @param новое имя файла $name
	 */
	function add_attachment($path, $name=null) {

		$this->mail->AddAttachment($path, $name);
	}

	

	/**
	 * Отправка сообщения
	 *
	 * @return bool
	 */
	function send() {
		GLOBAL $GLOBAL_ERRORS;


		$this->mail->AddReplyTo($this->from, 			$this->fromName);			//куда будет приходить ответ
		$this->mail->AddAddress($this->to, 				$this->toName);					//кому мы пишем
		$this->mail->From 		= $this->from;
		$this->mail->FromName 	= $this->fromName;
		$this->mail->SetFrom($this->fromEmailServer, 	$this->fromName);	//от чьего сервера мы отсылаем собщение

		$this->mail->Subject	= $this->subject;
		$this->mail->isHTML(true);
		$this->mail->MsgHTML($this->body);

		$res	= $this->mail->Send();

		$this->mail->ClearAddresses();
		$this->mail->ClearAttachments();

		//вывод ошибок, если есть
		if (count($this->mail->otherErrors)>0) {
			$mes='';
			foreach ($this->mail->otherErrors as $m) {
				$mes.=$m.'<br>';
			}
			$file_name				= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/Mime_Mail.php';
			$e['description']		= $mes."in <b>$file_name</b>";
			$e['type']				= 'WARNING';
			$GLOBAL_ERRORS[]		= $e;
		}

		return $res;
	}
}

?>