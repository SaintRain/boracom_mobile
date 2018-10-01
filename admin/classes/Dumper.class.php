<?php
/**
 * класс для вывода ошибок
 *
 */
class Dumper  {

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
   	 * @var class
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
	function Dumper($mysql, $smarty, $post, $postr, $posts, $get, $getr, $gets,  $do) {

		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		$this->post		= $post;
		$this->get		= $get;
		$this->postr	= $postr;
		$this->posts	= $posts;
		$this->getr		= $getr;
		$this->gets		= $gets;

		switch ($do):
		case ('list'): 		$this->Dumper_getlist(); 	break;
		endswitch;
	}



	/**
	 * выводит список администраторов
	 *
	 */
	function Dumper_getlist() {
		GLOBAL $MSGTEXT;

		$id			= $this->get['id'];

		if (isset($this->get['func'])) $func	= $this->get['func'];
		else $func	='list';


		switch ($id) {
			case 1: {
				switch ($func) {
					case 'list':  $zakladky_bd_content	= $this->smarty->fetch('database/database_optimization.tpl'); break;
					case 'do':   $zakladky_bd_content	= $this->optimizationDB(); break;
				} break;
			}
			case 2: {
				switch ($func) {
					case 'list': $zakladky_bd_content	= $this->smarty->fetch('database/database_indexes.tpl'); break;
					case 'do':   $zakladky_bd_content	= $this->createIndexes(); break;
				} break;
			}
			case 3: {
				switch ($func) {
					case 'list': $zakladky_bd_content	= $this->smarty->fetch('database/dumper.tpl'); break;

				} break;
			}
			case 4: {
				switch ($func) {
					case 'list': $zakladky_bd_content	= $this->showSql();  break;

				} break;
			}
			case 5: {
				switch ($func) {
					case 'list': 				$zakladky_bd_content	= $this->showSqlMaster();   break;
					case 'do':   			  	$zakladky_bd_content	= $this->showSelectSQL(); 	break;
					case 'ex_sql':   		  	$zakladky_bd_content	= $this->ex_sql(); 			break;
					case 'gen_form_fields':   	$zakladky_bd_content	= $this->gen_form_fields(); break;
				} break;
			}
		}


		$blocks[0]['virtualtagname']=$MSGTEXT['tablesconstructor_optimization'];
		$blocks[0]['id']=1;
		$blocks[1]['virtualtagname']=$MSGTEXT['tablesconstructor_create_index'];
		$blocks[1]['id']=2;
		$blocks[2]['virtualtagname']=$MSGTEXT['tablesconstructor_recovery'];
		$blocks[2]['id']=3;
		$blocks[3]['virtualtagname']=$MSGTEXT['tablesconstructor_slow_query'];
		$blocks[3]['id']=4;
		$blocks[4]['virtualtagname']=$MSGTEXT['tablesconstructor_sqlmaster'];
		$blocks[4]['id']=5;

		$zakladky	= array();
		$strl		= 0;
		$k			= 0;

		for ($i2=0; $i2<count($blocks); $i2++) {
			$virtualtagname_length	= mb_strlen($blocks[$i2]['virtualtagname']);
			$strl+=$virtualtagname_length;

			if ($strl>=150) {
				$strl=$virtualtagname_length;
				$k++;
			}

			if ($blocks[$i2]['id']==$id) {
				$selected_row=$k;
			}
			$zakladky[$k][]=$blocks[$i2];
		}

		$this->smarty->assign('content_template', 		'database/database_list.tpl');
		$this->smarty->assign('content_head', 			$blocks[$id-1]['virtualtagname']);
		$this->smarty->assign('zakladky_bd', 			$zakladky);
		$this->smarty->assign('zakladky_bd_content', 	$zakladky_bd_content);
	}



	/**
     * Выполняет пользовательский запрос
     *
     * @return string
     */
	function ex_sql() {
		GLOBAL $MSGTEXT;

		if (isset($this->postr['sql'])) {
			$query			= $this->postr['sql'] ;
			$start_time 	= microtime();
			$start_array 	= explode(' ',$start_time);
			$start_time 	= $start_array[1] + $start_array[0];

			$result			= $this->mysql->executeSQLSpy($query);

			$end_time 		= microtime();
			$end_array 		= explode(' ',$end_time);
			$end_time 		= $end_array[1] + $end_array[0];
			$time 			= round( $end_time - $start_time, 10);

			$result_affected	= $this->mysql->mysqlInfo();
			$error				= $this->mysql->getError();
			if ($total_records	= @$this->mysql->fetchAssocAll($result)) {
				$this->smarty->assign('total_records_count', 		count($total_records));
				$this->smarty->assign('total_records_text', 		print_r($total_records, true));
			}

			$this->smarty->assign('time', 				sprintf($MSGTEXT['database_was_exe_query_time_sek'], $time));
			$this->smarty->assign('result', 			$result);
			$this->smarty->assign('result_affected', 	$result_affected);
			$this->smarty->assign('sql', 	$this->post['sql']);
		}
		else {
			$error	= $MSGTEXT['database_error_empty_q'];
		}

		$this->smarty->assign('msg', 				$error);

		return $this->smarty->fetch('database/show_exe_sql_result.tpl');
	}



