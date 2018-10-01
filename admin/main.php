<?php
//если браузер ИЕ ниже 9
if (mb_strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9')===false) { 
	header('X-UA-Compatible: IE=9');	
}
require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		 //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/check_login.php');  //проверка авторизации

if (extension_loaded('zlib')) {
	ob_start('ob_gzhandler', 1);
}
else {
	ob_start();
}

if (isset($_SESSION['___GoodCMS']['back_url']) && $_SESSION['___GoodCMS']['back_url']!='') {
	$url				= $_SESSION['___GoodCMS']['back_url'];
	list($format_url)	= $GENERAL_FUNCTIONS->getFormatURL($url);
	
	$smarty->assign('format_url', $format_url);
}
else {
	$url	= 'index.php';
}

$smarty->assign('url', $url);

$CMS_TEMPLATE	= 'main.tpl';

$smarty->display($CMS_TEMPLATE);

ob_flush();

?>