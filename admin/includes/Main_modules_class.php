<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Основной класс, на основе которого создаются блоки модулей
*////////////////////////////////////////////////////////////////////////////////////////////
class MAIN_MODULES_CLASS {

	/**
     * Информация о модуле
     *
     * @var array
     */
	public	$moduleInfo;

	/**
	 * Cмарти класс
	 *
	 * @var object
	 */
	public $smarty;

	/**
	 * Информация о теге на странице
	 *
	 * @var array
	 */
	public $tagInfo;

	/**
	 * Информация о странице
	 *
	 * @var array
	 */
	public $pageInfo;

	/**
     *  Переменные из массива $_POST
     *
     * @var array
     */
	public	$post;

	/**
     *  Переменные из массива $_POST (спец символы не заменены)
     *
     * @var array
     */
	public	$postr;

	/**
     *  Переменные из массива $_POST  экранированые функцией addslashes()
     *
     * @var array
     */
	public	$posts;

	/**
     * Переменные из массива $_GET с заменёнными символами
     *
     * @var array
     */
	public	$get;

	/**
     *  Переменные из массива $_GET (спец символы не заменены)
     *
     * @var array
     */
	public	$getr;

	/**
     *  Переменные из массива $_GET экранированые функцией addslashes()
     *
     * @var array
     */
	public	$gets;

	/**
   	 * Класс для работы с MYSQL
   	 *
   	 * @var object
   	 */
	public	$mysql;

	/**
   	 * Префикс используемых таблиц
   	 *
   	 * @var string
   	 */
	public	$tablePrefix;

	/**
   	 * Префикс используемых шаблонов
   	 *
   	 * @var string
   	 */
	public	$tplPrefix;

	/**
     * Расположение шаблонов блока
     *
     * @var string
     */
	public $tplLocation;

	/**
     * Настройки блока
     *
     * @var array
     */
	public	$settings;

	/**
     * Тип переменой вызова
     *
     * @var string
     */

	public $act_method;

	/**
   	 * Имя переменной вызова
   	 *
   	 * @var string
   	 */
	public $act_variable;

	/**
	 * Действие, которое следует выполнить
	 *
	 * @var string
	 */
	public $action;

	/**
   	 * Сообщения об ошибках
   	 */
	public $errors	= array();

	/**
	 * Сообщения
	 *
	 * @var array
	 */
	public $messages= array();

	/**
     * Класс базовых API-функций
     *
     * @var object
     */
	public $API;

	/**
     * Сгенерированный HTML-код, который возвращает блок
     * 
     * @var string
     */
	public $contentOUT;

	/**
     * id - языка материала
     *
     * @var boolean
     */
	public $lang_id;

	/**
	 * Имя отредактированной таблицы
	 *
	 * @var string
	 */
	public $after_edit_tablename;

	/**
	 * Массив полей строки из таблицы до изменения
	 *
	 * @var array
	 */
	public	$after_edit_old_fields;

	/**
	 * Массив полей строки из таблицы после изменения
	 *
	 * @var array
	 */	
	public	$after_edit_fields;

	/**
	 * Тип операции над записью (обновление, вставка, удалене)
	 *
	 * @var string
	 */
	public	$after_edit_action;


