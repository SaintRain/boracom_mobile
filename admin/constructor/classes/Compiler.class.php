<?php
/**
 * компилятор модуля
 *
 */
class Compiler  {

	/**
	 * смарти-класс
	 * @var class
	 */
	public		$smarty;

	/**
	 * смарти-класс
	 * @var class
	 */
	public		$smartyTemp;

	/**
     * переменные из массива $_POST с заменёнными символами
     *
     * @var array
     */
	public		$post;

	/**
     *  переменные из массива $_POST (спец символы не заменены)
     *
     * @var array
     */
	public		$postr;

	/**
     * переменные из массива $_GET с заменёнными символами
     *
     * @var unknown_type
     */
	public		$get;

	/**
     *  переменные из массива $_GET (спец символы не заменены)
     *
     * @var array
     */
	public		$getr;

	/**
   	 * класс для работы с MYSQL
   	 *
   	 * @var class
   	 */
	public		$mysql;

	/**
     * сообщения об ошибках
     *
     * @var array
     */
	public 		$editError;

	/**
     * id редактируемого модуля
     *
     * @var int
     */
	public	 	$m_id;

	/**
     * параметры компиляции
     *
     * @var array
     */
	public	 	$parameters;

	/**
     * свойства модуля
     *
     * @var array
     */
	public	 	$module;


	/**
     * Конструктор
     * 
     * @param class $smarty
     */
	function Compiler($mysql, $smarty, $post, $postr, $get, $getr,  $do) {
		GLOBAL $MSGTEXT;

		$this->mysql		= $mysql;
		$this->smarty		= $smarty;
		$this->smartyTemp	= $this->smarty;
		$this->post			= $post;
		$this->get			= $get;
		$this->postr		= $postr;
		$this->getr			= $getr;

		if (isset($_SESSION['___GoodCMS']['m_id'])) {
			$this->m_id		= $_SESSION['___GoodCMS']['m_id'];

			switch ($do):
			case ('list'):					$this->getCompilerForm(); 		break;
			case ('compile'):				$this->compile();	 			break;
			endswitch;
		}
		else {
			$this->editError	= $MSGTEXT['error_accsess_to_constructor'];

			$this->smarty->assign('errors',	$this->editError);
			$this->smarty->assign('content_template',	'errors/errors_list.tpl');
		}
	}



