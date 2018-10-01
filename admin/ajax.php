<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		 //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/check_login.php');  //проверка авторизации
//$mysql->executeSQL('SET sql_mode=\'\'');												//устанавливаем не строгий формат Mysql. Это позволит вставлять записи, если не все поля указаны

header('Content-Type: text/html; charset=UTF-8');

if (isset($_GET['func'])) {

	$func=$_GET['func'];
	
	if ($func=='updateGSettins') {

		if ($GENERAL_FUNCTIONS->updateGSettings($_GET['caption'], $_GET['value'])) $out=true;
		else $out	= $MSGTEXT['config_is_notwriteable'];
		echo $out;
	}
	if ($func=='setSession') {
		$_SESSION[$_GET['name']]=$_GET['value'];
	}	

	elseif ($func=='addEmailGroup') {

		$name		= $GENERAL_FUNCTIONS->htmlspecialcharsToObject(urldecode($_GET['name']));
		$query		= "INSERT INTO `$MYSQL_TABLE25` (`email_group_name`, `subject`, `message`, `signature`) VALUES ('$name', '','','')";
		$result		= $mysql->executeSQL($query);

		echo $mysql->insertID();
	}

	elseif ($func=='updateGroupName') {
		$id		= $_GET['id'];
		$name	= $GENERAL_FUNCTIONS->htmlspecialcharsToObject(urldecode($_GET['name']));

		$query	= "UPDATE`$MYSQL_TABLE25` SET `email_group_name`='$name' WHERE `id`='$id'";
		$result	= $mysql->executeSQL($query);
		echo true;
	}

	elseif ($func=='deleteGroup') {

		$data_id	= $_GET['id'];
		$query		= "DELETE FROM `$MYSQL_TABLE25` WHERE `id` IN ($data_id)";
		$result		= $mysql->executeSQL($query);

		$query		= "DELETE FROM `$MYSQL_TABLE9` WHERE `group_name_id` IN ($data_id)";
		$result		= $mysql->executeSQL($query);

		echo true;
	}

	elseif ($func=='addLink') {
		$link	= $_GET['url'];
		$name	= $_GET['name'];
		$pos	= mb_strpos($link, '?');
		if ($pos) {
			$link	= mb_substr($link, $pos+1);
		}
		else $link	= 'act=administrators&page';

		$st	= mb_strpos($link, '&edit=');

		if ($st>0) {
			$st		= $st+mb_strlen('&edit=');
			$part1	= mb_substr($link,		0, $st);
			$part2	= mb_substr($link,		$st);
			$en		= mb_strpos($part2, 	'&');

			if ($en>0) {
				$part2	= mb_substr($part2, $en);
			}
			else $part2='';

			$link=$part1.$_SESSION['___GoodCMS']['rdo'].$part2;
		}

		$query				= "INSERT INTO `$MYSQL_TABLE15` (`name`, `link`) VALUES ('$name', '$link')";
		$result				= $mysql->executeSQL($query);
		echo true;
	}
	elseif ($func=='updateLink') {
		$id		= $_GET['id'];
		$name	= $_GET['name'];
		if (SETTINGS_MAGIC_QUOTES_GPC=='0') {
			$name= addslashes($name);
		}
		$name	= strip_tags($name);

		$query	= "UPDATE`$MYSQL_TABLE15` SET `name`='$name' WHERE `id`='$id'";
		$result	= $mysql->executeSQL($query);

		echo true;
	}
	elseif ($func=='deleteLink') {

		$data_id	= $_GET['id'];
		$query		= "DELETE FROM `$MYSQL_TABLE15` WHERE `id` IN ($data_id)";
		$result		= $mysql->executeSQL($query);

		echo true;
	}
	elseif ($func=='getLinks') {

		$query				= "SELECT * FROM `$MYSQL_TABLE15`  ORDER BY `name`";
		$result				= $mysql->executeSQL($query);

		$str='';
		while ($row=$mysql->fetchAssoc($result)) {
			$str.=$row['id'].'|'.$row['name'].'|'.$row['link'].'|';
		}

		$mysql->freeResult($result);
		$str	= mb_substr($str, 0, mb_strlen($str)-1);
		echo $str;
	}
	/*//////////работа с группами///////////////////////////////////*/
	elseif ($func=='addPageToGroup') {
		$caption	= strip_tags($_GET['caption']);
		$link		= $_GET['url'];
		$group_id	= $_GET['group_id'];
		$st			= mb_strpos($link, '&edit=');

		if ($st>0) {
			$st		= $st+mb_strlen('&edit=');
			$part1	= mb_substr($link, 0,$st);
			$part2	= mb_substr($link, $st);
			$en		= mb_strpos($part2, '&');

			if ($en>0) {
				$part2	= mb_substr($part2, $en);
			}
			else $part2='';

			$link	= $part1.$_SESSION['___GoodCMS']['rdo'].$part2;
		}

		$query		= "INSERT INTO `$MYSQL_TABLE20` (`group_id`, `url`, `caption`) VALUES ('$group_id',  '$link', '$caption')";
		$result		= $mysql->executeSQL($query);

		echo true;
	}
	elseif ($func=='deleteGroupPage') {
		$data_id	= $_GET['id'];
		$query		= "DELETE FROM `$MYSQL_TABLE20` WHERE `id` IN ($data_id)";
		$result		= $mysql->executeSQL($query);

		echo true;
	}
	elseif ($func=='getPageGroupUrl') {
		$url_id			= $_GET['id'];
		$query			= "SELECT `url` FROM `$MYSQL_TABLE20` WHERE `id`='$url_id'";
		$result			= $mysql->executeSQL($query);
		$row			= $mysql->fetchAssoc($result);
		$mysql->freeResult($result);

		echo $row['url'];
	}

	elseif ($func=='checkMailConfig') {

		if (SETTINGS_EMAIL_TYPE=='smtp') {
			require_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/Mime_Mail.php');
			$m							= new Mime_Mail('','','','');
			$setups['email_connect']	= $m->isConnect();
			unset($m);
		}
		else $setups['email_connect']=0;

		echo $setups['email_connect'];
	}
	elseif ($func=='checkFtpConfig') {

		if (extension_loaded('ftp')) {
			$setups['ftp']			= 1;
			if ($FILE_MANAGER->connect()) {
				$FILE_MANAGER->close();
				$setups['ftp_connect']			= 1;
			}
			else $setups['ftp_connect']			= 0;
		}
		else {

			$setups['ftp_connect']	= 0;
		}

		echo $setups['ftp_connect'];

	}

	elseif ($func=='getGroupPages') {

		$group_id			= $_GET['id'];
		$query				= "SELECT * FROM `$MYSQL_TABLE20` WHERE `group_id`='$group_id'  ORDER BY `caption`";
		$result				= $mysql->executeSQL($query);

		$str='';
		while ($row=$mysql->fetchAssoc($result)) {
			$str.=$row['id'].'|'.$row['caption'].'|'.$row['url'].'|';
		}

		$mysql->freeResult($result);
		if ($str!='') {
			$str	= mb_substr($str, 0, mb_strlen($str)-1);
		}

		echo $str;
	}
	elseif ($func=='refreshListByField') {
		//получаем первичный ключ
		$query						= "SELECT $MYSQL_TABLE17.fieldname FROM `$MYSQL_TABLE17`, `$MYSQL_TABLE18` WHERE $MYSQL_TABLE18.table_name='{$_GET['sourse_table']}'  AND $MYSQL_TABLE17.table_id=$MYSQL_TABLE18.id AND $MYSQL_TABLE17.pk=1 AND $MYSQL_TABLE17.auto_incr=1";
		$result						= $mysql->executeSQL($query);
		list($pk_key_fiedl_name)	= $mysql->fetchRow($result);

		if ($_GET['selected_field_value']>0) $where=" WHERE `{$_GET['selected_field_next']}`='{$_GET['selected_field_value']}' ";
		else $where='';

		$query				= "SELECT `$pk_key_fiedl_name`, `{$_GET['sourse_field']}` FROM `{$_GET['sourse_table']}` $where  ORDER BY `sort_index`";
		$result				= $mysql->executeSQL($query);

		$str		= array();
		while ($row = $mysql->fetchAssoc($result)) {
			$str[$row[$pk_key_fiedl_name]]=$row[$_GET['sourse_field']];
		}
		$str	= $GENERAL_FUNCTIONS->htmlspecialcharsToObject($str);
		$mysql->freeResult($result);
		echo $GENERAL_FUNCTIONS->get_javascript_array($str, 'm');
	}
	/*//////////работа со списками///////////////////////////////////*/
	elseif ($func=='setPopupFilter') {	//отображаем форму фильтр для выборки записей
		setPopupFilter();
	}
	elseif ($func=='lists_insert') {	//вставка новой записи
		lists_insert();
	}
	elseif ($func=='get_total_list') {	//выводит список всех записей в списке
		get_total_list();
	}
	elseif ($func=='list_save') {		//сохранение редактирования списка
		list_save();
	}
	elseif ($func=='list_delete') {		//удаление записи
		list_delete();
	}
	elseif ($func=='move_list') {		//меняем порядок сортирови
		move_list();
	}
	elseif ($func=='sort_list') {		//сортировка по убыванию или возростанию
		sort_list();
	}
	///////////////////////////////////////////////////////////////////////////
	elseif ($func=='getTemplate') {		//сортировка по убыванию или возростанию
		getTemplate();
	}
}


