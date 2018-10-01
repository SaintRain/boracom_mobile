<?php
//если браузер ИЕ ниже 9
if (mb_strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9')===false) { 
	//header('X-UA-Compatible: IE=9');	
}

session_start();

ini_set('session.gc_maxlifetime', 0);

define('REQUIRE_ADDITIONAL_FILES', 		true);		 //если флаг выставлен, то будует подключен файловый менеджер

if (extension_loaded('zlib')) {
	//ob_start('ob_gzhandler', 1);
}
else {
	ob_start();
}
require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		 //путь к админзоне
require_once  $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/config.php';          				//настройки подключение к БД
require_once 'DbConnection.php';					//класс для работы с БД
$mysql	=	 new DbConnection();

require $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/languages/'.SETTINGS_LANGUAGE;	//подключаем язык

//подключаем смарти
require_once 'smarty/Smarty.class.php';

$smarty					= new Smarty();
$smarty->cache			= true;
$smarty->compile_check  = true;
$smarty->template_dir	= $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/templates/';
$smarty->compile_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_c/';
$smarty->cache_dir		= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/cache/';


$smarty->assign('MSGTEXT', $MSGTEXT); //подключаем сообщения из файла

require_once 'includes/GeneralFunctions.php';			//библиотека общедоступных функций
require_once 'classes/CMSProtection.php';      			//библиотека функций админки

$GENERAL_FUNCTIONS	= new GeneralFunctions($mysql, $smarty);
$CMSProtection		= new CMSProtection($mysql, $smarty);
$out				= $CMSProtection->check_login();   	//проверка авторизации

if ($out===true) {

	//для безопасности назначаем переменную в сессию для данного пользователя
	$_SESSION['___GoodCMS']['REMOTE_ADDR']		= $_SERVER['REMOTE_ADDR'];
	$_SESSION['___GoodCMS']['HTTP_USER_AGENT']	= $_SERVER['HTTP_USER_AGENT'];

	header('Location: main.php');

	exit;
}
else {
	$smarty			= $out['smarty'];
	$CMS_TEMPLATE	= $out['CMS_TEMPLATE'];
}

//проверяем, чтоб в настройках был указан верный хост, иначе переписываем
$cleare_host			= str_ireplace(array('http://', 'www.'), '', SETTINGS_HTTP_HOST);
$cleare_host_current	= str_ireplace(array('http://', 'www.'), '', $_SERVER['HTTP_HOST']);

if (SETTINGS_HTTP_HOST=='' || $cleare_host!=$cleare_host_current) {
	$host='http://'.$_SERVER['HTTP_HOST'];
	$GENERAL_FUNCTIONS->updateGSettings('SETTINGS_HTTP_HOST', $host);
	
	//переписываем в настройках перенаправление хоста
	$GENERAL_FUNCTIONS->replaceHostInHtaccess($host);	
}
else {
	$host=SETTINGS_HTTP_HOST;
}

$smarty->assign('host', $host);

$smarty->display($CMS_TEMPLATE);

ob_flush();

?>