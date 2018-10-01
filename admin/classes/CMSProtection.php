<?php
/**
* Класс для проверки регистрации системы и авторизации в админке
*
*/
class CMSProtection  {

	/**
	* смарти-класс
	* @var class
	*/
	public		$smarty;

	/**
	* переменные из массива $this->post с заменёнными спец-символами
	*
	* @var array
	*/
	public		$post;

	/**
	*  переменные из массива $this->post как они вводились пользователем (спец символы не заменены)
	*
	* @var array
	*/
	public		$postr;

	/**
	*  экранированые переменные функцией addslashes() из массива $this->post
	*
	* @var array
	*/
	public		$posts;

	/**
	* переменные из массива $this->get с заменёнными символами
	*
	* @var array
	*/
	public		$get;


	/**
	*  переменные из массива $this->get (спец символы не заменены)
	*
	* @var array
	*/
	public		$getr;

	/**
	*  экранированые переменные функцией addslashes() из массива $this->get
	*
	* @var array
	*/
	public		$gets;

	/**
	* класс для работы с MYSQL
	*
	* @var unknown_type
	*/
	public		$mysql;

	/**
	* Хранит переданные ошибки
	*
	* @var array
	*/
	public 		$errorMsgs;

	/**
	* сообщения
	*
	* @var array
	*/
	public  	$messages;

	/**
	* Ключ шифрования
	*
	* @var string
	*/
	private 	$salt='l3-kjg4d6f23-45-49fsd4]m-fu4';

	/**
	* Имя зашифрованного файла в модуле
	*
	* @var string
	*/
	private  	$init_filename='/init.sql';



	/**
	* Конструктор
	*
	* @param class $this->smarty
	*/
	function __construct($mysql=NULL, $smarty=NULL) {
		GLOBAL $GENERAL_FUNCTIONS;

		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		if (isset($GENERAL_FUNCTIONS->get)) {
			$this->get		= $GENERAL_FUNCTIONS->get;
			$this->getr		= $GENERAL_FUNCTIONS->getr;
			$this->gets		= $GENERAL_FUNCTIONS->gets;
			$this->post		= $GENERAL_FUNCTIONS->post;
			$this->postr	= $GENERAL_FUNCTIONS->postr;
			$this->posts	= $GENERAL_FUNCTIONS->posts;
		}
	}



	/**
	* Функция, которая создаёт файл модуля init
	*
	* @param string $moduleName
	* @param string $init_dir
	* @return bool
	*/
	function createInit($moduleName, $init_dir) {
		GLOBAL $FILE_MANAGER;

		$init_f			= $init_dir.$this->init_filename;
		$outText		= $moduleName.SETTINGS_NEW_LINE.$moduleName;
		$cryptedText	= $this->encode($outText, $this->salt);			//шифруем текст обратно

		//запись в файл
		if ($fd	= $FILE_MANAGER->fopen($init_f, 'w')) {
			fwrite($fd, $cryptedText);
			fclose($fd);
			return true;
		}
		else return false;
	}



	/**
	* Функция, которая переписывает файл модуля init
	*
	* @param string $moduleName
	* @param string $init_dir
	* @return bool
	*/
	function updateInit($newModuleName, $init_dir) {
		GLOBAL $FILE_MANAGER;

		$init_f			= $init_dir.$this->init_filename;				//путь к файлу
		$cryptedText	= $FILE_MANAGER->getfile($init_f);
		$outText		= $this->decode($cryptedText, $this->salt);		//расшифровываем файл
		$parts			= explode(SETTINGS_NEW_LINE, $outText);

		$outText		= $newModuleName.SETTINGS_NEW_LINE.$parts[1];				//создаем новый текст
		$cryptedText	= $this->encode($outText, $this->salt);			//шифруем текст обратно

		//запись в файл
		if ($fd	= $FILE_MANAGER->fopen($init_f, 'w')) {
			fwrite($fd, $cryptedText);
			fclose($fd);
			return true;
		}
		else return false;
	}



	/**
	* Функция, которая возвращает первоначальное имя модуля из файла init
	*
	* @param string $moduleName
	* @param string $init_dir
	* @return bool
	*/
	function returnModuleNameInit($moduleName, $init_dir) {
		GLOBAL $FILE_MANAGER;

		$init_f			= $init_dir.$this->init_filename;				//путь к файлу
		$cryptedText	= $FILE_MANAGER->getfile($init_f);
		$outText		= $this->decode($cryptedText, $this->salt);		//расшифровываем файл
		$parts			= explode(SETTINGS_NEW_LINE, $outText);

		return $parts[1];
	}



