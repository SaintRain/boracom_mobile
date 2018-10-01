<?php
/**
 * класс для работы с шаблонами
 *
 */
class Templates  {

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
	function Templates($mysql, $smarty, $post, $postr, $get, $getr,  $do) {

		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		$this->post		= $post;
		$this->get		= $get;
		$this->postr	= $postr;
		$this->getr		= $getr;

		switch ($do):
		case ('list'):						$this->templates_getlist(); 				break;
		case ('form_add'):					$this->templates_form_add(); 				break;
		case ('insert'):					$this->templates_insert(); 					break;
		case ('delete'):					$this->templates_delete(); 					break;
		case ('edit'):						$this->templates_form_edit(); 				break;
		case ('copy'):						$this->templates_form_copy_virtual(); 		break;
		case ('saveedit'):					$this->templates_saveedit();	 			break;
		case ('savecopy'):					$this->templates_savecopy_virtual();	 	break;
		case ('settings_edit'):				$this->templates_settings_edit(); 			break;
		case ('settings_save_edit'):		$this->templates_settings_save_edit(); 		break;
		case ('saveedittags'):				$this->templates_saveedittags(); 			break;
		case ('add_virtual_tamplate'):		$this->templates_addVirtualTamplate(); 		break;
		case ('insert_virtual'):			$this->templates_insert_Virtual(); 			break;
		case ('edit_virtual'):				$this->templates_editVirtualTamplate(); 	break;
		case ('saveedit_virtual'):			$this->templates_saveedit_virtual(); 		break;
		case ('delete_virtual'):			$this->templates_delete_virtual(); 			break;
		case ('moveVirtualTag'):			$this->templates_moveVirtualTag(); 			break;
		endswitch;
	}


	/**
	 * выводит  список шаблонов
	 *
	 */
	function templates_getlist() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE2, $MYSQL_TABLE10, $TEMPLATES_PATH;

		$_SESSION['___GoodCMS']['rdo']='list';

		//поиск шаблонов
		$home_dir	= $TEMPLATES_PATH;

		//если нужно показать только один шаблон, то формируем ограничение для выборки
		if (isset($this->get['template_id'])) {
			$where						= " WHERE `id`='{$this->get['template_id']}'";
			$virtualtemplate_id_text	= '&virtualtemplate_id='.$this->get['template_id'];
			$this->smarty->assign('template_id',	$this->get['template_id']);
		}
		else {
			$virtualtemplate_id_text	= '';
			$where						= '';
		}

		$alltemplates	= array();
		$query			= "SELECT * FROM `$MYSQL_TABLE2` ".$where;
		$result			= $this->mysql->executeSQL($query);
		$alltemplates	= $this->mysql->fetchAssocAll($result);

		$sort			= $GENERAL_FUNCTIONS->getSortVariables('description');
		$alltemplates	= $GENERAL_FUNCTIONS->sort_massiv($sort['sort_type'], $alltemplates);
		$obj			= $GENERAL_FUNCTIONS->form_navigations(20, $alltemplates, '?act=templates&sort_by='.$sort['sort_by'].'&sort_type='.$sort['sort_type'].$virtualtemplate_id_text);
		$templates		= $obj['records'];
		$pages			= $obj['pages'];

		$virtual_tamplates	= array();
		$query				= "SELECT * FROM `$MYSQL_TABLE10`";
		$result				= $this->mysql->executeSQL($query);
		while ($row			= $this->mysql->fetchAssoc($result)){
			$virtual_tamplates[$row['tamplates_id']][]=$row;
		}

		for ($i=0; $i<count($templates); $i++) {
			if (isset($virtual_tamplates[$templates[$i]['id']])) $templates[$i]['virtual_tamplates']=$virtual_tamplates[$templates[$i]['id']];
		}

