<?php
//если браузер ИЕ ниже 9
if (mb_strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9')===false) {
	header('X-UA-Compatible: IE=9');
}

//если запрос пришел от swfupload
if (isset($_GET['PHPSESSID'])) {
	session_id($_GET['PHPSESSID']);
}

require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		 //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/check_login.php');  //проверка авторизации

if (extension_loaded('zlib')) {
	ob_start('ob_gzhandler', 1);
}
else {
	ob_start();
}

include_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/linker.php';           		//делаем обработку строки запроса

$CMS_TEMPLATE	= 'rightFrame.tpl';
$obj			= new Linker($mysql, $smarty);
$smarty			= $obj->getSmarty();

if (isset($_GET['hide_menu'])) {
	$smarty->assign('hide_menu', 'true');
}

//формируем ссылку, которую следует подсветить
if (isset($_SESSION['___GoodCMS']['back_url'])) {
	$current_url		= $_SERVER['REQUEST_URI'];
	list($format_url, $page_url)			= $GENERAL_FUNCTIONS->getFormatURL($current_url);
	
}
else {
	$format_url			= $_SERVER['REQUEST_URI'];
	$page_url			= SETTINGS_HTTP_HOST;
}

//запоминаем ссылку
$_SESSION['___GoodCMS']['back_url']	= $_SERVER['REQUEST_URI'];

$smarty->assign('format_url', 	$format_url);
$smarty->assign('page_url', 	$page_url);

$smarty->assign('pages_template', 'pages.tpl');     	//навигация
$smarty->display($CMS_TEMPLATE);

ob_flush();


?>