	/**
	* Функция кодирования
	*
	* @param string $String
	* @param string $Password
	* @return string
	*/
	function encode($String, $Password) {

		if ($Password!=$this->salt) {
			return false;
		}

		$Salt	= $this->salt;
		$String = mb_substr(pack('H*',sha1($String)),0,1).$String;
		$StrLen = mb_strlen($String);
		$Seq 	= $Password;
		$Gamma 	= '';
		while (mb_strlen($Gamma)< $StrLen) {
			$Seq = pack('H*',sha1($Seq.$Gamma.$Salt));
			$Gamma.=mb_substr($Seq,0,8);
		}

		return base64_encode($String^$Gamma);
	}



	/**
	* Функция декодирования
	*
	* @param string $String
	* @param string $Password
	* @return string
	*/
	function decode($String, $Password) {

		if ($Password!=$this->salt) {
			return false;
		}

		$Salt	= $this->salt;
		$StrLen = mb_strlen($String);
		$Seq 	= $Password;
		$Gamma 	= '';
		while (mb_strlen($Gamma)<$StrLen) {
			$Seq = pack('H*',sha1($Seq.$Gamma.$Salt));
			$Gamma.=mb_substr($Seq,0,8);
		}

		$String 		= base64_decode($String);
		$String 		= $String^$Gamma;

		$DecodedString 	= mb_substr($String, 1);
		$Error 			= ord(mb_substr($String, 0, 1)^ mb_substr(pack('H*',sha1($DecodedString)),0,1));

		//проверяем
		if ($Error) return false;
		else return $DecodedString;
	}



	/**
	 * Проверка лицензии на конструктор
	 *
	 * @param bool $refresh_include
	 * @return bool
	 */
	function checkActivationConstructor($refresh_include=false) {
		GLOBAL  $LICENSE_KEYS, $CMS_VERSION;
		
		return true;
		
		$host  = gethostbyname($_SERVER['HTTP_HOST']);

		if  ($host!='127.0.0.1') {
			//переподключаем файл конфига, т.к. он обновился
			if ($refresh_include) {
				include $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/config.php';          						//настройки подключение к БД
			}

			$activation	= false;

			$check_data	= str_replace('www.', '', $_SERVER['HTTP_HOST']).' constructor';

			if (isset($LICENSE_KEYS['constructor'])) {
				if ($check_data==$this->decode($LICENSE_KEYS['constructor'], $this->salt)) {
					$activation	= true;
				}
			}
		}
		else {
			$activation	= true;
		}

		return $activation;
	}



	/**
	 * Проверка лицензию на модуль
	 *
	 * @param string $module_name
	 * @return bool
	 */
	function checkActivationModule($module_name) {
		GLOBAl $MSGTEXT, $LICENSE_KEYS;

		return true;
		
		$buy_modules		= array('InternetShop');	//список платных модулей

		$host  				= gethostbyname($_SERVER['HTTP_HOST']);

		if ($host!='127.0.0.1') {
			$activation			= false;
			$module_init		= file_get_contents($_SERVER['DOCUMENT_ROOT']."/modules/$module_name/management/import_settings/init.sql");
			$t					= $this->decode($module_init, $this->salt);
			$t2					= explode(SETTINGS_NEW_LINE, $t);
			$first_module_name	= $t2[1];

			//проверяем, чтоб небыло подмены файла init
			if ($module_name!=$t[0] && $first_module_name!='') {

				//проверяем есть ли лицензия на платный модуль
				if (in_array($first_module_name, $buy_modules))	{
					$check_data	= str_replace('www.', '', $_SERVER['HTTP_HOST']).' '.$first_module_name;

					if (isset($LICENSE_KEYS['modules'][$first_module_name])) {
						if ($check_data==$this->decode($LICENSE_KEYS['modules'][$first_module_name], $this->salt)) {
							$activation	= true;
						}
					}
				}
				else {
					$activation	= true;
				}
			}
			else {
				printf($MSGTEXT['incorrect_init_file'], $module_name);
				exit;
			}
		}
		else {
			$activation	= true;
		}

		return $activation;
	}