//////////////////////////////////////рабочие функции//////////////////////////////////////////////
/**
 * Устанавливает фильтр
 *
 */
function setPopupFilter() {
	GLOBAL $MSGTEXT, $mysql,$MYSQL_TABLE15, $MYSQL_TABLE19, $MYSQL_TABLE20, $MYSQL_TABLE17;

	//подключаем смарти
	require_once 'smarty/Smarty.class.php';
	$smarty					= new Smarty();
	$smarty->template_dir	= $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/templates/';
	$smarty->compile_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_c/';
	$smarty->assign('MSGTEXT', $MSGTEXT); //подключаем сообщения из файла

	$table_id	= $_GET['table_id'];
	$field_id	= $_GET['field_id'];


	$query				= "SELECT * FROM `$MYSQL_TABLE17` WHERE `table_id`='' ORDER BY `sort_index` DESC ";
	$result				= $mysql->executeSQL($query);
	$groups				= $mysql->fetchAssocALL($result);

	$smarty->assign('datalist', $datalist);

	$out	= $smarty->fetch('filterPopup.tpl');
	echo   $out;
}


/**
* Взвращает содержимое запрашиваемого шаблона
*
*/
function getTemplate() {
	GLOBAL $MSGTEXT, $mysql,$MYSQL_TABLE15, $MYSQL_TABLE19, $MYSQL_TABLE20, $MYSQL_TABLE25;

	if ($_GET['tpl_name']=='addEmailGroup.tpl') {
		//подключаем смарти
		require_once 'smarty/Smarty.class.php';
		$smarty					= new Smarty();
		$smarty->template_dir	= $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/templates/mailer/';
		$smarty->compile_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_c/';
		$smarty->assign('MSGTEXT', $MSGTEXT); //подключаем сообщения из файла

		$out	= $smarty->fetch($_GET['tpl_name']);

	}
	else
	if ($_GET['tpl_name']=='editEmailGroup.tpl') {
		//подключаем смарти
		require_once 'smarty/Smarty.class.php';
		$smarty					= new Smarty();
		$smarty->template_dir	= $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/templates/mailer/';
		$smarty->compile_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_c/';
		$smarty->assign('MSGTEXT', $MSGTEXT); //подключаем сообщения из файла

		$query				= "SELECT * FROM `$MYSQL_TABLE25` ORDER BY `email_group_name`";
		$result				= $mysql->executeSQL($query);
		$groups				= $mysql->fetchAssocALL($result);

		$smarty->assign('groups', $groups);

		$out	= $smarty->fetch($_GET['tpl_name']);
	}

	else
	if ($_GET['tpl_name']=='addLinkForm.tpl') {
		//подключаем смарти
		require_once 'smarty/Smarty.class.php';
		$smarty					= new Smarty();
		$smarty->template_dir	= $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/templates/';
		$smarty->compile_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_c/';
		$smarty->assign('MSGTEXT', $MSGTEXT); //подключаем сообщения из файла

		$out	= $smarty->fetch($_GET['tpl_name']);
	}
	else
	if ($_GET['tpl_name']=='editGroupLinkForm.tpl') {
		//подключаем смарти
		require_once 'smarty/Smarty.class.php';
		$smarty					= new Smarty();
		$smarty->template_dir	= $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/templates/';
		$smarty->compile_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_c/';
		$smarty->assign('MSGTEXT', $MSGTEXT); //подключаем сообщения из файла

		$groups	= array();
		$urls	= array();

		$query				= "SELECT * FROM `$MYSQL_TABLE19` ORDER BY `sort_index` DESC ";
		$result				= $mysql->executeSQL($query);
		$groups				= $mysql->fetchAssocALL($result);

		if (isset($groups[0]['id'])) {
			$query				= "SELECT * FROM `$MYSQL_TABLE20` WHERE `group_id`='{$groups[0]['id']}' ORDER BY `caption` DESC ";
			$result				= $mysql->executeSQL($query);
			$urls				= $mysql->fetchAssocALL($result);
		}

		$smarty->assign('groups', $groups);
		$smarty->assign('urls',   $urls);
		$out	= $smarty->fetch($_GET['tpl_name']);
	}

	else {
		//подключаем смарти
		require_once 'smarty/Smarty.class.php';
		$smarty					= new Smarty();
		$smarty->template_dir	= $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/templates/';
		$smarty->compile_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_c/';
		$smarty->assign('MSGTEXT', $MSGTEXT); //подключаем сообщения из файла

		$query				= "SELECT * FROM `$MYSQL_TABLE15`  ORDER BY `name`";
		$result				= $mysql->executeSQL($query);
		$datalist			= $mysql->fetchAssocAll($result);
		$smarty->assign('datalist', $datalist);

		$out	= $smarty->fetch($_GET['tpl_name']);
	}

	echo $out;
}


