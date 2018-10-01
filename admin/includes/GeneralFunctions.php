<?php
/**
 * Класс-библиотека функций админзоны и конструктора
 *
 */
class GeneralFunctions
{

    /**
     * смарти-класс
     * @var class
     */
    public $smarty;

    /**
     * переменные из массива $_POST с заменёнными спец-символами функцией htmlspecialchars
     *
     * @var array
     */
    public $post;

    /**
     *  переменные из массива $_POST как они вводились пользователем (спец символы не заменены)
     *
     * @var array
     */
    public $postr;

    /**
     *  экранированые переменные функцией addslashes() из массива $_POST
     *
     * @var array
     */
    public $posts;

    /**
     * переменные из массива $_GET с заменёнными символами
     *
     * @var array
     */
    public $get;


    /**
     *  переменные из массива $_GET (спец символы не заменены)
     *
     * @var array
     */
    public $getr;

    /**
     *  экранированые переменные функцией addslashes() из массива $_GET
     *
     * @var array
     */
    public $gets;

    /**
     * класс для работы с MYSQL
     *
     * @var class
     */
    public $mysql;

    /**
     * Хранит переданные ошибки
     *
     * @var array
     */
    public $errors;

    /**
     * сообщения
     *
     * @var array
     */
    public $messages;

    /**
     * Временный массив
     *
     * @var unknown_type
     */
    public $dictionary_text = NULL;

    /**
     * Хранит объект файлового менеджера
     *
     * @var unknown_type
     */
    public $file_manager = false;

    /**
     * нужно ли сохранить словарь
     *
     * @var bool
     */
    public $need_to_save_dictionary = false;

    /**
     * Содержит информацию о Friendly URL
     */
    public $furl_info = array();

    /**
     * Конструктор
     *
     * @param class $smarty
     */
    function __construct($mysql = NULL, $smarty = NULL, $notGetSafeGetPostVariables = false)
    {

        $this->mysql = $mysql;
        $this->smarty = $smarty;

        if (!$notGetSafeGetPostVariables) {
            $this->getSafeGetPostVariables();
        }
    }


    //===================ОБЩИЕ ФУНКЦИИ АДМИНКИ=======================================================================================================

    /**
     * экранирует $_GET $_POST переменные и возвращает массив
     * @param array $getVars если переменная не установлена, тогда данные будуть браться из $_GET, иначе из переменной
     * @return  array $res
     */
    function getSafeGetPostVariables($getVars = null)
    {

        $post = array();
        $postr = array();
        $posts = array();
        $get = array();
        $getr = array();
        $gets = array();

        if ($getVars == null) {
            $getVars = $_GET;
        }

        if (SETTINGS_MAGIC_QUOTES_GPC == '1') { //если включены магические кавычки

            foreach ($_POST as $key => $v) {
                if (!is_array($v)) {
                    $posts[$key] = $v;
                    $postr[$key] = stripslashes($v);
                    $post[$key] = htmlspecialchars($postr[$key], ENT_QUOTES);
                } else {
                    $vs = array();
                    $vr = array();
                    foreach ($v as $field => $field_value) {
                        $vs[$field] = $field_value;
                        $vr[$field] = stripslashes($field_value);
                        $v[$field] = htmlspecialchars($vr[$field], ENT_QUOTES);
                    }
                    $posts[$key] = $vs;
                    $post[$key] = $v;
                    $postr[$key] = $vr;
                }
            }

            // экранируем get переменные
            foreach ($getVars as $key => $v) {
                $gets[$key] = $v;
                $getr[$key] = stripslashes($v);
                $get[$key] = htmlspecialchars($getr[$key], ENT_QUOTES);
            }
        } else {

            foreach ($_POST as $key => $v) {
                $postr[$key] = $v;

                if (!is_array($v)) {
                    $post[$key] = htmlspecialchars($v, ENT_QUOTES);
                    $posts[$key] = $this->mysql->realEscapeString($v);
                } else {
                    $vs = array();
                    foreach ($v as $field => $field_value) {
                        $v[$field] = htmlspecialchars($field_value, ENT_QUOTES);
                        $vs[$field] = $this->mysql->realEscapeString($field_value);
                    }
                    $posts[$key] = $vs;
                    $post[$key] = $v;
                }
            }

            // экранируем get переменные
            foreach ($getVars as $key => $v) {
                $gets[$key] = $this->mysql->realEscapeString($v);
                $getr[$key] = $v;
                $get[$key] = htmlspecialchars($getr[$key], ENT_QUOTES);
            }
        }

        $this->get = $get;
        $this->getr = $getr;
        $this->gets = $gets;
        $this->post = $post;
        $this->postr = $postr;
        $this->posts = $posts;

        $res['get'] = $get;
        $res['getr'] = $getr;
        $res['gets'] = $gets;
        $res['post'] = $post;
        $res['postr'] = $postr;
        $res['posts'] = $posts;

        return $res;
    }


    /**
     * переход на указаный url
     *
     * @param string $url
     */
    function gotoURL($url)
    {

        header('Location: ' . $url);
    }