	/**
	 * Проверка лицензии на инструмент рассылки
	 *
	 * @return bool
	 */
	function checkActivationMailer() {
		GLOBAL  $LICENSE_KEYS, $CMS_VERSION;

		return true;
		
		$host  = gethostbyname($_SERVER['HTTP_HOST']);

		if  ($host!='127.0.0.1') {
			$activation	= false;
			$check_data	= str_replace('www.', '', $_SERVER['HTTP_HOST']).' mailer';

			if (isset($LICENSE_KEYS['mailer'])) {
				if ($check_data==$this->decode($LICENSE_KEYS['mailer'], $this->salt)) {
					$activation	= true;
				}
			}
		}
		else {
			$activation	= true;
		}

		return $activation;
	}



	/**
	 * Проверка лицензии на систему
	 *
	 * @param bool $refresh_include
	 * @return bool
	 */	
	function checkActivation($refresh_include=false) {
		GLOBAL  $LICENSE_KEYS, $CMS_VERSION;

		return true;
		$host  				= gethostbyname($_SERVER['HTTP_HOST']);

		if  ($host!='127.0.0.1') {
			//переподключаем файл конфига, т.к. он обновился
			if ($refresh_include) {
				include $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/config.php';          						//настройки подключение к БД
			}

			$activation	= false;
			$check_data	= str_replace('www.', '', $_SERVER['HTTP_HOST']);

			if (isset($LICENSE_KEYS['system'])) {
				if ($check_data==$this->decode($LICENSE_KEYS['system'], $this->salt) || $_SERVER['HTTP_HOST']=='localhost') {
					$activation	= true;
				}
			}
		}
		else {
			$activation	= true;
		}

		return $activation;
	}



	/**
	 * Проверка даты окончания лицензии
	 *
	 * @return bool
	 */
	function checkActivationDate() {
		GLOBAL  $LICENSE_KEYS, $CMS_VERSION;
		
		return true;
		
		$host  				= gethostbyname($_SERVER['HTTP_HOST']);

		if  ($host!='127.0.0.1') {

			$activation	= false;
			$check_data	= str_replace('www.', '', $_SERVER['HTTP_HOST']);

			if (isset($LICENSE_KEYS['dt'])) {
				$temp		= explode(' ', $this->decode($LICENSE_KEYS['dt'], $this->salt));
				$dt_domain	= $temp[0];
				$dt_date	= $temp[1];

				//берём текущую дату
				$today		= gmdate('Y-m-d');

				//если есть совпадение по домену и текущая дата меньше
				if (($check_data==$dt_domain && $dt_date>$today) || $_SERVER['HTTP_HOST']=='localhost') {
					$activation	= true;
				}
			}
		}
		else {
			$activation	= true;
		}

		return $activation;
	}



