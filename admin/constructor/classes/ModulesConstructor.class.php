<?php
/**
 * класс для работы с модулями
 *
 */
class ModulesConstructor  {

	/**
	 * смарти-класс
	 * @var class
	 */
	public		$smarty;

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
     * @var array
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
   	 * @var object
   	 */
	public		$mysql;

	/**
     *  Содержит сообщения об ошибках
     *      
     * @var array
     */
	public 		$editError;

	/**
     *  Временный смарти класс для генерирования промежуточных шаблонов
     *
     * @var unknown_type
     */
	public 		$smartyTemp;

	/**
     * нужно ли обновлять левы фрейм
     *
     * @var bool
     */
	public 		$refreshFrame;

	/**
     * id редактируемого модуля
     *
     * @var int
     */
	public 		$m_id;



	/**
     * Конструктор
     * 
     * @param class $smarty
     */
	function ModulesConstructor($mysql, $smarty, $post, $postr, $get, $getr,  $do) {
		GLOBAL $MSGTEXT;

		$this->mysql		= $mysql;
		$this->smarty		= $smarty;
		$this->smartyTemp	= $smarty;
		$this->post			= $post;
		$this->get			= $get;
		$this->postr		= $postr;
		$this->getr			= $getr;

		if (isset($_SESSION['___GoodCMS']['m_id'])) {
			$this->m_id		= $_SESSION['___GoodCMS']['m_id'];
		}

		switch ($do):
		case ('list'):					$this->getList(); 				break;
		case ('add'):					$this->form_add(); 				break;
		case ('insert'):				$this->insert(); 				break;
		case ('edit'):					$this->form_edit(); 			break;
		case ('delete'):				$this->delete(); 				break;
		case ('saveedit'):				$this->saveEdit();	 			break;
		case ('insert_copy_form'):		$this->insertCopyForm(); 		break;
		case ('insert_copy'):			$this->insertCopy(); 			break;
		case ('move_module_item'):		$this->moveModuleItem(); 		break;
		case ('import_work_module'):	$this->importWorkModule(); 		break;
		case ('import_work_module_do'):	$this->importWorkModuleDo(); 	break;
		case ('save_work_module'):		$this->saveWorkModule(); 		break;
		endswitch;

	}



	/**
	 * получаем список модулей
	 *
	 */
	function getList() {
		GLOBAL $MSGTEXT, $GENERAL_FUNCTIONS, $MYSQL_CTR_TABLE17;

		if (isset($this->get['page']) && $this->get['page']!='') $_SESSION['___GoodCMS']['BACK_RECORD_URL']='?'.$_SERVER['QUERY_STRING'];

		if (isset($this->m_id) && $this->m_id>0) {

			$where	= " WHERE `id`='{$this->m_id}'";
		}
		else $where='';

		$query			= "SELECT * FROM `$MYSQL_CTR_TABLE17` $where ORDER BY `sort_index`";
		$result			= $this->mysql->executeSQL($query);
		$allModules		= $this->mysql->fetchAssocAll($result);

		$sort			= $GENERAL_FUNCTIONS->getSortVariables('name');
		$allModules		= $GENERAL_FUNCTIONS->sort_massiv_by_int($sort['sort_type'],     	$allModules);
		$obj			= $GENERAL_FUNCTIONS->form_navigations(20,   $allModules, '?act=m_c&sort_by='.$sort['sort_by'].'&sort_type='.$sort['sort_type']);
		$modules		= $obj['records'];
		$pages			= $obj['pages'];

		$this->smarty->assign('content_template',	'modules_forms/modules_list.tpl');
		$this->smarty->assign('modules',			$modules);
		$this->smarty->assign('pages', 				$pages);
		$this->smarty->assign('content_head',		$MSGTEXT['mod_constructor_modules']);
		$this->smarty->assign('sort_by',			$sort['sort_by']);
		$this->smarty->assign('sort_type',			$sort['sort_type']);
		$this->smarty->assign('refreshFrame',		$this->refreshFrame);
	}



