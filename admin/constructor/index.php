<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		 //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/constructor/check_login.php'); //проверка авторизации

if (!ini_get('zlib.output_compression')) {
	ob_start('ob_gzhandler', 1);
}
else  ob_start();


$CMS_TEMPLATE	= 'rightFrame.tpl';

include_once 'linker.php';           				//делаем обработку строки запроса
$obj	= new Linker($mysql, $smarty);
$smarty	= $obj->getSmarty();


if (isset($_GET['hide_menu'])) {
	$smarty->assign('hide_menu', 'true');
}

$FILE_MANAGER->close();

$smarty->assign('pages_template', 'pages.tpl');     //навигация
$smarty->display($CMS_TEMPLATE);

ob_flush();

?>