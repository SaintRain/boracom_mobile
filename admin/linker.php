<?php

/**
 * Обрабатывает строку запроса и подключает класс обработчик
 *
 */
class Linker  {

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
	public 		$errorMsgs;

	/**
     * сообщения
     *
     * @var array
     */
	public  	$messages;



	/**
     * Конструктор
     * 
     * @param class $this->smarty
     */
	function Linker($mysql, $smarty) {
		GLOBAL $GENERAL_FUNCTIONS;

		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		$this->get		= $GENERAL_FUNCTIONS->get;
		$this->getr		= $GENERAL_FUNCTIONS->getr;
		$this->gets		= $GENERAL_FUNCTIONS->gets;
		$this->post		= $GENERAL_FUNCTIONS->post;
		$this->postr	= $GENERAL_FUNCTIONS->postr;
		$this->posts	= $GENERAL_FUNCTIONS->posts;

		$this->start();
	}



	/**
	 * подключает нужный класс
	 *
	 */
	function start() {
		GLOBAL  $GENERAL_FUNCTIONS, $CMSProtection,  $MYSQL_TABLE5, $MYSQL_TABLE15, $MSGTEXT;

		//обрабатываем строку запроса
		if (isset($this->get['act'])) $act		= $this->get['act'];
		else  $act='administrators';

		if (isset($this->get['do']))  $do		= $this->get['do'];
		else  $do='list';

		if (isset($this->post['do'])) $do		= $this->post['do'];

		$qs='?act='.$act.'&do='.$do.'&page_id='.@$this->get['page_id'].'&tag_id='.@$this->get['tag_id'].'&pageCategoryId='.@$this->get['pageCategoryId'];

		if (is_array($_SESSION['___GoodCMS']['group_pages']))
		foreach ($_SESSION['___GoodCMS']['group_pages'] as $v) {
			if  (mb_strpos($qs, $v)>-1) {
				$errors[]=$MSGTEXT['access_is_forbidden'];
				break;
			}
		}

		//если пользователь не обладает правами записи, тогда проверяем его запрос
		if ($_SESSION['___GoodCMS']['read_only']) {
			$forbidden_operations	= array(
			'delete',
			'insert',
			'saveedit',
			'group_create',
			'group_update',
			'group_delete',
			'group_move',
			'ex_sql',
			'dictionary_save',
			'save',
			'send',
			'photos_save_desc',
			'setStatus',
			'popup_save',
			'files_edit',
			'files_save_desc',
			'updaterows',
			'photos_edit',
			'import',
			'settings_save',
			'saveedit_out_tpl',
			'copy_module',
			'category_create',
			'category_update',
			'category_delete',
			'category_putdo',
			'moveCategory',
			'movePage',
			'set_page_status',
			'set_cache_status',
			'set_selected_status',
			'savecopy',
			'settings_save_edit',
			'saveedittags',
			'insert_virtual',
			'saveedit_virtual',
			'delete_virtual',
			'moveVirtualTag'			
			);			
		
			if (in_array($do, $forbidden_operations)) {
				$errors[]=$MSGTEXT['operation_is_forbidden'];
			}
							
		}
		

		
		if (!isset($error))
		switch ($act):
		case ('modules'): {
			require_once('classes/Modules.class.php');
			$obj	= new Modules($this->mysql, $this->smarty, $this->post, $this->postr, $this->posts, $this->get, $this->getr, $this->gets,  $do);
			break;
		}
		case ('pages'): {
			require_once('classes/Pages.class.php');
			$obj	= new Pages($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr,  $do);
			break;
		}
		case ('templates'): {
			require_once('classes/Templates.class.php');
			$obj	= new Templates($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr,  $do);
			break;
		}
		case ('real_templates'): {
			require_once('classes/RealTemplates.class.php');
			$obj	= new RealTemplates($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr,  $do);
			break;
		}
		case ('settings'): {
			require_once('classes/Settings.class.php');
			$obj	= new Settings($this->mysql, $this->smarty,  $this->post, $this->postr, $this->posts, $this->get, $this->getr, $this->gets,  $do);
			break;
		}
		case ('css'): {
			require_once('classes/Css.class.php');
			$obj	= new Css($this->mysql, $this->smarty,  $this->post, $this->postr, $this->get, $this->getr,  $do);
			break;
		}
		case ('lists'): {
			require_once('classes/Lists.class.php');
			$obj	= new Lists($this->mysql, $this->smarty,  $this->post, $this->postr, $this->get, $this->getr,  $do);
			break;
		}
		case ('dumper'): {
			require_once('classes/Dumper.class.php');
			$obj	= new Dumper($this->mysql, $this->smarty,  $this->post, $this->postr, $this->posts, $this->get, $this->getr, $this->gets,  $do);
			break;
		}
		case ('administrators'): {
			require_once('classes/Administrators.class.php');
			$obj	= new Administrators($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr,  $do);
			break;
		}
		case ('mailer'): {
			require_once('classes/Mailer.class.php');
			$obj	= new Mailer($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr,  $do);
			break;
		}
		case ('languagesofmaterial'): {
			require_once('classes/LanguagesOfMaterial.class.php');
			$obj	= new LanguagesOfMaterial($this->mysql, $this->smarty,  $this->post, $this->postr, $this->posts, $this->get, $this->getr, $this->gets,  $do);
			break;
		}
		case ('friendly_url_rules'): {
			require_once('classes/FriendlyURLRules.class.php');
			$obj	= new FriendlyURLRules($this->mysql, $this->smarty,  $this->post, $this->postr, $this->posts, $this->get, $this->getr, $this->gets,  $do);
			break;
		}
		case ('php'): {
			require_once('classes/PHP.class.php');
			$obj	= new PHP($this->mysql, $this->smarty,  $this->post, $this->postr, $this->posts, $this->get, $this->getr, $this->gets,  $do);
			break;
		}		
		case ('logout'): {
			$CMSProtection->logout();
		}
		endswitch;
		

		if (isset($errors)) {
			$this->smarty->assign('content_template', 	'errors/errors_list.tpl');
			$this->smarty->assign('errors', 	$errors);
		}
		else $this->smarty	= $obj->getSmarty();

		$query				= "SELECT * FROM `$MYSQL_TABLE15`  ORDER BY `name`";
		$result				= $this->mysql->executeSQL($query);
		$allLinks			= $this->mysql->fetchAssocAll($result);
		$this->mysql->freeResult($result);
		$this->smarty->assign('allLinks',		$allLinks);

		$this->smarty->assign('qs', $qs);
	}



	/**
	 * выводит список администраторов
	 *
	 */
	function print_errors() {
		GLOBAL $MSGTEXT;

		$this->smarty->assign('content_template', 	'errors/errors_list.tpl');
		$this->smarty->assign('errors', 			$this->errors);
		$this->smarty->assign('content_head', 		$MSGTEXT['sistem_msg']);
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