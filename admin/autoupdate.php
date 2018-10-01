<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		    //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/check_login.php');      //проверка авторизации

$mysql->executeSQL('SET sql_mode=\'\'');											//устанавливаем не строгий формат Mysql. Это позволит вставлять записи, если не все поля указаны

/**
 * автообновления системы
 */

//подключаем смарти
require_once 'smarty/Smarty.class.php';
$smarty							= new Smarty();
$smarty->template_dir			= $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/templates/';
$smarty->compile_dir			= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_c/';

$ERRORS							= array();

$smarty->assign('MSGTEXT', $MSGTEXT); 												//подключаем сообщения из файла

if (!$_SESSION['___GoodCMS']['read_only']) {
	//проверяем лицензию и дату до которой можно обновлять
	if ($activated			= $CMSProtection->checkActivation() && $CMSProtection->checkActivationDate()) {

		if (!isset($_GET['func'])) {
			//запускаем форму вставки записей
			if (isset($_GET['loadZipFile'])) {
				loadArhiveManual();
			}
			elseif (isset($_GET['infoForm'])) {
				infoForm();
			}
			elseif (isset($_GET['updateProcess'])) {
				updateProcess();
			}
			else {
				showSettingsForm();
			}
		}
		else {
			$func				= $_GET['func'];
			if (isset($_GET['zipfilename'])) {
				$zipfilename	= $_GET['zipfilename'];
			}

			if ($func=='loadArhive') {
				$res	= loadArhive();
			}
			if ($func=='makeFilesDump') {
				$res	= makeFilesDump($zipfilename);
			}
			elseif ($func=='makeTablesDump') {
				$res	= makeTablesDump();
			}
			elseif ($func=='autoupdateFiles') {
				$res	= autoupdateFiles($zipfilename);
			}
			elseif ($func=='autoupdateBD') {
				$res	= autoupdateBD($zipfilename);
			}
			elseif ($func=='deleteFilesDump') {
				$res	= deleteFilesDump($zipfilename);
			}
			elseif ($func=='deleteTablesDump') {
				$res	= deleteTablesDump();
			}
			elseif ($func=='restoreFilesDump') {
				$res	= restoreFilesDump($zipfilename);
			}
			elseif ($func=='restoreTablesDump') {
				$res	= restoreTablesDump();
			}

			//выводим ошибку, если нужно
			if (count($ERRORS)>0)	{
				$er='';
				foreach ($ERRORS as $e) {
					$er.=$e.'<br>';
				}
				echo $er;
			}
			else echo $res;
		}
	}
	else {
		$autoupdate_caption	= sprintf($MSGTEXT['autoupdate_caption'], CMS_VERSION);
		$MESSAGE[]			= $MSGTEXT['edit_data_need_to_by'];
		
		$smarty->assign('autoupdate_caption', 	$autoupdate_caption);
		$smarty->assign('errors', 				$ERRORS);
		$smarty->assign('msgs', 				$MESSAGE);
		$smarty->display('autoupdate/info_from.tpl');
	}
}
else {
	echo $MSGTEXT['edit_data_forbidden'];
}




/////////////////////////////////////БИБЛИОТЕЧНЫЕ ФУНКЦИИ///////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
* Отобразить форму настроек обновления
*
*/
function showSettingsForm() {
	GLOBAL  $ERRORS, $FILE_MANAGER, $smarty, $MSGTEXT, $MYSQL_TABLE16, $MYSQL_TABLE17, $MYSQL_TABLE18, $mysql;

	include_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/classes/CMSProtection.php');

	$autoupdate_caption	= sprintf($MSGTEXT['autoupdate_caption'], CMS_VERSION);

	$smarty->assign('autoupdate_caption', 						$autoupdate_caption);
	$smarty->assign('errors', 									$ERRORS);
	$smarty->assign('session_id', 								session_id());

	$smarty->display('autoupdate/settings_from.tpl');
}



