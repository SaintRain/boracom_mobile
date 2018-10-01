<?php
/**
 * класс для работы с настройками
 *
 */
class Settings  {

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
   	 * @var unknown_type
   	 */
	public		$mysql;

	/**
     * Хранит переданные ошибки
     *
     * @var array
     */
	public 		$errorMsgs = array();

	/**
     * сообщения
     *
     * @var array
     */
	public  	$messages;

	/**
     * сообщения
     *
     * @var unknown_type
     */
	public  	$message;



	/**
     * Конструктор
     * 
     * @param class $smarty
     */
	function Settings($mysql, $smarty, $post, $postr, $posts, $get, $getr, $gets,  $do) {

		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		$this->post		= $post;
		$this->get		= $get;
		$this->postr	= $postr;
		$this->posts	= $posts;
		$this->getr		= $getr;
		$this->gets		= $gets;

		switch ($do):
		case ('list'):					$this->getlist(); 		break;
		case ('saveedit'):				$this->saveedit(); 		break;
		endswitch;
	}



	/**
  	 * получаем список настроек
  	 *
  	 */
	function getlist() {
		GLOBAL  $GENERAL_FUNCTIONS, $FILE_MANAGER, $MSGTEXT, $MYSQL_TABLE3, $MYSQL_TABLE22;

		$_SESSION['___GoodCMS']['rdo']= 'list';

		//удаляем весь кеш
		if (isset($this->get['flash_memcache'])) {
			$flash_result = $this->flushMemcache();
		}

		//удаляем дружественные URL
		if (isset($this->get['friendly_url_flash'])) {
			$query							= "TRUNCATE TABLE `$MYSQL_TABLE22`";
			if ($result						= $this->mysql->executeSQL($query)) {
				$friendly_url_flash_result	= true;
			}
			else {
				$friendly_url_flash_result	= false;
			}
		}

		$query							= "SELECT * FROM `$MYSQL_TABLE3` ORDER BY `sort_index` ";
		$result							= $this->mysql->executeSQL($query);
		$userPages						= $this->mysql->fetchAssocAll($result);

		include_once('dictionary/configLanguage.php');  //подключаем языки материала

		$setups['phpversion'] 			= phpversion();
		if (mb_strpos($setups['phpversion'], '-')>0) {
			$setups['phpversion']		= mb_substr($setups['phpversion'], 0, mb_strpos($setups['phpversion'], '-'));
		}

		$query							= 'SELECT VERSION()';
		$result							= $this->mysql->executeSQL($query);
		$tmp							= $this->mysql->fetchRow($result);
		$setups['mysqlversion']			= $tmp[0];

		if (mb_strpos($setups['mysqlversion'], '-')>0) {
			$setups['mysqlversion']		= mb_substr($setups['mysqlversion'], 0, mb_strpos($setups['mysqlversion'], '-'));
		}

		if (function_exists('gd_info')) {
            $tmp							= gd_info();
        }
        else {
            $tmp['GD Version'] = 'unknown';
        }
		$setups['gdversion']			= $tmp['GD Version'];
		$setups['maxloadfilesize']		= ini_get('upload_max_filesize');
		$setups['maxexecutetime']		= ini_get('max_execution_time');
		$s_patch						= session_save_path();

		if ($s_patch=='') $s_patch		= '/';
		$setups['session_save_path']	= $s_patch;

		$setups['upload_tmp_dir']		= $this->sys_get_temp_dir();
		$setups['free_space']			= disk_free_space($_SERVER['DOCUMENT_ROOT']);
		$setups['free_space']			= round($setups['free_space']/1000000, 2);

		$setups['memory_limit']			= ini_get('memory_limit');
		$setups['safe_mode']			= ini_get('safe_mode');
		$setups['register_globals']		= ini_get('register_globals');
		$setups['magic_quotes_gpc']		= ini_get('magic_quotes_gpc');
		$setups['server_time']			= gmdate('Y-m-d H:i:s');

		if (extension_loaded('ftp')) {
			$setups['ftp']			= 1;
		}
		else {
			$setups['ftp']			= 0;
		}

		//берем список файлов с языками
		$langs	= $GENERAL_FUNCTIONS->get_system_langs();

		if (class_exists('Memcache')) {
			$setups['memcache']	= true;
		}
		else {
			$setups['memcache']	= false;
		}

		$this->smarty->assign('content_template', 		'settings/settings_form_edit.tpl');
		if (isset($flash_result)) {
			$this->smarty->assign('flash_result',  				$flash_result);
		}

		if (isset($friendly_url_flash_result)) {
			$this->smarty->assign('friendly_url_flash_result',  				$friendly_url_flash_result);
		}

		$this->smarty->assign('setups',  				$setups);
		$this->smarty->assign('langs',  				$langs);
		$this->smarty->assign('LANGUAGES_OF_MATERIAL',  $LANGUAGES_OF_MATERIAL);
		$this->smarty->assign('userPages', 				$userPages);
		$this->smarty->assign('content_head', 			$MSGTEXT['settings_set']);
	}



