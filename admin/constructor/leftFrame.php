<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		           //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/constructor/check_login.php'); //проверка авторизации

if (!ini_get('zlib.output_compression')) {
	ob_start('ob_gzhandler', 1);
}
else  ob_start();


$CMS_TEMPLATE	= 'leftFrame.tpl';

//сохраняем id редактируемого модуля в сесиию
if (isset($_GET['m_id'])) {
	if ($_GET['m_id']>0)  $_SESSION['___GoodCMS']['m_id']=$_GET['m_id'];
}

//берем список модулей
$query			= "SELECT * FROM `$MYSQL_CTR_TABLE17` ORDER BY `sort_index`";
$result			= $mysql->executeSQL($query);
$allModules		= $mysql->fetchAssocAll($result);
$smarty->assign('allModules',		$allModules);

if (isset($_SESSION['___GoodCMS']['m_id'])) {
	$query			= "SELECT * FROM `$MYSQL_CTR_TABLE18` WHERE `module_id`='{$_SESSION['___GoodCMS']['m_id']}' ORDER BY `sort_index`";
	$result			= $mysql->executeSQL($query);
	$allTables		= $mysql->fetchAssocAll($result);
	$smarty->assign('allTables',		$allTables);

	//берем список блоков
	$query			= "SELECT t.id, t.description, count(t2.id) AS `tpl_count` FROM `$MYSQL_CTR_TABLE23` AS `t` LEFT JOIN `$MYSQL_CTR_TABLE30` AS `t2` ON (t.id=t2.block_id) WHERE t.module_id='{$_SESSION['___GoodCMS']['m_id']}' GROUP BY t.id ORDER BY t.sort_index";
	$result			= $mysql->executeSQL($query);
	$allBlocks		= $mysql->fetchAssocAll($result);

	$smarty->assign('allBlocks',		$allBlocks);

	foreach ($allModules as $m) {
		if ($_SESSION['___GoodCMS']['m_id']==$m['id']) {

			$query					= "SELECT `id` FROM `$MYSQL_CTR_TABLE31` WHERE `module_id`='{$_SESSION['___GoodCMS']['m_id']}' LIMIT 1";
			$result					= $mysql->executeSQL($query);
			list($m['need_save'])	= $mysql->fetchRow($result);
			$smarty->assign('CurrentModule',		$m);
			break;
		}
	}
}

$smarty->display($CMS_TEMPLATE);

ob_flush();

?>