	/**
	 * параметры компиляции
	 *
	 */
	function getCompilerForm() {
		GLOBAL $FILE_MANAGER, $SAVE_COMPILED_MODULE_PATCH_NAME, $MSGTEXT,$MYSQL_TABLE5, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE23;

		//проверяем, чтоб конструктор корректно  работал с файлами
		if (ini_get('safe_mode')) {
			if (extension_loaded('ftp')) {
				if ($FILE_MANAGER->connect()) {
					$FILE_MANAGER->close();
					$file_mode_check=true;
				}
				else $file_mode_check=false;
			}
			else $file_mode_check=false;
		}
		else $file_mode_check=true;


		if (!$file_mode_check) {
			$this->editError[] = $MSGTEXT['compiler_fmode_error'];
		}


		$query		= "SELECT `id`,`name` FROM `$MYSQL_CTR_TABLE23` WHERE `module_id`='{$this->m_id}'";
		$result		= $this->mysql->executeSQL($query);
		$blocks		= $this->mysql->fetchAssocAll($result);

		$sql		= '';
		$query		= "SELECT $MYSQL_CTR_TABLE18.* FROM `$MYSQL_CTR_TABLE18` WHERE $MYSQL_CTR_TABLE18.module_id='{$this->m_id}' ";
		$result		= $this->mysql->executeSQL($query);
		$tables		= $this->mysql->fetchAssocAll($result);

		for ($i=0; $i<count($tables); $i++) {

			$query		= "SELECT   f.*,  $MYSQL_CTR_TABLE20.datatype FROM  `$MYSQL_CTR_TABLE21` as `f`, `$MYSQL_CTR_TABLE20` WHERE f.table_id='{$tables[$i]['id']}' AND $MYSQL_CTR_TABLE20.id=f.datatype_id ";
			$result		= $this->mysql->executeSQL($query);
			$fields		= $this->mysql->fetchAssocAll($result);

			$pk_incr_in_table=false;
			foreach ($fields AS $ar) {
				if ($ar['pk']==1 && $ar['auto_incr']==1) $pk_incr_in_table=true;


				if ($ar['edittype_id']==4 && $ar['datatype_id']!=1 && $ar['datatype_id']!=3 && $ar['datatype_id']!=8)
				$this->editError[]		= sprintf($MSGTEXT['compiler_badf_for_m'], '?act=t_c&do=edit&t_id='.$tables[$i]['id'], $tables[$i]['name'], $ar['fieldname']);
			}

			if (!$pk_incr_in_table)	  {
				$this->editError[]		= sprintf($MSGTEXT['compiler_in_table_no_primary_key'], '?act=t_c&do=edit&t_id='.$tables[$i]['id']);
			}
		}

		$query				= "SELECT `name` FROM `$MYSQL_CTR_TABLE17` WHERE `id`='{$this->m_id}'";
		$result				= $this->mysql->executeSQL($query);
		list($module_name)	= $this->mysql->fetchRow($result);

		//проверяем возможность записи в папку
		if (!is_writeable($SAVE_COMPILED_MODULE_PATCH_NAME)) {
			$this->editError[]	= sprintf($MSGTEXT['compiler_error_module_write'], $SAVE_COMPILED_MODULE_PATCH_NAME);
		}

		//Берем из админку всю информацию об редактируемом модуле
		$mysqladmin 	= $this->getMysqlObjectForAdmin();

		//проверяем, чтоб не перезаписать подключенный модуль в админке с таким же именем
		$query				= "SELECT count(*) FROM `$MYSQL_TABLE5` WHERE `name`='{$module_name}'";
		$result				= $mysqladmin->executeSQL($query);
		list($is_exists)	= $mysqladmin->fetchRow($result);
		if ($is_exists>0) {
			$this->editError[]=sprintf($MSGTEXT['compiler_error_module_is_set'], $module_name);
		}

		//проверяем, чтоб не перезаписать случайно модуль
		//$perezapisat	= false;
		if ($is_exists==0 && file_exists($SAVE_COMPILED_MODULE_PATCH_NAME.$module_name) ) {
			if (isset($this->post['perezapisat']) && $this->post['perezapisat']==1) {
				$flag=false;
			}
			else $flag=true;

			if ($flag)	{
				$this->editError[]	= sprintf($MSGTEXT['compiler_error_module_is_exists'], $module_name);
				$perezapisat=true;
			}
		}

		$this->smarty->assign('content_template',	'compiler/compiler_form.tpl');
		$this->smarty->assign('m_id',				$this->m_id);
		$this->smarty->assign('editError',			$this->editError);
		if (isset($perezapisat)) $this->smarty->assign('perezapisat',		$perezapisat);

		$this->smarty->assign('content_head',		$MSGTEXT['compiler_option_compile'].' «<a href="?act=m_c&m_id='.$this->m_id.'">'.$module_name.'</a>»');
	}



	/**
     * параметры
     *
     */
	function parameters() {
		if (isset($this->post['drop_tables']))  		$this->parameters['drop_tables']=$this->post['drop_tables'];
		else {
			$this->parameters['drop_tables']=0;
		}
	}