		$this->smarty->assign('content_template',			'templates/templates_list.tpl');
		$this->smarty->assign('templates',					$templates);
		$this->smarty->assign('pages', 						$pages);
		$this->smarty->assign('content_head',				$MSGTEXT['templates']);
		$this->smarty->assign('sort_by',					$sort['sort_by']);
		$this->smarty->assign('sort_type',					$sort['sort_type']);
		$this->smarty->assign('virtualtemplate_id_text',	$virtualtemplate_id_text);
	}



	/**
     * форма добавления нового конечного шаблона
     *
     */
	function templates_addVirtualTamplate () {
		GLOBAL $MSGTEXT, $MYSQL_TABLE4, $MYSQL_TABLE11;

		if (!isset($this->post['addVirtualTamplate'])) {
			$query 			= "SELECT `tagname`, `id` FROM $MYSQL_TABLE4 WHERE `templates_id`='{$this->get['tamplate_id']}' ORDER BY `sort_index`";
			$result			= $this->mysql->executeSQL($query);
			$tags			= $this->mysql->fetchAssocAll($result);
		}
		else {
			foreach ($this->post AS $k=>$v) {
				if ($k!='addVirtualTamplate' && $k!='name') {
					$tmp['id']		= mb_substr($k, mb_strlen('tagid'));
					$tmp['tagname']	= $v;
					$tags[]			= $tmp;
				}
			}
			$this->smarty->assign('name',			$this->post['name']);
		}

		$this->smarty->assign('tags',				$tags);
		$this->smarty->assign('tamplate_id',		$this->get['tamplate_id']);
		$this->smarty->assign('content_template',	'templates/templates_form_add_virtual.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['tpl_create_last_tpl']);
	}



	/**
     * форма редактирования конечного шаблона
     *
     */
	function templates_editVirtualTamplate() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE4, $MYSQL_TABLE10, $MYSQL_TABLE11;

		$query		= "SELECT * FROM `$MYSQL_TABLE10`  WHERE `id`='{$this->get['id']}'";
		$result	= $this->mysql->executeSQL($query);
		$data		= $this->mysql->fetchAssoc($result);
		foreach  ($data as $key=>$value) $this->smarty->assign($key, stripslashes($value));

		$query					= "SELECT `tamplates_id` FROM `$MYSQL_TABLE10` WHERE `id`='{$this->get['id']}'";
		$result				= $this->mysql->executeSQL($query);
		list($tamplate_id)		= $this->mysql->fetchRow($result);

		//берём новые теги подгружаемых шаблонов
		$tags				= $GENERAL_FUNCTIONS->getTagsTree($tamplate_id, $this->get['id'], 0);

		$this->smarty->assign('tags',				$tags);
		$this->smarty->assign('content_template',	'templates/templates_form_edit_virtual.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['tpl_edit_last_tpl']);
	}



	/**
     * обработка формы добавления конечного шаблона
     *
     */
	function templates_saveedit_virtual() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE3, $MYSQL_TABLE10, $MYSQL_TABLE11;

		if (isset($this->post['name'])) {
			if ($this->post['name']=='') {
				$this->smarty->assign('message',			$MSGTEXT['cannot_tpl_null_name']);
				$this->get['id']=$this->post['id'];
				$this->templates_editVirtualTamplate();
			}
			else {
				$newTagNames	= array();

				$noName			= false;
				foreach  ($this->postr as $key=>$value) {
					if (mb_substr($key,0, mb_strlen('virtualtagid'))=='virtualtagid') {
						$virtualtagid	= mb_substr($key, mb_strlen('virtualtagid'));
						foreach  ($newTagNames AS $v) {
							if ($value==$v) {

								break;
							}
						}

						if ($value!='')
						$newTagNames[$virtualtagid]=$value;
						else {
							$noName=true;
							break;
						}

					}
				}

				if ($noName) {
					$this->smarty->assign('message',			$MSGTEXT['cannot_tag_null_name']);
					$this->get['id']	= $this->post['id'];
					$this->templates_editVirtualTamplate();
					return false;
				}

				$query	= "SELECT * FROM `$MYSQL_TABLE10`  WHERE `name`='{$this->post['name']}' AND `id`!='{$this->post['id']}'";
				$result	= $this->mysql->executeSQL($query);

				if ($this->mysql->numRows($result)==0)  {
					$query	= "UPDATE `$MYSQL_TABLE10` SET `name`='{$this->post['name']}' WHERE `id`='{$this->post['id']}'";
					$this->mysql->executeSQL($query);

					foreach  ($newTagNames AS $k=>$v) {
						$v		= htmlspecialchars($v, ENT_QUOTES);
						$v		= addslashes($v);
						$query	= "UPDATE `$MYSQL_TABLE11` SET `virtualtagname`='{$v}' WHERE `id`='$k'";
						$this->mysql->executeSQL($query);
					}
					foreach  ($this->post as $key=>$value) $this->smarty->assign($key, stripslashes($value));
					$this->smarty->assign('message',			$MSGTEXT['tpl_settings_is_saved']);

					if (isset($this->get['hide_menu']))  {	//выводим html-текст который обновляет родительское окно и закрывает текущее
						$query					= "SELECT `page_category` FROM `$MYSQL_TABLE3` WHERE `id`='{$this->post['page_id']}'";
						$result					= $this->mysql->executeSQL($query);
						list($pageCategoryId)	= $this->mysql->fetchRow($result);

						$this->smarty->assign('page_id', 		$this->post['page_id']);
						$this->smarty->assign('pageCategoryId', $pageCategoryId);
						echo $this->smarty->fetch('templates/templates_location.tpl');
						exit;
					}
					else {
						$this->templates_editVirtualTamplate();
					}
				}
				else {
					foreach  ($this->post as $key=>$value) {
						$this->smarty->assign($key, stripslashes($value));
					}

					$this->smarty->assign('message',			sprintf($MSGTEXT['tpl_is_exists'], $this->post['name']));
					$this->get['id']	= $this->post['id'];
					$this->templates_editVirtualTamplate();
				}
			}
		}
		else {
			$this->templates_editVirtualTamplate();
		}
	}



	/**
     * обработка формы добавления конечного шаблона
     *
     */
	function templates_insert_Virtual() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE10, $MYSQL_TABLE11;

		if ($this->post['name']=='') {
			$this->smarty->assign('message',			$MSGTEXT['cannot_tpl_null_name']);
			$this->get['id']	= $this->post['id'];
			$this->templates_addVirtualTamplate();
		}
		else {
			$newTagNames	= array();
			$twins			= false;
			$noName			= false;
			foreach  ($this->postr as $key=>$value) {
				if (mb_substr($key,0, mb_strlen('tagid'))=='tagid') {
					$virtualtagid	= mb_substr($key, mb_strlen('tagid'));
					foreach  ($newTagNames AS $v) {
						if ($value==$v) {
							$twins	= true;
							break;
						}
					}

					if (!$twins) {
						if ($value!='')
						$newTagNames[$virtualtagid]=$value;
						else {
							$noName=true;
							break;
						}
					}
					else {
						break;
					}
				}
			}

			//если есть повторяющиеся имена
			if ($twins) {
				$this->smarty->assign('message',			$MSGTEXT['tags_name_cannot_same']);

				$this->templates_addVirtualTamplate();
				return false;
			}
			//если есть пустые имена
			elseif ($noName) {
				$this->smarty->assign('message',			$MSGTEXT['cannot_tpl_null_name']);
				$this->templates_addVirtualTamplate();
				return false;
			}
		}

		$name	= htmlspecialchars($this->postr['name'], ENT_QUOTES);
		$name	= addslashes($name);

		$query	= "SELECT * FROM `$MYSQL_TABLE10`  WHERE `name`='$name'";
		$result	= $this->mysql->executeSQL($query);

		if ($this->mysql->numRows($result)==0)  {

			$query			= "INSERT INTO `$MYSQL_TABLE10`  (`tamplates_id`, `name`) VALUES ('{$this->get['tamplate_id']}', '$name')";
			$this->mysql->executeSQL($query);
			$tamplate_id	= $this->mysql->insertID();

			foreach  ($this->postr as $key=>$value) {
				if (mb_substr($key, 0, mb_strlen('tagid'))=='tagid') {
					$tag_id	= mb_substr($key, mb_strlen('tagid'));
					$value	= htmlspecialchars($value, ENT_QUOTES);
					$value	= addslashes($value);

					$query			= "INSERT INTO `$MYSQL_TABLE11`  (`tag_id`, `virtualtemplate_id`, `virtualtagname`) VALUES ('$tag_id', '$tamplate_id', '$value')";
					$this->mysql->executeSQL($query);
					$virtualtag_id	= $this->mysql->insertID();
				}
			}

			$GENERAL_FUNCTIONS->gotoURL('?act=templates&page=1');
		}
		else {
			foreach  ($this->postr as $key=>$value) {
				$value	= htmlspecialchars($value, ENT_QUOTES);
				$this->smarty->assign($key, $value);
			}

			$this->smarty->assign('message',	sprintf($MSGTEXT['tpl_is_exists'], stripslashes($name)));

			$this->templates_addVirtualTamplate();
		}
	}



	/**
     * форма добавления нового шаблона
     *
     */
	function templates_form_add () {
		GLOBAL $MSGTEXT;

		$this->smarty->assign('content_template',	'templates/templates_form_add.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['tpl_create_new']);
	}



	/**
     * обработка формы добавления нового шаблона
     *
     */
	function templates_insert() {
		GLOBAL $FILE_MANAGER, $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE2, $MYSQL_TABLE4,  $TEMPLATES_PATH;

		$checkTagRes	= $this->checkTagsSintaksis($this->postr['content']);
		if (!is_bool($checkTagRes)) {
			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, stripslashes($value));
			$this->smarty->assign('message', $MSGTEXT['incorrect_simbol_in_tags']."<br><b>".$checkTagRes.'</b>');
			$this->templates_form_add();
		}
		else {
			$description	= htmlspecialchars($this->postr['description'], ENT_QUOTES);
			$description	= addslashes($description);
			$content		= $this->postr['content'];

			$query			= "SELECT * FROM `$MYSQL_TABLE2`  WHERE `description`='$description'";
			$result			= $this->mysql->executeSQL($query);

			if ($this->mysql->numRows($result)>0) {
				foreach  ($this->post as $key=>$value) $this->smarty->assign($key, stripslashes($value));
				$this->smarty->assign('message',		$MSGTEXT['tpl_name_exists']);
				$this->templates_form_add();
			}
			elseif ($this->post['description']=='') {
				foreach  ($this->post as $key=>$value) $this->smarty->assign($key, stripslashes($value));
				$this->smarty->assign('message',		$MSGTEXT['tpl_name_not_point']);
				$this->templates_form_add();
			}
			else {
				if (is_writable($TEMPLATES_PATH)) {

					$query	= "INSERT INTO `$MYSQL_TABLE2`  (`description`) VALUES ('$description')";
					$this->mysql->executeSQL($query);
					$tpl_id	= $this->mysql->insertID();

					//если добавили новые теги, то пишем их в базу
					$tags	= $this->getTagsFromText($content);
					for ($i=0; $i<count($tags); $i++) {
						$tagname	= htmlspecialchars($tags[$i]['name'], ENT_QUOTES);
						$tagname	= addslashes($tagname);
						$query		= "INSERT INTO `$MYSQL_TABLE4` (`templates_id`, `tagname`, `sort_index`) VALUES ('$tpl_id', '$tagname', '{$tags[$i]['sort_index']}')";
						$result		= $this->mysql->executeSQL($query);
					}

					$this->post['id']	= $tpl_id;
					$content			= $this->replaceUserTagsBySystemTags($content);

					$file	= $FILE_MANAGER->fopen($TEMPLATES_PATH.$tpl_id.'.tpl', 'w');
					fwrite($file, $content);
					fclose($file);

					$GENERAL_FUNCTIONS->gotoURL('?act=templates&page=1');
				}
				else {
					foreach  ($this->post as $key=>$value) 		$this->smarty->assign($key, stripslashes($value));
					$this->smarty->assign('message',			sprintf($MSGTEXT['cannot_write_in_patch'], $TEMPLATES_PATH));
					$this->templates_form_add();
				}
			}
		}
	}



	/**
     * проверяет синтаксис тегов
     *
     * @param string $text
     * @return boolean|string
     */
	function checkTagsSintaksis($text) {
		$tags		= array();
		$regular	= '|{\$(.*)\}|U';
		$k			= preg_match_all($regular, $text, $matches);

		$bad_symbols= array('$');
		$badTags	= '';

		if ($k>0) {
			for ($i=0; $i<$k; $i++) {
				$tagname	= $matches[1][$i];
				$bSymbols	= '';
				for ($i2=0; $i2<count($bad_symbols); $i2++)	 {

					if (mb_strpos($tagname, $bad_symbols[$i2])!==false) {
						$bSymbols.=' '.$bad_symbols[$i2];
					}
				}

				if ($bSymbols!='') $badTags.='{$'.$tagname.'} &rarr; '.$bSymbols.'<br>';
			}
		}

		if ($badTags!='') return $badTags;
		else return true;
	}



	/**
     * удаляем конечный шаблон
     *
     */
	function templates_delete_virtual() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE2, $MYSQL_TABLE3, $MYSQL_TABLE4, $MYSQL_TABLE10, $MYSQL_TABLE11,  $TEMPLATES_PATH;

		$query	= "SELECT * FROM `$MYSQL_TABLE3` WHERE `templates_id`='{$this->get['id']}'";
		$result	= $this->mysql->executeSQL($query);

		if ($this->mysql->numRows($result)>0) {
			$this->smarty->assign('message',			$MSGTEXT['cannot_del_tpl_before_page']);
			$this->templates_getlist();
		}
		else {
			$query	= "DELETE FROM `$MYSQL_TABLE10` WHERE `id`='{$this->get['id']}'";
			$result	= $this->mysql->executeSQL($query);

			//удаляем теги в шаблоне
			$query	= "DELETE FROM `$MYSQL_TABLE11` WHERE `virtualtemplate_id`='{$this->get['id']}'";
			$result	= $this->mysql->executeSQL($query);

			$GENERAL_FUNCTIONS->gotoURL('?act=templates&page=1');
		}
	}



	/**
     * удаляем шаблон
     *
     */
	function templates_delete() {
		GLOBAL $FILE_MANAGER, $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE2, $MYSQL_TABLE3, $MYSQL_TABLE4, $MYSQL_TABLE10, $TEMPLATES_PATH;

		$query	= "SELECT * FROM `$MYSQL_TABLE10` WHERE `tamplates_id`='{$this->get['id']}'";
		$result	= $this->mysql->executeSQL($query);

		if ($this->mysql->numRows($result)>0) {
			$this->smarty->assign('message',			$MSGTEXT['cannot_del_tpl_before_virt_tpl']);
			$this->get['page']	= 1;
			$_GET['page']		= 1;
			$this->templates_getlist();
		}
		else {
			$query	= "SELECT * FROM `$MYSQL_TABLE2` WHERE `id`='{$this->get['id']}'";
			$result	= $this->mysql->executeSQL($query);

			$row	= $this->mysql->fetchAssoc($result);
			$FILE_MANAGER->unlink($TEMPLATES_PATH.$this->get['id'].'.tpl');

			//удаляем шаблон
			$query="DELETE FROM `$MYSQL_TABLE2` WHERE `id`='{$this->get['id']}'";
			$this->mysql->executeSQL($query);

			//удаляем теги в шаблоне
			$query="DELETE FROM `$MYSQL_TABLE4` WHERE `templates_id`='{$this->get['id']}'";
			$this->mysql->executeSQL($query);

			$GENERAL_FUNCTIONS->gotoURL('?act=templates&page=1');
		}
	}



	/**
	 * Обновляет индекс сортировки тегов по положению в шаблоне
	 *
	 * @param array $tags
	 */
	function update_tags_orders($tags) {
		GLOBAL $MYSQL_TABLE4;

		for ($i=0; $i<count($tags); $i++) {
			$tagname	= htmlspecialchars($tags[$i]['name'], ENT_QUOTES);
			$tagname	= addslashes($tagname);
			$query		= "SELECT `id` FROM `$MYSQL_TABLE4` WHERE `tagname`='{$tagname}' AND `templates_id`='{$this->post['id']}'";
			$result		= $this->mysql->executeSQL($query);
			if (list($tagid)	= $this->mysql->fetchRow($result)	) {
				$sort_index		= $tags[$i]['sort_index'];
				$query			= "UPDATE `$MYSQL_TABLE4` SET `sort_index`='$sort_index' WHERE `id`='$tagid'";
				$this->mysql->executeSQL($query);
			}
		}
	}






	/**
 * Проверяет можно ли добавить вложенный шаблон к данному тегу. Защита от зацикливания
 *
 * @param array $tag
 * @param int $include_tpl_id
 * @return bool
 */
	function checkTagTree($tag, $include_tpl_id) {
		GLOBAL $MYSQL_TABLE11;

		//если для теги подключили тотже шаблон в котором он находится
		if ($include_tpl_id==$tag['from_tpl_id']) {
			return false;
		}

		//берём всё теги уровнем выше
		$query	= "SELECT `id`, `include_tpl_id`, `from_tpl_id` FROM `$MYSQL_TABLE11` WHERE `include_tpl_id`='{$tag['from_tpl_id']}'";
		$result	= $this->mysql->executeSQL($query);
		$tags	= $this->mysql->fetchAssocAll($result);
		foreach ($tags as $t) {
			if ($t['include_tpl_id']) {
				if ($t['include_tpl_id']!=$include_tpl_id) {
					return $this->checkTagTree($t, $include_tpl_id);
				}
				else {
					return false;
				}
			}
		}

		return true;
	}



	/**
     * форма редактирования настроек шаблона
     *
     */
	function templates_settings_edit() {
		GLOBAL  $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE10, $MYSQL_TABLE11, $MYSQL_TABLE2, $MYSQL_TABLE4,  $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE7,  $TEMPLATES_PATH, $MODULES_PATH;

		
		//берём текущий виртуальный шаблон редактирования
		$query				= "SELECT * FROM `$MYSQL_TABLE10` WHERE `id`='{$this->get['id']}'";
		$result				= $this->mysql->executeSQL($query);
		$virtualTamplate	= $this->mysql->fetchAssoc($result);
				
		//берём всё шаблоны
		$all_tpls			= array();
		$query				= "SELECT * FROM `$MYSQL_TABLE2` ORDER BY `description`";
		$result				= $this->mysql->executeSQL($query);
		while ($row			= $this->mysql->fetchAssoc($result)) {
			//чтобы не было зацикливания
			if ($row['id']!=$virtualTamplate['tamplates_id']) {
				$all_tpls[]		= $row;
			}
		}

		$query				= "SELECT * FROM `$MYSQL_TABLE2` WHERE `id`='{$virtualTamplate['tamplates_id']}'";
		$result				= $this->mysql->executeSQL($query);
		$row				= $this->mysql->fetchAssoc($result);
		$tpl_name			= $virtualTamplate['tamplates_id'].'.tpl';

		//берём новые теги подгружаемых шаблонов
		$tags				= $GENERAL_FUNCTIONS->getTagsTree($row['id'], $virtualTamplate['id'], 0);

		//берём блоки
		$query		= "SELECT $MYSQL_TABLE5.id AS `module_id`, $MYSQL_TABLE5.name AS `module_name`, $MYSQL_TABLE5.description AS `module_description`, $MYSQL_TABLE6.sort_index,  $MYSQL_TABLE6.type , $MYSQL_TABLE6.description as `block_description`, $MYSQL_TABLE6.id AS `block_id`, $MYSQL_TABLE6.name AS `block_name`
                				FROM `$MYSQL_TABLE5`, `$MYSQL_TABLE6` WHERE  $MYSQL_TABLE6.module_id=$MYSQL_TABLE5.id ORDER BY `module_id`";                                                            
		$result		= $this->mysql->executeSQL($query);
		$blocks		= $this->mysql->fetchAssocAll($result);

		if (isset($this->get['sel1']))   {
			$sel1			= $this->get['sel1'];
			$query			= "SELECT `virtualtagname` FROM `$MYSQL_TABLE11` WHERE `id`='$sel1'";
			$result			= $this->mysql->executeSQL($query);
			list($tagname)	= $this->mysql->fetchRow($result);
		}
		else {
			$sel1			= '';
			$tagname		= '';
		}

		if (isset($this->get['sel2']))   {
			$sel2	= $this->get['sel2'];
		}
		else {
			$sel2	= '';
		}


		//сортируем блоки
		$temp=array();
		foreach ($blocks as $b) {
			$temp[$b['module_id']][]=$b;
		}
		$_SESSION['___GoodCMS']['SORT_BY_FIELD']='sort_index';
		$temp2=array();
		foreach ($temp as $t) {
			usort($t, array($GENERAL_FUNCTIONS, 'sortByIntGrow'));
			foreach ($t as $b) {
				$temp2[]=$b;
			}
		}
		unset($temp);
		unset($temp2);

		if (isset($this->get['saved'])) {
			$this->smarty->assign('message',		$MSGTEXT['tpl_settings_is_saved']);
		}


		$this->smarty->assign('sel1', 				$sel1);
		$this->smarty->assign('sel2', 				$sel2);
		$this->smarty->assign('content_template',	'templates/templates_form_settings_edit.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['tpl_settings']);
		//$this->smarty->assign('elements',			$elements);
		$this->smarty->assign('tamplate_name', 		$virtualTamplate['name']);
		$this->smarty->assign('templates_id', 		$virtualTamplate['id']);
		$this->smarty->assign('tags', 				$tags);
		$this->smarty->assign('blocks', 			$blocks);
		$this->smarty->assign('tagname', 			$tagname);
		$this->smarty->assign('all_tpls', 			$all_tpls);
		$this->smarty->assign('errorMsgs', 			$this->errorMsgs);



	}



	/**
     * форма редактирования шаблона
     *
     */
	function templates_form_edit() {
		GLOBAL $FILE_MANAGER, $MSGTEXT, $MYSQL_TABLE2,  $TEMPLATES_PATH;

		$query	= "SELECT * FROM `$MYSQL_TABLE2` WHERE `id`='{$this->get['id']}'";
		$result	= $this->mysql->executeSQL($query);
		$row	= $this->mysql->fetchAssoc($result);
		foreach  ($row as $key=>$value) $this->smarty->assign($key, $value);

		$fcontents 	= $FILE_MANAGER->getfile ($TEMPLATES_PATH. $this->get['id'].'.tpl');
		$fcontents	= htmlspecialchars($fcontents, ENT_QUOTES);
		$fcontents	= $this->replaceSystemTagsByUserTags($fcontents);

		$this->smarty->assign('content_template', 	'templates/templates_form_edit.tpl');
		$this->smarty->assign('content', 			$fcontents);
		$this->smarty->assign('content_head', 		$MSGTEXT['tpl_edit_first_tpl']);
	}



	/**
     * форма копирования шаблона
     *
     */
	function templates_form_copy_virtual() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE4, $MYSQL_TABLE10, $MYSQL_TABLE11;

		$query		= "SELECT `id`, `tamplates_id` FROM `$MYSQL_TABLE10`  WHERE `id`='{$this->get['id']}'";
		$result		= $this->mysql->executeSQL($query);
		$data		= $this->mysql->fetchAssoc($result);
		foreach  ($data as $key=>$value) {
			$this->smarty->assign($key, stripslashes($value));
		}

		$query				= "SELECT `tamplates_id` FROM `$MYSQL_TABLE10` WHERE `id`='{$this->get['id']}'";
		$result				= $this->mysql->executeSQL($query);
		list($tamplate_id)	= $this->mysql->fetchRow($result);

		//берём новые теги подгружаемых шаблонов
		$tags				= $GENERAL_FUNCTIONS->getTagsTree($tamplate_id, $this->get['id'], 0);

		$this->smarty->assign('tags',				$tags);
		$this->smarty->assign('content_template',	'templates/templates_form_copy.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['tpl_copy_last_tpl']);
	}



	/**
     * обрабатывает форму правки тегов, после редактирования
     *
     */
	function templates_saveedittags() {
		GLOBAL  $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE4, $MYSQL_TABLE11;

		//берём все теги, которые есть в БД
		$query	= "SELECT * FROM `$MYSQL_TABLE4` WHERE `templates_id`='{$this->post['id']}' ORDER BY `sort_index`";
		$result	= $this->mysql->executeSQL($query);
		$bdtags	= $this->mysql->fetchAssocAll($result);

		for ($i=0; $i<count($bdtags); $i++) {
			$bdtags[$i]['edit']	= true;
		}

		//берём все теги в тексте
		$tags	= $this->getTagsFromText($this->postr['content']);

		//получаем новые теги, которых еще нет в БД
		$newTags=array();
		for ($i=0; $i<count($tags); $i++) {
			$query	= "SELECT * FROM `$MYSQL_TABLE4` WHERE `tagname`='{$tags[$i]['name']}' AND `templates_id`='{$this->post['id']}'";
			$result	= $this->mysql->executeSQL($query);
			if ($this->mysql->numRows($result)==0) {
				$newTags[]	= $tags[$i];
			}
		}

		//определяем, какие теги отредактировались, какие нет
		for ($i=0; $i<count($bdtags); $i++) {
			$tag_edit=false;
			for ($i2=0; $i2<count($tags); $i2++) {
				if ($bdtags[$i]['tagname']==$tags[$i2]['name']) {
					$tag_edit=true;
					break;
				}
			}

			if (!$tag_edit) {
				$bdtags[$i]['edit']=true;
			}
			else {
				$bdtags[$i]['edit']=false;
			}
		}

		//проверяем, чтоб не назначить теги с одинаковыми именами
		$new_tagname=array();
		foreach  ($this->post as $key=>$value) {
			if ('edittype_'	== mb_substr($key, 0, mb_strlen('edittype_')) ) {
				$old_tag_id		= mb_substr($key, mb_strlen('edittype_'));
				if (isset($this->postr['new_name_'.$old_tag_id]) && $this->post['edittype_'.$old_tag_id]==2) {
					$new_tagname[]	=$this->postr['new_name_'.$old_tag_id];
				}
			}
		}

		$twins_tags_in_edit=false;
		for ($i=0; $i<count($new_tagname); $i++) {
			$k=0;
			for ($i2=0; $i2<count($new_tagname); $i2++) {
				if ($new_tagname[$i]==$new_tagname[$i2]) $k++;
			}
			if ($k>1)	{
				$twins_tags_in_edit=true;
				break;
			}
		}

		if ($twins_tags_in_edit) {
			for ($i=0; $i<count($newTags); $i++) {
				$newTags[$i]['name']= htmlspecialchars($newTags[$i]['name'], ENT_QUOTES);
			}
			$this->templates_tags_edit($bdtags, $newTags, $MSGTEXT['twins_tags_is_bad']);

		}
		else {
			foreach  ($this->post as $key=>$value) {

				if ('edittype_'==mb_substr($key, 0, mb_strlen('edittype_'))) {
					$old_tag_id	= mb_substr($key, mb_strlen('edittype_'));

					//удалить старые теги
					if ($this->postr[$key]==1) {

						$query="DELETE FROM `$MYSQL_TABLE4` WHERE `id`='$old_tag_id'";
						$this->mysql->executeSQL($query);

						//удаляем теги в конечных шаблонах
						$query				= "SELECT * FROM `$MYSQL_TABLE11` WHERE `tag_id`='$old_tag_id'";
						$result			= $this->mysql->executeSQL($query);
						$virtualTamplates	= $this->mysql->fetchAssocAll($result);

						for ($k=0; $k<count($virtualTamplates); $k++) {
							$GENERAL_FUNCTIONS->delete_modules_records($virtualTamplates[$k]['id'], 'tag_id');
							$query	= "DELETE FROM `$MYSQL_TABLE11` WHERE `id`='{$virtualTamplates[$k]['id']}'";
							$this->mysql->executeSQL($query);
						}

					}
					//подправить имя
					elseif ($this->postr[$key]==2) {
						$new_tagname	= $this->postr['new_name_'.$old_tag_id];
						$new_tagname 	= htmlspecialchars($new_tagname, ENT_QUOTES);
						$new_tagname	= addslashes($new_tagname);

						$query			= "UPDATE `$MYSQL_TABLE4` SET `tagname`='$new_tagname' WHERE `id`='$old_tag_id'";
						$this->mysql->executeSQL($query);
					}
				}
			}

			//сохраняем изменения
			$this->saveEditComplete();
		}
	}



	/**
	 * заменяет написанные  пользователем имена тегов на системные имена
	 * 
	 *
	 * @param string $text
	 * @return string $text
	 */
	function replaceUserTagsBySystemTags($text) {
		GLOBAL $MYSQL_TABLE4;

		$tags	= $this->getTagsFromText($text);

		for ($i=0; $i<count($tags); $i++) {

			$tagname	= htmlspecialchars($tags[$i]['name'], ENT_QUOTES);
			$tagname	= addslashes($tagname);

			$query		= "SELECT `id`, `tagname` FROM `$MYSQL_TABLE4` WHERE `tagname`='{$tagname}' AND `templates_id`='{$this->post['id']}'";
			$result		= $this->mysql->executeSQL($query);
			if ($row	= $this->mysql->fetchAssoc($result)	) {

				$system_tag	= 'tag'.$row['id'];
				$text		= str_replace('{$'.$tags[$i]['name'].'}', '{$'.$system_tag.'}', $text);
			}
		}

		return $text;
	}



	/**
	 * заменяет написанные  пользователем имена тегов на системные имена тегов
	 * 
	 *
	 * @param string $text
	 * @return string $text
	 */
	function replaceSystemTagsByUserTags($text) {
		GLOBAL $MYSQL_TABLE4;

		$tags	= $this->getTagsFromText($text);


		for ($i=0; $i<count($tags); $i++) {

			$tagid		= mb_substr($tags[$i]['name'], 3);
			$query		= "SELECT * FROM `$MYSQL_TABLE4` WHERE `id`='{$tagid}'";
			$result		= $this->mysql->executeSQL($query);
			if ($row	= $this->mysql->fetchAssoc($result)	) {
				$text	= str_replace('{$'.$tags[$i]['name'].'}', '{$'.$row['tagname'].'}', $text);
			}
		}

		return $text;
	}



	/**
	 * заменяет написанные  пользователем имена  тегов в конечном шаблоне на абстрактные имена тегов
	 * 
	 *
	 * @param string $text
	 * @return string $text
	 */
	function replaceUserTagsBySystemVirtualTags($text) {
		GLOBAL $MYSQL_TABLE11;

		$tags	= $this->getTagsFromText($text);

		for ($i=0; $i<count($tags); $i++) {
			$query			= "SELECT * FROM `$MYSQL_TABLE11` WHERE `tagname`='{$tags[$i]['name']}' AND `templates_id`='{$this->post['id']}'";
			$result			= $this->mysql->executeSQL($query);
			if ($row		= $this->mysql->fetchAssoc($result)	) {
				$system_tag	= 'tag'.$row['tag_id'];
				$text		= str_replace('{$'.$tags[$i]['name'].'}', '{$'.$system_tag.'}', $text );
			}
		}

		return $text;
	}



	/**
	 * выполняет сохранение редактирования шаблона
	 *
	 */
	function saveEditComplete() {
		GLOBAL	$FILE_MANAGER, $MSGTEXT, $MYSQL_TABLE2, $MYSQL_TABLE4, $MYSQL_TABLE10, $MYSQL_TABLE11, $TEMPLATES_PATH;

		$query				= "SELECT * FROM `$MYSQL_TABLE2` WHERE `id`='{$this->post['id']}'";
		$result				= $this->mysql->executeSQL($query);
		$row				= $this->mysql->fetchAssoc($result);

		$content			= $this->postr['content'];
		$description		= htmlspecialchars($this->postr['description'], ENT_QUOTES);
		$description		= addslashes($description);

		$content_fortags	= htmlspecialchars($content, ENT_QUOTES);
		$content_fortags	= addslashes($content_fortags);


		if (is_writable($TEMPLATES_PATH.$this->post['id'].'.tpl')) {

			$query		= "UPDATE `$MYSQL_TABLE2` SET `description`='$description' WHERE `id`='{$this->post['id']}'";
			$this->mysql->executeSQL($query);

			//если добавили новые теги, то пишем их в базу
			$tags				= $this->getTagsFromText($content_fortags);

			for ($i=0; $i<count($tags); $i++) {

				$query		= "SELECT * FROM `$MYSQL_TABLE4` WHERE `templates_id`='{$this->post['id']}' AND `tagname`='{$tags[$i]['name']}'";
				$result		= $this->mysql->executeSQL($query);

				if ($this->mysql->numRows($result)==0) {

					$query		= "INSERT INTO `$MYSQL_TABLE4` (`templates_id`, `tagname`, `sort_index`) VALUES ('{$this->post['id']}', '{$tags[$i]['name']}', '{$tags[$i]['sort_index']}')";
					$result		= $this->mysql->executeSQL($query);
					$ins_id		= $this->mysql->insertID();

					//добавляем новые теги в конечные шаблоны
					$query		= "SELECT * FROM `$MYSQL_TABLE10` WHERE `tamplates_id`='{$this->post['id']}'";
					$result		= $this->mysql->executeSQL($query);
					$virtualTamplates	= $this->mysql->fetchAssocAll($result);

					for ($k=0; $k<count($virtualTamplates); $k++) {
						$query				= "INSERT INTO `$MYSQL_TABLE11` (`tag_id`, `virtualtemplate_id`, `virtualtagname`) VALUES ('$ins_id', '{$virtualTamplates[$k]['id']}', '{$tags[$i]['name']}')";
						$result				= $this->mysql->executeSQL($query);
						$virtualtag_id		= $this->mysql->insertID();
					}
				}
			}

			$file		= $FILE_MANAGER->fopen($TEMPLATES_PATH.$this->post['id'].'.tpl', 'w');
			fwrite($file, $this->replaceUserTagsBySystemTags($content));
			fclose($file);

			$this->update_tags_orders($tags);

			$this->smarty->assign('message',  $MSGTEXT['changes_save']);
		}
		else {
			$this->smarty->assign('message', $MSGTEXT['cannot_write']);
		}

		$this->smarty->assign('content', 			htmlspecialchars($content, ENT_QUOTES));
		$this->smarty->assign('description', 		stripslashes($description));
		$this->smarty->assign('id', 				$this->post['id']);
		$this->smarty->assign('content_head', 		$MSGTEXT['tpl_edit_tpl']);
		$this->smarty->assign('content_template', 	'templates/templates_form_edit.tpl');
	}



	/**
	 * выводит форму правки тегов
	 *
	 * @param array  $bdtags
	 * @param array  $tags
	 * @param string $message
	 */
	function templates_tags_edit($bdtags, $tags, $message='') {
		GLOBAL $MSGTEXT;
		foreach  ($this->postr as $key=>$value) $this->smarty->assign($key, htmlspecialchars($value, ENT_QUOTES));

		$this->smarty->assign('content_template',	'templates/templates_tags_edit.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['tpl_edit_tags']);
		$this->smarty->assign('bdtags',				$bdtags);
		$this->smarty->assign('tags', 				$tags);
		$this->smarty->assign('message',			$message);
	}



	/**
	 * выбирает из текста все теги
	 *
	 * @param string $content
	 * @return array $tags
	 */

	function getTagsFromText($content) {
		$regular='|\{\$(.*)\}|U';
		$k=preg_match_all($regular, $content, $matches, PREG_PATTERN_ORDER);
		$tags=array();
		if ($k>0)  {
			for ($i=0; $i<$k; $i++) {
				if (mb_substr($matches[1][$i], 0,7)!='smarty.') { //конструкции типа {$smarty.} не воспринимаются, как спецтеги

					$tmp['name']		= $matches[1][$i];
					$tmp['sort_index']	= $i+1;
					$tags[]				= $tmp;
				}
			}
		}
		return $tags;
	}


	/**
	 * Проверка опасных элементов в код
	 *
	 * @param text $content
	 * @return bool
	 */
	function checkBadElements($content) {
		GLOBAL $MSGTEXT;

		$res		= true;
		$pattern1='/function .* *\(.*?\) *\{.*\}/is';
		$pattern2='/<style.*?>/is';
		$pattern3='/\{[^\$\|]*\}/is';
		
		if (preg_match($pattern1, $content)) {
			$res	= false;
			$this->smarty->assign('errors', htmlspecialchars($MSGTEXT['twins_badelements_1']));
		}
		elseif (preg_match($pattern2, $content)) {
			$res	= false;
			$this->smarty->assign('errors', htmlspecialchars($MSGTEXT['twins_badelements_2']));
		}
		elseif (preg_match($pattern3, $content)) {
			$res	= false;
			$this->smarty->assign('errors', htmlspecialchars($MSGTEXT['twins_badelements_3']));
		}

		return $res;
	}


	/**
     * сохранение редактирования шаблона
     *
     */
	function templates_saveedit() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE2, $MYSQL_TABLE4,  $TEMPLATES_PATH;

		if (isset($this->postr['content'])) {
			$this->smarty->assign('content_head', $MSGTEXT['tpl_edit_tpl']);
			$checkTagRes	= $this->checkTagsSintaksis($this->postr['content']);
			if (!is_bool($checkTagRes)) {
				$this->smarty->assign('content_template', 'templates/templates_form_edit.tpl');
				foreach  ($this->postr as $key=>$value) $this->smarty->assign($key, htmlspecialchars($value, ENT_QUOTES) );
				$this->smarty->assign('message',  sprintf($MSGTEXT['incorrect_simbol_in_tags'], $checkTagRes));
				return true;
			}

			//проверка, чтоб в шаблонах не было JS-функций и Css-стилей
			if (!$this->checkBadElements($this->postr['content'])) {

				$this->smarty->assign('content_template', 'templates/templates_form_edit.tpl');
				foreach  ($this->postr as $key=>$value) $this->smarty->assign($key, $value);

			}
			else {

				//берём все теги в тексте
				$cont	= $this->postr['content'];
				$cont	= htmlspecialchars($cont, ENT_QUOTES);
				$tags	= $this->getTagsFromText($cont);

				//проверяем, чтоб в одном шаблоне небыло двух одинаковых тегов
				$twins_tags=false;
				for ($i=0; $i<count($tags); $i++) {
					$k=0;
					for ($i2=0; $i2<count($tags); $i2++) {
						if ($tags[$i]['name']==$tags[$i2]['name']) {
							$k++;
							if ($k==2) {
								$twins_tags=true;
								break;
							}
						}
					}
					if ($twins_tags) break;
				}

				if ($twins_tags) {
					$this->smarty->assign('content_template', 'templates/templates_form_edit.tpl');
					foreach  ($this->postr as $key=>$value) $this->smarty->assign($key, $value);
					$this->smarty->assign('errors', $MSGTEXT['twins_tags_is_bad']);
				}
				else {
					$query		= "SELECT * FROM `$MYSQL_TABLE2` WHERE `description`='{$this->post['description']}' AND `id`<>'{$this->post['id']}'";
					$result	= $this->mysql->executeSQL($query);

					if ($this->mysql->numRows($result)>0) {
						$query		= "SELECT * FROM `$MYSQL_TABLE2` WHERE `id`='{$this->post['id']}'";
						$result		= $this->mysql->executeSQL($query);
						$row		= $this->mysql->fetchAssoc($result);

						$this->smarty->assign('content_template', 'templates/templates_form_edit.tpl');

						foreach  ($this->postr AS $key=>$value) {
							$this->smarty->assign($key, $value);
						}

						$this->smarty->assign('message', sprintf($MSGTEXT['tpl_is_exists'], $this->post['description']));
					}
					else {
						//берём все теги, которые есть в БД
						$query	= "SELECT * FROM `$MYSQL_TABLE4` WHERE `templates_id`='{$this->post['id']}' ORDER BY `sort_index`";
						$result	= $this->mysql->executeSQL($query);
						$bdtags	= $this->mysql->fetchAssocAll($result);

						for ($i=0; $i<count($bdtags); $i++) {
							$bdtags[$i]['edit']	= true;
						}

						//определяем, какие теги отредактировались, какие нет
						$tag_edit=false;
						for ($i=0; $i<count($bdtags); $i++) {
							for ($i2=0; $i2<count($tags); $i2++) {
								if ($bdtags[$i]['tagname']==$tags[$i2]['name']) {
									$bdtags[$i]['edit']	= false;
									break;
								}
							}

							if ($bdtags[$i]['edit']==true) {
								$tag_edit	= true;
							}
						}

						//выводим форму правки
						if ($tag_edit) {
							//получаем новые теги, которых еще нет в БД
							$newTags=array();
							for ($i=0; $i<count($tags); $i++) {
								$query	= "SELECT * FROM `$MYSQL_TABLE4` WHERE `tagname`='{$tags[$i]['name']}' AND `templates_id`='{$this->post['id']}'";
								$result	= $this->mysql->executeSQL($query);
								if ($this->mysql->numRows($result)==0) {
									$newTags[]=$tags[$i];
								}
							}

							$this->templates_tags_edit($bdtags, $newTags);
						}
						else {
							//сохраняем изменения
							$this->saveEditComplete();
						}
					}
				}
			}
		}
		else {
			$this->templates_form_edit();
		}
	}



	/**
     * создает копию шаблона
     *
     */
	function templates_savecopy_virtual() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE10, $MYSQL_TABLE11;

		$this->get['id']	= $this->post['id'];

		if ($this->post['name']=='') {
			$this->smarty->assign('message',			$MSGTEXT['cannot_tpl_null_name']);

			$this->templates_form_copy_virtual();
		}
		else {
			$newTagNames	= array();
			$noName			= false;
			foreach  ($this->postr as $key=>$value) {

				$temp=explode('--', $key);
				if (mb_strpos($temp[0], 'tagid')!==false) {
					$virtualtagid = $temp[1];
					foreach  ($newTagNames AS $v) {
						if ($value==$v) {
							$twins=true;
							break;
						}
					}

					if ($value!='') {
						$value	= htmlspecialchars($value, ENT_QUOTES);
						$value	= addslashes($value);
						$tn['virtualtagid']	= $virtualtagid;
						$tn['value']		= $value;
						$newTagNames[]		= $tn;
					}
					else {
						$noName=true;
						break;
					}
				}
			}

			if ($noName) {
				$this->smarty->assign('message',			$MSGTEXT['cannot_tag_null_name']);
				$this->templates_form_copy_virtual();
				return false;
			}
		}

		$name	= htmlspecialchars($this->postr['name'], ENT_QUOTES);
		$name	= addslashes($name);

		$query	= "SELECT * FROM `$MYSQL_TABLE10` WHERE `name`='$name'";
		$result	= $this->mysql->executeSQL($query);

		if ($this->mysql->numRows($result)==0)  {

			$query			= "INSERT INTO `$MYSQL_TABLE10` (`tamplates_id`, `name`) VALUES ('{$this->post['tamplate_id']}', '$name')";
			$this->mysql->executeSQL($query);
			$tamplate_id	= $this->mysql->insertID();

			$copied_tags	=array();
			$query			= "SELECT * FROM `$MYSQL_TABLE11`  WHERE `virtualtemplate_id`='{$this->post['id']}'";
			$result			= $this->mysql->executeSQL($query);
			while ($row		= $this->mysql->fetchAssoc($result)) {
				$copied_tags[$row['id']]=$row;
			}

			foreach  ($newTagNames as $ntn ) {
				$virtualtagid	= $ntn['virtualtagid'];
				$value			= $ntn['value'];

				if (isset($copied_tags[$virtualtagid])) {
					$tag_id			= $copied_tags[$virtualtagid]['tag_id'];
					$global			= $copied_tags[$virtualtagid]['global'];
					//чтобы небыло дублей сквозных тегов
					if ($global==2) {
						$global=0;
					}
					$block_id		= $copied_tags[$virtualtagid]['block_id'];
					$include_tpl_id	= $copied_tags[$virtualtagid]['include_tpl_id'];
					$from_tpl_id	= $copied_tags[$virtualtagid]['from_tpl_id'];
					
					if ($block_id==NULL) 	{
						$block_id='NULL';
					}
					if ($include_tpl_id==NULL) {
						$include_tpl_id='NULL';
					}
					if ($from_tpl_id==NULL) {
						$from_tpl_id='NULL';
					}

					$query			= "INSERT INTO `$MYSQL_TABLE11`  (`tag_id`, `virtualtemplate_id`, `virtualtagname`, `block_id`, `global`, `include_tpl_id`, `from_tpl_id`) VALUES ('$tag_id', '$tamplate_id', '$value', $block_id, '$global', $include_tpl_id, $from_tpl_id)";
					$this->mysql->executeSQL($query);
					$virtualtag_id	= $this->mysql->insertID();
				}
			}

			$GENERAL_FUNCTIONS->gotoURL('?act=templates&page=1');
		}
		else {
			foreach  ($this->postr as $key=>$value) {
				$value	= htmlspecialchars($value, ENT_QUOTES);
				$this->smarty->assign($key, $value);
			}

			$this->smarty->assign('message', sprintf($MSGTEXT['tpl_is_exists'], stripslashes($name)));

			$this->templates_form_copy_virtual();
		}
	}



	/**
	 * Заменяет пользовательский тег на реальный
	 *
	 * @param int $tpl_id
	 * @param int $ins_id
	 * @param string $tagname
	 */
	function replaceOneUserTag($tpl_id, $ins_id, $tagname) {
		GLOBAL  $FILE_MANAGER, $MYSQL_TABLE2, $TEMPLATES_PATH;

		$tpl_name	= $tpl_id.'.tpl';
		$content	= $FILE_MANAGER->getfile($TEMPLATES_PATH.$tpl_name);
		$content	= str_replace('{$'.$tagname.'}', '{$tag'.$ins_id.'}', $content);

		$file		= $FILE_MANAGER->fopen($TEMPLATES_PATH.$tpl_name, 'w');
		fwrite($file, $content);
		fclose($file);
	}



	/**
	 * Заменяет пользовательский тег на виртуальный
	 *
	 * @param int $tpl_id
	 * @param int $ins_id
	 * @param string $tagname
	 */
	function replaceOneUserVirtualTag($tpl_id, $ins_id, $tagname) {
		GLOBAL  $FILE_MANAGER, $MYSQL_TABLE10, $TEMPLATES_PATH;

		$tpl_name	= $tpl_id.'.tpl';
		$content	= $FILE_MANAGER->getfile($TEMPLATES_PATH.$tpl_name);
		$content	= str_replace('{$'.$tagname.'}', '{$tag'.$ins_id.'}', $content);

		$file		= $FILE_MANAGER->fopen($TEMPLATES_PATH.$tpl_name, 'w');
		fwrite($file, $content);
		fclose($file);
	}


	/**
	 * Удаляет виртуальные теги подгружаемых шаблонов
	 *
	 * @param int $include_tpl_id
	 */
	function deleteTags($include_tpl_id, $virtualtemplate_id) {
		GLOBAL $MYSQL_TABLE11;

		$query				= "SELECT `include_tpl_id` FROM `$MYSQL_TABLE11` WHERE `from_tpl_id`='$include_tpl_id' AND `virtualtemplate_id`='$virtualtemplate_id'";
		$result				= $this->mysql->executeSQL($query);
		$deleted_tags		= $this->mysql->fetchAssocAll($result);

		$query				= "DELETE FROM `$MYSQL_TABLE11`  WHERE `from_tpl_id`='$include_tpl_id' AND `virtualtemplate_id`='$virtualtemplate_id'";
		$this->mysql->executeSQL($query);

		foreach ($deleted_tags as $dt) {
			if ($dt['include_tpl_id']>0) {
				$this->deleteTags($dt['include_tpl_id'], $virtualtemplate_id);
			}
		}
	}



	/**
     * обработка формы редактирования настроек шаблона    
     *
     */
	function templates_settings_save_edit() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE3, $MYSQL_TABLE4, $MYSQL_TABLE6, $MYSQL_TABLE10, $MYSQL_TABLE11, $MYSQL_TABLE18;

		if (!isset($this->post['tag_id'])) {
			$GENERAL_FUNCTIONS->gotoURL('?act=templates&do=settings_edit&saved=true&id='.$this->post['templates_id']);
			exit;
		}

		$exist_row	= false;
		$query		= "SELECT * FROM `$MYSQL_TABLE11` WHERE `id`='{$this->post['tag_id']}'";
		$result		= $this->mysql->executeSQL($query);
		$exist_row	= $this->mysql->fetchAssoc($result);

		if ($this->post['global']==2) {
			$query		= "SELECT * FROM `$MYSQL_TABLE11` WHERE `id`!='{$this->post['tag_id']}' AND `virtualtagname`='{$this->post['tagname']}' AND `global`='2'";
			$result		= $this->mysql->executeSQL($query);
			$exist_same_global		= $this->mysql->numRows($result);
			if ($exist_same_global>0) {
				$this->smarty->assign('message', $MSGTEXT['super_tag_exists']);

				$this->get['id']	= $this->post['templates_id'];
				$this->get['sel1']	= $this->post['tag_id'];
				$this->get['sel2']	= $this->post['block_id'];

				$this->templates_settings_edit();
				return false;
			}
		}

		if (!$exist_row) {
			print_r($this->post);
			echo 'EXISTS ERROR!'; exit;
		}
		else {
			/////меняем в таблицах модуля значение тега/////
			//получаем модуль, к которому принадлежит блок, а также тип блока
			if ($this->post['block_id']==0) {
				//берем старый блок
				$query				= "SELECT  `block_id` FROM `$MYSQL_TABLE11` WHERE `id`='{$this->post['tag_id']}'";
				$result				= $this->mysql->executeSQL($query);
				list($old_block_id)	= $this->mysql->fetchRow($result);

				$query							= "SELECT  `module_id`, `type` FROM `$MYSQL_TABLE6` WHERE `id`='$old_block_id'";
				$result							= $this->mysql->executeSQL($query);
				list($module_id, $block_type)	= $this->mysql->fetchRow($result);
			}
			else {
				$query							= "SELECT  `module_id`, `type` FROM `$MYSQL_TABLE6` WHERE `id`='{$this->post['block_id']}'";
				$result							= $this->mysql->executeSQL($query);
				list($module_id, $block_type)	= $this->mysql->fetchRow($result);
			}

			//если блок одинарный
			if ($block_type==2) {

				//ищем тег, к которому имеет отношение блок
				if ($this->post['block_id']>0) {
					$query				= "SELECT `id` FROM `$MYSQL_TABLE11` WHERE `block_id`='{$this->post['block_id']}' ORDER BY `global` DESC LIMIT 1";
					$result				= $this->mysql->executeSQL($query);
					list($old_tag_id)	= $this->mysql->fetchRow($result);
					if (!$old_tag_id) 	$old_tag_id=0;
					$new_tag_id			= $this->post['tag_id'];
				}
				else {
					//проверяем, может один и тотже блок подключен разным тегам
					$query				= "SELECT `id` FROM `$MYSQL_TABLE11` WHERE `block_id`='$old_block_id' AND `id`!='{$this->post['tag_id']}' ORDER BY `global` DESC LIMIT 1";
					$result				= $this->mysql->executeSQL($query);
					list($other_tag_id)	= $this->mysql->fetchRow($result);

					if (!$other_tag_id)	$new_tag_id			= 0;
					else $new_tag_id	= $other_tag_id;

					$old_tag_id			= $this->post['tag_id'];
				}

				//получаем таблицы модуля
				$query				= "SELECT `table_name` FROM `$MYSQL_TABLE18` WHERE `module_id`='$module_id'";
				$result				= $this->mysql->executeSQL($query);
				$mtables			= $this->mysql->fetchAssocAll($result);
				/*
				//получаем id страницы
				$query				= "SELECT `id` FROM `$MYSQL_TABLE3` WHERE `templates_id`='{$this->post['templates_id']}' AND `enable`='1' LIMIT 1";
				$result				= $this->mysql->executeSQL($query);
				list($new_page_id)	= $this->mysql->fetchRow($result);
				*/

				//меняем в таблицах модуля значение тега
				foreach ($mtables AS $t) {
					$query			= "UPDATE `{$t['table_name']}` SET `tag_id`='$new_tag_id' WHERE `tag_id`='$old_tag_id' OR `tag_id`=0";
					$result			= $this->mysql->executeSQL($query);
					/*
					//меняем страницу
					$query			= "UPDATE `{$t['table_name']}` SET `page_id`='$new_page_id' WHERE `page_id`='$old_page_id' OR `page_id`=0";
					$result			= $this->mysql->executeSQL($query);
					print $query.'<br>';
					*/
				}
			}

			//$query	= "UPDATE `$MYSQL_TABLE11` SET `block_id`='{$this->post['block_id']}', `global`='{$this->post['global']}' WHERE `id`='{$this->post['tag_id']}' ";

			//удаляем шаблоны из подключаемых тегов
			if ($exist_row['include_tpl_id']>0 && $this->post['include_tpl_id']==0) {
				$this->deleteTags($exist_row['include_tpl_id'], $exist_row['virtualtemplate_id']);
			}

			//чтобы шаблон не указывал сам на себя
			if (isset($this->post['include_tpl_id']) && !$this->checkTagTree($exist_row, $this->post['include_tpl_id'])) {
				$update=false;
			}
			else {
				$update=true;
			}


			if ($update) {
				if ($this->post['include_tpl_id']) {
					$include_tpl_id=$this->post['include_tpl_id'];
				}
				else {
					$include_tpl_id='NULL';
				}

				if ($this->post['block_id']) {
					$block_id=$this->post['block_id'];
				}
				else {
					$block_id='NULL';
				}

				$query	= "UPDATE `$MYSQL_TABLE11` SET `include_tpl_id`=$include_tpl_id, `block_id`=$block_id, `global`='{$this->post['global']}' WHERE `id`='{$this->post['tag_id']}' ";
				$this->mysql->executeSQL($query);
			}
			else {
				//выводим ошибку
				$this->errorMsgs[]	= $MSGTEXT['templates_form_settings_dead_line'];
				$this->get['id']	= $exist_row['virtualtemplate_id'];
				$this->get['sel2']	= $exist_row['id'];
				return  $this->templates_settings_edit();
			}


			//обновляем для записей индекс на тег
			$sel1	= $this->post['tag_id'];

		}

		$sel2		= $this->post['block_id'];
		$selected	= '&sel1='.$sel1.'&sel2='.$sel2;

		//если тег был супер глобальным, а теперь имеет другое свойство, то ничего не выделяем
		if (isset($exist_row) &&  ($exist_row['global']==2) && ($this->post['global']<2) ) {
			$selected='';
		}

		if (isset($this->get['hide_menu']))  {	//выводим html-текст который обновляет родительское окно и закрывает текущее
			$query					= "SELECT `page_category` FROM `$MYSQL_TABLE3` WHERE `id`='{$this->post['page_id']}'";
			$result					= $this->mysql->executeSQL($query);
			list($pageCategoryId)	= $this->mysql->fetchRow($result);

			$this->smarty->assign('page_id', 		$this->post['page_id']);
			$this->smarty->assign('pageCategoryId', $pageCategoryId);

			echo $this->smarty->fetch('templates/templates_location.tpl');
			exit;
		}
		else $GENERAL_FUNCTIONS->gotoURL('?act=templates&do=settings_edit&saved=true&id='.$this->post['templates_id'].$selected);

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