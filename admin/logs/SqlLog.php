<?php $LOG_QUERIES = array (
  'SELECT t.*, t2.tamplates_id as `tpl_id` FROM `cms_pages` AS `t`, `cms_virtualtemplates` AS `t2` WHERE t.name="index" AND t.enable=1 AND t.templates_id=t2.id' => 
  array (
    'time' => 0.0011,
    'count' => 2,
  ),
  'SELECT t.* FROM `cms_virtualtags` as `t` LEFT JOIN `cms_tags` AS `rt` ON (rt.id=t.tag_id) WHERE t.virtualtemplate_id=37 ORDER BY rt.sort_index' => 
  array (
    'time' => 0.0016,
    'count' => 2,
  ),
  'SELECT t.* FROM `cms_virtualtags` as `t` LEFT JOIN `cms_tags` AS `rt` ON (rt.id=t.tag_id) WHERE t.global=2 ORDER BY rt.sort_index' => 
  array (
    'time' => 0.0015,
    'count' => 8,
  ),
  'SELECT cms_tables_ids.table_name AS `genetal_tablename`, cms_tables_ids.description AS `genetal_tablename_description`, cms_modules.data_export_datetime AS `module_data_export_datetime`, cms_modules.name AS `module_name`, cms_modules.id AS `module_id`,  cms_modules.description AS `module_description`, cms_modules.version AS `module_version`, cms_blocks.act_variable, cms_blocks.act_method, cms_blocks.url_get_vars, cms_blocks.id AS `block_id`, cms_blocks.type AS `block_type`, cms_blocks.name AS `block_name`, cms_blocks.description AS `block_description` FROM `cms_modules`, `cms_blocks` LEFT JOIN `cms_tables_ids` ON (cms_tables_ids.id=cms_blocks.general_table_id) WHERE cms_blocks.id IN (518,1052,519,0,540,541,599,596,600,593,535,1014) AND cms_blocks.module_id=cms_modules.id' => 
  array (
    'time' => 0.0016,
    'count' => 2,
  ),
  'SELECT t3.name, t3.value, t.id AS `module_id` FROM `cms_modules` AS `t` LEFT JOIN `cms_blocks` AS `t2` ON (t2.module_id=t.id) LEFT JOIN `cms_blocks_settings` AS `t3` ON (t3.block_id=t2.id)' => 
  array (
    'time' => 0.0029,
    'count' => 8,
  ),
  'SELECT p.name FROM `cms_blocks` AS `b` LEFT JOIN `cms_virtualtags` AS `v` ON (v.block_id=b.id) LEFT JOIN `cms_pages` AS `p` ON (p.templates_id=v.virtualtemplate_id) WHERE b.name=\'SearchResult\'' => 
  array (
    'time' => 0.0007,
    'count' => 8,
  ),
  'SELECT m.*, cms_pages.name FROM `menu_data` as `m`  LEFT JOIN (`cms_pages`) ON (m.pageid=cms_pages.id) ORDER BY m.sort_index DESC' => 
  array (
    'time' => 0.0009,
    'count' => 8,
  ),
  'SELECT t.id, t.caption, t.parent_id FROM `internetshop_categories` AS `t` WHERE t.active=1 ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0008,
    'count' => 8,
  ),
  'SELECT `category_id`, count(*) AS `count` FROM `internetshop_products` WHERE `active`=1 AND `category_id` IN (321,320,319,318,317,316,315,314,313,312,311,310,309,308,307,306,305,304,303,302,300) GROUP BY `category_id`' => 
  array (
    'time' => 0.0013,
    'count' => 8,
  ),
  'SELECT count(*) FROM `internetshop_products` AS `t` 
		LEFT JOIN `internetshop_categories` AS `t2` ON (t2.id=t.category_id)
		LEFT JOIN `internetshop_discount` AS `t4` ON (t4.id=t.discount_type)
		WHERE t.nova=1   ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0007,
    'count' => 2,
  ),
  'SELECT t.*,
		t2.caption AS `category_id_caption` ,
		t4.name AS `discount_type_caption` ,
		t4.discount
		FROM `internetshop_products` AS `t` 
		LEFT JOIN `internetshop_categories` AS `t2` ON (t2.id=t.category_id)
		LEFT JOIN `internetshop_discount` AS `t4` ON (t4.id=t.discount_type)
		WHERE t.nova=1   ORDER BY t.sort_index DESC LIMIT 0,10' => 
  array (
    'time' => 0.0007,
    'count' => 2,
  ),
  'SELECT * FROM `internetshop_currencies` ORDER BY `sort_index` DESC LIMIT 1' => 
  array (
    'time' => 0.0003,
    'count' => 4,
  ),
  'SELECT * FROM `internetshop_courses` WHERE `sell_currency_id`=\'1\' ORDER BY `sort_index`' => 
  array (
    'time' => 0.0005,
    'count' => 4,
  ),
  'SELECT product_id, count(*) AS `count`, sum(points) AS `points_width` FROM internetshop_products_comments WHERE enable=1 AND points>0 AND product_id IN (477,476) GROUP BY product_id' => 
  array (
    'time' => 0.0006,
    'count' => 3,
  ),
  'SELECT * FROM `internetshop_currencies` ORDER BY `sort_index` DESC' => 
  array (
    'time' => 0.0006,
    'count' => 8,
  ),
  'SELECT t.id, t.caption, t.short_text, left(t.full_text, 1) AS `full_text`, t.datetime FROM `news_data` AS `t` WHERE t.enable=1 ORDER BY t.sort_index DESC LIMIT 2' => 
  array (
    'time' => 0.0006,
    'count' => 8,
  ),
  'SELECT t.* FROM `voiting_questions` AS `t` WHERE t.main=\'1\' AND t.enable=\'1\'' => 
  array (
    'time' => 0.0006,
    'count' => 8,
  ),
  'SELECT t.* FROM `voiting_answers` AS `t` WHERE t.question_id=\'1\' AND t.enable=\'1\'' => 
  array (
    'time' => 0.0006,
    'count' => 8,
  ),
  'SELECT t.* FROM `voiting_results` AS `t` WHERE t.answer_id IN (1,2,3)' => 
  array (
    'time' => 0.0007,
    'count' => 8,
  ),
  'SELECT `text`, `tag_id` FROM `simpletext_data` WHERE ((`page_id`=\'61\' AND `tag_id`=\'696\') OR (`page_id`=\'61\' AND `tag_id`=\'697\') OR (`page_id`=\'61\' AND `tag_id`=\'698\') OR (`page_id`=\'-1\' AND `tag_id`=\'702\')) AND (`lang_id`=\'1\' OR `global`=\'1\')' => 
  array (
    'time' => 0.0008,
    'count' => 2,
  ),
  'SELECT `text`, `tag_id` FROM `richtext_data` WHERE ((`page_id`=\'-1\' AND `tag_id`=\'1007\') OR (`page_id`=\'-1\' AND `tag_id`=\'704\') OR (`page_id`=\'-1\' AND `tag_id`=\'907\') OR (`page_id`=\'61\' AND `tag_id`=\'700\') OR (`page_id`=\'-1\' AND `tag_id`=\'703\') OR (`page_id`=\'-1\' AND `tag_id`=\'919\')) AND (`lang_id`=\'1\' OR `global`=\'1\')' => 
  array (
    'time' => 0.0012,
    'count' => 2,
  ),
  'SELECT `id`, `name` FROM `cms_pages`' => 
  array (
    'time' => 0.0006,
    'count' => 8,
  ),
  'SELECT * FROM `cms_friendly_urls_settings` WHERE `enable`=1' => 
  array (
    'time' => 0.0003,
    'count' => 8,
  ),
  'SELECT t.*, t2.table_name, t3.fieldname FROM `cms_friendly_urls_settings_vars` AS `t` LEFT JOIN `cms_tables_ids` AS `t2` ON (t2.id=t.table_id) LEFT JOIN `cms_tables_fields_settings` AS `t3` ON (t3.table_id=t2.id AND t3.edittype_id=14 AND t3.unique=1) WHERE t.urls_settings_id=\'50\' ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0005,
    'count' => 8,
  ),
  'SELECT t.*, t2.table_name, t3.fieldname FROM `cms_friendly_urls_settings_vars` AS `t` LEFT JOIN `cms_tables_ids` AS `t2` ON (t2.id=t.table_id) LEFT JOIN `cms_tables_fields_settings` AS `t3` ON (t3.table_id=t2.id AND t3.edittype_id=14 AND t3.unique=1) WHERE t.urls_settings_id=\'51\' ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0005,
    'count' => 8,
  ),
  'SELECT t.*, t2.table_name, t3.fieldname FROM `cms_friendly_urls_settings_vars` AS `t` LEFT JOIN `cms_tables_ids` AS `t2` ON (t2.id=t.table_id) LEFT JOIN `cms_tables_fields_settings` AS `t3` ON (t3.table_id=t2.id AND t3.edittype_id=14 AND t3.unique=1) WHERE t.urls_settings_id=\'52\' ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0005,
    'count' => 8,
  ),
  'SELECT t.*, t2.table_name, t3.fieldname FROM `cms_friendly_urls_settings_vars` AS `t` LEFT JOIN `cms_tables_ids` AS `t2` ON (t2.id=t.table_id) LEFT JOIN `cms_tables_fields_settings` AS `t3` ON (t3.table_id=t2.id AND t3.edittype_id=14 AND t3.unique=1) WHERE t.urls_settings_id=\'53\' ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0004,
    'count' => 8,
  ),
  'SELECT t.*, t2.table_name, t3.fieldname FROM `cms_friendly_urls_settings_vars` AS `t` LEFT JOIN `cms_tables_ids` AS `t2` ON (t2.id=t.table_id) LEFT JOIN `cms_tables_fields_settings` AS `t3` ON (t3.table_id=t2.id AND t3.edittype_id=14 AND t3.unique=1) WHERE t.urls_settings_id=\'54\' ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0004,
    'count' => 8,
  ),
  'SELECT t.*, t2.table_name, t3.fieldname FROM `cms_friendly_urls_settings_vars` AS `t` LEFT JOIN `cms_tables_ids` AS `t2` ON (t2.id=t.table_id) LEFT JOIN `cms_tables_fields_settings` AS `t3` ON (t3.table_id=t2.id AND t3.edittype_id=14 AND t3.unique=1) WHERE t.urls_settings_id=\'55\' ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0005,
    'count' => 8,
  ),
  'SELECT t.*, t2.table_name, t3.fieldname FROM `cms_friendly_urls_settings_vars` AS `t` LEFT JOIN `cms_tables_ids` AS `t2` ON (t2.id=t.table_id) LEFT JOIN `cms_tables_fields_settings` AS `t3` ON (t3.table_id=t2.id AND t3.edittype_id=14 AND t3.unique=1) WHERE t.urls_settings_id=\'56\' ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0005,
    'count' => 8,
  ),
  'SELECT t.*, t2.table_name, t3.fieldname FROM `cms_friendly_urls_settings_vars` AS `t` LEFT JOIN `cms_tables_ids` AS `t2` ON (t2.id=t.table_id) LEFT JOIN `cms_tables_fields_settings` AS `t3` ON (t3.table_id=t2.id AND t3.edittype_id=14 AND t3.unique=1) WHERE t.urls_settings_id=\'57\' ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0006,
    'count' => 8,
  ),
  'SELECT t.*, t2.table_name, t3.fieldname FROM `cms_friendly_urls_settings_vars` AS `t` LEFT JOIN `cms_tables_ids` AS `t2` ON (t2.id=t.table_id) LEFT JOIN `cms_tables_fields_settings` AS `t3` ON (t3.table_id=t2.id AND t3.edittype_id=14 AND t3.unique=1) WHERE t.urls_settings_id=\'58\' ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0007,
    'count' => 8,
  ),
  'SELECT t.*, t2.table_name, t3.fieldname FROM `cms_friendly_urls_settings_vars` AS `t` LEFT JOIN `cms_tables_ids` AS `t2` ON (t2.id=t.table_id) LEFT JOIN `cms_tables_fields_settings` AS `t3` ON (t3.table_id=t2.id AND t3.edittype_id=14 AND t3.unique=1) WHERE t.urls_settings_id=\'59\' ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0008,
    'count' => 8,
  ),
  'SELECT t.*, t2.table_name, t3.fieldname FROM `cms_friendly_urls_settings_vars` AS `t` LEFT JOIN `cms_tables_ids` AS `t2` ON (t2.id=t.table_id) LEFT JOIN `cms_tables_fields_settings` AS `t3` ON (t3.table_id=t2.id AND t3.edittype_id=14 AND t3.unique=1) WHERE t.urls_settings_id=\'60\' ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0009,
    'count' => 8,
  ),
  'SELECT * FROM `cms_friendly_urls` WHERE `request_uri` IN (\'category_id=321\',\'category_id=320\',\'category_id=319\',\'category_id=317\',\'category_id=316\',\'category_id=314\',\'category_id=315\',\'category_id=312\',\'category_id=311\',\'category_id=310\',\'category_id=308\',\'category_id=307\',\'category_id=306\',\'category_id=305\',\'category_id=303\',\'category_id=302\',\'category_id=300\',\'for_page=5\',\'for_page=10\',\'for_page=15\',\'page=1\',\'act=more&category_id=321&id=477\',\'act=more&category_id=321&id=476\',\'act=more&id=5\',\'act=add_voiting\')' => 
  array (
    'time' => 0.0013,
    'count' => 2,
  ),
  'SELECT t.*, t2.tamplates_id as `tpl_id` FROM `cms_pages` AS `t`, `cms_virtualtemplates` AS `t2` WHERE t.name="contacts" AND t.enable=1 AND t.templates_id=t2.id' => 
  array (
    'time' => 0.001,
    'count' => 1,
  ),
  'SELECT t.* FROM `cms_virtualtags` as `t` LEFT JOIN `cms_tags` AS `rt` ON (rt.id=t.tag_id) WHERE t.virtualtemplate_id=42 ORDER BY rt.sort_index' => 
  array (
    'time' => 0.0017,
    'count' => 1,
  ),
  'SELECT cms_tables_ids.table_name AS `genetal_tablename`, cms_tables_ids.description AS `genetal_tablename_description`, cms_modules.data_export_datetime AS `module_data_export_datetime`, cms_modules.name AS `module_name`, cms_modules.id AS `module_id`,  cms_modules.description AS `module_description`, cms_modules.version AS `module_version`, cms_blocks.act_variable, cms_blocks.act_method, cms_blocks.url_get_vars, cms_blocks.id AS `block_id`, cms_blocks.type AS `block_type`, cms_blocks.name AS `block_name`, cms_blocks.description AS `block_description` FROM `cms_modules`, `cms_blocks` LEFT JOIN `cms_tables_ids` ON (cms_tables_ids.id=cms_blocks.general_table_id) WHERE cms_blocks.id IN (518,1052,519,0,540,541,599,559,600,593,535,1014) AND cms_blocks.module_id=cms_modules.id' => 
  array (
    'time' => 0.0016,
    'count' => 1,
  ),
  'SELECT t.*, t2.reg FROM `contacts_data` AS `t` LEFT JOIN `contacts_regs` AS `t2` ON (t2.id=t.regular) ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.059,
    'count' => 1,
  ),
  'SELECT `text`, `tag_id` FROM `simpletext_data` WHERE ((`page_id`=\'67\' AND `tag_id`=\'758\') OR (`page_id`=\'67\' AND `tag_id`=\'759\') OR (`page_id`=\'67\' AND `tag_id`=\'760\') OR (`page_id`=\'67\' AND `tag_id`=\'794\') OR (`page_id`=\'-1\' AND `tag_id`=\'702\')) AND (`lang_id`=\'1\' OR `global`=\'1\')' => 
  array (
    'time' => 0.0014,
    'count' => 1,
  ),
  'SELECT `text`, `tag_id` FROM `richtext_data` WHERE ((`page_id`=\'-1\' AND `tag_id`=\'1007\') OR (`page_id`=\'-1\' AND `tag_id`=\'704\') OR (`page_id`=\'-1\' AND `tag_id`=\'907\') OR (`page_id`=\'-1\' AND `tag_id`=\'703\') OR (`page_id`=\'-1\' AND `tag_id`=\'919\')) AND (`lang_id`=\'1\' OR `global`=\'1\')' => 
  array (
    'time' => 0.0009,
    'count' => 5,
  ),
  'SELECT * FROM `cms_friendly_urls` WHERE `request_uri` IN (\'category_id=321\',\'category_id=320\',\'category_id=319\',\'category_id=317\',\'category_id=316\',\'category_id=314\',\'category_id=315\',\'category_id=312\',\'category_id=311\',\'category_id=310\',\'category_id=308\',\'category_id=307\',\'category_id=306\',\'category_id=305\',\'category_id=303\',\'category_id=302\',\'category_id=300\',\'act=more&id=5\',\'act=add_voiting\')' => 
  array (
    'time' => 0.0011,
    'count' => 3,
  ),
  'SELECT t.*, t2.tamplates_id as `tpl_id` FROM `cms_pages` AS `t`, `cms_virtualtemplates` AS `t2` WHERE t.name="dostavka" AND t.enable=1 AND t.templates_id=t2.id' => 
  array (
    'time' => 0.001,
    'count' => 1,
  ),
  'SELECT t.* FROM `cms_virtualtags` as `t` LEFT JOIN `cms_tags` AS `rt` ON (rt.id=t.tag_id) WHERE t.virtualtemplate_id=54 ORDER BY rt.sort_index' => 
  array (
    'time' => 0.0017,
    'count' => 1,
  ),
  'SELECT cms_tables_ids.table_name AS `genetal_tablename`, cms_tables_ids.description AS `genetal_tablename_description`, cms_modules.data_export_datetime AS `module_data_export_datetime`, cms_modules.name AS `module_name`, cms_modules.id AS `module_id`,  cms_modules.description AS `module_description`, cms_modules.version AS `module_version`, cms_blocks.act_variable, cms_blocks.act_method, cms_blocks.url_get_vars, cms_blocks.id AS `block_id`, cms_blocks.type AS `block_type`, cms_blocks.name AS `block_name`, cms_blocks.description AS `block_description` FROM `cms_modules`, `cms_blocks` LEFT JOIN `cms_tables_ids` ON (cms_tables_ids.id=cms_blocks.general_table_id) WHERE cms_blocks.id IN (518,1052,519,0,540,541,599,600,593,535,1014) AND cms_blocks.module_id=cms_modules.id' => 
  array (
    'time' => 0.0016,
    'count' => 1,
  ),
  'SELECT `text`, `tag_id` FROM `simpletext_data` WHERE ((`page_id`=\'91\' AND `tag_id`=\'950\') OR (`page_id`=\'91\' AND `tag_id`=\'951\') OR (`page_id`=\'91\' AND `tag_id`=\'952\') OR (`page_id`=\'91\' AND `tag_id`=\'959\') OR (`page_id`=\'-1\' AND `tag_id`=\'702\')) AND (`lang_id`=\'1\' OR `global`=\'1\')' => 
  array (
    'time' => 0.0008,
    'count' => 1,
  ),
  'SELECT `text`, `tag_id` FROM `richtext_data` WHERE ((`page_id`=\'-1\' AND `tag_id`=\'1007\') OR (`page_id`=\'-1\' AND `tag_id`=\'704\') OR (`page_id`=\'-1\' AND `tag_id`=\'907\') OR (`page_id`=\'91\' AND `tag_id`=\'962\') OR (`page_id`=\'-1\' AND `tag_id`=\'703\') OR (`page_id`=\'-1\' AND `tag_id`=\'919\')) AND (`lang_id`=\'1\' OR `global`=\'1\')' => 
  array (
    'time' => 0.0008,
    'count' => 1,
  ),
  'SELECT t.*, t2.tamplates_id as `tpl_id` FROM `cms_pages` AS `t`, `cms_virtualtemplates` AS `t2` WHERE t.name="fotogalereya" AND t.enable=1 AND t.templates_id=t2.id' => 
  array (
    'time' => 0.0009,
    'count' => 2,
  ),
  'SELECT t.* FROM `cms_virtualtags` as `t` LEFT JOIN `cms_tags` AS `rt` ON (rt.id=t.tag_id) WHERE t.virtualtemplate_id=40 ORDER BY rt.sort_index' => 
  array (
    'time' => 0.0017,
    'count' => 2,
  ),
  'SELECT cms_tables_ids.table_name AS `genetal_tablename`, cms_tables_ids.description AS `genetal_tablename_description`, cms_modules.data_export_datetime AS `module_data_export_datetime`, cms_modules.name AS `module_name`, cms_modules.id AS `module_id`,  cms_modules.description AS `module_description`, cms_modules.version AS `module_version`, cms_blocks.act_variable, cms_blocks.act_method, cms_blocks.url_get_vars, cms_blocks.id AS `block_id`, cms_blocks.type AS `block_type`, cms_blocks.name AS `block_name`, cms_blocks.description AS `block_description` FROM `cms_modules`, `cms_blocks` LEFT JOIN `cms_tables_ids` ON (cms_tables_ids.id=cms_blocks.general_table_id) WHERE cms_blocks.id IN (547,549,548,1052,519,0,540,541,599,518,546,600,593,535,1014) AND cms_blocks.module_id=cms_modules.id' => 
  array (
    'time' => 0.0017,
    'count' => 2,
  ),
  'SELECT m.*FROM `photogallery_data` as `m`  ORDER BY m.sort_index DESC' => 
  array (
    'time' => 0.0173,
    'count' => 1,
  ),
  'SELECT `text`, `tag_id` FROM `simpletext_data` WHERE ((`page_id`=\'65\' AND `tag_id`=\'792\') OR (`page_id`=\'-1\' AND `tag_id`=\'702\')) AND (`lang_id`=\'1\' OR `global`=\'1\')' => 
  array (
    'time' => 0.0006,
    'count' => 2,
  ),
  'SELECT * FROM `cms_friendly_urls` WHERE `request_uri` IN (\'category_id=321\',\'category_id=320\',\'category_id=319\',\'category_id=317\',\'category_id=316\',\'category_id=314\',\'category_id=315\',\'category_id=312\',\'category_id=311\',\'category_id=310\',\'category_id=308\',\'category_id=307\',\'category_id=306\',\'category_id=305\',\'category_id=303\',\'category_id=302\',\'category_id=300\',\'act=more&id=1\',\'act=more&id=5\',\'act=add_voiting\')' => 
  array (
    'time' => 0.0011,
    'count' => 1,
  ),
  'SELECT `request_uri` FROM `cms_friendly_urls` WHERE `page_id`=\'65\' AND `friendly_url`=\'proizvodimye-monitory\'' => 
  array (
    'time' => 0.0004,
    'count' => 1,
  ),
  'SELECT t.title FROM `photogallery_data` AS `t`  WHERE t.enable=1 AND t.id=\'1\'' => 
  array (
    'time' => 0.0005,
    'count' => 1,
  ),
  'SELECT t.metakeywords FROM `photogallery_data` AS `t`  WHERE t.enable=1 AND t.id=\'1\'' => 
  array (
    'time' => 0.0004,
    'count' => 1,
  ),
  'SELECT t.metadescription FROM `photogallery_data` AS `t` WHERE t.enable=1 AND t.id=\'1\'' => 
  array (
    'time' => 0.0003,
    'count' => 1,
  ),
  'SELECT m.* FROM `photogallery_data` as `m`  WHERE m.id=\'1\'' => 
  array (
    'time' => 0.0006,
    'count' => 1,
  ),
  'SELECT t.*, t2.tamplates_id as `tpl_id` FROM `cms_pages` AS `t`, `cms_virtualtemplates` AS `t2` WHERE t.name="internet-shop" AND t.enable=1 AND t.templates_id=t2.id' => 
  array (
    'time' => 0.001,
    'count' => 2,
  ),
  'SELECT `request_uri` FROM `cms_friendly_urls` WHERE `page_id`=\'68\' AND `friendly_url`=\'televizory\'' => 
  array (
    'time' => 0.0004,
    'count' => 1,
  ),
  'SELECT t.* FROM `cms_virtualtags` as `t` LEFT JOIN `cms_tags` AS `rt` ON (rt.id=t.tag_id) WHERE t.virtualtemplate_id=43 ORDER BY rt.sort_index' => 
  array (
    'time' => 0.0018,
    'count' => 2,
  ),
  'SELECT cms_tables_ids.table_name AS `genetal_tablename`, cms_tables_ids.description AS `genetal_tablename_description`, cms_modules.data_export_datetime AS `module_data_export_datetime`, cms_modules.name AS `module_name`, cms_modules.id AS `module_id`,  cms_modules.description AS `module_description`, cms_modules.version AS `module_version`, cms_blocks.act_variable, cms_blocks.act_method, cms_blocks.url_get_vars, cms_blocks.id AS `block_id`, cms_blocks.type AS `block_type`, cms_blocks.name AS `block_name`, cms_blocks.description AS `block_description` FROM `cms_modules`, `cms_blocks` LEFT JOIN `cms_tables_ids` ON (cms_tables_ids.id=cms_blocks.general_table_id) WHERE cms_blocks.id IN (584,583,581,1052,519,0,540,541,599,585,598,1004,590,600,593,535,1014,518) AND cms_blocks.module_id=cms_modules.id' => 
  array (
    'time' => 0.0018,
    'count' => 2,
  ),
  'SELECT t.title FROM `internetshop_categories` AS `t` WHERE t.id=\'321\'' => 
  array (
    'time' => 0.0009,
    'count' => 1,
  ),
  'SELECT t.metakeywords FROM `internetshop_categories` AS `t` WHERE t.id=\'321\'' => 
  array (
    'time' => 0.0008,
    'count' => 1,
  ),
  'SELECT t.metadescription FROM `internetshop_categories` AS `t` WHERE t.id=\'321\'' => 
  array (
    'time' => 0.0005,
    'count' => 1,
  ),
  'SELECT t.id, t.parent_id FROM `internetshop_categories` AS `t` WHERE t.id=\'321\'' => 
  array (
    'time' => 0.0005,
    'count' => 2,
  ),
  'SELECT t.caption, t.id FROM `internetshop_categories` AS `t` WHERE t.id=\'321\'' => 
  array (
    'time' => 0.0006,
    'count' => 1,
  ),
  'SELECT t.id, t.parent_id, t.caption FROM `internetshop_categories` AS `t` WHERE t.id=\'321\'' => 
  array (
    'time' => 0.0005,
    'count' => 2,
  ),
  'SELECT * FROM `internetshop_categories` AS `t` WHERE t.id=\'321\'' => 
  array (
    'time' => 0.0006,
    'count' => 1,
  ),
  'SELECT count(*) FROM `internetshop_products` AS `t` 
		LEFT JOIN `internetshop_categories` AS `t2` ON (t2.id=t.category_id)
		LEFT JOIN `internetshop_currencies` AS `t3` ON (t3.id=t.currency_id)
		LEFT JOIN `internetshop_discount` AS `t4` ON (t4.id=t.discount_type)
		LEFT JOIN `internetshop_brands` AS `t5` ON (t5.id=t.brand_id) WHERE t.category_id=\'321\' AND t.active=1 
		ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.012,
    'count' => 1,
  ),
  'SELECT t.*,
		t2.caption AS `category_id_caption` ,
		t3.name AS `currency_id_caption` ,
		t4.name AS `discount_type_caption` ,
		t4.discount,
		t5.name AS `brand_id_caption` 
		FROM `internetshop_products` AS `t` 
		LEFT JOIN `internetshop_categories` AS `t2` ON (t2.id=t.category_id)
		LEFT JOIN `internetshop_currencies` AS `t3` ON (t3.id=t.currency_id)
		LEFT JOIN `internetshop_discount` AS `t4` ON (t4.id=t.discount_type)
		LEFT JOIN `internetshop_brands` AS `t5` ON (t5.id=t.brand_id) WHERE t.category_id=\'321\' AND t.active=1 
		ORDER BY t.sort_index DESC LIMIT 0,10' => 
  array (
    'time' => 0.001,
    'count' => 1,
  ),
  'SELECT `text`, `tag_id` FROM `simpletext_data` WHERE ((`page_id`=\'-1\' AND `tag_id`=\'702\')) AND (`lang_id`=\'1\' OR `global`=\'1\')' => 
  array (
    'time' => 0.0006,
    'count' => 2,
  ),
  'SELECT * FROM `cms_friendly_urls` WHERE `request_uri` IN (\'category_id=321\',\'category_id=320\',\'category_id=319\',\'category_id=317\',\'category_id=316\',\'category_id=314\',\'category_id=315\',\'category_id=312\',\'category_id=311\',\'category_id=310\',\'category_id=308\',\'category_id=307\',\'category_id=306\',\'category_id=305\',\'category_id=303\',\'category_id=302\',\'category_id=300\',\'category_id=321&for_page=5\',\'category_id=321&for_page=10\',\'category_id=321&for_page=15\',\'category_id=321&page=1\',\'act=more&category_id=321&id=477\',\'act=more&category_id=321&id=476\',\'act=more&id=5\',\'act=add_voiting\')' => 
  array (
    'time' => 0.0011,
    'count' => 1,
  ),
  'SELECT `request_uri` FROM `cms_friendly_urls` WHERE `page_id`=\'68\' AND `friendly_url`=\'televizory/televizor-sharp\'' => 
  array (
    'time' => 0.0006,
    'count' => 1,
  ),
  'SELECT t.title FROM `internetshop_products` AS `t` WHERE t.id=\'477\'' => 
  array (
    'time' => 0.0005,
    'count' => 1,
  ),
  'SELECT t.metakeywords FROM `internetshop_products` AS `t` WHERE t.id=\'477\'' => 
  array (
    'time' => 0.0003,
    'count' => 1,
  ),
  'SELECT t.metadescription FROM `internetshop_products` AS `t` WHERE t.id=\'477\'' => 
  array (
    'time' => 0.0005,
    'count' => 1,
  ),
  'SELECT t.caption, t.id FROM `internetshop_products` AS `t` WHERE t.id=\'477\'' => 
  array (
    'time' => 0.0006,
    'count' => 1,
  ),
  'SELECT t.*,
			t2.caption AS `category_id_caption` ,
			t3.name AS `currency_id_caption` ,
			t4.name AS `discount_type_caption` ,
			t4.discount,			
			t5.name AS `brand_id_caption` 
			FROM `internetshop_products` AS `t` 
			LEFT JOIN `internetshop_categories` AS `t2` ON (t2.id=t.category_id)
			LEFT JOIN `internetshop_currencies` AS `t3` ON (t3.id=t.currency_id)
			LEFT JOIN `internetshop_discount` AS `t4` ON (t4.id=t.discount_type)
			LEFT JOIN `internetshop_brands` AS `t5` ON (t5.id=t.brand_id) WHERE t.id=\'477\' AND t.active=1
			ORDER BY t.sort_index DESC' => 
  array (
    'time' => 0.0009,
    'count' => 1,
  ),
  'SELECT count(*) FROM `internetshop_products_comments` AS `t` WHERE t.product_id=\'477\' AND t.enable=1' => 
  array (
    'time' => 0.0005,
    'count' => 1,
  ),
  'SELECT t.* FROM `internetshop_products_comments` AS `t` WHERE t.product_id=\'477\' AND t.enable=1 LIMIT 0,10' => 
  array (
    'time' => 0.0002,
    'count' => 1,
  ),
  'SELECT * FROM `cms_friendly_urls` WHERE `request_uri` IN (\'category_id=321\',\'category_id=320\',\'category_id=319\',\'category_id=317\',\'category_id=316\',\'category_id=314\',\'category_id=315\',\'category_id=312\',\'category_id=311\',\'category_id=310\',\'category_id=308\',\'category_id=307\',\'category_id=306\',\'category_id=305\',\'category_id=303\',\'category_id=302\',\'category_id=300\',\'act=more&id=5\',\'act=insert_comments&category_id=321&id=477\',\'act=add_voiting\')' => 
  array (
    'time' => 0.0024,
    'count' => 1,
  ),
); ?>