	/**
     * форма создания модуля
     *
     */
	function form_add () {
		GLOBAL $MSGTEXT;
		$this->smarty->assign('content_template',	'modules_forms/modules_form_add.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['mod_constructor_new_mod']);
	}



	/**
     * форма создания копии модуля
     *
     */
	function insertCopyForm () {
		GLOBAL  $MSGTEXT, $MYSQL_CTR_TABLE17;

		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE17` WHERE `id`='{$this->get['id']}'";
		$result		= $this->mysql->executeSQL($query);
		$module		= $this->mysql->fetchAssoc($result);

		foreach ($module as $k=>$v) {
			$this->smarty->assign($k, $v);
		}

		$this->smarty->assign('content_template',	'modules_forms/modules_form_add_copy.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['mod_constructor_copy_mod']);
	}



	/**
	 * устонавливает порядок сортировки модулей
	 *
	 */
	function moveModuleItem() {
		GLOBAL  $MSGTEXT, $MYSQL_CTR_TABLE17;

		$id			= $this->get['id'];
		$query		= "SELECT * FROM  `$MYSQL_CTR_TABLE17` WHERE  `id`='$id'";
		$result		= $this->mysql->executeSQL($query);
		$cat		= $this->mysql->fetchAssoc($result);

		$query		= "SELECT * FROM  `$MYSQL_CTR_TABLE17` ORDER BY `sort_index`";
		$result		= $this->mysql->executeSQL($query);
		$catItems	= $this->mysql->fetchAssocAll($result);

		if ($catItems>1) {
			$min	= $catItems[0]['sort_index'];
			$max	= $catItems[count($catItems)-1]['sort_index'];

			for ($i=0; $i<count($catItems); $i++) {
				if ($catItems[$i]['id']==$cat['id']) {

					if ($this->get['type']=='up') {
						if ($i>0) $next	= $i-1;
						else {
							$this->smarty->assign('message',		$MSGTEXT['mod_constructor_no_up']);
							$next	= 0;
						}
					}
					elseif ($this->get['type']=='down') {
						if ($i<count($catItems)-1) $next = $i+1;
						else {
							$this->smarty->assign('message',		$MSGTEXT['mod_constructor_no_down']);
							$next	= count($catItems)-1;
						}
					}

					$moved		= $i;
					$query		= "UPDATE `$MYSQL_CTR_TABLE17` SET `sort_index`='{$catItems[$moved]['sort_index']}' WHERE  `id`='{$catItems[$next]['id']}'";
					$result		= $this->mysql->executeSQL($query);

					$query		= "UPDATE `$MYSQL_CTR_TABLE17` SET `sort_index`='{$catItems[$next]['sort_index']}' WHERE  `id`='{$catItems[$moved]['id']}'";
					$result		= $this->mysql->executeSQL($query);

					setHistory($this->m_id, 2, 0, $catItems[$next]['id']);
					setHistory($this->m_id, 2, 0, $catItems[$moved]['id']);

					$this->refreshFrame=1;
					break;
				}
			}
		}
		$this->getList();
	}



	/**
     * обработка формы создания модуля
     *
     */
	function insert() {
		GLOBAL $MSGTEXT, $MYSQL_CTR_TABLE17, $BAD_SYMBOLS;

		$error		= false;
		$name		= addslashes($this->post['name']);

		if (!preg_match("/^([A-Z0-9_\\/\.-]*)$/iu", $name)) {
			$error	= true;
			$this->smarty->assign('message', sprintf($MSGTEXT['mod_constructor_name_ciril'], '/\:*?"< >|</b>'));
		}
		else {

			$description	= htmlspecialchars(str_replace($BAD_SYMBOLS, '', $this->postr['description']), ENT_QUOTES);

			if (is_numeric($this->postr['version'])) {
				$version	= $this->postr['version'];
			}
			else {
				$version	= 1;
			}

			$query		= "SELECT count(*) FROM `$MYSQL_CTR_TABLE17` WHERE `name`='$name'";
			$result		= $this->mysql->executeSQL($query);
			$c			= $this->mysql->fetchRow($result);

			if ($c[0]>0) {
				$error	= true;
				$this->smarty->assign('message',			$MSGTEXT['mod_constructor_err_name']);
			}
			elseif ($this->post['name']=='') {
				$error	= true;
				$this->smarty->assign('message',			$MSGTEXT['mod_constructor_name_empty']);
			}
		}

		if ($error)	 {
			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
			$this->smarty->assign('content_template',	'modules_forms/modules_form_add.tpl');
			$this->smarty->assign('content_head',		$MSGTEXT['mod_constructor_new_mod']);
		}
		else {
			$query		= "INSERT INTO `$MYSQL_CTR_TABLE17` (`name`, `version`, `description`, `loaded`, `need_save`, `loaded_name`, `sort_index`) VALUES ('$name', '$version', '$description', '0', '0', '', '0')";
			$result		= $this->mysql->executeSQL($query);

			$sort_index	= $this->mysql->insertID();
			$query		= "UPDATE `$MYSQL_CTR_TABLE17` SET `sort_index`='$sort_index' WHERE `id`='$sort_index'";
			$result		= $this->mysql->executeSQL($query);

			$this->refreshFrame=1;

			$this->smarty->assign('message',			$MSGTEXT['mod_constructor_new_ctrated']);
			$this->getList();
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
     * обработка формы создания копии модуля
     *
     */
	function insertCopy() {
		GLOBAL $MSGTEXT, $GENERAL_FUNCTIONS, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21,$MYSQL_CTR_TABLE25, $BAD_SYMBOLS;

		$sort_index_tables 		= array ($MYSQL_CTR_TABLE17,$MYSQL_CTR_TABLE23,$MYSQL_CTR_TABLE30,$MYSQL_CTR_TABLE18,$MYSQL_CTR_TABLE21);
		$block_array_id 		= array();
		$tables_array_id 		= array();
		$all_hide_by_field		= array();
		$new_fields_settings_id	= array();
		$sourse_field			= array();
		$error					= false;
		$name					= addslashes($this->post['name']);

		if (!preg_match("/^([A-Z0-9_\\/\.-]*)$/iu", $name)) {
			$error	= true;
			$this->smarty->assign('message',	sprintf($MSGTEXT['mod_constructor_name_ciril'], '/\:*?"< >|'));
		}
		else {

			$description	= htmlspecialchars(str_replace($BAD_SYMBOLS, '', $this->postr['description']), ENT_QUOTES);
			//$loaded			= $this->post['loaded'];
			$loaded			= 0;
			$need_save		= $this->post['need_save'];
			$id_copy_module	= $this->post['id'];

			if (is_numeric($this->postr['version'])) {
				$version	= $this->postr['version'];
			}
			else {
				$version	= 1;
			}

			$query			= "SELECT count(*) FROM `$MYSQL_CTR_TABLE17` WHERE `name`='$name'";
			$result			= $this->mysql->executeSQL($query);
			$c				= $this->mysql->fetchRow($result);

			if ($c[0]>0) {
				$error	= true;
				$this->smarty->assign('message',			$MSGTEXT['mod_constructor_err_name']);
			}
			elseif ($this->post['name']=='') {
				$error	= true;
				$this->smarty->assign('message',			$MSGTEXT['mod_constructor_name_empty']);
			}
		}

		if ($error)	 {
			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
			$this->smarty->assign('content_template',	'modules_forms/modules_form_add_copy.tpl');
			$this->smarty->assign('content_head',		$MSGTEXT['mod_constructor_copy_mod']);
		}
		else {
			$query		= "INSERT INTO `$MYSQL_CTR_TABLE17` (`name`, `version`, `description`, `loaded`, `need_save`, `loaded_name`,   `sort_index`) VALUES ('$name', '$version', '$description', '$loaded', '$need_save', '$name', '0')";
			$result		= $this->mysql->executeSQL($query);
			$new_module_id	= $this->mysql->insertID();

			//создание новых таблиц
			$query			= "SELECT * FROM `$MYSQL_CTR_TABLE18` WHERE `module_id`='$id_copy_module'";
			$result			= $this->mysql->executeSQL($query);
			$ress_tables 	= $this->mysql->fetchAssocAll($result);
			$ress_tables	= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($ress_tables);

			$tables_ids		= array();
			foreach ($ress_tables as $ctr_tables) {
				$query			= "INSERT INTO `$MYSQL_CTR_TABLE18` VALUES (NULL, '$new_module_id', '{$ctr_tables['name']}', '{$ctr_tables['description']}', '{$ctr_tables['show_type']}', '{$ctr_tables['additional_buttons']}', '{$ctr_tables['name']}', '0')";
				$this->mysql->executeSQL($query);
				$new_tables_id 	= $this->mysql->insertID();
				$tables_ids[$ctr_tables['id']]=$new_tables_id;

				$query			= "SELECT * FROM `$MYSQL_CTR_TABLE21` WHERE `table_id`='{$ctr_tables['id']}'";
				$result 		= $this->mysql->executeSQL($query);
				$ress 			= $this->mysql->fetchAssocAll($result);
				$ress			= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($ress);

				if (is_array($ress)) {
					foreach ($ress as $insert) {
						if (!$insert['edittype_id']) $insert['edittype_id']='NULL';
						if (!$insert['collation_id']) $insert['collation_id']='NULL';
						if (!$insert['sourse_field_id']) $insert['sourse_field_id']='NULL';

						$query			= "INSERT INTO `$MYSQL_CTR_TABLE21` VALUES (NULL,'$new_tables_id',{$insert['edittype_id']},'{$insert['fieldname']}','{$insert['datatype_id']}','{$insert['len']}','{$insert['default']}',{$insert['collation_id']}, '{$insert['group_caption']}', '{$insert['pk']}','{$insert['not_null']}','{$insert['unsigned']}','{$insert['auto_incr']}','{$insert['zerofill']}','{$insert['unique']}', '{$insert['notfedit']}', '{$insert['comment']}',{$insert['sourse_field_id']},'{$insert['delete']}','{$insert['own_filter']}', '{$insert['fieldname']}','{$insert['sort_index']}')";
						$this->mysql->executeSQL($query);
						$new_tables_fileds_id = $this->mysql->insertID();

						if ($insert['sourse_field_id'] != 0) {
							$sourse_field[$insert['sourse_field_id']]	= $new_tables_fileds_id;
						}

						$query			= "SELECT * FROM `$MYSQL_CTR_TABLE25` WHERE `field_id`='{$insert['id']}'";
						$result			= $this->mysql->executeSQL($query);
						$ress_settings	= $this->mysql->fetchAssocAll($result);
						$ress_settings	= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($ress_settings);

						if (is_array($ress_settings)) {
							foreach ($ress_settings as $insert_settings) {
								if ($insert_settings['hide_by_field']==null)  $insert_settings['hide_by_field']=0;
								if ($insert_settings['hide_operator']==null)  $insert_settings['hide_operator']=0;
								if (!$insert_settings['check_regular_id']) $insert_settings['check_regular_id']='NULL';
								//if (!$insert_settings['collation_id']) $insert_settings['collation_id']='NULL';


								$query	 	= "INSERT INTO `$MYSQL_CTR_TABLE25` (`id`,`field_id`,`active`,`show_in_list`,`filter`, `check_regular_id`,`regex_other`,`height`,`width`,`style`,`hide_by_field`,`hide_operator`,`hide_on_value`, `avator_quality`, `avator_width`, `avator_height`, `avator_quality_big`, `avator_width_big`, `avator_height_big`) VALUES (NULL,'$new_tables_fileds_id','{$insert_settings['active']}','{$insert_settings['show_in_list']}', '{$insert_settings['filter']}', {$insert_settings['check_regular_id']},'{$insert_settings['regex_other']}','{$insert_settings['height']}','{$insert_settings['width']}','{$insert_settings['style']}','{$insert_settings['hide_by_field']}','{$insert_settings['hide_operator']}','{$insert_settings['hide_on_value']}', '{$insert_settings['avator_quality']}', '{$insert_settings['avator_width']}', '{$insert_settings['avator_height']}', '{$insert_settings['avator_quality_big']}', '{$insert_settings['avator_width_big']}', '{$insert_settings['avator_height_big']}')";
								$this->mysql->executeSQL($query);
								$new_tables_settings = $this->mysql->insertID();

								if ($insert_settings['hide_by_field'] != 0) {
									$all_hide_by_field[$insert_settings['hide_by_field']] = $new_tables_settings;
								}
							}
						}
						$new_fields_settings_id[$insert['id']] = $new_tables_fileds_id;
					}
				}
				$tables_array_id[$ctr_tables['id']] = $new_tables_id;
			}

			//обновляем таблицу cms_ctr_tables_fields_settings
			foreach ($all_hide_by_field as $id_fields_old=>$new_id) {
				$query = "UPDATE `$MYSQL_CTR_TABLE25` SET `hide_by_field`='$new_fields_settings_id[$id_fields_old]' WHERE `id`='$new_id'";
				$this->mysql->executeSQL($query);
			}

			//обновляем таблицу cms_ctr_tables_fields
			foreach ($sourse_field as $id_sourse_field=>$id_fileds) {
				$query = "UPDATE `$MYSQL_CTR_TABLE21` SET `sourse_field_id`='$new_fields_settings_id[$id_sourse_field]' WHERE `id`='$id_fileds'";
				$this->mysql->executeSQL($query);
			}

			//Создание нового блока
			$query		= "SELECT * FROM `$MYSQL_CTR_TABLE23` WHERE `module_id`='$id_copy_module'";
			$result		= $this->mysql->executeSQL($query);
			$ress_block = $this->mysql->fetchAssocAll($result);
			$ress_block	= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($ress_block);

			foreach ($ress_block as $block) {

				if (isset($tables_ids[$block['general_table_id']])) $block['general_table_id']=$tables_ids[$block['general_table_id']];
				else $block['general_table_id']=0;

				$query			= "INSERT INTO `$MYSQL_CTR_TABLE23` VALUES (NULL, '$new_module_id', '{$block['type']}', '{$block['name']}', '{$block['description']}', '{$block['act_variable']}', '{$block['act_method']}', '{$block['url_get_vars']}', '{$block['general_table_id']}', '{$block['name']}', '0')";
				$this->mysql->executeSQL($query);
				$new_block_id 	= $this->mysql->insertID();

				//копируем таблицу cms_ctr_blocks_settings
				$query			= "SELECT * FROM `$MYSQL_CTR_TABLE28` WHERE `block_id`='{$block['id']}'";
				$result 		= $this->mysql->executeSQL($query);
				$ress 			= $this->mysql->fetchAssocAll($result);
				$ress			= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($ress);

				if (is_array($ress)) {
					foreach ($ress as $insert) {
						$query			= "INSERT INTO `$MYSQL_CTR_TABLE28` VALUES (NULL,'$new_block_id','{$insert['name']}','{$insert['value']}','{$insert['description']}','{$insert['edit_s_type_id']}','{$insert['name']}')";
						$this->mysql->executeSQL($query);
					}
				}

				//копируем таблицу cms_ctr_blocks_templates
				$query			= "SELECT * FROM `$MYSQL_CTR_TABLE30` WHERE `block_id`='{$block['id']}'";
				$result 		= $this->mysql->executeSQL($query);
				$ress 			= $this->mysql->fetchAssocAll($result);
				$ress			= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($ress);

				if (is_array($ress)) {
					foreach ($ress as $insert) {
						$query			= "INSERT INTO `$MYSQL_CTR_TABLE30` VALUES (NULL,'$new_block_id','{$insert['name']}','{$insert['description']}','{$insert['content']}','{$insert['name']}','0')";

						$this->mysql->executeSQL($query);
					}
				}

				$block_array_id[$block['id']]=$new_block_id;
			}

			//Создание sort_index в рабочих таблицах
			foreach ($sort_index_tables as $key=>$value) {
				$query = "UPDATE `$value` SET `sort_index`=`id` WHERE `sort_index`=0";
				$this->mysql->executeSQL($query);
			}


			$this->refreshFrame	= 1;

			$GENERAL_FUNCTIONS->gotoURL('?act=m_c&m_id='.$new_module_id.'&refreshFrame='.$this->refreshFrame);
			exit;
		}
	}



	/**
     * удаляем модуль
     *
     */
	function delete() {
		GLOBAL $GENERAL_FUNCTIONS, $MYSQL_CTR_TABLE30, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE25, $MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE31;

		unset($_SESSION['___GoodCMS']['m_id']);

		//удаляем модуль
		$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE17` WHERE `id`='{$this->get['id']}'";
		$result		= $this->mysql->executeSQL($query);

		//удаляем таблицы
		$query		= "SELECT `id`  FROM  `$MYSQL_CTR_TABLE18` WHERE `module_id`='{$this->get['id']}'";
		$result		= $this->mysql->executeSQL($query);
		$tables		= $this->mysql->fetchAssocAll($result);

		$query			= "SELECT `id`  FROM  `$MYSQL_CTR_TABLE18` WHERE `module_id`='{$this->get['id']}'";
		$result			= $this->mysql->executeSQL($query);
		$all_tables		= $this->mysql->fetchAssocAll($result);
		for ($i=0; $i<count($all_tables); $i++) {
			$query				= "SELECT `id`  FROM  `$MYSQL_CTR_TABLE21` WHERE `table_id`='{$all_tables[$i]['id']}'";
			$result				= $this->mysql->executeSQL($query);
			$all_table_fields	= $this->mysql->fetchAssocAll($result);
			for ($i2=0; $i2<count($all_table_fields); $i2++) {
				//удаляем настройки полей
				$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE25` WHERE `field_id`='{$all_table_fields[$i2]['id']}'";
				$result		= $this->mysql->executeSQL($query);
			}
			//удаляем поля таблицы
			$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE21` WHERE `table_id`='{$all_tables[$i]['id']}'";
			$result		= $this->mysql->executeSQL($query);
		}

		//удаляем таблицы
		$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE18` WHERE `module_id`='{$this->get['id']}'";
		$result		= $this->mysql->executeSQL($query);

		//удаляем историю редактирования таблицы
		$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE31` WHERE `module_id`='{$this->get['id']}'";
		$result		= $this->mysql->executeSQL($query);

		//удаляем блоки
		$query		= "SELECT `id`  FROM  `$MYSQL_CTR_TABLE23` WHERE `module_id`='{$this->get['id']}'";
		$result		= $this->mysql->executeSQL($query);
		$blocks		= $this->mysql->fetchAssocAll($result);

		for ($i=0; $i<count($blocks); $i++) {

			$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE23` WHERE `id`='{$blocks[$i]['id']}'";
			$result		= $this->mysql->executeSQL($query);

			$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE28` WHERE `block_id`='{$blocks[$i]['id']}'";
			$result		= $this->mysql->executeSQL($query);

			//удялаем шаблоны
			$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE30` WHERE `block_id`='{$blocks[$i]['id']}'";
			$result		= $this->mysql->executeSQL($query);
		}

		$this->refreshFrame=1;
		$GENERAL_FUNCTIONS->gotoURL('?act=m_c&refreshFrame='.$this->refreshFrame);
	}



	/**
     * форма редактирования модуля
     *
     */
	function form_edit() {
		GLOBAL $MSGTEXT, $MYSQL_CTR_TABLE17;

		$query					= "SELECT * FROM `$MYSQL_CTR_TABLE17` WHERE `id`='{$this->get['id']}'";
		$result					= $this->mysql->executeSQL($query);
		$module					= $this->mysql->fetchAssoc($result);

		foreach ($module as $k=>$v) {
			$this->smarty->assign($k, $v);
		}

		$this->smarty->assign('content_head', 		$MSGTEXT['mod_constructor_edite_mod']);
		$this->smarty->assign('content_template',	'modules_forms/modules_form_edit.tpl');
	}



	/**
     * сохранение редактирования модуля
     *
     */
	function saveEdit() {
		GLOBAL $MSGTEXT, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE23, $BAD_SYMBOLS;

		$error		= false;
		$name		= addslashes($this->post['name']);


		//проверяем, чтоб имя блока не совпадало с именем модуля
		$query		= "SELECT count(*) FROM `$MYSQL_CTR_TABLE23` WHERE `module_id`='{$this->m_id}' AND `name`='{$this->post['name']}'";
		$result		= $this->mysql->executeSQL($query);
		list($c)	= $this->mysql->fetchRow($result);
		if ($c>0) {
			$error	= true;
			$this->smarty->assign('message',	$MSGTEXT['mod_constructor_name_like_block']);
		}


		if (!preg_match("/^([A-Z0-9_\\/\.-]*)$/iu", $name)) {
			$error	= true;
			$this->smarty->assign('message',	sprintf($MSGTEXT['mod_constructor_name_ciril'],'/\:*?"< >|'));
		}


		if (!$error) {

			$description	= htmlspecialchars(str_replace($BAD_SYMBOLS, '', $this->postr['description']), ENT_QUOTES);

			if (is_numeric($this->postr['version'])) {
				$version	= ",`version`='{$this->postr['version']}'";
			}
			else {
				$version	= '';
			}

			$query		= "SELECT count(*) FROM `$MYSQL_CTR_TABLE17` WHERE `name`='$name' AND `id`!='{$this->post['id']}'";
			$result		= $this->mysql->executeSQL($query);
			$c			= $this->mysql->fetchRow($result);

			if ($c[0]>0) {
				$error	= true;
				$this->smarty->assign('message',			$MSGTEXT['mod_constructor_err_name']);
			}
			elseif ($this->post['name']=='') {
				$error	= true;
				$this->smarty->assign('message',			$MSGTEXT['mod_constructor_name_empty']);
			}

			elseif (mb_strtolower($this->post['name'])=='cms' || mb_strtolower($this->post['name'])=='cms_' || mb_strtolower($this->post['name'])=='ctr' || mb_strtolower($this->post['name'])=='ctr_') {

				$error	= true;
				$this->smarty->assign('message',			$MSGTEXT['mod_constructor_swear_words']);
			}
		}

		if ($error)	 {
			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
			$this->smarty->assign('content_template',	'modules_forms/modules_form_edit.tpl');
			$this->smarty->assign('content_head',		$MSGTEXT['mod_constructor_edite_mod']);
			$this->get['id']=$this->post['id'];
		}
		else {
			$query		= "UPDATE `$MYSQL_CTR_TABLE17`  SET  `name`='$name', `description`='$description', `need_save`='1' $version  WHERE `id`='{$this->post['id']}'";
			$result		= $this->mysql->executeSQL($query);
			setHistory($this->m_id, 2, 0, $this->post['id']);

			//добавляем в историю, чтоб менять название таблиц по имени модуля
			$query				= "SELECT `id` FROM `$MYSQL_CTR_TABLE18` WHERE `module_id`='{$this->post['id']}'";
			$result				= $this->mysql->executeSQL($query);
			$all_tables			= $this->mysql->fetchAssocAll($result);
			foreach ($all_tables as $t) {
				setHistory($this->m_id, 2, 5, $t['id']);
			}

			$this->refreshFrame=1;
			$this->smarty->assign('message',			$MSGTEXT['mod_constructor_changed_save']);
			$this->getList();
		}
	}



	/**
     * форма импорта рабочего модуля
     *
     */
	function importWorkModule() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE5, $MYSQL_CTR_TABLE17;

		$mysqladmin = $this->getMysqlObjectForAdmin();

		$query			= "SELECT `name` FROM `$MYSQL_CTR_TABLE17` WHERE `loaded`=1";
		$result			= $this->mysql->executeSQL($query);
		$loaded_modules	= $this->mysql->fetchAssocAll($result);

		$s='';
		foreach ($loaded_modules as $lm) {
			$s.="'{$lm['name']}',";
		}

		if ($s!='') {
			$s=' WHERE `name` NOT IN ('.mb_substr($s,0,-1).')';
		}

		$query		= "SELECT * FROM `$MYSQL_TABLE5` $s  ORDER BY `name`";
		$result		= $mysqladmin->executeSQL($query);
		$modules	= $mysqladmin->fetchAssocAll($result);

		$this->smarty->assign('content_template',	'modules_forms/modules_import_work_module.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['mod_constructor_load_mod_admin']);
		$this->smarty->assign('modules',			$modules);
	}



	/**
	 *  Импортирует рабочий модуль из админки
	 *
	 */
	function importWorkModuleDo() {
		GLOBAL $MSGTEXT,$FILE_MANAGER, $GENERAL_FUNCTIONS,$MODULES_PATH,$MODULES_PERFORMANCE_PATCH_NAME, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE7, $MYSQL_TABLE18, $MYSQL_TABLE12, $MYSQL_CTR_TABLE17,$MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25,$MYSQL_CTR_TABLE26,$MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

		$mysqladmin = $this->getMysqlObjectForAdmin();

		$query		= "SELECT * FROM `$MYSQL_TABLE5` WHERE `id`='{$this->post['module_id']}'";
		$result		= $mysqladmin->executeSQL($query);
		$module		= $mysqladmin->fetchAssoc($result);

		$query			= "SELECT count(*) FROM `$MYSQL_CTR_TABLE17` WHERE `name`='{$module['name']}'";
		$result			= $this->mysql->executeSQL($query);
		list($m_count)	= $this->mysql->fetchRow($result);
		if ($m_count>0) {
			$this->smarty->assign('message',  sprintf($MSGTEXT['mod_constructor_mod_is_load'], $module['name']));
			$this->importWorkModule();
		}
		else {
			//импортируем блоки
			$query		= "SELECT * FROM `$MYSQL_TABLE6` WHERE `module_id`='{$this->post['module_id']}'";
			$result		= $mysqladmin->executeSQL($query);
			$blocks		= $mysqladmin->fetchAssocAll($result);

			for ($i=0; $i<count($blocks); $i++) {

				//импортируем настройки блока
				$query						= "SELECT * FROM `$MYSQL_TABLE7` WHERE `block_id`='{$blocks[$i]['id']}'";
				$result						= $mysqladmin->executeSQL($query);
				$blocks[$i]['settings']		= $mysqladmin->fetchAssocAll($result);

				foreach ($blocks[$i]['settings'] as $settings) {
					if ($settings['name']=='description') {
						$blocks[$i]['description']=$settings['value'];
						break;
					}
				}

				//импортируем шаблоны блока
				$query						= "SELECT * FROM `$MYSQL_TABLE12` WHERE `block_id`='{$blocks[$i]['id']}'";
				$result						= $mysqladmin->executeSQL($query);
				$blocks[$i]['templates']	= $mysqladmin->fetchAssocAll($result);
			}

			//импортируем таблицы модуля
			$query		= "SELECT * FROM `$MYSQL_TABLE18` WHERE `module_id`='{$this->post['module_id']}'";
			$result		= $mysqladmin->executeSQL($query);
			$m_tables	= $mysqladmin->fetchAssocAll($result);

			$tables	= array();
			foreach ($m_tables as $key => $table) {
				//импортируем настройки полей таблиц  блока
				$query						= "SELECT * FROM `$MYSQL_TABLE17` WHERE `table_id`='{$table['id']}'";
				$result						= $mysqladmin->executeSQL($query);
				$m_tables[$key]['fields']	= $mysqladmin->fetchAssocAll($result);
			}

			$module 		= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($module);
			$blocks 		= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($blocks);
			$m_tables		= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($m_tables);

			//берем список регулярных выражений в конструкторе
			$query			= "SELECT `id`, `regex` FROM `$MYSQL_CTR_TABLE26`";
			$result			= $this->mysql->executeSQL($query);
			$regulars		= $this->mysql->fetchAssocAll($result);

			//СОХРАНЯЕМ В БАЗУ КОНСТРУКТОРА
			$query			= "INSERT INTO `$MYSQL_CTR_TABLE17` (`name`, `version`, `description`, `loaded`, `need_save`,  `loaded_name`, `sort_index`) VALUES ('{$module['name']}', '{$module['version']}', '{$module['description']}', '1', '0', '{$module['name']}', '0')";
			$result			= $this->mysql->executeSQL($query);
			$module_id		= $this->mysql->insertID();

			$query			= "UPDATE `$MYSQL_CTR_TABLE17` SET `sort_index`='$module_id' WHERE `id`='$module_id'";
			$result			= $this->mysql->executeSQL($query);

			//добавляем таблицы блоков
			$all_fields		= array();
			$all_tables 	= array();
			$tables_ids		= array();
			foreach ($m_tables as $table) {
				$table_name			= mb_substr($table['table_name'], mb_strlen($module['name'])+1);
				$query				= "INSERT INTO `$MYSQL_CTR_TABLE18` (`module_id`, `name`, `description`, `show_type`, `loaded_name`, `additional_buttons`, `sort_index`) VALUES ('$module_id','$table_name','{$table['description']}','{$table['show_type']}', '$table_name', '{$table['additional_buttons']}', '{$table['sort_index']}')";
				$result				= $this->mysql->executeSQL($query);
				$table_id			= $this->mysql->insertID();

				$all_tables[$table['table_name']]	= $table['id'];
				$tables_ids[$table['id']]			= $table_id;

				//добавляем поля
				$fields	= array();
				if (is_array($table['fields'])) {
					foreach ($table['fields'] AS $field) {

						if ($field['edittype_id']==0 || $field['edittype_id']=='')  {
							$field['edittype_id']='NULL';
						}

						if ($field['datatype_id']==0 || $field['datatype_id']=='')  {
							$field['datatype_id']='NULL';
						}

						if ($field['collation_id']==0 || $field['collation_id']=='')  {
							$field['collation_id']='NULL';
						}

						//в свойстве len могут использоваться одинарные кавычки для некоторых типов данных
						$query		= "INSERT INTO `$MYSQL_CTR_TABLE21`
			 					(`table_id`,
			 					`edittype_id`,
								`fieldname`,
								`datatype_id`,
								`len`,
								`default`,
								`collation_id`,
								`group_caption`,								
								`pk`,
								`not_null`,
								`unsigned`,
								`auto_incr`,
								`zerofill`,
								`unique`,
								`notfedit`,								
								`comment`,
								`sourse_field_id`,
								`delete`,
								`own_filter`,								
								`loaded_name`,
								`sort_index`			 			
			 					) VALUES 
				 				('$table_id',
				 				{$field['edittype_id']},
				 				'{$field['fieldname']}',
				 				{$field['datatype_id']},
				 				'{$field['len']}',
				 				'{$field['default']}',
					 			{$field['collation_id']},
					 			'{$field['group_caption']}',					 			
					 			'{$field['pk']}',
					 			'{$field['not_null']}',
					 			'{$field['unsigned']}',
				 				'{$field['auto_incr']}',
					 			'{$field['zerofill']}',
					 			'{$field['unique']}',					 			
					 			'{$field['notfedit']}',					 								 			
			 					'{$field['comment']}',
				 				'0',
				 				'{$field['delete']}',
				 				'{$field['own_filter']}',				 				
				 				'{$field['fieldname']}',				 				
				 				'{$field['sort_index']}')";		

						$result				= $this->mysql->executeSQL($query);
						$field['new_id']	= $this->mysql->insertID();
						$all_fields[]		= $field;
						$fields[]			= $field;
					}

					//добавляем настройки полей
					$fields_settings_val='';
					foreach ($fields AS $field) {

						//находим id регулярного выражения
						$regex_other		= stripslashes($field['regex']);
						$check_regular_id	= 'NULL';
						foreach ($regulars as $regular) {
							if ($regex_other==$regular['regex']) {
								$check_regular_id	= $regular['id'];
								$regex_other		= '';
								break;
							}
						}


						//находим id поля по которому скрывается текущее поле
						$hide_by_field='NULL';
						$fields2=$fields;
						foreach ($fields2 AS $f) {
							if ($f['fieldname']==$field['hide_by_field_caption']) {
								$hide_by_field	= $f['new_id'];
								break;
							}
						}

						$fields_settings_val.="('{$field['new_id']}',
							'{$field['active']}',
							'{$field['show_in_list']}',
							'{$field['filter']}',
			 				$check_regular_id,
			 				'$regex_other',
			 				'{$field['height']}',
				 			'{$field['width']}',
							'{$field['style']}',
							$hide_by_field,
							'{$field['hide_operator']}',
				 			'{$field['hide_on_value']}',
							'{$field['avator_quality']}',
							'{$field['avator_width']}',
							'{$field['avator_height']}',
							'{$field['avator_quality_big']}',
							'{$field['avator_width_big']}',
							'{$field['avator_height_big']}'),";			 							 				
					}

					if ($fields_settings_val!='') {
						$fields_settings_val	= mb_substr($fields_settings_val, 0, -1);

						$query			= "INSERT INTO `$MYSQL_CTR_TABLE25`
				 					(`field_id`,
				 					`active`,
									`show_in_list`,
									`filter`,
									`check_regular_id`,
									`regex_other`,
									`height`,
									`width`,
									`style`,
									`hide_by_field`,
									`hide_operator`,
									`hide_on_value`,
									`avator_quality`, 
									`avator_width`, 
									`avator_height`, 
									`avator_quality_big`, 
									`avator_width_big`, 
									`avator_height_big`
									) 
									VALUES $fields_settings_val";

						$result	= $this->mysql->executeSQL($query);
					}
				}
			}

			//находим id поля подстановки источников
			foreach ($all_fields AS $f) {
				foreach ($all_fields AS $f2) {
					if ($f['sourse_field_name']==$f2['fieldname'] &&  $all_tables[$f['sourse_table_name']]==$f2['table_id']) {
						$query			= "UPDATE `$MYSQL_CTR_TABLE21` SET `sourse_field_id`='{$f2['new_id']}' WHERE `id`={$f['new_id']}";
						$result			= $this->mysql->executeSQL($query);
						break;
					}
				}
			}

			//добавляем блоки
			for ($i=0; $i<count($blocks); $i++) {

				//меняем ID таблицы
				if (isset($tables_ids[$blocks[$i]['general_table_id']])) $general_table_id	= $tables_ids[$blocks[$i]['general_table_id']];
				else $general_table_id	= 'NULL';

				$query			= "INSERT INTO `$MYSQL_CTR_TABLE23` (`module_id`, `type`, `name`, `description`, `act_variable`, `act_method`, `url_get_vars`, `general_table_id`, `loaded_name`, `sort_index`) VALUES ('$module_id', '{$blocks[$i]['type']}', '{$blocks[$i]['name']}','{$blocks[$i]['description']}','{$blocks[$i]['act_variable']}', '{$blocks[$i]['act_method']}', '{$blocks[$i]['url_get_vars']}', $general_table_id, '{$blocks[$i]['name']}', '{$blocks[$i]['sort_index']}')";
				$result			= $this->mysql->executeSQL($query);
				$block_id		= $this->mysql->insertID();

				//добавляем настройки блока
				foreach ($blocks[$i]['settings'] as $settings) {
					$query			= "INSERT INTO `$MYSQL_CTR_TABLE28` (`block_id`, `name`, `value`, `description`, `edit_s_type_id`, `loaded_name`) VALUES ('$block_id', '{$settings['name']}', '{$settings['value']}', '{$settings['description']}', '{$settings['type']}',  '{$settings['name']}')";
					$result			= $this->mysql->executeSQL($query);
				}

				//добавляем шаблоны блока
				foreach ($blocks[$i]['templates'] as $template) {

					$tpl_name	= $MODULES_PATH.$module['name'].'/'.$MODULES_PERFORMANCE_PATCH_NAME.'/'.$blocks[$i]['name'].'Templates/'.$template['name'].'.tpl';
					if (file_exists($tpl_name)) {
						$content	 = $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($FILE_MANAGER->getfile($tpl_name));
					}
					else $content=$template['content'];

					$query			= "INSERT INTO `$MYSQL_CTR_TABLE30` (`block_id`, `name`, `description`, `content`, `loaded_name`, `sort_index`) VALUES ('$block_id', '{$template['name']}', '{$template['description']}', '{$template['content']}',  '{$template['name']}', '{$template['sort_index']}')";
					$result			= $this->mysql->executeSQL($query);
				}
			}
		}

		$this->refreshFrame							= 1;

		$_SESSION['___GoodCMS']['m_id']				= $module_id;
		$this->smarty->assign('m',					$module);
		$this->smarty->assign('refreshFrame',		$this->refreshFrame);
		$this->smarty->assign('content_template',	'modules_forms/modules_import_work_module_do_result.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['mod_constructor_load_mod_admin']);
	}


	/**
	 * Берёт всю информацию о модуле
	 *
	 * @param array $module
	 * @return array
	 */
	function getModuleAllInfo($module) {
		GLOBAL $MODULES_PATH,$MODULES_PERFORMANCE_PATCH_NAME,$MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE20,$MYSQL_CTR_TABLE19, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE7, $MYSQL_TABLE18, $MYSQL_TABLE12, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25,$MYSQL_CTR_TABLE26,$MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE23` WHERE `module_id`='{$module['id']}'";
		$result		= $this->mysql->executeSQL($query);
		$blocks		= $this->mysql->fetchAssocAll($result);
		for ($i=0; $i<count($blocks); $i++) {

			$query				= "SELECT * FROM `$MYSQL_CTR_TABLE18`";
			$result				= $this->mysql->executeSQL($query);
			$block_tables		= $this->mysql->fetchAssocAll($result);

			for ($n=0; $n<count($block_tables); $n++) {

				$fields_settings	= array();
				$query				= "SELECT $MYSQL_CTR_TABLE25.*, $MYSQL_CTR_TABLE20.datatype, $MYSQL_CTR_TABLE19.collation, f.loaded_name,  f.edittype_id, f.fieldname, f.comment, f.sourse_field_id, f.datatype_id, f.len, f.default, f.collation_id, f.not_null, f.unsigned, f.zerofill, f.unique, f.notfedit, f.auto_incr,  f.pk , f.sort_index
		    			FROM `$MYSQL_CTR_TABLE21`  as `f` LEFT JOIN  `$MYSQL_CTR_TABLE25` ON ($MYSQL_CTR_TABLE25.field_id=f.id)
		    			LEFT JOIN `$MYSQL_CTR_TABLE20` ON (f.datatype_id=$MYSQL_CTR_TABLE20.id)
		    			LEFT JOIN `$MYSQL_CTR_TABLE19` ON (f.collation_id=$MYSQL_CTR_TABLE19.id)		    			
						WHERE f.table_id='{$block_tables[$n]['id']}' ORDER BY f.sort_index";		    			    	

				$result		= $this->mysql->executeSQL($query);
				$fields		= $this->mysql->fetchAssocAll($result);

				foreach ($fields as $v) {
					$v['table_name']=$block_tables[$n]['table_name'];

					if ($v['sourse_field_id']>0) {
						$query		= "SELECT $MYSQL_CTR_TABLE21.fieldname, $MYSQL_CTR_TABLE18.name FROM `$MYSQL_CTR_TABLE21`, `$MYSQL_CTR_TABLE18` WHERE $MYSQL_CTR_TABLE21.id='{$v['sourse_field_id']}' AND $MYSQL_CTR_TABLE21.table_id=$MYSQL_CTR_TABLE18.id";
						$result		= $this->mysql->executeSQL($query);
						list($v['sourse_field_name'],$v['sourse_table_name'])		= $this->mysql->fetchRow($result);
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

				for ($n2=0; $n2<count($fields_settings); $n2++) {
					$query				= "SELECT `regex` FROM `$MYSQL_CTR_TABLE26` WHERE `id`='{$fields_settings[$n2]['check_regular_id']}'";
					$result				= $this->mysql->executeSQL($query);
					if (!list($fields_settings[$n2]['regex'])	= $this->mysql->fetchRow($result)) {
						$fields_settings[$n2]['regex']=$fields_settings[$n2]['regex_other'];
					}
				}

				$block_tables[$n]['fields_settings']	= $fields_settings;
			}

			$blocks[$i]['tables']		= $block_tables;

			//берем переменные блока
			$query						= "SELECT * FROM `$MYSQL_CTR_TABLE28` WHERE `block_id`='{$blocks[$i]['id']}'";
			$result						= $this->mysql->executeSQL($query);
			$blocks[$i]['settings']		= $this->mysql->fetchAssocAll($result);


			//берем шаблоны блока
			$query						= "SELECT $MYSQL_CTR_TABLE30.*, $MYSQL_CTR_TABLE23.name as `block_name` FROM `$MYSQL_CTR_TABLE30` LEFT JOIN (`$MYSQL_CTR_TABLE23`) ON ($MYSQL_CTR_TABLE23.id=$MYSQL_CTR_TABLE30.block_id) WHERE $MYSQL_CTR_TABLE30.block_id={$blocks[$i]['id']}  ORDER BY $MYSQL_CTR_TABLE30.block_id";
			$result						= $this->mysql->executeSQL($query);
			$blocks[$i]['templates']	= $this->mysql->fetchAssocAll($result);
		}

		return $blocks;
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


	////////////////////////////////////////////////ФУНКЦИИ ОБНОВЛЕНИЯ МОДУЛЯ//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * Проверяет модуль перед сохранением в админку
	 *
	 * @return bool
	 */
	function checkData() {
		GLOBAL $FILE_MANAGER, $MSGTEXT, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21,$MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE23, $MYSQL_TABLE5, $MYSQL_CTR_TABLE17;

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
			$this->editError[]=$MSGTEXT['compiler_fmode_error'];
		}

		//если с момента последнего сохранения прошло меньше 35 секунд выводим сообщение
		$time_limit=35;
		if (SETTINGS_CTR_SAVE_TO_ADMIN_LAST_TIME!='' && (strtotime(gmdate('Y-m-d H:i:s'))-strtotime(SETTINGS_CTR_SAVE_TO_ADMIN_LAST_TIME))<$time_limit )	 {
			$this->editError[]=sprintf($MSGTEXT['compiler_time_error'], $time_limit-(strtotime(gmdate('Y-m-d H:i:s'))-strtotime(SETTINGS_CTR_SAVE_TO_ADMIN_LAST_TIME)));
		}

		//берем старое имя редактируемого модуля
		$query				= "SELECT `loaded_name` FROM `$MYSQL_CTR_TABLE17` WHERE `id`='{$this->m_id}'";
		$result				= $this->mysql->executeSQL($query);
		list($module_name)	= $this->mysql->fetchRow($result);

		//Берем из админку всю информацию об редактируемом модуле
		$mysqladmin 	= $this->getMysqlObjectForAdmin();
		//проверяем, чтоб модуль был подключен в админзоне
		$query				= "SELECT count(*) FROM `$MYSQL_TABLE5` WHERE `name`='{$module_name}'";
		$result				= $mysqladmin->executeSQL($query);
		list($is_exists)	= $mysqladmin->fetchRow($result);
		if ($is_exists==0) {
			$this->editError[]=sprintf($MSGTEXT['compiler_error_module_is_not_set'], $module_name);
		}

		$query		= "SELECT `id`,`name` FROM `$MYSQL_CTR_TABLE23` WHERE `module_id`='{$this->m_id}'";
		$result		= $this->mysql->executeSQL($query);
		$blocks		= $this->mysql->fetchAssocAll($result);

		$query		= "SELECT $MYSQL_CTR_TABLE18.name, $MYSQL_CTR_TABLE18.id FROM `$MYSQL_CTR_TABLE18` WHERE $MYSQL_CTR_TABLE18.module_id='{$this->m_id}'";
		$result		= $this->mysql->executeSQL($query);
		$tables		= $this->mysql->fetchAssocAll($result);

		for ($i=0; $i<count($tables); $i++) {

			$query		= "SELECT f.pk, f.auto_incr, f.edittype_id, f.datatype_id, f.fieldname,  $MYSQL_CTR_TABLE20.datatype FROM  `$MYSQL_CTR_TABLE21` as `f`, `$MYSQL_CTR_TABLE20` WHERE f.table_id='{$tables[$i]['id']}' AND $MYSQL_CTR_TABLE20.id=f.datatype_id ";
			$result		= $this->mysql->executeSQL($query);
			$fields		= $this->mysql->fetchAssocAll($result);

			$pk_incr_in_table = false;
			foreach ($fields AS $ar) {
				if ($ar['pk']==1 && $ar['auto_incr']==1) $pk_incr_in_table=true;

				if ($ar['edittype_id']==4 && ($ar['datatype_id']!=2 && $ar['datatype_id']!=5 && $ar['datatype_id']!=6 && $ar['datatype_id']!=7 && $ar['datatype_id']!=8)) {
					$this->editError[]		= sprintf($MSGTEXT['compiler_badf_for_m'], '?act=t_c&do=edit&t_id='.$tables[$i]['id'], $tables[$i]['name'], $ar['fieldname']);
				}

			}

			if (!$pk_incr_in_table)	  {
				$this->editError[]		= sprintf($MSGTEXT['compiler_in_table_no_primary_key'], '?act=t_c&do=edit&t_id='.$tables[$i]['id'], $tables[$i]['name']);
			}
		}


		if (count($this->editError)>0)	return false;
		else return true;
	}



	/**
	 * Сохраняет в админку редактирование модуля
	 *
	 */
	function saveWorkModule() {
		GLOBAL $CMSProtection, $FILE_MANAGER, $MSGTEXT, $GENERAL_FUNCTIONS, $MODULES_PATH,$MODULES_PERFORMANCE_PATCH_NAME,$MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE31,  $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE7, $MYSQL_TABLE18, $MYSQL_TABLE12, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25,$MYSQL_CTR_TABLE26,$MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE30;

		//проверка лицензии на конструктор
		if (!$activated						= $CMSProtection->checkActivationConstructor()) {
			$this->editError[]				= $MSGTEXT['edit_data_need_to_by_ctr'];
			$this->smarty->assign('content_template',	'errors/errors_list.tpl');
			$this->smarty->assign('content_head',		$MSGTEXT['mod_constructor_save_mod']);
			$this->smarty->assign('errors',				$this->editError);
		}
		else {

			$this->checkData();

			//если при предыдущем сохранении произошла ошибка, тогда определяем действие
			if (SETTINGS_CTR_SAVE_TO_ADMIN_STAGE=='makeFilesDump' || SETTINGS_CTR_SAVE_TO_ADMIN_STAGE=='makeTablesDump') {
				$workFuncs			= 'cleanFuncs';
				$workFuncsMessages	= 'cleanFuncsMessages';
			}
			elseif (SETTINGS_CTR_SAVE_TO_ADMIN_STAGE=='saveChanges') {
				$workFuncs			= 'restoreFuncs';
				$workFuncsMessages	= 'restoreFuncsMessages';
			}
			elseif (SETTINGS_CTR_SAVE_TO_ADMIN_STAGE=='deleteFilesDump' || SETTINGS_CTR_SAVE_TO_ADMIN_STAGE=='deleteTablesDump') {
				$workFuncs			= 'cleanFuncs';
				$workFuncsMessages	= 'cleanFuncsMessages';
			}
			else {
				$workFuncs			= false;
				$workFuncsMessages	= false;
			}

			$this->smarty->assign('content_template',	'modules_forms/save_work_module_result.tpl');
			$this->smarty->assign('content_head',		$MSGTEXT['mod_constructor_save_mod']);
			$this->smarty->assign('editError',			$this->editError);
			$this->smarty->assign('workFuncs',			$workFuncs);
			$this->smarty->assign('workFuncsMessages',	$workFuncsMessages);
		}
	}

}

?>