/**
* Закачиваем вручную архив с обновлением на сервер
*
*/
function loadArhiveManual() {
	GLOBAL  $GENERAL_FUNCTIONS, $ERRORS, $MESSAGE, $FILE_MANAGER, $smarty, $MSGTEXT, $MYSQL_TABLE16, $MYSQL_TABLE17, $MYSQL_TABLE18, $mysql;

	//закачиваем файл
	$files_patch		= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/updates/';
	$rash_array			= array('.zip');	//допустимые расширения
	$fieldname			= 'Filedata';
	$FILES_name			= $_FILES[$fieldname]['name'];
	$FILES_type			= $_FILES[$fieldname]['type'];
	$FILES_tmp_name		= $_FILES[$fieldname]['tmp_name'];

	if	(isset($FILES_name)) {
		if ($FILES_name=='') $flag= false;

		$t			= explode('.', $FILES_name);
		$rash		= '.'.$t[count($t)-1];
		$FILES_name	= mb_substr($FILES_name, 0, mb_strlen($FILES_name)-mb_strlen($rash));
		$FILES_name	= $GENERAL_FUNCTIONS->convertKirilToLatin($FILES_name);


		//если заданы допустимые расширения, то делаем проверку
		if (is_array($rash_array)) {
			$flag		= false;
			foreach($rash_array as $r)
			if ($r==$rash) {
				$flag	= true;
				break;
			}
		}
		else $flag=true;

		if ($flag)  {

			$NewName	= $FILES_name.$rash;

			//если устались папки с предудущего неудачного обновления, тогда удаляем их
			$update_patch		= mb_substr($NewName, 0, mb_strlen($NewName)-4);
			if (file_exists($files_patch.'/'.$NewName)) {
				$FILE_MANAGER->unlink($files_patch.'/'.$NewName);
			}

			if (file_exists($files_patch.'/'.$update_patch)) {
				$FILE_MANAGER->removeFolder($files_patch.'/'.$update_patch);
			}

			if (file_exists($files_patch.'/__'.$update_patch)) {
				$FILE_MANAGER->removeFolder($files_patch.'/__'.$update_patch);
			}


			if (is_uploaded_file($FILES_tmp_name)) {
				if (move_uploaded_file($FILES_tmp_name, $files_patch.'/'.$NewName)) {
					$res		= $NewName;
					$_SESSION['__GOODCMS']['zipfilename']	= $NewName;

					return true;
				}
				else $ERRORS[]	= $MSGTEXT['autoupdate_error_move'];
			}
			else $ERRORS[]		= $MSGTEXT['autoupdate_error_upload'];
		}
		else {
			$ERRORS[]			= $MSGTEXT['autoupdate_bad_extension'];
		}
	}

	$smarty->assign('update_type', 	$_POST['update_type']);
	showSettingsForm();
}




/**
* Информация перед обновлением, также проверка подходит ли нам архив
*
*/
function infoForm() {
	GLOBAL  $MSGTEXT, $MESSAGE, $ERRORS, $FILE_MANAGER, $smarty, $MSGTEXT, $MYSQL_TABLE16, $MYSQL_TABLE17, $MYSQL_TABLE18, $mysql;

	$can_update				= false;
	$autoupdate_caption		= '';
	$info_text				= '';
	$zipfilename			= '';

	if (!isset($_GET['noactual'])) {
		if (isset($_SESSION['__GOODCMS']['zipfilename'])) {

			$zipfilename		= $_SESSION['__GOODCMS']['zipfilename'];
			$update_patch		= mb_substr($zipfilename, 0, mb_strlen($zipfilename)-4);
			$update_dir			= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/updates/'.$update_patch;
			$zipfilename_full	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/updates/'.$zipfilename;
			$info_text			='';


			//разархивирование архива с обновлением
			require_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/PclZip.php');
			$zip = new PclZip($zipfilename_full);

			$FILE_MANAGER->mkdir($update_dir);	//создаём папку в которую распакуем архив

			if ($zip->extract($update_dir)) {

				//проверяем версии системы и обновления
				if (file_exists($update_dir.'/'.SETTINGS_ADMIN_PATH.'/config_more.php')) {

					//определяем версию обновления
					$config_more	= $FILE_MANAGER->getfile($update_dir.'/'.SETTINGS_ADMIN_PATH.'/config_more.php');
					preg_match("/define *\('CMS_VERSION', *'(.*?)'\)/iu", $config_more, $t);

					if (isset($t[1]) && is_numeric($t[1])) {
						$new_version	= $t[1];
					}
					else {
						$new_version	= false;
					}

					if (floatval($new_version)>floatval(CMS_VERSION)) {

						//берём описание обновления
						$info_text			= $FILE_MANAGER->getfile($update_dir.'/ReadMe.htm');
						$can_update			= true;
						$autoupdate_caption	= sprintf($MSGTEXT['autoupdate_info_caption'], $new_version);
					}
					else {
						$MESSAGE[]			= $MSGTEXT['autoupdate_info_small_version'];
					}
				}
				else {
					$ERRORS[]				= $MSGTEXT['autoupdate_info_bad_zip_file'];
				}
			}
			else {
				$ERRORS[]					= $MSGTEXT['autoupdate_info_read_zip_error'];
			}
		}

		else {
			$ERRORS[]						= $MSGTEXT['autoupdate_info_read_zip_error'];
		}
	}
	else {
		$MESSAGE[]							= $MSGTEXT['autoupdate_info_small_version'];
	}

	$smarty->assign('info_text', 			$info_text);
	$smarty->assign('zipfilename', 			$zipfilename);
	$smarty->assign('can_update', 			$can_update);
	$smarty->assign('autoupdate_caption', 	$autoupdate_caption);
	$smarty->assign('errors', 				$ERRORS);
	$smarty->assign('msgs', 				$MESSAGE);
	$smarty->display('autoupdate/info_from.tpl');
}



