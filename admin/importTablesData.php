<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		 //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/check_login.php');  //проверка авторизации
$mysql->executeSQL('SET sql_mode=\'\'');												//устанавливаем не строгий формат Mysql. Это позволит вставлять записи, если не все поля указаны

/**
* Делает вставку записей в таблицы импортируемого модуля
*/
header('Content-Type: text/html; charset=UTF-8');

$table_name		= $_GET['table_name'];
$module_name	= $_GET['module_name'];
$limit			= $_GET['limit'];
$start			= $_GET['start'];

//получаем файл настроек модуля
$dir_import_settings					= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$module_name.'/management/import_settings/import_settings.php';
include ($dir_import_settings);

//получаем данные для вставки
$datamassiv								= array_slice($DATA['TABLES_DATA'][$table_name], $start, $limit);
$full_table_name						= mb_strtolower($module_name.'_'.$table_name);

//берем описание полей таблицы
$tfields			= array();
$query				= "SELECT t2.fieldname, t2.id, t2.edittype_id FROM `$MYSQL_TABLE18` AS `t` JOIN  `$MYSQL_TABLE17` AS `t2` ON (t2.table_id=t.id AND t2.edittype_id=4) WHERE t.table_name='$full_table_name'";
$result				= $mysql->executeSQL($query);
while ($row 		= $mysql->fetchAssoc($result)) {
	$tfields[$row['fieldname']]		   = $row;
}

//вставляем данные в системные таблицы
$multimasiv=array();
if (count($tfields)>0) {

	if (isset($DATA['TABLES_DATA_MULTISELECT'])) {
		foreach ($DATA['TABLES_DATA_MULTISELECT'] as $table) {
			foreach ($table as $d) {
				$multimasiv[$d['field_id']][$d['data_id']][]=$d;
			}
		}
	}
}
unset($DATA);


//берем названия полей
$fields_names	= array();
foreach ($datamassiv as $d) {
	foreach ($d as $field=>$f_value) {
		$fields_names[]=$field;
	}
	break;
}

//берем для вставки записи
$values			= '';
$insert_system_data = array();
foreach ($datamassiv as $d) {
	$v					= array();
	foreach ($d as $field=>$f_value) {
		
		//сбрасываем значения системных полей
		if ($field=='page_id' || $field=='tag_id') {
			$f_value=0;
			}

		//для полей с типом редактирования multiselect подставляем правильный ID поля
		if (isset($tfields[$field]) && $f_value!='' && isset($multimasiv[$f_value][$d['id']])) {
			foreach ($multimasiv[$f_value][$d['id']] as $mm) {
				$insert_system_data[]	= "('{$tfields[$field]['id']}', '{$mm['data_id']}', '{$mm['value_id']}')";
			}
			$f_value					= $tfields[$field]['id'];
		}

		$f_value	= $mysql->realEscapeString($f_value);
		$v[]		= "'$f_value'";
	}
	$v		= implode(',', $v);
	$values.= "($v),";
}

if ($values!='') {
	foreach ($fields_names as $key=>$v) {
		$fields_names[$key]="`$v`";
	}

	$fields_names	= implode(',', $fields_names);
	$fields_names	= "($fields_names)";
	$values			= mb_substr($values, 0,-1);
	$query			= "INSERT INTO `$full_table_name` $fields_names VALUES $values";
	if ($result		= $mysql->executeSQL($query)) {
		$res		= true;
	}
	else {
		$res		= false;
	}

	//вставка мультиселект данных
	if (count($insert_system_data)>0) {
		$insert_system_data		= implode(',', $insert_system_data);
		$query					= "INSERT INTO `$MYSQL_TABLE13` (`field_id`, `data_id`, `value_id`) VALUES $insert_system_data";
		$mysql->executeSQL($query);
	}
}
else $res=true;

echo $res;

?>