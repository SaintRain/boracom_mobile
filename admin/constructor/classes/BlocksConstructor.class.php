<?php
/**
 * класс для работы с блоками
 *
 */
class BlocksConstructor  {

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
   	 * @var unknown_type
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
     * нужно ли обновлять левы фрейм
     *
     * @var bool
     */
	public	 	$refreshFrame;



	/**
     * Конструктор
     * 
     * @param class $smarty
     */
	function BlocksConstructor($mysql, $smarty, $post, $postr, $get, $getr,  $do) {
		GLOBAL $MSGTEXT;

		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		$this->post		= $post;
		$this->get		= $get;
		$this->postr	= $postr;
		$this->getr		= $getr;

		if (isset($_SESSION['___GoodCMS']['m_id'])) {
			$this->m_id		= $_SESSION['___GoodCMS']['m_id'];

			switch ($do):
			case ('list'):					$this->getList(); 			break;
			case ('add'):					$this->form_add(); 			break;
			case ('insert'):				$this->insert(); 			break;
			case ('edit'):					$this->form_edit(); 		break;
			case ('delete'):				$this->delete(); 			break;
			case ('saveedit'):				$this->saveEdit();	 		break;
			case ('move_block_item'):		$this->moveblockItem(); 	break;
			endswitch;
		}
		else {
			$this->editError	= $MSGTEXT['error_accsess_to_constructor'];

			$this->smarty->assign('errors',	$this->editError);
			$this->smarty->assign('content_template',	'errors/errors_list.tpl');
		}
	}



	/**
	 * получаем список блоков
	 *
	 */
	function getList() {
		GLOBAL $MSGTEXT, $GENERAL_FUNCTIONS, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE18;

		if (isset($this->get['page']) && $this->get['page']!='') $_SESSION['___GoodCMS']['BACK_RECORD_URL']='?'.$_SERVER['QUERY_STRING'];

		if (isset($this->get['b_id'])) {
			$b_id	= $this->get['b_id'];
			$where	= " AND b.id='$b_id'";
		}
		else $where='';

		$query			= "SELECT b.*, t.description AS `general_table_id_caption` FROM `$MYSQL_CTR_TABLE23` AS `b` LEFT JOIN `$MYSQL_CTR_TABLE18` AS `t` ON (t.id=b.general_table_id) WHERE b.module_id='{$this->m_id}' $where ORDER BY b.sort_index";
		$result			= $this->mysql->executeSQL($query);
		$allBlocks		= $this->mysql->fetchAssocAll($result);
		$sort			= $GENERAL_FUNCTIONS->getSortVariables('name');		
		$allBlocks		= $GENERAL_FUNCTIONS->sort_massiv_by_int($sort['sort_type'],     	$allBlocks);

		$this->smarty->assign('content_template',	'blocks/blocks_list.tpl');
		$this->smarty->assign('blocks',				$allBlocks);
		$this->smarty->assign('refreshFrame',		$this->refreshFrame);
		$this->smarty->assign('content_head',		$MSGTEXT['block_constr_block']);
		$this->smarty->assign('sort_by',			$sort['sort_by']);
		$this->smarty->assign('sort_type',			$sort['sort_type']);
	}