	/**
     * компиляция модуля
     *
     */
	function compile() {
		GLOBAL $CMSProtection, $FILE_MANAGER, $GENERAL_FUNCTIONS, $SAVE_COMPILED_MODULE_PATCH_NAME, $MSGTEXT, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE23;

		//проверка лицензии на конструктор
		if (!$activated						= $CMSProtection->checkActivationConstructor()) {
			$this->editError[]				= $MSGTEXT['edit_data_need_to_by_ctr'];
			$this->smarty->assign('content_template',	'errors/errors_list.tpl');
			$this->smarty->assign('content_head',		$MSGTEXT['compiler_ress_compile'].' «<a href="?act=m_c&m_id='.$this->m_id.'">'.$this->module['name'].'</a>»');
			$this->smarty->assign('errors',				$this->editError);
		}
		else {

			//считываем текущее время начала компиляции
			$start_time 	= microtime();
			$start_array 	= explode(' ', $start_time);
			$start_time 	= $start_array[1] + $start_array[0];

			$query			= "SELECT * FROM `$MYSQL_CTR_TABLE17` WHERE `id`='{$this->m_id}'";
			$result			= $this->mysql->executeSQL($query);
			$this->module	= $this->mysql->fetchAssoc($result);

			$this->parameters();

			$ar				= $this->dumpBD();

			//создаем папки
			if (!is_dir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/")) $FILE_MANAGER->mkdir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/", SETTINGS_CHMOD_FOLDERS);
			if (!is_dir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/performance/")) $FILE_MANAGER->mkdir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/performance/", SETTINGS_CHMOD_FOLDERS);
			if (!is_dir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/")) $FILE_MANAGER->mkdir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/", SETTINGS_CHMOD_FOLDERS);
			if (!is_dir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/storage/")) $FILE_MANAGER->mkdir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/storage/", SETTINGS_CHMOD_FOLDERS);
			if (!is_dir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/storage/files/")) $FILE_MANAGER->mkdir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/storage/files/", SETTINGS_CHMOD_FOLDERS);
			if (!is_dir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/storage/images/")) $FILE_MANAGER->mkdir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/storage/images/", SETTINGS_CHMOD_FOLDERS);
			if (!is_dir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/import_settings/")) $FILE_MANAGER->mkdir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/import_settings/", SETTINGS_CHMOD_FOLDERS);

			$this->createPerformanceBlocks();

			$this->createManagmentBlocks();

			$DATA['BDSTRUCTURE']			= $ar['sql'];
			$DATA['BLOCKS']					= $ar['blocks'];
			$DATA['TABLES']					= $ar['tables'];
			$DATA['MODULE']					= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($this->module);

			//формируем массив с данными модуля
			$this->smartyTemp->assign('data', var_export($DATA, true));
			$DATA_CONTENT=$this->smartyTemp->fetch('compiler/import_settings.tpl');


			$fd	= $FILE_MANAGER->fopen("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/import_settings/import_settings.php", 'w');
			fwrite($fd, $DATA_CONTENT);
			fclose($fd);

			//создаём библиотеку модуля
			$this->smartyTemp->assign('module', $this->module);
			$library_content	= $this->smartyTemp->fetch('compiler/library.tpl');

			$fd	= $FILE_MANAGER->fopen("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/{$this->module['name']}.php", 'w');
			fwrite($fd, $library_content);
			fclose($fd);

			//создаем файл защиты
			$htaccess	= $this->smartyTemp->fetch('compiler/.htaccess.tpl');
			$fd			= $FILE_MANAGER->fopen("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/import_settings/.htaccess", 'w');
			fwrite($fd, $htaccess);
			fclose($fd);

			//создаем файл защиты от выполнения шелов
			$htaccess2	= $this->smartyTemp->fetch('compiler/management_.htaccess.tpl');
			$fd			= $FILE_MANAGER->fopen("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/.htaccess", 'w');
			fwrite($fd, $htaccess2);
			fclose($fd);

			//создаем файл защиты от выполнения шелов
			$htaccess3	= $this->smartyTemp->fetch('compiler/perfomance_.htaccess.tpl');
			$fd			= $FILE_MANAGER->fopen("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/performance/.htaccess", 'w');
			fwrite($fd, $htaccess3);
			fclose($fd);

			//создаём init файл
			$CMSProtection->createInit($this->module['name'], "{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/import_settings");

			//берем статистику
			$query								= "SELECT count(*) FROM `$MYSQL_CTR_TABLE18` WHERE `module_id`='{$this->m_id}'";
			$result								= $this->mysql->executeSQL($query);
			list($statistics['tables_total'])	= $this->mysql->fetchRow($result);

			$query								= "SELECT count(*) FROM `$MYSQL_CTR_TABLE23` WHERE `module_id`='{$this->m_id}'";
			$result								= $this->mysql->executeSQL($query);
			list($statistics['blocks_total'])	= $this->mysql->fetchRow($result);

			$all_p		= $this->searchdirSimple("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/");
			$statistics['file_total']=count($all_p);

			// вычитаем из конечного времени начальное
			$end_time 			= microtime();
			$end_array 			= explode(' ',$end_time);
			$end_time 			= $end_array[1] + $end_array[0];
			$statistics['time'] = round( $end_time - $start_time, 4);

			$this->smarty->assign('content_head',		$MSGTEXT['compiler_ress_compile'].' «<a href="?act=m_c&m_id='.$this->m_id.'">'.$this->module['name'].'</a>»');
			$this->smarty->assign('module_name',		$this->module['name']);
			$this->smarty->assign('statistics',			$statistics);
			$this->smarty->assign('content_template',	'compiler/result.tpl');
		}
	}