	/**
	 * Конструктор класса...
	 *
	 * @param array $moduleInfo
	 * @param array $settings 
	 * @param object $mysql
	 * @param object $smarty
	 * @param array $tagInfo
	 * @param array $pageInfo
	 * @param array $post
	 * @param array $postr
	 * @param array $posts
	 * @param array $get
	 * @param array $getr
	 * @param array $gets
	 * @param array $lang
	 * @param int $block_id
	 * @param string $act_method
	 * @param string $act_variable
	 * @param string $tplPrefix
	 * @param string $contentOUT
	 * @param string $after_edit_tablename
	 * @param array $after_edit_old_fields
	 * @param array $after_edit_fields
	 * @param string $after_edit_action
	 */
	function __construct($moduleInfo=NULL, $settings=NULL, $mysql=NULL, $smarty=NULL, $tagInfo=NULL, $pageInfo=NULL, $post=NULL, $postr=NULL, $posts=NULL, $get=NULL, $getr=NULL, $gets=NULL, $lang=NULL, $block_id=NULL, $act_method=NULL, $act_variable=NULL, $tplPrefix=NULL, $contentOUT=NULL, $after_edit_tablename=NULL, $after_edit_old_fields=NULL, $after_edit_fields=NULL, $after_edit_action=NULL) {

		$this->mysql				= $mysql;
		$this->moduleInfo   		= $moduleInfo;
		$this->smarty				= $smarty;
		$this->lang_id				= $lang['lang_id'];
		$this->tagInfo				= $tagInfo;
		$this->pageInfo				= $pageInfo;
		$this->post					= $post;
		$this->postr				= $postr;
		$this->posts				= $posts;
		$this->get					= $get;
		$this->getr					= $getr;
		$this->gets					= $gets;
		$this->tablePrefix			= mb_strtolower($this->moduleInfo['module_name']).'_';
		$this->act_method 			= $act_method;
		$this->act_variable 		= $act_variable;
		$this->tplPrefix			= $tplPrefix;
		$this->contentOUT			= $contentOUT;
		$this->settings				= $settings;
		$this->after_edit_tablename	= $after_edit_tablename;
		$this->after_edit_old_fields= $after_edit_old_fields;
		$this->after_edit_fields	= $after_edit_fields;
		$this->after_edit_action	= $after_edit_action;

		$this->tplLocation			= "{$_SERVER['DOCUMENT_ROOT']}/modules/{$this->moduleInfo['module_name']}/performance/{$this->tplPrefix}Templates/";

		if (isset($this->{$this->act_method}[$this->act_variable])) $this->action	= $this->{$this->act_method}[$this->act_variable];
		else  {
			$this->action = '';
		}
	}



	/**
	 * Создает объект для работы с API-функциями
	 *
	 * @param string $full_table_name
	 * @param array $notStripTagsForFields
	 * @param array $allowable_tags
	 * @param array $dataRow - Данные для вставки/обновления/удаления строки в таблице
	 * @return object
	 */
	function getApiObject($full_table_name='', $dataRow=array(), $notStripTagsForFields = array(), $allowable_tags = array()) {
		GLOBAL $FRAME_FUNCTIONS, $MODULES_PATH, $MYSQL_TABLE18, $MYSQL_TABLE5;


		//подгружаем имя модуля
		$query							= "SELECT t.table_name, t2.name FROM $MYSQL_TABLE18 AS `t` JOIN `$MYSQL_TABLE5` AS `t2` ON (t2.id=t.module_id) WHERE t.table_name='$full_table_name'";
		$result							= $this->mysql->executeSQLSpy($query);
		list($table_name, $module_name)	= $this->mysql->fetchRow($result);


		$get					= $this->get;
		$get['t_name']			= $full_table_name;
		$get['page_id']			= $this->pageInfo['id'];
		$get['tag_id']			= $this->tagInfo['id'];
		$info					= $this->tagInfo;
		$info['module_name'] 	= $module_name;

		//обрезаем опасные данные
		$dataRow				= $FRAME_FUNCTIONS->stripTagsFromObject($dataRow, $allowable_tags, $notStripTagsForFields);

		//берём название таблицы без префикса
		$current_tablename_no_prefix= strtolower(mb_substr($full_table_name,mb_strlen($module_name)+1));
		

		//подключаем объект API-функциий
		include_once ($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/API.php');
		$this->API 	= new API($this->mysql, $this->smarty, $this->post, $this->postr, $this->posts, $get, $this->getr, $this->gets, $info, $full_table_name, $current_tablename_no_prefix, $this->lang_id, false, $dataRow);

		return $this->API;
	}


}
?>