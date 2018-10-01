<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		 //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/check_login.php');  //проверка авторизации
$mysql->executeSQL('SET sql_mode=\'\'');												//устанавливаем не строгий формат Mysql. Это позволит вставлять записи, если не все поля указаны


$query							= "SELECT `description` FROM `$MYSQL_TABLE18` WHERE `table_name`='{$_GET['t_name']}'";
$result							= $mysql->executeSQL($query);
list($table_description)		= $mysql->fetchRow($result);

$MSGTEXT['import_xls_caption']	= sprintf($MSGTEXT['import_xls_caption'], $table_description);
$MSGTEXT['import_xls_help']		= sprintf($MSGTEXT['import_xls_help'], $table_description);
$smarty->assign('MSGTEXT', 	$MSGTEXT); 								//подключаем сообщения из файла

$upload_patch	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/';  	//папка, куда будут закачиваться файлы

//закачка файла
if (isset($_FILES['filename'])) {

	$FILES_tmp_name	= $_FILES['filename']['tmp_name'];
	$name			= $_FILES['filename']['name'];
	$mas			= explode('.', $name);
	$rash			= '.'.$mas[count($mas)-1];
	switch ($rash):
	case '.xls': 	$error	= false;  break;
	default: 		$error	= true;
	endswitch;


	if ($error) {
		$smarty->assign('error', $MSGTEXT['import_xls_bad_format']);
	}
	else {
		//находим свободное имя
		$NewName		= '1'.$rash;
		$findex			= 1;
		while (is_readable($upload_patch.$NewName))  {
			$NewName	= $findex.$rash;
			$findex++;
		}

		//закачиваем во временную папку под новым именем
		if (is_uploaded_file($FILES_tmp_name)) {
			if (move_uploaded_file($FILES_tmp_name, $upload_patch.$NewName)) {
				require_once 'includes/GeneralFunctions.php';			//библиотека общедоступных функций
				$GENERAL_FUNCTIONS	= new GeneralFunctions($mysql, $smarty);
				$GENERAL_FUNCTIONS->gotoURL("import_xls.php?page_id={$_GET['page_id']}&tag_id={$_GET['tag_id']}&lang_id={$_GET['lang_id']}&t_name={$_GET['t_name']}&tmpname=$NewName");
			}
		}
	}
	showLoadForm();
}
//разбираем файл и записываем его в базу
elseif (isset($_GET['tmpname'])) {
	$filename	= $_GET['tmpname'];
	require_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/Excel_Reader2.php';

	//читаем файл и записываем данные во временную таблицу
	if ($data = new Spreadsheet_Excel_Reader($upload_patch.$filename)) {
		unlink($upload_patch.$filename);							//удаляем закаченный файл

		if (replaceToTable($data)) {
			makeTableDump($_GET['t_name']);
			makeTableDump($MYSQL_TABLE13);
			require_once 'includes/GeneralFunctions.php';			//библиотека общедоступных функций
			$GENERAL_FUNCTIONS	= new GeneralFunctions($mysql, $smarty);
			$GENERAL_FUNCTIONS->gotoURL("import_xls.php?page_id={$_GET['page_id']}&tag_id={$_GET['tag_id']}&lang_id={$_GET['lang_id']}&t_name={$_GET['t_name']}&progress=true");
		}
		else {
			showLoadForm();
		}
	}
	//не удалось прочитать файл
	else {
		unlink($upload_patch.$filename);
		$smarty->assign('error', $MSGTEXT['import_xls_cannot_read']);
		showLoadForm();
	}
}
//запускаем форму вставки записей
elseif (isset($_GET['progress'])) {
	showProgressForm();
	$smarty->assign('msgs', $MSGTEXT['import_xls_ok']);
}

//вставляем запись
elseif (isset($_GET['insert'])) {
	insertRecords($_GET['t_name']);
}
//выводим форму импорта
else {
	showLoadForm();
}




/////////////////////////////////////БИБЛИОТЕЧНЫЕ ФУНКЦИИ///////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
* делаем дамп таблицы для аварийного восстановления
*
* @param string $table_name
*/
function makeTableDump($table_name) {
	GLOBAL $mysql;

	$query				= "CREATE TABLE `__{$table_name}` LIKE `$table_name`";
	if ($result			= $mysql->executeSQL($query)) {
		$query		= "INSERT  `__{$table_name}` SELECT * FROM `$table_name`";
		$result		= $mysql->executeSQL($query);
		$_SESSION['___GoodCMS']['t_backup'][]	= $table_name;  //запоминаем, что для таблицы сделали бекап
	}
}



