<?php
@session_start();

ini_set('session.gc_maxlifetime', 0);

//проверяем, чтоб небыло подмены сессии
if (count($_SESSION>0)) {
	if (!isset($_SESSION['___GoodCMS']) || $_SERVER['REMOTE_ADDR']!=$_SESSION['___GoodCMS']['REMOTE_ADDR']) {
		$_SESSION	= NULL;
		session_destroy();
	}
	elseif (isset($_SERVER['HTTP_USER_AGENT']) && $_SERVER['HTTP_USER_AGENT']!='Shockwave Flash' && $_SERVER['HTTP_USER_AGENT']!=$_SESSION['___GoodCMS']['HTTP_USER_AGENT']) {
		$_SESSION	= NULL;
		session_destroy();
	}
}

define('REQUIRE_ADDITIONAL_FILES', 		true);		 									//если флаг выставлен, то будует подключен язык админки и файловый менеджер

include $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/config.php';          						//настройки подключение к БД
include $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/DbConnection.php';							//класс для работы с БД
$mysql		= new DbConnection();

include $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/languages/'.SETTINGS_LANGUAGE;				//подключаем язык

//подключаем смарти
include $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/Smarty.class.php';
$smarty							= new Smarty();
$smarty->cache			= true;
$smarty->compile_check  = true;
$smarty->template_dir	= $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/templates/';
$smarty->compile_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_c/';
$smarty->cache_dir		= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/cache/';

$smarty->assign('MSGTEXT', $MSGTEXT); 													//подключаем сообщения из файла

include $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/GeneralFunctions.php';				//библиотека общедоступных функций
include $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/classes/CMSProtection.php';      				//библиотека защитных функций админки
$GENERAL_FUNCTIONS	= new GeneralFunctions($mysql, $smarty);
$CMSProtection		= new CMSProtection($mysql, $smarty);
$out				= $CMSProtection->check_login();   									//проверка авторизации

require_once ($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/FRAME_FUNCTIONS.php');		//библиотека общедоступных пользовательских функций
$FRAME_FUNCTIONS	= new FRAME_FUNCTIONS($mysql, $smarty, SETTINGS_FRIENDLY_URL);

if ($out!==true) {
	header('Location: /'.SETTINGS_ADMIN_PATH.'/login.php');
	exit;
}

?>