/**
 * сортирует список
 *
 */
function sort_list() {
	GLOBAl $mysql;

	//берём значения
	$tablename		= 'cms_list'.$_GET['id'];
	if ($_GET['type']=='low') $desc='';
	else $desc=' DESC ';

	$query			= "SELECT * FROM `$tablename` ORDER BY `name` $desc";
	$result			= $mysql->executeSQL($query);
	$allData		= $mysql->fetchAssocAll($result);

	for ($i=0; $i<count($allData); $i++) {
		$k=$i+1;
		$query		= "UPDATE `$tablename` SET `sort_index`='$k' WHERE `id`='{$allData[$i]['id']}'";
		$result	= $mysql->executeSQL($query);
	}

	echo true;
}


/**
* ставим порядок сортировки для записей в справочнике
*
*/
function move_list() {
	GLOBAL  $mysql;

	$id			= $_GET['data_id'];
	$tablename	= 'cms_list'.$_GET['id'];

	$query		= "SELECT * FROM  `$tablename` WHERE  `id`='$id'";
	$result		= $mysql->executeSQL($query);
	$cat		= $mysql->fetchArray($result);

	$query		= "SELECT * FROM  `$tablename` ORDER BY `sort_index`";
	$result		= $mysql->executeSQL($query);
	$records	= $mysql->fetchArrayAll($result);

	if ($records>1) {
		$min	= $records[0]['sort_index'];
		$max	= $records[count($records)-1]['sort_index'];

		for ($i=0; $i<count($records); $i++) {
			if ($records[$i]['id']==$cat['id']) {

				if ($_GET['type']=='up') {
					if ($i>0) $next	= $i-1;
					else {
						$next	= 0;
					}
				}
				elseif ($_GET['type']=='down') {
					if ($i<count($records)-1) $next = $i+1;
					else {
						$next	= count($records)-1;
					}
				}

				$moved	= $i;

				$query		= "UPDATE `$tablename` SET `sort_index`='{$records[$moved]['sort_index']}' WHERE  `id`='{$records[$next]['id']}'";
				$result		= $mysql->executeSQL($query);

				$query		= "UPDATE `$tablename` SET `sort_index`='{$records[$next]['sort_index']}' WHERE  `id`='{$records[$moved]['id']}'";
				$result		= $mysql->executeSQL($query);
				echo true;

				break;
			}
		}
	}
}