/**
* Переносим данные из xls-файла во временную таблицу
*
* @param object $data
* @return bool
*/
function replaceToTable($data) {
	GLOBAL $MSGTEXT, $MYSQL_TABLE21, $MYSQL_TABLE18, $MYSQL_TABLE17, $smarty, $mysql;

	//проверяем соответствие колонок
	$table_name			= $_GET['t_name'];
	$query				= "SELECT t.* FROM `$MYSQL_TABLE18` LEFT JOIN `$MYSQL_TABLE17` as `t` on (t.table_id=$MYSQL_TABLE18.id) WHERE $MYSQL_TABLE18.table_name='$table_name'";
	$result				= $mysql->executeSQL($query);
	$table_fields		= $mysql->fetchAssocAll($result);

	//берем заголовки из файла
	$sopostavlenie		= array();
	if ($data->sheets[0]['numCols']>0) {
		for ($i=1; $i<$data->sheets[0]['numCols']+1; $i++) {
			if (isset($data->sheets[0]['cells'][1][$i])) {
				$caption		= $data->sheets[0]['cells'][1][$i];
				$caption		= trim(str_replace(array(SETTINGS_NEW_LINE, "\n"), array(' ',' '), $caption));
				if ($caption!='') $xls_fields[]	= $caption;
			}
		}

		$bad_colls	= array();
		foreach ($xls_fields as $xf)	{
			$flag	= false;
			foreach ($table_fields as $tf)	{
				//print $tf['comment'].'='.$xf.'<br>';
				if (mb_strtolower($tf['comment'])==mb_strtolower($xf)) {
					$flag				= true;
					$sopostavlenie[$xf]	= $tf['fieldname'];
					break;
				}
			}
			if (!$flag)	 {
				$bad_colls[]	= $xf;
			}
		}

		if (count($bad_colls)==0) $bad_colls=true;
	}
	//если документ пустой
	else {
		$bad_colls=false;
	}

	if ($bad_colls!==true) {
		if (is_array($bad_colls)) {
			//берем описание поля
			$query					= "SELECT `description` FROM `$MYSQL_TABLE18` WHERE `table_name`='{$_GET['t_name']}'";
			$result					= $mysql->executeSQL($query);
			list($description)		= $mysql->fetchRow($result);

			$smarty->assign('error', sprintf($MSGTEXT['import_xls_error_cols'], implode(', ', $bad_colls), $description));
		}
		else {
			$smarty->assign('error', sprintf($MSGTEXT['import_xls_empty']));
		}

		return false;
	}
	else {

		//делаем вставку в базу
		$xls_data	= array();
		$total_data = array();
		for ($i=2; $i<$data->sheets[0]['numRows']+1; $i++) {
			$i2					= 1;
			$ne_pustaya_stroka 	= false;
			foreach ($sopostavlenie as $fiedlname){
				if (isset($data->sheets[0]['cells'][$i][$i2])) {
					$value		= $data->sheets[0]['cells'][$i][$i2];

					if ($value!='') $ne_pustaya_stroka=true;

					if (isset($data->sheets[0]['cellsInfo'][$i][$i2]['rectype']) && $data->sheets[0]['cellsInfo'][$i][$i2]['rectype']=='number') {
						$xls_data[$fiedlname]	= str_replace(array(',', '%'), array('',''), trim($value));
					}
					else $xls_data[$fiedlname]	= htmlspecialchars(trim($value), ENT_QUOTES);
				}
				//если ячейка пустая
				else {
					$xls_data[$fiedlname]	= '';
				}
				$i2++;
			}

			if ($ne_pustaya_stroka)	{		//если строка не пустая
				$total_data[]				= $xls_data;
			}
		}


		$part1	= "INSERT INTO `$MYSQL_TABLE21` (`table_name`, `data`) VALUES ";
		$values	= array();
		$k		= 0;
		$ind	= 0;
		foreach ($total_data as $xls_data) {
			$ind++;
			$s_xd		= addslashes('return '.var_export($xls_data, true).';');
			$values[]	= "('$table_name', '$s_xd')";

			if ($k==50 || $ind==count($total_data)) {
				$part2		= implode(',', $values);
				$query		= $part1.$part2;
				$result		= $mysql->executeSQL($query);
				$values		= array();
				$k			= 0;
			}
			else {
				$k++;
			}
		}

		return true;
	}
}



