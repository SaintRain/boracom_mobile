<?php

$module_name	= 'InternetShop';	//имя модуля
$block_name		= 'JSActions';		//имя блока
require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		    //путь к админзоне
include_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/After_API_Edit.php');
$obj		= new After_API_Edit($module_name, $block_name);	//вызываем блок на выполнение
echo $obj->contentOUT;

?>