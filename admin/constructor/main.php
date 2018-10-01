<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		 //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/constructor/check_login.php'); //проверка авторизации

if (!ini_get('zlib.output_compression')) {
	ob_start('ob_gzhandler', 1);
}
else  ob_start();

if (isset($_GET['m_id'])) {
	if ($_GET['m_id']<>0)  $_SESSION['___GoodCMS']['m_id']=$_GET['m_id'];
	else unset($_SESSION['___GoodCMS']['m_id']);
}
$CMS_TEMPLATE						= 'main.tpl';
$_SESSION['___GoodCMS']['pageID']	= '?act=m_c';


if (isset($_GET['hide_menu'])) {
	$smarty->assign('hide_menu', 'true');
}

$FILE_MANAGER->close();

$smarty->display($CMS_TEMPLATE);

ob_flush();

?>