/**
* Выводим форму результата импорта данных
*
*/
function showProgressForm() {
	GLOBAL  $MYSQL_TABLE21, $smarty, $mysql;

	$query					= "SELECT COUNT(*) FROM `$MYSQL_TABLE21` WHERE `table_name`='{$_GET['t_name']}'";
	$result					= $mysql->executeSQL($query);
	list($total_records)	= $mysql->fetchRow($result);
	$smarty->assign('total_records', $total_records);
	$smarty->display('import_xls_progress.tpl');
}



/**
* Функция вставки данных из временной в редактируемую таблицу
*	
* @param string $table_name
*/
function insertRecords($table_name) {
	GLOBAL $mysql, $MYSQL_TABLE21, $MYSQL_TABLE18, $MYSQL_TABLE17, $NOT_ADDED;

	header('Content-Type: text/html; charset=UTF-8');

	$table_name	= $_GET['t_name'];

	//берем данные для вставки
	$limit		= $_GET['limitRecords'];
	$query		= "SELECT `id`, `data` FROM `$MYSQL_TABLE21` WHERE `table_name`='{$table_name}' ORDER BY `id` DESC LIMIT $limit";
	$result		= $mysql->executeSQL($query);
	$xls_data	= $mysql->fetchAssocAll($result);

	if (count($xls_data)==0) {
		echo '0|0';
		exit;
	}

	$xls_fields_s		= '';
	foreach ($xls_data as $x) {
		//$xls	= unserialize($x['data']);
		$xls	= eval(stripslashes($x['data']));

		foreach ($xls as $xls_field => $x) {
			$xls_fields_s.="'$xls_field',";
		}
		break;
	}

	if ($xls_fields_s!='')	 $xls_fields_s	= mb_substr($xls_fields_s, 0, -1);

	//берем ID модуля скоторым нужно работать
	$query				= "SELECT `module_id` FROM `$MYSQL_TABLE18` WHERE `table_name`='{$table_name}'";
	$result				= $mysql->executeSQL($query);
	list($module_id)	= $mysql->fetchRow($result);

	//берем все таблицы модуля
	$allBlockTables		= array();
	$query				= "SELECT * FROM `$MYSQL_TABLE18` WHERE `module_id`='{$module_id}' ORDER BY `sort_index`";
	$result				= $mysql->executeSQL($query);
	while ($row			= $mysql->fetchAssoc($result)) {
		$allBlockTables[$row['table_name']] = $row;
	}

	//берем все поля редактируемой таблицы
	$table_fields		= array();
	$query				= "SELECT f.* FROM `$MYSQL_TABLE18` LEFT JOIN `$MYSQL_TABLE17` as `f` on (f.table_id=$MYSQL_TABLE18.id) WHERE $MYSQL_TABLE18.table_name='$table_name' AND f.fieldname IN ($xls_fields_s)";
	$result				= $mysql->executeSQL($query);
	while ($row			= $mysql->fetchAssoc($result)) {
		$table_fields[$row['fieldname']]	= $row;
	}

	//для каждого поля ищем таблицу от которой он зависит (если зависит)
	$surse_tables_fields		= array();
	foreach ($table_fields as $key=>$tf) {
		if ($tf['sourse_table_name']!='') {
			$query				= "SELECT f.* FROM `$MYSQL_TABLE18` LEFT JOIN `$MYSQL_TABLE17` as `f` on (f.table_id=$MYSQL_TABLE18.id) WHERE $MYSQL_TABLE18.table_name='{$tf['sourse_table_name']}'";
			$result				= $mysql->executeSQL($query);
			while ($row			= $mysql->fetchAssoc($result)) {

				$surse_tables_fields[$tf['fieldname']][]	= $row;
			}
		}
	}

	//находим связи между таблицами
	$z_polya	= array();
	foreach ($surse_tables_fields as $field => $stfs) {
		foreach ($stfs as $stf) {
			if ($stf['sourse_table_name']!='') {
				foreach ($surse_tables_fields as $field2=>$stfs2) {
					foreach ($stfs2 as $stf2) {
						if ($stf['table_id']!=$stf2['table_id'] && $allBlockTables[$stf['sourse_table_name']]['id']==$stf2['table_id'] && $stf['sourse_field_name']==$stf2['fieldname']) {
							$temp['sourse_table_name']	= $stf['sourse_table_name'];
							$temp['sourse_field_name']	= $stf['sourse_field_name'];
							$z_polya[$stf['fieldname']]	= $temp;
							break;
						}
					}
				}
			}
		}
	}


	$zavisimie_polya	= array();
	foreach ($z_polya as $key => $z) {
		foreach ($table_fields as $key2=>$tf) {
			if ($z['sourse_table_name']==$tf['sourse_table_name'] && $z['sourse_field_name']==$tf['sourse_field_name']) {
				$zavisimie_polya[$tf['fieldname']]	= $key;
				break;
			}
		}
	}


	//подгружаем данные для списков
	foreach ($table_fields as $key=>$tf) {
		if ($tf['sourse_table_name']!='') {

			//проверяем, чтоб зависимое поле не ссылалось на себя
			$zp	= array();
			foreach ($zavisimie_polya as $k=>$z) {
				if ($k!=$tf['fieldname']) {
					$zp[]=$z;
				}
			}

			if (count($zp)>0) {
				$zavisimoe_pole_str	= ','. implode(',', $zp);
			}
			else {
				$zavisimoe_pole_str	= '';
			}

			$list			= array();
			$query			= "SELECT `id`, `{$tf['sourse_field_name']}` $zavisimoe_pole_str FROM `{$tf['sourse_table_name']}`";
			$result			= $mysql->executeSQL($query);
			while ($row		= $mysql->fetchAssoc($result)) {
				$value		= mb_strtolower($row[$tf['sourse_field_name']]);
				$masiv_key	='_';
				foreach ($zp as $pole) {
					$masiv_key.=$pole.'='.$row[$pole].';';
				}
				$list[$masiv_key][$value]		= $row['id'];
			}

			$table_fields[$key]['sourse_list'] 	= $list;
		}
	}


	//формируем правильную вставку данных с учетом списков а также зависимостей списков
	$ids		= array();
	$inserted	= 0;
	$errors 	= array();
	foreach ($xls_data as $xls) {
		$v		= eval(stripslashes($xls['data']));

		foreach ($table_fields as $table_field=>$tf) {

			if ($tf['sourse_table_name']!='')	{

				if ($tf['edittype_id']==4) {		//обрабатываем поле мультиселект

					$v_array					= explode(',', $v[$tf['fieldname']]);
					$value						= array();
					foreach ($v_array as $v_a) {
						$v_a					= rtrim($v_a);
						$v_a					= ltrim($v_a);
						$v2[$tf['fieldname']]	= $v_a;
						$r_value				= getDataFromList($table_fields, $tf, $table_field, $v2, $zavisimie_polya);
						if ($r_value!=null) {
							$value[]			= $r_value;
						}
					}
				}
				else {
					$value = getDataFromList($table_fields, $tf, $table_field, $v, $zavisimie_polya);
				}

				if ($value!=null) {
					$_POST[$table_field]	= $value;
				}
				else {
					if ($tf['edittype_id']==14 || $tf['edittype_id']==15) {	//если Friendly URL или CopyNewContent
						$_POST[$table_field]	= $v[$table_field];
					}
				}
			}
			else {
				$value						= $v[$table_field];
				$value						= changeFormatData($tf, $value);
				$_POST[$table_field]		= $value;
			}
		}

		//вставка данных
		$api		= getApiObject($table_name, $_POST);
		$api->dataInsertUpdate();
		if (count($api->errors)>0) {
			$errors[]		= $api->errors;
		}
		else {
			//удаляем историю импорта записи
			$query			= 	"DELETE FROM `$MYSQL_TABLE21` WHERE `id`='{$xls['id']}'";
			$result			=	$mysql->executeSQL($query);
			$inserted++;
		}
	}

	echo $inserted.'|'.(count($errors));
}



