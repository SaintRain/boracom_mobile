<?php
/////////////////////настройки подключения к БД/////////////////////
require_once '../config.php';         					//настройки подключение к БД  админки

define ('MYSQL_CTR_HOST',							MYSQL_HOST);
define ('MYSQL_CTR_DATABASE',						MYSQL_DATABASE);
define ('MYSQL_CTR_USER',							MYSQL_USER);
define ('MYSQL_CTR_PASSWORD',						MYSQL_PASSWORD);

define ('SETTINGS_CTR_LEFT_FRAME_WIDTH',			'235');
define ('SETTINGS_SELF_PATCH_NAME',					'constructor'); //название папки, где расположены файлы, если находится в корневой директории, то оставляем пустым
define ('SETTINGS_CTR_SAVE_TO_ADMIN_STAGE',			'');			//этап сохранения изменений в модуле
define ('SETTINGS_CTR_SAVE_TO_ADMIN_LAST_TIME',			'');		//время последнего сохранения в модуль

//таблицы конструктора
$MYSQL_CTR_TABLE17='cms__ctr_modules';					//модули конструктора
$MYSQL_CTR_TABLE18='cms__ctr_tables';					//таблицы модулей
$MYSQL_CTR_TABLE19='cms__ctr_collations';				//список кодировок
$MYSQL_CTR_TABLE20='cms__ctr_datatypes';				//список типов данных
$MYSQL_CTR_TABLE21='cms__ctr_tables_fields';			//поля таблиц
$MYSQL_CTR_TABLE22='cms__ctr_edittypes';				//варианты редактирования поля
$MYSQL_CTR_TABLE23='cms__ctr_blocks';					//блоки модулей
$MYSQL_CTR_TABLE24='cms__ctr_history_sql';				//хранит SQL-запросы, которые нужно выполнить при восстановлении БД
$MYSQL_CTR_TABLE25='cms__ctr_tables_fields_settings';	//настройки полей таблиц
$MYSQL_CTR_TABLE26='cms__ctr_field_check_regular';		//хранит регулярные типы для проверки заполнения полей таблиц
$MYSQL_CTR_TABLE27='cms__ctr_block_set_edittypes';		//хранит типы редактирования настроек
$MYSQL_CTR_TABLE28='cms__ctr_blocks_settings';			//дополнительные настройки блока
$MYSQL_CTR_TABLE30='cms__ctr_blocks_templates';			//шаблоны, которые используют блоки исполнения
$MYSQL_CTR_TABLE31='cms__ctr_edit_history';				//история редактирования загруженного модуля

$BAD_SYMBOLS	= array('/','\\','"', "'");				//символы, которые вырезаются практически во всех заполняемых формах конструктора

require $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/languages/'.SETTINGS_LANGUAGE;	//подключаем язык

$SAVE_COMPILED_MODULE_PATCH_NAME = $MODULES_PATH;							//имя папки, в которую сохраняются скомпилированные модули
?>