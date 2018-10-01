<?php
/////////////////////настройки подключения к БД/////////////////////

define ('MYSQL_HOST',		'mysql');
define ('MYSQL_DATABASE',		'boracom_mobile');
define ('MYSQL_USER',		'root');
define ('MYSQL_PASSWORD',		'root');

//define ('MYSQL_HOST',		'u347973.mysql.masterhost.ru');
//define ('MYSQL_DATABASE',		'u347973');
//define ('MYSQL_USER',		'u347973');
//define ('MYSQL_PASSWORD',		'aterat6o3lit');


//настройки мемкеша
define ('SETTINGS_MEMCACHED_PORT', 11211);

define ('SETTINGS_MEMCACHED_HOST', 'localhost');

/////////////////////настройки сайта/////////////////////
define ('SETTINGS_HTTP_HOST',						'http://localhost:8081');
define ('SETTINGS_ERORR_PAGE_400',					'0');
define ('SETTINGS_ERORR_PAGE_404',					'0');
define ('SETTINGS_ERORR_PAGE_500',					'');
define ('SETTINGS_INDEX_PAGE',						'index');
define ('SETTINGS_LICENSE_URL_CHECK',				'');								//URL проверки лицензии
define ('SETTINGS_UPDATE_URL',						'http://www.goodcms.net/updates/');	//URL обновления системы

define ('SETTINGS_CACHE_REFRESH_PERIOD',			'1000');
define ('SETTINGS_TIMEZONE',						'+2');

define ('SETTINGS_HIGHLIGHT_TPL_CODE',			'1');
define ('SETTINGS_EDIT_MODE',			'1');
define ('SETTINGS_LANGUAGE',						'ru.php');
define ('SETTINGS_LANGUAGE_OF_MATERIALS',			'rus');
define ('SETTINGS_LANGUAGE_OF_MATERIALS_DEFAULT',	'rus');

define ('SETTINGS_LOG_SQL_REQUESTS',				'0');
define ('SETTINGS_LOG_SQL_MAX_FILE_SIZE',			'500');
define ('SETTINGS_SHOW_ERRORS',					'1');
define ('SETTINGS_LEFT_FRAME_WIDTH',			'265');
define ('SETTINGS_MAGIC_QUOTES_GPC',			'0');
define ('SETTINGS_RECORDS_FOR_PAGE',			'50');
define ('SETTINGS_EDITOR_TYPE',					'ckeditor');
define ('SETTINGS_FAST_EDIT_MODE',					'0');
define ('SETTINGS_FAST_EDIT_TAG',					'span');
define ('SETTINGS_FRIENDLY_URL',					'1');
define ('SETTINGS_WATERMARK_FILENAME',				'');

//настройки подключения по фтп-протоколу
define ('SETTINGS_FTP_CLIENT_HOST',				'');
define ('SETTINGS_FTP_CLIENT_USERNAME',			'admin');
define ('SETTINGS_FTP_CLIENT_PASSWORD',			'admin');

//настройки для отправки почты
define ('SETTINGS_EMAIL_TYPE',						'');
define ('SETTINGS_EMAIL_HOST',						'');
define ('SETTINGS_EMAIL_PORT',						'');
define ('SETTINGS_EMAIL_CAPTION',					'');
define ('SETTINGS_EMAIL_USERNAME',					'admin');
define ('SETTINGS_EMAIL_PASSWORD',					'admin');
define ('SETTINGS_EMAIL_SSL',						'0');

//права на запись в файл
define ('SETTINGS_CHMOD_FILES',						0777);
//права на запись в папку
define ('SETTINGS_CHMOD_FOLDERS',					0755);


//если true, тогда ко всем ссылкам в режиме FriendlyURL в конец будет добавлен слеш /
define ('SETTINGS_FRIENDLY_URL_ADD_END_SLASH',		true);


//если флаг ывставлен, тогда при добавлении/редактировании записей через API, для полей friendlyURL будет добавляться префикс - ID записи.
//это необходимо, чтоб уникальные поля отличались
define ('SETTINGS_API_FRIENDLY_AUTHO_INDEX',		true);

define ('SETTINGS_REROUTING',		                true);	        //делать ли редайрект на внешний ресурс
define ('SETTINGS_REROUTING_VARIABLE_NAME',		    'goto_url');	//название $_GET-переменной, которая передаёт ссылку для перенаправления на другой домен

//лицензионные ключи системы
$LICENSE_KEYS		= array ();


