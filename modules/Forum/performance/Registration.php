<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Регистрация на сайте
*////////////////////////////////////////////////////////////////////////////////////////////
class Registration extends Forum {
	
	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {

		//вызываем функцию - обработчик
		switch ($this->action):
		case ('check_reg'):				$this->check_reg(); break;	//проверка формы регистрации
		case ('confirm_r'):				$this->confirm_r(); break;	//подтверждение регистрации
		default:						$this->START(); 	break;	//форма регистрации
		endswitch;
	}


	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS, $FILE_MANAGER;

		//берём список временных зон
		$query    		 	= "SELECT * FROM `{$this->tablePrefix}timezones` ORDER BY `sort_index`";
		$result   		 	= $this->mysql->executeSQL($query);
		$timezones		 	= $this->mysql->fetchAssocAll($result);
				
		$this->smarty->assign('timezones', 	$timezones);
		$this->smarty->assign('errors', 	$this->errors);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'registration_form.tpl');
	}



	/**
	 * Проверка регистрации
	 *
	 */
	function check_reg () {
		GLOBAL $FRAME_FUNCTIONS;

		if ($this->post['password']!=$this->post['retype_password']) {
			$this->errors[]	= 'Пароли не совпадают!';
		}

		if (!isset($this->post['confirm'])) {
			$this->errors[]	= 'Вы должны согласится с условиями и правилами сервиса!';
		}

		$query				= "SELECT count(*) FROM `{$this->tablePrefix}users` WHERE `email`='{$this->posts['email']}'";
		$result				= $this->mysql->executeSQL($query);
		list($is_registered)= $this->mysql->fetchRow($result);
		if ($is_registered>0) {
			$this->errors[]	= 'Пользователь с указанным Email уже зарегистрирован!';
		}
		
		$query				= "SELECT count(*) FROM `{$this->tablePrefix}users` WHERE `nic`='{$this->posts['nic']}'";
		$result				= $this->mysql->executeSQL($query);
		list($is_nic)		= $this->mysql->fetchRow($result);
		if ($is_nic>0) {
			$this->errors[]	= 'Пользователь с указанным ником на форуме уже зарегистрирован!';
		}		

		$posts						= $this->posts;
		$posts['enable']			= 0;
		$posts['confirm']			= 0;
		$posts['registration']		= gmdate('Y-m-d H:i:s');				
		$api						= $this->getApiObject($this->tablePrefix.'users', $posts);

		if (count($this->errors)==0) {
			$api->dataInsert();
			$this->errors			= $api->errors;
		}


		if (count($this->errors)>0) {
			foreach ($this->post as $key=>$value) {
				$this->smarty->assign($key, $value);
			}

			$this->START();
		}
		else {
			//запоминаем в сесию
			$user['id']						= $api->inserted_id;
			$_SESSION['logined_user']		= $user;

			$this->smarty->assign('id', 	$api->inserted_id);
			$this->smarty->assign('email', 	$this->posts['email']);
			$body	= $this->smarty->fetch($this->tplLocation.'reg_message.tpl');

			//делаем отправку
			$mail	= $FRAME_FUNCTIONS->getMailObject($this->posts['email'], $this->posts['name'], SETTINGS_EMAIL_USERNAME, SETTINGS_EMAIL_CAPTION, $this->settings['send_com_theme'], $body);
			$res	= $mail->send();

			$this-> smarty->assign('sendResult', 		$res);
			$this->contentOUT = $this-> smarty->fetch($this->tplLocation.'reg_result.tpl');
		}
	}



	/**
	 * Подтверждение регистрации
	 *
	 */
	function confirm_r() {
		$query  		   	= "SELECT `id`  FROM `{$this->tablePrefix}users` WHERE email = '{$this->gets['email']}' AND id = '{$this->gets['id']}' ";
		$result		    	= $this->mysql->executeSQL($query);
		list($is_exists) 	= $this->mysql->fetchRow($result);

		if ($is_exists && $is_exists==$this->gets['id']) {
			$query     	= "UPDATE  `{$this->tablePrefix}users` SET `confirm`='1', `enable`='1' WHERE  `id`='$is_exists'";
			$result    	= $this->mysql->executeSQL($query);			
						
			$this->smarty->assign('confirm', true);
		}
		else {
			$this->smarty->assign('confirm', false);
		}

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'confirm_result.tpl');
	}




}

?>