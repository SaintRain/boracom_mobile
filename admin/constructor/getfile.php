<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		 //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/constructor/check_login.php'); //проверка авторизации

$file_name	= $_GET['f'];
if (file_exists('compiled/'.$file_name)) {
	$content	= file_get_contents('backup/'.$file_name);
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', FALSE);
	header('Pragma: no-cache');
	header('Content-Disposition: attachment; filename="'.$file_name.'"');
	echo $content;
}
?>