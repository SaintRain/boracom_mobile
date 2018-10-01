<?php

/*
//включение подсчета времени генерирования страницы
$start_time 	= microtime();
$start_array 	= explode(' ',$start_time);
$start_time 	= $start_array[1] + $start_array[0];
*/

session_start();

//проверка безопасности сессий
$check_user_session		= $_SERVER['REMOTE_ADDR'];
if (isset($_SERVER['HTTP_USER_AGENT'])) {
	$check_user_session.=$_SERVER['HTTP_USER_AGENT'];
}

if (count($_SESSION>0)) {
	//проверяем, чтоб небыло подмены сессии
	if (isset($_SESSION['___GoodCMS']['check_user_session'])) {
		if ($check_user_session!=$_SESSION['___GoodCMS']['check_user_session']) {
			session_destroy();
		}
	}
}

define('REQUIRE_ADDITIONAL_FILES', 		true);		 //если флаг выставлен, то будут подключены дополнительные библиотеки админзоны
require_once 'tools/admin_patch.php';         		 //путь к админзоне
require_once $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/config.php';      //настройки подключение к БД

//если требуется установка
if (MYSQL_HOST=='') {
	header('location:/'.SETTINGS_ADMIN_PATH.'/install');
	exit;
}
//делаем перенаправление
else if (isset($_GET[SETTINGS_REROUTING_VARIABLE_NAME])) {
	header('Location: '.urldecode($_GET[SETTINGS_REROUTING_VARIABLE_NAME]));
	exit;
}

//проверяем установлен ли мемкеш
if (class_exists('Memcache')) {
	$MEMCAHE 				= new Memcache();
	if (@$MEMCAHE->connect(SETTINGS_MEMCACHED_HOST, SETTINGS_MEMCACHED_PORT)) {

		if (isset($_SESSION['___GoodCMS'])) {
			//формируем часть ключа страницы для мемкеша
			$mpart	= var_export($_SESSION['___GoodCMS'], true);
		}
		else {
			$mpart	= '';
		}

		//формируем ключ страницы для мемкеша
		$MEMCAHE_page_key 	= $_SERVER['REQUEST_URI'].$mpart;

		//выводим кеш, если есть
		if ($CONTENT  = $MEMCAHE->get($MEMCAHE_page_key)) {
			$memcahe_exists  = true;
			//вывод страницы из мемкеша
			echo $CONTENT;
		}
		else {
			$memcahe_exists  = false;
		}
	}
	else {
		$memcahe_exists 	= false;
		$MEMCAHE			= null;
	}
}
else {
	$memcahe_exists 		= false;
	$MEMCAHE				= null;
}