	/**
	* проверка авторизации
	*
	* @return array
	*/
	function check_login() {
		GLOBAL  $GENERAL_FUNCTIONS, $FILE_MANAGER, $MSGTEXT, $MYSQL_TABLE1, $MYSQL_TABLE20;

		$out		= false;
		$main_tpl	= 'login.tpl';

		if (isset($_SESSION['___GoodCMS']['adminlogin']) && $_SESSION['___GoodCMS']['adminlogin']!='') {
			//если не удалилась сессия
			if (isset($this->get['logout'])) {
				$this->logout();
			}
			else {
				//проверяем, если есть привязка по IP
				$query		= "SELECT `ip`, `check_ip` FROM `$MYSQL_TABLE1` WHERE `login`='{$_SESSION['___GoodCMS']['adminlogin']}'";
				$result		= $this->mysql->executeSQL($query);
				if ($user	= $this->mysql->fetchAssoc($result)) {

					if ($user['check_ip']) {
						if ($user['ip']==$_SERVER['REMOTE_ADDR']) {
							$out = true;
						}
					}
					else {
						$out 	= true;
					}
				}
			}
		}
		else {
			if (isset($this->posts['admin_login'])  &&   ($this->postr['admin_password'])) {

				$login		= $this->posts['admin_login'];
				$password	= $this->convertAP($this->postr['admin_password'].$login);

				$query		= "SELECT `password`, `group_id`, `ip`, `check_ip`, `read_only` FROM `$MYSQL_TABLE1` WHERE `login`='$login' AND `password`='$password'";
				$result		= $this->mysql->executeSQL($query);
				$user		= $this->mysql->fetchAssoc($result);

				//если пароль не совпадает, смотрим, возможно пользователь использовал восстановление пароля
				if ($user['password']!=$password) {
					$password	= $this->convertAP($this->postr['admin_password']);
					$query		= "SELECT `password`, `group_id`, `ip`, `check_ip`, `read_only`, `new_password`, `id` FROM `$MYSQL_TABLE1` WHERE `login`='$login' AND `new_password`='$password'";

					$result	= $this->mysql->executeSQL($query);
					$user	= $this->mysql->fetchAssoc($result);

					if ($user['new_password']==$password) {

						//если требуется, меняем пароль на новый
						$password	= $this->convertAP($this->postr['admin_password'].$login);
						$query	= "UPDATE  `$MYSQL_TABLE1` SET  `password`='$password' WHERE `id`='{$user['id']}'";
						$result	= $this->mysql->executeSQL($query);
						$out	= true;
					}
					else {
						$out	= false;
					}
				}
				else {
					//устанавливаем выбранный язык
					if (isset($this->get['lang'])) {
						$langs	= $GENERAL_FUNCTIONS->get_system_langs();

						if (isset($this->get['lang']) && $langs) {
							$k=1;
							foreach ($langs as $file_name=>$lan) {
								if ($k==$this->get['lang']) break;
								$k++;
							}
							$GENERAL_FUNCTIONS->updateGSettings('SETTINGS_LANGUAGE', $file_name);
						}
					}

					//проверяем наличие резервных таблиц бекапа
					$query			= "SHOW TABLES LIKE '\_\_%'";
					$result			= $this->mysql->executeSQL($query);
					$sql_part		= '';
					while (list($t_name)= $this->mysql->fetchRow($result)) {
						$t_name_old = mb_substr($t_name, 2);
						$_SESSION['___GoodCMS']['t_backup'][]=$t_name_old;
					}

					$out	= true;
				}

				if ($out==true) {

					$GENERAL_FUNCTIONS->check_files_modes();

					$group_pages 		= array();
					$query				= "SELECT `url` FROM `$MYSQL_TABLE20` WHERE `group_id`='{$user['group_id']}'";
					$result				= $this->mysql->executeSQL($query);
					while ($url 		= $this->mysql->fetchAssoc($result)) {
						$group_pages[]	= $url['url'];
					}

					$_SESSION['___GoodCMS']['adminlogin']				= $this->postr['admin_login'];
					$_SESSION['___GoodCMS']['group_id']				    = $user['group_id'];
					$_SESSION['___GoodCMS']['group_pages']				= $group_pages;
					$_SESSION['___GoodCMS']['read_only']				= $user['read_only'];


					/*
					$session_cookie_lifetime							= ini_get('session.cookie_lifetime');

					if ($session_cookie_lifetime>0) {
					$session_timeout 	= gmdate('d/m/Y H:i:s', strtotime('+'.$session_cookie_lifetime.' seconds'));
					$_SESSION['___GoodCMS']['session_timeout_datetime']	=$session_timeout ;
					}
					*/

					unset($this->posts['admin_login']);
					unset($this->postr['admin_password']);
/*
					//запрашиваем лицензионные ключи
					$host  				= gethostbyname($_SERVER['HTTP_HOST']);

					if (SETTINGS_LICENSE_URL_CHECK!='' && $host!='127.0.0.1') {
						$url_info	= parse_url(SETTINGS_LICENSE_URL_CHECK);
						//проверяем, есть ли инет
						$fp = fsockopen($url_info['host'], 80, $errno, $errstr, 1);

						$part='?domain='.$_SERVER['HTTP_HOST'];

						if ($fp && $keys = file_get_contents(SETTINGS_LICENSE_URL_CHECK.$part)) {

							fclose ($fp);
							$keys	= utf8_decode($keys);
							$keys	= str_replace('?', '', $keys);
							$keys	= str_replace(SETTINGS_NEW_LINE, '', $keys);

							if (preg_match('/array(.*?);/', $keys)) {
								//переписываем ключи
								$filename		= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/config.php';
								if ($text		= file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/config.php')) {
									$text 		= preg_replace('/\$LICENSE_KEYS[\t\s]*(.*?);/iu', 		"\$LICENSE_KEYS		= $keys",  			$text);

									if ($fd		= $FILE_MANAGER->fopen($filename, 'w')) {
										fwrite($fd, $text);
										fclose($fd);
									}
								}
							}
						}
					}
*/

					//проверяем активацию
					$_SESSION['___GoodCMS']['CMS_ACTIVE']		= $this->checkActivation(true);
					$_SESSION['___GoodCMS']['CMS_CTR_ACTIVE']	= $this->checkActivationConstructor(true);
					

					$GENERAL_FUNCTIONS->checkGeneralParameters();

					$main_tpl	= 'main.tpl';
				}
				else {
					$this->smarty->assign('error', $MSGTEXT['incorrect_data']);
				}
			}
			else	$out = false;


			if (isset($this->get['act'])) {
				switch ($this->get['act']) :
				case ('forget_form'): {
					$out		= false;
					$main_tpl	= 'forget_form.tpl';
					break;
				}
				case ('forget_send'): {
					$out			= false;
					$this->smarty	= $this->sendForgetPassword();
					$main_tpl		= 'forget_send_result.tpl';
					break;
				}
				default:	{
					$main_tpl		= 'login.tpl';
				}
				endswitch;
			}
			else     {
				$main_tpl			= 'login.tpl';
			}
		}

		if ($out==false) {

			$langs	= $GENERAL_FUNCTIONS->get_system_langs();

			if (isset($this->get['lang']) && $langs) {
				$k=1;
				foreach ($langs as $file_name=>$lan) {
					if ($k==$this->get['lang']) break;
					$k++;
				}

				include $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/languages/'.$file_name;	//подключаем язык
				$this->smarty->assign('MSGTEXT', $MSGTEXT); //подключаем сообщения из файла
			}

			$this->smarty->assign('langs', $langs);
			$out['smarty'] 		 = $this->smarty;
			$out['CMS_TEMPLATE'] = $main_tpl;
		}

		return  $out;
	}



