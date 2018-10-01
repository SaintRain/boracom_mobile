<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
API функции для работы с БД. Используется как админзоной, так и модулями разработчиков
*////////////////////////////////////////////////////////////////////////////////////////////

class API {

	/**
	 * Смарти-класс
	 * @var class
	 */
	private		$smarty;

	/**
     * Переменные из массива $_POST спец символы заменены функцией htmlspecialchars()
     *
     * @var array
     */
	private		$post;

	/**
     *  Переменные из массива $_POST (спец символы не заменены)
     *
     * @var array
     */
	private		$postr;

	/**
     *  Экранированые переменные функцией addslashes() из массива $_POST 
     *
     * @var array
     */
	public		$posts;

	/**
     * Переменные из массива $_GET
     *
     * @var array
     */
	private		$get;

	/**
     *  Переменные из массива $_GET (спец символы не заменены)
     *
     * @var array
     */
	private		$getr;

	/**
     *  Экранированые переменные функцией addslashes() из массива $_GET 
     *
     * @var array
     */
	public		$gets;
	
	/**
     *  Данные для вставки/обновления/удаления строки в таблице
     *
     * @var array
     */
	public		$dataRow;	

	/**
     * Сообщения об ошибках 
     *
     * @var array
     */
	public 		$errors=array();

	/**
     * Сообщения пользователю
     *
     * @var array
     */
	public 		$messages;

	/**
   	 * Класс для работы с MYSQL
   	 *
   	 * @var class
   	 */
	private		$mysql;

	/**
   	 * Данные модуля и блоков в этом модуле
   	 *
   	 * @var array
   	 */
	public		$info;

	/**
	 * Имя текущей таблицы с которой работает класс без префикса
	 *
	 * @var string
	 */
	public 		$current_tablename_no_prefix;

	/**
	 * Имя текущей таблицы с которой работает класс
	 *
	 * @var string
	 */
	public 		$current_tablename;

	/**
	 * id - добавленной записи
	 *
	 * @var int
	 */
	public  	$inserted_id;

	/**
	 * id - языка на котором выводится материал
	 *
	 * @var int
	 */
	private 	$lang_id;

	/**
	 * Обновлять чексбоксы, если их нет в форме
	 *
	 * @var bool
	 */
	private 	$autho_update_checkbox;


	/**
     * Конструктор класса
     *      
	 * @param class $mysql
	 * @param class $smarty
	 * @param array $post
	 * @param array $postr
	 * @param array $posts
	 * @param array $get
	 * @param array $getr
	 * @param array $gets
	 * @param array $info
	 * @param bool $autho_update_checkbox
	 * @param array $dataRow
	 * 
	 */
	function __construct ($mysql=NULL, $smarty=NULL, $post=NULL, $postr=NULL, $posts=NULL, $get=NULL, $getr=NULL, $gets=NULL, $info=NULL, $current_tablename=NULL, $current_tablename_no_prefix, $lang_id=NULL, $autho_update_checkbox=true, $dataRow=array()) {

		$this->mysql						= $mysql;
		$this->post							= $post;
		$this->postr						= $postr;
		$this->posts						= $posts;
		$this->get							= $get;
		$this->getr							= $getr;
		$this->gets							= $gets;
		$this->smarty						= $smarty;
		$this->info 						= $info;
		$this->lang_id						= $lang_id;
		$this->current_tablename			= $current_tablename;
		$this->current_tablename_no_prefix	= $current_tablename_no_prefix;
		$this->autho_update_checkbox		= $autho_update_checkbox;
		$this->dataRow						= $dataRow;
		
		//ставим ID из для совместимости с админзоной
		if (!isset($this->dataRow['id']) && isset($this->gets['id'])) {
			$this->dataRow['id']=$this->gets['id'];
		}
		else if (!isset($this->dataRow['id']) && isset($this->posts['id'])) {		
			$this->dataRow['id']=$this->posts['id'];
		}
	}


	////////////////////////ФУНКЦИИ, КОТОРЫЕ СОВЕТУЕТСЯ ИСПОЛЬЗОВАТЬ В БЛОКАХ МОДУЛЕЙ////////////////////////////////////////////////////////
	/**
	 * Сохранение редактирования
	 *
	 */
	function dataUpdate() {
		GLOBAL $MSGTEXT, $GENERAL_FUNCTIONS;

		//if (isset($this->dataRow['id'])) $this->dataRow['id']=$this->dataRow['id'];
		//if ($this->info['block_type']==1 && empty($this->dataRow['id'])) { //если редактируем простой блок  и нет записи, то добавляем
		if ($this->info['block_type']==1 && empty($this->dataRow['id'])) { //если редактируем простой блок  и нет записи, то добавляем		
			$this->dataInsert();
		}
		else {
			$arr				= $this->getFields('update');
			$fields 			= $arr['fields'];
			$info				= $arr['info'];
			$fs 				= $arr['fields_settings'];
			$pk_incr_fieldname  = $arr['pk_incr_fieldname'];
			$friendly_translit 	= $arr['friendly_translit'];
			$multiselect_fields	= $arr['multiselect_fields'];


			if (count($this->errors)==0 && count($fields)>0) {
				$f_value	= '';
				foreach ($fields as $k=>$v) {

					$incr			= false;
					$kavichky		= true;

					if ($k==$pk_incr_fieldname) {
						$incr=true;
					}

					if (!$incr) {		//защита, чтоб нельзя было менять id
						if (is_null($v)) $f_value.="`$k`=NULL,";
						else {
							if ($fs[$k]['datatype_id']==26) $kavichky=false;
							if ($kavichky) $f_value.="`$k`='$v',";
							else $f_value.="`$k`=$v,";
						}
					}
				}

				//запоминаем значение строки, перед изменением
				$query		= "SELECT * FROM `{$this->current_tablename}` WHERE `id`='{$this->dataRow['id']}'";
				$result		= $this->mysql->executeSQL($query);
				$old_fields	= $this->mysql->fetchAssoc($result);

				//берём старое значение поля Friendly URL
				if ($friendly_translit!=NULL) {
					$friendly_translit_old	= $old_fields[$friendly_translit['fieldname']];
				}

				//делаем обновление записи
				$f_value	= mb_substr($f_value, 0, -1);
				$query		= "UPDATE `{$this->current_tablename}` SET $f_value WHERE `$pk_incr_fieldname`='{$this->dataRow['id']}'";
				$result		= $this->mysql->executeSQL($query);

				//проверяем есть ли ошибки
				if ($ecode			= $this->mysql->getErrorCode()) {
					if (isset($MSGTEXT['mysql_errors_'.$ecode])) {
						$this->errors		= $MSGTEXT['mysql_errors_'.$ecode];
					}
					else {
						$this->errors		= $this->mysql->getError();
					}
				}
				else {
					//обновляем таблицу, в которой храняться подставляемые значения для поля с типом редактирования MultySelect
					$this->updateMultiselectData($multiselect_fields, $this->dataRow['id']);

					//обновляем значение Friendly URL, если оно изменилось
					if ($friendly_translit!=NULL && $friendly_translit_old!=$friendly_translit['value']) {
						$GENERAL_FUNCTIONS->updateFriendlYURL($fs, $friendly_translit,  $this->dataRow['id']);
					}

					//запускаем обработчик после редактирования записи
					$fields['id']		= $info['id'];
					$this->run_After_API_Edit($old_fields, $fields, 'update');
				}
			}
			else {
				$this->errors[]='';
			}
		}
	}



