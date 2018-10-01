<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Класс создание бекофиса для модулей
*////////////////////////////////////////////////////////////////////////////////////////////

class Management {

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
	private		$posts;

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
	private		$gets;

	/**
     * Сообщения об ошибках 
     *
     * @var array
     */
	public 		$errors;

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
	private		$info;


	/**
	 * Имя текущей таблицы с которой работает класс без префикса
	 *
	 * @var string
	 */
	private 	$current_tablename_no_prefix;

	/**
	 * Имя текущей таблицы с которой работает класс
	 *
	 * @var string
	 */
	private 	$current_tablename;

	/**
	 * id - языка на котором выводится материал
	 *
	 * @var int
	 */
	private 	$lang_id;

	/**
	 * id - языка для использования в запросе
	 *
	 * @var int
	 */
	private 	$lang_id_sql;

	/**
     * Расположение шаблонов управления
     *
     * @var string
     */
	private		$tplLocation;

	/**
	 * Объект для работы с API-функциями
	 *
	 * @var object
	 */
	private 	$API;

	/**
	 * Промежуточная переменная содержит названия артикулов таблиц
	 *
	 * @var array
	 */
	private $tablesArticles;


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
	 */
	function __construct ($mysql=NULL, $smarty=NULL, $post=NULL, $postr=NULL, $posts=NULL, $get=NULL, $getr=NULL, $gets=NULL, $info=NULL, $lang_id=NULL) {
		GLOBAL $MYSQL_TABLE7, $MYSQL_TABLE18;

		$this->mysql		= $mysql;
		$this->post			= $post;
		$this->postr		= $postr;
		$this->posts		= $posts;
		$this->get			= $get;
		$this->getr			= $getr;
		$this->gets			= $gets;
		$this->smarty		= $smarty;
		$this->info 		= $info;

		if (isset($this->get['lang_id'])) {
			$this->lang_id=$this->get['lang_id'];
			$this->lang_id_sql	= $lang_id;
		}
		else {
			$this->lang_id		= $lang_id;
			//если язык не выбран явно
			if ($this->lang_id==0) {
				$this->lang_id_sql	= '0 OR t.lang_id IS NULL';
			}
			else {
				$this->lang_id_sql	= $lang_id;
			}
		}


		//определяем имя основной таблицы, которую блок редактирует по умолчанию
		if (!isset($this->get['t_name']) || $this->get['t_name']=='') {
			$this->current_tablename		= $this->info['table_name'];  	//редактируемая таблица
		}
		else {
			$this->current_tablename		= $this->get['t_name'];  		//редактируемая таблица
		}

		$this->current_tablename_no_prefix	= mb_substr($this->current_tablename, mb_strlen($this->info['module_name'])+1); //имя редактируемой таблицы без префикса
		$this->tplLocation					= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/templates/management_templates/';

		//подключаем API-функции
		include_once ($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/API.php');
		$this->API = new API($this->mysql, $this->smarty, $this->post, $this->postr, $this->posts, $this->get, $this->getr, $this->gets, $this->info, $this->current_tablename, $this->current_tablename_no_prefix, $this->lang_id, true, $this->posts);


		if (isset($this->get['mdo']))    {
			$mdo	= $this->get['mdo'];
		}
		else {
			$mdo	= 'form_data';  		//действие по умолчанию
		}

		switch ($mdo):
		case ('backupXLSresult'):		$this->backupXLSresult(); 		break;	//восстанавливаем или удаляем таблицу после импорта xls-файла
		case ('form_data'):				$this->formData(); 				break;	//вывод формы редактирование таблицы
		case ('saveedit'):				$this->saveedit(); 				break;  //сохранение редактирования таблицы
		case ('photos_form'):			$this->photosForm(); 			break;	//вывод формы редактирования изображений в новом окне
		case ('photos_edit'):			$this->photosUpdate(); 			break;  //сохранение редактирования изображений
		case ('photos_save_desc'):		$this->photosSaveDescription(); break;  //сохранение индексов, описания изображений
		case ('setStatus'):				$this->setStatus(); 			break;	//меняем статус checkbox для записи
		case ('popup_form'):			$this->PopupForm(); 			break;	//вывод формы редактирования текста в новом окне
		case ('popup_save'):			$this->PopupUpdate(); 			break;	//сохранение редактирования текста в новом окне
		case ('files_form'):			$this->filesForm(); 			break;	//вывод формы редактирования файлов в новом окне
		case ('files_edit'):			$this->filesUpdate(); 			break; 	//сохранение редактирования файлов в новом окне
		case ('files_save_desc'):		$this->filesSaveDescription(); 	break;  //сохранение индексов, описания изображений
		case ('updaterows'):			$this->updaterows(); 			break;	//мульти-обновление индексов сортировки и удаление выбраных записей
		endswitch;
	}



	/**
	 * Восстанавливаем или удаляем таблицу после импорта xls-файла		
	 *
	 */
	function backupXLSresult() {
		GLOBAL $GENERAL_FUNCTIONS, $MYSQL_TABLE13;

		$t_name					= $this->get['t_name'];
		$query					= "SHOW TABLES LIKE '\_\_{$t_name}'";
		$result					= $this->mysql->executeSQL($query);
		list($t_name_restore)	= $this->mysql->fetchRow($result);

		if ($t_name_restore!='') {

			if ($_GET['chancel']==1) {

				$query	= "DROP TABLE `{$t_name}`";
				if ($result	= $this->mysql->executeSQL($query)) {

					$query	= "RENAME TABLE `__{$t_name}` TO `{$t_name}`";
					$result	= $this->mysql->executeSQL($query);
				}

				$query	= "DROP TABLE `{$MYSQL_TABLE13}`";
				if($result	= $this->mysql->executeSQL($query)) {
					$query	= "RENAME TABLE `__{$MYSQL_TABLE13}` TO `{$MYSQL_TABLE13}`";
					$result	= $this->mysql->executeSQL($query);
				}
			}
			else {
				$query	= "DROP TABLE `__{$t_name}`";
				if ($result	= $this->mysql->executeSQL($query)) {

					$query	= "DROP TABLE `__{$MYSQL_TABLE13}`";
					$result	= $this->mysql->executeSQL($query);
				}
			}
		}

		$tmp	= array();
		foreach ($_SESSION['___GoodCMS']['t_backup'] as $t) {
			if ($t_name!=$t && $MYSQL_TABLE13!=$t)	$tmp[]	= $t;
		}
		$_SESSION['___GoodCMS']['t_backup']	= $tmp;


		if (isset($this->get['fastEdit'])) $fastEdit	= '&fastEdit=true';
		else $fastEdit='';

		if (isset($this->get['lang_id'])) $lang_id		= '&lang_id=true';
		else $lang_id='';

		if (isset($this->get['hide_menu'])) $hide_menu	= '&hide_menu=true';
		else $hide_menu='';

		if (isset($this->get['id'])) $id				= '&id='.$this->get['id'];
		else $id='';

		if (isset($this->get['sort_type'])) $sort_type	= '&sort_type='.$this->get['sort_type'];
		else $sort_type='';

		if (isset($this->get['sort_by'])) $sort_by		= '&sort_by='.$this->get['sort_by'];
		else $sort_by='';

		$GENERAL_FUNCTIONS->gotoURL("?act=modules&do=managedata&page_id={$this->get['page_id']}&tag_id={$this->get['tag_id']}&mdo=form_data{$id}&p={$this->get['p']}{$sort_by}{$sort_type}{$hide_menu}{$fastEdit}{$lang_id}&t_name={$this->get['t_name']}");

		exit;
	}



	/**
	 * Формирует часть sql-запроса из фильтра
	 *
	 * @param array $data_filter
	 * @param array $dfilter
	 * @param array $fieldinfo_by_name
	 * @return array
	 */
	function generateSQLPartFromFilter($data_filter, $dfilter, $fieldinfo_by_name) {
		GLOBAL $MYSQL_TABLE13;

		$where				= '';
		$filter_query		= '';
		$ms_table_include	= '';

		foreach ($dfilter as $field => $value) {
			if (mb_strpos($value,'|')!==false) {

				$v	= explode('|', $value);
				$data_filter[$this->current_tablename][$field]=$v;

				if (isset($v[0]) && $v[0]!='') $d1	= " t.$field>='{$v[0]}' AND";
				else $d1	= '';

				if (isset($v[1]) && $v[1]!='') $d2	= " t.$field<='{$v[1]}' AND";
				else $d2	= '';
				$filter_query.=$d1.$d2;
			}
			else {
				//если мультиселект ищем ID среди списка
				if ($fieldinfo_by_name[$field]['edittype_id']==4) {
					$filter_query.=" (t.$field = ms.field_id AND t.id=ms.data_id AND ms.value_id='$value') AND";
					$ms_table_include=", `$MYSQL_TABLE13` AS `ms`"; //возвращаем переменную по которой подключаем таблицу мультисписков $MYSQL_TABLE13
				}
				else {
					$filter_query.=" t.$field='$value' AND";
				}
			}
		}
		if ($filter_query!='') {
			$filter_query					= mb_substr($filter_query, 0, -3);
			if ($where!='') $filter_query	= $filter_query.' AND ';
		}

		return 	array($filter_query, $where, $data_filter, $ms_table_include);
	}



	/**
    * Формирует форму редактирования данных таблицы
    *
    */
	function formData() {
		GLOBAL $CMSProtection, $MSGTEXT, $GENERAL_FUNCTIONS, $MODULES_PATH, $MYSQL_TABLE3, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE9, $MYSQL_TABLE11, $MYSQL_TABLE12, $MYSQL_TABLE13, $MYSQL_TABLE16, $MYSQL_TABLE17, $MYSQL_TABLE18;

		$search				= false;
		$search_by_field	= '';
		$search_by_rule		= '';
		$where				= '';
		$ms_table_include	= '';
		$multiselect_fields	= array();

		//берем все таблицы модуля
		$allBlockTables		= array();
		$module_blocksTables= array();
		//$query				= "SELECT * FROM `$MYSQL_TABLE18` WHERE `module_id`='{$this->info['module_id']}' ORDER BY `sort_index`";
		$query				= "SELECT * FROM `$MYSQL_TABLE18` ORDER BY `sort_index`";
		$result				= $this->mysql->executeSQL($query);
		while ($row			= $this->mysql->fetchAssoc($result)) {
			$allBlockTables[$row['table_name']] = $row;
			if ($row['module_id']==$this->info['module_id']) {
				$module_blocksTables[$row['table_name']]=$row;
			}
		}
		


		//определяем ID редактируемой таблицы
		$table_id			= $allBlockTables[$this->current_tablename]['id'];

		//берем все поля редактируемой таблицы
		$fields				= array();
		$fieldinfo_by_name	= array();
		$multyFields		= array(); 	//содержит поля стипом редактирования мультиселект
		$captions_tables	= '';		//часть запроса, которая хранит названия связных таблиц
		$captions_fields	= '';		//часть запроса, которая хранит подгружаемые значения из списков
		$cap_id				= 2;		//порядковый номер алиаса таблицы

		$query				= "SELECT $MYSQL_TABLE17.*, $MYSQL_TABLE18.id as `sourse_table_id`, $MYSQL_TABLE18.table_name, f.id as `sourse_field_id` FROM `$MYSQL_TABLE17` LEFT JOIN (`$MYSQL_TABLE18`) on ($MYSQL_TABLE18.table_name=$MYSQL_TABLE17.sourse_table_name) LEFT JOIN `$MYSQL_TABLE17` as `f` on (f.fieldname=$MYSQL_TABLE17.sourse_field_name AND f.table_id=$MYSQL_TABLE18.id) WHERE $MYSQL_TABLE17.table_id='{$table_id}' ORDER BY $MYSQL_TABLE17.sort_index DESC";
		$result				= $this->mysql->executeSQL($query);
		while ($row			= $this->mysql->fetchAssoc($result)) {
			$fields[]		= $row;
			$fieldinfo_by_name[$row['fieldname']]	= $row;		 //находим название поля первичного ключа для таблицы

			if ($row['sourse_table_name']!='') {
				$cap_id++;
				if ($row['show_in_list']) {
					if ($row['edittype_id']==4) {				//если мультиселект, тогда запоминаем поле
						$multyFields[]	= $row;
					}
					else {
						//формируем части запроса для подгрузки значений из связных таблиц
						$captions_tables.=" LEFT JOIN `{$row['sourse_table_name']}` AS `t{$cap_id}` ON (t{$cap_id}.id=t.{$row['fieldname']})";
						$captions_fields.=" t{$cap_id}.{$row['sourse_field_name']} AS `{$row['fieldname']}_caption`,";
					}
				}
			}
		}

		$pk_incr_fieldname	= $GENERAL_FUNCTIONS->getTablePkIncrFieldName($this->current_tablename);


		//устанавливаем ключ фильтра выборки т.к. взависимости от окна может быть разная фильтрация
		if (isset($this->gets['own_f_name']) && !isset($this->gets['f_name'])) {
			$opener_f_name		=  $this->gets['own_f_name'];
		}
		else {
			$opener_f_name		= '';
		}

		$data_filter_caption	= 'data_filter'.$opener_f_name;

		//обрабатываем фильтр отображения записей
		if (isset($this->get['clean_filter'])) {
			$_SESSION['___GoodCMS'][$data_filter_caption]	= array();
			$data_filter	=	 array();
		}
		elseif (isset($_SESSION['___GoodCMS'][$data_filter_caption]))  {
			$data_filter	= eval($_SESSION['___GoodCMS'][$data_filter_caption]);
		}
		else  $data_filter	= array();

		if (isset($this->get['filterfield'])) {
			if ($this->get['filtervalue']!='') {
				$data_filter[$this->current_tablename][$this->get['filterfield']]=$this->get['filtervalue'];
			}
			else if (isset($data_filter[$this->current_tablename][$this->get['filterfield']])) unset($data_filter[$this->current_tablename][$this->get['filterfield']]);
		}

		$_SESSION['___GoodCMS'][$data_filter_caption] = 'return '.var_export($data_filter, true).';';

		$filter_query = '';
		if (isset($data_filter[$this->current_tablename])) {
			$dfilter	= $data_filter[$this->current_tablename];
			list($filter_query, $where, $data_filter, $ms_table_include)	= $this->generateSQLPartFromFilter($data_filter, $dfilter, $fieldinfo_by_name);
		}

		$_SESSION['___GoodCMS']['filterQuery'] 	= $filter_query.' '.$where;

		//если блок типа запись
		if ($this->info['block_type']==2) {

			//поиск одной записи
			if (isset($this->get['search']) && $this->get['search']!='') {
				//определяем ID таблицы
				$search_table_id				= $allBlockTables[$this->get['t_name']]['id'];
				$search_pk						= $GENERAL_FUNCTIONS->getTablePkIncrFieldName($this->get['t_name']);
				$this->post['search']			= $this->posts['search']			= $this->get['search'];

                if (isset($this->gets['search_by_field'])) {
                    $this->posts['search_by_field']	= $this->gets['search_by_field'];
                }
                else {
                    $this->post['search_by_field']	= $this->posts['search_by_field']	= $search_pk;
                }

				$this->get['id']				    = $this->get['search'];
			}

			//обработка поиска записей по выбранному полю
			if (isset($this->get['clean_seacrh'])) {
				unset($_SESSION['___GoodCMS']['data_search'][$this->current_tablename]);
			}
			elseif (isset($this->posts['search']) && $this->posts['search']!='') {

				$search				= $this->posts['search'];
				$search_by_field	= $this->posts['search_by_field'];
				if (isset($this->posts['search_by_rule'])) {
					$search_by_rule	= $this->posts['search_by_rule'];
				}
				else {
					$search_by_rule	= 1;
				}

				//определяем правило поиска
				$search_rule		= $this->getRuleSearch($search_by_rule, $search);

				$edittype			= 0;
				$field_id			= 0;
				$v					= $fieldinfo_by_name[$search_by_field];

				$edittype	= $v['edittype_id'];
				$field_id	= $v['id'];
				if ($v['sourse_field_name']!='') {
					$pk				= $GENERAL_FUNCTIONS->getTablePkIncrFieldName($v['sourse_table_name']);

					//находим записи
					$query			= "SELECT t.$pk FROM `{$v['sourse_table_name']}` AS `t` WHERE (t.lang_id={$this->lang_id_sql}) AND t.{$v['sourse_field_name']} LIKE $search_rule ORDER BY t.sort_index DESC";
					$result			= $this->mysql->executeSQL($query);
					if	($res 		= $this->mysql->fetchRowAll($result)) {
						$search		= $res;
					}
				}
				//ищем среди страниц админки
				elseif ($v['edittype_id']==13)	{
					$query			= "SELECT `id` FROM `$MYSQL_TABLE3` WHERE `name` LIKE $search_rule OR `description` LIKE $search_rule ORDER BY `sort_index` DESC";
					$result			= $this->mysql->executeSQL($query);
					if	($res 		= $this->mysql->fetchRowAll($result)) {
						$search		= $res;
					}
				}

				if (isset($this->gets['fastEdit'])) {
					$fastEdit=1;
				}
				else {
					$fastEdit=0;
				}

				//сохраняем условия поиска в сессию, чтоб потом использовать
				$_SESSION['___GoodCMS']['data_search'][$this->current_tablename]	= 'return '.var_export(array('search_by_field'=>$search_by_field, 'search_by_rule'=>$search_by_rule, 'search'=>$search, 'keywords'=>$this->post['search'], 'edittype'=>$edittype, 'field_id'=>$field_id, 'fastEdit'=>$fastEdit), true).';';
			}

			//формируем из сессии запрос на выбору записей по заданному поиску
			if (isset($_SESSION['___GoodCMS']['data_search'][$this->current_tablename]) && !isset($this->get['filter_for_table'])) {

				$data_search		= eval($_SESSION['___GoodCMS']['data_search'][$this->current_tablename]);

				//очищаем переход с быстрого редактирования
				if (!isset($this->gets['fastEdit']) && isset($data_search['fastEdit']) && $data_search['fastEdit']) {
					unset($_SESSION['___GoodCMS']['data_search']);	//очищаем поиск
				}
				else {
					$search_query		= '';
					$field				= $data_search['search_by_field'];
					$search 			= $data_search['keywords'];
					$search_by_field	= $data_search['search_by_field'];
					$search_by_rule 	= $data_search['search_by_rule'];
					$value   			= $data_search['search'];
					$field_id  			= $data_search['field_id'];
					$edittype			= $data_search['edittype'];

					//если ищем по первичному ключу
					if ($field==$pk_incr_fieldname) {

						//проверяем, чтоб для поиска были заданы корректные индексы
						$bad_indexes	= false;
						$value2			= explode(',', str_replace(' ', '', $value));
						foreach ($value2 as $v2) {
							if (!is_numeric($v2) && !mb_strpos($v2, '.')) {
								$bad_indexes	= true;
								break;
							}
						}

						if (!$bad_indexes) {
							$search_query.=" t.$field IN ($value) ";
						}
					}
					elseif (is_array($value) || $edittype==4) {

						$s	= '';
						if ($data_search['edittype']!=4) {
							foreach ($value as $val) {
								if (is_numeric($val[0]) && !mb_strpos($val[0], '.')) {
									$s.="'{$val[0]}',";
								}
							}
							if ($s!='')	 {
								$s	=	mb_substr($s, 0, -1);
								$search_query.=" t.$field IN ($s) ";
							}
						}
						else {

							//обрабатываем поиск для поля с типом редактирования MultySelect
							if (is_array($value)) {
								$val_ids		= array();
								foreach ($value as $val) {
									if (is_numeric($val[0]) && !mb_strpos($val[0], '.')) {
										$val_ids[]	= $val[0];
									}
								}
								if (count($val_ids)>0) {
									$val_ids	= implode(',', $val_ids);
								}
								else {
									$val_ids	= '';
								}
							}
							else {
								//проверяем, чтоб было целое число
								if (is_numeric($value) && !mb_strpos($value, '.')) {
									$val_ids	= $value;
								}
								else {
									$val_ids	= false;	//ставим ноль, чтоб выдавало пустой результат
								}
							}

							if ($val_ids && $val_ids!='') {
								//берем число всех записей, удовлетворяющих запросу
								$data_ids			= array();
								$query				= "SELECT `data_id` FROM `$MYSQL_TABLE13` WHERE `field_id`='$field_id' AND `value_id` IN ($val_ids)";
								$result				= $this->mysql->executeSQL($query);
								while ($row			= $this->mysql->fetchAssoc($result)) {
									$data_ids[]		= $row['data_id'];
								}

								if (count($data_ids)>0)	 {
									$data_ids		= implode(',', $data_ids);
									$search_query	= "t.id IN ($data_ids)";
								}
								else {
									$search_query	= "t.id IN (0)"; //ставим ноль, чтоб выдавало пустой результат
								}
							}
							else {
								$search_query		= "t.id IN (0)"; //ставим ноль, чтоб выдавало пустой результат
							}
						}
					}
					else {
						//определяем правило поиска
						$search_rule  = $this->getRuleSearch($search_by_rule, $value);
						$search_query.=" t.$field LIKE $search_rule ";
					}

					if ($search_query!='') {
						$where				= $search_query;
						$search				= $data_search['keywords'];
						$search_by_field	= $field;
					}
				}
			}


			//определяем сортировку
			$currentData	= array();
			$step			= SETTINGS_RECORDS_FOR_PAGE;
			if (isset($this->get['sort_by'])) {
				$sort		= $GENERAL_FUNCTIONS->getSortVariables('sort_index');
			}
			else {
				$sort['sort_type']							= 'low';
				$sort['sort_by']							= 'sort_index';
				$_SESSION['___GoodCMS']['SORT_BY_FIELD']	= $sort['sort_by'];
			}

			if ($sort['sort_by']=='sort_index') {
				if ($sort['sort_type']=='low') $DESC_TOTAL='DESC';
				else $DESC_TOTAL	= '';
			}
			else $DESC_TOTAL		= 'DESC';

			//добавляем связки к запросу
			if ($filter_query!='' && $where=='') $filter_query	= ' AND '.$filter_query;
			elseif ($filter_query=='' && $where!='') $where		= ' AND '.$where;
			else if ($filter_query!='' && $where!='') {
				$where			= ' AND '.$where;
				$filter_query	= ' AND '.$filter_query;
			}


			//подгружаем все записи для обновления
			if (isset($this->gets['own_f_name'])) {
				$sel_own_caption	= $this->gets['own_f_name'];
				$opener_f_name		= $this->gets['opener_f_name'];
				$own_f_name			= '';

				//проверяем, вдруг записи являются категориями
				$query						= "SELECT `fieldname` FROM `$MYSQL_TABLE17` WHERE `sourse_table_name`='{$this->current_tablename}' AND `table_id`='{$allBlockTables[$this->current_tablename]['id']}' AND `edittype_id`!=14 AND `edittype_id`!=15 AND `edittype_id`!='4'";
				$result						= $this->mysql->executeSQL($query);
				if (list($tree_parent)		= $this->mysql->fetchRow($result)) {

					$own_dop_select	=",t.$tree_parent";
				}
				else {
					$own_dop_select	= '';
					$tree_parent	= false;
				}


				//проверяем, есть ли в таблице поле типа трансилт
				$sourse_table_id	= $allBlockTables[$this->current_tablename]['id'];
				list($sfnt_caption, $sourse_field_name_translite)=$this->getArticleField($sourse_table_id, $sel_own_caption);

				$ownDataList		= array();
				$firs_parent_value	= false;
				$query				= "SELECT t.id, t.{$sel_own_caption} AS `text value` $own_dop_select $sourse_field_name_translite FROM `{$this->current_tablename}` AS `t` $ms_table_include  WHERE (t.lang_id={$this->lang_id_sql}) $filter_query $where ORDER BY `id`";
				$result				= $this->mysql->executeSQL($query);
				while ($row			= $this->mysql->fetchAssoc($result)) {
					if (isset($row[$sfnt_caption])) {
						$row['text value']		 = $row[$sfnt_caption].' '.$row['text value'];
					}
					if (!$firs_parent_value && $tree_parent) {
						$firs_parent_value	= $row[$tree_parent];
					}
					$ownDataList[]		= $row;
				}
				if (!$firs_parent_value) $firs_parent_value=0;
				if (isset($this->gets['filtervalue']) && ($this->gets['filtervalue']=='')) {
					$firs_parent_value=0;
				}

				$ownDataList		= $GENERAL_FUNCTIONS->addSlashesToObjectIfNeed($ownDataList);				//экранируем опасные символы

				if ($tree_parent) {
					$ownDataList 	= $this->makeTreeSimple($ownDataList, 'id', 'text value', $tree_parent, $sel_own_caption,  $firs_parent_value, -1);
				}


				$ownDataList		= $GENERAL_FUNCTIONS->get_javascript_array($ownDataList, 'ownDataList'); 	//формируем JS массив
			}
			else {
				$ownDataList		= array();
				$opener_f_name		= '';
			}


			//берем число всех записей, удовлетворяющих запросу
			$query				= "SELECT count(*) FROM `{$this->current_tablename}` AS `t` $ms_table_include WHERE (t.lang_id={$this->lang_id_sql}) $filter_query $where";
			$result				= $this->mysql->executeSQL($query);
			list($allDataCount)	= $this->mysql->fetchRow($result);

			$needData							= array();
			$page_prev							= 0;
			$p_selected							= 1;
			$pages_navigations['p_selected']	= 0;
			$pages_navigations['page_count']	= 0;
			$pages_navigations['records_count']	= $allDataCount;

			while (count($needData)==0 && $allDataCount>0) {
				//определяем с какого номера брать записи
				if (isset($this->get['p']))	$p_selected = $this->get['p']-$page_prev;
				else	$p_selected=1;

				$page_count	= ceil($allDataCount/$step);
				$start		= ($p_selected-1)*$step;
				if ($start<0) $start = 0;

				$pages_navigations['p_selected']	= $p_selected;
				$pages_navigations['page_count']	= $page_count;
				$pages_navigations['records_count']	= $allDataCount;

				if ($sort['sort_type']=='low') $DESC = 'DESC';
				else $DESC ='';

				if (!isset($this->get['create_report'])) $order = " ORDER BY t.{$sort['sort_by']} $DESC LIMIT $start, $step";
				else $order = " ORDER BY t.{$sort['sort_by']} $DESC";


				//берем записи, которые нужно отобразить на странице
				$query		= "SELECT $captions_fields t.* FROM `{$this->current_tablename}` AS `t` $captions_tables $ms_table_include WHERE (t.lang_id={$this->lang_id_sql}) $filter_query $where $order";
				
				$result		= $this->mysql->executeSQL($query);
				$needData	= $this->mysql->fetchAssocAll($result);

				//подгружаем списки для мульиселекта
				if (count($multyFields)>0) {
					$needData = $this->getMultiDate($needData, $multyFields);
				}

				$page_prev++;
			}
		}
		//берем данные для блока типа Запись
		else {
			//берем записи, которые нужно отобразить на странице
			if ($filter_query=='') $filter_query=' WHERE ';
			else $filter_query.='AND';
			$query		= "SELECT t.* FROM `{$this->current_tablename}` AS `t` $filter_query t.page_id='{$this->get['page_id']}' AND t.tag_id='{$this->get['tag_id']}' AND (t.lang_id={$this->lang_id_sql})";
			$result		= $this->mysql->executeSQL($query);
			$needData	= $this->mysql->fetchAssocAll($result);
		}


		//определяем редактируемую запись
		if (SETTINGS_EDIT_MODE  || $this->info['block_type']==1) {
			if (isset($this->get['id'])) {
				$id=$this->get['id'];
				for ($i=0; $i<count($needData); $i++) {
					if ($needData[$i][$pk_incr_fieldname]==$id) {
						$currentData	= $needData[$i];
						break;
					}
				}
			}

			if (!isset($currentData) && count($needData)>0) $currentData=$needData[0];
			elseif (!isset($currentData)) $currentData=null;

			if (count($this->errors)>0) {
				foreach ($this->postr AS $key=>$value) 	{
					$currentData[$key]	= $value;
					/*
					if (!is_array($value)) $currentData[$key]	= $value;
					else {
						//делаем строку
						//$currentData[$key]	= implode(',', $value);						
					$currentData[$key]	= $value;
					}
					*/
				}
				$this->smarty->assign('errors', 		$this->errors);
			}
		}
		elseif (isset($this->get['id'])) $currentData[$pk_incr_fieldname]=$this->get['id'];


		//находим связные таблицы для динамической подгрузки данных
		$hide_masiv		= array();
		$hide_fields	= array();
		$translit_fields= array();
		$CopyNewContent = array();
		$filter			= false;
		for ($i=0; $i<count($fields); $i++)	 {
			$v	= $fields[$i];

			if ($v['sourse_table_name']!='' && $v['edittype_id']!=14  && $v['edittype_id']!=15) {

				$query		= "SELECT $MYSQL_TABLE17.table_id, $MYSQL_TABLE17.fieldname, $MYSQL_TABLE17.sourse_field_name, $MYSQL_TABLE17.own_filter, $MYSQL_TABLE17.filter FROM `$MYSQL_TABLE17` WHERE $MYSQL_TABLE17.sourse_table_name='{$v['sourse_table_name']}' AND $MYSQL_TABLE17.table_id!='{$v['table_id']}' AND $MYSQL_TABLE17.edittype_id!='14' AND $MYSQL_TABLE17.edittype_id!='15'";
				$result		= $this->mysql->executeSQL($query);
				$next_table = $this->mysql->fetchAssocAll($result);

				foreach ($next_table as $nt) {

					for ($i2=0; $i2<count($fields); $i2++)	 {
						$v2	= $fields[$i2];

						if ($v2['sourse_table_name']!=$v['sourse_table_name'] &&  $v['id']!=$v2['id'] && $v2['sourse_table_name']!='' && $allBlockTables[$v2['sourse_table_name']]['id']==$nt['table_id'] && $v2['own_filter']==0) {

							$fields[$i]['obnovit'][$v2['sourse_table_name']]['fieldname_array'][] = $v2['fieldname'];
							$obnovit['sourse_table_name']						= $v2['sourse_table_name'];
							$obnovit['sourse_field_name']						= $v2['sourse_field_name'];
							$obnovit['sourse_field_name_next']					= $nt['fieldname'];
							$obnovit['fieldname_array']							= $fields[$i]['obnovit'][$v2['sourse_table_name']]['fieldname_array'];
							$fields[$i]['obnovit'][$v2['sourse_table_name']]	= $obnovit;
						}
					}
				}
			}

			//если есть хоть одно поле в фильте выставляем флаг
			if ($v['filter']==1) {
				$filter = true;

				if ($v['sourse_table_name']!='') {
					//проверяем, есть ли у таблицы источника настраиваемые фильтры
					$query							= "SELECT count(*) FROM `$MYSQL_TABLE17` WHERE `table_id`='{$allBlockTables[$v['sourse_table_name']]['id']}' AND `table_id`!='{$v['table_id']}' AND `filter`='1' AND `datatype_id`!='24'  AND `datatype_id`!='25'";
					$result							= $this->mysql->executeSQL($query);
					list($have_sourse_filter) 		= $this->mysql->fetchRow($result);
					if ($have_sourse_filter>0) {
						$fields[$i]['have_sourse_filter'] = true;
					}
					else {
						$fields[$i]['have_sourse_filter'] = false;
					}
				}
			}

			//формируем массив по которому будут скрываться поля
			if ($v['hide_by_field_caption']!='') {
				$v['hide_on_value']														= str_replace("\r",'', $v['hide_on_value']);
				$hide_masiv[$v['hide_by_field_caption']][$v['fieldname']]['operator']	= $v['hide_operator'];
				$hide_masiv[$v['hide_by_field_caption']][$v['fieldname']]['value']		= addslashes(str_replace(SETTINGS_NEW_LINE, chr(31),$v['hide_on_value']));
				$hide_fields[$v['hide_by_field_caption']]								= $v['fieldname'];
			}

			//формируем массив по которому будет создаваться транслит
			if ($v['edittype_id']==14 && $v['sourse_table_name']!='') {
				$translit_fields[$v['sourse_field_name']]	= $v['fieldname'];
			}
			//формируем массив по которому будет создаваться копия содержимого
			elseif ($v['edittype_id']==15 && $v['sourse_table_name']!='') {
				$CopyNewContent[$v['sourse_field_name']][]	= $v['fieldname'];
			}
		}

		$hide_masiv = $GENERAL_FUNCTIONS->get_javascript_array($hide_masiv, 'hideMasiv');

		//получаем данные для списков
		$all_array_list	=   array();
		foreach ($fields as $k => $v) {

			//проверяем, чтоб 2 раза не брать один и тотже список
			if (isset($all_array_list['list_'.$v['fieldname']])) {
				$fields[$k]['list_'.$v['fieldname']]	= $all_array_list['list_'.$v['fieldname']];
			}
			else {
				//берем список вариантов поля ENUM и SET
				if ($v['datatype_id']==24 || $v['datatype_id']==25)	 {

					$query 			= "SHOW COLUMNS FROM `$this->current_tablename` LIKE '{$v['fieldname']}'";
					$result			= $this->mysql->executeSQL($query);
					if($this->mysql->numRows($result)>0){
						list(,$f) 								= $this->mysql->fetchRow($result);
						$fields[$k]['list_'.$v['fieldname']]	= explode("','", preg_replace("/(?:enum|set)\('(.+?)'\)/","$1", $f));
					}
					else 	{
						$fields[$k]['list_'.$v['fieldname']]	= array();
					}
				}

				//берем список страниц админки
				elseif ($v['edittype_id']==13)	 {
					//берем список страниц один раз
					$query		= "SELECT `id`, `name`, `description` FROM `$MYSQL_TABLE3` ORDER BY `name`";
					$result		= $this->mysql->executeSQL($query);
					while ($row=$this->mysql->fetchAssoc($result)) {
						$pages_list['id'.$row['id']] = $row;
					}

					$fields[$k]['list_'.$v['fieldname']] = $pages_list;
				}
				elseif ($v['sourse_table_name']!='' && $v['edittype_id']!=14 && $v['edittype_id']!=15) {

					$usl_vibora_for_filter		= '';
					//проверяем является ли данный список деревом
					$query						= "SELECT `fieldname` FROM `$MYSQL_TABLE17` WHERE `sourse_table_name`='{$v['sourse_table_name']}' AND `table_id`='{$allBlockTables[$v['sourse_table_name']]['id']}' AND `edittype_id`!=14 AND `edittype_id`!=15 AND own_filter='0' LIMIT 1";
					$result						= $this->mysql->executeSQL($query);
					list($tree_parent)			= $this->mysql->fetchRow($result);

					//берем название поля первичного ключа
					$pk_key_fiedl_name			= $GENERAL_FUNCTIONS->getTablePkIncrFieldName($v['sourse_table_name']);
					$fields[$k]['pkincr_sourse_'.$v['fieldname']] = $pk_key_fiedl_name;

					//проверяем зависит ли таблица на которую ссылаемся от других таблиц
					$usl_vibora					= "(t.lang_id={$this->lang_id_sql}) AND";	//выбираем тольке те данные, которые совпадают по языку
					$usl_vibora_for_filter		= "(t.lang_id={$this->lang_id_sql}) AND";


					if (isset($dfilter)) {
						$query		= "SELECT `fieldname`, `table_id` FROM `$MYSQL_TABLE17` WHERE `table_id`={$allBlockTables[$v['sourse_table_name']]['id']} AND `sourse_table_name`!=''";
						$result		= $this->mysql->executeSQL($query);
						while ($row	= $this->mysql->fetchAssoc($result)) {
							foreach ($dfilter as $field=>$value) {
								if ($row['fieldname']==$field && $row['table_id']!=$v['table_id']) {
									$usl_vibora.=" t.$field='$value' AND";
								}
							}
						}
					}


					$usl_not_for_tree='';
					//данная часть кода добавляет условие выборки для списков по фильтру
					if (isset($data_filter[$this->current_tablename])) {
						foreach ($fields as $f_usl)	{
							if (isset($f_usl['obnovit'])) {
								foreach ($f_usl['obnovit'] as $s_t_name=>$f_s_data) {
									if ($v['sourse_table_name']==$s_t_name) {
										if (isset($data_filter[$this->current_tablename][$f_usl['fieldname']]) && $data_filter[$this->current_tablename][$f_usl['fieldname']]!='') {
											$usl_not_for_tree.=" t.{$f_s_data['sourse_field_name_next']}='{$data_filter[$this->current_tablename][$f_usl['fieldname']]}' AND";
										}
									}
								}
							}
						}
					}


					//добавляем собственный фильтр выборки для списка
					if ($v['own_filter'] && isset($_SESSION['___GoodCMS']['data_filter'.$v['sourse_field_name']])) {
						$data_filter_own	= eval($_SESSION['___GoodCMS']['data_filter'.$v['sourse_field_name']]);
						if (isset($data_filter_own[$v['sourse_table_name']])) {
							foreach ($data_filter_own[$v['sourse_table_name']] as $key=>$f_usl)	{
								$usl_vibora.=" t.{$key}='{$f_usl}' AND";
							}
						}
					}

					//данная часть кода добавляет условие выборки для данных в фильтре
					if (isset($data_filter[$v['sourse_table_name']]) && $v['sourse_table_name']!=$this->current_tablename) {
						$df	= $data_filter[$v['sourse_table_name']];
						list($f_q)	= $this->generateSQLPartFromFilter($data_filter, $df, $data_filter[$v['sourse_table_name']]);
						if  ($f_q!='') $usl_vibora_for_filter.=$f_q.' AND';
					}

					//проверяем от каких таблиц зависит данное поле, если есть выбранная запись
					if (count($currentData)>0) {
						foreach ($fields as $f_usl)	{
							if (isset($f_usl['obnovit'])) {
								foreach ($f_usl['obnovit'] as $s_t_name=>$f_s_data) {
									if ($v['sourse_table_name']==$s_t_name) {
										if (isset($currentData[$f_usl['fieldname']]) && $currentData[$f_usl['fieldname']]!='') {
											$usl_not_for_tree=" t.{$f_s_data['sourse_field_name_next']}='{$currentData[$f_usl['fieldname']]}' AND";
										}
									}
								}
							}
						}
					}


					//проверяем, есть ли в таблице поле типа трансилт
					$sourse_table_id	= $allBlockTables[$v['sourse_table_name']]['id'];
					list($sfnt_caption, $sourse_field_name_translite)=$this->getArticleField($sourse_table_id, $v['sourse_field_name']);


					//если не является деревом
					if (!$tree_parent)	{
						//берем записи с условием
						$temp 	= array();
						$usl_vibora.=$usl_not_for_tree;

						if ($usl_vibora!='') $usl_vibora='WHERE '.mb_substr($usl_vibora, 0, -3);

						
						$query		= "SELECT t.$pk_key_fiedl_name, t.{$v['sourse_field_name']} $sourse_field_name_translite FROM `{$v['sourse_table_name']}` AS `t` $usl_vibora  ORDER BY t.{$v['sourse_field_name']}";
						$result		= $this->mysql->executeSQL($query);
						while ($row = $this->mysql->fetchAssoc($result)) {
							if (isset($row[$sfnt_caption])) {
								$row[$v['sourse_field_name']]		 = $row[$sfnt_caption].' '.$row[$v['sourse_field_name']];
							}
							$temp['id'.$row[$pk_key_fiedl_name]] = $row;
						}
						$fields[$k]['list_'.$v['fieldname']]	 = $temp;

						//генерируем списк для фильтра
						if ($usl_vibora_for_filter) {
							//берем записи с условием
							$temp 		= array();

							if ($usl_vibora_for_filter!='') $usl_vibora	= 'WHERE '.mb_substr($usl_vibora_for_filter,0,-3);
							else $usl_vibora	= '';

							$query		= "SELECT t.$pk_key_fiedl_name, t.{$v['sourse_field_name']} $sourse_field_name_translite FROM `{$v['sourse_table_name']}` AS `t` $usl_vibora  ORDER BY t.{$v['sourse_field_name']}";
							$result		= $this->mysql->executeSQL($query);
							while ($row = $this->mysql->fetchAssoc($result)) {

								if (isset($row[$sfnt_caption])) {
									$row[$v['sourse_field_name']]		 = $row[$sfnt_caption].' '.$row[$v['sourse_field_name']];
								}
								$temp['id'.$row[$pk_key_fiedl_name]] = $row;
							}
							$fields[$k]['list_filter_'.$v['fieldname']]	 = $temp;
						}
					}
					//формируем дерево
					else {
						if ($usl_vibora!='') $wh	= 'WHERE '.mb_substr($usl_vibora,0,-3);
						else $wh	= '';

						$all_tree_records 	= array();
						$query 				= "SELECT t.$pk_key_fiedl_name, t.{$v['sourse_field_name']}, t.$tree_parent FROM `{$v['sourse_table_name']}` AS `t` $wh ORDER BY t.sort_index $DESC_TOTAL";
						$result				= $this->mysql->executeSQL($query);
						while ($row			= $this->mysql->fetchAssoc($result)) {
							$all_tree_records['id'.$row['id']] 	= $row;
						}

						$fields[$k]['list_'.$v['fieldname']] = $this->makeTree($all_tree_records, $pk_key_fiedl_name, $v['sourse_field_name'], $tree_parent, $v['fieldname'],  0, -1);


						//генерируем списк для фильтра
						if ($usl_vibora_for_filter) {

							if ($usl_vibora_for_filter!='') $wh	= 'WHERE '.mb_substr($usl_vibora_for_filter,0,-3);
							else $wh	= '';

							$all_tree_records2 	= array();
							$query 				= "SELECT t.$pk_key_fiedl_name, t.{$v['sourse_field_name']}, t.$tree_parent FROM `{$v['sourse_table_name']}` AS `t` $wh ORDER BY t.sort_index $DESC_TOTAL";
							$result				= $this->mysql->executeSQL($query);
							while ($row			= $this->mysql->fetchAssoc($result)) {
								$all_tree_records2['id'.$row['id']] 	= $row;
							}

							$fields[$k]['list_filter_'.$v['fieldname']] = $this->makeTree($all_tree_records2, $pk_key_fiedl_name, $v['sourse_field_name'], $tree_parent, $v['fieldname'],  0, -1);
						}
						else {
							$all_tree_records2							= $all_tree_records;
							$fields[$k]['list_filter_'.$v['fieldname']]	= $fields[$k]['list_'.$v['fieldname']];
						}


						//если ссылается на себя, но не является деревом
						if (count($fields[$k]['list_'.$v['fieldname']])==0 && count($all_tree_records)>0) {
							$fields[$k]['list_'.$v['fieldname']]=$all_tree_records;
						}


						if (isset($fields[$k]['list_filter_'.$v['fieldname']]) && count($fields[$k]['list_filter_'.$v['fieldname']])==0 && count($all_tree_records2)>0) {
							$fields[$k]['list_filter_'.$v['fieldname']]	= $all_tree_records2;
						}

						$fields[$k]['is_tree'] = true;
					}
				}

				//запоминаем массив, чтоб небыло повторных выборок
				if (isset($fields[$k]['list_'.$v['fieldname']])) {
					$all_array_list['list_'.$v['fieldname']]=$fields[$k]['list_'.$v['fieldname']];
				}
			}


			if (SETTINGS_EDIT_MODE  || $this->info['block_type']==1) {

				//берем список выбранных записей для поля multiselect
				if ($v['edittype_id']==4 && !empty($currentData) && $v['sourse_field_name']!='') {
					$multiselect_fields[]	= $v['fieldname'];
					$temp					= array();

					//проверяем, есть ли в таблице поле типа трансилт
					$sourse_table_id	= $allBlockTables[$v['sourse_table_name']]['id'];
					list($sfnt_caption, $sourse_field_name_translite)=$this->getArticleField($sourse_table_id, $v['sourse_field_name']);

					if (!is_array($currentData[$v['fieldname']])) {						
						$query		= "SELECT t.id, t.{$v['sourse_field_name']} AS `caption` $sourse_field_name_translite FROM `{$v['sourse_table_name']}` AS `t`, `$MYSQL_TABLE13` AS `t2` WHERE t2.field_id='{$v['id']}' AND t2.data_id='{$currentData['id']}' AND t2.value_id=t.id ORDER BY t.sort_index DESC";
					}
					//если при добавлении произошла ошибка и переменная содержит массив выюранных данных
					else {						
						$multy_ids	= implode(',', $currentData[$v['fieldname']]);
									
						$query		= "SELECT t.id, t.{$v['sourse_field_name']} AS `caption` $sourse_field_name_translite 
							FROM `{$v['sourse_table_name']}` AS `t` 					
							WHERE t.id IN ($multy_ids) ORDER BY t.sort_index DESC";
					}
					$result		= $this->mysql->executeSQL($query);
					while ($row	= $this->mysql->fetchAssoc($result)) {
						if (isset($row[$sfnt_caption])) {
							$row['caption']		= $row[$sfnt_caption].' '.$row['caption'];
						}

						$temp['id'.$row['id']] 	= $row;
					}
					$currentData[$v['fieldname']]=$temp;
				}


				if (!empty($currentData)) {
					//берем количество картинок
					if ($v['edittype_id']==10) {
						$dir		= $MODULES_PATH.$this->info['module_name']."/management/storage/images/{$this->current_tablename_no_prefix}/{$v['fieldname']}/{$this->get['id']}/preview/";
						if (isset($currentData[$v['fieldname']]) && $all_p	= eval($currentData[$v['fieldname']])) {
							$img_count	= count($all_p);
						}
						else {
							$img_count 	= 0;
						}

						$fields[$k]['count_'.$v['fieldname']] = $img_count;
					}

					//берем количество файлов
					if ($v['edittype_id']==12) {
						$dir		= $MODULES_PATH.$this->info['module_name']."/management/storage/files/{$this->current_tablename_no_prefix}/{$v['fieldname']}/{$this->get['id']}/";
						if (isset($currentData[$v['fieldname']]) &&  $all_p		= eval($currentData[$v['fieldname']])) {
							$files_count= count($all_p);
						}
						else {
							$files_count = 0;
						}

						$fields[$k]['count_'.$v['fieldname']] = $files_count;
					}

					//берем атрибуты файла
					if ($v['edittype_id']==11 && isset($currentData[$v['fieldname']]) && $currentData[$v['fieldname']]!='') {
						$fullName= $MODULES_PATH.$this->info['module_name']."/management/storage/files/{$this->current_tablename_no_prefix}/{$v['fieldname']}/{$this->get['id']}/{$currentData[$v['fieldname']]}";
						$fields[$k]['size_'.$v['fieldname']]	= number_format( round(filesize($fullName)/1000), 0, ',', ' ');
						$fields[$k]['create_'.$v['fieldname']]  = gmdate('M d Y H:i:s', filectime($fullName));
					}
				}
			}
		}
		unset($all_array_list);


		//вычисляем ширину полей, чтоб построить таблицу
		if ($this->info['block_type']==2) {

			//считаем количество выводимых полей
			$show_fields_count			= 0;
			foreach($fields as $key=>$v) {
				if ($v['show_in_list']==1) {
					$show_fields_count++;
				}
			}

			//свободное место
			$field_width				= 95;

			//определяем весовые коэффициенты
			$show_simple_fields_count	= 0;
			$simple_data				= array(2=>5, 4=>5, 5=>5, 6=>5, 7=>5, 8=>5, 9=>5,10=>5, 11=>5, 12=>20, 13=>5, 14=>5, 15=>5, 16=>5, 27=>5);
			$select_data				= array(3, 4);
			$files_data					= array(9, 10, 11, 12);

			foreach($fields as $key=>$v) {
				if ($v['show_in_list']==1) {
					//если поле короткое
					if ((isset($simple_data[$v['datatype_id']]) && !in_array($v['edittype_id'], $select_data)) || in_array($v['edittype_id'], $files_data)) {
						if (isset($simple_data[$v['datatype_id']])) $w=$simple_data[$v['datatype_id']];
						else $w=5;

						$fields[$key]['width_percent']=$w;
						$field_width=$field_width-$w;
						$show_simple_fields_count++;
					}
				}
			}

			//вычисляем среднюю длинну
			if ($show_fields_count-$show_simple_fields_count>0) {
				$free_width_part=round($field_width/($show_fields_count-$show_simple_fields_count), 0);

				//распределяем место между большими полями
				foreach($fields as $key=>$v) {
					if ($v['show_in_list']==1) {
						//если поле короткое
						if ((!isset($simple_data[$v['datatype_id']]) || in_array($v['edittype_id'], $select_data)) && !in_array($v['edittype_id'], $files_data)) {
							$fields[$key]['width_percent']=$free_width_part;
							$field_width=$field_width-$free_width_part;

						}
					}
				}
			}

			//распределяем оставшееся место
			if ($field_width>0) {
				//вычисляем среднюю длинну
				$free_width_part=round($field_width/$show_simple_fields_count, 0);
				foreach($fields as $key=>$v) {
					if ($v['show_in_list']==1) {
						//если поле короткое
						if ((isset($simple_data[$v['datatype_id']]) && !in_array($v['edittype_id'], $select_data)) || in_array($v['edittype_id'], $files_data)) {
							$fields[$key]['width_percent']=$v['width_percent']+$free_width_part;
						}
					}
				}
			}
		}


		//генерируем код для подключение редакторов
		if (!isset($this->get['create_report'])) {
			$editorsCode	= '';
			$ck				= false;
			foreach ($fields as $field) {
				if ($field['edittype_id']==7) {
					if (!$ck) {
						$ck=true;
						$editorsCode.=$GENERAL_FUNCTIONS->editorGenerate();
					}
					$editorsCode.=$GENERAL_FUNCTIONS->editorGenerate($field['fieldname'], $field['height'], $field['width']);
				}
			}
		}
		else {
			$editorsCode	= '';
		}

		if (!isset($currentData)) $currentData=array();
		$interface_lang_prefix	= explode('.', SETTINGS_LANGUAGE);

		//заменяем спец-символы, чтоб не было проблем при отображении на странице
		$currentData					= $GENERAL_FUNCTIONS->htmlspecialcharsToObject($currentData);

		//проверяем лицензию на модуль
		if (!$activated					= $CMSProtection->checkActivationModule($this->info['module_name'])) {
			$currentData				= array();	//делаем редактируемое поле пустым
			$this->errors[]				= sprintf($MSGTEXT['management_block_need_tu_by'], $this->info['module_name']);
		}


		//формируем дополнительные кнопки
		$additional_buttons=array();
		$ab				= $allBlockTables[$this->current_tablename]['additional_buttons'];
		if ($ab!='') {
			$ab			= explode("\n", $ab);
			foreach ($ab as $v) {
				$t				= explode(':',$v);
				if (count($t)==3) {
					$tmp['caption']	= $t[0];
					$tmp['target']	= $t[1];
					$tmp['block']	= str_replace("\r", '', $t[2]);
					$tmp['url']		= "executeBlock.php?block_name={$tmp['block']}&module_name={$this->info['module_name']}&table_name={$this->current_tablename}&tag_id={$this->get['tag_id']}&page_id={$this->get['page_id']}";
					$additional_buttons[]	= $tmp;
				}
			}
		}


		$this->smarty->assign('activated', 							$activated); 					//информация о лицензии модуля
		$this->smarty->assign('additional_buttons', 				$additional_buttons); 			//информация о лицензии модуля
		$this->smarty->assign('info', 								$this->info); 					//данные о блоке и модуле
		$this->smarty->assign('module_blocksTables', 				$module_blocksTables);			//список всех редактируемых таблиц
		$this->smarty->assign('table_name', 						$this->current_tablename);		//имя редактируемой таблицы
		$this->smarty->assign('pk_incr_fieldname', 					$pk_incr_fieldname);			//название поля первичного ключа
		$this->smarty->assign('page_id', 							$this->get['page_id']);			//страница админки, которая редактируется
		$this->smarty->assign('tag_id', 							$this->get['tag_id']);			//тег страницы админки по которому редактируется блок
		$this->smarty->assign('module_name', 						$this->info['module_name']);	//название модуля
		$this->smarty->assign('currentData', 						$currentData);					//данные редактируемой записи
		$this->smarty->assign('hide_fields', 						$hide_fields);					//массив полей по которым происходит скрытие связных полей в форме редактирования
		$this->smarty->assign('hide_masiv', 						$hide_masiv);					//массив значений по которому происходит скрытие полей в форме редактирования
		$this->smarty->assign('translit_fields', 					$translit_fields);				//массив по которому происходит транслитерация для типа редактирования Friendly URL
		$this->smarty->assign('CopyNewContent', 					$CopyNewContent);				//массив по которому происходит копирование содержимого для типа редактирования CopyNewContent
		$this->smarty->assign('interface_lang_prefix', 				$interface_lang_prefix[0]);	//префикс языка интерфейся для календаря
		$this->smarty->assign('messages', 							$this->messages);				//сообщения
		$this->smarty->assign('errors', 							$this->errors);					//сообщения об ошибках
		$this->smarty->assign('filter', 							$filter);						//флаг, на использование фильтра
		$this->smarty->assign('data_filter', 						$data_filter);					//фильтр выборки записей
		$this->smarty->assign('current_tablename_no_prefix', 		$this->current_tablename_no_prefix); //имя текущей таблицы без префикса
		$this->smarty->assign('editorsCode', 						$editorsCode);					//код, для подключения редакторов

		if ($this->info['block_type']==2)  {
			$strip_tags_edit_type	= array(1, 2);
			foreach ($needData as $k=>$v) {
				foreach ($v as $field_name=>$v2) {
					if (isset($fieldinfo_by_name[$field_name])) {
						$edittype_id	= $fieldinfo_by_name[$field_name]['edittype_id'];
						if ($edittype_id==7 || $edittype_id==8) {
							$needData[$k][$field_name]			= $GENERAL_FUNCTIONS->stripTagsFromObject($v2);
						}
						else {
							if (in_array($edittype_id, $strip_tags_edit_type)) {
								$needData[$k][$field_name]		= $GENERAL_FUNCTIONS->htmlspecialcharsToObject($v2);
							}
						}
					}
				}
			}

			if (isset($this->get['create_report'])) {
				//берем настройки тех полей, которые нужно выводить в экспорт
				$fieldsExportSettings	= array();
				$query			= "SELECT t.*, t2.fieldname FROM `$MYSQL_TABLE16` AS `t` LEFT JOIN `$MYSQL_TABLE17` AS `t2` ON (t.field_id=t2.id) WHERE t.table_id='{$table_id}'";
				$result			= $this->mysql->executeSQL($query);
				while ($row		= $this->mysql->fetchAssoc($result)) {
					$fieldsExportSettings[$row['fieldname']] = $row;
				}

				list($needData, $fields)	= $this->parceDataBeforeReport($needData, $fieldsExportSettings, $fields);
			}

			$this->smarty->assign('ownDataList', 		$ownDataList);				//массив подставляемых записей в родительское окно
			$this->smarty->assign('opener_f_name', 		$opener_f_name);			//id элемента, в котором следует обновить записи
			$this->smarty->assign('pages_navigations', 	$pages_navigations);		//страницы навигации
			$this->smarty->assign('p_num', 				$p_selected);				//текущая страница
			$this->smarty->assign('search', 			$search);					//фраза, по которой происходит поиск
			$this->smarty->assign('search_by_field', 	$search_by_field);			//поле, по которому происходит поиск
			$this->smarty->assign('search_by_rule', 	$search_by_rule);			//правило, по которому происходит поиск
			$this->smarty->assign('sort_type', 			$sort['sort_type']);		//тип сортировки
			$this->smarty->assign('sort_by', 			$sort['sort_by']);			//сортировка по полю
		}

		$this->smarty->assign('needData', 			$needData);					//записи выводимые на страницу
		$this->smarty->assign('fields', 			$fields);					//настройки полей


		//выводим отчет
		if (isset($this->get['create_report'])) {

			$this->smarty->assign('total',  sprintf($MSGTEXT['html_report_all'], $pages_navigations['records_count']));


			$this->smarty->assign('fieldsExportSettings', 	$fieldsExportSettings);
			$report_content	 = $this->smarty->fetch("{$this->tplLocation}{$this->gets['report_type']}.tpl");
			if ($report_name = $this->createReport($allBlockTables[$this->current_tablename]['description'], $report_content)) {
				$GENERAL_FUNCTIONS->gotoURL('getfile.php?f='.$report_name);
				exit;
			}
			else {
				//ошибка создания отчета
				$errors	= sprintf($MSGTEXT['management_block_canot_write'], $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/reports');
				$this->smarty->assign('errors', 			$errors);
				echo $this->smarty->fetch($this->tplLocation.'report_error.tpl');
			}
			exit;
		}
		else {
			$this->smarty->assign('content_template', $this->tplLocation.'edit_data.tpl');
		}
	}



	/**
	 * Находит в таблице артикул
	 *
	 * @param int $sourse_table_id
	 * @param string $sourse_field_name
	 */
	function getArticleField($sourse_table_id, $sourse_field_name) {
		GLOBAL $MYSQL_TABLE17;

		if (!isset($this->tablesArticles[$sourse_table_id][$sourse_field_name])) {
			//проверяем, есть ли в таблице поле типа трансилт
			$query				= "SELECT t.fieldname FROM `$MYSQL_TABLE17` AS `t` WHERE t.table_id='$sourse_table_id' AND t.fieldname LIKE 'article%' AND t.fieldname!='$sourse_field_name'";
			$result				= $this->mysql->executeSQL($query);
			if (!list($sourse_field_name_translite)= $this->mysql->fetchRow($result)) {
				$sourse_field_name_translite	= '';
				$sfnt_caption					= '';
			}
			else {
				$sfnt_caption					= $sourse_field_name_translite;
				$sourse_field_name_translite	= ', t.'.$sourse_field_name_translite;
			}
			$this->tablesArticles[$sourse_table_id][$sourse_field_name]=array($sfnt_caption, $sourse_field_name_translite);
		}
		else {
			return	$this->tablesArticles[$sourse_table_id][$sourse_field_name];
		}

		return array($sfnt_caption, $sourse_field_name_translite);
	}



	/**
	 * Формирует данные для мультиселекта
	 *
	 * @param array $data
	 * @param array $multyFields
	 * @return array
	 */			
	function getMultiDate($data, $multyFields) {
		GLOBAL $MYSQL_TABLE13;

		//получаем список отображаемых ID
		$ids	= array();
		foreach ($data as $d)	 {
			$ids[]=$d['id'];
		}

		if (count($ids)>0) {
			$ids	= implode(',' , $ids);
			foreach ($multyFields as $field) {
				$captions	= array();
				//берем список записей для поля multiselect
				$query		= "SELECT t2.data_id, t.{$field['sourse_field_name']} FROM `{$field['sourse_table_name']}` AS `t`, `$MYSQL_TABLE13` AS `t2` WHERE t2.field_id='{$field['id']}' AND t2.data_id IN ($ids) AND t2.value_id=t.id ORDER BY t.sort_index DESC";
				$result		= $this->mysql->executeSQL($query);

				while (list($row_id,$row_data)	= $this->mysql->fetchRow($result)) {
					$captions[$row_id][]		= $row_data;
				}
				foreach ($data as $k=>$d) {
					if (isset($captions[$d['id']])) {
						$data[$k]['list_'.$field['fieldname']]=$captions[$d['id']];
					}
				}
			}
		}

		return $data;
	}



	/**
	  * Определяем тип редактирования записи
	  *
	  */
	function saveedit() {
		GLOBAL $MSGTEXT;
		$action		= $this->gets['edit'];

		switch ($action):
		case ('save')   : 	$this->dataUpdate(); $txt=$MSGTEXT['management_block_edit_save'];		break;
		case ('insert') : 	$this->dataInsert(); $txt=$MSGTEXT['management_block_edit_insert'];		break;
		case ('delete') : 	$this->dataDelete(); $txt=$MSGTEXT['management_block_edit_deleted'];	break;
		endswitch;

		if (count($this->errors)==0) {
			$this->messages[]	= $txt;
		}

		$this->formData();
	}



	/**
	 * Сохранение редактирования
	 *
	 */
	function dataUpdate() {
		$this->API->dataUpdate();
		$this->errors		= $this->API->errors;
	}



	/**
	 * Вставка новой записи в редактируемую таблицу
	 *
	 */
	function dataInsert() {
		$this->API->dataInsert();
		$this->errors			= $this->API->errors;

		if (count($this->errors)==0) {
			$this->get['id']	= $this->API->inserted_id;
		}
	}



	/**
	 * Вставка новой записи или замена если есть в редактируемую таблицу
	 *
	 */
/*	
	function dataReplace() {
		$this->API->dataReplace();
		$this->errors			= $this->API->errors;

		if (count($this->errors)==0) {
			$this->get['id']	= $this->API->inserted_id;
		}
	}
*/


	/**
	 * Удаление записи
	 *
	 */
	function dataDelete() {
		$this->API->dataDelete();
		$this->errors		= $this->API->errors;
	}



	///////////////////РЕДАКТИРОВАНИЕ ИЗОБРАЖЕНИЙ//////////////////////////////////////////////////
	/**
     * Выводит форму редактирования фотографий
     *
     */
	function  photosForm() {
		GLOBAL  $GENERAL_FUNCTIONS, $MSGTEXT, $MODULES_PATH;

		$pk_incr_fieldname	= $GENERAL_FUNCTIONS->getTablePkIncrFieldName($this->current_tablename);
		$field_name 		= $this->get['f_name'];

		$query				= "SELECT `$field_name` FROM `$this->current_tablename` WHERE `$pk_incr_fieldname`='{$this->get['id']}'";
		$result				= $this->mysql->executeSQL($query);
		list($currentData)	= $this->mysql->fetchRow($result);
		$allphotos			= eval($currentData);


		if (is_array($allphotos)) {
			$k = 0;
			//сортируем массив
			usort($allphotos, array('Management','sortBySortIndex'));
			for ($i=0; $i<count($allphotos); $i++) {

				$allphotos[$i]['big_img']	= '../modules/'.$this->info['module_name']."/management/storage/images/{$this->current_tablename_no_prefix}/$field_name/{$this->get['id']}/{$allphotos[$i]['name']}";
				$allphotos[$i]['small_img']	= '../modules/'.$this->info['module_name']."/management/storage/images/{$this->current_tablename_no_prefix}/$field_name/{$this->get['id']}/preview/{$allphotos[$i]['name']}";

				if ($k==0) {
					$allphotos[$i]['new_row_begin']	= true;
					$k		= 6;
				}

				if (($k==1) || ($i==(count($allphotos)-1))) {
					$allphotos[$i]['new_row_end']	= true;
				}
				$k--;
			}
		}


		$this->smarty->assign('content_template',	$this->tplLocation.'edit_photos.tpl');
		$this->smarty->assign('page_id', 			$this->get['page_id']);
		$this->smarty->assign('tag_id',				$this->get['tag_id']);
		$this->smarty->assign('table_name',			$this->current_tablename);
		$this->smarty->assign('errors',				$this->errors);
		$this->smarty->assign('messages',			$this->messages);
		$this->smarty->assign('id', 				$this->get['id']);
		$this->smarty->assign('field_name',			$field_name);
		$this->smarty->assign('session_id',			session_id());


		if (count($allphotos>0)) {
			$this->smarty->assign('allphotos',		$allphotos);
		}
	}



	/**
	 * Сохранение индексов, описания изображений
	 *
	 */
	function photosSaveDescription() {
		GLOBAL  $GENERAL_FUNCTIONS, $FILE_MANAGER, $MSGTEXT, $MODULES_PATH, $MYSQL_TABLE17, $MYSQL_TABLE18;

		$field_name 	= $this->get['f_name'];

		$save_to_dir 	= $MODULES_PATH.$this->info['module_name']."/management/storage/images/{$this->current_tablename_no_prefix}/$field_name/{$this->get['id']}/";

		$k		= 1;
		$photos	= array();
		while (isset($this->post['name_'.$k])) {

			//удаляем выбранные изображения
			if (isset($this->post['delete_'.$k])) {
				$v=$this->post['delete_'.$k];
				if (file_exists($save_to_dir.$v)) $FILE_MANAGER->unlink($save_to_dir.$v);
				if (file_exists($save_to_dir.'preview/'.$v)) $FILE_MANAGER->unlink($save_to_dir.'preview/'.$v);
			}
			else {
				$tmp['name']			= $this->post['name_'.$k];
				$tmp['description']		= $this->post['description_'.$k];
				if (!is_numeric($this->post['sort_index_'.$k])) {
					$tmp['sort_index']	= 0;
				}
				else {
					$tmp['sort_index']	= $this->post['sort_index_'.$k];
				}

				$photos[]				= $tmp;
			}
			$k++;
		}

		//сортируем массив
		usort($photos, array('Management','sortBySortIndex'));

		//обновляем индекс сортировки и описание
		$ser		= addslashes('return '.var_export($photos,true).';');
		$query		= "UPDATE `{$this->current_tablename}` SET `$field_name`='$ser' WHERE `id`='{$this->get['id']}'";
		$result		= $this->mysql->executeSQL($query);

		$this->messages[]=$MSGTEXT['edit_photos_id_saved'];
		$this->photosForm();
	}



	/**
	 * Сохранение индексов, описания файлов
	 *
	 */
	function filesSaveDescription() {
		GLOBAL  $GENERAL_FUNCTIONS, $FILE_MANAGER, $MSGTEXT, $MODULES_PATH, $MYSQL_TABLE17, $MYSQL_TABLE18;

		$field_name 	= $this->get['f_name'];
		$save_to_dir 	= $MODULES_PATH.$this->info['module_name']."/management/storage/files/{$this->current_tablename_no_prefix}/$field_name/{$this->get['id']}/";
		$k				= 1;
		$files			= array();

		while (isset($this->post['name_'.$k])) {

			//удаляем выбранные файлы
			if (isset($this->post['delete_'.$k])) {
				$v=$this->post['delete_'.$k];
				if (file_exists($save_to_dir.$v)) $FILE_MANAGER->unlink($save_to_dir.$v);
			}
			else {
				$tmp['name']			= $this->post['name_'.$k];
				$tmp['description']		= $this->post['description_'.$k];
				$tmp['size']			= $this->post['size_'.$k];
				$tmp['changed']			= $this->post['changed_'.$k];
				if (!is_numeric($this->post['sort_index_'.$k])) {
					$tmp['sort_index']	= 0;
				}
				else {
					$tmp['sort_index']	= $this->post['sort_index_'.$k];
				}

				$files[]				= $tmp;
			}
			$k++;
		}

		//сортируем массив
		usort($files, array('Management','sortBySortIndex'));

		//обновляем индекс сортировки и описание
		$ser				= addslashes('return '.var_export($files, true).';');
		$query				= "UPDATE `{$this->current_tablename}` SET `$field_name`='$ser' WHERE `id`='{$this->get['id']}'";
		$result				= $this->mysql->executeSQL($query);
		$this->messages[]	= $MSGTEXT['edit_files_id_saved'];
		$this->filesForm();
	}



	/**
	 * сортировка ассоциативного массива по ключу
	 *
	 * @param array $a
	 * @param array $b
	 * @return int
	 */
	function sortBySortIndex($a, $b) {

		$k=$b['sort_index'];
		$k2=$a['sort_index'];
		if ($k == $k2) return 0;
		else return ($k < $k2) ? -1 : 1;
	}



	/**
	 * Редактировать изображения
	 *
	 */
	function photosUpdate() {

		$this->API->photosUpdate($this->gets['f_name'], $this->gets['tmp_key']);
		$this->errors	= $this->API->errors;

		exit;
	}


	///////////////////РЕДАКТИРОВАНИЕ ФАЙЛОВ//////////////////////////////////////////////////
	/**
     * Выводит форму редактирования файлов в новом окне	
     *
     */
	function  filesForm() {
		GLOBAL  $GENERAL_FUNCTIONS, $MSGTEXT, $MODULES_PATH;

		$pk_incr_fieldname	= $GENERAL_FUNCTIONS->getTablePkIncrFieldName($this->current_tablename);
		$field_name 		= $this->get['f_name'];

		$query				= "SELECT `$field_name` FROM `{$this->current_tablename}` WHERE `$pk_incr_fieldname`='{$this->get['id']}'";
		$result				= $this->mysql->executeSQL($query);
		list($currentData)	= $this->mysql->fetchRow($result);
		$allfiles			= eval($currentData);


		if (is_array($allfiles)>0) {
			//сортируем массив
			usort($allfiles, array('Management','sortBySortIndex'));

			for ($i=0; $i<count($allfiles); $i++) {
				$allfiles[$i]['file_url']	= '../modules/'.$this->info['module_name']."/management/storage/files/{$this->current_tablename_no_prefix}/$field_name/{$this->get['id']}/{$allfiles[$i]['name']}";
				$allfiles[$i]['changed'] = $GENERAL_FUNCTIONS->userDateTime($allfiles[$i]['changed'], SETTINGS_TIMEZONE, 'Y-m-d H:i:s');
			}
		}

		$this->smarty->assign('content_template',	$this->tplLocation.'edit_files.tpl');
		$this->smarty->assign('content_head', 		sprintf($MSGTEXT['management_block_m_settings'], $this->info['module_name']));
		$this->smarty->assign('page_id', 			$this->get['page_id']);
		$this->smarty->assign('tag_id',				$this->get['tag_id']);
		$this->smarty->assign('table_name',			$this->current_tablename);
		$this->smarty->assign('errors',				$this->errors);
		$this->smarty->assign('messages',			$this->messages);
		$this->smarty->assign('id', 				$this->get['id']);
		$this->smarty->assign('allfiles',			$allfiles);
		$this->smarty->assign('field_name',			$field_name);
		$this->smarty->assign('session_id',			session_id());
	}



	/**
	 * Сохранение редактирования файлов в новом окне	
	 *
	 */
	function filesUpdate() {

		$this->API->filesUpdate($this->gets['f_name'], $this->gets['tmp_key']);
		$this->errors	= $this->API->errors;

		exit;
	}



	/**
	 * Меняет флажок при нажатии на иконку 
	 *
	 */
	function setStatus() {
		GLOBAL $MSGTEXT, $GENERAL_FUNCTIONS, $MYSQL_TABLE17;

		$f_name				= $this->get['f_name'];
		$f_value			= $this->get['f_value'];

		$pk_incr_fieldname	= $GENERAL_FUNCTIONS->getTablePkIncrFieldName($this->current_tablename);

		//запоминаем значение строки, перед изменением
		$query				= "SELECT * FROM `{$this->current_tablename}` WHERE `id`='{$this->gets['id']}'";
		$result				= $this->mysql->executeSQL($query);
		$old_fields			= $this->mysql->fetchAssoc($result);

		//обновляем статус
		$query				= "UPDATE `$this->current_tablename` SET `$f_name`='$f_value' WHERE `$pk_incr_fieldname`='{$this->get['id']}'";
		$result				= $this->mysql->executeSQL($query);

		//сбрасываем статус других полей, если тип редактирования поля RadioBoxThis
		if ($this->gets['edittype_id']==16) {
			//обновляем статус
			$query				= "UPDATE `$this->current_tablename` SET `$f_name`='0' WHERE `$pk_incr_fieldname`!='{$this->get['id']}'";
			$result				= $this->mysql->executeSQL($query);
		}


		$fields				= $old_fields;
		$fields[$f_name]	= $f_value;

		//запускаем обработчик после редактирования записи
		$this->API->run_After_API_Edit($old_fields, $fields, 'update');
		$this->errors	= $this->API->errors;

		if (count($this->errors)==0) $this->messages[]	= $MSGTEXT['management_block_edit_save'];

		$this->formData();
	}



	/**
	 * Проверяет поле
	 *
	 * @return array
	 */
	function getFieldPopup() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE17,  $MYSQL_TABLE18, $MODULES_PATH;

		$info['id']			= $this->get['id'];
		$query				= "SELECT $MYSQL_TABLE17.regex FROM `$MYSQL_TABLE17`, `$MYSQL_TABLE18` WHERE $MYSQL_TABLE18.table_name='{$this->current_tablename}'  AND $MYSQL_TABLE17.fieldname='{$this->get['f_name']}'";
		$result				= $this->mysql->executeSQL($query);
		list($regex)		= $this->mysql->fetchRow($result);

		$fields				= array();
		if ($regex!='') {
			if (preg_match($regex, $this->post[$this->get['f_name']]))  {
				$fields[$this->get['f_name']]	= $this->post[$this->get['f_name']];
			}
			else {
				$this->errors[] = $MSGTEXT['management_block_bad_data_format'];
			}
		}
		else $fields[$this->get['f_name']]	= $this->posts[$this->get['f_name']];

		$arr['fields']	= $fields;
		$arr['info']	= $info;

		return $arr;
	}



	/**
	 * Сохранение текста поля типа popup
	 *
	 */
	function PopupUpdate() {
		GLOBAL $MYSQL_TABLE17, $MYSQL_TABLE18;

		$arr	= $this->getFieldPopup();
		$fields = $arr['fields'];
		$info	= $arr['info'];

		if (count($this->errors)==0 && count($fields)>0) {

			$field		= $this->get['f_name'];
			$id			= $this->get['id'];
			$value		= $fields[$field];

			//берем название поля первичного ключа

			$pkincr_fieldname='id';

			$query			= "SELECT * FROM `$this->current_tablename` WHERE `$pkincr_fieldname`='$id'";
			$result			= $this->mysql->executeSQL($query);
			$old_fields		= $this->mysql->fetchAssoc($result);

			$query			= "UPDATE `$this->current_tablename` SET `$field`='$value' WHERE `$pkincr_fieldname`='$id'";
			$result			= $this->mysql->executeSQL($query);

			//запускаем обработчик после редактирования записи
			$fields			= $old_fields;
			$fields[$field]	= $value;

			$this->API->run_After_API_Edit($old_fields, $fields, 'update');

			echo $this->smarty->fetch($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/templates/closeself.tpl');

			exit;
		}
		else {
			foreach ($this->post AS $key=>$value) 	$currentData[$key]	= stripslashes($value);
			$this->smarty->assign('messages', 		$this->errors);
			$this->PopupForm();
		}
	}



	/**
    * Формирует форму редактирования текста для поля типа popup
    *
    */
	function PopupForm() {
		GLOBAL $GENERAL_FUNCTIONS, $MYSQL_TABLE17, $MYSQL_TABLE18, $MODULES_PATH;

		$field				= $this->get['f_name'];
		$id					= $this->get['id'];

		//берем название поля первичного ключа
		$query								= "SELECT $MYSQL_TABLE17.fieldname, $MYSQL_TABLE17.height FROM `$MYSQL_TABLE17`, `$MYSQL_TABLE18` WHERE $MYSQL_TABLE18.table_name='$this->current_tablename'  AND $MYSQL_TABLE17.table_id=$MYSQL_TABLE18.id  AND $MYSQL_TABLE17.pk=1 AND $MYSQL_TABLE17.auto_incr=1";
		$result								= $this->mysql->executeSQL($query);
		list($pkincr_fieldname, $height)	= $this->mysql->fetchRow($result);

		if (!is_numeric($height)) {
			$height 	= 400;
		}

		$query			= "SELECT `$field` FROM `{$this->current_tablename}` WHERE `$pkincr_fieldname`='$id'";
		$result			= $this->mysql->executeSQL($query);
		list($text)		= $this->mysql->fetchRow($result);

		//генерируем код для подключение редакторов
		$editorsCode	= '';
		$editorsCode.=$GENERAL_FUNCTIONS->editorGenerate();
		$editorsCode.=$GENERAL_FUNCTIONS->editorGenerate($field, $height);

		$this->smarty->assign('content_template', 	$this->tplLocation.'edit_popup.tpl');
		$this->smarty->assign('text', 				$text);
		$this->smarty->assign('field', 				$field);
		$this->smarty->assign('height', 			$height);
		$this->smarty->assign('tag_id', 			$this->get['tag_id']);
		$this->smarty->assign('page_id', 			$this->get['page_id']);
		$this->smarty->assign('editorsCode', 		$editorsCode);

	}



	/**
	 * Мульти обновление индексов сортировки / мульти удаление записей
	 *
	 */
	function updaterows() {
		GLOBAL $MSGTEXT, $GENERAL_FUNCTIONS, $MYSQL_TABLE17, $MYSQL_TABLE18;

		$pk_incr_fieldname	= $GENERAL_FUNCTIONS->getTablePkIncrFieldName($this->current_tablename);

		if (isset($this->post['actiontype']) && $this->post['actiontype']=='delete') {

			//удаление всех выбранных по фильтру записей
			if (isset($this->post['check_allrows']) && $this->post['check_allrows']==1) {

				$where_delete='';
				if (isset($_SESSION['___GoodCMS']['data_filter']))  {
					$data_filter	= eval($_SESSION['___GoodCMS']['data_filter']);

					if (isset($data_filter[$this->current_tablename])) {
						$dfilter									= $data_filter[$this->current_tablename];

						//берем id таблицы
						$query				= "SELECT `id` FROM `$MYSQL_TABLE18` WHERE `table_name`='{$this->current_tablename}'";
						$result				= $this->mysql->executeSQL($query);
						list($table_id)		= $this->mysql->fetchRow($result);

						//берем все поля редактируемой таблицы
						$query				= "SELECT $MYSQL_TABLE17.fieldname, $MYSQL_TABLE17.edittype_id, $MYSQL_TABLE17.id, $MYSQL_TABLE18.id as `sourse_table_id`, $MYSQL_TABLE18.table_name, f.id as `sourse_field_id` FROM `$MYSQL_TABLE17` LEFT JOIN (`$MYSQL_TABLE18`) on ($MYSQL_TABLE18.table_name=$MYSQL_TABLE17.sourse_table_name) LEFT JOIN `$MYSQL_TABLE17` as `f` on (f.fieldname=$MYSQL_TABLE17.sourse_field_name AND f.table_id=$MYSQL_TABLE18.id) WHERE $MYSQL_TABLE17.table_id='{$table_id}' ORDER BY $MYSQL_TABLE17.sort_index DESC";
						$result				= $this->mysql->executeSQL($query);
						$fields				= array();
						$fieldinfo_by_name	= array();
						while ($row			= $this->mysql->fetchAssoc($result)) {
							$fields[]		= $row;

							//находим название поля первичного ключа для таблицы
							$fieldinfo_by_name[$row['fieldname']]	= $row;
						}

						list($filter_query, $where, $data_filter)	= $this->generateSQLPartFromFilter($data_filter, $dfilter, $fieldinfo_by_name);

						if ($filter_query!='')	$where_delete		= "WHERE $filter_query";
					}
				}

				$query		= "SELECT t.{$pk_incr_fieldname} FROM `{$this->current_tablename}` AS `t` $where_delete";
				$result		= $this->mysql->executeSQL($query);
				$d			= '';
				while ($row	= $this->mysql->fetchAssoc($result)) {
					$d.=$row[$pk_incr_fieldname].',';
				}

				if ($d!='') {
					$d	= mb_substr($d, 0, -1);
					$this->API->dataDeleteSourseFields($d, $this->current_tablename, $pk_incr_fieldname);
				}

				if (count($this->errors)==0) {
					$this->messages[]	= $MSGTEXT['management_block_edit_deleted_list'];
				}
			}

			//удаление выбранных записей
			elseif (isset($this->post['rows'])) {
				$delRows	= $this->post['rows'];
				$d			= '';
				foreach ($delRows as $v) {
					$d.=$v.',';
				}

				if ($d!='')	 {
					$d	= mb_substr($d,0,-1);
					$this->API->dataDeleteSourseFields($d,  $this->current_tablename, $pk_incr_fieldname);
				}

				if (count($this->errors)==0) {
					if (count($delRows)>1) {
						$this->messages[]	= $MSGTEXT['management_block_edit_deleted_list'];
					}
					else {
						$this->messages[]	= $MSGTEXT['management_block_edit_deleted'];
					}
				}
			}
		}
		else {
			//обновление сортировки
			if (isset($this->post['ids_1'])) {
				$ind=1;
				$s='';
				while (isset($this->post['ids_'.$ind]))	 {
					$id	= $this->post['ids_'.$ind];
					$v	= $this->post['sortindexes_'.$id];

					if (is_numeric($v)) {
						$query		= "UPDATE `{$this->current_tablename}` SET `sort_index`='$v' WHERE `$pk_incr_fieldname`=$id";
						$result		= $this->mysql->executeSQL($query);
					}
					$ind++;
				}
				if (count($this->errors)==0) $this->messages[]	= $MSGTEXT['management_block_edit_save'];
			}
			else {
				//удаление одной записи
				if (isset($this->get['del_id'])) {
					$this->API->dataDeleteSourseFields($this->get['del_id'],  $this->current_tablename , $pk_incr_fieldname);
					if (count($this->errors)==0) $this->messages[]	= $MSGTEXT['management_block_edit_deleted'];
				}
			}
		}


		$this->formData();
	}



	///////////////////////ВСПОМАГАТЕЛЬНЫЕ ФУНКЦИИ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * Перед экспортом некоторые данные заменяем для совместимости
	 *
	 * @param array $data
	 * @param array $fieldsExportSettings
	 * @param array $fields
	 * @return array
	 */
	function parceDataBeforeReport($data, $fieldsExportSettings, $fields) {

		//если для некоторых полей, указано, чтоб выводить числовой индекс, тогда меняем значение списков
		foreach ($fields as $key=>$f) {
			$fieldname=$f['fieldname'];
			$list_sourse_field_name='list_'.$fieldname;
			if (isset($f[$list_sourse_field_name]) && isset($fieldsExportSettings[$fieldname]['show_id']) && $fieldsExportSettings[$fieldname]['show_id']) {

				foreach ($f[$list_sourse_field_name] as $k2 => $val) {
					$f[$list_sourse_field_name][$k2][$f['sourse_field_name']]=$f[$list_sourse_field_name][$k2]['id'];
				}

				$tmp['id']=0;
				$tmp[$f['sourse_field_name']]=0;
				$f[$list_sourse_field_name]['id0']=$tmp;

				$fields[$key][$list_sourse_field_name]=$f[$list_sourse_field_name];
			}
		}

		switch ($this->gets['report_type']):
		case 'csv_report': 	{
			foreach ($data as $key=>$value)	 {
				$value		= str_replace(array(SETTINGS_NEW_LINE, ';'), '',  $value);
				$data[$key]	= $value;
			}
		}
		case 'html_report': {
			break;
		}
		endswitch;

		return array($data, $fields);
	}



	/**
	 * Создание файла-отчета
	 *
	 * @param string $report_content
	 * @return bool|string
	 */
	function createReport($table_description, $report_content) {
		GLOBAL $GENERAL_FUNCTIONS;

		switch ($this->gets['report_type']):
		case 'csv_report': 	{
			$rash	= '.csv'; break;
		}
		case 'html_report': {
			$rash	= '.htm';
			$report_content= str_replace(array(SETTINGS_NEW_LINE."</td>", SETTINGS_NEW_LINE."&nbsp;</td>"), array('</td>', '&nbsp;</td>'), $report_content);
			break;
		}
		endswitch;

		$f = $GENERAL_FUNCTIONS->userDateTime(gmdate('Y-m-d H:i:s'), SETTINGS_TIMEZONE, 'Y-m-d_H-i-s');

		$prefix=$GENERAL_FUNCTIONS->convertKirilToLatin($table_description);

		$fn		= 'reports/'.$prefix.'_'.$f.$rash;
		if ($fd	= @fopen($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/'.$fn,'w')) {
			$bom = chr(hexdec('EF')).chr(hexdec('BB')).chr(hexdec('BF'));
			fwrite($fd, $bom.$report_content);
			fclose($fd);
			return $fn;
		}
		else {
			return false;
		}
	}



	/**
	 * Формирует дерево категорй
	 *
	 * @param string $pk_field
	 * @param string $selected_filed
	 * @param string $parent_field
	 * @param int $ParentID
	 * @param int $lvl
	 * @return array
	 */	
	function makeTree($all_tree_records, $pk_field, $selected_filed, $parent_field, $fieldname,  $ParentID, $lvl) {

		$lvl++;
		$tree		=   array();
		foreach ($all_tree_records as $key=>$row) {
			if ($row[$parent_field]==$ParentID) {
				$row[$fieldname.'_deep']	= $lvl;
				$tree['id'.$row[$pk_field]]	= $row;
				$tmp						= $this->makeTree($all_tree_records, $pk_field, $selected_filed, $parent_field, $fieldname, $row['id'], $lvl);
				if (is_array($tmp))
				$tree	= array_merge($tree, $tmp);
			}
		}
		return $tree;
	}



	/**
	 * Формирует дерево категорй для обновления списка записей в родительском окне
	 *
	 * @param string $pk_field
	 * @param string $selected_filed
	 * @param string $parent_field
	 * @param int $ParentID
	 * @param int $lvl
	 * @return array
	 */	
	function makeTreeSimple($all_tree_records, $pk_field, $selected_filed, $parent_field, $fieldname,  $ParentID, $lvl) {

		$lvl++;
		$tree		=   array();
		foreach ($all_tree_records as $key=>$row) {
			if ($row[$parent_field]==$ParentID) {

				//добавляем пробел, чтоб создавалась наглядность структурной иерархии
				$probel	= '';
				for ($i=0; $i<$lvl; $i++) {
					$probel.='    ';
				}
				$row[$selected_filed]		= $probel.$row[$selected_filed];

				$row[$fieldname.'_deep']	= $lvl;
				$tree[]		= $row;
				$tmp						= $this->makeTreeSimple($all_tree_records, $pk_field, $selected_filed, $parent_field, $fieldname, $row['id'], $lvl);
				if (is_array($tmp))
				$tree	= array_merge($tree, $tmp);
			}

		}
		return $tree;
	}



	/**
	 * определяем правило поиска
	 *
	 * @param int $search_by_rule
	 * @param string|int $search
	 * @return string|int
	 */
	function getRuleSearch($search_by_rule, $search) {

		if ($search_by_rule==0) {
			$search_rule	= "'%$search%'";
		}
		elseif ($search_by_rule==1) {
			$search_rule	= "'$search'";
		}
		return $search_rule;
	}


	/**
    * Возвращает смарти
    *
    * @return array
    */
	function getSmarty() {
		return $this->smarty;
	}

}

?>