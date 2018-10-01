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
	public 	$smarty;

	/**
     * переменные из массива $_POST с заменёнными спец-символами
     *
     * @var array
     */
	public	$post;

	/**
     *  переменные из массива $_POST как они вводились пользователем (спец символы не заменены)
     *
     * @var array
     */
	public	$postr;

	/**
     *  экранированые переменные функцией addslashes() из массива $_POST 
     *
     * @var array
     */
	public	$posts;

	/**
     * переменные из массива $_GET с заменёнными символами
     *
     * @var array
     */
	public	$get;

	/**
     *  переменные из массива $_GET (спец символы не заменены)
     *
     * @var array
     */
	public	$getr;

	/**
     *  экранированые переменные функцией addslashes() из массива $_GET 
     *
     * @var array
     */
	public	$gets;

	/**
   	 * класс для работы с MYSQL
   	 *
   	 * @var unknown_type
   	 */
	public	$mysql;

	/**
     * Хранит переданные ошибки
     *
     * @var arrays
     */
	public 	$errors;



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
		GLOBAL $CMSProtection, $MSGTEXT, $GENERAL_FUNCTIONS, $MYSQL_CTR_TABLE17, $MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE23, $MYSQL_CTR_TABLE31;

		//если администратор не СУПЕРАДМИН
		if ($_SESSION['___GoodCMS']['group_id']!=0) {
			$out	= $this->smarty->fetch('errors/error.tpl');
			echo $out;
			exit();
		}		

		//сохраняем id редактируемого модуля в сесиию
		if (isset($this->get['m_id'])) {
			if ($this->get['m_id']>0)  $_SESSION['___GoodCMS']['m_id']=$this->get['m_id'];
		}

		//обрабатываем строку запроса
		if (isset($this->get['act'])) $act=$this->get['act'];
		else  $act='m_c';

		if (isset($this->get['do'])) $do=$this->get['do'];
		else  $do='list';


		if (isset($_SESSION['___GoodCMS']['m_id'])) {
			$query			= "SELECT $MYSQL_CTR_TABLE17.*, $MYSQL_CTR_TABLE31.id as `need_save` FROM `$MYSQL_CTR_TABLE17` lEFT JOIN `$MYSQL_CTR_TABLE31` ON ($MYSQL_CTR_TABLE17.id=$MYSQL_CTR_TABLE31.module_id) WHERE $MYSQL_CTR_TABLE17.id='{$_SESSION['___GoodCMS']['m_id']}' ORDER BY $MYSQL_CTR_TABLE17.sort_index LIMIT 1";
			$result			= $this->mysql->executeSQL($query);
			$CurrentModule	= $this->mysql->fetchAssoc($result);

			$this->smarty->assign('CurrentModule',	$CurrentModule);
		}

		//определяем какой пункт меню надо подсветить
		if (isset($this->get['act'])) $pageID	= '?act='.$this->get['act'];
		else {
			$pageID	= '?act=m_c';
		}

		if (isset($this->get['b_id'])) {
			$pageID.= '&b_id='.$this->get['b_id'];
		}

		if (isset($this->get['t_id'])) {
			$pageID.= '&t_id='.$this->get['t_id'];
		}

		$_SESSION['___GoodCMS']['pageID'] = $pageID;

		switch ($act):
		case ('m_c'): {
			require_once('classes/ModulesConstructor.class.php');
			$obj	= new ModulesConstructor($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr, $do);
			$this->smarty	= $obj->getSmarty();
			break;
		}
		case ('t_c'): {
			require_once('classes/TablesConstructor.class.php');
			$obj	= new TablesConstructor($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr,  $do);
			$this->smarty	= $obj->getSmarty();
			break;
		}
		case ('b_c'): {
			require_once('classes/BlocksConstructor.class.php');
			$obj	= new BlocksConstructor($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr,  $do);
			$this->smarty	= $obj->getSmarty();
			break;
		}
		case ('b_t_c'): {
			require_once('classes/BlocksTablesConstructor.class.php');
			$obj	= new BlocksTablesConstructor($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr,  $do);
			$this->smarty	= $obj->getSmarty();
			break;
		}
		case ('b_s_c'): {
			require_once('classes/BlocksSettingsConstructor.class.php');
			$obj	= new BlocksSettingsConstructor($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr,  $do);
			$this->smarty	= $obj->getSmarty();
			break;
		}
		case ('b_f_c'): {
			if ($CurrentModule['loaded']==0) {
				require_once('classes/BlocksFunctionsConstructor.class.php');
				$obj	= new BlocksFunctionsConstructor($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr,  $do);
				$this->smarty	= $obj->getSmarty();
				break;
			}
			else {
				$GENERAL_FUNCTIONS->gotoURL('?act=m_c&m_id='.$this->get['m_id']);
				exit();
			}
		}
		case ('b_temp_c'): {
			require_once('classes/BlocksTemplatesConstructor.class.php');
			$obj	= new BlocksTemplatesConstructor($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr,  $do);
			$this->smarty	= $obj->getSmarty();
			break;
		}
		case ('compiler'): {
			require_once('classes/Compiler.class.php');
			$obj	= new Compiler($this->mysql, $this->smarty, $this->post, $this->postr, $this->get, $this->getr,  $do);
			$this->smarty	= $obj->getSmarty();
			break;
		}
		endswitch;

		$this->smarty	= $obj->getSmarty();
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