<?php

/* ///////////////////////////////////////////////////////////////////////////////////////////
  Выдаёт содержимое запрашиваемой страницы
 *////////////////////////////////////////////////////////////////////////////////////////////

class getPage {

    /**
     * смарти-класс
     * @var class
     */
    public $smarty;

    /**
     * Имя страницы
     *
     * @var string
     */
    public $pageName;

    /**
     * имя файла шаблона
     *
     * @var string
     */
    public $templateFileName;

    /**
     * класс для работы с MYSQL
     *
     * @var object
     */
    public $mysql;

    /**
     * Содержит сгенерированный код страницы
     *
     * @var text
     */
    public $contentOUT;

    /**
     * Конструктор
     *
     * @param array $pageinfo
     * @param string $pageName
     * @param object $smarty
     * @param object $mysql
     * @param object $memcache
     * @param bool $checkURL
     * @return string
     */
    function __construct($pageinfo, $pageName, $smarty, $mysql, $checkURL = true) {
        GLOBAL $FILE_MANAGER, $TOTAL_TAGS, $COUNT_TYPE_2_TAGS, $_GET_NEW, $_GET_NEW_FULL, $LANGUAGES_OF_MATERIAL, $LANGUAGE_PREFIX, $GENERAL_FUNCTIONS, $MYSQL_TABLE18, $MYSQL_TABLE2, $MYSQL_TABLE3, $MYSQL_TABLE4, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE7, $MYSQL_TABLE10, $MYSQL_TABLE11, $MYSQL_TABLE14, $MODULES_PATH, $MODULES_PERFORMANCE_PATCH_NAME;

        $this->mysql = $mysql;
        $this->pageName = $pageName;
        $this->smarty = $smarty;

        $get = $GENERAL_FUNCTIONS->get;
        $getr = $GENERAL_FUNCTIONS->getr;
        $gets = $GENERAL_FUNCTIONS->gets;
        $post = $GENERAL_FUNCTIONS->post;
        $postr = $GENERAL_FUNCTIONS->postr;
        $posts = $GENERAL_FUNCTIONS->posts;

        //если страницы нет, то выводим сообщение об ошибке
        if ($checkURL && (!$pageinfo || $pageinfo['templates_id'] == 0)) {
            $pageinfo = $this->getErrorPage($pageName);
        }
        $this->templateFileName = $pageinfo['tpl_id'] . '.tpl';


        $tags_all = $GENERAL_FUNCTIONS->getTagsTree($pageinfo['tpl_id'], $pageinfo['templates_id'], 0);

        $blocks_ids = array();
        $tags = array();
        foreach ($tags_all AS $i => $tag) {
            //если тегу назначен блок
            $tag['system_tagname'] = 'tag' . $tag['real_tag_id'];
            $tags[] = $tag;
            if (is_numeric($tag['block_id']) && $tag['block_id'] > 0) {
                $blocks_ids[$tag['block_id']] = $tag['block_id'];
            }
        }



        $blocks_ids = implode(',', $blocks_ids);
        $loaded_modules = array();
        $used_blocks = array(); //использованные повторно блоки типа - СПИСОК
        $record_blocks = array(); //блоки типа - ЗАПИСЬ
        $modificator_blocks = array();  //блоки типа - МОДИФИКАТОР
        $modules_blocks = array(); //все блоки
        $url_get_vars = array(); //$_GET переменные, которые можно использовать в режиме Friendly URL
        //если сайт смотрит администратор и включен режим быстрого редактирования
        if (GOODCMS_FAST_EDIT) {

            //берём информацию о всех таблицах
            $tablesInfo = array();
            $query = "SELECT t.table_name, t.description, t2.id AS `block_id`, t3.global, t3.id AS `tag_id`, t5.id AS `page_id` FROM `$MYSQL_TABLE18` AS `t`
				LEFT JOIN `$MYSQL_TABLE6` AS `t2` ON (t2.general_table_id=t.id)
				LEFT JOIN `$MYSQL_TABLE11` AS `t3` ON (t3.block_id=t2.id) 
				LEFT JOIN `$MYSQL_TABLE10` AS `t4` ON (t3.virtualtemplate_id=t4.id) 
				LEFT JOIN `$MYSQL_TABLE3` AS `t5` ON (t5.templates_id=t4.id) 
				WHERE t3.id>0 AND t5.id>0";

            $result = $this->mysql->executeSQLSpy($query);
            while ($row = $this->mysql->fetchAssoc($result)) {
                if (!isset($tablesInfo[$row['table_name']])) {
                    $tablesInfo[$row['table_name']] = $row;
                } else if ($row['global'] > $tablesInfo[$row['table_name']]['global']) {
                    $tablesInfo[$row['table_name']] = $row;
                }
            }

            $query = "SELECT $MYSQL_TABLE18.table_name AS `genetal_tablename`, $MYSQL_TABLE18.description AS `genetal_tablename_description`, $MYSQL_TABLE5.data_export_datetime AS `module_data_export_datetime`, $MYSQL_TABLE5.name AS `module_name`, $MYSQL_TABLE5.id AS `module_id`,  $MYSQL_TABLE5.description AS `module_description`, $MYSQL_TABLE5.version AS `module_version`, $MYSQL_TABLE6.act_variable, $MYSQL_TABLE6.act_method, $MYSQL_TABLE6.url_get_vars, $MYSQL_TABLE6.id AS `block_id`, $MYSQL_TABLE6.type AS `block_type`, $MYSQL_TABLE6.name AS `block_name`, $MYSQL_TABLE6.description AS `block_description` FROM `$MYSQL_TABLE5`, `$MYSQL_TABLE6` LEFT JOIN `$MYSQL_TABLE18` ON ($MYSQL_TABLE18.id=$MYSQL_TABLE6.general_table_id) WHERE $MYSQL_TABLE6.id IN ($blocks_ids) AND $MYSQL_TABLE6.module_id=$MYSQL_TABLE5.id";
        } else {
            $query = "SELECT $MYSQL_TABLE5.name AS `module_name`, $MYSQL_TABLE5.data_export_datetime AS `module_data_export_datetime`, $MYSQL_TABLE5.description AS `module_description`, $MYSQL_TABLE5.version AS `module_version`, $MYSQL_TABLE5.id AS `module_id`, $MYSQL_TABLE6.act_variable, $MYSQL_TABLE6.act_method, $MYSQL_TABLE6.url_get_vars, $MYSQL_TABLE6.id AS `block_id`, $MYSQL_TABLE6.type AS `block_type`, $MYSQL_TABLE6.name AS `block_name` FROM `$MYSQL_TABLE5`, `$MYSQL_TABLE6` WHERE $MYSQL_TABLE6.id IN ($blocks_ids) AND $MYSQL_TABLE6.module_id=$MYSQL_TABLE5.id";
        }
        if ($blocks_ids != '') {
            $result = $this->mysql->executeSQL($query);
            while ($row = $this->mysql->fetchAssoc($result)) {
                if ($row['url_get_vars'] != '') {
                    $url_get_vars = array_merge($url_get_vars, explode(SETTINGS_NEW_LINE, str_replace("\r", '', $row['url_get_vars'])));
                }

                $modules_blocks[$row['block_id']] = $row;

                $TOTAL_TAGS++;
                if ($row['block_type'] == 2)
                    $COUNT_TYPE_2_TAGS++; //подсчитываем количество подключенных блоков с типом 2
            }
        }

        //проверяем, что небыло в запросе не разрешенных переменных
        if ($checkURL && SETTINGS_FRIENDLY_URL && count($_GET) > 0) {
            $error_400 = false;
            foreach ($_GET as $key => $v) {
                if (!in_array($key, $url_get_vars)) {

                    $pageinfo = $this->getErrorPageURL($pageName);
                    $error_400 = true;
                    break;
                }
            }
        } else {
            $error_400 = false;
        }


        //проверяем правильный ли запрос
        if ($error_400) {
            $GENERAL_FUNCTIONS->get = array();
            $this->__construct($pageinfo, $pageName, $this->smarty, $this->mysql, false);
        } else {
            $sub_tpls = array();
            $sub_tpls_index = -1;
            $tpl_content_array = array();

            if (GOODCMS_FAST_EDIT) {

                //проверяем, если возле тега стоят кавычки, тогда не встраиваем обработку быстрого редактирования
                //т.к. можем испортить верстку
                $tpl_content = $FILE_MANAGER->getfile($_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/templates_for_site/' . $this->templateFileName);
                $body_pos = mb_stripos($tpl_content, '<body');
            }


            if (SETTINGS_FRIENDLY_URL) {
                $_GET = $_GET_NEW_FULL;  //назначаем в глобальную  переменную $_GET данные, чтоб они были доступны в smarty шаблонах
            }

            if (isset($LANGUAGES_OF_MATERIAL[$LANGUAGE_PREFIX]))
                $lang_id = $LANGUAGES_OF_MATERIAL[$LANGUAGE_PREFIX]['id'];
            else
                $lang_id = $LANGUAGES_OF_MATERIAL[SETTINGS_LANGUAGE_OF_MATERIALS_DEFAULT]['id'];

            $lang['lang_id'] = $lang_id;
            $lang['lang_prefix_for_url'] = LANGUAGE_PREFIX_FOR_URL;


            //берем все настройки блоков
            $modules_settings = array();
            $query = "SELECT t3.name, t3.value, t.id AS `module_id` FROM `$MYSQL_TABLE5` AS `t` LEFT JOIN `$MYSQL_TABLE6` AS `t2` ON (t2.module_id=t.id) LEFT JOIN `$MYSQL_TABLE7` AS `t3` ON (t3.block_id=t2.id)";
            $result = $this->mysql->executeSQL($query);
            while ($row = $this->mysql->fetchAssoc($result)) {
                $modules_settings[$row['module_id']][$row['name']] = $row['value'];
            }

            //подключаем родительский класс для блоков
            include_once (SETTINGS_ADMIN_PATH . '/includes/Main_modules_class.php');
            require 'classes/CMSProtection.php';         //библиотека функций админки

            $smartyTemp = $this->smarty;      //создаём комию обекта смарти

            foreach ($tags as $tag) {

                //подгружаем подшаблон
                if ($tag['include_tpl_id'] > 0) {
                    $sub_tpls[$tag['include_tpl_id']]['tags'][] = $tag;
                    $sub_tpls[$tag['include_tpl_id']]['smarty'] = $smartyTemp; //создаём экземпляр объекта
                } else {

                    if (isset($modules_blocks[$tag['block_id']])) {

                        $module = $modules_blocks[$tag['block_id']];
                        $tag['block_type'] = $module['block_type'];

                        //блок - СПИСОК
                        if ($module['block_type'] == 2) {

                            //подключаем модуль
                            if (!isset($loaded_modules[$module['module_name']])) {
                                include_once ($MODULES_PATH . $module['module_name'] . '/' . $module['module_name'] . '.php');
                                $loaded_modules[$module['module_name']] = true;
                            }

                            if (!isset($used_blocks[$module['block_id']])) {

                                if (!class_exists($module['block_name'])) {

                                    include_once ($MODULES_PATH . $module['module_name'] . '/' . $MODULES_PERFORMANCE_PATCH_NAME . '/' . $module['block_name'] . '.php');
                                    $moduleinfo['module_name'] = $module['module_name']; //информация о модуле, которая передается блоку
                                    $moduleinfo['module_id'] = $module['module_id'];
                                    $moduleinfo['module_description'] = $module['module_description'];
                                    $moduleinfo['module_version'] = $module['module_version'];
                                    $moduleinfo['module_data_export_datetime'] = $module['module_data_export_datetime'];

                                    $obj = new $module['block_name']($moduleinfo, $modules_settings[$module['module_id']], $this->mysql, $smartyTemp, $tag, $pageinfo, $post, $postr, $posts, $get, $getr, $gets, $lang, $module['block_id'], $module['act_method'], $module['act_variable'], $module['block_name']);
                                    $obj->linker();

                                    $used_blocks[$module['block_id']] = $obj;
                                } else {
                                    $this->getErrorClass($module, $modules_blocks);
                                }
                            } else {
                                $obj = $used_blocks[$module['block_id']];
                                $obj->tagInfo = $tag;
                                $obj->pageInfo = $pageinfo;
                                $obj->linker(); //вызываем обработку
                            }

                            //сохраняем настройку, если есть изменения
                            if ($modules_settings[$module['module_id']] != $obj->settings) {
                                $modules_settings[$module['module_id']] = $GENERAL_FUNCTIONS->updateSettings($obj->tagInfo['block_id'], $modules_settings[$module['module_id']], $obj->settings);
                            }

                            $context = $obj->contentOUT;

                            //Если страницу смотрит администратор и на странице больше чем 1 спецтег тогда встраиваем быстрое редактирование.
                            //Когда на странице 1 спецтег, то на страницу может выводиться RSS, XML или YML поток, наложение кода быстрого
                            //редактирования испортит формат данных)
                            if (GOODCMS_FAST_EDIT && ($COUNT_TYPE_2_TAGS != 1 || $TOTAL_TAGS > 1)) {

                                //берём вложенный шаблон
                                if ($tag['from_tpl_id'] == 0) {
                                    $tpl_c = $tpl_content;
                                    $tpl_cbody_pos = $body_pos;
                                } else {
                                    if (!isset($tpl_content_array[$tag['from_tpl_id']])) {
                                        $tpl_content_array[$tag['from_tpl_id']]['tpl'] = $FILE_MANAGER->getfile($_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/templates_for_site/' . $tag['from_tpl_id'] . '.tpl');
                                        $tpl_content_array[$tag['from_tpl_id']]['body_pos'] = mb_stripos($tpl_content_array[$tag['from_tpl_id']]['tpl'], '<body');
                                    }
                                    $tpl_c = $tpl_content_array[$tag['from_tpl_id']]['tpl'];
                                    $tpl_cbody_pos = $tpl_content_array[$tag['from_tpl_id']]['body_pos'];
                                }

                                $system_tagname_pos = mb_stripos($tpl_c, $tag['system_tagname']);
                                //если системный тег прописан не в шапке
                                if ($system_tagname_pos > $tpl_cbody_pos) {

                                    if ($module['genetal_tablename'] != '') {
                                        $url = '/' . SETTINGS_ADMIN_PATH . "/index.php?act=modules&do=managedata&page_id={$pageinfo['id']}&tag_id={$tag['id']}&p=1&hide_menu=true&t_name={$module['genetal_tablename']}&search=&fastEdit=true&l_id={$lang_id}";
                                    } else {
                                        $url = '';
                                    }

                                    //если на выходе пусто, тогда встраиваем метку [редактировать]
                                    if (trim($context) == '') {
                                        if ($module['genetal_tablename_description'] == '') {
                                            $module['genetal_tablename_description'] = $module['block_description'];
                                            $edit_able = 0;
                                        } else {
                                            $edit_able = 1;
                                        }

                                        $top = '<' . SETTINGS_FAST_EDIT_TAG . " oncontextmenu='return ___GoodCMS_menu(1, event, &quot;$url&quot;, &quot;{$module['block_id']}&quot;, &quot;{$module['genetal_tablename_description']}&quot;, $edit_able)' class='___GoodCMS_area'>";
                                        $bottom = '</' . SETTINGS_FAST_EDIT_TAG . '>';
                                        $context = $top . '[редактировать]' . $bottom;
                                    } else {
                                        $context = $GENERAL_FUNCTIONS->fastEditModeReplaceTagsInBlocks($context, $module['block_id'], $tablesInfo, $tag['id'], $lang_id, $pageinfo['id'], $module);
                                    }
                                }
                                if ($tag['from_tpl_id'] > 0) {

                                    if (isset($sub_tpls[$tag['from_tpl_id']])) {
                                        $sm = $sub_tpls[$tag['from_tpl_id']]['smarty'];
                                    } else {
                                        $sub_tpls[$tag['from_tpl_id']]['tags'][] = $tag;
                                        $sm = $smartyTemp;
                                    }

                                    $sm->assign($tag['system_tagname'], $context);
                                    $sub_tpls[$tag['from_tpl_id']]['smarty'] = $sm;
                                } else {
                                    $this->smarty->assign($tag['system_tagname'], $context);
                                }
                            } else {
                                //назначаем тег в обычный шаблон
                                if ($tag['from_tpl_id'] == 0) {
                                    $this->smarty->assign($tag['system_tagname'], $context);
                                } else {
                                    //назначаем тег во вложеннй шаблон
                                    if (isset($sub_tpls[$tag['from_tpl_id']])) {
                                        $sm = $sub_tpls[$tag['from_tpl_id']]['smarty'];
                                    } else {
                                        $sub_tpls[$tag['from_tpl_id']]['tags'][] = $tag;
                                        $sm = $smartyTemp;
                                    }

                                    $sm->assign($tag['system_tagname'], $context);
                                    $sub_tpls[$tag['from_tpl_id']]['smarty'] = $sm;
                                }
                            }
                        }
                        //блок - ЗАПИСЬ
                        elseif ($module['block_type'] == 1) {
                            //чтоб не вызывать несколько раз запоминаем теги, которые потом передадим
                            $module_name = $module['module_name'];
                            $record_blocks[$module_name][$module['block_name']]['tags'][$tag['id']] = $tag;
                            $record_blocks[$module_name][$module['block_name']]['block'] = $module;
                        }
                        //блок - МОДИФИКАТОР
                        else {
                            $module_name = $module['module_name'];
                            $modificator_blocks[$module_name][$module['block_name']]['tags'][$tag['id']] = $tag;
                            $modificator_blocks[$module_name][$module['block_name']]['block'] = $module;
                        }
                    }
                }
            }
            unset($used_blocks);



            //обрабатываем блоки - ЗАПИСЬ
            foreach ($record_blocks as $m) {

                foreach ($m as $k => $val) {
                    $b = $val['block'];
                    if (!class_exists($b['block_name'])) {

                        $moduleinfo['module_name'] = $b['module_name']; //информация о модуле, которая передается блоку
                        $moduleinfo['module_id'] = $b['module_id'];
                        //подключаем модуль
                        if (!isset($loaded_modules[$b['module_name']])) {
                            include_once ($MODULES_PATH . $b['module_name'] . '/' . $b['module_name'] . '.php');
                            $loaded_modules[$b['module_name']] = true;
                        }

                        include_once ($MODULES_PATH . $b['module_name'] . '/' . $MODULES_PERFORMANCE_PATCH_NAME . '/' . $b['block_name'] . '.php');
                        $obj = new $b['block_name']($moduleinfo, $modules_settings[$moduleinfo['module_id']], $this->mysql, $smartyTemp, $val['tags'], $pageinfo, $post, $postr, $posts, $get, $getr, $gets, $lang, $b['block_id'], $b['act_method'], $b['act_variable'], $b['block_name']);
                        $obj->linker();
                        $contentOUTArray = $obj->contentOUT;

                        //сохраняем настройку, если есть изменения
                        if ($modules_settings[$moduleinfo['module_id']] != $obj->settings) {
                            $modules_settings[$moduleinfo['module_id']] = $GENERAL_FUNCTIONS->updateSettings($obj->tagInfo['block_id'], $modules_settings[$moduleinfo['module_id']], $obj->settings);
                        }

                        foreach ($val['tags'] as $tt) {

                            //делаем ручную подстановку для сквозных тегов
                            if (!isset($contentOUTArray['tag' . $tt['id']]) && $tt['global'] > 0) {

                                foreach ($val['tags'] as $tt2) {
                                    if ($tt['id'] != $tt2['id'] && $tt['virtualtagname'] == $tt2['virtualtagname'] && $tt2['global'] > 0 && isset($contentOUTArray['tag' . $tt2['real_tag_id']])) {
                                        $contentOUTArray['tag' . $tt['real_tag_id']] = $contentOUTArray['tag' . $tt2['real_tag_id']];
                                        break;
                                    }
                                }
                            }


                            if (GOODCMS_FAST_EDIT) {

                                //берём вложенный шаблон
                                if ($tt['from_tpl_id'] == 0) {
                                    $tpl_c = $tpl_content;
                                    $tpl_cbody_pos = $body_pos;
                                } else {
                                    if (!isset($tpl_content_array[$tt['from_tpl_id']])) {
                                        $tpl_content_array[$tt['from_tpl_id']]['tpl'] = $FILE_MANAGER->getfile($_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/templates_for_site/' . $tt['from_tpl_id'] . '.tpl');
                                        $tpl_content_array[$tt['from_tpl_id']]['body_pos'] = mb_stripos($tpl_content_array[$tt['from_tpl_id']]['tpl'], '<body');
                                    }
                                    $tpl_c = $tpl_content_array[$tt['from_tpl_id']]['tpl'];
                                    $tpl_cbody_pos = $tpl_content_array[$tt['from_tpl_id']]['body_pos'];
                                }

                                $system_tagname_pos = mb_stripos($tpl_c, $tt['system_tagname']);

                                //если системный тег прописан не в шапке
                                if ($system_tagname_pos > $tpl_cbody_pos) {

                                    //проверяем обрамляющие тег символы
                                    $pos = mb_strpos($tpl_c, $tt['system_tagname']);
                                    $char1 = mb_substr($tpl_c, $pos - 3, 1);
                                    $char2 = mb_substr($tpl_c, $pos + (mb_strlen($tt['system_tagname'])) + 1, 1);

                                    if ($char1 == "'" || $char1 == '"' || $char2 == "'" || $char2 == '"') {
                                        if (isset($contentOUTArray[$tt['system_tagname']]))
                                            $context = $contentOUTArray[$tt['system_tagname']];
                                        else
                                            $context = '';
                                    }
                                    else {
                                        if ($b['genetal_tablename'] != '') {
                                            $url = '/' . SETTINGS_ADMIN_PATH . "/index.php?act=modules&do=managedata&page_id={$pageinfo['id']}&tag_id={$tt['id']}&p=1&hide_menu=true&t_name={$b['genetal_tablename']}&search=0&fastEdit=true&lang_id={$lang_id}#data form";
                                        }
                                        else
                                            $url = '';

                                        if ($b['genetal_tablename_description'] == '') {
                                            $b['genetal_tablename_description'] = $b['block_description'];
                                            $edit_able = 0;
                                        } else {
                                            $edit_able = 0;
                                        }

                                        if (isset($contentOUTArray[$tt['system_tagname']]) && $contentOUTArray[$tt['system_tagname']] != '') {
                                            $context = $contentOUTArray[$tt['system_tagname']];
                                        } else {
                                            $context = '[редактировать]';
                                        }

                                        $top = '<' . SETTINGS_FAST_EDIT_TAG . " oncontextmenu='return ___GoodCMS_menu(1, event, &quot;$url&quot;, &quot;{$b['block_id']}&quot;, &quot;{$b['genetal_tablename_description']}&quot;, {$edit_able})' class='___GoodCMS_area'>";
                                        $bottom = '</' . SETTINGS_FAST_EDIT_TAG . '>';
                                        $context = $top . $context . $bottom;
                                    }
                                } else {
                                    if (isset($contentOUTArray[$tt['system_tagname']]))
                                        $context = $contentOUTArray[$tt['system_tagname']];
                                    else
                                        $context = '';
                                }
                            }
                            else {
                                if (isset($contentOUTArray[$tt['system_tagname']]))
                                    $context = $contentOUTArray[$tt['system_tagname']];
                                else
                                    $context = '';
                            }

                            //назначаем тег в обычный шаблон
                            if ($tt['from_tpl_id'] == 0) {
                                $this->smarty->assign($tt['system_tagname'], $context);
                            } else {
                                //назначаем тег во вложеннй шаблон
                                if (isset($sub_tpls[$tt['from_tpl_id']])) {
                                    $sm = $sub_tpls[$tt['from_tpl_id']]['smarty'];
                                } else {
                                    $sub_tpls[$tt['from_tpl_id']]['tags'][] = $tt;
                                    $sm = $smartyTemp;
                                }

                                $sm->assign($tt['system_tagname'], $context);
                                $sub_tpls[$tt['from_tpl_id']]['smarty'] = $sm;
                            }
                        }
                    } else {
                        $this->getErrorClass($b, $modules_blocks);
                    }
                }
            }

            //переворачиваем массив
            $sub_tpls = array_reverse($sub_tpls);

            //генерируем код вложенных файлов
            foreach ($sub_tpls as $key => $sub_tpl) {
                $sm_temp = $sub_tpl['smarty'];
                foreach ($sub_tpl['tags'] as $sm_temp_tags) {
                    if ($sm_temp_tags['include_tpl_id']) {
                        $out = $sm_temp->fetch($_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . "/templates_for_site/{$sm_temp_tags['include_tpl_id']}.tpl");
                        if ($sm_temp_tags['from_tpl_id'] == 0) {
                            //вырезаем теги быстрого редактирования из шапки
                            if (GOODCMS_FAST_EDIT) {
                                $system_tagname_pos = mb_stripos($tpl_content, $sm_temp_tags['system_tagname']);
                                if ($system_tagname_pos < $body_pos) {
                                    $out = preg_replace('/<' . SETTINGS_FAST_EDIT_TAG . ' oncontextmenu=\'return ___GoodCMS_menu(.*?)>(.*?)<\/' . SETTINGS_FAST_EDIT_TAG . '>/i', '$2', $out);
                                }
                            }

                            $this->smarty->assign($sm_temp_tags['system_tagname'], $out);
                        } else {
                            $sub_tpls[$key]['smarty']->assign($sm_temp_tags['system_tagname'], $out);
                        }
                    }
                }
            }

            //генерируем HTML - код страницы
            $this->contentOUT = $smarty->fetch($this->templateFileName);

            //если администратор смотрит страницу, то встраиваем код меню для быстрого редактирования
            if (GOODCMS_FAST_EDIT && ($COUNT_TYPE_2_TAGS != 1 || $TOTAL_TAGS > 1)) {

                $this->contentOUT = $GENERAL_FUNCTIONS->fastEditModeReplaceTags($this->contentOUT);       //вывод контента сайта с быстрым редактированием для админа
            } else {
                $this->contentOUT = preg_replace('/ fastedit:([\d\w:\_]*)/', '', $this->contentOUT);    //в целях безопасности убираем системные теги быстрого редактирования
                //если включены Friendly URL
                if (SETTINGS_FRIENDLY_URL) {
                    $this->contentOUT = $GENERAL_FUNCTIONS->replaceLinksByFriendlyUrls($this->contentOUT);   //вывод контента сайта c Friendly URL
                }
            }

            //обрабатываем блоки - МОДИФИКАТОР
            foreach ($modificator_blocks as $m) {

                foreach ($m as $k => $val) {
                    $b = $val['block'];
                    if (!class_exists($b['block_name'])) {

                        $moduleinfo['module_name'] = $b['module_name']; //информация о модуле, которая передается блоку
                        $moduleinfo['module_id'] = $b['module_id'];
                        //подключаем модуль
                        if (!isset($loaded_modules[$b['module_name']])) {
                            include_once ($MODULES_PATH . $b['module_name'] . '/' . $b['module_name'] . '.php');
                            $loaded_modules[$b['module_name']] = true;
                        }

                        include_once ($MODULES_PATH . $b['module_name'] . '/' . $MODULES_PERFORMANCE_PATCH_NAME . '/' . $b['block_name'] . '.php');
                        $obj = new $b['block_name']($moduleinfo, $modules_settings[$moduleinfo['module_id']], $this->mysql, $smartyTemp, $val['tags'], $pageinfo, $post, $postr, $posts, $get, $getr, $gets, $lang, $b['block_id'], $b['act_method'], $b['act_variable'], $b['block_name'], $this->contentOUT);
                        $obj->linker();
                        $this->contentOUT = $obj->contentOUT;

                        //сохраняем настройку, если есть изменения
                        if ($modules_settings[$moduleinfo['module_id']] != $obj->settings) {
                            $modules_settings[$moduleinfo['module_id']] = $GENERAL_FUNCTIONS->updateSettings($obj->tagInfo['block_id'], $modules_settings[$moduleinfo['module_id']], $obj->settings);
                        }
                    } else {
                        $this->getErrorClass($b, $modules_blocks);
                    }
                }
            }


            //проверяем лицензию
            $CMSProtection = new CMSProtection($this->mysql, $this->smarty);
            //встраиваем в код тег
            if (!$activated = $CMSProtection->checkActivation()) {
                $temp = preg_split('/<\/title>/i', $this->contentOUT, 2);
                if (isset($temp[1])) {

                    $podpis = '<meta name="GENERATOR" content="http://www.goodcms.net" />';
                    $this->contentOUT = $temp[0] . "</title>" . SETTINGS_NEW_LINE . $podpis . $temp[1];
                }
            }
        }
    }

    /**
     * Выводит ошибку пкереопределения модуля
     *
     */
    function getErrorClass($module, $modules_blocks) {
        GLOBAL $MSGTEXT;

        include $_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/languages/' . SETTINGS_LANGUAGE; //подключаем язык

        foreach ($modules_blocks as $m) {
            if (strcasecmp($m['block_name'], $module['block_name']) == 0 && $m['block_id'] != $module['block_id']) {
                $module2 = $m;
                break;
            }
        }

        $content = sprintf($MSGTEXT['error_class_msg'], $module['module_name'], $module['block_name'], $module2['module_name'], $module2['block_name']);
        $this->smarty->assign('content', $content);
        $this->smarty->assign('MSGTEXT', $MSGTEXT);
        $this->smarty->display($_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/templates/errors/errors_class.tpl');

        exit();
    }

    /**
     * Выводит страницу 404-й ошибки
     *
     * @param string $pageName
     * @return string
     */
    function getErrorPage($pageName) {
        GLOBAL $MYSQL_TABLE3, $MYSQL_TABLE10;

        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");

        $query = "SELECT $MYSQL_TABLE3.id, $MYSQL_TABLE3.name, $MYSQL_TABLE3.description, $MYSQL_TABLE3.templates_id, $MYSQL_TABLE3.cache, $MYSQL_TABLE3.enable, $MYSQL_TABLE3.disable_cache_if_get, $MYSQL_TABLE10.tamplates_id as `tpl_id` FROM `$MYSQL_TABLE3`, `$MYSQL_TABLE10` WHERE $MYSQL_TABLE3.name='" . SETTINGS_ERORR_PAGE_404 . "' AND $MYSQL_TABLE3.enable=1 AND $MYSQL_TABLE3.templates_id=$MYSQL_TABLE10.id AND $MYSQL_TABLE3.templates_id>0";
        $result = $this->mysql->executeSQL($query);
        if (!$pageinfo = $this->mysql->fetchAssoc($result)) {
            $this->mysql->freeResult($result);
            echo("<html> <h1>404 Not Found</h1> The requested URL <b>$pageName</b> was not found on this server.</html>");
            exit;
        }
        return $pageinfo;
    }

    /**
     * Выводит страницу 400-й ошибки
     *
     * @param string $pageName
     * @return string
     */
    function getErrorPageURL($pageName) {
        GLOBAL $MYSQL_TABLE3, $MYSQL_TABLE10;

        header("{$_SERVER['SERVER_PROTOCOL']} 400 Bad Request");

        $query = "SELECT $MYSQL_TABLE3.id, $MYSQL_TABLE3.name, $MYSQL_TABLE3.description, $MYSQL_TABLE3.templates_id, $MYSQL_TABLE3.cache, $MYSQL_TABLE3.enable, $MYSQL_TABLE3.disable_cache_if_get, $MYSQL_TABLE10.tamplates_id as `tpl_id` FROM `$MYSQL_TABLE3`, `$MYSQL_TABLE10` WHERE $MYSQL_TABLE3.name='" . SETTINGS_ERORR_PAGE_400 . "' AND $MYSQL_TABLE3.enable=1 AND $MYSQL_TABLE3.templates_id=$MYSQL_TABLE10.id AND $MYSQL_TABLE3.templates_id>0";
        $result = $this->mysql->executeSQL($query);
        if (!$pageinfo = $this->mysql->fetchAssoc($result)) {
            $this->mysql->freeResult($result);
            echo("<html><h1>400 Bad Request</h1> The requested URL <b>$pageName</b> was not found on this server.</html>");
            exit;
        }
        return $pageinfo;
    }

    /**
     * возвращает смарти
     *
     * @return class
     */
    function getTemplateFileName() {
        return $this->templateFileName;
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