/**
* Запуск обновления
*
*/
function updateProcess() {
	GLOBAL  $MSGTEXT, $MESSAGE, $ERRORS, $FILE_MANAGER, $smarty, $MSGTEXT, $MYSQL_TABLE16, $MYSQL_TABLE17, $MYSQL_TABLE18, $mysql;

	if (isset($_SESSION['__GOODCMS']['zipfilename'])) {

		include_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/classes/CMSProtection.php');
		$autoupdate_caption	= sprintf($MSGTEXT['autoupdate_caption'], CMS_VERSION);

		$smarty->assign('zipfilename', 			$_SESSION['__GOODCMS']['zipfilename']);
		$smarty->assign('autoupdate_caption', 	$autoupdate_caption);
		$smarty->assign('errors', 				$ERRORS);
		$smarty->assign('msgs', 				$MESSAGE);
		$smarty->display('autoupdate/update_process.tpl');
	}
}






////////////////ДОПОЛНИТЕЛЬНЫЕ ФУНКЦИИ ОБРАБОТЧИКИ///////////////////////////////////
/**
 * Загружает архив с обновлением c сервера
 *
 * @return bool
 */
function loadArhive() {
	GLOBAL $FILE_MANAGER, $GENERAL_FUNCTIONS, $MSGTEXT;

	include_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/classes/CMSProtection.php');
	$zipfilename		= file_get_contents(SETTINGS_UPDATE_URL.'?act=get_arhive_filename&version='.CMS_VERSION);		//получаем имя архива

	if (mb_strlen($zipfilename)>5) {
		$zipfilename		= utf8_decode($zipfilename);
		$zipfilename		= str_replace('?', '', $zipfilename);

		$zip_file			= file_get_contents($zipfilename);		//получаем имя архива

		$t					= explode('/', $zipfilename);
		$zipfilename		= $t[count($t)-1];

		if ($zip_file) {

			//проверяем расширение скаченного файла
			$t			= explode('.', $zipfilename);
			$FILES_name	= $GENERAL_FUNCTIONS->convertKirilToLatin($t[0]);
			$rash		= '.'.$t[count($t)-1];

			$files_patch= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/updates/';

			if ($rash=='.zip') {


				if ($fd			= $FILE_MANAGER->fopen($files_patch.$zipfilename, 'w')) {
					fwrite($fd, $zip_file);
					fclose($fd);

					//если остались папки с предудущего неудачного обновления, тогда удаляем их
					$update_patch		= mb_substr($zipfilename, 0, mb_strlen($zipfilename)-4);

					if (file_exists($files_patch.'/'.$update_patch)) {
						$FILE_MANAGER->removeFolder($files_patch.'/'.$update_patch);
					}

					if (file_exists($files_patch.'/__'.$update_patch)) {
						$FILE_MANAGER->removeFolder($files_patch.'/__'.$update_patch);
					}

					$_SESSION['__GOODCMS']['zipfilename']	= $zipfilename;

					$res		= true;
				}
				else {
					$res		= false;
					$ERRORS[]	= sprintf($MSGTEXT['autoupdate_cannot_write'], $files_patch.$zipfilename);
				}
			}
			else {
				$res		= false;
				$ERRORS[]	= $MSGTEXT['autoupdate_bad_extension'];
			}
		}
		else {
			$res	= false;
		}
	}
	else {
		//нет актуальных обновлений
		$res		= 2;
	}

	return $res;
}