	/**
	 * создает административнуя часть модуля
	 *
	 */
	function createManagmentBlocks() {
		GLOBAL  $FILE_MANAGER, $SAVE_COMPILED_MODULE_PATCH_NAME, $MYSQL_CTR_TABLE25, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE22, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE26, $MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

		$save_images_to_dir = $SAVE_COMPILED_MODULE_PATCH_NAME.$this->module['name'].'/management/storage/images';
		$save_files_to_dir 	= $SAVE_COMPILED_MODULE_PATCH_NAME.$this->module['name'].'/management/storage/files';

		$query				= "SELECT *  FROM `$MYSQL_CTR_TABLE18` WHERE `module_id`='{$this->m_id}'";
		$result				= $this->mysql->executeSQL($query);
		$tables				= $this->mysql->fetchAssocAll($result);

		//создаём папки для хранения файлов
		if (count($tables)>0) {
			$storage_patch	= false;
			for ($i2=0; $i2<count($tables); $i2++) {

				//берем поля таблицы
				$query		= "SELECT * FROM `$MYSQL_CTR_TABLE21` WHERE `table_id`='{$tables[$i2]['id']}'";
				$result		= $this->mysql->executeSQL($query);
				$fields		= $this->mysql->fetchAssocAll($result);

				for ($i3=0; $i3<count($fields); $i3++) {
					if ($fields[$i3]['sourse_field_id']>0) {
						$query		= "SELECT `table_id` FROM `$MYSQL_CTR_TABLE21` WHERE `id`='{$fields[$i3]['sourse_field_id']}'";
						$result		= $this->mysql->executeSQL($query);
						$fields[$i3]['sourse_table_id']	= $this->mysql->fetchRow($result);
					}

					//берем настройки полей
					$query				= "SELECT $MYSQL_CTR_TABLE25.*, $MYSQL_CTR_TABLE26.regex FROM `$MYSQL_CTR_TABLE25`
					LEFT JOIN `$MYSQL_CTR_TABLE26`  ON $MYSQL_CTR_TABLE26.id=$MYSQL_CTR_TABLE25.check_regular_id WHERE $MYSQL_CTR_TABLE25.field_id='{$fields[$i3]['id']}'";												

					$result							= $this->mysql->executeSQL($query);
					$fields[$i3]['fields_settings']	= $this->mysql->fetchAssoc($result);

					if ($fields[$i3]['edittype_id']==9 || $fields[$i3]['edittype_id']==10 || $fields[$i3]['edittype_id']==11 || $fields[$i3]['edittype_id']==12) {
						$storage_patch	= true;
					}
				}

				$tables[$i2]['fields']		= $fields;
			}

			//создаем папки, где будут хранится файлы закачки
			if ($storage_patch) {
				if (!is_dir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/storage/")) 				$FILE_MANAGER->mkdir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/storage/", 					SETTINGS_CHMOD_FOLDERS);
				if (!is_dir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/storage/files/")) 		$FILE_MANAGER->mkdir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/storage/files/", 			SETTINGS_CHMOD_FOLDERS);
				if (!is_dir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/storage/images/")) 		$FILE_MANAGER->mkdir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/management/storage/images/", 			SETTINGS_CHMOD_FOLDERS);

				for ($i2=0; $i2<count($tables); $i2++) {
					$fields	= $tables[$i2]['fields'];
					for ($i3=0; $i3<count($fields); $i3++) {

						//создаем папки, где будут храниться картинки
						if ($fields[$i3]['edittype_id']==9 || $fields[$i3]['edittype_id']==10) {
							if (!is_dir($save_images_to_dir.'/'.$tables[$i2]['name'])) {
								$FILE_MANAGER->mkdir($save_images_to_dir.'/'.$tables[$i2]['name'], SETTINGS_CHMOD_FOLDERS);
							}

							if (!is_dir($save_images_to_dir.'/'.$tables[$i2]['name'].'/'.$fields[$i3]['fieldname'])) {
								$FILE_MANAGER->mkdir($save_images_to_dir.'/'.$tables[$i2]['name'].'/'.$fields[$i3]['fieldname'], SETTINGS_CHMOD_FOLDERS);
							}

							if ($fields[$i3]['edittype_id']==9) {
								if (!is_dir($save_images_to_dir.'/'.$tables[$i2]['name'].'/'.$fields[$i3]['fieldname'].'/preview')) {
									$FILE_MANAGER->mkdir($save_images_to_dir.'/'.$tables[$i2]['name'].'/'.$fields[$i3]['fieldname'].'/preview', SETTINGS_CHMOD_FOLDERS);
								}
							}
						}

						//создаем папки, где будут храниться файлы
						if ($fields[$i3]['edittype_id']==11 || $fields[$i3]['edittype_id']==12) {
							if (!is_dir($save_files_to_dir.'/'.$tables[$i2]['name'])) {
								$FILE_MANAGER->mkdir($save_files_to_dir.'/'.$tables[$i2]['name'], SETTINGS_CHMOD_FOLDERS);
							}

							if (!is_dir($save_files_to_dir.'/'.$tables[$i2]['name'].'/'.$fields[$i3]['fieldname'])) {
								$FILE_MANAGER->mkdir($save_files_to_dir.'/'.$tables[$i2]['name'].'/'.$fields[$i3]['fieldname'], SETTINGS_CHMOD_FOLDERS);
							}
						}
					}
				}
			}
		}

	}



