<?php
/**
 * класс для редактирования php-кода в блоках
 *
 */
class PHP  {

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
	function PHP($mysql, $smarty, $post, $postr, $posts, $get, $getr, $gets,  $do) {

		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		$this->post		= $post;
		$this->get		= $get;
		$this->postr	= $postr;
		$this->posts	= $posts;
		$this->getr		= $getr;
		$this->gets		= $gets;

		switch ($do):
		case ('edit'):					$this->edit(); 		break;
		case ('saveedit'):				$this->saveedit(); 		break;
		endswitch;
	}



	/**
  	 * Выводит форму редактирования содержимого блока
  	 *
  	 */
	function edit() {
		GLOBAL $MSGTEXT, $FILE_MANAGER, $MYSQL_TABLE5, $MYSQL_TABLE6,  $MYSQL_TABLE7;

		//берём информацию о блоке
		$query		= "SELECT $MYSQL_TABLE6.name AS `block_name`, $MYSQL_TABLE6.type, $MYSQL_TABLE6.act_variable, $MYSQL_TABLE6.act_method, $MYSQL_TABLE6.url_get_vars, $MYSQL_TABLE6.id, $MYSQL_TABLE5.id AS `module_id`, $MYSQL_TABLE5.name AS `module_name`, $MYSQL_TABLE6.description as `block_description` FROM `$MYSQL_TABLE5`, `$MYSQL_TABLE6`, `$MYSQL_TABLE7` WHERE $MYSQL_TABLE6.id='{$this->get['block_id']}' AND $MYSQL_TABLE6.module_id=$MYSQL_TABLE5.id";
		$result		= $this->mysql->executeSQL($query);
		$block		= $this->mysql->fetchAssoc($result);

		$file		= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$block['module_name'].'/performance/'.$block['block_name'].'.php';

		if (file_exists($file)) {

			$fcontent 	= $FILE_MANAGER->getfile ($file);
			$fcontent	= htmlspecialchars($fcontent, ENT_QUOTES);

			$this->smarty->assign('content_template', 'php/php_form_edit.tpl');
			$this->smarty->assign('content', 		$fcontent);

			$this->smarty->assign('file', 			$file);
			$this->smarty->assign('block', 			$block);
			$this->smarty->assign('message', 		$this->message);
			

			$this->smarty->assign('content_head', 	 sprintf($MSGTEXT['classesphp_edited'], $block['block_description']));
		}
	}



	/**
	 * Сохраняем редактирование настроек
	 *
	 */
	function saveedit() {
		GLOBAL $MSGTEXT, $FILE_MANAGER, $MYSQL_TABLE5, $MYSQL_TABLE6,  $MYSQL_TABLE7;
				
		//берём информацию о блоке
		$query		= "SELECT $MYSQL_TABLE6.name AS `block_name`, $MYSQL_TABLE6.type, $MYSQL_TABLE6.act_variable, $MYSQL_TABLE6.act_method, $MYSQL_TABLE6.url_get_vars, $MYSQL_TABLE6.id, $MYSQL_TABLE5.id AS `module_id`, $MYSQL_TABLE5.name AS `module_name`, $MYSQL_TABLE6.description as `block_description` FROM `$MYSQL_TABLE5`, `$MYSQL_TABLE6`, `$MYSQL_TABLE7` WHERE $MYSQL_TABLE6.id='{$this->get['block_id']}' AND $MYSQL_TABLE6.module_id=$MYSQL_TABLE5.id";
		$result		= $this->mysql->executeSQL($query);
		$block		= $this->mysql->fetchAssoc($result);

		$file		= $_SERVER['DOCUMENT_ROOT'].'/modules/'.$block['module_name'].'/performance/'.$block['block_name'].'.php';

		if (file_exists($file) && isset($this->postr['content']) && $this->postr['content']!='') {
			$fcontent	= $this->postr['content'];
			$fcontent 	= $FILE_MANAGER->putfile($file, $fcontent);
			$this->message	= $MSGTEXT['php_class_edit_save'];
			$this->edit();
		}
		else {
			$this->edit();
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