/////////////////////настройки путей/////////////////////
$TEMPLATES_PATH		= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/templates_for_site/';            	//путь, где хранятся созданные администратором шаблоны
$MODULES_PATH		= $_SERVER['DOCUMENT_ROOT'].'/modules/';              	//путь, где хранятся подключаемые модули
$TEMPORARY_DIR		= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/tmp_dir/';          //путь, к временной папке
$CSS_DIR			= $_SERVER['DOCUMENT_ROOT'].'/css/'; 					//папка, где хранятся css-файлы


$MODULES_MANAGMENT_PATCH_NAME 	= 'management';		//имя папки, в которой находятся блоки исполнения
$MODULES_PERFORMANCE_PATCH_NAME = 'performance';	//имя папки, в которой находятся блоки управления


/////////////////////названия глобальных таблиц/////////////////////
$MYSQL_TABLE1='cms_administrators';
$MYSQL_TABLE2='cms_tamplates';
$MYSQL_TABLE2_TEMPLATES	=	0;  					// код типа "шаблон"
$MYSQL_TABLE2_MODULES	=	1;  					// код типа "модуль"
$MYSQL_TABLE2_BLOCKS	=	3;						// код типа "блок"
$MYSQL_TABLE3='cms_pages';
$MYSQL_TABLE4='cms_tags';							//показывает принадлежность теггов к блокам
$MYSQL_TABLE5='cms_modules';						//модули
$MYSQL_TABLE6='cms_blocks';    						//блоки модулей
$MYSQL_TABLE7='cms_blocks_settings';				//настройки блоков
$MYSQL_TABLE8='cms_page_categories';				//категории страниц
$MYSQL_TABLE9='cms_email_sourses';					//настройки рассылки сообщений
$MYSQL_TABLE10='cms_virtualtemplates';				//конечные шаблоны
$MYSQL_TABLE11='cms_virtualtags';					//теги в конечных шаблонах
$MYSQL_TABLE12='cms_blocks_templates';				//теги в конечных шаблонах
$MYSQL_TABLE13='cms_multiselect_data';				//хранит индексы для полей с типом редактирования Multiselect
$MYSQL_TABLE15='cms_links';							//таблица ярлыков
$MYSQL_TABLE16='cms_export_settings';				//настройки экспорта для таблиц
$MYSQL_TABLE17='cms_tables_fields_settings';		//настройки полей
$MYSQL_TABLE18='cms_tables_ids';					//хранит индексы таблиц блоков
$MYSQL_TABLE19='cms_administrators_groups';			//названия администраторских групп
$MYSQL_TABLE20='cms_administrators_access';			//адреса страниц, доступ к которым запрещен для указаных групп администраторов
$MYSQL_TABLE21='cms_xlsdata';						//временное хранилище импорта xls-файлов
$MYSQL_TABLE22='cms_friendly_urls';					//Хранит подставляеммые ссылки и $_GET - данные
$MYSQL_TABLE23='cms_friendly_urls_settings';		//Страницы для которых устанавливаются правила Friendly URL
$MYSQL_TABLE24='cms_friendly_urls_settings_vars';	//Правила обработки Friendly URL
$MYSQL_TABLE25='cms_email_groups';					//группы рассылки

if (REQUIRE_ADDITIONAL_FILES) {
	require_once  $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/includes/File_Manager.php';        //класс для работы с файлами по фтп-протоколу или стандартными средствами
	$FILE_MANAGER = new FILE_MANAGER(array('host'=>SETTINGS_FTP_CLIENT_HOST, 'username'=>SETTINGS_FTP_CLIENT_USERNAME, 'password'=>SETTINGS_FTP_CLIENT_PASSWORD, 'startDir'=>''));
}

//включать ли режим быстрого редактирования
if (SETTINGS_FAST_EDIT_MODE && isset($_SESSION['___GoodCMS']['adminlogin']) && (!isset($_SESSION['___GoodCMS']['group_id']) || $_SESSION['___GoodCMS']['group_id']==0)) {
	define('GOODCMS_FAST_EDIT', true);
}
else {
	define('GOODCMS_FAST_EDIT', false);
}

define ('SETTINGS_NEW_LINE',						"\n");

//дополнительные настройки
include_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/config_more.php');

mb_internal_encoding('UTF-8'); 						//Устанавливаем кодировку строк
setlocale(LC_ALL, 'ru_RU.UTF-8'); 					//Устанавливаем нужную локаль (для дат, денег, запятых и пр.)
date_default_timezone_set('GMT')					//Временная зона по умолчанию 0 т.е. по гринвичу


?>