    /**
     * Возвращает объект для работы с почтой
     *
     * @param string $to
     * @param string $toName
     * @param string $from
     * @param string $fromName
     * @param string $subject
     * @param string $body
     */
    function getMailObject($to = '', $toName = '', $from = '', $fromName = '', $subject = '', $body = '')
    {

        //подключаем класс для отправки сообщения
        if (!class_exists('Mime_Mail')) {
            include_once ($_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/includes/Mime_Mail.php');
        }
        $mail = new Mime_Mail($to, $toName, $from, $fromName, $subject, $body);

        return $mail;
    }


    /**
     * Возвращает объект для работы с файлами
     *
     */
    function getFileManagerObject()
    {

        if (!$this->file_manager) {
            if (class_exists('FILE_MANAGER')) {
                GLOBAL $FILE_MANAGER;
                $this->file_manager = $FILE_MANAGER;
            } else {
                include ($_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/includes/File_Manager.php'); //класс для работы с файлами по фтп-протоколу или стандартными средствами
                $this->file_manager = new FILE_MANAGER(array('host' => SETTINGS_FTP_CLIENT_HOST, 'username' => base64_decode(SETTINGS_FTP_CLIENT_USERNAME), 'password' => base64_decode(SETTINGS_FTP_CLIENT_PASSWORD), 'startDir' => ''));
            }
        }

        return $this->file_manager;
    }


    /**
     * сортировка по строковому полю в порядке убывания
     *
     * @param array $a
     * @param array $b
     * @return int
     */
    function sortByStrGrow($a, $b)
    {
        return strcmp($a[$_SESSION['___GoodCMS']['SORT_BY_FIELD']], $b[$_SESSION['___GoodCMS']['SORT_BY_FIELD']]);
    }


    /**
     * сортировка по строковому полю в порядке убывания
     *
     * @param array $a
     * @param array $b
     * @return int
     */
    function sortByStrLow($a, $b)
    {
        return strcmp($b[$_SESSION['___GoodCMS']['SORT_BY_FIELD']], $a[$_SESSION['___GoodCMS']['SORT_BY_FIELD']]);
    }


    /**
     * сортировка по числовому полю в порядке убывания
     *
     * @param array $a
     * @param array $b
     * @return int
     */
    function sortByIntLow($a, $b)
    {

        $k2 = $b[$_SESSION['___GoodCMS']['SORT_BY_FIELD']];
        $k = $a[$_SESSION['___GoodCMS']['SORT_BY_FIELD']];
        if ($k == $k2) return 0;
        else  return ($k > $k2) ? -1 : 1;
    }


    /**
     * сортировка по числовому полю в порядке убывания
     *
     * @param array $a
     * @param array $b
     * @return int
     */
    function sortByIntGrow($a, $b)
    {

        $k = $b[$_SESSION['___GoodCMS']['SORT_BY_FIELD']];
        $k2 = $a[$_SESSION['___GoodCMS']['SORT_BY_FIELD']];
        if ($k == $k2) return 0;
        else return ($k > $k2) ? -1 : 1;
    }


    /**
     * возвращает тип сортировки, взависимости от выбранного типа
     *
     * @param string $sort_by_default
     * @return array
     */
    function getSortVariables($sort_by_default)
    {

        if (!isset($this->get['sort_by'])) { //сортируем по полю
            $sort_by = $sort_by_default;
        } else $sort_by = $this->get['sort_by'];

        if (!isset($this->get['sort_type'])) {
            $sort_type = 'low';
        } else $sort_type = $this->get['sort_type'];


        if (!isset($this->get['p'])) {
            if ($sort_type == 'low') $sort_type = 'hight';
            else $sort_type = 'low';
        }

        $_SESSION['___GoodCMS']['SORT_BY_FIELD'] = $sort_by;
        $sort['sort_by'] = $sort_by;
        $sort['sort_type'] = $sort_type;

        return $sort;
    }


    /**
     * сортирует массив по строковому полю
     *
     * @param  string $sort_type
     * @param  array  $allrecords
     * @return array
     */
    function sort_massiv($sort_type, $allrecords)
    {

        if ($sort_type == 'low') usort($allrecords, array($this, 'sortByStrlow'));
        else usort($allrecords, array($this, 'sortByStrGrow'));

        return $allrecords;
    }


    /**
     * сортирует массив по строковому полю
     *
     * @param  string $sort_type
     * @param  array  $allrecords
     * @return array
     */
    function sort_massiv_by_int($sort_type, $allrecords)
    {

        if ($sort_type == 'low') usort($allrecords, array($this, 'sortByIntlow'));
        else usort($allrecords, array($this, 'sortByIntGrow'));

        return $allrecords;
    }


    /**
     * реализуем переход по страницам
     *
     * @param int $step
     * @param array $allrecords
     * @param string $url
     * @return unknown
     */
    function form_navigations($step = 10, $allrecords = array(), $url)
    {

        if (isset($this->get['page'])) $p_num = $this->get['page'];
        else    $p_num = 1;

        if (isset($this->post['editaction']) && ($this->post['editaction'] == 'delete')) $p_num = 1;

        $navigations = array();
        if (!isset($p_num)) {
            $start = 0;
            $page = 1;
        } else {
            $page = $p_num;
            $start = ($p_num - 1) * $step;
        }

        $navigations['page'] = $page;
        $navigations['step'] = $step;
        $navigations['start'] = $start;

        $page_count = count($allrecords);
        $page_count = $page_count / $step;
        $pages = array();

        for ($i = 0; $i < $page_count; $i++) {
            $i2 = $i + 1;
            if ($i2 == $page) {
                $pages[$i]['selected'] = true;
                $pages[$i]['name'] = $i2;
                $pages[$i]['url'] = $url;
            } else {
                $pages[$i]['selected'] = false;
                $pages[$i]['name'] = $i2;
                $pages[$i]['url'] = $url;
            }
        }

        $records = array_slice($allrecords, $start, $step);

        $obj['pages'] = $pages;
        $obj['records'] = $records;

        return $obj;
    }


    /**
     * Вызывает методы классов удаляющие записи, имеющие отношения к определённому тегу или странице
     *
     * @param int $id
     * @param string $field
     */
    function delete_modules_records($id, $field)
    {
        GLOBAL $MYSQL_TABLE3, $MYSQL_TABLE2, $MYSQL_TABLE4, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE7, $MYSQL_TABLE11, $MODULES_PATH, $TEMPLATES_PATH, $MODULES_PERFORMANCE_PATCH_NAME;

        if ($field == 'tag_id') {
            $query = "SELECT $MYSQL_TABLE6.id as `block_id`, $MYSQL_TABLE6.type as `block_type`, $MYSQL_TABLE6.general_table_id, $MYSQL_TABLE5.name AS `module_name` FROM `$MYSQL_TABLE11`,`$MYSQL_TABLE5`, `$MYSQL_TABLE6` WHERE $MYSQL_TABLE11.id='$id' AND $MYSQL_TABLE11.block_id=$MYSQL_TABLE6.id AND $MYSQL_TABLE6.module_id=$MYSQL_TABLE5.id";
            $result = $this->mysql->executeSQL($query);
            $row = $this->mysql->fetchAssoc($result);


            if ($row['block_type'] == 1) { //если блок множественный, тогда удаляем
                $this->deleteRecords($id, $field, $row);
            }
        } elseif ($field == 'page_id') { //при удалении страницы

            $query = "SELECT $MYSQL_TABLE11.* FROM `$MYSQL_TABLE11`, `$MYSQL_TABLE3` WHERE  $MYSQL_TABLE3.id='$id' AND $MYSQL_TABLE3.templates_id=$MYSQL_TABLE11.virtualtemplate_id";
            $result = $this->mysql->executeSQL($query);
            $tags = $this->mysql->fetchAssocAll($result);

            //1)удаляем только простые теги
            //2)удаляем глобальный тег только, если у данного шаблона не осталось страниц
            //3)супер глобальный тег удаляем в том лучае, если нигде больше не встречается тег с таким названием
            if (isset($tags[0])) {
                $query = "SELECT count(*) FROM `$MYSQL_TABLE3` WHERE `templates_id`='{$tags[0]['virtualtemplate_id']}'";
                $result = $this->mysql->executeSQL($query);
                if ($this->mysql->fetchRow($result) == 1) $delete_global = true;
                else $delete_global = false;

                $tmp = array();
                for ($i = 0; $i < count($tags); $i++) {
                    if ($tags[$i]['global'] == 0) $tmp[] = $tags[$i];
                    elseif (($tags[$i]['global'] == 1) && $delete_global) {
                        $tmp[] = $tags[$i];
                    }
                    elseif ($tags[$i]['global'] == 2) {
                        $query = "SELECT count(*) FROM `$MYSQL_TABLE11` WHERE `virtualtagname`='{$tags[$i]['virtualtagname']}' AND `id`!='{$tags[$i]['id']}'";
                        $result = $this->mysql->executeSQL($query);
                        if ($this->mysql->fetchRow($result) == 0) $tmp[] = $tags[$i];
                    }
                }
                $tags = $tmp;


                for ($i = 0; $i < count($tags); $i++) {
                    $query = "SELECT $MYSQL_TABLE6.id as `block_id`, $MYSQL_TABLE6.type as `block_type`, $MYSQL_TABLE6.general_table_id,  $MYSQL_TABLE5.name AS `module_name` FROM `$MYSQL_TABLE11`,`$MYSQL_TABLE5`, `$MYSQL_TABLE6` WHERE $MYSQL_TABLE11.id='{$tags[$i]['id']}' AND $MYSQL_TABLE11.block_id=$MYSQL_TABLE6.id AND $MYSQL_TABLE6.module_id=$MYSQL_TABLE5.id";
                    $result = $this->mysql->executeSQL($query);
                    $row = $this->mysql->fetchAssoc($result);

                    if ($row['block_type'] == 1) { //если блок множественный, тогда удаляем
                        $this->deleteRecords($id, $field, $row);
                    }
                }
            }
        }
    }


    /**
     * Удаляет запись по полю
     *
     * @param int $id
     */
    function deleteRecords($id, $field, $info = NULL)
    {
        GLOBAL $MYSQL_TABLE18, $MYSQL_TABLE17;

        //берем название таблицы
        $query = "SELECT `table_name` FROM `$MYSQL_TABLE18` WHERE `id`='{$info['general_table_id']}'";
        $result = $this->mysql->executeSQL($query);
        list($current_tablename) = $this->mysql->fetchRow($result);

        if ($current_tablename) {
            //берем первичный ключ таблицы из которой удаляются записи
            $pk_incr_fieldname = $this->getTablePkIncrFieldName($current_tablename);

            //берем все записи из главной таблицы
            $ids = '';
            $query = "SELECT `$pk_incr_fieldname` FROM `{$current_tablename}` WHERE `$field`='$id'";
            $result = $this->mysql->executeSQL($query);
            while (list($id) = $this->mysql->fetchRow($result)) {
                $ids .= $id . ',';
            }

            if ($ids != '') {
                $ids = mb_substr($ids, 0, -1);
                $current_tablename_no_prefix = mb_substr($current_tablename, mb_strlen($info['module_name']) + 1); //имя редактируемой таблицы без префикса

                //подключаем API-функции
                include_once ($_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/includes/API.php');
                $API = new API($this->mysql, $this->smarty, $this->post, $this->postr, $this->posts, $this->get, $this->getr, $this->gets, $info, $current_tablename, $current_tablename_no_prefix, NULL, true, $this->posts);
                $API->dataDeleteSourseFields($ids, $current_tablename, $pk_incr_fieldname);
            }
        }
    }


    /**
     * проверяет глобальный настройки
     *
     */
    function checkGeneralParameters()
    {
        GLOBAL $MSGTEXT, $FILE_MANAGER;

        $dir = $_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/install';
        if (is_dir($dir)) { //если папка установки не удалена
            if (!$FILE_MANAGER->removeFolder($dir)) { //пытаемся удалить папку
                $_SESSION['___GoodCMS']['error'][] = sprintf($MSGTEXT['install_need_delete_folder'], $dir);
            }
        }

        //определяем включено ли добавление волшебных кавычек
        if (mb_strpos($_POST['check_magic_quotes_gpc'], '\'')) $v = 1;
        else $v = 0;

        $this->updateGSettings('SETTINGS_MAGIC_QUOTES_GPC', $v); //сохраняем настройку волшебных кавычек
    }


    /**
     * добавляет слеши к обьекту, если нужно
     *
     * @param array $obj
     * @return array
     */
    function addSlashesToObjectIfNeed($obj)
    {
        //if (SETTINGS_MAGIC_QUOTES_GPC=='0') {
        if (is_array($obj)) {
            foreach ($obj as $key => $value) {
                if (!is_array($value)) $obj[$key] = $this->mysql->realEscapeString($value);
                else $obj[$key] = $this->addSlashesToObjectIfNeed($value);
            }
        } else $obj = $this->mysql->realEscapeString($obj);
        //}
        return $obj;
    }


    /**
     * Заменяет в массиве спецсимволы
     *
     * @param array $obj
     * @param int $type
     * @return array
     */
    function htmlspecialcharsToObject($obj, $type = ENT_QUOTES)
    {
        if (is_array($obj)) {
            foreach ($obj as $key => $value) {
                if (!is_array($value)) $obj[$key] = htmlspecialchars($value, $type);
                else $obj[$key] = $this->htmlspecialcharsToObject($value, $type);
            }
        } else $obj = htmlspecialchars($obj, $type);

        return $obj;
    }


    /**
     * Вырезает опасные символы
     *
     * @param array $obj
     * @param string $allowable_tags
     * @param array $notStripTagsForFields
     * @param string $key
     * @return array
     */
    function stripTagsFromObject($obj, $allowable_tags = array(), $notStripTagsForFields = array(), $key = NULL)
    {

        //преобразуем, если передана строка
        if ($notStripTagsForFields && !is_array($notStripTagsForFields)) {
            $notStripTagsForFields = array($notStripTagsForFields);
        }

        if (is_array($obj)) {
            foreach ($obj as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $key2 => $value2) {
                        $obj[$key][$key2] = $this->stripTagsFromObject($value2, $allowable_tags, $notStripTagsForFields, $key2);
                    }
                } else {
                    $obj[$key] = $this->stripTagsFromObject($value, $allowable_tags, $notStripTagsForFields, $key);
                }
            }
        } else {

            if (in_array($key, $notStripTagsForFields)) {
                $obj = urldecode($obj);

                //если найден JS код, тогда вырезаем всё
                if (preg_match('/javascript *:/is', $obj) || preg_match('/(onblur|onchange|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup|onload|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|onreset|onselect|onsubmit|onunload) *= *["\'](.*?)["\'][ >]/is', $obj)) {
                    $obj = $this->strip_tags_smart($obj);
                } else {
                    $obj = $this->strip_tags_smart($obj, $allowable_tags);
                }
            } else {
                $obj = $this->strip_tags_smart($obj); //если не указано поле,тогда вырезаем все теги
            }
        }

        return $obj;
    }


    /**
     * Более продвинутый аналог strip_tags() для корректного вырезания тагов из html кода.
     * Функция strip_tags(), в зависимости от контекста, может работать не корректно.
     * Возможности:
     *   - корректно обрабатываются вхождения типа "a < b > c"
     *   - корректно обрабатывается "грязный" html, когда в значениях атрибутов тагов могут встречаться символы < >
     *   - корректно обрабатывается разбитый html
     *   - вырезаются комментарии, скрипты, стили, PHP, Perl, ASP код, MS Word таги, CDATA
     *   - автоматически форматируется текст, если он содержит html код
     *   - защита от подделок типа: "<<fake>script>alert('hi')</</fake>script>"
     *
     * @param   string  $s
     * @param   array   $allowable_tags     Массив тагов, которые не будут вырезаны
     *                                      Пример: 'b' -- таг останется с атрибутами, '<b>' -- таг останется без атрибутов
     * @param   bool    $is_format_spaces   Форматировать пробелы и переносы строк?
     *                                      Вид текста на выходе (plain) максимально приближеется виду текста в браузере на входе.
     *                                      Другими словами, грамотно преобразует text/html в text/plain.
     *                                      Текст форматируется только в том случае, если были вырезаны какие-либо таги.
     * @param   array   $pair_tags   массив имён парных тагов, которые будут удалены вместе с содержимым
     *                               см. значения по умолчанию
     * @param   array   $para_tags   массив имён парных тагов, которые будут восприниматься как параграфы (если $is_format_spaces = true)
     *                               см. значения по умолчанию
     * @return  string
     *
     * @charset  UTF8
     * @version  4.0.14
     */
    function strip_tags_smart($s, array $allowable_tags = null, $is_format_spaces = true, array $pair_tags = array('script', 'style', 'map', 'iframe', 'frameset', 'object', 'applet', 'comment', 'button', 'textarea', 'select'), array $para_tags = array('p', 'td', 'th', 'li', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'form', 'title', 'pre'))
    {

        static $_callback_type = false;
        static $_allowable_tags = array();
        static $_para_tags = array();
        static $re_attrs_fast_safe = '(?![a-zA-Z\d])  #statement, which follows after a tag
                                   #correct attributes
                                   (?>
                                       [^>"\']+
                                     | (?<=[\=\x20\r\n\t]|\xc2\xa0) "[^"]*"
                                     | (?<=[\=\x20\r\n\t]|\xc2\xa0) \'[^\']*\'
                                   )*
                                   #incorrect attributes
                                   [^>]*+';

        if (is_array($s)) {
            if ($_callback_type === 'strip_tags') {
                $tag = mb_strtolower($s[1]);
                if ($_allowable_tags) {
                    //тег с атрибутами
                    if (array_key_exists($tag, $_allowable_tags)) return $s[0];

                    //тег без атрибутов
                    if (array_key_exists('<' . $tag . '>', $_allowable_tags)) {
                        if (mb_substr($s[0], 0, 2) === '</') return '</' . $tag . '>';
                        if (mb_substr($s[0], -2) === '/>') return '<' . $tag . ' />';
                        return '<' . $tag . '>';
                    }
                }
                if ($tag === 'br') return SETTINGS_NEW_LINE;
                if ($_para_tags && array_key_exists($tag, $_para_tags)) return SETTINGS_NEW_LINE . SETTINGS_NEW_LINE;
                return '';
            }
            trigger_error('Unknown callback type "' . $_callback_type . '"!', E_USER_ERROR);
        }

        if (($pos = mb_strpos($s, '<')) === false || mb_strpos($s, '>', $pos) === false) {
            return $s;
        }

        $length = mb_strlen($s);

        $re_tags = '~  <[/!]?+
                   (
                       [a-zA-Z][a-zA-Z\d]*+
                       (?>:[a-zA-Z][a-zA-Z\d]*+)?
                   ) #1
                   ' . $re_attrs_fast_safe . '
                   >
                ~sxSX';

        $patterns = array(
            '/<([\?\%]) .*? \\1>/sxSX', #встроенный PHP, Perl, ASP код
            '/<\!\[CDATA\[ .*? \]\]>/sxSX', #блоки CDATA
            #'/<\!\[  [\x20\r\n\t]* [a-zA-Z] .*?  \]>/sxSX',  #:DEPRECATED: MS Word таги типа <![if! vml]>...<![endif]>

            '/<\!--.*?-->/sSX', #комментарии

            #MS Word теги типа "<![if! vml]>...<![endif]>",
            #условное выполнение кода для IE типа "<!--[if expression]> HTML <![endif]-->"
            #условное выполнение кода для IE типа "<![if expression]> HTML <![endif]>"
            #см. http://www.tigir.com/comments.htm
            '/ <\! (?:--)?+
               \[
               (?> [^\]"\']+ | "[^"]*" | \'[^\']*\' )*
               \]
               (?:--)?+
           >
         /sxSX',
        );

        if ($pair_tags) {
            //парные таги вместе с содержимым:
            foreach ($pair_tags as $k => $v) $pair_tags[$k] = preg_quote($v, '/');
            $patterns[] = '/ <((?i:' . implode('|', $pair_tags) . '))' . $re_attrs_fast_safe . '(?<!\/)>
                         .*?
                         <\/(?i:\\1)' . $re_attrs_fast_safe . '>
                       /sxSX';
        }

        $i = 0; //защита от зацикливания
        $max = 99;
        while ($i < $max) {
            $s2 = preg_replace($patterns, '', $s);
            if (preg_last_error() !== PREG_NO_ERROR) {
                $i = 999;
                break;
            }

            if ($i == 0) {
                $is_html = ($s2 != $s || preg_match($re_tags, $s2));
                if (preg_last_error() !== PREG_NO_ERROR) {
                    $i = 999;
                    break;
                }

                if ($is_html) {
                    if ($is_format_spaces) {
                        /*
         				В библиотеке PCRE для PHP \s - это любой пробельный символ, а именно класс символов [\x09\x0a\x0c\x0d\x20\xa0] или, по другому, [\t\n\f\r \xa0]
         				Если \s используется с модификатором /u, то \s трактуется как [\x09\x0a\x0c\x0d\x20]
         				Браузер не делает различия между пробельными символами, друг за другом подряд идущие символы воспринимаются как один
         				*/
                        #$s2 = str_replace(array("\r", "\n", "\t"), ' ', $s2);
                        #$s2 = strtr($s2, "\x09\x0a\x0c\x0d", '    ');
                        $s2 = preg_replace('/  [\x09\x0a\x0c\x0d]++
                                         | <((?i:pre|textarea))' . $re_attrs_fast_safe . '(?<!\/)>
                                           .+?
                                           <\/(?i:\\1)' . $re_attrs_fast_safe . '>
                                           \K
                                        /sxSX', ' ', $s2);
                        if (preg_last_error() !== PREG_NO_ERROR) {
                            $i = 999;
                            break;
                        }
                    }

                    //массив тагов, которые не будут вырезаны
                    if ($allowable_tags) $_allowable_tags = array_flip($allowable_tags);

                    //парные таги, которые будут восприниматься как параграфы
                    if ($para_tags) $_para_tags = array_flip($para_tags);
                }
            }


            if ($is_html) {
                $_callback_type = 'strip_tags';
                $s2 = preg_replace_callback($re_tags, array(&$this, 'strip_tags_smart'), $s2);
                $_callback_type = false;
                if (preg_last_error() !== PREG_NO_ERROR) {
                    $i = 999;
                    break;
                }
            }

            if ($s === $s2) break;
            $s = $s2;
            $i++;
        }

        if ($i >= $max) $s = strip_tags($s);

        if ($is_format_spaces && mb_strlen($s) !== $length) {
            //удаляем повторяющиеся пробелы
            $s = preg_replace('/\x20\x20++/sSX', ' ', trim($s));
            //удаляем пробелы до и после новой строки
            $s = str_replace(array("\r\n\x20", "\x20\r\n"), "\r\n", $s);
            //удаляем 3 и больше новых строк
            $s = preg_replace('/[\r\n]{3,}+/sSX', "\r\n\r\n", $s);
        }

        //вырезаем JavaScript в разрешенных тегах
        if (is_array($allowable_tags)) {

            $s = preg_replace(
                array(
                    '/javascript *:/is',
                    '/(onblur|onchange|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup|onload|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|onreset|onselect|onsubmit|onunload) *= *["\'](.*?)["\'][ >]/is')
                , array('', ''), $s);
        }

        return $s;
    }


    /**
     * Обновляет глобальные настройки системы
     *
     * @param string $caption
     * @param string $value
     * @param bool $toConstructor
     *
     * @return bool
     */
    function updateGSettings($caption, $value, $toConstructor = false)
    {
        GLOBAL $FILE_MANAGER;

        //переписываем файл конфигурации
        $value = str_replace(SETTINGS_NEW_LINE, '', $value);
        if (!$toConstructor) {
            $filename = $_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/config.php';
        } else {
            $filename = $_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/constructor/config.php';
        }

        $text = file_get_contents($filename);
        $text = preg_replace("/define *\('$caption',(.*)'(.*)'\);/iu", "define ('$caption',			'$value');", $text);
        if ($fd = $FILE_MANAGER->fopen($filename, 'w')) {
            fwrite($fd, $text);
            fclose($fd);
            $out = true;
        } else $out = false;

        return $out;
    }


    /**
     * Обновляет настройкe блока
     *
     * @param int $block_id
     * @param array $old_settings
     * @param array $new_settings
     * @return array
     */
    function updateSettings($block_id, $old_settings, $new_settings)
    {
        GLOBAL $MYSQL_TABLE7;

        foreach ($new_settings as $key => $v) {
            if ($v != $old_settings[$key]) {
                $query = "UPDATE `$MYSQL_TABLE7` SET `value`='$v' WHERE `block_id`='$block_id' AND `name`='$key'";
                $result = $this->mysql->executeSQL($query);
            }
        }

        return $new_settings;
    }


    /**
     * Проверка на запись для некоторых файлов
     *
     */
    function check_files_modes()
    {
        GLOBAL $FILE_MANAGER, $MSGTEXT;

        $error = '';
        $files_list = array(
            SETTINGS_ADMIN_PATH . '/config.php',
            SETTINGS_ADMIN_PATH . '/constructor/config.php',
            SETTINGS_ADMIN_PATH . '/upload_tmp',
            SETTINGS_ADMIN_PATH . '/logs/SqlLog.php',
            SETTINGS_ADMIN_PATH . '/smarty/templates_c',
            SETTINGS_ADMIN_PATH . '/smarty/templates_constructor',
         //   SETTINGS_ADMIN_PATH . '/sxd/ses.php',
            SETTINGS_ADMIN_PATH . '/dictionary/dictionary.php',
            SETTINGS_ADMIN_PATH . '/dictionary/configLanguage.php',
            SETTINGS_ADMIN_PATH . '/templates',
            'modules',
            'ckfinder/userfiles',
            'ckfinder/userfiles/_thumbs',
            'ckfinder/userfiles/files',
            'ckfinder/userfiles/flash',
            'ckfinder/userfiles/images'
        );

        $file_name = $_SERVER['DOCUMENT_ROOT'] . '/';
        foreach ($files_list as $fn) {
            $fullName = $file_name . $fn;
            if (!is_writable($fullName)) {
                if (!$FILE_MANAGER->chmod($fullName, SETTINGS_CHMOD_FOLDERS)) {
                    $error = '<br/>' . $fullName;
                }
            }
        }

        //если есть ошибки
        if ($error != '') {
            $_SESSION['___GoodCMS']['error'][] = $MSGTEXT['error_open_files'] . $error;
        }
    }


    /**
     * подключение редактора
     *
     * @param int $element_id
     * @return string
     */
    function editorGenerate($element_id = null, $height = 200, $width = '100%')
    {
        if ($height == '') $height = 200;
        if ($width == '') $width = '100%';

        $full_patch = $_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/';
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        $this->smarty->assign('host', $host);
        if (SETTINGS_EDITOR_TYPE == 'ckeditor') {
            if ($element_id == null) {
                $out = $this->smarty->fetch($full_patch . 'templates/general_functions/ckeditor_include.tpl');
            } else {
                $this->smarty->assign('height', $height);
                $this->smarty->assign('width', $width);
                $this->smarty->assign('element_id', $element_id);
                $out = $this->smarty->fetch($full_patch . 'templates/general_functions/ckeditor.tpl');
            }
        } else {
            if ($element_id == null) {
                $out = $this->smarty->fetch($full_patch . '/templates/general_functions/tinymce_include.tpl');
            } else {
                $this->smarty->assign('element_id', $element_id);
                $this->smarty->assign('height', $height);
                $this->smarty->assign('width', $width);
                $out = $this->smarty->fetch($full_patch . '/templates/general_functions/tinymce.tpl');
            }
        }

        return $out;
    }


    /**
     * подключение безопасного редактора
     *
     * @param int $element_id
     * @return string
     */
    function editorSimpleGenerate($element_id = null, $height = 200, $width = '100%')
    {
        if ($height == '') $height = 200;
        if ($width == '') $width = '100%';

        $full_patch = $_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/';
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        $this->smarty->assign('host', $host);

        if ($element_id == null) {
            $out = $this->smarty->fetch($full_patch . '/templates/general_functions/tinymce_include.tpl');
        } else {
            $this->smarty->assign('element_id', $element_id);
            $this->smarty->assign('height', $height);
            $this->smarty->assign('width', $width);

            $out = $this->smarty->fetch($full_patch . '/templates/general_functions/tinymce_simple.tpl');
        }

        return $out;
    }


    /**
     * Создает из php-массива массив на языке JavaScript
     *
     * @param array $phpArray
     * @param string $jsArrayName
     * @param unknown_type $html
     * @return string
     */
    function get_javascript_array($phpArray, $jsArrayName, &$html = 'var ')
    {
        $html .= $jsArrayName . ' = new Array(); ' . SETTINGS_NEW_LINE . ' ';

        foreach ($phpArray as $key => $value) {
            $outKey = (is_int($key)) ? '[' . $key . ']' : "['" . $key . "']";

            if (is_array($value)) {
                $this->get_javascript_array($value, $jsArrayName . $outKey, $html);
                continue;
            }
            $html .= $jsArrayName . $outKey . " = ";
            if (is_string($value)) {
                $html .= "'" . $value . "'; " . SETTINGS_NEW_LINE . " ";
            } else if ($value === false) {
                $html .= "false; " . SETTINGS_NEW_LINE;
            } else if ($value === NULL) {
                $html .= "null; " . SETTINGS_NEW_LINE;
            } else if ($value === true) {
                $html .= "true; " . SETTINGS_NEW_LINE;
            } else {
                $html .= $value . "; " . SETTINGS_NEW_LINE;
            }
        }

        return $html;
    }


    /**
     * Переводит кирилицу в латиницу для безопасного сохранения файлов с русскими именами
     *
     * @param string $content
     */
    function convertKirilToLatin($content)
    {
        $content = urldecode($content);
        $content = mb_strtolower($content);
        $alphas = array(
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'yo',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'y',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'ts',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sh',
            'ы' => 'y',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',
            ' ' => '-',
            '_' => '_',
            '0' => '0',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '"' => '',
            "'" => '',
            '(' => '',
            ')' => '',
            '/' => '',
            '\\' => '',
            '?' => '',
            '+' => '',
            '&' => '',
            '`' => '',
            '$' => '',
            '*' => '',
            '=' => '',
            '%' => '',
            '#' => '',
            '@' => '',
            '^' => '',
            '.' => '.',
            ',' => '',
            ':' => '',
            'ь' => '',
            'ъ' => '',
            '№' => ''

        );


        $total = '';
        for ($i = 0; $i < mb_strlen($content); $i++) {
            $symbol = mb_substr($content, $i, 1);
            $flag = false;
            if (isset($alphas[$symbol])) {
                $new_symbol = $alphas[$symbol];
            } else {
                $new_symbol = $symbol;
            }
            $total .= $new_symbol;
        }

        //заменяем повторяющиеся значения
        $total = preg_replace('~([- \./_])+~u', '$1', $total);

        return $total;
    }


    /**
     * Возвращает список всех файлов в заданной директории c атрибутами
     *
     * @param  string $dir
     * @return array
     */
    function searchdir($path, $maxdepth = -1, $mode = 'FILES', $d = 0)
    {
        if (mb_substr($path, mb_strlen($path) - 1) != '/') $path .= '/';

        $dirlist = array();
        if ($mode != 'FILES') $dirlist[] = $path;

        if ($handle = @opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..') {

                    $fullName = $path . $file;
                    $tmp['name'] = $file;
                    $tmp['size'] = number_format(round(filesize($fullName) / 1000), 0, ',', ' ');
                    $tmp['create'] = gmdate('M d Y H:i:s', filectime($fullName));

                    if (!is_dir($fullName)) {
                        if ($mode != 'DIRS') $dirlist[] = $tmp;
                    } elseif ($d >= 0 && ($d < $maxdepth || $maxdepth < 0)) {
                        $result = $this->searchdir($fullName . '/', $maxdepth, $mode, $d + 1);
                        $dirlist = array_merge($dirlist, $result);
                    }
                }
            }
            closedir($handle);
        }

        return ($dirlist);
    }


    /**
     * Возвращает список всех файлов в заданной директории
     *
     * @param  string $dir
     * @return array
     */
    function searchdirSimple($path, $maxdepth = -1, $mode = 'FILES', $d = 0)
    {
        if (mb_substr($path, mb_strlen($path) - 1) != '/') $path .= '/';

        $dirlist = array();
        if ($mode != 'FILES') $dirlist[] = $path;

        if ($handle = @opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..') {

                    $fullName = $path . $file;
                    $tmp['name'] = $file;
                    if (!is_dir($fullName)) {
                        if ($mode != 'DIRS') $dirlist[] = $tmp;
                    } elseif ($d >= 0 && ($d < $maxdepth || $maxdepth < 0)) {
                        $result = $this->searchdirSimple($fullName . '/', $maxdepth, $mode, $d + 1);
                        $dirlist = array_merge($dirlist, $result);
                    }
                }
            }
            closedir($handle);
        }

        return ($dirlist);
    }


