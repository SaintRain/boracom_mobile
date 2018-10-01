<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tools/admin_patch.php';         		 //путь к админзоне
include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/constructor/check_login.php'); //проверка авторизации

/**
* Сохраняет изменения в загруженном модуле
*/

if (isset($_GET['func']) && $_GET['func']=='restoreFilesDump') {
	set_time_limit(0);	//ставим неограниченное время выполнения
}
else {
	set_time_limit(30);	//ставим максимальное время выполнения 30 секунд
}

header('Content-Type: text/html; charset=UTF-8');

require_once('lib.php');

$UNDEFINED_ERROR		= false;	//неизветсная ошибка

if (isset($_GET['func'])) {
	ob_start();

	$editError			= array();

	require_once 'config.php';          					//настройки подключение к БД
	require_once 'DbConnectionCTR.php';						//класс для работы с БД
	$mysql	=	 new DbConnectionCTR();

	$smarty			= getSmarty();
	$smartyTemp		= $smarty;
	require_once '../includes/GeneralFunctions.php';		//библиотека общедоступных функций
	$GENERAL_FUNCTIONS	= new GeneralFunctions($mysql, $smarty);

	require_once '../classes/CMSProtection.php';      		//библиотека защитных функций админки

	//проверка лицензии на конструктор
	$CMSProtection					= new CMSProtection($mysql, $smarty);
	if (!$activated					= $CMSProtection->checkActivationConstructor()) {
		$editError[]				= $MSGTEXT['edit_data_need_to_by_ctr'];
	}


	clearstatcache();	//очищает файловый кеш

	//Записываем начало старта сохранения
	if (!$GENERAL_FUNCTIONS->updateGSettings('SETTINGS_CTR_SAVE_TO_ADMIN_LAST_TIME', gmdate('Y-m-d H:i:s'), true)) {
		$editError[]= 'mod_constructor_error_write_to_config';
	}

	//Берем из админку всю информацию об редактируемом модуле
	$mysqladmin 	= getMysqlObjectForAdmin();

	//берем всю информацию о новом модуле из конструктора
	$query			= "SELECT * FROM `$MYSQL_CTR_TABLE17` WHERE `id`='{$_SESSION['___GoodCMS']['m_id']}'";
	$result			= $mysql->executeSQL($query);
	$newModule		= $mysql->fetchAssoc($result);

	$query			= "SELECT * FROM `$MYSQL_TABLE5` WHERE `name`='{$newModule['loaded_name']}'";
	$result			= $mysqladmin->executeSQL($query);
	$oldModule		= $mysqladmin->fetchAssoc($result);

	$func			= $_GET['func'];

	//Записываем этап сохранения в модуль
	if (!$GENERAL_FUNCTIONS->updateGSettings('SETTINGS_CTR_SAVE_TO_ADMIN_STAGE', $func, true)) {
		$editError[]= $MSGTEXT['mod_constructor_error_write_to_config'];
	}
	$answer			= false;
	if (count($editError)==0)	{

		if ($func=='makeFilesDump') {
			$answer	= makeFilesDump($mysqladmin, $oldModule, $newModule);
		}
		elseif ($func=='makeTablesDump') {
			$answer	= makeTablesDump($mysqladmin, $oldModule, $newModule);
		}
		elseif ($func=='saveChanges') {

			//получаем файл настроек модуля, чтоб потом сохранить массив данных для вставки в таблицы
			$fn	= $_SERVER['DOCUMENT_ROOT']."/modules/{$oldModule['name']}/management/import_settings/import_settings.php";

			//подключаем массив $DATA с данными модуля
			include($fn);

			$answer = saveChanges($mysqladmin, $oldModule, $newModule);
		}
		elseif ($func=='restoreFilesDump') {

			$answer	= restoreFilesDump($mysqladmin, $oldModule, $newModule);

			//удаляем резервную копию модуля, если восстановление прошло успешно
			if ($answer) {
				deleteFilesDump($mysqladmin, $oldModule, $newModule);
			}
		}
		elseif ($func=='restoreTablesDump') {
			//выполняем запросы восстановления
			restoreHistoryQuery();
			cleaneHistoryQuery();
			$answer = restoreTablesDump($mysqladmin, $oldModule, $newModule);

			$GENERAL_FUNCTIONS->updateGSettings('SETTINGS_CTR_SAVE_TO_ADMIN_LAST_TIME', 	'', 	true);
			$GENERAL_FUNCTIONS->updateGSettings('SETTINGS_CTR_SAVE_TO_ADMIN_STAGE', 		'', 	true);
		}
		elseif ($func=='deleteFilesDump') {
			$answer = deleteFilesDump($mysqladmin, $oldModule, $newModule);
		}
		elseif ($func=='deleteTablesDump') {
			$answer = deleteTablesDump($mysqladmin, $oldModule, $newModule);

			//удаляем временные запросы восстановления
			cleaneHistoryQuery();

			//обнуляем переменные сохранения
			$GENERAL_FUNCTIONS->updateGSettings('SETTINGS_CTR_SAVE_TO_ADMIN_LAST_TIME', 	'', 	true);
			$GENERAL_FUNCTIONS->updateGSettings('SETTINGS_CTR_SAVE_TO_ADMIN_STAGE', 		'', 	true);
		}
	}

	//выводим ошибку, если нужно
	if (count($editError)>0)	{
		$errors	= '';
		foreach ($editError as $e) {
			$errors.=$e.'<br>';
		}
		echo $errors;
	}

	if ($answer) {
		echo 1;
	}
	else {
		echo 0;
	}

	ob_flush();
}



////////////////ФУНКЦИИ ОБРАБОТЧИКИ///////////////////////////////////

/**
 * Создает резервную копию файлов редактируемого модуля 
 *
 * @param class $mysqladmin
 * @param array $oldModule
 * @param array $newModule
 * @return bool
 */
function makeFilesDump($mysqladmin, $oldModule, $newModule) {
	GLOBAL $editError, $FILE_MANAGER, $MODULES_PATH, $MSGTEXT;

	$not_copied_elements	= array('storage');

	if ($FILE_MANAGER->copyFolder($MODULES_PATH.$oldModule['name'], $MODULES_PATH.'__'.$oldModule['name'], $not_copied_elements)) {
		$res	= true;
	}
	else {
		$editError[]	= sprintf($MSGTEXT['mod_constructor_copy_pacth_error'], $MODULES_PATH.$oldModule['name'], $MODULES_PATH.'__'.$oldModule['name']);
		$res			= false;
	}


	return $res;
}



/**
 * Создает резервную копию системных таблиц редактируемого модуля 
 *
 * @param class $mysqladmin
 * @param array $oldModule
 * @param array $newModule
 * @return bool
 */
function makeTablesDump($mysqladmin, $oldModule, $newModule) {
	GLOBAL $MSGTEXT, $FILE_MANAGER, $MODULES_PATH, $MYSQL_TABLE18, $MYSQL_TABLE17, $MYSQL_TABLE12, $MYSQL_TABLE7, $MYSQL_TABLE6, $MYSQL_TABLE5;

	$res 					= true;
	$backup_tables			= array($MYSQL_TABLE18, $MYSQL_TABLE17, $MYSQL_TABLE12, $MYSQL_TABLE7, $MYSQL_TABLE6, $MYSQL_TABLE5);

	$query					= "SHOW TABLES LIKE '{$oldModule['name']}\_%'";
	$result					= $mysqladmin->executeSQL($query);
	while (list($t_name)	= $mysqladmin->fetchRow($result)) {
		$backup_tables[]	= $t_name;
	}

	foreach ($backup_tables as $table_name) {
		$query			= "CREATE TABLE `__{$table_name}` LIKE `$table_name`";
		if ($result		= $mysqladmin->executeSQL($query)) {
			$query		= "INSERT  `__{$table_name}` SELECT * FROM `$table_name`";
			$result		= $mysqladmin->executeSQL($query);
		}
		else {
			$editError[]	= sprintf($MSGTEXT['mod_constructor_copy_table_error'], $table_name, "__{$table_name}");
			$res 			= false;
			break;
		}
	}

	return $res;
}



/**
 * Очищает файлы резервной копии модуля
 *
 * @param class $mysqladmin
 * @param array $oldModule
 * @return bool
 */	
function deleteFilesDump($mysqladmin, $oldModule, $newModule) {
	GLOBAL $FILE_MANAGER, $MODULES_PATH;

	$res	= true;
	$dir	= $_SERVER['DOCUMENT_ROOT'].'/modules';
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				
				
				if ($file==='__'.$newModule['name']) {
					//удаляем резервную копию модуля
					if ($FILE_MANAGER->removeFolder($MODULES_PATH.$file)) {
						$res	= true;
					}
					else {
						$res	= false;
					}
				}
			}
			closedir($dh);
		}
	}

	return $res;
}



/**
 * Очищает таблицы резервной копии модуля
 *
 * @param class $mysqladmin
 * @param array $oldModule
 * @return bool
 */		
function deleteTablesDump($mysqladmin, $oldModule) {
	GLOBAL  $MYSQL_TABLE18, $MYSQL_TABLE17, $MYSQL_TABLE12, $MYSQL_TABLE7, $MYSQL_TABLE6, $MYSQL_TABLE5;

	//таблицы, которые нужно удалить
	$backup_tables	= array();
	$query			= "SHOW TABLES LIKE '\_\_%'";
	$result			= $mysqladmin->executeSQL($query);

	while (list($t_name)= $mysqladmin->fetchRow($result)) {
		$backup_tables[]= $t_name;
	}

	if (count($backup_tables)>0) {
		$t_names		= implode(',', $backup_tables);
		$query			= "DROP TABLE $t_names";

		if ($result		= $mysqladmin->executeSQL($query))	    $res	= true;
		else $res		= false;
	}
	else $res			= true;

	return $res;
}



/**
 * Восстанавливает резервную копию файлов модуля
 *
 * @param object $mysqladmin
 * @param array $oldModule
 * @param array $newModule
 * @return bool
 */
function restoreFilesDump($mysqladmin, $oldModule, $newModule) {
	GLOBAL $editError, $MSGTEXT, $FILE_MANAGER, $MODULES_PATH;

	//переносим папку storage из исходной папки
	$storage_patch		= $MODULES_PATH.$oldModule['name'].'/management/storage';
	$management_patch	= $MODULES_PATH.$oldModule['name'].'/management';
	$res 				= true;

	//удаляем из редактируемого файла все папки кроме $storage_patch
	$st		= $FILE_MANAGER->getArrayFolderFiles($MODULES_PATH.$oldModule['name']);
	foreach ($st as $f) {
		if (isset($f['file']) &&  mb_strpos($f['file'], '/management/storage/')===false) {
			$FILE_MANAGER->unlink($f['file']);
		}
		else if (isset($f['dir']) &&  mb_strpos($f['dir'], '/management/storage/')===false && $storage_patch!=$f['dir'] && $management_patch!=$f['dir']) {
			$FILE_MANAGER->removeFolder($f['dir']);
		}
	}

	//копируем из дампа всё файлы
	$dumpedDir	= $MODULES_PATH.'__'.$oldModule['name'];
	$st			= $FILE_MANAGER->getArrayFolderFiles($dumpedDir, false);
	foreach ($st as $f) {
		if (isset($f['file'])) {
			$newFile	= str_replace('__'.$oldModule['name'], $oldModule['name'], $f['file']);

			if (!$FILE_MANAGER->copy($f['file'], $newFile)) {
				$res 	= false;
			}
		}
		else if (isset($f['dir'])) {

			$newDir	= str_replace('__'.$oldModule['name'], $oldModule['name'], $f['dir']);

			if (!$FILE_MANAGER->copyFolder($f['dir'], $newDir)) {
				if ($management_patch!=$newDir) {
					$res 	= false;
				}
			}
		}
	}

	if (!$res) {
		//переименовываем резервную копию, чтоб можно было восстановить вручную
		$today	= gmdate('Y-m-d_H-i-s');

		$FILE_MANAGER->rename($MODULES_PATH.'__'.$oldModule['name'], $MODULES_PATH.'__'.$oldModule['name'].'-'.$today);
		//копируем файловое хранилище в резервную копию модуля
		$FILE_MANAGER->copyFolder($storage_patch, $MODULES_PATH.'__'.$oldModule['name'].'-'.$today.'/management/storage');
	}

	return $res;
}