	/**
	 * Герерирует TPL-шаблон, который выводит форму редактирования таблицы
	 *
	 * @return string
	 */
	function gen_form_fields() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE18;

		$table_id				= $this->post['table_id'];

		//берем информацию о таблице
		$query					= "SELECT $MYSQL_TABLE18.*, $MYSQL_TABLE5.name as `module_name` FROM  `$MYSQL_TABLE18` LEFT JOIN `$MYSQL_TABLE5` ON ($MYSQL_TABLE5.id=$MYSQL_TABLE18.module_id) WHERE $MYSQL_TABLE18.id='$table_id'";
		$result					= $this->mysql->executeSQL($query);
		if ($tableInfo			= $this->mysql->fetchAssoc($result)) {
			//определяем имя редактируемой таблицы
			$table_name			= $tableInfo['table_name'];

			$query				= "SELECT * FROM `$MYSQL_TABLE17` WHERE $MYSQL_TABLE17.table_id='{$table_id}' ORDER BY $MYSQL_TABLE17.sort_index DESC";
			$result				= $this->mysql->executeSQL($query);
			$fields				= $this->mysql->fetchAssocAll($result);

			//формируем названия таблиц-источников без префикса
			$pos				= mb_strlen($tableInfo['module_name'])+1;
			foreach ($fields as $key=>$field) {
				$fields[$key]['sourse_table_name_no_prefix']=mb_substr($field['sourse_table_name'], $pos);
			}


			$this->smarty->assign('res', 		sprintf($MSGTEXT['database_for_table_form_is_create'], $table_name));
			$this->smarty->assign('fields', 	$fields);
			$form		= $this->smarty->fetch('database/generate_form_fields.tpl');

			$form		= htmlspecialchars($form, ENT_QUOTES);
			$this->smarty->assign('form', 	$form);

			$out		= $this->smarty->fetch('database/show_form_fields.tpl');

			return $out;
		}
		else {
			$this->smarty->assign('msg', $MSGTEXT['database_table_not_found']);
			return $this->showSqlMaster();
		}
	}



	/**
     * Создает SQL-запрос выборки для указанной таблицы
     *
     * @return TEXT
     */
	function showSelectSQL() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE17, $MYSQL_TABLE18, $MYSQL_TABLE3;

		$table_id				= $this->post['table_id'];

		//берем информацию о таблице
		$query					= "SELECT $MYSQL_TABLE18.*, $MYSQL_TABLE5.name as `module_name` FROM  `$MYSQL_TABLE18` LEFT JOIN `$MYSQL_TABLE5` ON ($MYSQL_TABLE5.id=$MYSQL_TABLE18.module_id) WHERE $MYSQL_TABLE18.id='$table_id'";
		$result					= $this->mysql->executeSQL($query);
		if ($tableInfo			= $this->mysql->fetchAssoc($result)) {
			//определяем имя редактируемой таблицы
			$table_name			= $tableInfo['table_name'];

			$query				= "SELECT $MYSQL_TABLE17.*, $MYSQL_TABLE18.id as `sourse_table_id`, $MYSQL_TABLE18.table_name, f.id as `sourse_field_id`, m.id AS `module_id`, m.name AS `module_name` FROM `$MYSQL_TABLE17`
			LEFT JOIN (`$MYSQL_TABLE18`) on ($MYSQL_TABLE18.table_name=$MYSQL_TABLE17.sourse_table_name) 
			LEFT JOIN `$MYSQL_TABLE17` as `f` on (f.fieldname=$MYSQL_TABLE17.sourse_field_name AND f.table_id=$MYSQL_TABLE18.id) 
			LEFT JOIN `$MYSQL_TABLE17` as `fpk` on (fpk.pk=1 AND fpk.table_id=f.table_id) 
			LEFT JOIN `$MYSQL_TABLE5` as `m` on (m.id=$MYSQL_TABLE18.module_id) 
			
			WHERE $MYSQL_TABLE17.table_id='{$table_id}' ORDER BY $MYSQL_TABLE17.sort_index DESC";

			$result				= $this->mysql->executeSQL($query);
			$fields				= $this->mysql->fetchAssocAll($result);


			$left_join			= '';
			$sel_fields_join	= '';
			$t					= 2;
			if (isset($this->post['split'])) $rn	= SETTINGS_NEW_LINE;
			else $rn		= ' ';

			$prefix			= '{$this->tablePrefix}';
			$mname_length	= mb_strlen($tableInfo['module_name'])+1;
			foreach ($fields as $f) {
				if ($f['pk']==1) {
					$pk_left_join	= $f['fieldname'];
					break;
				}
			}

			$select_sql2='';
			foreach ($fields as $f) {
				//если мультиселект
				if ($f['edittype_id']==4) {
					$select_sql2.="\r\n\r\nSELECT t2.* FROM `".'$MYSQL_TABLE13'."` AS `t` {$rn}LEFT JOIN `{$f['sourse_table_name']}` AS `t2` ON (t2.id=t.value_id) {$rn}WHERE t.field_id='' AND t.data_id='' ORDER BY t2.sort_index DESC";
				}
				else if ($f['edittype_id']==13) {
					$left_join.= "{$rn}LEFT JOIN ".'`$MYSQL_TABLE3`'." AS `t{$t}` ON (t{$t}.id=t.{$f['fieldname']})";
					$sel_fields_join.=",{$rn}t{$t}.{$f['sourse_field_name']} AS `{$f['fieldname']}_caption` ";
					$t++;
				}
				else if ($f['sourse_field_name']!='' && $f['edittype_id']!=14 && $f['edittype_id']!=15) {
					if ($f['module_id']!=$tableInfo['module_id']) {
						$s_t		= $f['sourse_table_name'];
					}
					else {
						$s_t		= $prefix.mb_substr($f['sourse_table_name'], $mname_length);
					}
					$left_join.= "{$rn}LEFT JOIN `$s_t` AS `t{$t}` ON (t{$t}.$pk_left_join=t.{$f['fieldname']})";
					$sel_fields_join.=",{$rn}t{$t}.{$f['sourse_field_name']} AS `{$f['fieldname']}_caption` ";
					$t++;

				}
			}
			$t_n			= $prefix.mb_substr($table_name, $mname_length);
			$select_sql		= "SELECT t.*{$sel_fields_join}{$rn}FROM `$t_n` AS `t` $left_join{$rn}ORDER BY t.sort_index DESC".$select_sql2;

			$this->smarty->assign('res', 			sprintf($MSGTEXT['database_for_table_sql_is_create'], $table_name));
			$this->smarty->assign('select_sql', 	$select_sql);
			return $this->smarty->fetch('database/show_select_sql.tpl');
		}
		else {
			$this->smarty->assign('msg', $MSGTEXT['database_table_not_found']);
			return $this->showSqlMaster();
		}

	}



	/**
	 * Выводит форму мастера запросов
	 *
	 * @return TEXT
	 */
	function showSqlMaster() {
		GLOBAL $MYSQL_TABLE18;

		$query				= "SELECT `table_name`, `id` FROM `$MYSQL_TABLE18` ORDER BY `table_name`";
		$result				= $this->mysql->executeSQL($query);
		$all_tables			= $this->mysql->fetchAssocAll($result);
		$this->smarty->assign('all_tables', $all_tables);

		return $this->smarty->fetch('database/show_sql_master.tpl');
	}



	/**
     * Вывод 20 самых медленных запросов
     *
     */
	function showSql() {
		GLOBAL $MSGTEXT;

		include_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/logs/SqlLog.php');

		if (isset($LOG_QUERIES)) {
			uasort($LOG_QUERIES, array('Dumper', 'cmp'));
			$LOG_QUERIES	= array_slice($LOG_QUERIES, 1, 20);
		}
		else {
			$LOG_QUERIES	= array();
		}

		$this->smarty->assign('sqls', $LOG_QUERIES);
		return $this->smarty->fetch('database/show_sql.tpl');
	}



	/**
	 * Сортировка массива
	 *
	 * @param array $sql
	 * @param array $sql2
	 * @return int
	 */
	function cmp($sql, $sql2) {
		$a	= $sql['time'];
		$b	= $sql2['time'];

		if ($a == $b) {
			return 0;
		}
		return ($a > $b) ? -1 : 1;
	}



	/**
	 * Выполняет оптимизацию БД
	 *
	 */	
	function optimizationDB() {
		GLOBAL $MSGTEXT;

		$start_time 	= microtime();
		$start_array 	= explode(' ',$start_time);
		$start_time 	= $start_array[1] + $start_array[0];

		$num	= 0;
		$ret	= '';
		$result = $this->mysql->listTables();
		while ($ress = $this->mysql->fetchArray($result)) {
			$ret .= '`'.$ress[0].'`,';
			$num ++;
		}
		$ret=mb_substr($ret,0,-1);

		$optimiz = "OPTIMIZE TABLE $ret";
		$this->mysql->executeSQL($optimiz);

		$end_time 	= microtime();
		$end_array 	= explode(' ',$end_time);
		$end_time 	= $end_array[1] + $end_array[0];
		$time 		= round($end_time - $start_time, 4);
		$message 	= sprintf($MSGTEXT['tablesconstructor_mess_optimiz'], $num,$time);
		return $message;
	}



	/**
	 * Создание индексов в БД
	 *
	 */	
	function createIndexes() {
		GLOBAL $MSGTEXT;

		include_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/logs/SqlLog.php');

		if (!isset($LOG_QUERIES)) {
			$LOG_QUERIES=array();
		}


		$k=0;
		$ind=0;
		foreach ($LOG_QUERIES as $sql=>$v)	 	 {

			$sql	= ltrim($sql);
			if  (mb_strtoupper(mb_substr($sql,0,6))=='SELECT') {
				$k++;

				$sql		= $this->cleanSql($sql);

				$tables		= $this->getRealTablesNames($sql);

				if (!is_array($tables)) $TableName = $tables;
				else  $TableName=null;

				$constructs	= $this->findFieldsConstructs($sql);

				$fields		= $this->getFields($constructs, $TableName);

				$indexes = array();
				foreach ($fields as $t=>$field) {
					if ($TableName!=null && $TableName!='') $indexes[$TableName]=$field;
					else {
						if (isset($tables[$t])) $indexes[$tables[$t]]=$field;
						else {
							if ($t!='')	$indexes[$t]=$field;
						}
					}
				}

				$ind=$ind+$this->createAlterQuery($indexes);
			}
		}
		if ($ind>0) return sprintf($MSGTEXT['tablesconstructor_mess_create_ind'], $ind);

		return $MSGTEXT['tablesconstructor_mess_create'];
	}



	/**
	 * Возвращает подготовленный запрос для парсинга
	 * 
	 */
	function cleanSql($sql) {

		$bad_symbols	= array('\\\'', '\"', '(',')',',','`', "\t", "\r", "\n");
		$sql			= str_replace($bad_symbols,'',$sql);

		$bad_data 		=  array("/'(.*?)'/", "/\"(.*?)\"/u");
		$sql			=  preg_replace($bad_data,"''",$sql);

		return $sql;
	}



	/**
	 *  Находи конструкции, где встречаются поля
	 */
	function findFieldsConstructs($sql) {
		$pattern	= "/([\w\.\-]*?) *[=><] *(['\w\.\-]*?) */u";
		$constructs = array();
		preg_match_all($pattern,$sql,$constructs, PREG_SET_ORDER );
		return $constructs;
	}



	/**
	 * Получает из конструкции поля
	 *
	 * @param array $constructs
	 * @param string $TableName
	 * @return array
	 */
	function getFields($constructs, $TableName) {
		$fiedls = array();

		foreach ($constructs as $c) {

			$part1	= $c[1];
			$part2	= $c[2];

			$t1		= explode('.',$part1);
			if (isset($t1[1])) $fiedls[$t1[0]][$t1[1]]=true;
			else $fiedls[$TableName][$t1[0]]=true;

			if ($part2!='') {
				if (!is_numeric($part2) && $part2!="''") {
					$t2		= explode('.',$part2);
					if (isset($t2[1])) $fiedls[$t2[0]][$t2[1]]=true;
					else $fiedls[$TableName][$t2[0]]=true;
				}
			}
		}
		return $fiedls;
	}



	/**
	 * Получает реальные имена таблиц
	 *
	 * @param string $sql
	 * @return array
	 */
	function getRealTablesNames($sql) {
		$tables=array();
		$pattern	= "/([\w\.\-]*?) *AS *([\w\.\-]*?) /iu";
		$pattern2	= "/ FROM *([\w\.\-]*?) /iu";
		$k			= preg_match_all($pattern, $sql, $temp, PREG_SET_ORDER );

		if ($k>0) {
			foreach ($temp as $t) {
				if (isset($t[2])) {

					if (mb_strpos($t[1],'.')===false) {
						$tables[$t[2]]=$t[1];
					}
				}
			}
		}
		else {
			preg_match_all($pattern2, $sql, $temp, PREG_SET_ORDER);
			if (isset($temp[0][1])) $tables	= $temp[0][1];
		}

		return $tables;
	}



	/**
	 * Создает и выполняет запрос на создание индекса
	 *
	 * @param array $indexes
	 * @return int
	 */
	function createAlterQuery($indexes) {
		$ind=0;
		foreach ($indexes as $t=>$fields) {
			$temp=array();
			foreach ($fields as $key=>$v) {
				$temp[]=$key;
				$index_name	= implode('_', $temp);
				$f			= implode(',', $temp);
				$query		= 'ALTER TABLE `'.MYSQL_DATABASE."`.`$t` ADD INDEX `$index_name` ($f)";
				if ($result	= $this->mysql->executeSQLSpy($query)) $ind++;
			}
		}
		return $ind;
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