/**
* Создает резервную копию системных таблиц ядра системы
*
* @return bool
*/
function makeTablesDump() {
	GLOBAL $mysql, $MSGTEXT, $FILE_MANAGER, $MODULES_PATH, $MYSQL_TABLE18, $MYSQL_TABLE17, $MYSQL_TABLE12, $MYSQL_TABLE7, $MYSQL_TABLE6, $MYSQL_TABLE5;

	$res 					= true;
	$backup_tables			= array();

	$query					= "SHOW TABLES LIKE 'cms\_%'";
	$result					= $mysql->executeSQL($query);
	while (list($t_name)	= $mysql->fetchRow($result)) {
		$backup_tables[]	= $t_name;
	}


	foreach ($backup_tables as $table_name) {
		$query			= "CREATE TABLE `__{$table_name}` LIKE `$table_name`";
		if ($result		= $mysql->executeSQL($query)) {

			$query		= "INSERT  `__{$table_name}` SELECT * FROM `$table_name`";
			$result		= $mysql->executeSQL($query);
		}
		else {
			$ERRORS[]	= sprintf($MSGTEXT['autoupdate_copy_table_error'], $table_name, "__{$table_name}");
			$res 		= false;
			break;
		}
	}

	return $res;
}



/**
* Очищает таблицы резервной копии ядра системы
*
* @return bool
*/		
function deleteTablesDump() {
	GLOBAL  $mysql, $MYSQL_TABLE18, $MYSQL_TABLE17, $MYSQL_TABLE12, $MYSQL_TABLE7, $MYSQL_TABLE6, $MYSQL_TABLE5;

	//таблицы, которые нужно удалить
	$backup_tables	= array();
	$query			= "SHOW TABLES LIKE '\_\_%'";
	$result			= $mysql->executeSQL($query);

	while (list($t_name)= $mysql->fetchRow($result)) {
		$backup_tables[]= $t_name;
	}

	if (count($backup_tables)>0) {
		$t_names		= implode(',', $backup_tables);
		$query			= "DROP TABLE $t_names";

		if ($result		= $mysql->executeSQL($query))	    $res	= true;
		else $res		= false;
	}
	else $res			= true;

	return $res;
}



/**
* Восстанавливает резервную копию таблиц ядра системы
*
* @return bool
*/	
function restoreTablesDump() {
	GLOBAL  $mysql, $ERRORS, $MSGTEXT, $MYSQL_TABLE18, $MYSQL_TABLE17, $MYSQL_TABLE12, $MYSQL_TABLE7, $MYSQL_TABLE6, $MYSQL_TABLE5;

	$res				= true;

	//удаляем новые таблицы
	$del_tables			= array();
	$query				= "SHOW TABLES LIKE 'cms\_%'";
	$result				= $mysql->executeSQL($query);
	while (list($t_name)= $mysql->fetchRow($result)) {
		$del_tables[]	= $t_name;
	}

	if (count($del_tables)>0) {
		$t_names			= implode(',', $del_tables);
		$query				= "DROP TABLE $t_names";
		if (!$result		= $mysql->executeSQL($query)) {
			$ERRORS[]		= sprintf($MSGTEXT['autoupdate_delete_table_error'], $t_names);
			$res			= false;
		}
	}

	//восстанавливаем резервные таблицы
	$query					= "SHOW TABLES LIKE '\_\_%'";
	$result					= $mysql->executeSQL($query);
	$sql_part				= '';
	while (list($t_name)	= $mysql->fetchRow($result)) {
		$t_name_old 		= mb_substr($t_name, 2);
		$sql_part.= "`$t_name` TO `$t_name_old`,";
	}

	$sql_part 			= mb_substr($sql_part, 0, -1);
	$query				= "RENAME TABLE $sql_part";
	if (!$result		= $mysql->executeSQL($query)) {
		$ERRORS[]		= sprintf($MSGTEXT['autoupdate_rename_table_error'], $sql_part);
		$res			= false;
	}

	return $res;
}