	/**
	 * создает один исполнительный блок
	 *
	 * @param unknown_type $block
	 */
	function createOnePerformanceBlock($block, $tpl_only=false) {
		GLOBAL  $FILE_MANAGER, $SAVE_COMPILED_MODULE_PATCH_NAME, $MYSQL_CTR_TABLE25, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE22, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE26, $MYSQL_CTR_TABLE28,  $MYSQL_CTR_TABLE30;

		if (!$tpl_only)	{

			$this->smartyTemp->assign('module', 				$this->module);
			$this->smartyTemp->assign('block', 					$block);
			$out = $this->smartyTemp->fetch('compiler/performance_block.tpl');

			//запись в файл
			$fd	= $FILE_MANAGER->fopen("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/performance/{$block['name']}.php", 'w');
			fwrite($fd, $out);
			fclose($fd);
		}

		//создание файлов-шаблонов
		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE30` WHERE `block_id`='{$block['id']}' ORDER BY `sort_index`";
		$result		= $this->mysql->executeSQL($query);
		$templates	= $this->mysql->fetchAssocAll($result);

		if (!is_dir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/performance/{$block['name']}Templates/")) $FILE_MANAGER->mkdir("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/performance/{$block['name']}Templates/", SETTINGS_CHMOD_FOLDERS);
		for ($i2=0; $i2<count($templates); $i2++) {

			$fd=$FILE_MANAGER->fopen("{$SAVE_COMPILED_MODULE_PATCH_NAME}{$this->module['name']}/performance/{$block['name']}Templates/{$templates[$i2]['name']}", 'w');
			fwrite($fd, $templates[$i2]['content']);
			fclose($fd);
		}
	}



	/**
	 * создает исполнительную часть модуля
	 *
	 */
	function createPerformanceBlocks() {
		GLOBAL  $FILE_MANAGER,$SAVE_COMPILED_MODULE_PATCH_NAME, $MSGTEXT, $GENERAL_FUNCTIONS, $MYSQL_CTR_TABLE25, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE22, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE26, $MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE23` WHERE `module_id`='{$this->m_id}'";
		$result		= $this->mysql->executeSQL($query);
		$blocks		= $this->mysql->fetchAssocAll($result);

		$pattern 	= '/\/\*[\S\s\w\W]{0,}\/\/\/\s*class\s*[0-9A-z]*\s*{/u';

		for ($i=0; $i<count($blocks); $i++) {
			$tpl_only	= false;
			if ($this->module['loaded']==1) {
				$source_file	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$this->module['loaded_name']."/performance/{$blocks[$i]['loaded_name']}.php";
				$copied_file	= $SAVE_COMPILED_MODULE_PATCH_NAME.$this->module['name']."/performance/{$blocks[$i]['name']}.php";
				if (is_file($source_file)) {
					if ($FILE_MANAGER->copy($source_file, 	$copied_file)) {
						$block_file_content	= $FILE_MANAGER->getfile($copied_file);

						$this->smartyTemp->assign('module', $this->module);
						$this->smartyTemp->assign('block', $blocks[$i]);
						$block_head 		= $this->smartyTemp->fetch('compiler/performance_block_head.tpl');

						$block_file_content	= preg_replace($pattern, $block_head, $block_file_content);


						$fd	= $FILE_MANAGER->fopen($copied_file, 'w');
						fwrite($fd, $block_file_content);
						fclose($fd);

						$tpl_only=true;
					}
					else $this->editError[]= sprintf($MSGTEXT['compiler_error_copy'], $source_file,$copied_file);
				}
			}
			$this->createOnePerformanceBlock($blocks[$i], $tpl_only);
		}
	}



