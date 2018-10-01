<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Авторизация
*////////////////////////////////////////////////////////////////////////////////////////////
class Authorization extends InternetShop {
	
	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {
		
		//вызываем функцию - обработчик
		switch ($this->action):
		case ('checkLogin'):			$this->checkLogin(); 	break;
		default:						$this->START(); 		break;
		endswitch;
	}


	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $GENERAL_FUNCTIONS, $FILE_MANAGER;

		if (isset($_SESSION['logined_user'])) {
			$query			= "SELECT * FROM `{$this->tablePrefix}users` WHERE `id`='{$_SESSION['logined_user']['id']}'";
			$result			= $this->mysql->executeSQL($query);
			$user			= $this->mysql->fetchAssoc($result);

			$this->smarty->assign('user', $user);
			$this->contentOUT = $this->smarty->fetch($this->tplLocation.'info_form.tpl');
		}
		else {
			$this->contentOUT = $this->smarty->fetch($this->tplLocation.'login_form.tpl');
		}
	}

	

	/**
	 * Проверка авторизации
	 *
	 */
	function  checkLogin() {
		GLOBAL $GENERAL_FUNCTIONS;

		$query_cats     	= "SELECT `id`  FROM `{$this->tablePrefix}users` WHERE email = '{$this->posts['email']}' AND `password`='{$this->posts['password']}' AND `confirm`=1 AND `enable`=1";
		$result_cats    	= $this->mysql->executeSQL($query_cats);
		$user 				= $this->mysql->fetchAssoc($result_cats);
		if ($user) {
			//обновляем последнюю активность
			$last_activity	= gmdate('Y-m-d H:i:s');
			$query_cats     = "UPDATE  `{$this->tablePrefix}users` SET `last_activity`='$last_activity' WHERE `id`='{$user['id']}'";
			$result_cats    = $this->mysql->executeSQL($query_cats);			
			
			//проверяем нужно ли добавить юзера, если был подключен позже форум, чтоб была сквозная авторизация
			$api	= $this->getApiObject($this->tablePrefix.'users', $this->posts);
			$this->dataSynchronize($this->tablePrefix.'users', $this->settings['forum_users_table_name'], $user['id']);
						
			if (isset($this->posts['zapomnit'])) {
				ini_set('session.gc_maxlifetime', 0);
				ini_set('session.cookie_lifetime', 0);
			}
			else {
				ini_set('session.gc_maxlifetime', 3600);
				ini_set('session.cookie_lifetime', 3600);
			}

			$_SESSION['logined_user']	= $user;
			$GENERAL_FUNCTIONS->gotoURL('/cabinet');

			exit;
		}
		else {
			$this->smarty->assign('error', true);
			$this->contentOUT = $this->smarty->fetch($this->tplLocation.'login_form.tpl');
		}
	}



}

?>