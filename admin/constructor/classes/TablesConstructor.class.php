<?php
/**
 * класс для работы с таблицыми
 *
 */
class TablesConstructor  {

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
   	 * @var array
   	 */
	public		$mysql;


	/**
     *  Содержит сообщения об ошибках
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
	function TablesConstructor($mysql, $smarty, $post, $postr, $get, $getr,  $do) {
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
			case ('insert_copy'):			$this->insertCopy(); 		break;
			case ('move_table_item'):		$this->moveTableItem(); 	break;
			case ('setStatus'):				$this->setStatus(); 	break;
			endswitch;
		}
		else {
			$this->editError	= $MSGTEXT['error_accsess_to_constructor'];

			$this->smarty->assign('errors',	$this->editError);
			$this->smarty->assign('content_template',	'errors/errors_list.tpl');
		}
	}



	/**
	 * получаем список таблиц
	 *
	 */
	function getList() {
		GLOBAL $MSGTEXT, $GENERAL_FUNCTIONS, $MYSQL_CTR_TABLE18;

		if (isset($this->get['page']) && $this->get['page']!='') $_SESSION['___GoodCMS']['BACK_RECORD_URL']='?'.$_SERVER['QUERY_STRING'];

		if (isset($this->get['t_id'])) {
			$t_id	= $this->get['t_id'];
			$where	= " AND `id`='$t_id'";
		}
		else $where='';

		$query			= "SELECT * FROM `$MYSQL_CTR_TABLE18` WHERE `module_id`='{$this->m_id}' $where ORDER BY `sort_index`";
		$result			= $this->mysql->executeSQL($query);
		$allTables		= $this->mysql->fetchAssocAll($result);
		$sort			= $GENERAL_FUNCTIONS->getSortVariables('sort_index');

		$this->smarty->assign('content_template',	'tables/tables_list.tpl');
		$this->smarty->assign('tables',				$allTables);
		$this->smarty->assign('content_head',		$MSGTEXT['table_constr_table_mod']);
		$this->smarty->assign('sort_by',			$sort['sort_by']);
		$this->smarty->assign('sort_type',			$sort['sort_type']);
		$this->smarty->assign('refreshFrame',		$this->refreshFrame);
	}



	/**
     * форма создания таблицы
     *
     */
	function form_add() {
		GLOBAL  $CMSProtection, $MSGTEXT, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE19, $MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE22;

		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE19`";
		$result		= $this->mysql->executeSQL($query);
		$collations	= $this->mysql->fetchAssocAll($result);

		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE20`";
		$result		= $this->mysql->executeSQL($query);
		$datatypes	= $this->mysql->fetchAssocAll($result);

		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE22`";
		$result		= $this->mysql->executeSQL($query);
		$edittypes	= $this->mysql->fetchAssocAll($result);


		$this->smarty->assign('content_template',	'tables/tables_form_edit.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['table_constr_create_table']);
		$this->smarty->assign('collations',			$collations);
		$this->smarty->assign('datatypes',			$datatypes);
		$this->smarty->assign('edittypes',			$edittypes);
		$this->smarty->assign('do',					'insert');


		if (isset($this->post['counter'])) $counter=$this->post['counter'];
		else  $counter=-1;
		$this->smarty->assign('counter',	$counter);
	}



	/**
     * форма создания копии таблицы
     *
     */
	function insertCopyForm () {
		GLOBAL  $MSGTEXT,$MYSQL_CTR_TABLE18;

		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE18` WHERE `id`='{$this->get['t_id']}'";
		$result		= $this->mysql->executeSQL($query);
		$table		= $this->mysql->fetchAssoc($result);

		foreach ($table as $k=>$v) {
			$this->smarty->assign($k, $v);
		}

		$this->smarty->assign('content_template',	'tables/tables_form_add_copy.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['table_constr_copy_table'].' <a href="?act=t_c&t_id='.$this->get['t_id'].'">«'.$table['name'].'»</a>');
	}



	/**
	 * устонавливает порядок сортировки модулей
	 *
	 */
	function moveTableItem() {
		GLOBAL  $MSGTEXT,$MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18;

		$id			= $this->get['id'];
		$query		= "SELECT * FROM  `$MYSQL_CTR_TABLE18` WHERE  `id`='$id'";
		$result		= $this->mysql->executeSQL($query);
		$cat		= $this->mysql->fetchAssoc($result);

		$query		= "SELECT * FROM  `$MYSQL_CTR_TABLE18` WHERE `module_id`='{$this->m_id}' ORDER BY `sort_index`";
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
							$this->smarty->assign('message',		$MSGTEXT['table_constr_no_up']);
							$next	= 0;
						}
					}
					elseif ($this->get['type']=='down') {
						if ($i<count($catItems)-1) $next = $i+1;
						else {
							$this->smarty->assign('message',		$MSGTEXT['table_constr_no_down']);
							$next	= count($catItems)-1;
						}
					}

					$moved		= $i;
					$query		= "UPDATE `$MYSQL_CTR_TABLE18` SET `sort_index`='{$catItems[$moved]['sort_index']}' WHERE  `id`='{$catItems[$next]['id']}'";
					$result		= $this->mysql->executeSQL($query);

					$query		= "UPDATE `$MYSQL_CTR_TABLE18` SET `sort_index`='{$catItems[$next]['sort_index']}' WHERE  `id`='{$catItems[$moved]['id']}'";
					$result		= $this->mysql->executeSQL($query);

					$this->refreshFrame	= 1;
					setHistory($this->m_id, 2, 5, $catItems[$next]['id']);
					setHistory($this->m_id, 2, 5, $catItems[$moved]['id']);