	/**
     * форма создания блока
     *
     */
	function form_add () {
		GLOBAL  $MSGTEXT, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE19, $MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE24;

		//берем все таблицы
		$query		= "SELECT t.*, b.general_table_id, b.name AS `block_name`, b.description AS `block_description` FROM `$MYSQL_CTR_TABLE18` AS `t` LEFT JOIN `$MYSQL_CTR_TABLE23` AS `b` ON (b.general_table_id=t.id) WHERE t.module_id='{$this->m_id}' GROUP BY t.id ORDER BY t.sort_index";
		$result		= $this->mysql->executeSQL($query);
		$tables		= $this->mysql->fetchAssocAll($result);

		$this->smarty->assign('content_template',	'blocks/blocks_form_add.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['block_constr_create_block']);
		$this->smarty->assign('tables',				$tables);
	}



	/**
	 * устанавливает порядок сортировки модулей
	 *
	 */
	function moveblockItem() {
		GLOBAL  $MSGTEXT, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE23;

		$id			= $this->get['id'];
		$query		= "SELECT * FROM  `$MYSQL_CTR_TABLE23` WHERE  `id`='$id'";
		$result		= $this->mysql->executeSQL($query);
		$cat		= $this->mysql->fetchAssoc($result);

		$query		= "SELECT * FROM  `$MYSQL_CTR_TABLE23` WHERE `module_id`='{$this->m_id}' ORDER BY `sort_index`";
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
							$this->smarty->assign('message',		$MSGTEXT['block_constr_no_up']);
							$next	= 0;
						}
					}
					elseif ($this->get['type']=='down') {
						if ($i<count($catItems)-1) $next = $i+1;
						else {
							$this->smarty->assign('message',		$MSGTEXT['block_constr_no_down']);
							$next	= count($catItems)-1;
						}
					}

					$moved		= $i;
					$query		= "UPDATE `$MYSQL_CTR_TABLE23` SET `sort_index`='{$catItems[$moved]['sort_index']}' WHERE  `id`='{$catItems[$next]['id']}'";
					$result		= $this->mysql->executeSQL($query);

					$query		= "UPDATE `$MYSQL_CTR_TABLE23` SET `sort_index`='{$catItems[$next]['sort_index']}' WHERE  `id`='{$catItems[$moved]['id']}'";
					$result		= $this->mysql->executeSQL($query);

					$this->refreshFrame = 1;
					setHistory($this->m_id, 2, 1, $catItems[$next]['id']);
					setHistory($this->m_id, 2, 1, $catItems[$moved]['id']);