/**
* Меняет формат данных на совместимый с БД
*
* @param array $tf
* @param array $value
* @return string
*/
function changeFormatData($tf, $value) {
	GLOBAL $MSGTEXT;

	$new_value=$value;
	//проверяем по типу редактирования
	switch ($tf['edittype_id']) {
		case 5 : //checkbox
		switch ($value) {
			case $MSGTEXT['report_yes'] :		$new_value=1; 	break;
			case $MSGTEXT['report_no'] : 		$new_value=0; 	break;
			case $MSGTEXT['report_not_set'] :
				if (is_numeric($tf['default']))	{
					$new_value=$tf['default'];
				}
				else {
					$new_value=0;
				}
				break;
		}
	}

	//проверяем по типу данныx
	switch ($tf['datatype_id']) {
		case 12 : //DATETIME
		if ($value!='') {
			$value		= str_replace('/', '-', $value);
			$timestamp	= strtotime($value);
			$new_value	= date('Y-m-d H:i:s', $timestamp).'';
		}

		break;
		case 4 : //DATE
		$value		= str_replace('/', '-', $value);
		$timestamp	= strtotime($value);
		$new_value	= date('Y-m-d', $timestamp);
		break;
	}

	return $new_value;
}



/**
* Подставляет значения для списков
*
* @param array $table_fields
* @param array $field
* @param string $table_field
* @param array $row
* @param array $zavisimie_polya
* @return string|int|null
*/
function getDataFromList($table_fields, $field, $table_field, $row, $zavisimie_polya) {

	$all_list	= $field['sourse_list'];
	$cell_value = mb_strtolower($row[$table_field]);

	//если значение является целым числом, тогда это индекс
	if (!is_numeric($cell_value)) {

		//берем урезанный список учитывая значения связных полей
		$masiv_key					='_';

		//проверяем, чтоб зависимое поле не ссылалось на себя
		$zp	= array();
		foreach ($zavisimie_polya as $k=>$z) {
			if ($k!=$field['fieldname']) {
				$zp[$k]=$z;
			}
		}

		if (count($zp)>0) {
			foreach ($zp as $k=> $pole) {
				foreach ($table_fields as $tf) {

					if ($k==$tf['fieldname']) {
						$field_new=$tf;
						break;
					}
				}
				$pole_id	= getDataFromList($table_fields, $field_new, $field_new['fieldname'], $row, $zavisimie_polya);

				$masiv_key.=$pole.'='.$pole_id.';';
			}
		}

		if (isset($all_list[$masiv_key])) {
			$list	= $all_list[$masiv_key];

			//ищем в списке нужное значение
			$value=null;
			if (isset($list[$cell_value])) $value	= $list[$cell_value];	//подставляем id
			else {
				foreach ($list as $id=>$key) {
					similar_text($cell_value, $key, $percent);
					if ($percent>79) {
						$value=$id;
						break;
					}
				}
			}
		}
		else 	$value=null;
	}
	else {
		$value= $cell_value;
	}

	return $value;
}



