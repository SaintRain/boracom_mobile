<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		    //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/check_login.php');      //проверка авторизации

//проверяем лицензию на рассылку
if (!$CMSProtection->checkActivationMailer()) {
	exit;
}


$mysql->executeSQL('SET sql_mode=\'\'');							//устанавливаем не строгий формат Mysql. Это позволит вставлять записи, если не все поля указаны


$upload_patch	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/';  	//папка, куда будут закачиваться файлы
$msg_file		= $upload_patch.'message.php';

if (!file_exists($msg_file)) {
	echo '0|0';
	exit;
}

//берем содержимое сообщения и тему
$text			= $FILE_MANAGER->getfile($msg_file);
$pos			= mb_strpos($text, "\r");   //первая строка является темой
$mailSubject	= mb_substr($text, 0, $pos);
$body			= mb_substr($text, $pos);


//если есть берем файл - вложение
if (isset($_GET['atachName'])) {
	$atachFileName  = $_GET['atachName'];
}
else {
	$atachFileName = '';
}

//подключаем список email адресов
$emails_file	= $upload_patch.'emails.php';
include($emails_file);

//берем адреса по которым будем делать рассылку
$save_emails	= array();
$use_emails		= array();
$k				= 0;
foreach ($EMAILS as $key=>$e) {
	if ($k<$_GET['limitRecords']) $use_emails[$key]=$e;
	else $save_emails[$key]=$e;
	$k++;
}

//перезаписываем емаил адреса в файл
if (count($save_emails)>0) {
	$smarty->assign('emails', var_export($save_emails, true));
	$emails			= $smarty->fetch('mailer/mailer_masiv.tpl');
	$FILE_MANAGER->putfile($emails_file, $emails);
	unset($EMAILS);
	unset($save_emails);
}


$mail_from			= SETTINGS_EMAIL_USERNAME;

//подключаем класс для отправки сообщения
include_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/Mime_Mail.php');

$inserted	= 0;
$errors 	= 0;
foreach ($use_emails as $email=>$e) {
	$name		= $e['name'];
	$table_name	= $e['table_name'];
	$table_id	= $e['table_id'];
	$id			= $e['id'];

	//берем данные для макрос
	$query			= "SELECT * FROM `$table_name` WHERE `id`='$id'";
	$result			= $mysql->executeSQL($query);
	$makrosData		= $mysql->fetchAssoc($result);


	//берем название полей
	$fields			= array();
	$comment		= array();
	$fieldname		= array();
	$query			= "SELECT * FROM `$MYSQL_TABLE17` WHERE `table_id`='$table_id'";
	$result			= $mysql->executeSQL($query);
	while ($row		= $mysql->fetchAssoc($result)) {
		$fields[$row['fieldname']]		= 	$row['comment'];
		$comment[]	= '{$'.$row['comment'].'}';
		$fieldname[] = '{$'.$row['fieldname'].'}';
	}


	//заменяем метки на русском на метки в латинице (описание поля заменяется названием поля)
	$mailSubject	= str_ireplace($comment, $fieldname, $mailSubject);
	$mailMessage	= str_ireplace($comment, $fieldname, $body);

	//добавляем в шаблон данные для макрос
	foreach ($makrosData as $key=>$value) {
		$smarty->assign($key, $value);
	}

	$mailSubject	= preg_replace('/\{\$[а-я0-9 _-]?\}/ui', '', $mailSubject);
	$mailMessage	= preg_replace('/\{\$[а-я0-9 _-]*?\}/ui', '', $mailMessage);

	//для темы
	$smarty->assign('body_message_content_marker', $mailSubject);
	$mailSubject	= $smarty->fetch($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/templates/mailer/mailer_message.tpl');

	//для сообщения с подписью
	$smarty->assign('body_message_content_marker', $mailMessage);
	$mailMessage	= $smarty->fetch($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/templates/mailer/mailer_message.tpl');
	$to				= $email;
	$mail 			= new Mime_Mail($to, $name, $mail_from,  SETTINGS_EMAIL_CAPTION, $mailSubject, $mailMessage);

	//добавляем вложения
	if ($atachFileName!='') {
		$mail->add_attachment($upload_patch.$atachFileName);
	}

	if ($res	= $mail->send()) { 	//делаем отправку
		$inserted++;
	}
	else {
		$errors++;
	}

}

//если рассылка закончена, тогда удаляем временные файлы
if (count($save_emails)==0) {
	if ($atachFileName!='') unlink($upload_patch.$atachFileName);
	unlink($emails_file);
	unlink($msg_file);
}

echo $inserted.'|'.$errors;
?>