/**
* Создает резервную копию файлов редактируемого модуля 
*
* @param string $zipfilename
* @return bool
*/
function makeFilesDump($zipfilename) {
	GLOBAL $ERRORS, $FILE_MANAGER, $MODULES_PATH, $MSGTEXT;

	$update_patch		= mb_substr($zipfilename, 0, mb_strlen($zipfilename)-4);
	$update_dir			= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/updates/'.$update_patch;
	$dump_update_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/updates/__'.$update_patch;

	if ((file_exists($dump_update_dir)) || $FILE_MANAGER->mkdir($dump_update_dir)) {	//создаём папку, где будет храниться резервная копия файлов

		$allfiles			= searchdir($update_dir);									//получаем список всех файлов, которые будут перезаписаны

		//создаём резервную копию файлов
		foreach ($allfiles as $file) {
			$dest_file		= str_replace(SETTINGS_ADMIN_PATH."/updates/{$update_patch}/", '', $file['dirfull']).$file['name'];
			$dump_file		= str_replace("updates/{$update_patch}/", "updates/__{$update_patch}/", $file['dirfull']).$file['name'];

			if (file_exists($dest_file)) {
				//создание папок
				createWayFolders($dump_file);

				if ($FILE_MANAGER->copy($dest_file, $dump_file)) {
					$res		= true;
				}
				else {
					$ERRORS[]	= sprintf($MSGTEXT['autoupdate_cannot_copy_file'], $dest_file, $dump_file);
					$res		= false;
				}
			}
		}
	}
	else {
		$ERRORS[]	= sprintf($MSGTEXT['autoupdate_cannot_create_patch'], $dump_update_dir);
		$res		= false;
	}

	return $res;
}



/**
* возвращает список всех файлов в заданной директории
*
* @param  string $dir
* @return array
*/
function searchdir ($path , $maxdepth=-1 , $mode='FILES' , $d=0 ) {

	if (mb_substr ($path , mb_strlen ( $path ) - 1 ) != '/' )     	$path .= '/';

	$dirlist = array ();
	if ($mode != 'FILES')  $dirlist[] = $path;

	if ($handle = opendir ($path)) {
		while (false !== ($file = readdir($handle))) {

			if ($file != '.' && $file != '..' && $file != 'SQLS.sql' && $file != 'ReadMe.htm') {
				$fullName 		= $path.$file;
				$tmp['dirfull']	= $path;
				$tmp['dir']		= mb_substr($path, mb_strlen($_SERVER['DOCUMENT_ROOT'])+1);
				$tmp['name']	= $file;

				if ( ! is_dir ($fullName) ) {
					if ( $mode != 'DIRS' )  $dirlist[] = $tmp;
				}
				elseif ( $d >=0 && ($d < $maxdepth || $maxdepth < 0) ) {
					$result = searchdir ($fullName . '/' , $maxdepth , $mode , $d + 1 ) ;
					$dirlist = array_merge ( $dirlist , $result ) ;
				}
			}
		}
		closedir ($handle);
	}

	return ($dirlist);
}



/**
* Очищает файлы резервной копии модуля
*
* @param string $zipfilename
* @return bool
*/	
function deleteFilesDump($zipfilename) {
	GLOBAL $FILE_MANAGER;

	$update_patch		= mb_substr($zipfilename, 0, mb_strlen($zipfilename)-4);
	$update_dir			= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/updates/'.$update_patch;	//удаляем распокованную папку
	$update_dir_dump	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/updates/__'.$update_patch;	//удаляем резервную копию
	$update_zip_file	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/updates/'.$zipfilename;		//удаляем zip-архив

	//удаляем резервную копию файлов
	if ($FILE_MANAGER->removeFolder($update_dir)) {
		if ($FILE_MANAGER->removeFolder($update_dir_dump)) {
			if ($FILE_MANAGER->unlink($update_zip_file)) {
				unset($_SESSION['__GOODCMS']['zipfilename']);
				return true;
			}
			else return false;
		}
		else return false;
	}
	else return false;

}