					break;
				}
			}
		}
		$this->getList();
	}



	/**
	 * Обновляет свойство таблицы "Редактируется"
	 *
	 */
	function setStatus() {
		GLOBAl $MYSQL_CTR_TABLE18;

		$show_type		= $this->get['show_type'];
		$table_id		= $this->get['table_id'];

		$query		= "UPDATE `$MYSQL_CTR_TABLE18` SET `show_type`='$show_type' WHERE  `id`='$table_id'";
		$result		= $this->mysql->executeSQL($query);
		setHistory($this->m_id, 2, 5, $table_id);

		$this->getList();
	}



	/**
	 * Получает поля
	 *
	 * @param bool $edit
	 * @return array
	 */
	function getFields($edit=false) {
		GLOBAL $MSGTEXT,$MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE25, $BAD_SYMBOLS;

		$table			= array();
		$edittype_id_14	= 0;
		$name			= addslashes(strtolower($this->post['name']));
        if (!preg_match("/^([A-Z0-9_\\/\.-]*)$/i", $name)) {
			$this->editError[]=	$MSGTEXT['table_constr_err_ciril'].' <b>/\:*?"< >|</b>';
		}
		else {
			$table['name']	= $name;
			if (isset($this->post['show_type'])) {
				$table['show_type']=$this->postr['show_type'];
			}
			else {
				$table['show_type']=0;
			}

			if ($edit) $where=" AND `id`!='{$this->post['id']}'";
			else $where='';
			if ($this->postr['description']!='')  {
				$description			= htmlspecialchars(str_replace($BAD_SYMBOLS, '', $this->postr['description']), ENT_QUOTES);
				$table['description']	= $description;
			}
			else $this->editError[]		= $MSGTEXT['table_constr_no_desc'];

			//дополнительные кнопки
			$table['additional_buttons']= htmlspecialchars(str_replace($BAD_SYMBOLS, '', $this->postr['additional_buttons']), ENT_QUOTES);

			$query		= "SELECT count(*) FROM `$MYSQL_CTR_TABLE18` WHERE `name`='$name' AND `module_id`='{$this->m_id}' $where";
			$result		= $this->mysql->executeSQL($query);
			$c			= $this->mysql->fetchRow($result);
			if ($c[0]>0) {
				$this->editError[]		= $MSGTEXT['table_constr_err_name'];
			}
			elseif ($this->post['name']=='') {
				$this->editError[]		= $MSGTEXT['table_constr_no_empty'];
			}
		}

		//проверка зополненых полей таблицы
		$fields_count	= 0;
		$fields			= array();
		$same_names		= array();

		while ($fields_count<=$this->post['counter']) {

			if (isset($this->post['fieldname'.$fields_count])) {
				$tmp=array();

				if (isset($this->post['field_id'.$fields_count])) $tmp['id']	= $this->post['field_id'.$fields_count];
				$tmp['edittype_id']=$this->postr['edittype_id'.$fields_count];

				//если поменяли тип редактирования, то очищаем ссылку на другую таблицу
				if (is_numeric($this->postr['sourse_field_id'.$fields_count])) {
					//если не может быть в фильтре, то обновляем настройку
					if  (!in_array($tmp['edittype_id'], array(3,4,5,6)) && $tmp['edittype_id']!=14 && $tmp['edittype_id']!=15) {
						if ($this->postr['sourse_field_id'.$fields_count]>0) {
							$query				= "SELECT `id` FROM `$MYSQL_CTR_TABLE25`  WHERE  `field_id`='{$tmp['id']}'";
							$result				= $this->mysql->executeSQL($query);

							if (list($fs_id)	= $this->mysql->fetchRow($result)) {
								$query			= "UPDATE `$MYSQL_CTR_TABLE25` SET	`filter`='0' WHERE  `id`='$fs_id'";
								$result			= $this->mysql->executeSQL($query);
								setHistory($this->m_id, 2, 7, $fs_id);
							}
						}
						$tmp['sourse_field_id']=0;
					}
					else $tmp['sourse_field_id']=$this->postr['sourse_field_id'.$fields_count];
				}
				else  $tmp['sourse_field_id']=0;

				$tmp['delete']		= $this->postr['delete'.$fields_count];
				$tmp['own_filter']	= $this->postr['own_filter'.$fields_count];


				if (isset($this->post['comment'.$fields_count])) $tmp['comment']= addslashes(str_replace($BAD_SYMBOLS, '', $this->postr['comment'.$fields_count]));
				else $tmp['comment']='';

				//удаляет из начала строки пробелы
				$tmp['comment']=ltrim($tmp['comment']);

				//удаляет в конце строки пробелы
				$tmp['comment']=rtrim($tmp['comment']);

				$tmp['comment']=str_replace('/', '', $tmp['comment']);




				$tmp['fieldname']=addslashes($this->postr['fieldname'.$fields_count]);

				if (isset($this->post['datatype_id'.$fields_count])) $tmp['datatype_id']=$this->post['datatype_id'.$fields_count];
				else $tmp['datatype_id']='';

				if (isset($this->postr['len'.$fields_count])) {
					if ($this->postr['len'.$fields_count]!='') $tmp['len']=$this->postr['len'.$fields_count];
					else $tmp['len']='';
				}
				else $tmp['len']='';

				if (isset($this->post['default'.$fields_count])) $tmp['default']=addslashes($this->postr['default'.$fields_count]);
				else $tmp['default']='';

				if (isset($this->post['collation_id'.$fields_count])) $tmp['collation_id']=$this->post['collation_id'.$fields_count];
				else $tmp['collation_id']=56;	//по умолчанию ставим кодировку


				if (isset($this->post['group_caption'.$fields_count])) $tmp['group_caption']=addslashes($this->postr['group_caption'.$fields_count]);
				else $tmp['group_caption']='';


				if (isset($this->post['pk'.$fields_count])) $tmp['pk']=$this->post['pk'.$fields_count];
				else $tmp['pk']=0;

				if (isset($this->post['not_null'.$fields_count])) $tmp['not_null']=$this->post['not_null'.$fields_count];
				else $tmp['not_null']=0;

				if (isset($this->post['unsigned'.$fields_count]))$tmp['unsigned']=$this->post['unsigned'.$fields_count];
				else $tmp['unsigned']=0;

				if (isset($this->post['auto_incr'.$fields_count])) $tmp['auto_incr']=$this->post['auto_incr'.$fields_count];
				else $tmp['auto_incr']=0;

				if (isset($this->post['zerofill'.$fields_count])) $tmp['zerofill']=$this->post['zerofill'.$fields_count];
				else $tmp['zerofill']=0;

				if (isset($this->post['unique'.$fields_count])) {
					if ($tmp['len']>255)  {
						$this->editError[]	= sprintf($MSGTEXT['table_constr_big_len_for_unic'], $tmp['fieldname']);
					}

					$tmp['unique']=$this->post['unique'.$fields_count];
				}
				else $tmp['unique']=0;

				//проверяем, чтоб в таблице не было двух полей стипом редактирования Friendly URL
				if ($tmp['edittype_id']==14) {
					$edittype_id_14++;
					if ($edittype_id_14>1) {
						$this->editError[]	= $MSGTEXT['table_constr_friendly_double'];
					}

				}
				//проверяем, чтоб поле было уникальным, если выбрано Friendly URL
				if ($tmp['edittype_id']==14 && (!isset($tmp['unique']) || !$tmp['unique'])) {
					$this->editError[]	= $MSGTEXT['table_constr_friendly_most_have_uniq'];
				}

				if (isset($this->post['notfedit'.$fields_count])) {
					$tmp['notfedit']=1;
				}
				else {
					$tmp['notfedit']=0;
				}

				if (is_numeric($this->post['sort_index'.$fields_count])) $tmp['sort_index']=$this->post['sort_index'.$fields_count];
				else $tmp['sort_index']=0;

				$fields[]=$tmp;
			}
			$fields_count++;
		}

		$auto_incr=false;
		$pk_is=false;
		for ($i=0; $i<count($fields); $i++) {
			if ($fields[$i]['pk']) {
				$pk_is=true;
			}

			$len_array=array();
			if ($fields[$i]['fieldname']=='') {
				$this->editError[]	= $MSGTEXT['table_constr_empty'];
			}
			else {

				$k=0;
				for ($i2=0; $i2<count($fields); $i2++) {
					if ($fields[$i]['fieldname']==$fields[$i2]['fieldname']) $k++;
					if ($k>1) {
						if (!isset($same_names[$fields[$i]['fieldname']])) {
							$this->editError[]=sprintf($MSGTEXT['table_constr_same'], $fields[$i]['fieldname']);
							$same_names[$fields[$i]['fieldname']]=true;
						}
						$k=0;
						break;
					}
				}

				if ($fields[$i]['fieldname']=='sort_index' || $fields[$i]['fieldname']=='page_id' || $fields[$i]['fieldname']=='tag_id' || $fields[$i]['fieldname']=='lang_id') {
					$this->editError[]=$MSGTEXT['table_constr_err_same_name'];
				}

				if ($fields[$i]['comment']=='') {
					$this->editError[]=sprintf($MSGTEXT['table_constr_no_com'], $fields[$i]['fieldname']);
				}

				if ($fields[$i]['datatype_id']=='') {
					$this->editError[]=sprintf($MSGTEXT['table_constr_no_type'], $fields[$i]['fieldname']);
				}
				else {

					$query		= "SELECT * FROM `$MYSQL_CTR_TABLE20` WHERE `id`='{$fields[$i]['datatype_id']}'";
					$result		= $this->mysql->executeSQL($query);
					$datatype	= $this->mysql->fetchAssoc($result);
					$fields[$i]['datatype']=$datatype['datatype'];


					if ($datatype['character_need']==1) {
						if ($fields[$i]['collation_id']=='' || $fields[$i]['collation_id']<1) {
							$this->editError[]=sprintf($MSGTEXT['table_constr_no_cod'], $fields[$i]['fieldname']);
						}
					}
					elseif ($datatype['character_need']==0) {
						$fields[$i]['collation_id']=0;
					}

					if ($datatype['len_need']==1) {
						if ($fields[$i]['datatype_id']!=24 && $fields[$i]['datatype_id']!=25) {
							if (!is_numeric($fields[$i]['len']) || $fields[$i]['len']<1) $this->editError[]= sprintf($MSGTEXT['table_constr_bad_length'], $fields[$i]['fieldname']);
						}
						else {
							if ((!$len_count=@preg_match_all("|'(.*)'|U", $fields[$i]['len'],  $len_array)) || mb_strpos($fields[$i]['len'], '"')) {

								$this->editError[]=sprintf($MSGTEXT['table_constr_no_length'], $fields[$i]['fieldname']);
								$pflag=false;
							}
							else $pflag=true;


							$t=array(); $l_s='';
							for ($z=0; $z<$len_count; $z++) {
								$t[]=  $len_array[1][$z];
								$l_s.="'{$len_array[1][$z]}',";
							}

							if ($l_s!='')	$fields[$i]['len']=addslashes(mb_substr($l_s, 0, mb_strlen($l_s)-1));
							else $fields[$i]['len']=addslashes($fields[$i]['len']);
							$len_array=$t;
						}
					}
					elseif	($datatype['len_need']==3) {
						if ($fields[$i]['len']!='') {
							if ($fields[$i]['datatype_id']!=24 && $fields[$i]['datatype_id']!=25) {
								if (!is_numeric($fields[$i]['len']) || $fields[$i]['len']<1) $this->editError[]=sprintf($MSGTEXT['table_constr_no_length2'], $fields[$i]['fieldname']);
							}
							else {
								if (!$len_count=@preg_match_all("|'(.*)'|U", $fields[$i]['len'],  $len_array)) $this->editError[]=sprintf($MSGTEXT['table_constr_no_length2'], $fields[$i]['fieldname']);
								$t=array(); $l_s='';
								for ($z=0; $z<$len_count; $z++) {
									$t[]= $len_array[1][$z];
									$l_s.="'{$len_array[1][$z]}',";
								}
								if ($l_s!='')	$fields[$i]['len']=addslashes(mb_substr($l_s, 0, mb_strlen($l_s)-1));
								else $fields[$i]['len']=addslashes($fields[$i]['len']);
								$len_array=$t;
							}
						}
					}
					elseif ($datatype['len_need']==0) {
						$fields[$i]['len']='';
					}

					if ($datatype['default_need']==1) {
						if ($fields[$i]['datatype_id']!=24 && $fields[$i]['datatype_id']!=25) {
							if ($datatype['default_format']!=NULL) {
								if (!@preg_match($datatype['default_format'],  $fields[$i]['default'])) $this->editError[]=sprintf($MSGTEXT['table_constr_err_val_def'], $fields[$i]['fieldname']);
							}
							else if ($datatype['default_format']=='') $this->editError[]=sprintf($MSGTEXT['table_constr_err_val_def'], $fields[$i]['fieldname']);
						}
						else if  ($fields[$i]['default']!='' && !in_array($fields[$i]['default'], $len_array)) $this->editError[]=sprintf($MSGTEXT['table_constr_err_val_def'], $fields[$i]['fieldname']);


					}
					elseif ($datatype['default_need']==0) {
						$fields[$i]['default_need']='';
					}
					elseif ($datatype['default_need']==3) {
						if  ($fields[$i]['default']!='') {
							if ($fields[$i]['datatype_id']!=24 && $fields[$i]['datatype_id']!=25) {
								if ($datatype['default_format']!=NULL)
								if (!@preg_match($datatype['default_format'],  $fields[$i]['default'])) $this->editError[]=sprintf($MSGTEXT['table_constr_err_val_def'], $fields[$i]['fieldname']);
							}
							else if  (!in_array($fields[$i]['default'], $len_array)) $this->editError[]=sprintf($MSGTEXT['table_constr_err_val_def'], $fields[$i]['fieldname']);
						}
					}

					if ($datatype['zerrofill_need']==1) {
						if ($fields[$i]['zerofill']!=1) $this->editError[]=sprintf($MSGTEXT['table_constr_err_zerrof'], $fields[$i]['fieldname']);
					}
					elseif ($datatype['zerrofill_need']==0) {
						$fields[$i]['zerofill']=0;
					}

					if ($datatype['unsigned_need']==1) {
						if ($fields[$i]['unsigned']!=1) $this->editError[]=sprintf($MSGTEXT['table_constr_err_var_unsig'], $fields[$i]['fieldname']);
					}
					elseif ($datatype['unsigned_need']==0) {
						$fields[$i]['unsigned']=0;
					}
				}


				if ($fields[$i]['pk']==1 && $fields[$i]['not_null']==0 ) {
					$this->editError[]=sprintf($MSGTEXT['table_constr_err_not_null'], $fields[$i]['fieldname']);
				}

				if ($fields[$i]['pk']==1 && $fields[$i]['fieldname']!='id' ) {
					$this->editError[]=sprintf($MSGTEXT['table_constr_err_not_id'], $fields[$i]['fieldname']);
				}

				if ($fields[$i]['auto_incr']==1 && $fields[$i]['pk']==0 ) {
					$this->editError[]=$MSGTEXT['table_constr_err_key'];
				}

				if ($fields[$i]['auto_incr']==1) {
					if  ($auto_incr) $this->editError[]=$MSGTEXT['table_constr_err_field'];
					$auto_incr=true;
				}
			}

			if (!$this->checkEditAndDataTypes($fields[$i]['datatype_id'], $fields[$i]['edittype_id'])) {
				$this->editError[]	= sprintf($MSGTEXT['table_constr_err_sel_type'], $fields[$i]['fieldname']);
			}
		}

		if (!$pk_is) {
			$this->editError[]=$MSGTEXT['table_constr_autoincrementing'];
		}

		if (count($this->editError)==0) {
			require_once('classes/Compiler.class.php');
			$this->get['m_id']=$this->m_id;
			$obj	= new Compiler($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr,  '');

			$sql	= $obj->get_on_query($fields, 'ctr_');
			$sql	= stripslashes($sql);
			$sql2	= str_replace(SETTINGS_NEW_LINE,'', $sql);


			if (!$result		= $this->mysql->executeSQLErrorNo($sql2)) {
				$sql=str_replace(SETTINGS_NEW_LINE,'<br>', $sql);
				$this->editError[]=$MSGTEXT['table_constr_err_value'].$this->mysql->getError().'<br>'.$sql;
			}
			else {
				$query			= "DROP TABLE `".MYSQL_CTR_DATABASE."`.`ctr_`";
				$result			= $this->mysql->executeSQL($query);
			}
		}

		$r['fields']			= $fields;
		$r['table']				= $table;

		return $r;
	}



	/**
	 * проверяет соответствие типа редактирование и типа данных
	 *
	 */
	function checkEditAndDataTypes($datatype_id, $edittype_id) {

		$rules=array(
		//нет редактирования
		0=>array(1=>true,2=>true,3=>true,4=>true,5=>true,6=>true,7=>true,8=>true,9=>true,10=>true,11=>true,12=>true,13=>true,14=>true,15=>true,16=>true,17=>true,18=>true,19=>true,20=>true,21=>true,22=>true,23=>true,24=>true,25=>true,26=>true,27=>true,28=>true,29=>true),
		//1 Input
		1=>array(1=>true,2=>true,3=>true,4=>true,5=>true,6=>true,7=>true,8=>true,9=>true,10=>true,11=>true,12=>true,13=>true,14=>true,15=>true,16=>true,17=>true,18=>true,19=>true,20=>true,21=>true,22=>true,23=>true,24=>true,25=>true,26=>true,27=>true,28=>true,29=>true),
		//2 TextArea
		2=>array(1=>true,2=>true,3=>true,4=>true,5=>true,6=>true,7=>true,8=>true,9=>true,10=>true,11=>true,12=>true,13=>true,14=>true,15=>true,16=>true,17=>true,18=>true,19=>true,20=>true,21=>true,22=>true,23=>true,24=>true,25=>true,26=>true,27=>true,28=>true,29=>true),
		//3 Select
		3=>array(2=>true,4=>true,5=>true,6=>true,7=>true,8=>true, 24=>true, 27=>true, 28=>true),
		//4 MultiSelect
		4=>array(2=>true,5=>true,6=>true,7=>true,8=>true),
		//5 CheckBox
		5=>array(2=>true,4=>true,5=>true,6=>true,7=>true,8=>true,27=>true,28=>true),
		//6 RadioBox
		6=>array(2=>true,4=>true,5=>true,6=>true,7=>true,8=>true,27=>true,28=>true),
		//7 Editor
		7=>array(1=>true,3=>true,16=>true,18=>true,21=>true,23=>true),
		//8 Editor Popup
		8=>array(1=>true,3=>true,16=>true,18=>true,21=>true,23=>true),
		//9 One Image
		9=>array(1=>true,3=>true,16=>true,18=>true,21=>true,23=>true),
		//10 Images
		10=>array(1=>true,3=>true,16=>true,18=>true,21=>true,23=>true),
		//11 One File
		11=>array(1=>true,3=>true,16=>true,18=>true,21=>true,23=>true),
		//12 Files
		12=>array(1=>true,3=>true,16=>true,18=>true,21=>true,23=>true),
		//13 Selected page
		13=>array(2=>true,4=>true,5=>true,6=>true,7=>true,8=>true,27=>true,28=>true),
		//14 Friendly URL
		14=>array(1=>true,3=>true),
		//15 CopyNewContent
		15=>array(1=>true,3=>true,18=>true,21=>true,23=>true),
		//16 RadioBoxThis
		16=>array(2=>true,4=>true,5=>true,6=>true,7=>true,8=>true,27=>true,28=>true),
		);

		if (isset($rules[$edittype_id][$datatype_id])) return true;
		else return false;
	}


	/**
     * обработка формы создания таблицы
     *
     */
	function insert() {
		GLOBAL $CMSProtection, $MSGTEXT, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25;

		$r				= $this->getFields();
		$fields			= $r['fields'];
		$table			= $r['table'];

		if (count($this->editError)>0) {
			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
			$this->form_add();
			$this->smarty->assign('fields',		$fields);
			$this->smarty->assign('editError',	$this->editError);
		}
		else {
			$query		= "INSERT INTO `$MYSQL_CTR_TABLE18` (`module_id`, `name`, `description`, `show_type`, `loaded_name`, `additional_buttons`, `sort_index`) VALUES ('{$this->m_id}', '{$table['name']}', '{$table['description']}', '{$table['show_type']}', '{$table['name']}', '{$table['additional_buttons']}', '0')";
			$result		= $this->mysql->executeSQL($query);

			$sort_index	= $this->mysql->insertID();
			$query		= "UPDATE `$MYSQL_CTR_TABLE18`  SET `sort_index`='$sort_index' WHERE `id`='$sort_index'";
			$result		= $this->mysql->executeSQL($query);

			setHistory($this->m_id, 1, 5, $sort_index);

			$sort_index_for_fields=count($fields)*10;

			for ($i=0; $i<count($fields); $i++) {
				//вычисляем индекс сортировки
				if (is_numeric($fields[$i]['sort_index']) && $fields[$i]['sort_index']>0) {
					$s_i					= $fields[$i]['sort_index'];
					if ($fields[$i]['sort_index']-10>0) {
						$sort_index_for_fields	= $fields[$i]['sort_index']-10;
					}
					else {
						$s_i					= 0;
					}
				}
				else {
					if ($sort_index_for_fields>0) {
						$s_i					= $sort_index_for_fields;
					}
					else {
						$s_i					= 0;
					}
					$sort_index_for_fields	-= 10;
				}

				if ($fields[$i]['edittype_id']==0 || $fields[$i]['edittype_id']=='')  {
					$fields[$i]['edittype_id']='NULL';
				}

				if ($fields[$i]['datatype_id']==0 || $fields[$i]['datatype_id']=='')  {
					$fields[$i]['datatype_id']='NULL';
				}

				if ($fields[$i]['collation_id']==0 || $fields[$i]['collation_id']=='')  {
					$fields[$i]['collation_id']='NULL';
				}

				if ($fields[$i]['sourse_field_id']==0 || $fields[$i]['sourse_field_id']=='')  {
					$fields[$i]['sourse_field_id']='NULL';
				}
								
				$query		= "INSERT INTO `$MYSQL_CTR_TABLE21` (`table_id`, `edittype_id`, `fieldname`,`datatype_id`,`len`,`default`,`collation_id`,`pk`,`not_null`,`unsigned`,`auto_incr`,`zerofill`, `unique`, `notfedit`, `comment`, `sourse_field_id`, `loaded_name`, `sort_index`)
 					VALUES (
					 	'$sort_index',
					 	{$fields[$i]['edittype_id']},
 						'{$fields[$i]['fieldname']}',
 						{$fields[$i]['datatype_id']},
 						'{$fields[$i]['len']}',
 						'{$fields[$i]['default']}',
 						{$fields[$i]['collation_id']},
 						'{$fields[$i]['pk']}',
 						'{$fields[$i]['not_null']}',
 						'{$fields[$i]['unsigned']}',
 						'{$fields[$i]['auto_incr']}',
 						'{$fields[$i]['zerofill']}',
 						'{$fields[$i]['unique']}', 						
 						'{$fields[$i]['notfedit']}', 						 						
 						'{$fields[$i]['comment']}',
 						{$fields[$i]['sourse_field_id']},
 						'{$fields[$i]['fieldname']}',
 						'{$s_i}')";

				$result			= $this->mysql->executeSQL($query);
				$inserted_id 	= $this->mysql->insertID();
				setHistory($this->m_id, 1, 6, $inserted_id);

				//добавляем настройку для поля
				$query			= "INSERT INTO `$MYSQL_CTR_TABLE25` (`field_id`) VALUES ('$inserted_id')";
				$result			= $this->mysql->executeSQL($query);
				$inserted_fs_id = $this->mysql->insertID($result);
				setHistory($this->m_id, 1, 7, $inserted_fs_id);
			}
			$this->refreshFrame=1;
			$this->smarty->assign('message',			$MSGTEXT['table_constr_table_create']);
			$this->getList();
		}
	}



	/**
     * обработка формы создания копии таблицы
     *
     */
	function insertCopy() {
		GLOBAL $MSGTEXT,$MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25, $BAD_SYMBOLS;

		$error		= false;

		$name=addslashes($this->post['name']);
		if (!eregi("^([A-Z0-9_\\/\.-]*)$", $name)) {
			$error	= true;
			$this->smarty->assign('message',	$MSGTEXT['table_constr_err_ciril'].' <b>/\:*?"< >|</b>');
		}
		else {

			$description 		= htmlspecialchars(str_replace($BAD_SYMBOLS, '', $this->postr['description']), ENT_QUOTES);
			$additional_buttons = htmlspecialchars(str_replace($BAD_SYMBOLS, '', $this->postr['additional_buttons']), ENT_QUOTES);

			if (isset($this->postr['show_type'])) {
				$show_type	= $this->postr['show_type'];
			}
			else {
				$show_type=0;
			}



			$query		= "SELECT count(*) FROM `$MYSQL_CTR_TABLE18` WHERE `name`='$name' AND `module_id`='{$this->m_id}'";
			$result		= $this->mysql->executeSQL($query);
			$c			= $this->mysql->fetchRow($result);

			if ($c[0]>0) {
				$error	= true;
				$this->smarty->assign('message',			$MSGTEXT['table_constr_err_name']);
			}
			elseif ($this->post['name']=='') {
				$error	= true;
				$this->smarty->assign('message',			$MSGTEXT['table_constr_no_empty']);
			}
		}

		if ($error)	 {
			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
			$this->smarty->assign('content_template',	'tables/tables_form_add_copy.tpl');
			$this->smarty->assign('content_head',		$MSGTEXT['table_constr_copy_table']);
		}
		else {
			$query		= "INSERT INTO `$MYSQL_CTR_TABLE18` (`module_id`, `name`, `description`, `show_type`, `loaded_name`, `additional_buttons`, `sort_index`) VALUES ('{$this->m_id}', '$name', '$description', '$show_type', '$name', '$additional_buttons', '0')";
			$result		= $this->mysql->executeSQL($query);

			$sort_index	= $this->mysql->insertID();
			$query		= "UPDATE `$MYSQL_CTR_TABLE18` SET `sort_index`='$sort_index' WHERE `id`='$sort_index'";
			$result		= $this->mysql->executeSQL($query);

			setHistory($this->m_id, 1, 5, $sort_index);

			//здесь кусок кода, который копирует все остальные функции, данные таблицы
			$query		= "SELECT * FROM `$MYSQL_CTR_TABLE21` WHERE `table_id`='{$this->post['id']}'";
			$result		= $this->mysql->executeSQL($query);
			$fields		= $this->mysql->fetchAssocAll($result);

			$fields2	= array();
			$tmp		= array();
			foreach ($fields AS $ar) {
				foreach ($ar AS $k=>$v) {
					$tmp[$k]	= addslashes($v);
				}
				$fields2[]		= $tmp;
			}

			$fields				= $fields2;

			$fs=array();
			for ($i=0; $i<count($fields); $i++) {
                if (!$fields[$i]['edittype_id']) {
                    $fields[$i]['edittype_id']=0;
                }

                if (!$fields[$i]['collation_id']) {
                    $fields[$i]['collation_id']=0;
                }

                if (!$fields[$i]['sourse_field_id']) {
                    $fields[$i]['sourse_field_id']=0;
                }


				$query		= "INSERT INTO `$MYSQL_CTR_TABLE21` (`table_id`, `edittype_id`, `fieldname`,`datatype_id`,`len`,`default`,`collation_id`,`group_caption`, `pk`,`not_null`,`unsigned`,`auto_incr`,`zerofill`, `unique`, `notfedit`, `comment`, `sourse_field_id`, `delete`, `own_filter`, `loaded_name`, `sort_index`)
 					VALUES (
					 	'$sort_index',
					 	'{$fields[$i]['edittype_id']}',
 						'{$fields[$i]['fieldname']}',
 						'{$fields[$i]['datatype_id']}',
 						'{$fields[$i]['len']}',
 						'{$fields[$i]['default']}',
 						'{$fields[$i]['collation_id']}',
 						'{$fields[$i]['group_caption']}',
 						'{$fields[$i]['pk']}',
 						'{$fields[$i]['not_null']}',
 						'{$fields[$i]['unsigned']}',
 						'{$fields[$i]['auto_incr']}',
 						'{$fields[$i]['zerofill']}',
 						'{$fields[$i]['unique']}', 						
 						'{$fields[$i]['notfedit']}', 						 						
 						'{$fields[$i]['comment']}',
 						'{$fields[$i]['sourse_field_id']}',
 						'{$fields[$i]['delete']}',
 						'{$fields[$i]['own_filter']}', 						
 						'{$fields[$i]['fieldname']}',
 						'{$fields[$i]['sort_index']}')";

				$result			= $this->mysql->executeSQL($query);
				$inserted_id	= $this->mysql->insertID($result);
				setHistory($this->m_id, 1, 6, $inserted_id);
				$fields[$i]['new_id']	= $inserted_id;

				//добавляем настройку для поля
				$query				= "SELECT * FROM `$MYSQL_CTR_TABLE25` WHERE `field_id`='{$fields[$i]['id']}'";
				$result				= $this->mysql->executeSQL($query);
				$field_settings		= $this->mysql->fetchAssoc($result);

				if (!is_numeric($field_settings['hide_by_field'])) $field_settings['hide_by_field']=0;
				if (!is_numeric($field_settings['hide_operator'])) $field_settings['hide_operator']=0;

                if (!$field_settings['check_regular_id']) {
                    $field_settings['check_regular_id']=0;
                }

				$query	= "INSERT INTO `$MYSQL_CTR_TABLE25` (
					`field_id`, 
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
					`hide_on_value` )
					VALUES (
					'$inserted_id', 
					'{$field_settings['active']}', 
					'{$field_settings['show_in_list']}', 
					'{$field_settings['filter']}', 
					'{$field_settings['check_regular_id']}', 
					'{$field_settings['regex_other']}',
					'{$field_settings['height']}', 
					'{$field_settings['width']}', 
					'{$field_settings['style']}', 
					'{$field_settings['hide_by_field']}', 
					'{$field_settings['hide_operator']}', 
					'{$field_settings['hide_on_value']}'
					)";

				$result						= $this->mysql->executeSQL($query);
				$inserted_fs_id 			= $this->mysql->insertID($result);
				$field_settings['new_id']	= $inserted_fs_id;
				$fs[]						= $field_settings;

				setHistory($this->m_id, 1, 7, $inserted_fs_id);
			}
			//обновляем id поля hide_by_field
			for ($i=0; $i<count($fs); $i++) {
				if ($fs[$i]['hide_by_field']!='') {
					for ($i2=0; $i2<count($fields); $i2++) {
						if ($fs[$i]['hide_by_field']==$fields[$i2]['id']) {
							$query	= "UPDATE `$MYSQL_CTR_TABLE25` SET `hide_by_field`='{$fields[$i2]['new_id']}' WHERE `id`='{$fs[$i]['new_id']}' ";
							$result	= $this->mysql->executeSQL($query);
						}
					}
				}
			}

			$this->refreshFrame=1;
			$this->smarty->assign('message',			$MSGTEXT['table_constr_table_copy']);
			$this->getList();
		}
	}


	/**
     * удаляем таблицу
     *
     */
	function delete() {
		GLOBAL $GENERAL_FUNCTIONS, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25, $MYSQL_CTR_TABLE23;

		$query				= "SELECT `loaded_name` FROM `$MYSQL_CTR_TABLE18` WHERE `id`='{$this->get['t_id']}'";
		$result				= $this->mysql->executeSQL($query);
		list($loaded_name)	= $this->mysql->fetchRow($result);

		//берем ID блока
		$query				= "SELECT `id` FROM `$MYSQL_CTR_TABLE23` WHERE `general_table_id`='{$this->get['t_id']}'";
		$result				= $this->mysql->executeSQL($query);
		$block_ids			= $this->mysql->fetchAssocAll($result);

		if (count($block_ids)>0) {
			//обновляем блоки, у которых удалённая таблица главная
			$query			= "UPDATE `$MYSQL_CTR_TABLE23` SET `general_table_id`='0' WHERE `general_table_id`='{$this->get['t_id']}'";
			$result			= $this->mysql->executeSQL($query);

			//ставим в историю, что блоки изменены
			foreach ($block_ids as $block_id) {
				setHistory($this->m_id, 2, 1, $block_id['id']);
			}
		}
		else $block_id=0;

		$query				= "SELECT $MYSQL_CTR_TABLE21.id, $MYSQL_CTR_TABLE25.id as `s_id` FROM `$MYSQL_CTR_TABLE21` LEFT JOIN `$MYSQL_CTR_TABLE25` ON ($MYSQL_CTR_TABLE21.id=$MYSQL_CTR_TABLE25.field_id) WHERE $MYSQL_CTR_TABLE21.table_id='{$this->get['t_id']}'";
		$result				= $this->mysql->executeSQL($query);
		$all_f_ids			= array();
		while ($row	= $this->mysql->fetchAssoc($result)) {
			$all_f_ids[]	= $row['id'];
		}

		setHistory($this->m_id, 0, 5, $this->get['t_id'], $loaded_name); //удаляем историю о создании таблицы

		$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE18` WHERE `id`='{$this->get['t_id']}'";
		$result		= $this->mysql->executeSQL($query);

		$query		= "DELETE  FROM  `$MYSQL_CTR_TABLE21` WHERE `table_id`='{$this->get['t_id']}'";
		$result		= $this->mysql->executeSQL($query);

		$f_ids		= implode(',', $all_f_ids);

		if ($f_ids!='') {
			$query		= "DELETE FROM `$MYSQL_CTR_TABLE25` WHERE `field_id` IN ($f_ids)";
			$result		= $this->mysql->executeSQL($query);
		}

		//обнуляем ссылку на источник
		$query				= "UPDATE `$MYSQL_CTR_TABLE21` SET  `sourse_field_id`=0 WHERE `sourse_field_id`='{$this->get['t_id']}'";
		$result				= $this->mysql->executeSQL($query);
		$this->refreshFrame	= 1;

		$GENERAL_FUNCTIONS->gotoURL('?act=t_c&refreshFrame='.$this->refreshFrame);
	}



	/**
     * форма редактирования таблицы
     *
     */
	function form_edit($fields=null) {
		GLOBAL  $MSGTEXT,$MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE19, $MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE22;

		$query		= "SELECT `name`, `description`, `show_type`, additional_buttons FROM `$MYSQL_CTR_TABLE18` WHERE `id`='{$this->get['t_id']}'";
		$result		= $this->mysql->executeSQL($query);
		list($name, $description, $show_type, $additional_buttons)		= $this->mysql->fetchRow($result);

		if (count($this->editError)==0) {

			$query		= "SELECT * FROM `$MYSQL_CTR_TABLE21` WHERE `table_id`='{$this->get['t_id']}'  ORDER BY `sort_index` DESC";
			$result		= $this->mysql->executeSQL($query);
			$fields		= $this->mysql->fetchAssocAll($result);

			$fields2	= array();
			$tmp		= array();
			foreach ($fields AS $ar) {
				foreach ($ar AS $k=>$v) {
					$tmp[$k]=addslashes($v);
				}
				$fields2[]=$tmp;
			}
			$fields=$fields2;
		}

		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE19` ORDER BY `collation`";
		$result		= $this->mysql->executeSQL($query);
		$collations	= $this->mysql->fetchAssocAll($result);

		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE20`";
		$result		= $this->mysql->executeSQL($query);
		$datatypes	= $this->mysql->fetchAssocAll($result);

		$query		= "SELECT * FROM `$MYSQL_CTR_TABLE22` ORDER BY `sort_index` DESC";
		$result		= $this->mysql->executeSQL($query);
		$edittypes	= $this->mysql->fetchAssocAll($result);

		$this->smarty->assign('content_template',	'tables/tables_form_edit.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['table_constr_edit_table'].' <a href="?act=t_c&t_id='.$this->get['t_id'].'">«'.$name.'»</a>');
		$this->smarty->assign('collations',			$collations);
		$this->smarty->assign('datatypes',			$datatypes);
		$this->smarty->assign('edittypes',			$edittypes);
		$this->smarty->assign('name',				$name);
		$this->smarty->assign('description',		$description);
		$this->smarty->assign('show_type',			$show_type);
		$this->smarty->assign('additional_buttons',	$additional_buttons);

		$this->smarty->assign('fields',				$fields);
		$this->smarty->assign('id',					$this->get['t_id']);
		$this->smarty->assign('do',					'saveedit');
		$this->smarty->assign('editError',			$this->editError);

		if (isset($this->post['counter'])) $counter=$this->post['counter'];
		else $counter=count($fields);

		$this->smarty->assign('counter',		$counter);
		$this->smarty->assign('refreshFrame',	$this->refreshFrame);
	}



	/**
     * сохранение редактирования таблицы
     *
     */
	function saveEdit() {
		GLOBAL $MSGTEXT,$GENERAL_FUNCTIONS, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE24, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE21, $MYSQL_CTR_TABLE25, $MYSQL_CTR_TABLE31;

		if (isset($this->post['id']))	{
			$r						= $this->getFields(true);
			$fields					= $r['fields'];
			$table					= $r['table'];
		}

		if (count($this->editError)>0 || !isset($this->post['id'])) {

			if (isset($this->post['id'])) {
				$this->get['t_id']	= $this->post['id'];
				$this->form_edit($fields);
			}
			else {
				$this->form_edit();
			}
		}
		else {

			//проверяем есть ли реальные изминения в таблице
			$query			= "SELECT * FROM `$MYSQL_CTR_TABLE18` WHERE `id`='{$this->post['id']}'";
			$result			= $this->mysql->executeSQL($query);
			$old_table_data	= $this->mysql->fetchAssoc($result);

			if ($old_table_data['name']!=$table['name'] || $old_table_data['description']!=$table['description'] || $old_table_data['show_type']!=$table['show_type'] || $old_table_data['additional_buttons']!=$table['additional_buttons']) {
				$table_is_modifed	= true;
				//проверяем, если таблица создана, то меняем и загруженное имя
				$query				= "SELECT count(*) FROM `$MYSQL_CTR_TABLE31`  WHERE `module_id`='{$this->m_id}' && `operation`=1 && `object_type`=5 && `object_id`='{$this->post['id']}'";
				$result				= $this->mysql->executeSQL($query);
				list($is_created) 	= $this->mysql->fetchRow($result);

				if ($is_created>0) $load_change	= ", `loaded_name`='{$table['name']}'";
				else $load_change 	= '';

				$table['description']	= str_replace('/', '', $table['description']);

				$query		= "UPDATE `$MYSQL_CTR_TABLE18` SET `name`='{$table['name']}', `description`='{$table['description']}', `show_type`='{$table['show_type']}', `additional_buttons`='{$table['additional_buttons']}' $load_change WHERE `id`='{$this->post['id']}'";
				$result		= $this->mysql->executeSQL($query);

				setHistory($this->m_id, 2, 5, $this->post['id']);
			}
			else {
				$table_is_modifed	= false;
			}

			//запоминаем поля
			$fields_ids = array();
			$query		= "SELECT * FROM `$MYSQL_CTR_TABLE21` WHERE `table_id`='{$this->post['id']}'";
			$result		= $this->mysql->executeSQL($query);
			while ($row	= $this->mysql->fetchAssoc($result)) {
				//добавляем слеши для сравнения
				foreach ($row as $key=>$v) {
					$row[$key]			= addslashes($v);
				}
				$fields_ids[$row['id']]	= $row;
			}


			//проверяем, что нужно сделать
			foreach ($fields as $i=>$v) {

				$do_some	= false;

				if ($fields[$i]['edittype_id']==0 || $fields[$i]['edittype_id']=='')  {
					$fields[$i]['edittype_id']='NULL';
				}

				if ($fields[$i]['datatype_id']==0 || $fields[$i]['datatype_id']=='')  {
					$fields[$i]['datatype_id']='NULL';
				}

				if ($fields[$i]['collation_id']==0 || $fields[$i]['collation_id']=='')  {
					$fields[$i]['collation_id']='NULL';
				}

				if ($fields[$i]['sourse_field_id']==0 || $fields[$i]['sourse_field_id']=='')  {
					$fields[$i]['sourse_field_id']='NULL';
				}

				//обновляем поле
				if (isset($fields_ids[$fields[$i]['id']]))  {
					//проверяем есть ли реальные изминения в поле
					if (count(array_diff_assoc($fields[$i], $fields_ids[$fields[$i]['id']]))>1) {
						$do_some= true;

						$query	= "UPDATE `$MYSQL_CTR_TABLE21` SET
						`edittype_id`={$fields[$i]['edittype_id']},
 						`fieldname`='{$fields[$i]['fieldname']}',
 						`datatype_id`={$fields[$i]['datatype_id']},
 						`len`='{$fields[$i]['len']}',
 						`default`='{$fields[$i]['default']}',
 						`collation_id`={$fields[$i]['collation_id']},
 						`group_caption`='{$fields[$i]['group_caption']}',
 						`pk`='{$fields[$i]['pk']}',
 						`not_null`='{$fields[$i]['not_null']}',
 						`unsigned`='{$fields[$i]['unsigned']}',
 						`auto_incr`='{$fields[$i]['auto_incr']}',
 						`zerofill`='{$fields[$i]['zerofill']}',
 						`unique`='{$fields[$i]['unique']}', 						
 						`notfedit`='{$fields[$i]['notfedit']}', 						 						
 						`comment`='{$fields[$i]['comment']}',
 						`sourse_field_id`={$fields[$i]['sourse_field_id']},
 						`delete`='{$fields[$i]['delete']}',
 						`own_filter`='{$fields[$i]['own_filter']}', 						
 						`sort_index`='{$fields[$i]['sort_index']}'
 						WHERE `id`='{$fields[$i]['id']}'";
					}
				}
				//добавляем поле
				else {
					$do_some	= true;
					$query		= "INSERT INTO `$MYSQL_CTR_TABLE21` (`table_id`,`edittype_id`,`fieldname`,`datatype_id`,`len`,`default`,`collation_id`,`group_caption`,`pk`,`not_null`,`unsigned`,`auto_incr`,`zerofill`, `unique`, `notfedit`, `comment`, `sourse_field_id`, `delete`, `own_filter`, `loaded_name`, `sort_index`)
 						VALUES (
					 	'{$this->post['id']}',					 	
					 	{$fields[$i]['edittype_id']},
 						'{$fields[$i]['fieldname']}',
 						{$fields[$i]['datatype_id']},
 						'{$fields[$i]['len']}',
 						'{$fields[$i]['default']}',
 						{$fields[$i]['collation_id']},
 						'{$fields[$i]['group_caption']}', 						
 						'{$fields[$i]['pk']}',
 						'{$fields[$i]['not_null']}',
 						'{$fields[$i]['unsigned']}',
 						'{$fields[$i]['auto_incr']}',
 						'{$fields[$i]['zerofill']}',
 						'{$fields[$i]['unique']}', 						
 						'{$fields[$i]['notfedit']}', 						 						
 						'{$fields[$i]['comment']}',
 						{$fields[$i]['sourse_field_id']},
 						'{$fields[$i]['delete']}',
 						'{$fields[$i]['own_filter']}', 						
 						'{$fields[$i]['fieldname']}',
 						'{$fields[$i]['sort_index']}')";					
				}

				if ($do_some) {
					//обновляем поле
					if (is_numeric($fields[$i]['id']))  {

						$result		= $this->mysql->executeSQL($query);
						setHistory($this->m_id, 2, 6, $fields[$i]['id']);

						//добавляем историю об изминении настройки поля
						$query		= "SELECT `id` FROM `$MYSQL_CTR_TABLE25` WHERE `hide_by_field`='{$fields[$i]['id']}'";
						$result		= $this->mysql->executeSQL($query);
						$set 		= $this->mysql->fetchAssoc($result);
						if (isset($set['id'])) {
							setHistory($this->m_id, 2, 7, $set['id']);
							$delete_hide_field	= true;
						}
						else $delete_hide_field	= false;

						//удаляем из настроек поле, по которому	нужно скрывать данное поле
						if ($delete_hide_field && in_array($fields[$i]['edittype_id'] , array(0, 8, 9, 10, 11, 12))) {

							$query		= "SELECT `id`, `hide_on_value` FROM `$MYSQL_CTR_TABLE25` WHERE `field_id`='{$fields[$i]['id']}'";
							$result		= $this->mysql->executeSQL($query);
							$set 		= $this->mysql->fetchAssoc($result);

							if (isset($set['hide_on_value']) && $set['hide_on_value']!='') {

								$query	= "UPDATE `$MYSQL_CTR_TABLE25` SET `hide_by_field`=NULL,`hide_operator`=0, `hide_on_value`='' WHERE `id`='{$set['id']}'";
								$result	= $this->mysql->executeSQL($query);

								setHistory($this->m_id, 2, 7, $set['id']);
							}
						}
					}
					//добавляем поле
					else {
						$result		 = $this->mysql->executeSQL($query);
						$inserted_id = $this->mysql->insertID($result);
						setHistory($this->m_id, 1, 6, $inserted_id);

						//добавляем настройку для поля
						$query			= "INSERT INTO `$MYSQL_CTR_TABLE25` (`field_id`) VALUES ('$inserted_id')";
						$result			= $this->mysql->executeSQL($query);
						$inserted_fs_id = $this->mysql->insertID($result);
						setHistory($this->m_id, 1, 7, $inserted_fs_id);
					}
				}
			}


			//удаляем поля
			foreach ($fields_ids as $i=>$v) {
				$del=true;
				foreach ($fields as $i2=>$v2) {

					if ($fields_ids[$i]['id']==$fields[$i2]['id']) {
						$del	= false;
						break;
					}
				}

				if ($del) {

					$query									= "SELECT $MYSQL_CTR_TABLE21.loaded_name, $MYSQL_CTR_TABLE18.loaded_name as `loaded_table_name` FROM `$MYSQL_CTR_TABLE21`, `$MYSQL_CTR_TABLE18` WHERE $MYSQL_CTR_TABLE21.id='{$fields_ids[$i]['id']}' AND $MYSQL_CTR_TABLE21.table_id=$MYSQL_CTR_TABLE18.id";
					$result									= $this->mysql->executeSQL($query);
					list($loaded_name, $loaded_table_name)	= $this->mysql->fetchRow($result);

					setHistory($this->m_id, 0, 6, $fields_ids[$i]['id'], $loaded_name, $loaded_table_name);

					$query	= "DELETE FROM `$MYSQL_CTR_TABLE21` WHERE `id`='{$fields_ids[$i]['id']}'";
					$result	= $this->mysql->executeSQL($query);

					$query	= "DELETE FROM `$MYSQL_CTR_TABLE25` WHERE `field_id`='{$fields_ids[$i]['id']}'";
					$result	= $this->mysql->executeSQL($query);

					//обнуляем ссылку на источник
					$query	= "UPDATE  `$MYSQL_CTR_TABLE21` SET  `sourse_field_id`=NULL WHERE `sourse_field_id`='{$fields_ids[$i]['id']}'";
					$result	= $this->mysql->executeSQL($query);
				}
			}

			if ($table_is_modifed) {
				$this->refreshFrame	= 1;
			}

			$this->smarty->assign('message',			$MSGTEXT['table_constr_changed_save']);
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