/**
 * Восстанавливает резервную копию таблиц модуля
 *
 * @param class $mysqladmin
 * @param array $oldModule
 * @param array $newModule
 * @return bool
 */	
function restoreTablesDump($mysqladmin, $oldModule, $newModule) {
	GLOBAL  $editError, $MSGTEXT, $MYSQL_TABLE18, $MYSQL_TABLE17, $MYSQL_TABLE12, $MYSQL_TABLE7, $MYSQL_TABLE6, $MYSQL_TABLE5;

	$res		= true;

	//удаляем новые таблицы
	$del_tables	= array($MYSQL_TABLE18, $MYSQL_TABLE17, $MYSQL_TABLE12, $MYSQL_TABLE7, $MYSQL_TABLE6, $MYSQL_TABLE5);
	$query		= "SHOW TABLES LIKE '{$newModule['name']}\_%'";
	$result		= $mysqladmin->executeSQL($query);
	while (list($t_name)= $mysqladmin->fetchRow($result)) {
		$del_tables[]	= $t_name;
	}

	if (count($del_tables)>0) {
		$t_names		= implode(',', $del_tables);
		$query			= "DROP TABLE $t_names";
		if (!$result	= $mysqladmin->executeSQL($query)) {
			$editError[]	= sprintf($MSGTEXT['mod_constructor_delete_table_error'], $t_names);
			$res			= false;
		}
	}

	//восстанавливаем резервные таблицы
	$query			= "SHOW TABLES LIKE '\_\_%'";
	$result			= $mysqladmin->executeSQL($query);
	$sql_part		= '';
	while (list($t_name)= $mysqladmin->fetchRow($result)) {
		$t_name_old = mb_substr($t_name, 2);
		$sql_part.= "`$t_name` TO `$t_name_old`,";
	}

	$sql_part 			= mb_substr($sql_part, 0, -1);
	$query				= "RENAME TABLE $sql_part";
	if (!$result		= $mysqladmin->executeSQL($query)) {
		$editError[]	= sprintf($MSGTEXT['mod_constructor_rename_table_error'], $sql_part);
		$res			= false;
	}

	return $res;
}



/**
 * Подключаем смарти
 *
 * @return class
 */
function getSmarty() {
	GLOBAL $MSGTEXT;

	//настройки подключение к БД
	require_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/config.php';

	//подключаем смарти
	require_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/Smarty.class.php';

	$smarty					= new Smarty();
	$smarty->template_dir	= $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/constructor/templates/';
	$smarty->compile_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_constructor/';
	$smarty->cache					= true;
	$smarty->cache_modified_check	= true;
	$smarty->compile_check			= true;

	$smarty->assign('MSGTEXT', $MSGTEXT); 					//подключаем сообщения из файла
	return $smarty;
}



/**
 * возвращает обект для работы с базой админки
 *
 * @return object
 */
function getMysqlObjectForAdmin() {
	require_once  $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/config.php';          		//настройки подключение к БД
	require_once  $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/DbConnection.php';			//класс для работы с БД
	$mysqladmin	=	 new DbConnection();
	return $mysqladmin;
}



//////////////функции сохранения изменений
/**
 * Сохраняет изменения в модуль
 *
 * @param object $mysqladmin
 * @param object $oldModule
 * @param object $newModule
 * @return bool
 */
