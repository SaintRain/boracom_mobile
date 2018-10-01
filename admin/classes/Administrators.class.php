<?php
/**
 * класс для работы с администраторами 
 *
 */
class Administrators  {

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
     * @param class $smarty
     */
	function Administrators($mysql, $smarty, $post, $postr, $get, $getr,  $do) {

		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		$this->post		= $post;
		$this->get		= $get;
		$this->postr	= $postr;
		$this->getr		= $getr;

		switch ($do):
		case ('list'): 			$this->administrators_getlist(); 			break;
		case ('form_add'):		$this->administrators_form_add(); 			break;
		case ('insert'): 		$this->administrators_insert(); 			break;
		case ('delete'): 		$this->administrators_delete(); 			break;
		case ('edit'): 			$this->administrators_form_edit(); 			break;
		case ('saveedit'): 		$this->administrators_saveedit(); 			break;
		case ('group_edit'): 	$this->administrators_group_edit(); 		break;
		case ('group_create'):	$this->administrators_group_create(); 		break;
		case ('group_update'):	$this->administrators_group_update(); 		break;
		case ('group_delete'):	$this->administrators_group_delete(); 		break;
		case ('group_move'):	$this->administrators_group_move(); 		break;
		endswitch;
	}


	
	/**
	 * выводит список администраторов
	 *
	 */
	function administrators_getlist() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE1, $MYSQL_TABLE19;

		$_SESSION['___GoodCMS']['rdo']	= 'list';

		$query				= "SELECT $MYSQL_TABLE1.*, $MYSQL_TABLE19.name FROM `$MYSQL_TABLE1` LEFT JOIN `$MYSQL_TABLE19` ON ($MYSQL_TABLE1.group_id=$MYSQL_TABLE19.id) ORDER BY `login`";
		$result				= $this->mysql->executeSQL($query);
		$alladministrators	= $this->mysql->fetchAssocALL($result);

		$sort				= $GENERAL_FUNCTIONS->getSortVariables('login');
		$alladministrators	= $GENERAL_FUNCTIONS->sort_massiv($sort['sort_type'], $alladministrators);
		$obj				= $GENERAL_FUNCTIONS->form_navigations(20, $alladministrators, '?act=administrators&sort_by='.$sort['sort_by'].'&sort_type='.$sort['sort_type']);
		$administrators		= $obj['records'];
		$pages				= $obj['pages'];

		$this->smarty->assign('content_template', 	'administrators/administrators_list.tpl');
		$this->smarty->assign('administrators', 	$administrators);
		$this->smarty->assign('content_head', 		$MSGTEXT['administrators']);
		$this->smarty->assign('pages', 				$pages);
		$this->smarty->assign('sort_by', 			$sort['sort_by']);
		$this->smarty->assign('sort_type', 			$sort['sort_type']);