/**
* Отобразить форму загрузки xls-файла
*
*/
function showLoadForm() {
	GLOBAL  $smarty, $MYSQL_TABLE21, $mysql;

	//очищаем временную таблицу
	$query					= "TRUNCATE `$MYSQL_TABLE21`";
	$result					= $mysql->executeSQL($query);
	if (!isset($_GET['lang_id'])) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/dictionary/configLanguage.php');  //подключаем языки материала
		$lang_id			= $LANGUAGES_OF_MATERIAL[SETTINGS_LANGUAGE_OF_MATERIALS]['id'];
	}
	else $lang_id			= $_GET['lang_id'];

	$smarty->assign('lang_id', $lang_id);
	$smarty->display('import_xls.tpl');
}



/**
* Создает объект для работы с API-функциями
*
* @param string $table_name
* @param array $dataRow - Данные для вставки/обновления/удаления строки в таблице
* @return calss
*/
function getApiObject($table_name, $dataRow=array(), $notStripTagsForFields = array(), $allowable_tags = array()) {
	GLOBAL $GENERAL_FUNCTIONS, $MODULES_PATH, $MYSQL_TABLE11, $MYSQL_TABLE6, $MYSQL_TABLE5, $mysql, $smarty;

	$query		= "SELECT t.*, b.name AS `block_name`, m.name AS `module_name` FROM `$MYSQL_TABLE11` AS `t` LEFT JOIN `$MYSQL_TABLE6` AS `b` ON (b.id=t.block_id) LEFT JOIN `$MYSQL_TABLE5` AS `m` ON (m.id=b.module_id) WHERE t.id='{$_GET['tag_id']}'";
	$result		= $mysql->executeSQL($query);
	$tagInfo	= $mysql->fetchAssoc($result);

	if ($table_name!='') {
		$lang_id				= $_GET['lang_id'];
		$get					= $_GET;
		$get['t_name']			= $table_name;
		$tagInfo['table_name']	= $table_name;
		$get['page_id']			= $_GET['page_id'];
		$get['tag_id']			= $_GET['tag_id'];
		$tagInfo				= $tagInfo;

		//подключаем объект API-функциий
		include_once ($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/API.php');
		$API 	= new API($mysql, $smarty, $_POST, $_POST, $_POST, $get, $_GET, $_GET, $tagInfo, $get['t_name'], $table_name, $lang_id, true, $dataRow);
	}
	else $API	= false;

	return $API;
}

?>