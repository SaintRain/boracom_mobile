<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		 //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/check_login.php');  //проверка авторизации

if (extension_loaded('zlib')) {
	ob_start('ob_gzhandler', 1);
}
else {
	ob_start();
}

$CMS_TEMPLATE	= 'leftFrame.tpl';
require_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/classes/Pages.class.php');

$obj	= new Pages($mysql, $smarty);

$getPageCategoryTreeAndPages	= $obj->getPageCategoryTreeAndPages();

$smarty->assign('pCategoriesAndPages',	$getPageCategoryTreeAndPages);


if (isset($_GET['hide_menu'])) {
	$smarty->assign('hide_menu', 'true');
}

$smarty->display($CMS_TEMPLATE);
/*
if (isset($_SESSION['___GoodCMS']['select_page_by_url'])) {

	$_SESSION['___GoodCMS']['select_page_by_url']='';
	
}
*/

ob_flush();
?>