	/**
     * создание дампа базы данных
     *
     */
	function dumpBD() {
		GLOBAL  $MYSQL_CTR_TABLE25,$MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE19, $MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE22, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE26,$MYSQL_CTR_TABLE30,$MYSQL_CTR_TABLE28;

		//формируем дамп таблиц модуля
		$sql		= array();
		$query		= "SELECT *, `name` AS `table_name` FROM `$MYSQL_CTR_TABLE18` WHERE `module_id`='{$this->m_id}'";
		$result		= $this->mysql->executeSQL($query);
		$tables		= $this->mysql->fetchAssocAll($result);
		for ($i=0; $i<count($tables); $i++) {

			$query		= "SELECT   f.*, $MYSQL_CTR_TABLE20.datatype FROM  `$MYSQL_CTR_TABLE21` as `f`, `$MYSQL_CTR_TABLE20` WHERE f.table_id='{$tables[$i]['id']}' AND $MYSQL_CTR_TABLE20.id=f.datatype_id ORDER BY f.sort_index DESC";
			$result		= $this->mysql->executeSQL($query);
			$fields		= $this->mysql->fetchAssocAll($result);

			$fields2	= array();
			$tmp		= array();
			foreach ($fields AS $ar) {
				foreach ($ar AS $k=>$v) {
					if ($k!='len') $tmp[$k]	= addslashes($v);
					else $tmp[$k]=$v;
				}
				$fields2[]=$tmp;
			}

			$fields=$fields2;

			//добавляем в запрос перед вставкой удаление таблицы
			if ($this->parameters['drop_tables']==1) $sql[$tables[$i]['name']][]	= "DROP TABLE IF EXISTS `{$tables[$i]['name']}`;";

			$sql[$tables[$i]['name']][]=$this->get_on_query($fields, $tables[$i]['name']);
		}

		//берем блоки
		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE23` WHERE `module_id`='{$this->m_id}'";
		$result		= $this->mysql->executeSQL($query);
		$blocks		= $this->mysql->fetchAssocAll($result);
		for ($i=0; $i<count($blocks); $i++) {
			//берем переменные блока
			$query						= "SELECT * FROM `$MYSQL_CTR_TABLE28` WHERE `block_id`='{$blocks[$i]['id']}'";
			$result						= $this->mysql->executeSQL($query);
			$blocks[$i]['settings']		= $this->mysql->fetchAssocAll($result);

			//берем шаблоны блока
			$query						= "SELECT $MYSQL_CTR_TABLE30.*, $MYSQL_CTR_TABLE23.name as `block_name` FROM `$MYSQL_CTR_TABLE30` LEFT JOIN (`$MYSQL_CTR_TABLE23`) ON ($MYSQL_CTR_TABLE23.id=$MYSQL_CTR_TABLE30.block_id) WHERE $MYSQL_CTR_TABLE30.block_id={$blocks[$i]['id']}  ORDER BY $MYSQL_CTR_TABLE30.block_id";
			$result						= $this->mysql->executeSQL($query);
			$blocks[$i]['templates']	= $this->mysql->fetchAssocAll($result);
		}

		//берем все таблицы модуля
		$block_tables		= $tables;
		//для каждой таблицы берем поля с настройками
		for ($n=0; $n<count($block_tables); $n++) {
			$fields_settings	= array();
			$query				= "SELECT $MYSQL_CTR_TABLE25.*, $MYSQL_CTR_TABLE26.regex,  f.edittype_id, f.fieldname, f.comment, f.sourse_field_id, f.delete, f.own_filter, f.datatype_id, f.len, f.default, f.collation_id, f.group_caption, f.not_null, f.unsigned,  f.auto_incr, f.zerofill, f.unique, f.notfedit,  f.pk , f.sort_index FROM `$MYSQL_CTR_TABLE21` as `f` LEFT JOIN `$MYSQL_CTR_TABLE25` ON ($MYSQL_CTR_TABLE25.field_id=f.id) LEFT JOIN  `$MYSQL_CTR_TABLE26` ON ($MYSQL_CTR_TABLE26.id=$MYSQL_CTR_TABLE25.check_regular_id) WHERE f.table_id='{$block_tables[$n]['id']}'";
			$result				= $this->mysql->executeSQL($query);
			$fields				= $this->mysql->fetchAssocAll($result);

			foreach ($fields as $v) {

				$v['table_name']=$block_tables[$n]['table_name'];

				if ($v['sourse_field_id']>0) {
					$query		= "SELECT $MYSQL_CTR_TABLE21.fieldname, $MYSQL_CTR_TABLE18.name, t3.name AS `module_name` FROM `$MYSQL_CTR_TABLE21`, `$MYSQL_CTR_TABLE18`
					LEFT JOIN `$MYSQL_CTR_TABLE17` AS `t3` ON (t3.id=$MYSQL_CTR_TABLE18.module_id AND t3.id!={$this->m_id})
					WHERE $MYSQL_CTR_TABLE21.id='{$v['sourse_field_id']}' AND $MYSQL_CTR_TABLE21.table_id=$MYSQL_CTR_TABLE18.id";
					$result		= $this->mysql->executeSQL($query);
					list($v['sourse_field_name'], $v['sourse_table_name'], $sourse_module_name) 		= $this->mysql->fetchRow($result);

					if ($sourse_module_name) {
						$v['sourse_module_name']=$sourse_module_name;
					}
				}
				else {
					$v['sourse_field_name']='';
					$v['sourse_table_name']='';
				}

				if ($v['hide_by_field']>0) {
					$query								= "SELECT   `fieldname` FROM  `$MYSQL_CTR_TABLE21` WHERE `id`='{$v['hide_by_field']}'";
					$result								= $this->mysql->executeSQL($query);
					list($v['hide_by_field_caption'])	= $this->mysql->fetchRow($result);
				}
				else $v['hide_by_field_caption']='';

				if (!is_numeric($v['active']))  			$v['active']=1;
				if (!is_numeric($v['show_in_list']))  		$v['show_in_list']=1;
				if (!is_numeric($v['check_regular_id']))  	$v['check_regular_id']=0;
				if (!is_numeric($v['hide_operator']))  		$v['hide_operator']=0;

				$fields_settings[]=$v;
			}

			$block_tables[$n]['fields_settings']	= $fields_settings;
		}

		$ar['sql']		= $sql;
		$ar['blocks']	= $blocks;
		$ar['tables']	= $block_tables;

		return $ar;
	}



	/**
    * генерирует sql-запрос для создания одной таблицы
    *
    * @param array $fields
    * @param string $table_name
    * @return array
    */
	function get_on_query($fields, $table_name) {
		GLOBAL   $MYSQL_CTR_TABLE19;

		$zap	= ',';
		$sql	= "CREATE TABLE `$table_name` (".SETTINGS_NEW_LINE;

		$primary_keys='';
		$fields_count=count($fields);
		for ($k=0; $k<$fields_count; $k++) {

			$query		= "SELECT `collation`, `charset`  FROM   `$MYSQL_CTR_TABLE19` WHERE `id`='{$fields[$k]['collation_id']}'";
			$result		= $this->mysql->executeSQL($query);
			list($fields[$k]['collation'], $fields[$k]['charset'])	= $this->mysql->fetchRow($result);


			if ($fields[$k]['collation_id']>0) $kodirovka ="character set {$fields[$k]['charset']} collate {$fields[$k]['collation']}";
			else  $kodirovka='';

			if ($fields[$k]['len']!='') $len="({$fields[$k]['len']})";
			else $len='';

			if ($fields[$k]['auto_incr']==1) {
				$sql.="`{$fields[$k]['fieldname']}` {$fields[$k]['datatype']}$len $kodirovka NOT NULL auto_increment $zap".SETTINGS_NEW_LINE;
			}
			else {
				if ($fields[$k]['default']=='') {
					if ($fields[$k]['datatype_id']!=13 && $fields[$k]['datatype_id']!=12) $def='default NULL';
					else $def='';
				}
				else {
					if ($fields[$k]['datatype_id']!=13 && $fields[$k]['datatype_id']!=12) $def="default '{$fields[$k]['default']}'";
					else   {
						if (@preg_match("/^(\d{4}\-\d{2}\-\d{2} \d{2}\:\d{2}\:\d{2})$/iu", $fields[$k]['default'])) $def="default '{$fields[$k]['default']}'";
						else $def="default {$fields[$k]['default']}";
					}
				}

				if ($fields[$k]['unsigned']==1) $unsigned='unsigned';
				else $unsigned='';

				if ($fields[$k]['zerofill']==1) $zerofill='zerofill';
				else $zerofill='';

				$sql.="`{$fields[$k]['fieldname']}` {$fields[$k]['datatype']}$len $kodirovka $unsigned $zerofill  $def $zap".SETTINGS_NEW_LINE;
			}
			if ($fields[$k]['pk']==1) 	$primary_keys.="`{$fields[$k]['fieldname']}`,";
		}

		if  ($primary_keys!='') {
			$primary_keys	= mb_substr($primary_keys, 0, mb_strlen($primary_keys)-1);
			$primary_keys	= ", PRIMARY KEY  ($primary_keys)".SETTINGS_NEW_LINE;
		}

		$sql.=" `page_id` int(11) default NULL,".SETTINGS_NEW_LINE." `tag_id` int(11) default NULL,".SETTINGS_NEW_LINE." `lang_id` int(6) default NULL,".SETTINGS_NEW_LINE." `sort_index` bigint default '0' ".SETTINGS_NEW_LINE.$primary_keys;
		$sql.=") ENGINE=InnoDB DEFAULT CHARSET=utf8;".SETTINGS_NEW_LINE.SETTINGS_NEW_LINE;

		return $sql;
	}



	/**
	 * Возвращает список всех файлов в заданной директории
	 *
	 * @param  string $dir
	 * @return array
	 */
	function searchdirSimple ($path , $maxdepth = -1 , $mode = 'FILES' , $d = 0 ) {
		if ( mb_substr ( $path , mb_strlen ( $path ) - 1 ) != '/' )     	$path .= '/';

		$dirlist = array ();
		if ($mode != 'FILES')  $dirlist[] = $path;

		if ($handle = @opendir ($path) ) {
			while (false !== ($file = readdir($handle))) {
				if ($file != '.' && $file != '..') {

					$fullName 		= $path.$file;
					$tmp['name']	= $file;
					if ( ! is_dir ($fullName) ) {
						if ( $mode != 'DIRS' )  $dirlist[] = $tmp;
					}
					elseif ( $d >=0 && ($d < $maxdepth || $maxdepth < 0) ) {
						$result = $this->searchdirSimple ($fullName . '/' , $maxdepth , $mode , $d + 1 ) ;
						$dirlist = array_merge ( $dirlist , $result ) ;
					}
				}
			}
			closedir ($handle);
		}

		return ($dirlist);
	}



	/**
	 * возвращает обект для работы с базой админки
	 *
	 * @return object
	 */
	function getMysqlObjectForAdmin() {
		require_once '../config.php';          		//настройки подключение к БД
		require_once '../DbConnection.php';			//класс для работы с БД
		$mysqladmin	=	 new DbConnection();
		return $mysqladmin;
	}



	/**
	 * возвращает смарти
	 *
	 * @return class
	 */
	function getSmarty() {
		return $this->smarty;
	}

}
?>