					break;
				}
			}
		}
		$this->getList();
	}



	/**
	 * Получает поле
	 *
	 * @param bool $edit
	 * @return array
	 */
	function getFields($edit=false) {
		GLOBAL $MSGTEXT, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE17, $BAD_SYMBOLS;

		$editError	= array();
		$block		= array();

		//проверяем, чтоб имя блока не совпадало с именем системных php-функций
		$bad_names	= array('new', 'class', 'print', 'eval', 'null', 'delete', 'unset', 'echo');
		$name			= addslashes($this->post['name']);
		$system_funs	= get_defined_functions();
		foreach ($system_funs['internal'] as $f) {
			if  (mb_strtolower($name)==mb_strtolower($f)) {
				$editError[]	= $MSGTEXT['block_constr_select_name'];
				break;
			}
		}

		if  (count($editError)==0 && in_array(mb_strtolower($name), $bad_names)) {
			$editError[] = $MSGTEXT['block_constr_select_name'];
		}
		

		$block['type']	= $this->post['type'];
		$act_variable 	= addslashes(str_replace($BAD_SYMBOLS, '', $this->post['act_variable']));

		if (!preg_match("/^([A-Z0-9_\\/\.-]*)$/iu", $name)) {
			$editError[]	=	$MSGTEXT['block_constr_no_prob'];
		}

		if (!preg_match("/^([A-Z0-9_\\/\.-]*)$/iu", $act_variable)) {
			$editError[]	=	$MSGTEXT['block_constr_no_ciril'];
		}

		//проверяем, чтоб вначале небыло цифр
		if (count($editError)==0) {
			$first_char=mb_substr($name,0, 1);
			if (is_numeric($first_char)) {
				$editError[]	= $MSGTEXT['block_constr_bad_name_number'];
			}
		}

		//проверяем, чтоб имя блока не совпадало с именем модуля
		$query		= "SELECT `name` FROM `$MYSQL_CTR_TABLE17` WHERE `id`='$this->m_id'";
		$result		= $this->mysql->executeSQL($query);
		list($mod_name)	= $this->mysql->fetchRow($result);
		
		if (mb_strtolower($name)== mb_strtolower($mod_name)) {
			$editError[]=			$MSGTEXT['block_templates_error_name_like_module'];
		}

		if (count($editError)==0) {
			$block['name']	= $name;
			$description	= htmlspecialchars(str_replace($BAD_SYMBOLS, '', $this->postr['description']), ENT_QUOTES);

			if ($description=='') {
				$editError[]			= $MSGTEXT['block_constr_desc_no_empty'];
			}

			if ($edit) $where=" AND `id`!='{$this->get['b_id']}'";
			else $where='';

			$block['description']		= $description;
			$block['act_variable']		= $act_variable;
			$block['act_method']		= $this->post['act_method'];
			$block['general_table_id']	= $this->post['general_table_id'];
			$block['url_get_vars']		= str_replace($BAD_SYMBOLS, '', $this->post['url_get_vars']);

			$query		= "SELECT count(*) FROM `$MYSQL_CTR_TABLE23` WHERE `name`='$name' AND `module_id`='{$this->m_id}' $where";
			$result		= $this->mysql->executeSQL($query);
			$c			= $this->mysql->fetchRow($result);
			if ($c[0]>0) {
				$editError[]= $MSGTEXT['block_constr_block_err'];
			}
			elseif ($this->post['name']=='') {
				$editError[]= $MSGTEXT['block_constr_no_empty'];
			}
		}

		$r['editError']	= $editError;
		$r['block']		= $block;

		return $r;
	}



	/**
     * обработка формы создания блока
     *
     */
	function insert() {
		GLOBAL $MSGTEXT, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18,  $MYSQL_CTR_TABLE31, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE24, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE29;

		$r				= $this->getFields();
		$editError		= $r['editError'];
		$block			= $r['block'];

		if (count($editError)>0) {
			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
			$this->smarty->assign('editError',	$editError);
			$this->form_add();
		}
		else {
			if ($block['general_table_id']==0 || $block['general_table_id']=='') {
				$block['general_table_id']='NULL';
			}
			$query		= "INSERT INTO `$MYSQL_CTR_TABLE23` (`module_id`, `type`, `name`, `description`, `act_variable`, `act_method`, `url_get_vars`, `general_table_id`, `loaded_name`, `sort_index`)
            				VALUES ('{$this->m_id}', '{$block['type']}', '{$block['name']}', '{$block['description']}',  '{$block['act_variable']}',  '{$block['act_method']}', '{$block['url_get_vars']}', {$block['general_table_id']}, '{$block['name']}',  '0')";
			$result		= $this->mysql->executeSQL($query);
			$sort_index	= $this->mysql->insertID();

			$query		= "UPDATE `$MYSQL_CTR_TABLE23`  SET `sort_index`='$sort_index' WHERE `id`='$sort_index'";
			$result		= $this->mysql->executeSQL($query);

			//обновляем историю
			setHistory($this->m_id, 1, 1, $sort_index);
			$this->refreshFrame=1;

			$this->smarty->assign('message',			$MSGTEXT['block_constr_block_create']);
			$this->getList();
		}
	}



	/**
     * удаляем блок
     *
     */
	function delete() {
		GLOBAL $GENERAL_FUNCTIONS, $MYSQL_CTR_TABLE30, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE24, $MYSQL_CTR_TABLE25,  $MYSQL_CTR_TABLE28;

		$query				= "SELECT `name` FROM `$MYSQL_CTR_TABLE23` WHERE `id`='{$this->get['b_id']}'";
		$result				= $this->mysql->executeSQL($query);
		list($block_name)	= $this->mysql->fetchRow($result);

		setHistory($this->m_id, 0, 1, $this->get['b_id'], $block_name);

		$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE23` WHERE `id`='{$this->get['b_id']}'";
		$result		= $this->mysql->executeSQL($query);

		$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE28` WHERE `block_id`='{$this->get['b_id']}'";
		$result		= $this->mysql->executeSQL($query);

		$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE30` WHERE `block_id`='{$this->get['b_id']}'";
		$result		= $this->mysql->executeSQL($query);

		$this->refreshFrame = 1;

		$GENERAL_FUNCTIONS->gotoURL('?act=b_c&refreshFrame='.$this->refreshFrame);
	}



	/**
     * форма редактирования блока
     *
     */
	function form_edit() {
		GLOBAL  $MSGTEXT, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE24;

		//берем все таблицы
		$query		= "SELECT t.*, b.general_table_id, b.name AS `block_name`, b.description AS `block_description` FROM `$MYSQL_CTR_TABLE18` AS `t` LEFT JOIN `$MYSQL_CTR_TABLE23` AS `b` ON (b.general_table_id=t.id) WHERE t.module_id='{$this->m_id}' GROUP BY t.id ORDER BY t.sort_index";
		$result		= $this->mysql->executeSQL($query);
		$tables		= $this->mysql->fetchAssocAll($result);

		$query		= "SELECT `name`, `type`, `description`, `act_variable`, `act_method`, `url_get_vars`, `general_table_id` FROM `$MYSQL_CTR_TABLE23` WHERE `id`='{$this->get['b_id']}'";
		$result		= $this->mysql->executeSQL($query);
		list($name, $type, $description, $act_variable, $act_method, $url_get_vars, $general_table_id)		= $this->mysql->fetchRow($result);

		$this->smarty->assign('content_template',	'blocks/blocks_form_edit.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['block_constr_edit_block'].' «<a href="?act=b_c&b_id='.$this->get['b_id'].'">'.$name.'</a>»');

		$this->smarty->assign('name',				$name);
		$this->smarty->assign('type',				$type);
		$this->smarty->assign('description',		$description);
		$this->smarty->assign('act_variable',		$act_variable);
		$this->smarty->assign('act_method',			$act_method);
		$this->smarty->assign('url_get_vars',		$url_get_vars);

		$this->smarty->assign('general_table_id',	$general_table_id);
		$this->smarty->assign('tables',				$tables);

		$this->smarty->assign('id',					$this->get['b_id']);
	}



	/**
     * сохранение редактирования блоки
     *
     */
	function saveEdit() {
		GLOBAL $MSGTEXT, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE31;

		$r				= $this->getFields(true);
		$editError		= $r['editError'];
		$block			= $r['block'];

		if (count($editError)>0) {
			$query		= "SELECT `name` FROM `$MYSQL_CTR_TABLE23` WHERE `id`='{$this->get['b_id']}'";
			$result		= $this->mysql->executeSQL($query);
			list($name)	= $this->mysql->fetchRow($result);

			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
			$this->smarty->assign('editError',	$editError);
			$this->smarty->assign('content_template',	'blocks/blocks_form_edit.tpl');
			$this->smarty->assign('content_head',		$MSGTEXT['block_constr_edit_block'].' <a href="?act=b_c&b_id='.$this->get['b_id'].'">«'.$name.'»</a>');
		}
		else {
			//проверяем, вдруг блок создан и не сохранён
			$query			= "SELECT count(*) FROM `$MYSQL_CTR_TABLE31` WHERE `module_id`='{$this->m_id}' AND `operation`='1' AND `object_type`='1' AND `object_id`='{$this->get['b_id']}'";
			$result			= $this->mysql->executeSQL($query);
			list($exist)	= $this->mysql->fetchRow($result);
			
			if ($exist) {
				$loaded_name	= ",`loaded_name`='{$block['name']}'";
			}
			else {
				$loaded_name	= '';
			}
			if ($block['general_table_id']==0 || $block['general_table_id']=='') {
				$block['general_table_id']='NULL';
			}
			$query		= "UPDATE `$MYSQL_CTR_TABLE23`  SET `name`='{$block['name']}', `type`='{$block['type']}', `description`='{$block['description']}', `act_variable`='{$block['act_variable']}', `act_method`='{$block['act_method']}', `url_get_vars`='{$block['url_get_vars']}', `general_table_id`={$block['general_table_id']} $loaded_name WHERE `id`='{$this->get['b_id']}'";
			$result		= $this->mysql->executeSQL($query);

			setHistory($this->m_id, 2, 1, $this->get['b_id']);
			$this->refreshFrame=1;

			$this->smarty->assign('message',			$MSGTEXT['block_constr_save_chenges']);
			$this->getList();
		}
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