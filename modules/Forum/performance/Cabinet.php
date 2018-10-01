<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Личный кабинет пользователя
*////////////////////////////////////////////////////////////////////////////////////////////
class Cabinet extends Forum {
	
	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {

		$this->checkLogin();

		//вызываем функцию - обработчик
		switch ($this->action):
		case ('logout'):				$this->logout(); 			break;
		case ('update_profile'):		$this->update_profile(); 	break;
		default:						$this->START(); 			break;
		endswitch;
		
	}


	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START($mr=true) {
		GLOBAL $FRAME_FUNCTIONS, $FILE_MANAGER;

		$query							= "SELECT * FROM `{$this->tablePrefix}country`  ORDER BY `sort_index`";
		$result							= $this->mysql->executeSQL($query);
		$country						= $this->mysql->fetchAssocAll($result);

		if ($mr) {
			$query						= "SELECT * FROM `{$this->tablePrefix}users` WHERE `id`='{$_SESSION['logined_user']['id']}'";
			$result						= $this->mysql->executeSQL($query);
			$user						= $this->mysql->fetchAssoc($result);
			$user['retype_password']	= $user['password'];

			foreach ($user as $key=>$val) {
				$this->smarty->assign($key, $val);
			}
		}

		//берём список временных зон
		$query    		 	= "SELECT * FROM `{$this->tablePrefix}timezones` ORDER BY `sort_index`";
		$result   		 	= $this->mysql->executeSQL($query);
		$timezones		 	= $this->mysql->fetchAssocAll($result);		

		$this->smarty->assign('timezones', 	$timezones);
		$this->smarty->assign('country', 	$country);
		$this->smarty->assign('messages', 	$this->messages);
		$this->smarty->assign('errors', 	$this->errors);

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'profile.tpl');
	}
		
	
	/**
	 * Сохранить редактирование профиля
	 *
	 */
	function update_profile() {
		GLOBAL $FRAME_FUNCTIONS;

		if ($this->post['password']!=$this->post['retype_password']) {
			$this->errors[]		= 'Пароли не совпадают!';
		}

		$query					= "SELECT count(*) FROM `{$this->tablePrefix}users` WHERE `email`='{$this->posts['email']}' AND `id`!='{$_SESSION['logined_user']['id']}'";
		$result					= $this->mysql->executeSQL($query);
		list($is_registered)	= $this->mysql->fetchRow($result);
		if ($is_registered>0) {
			$this->errors[]		= 'Пользователь с указанным Email уже зарегистрирован!';
		}
		
		$query				= "SELECT count(*) FROM `{$this->tablePrefix}users` WHERE `nic`='{$this->posts['nic']}'  AND `id`!='{$_SESSION['logined_user']['id']}'";
		$result				= $this->mysql->executeSQL($query);
		list($is_nic)		= $this->mysql->fetchRow($result);
		if ($is_nic>0) {
			$this->errors[]	= 'Пользователь с указанным ником на форуме уже зарегистрирован!';
		}	
				

		$query			= "SELECT * FROM `{$this->tablePrefix}users` WHERE `id`='{$_SESSION['logined_user']['id']}'";
		$result			= $this->mysql->executeSQL($query);
		$user			= $this->mysql->fetchAssoc($result);

		$posts			= $this->posts;
		if ($user['email']!=$this->posts['email']) {
			$posts['enable']		= 0;
			$posts['confirm']		= 0;
		}
		else {
			$posts['enable']		= $user['enable'];
			$posts['confirm']		= $user['confirm'];
		}

		$api						= $this->getApiObject($this->tablePrefix.'users', $posts);
		if (count($this->errors)==0) {
			$api->dataUpdate();
			$this->errors			= $api->errors;
		}


		if (count($this->errors)>0) {
			foreach ($this->post as $key=>$value) {
				$this->smarty->assign($key, $value);
			}
			$this->START(false);
		}
		else {
						
			if ($user['email']!=$this->posts['email']) {
				$this->smarty->assign('id', 	$this->posts['id']);
				$this->smarty->assign('email', 	$this->posts['email']);
				$body			= $this->smarty->fetch($this->tplLocation.'reg_message.tpl');
				$send_com_theme	=  $this->settings['send_com_theme'];

				//делаем отправку
				$mail	= $FRAME_FUNCTIONS->getMailObject($this->posts['email'], $this->posts['name'], SETTINGS_EMAIL_USERNAME, SETTINGS_EMAIL_CAPTION, $send_com_theme, $body);
				$res	= $mail->send();
			}

			$this->messages[]='Изменения сохранены!';
			$this->START();
		}
	}



	/**
	 * Выход из кабинета
	 *
	 */
	function logout() {
		GLOBAL $GENERAL_FUNCTIONS;
		
		unset($_SESSION['logined_user']);
		$GENERAL_FUNCTIONS->gotoURL(SETTINGS_HTTP_HOST);
		exit;
	}



	/**
	 * Проверяет пользователя на авторизацию
	 *
	 */
	function checkLogin() {
		GLOBAL $GENERAL_FUNCTIONS;
		
		if (!isset($_SESSION['logined_user'])) {
			$GENERAL_FUNCTIONS->gotoURL(SETTINGS_HTTP_HOST);
			exit;
		}
	}



}

?>