	/**
	* Преобразует пароль для сравнения
	*
	* @param string $current_password
	* @return string
	*/
	function convertAP($current_password) {
		$password	= md5(md5($current_password.md5($current_password.' ')));

		return $password;
	}



	/**
	* генерирует пароль
	*
	* @param  int $length
	* @return string
	*/
	function generatePassword($length = 8) {
		$chars 		= 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
		$numChars 	= mb_strlen($chars);
		$string 	= '';

		for ($i = 0; $i < $length; $i++) {
			$string .= mb_substr($chars, rand(1, $numChars) - 1, 1);
		}
		return $string;
	}



	/**
	* Восстановления пароля
	*
	* @param class $this->smarty
	* @return class
	*/
	function sendForgetPassword() {
		GLOBAL  $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE1;

		if (isset($_SESSION['captcha_keystring']) && $this->post['kcaptha']==$_SESSION['captcha_keystring']) {
			unset($_SESSION['captcha_keystring']);
			//!! т.к. пароль хранится в зашифрованном виде, то нужно вставлять новый пароль и отсылать его
			$query	= "SELECT * FROM `$MYSQL_TABLE1` WHERE `email`='{$this->post['email']}'";
			$result	= $this->mysql->executeSQL($query);
			$row	= $this->mysql->fetchAssoc($result);

			if ($row['password'])  {
				$newPassword	= $this->generatePassword(8);

				$this->smarty->assign('newPassword', 	$newPassword);
				$this->smarty->assign('login', 			$row['login']);


				$InputText 		= $this->smarty->fetch('forget_send_message.tpl');
				$mail			= $GENERAL_FUNCTIONS->getMailObject($this->post['email'], $_SERVER['HTTP_HOST'], '', '', sprintf($MSGTEXT['renewal_of_pas'], $_SERVER['HTTP_HOST']) , $InputText, '');
				$send_result	= $mail->send(); 	//делаем отправку
				if ($send_result) $send_result=1;
				else $send_result=0;

				$newPassword	= $this->convertAP($newPassword);
				$query			= "UPDATE  `$MYSQL_TABLE1` SET  `new_password`='{$newPassword}' WHERE `email`='{$this->post['email']}'";
				$result			= $this->mysql->executeSQL($query);
			}
			else {
				$send_result	= 2;
			}
		}
		else $send_result		= 3;

		$this->smarty->assign('error', 			$MSGTEXT['incorrect_data']);
		$this->smarty->assign('send_result',	$send_result);

		return $this->smarty;
	}



	/**
	* выход из админки
	*
	*/
	function logout() {
		GLOBAL $GENERAL_FUNCTIONS;

		$this->StopSession('___GoodCMS');
		$GENERAL_FUNCTIONS->gotoURL('login.php');
		exit;
	}



	/**
	* Удаляет сессию
	*
	* @param string $session_name
	* @return bool
	*/
	function StopSession($session_name) {

		unset($_SESSION[$session_name]);

		return @session_destroy();
	}



	/**
	* возвращает смарти
	*
	* @return class
	*/
	function getSmarty() {
		return $this->smarty;
	}
}
?>