    /**
     * Выводит перевод фразы
     *
     * @param string $string
     * @param array $data_format
     * @return string
     */
    function ftext($string, $data_format = NULL)
    {
        GLOBAL $LANGUAGE_PREFIX, $DICTIONARY_TEXT;

        if ($this->dictionary_text == NULL) {
            include_once ($_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/dictionary/dictionary.php'); //подключаем словарь
            $this->dictionary_text = $DICTIONARY_TEXT;
        }

        //если фраза добавлена в словарь
        if (isset($this->dictionary_text['key_phrases'][$string])) {
            if (isset($this->dictionary_text[$LANGUAGE_PREFIX])) {
                $index = $this->dictionary_text['key_phrases'][$string];
                $return_text = array_search($index, $this->dictionary_text[$LANGUAGE_PREFIX]);
                if ($return_text == '') $return_text = $string;
            } else {
                //еще нет перевода для этой фразы
                $return_text = $string;
            }
        } else {
            //добавляем фразу в словарь
            $return_text = $string;
            if ($string != '' && !is_numeric($string)) {
                $this->dictionary_text['key_phrases'][$string] = count($this->dictionary_text['key_phrases']);
                $this->need_to_save_dictionary = true;
            }
        }

        if ($data_format != NULL) {
            $return_text = vsprintf($return_text, $data_format);
        }

        return $return_text;
    }


    /**
     * Перезаписывает словарь
     *
     */
    function seveDictionary()
    {
        GLOBAL $FILE_MANAGER;

        if (!$FILE_MANAGER) {
            $FILE_MANAGER = $this->getFileManagerObject();
        }

        $data = var_export($this->dictionary_text, true);
        $this->smarty->assign('data', $data);
        $content = $this->smarty->fetch($_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/templates/languagesofmaterial/dictionary_massiv.tpl');
        $fname = $_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/dictionary/dictionary.php';
        if ($fd = $FILE_MANAGER->fopen($fname, 'w')) {
            fwrite($fd, $content);
            fclose($fd);
        }
    }


    //////////////////////////ФУНКЦИИ ДЛЯ ОБРАБОТКИ Friendly URL /////////////////////////////
    /**
     * Формирует Friendly URL из адреса ссылки
     *
     * @param string $url
     * @return string
     */
    function furl($url)
    {
        //заменяем дружественные URL
        if (SETTINGS_FRIENDLY_URL) {

            $url = $this->replaceLinksByFriendlyUrls($url, true);
        }

        return $url;
    }


    /**
     * Заменяет ссылки в коде на Friendly URL
     *
     * @param text $text
     * @param text $one_url  если флаг выставлен, текст в $text будет обрабатываться как адрес ссылки
     * @return text
     */
    function replaceLinksByFriendlyUrls($text, $one_url = false)
    {
        GLOBAL $GLOBAL_ERRORS, $LANGUAGES_OF_MATERIAL, $MYSQL_TABLE23, $MYSQL_TABLE24, $MYSQL_TABLE3, $PAGE_INFO, $MYSQL_TABLE22, $MYSQL_TABLE18, $MYSQL_TABLE17;

        if (count($this->furl_info) == 0) {

            //берем все страницы
            $this->furl_info['all_pages'] = array();
            $query = "SELECT `id`, `name` FROM `$MYSQL_TABLE3`";
            $result = $this->mysql->executeSQL($query);
            while (list($page_id, $page_name) = $this->mysql->fetchRow($result)) {
                $this->furl_info['all_pages'][$page_name] = $page_id;
            }

            //берем правила подстановки записей
            $this->furl_info['urls_settings'] = array();

            $query = "SELECT * FROM `$MYSQL_TABLE23` WHERE `enable`=1";
            $result = $this->mysql->executeSQL($query);
            while ($row = $this->mysql->fetchAssoc($result)) {
                $this->furl_info['urls_settings'][$row['page_id']][] = $row;
            }

            if (count($this->furl_info['urls_settings']) > 0) {

                foreach ($this->furl_info['urls_settings'] as $page_id => $records) {
                    foreach ($records as $key => $up) {
                        $query = "SELECT t.*, t2.table_name, t3.fieldname FROM `$MYSQL_TABLE24` AS `t` LEFT JOIN `$MYSQL_TABLE18` AS `t2` ON (t2.id=t.table_id) LEFT JOIN `$MYSQL_TABLE17` AS `t3` ON (t3.table_id=t2.id AND t3.edittype_id=14 AND t3.unique=1) WHERE t.urls_settings_id='{$up['id']}' ORDER BY t.sort_index DESC";
                        $result = $this->mysql->executeSQL($query);
                        while ($row = $this->mysql->fetchAssoc($result)) {
                            $this->furl_info['urls_settings'][$page_id][$key]['vars'][] = $row;
                        }
                    }
                }
            }
        }

        //ссылки, которые не следует изменять
        $bad_links = array('#', '/', '\\', '');

        if (!$one_url) {
            //парсинг простых ссылок
            $regexp = "/<a(.*?) (href=)['\"]([^\@|:]*?)(['\"])/is";
            preg_match_all($regexp, $text, $mathes, PREG_SET_ORDER);

            //парсинг ссылок в формах
            $regexp = "/<form(.*?) (action=)['\"]([^\@|:]*?)(['\"])/is";
            preg_match_all($regexp, $text, $mathes2, PREG_SET_ORDER);
            $mathes = array_merge($mathes, $mathes2);

            //парсинг ссылок location.href
            $regexp = "/(\.)(href=)['\"](.*?)(['\"])/is";
            preg_match_all($regexp, $text, $mathes2, PREG_SET_ORDER);
            $mathes = array_merge($mathes, $mathes2);

            //сортируем, чтоб небыло одинаковых ссылок
            $links = array();
            foreach ($mathes as $m) {
                if (!in_array($m[3], $bad_links) && mb_stripos($m[3], 'javascript:') === false) {
                    $links[$m[3]]['qote'][$m[4]] = true;
                    $links[$m[3]]['type'] = $m[2];
                }
            }

            unset($mathes);
        } else {
            if (!in_array($text, $bad_links)) {
                $links[$text]['qote'][''] = true;
                $links[$text]['type'] = '';
            } else {
                return $text;
            }
        }

        //формируем правильный массив с некоторыми информационными элементами
        $all_links = array();
        $site_links = array();
        foreach ($links as $link => $v) {
            $url_info = parse_url($link);

            if (isset($url_info['path'])) {

                //вырезаем первый знак /
                if (mb_strpos($url_info['path'], '/') === 0) {
                    $url_info['path'] = mb_substr($url_info['path'], 1);
                }

                //вырезаем последний знак /
                if (mb_substr($url_info['path'], -1) == '/') {
                    $url_info['path'] = mb_substr($url_info['path'], 0, -1);
                }

                //проверяем есть ли в ссылке префикс языка
                $url_parts = explode('/', $url_info['path']);
                if (isset($LANGUAGES_OF_MATERIAL[$url_parts[0]])) {

                    //определяем нужно ли вырезать слеш
                    if (count($url_parts) > 1 && $url_parts[1] != '') {
                        $links[$link]['slash'] = '/';
                        $url_page_name = $url_parts[1]; //берём имя страницы после запроса
                    } else {
                        $links[$link]['slash'] = '';
                        $url_page_name = '';
                    }

                    $links[$link]['have_lang'] = $url_parts[0]; //запоминаем указанный префикс языка

                    if (SETTINGS_LANGUAGE_OF_MATERIALS_DEFAULT == $url_parts[0]) {
                        //меняем ссылку, чтоб не было префикса для языка по умолчанию
                        $links[$link]['replaced_lang'] = true;
                    } else {
                        $links[$link]['replaced_lang'] = false;
                    }
                } else {
                    $url_page_name = $url_info['path'];
                }

                //определяем страницу
                if (isset($this->furl_info['all_pages'][$url_page_name]) && isset($this->furl_info['all_pages'][$url_info['path']])) {
                    //if (isset($this->furl_info['all_pages'][$url_page_name]) ) {
                    $page_id = $this->furl_info['all_pages'][$url_info['path']];
                    $links[$link]['page_id'] = $page_id;
                    $links[$link]['path'] = $url_info['path']; //берем id страницы, куда ведёт ссылка
                } else {
                    //проверяем, чтоб ссылка небыла уже ЧПУ
                    if (mb_strpos($url_info['path'], '/')) {
                        $links[$link]['path'] = $url_info['path'];
                    }

                    if (!isset($links[$link]['path']) || $links[$link]['path'] == '' || isset($this->furl_info['all_pages'][$links[$link]['path']])) {
                        //if ($links[$link]['path'] == '' || isset($this->furl_info['all_pages'][$links[$link]['path']])) {
                        $page_id = $PAGE_INFO['id']; //берем id-текущей страницы
                        $links[$link]['page_id'] = $page_id;
                        $links[$link]['path'] = $url_info['path']; //берем id страницы, куда ведёт ссылка

                    } else {
                        $links[$link]['bad_page_name'] = true; //если в качестве имени указан не существующуя страница
                        $links[$link]['page_id']=null;
                    }
                }
            } else {
                $page_id = $PAGE_INFO['id']; //берем id-текущей страницы
                $links[$link]['page_id'] = $page_id;
            }

            //если есть домен в ссылке
            if (isset($url_info['host'])) {
                $links[$link]['host'] = $url_info['host'];
            }

            //если есть запрос в ссылке
            if (isset($url_info['query'])) {
                //заменяем, если есть, код &amp; на символ &
                $links[$link]['query'] = str_replace('&amp;', '&', $url_info['query']);
            }

            //если есть якорь в ссылке
            if (isset($url_info['fragment'])) {
                $links[$link]['fragment'] = '#' . $url_info['fragment'];
            }
            else {
                $links[$link]['fragment'] = '';
            }

            if (isset($links[$link]['host'])) {
                $test_host = str_replace(array('https://', 'http://', 'www.'), '', $links[$link]['host']);
            } else {
                $test_host = '';
            }

            if (!isset($links[$link]['host']) || $test_host == $_SERVER['HTTP_HOST'] || 'www.' . $test_host == $_SERVER['HTTP_HOST']) {
                $links[$link]['replace_host'] = false;
                $site_links[$link] = $links[$link];
                if (isset($links[$link]['query'])) {
                    $all_links[$links[$link]['query']] = '\'' . $links[$link]['query'] . '\'';
                }
            } else {
                //делаем перенаправление, чтоб вес страниц не утекал
                $links[$link]['replace_host'] = true;
                $site_links[$link] = $links[$link];
            }
        }

        unset($links);


        //берем все сохранённые правила для URL
        if (count($all_links) > 0) {
            $all_links_s = implode(',', $all_links);
            $query = "SELECT * FROM `$MYSQL_TABLE22` WHERE `request_uri` IN ($all_links_s)";
            $result = $this->mysql->executeSQL($query);
            while ($row = $this->mysql->fetchAssoc($result)) {
                $this->furl_info['all_friendly_urls'][$row['page_id']][$row['request_uri']] = $row;
            }
        }

        //создаём ссылки на Friendly URL
        $tables_data = array();
        $friendly_links = array();
        $replaced_links = array();
        foreach ($site_links as $link => $link_info) {

            //делаем перенаправление, чтоб вес страниц не утекал
            if ($link_info['replace_host']) {
                if (SETTINGS_REROUTING) {
                    if (SETTINGS_FRIENDLY_URL_ADD_END_SLASH) {
                        $new_link = '/?' . SETTINGS_REROUTING_VARIABLE_NAME . '=' . $link;
                    } else {
                        $new_link = '?' . SETTINGS_REROUTING_VARIABLE_NAME . '=' . $link;
                    }
                } else {
                    $new_link = '';
                }
            } else {
                $new_link = '';
                if (isset($link_info['query']) && !isset($link_info['bad_page_name'])) {

                    //проверяем по правилам подстановки
                    $vars = NULL;
                    $urls_settings_id = 0;
                    if (!isset($this->furl_info['all_friendly_urls'][$link_info['page_id']][$link_info['query']]) || $this->furl_info['all_friendly_urls'][$link_info['page_id']][$link_info['query']] == '') {
                        if (isset($this->furl_info['urls_settings'][$link_info['page_id']])) {

                            $rules = $this->furl_info['urls_settings'][$link_info['page_id']];

                            //проверяем каждое правило, подходит ли оно
                            foreach ($rules as $r) {
                                if (isset($link_info['path'])) {
                                    $r['regular'] = '/^' . $link_info['path'] . $r['regular'] . '$/';
                                } else {
                                    $r['regular'] = '/^' . $r['regular'] . '$/';
                                }

                                if (preg_match($r['regular'], $link)) {
                                    if (isset($r['vars'])) {
                                        $vars = $r['vars'];
                                        $urls_settings_id = $r['id'];
                                    }
                                    break;
                                }
                            }
                        }
                    }

                    //делаем замену
                    $new_link = $this->getFriendlyLink($link_info, $link, $this->furl_info['all_friendly_urls'], $vars, $tables_data, $urls_settings_id);

                } elseif ((isset($link_info['path']) && $link_info['path'] != '') || isset($link_info['have_lang'])) {

                    if (isset($link_info['have_lang'])) {
                        if ($link_info['replaced_lang']) {
                            $link_info['path'] = str_replace(SETTINGS_LANGUAGE_OF_MATERIALS_DEFAULT . $link_info['slash'], '', $link_info['path']);
                            $lfp = '';
                            $lfp_clean = '';
                        } else {

                            if ($link_info['slash'] == '') {
                                $lfp = $link_info['have_lang'] . '/';
                            } else {
                                $lfp = '';
                            }
                            $lfp_clean = $link_info['have_lang'];
                        }
                    } else {
                        $lfp = LANGUAGE_PREFIX_FOR_URL;
                        $lfp_clean = LANGUAGE_PREFIX;
                    }


                    //нужно ли в конце добавлять слеш
                    if (SETTINGS_FRIENDLY_URL_ADD_END_SLASH && mb_strpos($link_info['path'], '.') === false) {
                        //if (SETTINGS_FRIENDLY_URL_ADD_END_SLASH && mb_strpos($link_info['path'], '.') === false) {
                        if ($link_info['page_id'] == $this->furl_info['all_pages'][SETTINGS_INDEX_PAGE]) {
                            $new_link = '/' . $lfp . $link_info['fragment'];
                        } else {
                            $new_link = '/' . $lfp . $link_info['path'] . '/' . $link_info['fragment'];
                        }
                    } else {
                        if ($link_info['page_id'] == $this->furl_info['all_pages'][SETTINGS_INDEX_PAGE]) {
                            if (mb_strpos($link_info['path'], '.') !== false) {
                                $new_link = '/' . $link_info['fragment'];
                            } else {
                                $new_link = '/' . $lfp_clean . $link_info['fragment'];
                            }
                        } else {
                            if (mb_strpos($link_info['path'], '.') !== false) {
                                $new_link = '/' . $link_info['path'] . $link_info['fragment'];
                            } else {

                                $new_link = '/' . $lfp . $link_info['path'] . $link_info['fragment'];
                            }
                        }
                    }
                }
            }


            //меняем ссылку, если для неё есть Friendly URL
            if ($new_link != '') {
                foreach ($link_info['qote'] as $qote => $v) {
                    $replaced_links[] = $link_info['type'] . $qote . $link . $qote;
                    $friendly_links[] = $link_info['type'] . $qote . $new_link . $qote;
                }
            }

        }

        $text = str_replace($replaced_links, $friendly_links, $text);

        return $text;
    }


    /**
     * Формирует Friend Link, работает в связке c replaceLinksByFriendlyUrls
     *
     * @param array $link_info
     * @param string $link
     * @param array $all_friendly_urls
     * @param array $vars
     * @return array
     */
    function getFriendlyLink($link_info, $link, &$all_friendly_urls, $vars = NULL, &$tables_data, $urls_settings_id) {
        GLOBAL $MYSQL_TABLE22, $PAGE_INFO;

        //определяем хост, парсится могут только ссылки, которые ведут на свой домен
        if (isset($link_info['host'])) {
            $host = SETTINGS_HTTP_HOST;
            if (mb_substr($host, 0, -1) == '/') {
                $host = mb_substr($host, -1);
            }
        } else {
            $host = '';
        }

        //определяем текущую страницу
        if (isset($link_info['path']) && $link_info['path'] != '') {
            //чтобы не было в коде прямых ссылок на главную страницу
            if ($link_info['path'] == SETTINGS_INDEX_PAGE) {
                $current_page_name = '';
            } else {
                $current_page_name = $link_info['path'];
            }
        } else {
            if (SETTINGS_INDEX_PAGE != $PAGE_INFO['name']) {
                $current_page_name = $PAGE_INFO['name'];
            } else {
                $current_page_name = '';
            }
        }


        //определяем якорь
        if (isset($link_info['fragment'])) {
            $fragment = $link_info['fragment'];
        } else {
            $fragment = '';
        }


        //если в базе уже есть такая ссылка
        if (isset($all_friendly_urls[$link_info['page_id']][$link_info['query']]) && isset($all_friendly_urls[$link_info['page_id']][$link_info['query']]['friendly_url'])) {
            $new_link = $current_page_name . '/' . $all_friendly_urls[$link_info['page_id']][$link_info['query']]['friendly_url'];
        } else {
            $data_ids = array();

            if ($vars != NULL) { //если есть есть правило замены и оно подходит

                parse_str($link_info['query'], $get_array); //разбираем URL-запрос на массив

                $field_value = array();
                $replaced = '';
                $ostatok = $link_info['query'];

                foreach ($vars as $var) {
                    $var_id = $get_array[$var['var_name']]; //берем значение переменной
                    $var_name_value = $var['var_name'] . '=' . $var_id;
                    $ostatok = str_replace($var_name_value, '', $ostatok); //подсчитываем есть ли переменные, кроме настроек

                    //выбираем транслит по значению
                    if ($var['is_value'] == 0) {
                        $query = "SELECT `{$var['fieldname']}` FROM `{$var['table_name']}` WHERE `id`='$var_id'";
                        $result = $this->mysql->executeSQL($query);
                        list($field_value[]) = $this->mysql->fetchRow($result);
                        $data_ids[] = "{$var['table_id']}=$var_id";

                    }
                }

                $translit = implode('/', $field_value);
                //скрываем в конце индекс, если нужно
                $ostatok = str_replace('&', '', $ostatok); //нужно переделать, что не оставалось знаков &, иначе приходится их вырезать
            } else {
                $translit = '';
                $ostatok = '';
            }

            //добавляем запись подстановки ссылок
            $data_ids_string = implode(',', $data_ids);
            if (!$urls_settings_id) {
                $urls_settings_id = 'NULL';
            }

            $query = "INSERT INTO `$MYSQL_TABLE22` (`page_id`, `urls_settings_id`,  `data_ids`, `request_uri`, `friendly_url`) VALUES ('{$link_info['page_id']}', $urls_settings_id, '$data_ids_string', '{$link_info['query']}', '')";
            $result = $this->mysql->executeSQL($query);
            $new_record_index = $this->mysql->insertID();

            //формируем новую ссылку
            $new_link_parts = array();

            if ($vars != NULL && $ostatok == '') {
                $query_index = '';
            } else {
                $query_index = $new_record_index;
            }

            //формируем Friendly URL
            if ($current_page_name != '') {
                $new_link_parts[] = $current_page_name;
            }

            if ($translit != '') {
                $new_link_parts[] = $translit;
            }

            if ($query_index != '') {
                $new_link_parts[] = $query_index;
            }

            $new_link = implode('/', $new_link_parts);

            $friendly_url = array_splice($new_link_parts, 1);

            $friendly_url = implode('/', $friendly_url);

            if ($friendly_url == '') $friendly_url = $query_index;

            //обновляем сопоставляемое значение
            $query = "UPDATE `$MYSQL_TABLE22` SET `friendly_url`='$friendly_url' WHERE `id`='$new_record_index'";
            $result = $this->mysql->executeSQL($query);

            //добавляем также в массив запись, чтоб в базу потом не лезть
            $tmp['id'] = $query_index;
            $tmp['page_id'] = $link_info['page_id'];
            $tmp['request_uri'] = $link_info['query'];
            $tmp['friendly_url'] = $friendly_url;

            $all_friendly_urls[$link_info['page_id']][$link_info['query']] = $tmp;
        }

        //если в исходной ссылке в начале не указан слеш, тогда ставим его
        if (isset($link_info['have_lang'])) {
            if ($current_page_name == '') $new_link = mb_substr($new_link, 1);
            $new_link = '/' . $new_link;
        } else if (LANGUAGE_PREFIX_FOR_URL != '/') {
            if ($current_page_name == '') $new_link = mb_substr($new_link, 1);
            $new_link = '/' . LANGUAGE_PREFIX_FOR_URL . $new_link;
        }

        //нужно ли в конце добавлять слеш
        if (SETTINGS_FRIENDLY_URL_ADD_END_SLASH) {
            return $host . $new_link . '/' . $fragment;
        } else {
            return $host . $new_link . $fragment;
        }
    }


    /**
     * Делает сопоставление между Friendly URL и данными из массива $_GET
     *
     * @param array $friendly_url_parts
     * @param int $page_id
     * @param int|null $friendly_index
     */
    function parceFriendlyURL($friendly_url_parts, $page_id, $friendly_index)
    {
        GLOBAL $_GET_NEW, $_GET_NEW_FULL, $PAGE_INFO, $MYSQL_TABLE22, $MYSQL_TABLE23;

        $check_url_more = false;

        //берем запись подстановки
        if ($friendly_index != NULL) {

            if (count($friendly_url_parts) > 0) {

                $friendly_url = "AND  `friendly_url`='" . urldecode(implode('/', $friendly_url_parts)) . "/$friendly_index'";
            } else {
                $friendly_url = "AND  `friendly_url`='{$friendly_index}'";
            }

            $query = "SELECT `request_uri` FROM `$MYSQL_TABLE22` WHERE `page_id`='$page_id' AND `id`='$friendly_index' $friendly_url";
            $result = $this->mysql->executeSQL($query);
            list($need_record) = $this->mysql->fetchRow($result);

            //если в запросе присутствует значение, которого нет в базе, тогда выдаём ошибку
            if (!$need_record) {
                $PAGE_INFO = false;

            }
        } else {
            if (count($friendly_url_parts) > 0) {
                $friendly_url = urldecode(implode('/', $friendly_url_parts));
                $query = "SELECT `request_uri` FROM `$MYSQL_TABLE22` WHERE `page_id`='$page_id' AND `friendly_url`='$friendly_url'";
                $result = $this->mysql->executeSQL($query);
                list($need_record) = $this->mysql->fetchRow($result);

                //если в запросе присутствует значение, которого нет в базе, тогда выдаём ошибку
                if (!$need_record) {
                    $check_url_more = true;
                }
            }
        }

        //делаем дополнительную проверку
        if ($check_url_more) {
            if (!$need_record = $this->check_url_more($friendly_url_parts, $page_id)) {
                $PAGE_INFO = false;
            }
        }

        if (isset($need_record)) {
            parse_str($need_record, $_GET_NEW); //разбираем URL-запрос на массив и назначаем новые данные в	$_GET_NEW
            $_GET_NEW_FULL = array_merge_recursive($_GET, $_GET_NEW); //объединяем два массива
            $get = $_GET_NEW_FULL;
        } else $get = null;

        $this->getSafeGetPostVariables($get); //назначаем $_GET и $_POST переменные
    }


    /**
     * Ищет подходящее правило
     *
     * @param aray $friendly_url_parts
     * @param int $page_id
     * @return unknown
     */
    function check_url_more($friendly_url_parts, $page_id)
    {
        GLOBAL $MYSQL_TABLE17, $MYSQL_TABLE18, $MYSQL_TABLE22, $MYSQL_TABLE23, $MYSQL_TABLE24, $PAGE_INFO;

        $link_info_string = false;

        //берем правила подстановки записей
        $urls_settings = array();
        $query = "SELECT `id` FROM `$MYSQL_TABLE23` WHERE `enable`=1 AND `page_id`='$page_id'";
        $result = $this->mysql->executeSQL($query);
        while ($row = $this->mysql->fetchAssoc($result)) {
            $urls_settings[] = $row;
        }

        if (count($urls_settings) > 0) {

            foreach ($urls_settings as $key => $s) {
                $is_value_count = 0;
                $query = "SELECT t.*, t2.table_name, t3.fieldname FROM `$MYSQL_TABLE24` AS `t`
					LEFT JOIN `$MYSQL_TABLE18` AS `t2` ON (t2.id=t.table_id)
					LEFT JOIN `$MYSQL_TABLE17` AS `t3` ON (t3.table_id=t.table_id AND t3.edittype_id=14 AND t3.unique=1)
					WHERE t.urls_settings_id='{$s['id']}' ORDER BY t.sort_index DESC";

                $result = $this->mysql->executeSQL($query);
                while ($row = $this->mysql->fetchAssoc($result)) {
                    if ($row['is_value'] == 0) $is_value_count++;

                    $urls_settings[$key]['vars'][] = $row;
                }
                $urls_settings[$key]['is_value_count'] = $is_value_count;
            }


            //проверяем каждое правило подходит ли оно
            foreach ($urls_settings as $s) {
                $find = true;
                $data_ids = array();
                $link_info = array();

                //если чиcло переменных в правиле и запросе совпадают, тогда ищем подробнее
                if ($s['is_value_count'] == count($friendly_url_parts)) {
                    $i2 = 0;
                    for ($i = 0; $i < count($s['vars']); $i++) {

                        //если значение из таблицы
                        if ($s['vars'][$i]['is_value'] == 0) {

                            $query = "SELECT t.id FROM `{$s['vars'][$i]['table_name']}` AS `t` WHERE t.{$s['vars'][$i]['fieldname']}='{$friendly_url_parts[$i-$i2]}'";
                            $result = $this->mysql->executeSQL($query);

                            if (!list($data_id) = $this->mysql->fetchRow($result)) {
                                $find = false;
                                $remember = false;
                            } else {

                                $remember = true;
                            }
                        } else {
                            $remember = true;
                            $i2++;
                        }

                        if ($remember) {
                            if ($s['vars'][$i]['is_value'] == 0) {
                                $data_ids[] = "{$s['vars'][$i]['table_id']}=$data_id";
                                $link_info[] = "{$s['vars'][$i]['var_name']}=$data_id";
                            } else {
                                $link_info[] = "{$s['vars'][$i]['var_name']}={$s['vars'][$i]['value']}";
                            }
                        }
                    }
                } else {
                    $find = false;
                }

                //если нашли подходящее правило
                if ($find) {
                    $link_info_string = implode('&', $link_info);
                    $data_ids_string = implode(',', $data_ids);
                    $friendly_url_string = implode('/', $friendly_url_parts);

                    if (!$s['id']) {
                        $s['id'] = 'NULL';
                    }

                    $query = "INSERT INTO `$MYSQL_TABLE22` (`page_id`, `urls_settings_id`, `data_ids`, `request_uri`, `friendly_url`)
					VALUES ('$page_id', {$s['id']},  '$data_ids_string', '$link_info_string', '$friendly_url_string')";
                    $result = $this->mysql->executeSQL($query);

                    break;
                }
            }
        }

        return $link_info_string;

    }


    /**
     * Обновляем запись в таблице cms_friendly_urls, если отредактировали исходную запись через API
     *
     * @param array $fs
     * @param array $friendly_translit
     * @param int $id
     */
    function updateFriendlYURL($fs, $friendly_translit, $id, $deleted = false)
    {
        GLOBAL $MSGTEXT, $MYSQL_TABLE22, $MYSQL_TABLE24;

        $data_ids = "{$fs[$friendly_translit['fieldname']]['table_id']}=$id";

        //берем из таблицы значение ссылок Friendly URL
        $query = "SELECT * FROM `$MYSQL_TABLE22` WHERE (data_ids LIKE '$data_ids,%' OR data_ids LIKE '%,$data_ids' OR data_ids LIKE '%,$data_ids,%') OR data_ids='$data_ids'";
        $result = $this->mysql->executeSQL($query);
        $fu_all = $this->mysql->fetchAssocAll($result);

        //меняем в поле значение		
        foreach ($fu_all as $fu) {
            if (isset($fu['friendly_url'])) {
                //берем переменные настройки
                $var_index = 0;
                $query = "SELECT * FROM `$MYSQL_TABLE24` WHERE `urls_settings_id`='{$fu['urls_settings_id']}' AND is_value='0' ORDER BY `sort_index` DESC";
                $result = $this->mysql->executeSQL($query);
                while ($row = $this->mysql->fetchAssoc($result)) {
                    if ($row['table_id'] == $fs[$friendly_translit['fieldname']]['table_id']) {
                        break;
                    } else {
                        $var_index++;
                    }
                }

                if (!$deleted) {
                    //перезаписываем Friendly URL
                    $friendly_translit_new = explode('/', $fu['friendly_url']);
                    $friendly_translit_new[$var_index] = $friendly_translit['value'];
                    $friendly_translit_new = implode('/', $friendly_translit_new);
                    $query = "UPDATE `$MYSQL_TABLE22` SET `friendly_url`='$friendly_translit_new' WHERE `id`='{$fu['id']}'";
                    $result = $this->mysql->executeSQL($query);
                } else {
                    $query = "DELETE FROM `$MYSQL_TABLE22` WHERE `id`='{$fu['id']}'";
                    $result = $this->mysql->executeSQL($query);
                }
            }
        }
    }


    /**
     * Встраивает системный код для режима быстрое редактирование
     *
     * @param text $text
     * @return text
     */
    function fastEditModeReplaceTagsInBlocks($text, $current_block_id, $tablesInfo, $current_tag_id, $lang_id, $current_page_id, $module)
    {

        $reg = '/ fastedit:(.*?):(\d*)(.)/';
        preg_match_all($reg, $text, $content_array, PREG_SPLIT_DELIM_CAPTURE);

        $replace_pairs = array();

        foreach ($content_array as $t) {
            $table_name = $t[1];
            $last_symbol = $t[3];

            if (isset($tablesInfo[$table_name])) {
                $table_description = $tablesInfo[$table_name]['description'];
                if ($tablesInfo[$table_name]['page_id'] != '') {
                    $page_id = $tablesInfo[$table_name]['page_id'];
                } else {
                    $page_id = $current_page_id;
                }

                if ($tablesInfo[$table_name]['tag_id'] != '') {
                    $tag_id = $tablesInfo[$table_name]['tag_id'];
                } else {
                    $tag_id = $current_tag_id;
                }

                $block_id = $current_block_id;
            } else {

                if ($table_name != '') {
                    $table_description = $module['genetal_tablename_description'];
                } else {
                    $table_description = '';
                }
                $tag_id = $current_tag_id;
                $page_id = $current_page_id;
                $block_id = $current_block_id;
            }


            //если указан ID записи
            if ($t[2] != '') {
                $edit_able = 1;
                $id = $t[2];
                $url = '&quot;/' . SETTINGS_ADMIN_PATH . "/index.php?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&p=1&hide_menu=true&t_name={$table_name}&search={$id}&fastEdit=true&l_id={$lang_id}#data form&quot;";
            } else {
                if ($module['genetal_tablename_description'] == '') {
                    $module['genetal_tablename_description'] = $module['block_description'];
                    $edit_able = 0;
                } else {
                    $edit_able = 1;
                }

                $url = '&quot;/' . SETTINGS_ADMIN_PATH . "/index.php?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&p=1&hide_menu=true&t_name={$module['genetal_tablename']}&search=&fastEdit=true&l_id={$lang_id}&quot;";
            }

            $replace_pairs[$t[0]] = " oncontextmenu='return ___GoodCMS_menu(1, event, $url, &quot;{$block_id}&quot;, &quot;$table_description&quot;, $edit_able)'{$last_symbol}";
        }

        $text = strtr($text, $replace_pairs);

        return $text;
    }


    /**
     * Встраивает системный код меню для режима быстрое редактирование и вырезает системный код до тега <body>
     *
     * @param text $text
     * @return text
     */
    function fastEditModeReplaceTags($text)
    {
        GLOBAL $MSGTEXT;

        if (count($MSGTEXT) == 0) {
            include $_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/languages/' . SETTINGS_LANGUAGE; //подключаем язык
        }
        $this->smarty->assign('MSGTEXT', $MSGTEXT); //подключаем сообщения из файла
        $insert_code = $this->smarty->fetch($_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/templates/fastEditMenu.tpl');

        $text = preg_replace('/<body(.*?)>/is', '<body$1>' . $insert_code, $text, 1);

        //заменяем дружественные URL
        if (SETTINGS_FRIENDLY_URL) {
            $text = $this->replaceLinksByFriendlyUrls($text);
        }

        return $text;
    }


    /**
     * Проверяет является ли объект сериализованным массивом
     *
     * @param string $value
     * @param bool $result
     * @return bool
     */
    function is_serialized($value, &$result = null)
    {

        if (!is_string($value)) {
            return false;
        }

        if ($value === 'b:0;') {
            $result = false;
            return true;
        }

        $length = mb_strlen($value);
        $end = '';

        switch ($value[0]) {
            case 's':
                if ($value[$length - 2] !== '"') {
                    return false;
                }
            case 'b':
            case 'i':
            case 'd':
                $end .= ';';
            case 'a':
            case 'O':
                $end .= '}';

                if ($value[1] !== ':') {
                    return false;
                }

                switch ($value[2]) {
                    case 0:
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                    case 8:
                    case 9:
                        break;
                    default:
                        return false;
                }
            case 'N':
                $end .= ';';

                if ($value[$length - 1] !== $end[0]) {
                    return false;
                }
                break;

            default:
                return false;
        }

        if (($result = @unserialize($value)) === false) {
            $result = null;
            return false;
        }
        return true;
    }


    /**
     * Определяет имя поля первичного ключа для таблицы
     *
     * @return string
     */
    function getTablePkIncrFieldName($current_tablename)
    {

        $pk_incr_fieldname = 'id';

        return $pk_incr_fieldname;
    }


    /**
     * форматирует дату взависимости от часового пояса
     *
     * @param string $GMT_datetime
     * @param float $UMC_hours
     * @param string $format
     * @return string
     */
    function userDateTime($GMT_datetime, $UMC_hours, $format)
    {

        $int_datetime = strtotime($GMT_datetime);
        $timeNew = $int_datetime + ($UMC_hours * 3600);
        return date($format, $timeNew);
    }


    /**
     * Возвращает значение по ключу
     *
     * @param unknown_type $masiv
     * @param unknown_type $key
     * @return unknown
     */
    function findValueByKey($masiv, $key)
    {
        foreach ($masiv as $mas) {
            foreach ($mas as $k => $v) {
                if ($k == $key) {
                    return $v;
                }
            }
        }
    }


    /**
     * Возвращает масси языков системы
     *
     * @return array|bool
     */
    function get_system_langs()
    {
        GLOBAL $FILE_MANAGER;

        //берем список файлов с языками
        $langs = array();
        $find_in_dir = $_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/languages/';
        if ($handle = opendir($find_in_dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..' && $file != '.htaccess') {
                    if (is_file($find_in_dir . $file)) {
                        $lang_description = $FILE_MANAGER->getfile($find_in_dir . $file);
                        $lang_description = str_replace(array("\r", "\n", "\t"), '', $lang_description);

                        preg_match("/\/\*(.*?)\*\//u", $lang_description, $d);
                        if (isset($d[1])) {
                            $l_description = addslashes($d[1]);
                            $l_description = str_replace('/', '', $l_description);
                            $l_description = ltrim($l_description);
                            $langs[$file] = $l_description;
                        } else {
                            $langs[$file] = $file;
                        }
                    }
                }
            }
            closedir($handle);
        } else $langs = false;

        return $langs;
    }


    /**
     * Разбирает SQL-запрос и возвращает массив, содержащий имена таблиц и их алиасы
     *
     * @param string $query
     * @return array of alias mapping
     */

    function queryAlias($query)
    {

        $substr = mb_strtolower($query);
        $substr = preg_replace('/\(.*\)/', '', $substr);
        $substr = preg_replace('/[^a-zA-Z0-9_,]/', ' ', $substr);
        $substr = preg_replace('/\s\s+/', ' ', $substr);

        //$substr = mb_strtolower(mb_substr($substr, mb_strpos(mb_strtolower($substr),' from ') + 6));
        $substr = mb_substr($substr, mb_strpos($substr, ' from ') + 6);

        $substr = preg_replace(
            Array(
                '/ where .*+$/',
                '/ group by .*+$/',
                '/ limit .*+$/',
                '/ having .*+$/',
                '/ order by .*+$/',
                '/ into .*+$/'
            ), '', $substr);

        $substr = preg_replace(
            Array(
                '/ left /',
                '/ right /',
                '/ inner /',
                '/ cross /',
                '/ outer /',
                '/ natural /',
                '/ as /'
            ), ' ', $substr);

        $substr = preg_replace(Array('/ join /', '/ straight_join /'), ',', $substr);

        $out_array = Array();
        $st_array = explode(',', $substr);

        foreach ($st_array as $col) {
            $col = preg_replace(Array('/ on .*+/'), '', $col);
            $tmp_array = explode(' ', trim($col));
            if (!isset($tmp_array[0])) continue;

            $first = $tmp_array[0];

            if (isset($tmp_array[1]))
                $second = $tmp_array[1];
            else  $second = $first;

            if (mb_strlen($first)) $out_array[$second] = $first;
        }

        return $out_array;
    }


    /**
     * Обработчик ошибок
     *
     * @param код ошибки $errno
     * @param описание ошибки $errstr
     * @param файл ошибки $errfile
     * @param строка файла ошибки $errline
     * @return bool
     */
    function errorHandler($errno, $errstr, $errfile, $errline)
    {
        GLOBAL $ERROR_IN_CODE;

        //return false;	//если ошибка возникнет в классе General Functions тогда ошибка не будет видна, нужно разкоментировать эту строчку

        if (mb_strpos($errfile, SETTINGS_ADMIN_PATH . '\smarty\templates_c') > 0 || mb_strpos($errfile, SETTINGS_ADMIN_PATH . '/smarty/templates_c') > 0) { //не выводим сообщения, если не инициализированы переменные в шаблонах smarty
            return false;
        }

        if ($errno > 0 && $errno != 8) $ERROR_IN_CODE = true;

        // если не включено отображение ошибок
        if (!SETTINGS_SHOW_ERRORS) {
            return true;
        }


        GLOBAL $GENERAL_FUNCTIONS, $GLOBAL_ERRORS, $MSGTEXT;
        require_once $_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/languages/' . SETTINGS_LANGUAGE; //подключаем язык

        $error = array();
        $error['code'] = $errno;
        $error['line'] = $errline;
        $error['filename'] = $errfile;
        $error['description'] = sprintf($MSGTEXT['e_handle_description_data'], $errstr, $error['filename'], $error['line']);

        switch ($errno) {
            case E_ERROR:
                $error_name = 'ERROR';
                break;

            case E_WARNING:
                $error_name = 'WARNING';
                break;

            case E_PARSE:
                $error_name = 'PARSE';
                break;

            case E_NOTICE:
                $error_name = 'NOTICE';
                break;

            case E_CORE_ERROR:
                $error_name = 'CORE_ERROR';
                break;

            case E_CORE_WARNING:
                $error_name = 'CORE_WARNING';
                break;

            case E_COMPILE_ERROR:
                $error_name = 'COMPILE_ERROR';
                break;

            case E_COMPILE_WARNING:
                $error_name = 'COMPILE_WARNING';
                break;

            case E_USER_ERROR:
                $error_name = 'USER_ERROR';
                break;

            case E_USER_WARNING:
                $error_name = 'USER_WARNING';
                break;

            case E_USER_NOTICE:
                $error_name = 'USER_NOTICE';
                break;

            case E_ALL:
                $error_name = 'ALL';
                break;

            case E_STRICT:
                $error_name = 'STRICT';
                break;

            default:
                $error_name = 'Unknown error type';
                break;
        }

        $error['type'] = $error_name;

        $GLOBAL_ERRORS[] = $error;

        return true;
    }


    /**
     * Записывает запросы SELECT в файл /SETTINGS_ADMIN_PATH/logs/SqlLog.php
     *
     * @param string $query
     * @return bool
     */
    function saveLogQueryToFile()
    {
        GLOBAL $LOG_QUERIES;

        $FILE_MANAGER = $this->getFileManagerObject();

        $logfilename = $_SERVER['DOCUMENT_ROOT'] . '/' . SETTINGS_ADMIN_PATH . '/logs/SqlLog.php';
        $fsize = filesize($logfilename);

        if ($fsize !== false && $fsize <= SETTINGS_LOG_SQL_MAX_FILE_SIZE * 1000) { //переводим в байты

            if ($fd = $FILE_MANAGER->fopen($logfilename, 'w')) {
                fwrite($fd, '<?php $LOG_QUERIES = ' . var_export($LOG_QUERIES, true) . '; ?>');
                fclose($fd);
                return true;
            } else return false;
        } else return false;
    }


    /**
     * Формирует URL для подсветки
     *
     * @param string $url
     * @return array|bool
     */
    function getFormatURL($url)
    {
        GLOBAL $MYSQL_TABLE3;

        $url = str_replace('/' . SETTINGS_ADMIN_PATH . '/', '', $url);
        $temp = explode('?', $url);
        if (isset($temp[1])) {
            $pageName = $temp[0]; //берём имя страницы

            $get = explode('&', $temp[1]); //переменные запроса
            $act = false;
            $dosome = false;
            $pageCategoryId = false;
            $page_id = false;
            $page = false;

            for ($i = 0; $i < count($get); $i++) {
                $variable = explode('=', $get[$i]);

                if ($variable[0] == 'act') {
                    $act = $variable[1];
                }

                if ($variable[0] == 'do') {
                    $dosome = $variable[1];
                }


                if ($variable[0] == 'page_id') {
                    $page_id = $variable[1];
                }

                if ($variable[0] == 'pageCategoryId') {
                    $pageCategoryId = $variable[1];
                } else if ($act == 'pages') {
                    $pageCategoryId = 0;
                }


                if ($variable[0] == 'page') {
                    $page = $variable[0];
                }
            }

            $res1 = $pageName . '?act=' . $act;

            if ($dosome) {
                $res1 = $res1 . '&do=' . $dosome;
            }


            if ($page_id !== false) {
                $res1 = $res1 . '&page_id=' . $page_id;
            }

            if ($pageCategoryId !== false) {
                $res1 = $res1 . '&pageCategoryId=' . $pageCategoryId;
            }

            if ($page !== false) {
                $res1 = $res1 . '&page';
            }
        } else {
            $res1 = $url;
        }


        $page_url = SETTINGS_HTTP_HOST;

        //делаем сопоставление
        if (isset($act)) {
            //редактирование свойст страниц
            if ($act == 'modules' && isset($this->get['do']) && $this->get['do'] == 'managedata' && isset($this->get['page_id'])) {

                $query = "SELECT * FROM `$MYSQL_TABLE3` WHERE `id`='{$this->get['page_id']}'";
                $result = $this->mysql->executeSQL($query);
                $page = $this->mysql->fetchAssoc($result);
                $res1 = "index.php?act=pages&page_id={$page['id']}&pageCategoryId={$page['page_category']}";

                //формируем ссылку перехода на сайт
                if ($page['name'] != '' && $page['name'] != SETTINGS_INDEX_PAGE) {
                    if (mb_substr(SETTINGS_HTTP_HOST, -1) != '/') {
                        $page_url .= '/';
                    }
                    $page_url .= $page['name'];
                    if (SETTINGS_FRIENDLY_URL_ADD_END_SLASH) {
                        $page_url .= '/';
                    }
                }

            } else {
                $settings = array('friendly_url_rules', 'languagesofmaterial');
                if (in_array($act, $settings)) {
                    $res1 = 'index.php?act=settings&page';
                }
            }
        }

        return array($res1, $page_url);
    }


    /**
     * Перезыписываем перенаправлеие с основного сервера c или без www.
     *
     * @param string $good_host
     * @return bool
     */
    function replaceHostInHtaccess($good_host)
    {

        $filename = $_SERVER['DOCUMENT_ROOT'] . '/.htaccess';
        if ($text = file_get_contents($filename)) {
            $out = true;

            //определяем с какого на какой хост делать перенаправление
            $bad_host = str_ireplace(array('http://', 'www.'), '', $good_host);
            if (mb_stripos($good_host, 'www.') === false) {
                $bad_host = 'www.' . $bad_host;
            }

            $new_content = preg_replace('/[# \t]*RewriteCond[ \t]*%\{HTTP_HOST\}[ \t]*\^(.*)' . "[ \t\r\n]*" . '/i', "RewriteCond %{HTTP_HOST} ^$bad_host\r\n", $text);
            $new_content = preg_replace('/[# \t]*RewriteRule[ \t]*\^\(\.\*\)\$[ \t]*(.*?)\/\$1[ \t]*\[R=301,L\]' . "[ \t\r\n]*" . '/i', 'RewriteRule ^(.*)\$ ' . $good_host . '/\$1 [R=301,L]' . "\r\n", $new_content);

            file_put_contents($filename, $new_content);
        } else $out = false;

        return $out;
    }

    /**
     * Формирует дерево тегов с подстановкой
     *
     * @param int $tpl_id
     * @param int $deep
     * @return array
     */
    function getTagsTree($tpl_id, $virtual_tpl_id, $deep)
    {
        GLOBAL $MYSQL_TABLE11, $MYSQL_TABLE4, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE18;

        $tags = $this->getTagsTreeRecursive($tpl_id, $virtual_tpl_id, $deep);

        //берём полусквозные теги в текущем шаблоне
        $middle = array();
        foreach ($tags AS $tag) {

            if ($tag['global'] == 1) {
                $middle[$tag['virtualtagname']] = $tag;
            }
        }

        //отбираем сквозные теги по всем шаблонам
        $global = array();
        $query = "SELECT t.sort_index,t.tagname, t.id AS `prim_id`, t.templates_id, t2.*, t2.id AS `virtualtag_id`, t3.type AS `block_type`, t3.name AS `block_name`, t3.general_table_id, t3.description, t4.name AS `module_name`, t4.id AS `module_id`, t5.table_name FROM `$MYSQL_TABLE4` AS `t`
		LEFT JOIN `$MYSQL_TABLE11` AS `t2` ON (t2.tag_id=t.id) 
		LEFT JOIN `$MYSQL_TABLE6` AS `t3` ON (t3.id=t2.block_id)
		LEFT JOIN `$MYSQL_TABLE5` AS `t4` ON (t4.id=t3.module_id) 
		LEFT JOIN `$MYSQL_TABLE18` AS `t5` ON (t5.id=t3.general_table_id) 
		WHERE t2.global='2' ORDER BY t.sort_index";
        $result = $this->mysql->executeSQL($query);
        while ($row = $this->mysql->fetchAssoc($result)) {
            $global[$row['virtualtagname']] = $row;
        }


        //заменяем теги
        foreach ($tags AS $key => $tag) {
            if (isset($global[$tag['virtualtagname']])) {
                $tags[$key] = $global[$tag['virtualtagname']];
                //$tags[$key]['deep']	= $tag['deep'];				
                //$tags[$key]['id']	= $tag['id'];
                $tags[$key]['deep'] = $tag['deep'];
                //$tags[$key]['id']	= $tag['id'];				
                $tags[$key]['id'] = $global[$tag['virtualtagname']]['id'];
                //print_r($global); exit;	
            } else if (isset($middle[$tag['virtualtagname']])) {
                $tags[$key] = $middle[$tag['virtualtagname']];
                $tags[$key]['deep'] = $tag['deep'];
                //$tags[$key]['id']	= $tag['id'];
                $tags[$key]['id'] = $middle[$tag['virtualtagname']]['id'];
            }
            $tags[$key]['real_tag_id'] = $tag['tag_id']; //сохраняем реальный ID
        }


        return $tags;
    }


    /**
     * Рекурсивно формирует дерево тегов
     *
     * @param int $tpl_id
     * @param int $deep
     * @return array
     */
    function getTagsTreeRecursive($tpl_id, $virtual_tpl_id, $deep)
    {
        GLOBAL $MYSQL_TABLE4, $MYSQL_TABLE5, $MYSQL_TABLE10, $MYSQL_TABLE11, $MYSQL_TABLE6, $MYSQL_TABLE2, $MYSQL_TABLE18;

        //берём теги основного шаблона
        $query = "SELECT t.sort_index,t.tagname, t.id AS `prim_id`, t.templates_id, t2.*, t2.id AS `virtualtag_id`, t3.type AS `block_type`, t3.name AS `block_name`, t3.general_table_id, t3.description, t4.name AS `module_name`, t4.id AS `module_id`, t5.table_name, t6.tamplates_id AS `main_tpl_id` FROM `$MYSQL_TABLE4` AS `t`
		LEFT JOIN `$MYSQL_TABLE11` AS `t2` ON (t2.tag_id=t.id AND t2.virtualtemplate_id='$virtual_tpl_id') 
		LEFT JOIN `$MYSQL_TABLE6` AS `t3` ON (t3.id=t2.block_id)
		LEFT JOIN `$MYSQL_TABLE5` AS `t4` ON (t4.id=t3.module_id) 
		LEFT JOIN `$MYSQL_TABLE18` AS `t5` ON (t5.id=t3.general_table_id)
		LEFT JOIN `$MYSQL_TABLE10` AS `t6` ON (t6.id=t2.virtualtemplate_id)
		WHERE t.templates_id='$tpl_id' ORDER BY t.sort_index";
        $result = $this->mysql->executeSQL($query);
        $tags = $this->mysql->fetchAssocAll($result);

        $all_tpl_tags = array();

        foreach ($tags as $key => $t) {
            $t['deep'] = $deep;

            if ($t['virtualtagname']) {
                $t['virtualtagname'] = $t['virtualtagname'];
            } else {
                //добавляем виртуальный тег
                if ($t['templates_id']!=$t['main_tpl_id']) {
                    $from_tpl_id    = $t['templates_id'];
                }
                else {
                    $from_tpl_id    = 'NULL';
                }
                $query = "INSERT INTO `$MYSQL_TABLE11` (`tag_id`, `virtualtemplate_id`, `virtualtagname`, `block_id`, `include_tpl_id`, `from_tpl_id`) VALUES ('{$t['prim_id']}', '$virtual_tpl_id', '{$t['tagname']}', NULL, NULL, $from_tpl_id)";
                $this->mysql->executeSQL($query);
                $t['virtualtagname'] = $t['tagname'];
                $t['id'] = $this->mysql->insertID();
            }

            $all_tpl_tags[] = $t;

            if ($t['include_tpl_id']) {

                $t['deep'] = $deep + 1;

                $tpl_include_id = $t['include_tpl_id'];

                $t_temp = $this->getTagsTreeRecursive($t['include_tpl_id'], $virtual_tpl_id, $deep + 1);

                foreach ($t_temp as $tt) {
                    $all_tpl_tags[] = $tt;
                }
            }
        }

        $tags = $all_tpl_tags;

        return $tags;
    }


}

?>