/**
* Восстанавливает резервную копию файлов ядра системы
*
* @param string $zipfilename
* @return bool
*/		
function restoreFilesDump($zipfilename) {
	GLOBAL $ERRORS, $FILE_MANAGER, $MODULES_PATH, $MSGTEXT;

	$update_patch		= mb_substr($zipfilename, 0, mb_strlen($zipfilename)-4);
	$dump_update_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/updates/__'.$update_patch;
	$allfiles			= searchdir($dump_update_dir);		//получаем список всех файлов, которые нужно восстановить

	//создаём резервную копию файлов
	foreach ($allfiles as $file) {
		$dump_file		= $file['dirfull'].$file['name'];												//новый файл
		$dest_file		= str_replace( SETTINGS_ADMIN_PATH."/updates/__{$update_patch}/", '', $file['dirfull']).$file['name'];

		if ($FILE_MANAGER->copy($dump_file, $dest_file)) {
			$res		= true;
		}
		else {
			$ERRORS[]	= sprintf($MSGTEXT['autoupdate_cannot_copy_file'], $dest_file, $dump_file);
			$res		= false;
		}
	}

	return $res;
}



/**
* Обновляем файлы ядра системы
*
* @param string $zipfilename
* @return bool
*/		
function autoupdateFiles($zipfilename) {
	GLOBAL $ERRORS, $FILE_MANAGER, $MODULES_PATH, $MSGTEXT;

	$update_patch		= mb_substr($zipfilename, 0, mb_strlen($zipfilename)-4);
	$update_dir			= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/updates/'.$update_patch;

	$allfiles			= searchdir($update_dir);		//получаем список всех файлов, которые нужно обновить

	//обновляем файлы
	foreach ($allfiles as $file) {
		$old_file		= str_replace(SETTINGS_ADMIN_PATH."/updates/{$update_patch}/", '', $file['dirfull']).$file['name'];	//старый файл
		$dest_file		= $file['dirfull'].$file['name'];														//новый файл

		//создание папок
		createWayFolders($old_file);

		if ($FILE_MANAGER->copy($dest_file, $old_file)) {
			$res		= true;
		}
		else {
			$ERRORS[]	= sprintf($MSGTEXT['autoupdate_r_copy_file_error'], $dest_file, $old_file);
			$res		= false;
		}
	}

	return $res;
}



/**
* Обновляем базу ядра системы
*
* @param string $zipfilename
* @return bool
*/		
function autoupdateBD($zipfilename) {
	GLOBAL $mysql, $ERRORS, $FILE_MANAGER, $MODULES_PATH, $MSGTEXT;

	$update_patch		= mb_substr($zipfilename, 0, mb_strlen($zipfilename)-4);
	$sql_file			=  $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/updates/'.$update_patch.'/SQLS.sql';

	if (file_exists($sql_file)) {
		if ($sqls_content	= $FILE_MANAGER->getfile($sql_file)) {
			$sqls			= explode(SETTINGS_NEW_LINE, $sqls_content);
			$res			= true;
			foreach ($sqls as $sql) {
				if ($sql!='') {
					//меняем название базы в запросе
					$sql				= str_ireplace('`goodcms`.`', '`'.MYSQL_DATABASE.'`.`', $sql);

					if (!$result		= $mysql->executeSQL($sql)) {
						$res			= false;
						$ERRORS[] 		= sprintf($MSGTEXT['autoupdate_sql_execute_error'], $mysql->getError(), $sql);
						break;
					}
				}
			}
		}
		else {
			$ERRORS[] 		= $MSGTEXT['autoupdate_read_sql_file_error'];
			$res			= false;
		}
	}
	else $res	= true;

	return $res;
}



/**
* Функция создания вложенных папок
*
* @param string $dir
*/
function  createWayFolders($dir) {
	GLOBAL $FILE_MANAGER;

	$root_admin	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/';
	$dir		= str_replace($root_admin, '', $dir);
	$t			= explode('/',$dir);
	$make_dir	= array();
	for ($i=0; $i<count($t)-1; $i++) {
		$make_dir[]	= $t[$i];

		$s_dir		= implode('/', $make_dir);

		$FILE_MANAGER->mkdir($root_admin.$s_dir);
	}
	return true;
}

?>