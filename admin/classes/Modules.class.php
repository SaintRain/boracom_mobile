<?php
/**
 * класс для работы с модулями
 *
 */
class Modules  {

	/**
	 * смарти-класс
	 * @var class
	 */
	public		$smarty;

	/**
     * переменные из массива $_POST с заменёнными спец-символами
     *
     * @var array
     */
	public		$post;

	/**
     *  переменные из массива $_POST как они вводились пользователем (спец символы не заменены)
     *
     * @var array
     */
	public		$postr;

	/**
     *  экранированые переменные функцией addslashes() из массива $_POST 
     *
     * @var array
     */
	public		$posts;

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
     *  экранированые переменные функцией addslashes() из массива $_GET 
     *
     * @var array
     */
	public		$gets;

	/**
   	 * класс для работы с MYSQL
   	 *
   	 * @var unknown_type
   	 */
	public		$mysql;

	/**
     * Хранит переданные ошибки
     *
     * @var array
     */
	public 		$errorMsgs;

	/**
     * сообщения
     *
     * @var array
     */
	public  	$messages;



	/**
     * Конструктор
     * 
     * @param class $smarty
     */
	function Modules($mysql, $smarty, $post, $postr, $posts, $get, $getr, $gets,  $do) {

		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		$this->post		= $post;
		$this->postr	= $postr;
		$this->posts	= $posts;
		$this->get		= $get;
		$this->getr		= $getr;
		$this->gets		= $gets;

		switch ($do):
		case ('list'):				$this->modules_getlist(); 		break;
		case ('form_import'):		$this->modules_form_import(); 	break;
		case ('import'):			$this->modules_import(); 		break;
		case ('delete'):			$this->modules_delete(true); 	break;
		case ('edit'):				$this->modules_form_edit(); 	break;
		case ('saveedit'):			$this->modules_saveedit(); 		break;
		case ('settings'):			$this->modules_settings(); 		break;
		case ('settings_save'):		$this->modules_settings_save(); break;
		case ('managedata'):		$this->modules_managedata(); 	break;
		case ('edit_out_tpl'):		$this->edit_out_tpl(); 			break;
		case ('saveedit_out_tpl'):	$this->saveedit_out_tpl(); 		break;
		case ('copy_module_form'):	$this->copy_module_form(); 		break;
		case ('copy_module'):		$this->copy_module(); 			break;
		case ('export_module_data'):$this->export_module_data(); 	break;
		endswitch;
	}



	/**
	 * переписывает имя модуля на новое включая изм. в коде
	 *
	 * @param string $old_name
	 * @param string $new_name
	 * @return boolean
	 */

	function rename_module_files($old_name, $new_name) {
		GLOBAL $FILE_MANAGER, $GENERAL_FUNCTIONS, $MYSQL_TABLE5, $MYSQL_TABLE6, $MODULES_PATH, $MODULES_MANAGMENT_PATCH_NAME;

		$res						= true;

		$dir_import_settings		= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$old_name.'/management/import_settings/import_settings.php';
		$dir_import_settings_new	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$new_name.'/management/import_settings/import_settings.php';

		//подключаем массив $DATA с данными модуля
		include ($dir_import_settings);

		if (isset($DATA['MODULE'])) {
			$DATA['MODULE']['name']			= $new_name;
			$DATA['MODULE']['loaded_name']	= $new_name;

			$this->smarty->assign('data', var_export($DATA, true));
			$DATA_CONTENT	= $this->smarty->fetch($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/constructor/templates/compiler/import_settings.tpl');

			$res	= $FILE_MANAGER->putfile($dir_import_settings_new, $DATA_CONTENT);
		}
		else {
			$res	= false;
		}


		$module['name']	= $new_name;
		$pattern 		= '/\/\*[\S\s\w\W]{0,}\/\/\/\s*class\s*[0-9A-z]*\s*extends\s*[0-9A-z]*\s*{/ui';

		//обновляем библиотеку модуля
        if ($res) {
            $source_library_file_old = $_SERVER['DOCUMENT_ROOT'] . '/modules/' . $module['name'] . '/' . $old_name . '.php';
            $source_library_file = $_SERVER['DOCUMENT_ROOT'] . '/modules/' . $module['name'] . '/' . $module['name'] . '.php';

            //переименовываем файл модуля
            $res = $FILE_MANAGER->rename($source_library_file_old, $source_library_file);
            if ($res) {
                if (is_writable($source_library_file)) {
                    $block_file_content = $FILE_MANAGER->getfile($source_library_file);

                    $this->smarty->assign('module', $module);

                    $block_head = $this->smarty->fetch($_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/constructor/templates/compiler/library_head.tpl');
                    $block_file_content = preg_replace($pattern, $block_head, $block_file_content);

                    if ($fd = $FILE_MANAGER->fopen($source_library_file, 'w')) {
                        fwrite($fd, $block_file_content);
                        fclose($fd);
                    } else {
                        $res = false;
                    }
                } else {
                    $res = false;
                }
            }
        }

		//обновляем заголовки блоков
		if ($res) {
			//берём id копируемого модуля
			$query				= "SELECT `id` FROM `$MYSQL_TABLE5` WHERE `name`='{$this->postr['copy_module']}'";
			$result				= $this->mysql->executeSQL($query);
			list($module_id)	= $this->mysql->fetchRow($result);

			//берём блоки модуля
			$query				= "SELECT `id`, `name`, `description` FROM `$MYSQL_TABLE6` WHERE `module_id`='$module_id'";
			$result				= $this->mysql->executeSQL($query);
			$blocks				= $this->mysql->fetchAssocAll($result);

			foreach ($blocks as $block) {
				//обновляем заголовок блока
				$source_block_file	= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$module['name'].'/performance/'.$block['name'].'.php';

				if (is_writable($source_block_file)) {

					$block_file_content	= $FILE_MANAGER->getfile($source_block_file);

					$this->smarty->assign('module', $module);
					$this->smarty->assign('block', $block);

					$block_head 		= $this->smarty->fetch($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/constructor/templates/compiler/performance_block_head.tpl');
					$block_file_content	= preg_replace($pattern, $block_head, $block_file_content);

					if ($fd	= $FILE_MANAGER->fopen($source_block_file, 'w')) {
						fwrite($fd, $block_file_content);
						fclose($fd);
					}
					else {
						$res=false;
					}
				}
				else {
					$res=false;
				}
			}
		}

		return $res;
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
	 * Получает список файлов в заданной директории
	 *
	 * @param string $dir
	 * @param array $em
	 * @return array
	 */
	function ReadDirs($dir,$em){
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != '.' && $file != '..' ) {
					$tmp['dir']			= $dir;
					$tmp['file']		= $file;
					$tmp['fullname']	= $dir.$file;
					$em[]=$tmp;
					if(is_dir($dir.$file)) {
						$em=$this->ReadDirs($dir.$file.'/', $em);
					}
				}
			}
			closedir($handle);
		}
		return $em;
	}



	/**
	 * Обработка формы копирования модуля
	 *
	 */
	function copy_module() {
		GLOBAL $CMSProtection, $FILE_MANAGER, $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE5, $MODULES_MANAGMENT_PATCH_NAME, $MODULES_PATH;

		$new_name	= $this->postr['new_name'];
		if ($new_name=='') $bad_symbol	= true;

		//в имени модуля должны быть только латинские буквы
		if (preg_match("/^([A-Z0-9_\\/\.-]*)$/iu", $new_name)) {
			$bad_symbol	= false;
		}
		else {
			$bad_symbol	= true;
		}

		if 	($bad_symbol) {
			$message		= $MSGTEXT['incorrect_module_name'];
		}
		else {
			if (file_exists($MODULES_PATH.$new_name)) {
				$message	= sprintf($MSGTEXT['module_is_exists'], $new_name);
			}
		}

		if (isset($message)) {
			$this->smarty->assign('new_name',			$new_name);
			$this->smarty->assign('copy_module',		$this->post['copy_module']);
			$this->smarty->assign('message',			$message);
			$this->copy_module_form();

			return false;
		}

		$copy_module	= $this->postr['copy_module'];
		$copy_res		= $FILE_MANAGER->copyFolder($MODULES_PATH.$copy_module, $MODULES_PATH.$new_name);
		//$copy_res		= true;

		if ($copy_res==false) {
			$message	= sprintf($MSGTEXT['module_copy_error'], $MODULES_PATH);
			$FILE_MANAGER->removeFolder($MODULES_PATH.$new_name);
		}
		else {
			if (!$this->rename_module_files($copy_module, $new_name)) {
				$message	= $MSGTEXT['error_copy_module'];
				$FILE_MANAGER->removeFolder($MODULES_PATH.$new_name);
			}
			else {
				//переименовываем в init файле название модуля
				$CMSProtection->updateInit($new_name, $_SERVER['DOCUMENT_ROOT'].'/modules/'.$new_name.'/management/import_settings');
				$message	= sprintf($MSGTEXT['module_copied'], $new_name);
			}
		}


		//импортирование модуля
		if (isset($this->post['import'])) {

			$dir_import_settings		= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$new_name.'/management/import_settings/import_settings.php';

			//подключаем массив $DATA с данными модуля
			include_once($dir_import_settings);

			if (isset($DATA['MODULE'])) {
				$description			= $DATA['MODULE']['description'];
			}
			else {
				$description			= '';
			}

			$this->post['description']	= $description;
			$this->post['import_modul']	= $new_name;
			$this->modules_import();
		}
		else {
			$this->smarty->assign('copy_module',		$this->post['copy_module']);
			$this->smarty->assign('new_name',			$new_name);
			$this->smarty->assign('message',			$message);
			$this->copy_module_form();
		}
	}



	/**
	 * форма копирования модуля
	 *
	 */
	function copy_module_form(){
		GLOBAL $MSGTEXT, $MYSQL_TABLE5, $MODULES_PATH, $FILE_MANAGER;

		$home_dir	= $MODULES_PATH;
		$i			= 0;
		$message	= '';
		$modules	= array();

		if ($handle = opendir($home_dir)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != ".." ) {
					if (is_dir($home_dir.$file)  && mb_strpos($file, '__')===false) {
						$modules[]['filename']	= $file;
					}
				}
			}
			closedir($handle);
		}

