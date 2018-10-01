<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Личный кабинет пользователя
*////////////////////////////////////////////////////////////////////////////////////////////
class Cabinet extends InternetShop {

	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {

		$this->checkLogin();

		//вызываем функцию - обработчик
		switch ($this->action):
		case ('orders'):				$this->orders(); 			break;
		case ('logout'):				$this->logout(); 			break;
		case ('update_profile'):		$this->update_profile(); 	break;
		case ('help'):					$this->help(); 				break;
		case ('help_add_q'):			$this->help_add_q(); 		break;

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
				$this->smarty->assign($key, htmlspecialchars($val, ENT_QUOTES));
			}
		}

		//берём список временных зон
		$query    		 	= "SELECT * FROM `{$this->tablePrefix}timezones` ORDER BY `sort_index`";
		$result   		 	= $this->mysql->executeSQL($query);
		$timezones		 	= $this->mysql->fetchAssocAll($result);

		//берём юридические статусы
		$query     			= "SELECT * FROM `{$this->tablePrefix}ur_statuses`ORDER BY `sort_index` DESC";
		$result    			= $this->mysql->executeSQL($query);
		$ur_statuses		= $this->mysql->fetchAssocAll($result);

		$this->smarty->assign('timezones', 		$timezones);
		$this->smarty->assign('country', 		$country);
		$this->smarty->assign('ur_statuses', 	$ur_statuses);
		$this->smarty->assign('messages', 		$this->messages);
		$this->smarty->assign('errors', 		$this->errors);

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'profile.tpl');
	}



	/**
	 * Вывод оформленных заказов
	 *
	 */
	function orders() {
		GLOBAL $FRAME_FUNCTIONS;

		//выводим в основной валюте
		$query 						= "SELECT * FROM `{$this->tablePrefix}currencies` ORDER BY `sort_index` DESC LIMIT 1";
		$result						= $this->mysql->executeSQL($query);
		$currency					= $this->mysql->fetchAssoc($result);

		//берём курсы продажы валюты
		$courses					= array();
		$query 						= "SELECT * FROM `{$this->tablePrefix}courses`  WHERE `sell_currency_id`='{$currency['id']}' ORDER BY `sort_index`";
		$result						= $this->mysql->executeSQL($query);
		while ($row= $this->mysql->fetchAssoc($result)) {
			$courses[$row['sell_currency_id']][$row['by_currency_id']]=$row['quotation'];
		}

		$discount				= $this->getdiscount($courses, $currency);


		$id						= $_SESSION['logined_user']['id'];
		$api					= $this->getApiObject($this->tablePrefix.'orders');

		$query					= "SELECT t.*,
		t2.email AS `client_id_caption` ,
		t3.name AS `status_id_caption` ,
		t4.name AS `delivery_id_caption` ,		
		t6.name AS `pay_system_id_caption` ,
		t7.sign AS `currency_id_caption` 
		FROM `{$this->tablePrefix}orders` AS `t` 
		LEFT JOIN `{$this->tablePrefix}users` AS `t2` ON (t2.id=t.client_id)
		LEFT JOIN `{$this->tablePrefix}orders_status` AS `t3` ON (t3.id=t.status_id)
		LEFT JOIN `{$this->tablePrefix}delivery` AS `t4` ON (t4.id=t.delivery_id)		
		LEFT JOIN `{$this->tablePrefix}pay_systems` AS `t6` ON (t6.id=t.pay_system_id)
		LEFT JOIN `{$this->tablePrefix}currencies` AS `t7` ON (t7.id=t.currency_id)
		WHERE t.client_id='$id' ORDER BY t.sort_index DESC";				

		list($orders, $pages)	= $api->dataGet($query, $this->settings['orders_for_page'], 'page');

		$total_summ				= 0;
		foreach ($orders as $k=>$tmp)	 {

			//переводим по курсу доставку
			if ($tmp['currency_id']!=$currency['id']) {
				if (isset($courses[$currency['id']][$tmp['currency_id']])) {
					$course					= $courses[$currency['id']][$tmp['currency_id']];
					$tmp['delivery_cost']	= $tmp['delivery_cost']/$course;
				}
				else {
					$tmp['delivery_cost']	= 0;
				}
			}

			//переводим по курсу
			if ($tmp['currency_id']!=$currency['id']) {
				if (isset($courses[$currency['id']][$tmp['currency_id']])) {
					$course					= $courses[$currency['id']][$tmp['currency_id']];
					$tmp['total_price']		= $tmp['total_price']/$course;
				}				
				else {
					$tmp['total_price']		= 0;
				}
			}

			$orders[$k]['created']			= $FRAME_FUNCTIONS->userDateTime($tmp['created'], SETTINGS_TIMEZONE, 'Y-m-d H:i:s');
			$orders[$k]['delivery_cost']	= number_format($tmp['delivery_cost'], 0, ',', ' ');
			$orders[$k]['total_price']		= number_format($tmp['total_price'], 0, ',', ' ');
			$orders[$k]['composition'] 		= $this->getPrintOrder($orders[$k]['id'], 'print_composition.tpl');
		}


		//берем оплаченные заказы
		$query     		= "SELECT `total_price`, `currency_id` FROM `{$this->tablePrefix}orders` WHERE  client_id='$id' AND payed='1'";
		$result    		= $this->mysql->executeSQL($query);
		$payed_orders 	= $this->mysql->fetchAssocAll($result);

		$total_summ = 0;
		foreach ($payed_orders as $key=>$tmp) {
			//переводим по курсу
			if ($tmp['currency_id']!=$currency['id']) {

				if (isset($courses[$currency['id']][$tmp['currency_id']])) {
					$course					= $courses[$currency['id']][$tmp['currency_id']];
					$tmp['total_price']		= $tmp['total_price']/$course;
				}
				else {
					$tmp['total_price']		= 0;
				}
			}
			$total_summ+=$tmp['total_price'];
		}
		$total_summ	= number_format(round($total_summ,0), 0, ',', ' ');


		$this->smarty->assign('table_name', 	$this->tablePrefix.'orders');
		$this->smarty->assign('total_summ', 	$total_summ);
		$this->smarty->assign('discount', 		$discount);
		$this->smarty->assign('currency', 		$currency);
		$this->smarty->assign('orders', 		$orders);
		$this->smarty->assign('pages', 			$pages);

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'orders.tpl');
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


		if (isset($this->posts['nic'])) {
			$query				= "SELECT count(*) FROM `{$this->tablePrefix}users` WHERE `nic`='{$this->posts['nic']}'  AND `id`!='{$_SESSION['logined_user']['id']}'";
			$result				= $this->mysql->executeSQL($query);
			list($is_nic)		= $this->mysql->fetchRow($result);
			if ($is_nic>0) {
				$this->errors[]	= 'Пользователь с указанным ником на форуме уже зарегистрирован!';
			}
		}

		if (is_numeric($this->posts['nic'])) {
			$this->errors[]		= 'Ник на форуме не может состоять только из цифр!';
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
			$posts['moderator']		= $user['moderator'];
		}

		$api=$this->getApiObject($this->tablePrefix.'users', $posts);
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
			//обновляем юзера, чтоб была сквозная регистрация
			$this->dataSynchronize($this->tablePrefix.'users', $this->settings['forum_users_table_name'], $this->posts['id']);

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
	 * Выводит переписку пользователя с техподдержкой
	 *
	 */
	function help() {
		GLOBAl $FRAME_FUNCTIONS;

		$api					= $this->getApiObject($this->tablePrefix.'help');

		$query					= "SELECT t.*,
		t2.email AS `user_id_caption` 
		FROM `{$this->tablePrefix}help` AS `t` 
		LEFT JOIN `{$this->tablePrefix}users` AS `t2` ON (t2.id=t.user_id)
		WHERE t.user_id='{$_SESSION['logined_user']['id']}' ORDER BY t.datetime DESC";

		list($help, $pages)	= $api->dataGet($query, $this->settings['orders_for_page'], 'page');

		//подключение редактора
		$editor			= $FRAME_FUNCTIONS->editorSimpleGenerate();
		$editor			.= $FRAME_FUNCTIONS->editorSimpleGenerate('question', $height=200, $width='600px');


		$this->smarty->assign('table_name', 	$this->tablePrefix.'help');
		$this->smarty->assign('errors', 		$this->errors);
		$this->smarty->assign('editor', 		$editor);
		$this->smarty->assign('help', 			$help);
		$this->smarty->assign('pages', 			$pages);

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'help_show.tpl');
	}


	/**
	 * Добавление вопроса пользователем в техподдержку
	 *
	 */
	function help_add_q() {
		GLOBAL $FRAME_FUNCTIONS;

		//разрешенные теги
		$allowable_tags	= array('b', 'i', 'u', 'strong', 'p', 'a', 'img', 'blockquote', 'sub', 'em', 'span', 'div');

		$posts					= $this->posts;
		$posts['user_id'] 		= $_SESSION['logined_user']['id'];
		$api					= $this->getApiObject($this->tablePrefix.'help', $posts, 'question', $allowable_tags);
		$api->dataInsert();
		$this->errors			= $api->errors;

		if (count($this->errors)>0) {
			foreach ($this->post as $key=>$value) {
				$this->smarty->assign($key, $value);
			}
		}
		else {
			$query						= "SELECT * FROM `{$this->tablePrefix}users` WHERE `id`='{$_SESSION['logined_user']['id']}'";
			$result						= $this->mysql->executeSQL($query);
			$user						= $this->mysql->fetchAssoc($result);

			//отправка уведомления администратору
			$this->smarty->assign('user', 				$user);
			$this->smarty->assign('user_question', 		$this->posts['question']);
			$body	= $this->smarty->fetch($this->tplLocation.'help_message_confirm.tpl');

			$mail	= $FRAME_FUNCTIONS->getMailObject($this->settings['sendQToEmail'], SETTINGS_EMAIL_CAPTION,  $user['email'], $user['name'], $this->settings['sendQSubject'], $body);
			$mail->send();

			$this->smarty->assign('q_is_added', true);
		}


		$this->help();
	}


	/**
	 * Выход из кабинета
	 *
	 */
	function logout() {
		GLOBAL $GENERAL_FUNCTIONS;

		$query				= "UPDATE `{$this->tablePrefix}users` SET `last_activity`='' WHERE `id`='{$_SESSION['logined_user']['id']}'";
		$result				= $this->mysql->executeSQL($query);

		$this->dataSynchronize($this->tablePrefix.'users', $this->settings['forum_users_table_name'], $_SESSION['logined_user']['id']);

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