<?php
@session_start();

ini_set('session.gc_maxlifetime', 0);

//проверка безопасности сессий
$check_user_session		= $_SERVER['REMOTE_ADDR'];
if (isset($_SERVER['HTTP_USER_AGENT'])) {
	$check_user_session.=$_SERVER['HTTP_USER_AGENT'];
}

//проверяем, чтоб небыло подмены сессии
if (count($_SESSION>0)) {
	if (isset($_SESSION['___GoodCMS']['check_user_session'])) {
		if ($check_user_session!=$_SESSION['___GoodCMS']['check_user_session']) {
			session_destroy();
		}
	}
}

define('REQUIRE_ADDITIONAL_FILES', 		true);		 	//если флаг выставлен, то будует подключен язык админки и файловый менеджер

require_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/constructor/config.php';          					//настройки подключение к БД
require_once 'DbConnectionCTR.php';						//класс для работы с БД
$mysql	=	 new DbConnectionCTR();

require_once 'lib.php';              					//библиотека функций конструктора

//подключаем смарти
require_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/Smarty.class.php';
$smarty					= new Smarty();
$smarty->cache			= true;
$smarty->compile_check  = true;
$smarty->template_dir	= $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/constructor/templates/';
$smarty->compile_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_constructor/';
$smarty->cache_dir		= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/cache/';

$smarty->assign('MSGTEXT', $MSGTEXT);					//подключаем сообщения из файла

require_once '../classes/CMSProtection.php';      		//библиотека функций админки
require_once '../includes/GeneralFunctions.php';		//библиотека общедоступных функций
$GENERAL_FUNCTIONS	= new GeneralFunctions($mysql, $smarty);
$CMSProtection		= new CMSProtection($mysql, $smarty);
$out				= $CMSProtection->check_login();	//проверка авторизации


if ($out!==true) {
	header('Location: /'.SETTINGS_ADMIN_PATH.'/login.php');
	exit;
}

?>