		if (count($modules)==0) $message.=$MSGTEXT['list_havnot_modules'];
		else {
			foreach ($modules as $key=>$m) {
				$dir_modul				= $MODULES_PATH.$m['filename'];
				$dir_import_settings	= $dir_modul.'/management/import_settings/import_settings.php';

				//подключаем массив $DATA с данными модуля
				include_once($dir_import_settings);

				if (isset($DATA)) {
					if (isset($DATA['MODULE']['version']))	{
						$modules[$key]['version']	= $DATA['MODULE']['version'];
					}
					unset($DATA);
				}
			}
		}

		$this->smarty->assign('content_template',	'modules/modules_form_copy.tpl');
		$this->smarty->assign('modules', 			$modules);
		$this->smarty->assign('content_head',		$MSGTEXT['module_copy']);
		if ($message!='')
		$this->smarty->assign('message',			$message);
	}



	/**
	 * Сохраняем редактирование шаблона вывода
	 *
	 */
	function saveedit_out_tpl() {
		GLOBAL $GENERAL_FUNCTIONS, $FILE_MANAGER, $MSGTEXT, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE12, $MODULES_PATH, $MODULES_PERFORMANCE_PATCH_NAME;

		$query		= "SELECT `name` FROM `$MYSQL_TABLE12` WHERE `id`='{$this->get['tpl_id']}'";
		$result		= $this->mysql->executeSQL($query);
		list ($tpl_name)		= $this->mysql->fetchRow($result);


		$query		= "SELECT `module_id`, `name` FROM `$MYSQL_TABLE6` WHERE `id`='{$this->get['block_id']}'";
		$result		= $this->mysql->executeSQL($query);
		list ($module_id, $block_name)		= $this->mysql->fetchRow($result);


		$query		= "SELECT `name` FROM `$MYSQL_TABLE5` WHERE `id`='$module_id'";
		$result		= $this->mysql->executeSQL($query);
		list ($module_name)		= $this->mysql->fetchRow($result);


		$filename	= $MODULES_PATH.$module_name.'/'.$MODULES_PERFORMANCE_PATCH_NAME.'/'.$block_name.'Templates/'.$tpl_name;
		if (isset($this->postr['tplContent'])) {
			if ($file		= $FILE_MANAGER->fopen($filename, 'w')) {
				fwrite($file, $this->postr['tplContent']);
				fclose($file);
				$msg=$MSGTEXT['changes_save'];
			}
			else {
				$msg=$MSGTEXT['cannot_write'];
			}
			$this->smarty->assign('message', 		$msg);
		}

		$this->edit_out_tpl();
	}



	/**
	 * Форма редактирования шаблона вывода
	 *
	 */
	function edit_out_tpl() {
		GLOBAL 	$FILE_MANAGER, $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE7,  $MYSQL_TABLE12, $MODULES_PATH, $MODULES_PERFORMANCE_PATCH_NAME;

		$query		= "SELECT `name`, `module_id`, `description` FROM `$MYSQL_TABLE6` WHERE `id`='{$this->get['block_id']}'";
		$result		= $this->mysql->executeSQL($query);
		list ($block_name, $module_id, $block_description)		= $this->mysql->fetchRow($result);

		$query					= "SELECT `name` FROM `$MYSQL_TABLE5` WHERE `id`='$module_id'";
		$result					= $this->mysql->executeSQL($query);
		list ($module_name)		= $this->mysql->fetchRow($result);

		$query		= "SELECT * FROM `$MYSQL_TABLE12` WHERE `id`='{$this->get['tpl_id']}'";
		$result		= $this->mysql->executeSQL($query);
		$tpl		= $this->mysql->fetchAssoc($result);

		$filename		= $MODULES_PATH.$module_name.'/'.$MODULES_PERFORMANCE_PATCH_NAME.'/'.$block_name.'Templates/'.$tpl['name'];
		$tplContent 	= $FILE_MANAGER->getfile($filename);
		$tplContent		= htmlspecialchars($tplContent, ENT_QUOTES);
		$tpl['content']	= htmlspecialchars($tpl['content'], ENT_QUOTES);

		$parts		= explode('.', $tpl['name']);
		$tpl_type	= $parts[count($parts)-1];

		$tpl_dir	= 'modules/'.$module_name.'/'.$MODULES_PERFORMANCE_PATCH_NAME.'/'.$block_name.'Templates/';

		$this->smarty->assign('content_template',	'modules/modules_edit_out_tpl.tpl');
		$this->smarty->assign('tplContent', 		$tplContent);
		$this->smarty->assign('block_id', 			$this->get['block_id']);
		$this->smarty->assign('module_id', 			$module_id);
		$this->smarty->assign('tpl_dir', 			$tpl_dir);
		$this->smarty->assign('tpl_id', 			$this->get['tpl_id']);
		$this->smarty->assign('tplname', 			$tpl['description']);
		$this->smarty->assign('notModifedTpl', 		$tpl['content']);
		$this->smarty->assign('name', 				$tpl['name']);
		$this->smarty->assign('tpl_type', 			$tpl_type);

		$this->smarty->assign('content_head', 		sprintf($MSGTEXT['module_edit_tpl_out_block'], $block_description));
	}



	/**
	 * подключает модуль для редактироваия данных на странице
	 *
	 */
	function modules_managedata() {
		GLOBAL  $MSGTEXT, $GENERAL_FUNCTIONS, $MYSQL_TABLE2, $MYSQL_TABLE3, $MYSQL_TABLE4, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE7, $MYSQL_TABLE10, $MYSQL_TABLE11, $MYSQL_TABLE18, $MODULES_PATH, $MODULES_PERFORMANCE_PATCH_NAME;


		if (isset($this->get['fastEdit'])) {

			//устанавливаем правильный язык перехода
			if (!isset($this->gets['lang_id'])) {
				$anchor='';
				if (isset($this->gets['search'])) {
					if ($this->gets['search']>0) {
						$query			= "SELECT `lang_id` FROM `{$this->gets['t_name']}` WHERE `id`='{$this->gets['search']}'";
						$result			= $this->mysql->executeSQL($query);
						list($lang_id)	= $this->mysql->fetchRow($result);
						$anchor			= '#data form';
					}
				}
				else {
					if (isset($this->gets['l_id'])) {
						$query				= "SELECT `lang_id` FROM `{$this->gets['t_name']}` WHERE `lang_id`='{$this->gets['l_id']}' LIMIT 1";
						$result				= $this->mysql->executeSQL($query);
						list($l_id)			= $this->mysql->fetchRow($result);
						if (!$l_id) {
							$query			= "SELECT `lang_id` FROM `{$this->gets['t_name']}` LIMIT 1";
							$result			= $this->mysql->executeSQL($query);
							list($lang_id)	= $this->mysql->fetchRow($result);
						}
					}
				}

				if (isset($lang_id)) {
					$GENERAL_FUNCTIONS->gotoURL($_SERVER['REQUEST_URI'].'&lang_id='.$lang_id.$anchor);
					exit;
				}
			}

			//очищаем фильтр при переходе на быстрое редактирование записи
			if (isset($_SESSION['___GoodCMS']['data_filter']) && isset($this->get['search'])) {
				unset($_SESSION['___GoodCMS']['data_filter']);
			}
		}

		require_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/dictionary/configLanguage.php');  //подключаем языки материала

		//получаем данные редактируемой страницы
		if ($this->get['page_id']>0) {
			$query	= "SELECT t.*, t2.tamplates_id AS `tpl_id` FROM `$MYSQL_TABLE3` AS `t` LEFT JOIN `$MYSQL_TABLE10` AS `t2` ON (t2.id=t.templates_id) WHERE t.id='{$this->get['page_id']}'";
		}
		else {
			$query	= "SELECT t.*, t2.tamplates_id AS `tpl_id` FROM `$MYSQL_TABLE3` AS `t` LEFT JOIN `$MYSQL_TABLE10` AS `t2` ON (t2.id=t.templates_id) WHERE t.id='{$_SESSION['___GoodCMS']['page_id']}'";
		}
		$result		= $this->mysql->executeSQL($query);
		$page		= $this->mysql->fetchAssoc($result);
		$real_page	= $page;


		//берём новые теги подгружаемых шаблонов
		$tags	= $GENERAL_FUNCTIONS->getTagsTree($page['tpl_id'], $page['templates_id'], 0);

		//убираем из тегов повторяющиеся, а также те, которые подгружают шаблоны
		$blocks	= array();
		foreach ($tags AS $key=>$t) {
			if ($t['include_tpl_id']==0) {
				$blocks[$t['tag_id']]	= $t;
			}
		}


		//определяем редактируемый блок
		foreach ($blocks as $k=>$b) {

			if ($b['virtualtag_id']==$this->get['tag_id']) {
				$block	= $b;

				//если в шаблоне блока в режиме быстрого редактирования используется таблица из другого модуля
				if (isset($this->gets['fastEdit']) && isset($this->gets['t_name'])) {
					$query						= "SELECT `module_id` FROM `$MYSQL_TABLE18` WHERE `table_name`='{$this->gets['t_name']}'";
					$result						= $this->mysql->executeSQL($query);
					if (list($real_module_id)	= $this->mysql->fetchRow($result)) {
						$block['module_id']		= $real_module_id;
					}
				}
			}
		}


		if ($this->get['page_id']>0)	$_SESSION['___GoodCMS']['page_id']=$this->get['page_id'];
		$page_real	= $page;

		if (isset($block['id'])) {

			if ($block['global']==1) {
				$this->get['page_id']=0;

				if (!isset($_SESSION['___GoodCMS']['page_description']))	$_SESSION['___GoodCMS']['page_description']=$page;
				else 	$page	= $_SESSION['___GoodCMS']['page_description'];
			}
			elseif  ($block['global']==2) {
				$this->get['page_id']=-1;
				if (!isset($_SESSION['___GoodCMS']['page_description']))	$_SESSION['___GoodCMS']['page_description']=$page;
				else 	$page	= $_SESSION['___GoodCMS']['page_description'];
			}

			//подключаем модуль
			include ($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/classes/Management.class.php');
            if (isset($this->gets['lang_id'])) {
                  $lang_id  = $this->gets['lang_id'];
            }
			else if (isset($LANGUAGES_OF_MATERIAL[SETTINGS_LANGUAGE_OF_MATERIALS]['id'])) {
				$lang_id	= $LANGUAGES_OF_MATERIAL[SETTINGS_LANGUAGE_OF_MATERIALS]['id'];
			}
			else {
				$lang_id	= 0;
			}

			$obj			= new Management($this->mysql, $this->smarty,  $this->post, $this->postr, $this->posts, $this->get, $this->getr, $this->gets, $block, $lang_id);
			$this->smarty	= $obj->getSmarty();
			$smarty_temp	= $this->smarty;

			//проверяем открыто ли окно для редактирования файлов/картинок
			if (!isset($this->get['mdo'])) {
				$ImagesFiles=false;
			}
			elseif ($this->get['mdo']=='photos_form' || $this->get['mdo']=='photos_edit' || $this->get['mdo']=='photos_save_desc' || $this->get['mdo']=='files_form'  || $this->get['mdo']=='files_edit' || $this->get['mdo']=='files_save_desc')	{
				$ImagesFiles=true;
			}
			else {
				$ImagesFiles=false;
			}

			$smarty_temp->assign('ImagesFiles',				$ImagesFiles);

			if (!$ImagesFiles) {
				$smarty_temp->assign('LANGUAGES_OF_MATERIAL', 	$LANGUAGES_OF_MATERIAL);
				$smarty_temp->assign('blocks',					$blocks);
				$smarty_temp->assign('page', 					$page_real);
				$smarty_temp->assign('ImagesFiles', 			$ImagesFiles);
				$smarty_temp->assign('edit_block',				$block);
				$zakladky_content	= $smarty_temp->fetch('modules/modules_head.tpl');
				$smarty_temp->assign('zakladky',				$zakladky_content);
			}
		}
		else {
			//выводим ошибку, что путь не найден
			$this->smarty->assign('errors', 				$MSGTEXT['manege_error_link']);
			$zakladky_content								= $this->smarty->fetch('errors/errors_list.tpl');
			$this->smarty->assign('zakladky',				$zakladky_content);
		}
	}



	/**
	 * генерирует форму настроек
	 *
	 */
	function modules_settings() {
		GLOBAL $MSGTEXT,$MODULES_PATH, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE7, $MYSQL_TABLE12,  $MODULES_PATH, $MODULES_PERFORMANCE_PATCH_NAME;

		//берём информацию о блоке
		$query		= "SELECT $MYSQL_TABLE6.name AS `block_name`, $MYSQL_TABLE6.type, $MYSQL_TABLE6.act_variable, $MYSQL_TABLE6.act_method, $MYSQL_TABLE6.url_get_vars, $MYSQL_TABLE6.id, $MYSQL_TABLE5.id AS `module_id`, $MYSQL_TABLE5.name AS `module_name`, $MYSQL_TABLE6.description as `block_description` FROM `$MYSQL_TABLE5`, `$MYSQL_TABLE6`, `$MYSQL_TABLE7` WHERE $MYSQL_TABLE6.id='{$this->get['id']}' AND $MYSQL_TABLE6.module_id=$MYSQL_TABLE5.id";
		$result		= $this->mysql->executeSQL($query);
		$block		= $this->mysql->fetchAssoc($result);

		//берём id блоков модуля
		$blocks_ids 		= array();
		$query				= "SELECT `id` FROM `$MYSQL_TABLE6` WHERE `module_id`='{$block['module_id']}'";
		$result				= $this->mysql->executeSQL($query);
		while (list($b_id) 	= $this->mysql->fetchRow($result)) {
			$blocks_ids[]	= $b_id;
		}

		$own_settings			= false;
		$addittional_settings 	= false;
		if (count($blocks_ids)>0) {
			$blocks_ids	= implode(',', $blocks_ids);
			$settings	= array();
			$query		= "SELECT * FROM `$MYSQL_TABLE7` WHERE `block_id` IN ($blocks_ids)";
			$result		= $this->mysql->executeSQL($query);
			while ($row = $this->mysql->fetchAssoc($result)) {
				$row['value'] 	= htmlspecialchars($row['value'], ENT_QUOTES);
				$settings[]		= $row;
				if ($row['block_id']==$block['id']) {
					$own_settings=true;
				}
				else {
					$addittional_settings=true;
				}
			}
		}

		$temp	= array();
		$temp2	= array();
		foreach ($settings as $key=>$s) {
			if ($s['block_id']==$block['id']) {
				$temp[]=$s;
			}
			else {
				$temp2[]=$s;
			}
		}

		$settings	= array_merge($temp, $temp2);
		unset($temp);
		unset($temp2);

		$tplFiles	= array();
		$query		= "SELECT * FROM `$MYSQL_TABLE12` WHERE `block_id`='{$this->get['id']}' ORDER BY `sort_index`";
		$result		= $this->mysql->executeSQL($query);
		while ($row	= $this->mysql->fetchAssoc($result)) {
			$parts		= explode('.', $row['name']);
			$row['tpl_type']	= $parts[count($parts)-1];
			$tplFiles[]			= $row;
		}

		$this->smarty->assign('content_head', sprintf($MSGTEXT['module_block_settings'], $block['block_description']));

		if ($block['url_get_vars']!=''){
			$block['url_get_vars'] = str_replace(SETTINGS_NEW_LINE, '<br/>', $block['url_get_vars']);
		}

		$module_dir	= $MODULES_PATH.$block['module_name'].'/'.$MODULES_PERFORMANCE_PATCH_NAME.'/'.$block['block_name'].'Templates';
		$tpl_dir	= 'modules/'.$block['module_name'].'/'.$MODULES_PERFORMANCE_PATCH_NAME.'/'.$block['block_name'].'Templates/';
		$block_patch='modules/'.$block['module_name'].'/'.$MODULES_PERFORMANCE_PATCH_NAME.'/'.$block['block_name'].'.php';
		$this->smarty->assign('content_template',	'modules/modules_settings.tpl');
		$this->smarty->assign('block_id', 			$this->get['id']);
		$this->smarty->assign('settings', 			$settings);
		$this->smarty->assign('tpl_dir', 			$tpl_dir);
		$this->smarty->assign('tplFiles', 			$tplFiles);
		$this->smarty->assign('block', 				$block);
		$this->smarty->assign('block_patch', 		$block_patch);

		$form_template	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/templates/modules/modules_settings_elements.tpl';

		$this->smarty->assign('form_template', 				$form_template);
		$this->smarty->assign('own_settings', 				$own_settings);
		$this->smarty->assign('addittional_settings', 		$addittional_settings);
	}



	/**
	 * сохраняет редактирование настроек
	 *
	 */
	function modules_settings_save() {
		GLOBAL $GENERAL_FUNCTIONS, $MODULES_PATH, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE7;

		//берём id модуля
		$query		= "SELECT `module_id` FROM `$MYSQL_TABLE6` WHERE `id`='{$this->gets['block_id']}'";
		$result		= $this->mysql->executeSQL($query);
		list($m_id)	= $this->mysql->fetchRow($result);

		//берём id блоков модуля
		$blocks_ids	= array();
		$query		= "SELECT `id` FROM `$MYSQL_TABLE6` WHERE `module_id`='$m_id'";
		$result		= $this->mysql->executeSQL($query);
		while (list($block_id)	= $this->mysql->fetchRow($result)) {
			$blocks_ids[]	= $block_id;
		}

		//берём все настройки блоков
		if (count($blocks_ids)>0) {
			$blocks_ids	= implode(',', $blocks_ids);
			$settings	= array();
			$query		= "SELECT `id`, `name` FROM `$MYSQL_TABLE7` WHERE `block_id` IN ($blocks_ids)";
			$result		= $this->mysql->executeSQL($query);
			while ($row	= $this->mysql->fetchAssoc($result)) {
				if (!isset($this->posts[$row['name']])) {
					$settings[$row['id']]	= 0;  //неотмечен чекбокс
				}
				else {
					$settings[$row['id']]	= $this->posts[$row['name']];
				}
			}
		}

		foreach ($settings as $id=>$v) {
			$query	= "UPDATE `$MYSQL_TABLE7` SET `value`='$v' WHERE `id`='$id'";
			$this->mysql->executeSQL($query);
		}


		if (isset($this->get['close'])) {
			if (isset($this->get['fastEdit'])) {
				$GENERAL_FUNCTIONS->gotoURL('?act=modules&do=settings&id='.$this->get['block_id']."&fastEdit={$this->get['fastEdit']}&hide_menu=true&refresh=true&saved=true");
			}
			else {
				echo $this->smarty->fetch('closeself.tpl');
			}
		}
		else {
			$GENERAL_FUNCTIONS->gotoURL('?act=modules&do=settings&saved=true&id='.$this->get['block_id']);
		}

		exit;
	}



	/**
     * получаем список модулей
     *
     */    
	function modules_getlist() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT,$MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE7, $MODULES_PATH, $TEMPLATES_PATH, $MODULES_PERFORMANCE_PATCH_NAME;

		$_SESSION['___GoodCMS']['rdo']= 'list';

		$query			= "SELECT * FROM `$MYSQL_TABLE5`";
		$result			= $this->mysql->executeSQL($query);
		$allmodules		= $this->mysql->fetchAssocAll($result);

		$sort			= $GENERAL_FUNCTIONS->getSortVariables('name');
		$allmodules		= $GENERAL_FUNCTIONS->sort_massiv($sort['sort_type'], $allmodules);
		$obj			= $GENERAL_FUNCTIONS->form_navigations(20, $allmodules, '?act=modules&sort_by='.$sort['sort_by'].'&sort_type='.$sort['sort_type']);
		$modules		= $obj['records'];
		$pages			= $obj['pages'];

		$query		= "SELECT `module_id`, `name` AS `block_name`, `id` AS `block_id`, `description` as `block_description` FROM `$MYSQL_TABLE6`";
		$result		= $this->mysql->executeSQL($query);
		while ($row	= $this->mysql->fetchAssoc($result)) {
			$blocks[$row['module_id']][]=$row;
		}

		for ($i=0; $i<count($modules); $i++) {
			if (isset($blocks[$modules[$i]['id']])) $modules[$i]['blocks']=$blocks[$modules[$i]['id']];
		}

		$this->smarty->assign('pages', 				$pages);
		$this->smarty->assign('message', 			$this->messages);
		$this->smarty->assign('content_template',	'modules/modules_list.tpl');
		$this->smarty->assign('modules',			$modules);
		$this->smarty->assign('content_head',		$MSGTEXT['modules']);
		$this->smarty->assign('sort_by',			$sort['sort_by']);
		$this->smarty->assign('sort_type',			$sort['sort_type']);
	}



	/**
     * форма импорта модуля
     *
     */
	function modules_form_import() {
		GLOBAL $FILE_MANAGER, $MSGTEXT, $MYSQL_TABLE5, $MODULES_PATH, $MODULES_MANAGMENT_PATCH_NAME;

		//поиск модулей
		$home_dir	= $MODULES_PATH;
		$i			= 0;
		$message	= '';
		$modules	= array();

		if ($handle = opendir($home_dir)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != '.' && $file != '..' ) {

					if (is_dir($home_dir.$file) && mb_strpos($file, '__')===false) {
						$fname		= $file;
						$query		= "SELECT count(*) FROM `$MYSQL_TABLE5` WHERE `name`='$fname'";
						$result		= $this->mysql->executeSQL($query);
						list($m_is)	= $this->mysql->fetchRow($result);
						if ($m_is==0) {
							$modules[$i]['filename']	= $file;

							//берем описание
							$dir_import_settings		= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$file.'/management/import_settings/import_settings.php';

							//подключаем массив $DATA с данными модуля
							include_once($dir_import_settings);

							if (isset($DATA['MODULE'])) {
								$description							= $DATA['MODULE']['description'];
								if (isset($DATA['MODULE']['version']))	{
									$modules[$i]['version']	= $DATA['MODULE']['version'];
								}
							}
							else {
								$description='';
							}

							$modules[$i]['description']=$description;
							unset($d);
							$i++;
						}
					}
				}
			}
			closedir($handle);
		}

		if (count($modules)==0) $message.=$MSGTEXT['in_listimport_no_modules'];

		$this->smarty->assign('content_template',	'modules/modules_form_import.tpl');
		$this->smarty->assign('modules', 			$modules);
		$this->smarty->assign('content_head',		$MSGTEXT['module_import']);
		$this->smarty->assign('message',			$message);
		$this->smarty->assign('messages',			$this->messages);

	}



	/**
     * обработка формы импорта модуля
     *
     */
	function modules_import() {
		GLOBAL $FILE_MANAGER, $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE7, $MYSQL_TABLE17, $MYSQL_TABLE18, $MYSQL_TABLE12, $MODULES_PATH, $TEMPORARY_DIR, $MODULES_PERFORMANCE_PATCH_NAME, $MODULES_MANAGMENT_PATCH_NAME;

		if (isset($this->post['import_modul'])) {
			$import_try	= true;
			$need_modules=array();

			$dir_modul				= $MODULES_PATH.$this->post['import_modul'];
			$dir_import_settings	= $dir_modul.'/management/import_settings/import_settings.php';

			if (!file_exists($dir_modul) || !file_exists($dir_import_settings)) $error[]=$MSGTEXT['cannot_read_module_patch'];

			if (!isset($error)) {
				$module_name	= $this->post['import_modul'];

				//подключаем массив $DATA с данными модуля
				include ($dir_import_settings);

				if ($DATA) {
					if (isset($DATA['MODULE']['version'])) {
						$version		=  $DATA['MODULE']['version'];
					}

					//проверяем добавлен ли уже модуль с таким именем
					$query				= "SELECT count(*) FROM `$MYSQL_TABLE5` WHERE `name`='$module_name'";
					$result				= $this->mysql->executeSQL($query);
					list($is_module)	= $this->mysql->fetchRow($result);

					if ($is_module==0)  {

						//добавляем описание модуля
						$query		= "INSERT INTO `$MYSQL_TABLE5` (`name`, `version`, `description`) VALUES ('$module_name', '$version', '{$this->post['description']}')";
						$this->mysql->executeSQL($query);
						$module_id	= $this->mysql->insertID();

						//делаем импорт структуры таблиц, которые используются модулем
						$sk		= false;
						$sk		= false;
						$start	= 0;
						$q_text	= $DATA['BDSTRUCTURE'];

						$module_name_lower	= mb_strtolower($module_name);
						foreach ($q_text as $t_name=>$sql_arr) {
							foreach ($sql_arr as $sql) {
								$new_t_name	= $module_name_lower.'_'.$t_name;
								if ((mb_strpos($sql, 'DROP TABLE IF EXISTS'))>-1) $sql2	= str_replace("DROP TABLE IF EXISTS `$t_name`",	"DROP TABLE IF EXISTS `$new_t_name`", $sql);
								else	$sql2		= str_replace("CREATE TABLE `$t_name`",	"CREATE TABLE `$new_t_name`", $sql);
								$this->mysql->executeSQL($sql2);
							}
						}

						//записываем настройки таблиц и полей
						$tables_ids	= array();
						if (isset($DATA['TABLES'])) {
							foreach ($DATA['TABLES'] as $b_table) {

								$b_table['table_name']				= $module_name_lower.'_'.$b_table['table_name'];
								$query								= "INSERT INTO `$MYSQL_TABLE18` (`table_name`, `description`, `show_type`, `additional_buttons`, `module_id`, `sort_index`) VALUES ('{$b_table['table_name']}', '{$b_table['description']}', '{$b_table['show_type']}', '{$b_table['additional_buttons']}', '$module_id',  '{$b_table['sort_index']}')";
								$this->mysql->executeSQL($query);
								$new_block_table_id					= $this->mysql->insertID();
								$tables_ids[$b_table['id']]			= $new_block_table_id;

								//записываем настройки таблиц полей
								$fields_settings_val='';
								if (count($b_table['fields_settings'])>0) {
									foreach ($b_table['fields_settings'] as $t_fields) {
										if (!isset($t_fields['unique'])) $t_fields['unique']		= 0;
										if (!isset($t_fields['notfedit'])) $t_fields['notfedit']	= 0;
										if ($t_fields['collation_id']==0 || $t_fields['collation_id']=='')  {
											$t_fields['collation_id']='NULL';
										}

										if ($t_fields['datatype_id']==0 || $t_fields['datatype_id']=='')  {
											$t_fields['datatype_id']='NULL';
										}
										if ($t_fields['edittype_id']==0 || $t_fields['edittype_id']=='')  {
											$t_fields['edittype_id']='NULL';
										}

										$t_fields=$GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($t_fields);

										//формирует полное имя таблицы - источника
										if (isset($t_fields['sourse_module_name']) && $t_fields['sourse_module_name']!='' && $t_fields['sourse_table_name']!='') {
											$t_fields['sourse_table_name']		= mb_strtolower($t_fields['sourse_module_name']).'_'.$t_fields['sourse_table_name'];

											//проверяем, установлен ли в системе модуль, в котором находится таблица - источник
											$query					= "SELECT COUNT(*) FROM `$MYSQL_TABLE5` WHERE `name`='{$t_fields['sourse_module_name']}'";
											$result					= $this->mysql->executeSQL($query);
											list($is_exist_module)	= $this->mysql->fetchRow($result);
																		
											if ($is_exist_module==0) {
												$need_modules[]=$t_fields['sourse_module_name'];
											}
										}
										else {
											if ($t_fields['sourse_table_name']!='') {
												$t_fields['sourse_table_name']	= $module_name_lower.'_'.$t_fields['sourse_table_name'];
											}
										}

										$fields_settings_val.="(
											'$new_block_table_id',
											'{$t_fields['fieldname']}',
											'{$t_fields['comment']}', 
											{$t_fields['datatype_id']}, 
											'{$t_fields['len']}', 
											'{$t_fields['default']}', 
											{$t_fields['collation_id']},
											'{$t_fields['group_caption']}',											
											'{$t_fields['not_null']}',
											'{$t_fields['unsigned']}', 
											'{$t_fields['zerofill']}', 
											'{$t_fields['unique']}', 											
											'{$t_fields['notfedit']}', 																						
											{$t_fields['edittype_id']},
											'{$t_fields['active']}',
											'{$t_fields['show_in_list']}',
											'{$t_fields['filter']}',
											'{$t_fields['delete']}',
											'{$t_fields['own_filter']}',											
											'{$t_fields['regex']}',
											'{$t_fields['height']}', 
											'{$t_fields['width']}', 
											'{$t_fields['style']}', 
											'{$t_fields['sourse_field_name']}', 
											'{$t_fields['sourse_table_name']}', 
											'{$t_fields['auto_incr']}', 
											'{$t_fields['pk']}',
											'{$t_fields['hide_by_field_caption']}', 
											'{$t_fields['hide_operator']}', 
										 	'{$t_fields['hide_on_value']}', 										 	 
											'{$t_fields['avator_quality']}',
											'{$t_fields['avator_width']}',
											'{$t_fields['avator_height']}',
											'{$t_fields['avator_quality_big']}',
											'{$t_fields['avator_width_big']}',
											'{$t_fields['avator_height_big']}',															 	 
											'{$t_fields['sort_index']}'),";
									}
								}

								if ($fields_settings_val!='') {
									$fields_settings_val	= mb_substr($fields_settings_val, 0, -1);

									$query="INSERT INTO `$MYSQL_TABLE17`
										(`table_id`,
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
										`sort_index`)
										 VALUES $fields_settings_val";

									$this->mysql->executeSQL($query);
								}
							}
						}


						//добавляем блоки
						foreach ($DATA['BLOCKS'] as $block) {
							$block = $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($block);

							if (file_exists($dir_modul.'/'.$MODULES_PERFORMANCE_PATCH_NAME.'/'.$block['name'].'.php')) {

								//берем ID таблицы из админки
								if (isset($tables_ids[$block['general_table_id']])) $block['general_table_id']	= $tables_ids[$block['general_table_id']];
								else  $block['general_table_id']='NULL';


								//добавляем блок
								$query		= "INSERT INTO `$MYSQL_TABLE6`  (`module_id`, `type`, `name`, `description`, `act_variable`, `act_method`, `url_get_vars`, `general_table_id`, `sort_index`) VALUES ('$module_id', '{$block['type']}', '{$block['name']}', '{$block['description']}', '{$block['act_variable']}', '{$block['act_method']}', '{$block['url_get_vars']}', {$block['general_table_id']}, '{$block['sort_index']}')";
								$this->mysql->executeSQL($query);
								$block['new_id']	=  $this->mysql->insertID();

								//записываем в БД переменные настроек блоков
								$settings_val='';
								foreach ($block['settings'] as $b_settings) {
									$settings_val.="('{$block['new_id']}', '{$b_settings['edit_s_type_id']}', '{$b_settings['name']}', '{$b_settings['value']}', '{$b_settings['description']}'),";
								}

								if ($settings_val!='') {
									$settings_val	= mb_substr($settings_val,0,-1);
									$query			= "INSERT INTO `$MYSQL_TABLE7`  (`block_id`, `type`, `name`, `value`, `description`) VALUES $settings_val";

									$this->mysql->executeSQL($query);
								}


								//записываем в БД описание шаблонов блока
								foreach ($block['templates'] as $b_templates) {
									$tpl_name	= $MODULES_PATH.$module_name.'/'.$MODULES_PERFORMANCE_PATCH_NAME.'/'.$block['name'].'Templates/'.$b_templates['name'];

									if (file_exists($tpl_name)) {
										$content	 = $FILE_MANAGER->getfile($tpl_name);
										$content 	 = $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($content);

										$query		= "INSERT INTO `$MYSQL_TABLE12`  (`block_id`, `name`, `description`, `content`, `sort_index` ) VALUES ('{$block['new_id']}' , '{$b_templates['name']}',  '{$b_templates['description']}', '$content',  '{$b_templates['sort_index']}')";
										$this->mysql->executeSQL($query);
									}
								}
							}
						}
					}
				}
			}
		}

		//если при импорте произошли ошибки, то удаляем все следы импорта
		if (isset($error))	{
			if ($import_try) {
				$this->get['id']=$module_id;

				$this->modules_delete(false);
			}

			$this->smarty->assign('error', $error);
			$message	= $MSGTEXT['module_not_added'];
		}
		else  {
			if (isset($module_name) && isset($DATA)) {
				$message	= $MSGTEXT['module_is_added'];
			}
			else {
				$message	= $MSGTEXT['module_not_added'];
			}
		}

		$this->smarty->assign('import_result', $message);

		//выводим ошибки
		if (isset($error))	{
			$this->modules_form_import();
		}
		else {
			//формируем сообщение о неообхгодимости установить другие модули
			if ($need_modules) {
				$this->messages[]=sprintf($MSGTEXT['module_need_other_modules'], implode(',', $need_modules));
			}

			if (isset($module_name) && isset($DATA)) {
				$this->progressImportTablesData($module_name, $DATA);
			}
			else {

				$this->modules_form_import();
			}
		}
	}



	/**
	 * Выводит форму добавления записей в таблицы импортируемого модуля
	 *
	 * @param string $module_name
	 * @param array $DATA
	 */
	function progressImportTablesData($module_name, $DATA) {
		GLOBAL $FILE_MANAGER, $GENERAL_FUNCTIONS, $MSGTEXT;

		$total_records	= 0;
		//подсчитываем количество всех записей
		if (isset($DATA['TABLES_DATA'])) {

			$data			= $DATA['TABLES_DATA'];
			$t_info			= array();

			foreach ($data as $t=>$d) {
				$records	= count($d);
				if ($records>0) {
					$temp['table_name']			= $t;
					$temp['table_data_count']	= $records;
					$t_info[]					= $temp;
					$total_records				= $total_records+$records;
				}
			}
			unset($DATA);
		}

		if ($total_records>0) {
			$t_info							= $GENERAL_FUNCTIONS->get_javascript_array($t_info, 't_info');
			$import_tablesdata_title		= sprintf($MSGTEXT['import_tablesdata_title'], $module_name);

			$this->smarty->assign('total_records', 				$total_records);
			$this->smarty->assign('t_info', 					$t_info);
			$this->smarty->assign('content_template',			'modules/modules_form_import_progress.tpl');
			$this->smarty->assign('module_name', 				$module_name);
			$this->smarty->assign('content_head',				$MSGTEXT['module_import']);
			$this->smarty->assign('import_tablesdata_title',	$import_tablesdata_title);
			$this->smarty->assign('messages',					$this->messages);
		}
		else {
			$this->modules_form_import();
		}
	}



	/**
     * удалить модуль
     *
     */
	function modules_delete($go=null) {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE2, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE4, $MYSQL_TABLE10, $MYSQL_TABLE11, $MYSQL_TABLE13, $MYSQL_TABLE7, $MYSQL_TABLE12, $MYSQL_TABLE17, $MYSQL_TABLE18, $MODULES_PATH, $MODULES_PERFORMANCE_PATCH_NAME;

		$query	= "SELECT b.id as `block_id`, tr.description, vt.name,  vt.id, t.virtualtagname FROM `$MYSQL_TABLE6` AS `b`, `$MYSQL_TABLE11` AS `t`
		LEFT JOIN `$MYSQL_TABLE10` AS `vt` ON (vt.id=t.virtualtemplate_id)
		LEFT JOIN `$MYSQL_TABLE2` AS `tr` ON (tr.id=vt.tamplates_id)
		WHERE b.module_id={$this->get['id']} AND b.id=t.block_id";
		$result	= $this->mysql->executeSQL($query);
		$c		= $this->mysql->fetchAssoc($result);


		if ($c['name']!='') {
			$this->messages[]=sprintf($MSGTEXT['module_cannot_d_if_used'], $c['id'], $c['description'], $c['name'], $c['virtualtagname']);

			$this->modules_getlist();
		}

		else {
			//удаляем таблицы

			//удаляем таблицы модуля
			$query	= "SELECT `name`, `id` FROM `$MYSQL_TABLE5` WHERE `id`='{$this->get['id']}'";
			$result	= $this->mysql->executeSQL($query);
			list($module_name, $module_id)=$this->mysql->fetchRow($result);

			$query		= "SELECT `table_name`, `id` FROM `$MYSQL_TABLE18` WHERE `module_id`='{$module_id}'";
			$result		= $this->mysql->executeSQL($query);
			$t_b_names	= $this->mysql->fetchAssocAll($result);
			$s			= '';
			$ids		= array();
			foreach ($t_b_names as $t) {
				$s.="`{$t['table_name']}`,";
				$ids[]	= $t['id'];
			}

			//удаляем таблицы физически из базы
			if ($s!='') {
				$s				= mb_substr($s,0,-1);
				$query			= 'DROP TABLE '.$s;
				$result			= $this->mysql->executeSQL($query);
			}

			$query	= "SELECT $MYSQL_TABLE6.name AS `block_name`, $MYSQL_TABLE6.id AS `block_id` FROM  `$MYSQL_TABLE6` WHERE $MYSQL_TABLE6.module_id='$module_id'";
			$result	= $this->mysql->executeSQL($query);
			$blocks	= $this->mysql->fetchAssocAll($result);

			//удаляем записи о модуле
			$query	= "DELETE FROM `$MYSQL_TABLE5` WHERE `id`='{$this->get['id']}'";
			$result	= $this->mysql->executeSQL($query);

			$query	= "DELETE FROM `$MYSQL_TABLE6` WHERE `module_id`='{$this->get['id']}'";
			$result	= $this->mysql->executeSQL($query);



			if (count($ids)>0) {
				$s_ids	= implode(',', $ids);

				//удаляем индексы таблиц
				$query	= "DELETE FROM  `$MYSQL_TABLE18` WHERE `id` IN ($s_ids)";
				$result	= $this->mysql->executeSQL($query);

				//берем все поля таблиц модуля
				$fields_id		= array();
				$query			= "SELECT `id` FROM `$MYSQL_TABLE17` WHERE `table_id` IN ($s_ids)";
				$result			= $this->mysql->executeSQL($query);
				while ($row 	= $this->mysql->fetchAssoc($result)) {
					$fields_id[]= $row['id'];
				}

				if (count($fields_id)>0)	 {
					$fields_id = implode(',', $fields_id);
					//удаляем составные записи для полей с типом редактирования MultySelect
					$query	= "DELETE FROM `$MYSQL_TABLE13`  WHERE field_id IN ($fields_id)";
					$this->mysql->executeSQL($query);
				}

				//удаляем настройки полей таблиц блоков
				$query	= "DELETE FROM `$MYSQL_TABLE17` WHERE `table_id` IN ($s_ids)";
				$this->mysql->executeSQL($query);
			}


			for ($i=0; $i<count($blocks); $i++) {

				//удаляем настройки блоков
				$query	= "DELETE FROM `$MYSQL_TABLE7` WHERE `block_id`='{$blocks[$i]['block_id']}'";
				$this->mysql->executeSQL($query);

				//удаляем информацию об шаблонах
				$query	= "DELETE FROM `$MYSQL_TABLE12` WHERE `block_id`='{$blocks[$i]['block_id']}'";
				$this->mysql->executeSQL($query);

				//переписываем индексы для тегов
				$query	= "UPDATE `$MYSQL_TABLE11` SET `block_id`='0' WHERE `block_id`='{$blocks[$i]['block_id']}'";
				$this->mysql->executeSQL($query);
			}

			if ($go!=null) $GENERAL_FUNCTIONS->gotoURL('?act=modules&page');
		}
	}



	/**
     * форма редактирования описания модуля
     *
     */
	function modules_form_edit() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE5;

		if (count($this->errorMsgs)==0) {
			$query	= "SELECT * FROM `$MYSQL_TABLE5` WHERE `id`='{$this->get['id']}'";
			$result	= $this->mysql->executeSQL($query);
			$row	= $this->mysql->fetchAssoc($result);
			foreach  ($row as $key=>$value) $this->smarty->assign($key, $value);
		}

		$this->smarty->assign('content_template', 'modules/modules_form_edit.tpl');
		$this->smarty->assign('content_head', $MSGTEXT['module_edit_description']);
		$this->smarty->assign('errors', $this->errorMsgs);
	}



	/**
     * сохранение редактирования шаблона
     *
     */
	function modules_saveedit() {
		GLOBAL $MSGTEXT, $FILE_MANAGER, $GENERAL_FUNCTIONS, $MYSQL_TABLE5;

		$query						= "SELECT * FROM `$MYSQL_TABLE5` WHERE `id`='{$this->postr['id']}'";
		$result						= $this->mysql->executeSQL($query);
		$module_info				= $this->mysql->fetchAssoc($result);

		$dir_import_settings		= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$module_info['name'].'/management/import_settings/import_settings.php';

		//подключаем массив $DATA с данными модуля
		include_once($dir_import_settings);

		if (isset($DATA['MODULE'])) {
			$description					= htmlspecialchars($this->postr['description'], ENT_QUOTES);
			$DATA['MODULE']['description']	= $description;

			$this->smarty->assign('data', var_export($DATA, true));
			$DATA_CONTENT	= $this->smarty->fetch($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/constructor/templates/compiler/import_settings.tpl');

			if ($FILE_MANAGER->putfile($dir_import_settings, $DATA_CONTENT)) {

				$query			= "UPDATE `$MYSQL_TABLE5` SET `description`='$description' WHERE `id`='{$this->postr['id']}'";
				$this->mysql->executeSQL($query);
				$GENERAL_FUNCTIONS->gotoURL('?act=modules');
			}
			else {
				foreach  ($this->postr as $key=>$value) $this->smarty->assign($key, $value);
				$this->get['id']=$this->postr['id'];
				$this->errorMsgs[]	= sprintf($MSGTEXT['cannot_change_mod_description'], $dir_import_settings);
				$this->modules_form_edit();
			}
		}
		else {
			foreach  ($this->postr as $key=>$value) $this->smarty->assign($key, $value);
			$this->get['id']=$this->postr['id'];
			$this->errorMsgs[]	= sprintf($MSGTEXT['cannot_change_read_description'], $dir_import_settings);
			$this->modules_form_edit();
		}

		unset($DATA);
	}



	/**
	 * Выгружает данные из таблиц в папку модуля
	 *
	 */
	function export_module_data() {
		GLOBAL $MSGTEXT, $FILE_MANAGER, $GENERAL_FUNCTIONS, $MYSQL_TABLE5, $MYSQL_TABLE13, $MYSQL_TABLE17, $MYSQL_TABLE18;

		$query				= "SELECT * FROM `$MYSQL_TABLE5` WHERE `id`='{$this->get['id']}'";
		$result				= $this->mysql->executeSQL($query);
		$module_info		= $this->mysql->fetchAssoc($result);

		$query				= "SELECT `table_name` FROM `$MYSQL_TABLE18` WHERE `module_id`='{$this->get['id']}'";
		$result				= $this->mysql->executeSQL($query);
		$tables				= $this->mysql->fetchAssocAll($result);

		$prefix_len			= mb_strlen($module_info['name'])+1;

		$datamassiv			= array();
		foreach ($tables as $t) {
			$query			= "SELECT * FROM `{$t['table_name']}`";
			$result			= $this->mysql->executeSQL($query);
			$data			= $this->mysql->fetchAssocAll($result);

			$tn_no_prefix	= mb_substr($t['table_name'], $prefix_len);
			$datamassiv[$tn_no_prefix]	= $data;
		}

		//получаем файл настроек модуля
		$dir_import_settings		= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$module_info['name'].'/management/import_settings/import_settings.php';

		//подключаем массив $DATA с данными модуля
		include_once($dir_import_settings);

		$DATA['TABLES_DATA']		= $datamassiv;

		//берем данные, которые являются системными
		$datamassiv_system	= array();
		$fields				= array();
		$query				= "SELECT t.id FROM `$MYSQL_TABLE17` AS `t`, `$MYSQL_TABLE18` AS `t2` WHERE t2.module_id='{$this->get['id']}' AND t.table_id=t2.id";
		$result				= $this->mysql->executeSQL($query);
		while (list($field_id) = $this->mysql->fetchRow($result)) {
			$fields[]		   = $field_id;
		}

		if (count($fields)>0) {
			$fields								= implode(',', $fields);
			$query								= "SELECT `field_id`, `data_id`,`value_id` FROM `$MYSQL_TABLE13` WHERE field_id IN ($fields)";
			$result								= $this->mysql->executeSQL($query);
			$cms_multiselect_data				= $this->mysql->fetchAssocAll($result);
			$datamassiv_system[$MYSQL_TABLE13]	= $cms_multiselect_data;
		}

		$DATA['TABLES_DATA_MULTISELECT']		= $datamassiv_system;


		//запись в файл
		if (is_writable($dir_import_settings)) {
			if ($fd = $FILE_MANAGER->fopen($dir_import_settings, 'w')) {

				$this->smarty->assign('data', var_export($DATA, true));
				$DATA_CONTENT	= $this->smarty->fetch($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/constructor/templates/compiler/import_settings.tpl');

				fwrite($fd, $DATA_CONTENT);
				fclose($fd);
				$this->messages[]		= sprintf($MSGTEXT['export_module_data_ok'], $module_info['name']);

				//формируем дату выгрузки
				$data_export_datetime	= $GENERAL_FUNCTIONS->userDateTime(gmdate('Y-m-d H:i:s'), SETTINGS_TIMEZONE, 'Y-m-d H:i:s');

				$query					= "UPDATE `$MYSQL_TABLE5` SET `data_export_datetime`='$data_export_datetime' WHERE `id`='{$this->get['id']}'";
				$result					= $this->mysql->executeSQL($query);
			}
		}
		else $this->messages[]			= sprintf($MSGTEXT['mod_constructor_err_writefile'], $dir_import_settings);

		$this->modules_getlist();
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