		if (isset($_SESSION['___GoodCMS']['error']))    {
			$this->smarty->assign('error', 	$_SESSION['___GoodCMS']['error']);
			$_SESSION['___GoodCMS']['error']='';
		}
	}

	

	/**
	 * выводит форму редактирования групп администраторов
	 *
	 */
	function administrators_group_edit() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE19;

		$query				= "SELECT * FROM `$MYSQL_TABLE19` ORDER BY `sort_index` DESC ";
		$result				= $this->mysql->executeSQL($query);
		$admin_groups		= $this->mysql->fetchAssocALL($result);

		$this->smarty->assign('content_template', 	'administrators/group_form_edit.tpl');
		$this->smarty->assign('admin_groups', 		$admin_groups);
		$this->smarty->assign('content_head', 		$MSGTEXT['administrators_groups']);
	}


	
	/**
     * создаёт новую группу
     *
     */
	function administrators_group_create() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE19;

		if (isset($this->post['name'])) {
			$name		= addslashes($this->post['name']);

			$query		= "INSERT INTO `$MYSQL_TABLE19`  (`name`, `sort_index`) VALUES ('$name', '0')";
			$result		= $this->mysql->executeSQL($query);

			$sort_index	= $this->mysql->insertID();
			$query		= "UPDATE `$MYSQL_TABLE19`  SET `sort_index`='$sort_index' WHERE `id`='$sort_index'";
			$result		= $this->mysql->executeSQL($query);

			$this->smarty->assign('catSelected',	$sort_index);
			$this->smarty->assign('groupName',		$this->post['name']);
			$this->smarty->assign('message',		$MSGTEXT['new_goup_is_created']);
		}

		$this->administrators_group_edit();
	}


	
	/**
	 * обновляет название группы
	 *
	 */
	function administrators_group_update() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE19;

		if (isset($this->post['name'])) {
			$name	= addslashes($this->post['name']);

			$query	= "UPDATE `$MYSQL_TABLE19` SET `name`='$name' WHERE `id`='{$this->post['group_id']}'";
			$result	= $this->mysql->executeSQL($query);

			$this->smarty->assign('groupSelected',	$this->post['group_id']);
			$this->smarty->assign('groupName',		$this->post['name']);

			$this->smarty->assign('message',		$MSGTEXT['changes_save']);
		}
		$this->administrators_group_edit();
	}

	

	/**
	 * удаляет группу
	 *
	 */
	function administrators_group_delete() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE19, $MYSQL_TABLE1;

		if (isset($this->post['group_id'])) {
			$query			= "DELETE FROM `$MYSQL_TABLE19` WHERE `id`='{$this->post['group_id']}'";
			$result			= $this->mysql->executeSQL($query);

			$query			= "DELETE FROM `$MYSQL_TABLE1` WHERE `group_id`='{$this->post['group_id']}'";
			$result			= $this->mysql->executeSQL($query);

			$this->smarty->assign('message',		$MSGTEXT['group_was_deleted']);
		}

		$this->administrators_group_edit();
	}


	
	/**
	 * устонавливает порядок сортировки для категории
	 *
	 */
	function administrators_group_move() {
		GLOBAL  $MSGTEXT, $MYSQL_TABLE19;

		$id			= $this->get['id'];

		$query		= "SELECT * FROM  `$MYSQL_TABLE19` WHERE  `id`='$id'";
		$result		= $this->mysql->executeSQL($query);
		$cat		= $this->mysql->fetchArray($result);

		$query		= "SELECT * FROM  `$MYSQL_TABLE19` ORDER BY `sort_index` DESC";
		$result		= $this->mysql->executeSQL($query);
		$records	= $this->mysql->fetchAssocAll($result);

		if ($records>1) {
			$min	= $records[0]['sort_index'];
			$max	= $records[count($records)-1]['sort_index'];

			for ($i=0; $i<count($records); $i++) {
				if ($records[$i]['id']==$cat['id']) {

					if ($this->get['type']=='up') {
						if ($i>0) $next	= $i-1;
						else {
							$this->smarty->assign('message',		$MSGTEXT['cannot_move_up']);
							$next	= 0;
						}
					}
					elseif ($this->get['type']=='down') {
						if ($i<count($records)-1) $next = $i+1;
						else {
							$this->smarty->assign('message',		$MSGTEXT['cannot_move_down']);
							$next	= count($records)-1;
						}
					}

					$moved	= $i;

					$query		= "UPDATE `$MYSQL_TABLE19` SET `sort_index`='{$records[$moved]['sort_index']}' WHERE  `id`='{$records[$next]['id']}'";
					$result		= $this->mysql->executeSQL($query);

					$query		= "UPDATE `$MYSQL_TABLE19` SET `sort_index`='{$records[$next]['sort_index']}' WHERE  `id`='{$records[$moved]['id']}'";
					$result		= $this->mysql->executeSQL($query);

					break;
				}

			}
		}

		$this->smarty->assign('groupSelected',	$cat['id']);
		$this->smarty->assign('groupName',		$cat['name']);

		$this->administrators_group_edit();
	}


	
	/**
     * форма добавления нового администратора
     *
     */
	function administrators_form_add() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE1, $MYSQL_TABLE19;

		$query				= "SELECT * FROM `$MYSQL_TABLE19` ORDER BY `sort_index` DESC ";
		$result				= $this->mysql->executeSQL($query);
		$admin_groups		= $this->mysql->fetchAssocALL($result);
		$this->smarty->assign('admin_groups', 		$admin_groups);

		$this->smarty->assign('content_template',	'administrators/administrators_form_add.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['admins_add_new']);
		$this->smarty->assign('ip',					$_SERVER['REMOTE_ADDR']);
	}


	
	/**
     * обработка формы добавления нового администратора
     *
     */
	function administrators_insert() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE1, $CMSProtection;

		$query	= "SELECT * FROM `$MYSQL_TABLE1` WHERE `login`='{$this->post['login']}'";
		$result	= $this->mysql->executeSQL($query);

		if ($this->mysql->numRows($result)>0) $message_text	=$MSGTEXT['admins_with_login_exists'];
		else $message_text='';

		$query	= "SELECT * FROM `$MYSQL_TABLE1` WHERE `email`='{$this->post['email']}'";
		$result	= $this->mysql->executeSQL($query);
		if ($this->mysql->numRows($result)>0) $message_text.=$MSGTEXT['admins_with_email_exists'];

		if  ($message_text=='') {
			if (isset($this->post['check_ip'])) {
				$check_ip	= 1;
			}
			else {
				$check_ip	= 0;
			}

			if (isset($this->post['read_only'])) {
				$read_only	= 1;
			}
			else {
				$read_only	= 0;
			}
						
			

			$password		= $CMSProtection->convertAP($this->post['password'].$this->post['login']);
			$query			= "INSERT INTO `$MYSQL_TABLE1` (`login`, `email`, `password`, `group_id`, `ip`, `check_ip`, `read_only`) VALUES ('{$this->post['login']}', '{$this->post['email']}', '$password', '{$this->post['group_id']}', '{$this->post['ip']}', '$check_ip', '$read_only')";
			$this->mysql->executeSQL($query);
			$message_text	=	$MSGTEXT['new_admin_was_added'];
		}

		$this->smarty->assign('content_template',	'message.tpl');
		$this->smarty->assign('message_text', 		$message_text);
		$this->smarty->assign('back_link',			'&larr; <a href="?act=administrators">'.$MSGTEXT['go_back'].'</a>');
		$this->smarty->assign('content_head',		'');
	}


	
	/**
     * удалить администратора
     *
     */
	function administrators_delete() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE1;

		$query	= "SELECT * FROM `$MYSQL_TABLE1` WHERE `id`='{$this->get['id']}'";
		$result	= $this->mysql->executeSQL($query);
		$row	= $this->mysql->fetchAssoc($result);
		if ($row['login']==$_SESSION['___GoodCMS']['adminlogin']) {
			$message_text	= $MSGTEXT['connot_delete_self'];
			$this->smarty->assign('content_template',	'message.tpl');
			$this->smarty->assign('message_text',		$message_text);
			$this->smarty->assign('back_link',			'&larr; <a href="?act=administrators">'.$MSGTEXT['go_back'].'</a>');
			$this->smarty->assign('content_head',		'');
		}
		else {
			$query="DELETE FROM `$MYSQL_TABLE1` WHERE `id`='{$this->get['id']}'";
			$this->mysql->executeSQL($query);
			$GENERAL_FUNCTIONS->gotoURL('?act=administrators');
		}
	}


	
	/**
     * форма редактирования
     *
     */
	function administrators_form_edit() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE1, $MYSQL_TABLE19;

		$query	= "SELECT * FROM `$MYSQL_TABLE1` WHERE `id`='{$this->get['id']}'";
		$result	= $this->mysql->executeSQL($query);
		$row	= $this->mysql->fetchAssoc($result);

		//определяем IP-администратора
		if ($row['check_ip']==0) {
			$row['ip']=$_SERVER['REMOTE_ADDR'];
		}

		foreach  ($row as $key=>$value) $this->smarty->assign($key, $value);

		$query				= "SELECT * FROM `$MYSQL_TABLE19` ORDER BY `sort_index` DESC ";
		$result				= $this->mysql->executeSQL($query);
		$admin_groups		= $this->mysql->fetchAssocALL($result);

		$this->smarty->assign('admin_groups', 		$admin_groups);
		$this->smarty->assign('content_template',	'administrators/administrators_form_edit.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['admin_edit_profile']);
	}


	
	/**
     * сохранение редактирования
     *
     */
	function administrators_saveedit() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE1, $GENERAL_FUNCTIONS, $CMSProtection;

		if (isset($this->post['id'])) {
			$query	= "SELECT * FROM `$MYSQL_TABLE1` WHERE `email`='{$this->post['email']}' AND `login`<>'{$this->post['login']}'";
			$result	= $this->mysql->executeSQL($query);

			if ($this->mysql->numRows($result)>0)  {
				$message_text	= $MSGTEXT['admins_with_email_exists'];
				$this->smarty->assign('content_template',	'message.tpl');
				$this->smarty->assign('message_text', 		$message_text);
				$this->smarty->assign('back_link', 			'&larr; <a href="?act=administrators">'.$MSGTEXT['go_back'].'</a>');
				$this->smarty->assign('content_head', 		'');
			}
			else   {
				$query			= "SELECT `login` FROM `$MYSQL_TABLE1` WHERE `id`='{$this->post['id']}'";
				$result			= $this->mysql->executeSQL($query);
				list($login)	= $this->mysql->fetchRow($result);
				$password		= $CMSProtection->convertAP($_POST['password'].$login);

				if (isset($this->post['check_ip'])) {
					$check_ip	= 1;
				}
				else {
					$check_ip	= 0;
				}
				

				if (isset($this->post['read_only'])) {
					$read_only	= 1;
				}
				else {
					$read_only	= 0;
				}				

				$query			= "UPDATE `$MYSQL_TABLE1` SET  `email`='{$this->post['email']}', `password`='$password', `group_id`='{$this->post['group_id']}', `ip`='{$this->post['ip']}', `check_ip`='{$check_ip}', `read_only`='{$read_only}'  WHERE `id`='{$this->post['id']}' AND `password`='{$this->post['old_password']}'";
				$result			= $this->mysql->executeSQL($query);

				$GENERAL_FUNCTIONS->gotoURL('?act=administrators');
			}
		}
		else {
			$GENERAL_FUNCTIONS->gotoURL('?act=administrators');
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