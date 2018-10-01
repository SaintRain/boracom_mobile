<?php
/**
 * класс для работы с шаблонами для блоков
 *
 */
class BlocksTemplatesConstructor  {

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
	public 		$m_id;

	/**
     * нужно ли обновлять левы фрейм
     *
     * @var bool
     */
	public 		$refreshFrame;

	/**
     * Конструктор
     * 
     * @param class $smarty
     */
	function BlocksTemplatesConstructor($mysql, $smarty, $post, $postr, $get, $getr,  $do) {
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
			case ('insert_copy_form'):		$this->insertCopyForm(); 	break;
			case ('move_table_item'):		$this->moveTableItem(); 	break;
			endswitch;
		}
		else {
			$this->editError=$MSGTEXT['error_accsess_to_constructor'];

			$this->smarty->assign('errors',	$this->editError);
			$this->smarty->assign('content_template',	'errors/errors_list.tpl');
		}
	}



	/**
	 * получаем список шаблонов
	 *
	 */
	function getList() {
		GLOBAL $MSGTEXT, $GENERAL_FUNCTIONS, $MYSQL_CTR_TABLE30;

		if (isset($this->get['page']) && $this->get['page']!='') $_SESSION['___GoodCMS']['BACK_RECORD_URL']='?'.$_SERVER['QUERY_STRING'];

		if (isset($this->get['id'])) {
			$id	= $this->get['id'];
			$where	= " AND `id`='$id'";
		}
		else $where='';

		$allTemplates	= array();
		$query			= "SELECT * FROM `$MYSQL_CTR_TABLE30` WHERE `block_id`='{$this->get['b_id']}' $where ORDER BY `sort_index`";
		$result			= $this->mysql->executeSQL($query);
		while ($row		= $this->mysql->fetchAssoc($result)) {
			$parts		= explode('.', $row['name']);
			if (count($parts)>1) {
				$row['tpl_type']		= $parts[count($parts)-1];				
			}
			
			$allTemplates[]=$row;
		}

		$sort			= $GENERAL_FUNCTIONS->getSortVariables('name');
		$allTemplates	= $GENERAL_FUNCTIONS->sort_massiv_by_int($sort['sort_type'],     	$allTemplates);
		
		$this->smarty->assign('content_template',	'blocks_templates/templates_list.tpl');
		$this->smarty->assign('templates',			$allTemplates);
		$this->smarty->assign('content_head',		$MSGTEXT['block_templates_block']);
		$this->smarty->assign('sort_by',			$sort['sort_by']);
		$this->smarty->assign('sort_type',			$sort['sort_type']);
		$this->smarty->assign('b_id',				$this->get['b_id']);
		$this->smarty->assign('refreshFrame',		$this->refreshFrame);
	}



	/**
     * форма создания шаблонов
     *
     */
	function form_add () {
		GLOBAL $MSGTEXT;

		$this->smarty->assign('content_template',	'blocks_templates/templates_form_edit.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['block_templates_create']);
		$this->smarty->assign('do',					'insert');
		$this->smarty->assign('b_id',				$this->get['b_id']);
	}



	/**
     * форма создания копии шаблонов
     *
     */
	function insertCopyForm () {
		GLOBAL $MSGTEXT, $MYSQL_CTR_TABLE30;

		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE30` WHERE `id`='{$this->get['id']}'";
		$result		= $this->mysql->executeSQL($query);
		$function	= $this->mysql->fetchAssoc($result);

		foreach ($function as $k=>$v) {
			if ($k=='name') {
				$parts		= explode('.', $v);
				if (count($parts)>1) {
					$tpl_prefix		= '.'.$parts[count($parts)-1];
					$v				= mb_substr($v, 0, -(mb_strlen($tpl_prefix)));
					$this->smarty->assign('tpl_prefix',	$tpl_prefix);
				}

			}
			$this->smarty->assign($k, $v);
		}

		$this->smarty->assign('content_template',	'blocks_templates/templates_form_add_copy.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['block_templates_create_copy'].' <a href="?act=b_temp_c&b_id='.$this->get['b_id'].'&id='.$function['id'].'">«'.$function['name'].'»</a>');
		$this->smarty->assign('b_id',				$this->get['b_id']);
		$this->smarty->assign('do	',				'insert');
	}



	/**
	 * устонавливает порядок сортировки шаблонов
	 *
	 */
	function moveTableItem() {
		GLOBAL  $MSGTEXT, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE30;

		$id			= $this->get['temp_id'];
		$query		= "SELECT * FROM  `$MYSQL_CTR_TABLE30` WHERE  `id`='$id'";
		$result		= $this->mysql->executeSQL($query);
		$cat		= $this->mysql->fetchAssoc($result);

		$query		= "SELECT * FROM  `$MYSQL_CTR_TABLE30` WHERE `block_id`='{$this->get['b_id']}' ORDER BY `sort_index`";
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
							$this->smarty->assign('message',		$MSGTEXT['block_templates_no_up']);
							$next	= 0;
						}
					}
					elseif ($this->get['type']=='down') {
						if ($i<count($catItems)-1) $next = $i+1;
						else {
							$this->smarty->assign('message',		$MSGTEXT['block_templates_no_down']);
							$next	= count($catItems)-1;
						}
					}

					$moved		= $i;
					$query		= "UPDATE `$MYSQL_CTR_TABLE30` SET `sort_index`='{$catItems[$moved]['sort_index']}' WHERE  `id`='{$catItems[$next]['id']}'";
					$result		= $this->mysql->executeSQL($query);

					$query		= "UPDATE `$MYSQL_CTR_TABLE30` SET `sort_index`='{$catItems[$next]['sort_index']}' WHERE  `id`='{$catItems[$moved]['id']}'";
					$result		= $this->mysql->executeSQL($query);

					setHistory($this->m_id, 2, 3, $catItems[$next]['id']);
					setHistory($this->m_id, 2, 3, $catItems[$moved]['id']);
					break;
				}
			}
		}
		$this->getList();
	}



	/**
	 * Получает поля формы
	 *
	 * @return array
	 */
	function getFields() {
		GLOBAL $MSGTEXT, $MYSQL_CTR_TABLE30, $BAD_SYMBOLS;

		$editError	= array();
		$function	= array();

		$name			= addslashes($this->post['name']);
		$loaded_name	= addslashes($this->post['loaded_name']);

		if ($this->postr['description']=='') {
			$editError[]				= $MSGTEXT['block_templates_description_no_empty'];
		}

		if (!preg_match("/^([A-Z0-9_\\/-]*)$/iu", $name)) {
			$editError[]				= sprintf($MSGTEXT['block_templates_err_ciril'], './\:*?"< >|');
		}
		elseif ($name=='') {
			$editError[]				= $MSGTEXT['block_templates_name_no_empty'];
		}

		else {

			$name						= $name.$this->post['tpl_prefix'];
			$function['name']			= $name;
			$function['loaded_name']	= $loaded_name;
			$function['description']	= addslashes(str_replace($BAD_SYMBOLS, '', $this->postr['description']));
			$function['content']		= addslashes($this->postr['content']);

			if ($this->get['do']=='saveedit') $where=" AND `id`!='{$this->post['id']}'";
			else $where	= '';

			$query		= "SELECT count(*) FROM `$MYSQL_CTR_TABLE30` WHERE `name`='$name' AND `block_id`='{$this->get['b_id']}' $where";
			$result		= $this->mysql->executeSQL($query);
			list($c)	= $this->mysql->fetchRow($result);
			if ($c>0) {
				$editError[]=			$MSGTEXT['block_templates_name'];
			}
			elseif ($this->post['name']=='') {
				$editError[]=			$MSGTEXT['block_templates_name_err'];
			}

		}

		$r['function']	= $function;
		$r['editError']	= $editError;

		return $r;
	}



	/**
     * обработка формы создания шаблона
     *
     */
	function insert() {
		GLOBAL $MSGTEXT, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE30, $MYSQL_CTR_TABLE21;

		$r				= $this->getFields();
		$editError		= $r['editError'];
		$function		= $r['function'];

		if (count($editError)>0) {
			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
			$this->form_add();
			$this->smarty->assign('editError',	$editError);
		}
		else {
			$query		= "INSERT INTO `$MYSQL_CTR_TABLE30` (`block_id`, `name`, `description`,  `content`, `loaded_name`, `sort_index`) VALUES ('{$this->get['b_id']}', '{$function['name']}', '{$function['description']}',  '{$function['content']}', '{$function['name']}', '0')";
			$result		= $this->mysql->executeSQL($query);
			$sort_index	= $this->mysql->insertID();
			$query		= "UPDATE `$MYSQL_CTR_TABLE30`  SET `sort_index`='$sort_index' WHERE `id`='$sort_index'";
			$result		= $this->mysql->executeSQL($query);

			setHistory($this->m_id, 1, 3, $sort_index);
			$this->refreshFrame	= 1;
			$this->smarty->assign('message',			$MSGTEXT['block_templates_created']);
			$this->getList();
		}
	}



	/**
     * обработка формы создания копии шаблона
     *
     */
	function insertCopy() {
		GLOBAL $MSGTEXT, $MYSQL_CTR_TABLE30, $MYSQL_CTR_TABLE21;

		$error		= false;
		$name		= addslashes($this->post['name']);

		if (!preg_match("/^([A-Z0-9_\\/-]*)$/iu", $name)) {
			$error	= true;
			$this->smarty->assign('message',	sprintf($MSGTEXT['block_templates_err_ciril'], './\:*?"< >|'));
		}
		else {

			$description	= htmlspecialchars($this->postr['description'], ENT_QUOTES);

			$query			= "SELECT count(*) FROM `$MYSQL_CTR_TABLE30` WHERE `name`='$name' AND `module_id`!='{$this->m_id}'";
			$result			= $this->mysql->executeSQL($query);
			$c				= $this->mysql->fetchRow($result);

			if ($c[0]>0) {
				$error	= true;
				$this->smarty->assign('message',			$MSGTEXT['block_templates_name_err']);
			}
			elseif ($this->post['name']=='') {
				$error	= true;
				$this->smarty->assign('message',			$MSGTEXT['block_templates_name_no_empty']);
			}
		}

		if ($error)	 {
			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
			$this->smarty->assign('content_template',	'blocks_templates/templates_form_add_copy.tpl');
			$this->smarty->assign('content_head',		$MSGTEXT['block_templates_create_copy']);
		}
		else {
			$query		= "INSERT INTO `$MYSQL_CTR_TABLE30` (`module_id`, `name`, `description`, `sort_index`) VALUES ('{$this->m_id}', '$name', '$description', '0')";
			$result		= $this->mysql->executeSQL($query);

			$sort_index	= $this->mysql->insertID();
			$query		= "UPDATE `$MYSQL_CTR_TABLE30`  SET `sort_index`='$sort_index' WHERE `id`='$sort_index'";
			$result		= $this->mysql->executeSQL($query);

			setHistory($this->m_id, 1, 3, $sort_index);

			$this->smarty->assign('message',			$MSGTEXT['block_templates_created']);
			$this->getList();
		}
	}



	/**
     * удаляем шаблон
     *
     */
	function delete() {
		GLOBAL $GENERAL_FUNCTIONS, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE30, $MYSQL_CTR_TABLE23;

		$query						= "SELECT `name` FROM `$MYSQL_CTR_TABLE23` WHERE `id`='{$this->get['b_id']}'";
		$result						= $this->mysql->executeSQL($query);
		list($block_name)			= $this->mysql->fetchRow($result);

		$query						= "SELECT `name`, `block_id` FROM `$MYSQL_CTR_TABLE30` WHERE `id`='{$this->get['id']}'";
		$result						= $this->mysql->executeSQL($query);
		list($tpl_name, $block_id)	=  $this->mysql->fetchRow($result);

		setHistory($this->m_id, 0, 3, $this->get['id'], $tpl_name, $block_id);
		$this->refreshFrame	= 1;

		$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE30` WHERE `id`='{$this->get['id']}'";
		$result		= $this->mysql->executeSQL($query);

		$GENERAL_FUNCTIONS->gotoURL('?act=b_temp_c&b_id='.$this->get['b_id'].'&refreshFrame='.$this->refreshFrame);
	}



	/**
     * форма редактирования шаблона
     *
     */
	function form_edit() {
		GLOBAL  $MSGTEXT, $MYSQL_CTR_TABLE30;

		if ($this->get['do']!='saveedit') {
			$query		= "SELECT * FROM `$MYSQL_CTR_TABLE30` WHERE `id`='{$this->get['id']}'";
			$result		= $this->mysql->executeSQL($query);
			$template	= $this->mysql->fetchAssoc($result);

			foreach ($template AS $k=>$v) {
				$v   = htmlspecialchars($v, ENT_QUOTES);
				if ($k=='name') {
					$parts		= explode('.', $v);
					if (count($parts)>1) {
						$tpl_prefix		= '.'.$parts[count($parts)-1];
						$v				= mb_substr($v, 0, -(mb_strlen($tpl_prefix)));
						$this->smarty->assign('tpl_prefix',	$tpl_prefix);
					}

				}
				$this->smarty->assign($k,	$v);
			}
		}

		$this->smarty->assign('content_template',	'blocks_templates/templates_form_edit.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['block_templates_edit']);
		$this->smarty->assign('do',					'saveedit');
		$this->smarty->assign('b_id',				$this->get['b_id']);
	}



	/**
     * сохранение редактирования шаблона
     *
     */
	function saveEdit() {
		GLOBAL $MSGTEXT, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE30, $MYSQL_CTR_TABLE21;

		$r				= $this->getFields();
		$editError		= $r['editError'];
		$function		= $r['function'];

		if (count($editError)>0) {

			$this->get['id']=$this->post['id'];
			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
			$this->smarty->assign('editError',	$editError);
			$this->form_edit();
		}
		else {
			$query		= "UPDATE `$MYSQL_CTR_TABLE30`  SET `name`='{$function['name']}', `description`='{$function['description']}',
	 				 	 `content`='{$function['content']}' WHERE `id`='{$this->post['id']}'";
			$result		= $this->mysql->executeSQL($query);

			setHistory($this->m_id, 2, 3, $this->post['id']);

			$this->smarty->assign('message',			$MSGTEXT['block_templates_save_chenged']);
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