if (!$memcahe_exists) {

	$GLOBAL_ERRORS			= array();					 //содержит ошибки, которые возникают в скриптах
	$ERROR_IN_CODE			= false;
	$TOTAL_TAGS				= 0;						 //хранит общее количество тегов в шаблоне
	$COUNT_TYPE_2_TAGS		= 0;						 //хранит количество тегов в шаблоне к которым подключены блоки с типом 2

	$slash_in_end			= false;					//слеш в конце имени страницы
	$set_by_script_index	= false;					//если имя страницы установленно на индексную скриптом

	//подключаем установленные языки материала
	require_once ($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/dictionary/configLanguage.php');  	//подключаем языки материала

	//разбираем URL - запрос
	$request_uri   		= $_SERVER['REQUEST_URI'];

	if (count($_GET)>0) {
		$pos			= mb_strpos($request_uri, '?');
		$request_uri 	= mb_substr($request_uri, 0, $pos);
	}

	$m	= explode('/', $request_uri);
	if ($m[count($m)-1]=='') {
		unset($m[count($m)-1]);									//удаляем последний пустой массив, если в конце есть слеш
		$slash_in_end		= true;
	}

	//определяем префикс языка
	if (isset($m[1]) && isset($LANGUAGES_OF_MATERIAL[$m[1]])) {
		$LANGUAGE_PREFIX	= $m[1];
		$page_in_index		= 2;
	}
	else {
		$LANGUAGE_PREFIX	= SETTINGS_LANGUAGE_OF_MATERIALS_DEFAULT;
		$page_in_index		= 1;
	}

	//определяем страницу
	if (isset($m[$page_in_index]) && $m[$page_in_index]!='') {
		$PAGE_NAME   		= $m[$page_in_index];
		$friendly_in_index	= $page_in_index+1;
	}
	else	{
		$PAGE_NAME   		= SETTINGS_INDEX_PAGE;
		$friendly_in_index	= $page_in_index;
		$set_by_script_index= true;
	}

	//если включены Friendly URL
	if (SETTINGS_FRIENDLY_URL) {
		//определяем id записи из таблицы cms_friendly_urls, если есть
		if (is_numeric($m[count($m)-1])) {
			$FRIENDLY_INDEX		= $m[count($m)-1];
			$friendly_in_length	= count($m)-($page_in_index+2);
		}
		else {
			$FRIENDLY_INDEX		= NULL;
			$friendly_in_length	= count($m)-($page_in_index+1);
		}

		//определяем массив транслита
		if ($friendly_in_length>0)	{
			$FRIENDLY_URL_PARTS	= array_slice($m, $friendly_in_index, $friendly_in_length);
		}
		else {
			$FRIENDLY_URL_PARTS	= NULL;
		}

		//если имя страницы определилось, как индекс, тогда мы находимся на главной
		if (is_numeric($PAGE_NAME))  {
			$PAGE_NAME				= SETTINGS_INDEX_PAGE;
			$set_by_script_index	= true;
		}
	}
	else {
		//проверяем, чтоб в режиме без ЧПУ был правильный URL
		if (count($m)-$page_in_index>1) {
			$PAGE_NAME	= '';
		}
	}

	//если в URL - запросе есть префикс языка, который выставлен по умолчанию, тогда делаем перенаправление,
	//иначе будет возможным запрашивать одни и теже страницы с префиксом и без, что снизит вес ссылок
	if ($page_in_index==2 && SETTINGS_LANGUAGE_OF_MATERIALS_DEFAULT==$LANGUAGE_PREFIX) {
		$redirect_url	= preg_replace('/\/'.$LANGUAGE_PREFIX.'/', '', $_SERVER['REQUEST_URI'], 1);
		header('location: '.$redirect_url, true, 301);
		exit;
	}
    $dot_pos    =  mb_strpos($_SERVER['REQUEST_URI'],'.');
	//делаем перенаправление, чтоб в конце был слеш
	if (SETTINGS_FRIENDLY_URL_ADD_END_SLASH && SETTINGS_FRIENDLY_URL && !$slash_in_end && $dot_pos===false) {

		if (count($_GET)==0) {
			$redirect_url	= $_SERVER['REQUEST_URI'].'/';
		}
		else {
			$redirect_url	= preg_replace('/\?/', '/?', $_SERVER['REQUEST_URI'], 1);
		}

		header('location: '.$redirect_url, true, 301);
		exit;
	}
	//если в конце не должно быть слеша, тогда обрезаем
	else if ((!SETTINGS_FRIENDLY_URL_ADD_END_SLASH && $slash_in_end)) {
		if (count($_GET)==0) {
			$redirect_url	= mb_substr($_SERVER['REQUEST_URI'], 0, -1);
		}
		else {
			$redirect_url	= preg_replace('/\/'.$PAGE_NAME.'\//', '/'.$PAGE_NAME, $_SERVER['REQUEST_URI'], 1);
		}

		if ($redirect_url!='') {
			header('location: '.$redirect_url, true, 301);
			exit;
		}
	}
    //если должен быть слеш, но в URL есть точка, тогда пропускаем
    else if (SETTINGS_FRIENDLY_URL_ADD_END_SLASH && $dot_pos && $slash_in_end) {
        if (count($_GET)==0) {
            $redirect_url	= mb_substr($_SERVER['REQUEST_URI'], 0, -1);
        }
        else {
            $redirect_url	= preg_replace('/\/'.$PAGE_NAME.'\//', '/'.$PAGE_NAME, $_SERVER['REQUEST_URI'], 1);
        }

        if ($redirect_url!='') {
            header('location: '.$redirect_url, true, 301);
            exit;
        }
    }


	//если явно указана главная страница, тогда делаем перенаправление
	if ($PAGE_NAME==SETTINGS_INDEX_PAGE && !$set_by_script_index) {
		$redirect_url	= preg_replace('/\/'.$PAGE_NAME.'/', '', $_SERVER['REQUEST_URI'], 1);

		if ($redirect_url=='') $redirect_url='/';

		header('location: '.$redirect_url);
		exit;
	}

	//получаем переменную, которая используется в ссылках для указания префикса языка
	//если префикс совпадает с языком по умолчанию, тогда префикс пустой, это нужно для SEO, чтоб не терялся вес ссылок
	if ($LANGUAGE_PREFIX==SETTINGS_LANGUAGE_OF_MATERIALS_DEFAULT) {
		define('LANGUAGE_PREFIX_FOR_URL', 	'');
		define('LANGUAGE_PREFIX', 			'');
	}
	else {
		define('LANGUAGE_PREFIX_FOR_URL',  	$LANGUAGE_PREFIX.'/');
		define('LANGUAGE_PREFIX', 			$LANGUAGE_PREFIX);
	}

	//ГЕНЕРАЦИЯ ЗАПРАШИВАЕМОЙ СТРАНИЦЫ
	if (SETTINGS_SHOW_ERRORS==1) {
		ini_set('display_errors',			1);
		ini_set('display_startup_errors',	1);
		ini_set('error_reporting',	 		E_ALL);
	}
	else {
		ini_set('display_errors',			0);
		ini_set('display_startup_errors',	0);
	}

	if (SETTINGS_LOG_SQL_REQUESTS) {
		include_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/logs/SqlLog.php');

		if (!isset($LOG_QUERIES)) {
			$LOG_QUERIES			= array();
		}
	}

	require_once (SETTINGS_ADMIN_PATH.'/DbConnection.php');					//подключаем класс для работы с БД
	$mysql							= new DbConnection();

	//берем информацию о странице
	$query		= "SELECT t.*, t2.tamplates_id as `tpl_id` FROM `$MYSQL_TABLE3` AS `t`, `$MYSQL_TABLE10` AS `t2` WHERE t.name=\"$PAGE_NAME\" AND t.enable=1 AND t.templates_id=t2.id";
	$result		= $mysql->executeSQL($query);
	$PAGE_INFO	= $mysql->fetchAssoc($result);
	$mysql->freeResult($result);

	//ставим блокировку от Dog-pile effect
	if ($PAGE_INFO['cache'] && $MEMCAHE) {
		$lock 	= $MEMCAHE->add('lock:' . $MEMCAHE_page_key, 1, false, 3);
	}
	else {
		$lock	= false;
	}

	//ывводим кеш
	if ($PAGE_INFO['cache'] && !$lock && $MEMCAHE)	 {
		while (!$CONTENT			= $MEMCAHE->get($MEMCAHE_page_key)) {
			usleep(10000);		//ждём 0.01
		}
		echo $CONTENT;
	}
	else {

		$_GET_NEW						= array();						//вспомагательный массив
		$_GET_NEW_FULL					= array();						//вспомагательный массив

		//подключаем смарти
		require_once 				 	$_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/Smarty.class.php';
		$smarty							= new Smarty;

		$smarty->template_dir			= $TEMPLATES_PATH;					//папка по умолчанию, где хранятся шаблоны сайта
		$smarty->compile_dir			= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/templates_c/';
		$smarty->cache_dir				= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/smarty/cache/';
		$smarty->cache					= true;
		$smarty->cache_modified_check	= true;
		$smarty->compile_check			= true;

		require_once (SETTINGS_ADMIN_PATH.'/includes/GeneralFunctions.php');		//библиотека функций админзоны
		$GENERAL_FUNCTIONS	= new GeneralFunctions($mysql, $smarty, SETTINGS_FRIENDLY_URL);

		require_once (SETTINGS_ADMIN_PATH.'/includes/FRAME_FUNCTIONS.php');		//библиотека общедоступных пользовательских функций
		$FRAME_FUNCTIONS	= new FRAME_FUNCTIONS($mysql, $smarty, SETTINGS_FRIENDLY_URL);

		//указываем обработчик ошибок
		set_error_handler(array($GENERAL_FUNCTIONS, 'errorHandler'));
		try {

			//включаем сжатие контента
			if (extension_loaded('zlib')) {
				ob_start('ob_gzhandler', 1);
			}
			else {
				ob_start();
			}

			//если включен Friendly URL, тогда делаем подстановку реальных переменных для массива $_GET
			if (SETTINGS_FRIENDLY_URL && isset($PAGE_INFO['id'])) {
				$GENERAL_FUNCTIONS->parceFriendlyURL($FRIENDLY_URL_PARTS, $PAGE_INFO['id'], $FRIENDLY_INDEX);
			}

			require_once SETTINGS_ADMIN_PATH.'/getPage.php';						//класс получающий содержимое сформированой страницы

			$pageObject	= new getPage($PAGE_INFO, $PAGE_NAME, $smarty, $mysql);

			//получаем сгенерированную страницу
			$CONTENT	= $pageObject->contentOUT;
		}
		catch (Exception  $e) {

		}


		//вывод ошибок, если есть
		if (SETTINGS_SHOW_ERRORS  && count($GLOBAL_ERRORS)>0) {
			header("{$_SERVER['SERVER_PROTOCOL']} 500 Internal Server Error");				//посылаем сообщение о ошибке на сервере
			include $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/languages/'.SETTINGS_LANGUAGE;		//подключаем язык

			$smarty->assign('MSGTEXT', 			$MSGTEXT);
			$smarty->assign('GLOBAL_ERRORS', 	$GLOBAL_ERRORS);
			$smarty->assign('title_error', 		sprintf($MSGTEXT['e_handle_title'], $PAGE_NAME));
			echo $smarty->fetch($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/templates/global_error_handler.tpl');
		}

		if ($ERROR_IN_CODE && SETTINGS_ERORR_PAGE_500!='') {		//переходим на страницу ошибок

			$GENERAL_FUNCTIONS->gotoURL('http://'.$_SERVER['HTTP_HOST'].'/'.SETTINGS_ERORR_PAGE_500);
			exit;
		}

		//запоминаем страницу в мемкеш
		if  ($PAGE_INFO['cache'] && $MEMCAHE) {

			if ($PAGE_INFO['disable_cache_if_get']==1) {
				if (count($_GET)>0) {
					$c	= false;
				}
				else $c	= true;
			}
			else $c		= true;

			if ($c) {
				$MEMCAHE->set($MEMCAHE_page_key, $CONTENT, MEMCACHE_COMPRESSED, SETTINGS_CACHE_REFRESH_PERIOD) or die ('Failed to save data at the server');
			}
		}

		if ($MEMCAHE) {
			// Удаляем блокировщик
			$MEMCAHE->delete('lock:' . $MEMCAHE_page_key);

			//закрываем соединение с сервером мемкеш
			$MEMCAHE->close();
		}

		//сохраняем массив с выполнеными запросами для статистики
		if (SETTINGS_LOG_SQL_REQUESTS==1) {
			$GENERAL_FUNCTIONS->saveLogQueryToFile();
		}
		//сохраняем новые слова в словарь
		if ($GENERAL_FUNCTIONS->need_to_save_dictionary) {
			$GENERAL_FUNCTIONS->seveDictionary();
		}

		//выводим контент
		echo $CONTENT;

		//устанавливаем переменную для проверки сессии
		if (count($_SESSION>0)) {
			$_SESSION['___GoodCMS']['check_user_session']	= $check_user_session;
		}

		ob_flush();
	}
}


/*
//печать времени генерирования страницы
$end_time 	= microtime();
$end_array 	= explode(' ',$end_time);
$end_time 	= $end_array[1] + $end_array[0];
$time 		= $end_time - $start_time;
printf("Страница сгенерирована за %f секунд",$time);

if( function_exists('memory_get_usage') ) {
$mem_usage = memory_get_usage(true);
if ($mem_usage < 1024)
echo $mem_usage." bytes";
elseif ($mem_usage < 1048576)
$memory_usage = round($mem_usage/1024,2)." кб";
else
$memory_usage = round($mem_usage/1048576,2)." мб";
}
//Выводится это дело командой:
echo $memory_usage;
*/

?>