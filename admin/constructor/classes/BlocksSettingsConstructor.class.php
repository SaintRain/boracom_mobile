<?php
/**
 * класс для работы с настройкми блока
 *
 */
class BlocksSettingsConstructor  {

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
	public	 $m_id;



	/**
     * Конструктор
     * 
     * @param class $smarty
     */
	function BlocksSettingsConstructor($mysql, $smarty, $post, $postr, $get, $getr,  $do) {
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
			case ('edit'):					$this->form_edit(); 		break;
			case ('saveedit'):				$this->saveEdit();	 		break;
			default:						$this->form_edit(); 		break;
			endswitch;
		}
		else {
			$this->editError	= $MSGTEXT['error_accsess_to_constructor'];

			$this->smarty->assign('errors',	$this->editError);
			$this->smarty->assign('content_template',	'errors/errors_list.tpl');
		}
	}



	/**
     * форма редактирования настроек блока
     *
     */
	function form_edit($settings=false) {
		GLOBAL  $MSGTEXT, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE19, $MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE22, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE27, $MYSQL_CTR_TABLE28;

		//берём блоки модуля
		$blocks		= array();
		$blocks_ids	= array();
		$query		= "SELECT `id`, `name`, `description` FROM `$MYSQL_CTR_TABLE23` WHERE `module_id`='{$this->m_id}' ORDER BY `sort_index`";
		$result		= $this->mysql->executeSQL($query);
		while ($row	= $this->mysql->fetchAssoc($result)) {
			$blocks_ids[]	= $row['id'];
			$blocks[]		= $row;
		}

		if (!$settings) {
			//берём все настройки блоков
			if (count($blocks_ids)>0) {
				$blocks_ids	= implode(',', $blocks_ids);
				$query		= "SELECT * FROM `$MYSQL_CTR_TABLE28` WHERE `block_id` IN ($blocks_ids) ORDER BY `block_id`";
				$result		= $this->mysql->executeSQL($query);
				$settings	= $this->mysql->fetchAssocAll($result);
			}
			else {
				$settings	= array();
			}
		}

		$settings2	= array();
		$tmp		= array();
		foreach ($settings AS $ar) {
			foreach ($ar AS $k => $v) {
				$tmp[$k]	= addslashes(str_replace(array(SETTINGS_NEW_LINE, "\r"), array(chr(31), ''), $v));
			}
			$settings2[]	= $tmp;
		}
		$settings			= $settings2;


		//берем список типов редактирования настройки
		$query			= "SELECT * FROM `$MYSQL_CTR_TABLE27`";
		$result			= $this->mysql->executeSQL($query);
		$edit_s_types	= $this->mysql->fetchAssocAll($result);

		//вычисляем счетчик
		if (isset($this->post['counter'])) {
			$counter	= $this->post['counter'];
		}
		else {
			$counter	= count($settings);
		}

		$this->smarty->assign('content_template',	'blocks_settings/blocks_settings_form_edit.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['block_settings_edit_set_block']);
		$this->smarty->assign('edit_s_types',		$edit_s_types);
		$this->smarty->assign('settings',			$settings);
		$this->smarty->assign('counter',			$counter);
		$this->smarty->assign('blocks',				$blocks);

	}



	/**
	 * проверка заполненых полей 
	 * @return array
	 */
	function getFields() {
		GLOBAL  $MSGTEXT, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE28, $BAD_SYMBOLS;

		$fields			= array();
		$editError		= array();
		$fields_count	= 0;
		while ($fields_count <= $this->post['counter']) {
			if (isset($this->post['name_'.$fields_count])) {
				$tmp					= array();
				$tmp['id']				= $this->postr['id_'.$fields_count];
				$tmp['name']			= addslashes(str_replace($BAD_SYMBOLS, '', $this->postr['name_'.$fields_count]));
				$tmp['value']			= addslashes($this->postr['value_'.$fields_count]);
				$tmp['description']		= addslashes(str_replace($BAD_SYMBOLS, '', $this->postr['description_'.$fields_count]));
				$tmp['edit_s_type_id']	= $this->postr['edit_s_type_id_'.$fields_count];
				$tmp['block_id']		= $this->postr['block_id_'.$fields_count];
				$tmp['loaded_name']		= $this->postr['loaded_name_'.$fields_count];
				$fields[]				= $tmp;
			}
			$fields_count++;
		}

		$same_names	= array();
		for ($i=0; $i<count($fields); $i++) {
			$k=0;
			for ($i2=0; $i2<count($fields); $i2++) {

				if ($fields[$i]['name']==$fields[$i2]['name']) $k++;
				if ($k>1) {
					if (!isset($same_names[$fields[$i]['name']])) {
						$editError[]						= sprintf($MSGTEXT['block_settings_err_key'], stripslashes(htmlspecialchars($fields[$i]['name'], ENT_QUOTES)));
						$same_names[$fields[$i]['name']]	= true;
					}
					$k=0;
					break;
				}
			}
		}


		//берём список блоков
		$blocks_ids			= array();
		$query				= "SELECT `id` FROM `$MYSQL_CTR_TABLE23`  WHERE `module_id`='{$this->m_id}'";
		$result				= $this->mysql->executeSQL($query);
		while (list($b_id)	= $this->mysql->fetchRow($result)) {
			$blocks_ids[]	= $b_id;
		}

		if (count($blocks_ids)>0) {
			$blocks_ids		= 'AND t.block_id IN ('.implode(',', $blocks_ids).')';
		}
		else {
			$blocks_ids		= '';
		}

		$r['editError']		= $editError;
		$r['fields']		= $fields;

		return $r;
	}



	/**
     * сохранение редактирования настроек блока
     *
     */
	function saveEdit() {
		GLOBAL  $MSGTEXT, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE28, $MYSQL_CTR_TABLE23;

		if (isset($this->post['counter'])) {
			$r				= $this->getFields(true);
			$editError		= $r['editError'];
			$fields			= $r['fields'];
		}
		else {
			$editError		= array();
		}

		if (count($editError)>0 || !isset($this->post['counter'])) {
			if (isset($this->post['counter'])) {

				foreach ($fields as $k=>$field) {
					foreach ($field as $k2=>$v) {
						$fields[$k][$k2]=stripslashes($v);
					}
				}

				$this->smarty->assign('editError',	$editError);
				$this->form_edit($fields);
			}
			else {
				$this->form_edit();
			}
		}
		else {


			//берём блоки модуля
			$blocks		= array();
			$blocks_ids	= array();
			$query		= "SELECT `id`, `name`, `description` FROM `$MYSQL_CTR_TABLE23` WHERE `module_id`='{$this->m_id}'";
			$result		= $this->mysql->executeSQL($query);
			while ($row	= $this->mysql->fetchAssoc($result)) {
				$blocks_ids[]	= $row['id'];
				$blocks[]		= $row;
			}

			//запоминаем поля
			$fields_ids	= array();
			$fields_ids2= array();

			//берём все настройки блоков
			if (count($blocks_ids)>0) {
				$blocks_ids	= implode(',', $blocks_ids);
				$query		= "SELECT * FROM `$MYSQL_CTR_TABLE28` WHERE `block_id` IN ($blocks_ids) ORDER BY `block_id`";
				$result		= $this->mysql->executeSQL($query);
				while ($row	= $this->mysql->fetchAssoc($result)) {
					$row['value']				= addslashes($row['value']);
					$row['description']			= addslashes($row['description']);
					$fields_ids[] 				= $row;
					$fields_ids2[$row['id']] 	= $row;
				}
			}


			for ($i=0; $i<count($fields); $i++) {

				if (is_numeric($fields[$i]['id'])) {

					//проверяем есть ли реальные изменения
					if ($fields_ids2[$fields[$i]['id']]['name']!=$fields[$i]['name'] || $fields_ids2[$fields[$i]['id']]['value']!=$fields[$i]['value']  || $fields_ids2[$fields[$i]['id']]['description']!=$fields[$i]['description'] || $fields_ids2[$fields[$i]['id']]['edit_s_type_id']!=$fields[$i]['edit_s_type_id']  || $fields_ids2[$fields[$i]['id']]['block_id']!=$fields[$i]['block_id']) {

						$setHistoryEdit	= true;

						$query	= "UPDATE `$MYSQL_CTR_TABLE28` SET
							`name`='{$fields[$i]['name']}',
							`value`='{$fields[$i]['value']}',
							`description`='{$fields[$i]['description']}',
							`edit_s_type_id`='{$fields[$i]['edit_s_type_id']}',
							`block_id`='{$fields[$i]['block_id']}'							
 							WHERE `id`='{$fields[$i]['id']}'";
					}
					else {
						$setHistoryEdit	= false;
					}
				}
				else {
					$setHistoryEdit	= true;
					$query			= "INSERT INTO `$MYSQL_CTR_TABLE28` (`block_id`, `name`,`value`,`description`,`edit_s_type_id`, `loaded_name`)
 					VALUES ( 					
					 	'{$fields[$i]['block_id']}',
					 	'{$fields[$i]['name']}',
 						'{$fields[$i]['value']}',
 						'{$fields[$i]['description']}',
 						'{$fields[$i]['edit_s_type_id']}', 						
 						'{$fields[$i]['name']}')";				
				}
				$result		= $this->mysql->executeSQL($query);

				if ($setHistoryEdit) {
					if (is_numeric($fields[$i]['id'])) {
						setHistory($this->m_id, 2, 4, $fields[$i]['id'], $fields[$i]['loaded_name'], $fields_ids2[$fields[$i]['id']]['block_id']);
					}
					else {
						setHistory($this->m_id, 1, 4, $this->mysql->insertID(), '', $fields[$i]['block_id']);
					}
				}
			}

			//удаляем поля
			for ($i=0; $i<count($fields_ids); $i++) {
				$del=true;
				for ($i2=0; $i2<count($fields); $i2++) {
					if ($fields_ids[$i]['id']==$fields[$i2]['id']) {
						$del=false;
						break;
					}
				}

				if ($del) {
					$query		= "SELECT `id`,  `block_id`, `loaded_name` FROM `$MYSQL_CTR_TABLE28` WHERE `id`='{$fields_ids[$i]['id']}'";
					$result		= $this->mysql->executeSQL($query);
					$del_ids	= $this->mysql->fetchAssocAll($result);

					foreach ($del_ids as $del_id) {
						setHistory($this->m_id, 0, 4, $del_id['id'], $del_id['loaded_name'], $del_id['block_id']);
					}

					$query	= "DELETE FROM `$MYSQL_CTR_TABLE28` WHERE `id`='{$fields_ids[$i]['id']}'";
					$result	= $this->mysql->executeSQL($query);
				}
			}

			$this->smarty->assign('message',			$MSGTEXT['block_settings_chenged_save']);
			$this->form_edit();
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