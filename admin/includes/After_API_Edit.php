<?php
if (!session_id()) {
	session_start();
}

/*///////////////////////////////////////////////////////////////////////////////////////////
Класс в котором прописываются действия после редактирования записи в таблице (сохранение, вставка, удаление) через API интерфейс
*////////////////////////////////////////////////////////////////////////////////////////////

class After_API_Edit {

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
	 * Массив полей строки из таблицы до изменения
	 *
	 * @var array
	 */
	private		$old_fields;

	/**
	 * Массив полей строки из таблицы после изменения
	 *
	 * @var array
	 */	
	private		$fields;

	/**
	 * Тип операции над записью (обновление, вставка, удалене)
	 *
	 * @var string
	 */
	private		$action;

	/**
	 * Имя выполняемого модуля
	 *
	 * @var string
	 */
	private		$module_name;

	/**
	 * Имя выполняемого блока
	 *
	 * @var string
	 */
	private		$block_name;

	/**
     * Сгенерированный HTML-код, который возвращает блок
     * 
     * @var string
     */
	public 		$contentOUT;


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
	 * @param array $old_fields
	 * @param array $fields
	 * @param array $action
	 */
	function __construct ($module_name, $block_name, $mysql=NULL, $smarty=NULL, $post=NULL, $postr=NULL, $posts=NULL, $get=NULL, $getr=NULL, $gets=NULL, $info=NULL, $current_tablename=NULL, $current_tablename_no_prefix=NULL, $lang_id=NULL, $old_fields=NULL, $fields=NULL, $action=NULL) {

		if (!defined('LANGUAGE_PREFIX_FOR_URL')) {
			define('LANGUAGE_PREFIX_FOR_URL', '');
		}

		//подключаем установленные языки материала
		include ($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/dictionary/configLanguage.php');  		//подключаем языки материала

		//заполняем переменные, если они пустые
		if ($mysql==NULL) {

			$GLOBAL_ERRORS			= array();					 										//содержит ошибки, которые возникают в скриптах
			//языковые установки
			if (!defined('LANGUAGE_PREFIX')) {
				define('LANGUAGE_PREFIX', '');
			}

			if (!defined('REQUIRE_ADDITIONAL_FILES')) {
				define('REQUIRE_ADDITIONAL_FILES', 		true);		 									//если флаг выставлен, то будует подключен язык админки и файловый менеджер
			}

			include_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/config.php';          						//настройки подключение к БД
			include_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/DbConnection.php';							//класс для работы с БД
			$mysql		= new DbConnection();

			include_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/languages/'.SETTINGS_LANGUAGE;				//подключаем язык админзоны

			//подключаем смарти
			include_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/Smarty.class.php';
			$smarty							= new Smarty();
			$smarty->cache			= true;
			$smarty->compile_check  = true;
			$smarty->template_dir	= $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/templates/';
			$smarty->compile_dir	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_c/';
			$smarty->cache_dir		= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/cache/';

			include_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/GeneralFunctions.php';				//библиотека общедоступных функций
			$GENERAL_FUNCTIONS	= new GeneralFunctions($mysql, $smarty);

			require_once ($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/FRAME_FUNCTIONS.php');				//библиотека общедоступных пользовательских функций
			$FRAME_FUNCTIONS	= new FRAME_FUNCTIONS($mysql, $smarty, SETTINGS_FRIENDLY_URL);

			$post				= $GENERAL_FUNCTIONS->post;
			$postr				= $GENERAL_FUNCTIONS->postr;
			$posts				= $GENERAL_FUNCTIONS->posts;
			$get				= $GENERAL_FUNCTIONS->get;
			$getr				= $GENERAL_FUNCTIONS->getr;
			$gets				= $GENERAL_FUNCTIONS->gets;
		}

		$lang['lang_id']			= $LANGUAGES_OF_MATERIAL[SETTINGS_LANGUAGE_OF_MATERIALS]['id'];;
		$lang['lang_prefix_for_url']= LANGUAGE_PREFIX_FOR_URL;


		$this->module_name					= $module_name;
		$this->block_name					= $block_name;
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
		$this->old_fields					= $old_fields;
		$this->fields						= $fields;
		$this->action						= $action;


		if (!isset($MYSQL_TABLE5)) {
			GLOBAL $MODULES_PATH, $MODULES_PERFORMANCE_PATCH_NAME, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE7;
		}

		//берем информацию о модуле
		$query				= "SELECT `id` FROM `$MYSQL_TABLE5` WHERE `name`='{$this->module_name}'";
		$result				= $this->mysql->executeSQL($query);
		list($module_id)	= $this->mysql->fetchRow($result);

		//берём блок
		$query				= "SELECT * FROM `$MYSQL_TABLE6` WHERE `module_id`='$module_id' AND `name`='{$this->block_name}'";
		$result				= $this->mysql->executeSQL($query);
		$block				= $this->mysql->fetchAssoc($result);


		//берём информацию о всех таблицах
		$modules_blocks 	= array();	//все блоки
		$query				= "SELECT $MYSQL_TABLE5.name AS `module_name`, $MYSQL_TABLE5.data_export_datetime AS `module_data_export_datetime`, $MYSQL_TABLE5.description AS `module_description`, $MYSQL_TABLE5.version AS `module_version`, $MYSQL_TABLE5.id AS `module_id`, $MYSQL_TABLE6.act_variable, $MYSQL_TABLE6.act_method, $MYSQL_TABLE6.url_get_vars, $MYSQL_TABLE6.id AS `block_id`, $MYSQL_TABLE6.type AS `block_type`, $MYSQL_TABLE6.name AS `block_name` FROM `$MYSQL_TABLE5`, `$MYSQL_TABLE6` WHERE $MYSQL_TABLE6.id='{$block['id']}' AND $MYSQL_TABLE6.module_id=$MYSQL_TABLE5.id";
		$result				= $this->mysql->executeSQL($query);
		while ($row			= $this->mysql->fetchAssoc($result)) {
			$modules_blocks[$row['block_id']]				= $row;
		}

		//берем все настройки блоков
		$modules_settings	= array();
		$query				= "SELECT t3.name, t3.value, t.id AS `module_id` FROM `$MYSQL_TABLE5` AS `t` LEFT JOIN `$MYSQL_TABLE6` AS `t2` ON (t2.module_id=t.id) LEFT JOIN `$MYSQL_TABLE7` AS `t3` ON (t3.block_id=t2.id)";
		$result				= $this->mysql->executeSQL($query);
		while ($row			= $this->mysql->fetchAssoc($result)) {
			$modules_settings[$row['module_id']][$row['name']]	= $row['value'];
		}


		//подключаем родительский класс для блоков
		include_once ($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/Main_modules_class.php');

		foreach ($modules_blocks as $module) {
			//создаём комию обекта смарти
			include_once ($MODULES_PATH.$module['module_name'].'/'.$module['module_name'].'.php');
			include_once ($MODULES_PATH.$module['module_name'].'/'.$MODULES_PERFORMANCE_PATCH_NAME.'/'.$module['block_name'].'.php');
			$moduleinfo['module_name']					= $module['module_name'];	//информация о модуле, которая передается блоку
			$moduleinfo['module_id']					= $module['module_id'];
			$moduleinfo['module_description']			= $module['module_description'];
			$moduleinfo['module_version']				= $module['module_version'];
			$moduleinfo['module_data_export_datetime']	= $module['module_data_export_datetime'];

			$tag			= array();
			$pageinfo		= array();

			//формируем действие
			if (!$this->action && isset($this->{$module['act_method']}[$module['act_variable']])) {
				$this->action	= $this->{$module['act_method']}[$module['act_variable']];
			}

			$obj			= new $module['block_name']($moduleinfo, $modules_settings[$module['module_id']], $this->mysql, $this->smarty, $tag, $pageinfo, $this->post, $this->postr, $this->posts, $this->get, $this->getr, $this->gets, $lang, $module['block_id'], $module['act_method'], $module['act_variable'], $module['block_name'], NULL, $this->current_tablename, $this->old_fields, $this->fields, $this->action);
			$obj->linker();
			$this->contentOUT= $obj->contentOUT;
		}
	}



	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START($lang) {


	}

	//////////////ОКОНЧАНИЕ ФУНКЦИЙ-ОБРАБОТЧИКОВ//////////////////////////////////////////////////////////////////////////////////////

}

?>