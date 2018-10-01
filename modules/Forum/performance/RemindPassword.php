<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Восстановление пароля
*////////////////////////////////////////////////////////////////////////////////////////////
class RemindPassword extends Forum {
	
	
	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {

		//вызываем функцию - обработчик
		switch ($this->action):
		case ('remind_send'):			$this->remind_send(); 	break;
		default:						$this->START(); 		break;
		endswitch;
	}


	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS;

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'remind_form.tpl');
	}

	

	/**
	 * Отправка пароля пользователю
	 *
	 */
	function remind_send() {
		GLOBAL $FRAME_FUNCTIONS;

		$query     				= "SELECT `password`, `name`  FROM `{$this->tablePrefix}users` WHERE email = '{$this->posts['email']}'";
		$result    				= $this->mysql->executeSQL($query);
		list($password, $name) 	= $this->mysql->fetchRow($result);

		if ($password) {

			//делаем отправку
			$this->smarty->assign('password', $password);
			$body 	= $this->smarty->fetch($this->tplLocation.'remind_message.tpl');
			$mail	= $FRAME_FUNCTIONS->getMailObject($this->posts['email'], $name, SETTINGS_EMAIL_USERNAME, SETTINGS_EMAIL_CAPTION, $this->settings['send_com_theme_forget'], $body);

			if ($mail->send()) {
				$this->smarty->assign('send', true);
			}
			else {
				$this->smarty->assign('send', false);
			}
		}
		else   	$this->smarty->assign('send', false);

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'remind_result.tpl');
	}


}

?>