	/**
	 * определяет временную папку
	 *
	 * @return string
	 */
	function sys_get_temp_dir() {
		GLOBAL $FILE_MANAGER;

		if (!empty($_ENV['TMP'])) {
			return realpath($_ENV['TMP']);
		}
		if (!empty($_ENV['TMPDIR'])) {
			return realpath( $_ENV['TMPDIR']);
		}
		if (!empty($_ENV['TEMP'])) {
			return realpath( $_ENV['TEMP']);
		}

		return $tempfile	= @tempnam(uniqid(rand(),TRUE),'');

		if (file_exists($tempfile)) {
			return realpath(dirname($tempfile));
		}
	}



	/**
	 * Очищает весь кеш
	 *
	 * @return bool
	 */
	function flushMemcache() {
		GLOBAL $MSGTEXT;

		if (class_exists('Memcache')) {
			$memcache 			= new Memcache();
			$memcache->connect(SETTINGS_MEMCACHED_HOST, SETTINGS_MEMCACHED_PORT) or die ($MSGTEXT['memcache_error_connect']);
			$memcache->flush();
			return true;
		}
		else return false;
	}



	/**
	 * Сохраняем редактирование настроек
	 *
	 */
	function saveedit() {
		GLOBAL $FILE_MANAGER, $MSGTEXT, $GENERAL_FUNCTIONS;

		if (!$_SESSION['___GoodCMS']['read_only']) {
			if ($this->posts['http_host']!='') {
				$http_host	= $this->posts['http_host'];
			}
			else {
				$http_host	= 'http://'.$_SERVER['HTTP_HOST'];
			}

			$cach_refresh_period=$this->post['cach_refresh_period'];
			if (!is_numeric($cach_refresh_period)) {
				$this->errorMsgs[]=$MSGTEXT['settings_err_cache'];
			}

			if (is_numeric($this->post['timezone'])) {
				$timezone	= $this->post['timezone'];
			}
			else {
				$timezone	= SETTINGS_TIMEZONE;
			}

			if (count($this->errorMsgs)==0)	{
				if (isset($this->posts['sql_requests_analize'])) {
					$sql_requests_analize	= 1;
				}
				else $sql_requests_analize	= 0;


				if (isset($this->posts['show_errors'])) {
					$show_errors	= 1;
				}
				else $show_errors	= 0;

				if (isset($this->posts['max_log_file_size'])) {
					if (is_numeric($this->posts['max_log_file_size'])) {
						$max_log_file_size	= $this->posts['max_log_file_size'];
					}
					else {
						$max_log_file_size	= 10000;
						$this->errorMsgs[]	= $MSGTEXT['settings_err_size'];
					}
				}
				else $max_log_file_size = SETTINGS_LOG_SQL_MAX_FILE_SIZE;

				if (SETTINGS_CACHE_REFRESH_PERIOD!=$this->posts['cach_refresh_period']) {
					$this->flushMemcache();
				}

				if (isset($this->post['editor_type'])) {
					$editor_type	= $this->posts['editor_type'];
				}
				else $editor_type	= 'ckeditor';

				$lang					= $this->posts['lang'];
				$lang_default			= $this->posts['lang_default'];


				//настройки почты
				$email_type		= str_replace("'", "\'", $this->postr['email_type']);
				$email_host		= str_replace("'", "\'", $this->postr['email_host']);
				$email_port		= str_replace("'", "\'", $this->postr['email_port']);
				$email_caption	= str_replace("'", "\'", $this->postr['email_caption']);
				$email_username	= str_replace("'", "\'", $this->postr['email_username']);
				$email_password	= str_replace("'", "\'", $this->postr['email_password']);

				if (isset($this->posts['email_ssl'])) {
					$email_ssl	= 1;
				}
				else $email_ssl	= 0;

				if (isset($this->posts['fast_edit_mode'])) {
					$fast_edit_mode	= 1;
				}
				else $fast_edit_mode	= 0;
				if (isset($this->posts['friendly_url'])) {
					$friendly_url	= 1;
				}
				else $friendly_url	= 0;

				//загрузка ватермарка
				$watermark_patch	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/';
				if (isset($this->post['delete_watermark'])) {
					unlink($watermark_patch.SETTINGS_WATERMARK_FILENAME);
					$watermark_filename  = '';
				}
				else $watermark_filename = false;

				if (isset($_FILES['watermark_filename']['name']) && $_FILES['watermark_filename']['name']!='') {

					$FILES_name 		= $_FILES['watermark_filename']['name'];
					$FILES_tmp_name		= $_FILES['watermark_filename']['tmp_name'];
					$t					= explode('.', $FILES_name);
					$FILES_type			= $t[count($t)-1];
					$FILES_name			= $GENERAL_FUNCTIONS->convertKirilToLatin($t[0]);

					//проверка расширения
					$rash	= mb_strtolower($FILES_type);
					switch ($rash):
					case('jpg'): 		$flag=true;	 break;
					case('jpeg'): 		$flag=true;	 break;
					case('gif'): 		$flag=true;	 break;
					case('png'): 		$flag=true;	 break;
					default :  			$flag=false; break;
					endswitch;

					if ($flag)  {
						//находим свободное имя
						$rash			= '.'.$rash;
						$NewName		= $FILES_name.$rash;
						$findex			= 1;
						while (is_readable($watermark_patch.'/'.$NewName))  {
							$NewName	= $FILES_name.'_'.$findex.$rash;
							$findex++;
						}

						if (is_uploaded_file($FILES_tmp_name)) {
							//удаляем старый ватермарк
							if (SETTINGS_WATERMARK_FILENAME!='') {
								if (file_exists($watermark_patch.SETTINGS_WATERMARK_FILENAME)) unlink($watermark_patch.SETTINGS_WATERMARK_FILENAME);
							}
							if (move_uploaded_file($FILES_tmp_name, $watermark_patch.$NewName)) {
								$watermark_filename	= $NewName;
							}
						}
					}
					else {
						$this->errorMsgs[]	= $MSGTEXT['settings_watermark_bad_type'];
					}
				}

				//настройки фтп
				$ftp_client_host		= str_replace("'", "\'", $this->postr['ftp_client_host']);
				$ftp_client_username	= str_replace("'", "\'", $this->postr['ftp_client_username']);
				$ftp_client_password	= str_replace("'", "\'", $this->postr['ftp_client_password']);

				//переписываем файл конфигурации
				$text	= file_get_contents('config.php');

				$text 	= preg_replace("/define \('SETTINGS_HTTP_HOST',(.*)'(.*)'\);/iu", 								"define ('SETTINGS_HTTP_HOST',						'{$http_host}');",  						$text);
				$text 	= preg_replace("/define \('SETTINGS_ERORR_PAGE_400',(.*)'(.*)'\);/iu", 							"define ('SETTINGS_ERORR_PAGE_400',					'{$this->posts['error_400']}');",  			$text);
				$text 	= preg_replace("/define \('SETTINGS_ERORR_PAGE_404',(.*)'(.*)'\);/iu", 							"define ('SETTINGS_ERORR_PAGE_404',					'{$this->posts['error_404']}');",  			$text);
				$text 	= preg_replace("/define \('SETTINGS_ERORR_PAGE_500',(.*)'(.*)'\);/iu", 							"define ('SETTINGS_ERORR_PAGE_500',					'{$this->posts['error_500']}');",  			$text);
				$text 	= preg_replace("/define \('SETTINGS_INDEX_PAGE',(.*)'(.*)'\);/iu", 								"define ('SETTINGS_INDEX_PAGE',						'{$this->posts['index_page']}');",  		$text);
				$text 	= preg_replace("/define \('SETTINGS_LICENSE_URL_CHECK',(.*)'(.*)'\);/iu", 						"define ('SETTINGS_LICENSE_URL_CHECK',				'{$this->posts['activated_url_check']}');", $text);
				$text 	= preg_replace("/define \('SETTINGS_UPDATE_URL',(.*)'(.*)'\);/iu", 								"define ('SETTINGS_UPDATE_URL',						'{$this->posts['update_url']}');", 			$text);
				$text 	= preg_replace("/define \('SETTINGS_CACHE_REFRESH_PERIOD',(.*)'(.*)'\);/iu", 					"define ('SETTINGS_CACHE_REFRESH_PERIOD',			'{$this->posts['cach_refresh_period']}');", $text);

				$text 	= preg_replace("/define \('SETTINGS_TIMEZONE',(.*)'(.*)'\);/iu", 								"define ('SETTINGS_TIMEZONE',						'$timezone');", $text);

				$text 	= preg_replace("/define \('SETTINGS_LOG_SQL_REQUESTS',(.*)'(.*)'\);/iu", 						"define ('SETTINGS_LOG_SQL_REQUESTS',				'$sql_requests_analize');", 		 		$text);
				$text 	= preg_replace("/define \('SETTINGS_SHOW_ERRORS',(.*)'(.*)'\);/iu", 							"define ('SETTINGS_SHOW_ERRORS',					'$show_errors');", 		 					$text);
				$text 	= preg_replace("/define \('SETTINGS_LOG_SQL_MAX_FILE_SIZE',(.*)'(.*)'\);/iu",					"define ('SETTINGS_LOG_SQL_MAX_FILE_SIZE',			'$max_log_file_size');", 		 			$text);
				$text 	= preg_replace("/define \('SETTINGS_EDITOR_TYPE',(.*)'(.*)'\);/iu",								"define ('SETTINGS_EDITOR_TYPE',					'$editor_type');", 		 					$text);
				$text 	= preg_replace("/define \('SETTINGS_LANGUAGE',(.*)'(.*)'\);/iu",								"define ('SETTINGS_LANGUAGE',						'$lang');", 		 						$text);
				$text 	= preg_replace("/define \('SETTINGS_LANGUAGE_OF_MATERIALS_DEFAULT',(.*)'(.*)'\);/iu",			"define ('SETTINGS_LANGUAGE_OF_MATERIALS_DEFAULT',	'$lang_default');", 		 				$text);

				$text 	= preg_replace("/define \('SETTINGS_EMAIL_TYPE',(.*)'(.*)'\);/iu",								"define ('SETTINGS_EMAIL_TYPE',						'$email_type');", 		 					$text);
				$text 	= preg_replace("/define \('SETTINGS_EMAIL_HOST',(.*)'(.*)'\);/iu",								"define ('SETTINGS_EMAIL_HOST',						'$email_host');", 		 					$text);
				$text 	= preg_replace("/define \('SETTINGS_EMAIL_PORT',(.*)'(.*)'\);/iu",								"define ('SETTINGS_EMAIL_PORT',						'$email_port');", 		 					$text);
				$text 	= preg_replace("/define \('SETTINGS_EMAIL_CAPTION',(.*)'(.*)'\);/iu",							"define ('SETTINGS_EMAIL_CAPTION',					'$email_caption');", 		 				$text);
				$text 	= preg_replace("/define \('SETTINGS_EMAIL_USERNAME',(.*)'(.*)'\);/iu",							"define ('SETTINGS_EMAIL_USERNAME',					'$email_username');", 		 				$text);
				$text 	= preg_replace("/define \('SETTINGS_EMAIL_PASSWORD',(.*)'(.*)'\);/iu",							"define ('SETTINGS_EMAIL_PASSWORD',					'$email_password');", 		 				$text);
				$text 	= preg_replace("/define \('SETTINGS_EMAIL_SSL',(.*)'(.*)'\);/iu",								"define ('SETTINGS_EMAIL_SSL',						'$email_ssl');", 			 				$text);

				$text 	= preg_replace("/define \('SETTINGS_FTP_CLIENT_HOST',(.*)'(.*)'\);/iu",							"define ('SETTINGS_FTP_CLIENT_HOST',				'$ftp_client_host');", 		 				$text);
				$text 	= preg_replace("/define \('SETTINGS_FTP_CLIENT_USERNAME',(.*)'(.*)'\);/iu",						"define ('SETTINGS_FTP_CLIENT_USERNAME',			'$ftp_client_username');", 		 			$text);
				$text 	= preg_replace("/define \('SETTINGS_FTP_CLIENT_PASSWORD',(.*)'(.*)'\);/iu",						"define ('SETTINGS_FTP_CLIENT_PASSWORD',			'$ftp_client_password');", 		 			$text);
				$text 	= preg_replace("/define \('SETTINGS_FAST_EDIT_MODE',(.*)'(.*)'\);/iu",							"define ('SETTINGS_FAST_EDIT_MODE',					'$fast_edit_mode');", 			 			$text);
				$text 	= preg_replace("/define \('SETTINGS_FRIENDLY_URL',(.*)'(.*)'\);/iu",							"define ('SETTINGS_FRIENDLY_URL',					'$friendly_url');", 			 			$text);

				if ($watermark_filename!==false) {
					$text 	= preg_replace("/define \('SETTINGS_WATERMARK_FILENAME',(.*)'(.*)'\);/iu",					"define ('SETTINGS_WATERMARK_FILENAME',				'$watermark_filename');", 					$text);
				}

				if ($sql_requests_analize==1) {
					if (!is_file($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/logs/SqlLog.php')) {
						$this->errorMsgs[]=$MSGTEXT['settings_no_file_log'];
					}
					else {
						if (SETTINGS_LOG_SQL_REQUESTS==0) {
							$fd	= $FILE_MANAGER->fopen($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/logs/SqlLog.php', 'w');
							fwrite($fd,'<?php $LOG_QUERIES = array(); ?>');
							fclose($fd);
						}
					}
				}

				if ($fd		= $FILE_MANAGER->fopen('config.php', 'w')) {
					fwrite($fd, $text);
					fclose($fd);
					//переписываем в настройках перенаправление хоста
					$GENERAL_FUNCTIONS->replaceHostInHtaccess($http_host);
				}
				else $this->errorMsgs[]=$MSGTEXT['settings_err_file_chmod'];
			}

			if (count($this->errorMsgs)==0) {
				$GENERAL_FUNCTIONS->gotoURL('index.php?act=settings&page&saved=true');
			}
			else {
				$this->smarty->assign('errors',			$this->errorMsgs);
				$this->getlist();
			}
		} 
		else {
			$this->errorMsgs[]=$MSGTEXT['operation_is_forbidden'];
			$this->smarty->assign('errors',			$this->errorMsgs);
			$this->getlist();
		}
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