<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Авторизация
*////////////////////////////////////////////////////////////////////////////////////////////
class Authorization extends Forum {
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
			
			$this->smarty->assign('user',		$user);
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

		$query     	= "SELECT `id` FROM `{$this->tablePrefix}users` WHERE email = '{$this->posts['email']}' AND `password`='{$this->posts['password']}' AND `confirm`=1 AND `enable`=1";
		$result    	= $this->mysql->executeSQL($query);
		$user 		= $this->mysql->fetchAssoc($result);
			
		if ($user) {
			
			//проверяем нужно ли добавить юзера, если был подключен позже форум, чтоб была сквозная авторизация
			$api	= $this->getApiObject($this->tablePrefix.'users', $this->posts);
						
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