/**
* удаление записи
*
*/		
function list_delete() {
	GLOBAl $mysql;

	$tablename	= 'cms_list'.$_GET['id'];
	$data_id	= $_GET['data_id'];
	$query		= "DELETE FROM `$tablename` WHERE `id` IN ($data_id)";
	$result		= $mysql->executeSQL($query);
	echo true;
}



/**
* сохранение редактирования
*
*/
function list_save() {
	GLOBAl $mysql;

	$fields	= getListFields();
	if (count($fields['error'])==0) {
		$query	= "UPDATE `{$fields['tablename']}` SET `name`='{$fields['name']}' WHERE `id`='{$_GET['data_id']}'";
		$result	= $mysql->executeSQL($query);

		echo true;
	}
}



/**
* вывод всех записей списка
*
*/
function get_total_list() {
	GLOBAl $mysql;

	//берём значения
	$tablename		= 'cms_list'.$_GET['id'];
	$query			= "SELECT * FROM `$tablename` ORDER BY `sort_index`";
	$result			= $mysql->executeSQL($query);
	$str='';
	while ($row=$mysql->fetchAssoc($result)) {
		$str.=$row['id'].'|'.$row['name'].'|';
	}
	$mysql->freeResult($result);
	$str=mb_substr($str, 0, mb_strlen($str)-1);
	echo $str;
}



/**
* вставка новой записи в список
*
*/
function lists_insert() {
	GLOBAl $mysql;

	$fields	= getListFields();
	if (count($fields['error'])==0) {
		$query			= "INSERT INTO `{$fields['tablename']}`	(`name`, `sort_index`) VALUES ('{$fields['name']}', '{$fields['sort_index']}')";
		$result			= $mysql->executeSQL($query);
		$sort_index		= $mysql->insertID();

		$query			= "UPDATE `{$fields['tablename']}`  SET `sort_index`='$sort_index' WHERE `id`='$sort_index'";
		$result			= $mysql->executeSQL($query);
		$message_info	= $sort_index;
	}
	else $message_info	= 0;

	echo $message_info;
}


/**
* возвращает данные с формы редактирования элемента списка
*
* @return array
*/
function getListFields() {
	GLOBAl $mysql;

	$fields['error']=array();
	if (isset($_GET['data_id'])) {
		$fields['data_id']	=  $_GET['data_id'];
	}

	if ($_GET['name']!='') {
		$fields['name']	= $file_html =  $_GET['name'];
	}
	else {
		$fields['name']	=  '';
	}

	$fields['tablename']='cms_list'.$_GET['id'];
	$fields['sort_index']	= 0;

	return $fields;
}

?>