function saveChanges($mysqladmin, $oldModule, $newModule) {
	GLOBAL $UNDEFINED_ERROR, $DATA, $GENERAL_FUNCTIONS, $mysql, $editError, $smarty, $smartyTemp, $FILE_MANAGER, $MSGTEXT, $MODULES_PATH, $MODULES_PERFORMANCE_PATCH_NAME,$MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE31, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE7, $MYSQL_TABLE18, $MYSQL_TABLE12, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25,$MYSQL_CTR_TABLE26,$MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

	//берем историю редактирования
	$query				= "SELECT $MYSQL_CTR_TABLE31.*
	 FROM `$MYSQL_CTR_TABLE31` 
	 LEFT JOIN `$MYSQL_CTR_TABLE21` ON ($MYSQL_CTR_TABLE31.object_id=$MYSQL_CTR_TABLE21.id AND $MYSQL_CTR_TABLE31.object_type=6) 
	 WHERE $MYSQL_CTR_TABLE31.module_id='{$_SESSION['___GoodCMS']['m_id']}' ORDER BY $MYSQL_CTR_TABLE31.id";
	$result				= $mysql->executeSQL($query);
	$all_history		= $mysqladmin->fetchAssocAll($result);

	$history	= array();
	foreach ($all_history as $h) {
		switch ($h['object_type']):
		case 0:  $history['modules'][]			=$h;	break;
		case 1:  $history['blocks'][]			=$h;	break;
		case 2:  $history['functions'][]		=$h; 	break;
		case 3:  $history['tamplates'][]		=$h;	break;
		case 4:  $history['settings'][]			=$h;	break;
		case 5:  $history['tables'][]			=$h;	break;
		case 6:  $history['field'][]			=$h;	break;
		case 7:  $history['field_settings'][]	=$h; 	break;
		case 8:  $history['block_tables'][]		=$h; 	break;
		endswitch;
	}

	//сортировка по типу операции
	foreach ($history as $key=>$arr) {
		$temp_delete=array();
		$temp_update=array();
		$temp_insert=array();

		foreach ($arr as $key2=>$val) {
			if ($val['operation']==0) {
				$temp_delete[]=$val;
			}
			elseif ($val['operation']==2) {
				$temp_update[]=$val;
			}
			elseif ($val['operation']==1) {
				$temp_insert[]=$val;
			}
		}

		$temp			= array();
		$temp			= array_merge($temp, $temp_delete);
		$temp			= array_merge($temp, $temp_update);
		$temp			= array_merge($temp, $temp_insert);
		$history[$key]	= $temp;
	}


	if (isset($oldModule['name'])) {

		//очищаем сесси поиска и выборки, чтоб не возникало ошибки, если будем искать удаленное поле
                $_SESSION['data_search']='';
                $_SESSION['data_filter']='';
                $_SESSION['filterQuery']='';

		$newModule			= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($newModule);
		$oldModule			= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($oldModule);

		//обновляем таблицы блока
		$old_table_prefix	= mb_strtolower($oldModule['name']).'_';
		$new_table_prefix	= mb_strtolower($newModule['name']).'_';

		set_error_handler('errorHandler' , E_ALL);

		try {
			updateModules($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix);

			updateTables($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix);
			updateTablesFields($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix);
			updateTablesFieldsSettings($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix);

			updateBlocks($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix);
			updateBlocksSettings($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix);

			updateTamplates($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix);
		}
		catch(Exception $ex) {
			$editError[]	= sprintf($MSGTEXT['mod_constructor_err'], $ex);
		}

		//переписываем файл настроек импорта
		if (count($editError)==0)		{
			require_once('classes/Compiler.class.php');
			$compiler				= new Compiler($mysql, $smarty, array(), array(), array(), array(), '');
			$ar						= $compiler->dumpBD();
			$DATA['BDSTRUCTURE']	= $ar['sql'];
			$DATA['BLOCKS']			= $ar['blocks'];
			$DATA['MODULE']			= $newModule;
			$DATA['TABLES']			= $ar['tables'];

			//переписываем настройки файла
			$fn						= $_SERVER['DOCUMENT_ROOT']."/modules/{$newModule['name']}/management/import_settings/import_settings.php";
			if (is_writable($fn)) {
				if ($fd = $FILE_MANAGER->fopen($fn, 'w')) {
					//формируем массив с данными модуля
					$smartyTemp->assign('data', var_export($DATA, true));
					$DATA_CONTENT	= $smarty->fetch($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/constructor/templates/compiler/import_settings.tpl');
					fwrite($fd, $DATA_CONTENT);
					fclose($fd);
				}
			}
			else $editError[]	= sprintf($MSGTEXT['mod_constructor_err_writefile'], $fn);

			unset($compiler);
		}
	}
	else {
		$editError[]	= sprintf($MSGTEXT['mod_constructor_no_load_mod'], $newModule['loaded_name']);
	}

	//если в процессе что-то вывалилось, тогда добавляем в ошибки
	$e	= ob_get_contents();
	if ($e) {
		$UNDEFINED_ERROR = true;
	}

	if (count($editError)==0 && !$UNDEFINED_ERROR) {
		//очищаем историю редактирования
		$query			= "DELETE FROM `$MYSQL_CTR_TABLE31` WHERE `module_id`='{$newModule['id']}'";
		$result			= $mysql->executeSQL($query);
		$res			= true;
	}
	else {
		$res			= false;
	}

	return $res;
}



/**
 * Обработчик ошибок
 *
 * @param string $errno
 * @param string $errstr
 * @param string $errfile
 * @param int 	$errline
 */
function errorHandler($errno, $errstr, $errfile, $errline) {
	GLOBAL $MSGTEXT, $editError;

	$e				= 'Error #'.$errno.' on line  '.$errline.'<br>in file: '.$errfile.'<br>'.$errstr;

	$editError[]	= sprintf($MSGTEXT['mod_constructor_err'], $e);
}



///////////////////ФУНКЦИИ СОХРАНЕНИЯ МОДУЛЯ//////////////////////////////////////////////////////////////

/**
 * обновление модуля	
 *	
 * @param array $history
 * @param array $newModule
 * @param array $oldModule
 * @param string $old_table_prefix
 * @param string $new_table_prefix
 */	
function updateModules($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix) {
	GLOBAL  $CMSProtection, $DATA, $mysql, $smarty, $smartyTemp, $editError, $FILE_MANAGER, $MSGTEXT, $GENERAL_FUNCTIONS, $MODULES_PATH,$MODULES_PERFORMANCE_PATCH_NAME,$MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE31, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE7, $MYSQL_TABLE18, $MYSQL_TABLE12, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25,$MYSQL_CTR_TABLE26,$MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

	//$pattern 	= '/\/\*[\S\s\w\W]{0,}\/\/\/\s*class\s*[0-9A-z]*\s*{/u';
	$pattern 	= '/\/\*[\S\s\w\W]{0,}\/\/\/\s*class\s*[0-9A-z]*\s*extends\s*[0-9A-z]*\s*{/ui';

	if (isset($history['modules'])) {
		foreach ($history['modules'] as $h_r) {

			switch ($h_r['operation']) {
				case 2: {
					//переименовываем папку модуля
					$oldModulePatch	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['loaded_name'];
					$newModulePatch	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name'];

					if (!@$FILE_MANAGER->rename($oldModulePatch, $newModulePatch)) {
						$editError[]	= sprintf($MSGTEXT['mod_constructor_err_createdir'], $oldModulePatch);
					}
					
					//переименовываем файл модуля
					$oldModuleFile	= $newModulePatch.'/'.$newModule['loaded_name'].'.php';
					$newModuleFile	= $newModulePatch.'/'.$newModule['name'].'.php';					
					if (!@$FILE_MANAGER->rename($oldModuleFile, $newModuleFile)) {
						$editError[]	= sprintf($MSGTEXT['mod_constructor_err_library_write'], $oldModuleFile);
					}					

					if (count($editError)==0) {
						$new_table_prefix 			= mb_strtolower($newModule['name']);
						$dir_import_settings		= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name'].'/management/import_settings/import_settings.php';


						//обновляем библиотеку модуля
						$source_library_file	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name'].'/'.$newModule['name'].'.php';
						if (is_writable($source_library_file)) {
							$block_file_content	= $FILE_MANAGER->getfile($source_library_file);

							$smartyTemp->assign('module', $newModule);

							$block_head 		= $smartyTemp->fetch('compiler/library_head.tpl');
							$block_file_content	= preg_replace($pattern, $block_head, $block_file_content);

							if ($fd	= $FILE_MANAGER->fopen($source_library_file, 'w')) {
								fwrite($fd, $block_file_content);
								fclose($fd);
							}
							else {
								$editError[]	= sprintf($MSGTEXT['mod_constructor_err_library_write'], $source_library_file);
							}
						}
						else {
							$editError[]		= sprintf($MSGTEXT['mod_constructor_err_library_write'], $source_library_file);
						}

						//обновляем заголовоки всех блоков модуля
						if (count($editError)==0) {
							updateBlocksHead($mysqladmin, $oldModule, $newModule);
						}

						if (isset($DATA['MODULE']) && count($editError)==0) {
							$description					= htmlspecialchars($newModule['description'], ENT_QUOTES);
							$DATA['MODULE']['name']			= $newModule['name'];
							$DATA['MODULE']['description']	= $description;


							//обновляем модуль в базе админки
							$query			= "UPDATE `$MYSQL_TABLE5` SET `name`='{$newModule['name']}', `version`='{$newModule['version']}', `description`='{$newModule['description']}' WHERE `name`='{$newModule['loaded_name']}'";
							$result			= $mysqladmin->executeSQL($query);

							//обновляем загруженное имя модуля
							$query			= "UPDATE `$MYSQL_CTR_TABLE17` SET `loaded_name`='{$newModule['name']}' WHERE `id`='{$newModule['id']}'";
							$result			= $mysql->executeSQL($query);

							//запоминаем бывшее имя модуля, по которому нужно удалить резервную копию
							//$_SESSION['___GoodCMS']['loaded_module_name']=$newModule['name'];

							//запоминаем запрос восстановления
							addSqlToHistory("UPDATE `$MYSQL_CTR_TABLE17` SET `loaded_name`='{$newModule['loaded_name']}' WHERE `id`='{$newModule['id']}'");

							//переименовываем в init файле название модуля

							//$CMSProtection	= new CMSProtection($mysql, $smarty);
							$CMSProtection->updateInit($newModule['name'], $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name'].'/management/import_settings');

							//удаляем из истории запись
							deleteHistoryById($h_r['id']);
						}
					}
				}
			}
		}
	}
}



/**
 * Обновляет заголовки в блоках модуля
 *
 * @param object $mysqladmin
 * @param array $oldModule
 * @param array $newModule
 */
function updateBlocksHead($mysqladmin,  $oldModule, $newModule) {
	GLOBAL $MYSQL_TABLE6, $MSGTEXT, $FILE_MANAGER, $smartyTemp;

	$pattern 	= '/\/\*[\S\s\w\W]{0,}\/\/\/\s*class\s*[0-9A-z]*\s*extends\s*[0-9A-z]*\s*{/ui';

	//берём список блоков модуля
	$query		= "SELECT `id`, `name`, `description` FROM `$MYSQL_TABLE6` WHERE `module_id`='{$oldModule['id']}'";
	$result		= $mysqladmin->executeSQL($query);
	$blocks		= $mysqladmin->fetchAssocAll($result);

	foreach ($blocks as $block) {
		//обновляем заголовок блока
		$source_block_file	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name'].'/performance/'.$block['name'].'.php';

		if (is_writable($source_block_file)) {

			$block_file_content	= $FILE_MANAGER->getfile($source_block_file);

			$smartyTemp->assign('module', $newModule);
			$smartyTemp->assign('block', $block);

			$block_head 		= $smartyTemp->fetch('compiler/performance_block_head.tpl');
			$block_file_content	= preg_replace($pattern, $block_head, $block_file_content);

			if ($fd	= $FILE_MANAGER->fopen($source_block_file, 'w')) {
				fwrite($fd, $block_file_content);
				fclose($fd);
			}
			else {
				$editError[]	= sprintf($MSGTEXT['mod_constructor_err_writedir'], $source_block_file);
			}
		}
		else {
			$editError[]		= sprintf($MSGTEXT['mod_constructor_err_writedir'], $source_block_file);
		}
	}
}



/**
  * обновление блоков    	
  *
  * @param array $history
  * @param array $newModule
  * @param array $oldModule
  * @param string $old_table_prefix
  * @param string $new_table_prefix
  */
function updateBlocks($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix) {
	GLOBAL $mysql, $editError, $smartyTemp, $FILE_MANAGER, $MSGTEXT, $GENERAL_FUNCTIONS,$MODULES_PATH,$MODULES_PERFORMANCE_PATCH_NAME,$MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE31,  $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE7, $MYSQL_TABLE18, $MYSQL_TABLE12, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25,$MYSQL_CTR_TABLE26,$MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

	//$pattern 	= '/\/\*[\S\s\w\W]{0,}\/\/\/\s*class\s*[0-9A-z]*\s*{/u';
	$pattern 	= '/\/\*[\S\s\w\W]{0,}\/\/\/\s*class\s*[0-9A-z]*\s*extends\s*[0-9A-z]*\s*{/ui';

	//class Menu extends Menu2
	if (isset($history['blocks'])) {
		foreach ($history['blocks'] as $h_r) {
			switch ($h_r['operation']) {

				case 0: {//удаление блока

					$source_file	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name']."/performance/{$h_r['object_name']}.php";
					$tpl_patch		= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name']."/performance/{$h_r['object_name']}Templates/";
					if (!$FILE_MANAGER->unlink($source_file)) {
						$editError[]	= sprintf($MSGTEXT['mod_constructor_err_writedir'], $source_file);
					}

					if (!$FILE_MANAGER->removeFolder($tpl_patch)) {
						$editError[]	= sprintf($MSGTEXT['mod_constructor_err_writedir'], $tpl_patch);
					}

					if (count($editError)==0) {
						$query				= "SELECT `id` FROM `$MYSQL_TABLE6` WHERE `module_id`='{$oldModule['id']}' AND `name`='{$h_r['object_name']}'";
						$result				= $mysqladmin->executeSQL($query);
						list($old_block_id)	= $mysqladmin->fetchRow($result);

						//удаляем шаблоны
						$query		= "DELETE FROM `$MYSQL_TABLE12` WHERE `block_id`='$old_block_id'";
						$result		= $mysqladmin->executeSQL($query);

						//удаляем настройки блока
						$query		= "DELETE FROM `$MYSQL_TABLE7` WHERE `block_id`='$old_block_id'";
						$result		= $mysqladmin->executeSQL($query);

						//удаляем сам блок
						$query		= "DELETE FROM `$MYSQL_TABLE6` WHERE `id`='$old_block_id'";
						$result		= $mysqladmin->executeSQL($query);

						//удаляем из истории запись
						deleteHistoryById($h_r['id']);
					}
					break;
				}
				case 1: {//добавление блока

					$query				= "SELECT b.*, t.loaded_name AS `general_table_id_caption` FROM `$MYSQL_CTR_TABLE23` AS `b` LEFT JOIN `$MYSQL_CTR_TABLE18` AS `t` ON (t.id=b.general_table_id) WHERE b.id='{$h_r['object_id']}'";
					$result				= $mysql->executeSQL($query);
					$block				= $mysql->fetchAssoc($result);

					//берем id таблицы в админке
					$old_table_name		= $new_table_prefix.mb_strtolower($block['general_table_id_caption']);
					$query				= "SELECT `id` FROM `$MYSQL_TABLE18` WHERE `table_name`='$old_table_name' AND `module_id`='{$oldModule['id']}'";
					$result				= $mysqladmin->executeSQL($query);
					list($old_table_id)	= $mysqladmin->fetchRow($result);

					if (!$old_table_id) $old_table_id=0;

					$source_file	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name']."/performance/{$block['name']}.php";
					createOnePerformanceBlock($block, $newModule);

					if (count($editError)==0) {
						$block		= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($block);
						$query		= "INSERT INTO `$MYSQL_TABLE6` (`module_id`, `type`, `name`,  `description`, `act_variable`, `act_method`, `url_get_vars`, `general_table_id`, `sort_index`) VALUES ('{$oldModule['id']}', '{$block['type']}', '{$block['name']}',  '{$block['description']}', '{$block['act_variable']}' , '{$block['act_method']}', '{$block['url_get_vars']}', '$old_table_id', '{$block['sort_index']}')";
						$result		= $mysqladmin->executeSQL($query);

						//удаляем из истории запись
						deleteHistoryById($h_r['id']);
					}
					break;
				}
				case 2: {//обновление блока
					$query				= "SELECT b.*, t.loaded_name AS `general_table_id_caption` FROM `$MYSQL_CTR_TABLE23` AS `b` LEFT JOIN `$MYSQL_CTR_TABLE18` AS `t` ON (t.id=b.general_table_id) WHERE b.id='{$h_r['object_id']}'";
					$result				= $mysql->executeSQL($query);
					$block				= $mysql->fetchAssoc($result);

					//берем id блока в админке
					$query				= "SELECT `id` FROM `$MYSQL_TABLE6` WHERE `module_id`='{$oldModule['id']}' AND `name`='{$block['loaded_name']}'";
					$result				= $mysqladmin->executeSQL($query);
					list($old_block_id)	= $mysqladmin->fetchRow($result);

					//берем id таблицы в админке
					$old_table_name		= $new_table_prefix.mb_strtolower($block['general_table_id_caption']);
					$query				= "SELECT `id` FROM `$MYSQL_TABLE18` WHERE `table_name`='$old_table_name' AND `module_id`='{$oldModule['id']}'";
					$result				= $mysqladmin->executeSQL($query);
					list($old_table_id)	= $mysqladmin->fetchRow($result);

					if (!$old_table_id) $old_table_id='NULL';

					//меняем название блока в файле
					$source_file			= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name']."/performance/{$block['loaded_name']}.php";
					$source_file_new		= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name']."/performance/{$block['name']}.php";
					$source_patch_tpl		= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name']."/performance/{$block['loaded_name']}Templates";
					$source_patch_tpl_new	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name']."/performance/{$block['name']}Templates";

					//переписывам название блока
					if (is_file($source_file)) {
						$block_file_content	= $FILE_MANAGER->getfile($source_file);

						$smartyTemp->assign('module', $newModule);
						$smartyTemp->assign('block', $block);

						$block_head 		= $smartyTemp->fetch('compiler/performance_block_head.tpl');
						$block_file_content	= preg_replace($pattern, $block_head, $block_file_content);

						$fd	= $FILE_MANAGER->fopen($source_file, 'w');
						fwrite($fd, $block_file_content);
						fclose($fd);
						$FILE_MANAGER->rename($source_file, 		$source_file_new);
						$FILE_MANAGER->rename($source_patch_tpl, 	$source_patch_tpl_new);

						$block		= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($block);

						$query		= "UPDATE `$MYSQL_TABLE6` SET `type`='{$block['type']}', `name`='{$block['name']}', `description`='{$block['description']}', `act_variable`='{$block['act_variable']}', `act_method`='{$block['act_method']}', `url_get_vars`='{$block['url_get_vars']}', `general_table_id`=$old_table_id, `sort_index`='{$block['sort_index']}' WHERE `id`='$old_block_id'";
						$result		= $mysqladmin->executeSQL($query);

						//обновляем  загруженное имя блока в конструкторе
						$query		= "UPDATE `$MYSQL_CTR_TABLE23` SET `loaded_name`='{$block['name']}' WHERE `id`='{$block['id']}'";
						$result		= $mysql->executeSQL($query);

						//запоминаем запрос восстановления
						addSqlToHistory("UPDATE `$MYSQL_CTR_TABLE23` SET `loaded_name`='{$block['loaded_name']}' WHERE `id`='{$block['id']}'");

						//удаляем из истории запись
						deleteHistoryById($h_r['id']);
					}
					else {
						$this->editError[]	= sprintf($MSGTEXT['mod_constructor_err_writedir'], $source_file);
					}
					break;
				}
			}
		}
	}
}



/**
  * обновляем настройки блоков
  *
  * @param array $history
  * @param array $newModule
  * @param array $oldModule
  * @param string $old_table_prefix
  * @param string $new_table_prefix
  */
function updateBlocksSettings($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix) {
	GLOBAL $mysql, $editError, $GENERAL_FUNCTIONS, $MODULES_PATH,$MODULES_PERFORMANCE_PATCH_NAME,$MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE31,  $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE7, $MYSQL_TABLE18, $MYSQL_TABLE12, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25,$MYSQL_CTR_TABLE26,$MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

	if (isset($history['settings']))
	foreach ($history['settings'] as $h_r) {
		$query			= "SELECT `loaded_name` FROM  `$MYSQL_CTR_TABLE23` WHERE `id`='{$h_r['object_name_second']}'";
		$result			= $mysql->executeSQL($query);
		$block			= $mysql->fetchAssoc($result);

		//берем id-старого блока
		$query			= "SELECT `id`, `name` FROM  `$MYSQL_TABLE6` WHERE `name`='{$block['loaded_name']}' AND `module_id`='{$oldModule['id']}'";
		$result			= $mysqladmin->executeSQL($query);
		$old_block		= $mysqladmin->fetchAssoc($result);


		switch ($h_r['operation']) {
			case 0: { //удаление настройки

				//удаляем настройку
				$query		= "DELETE FROM `$MYSQL_TABLE7` WHERE `name`='{$h_r['object_name']}' AND `block_id`='{$old_block['id']}'";
				$result		= $mysqladmin->executeSQL($query);

				//удаляем из истории запись
				deleteHistoryById($h_r['id']);
				break;
			}
			case 1: {//добавление настройки

				$query		= "SELECT * FROM `$MYSQL_CTR_TABLE28` WHERE `id`='{$h_r['object_id']}'";
				$result		= $mysql->executeSQL($query);
				$s			= $mysql->fetchAssoc($result);
				$s			= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($s);

				$query		= "INSERT INTO `$MYSQL_TABLE7` (`id`, `block_id`, `type`, `name`, `value`, `description`) VALUES (NULL, '{$old_block['id']}', '{$s['edit_s_type_id']}', '{$s['name']}', '{$s['value']}', '{$s['description']}')";
				$result		= $mysqladmin->executeSQL($query);

				//удаляем из истории запись
				deleteHistoryById($h_r['id']);
				break;
			}
			case 2: {//изменение настройки
				$query		= "SELECT * FROM `$MYSQL_CTR_TABLE28` WHERE `id`='{$h_r['object_id']}'";
				$result		= $mysql->executeSQL($query);
				$s			= $mysql->fetchAssoc($result);
				$s			= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($s);


				//берем ID нового назначенного блока
				$query			= "SELECT `loaded_name` FROM  `$MYSQL_CTR_TABLE23` WHERE `id`='{$s['block_id']}'";
				$result			= $mysql->executeSQL($query);
				$new_block		= $mysql->fetchAssoc($result);

				//берем id блока в админке
				$query			= "SELECT `id`, `name` FROM  `$MYSQL_TABLE6` WHERE `name`='{$new_block['loaded_name']}' AND `module_id`='{$oldModule['id']}'";
				$result			= $mysqladmin->executeSQL($query);
				$new_old_block	= $mysqladmin->fetchAssoc($result);


				$query		= "UPDATE `$MYSQL_TABLE7` SET `type`='{$s['edit_s_type_id']}', `name`='{$s['name']}', `value`='{$s['value']}', `description`='{$s['description']}', `block_id`='{$new_old_block['id']}'
				WHERE `name`='{$h_r['object_name']}' AND `block_id`='{$old_block['id']}'";
				$result		= $mysqladmin->executeSQL($query);
				///			print $query;

				//обновляем  загруженное имя настройки блока
				$query		= "UPDATE `$MYSQL_CTR_TABLE28` SET `loaded_name`='{$s['name']}' WHERE `id`='{$h_r['object_id']}'";
				$result		= $mysql->executeSQL($query);

				//запоминаем запрос восстановления
				addSqlToHistory("UPDATE `$MYSQL_CTR_TABLE28` SET `loaded_name`='{$s['loaded_name']}' WHERE `id`='{$h_r['object_id']}'");

				//удаляем из истории запись
				deleteHistoryById($h_r['id']);
				break;
			}
		}
	}
}



/**
  * обновление шаблонов	
  *
  * @param array $history
  * @param array $newModule
  * @param array $oldModule
  * @param string $old_table_prefix
  * @param string $new_table_prefix
  */
function updateTamplates($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix) {
	GLOBAL $mysql, $editError, $FILE_MANAGER, $MSGTEXT, $GENERAL_FUNCTIONS, $MODULES_PATH,$MODULES_PERFORMANCE_PATCH_NAME,$MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE31,  $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE7, $MYSQL_TABLE18, $MYSQL_TABLE12, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25,$MYSQL_CTR_TABLE26,$MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

	if (isset($history['tamplates']))
	foreach ($history['tamplates'] as $h_r) {

		switch ($h_r['operation']) {
			case 0: {//удаление шаблона

				$query			= "SELECT `loaded_name` FROM  `$MYSQL_CTR_TABLE23` WHERE `id`='{$h_r['object_name_second']}'";
				$result			= $mysql->executeSQL($query);
				$block			= $mysql->fetchAssoc($result);

				//берем id-старого блока
				$query			= "SELECT `id`, `name` FROM  `$MYSQL_TABLE6` WHERE `name`='{$block['loaded_name']}' AND `module_id`='{$oldModule['id']}'";
				$result			= $mysqladmin->executeSQL($query);
				$old_block		= $mysqladmin->fetchAssoc($result);

				//берем id-старого шаблона
				$query					= "SELECT `id` FROM  `$MYSQL_TABLE12` WHERE `name`='{$h_r['object_name']}' AND `block_id`='{$old_block['id']}'";
				$result					= $mysqladmin->executeSQL($query);
				list($old_block_tpl_id)	= $mysqladmin->fetchRow($result);


				$source_file	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name']."/performance/{$old_block['name']}Templates/{$h_r['object_name']}";

				if (file_exists($source_file)) $FILE_MANAGER->unlink($source_file);

				$query			= "DELETE FROM `$MYSQL_TABLE12` WHERE `id`='$old_block_tpl_id'";
				$result			= $mysqladmin->executeSQL($query);

				//удаляем из истории запись
				deleteHistoryById($h_r['id']);

				break;
			}
			case 1: {//добавление шаблона
				$query			= "SELECT $MYSQL_CTR_TABLE30.*, $MYSQL_CTR_TABLE23.name as `block_name`, $MYSQL_CTR_TABLE23.loaded_name as `loaded_block_name`  FROM `$MYSQL_CTR_TABLE30` LEFT JOIN `$MYSQL_CTR_TABLE23` ON ($MYSQL_CTR_TABLE23.id=$MYSQL_CTR_TABLE30.block_id) WHERE $MYSQL_CTR_TABLE30.id='{$h_r['object_id']}'";
				$result			= $mysql->executeSQL($query);
				$new_block_tpl	= $mysql->fetchAssoc($result);

				//берем id-старого блока
				$query			= "SELECT `id`, `name` FROM  `$MYSQL_TABLE6` WHERE `name`='{$new_block_tpl['loaded_block_name']}' AND `module_id`='{$oldModule['id']}'";
				$result			= $mysqladmin->executeSQL($query);
				$old_block		= $mysqladmin->fetchAssoc($result);

				$source_file_tpl_new	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name']."/performance/{$old_block['name']}Templates/{$new_block_tpl['name']}";
				if ($fd	= $FILE_MANAGER->fopen($source_file_tpl_new, 'w')) {
					fwrite($fd, $new_block_tpl['content']);
					fclose($fd);

					$new_block_tpl	= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($new_block_tpl);
					$query			= "INSERT INTO `$MYSQL_TABLE12` (`id`, `block_id`, `name`, `description`, `content`, `sort_index`) VALUES (NULL, '{$old_block['id']}', '{$new_block_tpl['name']}', '{$new_block_tpl['description']}', '{$new_block_tpl['content']}', '{$new_block_tpl['sort_index']}')";
					$result			= $mysqladmin->executeSQL($query);

					//обновляем  загруженное имя шаблона в конструкторе
					$query			= "UPDATE `$MYSQL_CTR_TABLE30` SET `loaded_name`='{$new_block_tpl['name']}' WHERE `id`='{$h_r['object_id']}'";
					$result			= $mysql->executeSQL($query);

					//запоминаем запрос восстановления
					addSqlToHistory("UPDATE `$MYSQL_CTR_TABLE30` SET `loaded_name`='{$new_block_tpl['loaded_name']}' WHERE `id`='{$h_r['object_id']}'");

					//удаляем из истории запись
					deleteHistoryById($h_r['id']);
				}
				else {
					$editError[]	= sprintf($MSGTEXT['mod_constructor_err_writedir'], $source_file);
				}

				break;
			}
			case 2: {//обновление шаблона

				$query			= "SELECT $MYSQL_CTR_TABLE30.*, $MYSQL_CTR_TABLE23.name as `block_name`, $MYSQL_CTR_TABLE23.loaded_name as `loaded_block_name`  FROM `$MYSQL_CTR_TABLE30` LEFT JOIN `$MYSQL_CTR_TABLE23` ON ($MYSQL_CTR_TABLE23.id=$MYSQL_CTR_TABLE30.block_id) WHERE $MYSQL_CTR_TABLE30.id='{$h_r['object_id']}'";
				$result			= $mysql->executeSQL($query);
				$new_block_tpl	= $mysql->fetchAssoc($result);

				//берем id-старого блока
				$query				= "SELECT `id`, `name` FROM  `$MYSQL_TABLE6` WHERE `name`='{$new_block_tpl['loaded_block_name']}' AND `module_id`='{$oldModule['id']}'";
				$result				= $mysqladmin->executeSQL($query);
				$old_block			= $mysqladmin->fetchAssoc($result);

				//берем id-старого шаблона
				$query					= "SELECT `id` FROM  `$MYSQL_TABLE12` WHERE `name`='{$new_block_tpl['loaded_name']}' AND `block_id`='{$old_block['id']}'";
				$result					= $mysqladmin->executeSQL($query);
				list($old_block_tpl_id)	= $mysqladmin->fetchRow($result);

				$source_file_tpl		= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name']."/performance/{$old_block['name']}Templates/{$new_block_tpl['loaded_name']}";
				$source_file_tpl_new	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name']."/performance/{$old_block['name']}Templates/{$new_block_tpl['name']}";

				if  ($FILE_MANAGER->rename($source_file_tpl, $source_file_tpl_new)) {

					$new_block_tpl	= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($new_block_tpl);
					//$query			= "UPDATE `$MYSQL_TABLE12` SET  `name`='{$new_block_tpl['name']}', `description`='{$new_block_tpl['description']}', `content`='{$new_block_tpl['content']}' WHERE `id`='$old_block_tpl_id'";
					$query			= "UPDATE `$MYSQL_TABLE12` SET  `name`='{$new_block_tpl['name']}', `description`='{$new_block_tpl['description']}'  WHERE `id`='$old_block_tpl_id'";
					$result			= $mysqladmin->executeSQL($query);

					//обновляем  загруженное имя шаблона в конструкторе
					$query		= "UPDATE `$MYSQL_CTR_TABLE30` SET `loaded_name`='{$new_block_tpl['name']}' WHERE `id`='{$h_r['object_id']}'";
					$result		= $mysql->executeSQL($query);

					//запоминаем запрос восстановления
					addSqlToHistory("UPDATE `$MYSQL_CTR_TABLE30` SET `loaded_name`='{$new_block_tpl['loaded_name']}' WHERE `id`='{$h_r['object_id']}'");

					//удаляем из истории запись
					deleteHistoryById($h_r['id']);
				}
				else {
					$editError[]=sprintf($MSGTEXT['mod_constructor_err_writedir'], $source_file);
				}
				break;
			}
		}
	}
}



/**
 * обновляем описания таблиц
 *
 * @param array $history
 * @param array $newModule
 * @param array $oldModule
 * @param string $old_table_prefix
 * @param string $new_table_prefix
 */
function updateTables($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix) {
	GLOBAL $mysql, $editError, $GENERAL_FUNCTIONS, $MODULES_PATH,$MODULES_PERFORMANCE_PATCH_NAME,$MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE31,  $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE7, $MYSQL_TABLE18, $MYSQL_TABLE12, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25,$MYSQL_CTR_TABLE26,$MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

	if (isset($history['tables']))
	foreach ($history['tables'] as $h_r) {
		switch ($h_r['operation']) {
			case 0: { //удаление таблицы

				$old_table_name	= $old_table_prefix.$h_r['object_name'];

				//берем id удаляемой таблицы
				$query			= "SELECT `id` FROM `$MYSQL_TABLE18` WHERE `table_name`='$old_table_name' AND `module_id`='{$oldModule['id']}'";
				$result			= $mysqladmin->executeSQL($query);
				list($table_id) = $mysqladmin->fetchRow($result);

				$query	= "DROP TABLE `$old_table_name`";
				if ($result	= $mysqladmin->executeSQL($query)) {

					$query			= "DELETE FROM `$MYSQL_TABLE18` WHERE `id`='$table_id'";
					$result			= $mysqladmin->executeSQL($query);

					//чтоб небыло ошибки обновляем имя на ресурс-источник
					$query		= "UPDATE `$MYSQL_TABLE17` SET `sourse_table_name`='', `sourse_field_name`='' WHERE `sourse_table_name`='$old_table_name'";
					$result		= $mysqladmin->executeSQL($query);

					//удаляем настройки полей
					$query		= "DELETE FROM `$MYSQL_TABLE17` WHERE `table_id`='$table_id'";
					$mysqladmin->executeSQL($query);

					//удаляем из истории запись
					deleteHistoryById($h_r['id']);

					updateStoragePatchName($newModule['name'], $h_r['operation'], $h_r['object_name']);

					//Изменяет содержимое файла import_settings.php
					updateTablesRecords($h_r['operation'], false, $newModule['name'],  $old_table_name, $old_table_name);
				}
				break;
			}
			case 1: {//добавление таблицы

				$query		= "SELECT * FROM `$MYSQL_CTR_TABLE18` WHERE id='{$h_r['object_id']}'";
				$result		= $mysql->executeSQL($query);
				$t			= $mysql->fetchAssoc($result);

				$t_name		= $new_table_prefix.$t['name'];
				$query		= "CREATE TABLE `$t_name` (`tag_id` int, `page_id` int, `lang_id` int(6), `sort_index` int)";
				if ($result	= $mysqladmin->executeSQL($query)) {

					$t			= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($t);
					$query		= "INSERT INTO `$MYSQL_TABLE18` (`table_name`, `description`, `show_type`, `additional_buttons`, `module_id`, `sort_index`) VALUES ('$t_name', '{$t['description']}', '{$t['show_type']}', '{$t['additional_buttons']}', '{$oldModule['id']}', '{$t['sort_index']}')";
					if ($result	= $mysqladmin->executeSQL($query)) {

						$inserted_table_id 	= $mysqladmin->insertID();

						//удаляем настройки полей, если не удалились
						$query		= "DELETE FROM `$MYSQL_TABLE17` WHERE `table_id`='$inserted_table_id'";
						$mysqladmin->executeSQL($query);


						//удаляем из истории запись
						deleteHistoryById($h_r['id']);
					}
				}
				break;
			}
			case 2: {//изменение таблицы

				$query			= "SELECT * FROM `$MYSQL_CTR_TABLE18` WHERE id='{$h_r['object_id']}'";
				$result			= $mysql->executeSQL($query);
				$t				= $mysql->fetchAssoc($result);

				$t_name			= $new_table_prefix.$t['name'];
				$old_table_name	= $old_table_prefix.$t['loaded_name'];

				if (updateStoragePatchName($newModule['name'], $h_r['operation'], $t['loaded_name'], $t['name'])) {

					$query			= "ALTER TABLE `$old_table_name` RENAME `$t_name`";
					if ($result		= $mysqladmin->executeSQL($query)) {

						$t			= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($t);

						$query		= "UPDATE `$MYSQL_TABLE18` SET `table_name`='$t_name', `description`='{$t['description']}', `show_type`='{$t['show_type']}', `additional_buttons`='{$t['additional_buttons']}', `sort_index`='{$t['sort_index']}' WHERE `table_name`='$old_table_name'";

						if ($result		= $mysqladmin->executeSQL($query)) {
							//обновляем имя на ресурс
							$query		= "UPDATE `$MYSQL_TABLE17` SET  `sourse_table_name`='$t_name' WHERE `sourse_table_name`='$old_table_name'";
							if ($result	= $mysqladmin->executeSQL($query)) {

								//обновляем  загруженное имя таблицы в конструкторе
								$query		= "UPDATE `$MYSQL_CTR_TABLE18` SET `loaded_name`='{$t['name']}' WHERE `id`='{$t['id']}'";
								$result		= $mysql->executeSQL($query);

								//запоминаем запрос восстановления
								addSqlToHistory("UPDATE `$MYSQL_CTR_TABLE18` SET `loaded_name`='{$t['loaded_name']}' WHERE `id`='{$t['id']}'");

								//удаляем из истории запись
								deleteHistoryById($h_r['id']);

								//Изменяет содержимое файла import_settings.php
								if ($old_table_name!=$t_name) {
									updateTablesRecords($h_r['operation'], false, $newModule['name'], $old_table_name, $t_name);
								}

							}
						}
					}
				}
				break;
			}
		}
	}
}



/**
 * Переименовывает папки по имени табицы/поля
 *
 * @param unknown_type $module_name
 * @param unknown_type $operation_type
 * @param unknown_type $old_name
 * @param unknown_type $new_name
 * @param unknown_type $field_edit_type_id
 * @param unknown_type $table_name
 * @return unknown
 */
function updateStoragePatchName($module_name, $operation_type, $old_name, $new_name=null, $field_edit_type_id=null, $table_name=null) {
	GLOBAL $mysql, $editError, $FILE_MANAGER, $MSGTEXT, $GENERAL_FUNCTIONS;

	$res	= true;
	if (in_array($field_edit_type_id, array(9,10,11,12))) {	//если тип редактирования файловый
		if ($field_edit_type_id==9 || $field_edit_type_id==10) {
			$s_patch='images/';
		}
		else if ($field_edit_type_id==11 || $field_edit_type_id==12) {
			$s_patch='files/';
		}

		//меняем имя папки по таблице
		if (!isset($s_patch)) {
			$patch	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$module_name."/management/storage/";
		}
		//меняем имя папки по полю
		else {
			$patch	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$module_name."/management/storage/{$s_patch}{$table_name}/";
		}

		switch ($operation_type){
			//удалить
			case 0 : {
				if (!isset($s_patch)) {
					if (is_dir($patch.'images/'.$old_name) && !@$FILE_MANAGER->removeFolder($patch.'images/'.$old_name)) {
						$editError[]	= sprintf($MSGTEXT['mod_constructor_err_writedir'], $patch.'images/'.$old_name);
						$res	= false;
					}

					if (is_dir($patch.'files/'.$old_name) && !@$FILE_MANAGER->removeFolder($patch.'files/'.$old_name)) {
						$editError[]	= sprintf($MSGTEXT['mod_constructor_err_writedir'], $patch.'files/'.$old_name);
						$res	= false;
					}
				}
				elseif (is_dir($patch.$old_name) && !@$FILE_MANAGER->removeFolder($patch.$old_name)) {
					$editError[]		= sprintf($MSGTEXT['mod_constructor_err_writedir'], $patch.$old_name);
					$res	= false;
				}
				break;
			}
			//обновить
			case 2: {
				if (!isset($s_patch)) {
					if (is_dir($patch.'images/'.$old_name) &&  !@$FILE_MANAGER->rename($patch.'images/'.$old_name, $patch.'images/'.$new_name)) 	{
						$editError[]	= sprintf($MSGTEXT['mod_constructor_err_writedir'], $patch.'images/'.$old_name);
						$res	= false;
					}
					elseif (is_dir($patch.'files/'.$old_name) &&  !@$FILE_MANAGER->rename($patch.'files/'.$old_name, $patch.'files/'.$new_name)) 	{
						$editError[]	= sprintf($MSGTEXT['mod_constructor_err_writedir'], $patch.'files/'.$old_name);
						$res	= false;
					}
				}
				else 	if (is_dir($patch.$old_name) && !@$FILE_MANAGER->rename($patch.$old_name, $patch.$new_name)) 						{
					$editError[]	= sprintf($MSGTEXT['mod_constructor_err_writedir'], $patch.$old_name);
					$res	= false;
				}
				break;
			}
		}
	}

	return $res;
}



/**
  * обновляем поля таблиц
  *
  * @param array $history
  * @param array $newModule
  * @param array $oldModule
  * @param string $old_table_prefix
  * @param string $new_table_prefix
  */
function updateTablesFields($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix) {
	GLOBAL $mysql, $editError, $MSGTEXT, $GENERAL_FUNCTIONS, $MODULES_PATH,$MODULES_PERFORMANCE_PATCH_NAME, $MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE31,  $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE7, $MYSQL_TABLE18, $MYSQL_TABLE12, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25,$MYSQL_CTR_TABLE26,$MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

	$sql_modify		= array();
	if (isset($history['field']))
	foreach ($history['field'] as $h_r) {

		$sql_modify	= array();

		switch ($h_r['operation']) {
			case 0: { //удаление поля

				$old_table_name	= $old_table_prefix.$h_r['object_name_second'];
				//$t_name			= $new_table_prefix.'_'.$t['name'];
				$query		= "SELECT `id`, `table_name` FROM  `$MYSQL_TABLE18` WHERE `table_name`='$old_table_name'";
				$result		= $mysqladmin->executeSQL($query);
				$oldtable	= $mysqladmin->fetchAssoc($result);

				$query		= "ALTER TABLE `{$oldtable['table_name']}` DROP COLUMN `{$h_r['object_name']}`";
				if ($result	= $mysqladmin->executeSQL($query)) {
					//удаляем поле
					$query			= "DELETE FROM `$MYSQL_TABLE17` WHERE `fieldname`='{$h_r['object_name']}' AND `table_id`='{$oldtable['id']}'";
					if ($result		= $mysqladmin->executeSQL($query)) {
						//удаляем из истории запись
						deleteHistoryById($h_r['id']);

						//берем название поля и таблицы из конструктора
						$query						= "SELECT $MYSQL_CTR_TABLE21.edittype_id FROM `$MYSQL_CTR_TABLE21` WHERE $MYSQL_CTR_TABLE21.id='{$h_r['object_id']}'";
						$result						= $mysql->executeSQL($query);
						list($field_edit_type_id)	= $mysql->fetchRow($result);

						updateStoragePatchName($newModule['name'], $h_r['operation'], $h_r['object_name'], null, $field_edit_type_id, $h_r['object_name_second']);

						//Изменяет содержимое файла  import_settings.php
						updateTablesRecords($h_r['operation'], true, $newModule['name'],  $old_table_name, $h_r['object_name'], $h_r['object_name']);
					}
				}
				else $editError[]	= sprintf($MSGTEXT['mod_constructor_err_delfield'], $h_r['object_name'],$old_table_name);

				break;
			}

			case 1: {//добавление поля
				//берем название поля и таблицы из конструктора
				$query			= "SELECT $MYSQL_CTR_TABLE21.id, $MYSQL_CTR_TABLE21.loaded_name, $MYSQL_CTR_TABLE21.table_id, $MYSQL_CTR_TABLE18.loaded_name AS `loaded_table_name`
					FROM `$MYSQL_CTR_TABLE21` LEFT JOIN `$MYSQL_CTR_TABLE18` ON ($MYSQL_CTR_TABLE18.id=$MYSQL_CTR_TABLE21.table_id) 
					WHERE $MYSQL_CTR_TABLE21.id='{$h_r['object_id']}'";

				$result			= $mysql->executeSQL($query);
				$f				= $mysql->fetchAssoc($result);
				$old_table_name	= $old_table_prefix.$f['loaded_table_name'];

				//берем id таблицы в админке
				$query		= "SELECT `id` FROM  `$MYSQL_TABLE18` WHERE `table_name`='$old_table_name'";
				$result		= $mysqladmin->executeSQL($query);
				$oldtable	= $mysqladmin->fetchAssoc($result);

				$new_field			= getTableField($h_r['object_id']);

				$sql_alter			= get_on_query_forModify($old_table_name, $new_field, 1);

				$new_field			= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($new_field);
				if (alterSQL($sql_alter, $mysqladmin, $old_table_name)) {	//добавляем поле

					$full_sourse_table_name=$new_field['sourse_table_name'];

					if ($new_field['edittype_id']==0 || $new_field['edittype_id']=='')  {
						$new_field['edittype_id']='NULL';
					}

					if ($new_field['datatype_id']==0 || $new_field['datatype_id']=='')  {
						$new_field['datatype_id']='NULL';
					}

					if ($new_field['collation_id']==0 || $new_field['collation_id']=='')  {
						$new_field['collation_id']='NULL';
					}

					$query="INSERT INTO `$MYSQL_TABLE17`  (
												`id`,													
												`table_id`,
												`fieldname`,
												`comment`, 
												`datatype_id`, 
												`len`, 
												`default`,
												`collation_id`,
												`group_caption`,
												`not_null`, 
												`unsigned`, 
												`zerofill`, 
												`unique`, 												
												`notfedit`, 																								
												`edittype_id`,
												`active`,
												`show_in_list`,
												`filter`,
												`delete`,
												`own_filter`,												
												`regex`,
												`height`, 
												`width`, 
												`style`, 
												`sourse_field_name`, 
												`sourse_table_name`, 
												`auto_incr`, 
												`pk`, 
												`hide_by_field_caption`, 
												`hide_operator`, 
												`hide_on_value`,
												`avator_quality`,
												`avator_width`,
												`avator_height`,
												`avator_quality_big`,
												`avator_width_big`,
												`avator_height_big`,
												`sort_index`												 
												) 
												VALUES 
												(																										
												NULL,												
												'{$oldtable['id']}',
												'{$new_field['fieldname']}',
												'{$new_field['comment']}', 
												{$new_field['datatype_id']}, 
												'{$new_field['len']}', 
												'{$new_field['default']}',
												{$new_field['collation_id']},
												'{$new_field['group_caption']}',												
												'{$new_field['not_null']}', 
												'{$new_field['unsigned']}', 
												'{$new_field['zerofill']}', 
												'{$new_field['unique']}', 												
												'{$new_field['notfedit']}', 																								
												{$new_field['edittype_id']},
												'{$new_field['active']}',
												'{$new_field['show_in_list']}',
												'{$new_field['filter']}',
												'{$new_field['delete']}',
												'{$new_field['own_filter']}',												
												'{$new_field['regex']}',
												'{$new_field['height']}', 
												'{$new_field['width']}', 
												'{$new_field['style']}', 
												'{$new_field['sourse_field_name']}', 
												'$full_sourse_table_name', 
												'{$new_field['auto_incr']}', 
												'{$new_field['pk']}', 
												'{$new_field['hide_by_field_caption']}', 
												'{$new_field['hide_operator']}', 
												'{$new_field['hide_on_value']}', 
												'{$new_field['avator_quality']}',
												'{$new_field['avator_width']}',
												'{$new_field['avator_height']}',
												'{$new_field['avator_quality_big']}',
												'{$new_field['avator_width_big']}',
												'{$new_field['avator_height_big']}',
												'{$new_field['sort_index']}'
												)";

					if ($result		= $mysqladmin->executeSQL($query)) {

						//обновляем название поля-источника
						$query		= "UPDATE `$MYSQL_TABLE17` SET `sourse_field_name`='{$new_field['fieldname']}' WHERE `sourse_field_name`='{$f['loaded_name']}' AND `sourse_table_name`='$old_table_name'";
						$result		= $mysqladmin->executeSQL($query);

						//обновляем  загруженное имя таблицы в конструкторе
						$query			= "UPDATE `$MYSQL_CTR_TABLE21` SET `loaded_name`='{$new_field['fieldname']}' WHERE `id`='{$f['id']}'";
						if ($result		= $mysql->executeSQL($query)) {
							//запоминаем запрос восстановления
							addSqlToHistory("UPDATE `$MYSQL_CTR_TABLE21` SET `loaded_name`='{$new_field['loaded_name']}' WHERE `id`='{$new_field['id']}'");
							//удаляем из истории запись
							deleteHistoryById($h_r['id']);
							//Изменяет содержимое файла  import_settings.php
							if ($f['loaded_name']!=$new_field['fieldname']) {
								updateTablesRecords($h_r['operation'], true, $newModule['name'], $old_table_name, null, $f['loaded_name'], $new_field['fieldname']);
							}
						}


					}
				}
				else $editError[]=sprintf($MSGTEXT['mod_constructor_err_add_field'], $new_field['fieldname'],$old_table_name);
				break;
			}
			case 2: {//обновляем поля таблиц

				//берем название поля и таблицы из конструктора
				$query		= "SELECT  $MYSQL_CTR_TABLE21.table_id, $MYSQL_CTR_TABLE21.id, $MYSQL_CTR_TABLE21.loaded_name, $MYSQL_CTR_TABLE18.loaded_name AS `loaded_table_name` FROM `$MYSQL_CTR_TABLE21` LEFT JOIN `$MYSQL_CTR_TABLE18` ON ($MYSQL_CTR_TABLE18.id=$MYSQL_CTR_TABLE21.table_id) WHERE $MYSQL_CTR_TABLE21.id='{$h_r['object_id']}'";
				$result		= $mysql->executeSQL($query);
				$f			= $mysql->fetchAssoc($result);

				$old_table_name	= $old_table_prefix.$f['loaded_table_name'];

				//берем id таблицы в админке
				$query		= "SELECT `id` FROM  `$MYSQL_TABLE18` WHERE `table_name`='$old_table_name'";
				$result		= $mysqladmin->executeSQL($query);
				$oldtable	= $mysqladmin->fetchAssoc($result);

				//получаем id записи в админке
				$query				= "SELECT `id` FROM `$MYSQL_TABLE17` WHERE `fieldname`='{$f['loaded_name']}' AND `table_id`='{$oldtable['id']}'";
				$result				= $mysqladmin->executeSQL($query);
				list($old_field_id)	= $mysqladmin->fetchRow($result);

				$new_field			= getTableField($h_r['object_id']);
				//проверяем, чтоб небыло нулей в поле, которое хотят сделать автоинкрементом и первичным ключем, иначе ошибка
				if ($new_field['pk']==1) {
					$query		= "SELECT count(*) FROM  `$old_table_name` WHERE `{$f['loaded_name']}`='0' LIMIT 1";
					$result		= $mysqladmin->executeSQL($query);
					list($bad_records)	= $mysqladmin->fetchRow($result);
					if ($bad_records==1) $editError[]=sprintf($MSGTEXT['mod_constructor_err_createkey'], $old_table_name,$f['loaded_name']);
				}

				if (count($editError)==0) {

					$sql_alter	= get_on_query_forModify($old_table_name, $new_field, 2);

					$new_field	= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($new_field);

					if (updateStoragePatchName($newModule['name'], $h_r['operation'], $f['loaded_name'], $new_field['fieldname'], $new_field['edittype_id'], $f['loaded_table_name'])) {

						if (alterSQL($sql_alter, $mysqladmin, $old_table_name)) {
							$full_sourse_table_name=$new_field['sourse_table_name'];

							if ($new_field['edittype_id']==0 || $new_field['edittype_id']=='')  {
								$new_field['edittype_id']='NULL';
							}

							if ($new_field['datatype_id']==0 || $new_field['datatype_id']=='')  {
								$new_field['datatype_id']='NULL';
							}

							if ($new_field['collation_id']==0 || $new_field['collation_id']=='')  {
								$new_field['collation_id']='NULL';
							}

							$query="UPDATE `$MYSQL_TABLE17`  SET
												`fieldname`='{$new_field['fieldname']}',
												`comment`='{$new_field['comment']}', 
												`datatype_id`={$new_field['datatype_id']}, 
												`len`='{$new_field['len']}', 
												`default`='{$new_field['default']}',
												`collation_id`={$new_field['collation_id']}, 
												`group_caption`='{$new_field['group_caption']}',												
												`not_null`='{$new_field['not_null']}', 
												`unsigned`='{$new_field['unsigned']}', 
												`zerofill`='{$new_field['zerofill']}', 
												`unique`='{$new_field['unique']}', 												
												`notfedit`='{$new_field['notfedit']}', 																								
												`edittype_id`={$new_field['edittype_id']},
												`active`='{$new_field['active']}',
												`show_in_list`='{$new_field['show_in_list']}',
												`filter`='{$new_field['filter']}',
												`delete`='{$new_field['delete']}',
												`own_filter`='{$new_field['own_filter']}',												
												`regex`='{$new_field['regex']}',
												`height`='{$new_field['height']}', 
												`width`='{$new_field['width']}', 
												`style`='{$new_field['style']}', 
												`sourse_field_name`='{$new_field['sourse_field_name']}', 
												`sourse_table_name`='$full_sourse_table_name', 
												`auto_incr`='{$new_field['auto_incr']}', 
												`pk`='{$new_field['pk']}', 
												`hide_by_field_caption`='{$new_field['hide_by_field_caption']}', 
												`hide_operator`='{$new_field['hide_operator']}', 
												`hide_on_value`='{$new_field['hide_on_value']}', 
												`sort_index`='{$new_field['sort_index']}'
												 WHERE `id`='$old_field_id'";

							if ($result		= $mysqladmin->executeSQL($query)) {

								//обновляем название поля-источника
								$query		= "UPDATE `$MYSQL_TABLE17` SET `sourse_field_name`='{$new_field['fieldname']}' WHERE `sourse_field_name`='{$f['loaded_name']}' AND `sourse_table_name`='$old_table_name'";
								$result		= $mysqladmin->executeSQL($query);

								//обновляем  загруженное имя таблицы в конструкторе
								$query		= "UPDATE `$MYSQL_CTR_TABLE21` SET `loaded_name`='{$new_field['fieldname']}' WHERE `id`='{$f['id']}'";

								if ($result		= $mysql->executeSQL($query)) {

									//запоминаем запрос восстановления
									addSqlToHistory("UPDATE `$MYSQL_CTR_TABLE21` SET `loaded_name`='{$new_field['loaded_name']}' WHERE `id`='{$f['id']}'");

									//удаляем из истории запись
									deleteHistoryById($h_r['id']);

									//Изменяет содержимое файла  import_settings.php
									if ($f['loaded_name']!=$new_field['fieldname']) {
										updateTablesRecords($h_r['operation'], true, $newModule['name'], $old_table_name, null, $f['loaded_name'], $new_field['fieldname']);
									}
								}
							}
						}
					}
					else {
						break;
					}
				}
				break;
			}
		}
	}
}



/**
 * Изменяет содержимое файла  import_settings.php
 *
 * @param int $operation
 * @param bool $field
 * @param string $module_name
 * @param string $table_name_full
 * @param string $table_name_full_new
 * @param string $field_old
 * @param string $field_new
 * @return bool
 */
function updateTablesRecords($operation, $field, $module_name,  $table_name_full, $table_name_full_new=NULL, $field_old=NULL, $field_new=NULL) {
	GLOBAL $FILE_MANAGER, $MSGTEXT, $DATA;

	//формируем имя таблицы без префикса
	$prefix_len					= mb_strlen($module_name)+1;
	$tn_no_prefix				= mb_substr($table_name_full, $prefix_len);

	//если изменения произошли с полем
	if (isset($DATA['TABLES_DATA'][$tn_no_prefix])) {

		if ($field) {

			$datamassivNew				= array();
			switch ($operation) {
				case 0:  //удаление поля
				foreach ($DATA['TABLES_DATA'][$tn_no_prefix] as $dm) {

					$dm_new	= array();
					foreach ($dm as  $key=>$dm2) {
						if ($key !=$field_old) {
							$dm_new[$key]	= $dm2;
						}
					}
					$datamassivNew[]		= $dm_new;
				}
				break;

				case 2: //обновление поля
				foreach ($DATA['TABLES_DATA'][$tn_no_prefix] as $dm) {
					if (isset($dm[$field_old])) {
						$dm[$field_new]			= $dm[$field_old];
						unset($dm[$field_old]);
					}
					$datamassivNew[]			= $dm;
				}
				break;
			}

			$DATA['TABLES_DATA'][$tn_no_prefix]		= $datamassivNew;
		}
		//если изменения произошли с таблицей
		else {
			switch ($operation) {
				case 0:  //удаление таблицы
				unset($DATA['TABLES_DATA'][$tn_no_prefix]);
				break;

				case 2: //обновление таблицы
				//формируем имя новой таблицы без префикса
				$tn_no_prefix_new						= mb_substr($table_name_full_new, $prefix_len);
				$DATA['TABLES_DATA'][$tn_no_prefix_new]	= $DATA['TABLES_DATA'][$tn_no_prefix];
				unset($DATA['TABLES_DATA'][$tn_no_prefix]);
				break;
			}
		}
	}

	return true;
}



/**
 * обновляем настройки полей
 *
 * @param array $history
 * @param array $newModule
 * @param array $oldModule
 * @param string $old_table_prefix
 * @param string $new_table_prefix
 */
function updateTablesFieldsSettings($mysqladmin, $history, $newModule, $oldModule, $old_table_prefix, $new_table_prefix) {
	GLOBAL $mysql, $editError, $GENERAL_FUNCTIONS, $MODULES_PATH,$MODULES_PERFORMANCE_PATCH_NAME,$MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE31,  $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE7, $MYSQL_TABLE18, $MYSQL_TABLE12, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25,$MYSQL_CTR_TABLE26,$MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

	if (isset($history['field_settings']))
	foreach ($history['field_settings'] as $h_r) {

		switch ($h_r['operation']) {
			case 1: {//добавление настройки
				/*
				По факту настройка добавляется автоматом с полем, поэтому здесь ничего не делаем
				*/

				//удаляем из истории запись
				deleteHistoryById($h_r['id']);
				break;
			}
			case 2: {//изменение настройки
				$query		= "SELECT $MYSQL_CTR_TABLE25.*, $MYSQL_CTR_TABLE26.regex, $MYSQL_CTR_TABLE21.loaded_name, $MYSQL_CTR_TABLE18.loaded_name as `loaded_table_name`
									FROM `$MYSQL_CTR_TABLE25` LEFT JOIN `$MYSQL_CTR_TABLE26` ON ($MYSQL_CTR_TABLE25.check_regular_id=$MYSQL_CTR_TABLE26.id)  
									LEFT JOIN `$MYSQL_CTR_TABLE21` ON ($MYSQL_CTR_TABLE25.field_id=$MYSQL_CTR_TABLE21.id)  
									LEFT JOIN `$MYSQL_CTR_TABLE18` ON ($MYSQL_CTR_TABLE21.table_id=$MYSQL_CTR_TABLE18.id)  														
									WHERE $MYSQL_CTR_TABLE25.id='{$h_r['object_id']}'";

				$result		= $mysql->executeSQL($query);
				$f			= $mysql->fetchAssoc($result);

				$query								= "SELECT `loaded_name` FROM `$MYSQL_CTR_TABLE21` WHERE `id`='{$f['hide_by_field']}'";
				$result								= $mysql->executeSQL($query);
				if (list($hide_by_field_caption)	= $mysql->fetchRow($result)) $f['hide_by_field_caption']=$hide_by_field_caption;

				if ($f['regex']=='') $f['regex']	= $f['regex_other'];

				//берем id-таблицы
				$loaded_table_name	= $old_table_prefix.$f['loaded_table_name'];
				$query			= "SELECT `id` FROM  `$MYSQL_TABLE18` WHERE `table_name`='$loaded_table_name'";
				$result			= $mysqladmin->executeSQL($query);
				list($table_id)	= $mysqladmin->fetchRow($result);

				$f			= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($f);

				$query		= "UPDATE `$MYSQL_TABLE17` SET
									`active`='{$f['active']}',
									`show_in_list`='{$f['show_in_list']}',
									`filter`='{$f['filter']}',
									`regex`='{$f['regex']}',
									`height`='{$f['height']}',
									`width`='{$f['width']}',
									`style`='{$f['style']}',
									`hide_by_field_caption`='$hide_by_field_caption',
									`hide_operator`='{$f['hide_operator']}',
									`hide_on_value`='{$f['hide_on_value']}',
									`avator_quality`='{$f['avator_quality']}',
									`avator_width`='{$f['avator_width']}',
									`avator_height`='{$f['avator_height']}',
									`avator_quality_big`='{$f['avator_quality_big']}',
									`avator_width_big`='{$f['avator_width_big']}',
									`avator_height_big`='{$f['avator_height_big']}'										
		       	 					WHERE `fieldname`='{$f['loaded_name']}' AND `table_id`='{$table_id}'";		    

				$result		= $mysqladmin->executeSQL($query);

				//удаляем из истории запись
				deleteHistoryById($h_r['id']);
				break;
			}
		}
	}
}



/**
 * удаляет историю редактирования
 *
 * @param unknown_type $history_id
 */
function deleteHistoryById($history_id) {
	GLOBAL $mysql, $editError, $MYSQL_CTR_TABLE31, $MYSQL_TABLE18,$MYSQL_TABLE17, $MYSQL_TABLE12, $MYSQL_TABLE7, $MYSQL_TABLE6, $MYSQL_TABLE5;


}



/**
 * генерирует sql-запрос для обновления поля таблицы
 *
 * @param array $fields
 * @param string $table_name
 * @return array
 */
function get_on_query_forModify($table_name, $new_field, $operation_type) {
	GLOBAL   $mysql, $editError, $MYSQL_CTR_TABLE19;

	$pk				= 0;
	$unique			= 0;
	$notfedit		= 0;
	$f				= '';

	if ($operation_type!=0) {

		//проверяем, какие поля добавляем, а какие обновляем
		if (is_numeric($new_field['len']) || $new_field['datatype_id']==24 || $new_field['datatype_id']==25) $len="({$new_field['len']})";
		else $len='';

		if ((is_numeric($new_field['default']) || $new_field['datatype_id']==24 || $new_field['datatype_id']==25) && $new_field['default']!='') {
			$default=" DEFAULT '{$new_field['default']}'";
		}
		else $default='';

		if ($new_field['not_null']==0) $null=' NULL ';
		else $null=' NOT NULL ';

		if ($new_field['auto_incr']==1) $auto_incr=' AUTO_INCREMENT ';
		else $auto_incr='';

		if ($new_field['collation']!='') $collation=" COLLATE {$new_field['collation']} ";
		else $collation='';

		if ($new_field['unsigned']==1) $unsigned=' UNSIGNED ';
		else $unsigned='';

		if ($new_field['zerofill']==1) $zerofill=' ZEROFILL ';
		else $zerofill='';

		$pk			= $new_field['pk'];
		$unique		= $new_field['unique'];
		$notfedit	= $new_field['notfedit'];
	}

	switch ($operation_type) {
		case 0: { //удаление
			$f=SETTINGS_NEW_LINE."DROP COLUMN `{$new_field['loaded_name']}`";
			break;
		}
		case 1: { //добавление
			$f=SETTINGS_NEW_LINE."ADD COLUMN `{$new_field['fieldname']}` {$new_field['datatype']} $len $default $unsigned $zerofill $null $collation $auto_incr ";
			break;
		}
		case 2: { //обновление
			$f=SETTINGS_NEW_LINE."CHANGE `{$new_field['loaded_name']}` `{$new_field['fieldname']}` {$new_field['datatype']} $len $default $unsigned $zerofill $null $collation $auto_incr";
			break;
		}
	}

	if ($auto_incr!='') $r['auto_incr']		= 1;
	else $r['auto_incr']	= 0;
	$r['unique']			= $unique;
	$r['notfedit']			= $notfedit;
	$r['pk']				= $pk;
	$r['fieldname']			= $new_field['fieldname'];
	$r['loaded_name']		= $new_field['loaded_name'];
	$r['sql']				= $f;

	return $r;
}



/**
 * генерирует sql-запрос для обновления поля таблицы
 *
 * @param array $fields
 * @param string $table_name
 * @return array
 */
function get_on_query_forModify2($table_name, $new_fields, $old_fields) {
	GLOBAL   $MYSQL_CTR_TABLE19;

	$pk				= '';
	$f				= '';

	foreach ($old_fields as $old_field) {
		$delete	= true;
		foreach ($new_fields as $new_field) {
			if ($old_field['fieldname']==$new_field['loaded_name']) {
				$delete = false;
				break;
			}
		}
		if ($delete)	 {
			$f.=SETTINGS_NEW_LINE."DROP COLUMN `{$old_field['fieldname']}`,";
		}
	}

	foreach ($new_fields as $k=>$new_field) {
		$add	= true;

		//проверяем, какие поля удаляем
		foreach ($old_fields as $old_field) {
			if ($old_field['fieldname']==$new_field['loaded_name']) {
				$add=false;
				break;
			}
		}

		//проверяем, какие поля добавляем, а какие обновляем
		if (is_numeric($new_field['len'])) $len="({$new_field['len']})";
		else $len='';

		if (is_numeric($new_field['default'])) {
			$default=" DEFAULT '{$new_field['default']}'";
		}
		else $default='';

		if ($new_field['not_null']==0) $null=' NULL ';
		else $null=' NOT NULL ';

		if ($new_field['auto_incr']==1) $auto_incr=' AUTO_INCREMENT ';
		else $auto_incr='';

		if ($new_field['collation']!='') $collation=" COLLATE {$new_field['collation']} ";
		else $collation='';

		if ($new_field['pk']==1) $pk.="`{$new_field['fieldname']}`,";
		///else $pk='';

		if ($new_field['unsigned']==1) $unsigned=' UNSIGNED ';
		else $unsigned='';

		if ($new_field['zerofill']==1) $zerofill=' ZEROFILL ';
		else $zerofill='';

		if ($add)	{
			if ($k==0) {
				if (count($new_fields)>1) $ins_field_rul=' FIRST '.$new_fields[$k+1]['fieldname'];
				else $ins_field_rul='';
			}
			else {
				$ins_field_rul=' AFTER '.$new_fields[$k-1]['fieldname'];
			}

			$f.=SETTINGS_NEW_LINE."ADD COLUMN `{$new_field['fieldname']}` {$new_field['datatype']} $len $default $unsigned $zerofill $null $collation $auto_incr $ins_field_rul,";
		}
		else {
			$f.=SETTINGS_NEW_LINE."CHANGE `{$new_field['loaded_name']}` `{$new_field['fieldname']}` {$new_field['datatype']} $len $default $unsigned $zerofill $null $collation $auto_incr FIRST ,";
		}
	}


	if ($pk!='')	 $pk='drop primary key,  add primary key('.mb_substr($pk,0,-1).')';

	$sql="ALTER TABLE `$table_name` ".$f.$pk;

	if ($pk=='') $sql = mb_substr($sql,0,-1);

	return $sql;
}



/**
 * Создаёт запрос обновления поля
 *
 * @param array $sql_alter
 * @param object $mysqladmin
 * @param string $table_name
 * @return bool
 */
function alterSQL($sql_alter, $mysqladmin, $table_name) {
	GLOBAL $mysql, $editError, $MSGTEXT;

	$sql				= $sql_alter['sql'];

	//берем все ключи таблицы
	$query				= "SHOW KEYS FROM `$table_name`";
	$result				= $mysqladmin->executeSQL($query);
	$current_keys		= $mysqladmin->fetchAssocAll($result);

	//проверяем нужно ли добавить или удалить первичный ключ
	$drop_pk_need		= '';
	$add_pk_need		= '';

	if ($sql_alter['pk']==1) {

		foreach ($current_keys AS $c) {
			if (isset($c['Key_name']) && $c['Key_name']=='PRIMARY') {
				$drop_pk_need	= ', DROP PRIMARY KEY';
				break;
			}
		}

		$add_pk_need	=  ", ADD PRIMARY KEY ({$sql_alter['fieldname']})";
	}

	$pk		= $drop_pk_need.$add_pk_need;

	//проверяем нужно ли добавить или удалить уникальный ключ
	$drop_unique_need		= '';
	$add_unique_need		= '';
	if ($sql_alter['unique']==0) {
		foreach ($current_keys AS $row) {
			if (isset($row['Non_unique']) && $row['Key_name']==$sql_alter['fieldname'] && $row['Non_unique']==0) {
				$drop_unique_need	=  ", DROP KEY `{$row['Key_name']}`";
				break;
			}
		}
	}
	else {
		//проверяем нужно ли добавить новый индекс
		$flag=true;
		foreach ($current_keys AS $row) {
			if (isset($row['Non_unique']) && $row['Non_unique']==0 && $row['Key_name']==$sql_alter['fieldname']) {
				$flag	= false;
				break;
			}
		}

		if ($flag) {
			//проверяем нужно ли удалить старый индекс
			foreach ($current_keys AS $row) {
				if (isset($row['Non_unique']) && $row['Non_unique']==0 && $row['Key_name']==$sql_alter['loaded_name']) {
					$drop_unique_need	=  ", DROP KEY `{$row['Key_name']}`";
					break;
				}
			}

			$add_unique_need	=  ", ADD UNIQUE `{$sql_alter['fieldname']}` (`{$sql_alter['fieldname']}`)";
		}
	}

	$unique			= $drop_unique_need.$add_unique_need;

	$query			= "ALTER TABLE `$table_name` $sql $pk $unique";
	if ($result		= $mysqladmin->executeSQL($query)) return true;
	else {
		$erCode=$mysqladmin->getErrorCode();
		if  ($erCode==1265 || $erCode==1264)  {
			$editError[] = sprintf($MSGTEXT['mod_constructor_no_change_type'], $sql_alter['fieldname'], $table_name);
		}
		elseif ($erCode==1062)  {
			$editError[] = sprintf($MSGTEXT['mod_constructor_no_change_uniq'], $sql_alter['fieldname'], $table_name);
		}
		else {
			$editError[] = sprintf($MSGTEXT['mod_constructor_error_number'], $erCode);
		}

		return false;
	}
}



/**
 * Возвращает поле таблицы для сохранения в админзону
 *
 * @param int $f_id
 * @return array
 */
function getTableField($f_id) {
	GLOBAL $mysql, $MODULES_PATH,$MODULES_PERFORMANCE_PATCH_NAME,$MYSQL_CTR_TABLE23,$MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE20,$MYSQL_CTR_TABLE19, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE7, $MYSQL_TABLE18, $MYSQL_TABLE12, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25,$MYSQL_CTR_TABLE26,$MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

	$fields_settings	= array();
	$query				= "SELECT $MYSQL_CTR_TABLE25.*, $MYSQL_CTR_TABLE20.datatype, $MYSQL_CTR_TABLE19.collation, f.table_id, f.loaded_name,  f.edittype_id, f.fieldname, f.comment, f.sourse_field_id, f.delete, f.own_filter, f.datatype_id, f.len, f.default, f.collation_id, f.group_caption, f.not_null, f.unsigned, f.zerofill, f.unique, f.notfedit, f.auto_incr,  f.pk , f.sort_index
		    			FROM `$MYSQL_CTR_TABLE21`  as `f` LEFT JOIN  `$MYSQL_CTR_TABLE25` ON ($MYSQL_CTR_TABLE25.field_id=f.id)
		    			LEFT JOIN `$MYSQL_CTR_TABLE20` ON (f.datatype_id=$MYSQL_CTR_TABLE20.id)
		    			LEFT JOIN `$MYSQL_CTR_TABLE19` ON (f.collation_id=$MYSQL_CTR_TABLE19.id)		    			
						WHERE f.id='$f_id'";

	$result		= $mysql->executeSQL($query);
	$fields		= $mysql->fetchAssoc($result);


	//формируем имя подгружаемого поля и таблицы
	if ($fields['sourse_field_id']>0) {		
		$query		= "SELECT t.fieldname, t2.name, t3.name AS `module_name` 
		FROM `$MYSQL_CTR_TABLE21` AS `t` LEFT JOIN `$MYSQL_CTR_TABLE18` AS `t2` ON (t2.id=t.table_id)
		LEFT JOIN `$MYSQL_CTR_TABLE17` AS `t3` ON (t3.id=t2.module_id)
		WHERE t.id='{$fields['sourse_field_id']}'";
		
		$result		= $mysql->executeSQL($query);
		list($fields['sourse_field_name'],$fields['sourse_table_name'], $module_name)		= $mysql->fetchRow($result);
		
		//формируем полное название таблицы		
		$tbl_prefix	= mb_strtolower($module_name).'_';
		$fields['sourse_table_name']=$tbl_prefix.$fields['sourse_table_name'];
	}
	else {
		$fields['sourse_field_name']='';
		$fields['sourse_table_name']='';
	}

	if ($fields['hide_by_field']>0) {
		$query									= "SELECT `fieldname` FROM  `$MYSQL_CTR_TABLE21` WHERE `id`='{$fields['hide_by_field']}'";
		$result									= $mysql->executeSQL($query);
		list($fields['hide_by_field_caption'])	= $mysql->fetchRow($result);
	}
	else $fields['hide_by_field_caption']	= '';

	if (!is_numeric($fields['active']))  			$fields['active']			= 1;
	if (!is_numeric($fields['show_in_list']))  		$fields['show_in_list']		= 1;
	if (!is_numeric($fields['check_regular_id']))  	$fields['check_regular_id']	= 0;
	if (!is_numeric($fields['hide_operator']))  	$fields['hide_operator']	= 0;


	$query				= "SELECT `regex` FROM `$MYSQL_CTR_TABLE26` WHERE `id`='{$fields['check_regular_id']}'";
	$result				= $mysql->executeSQL($query);
	if (!list($fields['regex'])	= $mysql->fetchRow($result)) {
		$fields['regex']	= $fields['regex_other'];
	}

	return $fields;
}



/**
 * создает один исполнительный блок
 *
 * @param array $block
 */
function createOnePerformanceBlock($block, $newModule) {
	GLOBAL $editError, $smartyTemp, $FILE_MANAGER, $MSGTEXT, $MYSQL_CTR_TABLE25, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE22, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE26, $MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

	$smartyTemp->assign('module', 					$newModule);
	$smartyTemp->assign('block', 					$block);
	$out = $smartyTemp->fetch('compiler/performance_block.tpl');

	//запись в файл
	$file_new	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name']."/performance/{$block['name']}.php";
	if ($fd		= $FILE_MANAGER->fopen($file_new, 'w')) {
		fwrite($fd, $out);
		fclose($fd);
	}
	else {
		$editError[]='Нет прав на запись в файл '.$file_new;
	}

	//создаем папку для шаблонов
	$tpl_dir=$_SERVER['DOCUMENT_ROOT'].'/modules/'.$newModule['name']."/performance/{$block['name']}Templates/";
	if (!$FILE_MANAGER->mkdir($tpl_dir, SETTINGS_CHMOD_FOLDERS)) $editError[]= sprintf($MSGTEXT['mod_constructor_err_createdir'], $tpl_dir);
}



/**
 * Сохраняем запрос для восстановления
 *
 * @param string $restore_query
 */
function addSqlToHistory($restore_query) {
	GLOBAL $mysql, $MYSQL_CTR_TABLE24;
	$restore_query=addslashes($restore_query);

	//проверяем, чтоб небыло 2 одинаковых запросов
	$module_id		= $_SESSION['___GoodCMS']['m_id'];

	$query			= "SELECT count(*) FROM `$MYSQL_CTR_TABLE24` WHERE `module_id`='$module_id' AND `restore_query`='$restore_query'";
	$result			= $mysql->executeSQL($query);
	list($is_ex)	= $mysql->fetchRow($result);

	if ($is_ex==0) {
		$query		= "INSERT INTO `$MYSQL_CTR_TABLE24` (`module_id`, `restore_query`) VALUES ('$module_id', '$restore_query')";
		$result		= $mysql->executeSQL($query);
	}

}



/**
 * Выполняем запросы восстановления
 *
 */
function restoreHistoryQuery() {
	GLOBAL $mysql, $MYSQL_CTR_TABLE24;

	$module_id				= $_SESSION['___GoodCMS']['m_id'];

	$query					= "SELECT * FROM `$MYSQL_CTR_TABLE24` WHERE `module_id`='$module_id' ";
	$result					= $mysql->executeSQL($query);
	$restore_queries		= $mysql->fetchAssocAll($result);

	foreach ($restore_queries as $q) {
		$query				= $q['restore_query'];
		$result				= $mysql->executeSQL($query);
	}
}


/**
 * Очищаем таблицу, где храняться сохранённые запросы восстановления
 *
 */
function cleaneHistoryQuery() {
	GLOBAL $mysql, $MYSQL_CTR_TABLE24;

	$module_id			= $_SESSION['___GoodCMS']['m_id'];
	$query				= "DELETE FROM `$MYSQL_CTR_TABLE24` WHERE `module_id`='$module_id' ";
	$result				= $mysql->executeSQL($query);
}

?>