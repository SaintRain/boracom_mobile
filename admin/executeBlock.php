<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		    //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/check_login.php');      //проверка авторизации

$module_name	= $_GET['module_name'];
$block_name		= $_GET['block_name'];
include_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/After_API_Edit.php');
$obj		= new After_API_Edit($module_name, $block_name);

echo $obj->contentOUT;

?>