	/**
	 * Вставка новой записи в редактируемую таблицу
	 *
	 */
	function dataInsert() {
		GLOBAL $MSGTEXT;

		$arr				= $this->getFields('insert');
		$fields 			= $arr['fields'];
		$info				= $arr['info'];
		$f_s			 	= $arr['fields_settings'];
		$pk_incr_fieldname  = $arr['pk_incr_fieldname'];
		$multiselect_fields = $arr['multiselect_fields'];

		if (count($this->errors)==0 && count($fields)>0) {

			$f						= '';
			$f_value				= '';
			$opdate_all_radiobox	= array();
			foreach ($fields as $k=>$v) {
				$incr		= false;
				$kavichky	= true;

				$f.="`$k`,";
				if (is_null($v)) $f_value.='NULL,';
				else {
					if ($f_s[$k]['datatype_id']==26) $kavichky=false;
					if ($kavichky) $f_value.="'$v',";
					else $f_value.="$v,";
				}

				if ($f_s[$k]['edittype_id']==16 && $v==1)	{
					$opdate_all_radiobox[]	= "`$k`='0'";
				}
			}

			$f					= mb_substr($f,0,-1);
			$f_value			= mb_substr($f_value,0,-1);

			//получаем наибольший sort_index
			$query					= "SELECT max(`sort_index`) FROM `{$this->current_tablename}`";
			$result					= $this->mysql->executeSQL($query);
			list($max_sort_index)	= $this->mysql->fetchRow($result);
			$new_sort_index			= $max_sort_index+5;

			$query					= "INSERT INTO `{$this->current_tablename}`($f, `page_id`, `tag_id`, `lang_id`, `sort_index`) VALUES ($f_value, '{$info['page_id']}', '{$info['tag_id']}', '{$info['lang_id']}', '$new_sort_index')";
			$result					= $this->mysql->executeSQL($query);
			if (!$this->inserted_id	= $this->mysql->insertID($result)) {
				$ecode				= $this->mysql->getErrorCode();

				if (isset($MSGTEXT['mysql_errors_'.$ecode])) {
					$this->errors[]			= $MSGTEXT['mysql_errors_'.$ecode];
				}
				else {
					if (!isset($_SESSION['___GoodCMS']['read_only']) || !$_SESSION['___GoodCMS']['read_only']) {
						$this->errors[]		= $this->mysql->getError();
					}
				}
			}


			if ($this->inserted_id) {
				//обновляем статус всех RadioBoxOther
				if (count($opdate_all_radiobox)>0) {
					$opdate_all_radiobox= implode(',', $opdate_all_radiobox);
					$query				= "UPDATE `$this->current_tablename` SET $opdate_all_radiobox WHERE `$pk_incr_fieldname`!='{$this->inserted_id}'";
					$result				= $this->mysql->executeSQL($query);
				}

				//обновляем таблицу, в которой храняться подставляемые значения для поля с типом редактирования MultySelect
				$this->updateMultiselectData($multiselect_fields, $this->inserted_id);

				//сохраняем файлы
				$update_fields='';
				foreach ($f_s as $k=>$v) {
					if ($v['edittype_id']==9 || $v['edittype_id']==11) {
						$r	=	$this->saveOneFile($v, $this->inserted_id);
						if (count($this->errors)==0 && $r) {
							$update_fields.=" `{$v['fieldname']}`='$r' ," ;
						}
					}
				}

				if ($update_fields!='') {
					$query			= "UPDATE `{$this->current_tablename}` SET ".mb_substr($update_fields,0,-2)." WHERE `$pk_incr_fieldname`='{$this->inserted_id}'";
					$result			= $this->mysql->executeSQL($query);
				}

				$this->get['id']	= $this->inserted_id;
				$fields['id']		= $this->inserted_id;
				//запускаем обработчик после добавления записи
				$this->run_After_API_Edit($fields, $fields, 'insert');
			}
		}
		else {
			$this->errors[]='';
		}
	}



	/**
	 * Обновляет таблицу $MYSQL_TABLE13, в которой храняться подставляемые значения для поля с типом редактирования MultySelect
	 *
	 * @param array $field_id_array
	 * @param int $data_id
	 */
	function updateMultiselectData($field_id_array, $data_id) {
		GLOBAL $MYSQL_TABLE13;

		foreach ($field_id_array as $field) {

			$delete				= array();
			$insert				= array();
			$MultiselectData	= array();
			$field_id			= $field['id'];
			$value_ids  		= $field['values'];

			//берем все записи для подстановки
			$query				= "SELECT `value_id` FROM `$MYSQL_TABLE13` WHERE field_id='$field_id' AND data_id='$data_id'";
			$result				= $this->mysql->executeSQL($query);
			while ($row			= $this->mysql->fetchAssoc($result)) {
				$MultiselectData[$row['value_id']]	= $row['value_id'];
			}

			//какие записи нужно удалить
			foreach ($MultiselectData as $md_id) {
				if (!in_array($md_id, $value_ids)) {
					$delete[]=$md_id;
				}
			}

			//какие записи нужно добавить
			foreach ($value_ids as $new_md_id) {
				if (!in_array($new_md_id, $MultiselectData)) {
					$insert[]		= "('$field_id', '$data_id', '{$new_md_id}')";
				}
			}

			//удаляем из таблицы записи
			if (count($delete)>0) {
				$delete				= implode(',', $delete);
				$query				= "DELETE FROM `$MYSQL_TABLE13` WHERE field_id='$field_id' AND data_id='$data_id' AND `value_id` IN ($delete)";
				$result				= $this->mysql->executeSQL($query);
			}

			//добавляем в таблицу записи
			if (count($insert)>0) {
				$insert				= implode(',', $insert);
				$query				= "INSERT INTO `$MYSQL_TABLE13` (`field_id`, `data_id`, `value_id`) VALUES $insert";
				$result				= $this->mysql->executeSQL($query);
			}
		}
	}



	/**
	 * Вставка или обновление новой записи в редактируемую таблицу
	 * используется при импортировании xls-файлов
	 *
	 */
	function dataInsertUpdate() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT;

		$arr				= $this->getFields('insert_update');
		$fields 			= $arr['fields'];
		$info				= $arr['info'];
		$f_s			 	= $arr['fields_settings'];
		$pk_incr_fieldname  = $arr['pk_incr_fieldname'];
		$friendly_translit 	= $arr['friendly_translit'];
		$multiselect_fields = $arr['multiselect_fields'];

