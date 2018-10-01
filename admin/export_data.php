<?php
/**
 * Форма экспорта данных
 */


//проверка авторизации
require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		    //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/check_login.php');      //проверка авторизации
$mysql->executeSQL('SET sql_mode=\'\'');												//устанавливаем не строгий формат Mysql. Это позволит вставлять записи, если не все поля указаны


$query					= "SELECT `description` FROM `$MYSQL_TABLE18` WHERE `table_name`='{$_GET['t_name']}'";
$result					= $mysql->executeSQL($query);
list($table_description)= $mysql->fetchRow($result);

$MSGTEXT['import_xls_caption']	= sprintf($MSGTEXT['import_xls_caption'], 	$table_description);
$MSGTEXT['import_xls_help']		= sprintf($MSGTEXT['import_xls_help'], 		$table_description);

$smarty->assign('MSGTEXT', 													$MSGTEXT); //подключаем сообщения из файла

//запускаем форму вставки записей
if (isset($_GET['saveExportSettings'])) {
	saveExportSettings();
}
else {
	showSettingsForm();
}



/////////////////////////////////////БИБЛИОТЕЧНЫЕ ФУНКЦИИ///////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Отобразить форму настроек экспорта
 *
 */
function showSettingsForm() {
	GLOBAL  $smarty, $MSGTEXT, $MYSQL_TABLE16, $MYSQL_TABLE17, $MYSQL_TABLE18, $mysql;

	//берём данные таблицы
	$query	= "SELECT * FROM `$MYSQL_TABLE18` WHERE `table_name`='{$_GET['t_name']}'";
	$result	= $mysql->executeSQL($query);
	$table	= $mysql->fetchAssoc($result);

	//берём поля, которые добавлены в импорт
	$fieldsSettings		= array();
	$query				= "SELECT t.*, t2.fieldname FROM `$MYSQL_TABLE16` AS `t` LEFT JOIN `$MYSQL_TABLE17` AS `t2` ON (t.field_id=t2.id) WHERE t.table_id='{$table['id']}'";
	$result				= $mysql->executeSQL($query);
	while ($row			= $mysql->fetchAssoc($result)) {
		$fieldsSettings[$row['fieldname']] = $row;
	}

	//берём поля таблицы
	$query				= "SELECT * FROM `$MYSQL_TABLE17` WHERE `table_id`='{$table['id']}'  ORDER BY `sort_index` DESC";
	$result				= $mysql->executeSQL($query);
	while ($row			= $mysql->fetchAssoc($result)) {
		if (isset($fieldsSettings[$row['fieldname']])) {
			$row['export_this_field']	= true;
		}
		$fields[]	= $row;
	}

	if (!isset($_GET['lang_id'])) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/dictionary/configLanguage.php');  //подключаем языки материала

		$lang_id	= $LANGUAGES_OF_MATERIAL[SETTINGS_LANGUAGE_OF_MATERIALS]['id'];
	}
	else {
		$lang_id	= $_GET['lang_id'];
	}

	$export_caption=sprintf($MSGTEXT['export_caption'], 	$table['description']);
	$smarty->assign('export_caption', 						$export_caption);
	$smarty->assign('table', 								$table);
	$smarty->assign('fieldsSettings', 						$fieldsSettings);
	$smarty->assign('fields', 								$fields);
	$smarty->assign('lang_id', 								$lang_id);
	$smarty->assign('sort_type', 							$_GET['sort_type']);
	$smarty->assign('sort_by', 								$_GET['sort_by']);
	$smarty->assign('tag_id', 								$_GET['tag_id']);
	$smarty->assign('page_id', 								$_GET['page_id']);

	$smarty->display('export_data.tpl');
}


/**
 * Сохранение настроек экспорта и переход на экспорт данных
 *
 */
function saveExportSettings() {
	GLOBAl $mysql, $smarty, $MYSQL_TABLE16, $MYSQL_TABLE17, $MYSQL_TABLE18;


	require_once 'includes/GeneralFunctions.php';//библиотека общедоступных функций
	$GENERAL_FUNCTIONS= new GeneralFunctions($mysql, $smarty);

	//берём данные таблицы
	$query	= "SELECT * FROM `$MYSQL_TABLE18` WHERE `table_name`='{$_GET['t_name']}'";
	$result	= $mysql->executeSQL($query);
	$table	= $mysql->fetchAssoc($result);

	//сохраняем поля, которые экспортируются
	$fieldsSettings	= array();
	$query			= "SELECT t.*, t2.fieldname FROM `$MYSQL_TABLE16` AS `t` LEFT JOIN `$MYSQL_TABLE17` AS `t2` ON (t.field_id=t2.id) WHERE t.table_id='{$table['id']}'";
	$result			= $mysql->executeSQL($query);
	while ($row		= $mysql->fetchAssoc($result)) {
		$fieldsSettings[$row['fieldname']] = $row;
	}

	$insert			= array();
	$delete			= array();
	$update			= array();
	//берём поля таблицы
	$query			= "SELECT * FROM `$MYSQL_TABLE17` WHERE `table_id`='{$table['id']}'  ORDER BY `sort_index` DESC";
	$result			= $mysql->executeSQL($query);
	while ($row		= $mysql->fetchAssoc($result)) {
		if (isset($fieldsSettings[$row['fieldname']])) {
			$row['export_this_field']=true;
		}
		$fields[]  = $row;

		//выводить ли числовой индекс вместо названия
		if (isset($_POST[$row['fieldname'].'+id'])) {
			$show_id	= 1;
		}
		else {
			$show_id	= 0;
		}


		if (isset($_POST[$row['fieldname']]) && !isset($fieldsSettings[$row['fieldname']])) {

			$insert[] = "('{$table['id']}', '{$row['id']}','$show_id')";
		}
		else if (isset($_POST[$row['fieldname']]) && isset($fieldsSettings[$row['fieldname']])) {
			$update[] = "UPDATE `$MYSQL_TABLE16` SET `show_id`='$show_id' WHERE `id`='{$fieldsSettings[$row['fieldname']]['id']}'";
		}
		else if (!isset($_POST[$row['fieldname']]) && isset($fieldsSettings[$row['fieldname']])) {
			$delete[] = "'{$row['id']}'";
		}
	}

	//добавляем настройку
	if (count($insert)>0)     {
		$insert	= implode(',', $insert);
		$query	= "INSERT INTO `$MYSQL_TABLE16` (`table_id`, `field_id`, `show_id`) VALUES $insert";
		$result	= $mysql->executeSQL($query);
	}

	//обновляем настройку
	if (count($update)>0)     {
		foreach ($update as $query) {
			//print $query.'<br>'; 
			$result	= $mysql->executeSQL($query);
		}
	}


	//удаляем настройку
	if (count($delete)>0)     {
		$delete	= implode(',', $delete);
		$query	= "DELETE FROM `$MYSQL_TABLE16` WHERE `field_id` IN ($delete)";
		$result	= $mysql->executeSQL($query);
	}

	if (isset($_GET['filter_for_table'])) {
		$filter_for_table	= '&filter_for_table='.$_GET['filter_for_table'];
	}
	else {
		$filter_for_table	= '';
	}

	$GENERAL_FUNCTIONS->gotoURL("index.php?act=modules&do=managedata&page_id={$_GET['page_id']}&tag_id={$_GET['tag_id']}&mdo=form_data&sort_by={$_GET['sort_by']}&sort_type={$_GET['sort_type']}&lang_id={$_GET['lang_id']}{$filter_for_table}&t_name={$table['table_name']}&p=1&report_type={$_POST['report_type']}&create_report=true");
}


?>