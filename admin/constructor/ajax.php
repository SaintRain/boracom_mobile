<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		 //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/constructor/check_login.php'); //проверка авторизации

header('Content-Type: text/html; charset=UTF-8');

require_once('lib.php');
if (isset($_GET['func'])) {

	require_once 'config.php';          		//настройки подключение к БД
	require_once 'DbConnectionCTR.php';			//класс для работы с БД

	$mysql	=	 new DbConnectionCTR();
	$func	= $_GET['func'];

	if ($func=='updateCtrGSettins') {
		if (updateCtrGSettings($_GET['caption'], $_GET['value'])) $out='ok';
		else $out=$MSGTEXT['config_is_notwriteable'];
		echo $out;
	}

	elseif ($func=='updateDataMap') {
		$field_id			= $_GET['field_id'];
		$sourse_field_id	= $_GET['sourse_field_id'];
		$delete_value		= $_GET['delete_value'];
		$own_filter_value	= $_GET['own_filter_value'];
		$query				= "UPDATE `$MYSQL_CTR_TABLE21` SET `sourse_field_id`='$sourse_field_id', `delete`='$delete_value', `own_filter`='$own_filter_value' WHERE `id`='$field_id'";
		$result				= $mysql->executeSQL($query);

		setHistory($_SESSION['___GoodCMS']['m_id'], 2, 6, $field_id);
		echo true;
	}
	elseif ($func=='getTables') {

		//$data_id	= $_GET['id'];
		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE18` WHERE `module_id`='{$_GET['module_id']}' ORDER BY `sort_index`";
		$result		= $mysql->executeSQL($query);
		$str='';
		while ($row=$mysql->fetchAssoc($result)) {
			$str.=$row['id'].'|'.$row['name'].'|';
		}
		$mysql->freeResult($result);
		$str	= mb_substr($str, 0, -1);
		echo $str;
	}
	elseif ($func=='getFields') {
		if ($_GET['table_id']>0) {

			//если подстановка только для FriendFilter, то находим поля с типом редактирования INPUT
			if (isset($_GET['friendlyFilter'])) $friendlyURLWhere=" AND (`edittype_id`='1' OR `edittype_id`='2')";
			else $friendlyURLWhere='';

			if (isset($_GET['CopyNewContent'])) $CopyNewContent=" AND (`edittype_id`='1' OR `edittype_id`='2')";
			else $CopyNewContent='';

			$query				= "SELECT * FROM `$MYSQL_CTR_TABLE21` WHERE `table_id`='{$_GET['table_id']}' $friendlyURLWhere $CopyNewContent ORDER BY `sort_index` DESC";
			$result				= $mysql->executeSQL($query);
			$str='';
			while ($row=$mysql->fetchAssoc($result)) {
				$str.=$row['id'].'|'.$row['fieldname'].'|';
			}
			$mysql->freeResult($result);
			$str	= mb_substr($str, 0, -1);
			echo $str;
		}
	}
	elseif ($func=='getTemplate') {			//сортировка по убыванию или возростанию
		getTemplate();
	}
	elseif ($func=='save_fsettings') {		//сортировка по убыванию или возростанию
		save_fsettings();
	}
}


//////////////////////////////////////Вызываемые функции//////////////////////////////////////////////

function save_fsettings() {
	GLOBAL $MYSQL_CTR_TABLE25, $mysql, $BAD_SYMBOLS;

	$fields['id']=$_POST['id'];

	if (SETTINGS_MAGIC_QUOTES_GPC) $slash=true;
	else $slash=false;

	if (isset($_POST['active'])) $fields['active']=$_POST['active'];
	else $fields['active']=0;

	if (isset($_POST['check_regular_id'])) $fields['check_regular_id']=$_POST['check_regular_id'];
	else  $fields['check_regular_id']=0;

	if (isset($_POST['show_in_list'])) $fields['show_in_list']=$_POST['show_in_list'];
	else $fields['show_in_list']=0;

	if (isset($_POST['filter'])) $fields['filter']=$_POST['filter'];
	else $fields['filter']=0;

	if ($slash) {
		$fields['regex_other']		= $_POST['regex_other'];
		$fields['height']			= str_replace($BAD_SYMBOLS, '', $_POST['height']);
		$fields['width']			= str_replace($BAD_SYMBOLS, '', $_POST['width']);
		$fields['style']			= str_replace($BAD_SYMBOLS, '', $_POST['style']);
		$fields['hide_on_value']	= str_replace($BAD_SYMBOLS, '', $_POST['hide_on_value']);
	}
	else {
		if ($fields['check_regular_id']<0) $fields['regex_other']		= addslashes($_POST['regex_other']);
		else $fields['regex_other']	='';
		$fields['height']			= addslashes(str_replace($BAD_SYMBOLS, '', $_POST['height']));
		$fields['width']			= addslashes(str_replace($BAD_SYMBOLS, '', $_POST['width']));
		$fields['style']			= addslashes(str_replace($BAD_SYMBOLS, '', $_POST['style']));
		$fields['hide_on_value']	= addslashes(str_replace($BAD_SYMBOLS, '', $_POST['hide_on_value']));
	}

	//преобразуем в нужный формат
	if ($fields['check_regular_id']==-2) {
		$fields['regex_other']		= str_replace(array(' ', ';'), array('', ','), $fields['regex_other']);
	}

	if (isset($_POST['avator_quality']) && is_numeric($_POST['avator_quality'])) {
		if ($_POST['avator_quality']>100) $fields['avator_quality']			= 100;
		else $fields['avator_quality']			= $_POST['avator_quality'];
	}
	else $fields['avator_quality']=0;

	if (isset($_POST['avator_width'])  && is_numeric($_POST['avator_width'])) $fields['avator_width']				= $_POST['avator_width'];
	else $fields['avator_width']=0;

	if (isset($_POST['avator_height'])  && is_numeric($_POST['avator_height'])) $fields['avator_height']			= $_POST['avator_height'];
	else $fields['avator_height']=0;

	if (isset($_POST['avator_quality_big'])  && is_numeric($_POST['avator_quality_big'])) {
		if ($_POST['avator_quality_big']>100) $fields['avator_quality_big']	= 100;
		else	$fields['avator_quality_big']	= $_POST['avator_quality_big'];
	}
	else $fields['avator_quality_big']=0;

	if (isset($_POST['avator_width_big'])  && is_numeric($_POST['avator_width_big'])) $fields['avator_width_big']		= $_POST['avator_width_big'];
	else $fields['avator_width_big']=0;

	if (isset($_POST['avator_height_big'])  && is_numeric($_POST['avator_height_big'])) $fields['avator_height_big']	= $_POST['avator_height_big'];
	else $fields['avator_height_big']=0;

	$fields['hide_by_field']		= $_POST['hide_by_field'];
	$fields['hide_operator']		= $_POST['hide_operator'];

	//если не выбрано поле
	if ($fields['hide_by_field']==0) {
		$fields['hide_operator']	=0;
		$fields['hide_on_value']	='';
	}

	$query	= "UPDATE `$MYSQL_CTR_TABLE25` SET
			`active`='{$fields['active']}',
			`show_in_list`='{$fields['show_in_list']}',		
			`filter`='{$fields['filter']}',						
			`check_regular_id`='{$fields['check_regular_id']}',
			`regex_other`='{$fields['regex_other']}',								
			`height`='{$fields['height']}',
			`width`='{$fields['width']}',
			`style`='{$fields['style']}',
			`hide_by_field`='{$fields['hide_by_field']}',
			`hide_operator`='{$fields['hide_operator']}',
			`hide_on_value`='{$fields['hide_on_value']}',
			`avator_quality`='{$fields['avator_quality']}',
			`avator_width`='{$fields['avator_width']}',
			`avator_height`='{$fields['avator_height']}',
			`avator_quality_big`='{$fields['avator_quality_big']}',
			`avator_width_big`='{$fields['avator_width_big']}',
			`avator_height_big`='{$fields['avator_height_big']}'	
			
			WHERE  `id`='{$fields['id']}'";

	$result		= $mysql->executeSQL($query);
	setHistory($_SESSION['___GoodCMS']['m_id'], 2, 7, $fields['id']);

	echo '<html><body><script>window.close()</script></body></html>';
}


/**
 * Взвращает содержимое запрашиваемого шаблона
 *
 */
function getTemplate() {
	GLOBAL $mysql, $MSGTEXT,$MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE22, $MYSQL_CTR_TABLE25, $MYSQL_CTR_TABLE26;

	if ($_GET['tpl_name']=='addLinkForm.tpl') {
		$out	= file_get_contents('templates/'.$_GET['tpl_name']);
	}

	elseif ($_GET['tpl_name']=='editFieldSettings.tpl') {
		$smarty	= getSmarty();

		if (is_numeric($_GET['f_id'])) {
			$query		= "SELECT count(*) FROM `$MYSQL_CTR_TABLE25` WHERE  field_id={$_GET['f_id']}";
			$result		= $mysql->executeSQL($query);
			list($r)	= $mysql->fetchRow($result);

			//создаем пустые записи настроек для полей таблицы
			if ($r==0) {
				$query		= "INSERT INTO `$MYSQL_CTR_TABLE25` (`field_id`) VALUES ('{$_GET['f_id']}')";
				$result		= $mysql->executeSQL($query);
			}

			$query		= "SELECT f.id, f.table_id,  f.edittype_id, f.auto_incr, f.comment, f.fieldname, f.datatype_id, f.sourse_field_id, $MYSQL_CTR_TABLE22.edittype, $MYSQL_CTR_TABLE25.* FROM	`$MYSQL_CTR_TABLE25`, `$MYSQL_CTR_TABLE21` as `f` LEFT JOIN `$MYSQL_CTR_TABLE22` ON (f.edittype_id=$MYSQL_CTR_TABLE22.id) WHERE  f.id={$_GET['f_id']} AND $MYSQL_CTR_TABLE25.field_id=f.id";
			$result		= $mysql->executeSQL($query);
			$field		= $mysql->fetchAssoc($result);

			foreach ($field AS $k=>$v) {
				$field[$k]	= htmlspecialchars($v, ENT_QUOTES);
			}

			//берем данные таблицы
			$query				= "SELECT `name`, `description` FROM `$MYSQL_CTR_TABLE18` WHERE `id`='{$_GET['t_id']}'";
			$result				= $mysql->executeSQL($query);
			list($table_name, $table_description)	= $mysql->fetchRow($result);

			$query				= "SELECT * FROM `$MYSQL_CTR_TABLE26`";
			$result				= $mysql->executeSQL($query);
			$check_regular		= $mysql->fetchAssocAll($result);

			$query				= "SELECT `fieldname`, `id` FROM `$MYSQL_CTR_TABLE21` WHERE  `table_id`='{$_GET['t_id']}' AND `edittype_id` NOT IN (0,8,9,10,11,12)  ORDER BY `sort_index` DESC";
			$result				= $mysql->executeSQL($query);
			$f_list				= $mysql->fetchAssocAll($result);

			$smarty->assign('check_regular',		$check_regular);
			$smarty->assign('field',				$field);
			$smarty->assign('f_list',				$f_list);

			if (isset($_GET['c_number']))  			$smarty->assign('c_number', $_GET['c_number']);
			$smarty->assign('table_name',			$table_name);
			$smarty->assign('table_description',	$table_description);
		}

		$out		= $smarty->fetch($_GET['tpl_name']);
	}
	else {
		$smarty			= getSmarty();
		$tables			= array();
		$modules		= array();
		$fields			= array();
		$current_module	= array();
		$current_table	= '';

		$friendlyURLWhere	= '';
		$CopyNewContentWhere= '';

		if ($_GET['selected_edit_type']==14) $friendlyURL=true;
		else $friendlyURL=false;

		if ($_GET['selected_edit_type']==15) $CopyNewContent=true;
		else $CopyNewContent=false;


		//определяем из какого модуля поле
		$query		= "SELECT t2.module_id
			FROM `$MYSQL_CTR_TABLE21` AS `t` 
			JOIN `$MYSQL_CTR_TABLE18` AS `t2` ON (t2.id=t.table_id) WHERE t.id='{$_GET['sourse_field_id']}'";
		$result		= $mysql->executeSQL($query);
		list($module_id) = $mysql->fetchRow($result);
		if (!$module_id) {
			$module_id=$_GET['module_id'];
		}

		//берём список модулей
		if ($friendlyURL || $CopyNewContent) {
			$queryM		= "SELECT * FROM `$MYSQL_CTR_TABLE17` WHERE `id`='$module_id'  ORDER BY `sort_index`";
		}
		else {
			$queryM		= "SELECT * FROM `$MYSQL_CTR_TABLE17`  ORDER BY `sort_index`";
		}
		$result		= $mysql->executeSQL($queryM);
		while ($row = $mysql->fetchAssoc($result)) {
			if ($row['id']==$module_id) {
				$current_module	= $row;
			}
			$modules[]			= $row;

		}

		if ($friendlyURL) {
			//берем название текущей страницы
			$query		= "SELECT * FROM `$MYSQL_CTR_TABLE18` WHERE `id`='{$_GET['table_id']}'";
			$result		= $mysql->executeSQL($query);
			while ($row = $mysql->fetchAssoc($result)) {
				$current_table	= $row['name'];
				$tables[]		= $row;
			}
			$friendlyURLWhere	= " AND (`edittype_id`=1 OR `edittype_id`=2)";

			$smarty->assign('friendlyURL', $friendlyURL);
		}
		elseif ($CopyNewContent) {

			//берем название текущей страницы
			$query		= "SELECT * FROM `$MYSQL_CTR_TABLE18` WHERE `id`='{$_GET['table_id']}'";
			$result		= $mysql->executeSQL($query);
			while ($row = $mysql->fetchAssoc($result)) {
				$current_table	= $row['name'];
				$tables[]		= $row;
			}
			$CopyNewContentWhere= " AND (`edittype_id`=1 OR `edittype_id`=2)";

			$smarty->assign('CopyNewContent', $CopyNewContent);
		}
		else {

			$query		= "SELECT * FROM `$MYSQL_CTR_TABLE18` WHERE `module_id`='{$module_id}' ORDER BY `sort_index`";
			$result		= $mysql->executeSQL($query);
			while ($row = $mysql->fetchAssoc($result)) {
				if ($row['id']==$_GET['table_id']) {
					$current_table	= $row['name'];
				}
				$tables[]			= $row;
			}


		}



		if (isset($_GET['c_number']))  {
			$delete			= $_GET['delete'];
			$own_filter 	= $_GET['own_filter'];
			$smarty->assign('delete', 		$delete);
			$smarty->assign('own_filter', 	$own_filter);
			$smarty->assign('c_number', 	$_GET['c_number']);
		}

		if (isset($_GET['sourse_field_id']) && $_GET['sourse_field_id']!=0)  {
			$query				= "SELECT * FROM `$MYSQL_CTR_TABLE21` WHERE `id`='{$_GET['sourse_field_id']}' ";
			$result				= $mysql->executeSQL($query);
			$field				= $mysql->fetchAssoc($result);
			$smarty->assign('saved_field', $field);

			$query				= "SELECT * FROM `$MYSQL_CTR_TABLE21` WHERE `table_id`='{$field['table_id']}' $friendlyURLWhere $CopyNewContentWhere ORDER BY `sort_index` DESC";
			$result				= $mysql->executeSQL($query);
			$fields				= $mysql->fetchAssocAll($result);
		}
		else  {
			if (count($tables)>0) {
				$query				= "SELECT * FROM `$MYSQL_CTR_TABLE21` WHERE `table_id`='{$tables[0]['id']}' ORDER BY `sort_index` DESC";
				$result				= $mysql->executeSQL($query);
				$fields				= $mysql->fetchAssocAll($result);
			}
		}

		if ($current_table!='') {
			$current_table_description= sprintf($MSGTEXT['editData_delete_source'], $current_table);
		}
		else {
			$current_table_description= $MSGTEXT['editData_delete_source_empty'];
		}

		$smarty->assign('current_table_description', $current_table_description);
		$smarty->assign('current_table', $current_table);
		$smarty->assign('current_module', $current_module);

		$smarty->assign('modules', $modules);
		$smarty->assign('tables', $tables);
		$smarty->assign('fields', $fields);

		$out	= $smarty->fetch($_GET['tpl_name']);
	}

	echo $out;
}



/**
 * Подключаем смарти
 *
 * @return class
 */
function getSmarty() {
	GLOBAL $MSGTEXT;
	require_once '../config.php';          		//настройки подключение к БД
	//подключаем смарти
	require_once '../smarty/Smarty.class.php';
	$smarty					= new Smarty();
	$smarty->template_dir	= $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/constructor/templates/';
	$smarty->compile_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_c/';
	$smarty->assign('MSGTEXT', $MSGTEXT); 					//подключаем сообщения из файла
	return $smarty;
}

?>