		if (count($this->errors)==0 && count($fields)>0) {

			$f						= '';
			$f_value				= '';
			$update_f_value			= '';
			$opdate_all_radiobox	= array();
			foreach ($fields as $k=>$v) {
				$incr		= false;
				$kavichky	= true;

				//формируем данные для вставки
				$f.="`$k`,";
				if (is_null($v)) $f_value.='NULL,';
				else {
					if ($f_s[$k]['datatype_id']==26) $kavichky=false;
					if ($kavichky) $f_value.="'$v',";
					else $f_value.="$v,";
				}


				//формируем данные для обновления
				if (is_null($v)) $update_f_value.="`$k`=NULL,";
				else {
					if ($f_s[$k]['datatype_id']==26) $kavichky=false;
					if ($kavichky) $update_f_value.="`$k`='$v',";
					else $update_f_value.="`$k`=$v,";
				}

				if ($f_s[$k]['edittype_id']==16 && $v==1)	{
					$opdate_all_radiobox[]	= "`$k`='0'";
				}
			}

			$f						= mb_substr($f, 0, -1);
			$f_value				= mb_substr($f_value, 0, -1);
			$update_f_value			= mb_substr($update_f_value, 0, -1);

			//получаем наибольший sort_index
			$query					= "SELECT max(`sort_index`) FROM `{$this->current_tablename}`";
			$result					= $this->mysql->executeSQL($query);
			list($max_sort_index)	= $this->mysql->fetchRow($result);
			$new_sort_index			= $max_sort_index+5;

			//берём старое значение поля Friendly URL, если указан id
			if ($friendly_translit!=NULL && isset($info['id'])) {
				$query							= "SELECT `{$friendly_translit['fieldname']}` FROM `{$this->current_tablename}` WHERE `id`='{$info['id']}'";
				$result							= $this->mysql->executeSQL($query);
				list($friendly_translit_old)	= $this->mysql->fetchRow($result);
			}

			//вставка или обновление записи
			$query					= "INSERT INTO `{$this->current_tablename}` ($f, `page_id`, `tag_id`, `lang_id`, `sort_index`) VALUES ($f_value, '{$info['page_id']}', '{$info['tag_id']}', '{$info['lang_id']}', '$new_sort_index') ON DUPLICATE KEY UPDATE $update_f_value";
			$result					= $this->mysql->executeSQL($query);

			if (!$this->inserted_id	= $this->mysql->insertID($result)) {
				$ecode				= $this->mysql->getErrorCode();

				if (isset($MSGTEXT['mysql_errors_'.$ecode])) {
					$this->errors		= $MSGTEXT['mysql_errors_'.$ecode];
				}
				else {
					$this->errors		= $this->mysql->getError();
				}
			}
			//обновляем значение Friendly URL, если оно изменилось. Данный код работает только, если просиходит обновление записей, а не вставка
			elseif ($friendly_translit!=NULL && isset($friendly_translit_old) && $friendly_translit_old!=$friendly_translit['value'] && isset($info['id'])) {

				//обновляем таблицу, в которой храняться подставляемые значения для поля с типом редактирования MultySelect
				$this->updateMultiselectData($multiselect_fields, $info['id']);

				$GENERAL_FUNCTIONS->updateFriendlYURL($f_s, $friendly_translit,  $info['id']);
			}

			if ($this->inserted_id) {
				//обновляем статус всех RadioBoxOther
				if (count($opdate_all_radiobox)>0) {
					$opdate_all_radiobox= implode(',', $opdate_all_radiobox);
					$query				= "UPDATE `$this->current_tablename` SET $opdate_all_radiobox WHERE `$pk_incr_fieldname`!='{$this->inserted_id}'";
					$result				= $this->mysql->executeSQL($query);
				}

				//обновляем таблицу, в которой храняться подставляемые значения для поля с типом редактирования MultySelect
				$this->updateMultiselectData($multiselect_fields, $this->inserted_id);

				//сохраняем файлы
				$update_fields='';
				foreach ($f_s as $k=>$v) {
					if ($v['edittype_id']==9 || $v['edittype_id']==11) {
						$r	=	$this->saveOneFile($v, $this->inserted_id);
						if (count($this->errors)==0 && $r) {
							$update_fields.=" `{$v['fieldname']}`='$r' AND";
						}
					}
				}

				if ($update_fields!='') {
					$query			= "UPDATE `{$this->current_tablename}` SET ".mb_substr($update_fields,0,-3)." WHERE `$pk_incr_fieldname`='{$this->inserted_id}'";
					$result			= $this->mysql->executeSQL($query);
				}

				$this->get['id']	= $this->inserted_id;
			}
		}
		else {
			$this->errors[]='';
		}
	}



	/**
	 * Удаление записи
	 *
	 */
	function dataDelete() {
		GLOBAL $GENERAL_FUNCTIONS;

		$pk_incr_fieldname	= $GENERAL_FUNCTIONS->getTablePkIncrFieldName($this->current_tablename);
		$this->dataDeleteSourseFields($this->dataRow['id'],  $this->current_tablename, $pk_incr_fieldname);
	}



	/**
	 * Удаляет записи из таблиц
	 *
	 * @param string $ids
	 * @param string $current_tablename
	 * @param string $s_field
	 */
	function dataDeleteSourseFields($ids,  $current_tablename, $s_field) {
		GLOBAL $GENERAL_FUNCTIONS, $FILE_MANAGER, $MYSQL_TABLE17, $MYSQL_TABLE18;

		//берем первичный ключ таблицы из которой удаляются записи
		$pk_incr_fieldname	= $GENERAL_FUNCTIONS->getTablePkIncrFieldName($current_tablename);

		//получаем таблицы, из которых нужно удалить записи
		$query					= "SELECT t2.table_name, t.fieldname, t.edittype_id, t.sourse_field_name, t.delete, t.table_id FROM `$MYSQL_TABLE17` AS `t` LEFT JOIN `$MYSQL_TABLE18` AS `t2` ON (t.table_id=t2.id) WHERE t.sourse_table_name='{$current_tablename}'";
		$result					= $this->mysql->executeSQL($query);
		$deleted_info			= array();
		$friendly_translit_all	= array();
		while ($row		= $this->mysql->fetchAssoc($result)) {
			if ($row['delete']==1) {
				$deleted_info[$row['table_name']]['sourse_field_name'][]	= $row['sourse_field_name'];
				$deleted_info[$row['table_name']]['fieldname'][]			= $row['fieldname'];
				$deleted_info[$row['table_name']]['edittype_id'][]			= $row['edittype_id'];
			}

			if ($row['edittype_id']==14) {
				$friendly_translit_all[]	= $row;
			}
		}

		//получаем таблицы, из которых нужно удалить записи
		$query				= "SELECT t.fieldname, t.edittype_id FROM `$MYSQL_TABLE17` AS `t` LEFT JOIN `$MYSQL_TABLE18` AS `t2` ON (t.table_id=t2.id) WHERE t2.table_name='{$current_tablename}' AND (t.edittype_id='9' OR t.edittype_id='10' OR t.edittype_id='11' OR t.edittype_id='12')";
		$result				= $this->mysql->executeSQL($query);
		$deleted_folders	= $this->mysql->fetchAssocAll($result);

		if (count($deleted_info)>0) {
			//получаем значение полей на которые ссылаются записи в таблицах
			$query			= "SELECT `$pk_incr_fieldname` FROM `{$current_tablename}` WHERE `$s_field` IN ($ids)";
			$result			= $this->mysql->executeSQL($query);
			$source_value	='';
			while ($row		= $this->mysql->fetchAssoc($result)) {
				$source_value.=$row[$pk_incr_fieldname].',';
			}
			if ($source_value!='') {
				$source_value	= mb_substr($source_value,0,-1);
				foreach ($deleted_info as $t=>$d) {
					foreach ($deleted_info[$t]['sourse_field_name'] as $ind=>$sourse_field_name) {
						$del_field	= $deleted_info[$t]['fieldname'][$ind];
						$this->dataDeleteSourseFields($source_value,  $t, $del_field);
					}
				}
			}
		}

		//получаем поля Multiselect из таблицы
		$multiselect_fields	= array();
		$query			= "SELECT $MYSQL_TABLE18.id FROM `$MYSQL_TABLE18` WHERE $MYSQL_TABLE18.table_name='{$current_tablename}'";
		$result			= $this->mysql->executeSQL($query);
		list($table_id) = $this->mysql->fetchRow($result);

		$query			= "SELECT $MYSQL_TABLE17.id FROM `$MYSQL_TABLE17` WHERE $MYSQL_TABLE17.table_id='$table_id'";
		$result			= $this->mysql->executeSQL($query);
		while ($row		= $this->mysql->fetchAssoc($result)) {
			$mtmp['id']				= $row['id'];
			$mtmp['values']			= array();
			$multiselect_fields[]	= $mtmp;
		}

		if ($ids!='') {
			$ids_array	= explode(',', str_replace(' ', '', $ids));
			foreach ($ids_array AS $data_id) {
				//обновляем таблицу, в которой храняться подставляемые значения для поля с типом редактирования MultySelect
				$this->updateMultiselectData($multiselect_fields, $data_id);

				foreach ($deleted_folders as $df) {
					//удаляем папки
					if ($df['edittype_id']==9 || $df['edittype_id']==10) {
						$ftype	= 'images';
					}
					else {
						$ftype	= 'files';
					}

					$folder	= $_SERVER['DOCUMENT_ROOT']."/modules/{$this->info['module_name']}/management/storage/$ftype/{$this->current_tablename_no_prefix}/{$df['fieldname']}/$data_id/";
					$FILE_MANAGER->removeFolder($folder);
				}
			}

			//запоминаем значение строки, перед удалением
			$query			= "SELECT * FROM `$current_tablename` WHERE `id` IN ($ids)";
			$result			= $this->mysql->executeSQL($query);
			$del_fields		= $this->mysql->fetchAssocAll($result);

			foreach ($del_fields as $fields) {

				//обновляем значение Friendly URL, если оно изменилось
				foreach ($friendly_translit_all as $friendly_translit) {
					$fs[$friendly_translit['fieldname']]['table_id']	= $friendly_translit['table_id'];
					$GENERAL_FUNCTIONS->updateFriendlYURL($fs, $friendly_translit,  $fields['id'], true);
				}
				//запускаем обработчик после редактирования записи
				$this->run_After_API_Edit($fields, $fields, 'delete');
			}

			//удаляем записи из исходной таблицы
			$query			= "DELETE FROM `$current_tablename` WHERE `$s_field` IN ($ids)";
			$result			= $this->mysql->executeSQL($query);
		}
	}



	/**
	 * Возвращает список выбранных записей и
	 * информацию о страницах перехода
	 *
	 * @param string 	$sql
	 * @param int 		$limit
	 * @param string 	$page_number_name
	 * @return array
	 */
	function dataGet($sql = NULL, $limit = 10, $page_number_name = NULL) {
		GLOBAL $MYSQL_TABLE17, $MYSQL_TABLE18;

		if ($sql!=NULL) {
			$sql 	= ltrim($sql);

			if ($page_number_name!=NULL) {
				if (!isset($this->gets[$page_number_name])) {
					$page_number	= 1;
				}
				else $page_number	= $this->gets[$page_number_name];

				if ($limit!=NULL) {
					$start_limit				= ($page_number-1)*$limit;
					if ($start_limit<0) {
						$start_limit			= 0;
					}
					$limit_sql					= " LIMIT $start_limit,$limit";
				}
				else {
					$limit_sql					= '';
				}

				$search						= array('/\ASELECT\s+(.*?)[\s`]+FROM\s+/is');
				$replace					= array('SELECT count(*) FROM ');
				$records_count				= 0;
				$sql_count					= preg_replace($search, $replace, $sql);
				$result						= $this->mysql->executeSQL($sql_count);

				//если есть группировка
				if (preg_match('/[ \t\r\n]*GROUP[ \t\r\n]*BY[ \t\r\n]*/i', $sql_count)) {
					$records_count			= $this->mysql->numRows($result);	//берём число затронутых записей
				}
				else {
					while (list($r_c)			= $this->mysql->fetchRow($result)) {
						$records_count			+= $r_c;
					}
				}

				if ($limit!=NULL) {
					$total_pages			= ceil($records_count/$limit);
				}
				else {
					$total_pages			= 0;
				}
			}
			else {
				$records_count 	= 0;
				$limit_sql		= '';
				$total_pages	= 0;
				$page_number	= 0;
			}

			//получаем записи, которые выводятся на страницу
			$sql						= $sql.$limit_sql;
			$result						= $this->mysql->executeSQL($sql);
			$records					= $this->mysql->fetchAssocAll($result);

			$pages['page_selected']		= $page_number;
			$pages['page_count']		= $total_pages;
			$pages['records_count']		= $records_count;

			if ($page_number_name!=NULL) {
				$data[0]				= $records;
				$data[1]				= $pages;
			}
			else 	{
				$data					= $records;
			}
		}
		else $data = false;

		return $data;
	}




	////////////////////////ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ///////////////////////////////////////////////////////////////////////////////////


	/**
	 * Возвращает данные с формы редактирования таблицы
	 *
	 * @return array
	 */
	function getFields($type_edit=NULL) {
		GLOBAL $MSGTEXT, $MODULES_PATH, $MYSQL_TABLE17, $MYSQL_TABLE18, $GENERAL_FUNCTIONS;

		if (count($MSGTEXT)==0) {
			require_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/languages/'.SETTINGS_LANGUAGE;	//подключаем язык
		}
		

		$info['page_id']		= $this->get['page_id'];
		$info['tag_id']			= $this->get['tag_id'];
		$info['lang_id']		= $this->lang_id;

		if (isset($this->dataRow['id']))	{
			$info['id']			= $this->dataRow['id'];
		}
		else {
			$info['id']			= '';
		}

		//проверяем, чтоб корректно был указан ID при обновлении
		if ($type_edit=='update' && ! is_numeric($info['id'])) {
			$this->errors[] = sprintf($MSGTEXT['management_block_error_type_field'], 'id');
		}


		$friendly_translit		= null;
		$delete					= array();
		$fs						= array();
		$fields					= array();
		$multiselect_fields		= array();

		//берем настройки полей
		$query					= "SELECT $MYSQL_TABLE17.* FROM `$MYSQL_TABLE18`, `$MYSQL_TABLE17`
		WHERE $MYSQL_TABLE18.table_name='{$this->current_tablename}' 
		AND $MYSQL_TABLE17.table_id=$MYSQL_TABLE18.id 
		AND $MYSQL_TABLE17.edittype_id!=8 
		AND $MYSQL_TABLE17.edittype_id!=10
		AND $MYSQL_TABLE17.edittype_id!=12 ORDER BY `sort_index` DESC";
		$result					= $this->mysql->executeSQL($query);
		$fields_settings		= $this->mysql->fetchAssocAll($result);

		//проверяем правильность заполнения полей
		if (count($this->dataRow)>0)
		foreach ($fields_settings as $v) {

			//если поле передано в массив $this->dataRow
			if (isset($this->dataRow[$v['fieldname']]) || isset($_FILES[$v['fieldname']]) || $v['edittype_id']==5 || $v['edittype_id']==4) {

				if ($v['edittype_id']==9 || $v['edittype_id']==11)  { //если картинка или файл
					if ($type_edit!='insert') {
						$r	=	$this->saveOneFile($v, $info['id']);

						//проверяем результат
						if (count($this->errors)==0 && $r) {
							$fields[$v['fieldname']]	= $r;
						}

					}
					else $fields[$v['fieldname']] 		= '';
				}
				else {
					if (isset($this->dataRow[$v['fieldname']])) {						
						if ($v['edittype_id']==4  )  {	//если данные переданы как масив, то переводим в строку

							if (!is_array($this->dataRow[$v['fieldname']])) {
								$this->dataRow[$v['fieldname']]	= array(0);
							}
							else if ($this->dataRow[$v['fieldname']][0]=='') {
								$this->dataRow[$v['fieldname']]	= array_splice($this->dataRow[$v['fieldname']], 1);
							}

							$fields[$v['fieldname']]	= $v['id'];
							$mtmp['id']					= $v['id'];
							$mtmp['values']				=  $this->dataRow[$v['fieldname']];
							$multiselect_fields[]		= $mtmp;
						}
						//проверяем тип редактирования Friendly URL
						elseif ($v['edittype_id']==14) {
							if (is_numeric($this->dataRow[$v['fieldname']])) {
								$this->errors[] = sprintf($MSGTEXT['management_block_error_14_numbers'], $v['comment']);
							}
							elseif ($this->dataRow[$v['fieldname']]=='') {	//проверяем, чтоб небыло пустым

								//автоматичесик генерируем транслит
								if (isset($this->dataRow[$v['sourse_field_name']])) {
									$translit							= $GENERAL_FUNCTIONS->convertKirilToLatin($this->dataRow[$v['sourse_field_name']]);
									$fields[$v['fieldname']]			= $translit;
								}
								else {
									$this->errors[] 					= sprintf($MSGTEXT['management_block_error_14_empty'], $v['comment']);
								}
							}
							else {
								$fields[$v['fieldname']]				= $this->dataRow[$v['fieldname']];
							}
						}
						elseif ($v['edittype_id']==15) {

							if ($this->dataRow[$v['fieldname']]=='' && isset($this->dataRow[$v['sourse_field_name']])) {
								$fields[$v['fieldname']] = $this->dataRow[$v['sourse_field_name']];
							}
							else {
								$fields[$v['fieldname']] = $this->dataRow[$v['fieldname']];
							}

						}
						//если число дробное, тогда вырезаем пробелы, табуляцию и меняем запятую на точку
						elseif ($v['datatype_id']==9 || $v['datatype_id']==10) {
							$fields[$v['fieldname']]	= str_replace(array("\t", ' ', ','), array('', '', '.'), $this->dataRow[$v['fieldname']]);
						}
						else {
							$fields[$v['fieldname']]	= $this->dataRow[$v['fieldname']];
						}
					}
					else { //если поле в форме редактирования не существует
						if ($type_edit!='update') {
							if ($v['edittype_id']==4) {
								$fields[$v['fieldname']]	= 0;

								$mtmp['id']					= $v['id'];
								$mtmp['values']				= array();
								$multiselect_fields[]		= $mtmp;
							}
							elseif ($v['edittype_id']==5) {
								$fields[$v['fieldname']]	= 0;
							}
							elseif ($v['edittype_id']==16) {
								$fields[$v['fieldname']]	= 0;
							}
							elseif ($v['edittype_id']==14) {
								$this->errors[] = sprintf($MSGTEXT['management_block_error_14_empty'], $v['comment']);
							}
							elseif ($v['default']!='') {
								$fields[$v['fieldname']]	= $v['default'];
							}
							else {
								if ($type_edit=='insert') {
									if ($v['not_null']==0 || $v['auto_incr']==1 || $v['pk']==1) {
										$fields[$v['fieldname']] 	= NULL;

									}
									else {
										$this->errors[] = sprintf($MSGTEXT['management_block_error_type_field'], $v['comment']);
									}
								}
							}
						}
					}
				}

				//если значение для поля пустое и выставленно Not Null, значит выводим ошибку
				if (!$v['pk'] && $v['not_null']==1) {
					if (!isset($fields[$v['fieldname']])) {
						$this->errors[] = sprintf($MSGTEXT['management_block_error_type_field'], $v['comment']);
					}
					else if ($fields[$v['fieldname']]=='' || (($v['edittype_id']==3 || $v['edittype_id']==4) &&  $fields[$v['fieldname']]==0)) {
						$this->errors[] = sprintf($MSGTEXT['management_block_error_type_field'], $v['comment']);
					}
				}

				//если есть данные, делаем	проверку по регулярному выражению
				if ($v['regex']!='' && isset($fields[$v['fieldname']]) && $fields[$v['fieldname']]!='' && $v['edittype_id']!=9 && $v['edittype_id']!=11) {
					if (!@preg_match($v['regex'], $fields[$v['fieldname']])) {
						$this->errors[] = sprintf($MSGTEXT['management_block_error_type_field'], $v['comment']);
					}
				}

				//проверяем, чтоб в таблицу нельзя было добавить 2 уникальных поля
				if ($v['unique'] && count($this->errors)==0) {

					//проверяем нужно ли модифицировать ключ
					$modify_uniq=false;
					foreach ($fields_settings as $test_v) {
						if ($test_v['edittype_id']==14 && $test_v['sourse_field_name']==$v['fieldname']) {
							$modify_uniq=true;
							break;
						}
					}

					if ($type_edit=='update') {
						$unig_where_id="AND `id`!='{$info['id']}'";
					}
					else {
						$unig_where_id='';
					}

					//обрезаем строку, если она больше 255 символов
					$str_length						= mb_strlen($fields[$v['fieldname']]);
					if ($str_length>255) {
						$strip_length				= $str_length-255;
						$fields[$v['fieldname']]	= mb_substr($fields[$v['fieldname']], 0, -$strip_length);
					}

					$pred			= $fields[$v['fieldname']];
					$increment		= 0;
					$uniq_count_id	= 1;
					while ($uniq_count_id>0 && count($this->errors)==0) {
						$query							= "SELECT `id` FROM `$this->current_tablename` WHERE `{$v['fieldname']}`='{$fields[$v['fieldname']]}' $unig_where_id";
						$result							= $this->mysql->executeSQL($query);
						list($uniq_count_id)			= $this->mysql->fetchRow($result);

						//если в таблице есть запись с таким уникальным ключем
						if ($uniq_count_id>0) {
							if (SETTINGS_API_FRIENDLY_AUTHO_INDEX && $modify_uniq) {
								$fields[$v['fieldname']]=$pred;

								if (!isset($table_info['Auto_increment'])) {
									$query				= "SHOW TABLE STATUS LIKE '{$this->current_tablename}'";
									$result				= $this->mysql->executeSQL($query);
									$table_info			= $this->mysql->fetchAssoc($result);
								}

								$table_info['Auto_increment']=$table_info['Auto_increment']+$increment;

								//проверяем, нужно ли обрезать индекс в конце
								$tex				= explode('-', $fields[$v['fieldname']]);
								$tex_prefix			= $tex[count($tex)-1];
								if ($tex_prefix==$uniq_count_id) {
									$strip_length				= mb_strlen($tex_prefix)+1;
									$fields[$v['fieldname']]	= mb_substr($fields[$v['fieldname']], 0, -$strip_length);
								}

								//обрезаем строку, если она больше 255 c префиксом
								$pk_str_length		= mb_strlen($fields[$v['fieldname']])+mb_strlen($table_info['Auto_increment'])+1;
								if ($pk_str_length>255) {
									$strip_length				= $pk_str_length-255;
									$fields[$v['fieldname']]	= mb_substr($fields[$v['fieldname']], 0, -$strip_length);
								}

								$fields[$v['fieldname']]		= $fields[$v['fieldname']].'-'.$table_info['Auto_increment'];
								$increment++;
							}
							else {
								if ($type_edit!='insert_update') {
									$this->errors[] = sprintf($MSGTEXT['management_block_error_duble_uniq'], $v['comment']);
								}
								else {
									break;
								}
							}
						}
					}
				}
			}


			//если галочка отсутствует, и выставлена настройка автозаполнения, тогда  назначаем 0
			if (!isset($fields[$v['fieldname']]) && $v['edittype_id']==5 && $this->autho_update_checkbox) {
				$fields[$v['fieldname']]	= 0;
			}

			//если галочка отсутствует, но далжна быть обязательно заполнена
			if (!isset($fields[$v['fieldname']]) && !$v['pk'] && $v['not_null']==1 && $v['default']=='') {
				$this->errors[] = sprintf($MSGTEXT['management_block_error_type_field'], $v['comment']);
			}

			//если значение уникального поля больше 255, тогда обрезаем его
			if ($v['unique'] && isset($fields[$v['fieldname']]) && mb_strlen($fields[$v['fieldname']])>255) {
				$fields[$v['fieldname']]=mb_substr($fields[$v['fieldname']], 0, 255);
			}

			//если для поля с числовым типом не указаны данные ставим по умолчанию 0
			if (isset($fields[$v['fieldname']])) {
				if ($v['datatype_id']==27 && $fields[$v['fieldname']]===true) {
					$fields[$v['fieldname']]=1;
				}
				elseif (($v['datatype_id']==2 || $v['datatype_id']==5 || $v['datatype_id']==6 || $v['datatype_id']==7 || $v['datatype_id']==8 || $v['datatype_id']==9 || $v['datatype_id']==10 || $v['datatype_id']==11 || $v['datatype_id']==15 ||  $v['datatype_id']==26 || $v['datatype_id']==27 || $v['datatype_id']==28 || $v['datatype_id']==29) && ($fields[$v['fieldname']]=='' || !is_numeric($fields[$v['fieldname']]) )) {
					$fields[$v['fieldname']]=0;
				}
				//если для поля с типом DATETIME, TIMESTAMP не указано время ставим текущее время
				else if (($v['datatype_id']==12 || $v['datatype_id']==13) &&  $fields[$v['fieldname']]=='' ) {
					$fields[$v['fieldname']] = gmdate('Y-m-d H:i:s');
				}
				elseif (($v['datatype_id']==24 || $v['datatype_id']==25) && $fields[$v['fieldname']]=='') {
					$fields[$v['fieldname']]	= null;
				}
			}

			$fs[$v['fieldname']]=$v;

			if ($v['edittype_id']==14 && isset($fields[$v['fieldname']])) {
				//вырезаем перевод строки, если есть
				$fields[$v['fieldname']]			= str_replace(SETTINGS_NEW_LINE, '-', $fields[$v['fieldname']]);

				//вырезаем двойные черточки
				$fields[$v['fieldname']]			= str_replace('--', '-', $fields[$v['fieldname']]);

				$friendly_translit['value']			= $fields[$v['fieldname']];
				$friendly_translit['fieldname']		= $v['fieldname'];
			}
		}
		
		
		$arr['multiselect_fields']	= $multiselect_fields;
		$arr['friendly_translit']	= $friendly_translit;
		$arr['fields']				= $fields;
		$arr['fields_settings']		= $fs;
		$arr['info']				= $info;
		$arr['delete']				= $delete;
		$arr['pk_incr_fieldname']	= 'id';

		return $arr;
	}



	///////////////////РЕДАКТИРОВАНИЕ ИЗОБРАЖЕНИЙ//////////////////////////////////////////////////
	/**
	 * Сохранить загрузку изображений из нового окна
	 *
	 * @param string $field_name - имя поля в таблице, где храниться имя изображения
	 * @param string $field_name_file - ключ в массиве $_FILES, по которому передаётся имя закачиваемого файла
	 */
	function photosUpdate($field_name, $field_name_file) {
		GLOBAL  $GENERAL_FUNCTIONS, $FILE_MANAGER, $MSGTEXT, $MODULES_PATH, $MYSQL_TABLE17, $MYSQL_TABLE18;

		$save_to_dir 		= $MODULES_PATH.$this->info['module_name']."/management/storage/images/{$this->current_tablename_no_prefix}/$field_name/{$this->dataRow['id']}/";

		//создаём папки, где будут храниться изображения для данной записи
		$patch_enable=true;
		if (!is_dir($save_to_dir)) {
			if (!$FILE_MANAGER->mkdir($save_to_dir.'preview', SETTINGS_CHMOD_FOLDERS,  true)) {
				$this->errors[]	= sprintf($MSGTEXT['management_block_no_r_for_patch'], $save_to_dir);
				$patch_enable		= false;
			}
		}

		if ($patch_enable) {
			//берем настройки поля
			$query							= "SELECT $MYSQL_TABLE17.* FROM `$MYSQL_TABLE18`, `$MYSQL_TABLE17` WHERE $MYSQL_TABLE17.table_id=$MYSQL_TABLE18.id AND $MYSQL_TABLE18.table_name='{$this->current_tablename}' AND $MYSQL_TABLE17.fieldname='$field_name'";
			$result							= $this->mysql->executeSQL($query);
			$field_settings					= $this->mysql->fetchAssoc($result);
			$field_settings['fieldname']	= $field_name_file;

			//сохраняем новое изображение
			$res	= $this->uploadimg($save_to_dir, $field_settings);

			//если все нормально
			if (count($this->errors)==0) {
				$max				= 0;
				$pk_incr_fieldname	= $GENERAL_FUNCTIONS->getTablePkIncrFieldName($this->current_tablename);

				//берем старый массив
				$query				= "SELECT `$field_name` FROM `{$this->current_tablename}` WHERE `$pk_incr_fieldname`='{$this->dataRow['id']}' ";
				$result				= $this->mysql->executeSQL($query);
				list($currentData)	= $this->mysql->fetchRow($result);

				//добавляем элемент
				$photos				= eval($currentData);
				if (is_array($photos)) {
					foreach ($photos as $p) {
						if ($max<$p['sort_index']) $max=$p['sort_index'];
					}
				}
				else {
					$photos	= array();
				}

				$tmp['name']		= $res;
				$tmp['sort_index']	= $max+5;
				$tmp['description']	= '';
				$photos[]			= $tmp;

				$ser				= addslashes('return '.var_export($photos, true).';');

				$query				= "UPDATE `{$this->current_tablename}` SET `$field_name`='$ser' WHERE `$pk_incr_fieldname`='{$this->dataRow['id']}'";
				$result				= $this->mysql->executeSQL($query);
			}
		}
	}



	///////////////////РЕДАКТИРОВАНИЕ ФАЙЛОВ//////////////////////////////////////////////////
	/**
	 * Сохранение закачки файла в новом окне	
	 * @param string $field_name - имя поля в таблице, где храниться имя файла
	 * @param string $field_name_file - ключ в массиве $_FILES, по которому передаётся имя закачиваемого файла
	 */
	function filesUpdate($field_name, $field_name_file) {
		GLOBAL  $GENERAL_FUNCTIONS, $FILE_MANAGER, $MSGTEXT, $MODULES_PATH, $MYSQL_TABLE17, $MYSQL_TABLE18;

		$save_to_dir 		= $MODULES_PATH.$this->info['module_name']."/management/storage/files/{$this->current_tablename_no_prefix}/$field_name/{$this->dataRow['id']}/";

		//создаём папки, где будут храниться файлы для данной записи
		if (!is_dir($save_to_dir)) {
			$FILE_MANAGER->mkdir($save_to_dir, SETTINGS_CHMOD_FOLDERS, true);
		}

		//берем допустимые расширения
		$query							= "SELECT $MYSQL_TABLE17.* FROM `$MYSQL_TABLE17`, `$MYSQL_TABLE18` WHERE $MYSQL_TABLE18.table_name='{$this->current_tablename}' AND $MYSQL_TABLE17.fieldname='$field_name'";
		$result							= $this->mysql->executeSQL($query);
		$field_settings					= $this->mysql->fetchAssoc($result);
		$regex							= $field_settings['regex'];
		$field_settings['fieldname']	= $field_name_file;

		if ($regex!='') $rash_array 	= explode(',', $regex);
		else $rash_array = null;


		//сохраняем новый файл
		$res				= $this->uploadfile($save_to_dir, $field_settings, $rash_array);

		//если все нормально
		if (count($this->errors)==0) {
			$max				= 0;
			$pk_incr_fieldname	= $GENERAL_FUNCTIONS->getTablePkIncrFieldName($this->current_tablename);

			//берем старый массив
			$query				= "SELECT `$field_name` FROM `{$this->current_tablename}` WHERE `$pk_incr_fieldname`='{$this->dataRow['id']}' ";
			$result				= $this->mysql->executeSQL($query);
			list($currentData)	= $this->mysql->fetchRow($result);

			//добавляем элемент
			$files				= eval($currentData);
			if (is_array($files)) {

				foreach ($files as $f) {
					if ($max<$f['sort_index']) $max	= $f['sort_index'];
				}
			}
			else {
				$files=array();
			}

			$fullName			= $save_to_dir.$res;
			$tmp['name']		= $res;
			$tmp['size']		= number_format(round(filesize($fullName)/1000), 0, ',', '.');
			$tmp['changed']		= gmdate('M d Y H:i:s', filectime($fullName));

			$tmp['sort_index']	= $max+5;
			$tmp['description']	= '';
			$files[]			= $tmp;

			$ser				= addslashes('return '.var_export($files, true).';');
			$query				= "UPDATE `{$this->current_tablename}` SET `$field_name`='$ser' WHERE `$pk_incr_fieldname`='{$this->dataRow['id']}'";
			$result				= $this->mysql->executeSQL($query);
		}
	}



	/**
	 * Сохраняет файл с формы редактирования
	 *
	 * @param array $v
	 * @param int $inserted_id
	 * @return string|boolean
	 */
	function saveOneFile($v,  $inserted_id) {
		GLOBAL $FILE_MANAGER, $MSGTEXT, $MODULES_PATH, $GENERAL_FUNCTIONS;

		$pk_incr_fieldname	= 'id';
		$save_images_to_dir = $MODULES_PATH.$this->info['module_name']."/management/storage/images/{$this->current_tablename_no_prefix}";
		$save_files_to_dir 	= $MODULES_PATH.$this->info['module_name']."/management/storage/files/{$this->current_tablename_no_prefix}";
		$filename			= false;

		//загрузка файла
		if ($v['edittype_id']==11) {
			if (!is_dir($save_files_to_dir.'/'.$v['fieldname'].'/'.$inserted_id)) {
				$FILE_MANAGER->mkdir($save_files_to_dir.'/'.$v['fieldname'].'/'.$inserted_id, SETTINGS_CHMOD_FOLDERS, true);
			}

			//удаляем, если выбрано
			if (isset($this->postr[$v['fieldname'].'_delete'])) {
				$filename		= '';
				$del_file_name 	= $this->postr[$v['fieldname'].'_delete'];
				if (is_numeric($inserted_id)) {

					if (file_exists($save_files_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/preview/'.$del_file_name)) {
						$FILE_MANAGER->unlink($save_files_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/preview/'.$del_file_name);
					}

					if (file_exists($save_files_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/'.$del_file_name)) {
						$FILE_MANAGER->unlink($save_files_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/'.$del_file_name);
					}

					$query		= "UPDATE `{$this->current_tablename}` SET `{$v['fieldname']}`=NULL WHERE `$pk_incr_fieldname`='{$inserted_id}'";
					$result		= $this->mysql->executeSQL($query);
				}
			}



			if (isset($_FILES[$v['fieldname']]['name']) && $_FILES[$v['fieldname']]['name']!='') {

				if ($v['regex']!='') $rash_array 	= explode(',', $v['regex']);
				else $rash_array = null;

				$res = $this->uploadfile("$save_files_to_dir/{$v['fieldname']}/{$inserted_id}", $v, $rash_array);

				//проверяем результат
				if (count($this->errors)==0 && $res) {
					$filename	= $res;

					//при закачке нового файла удаляем старый
					if ((!isset($this->postr[$v['fieldname'].'_delete'])) && is_numeric($inserted_id)) {
						$query					= "SELECT `{$v['fieldname']}` FROM `{$this->current_tablename}` WHERE `$pk_incr_fieldname`='{$inserted_id}'";
						$result					= $this->mysql->executeSQL($query);
						list($currentData)		= $this->mysql->fetchRow($result);

						if ($currentData!=NULL && $currentData!='') {
							$f_p	= $save_files_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/'.$currentData;
							if (file_exists($f_p)) $FILE_MANAGER->unlink($f_p);
						}
					}
				}
			}
		}
		//загрузка картинки
		elseif ($v['edittype_id']==9) {

			if (!is_dir($save_images_to_dir.'/'.$v['fieldname'].'/'.$inserted_id)) {
				$FILE_MANAGER->mkdir($save_images_to_dir.'/'.$v['fieldname'].'/'.$inserted_id, SETTINGS_CHMOD_FOLDERS, true);
			}

			if (!is_dir($save_images_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/preview')) {
				$FILE_MANAGER->mkdir($save_images_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/preview', SETTINGS_CHMOD_FOLDERS, true);
			}

			//удаляем, если выбрано
			if (isset($this->postr[$v['fieldname'].'_delete'])) {
				$filename		= '';
				$del_file_name 	= $this->postr[$v['fieldname'].'_delete'];
				if (is_numeric($inserted_id)) {

					if (file_exists($save_images_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/preview/'.$del_file_name)) {
						$FILE_MANAGER->unlink($save_images_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/preview/'.$del_file_name);
					}

					if (file_exists($save_images_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/'.$del_file_name)) {
						$FILE_MANAGER->unlink($save_images_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/'.$del_file_name);
					}

					$query		= "UPDATE `{$this->current_tablename}` SET `{$v['fieldname']}`=NULL WHERE `$pk_incr_fieldname`='{$inserted_id}'";
					$result		= $this->mysql->executeSQL($query);
				}
			}

			if (isset($_FILES[$v['fieldname']]['name']) && $_FILES[$v['fieldname']]['name']!='') {

				$res	= $this->uploadimg($save_images_to_dir.'/'.$v['fieldname'].'/'.$inserted_id, $v);

				//проверяем результат
				if (count($this->errors)==0) {
					$filename	= $res;

					//при закачке новой картинки удаляем старую
					if (!isset($this->postr[$v['fieldname'].'_delete']) && is_numeric($inserted_id)) {
						$query					= "SELECT `{$v['fieldname']}` FROM `{$this->current_tablename}` WHERE `$pk_incr_fieldname`='{$inserted_id}'";
						$result					= $this->mysql->executeSQL($query);
						list($currentData)		= $this->mysql->fetchRow($result);

						if ($currentData!=NULL && $currentData!='') {
							if (file_exists($save_images_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/'.$currentData)) $FILE_MANAGER->unlink($save_images_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/'.$currentData);
							if (file_exists($save_images_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/preview/'.$currentData)) $FILE_MANAGER->unlink($save_images_to_dir.'/'.$v['fieldname'].'/'.$inserted_id.'/preview/'.$currentData);
						}
					}
				}
			}
		}

		return $filename;
	}




	///////////////////////ВСПОМАГАТЕЛЬНЫЕ ФУНКЦИИ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	 * Масштабирует изображение
	 *
	 * @param string $ext	-расширение
	 * @param string $src	-исходная картинка
	 * @param string $dest	-имя новой картинки
	 * @param int $lock_w	-ширина
	 * @param int $lock_h	-высота
	 * @param int $imageQuality	-качество сжатия
	 * 
	 * @return boolean
	 */
	function makePreview($ext, $src, $dest, $lock_w, $lock_h, $imageQuality) {

		if (@!file_exists($src)) return false;

		$ext	= str_replace('.', '', $ext);

		$this->createthumb(mb_strtolower($ext), $src, $dest, $lock_w, $lock_h, $imageQuality, false, true, false);

		return true;
	}



	/**
	 * Создаёт preview
	 *
	 * @param string $ext
	 * @param string $name
	 * @param string $newname
	 * @param int $new_w
	 * @param int $new_h
	 * @param int $imageQuality
	 * @param bool $border
	 * @param bool $transparency
	 * @param bool $base64
	 * @return bool
	 */
	function createthumb($ext, $name, $newname, $new_w, $new_h, $imageQuality, $border=false, $transparency=true, $base64=false) {

		if($ext=='jpeg' || $ext=='jpg'){
			$img = @imagecreatefromjpeg($name);
		}
		elseif($ext=='png'){
			$img = @imagecreatefrompng($name);
		}
		elseif($ext=='gif') {
			$img = @imagecreatefromgif($name);
		}

		if(!$img) return false;


		$old_x = imageSX($img);
		$old_y = imageSY($img);

		$from=$img;
		if (imageSX($from)>imageSY($from)) {
			$isPortret=false; // landscape
		}
		else {
			$isPortret=true; // portret
		}
		$hh	= $new_h;
		$ww	= $new_w;

		if ($isPortret) {
			$aspect=imageSX($from)/imageSY($from);
		}
		else {
			$aspect=imageSY($from)/imageSX($from);
		}

		if ($isPortret) {
			$ww=(int)($hh*$aspect);
		}
		else {
			$hh=(int)($ww*$aspect);
		}

		$thumb_w=$ww;
		$thumb_h=$hh;


		if($transparency) {
			if($ext=='png' ) {
				$new_img = ImageCreateTrueColor($thumb_w, $thumb_h);
				imagealphablending($new_img, false);
				$colorTransparent = imagecolorallocatealpha($new_img, 0, 0, 0, 127);
				imagefill($new_img, 0, 0, $colorTransparent);
				imagesavealpha($new_img, true);
			}
			elseif($ext=='gif') {
				$new_img 	= imagecreate($thumb_w, $thumb_h);
				$color 		= imagecolorallocate($new_img, 0, 0, 0);
				imagecolortransparent($new_img, $color);
			}
			else {
				$new_img = ImageCreateTrueColor($thumb_w, $thumb_h);
			}
		}
		else {
			$new_img = ImageCreateTrueColor($thumb_w, $thumb_h);
			Imagefill($new_img, 0, 0, imagecolorallocate($new_img, 255, 255, 255));
		}

		imagecopyresampled($new_img, $img, 0,0,0,0, $thumb_w, $thumb_h, $old_x, $old_y);


		if($border) {
			$black = imagecolorallocate($new_img, 0, 0, 0);
			imagerectangle($new_img,0,0, $thumb_w, $thumb_h, $black);
		}

		if($base64) {
			ob_start();
			imagepng($new_img);
			$img = ob_get_contents();
			ob_end_clean();
			$return = base64_encode($img);
		}
		else {
			if($ext=='jpeg' || $ext=='jpg') {
				imagejpeg($new_img, $newname, $imageQuality);
				$return = true;
			}
			elseif($ext=='png') {
				imagepng($new_img, $newname);
				$return = true;
			}
			elseif($ext=='gif') {
				imagegif($new_img, $newname);
				$return = true;
			}
		}
		imagedestroy($new_img);
		imagedestroy($img);
		return $return;
	}



	/**
	* Загружает изображение
 	*	
	* @param string  	$images_patch - папка в которую сохранять файл
	* @param string		$fieldname имя поля
	* @param int  		$lock_w ширина preview картинки
	* @param int  		$lock_h высота preview картинки
 	* @return string|array возвращает имя файла, либо массив ошибок в случае неудачи закачки
	*/
	function uploadimg($images_patch, $field, $index=null) {
		GLOBAL $GENERAL_FUNCTIONS, $FILE_MANAGER, $MSGTEXT;

		$res		= false;
		$flag		= false;
		$fieldname	= $field['fieldname'];

		if (is_numeric($index)) {
			$FILES_name		= $_FILES[$fieldname]['name'][$index];
			$FILES_tmp_name	= $_FILES[$fieldname]['tmp_name'][$index];
		}
		else {
			$FILES_name		= $_FILES[$fieldname]['name'];
			$FILES_tmp_name	= $_FILES[$fieldname]['tmp_name'];
		}

		if	(isset($FILES_name)) {
			if ($FILES_name=='') return false;

			//если закачиваемый файл не является изображением
			if (!$this->is_image($FILES_tmp_name)) return false;


			//проверяем, чтоб нельзя было закачать файлы с расшерением  .php
			if (mb_strpos('.php', strtolower($FILES_name)) || mb_strpos('.php', strtolower($FILES_tmp_name))) {
				$this->errors[] = sprintf($MSGTEXT['management_block_bad_file_format'], $field['comment']);
			}
			else {
				$t			= explode('.', $FILES_name);
				$FILES_type	= $t[count($t)-1];
				$FILES_name	= mb_substr($FILES_name, 0, mb_strlen($FILES_name)-mb_strlen($FILES_type)-1);
				$FILES_name	= $GENERAL_FUNCTIONS->convertKirilToLatin($FILES_name);
				$rash		= mb_strtolower($FILES_type);

				//проверка расширения
				switch ($rash):
				case('jpg'): 		$flag	= true;	 break;
				case('jpeg'): 		$flag	= true;	 break;
				case('gif'): 		$flag	= true;	 break;
				case('bmp'): 		$flag	= true;	 break;
				case('png'): 		$flag	= true;	 break;
				default :  			$this->errors[] = sprintf($MSGTEXT['management_block_bad_file_format'], $field['comment']); break;
				endswitch;
			}


			if ($flag)  {

				$rash			= '.'.$rash;

				//находим свободное имя
				$NewName		= $FILES_name.$rash;

				$findex			= 1;
				while (is_readable($images_patch.'/'.$NewName))  {
					$NewName	= $FILES_name.'_'.$findex.$rash;
					$findex++;
				}

				//if (is_uploaded_file($FILES_tmp_name)) {

				//создаём путь, если нужно
				if (!is_dir($images_patch.'/')) {
					$FILE_MANAGER->mkdir($images_patch.'/', SETTINGS_CHMOD_FOLDERS, true);
				}

				if ($FILE_MANAGER->copy($FILES_tmp_name, $images_patch.'/'.$NewName)) {

					$res	= $NewName;

					//создаем превьюшку
					if ($field['avator_width']==0) {
						$field['avator_width']=150;
					}

					if ($field['avator_height']==0) {
						$field['avator_height']=150;
					}

					if ($field['avator_quality']==0) {
						$field['avator_quality']=100;
					}

					$this->makePreview($rash, $images_patch.'/'.$NewName, $images_patch.'/preview/'.$NewName, $field['avator_width'], $field['avator_height'], $field['avator_quality']);

					//сжимаем закаченное изображение
					if ($field['avator_width_big']>0 && $field['avator_height_big']>0) {
						$this->makePreview($rash,  $images_patch.'/'.$NewName, $images_patch.'/'.$NewName, $field['avator_width_big'], $field['avator_height_big'], $field['avator_quality_big']);
					}

					//накладываем ватермарк на большое изображение
					if (SETTINGS_WATERMARK_FILENAME) {
						$watermark_filename = $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/'.SETTINGS_WATERMARK_FILENAME;
						$this->waterMark($images_patch.'/'.$NewName, $watermark_filename);
					}
				}
				else {
					$this->errors[]	= $MSGTEXT['management_block_no_r_for_patch2'];
				}
				/*
}
else {
$this->errors[]	= $MSGTEXT['management_block_upload_error'];
}
*/

			}
		}

		return  $res;
	}



	/**
	 * Проверяет, является ли файл изображением
	 *
	 * @param string $filename
	 * @return bool
	 */
	function is_image($filename) {
		$is = @getimagesize($filename);
		if (!$is) return false;
		elseif (!in_array($is[2], array(1,2,3,6))) return false;
		else return true;
	}



	/**
	 * Накладываем ватермарк
	 *
	 * @param string $fileInHD
	 * @param string $wmFile
	 * @param int $alpha
	 * @param int $quality
	 * @param string $position
	 */
	function waterMark($fileInHD, $wmFile, $alpha = 50, $quality = 100, $position='right') {

		include_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/Watermark.php');
		$watermark	= new Watermark($fileInHD, $wmFile, $alpha, $position);
		$watermark->save($fileInHD, $quality);
	}



	/**
	* Загружает файл
 	*	
	* @param string  $files_patch - папка в которую сохранять файл
	* @param array  $field_settings настройки поля
 	* @return string|array возвращает имя файла, либо массив ошибок в случае неудачи закачки
	*/
	function uploadfile($files_patch, $field_settings, $rash_array=null) {
		GLOBAL $MSGTEXT, $FILE_MANAGER, $GENERAL_FUNCTIONS;

		$flag			= false;
		$res			= false;

		$fieldname		= $field_settings['fieldname'];
		$FILES_name		= $_FILES[$fieldname]['name'];
		$FILES_type		= $_FILES[$fieldname]['type'];
		$FILES_tmp_name	= $_FILES[$fieldname]['tmp_name'];


		if	(isset($FILES_name)) {
			if ($FILES_name=='') return false;

			//проверяем, чтоб нельзя было закачать файлы с расшерением  .php
			if (mb_strpos(strtolower($FILES_name), '.php') || mb_strpos(strtolower($FILES_tmp_name), '.php')) {
				$this->errors[] = sprintf($MSGTEXT['management_block_bad_file_format'], $field_settings['comment']);
			}
			//проверяем, допустимо ли данное расширение файла
			else {

				$t			= explode('.', $FILES_name);
				$FILES_type	= $t[count($t)-1];
				$FILES_name	= mb_substr($FILES_name, 0, mb_strlen($FILES_name)-mb_strlen($FILES_type)-1);
				$FILES_name	= $GENERAL_FUNCTIONS->convertKirilToLatin($FILES_name);

				if (!is_dir($files_patch)) {
					$FILE_MANAGER->mkdir($files_patch, SETTINGS_CHMOD_FOLDERS, true);
				}

				//если заданы допустимые расширения, то делаем проверку
				$rash			= mb_strtolower($FILES_type);
				$rash			= '.'.$rash;

				if ( is_array($rash_array) && !in_array($rash, $rash_array)) {
					$flag			= false;
					$this->errors[] = sprintf($MSGTEXT['management_block_error_type_field'], $field_settings['comment']);
				}
				else {
					$flag			= true;
				}
			}


			if ($flag)  {

				//находим свободное имя
				$NewName	= $FILES_name.$rash;
				$findex		= 1;
				while (is_readable($files_patch.'/'.$NewName))  {
					$NewName	= $FILES_name.'_'.$findex.$rash;
					$findex++;
				}

				if (is_uploaded_file($FILES_tmp_name)) {
					//создаём путь, если нужно
					if (!is_dir($files_patch.'/')) {
						$FILE_MANAGER->mkdir($files_patch.'/', SETTINGS_CHMOD_FOLDERS, true);
					}

					if ($FILE_MANAGER->copy($FILES_tmp_name, $files_patch.'/'.$NewName)) {
						$res	= $NewName;
					}
					else {
						$this->errors[]	= $MSGTEXT['management_block_no_r_for_patch2'];
					}
				}
				else  {
					$this->errors[]	= $MSGTEXT['management_block_upload_error'];
				}
			}
		}

		return  $res;
	}



	/**
	 * Запускает действие после редактирования записи из таблицы
	 * @param array $old_fields
	 * @param array $fields
	 */
	function run_After_API_Edit($old_fields, $fields, $operation) {
		GLOBAL $MYSQL_TABLE18;

		//берём информацию о таблице
		$query			= "SELECT `additional_buttons` FROM `$MYSQL_TABLE18` WHERE `table_name`='$this->current_tablename'";
		$result			= $this->mysql->executeSQL($query);
		$tables_info	= $this->mysql->fetchAssoc($result);

		if ($tables_info['additional_buttons']!='') {

			$ab			= explode("\n", $tables_info['additional_buttons']);
			foreach ($ab as $block_name) {
				$block_name			= str_replace("\r", '', $block_name);
				if (mb_strpos($block_name, ':')===false && $block_name!='') {

					include_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/After_API_Edit.php');
					$module_name	= $this->info['module_name'];

					$obj			= new After_API_Edit($module_name, $block_name, $this->mysql, $this->smarty, $this->post, $this->postr, $this->dataRow, $this->get, $this->getr, $this->gets, $this->info, $this->current_tablename, $this->current_tablename_no_prefix, $this->lang_id, $old_fields, $fields, $operation);
					if (is_array($obj->errors)) {
						$this->errors			= array_merge($this->errors, $obj->errors);
					}
				}
			}
		}
	}

}

?>