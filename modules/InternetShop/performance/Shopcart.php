<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Корзина товаров
*////////////////////////////////////////////////////////////////////////////////////////////
class Shopcart extends InternetShop {

	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {

		//вызываем функцию - обработчик
		switch ($this->action):
		case ('sendOrder'):				$this->sendOrder(); 	break;
		case ('Result_pay'):			$this->Result_pay(); 	break;
		case ('Success_pay'):			$this->Success_pay(); 	break;
		case ('Fail_pay'):				$this->Fail_pay(); 		break;
		default:						$this->START(); 		break;
		endswitch;
	}


	
	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS, $FILE_MANAGER;

		//очищаем куки
		if (isset($this->get['empty'])) {
			$_SESSION['shop_cart_module']='';			
			unset($_SESSION['shop_cart_module']);
		}

		list($products, $total_summ, $total_summ_dustly, $discount, $discount_by_q_summ, $total_count, $discount_percent, $currency, $currency_general, $pay_systems, $delivery)	= $this->getOrder();

		if ($products)	{

			if (isset($_SESSION['logined_user']['id'])) {
				$query						= "SELECT * FROM `{$this->tablePrefix}users` WHERE `id`='{$_SESSION['logined_user']['id']}'";
				$result						= $this->mysql->executeSQL($query);
				$user						= $this->mysql->fetchAssoc($result);
				foreach ($user as $key=>$v) {
					$this->smarty->assign($key, 			$v);
				}
			}
			
			//берём юридические статусы
			$query     			= "SELECT * FROM `{$this->tablePrefix}ur_statuses`ORDER BY `sort_index` DESC";
			$result    			= $this->mysql->executeSQL($query);
			$ur_statuses		= $this->mysql->fetchAssocAll($result);

			$this->smarty->assign('products', 			$products);
			$this->smarty->assign('delivery', 			$delivery);
			$this->smarty->assign('pay_systems', 		$pay_systems);
			$this->smarty->assign('total_summ', 		$total_summ);
			$this->smarty->assign('total_count', 		$total_count);
			$this->smarty->assign('total_summ_dustly', 	$total_summ_dustly);
			$this->smarty->assign('discount_percent', 	$discount_percent);
			$this->smarty->assign('discount', 			$discount);
			$this->smarty->assign('discount_by_q_summ', $discount_by_q_summ);
			$this->smarty->assign('currency', 			$currency);
			$this->smarty->assign('currency_general', 	$currency_general);
			$this->smarty->assign('ur_statuses', 		$ur_statuses);			
			$this->smarty->assign('settings', 			$this->settings);
			$this->smarty->assign('table_name', 		$this->tablePrefix.'products');
			$this->smarty->assign('errors', 			$this->errors);
			
		}

		foreach ($this->post as $k=>$v) {
			$this->smarty->assign($k, 			$v);
		}

		$this->smarty->assign('errors', 		$this->errors);

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_list.tpl');
	}



	/**
	 * Формирует состав заказа
	 *
	 * @return arrat
	 */
	function getOrder() {
		if (isset ($_SESSION['shop_cart_module']['shopingcart'])) $cookieData	= $_SESSION['shop_cart_module']['shopingcart'];
		else  $cookieData	= '';

		$list 				= explode(';', $cookieData);

		if (isset($list[1])) {

			list($products, $total_summ, $total_summ_dustly, $discount, $discount_by_q_summ, $total_count, $discount_percent, $currency, $currency_general, $pay_systems, $delivery) = $this->getOrderSumm($list, true, false);
			
			//приводим к нужному формату
			$total_summ			= number_format($total_summ, $this->roundPriceTo(), ',', ' ');
			$total_summ_dustly	= number_format($total_summ_dustly, $this->roundPriceTo(), ',', ' ');
			$discount			= number_format($discount, $this->roundPriceTo(), ',', ' ');
			$discount_by_q_summ	= number_format($discount_by_q_summ, $this->roundPriceTo(), ',', ' ');
			
			return array($products, $total_summ, $total_summ_dustly, $discount, $discount_by_q_summ, $total_count, $discount_percent, $currency, $currency_general, $pay_systems, $delivery);
			
		}
		else return false;
	}

	
	
	/**
	 * Отправка заказа и регистрация пользователя, если нужно
	 *
	 */
	function sendOrder() {
		GLOBAL $FRAME_FUNCTIONS;

		if (isset ($_SESSION['shop_cart_module']['shopingcart'])) $cookieData	= $_SESSION['shop_cart_module']['shopingcart'];
		else  {
			$cookieData	= '';
			$FRAME_FUNCTIONS->gotoURL('/shopcart');
			exit;
		}

		//берём выбранную платёжную систему
		$query     			= "SELECT t.* FROM `{$this->tablePrefix}pay_systems` AS `t` WHERE t.id='{$this->posts['pay_system_id']}'";
		$result    			= $this->mysql->executeSQL($query);
		$paysystem_info		= $this->mysql->fetchAssoc($result);

		list($products, $total_summ, $total_summ_dustly, $discount, $discount_by_q_summ, $total_count, $discount_percent, $currency, $currency_general, $pay_systems, $delivery)	= $this->getOrder();

		if ($products) {

			foreach ($this->posts as $key=>$v) {
				$this->smarty->assign($key, 			$v);
			}

			$this->smarty->assign('products', 			$products);
			$this->smarty->assign('delivery', 			$delivery);
			$this->smarty->assign('pay_systems', 		$pay_systems);
			$this->smarty->assign('total_summ', 		$total_summ);
			$this->smarty->assign('total_count', 		$total_count);
			$this->smarty->assign('total_summ_dustly', 	$total_summ_dustly);
			$this->smarty->assign('discount_percent', 	$discount_percent);
			$this->smarty->assign('discount', 			$discount);
			$this->smarty->assign('discount_by_q_summ', $discount_by_q_summ);
			$this->smarty->assign('settings', 			$this->settings);
			$this->smarty->assign('currency', 			$currency);
			$this->smarty->assign('host', 				$_SERVER['HTTP_HOST']);
			
			//сохраняем заказ в базу
			$posts										= $this->posts;
			$created									= $FRAME_FUNCTIONS->userDateTime(gmdate('Y-m-d H:i:s'), SETTINGS_TIMEZONE, 'Y-m-d H:i:s');
			$posts['created']							= $created;
			$posts['id_client']							= 0;
			$posts['total_price']						= $total_summ;
			$posts['order_cost_gross']					= $total_summ_dustly;
			$posts['currency_id']						= $currency['id'];
			//генерируем секретный ключ для даннаго заказа, нужен для безопасной проверки оплаты
			$posts['secret_pay_code']					= $FRAME_FUNCTIONS->generate_password(20);

			$api										= $this->getApiObject($this->tablePrefix.'orders', $posts);
			$api->dataInsert();
			$this->errors								= $api->errors;

			if (count($this->errors)>0) {
				
				foreach ($this->post as $key=>$value) {
					$this->smarty->assign($key, $value);
					$this->START();
				}
			}
			else {
				$order_number			= $api->inserted_id;

				//состав заказа
				foreach ($products as $p) {
					$posts2 = array();
					$posts2['order_id']			= $order_number;
					$posts2['product_id']		= $p['id'];
					$posts2['amount']			= $p['count'];
					$posts2['price']			= $p['price'];
					$posts2['currency_id']		= $p['currency_id'];
					$api						= $this->getApiObject($this->tablePrefix.'orders_composition', $posts2);
					$api->dataInsert();
				}

				//берём название юридического статуса	
				$query     						= "SELECT `caption` FROM `{$this->tablePrefix}ur_statuses` AS `t` WHERE t.id='{$this->posts['ur_status_id']}'";
				$result    						= $this->mysql->executeSQL($query);
				list($ur_status_id_caption)		= $this->mysql->fetchRow($result);

				$this->smarty->assign('order_number', 			$order_number);
				$this->smarty->assign('created', 				$created);
				$this->smarty->assign('ur_status_id_caption',	$ur_status_id_caption);

				$order_body 			= $this->smarty->fetch($this->tplLocation.'message.tpl');
				$order_body_to_admin 	= $this->smarty->fetch($this->tplLocation.'message_to_admin.tpl');

								
				//делаем отправку администратору
				$mail				= $FRAME_FUNCTIONS->getMailObject($this->settings['sendOrderToEmail'], SETTINGS_EMAIL_CAPTION, $this->post['email'], $this->post['name'], $this->settings['mailOrderSubject'].$order_number,   $order_body_to_admin);
				$res				= $mail->send();

				//делаем отправку клиенту
				$mail				= $FRAME_FUNCTIONS->getMailObject($this->posts['email'], $this->post['name'], SETTINGS_EMAIL_USERNAME,  SETTINGS_EMAIL_CAPTION, 'Заказ товара №'.$order_number, $order_body);
				$res2				= $mail->send();

				//регистрация нового пользователя
				if (isset($_SESSION['logined_user']['id'])) {
					$user_id			= $_SESSION['logined_user']['id'];
				}
				else {
					//проверяем, может в базе есть юзер с такими данными
					$query_cats     	= "SELECT `id` FROM `{$this->tablePrefix}users` WHERE `email` = '{$this->posts['email']}'";
					$result_cats    	= $this->mysql->executeSQL($query_cats);
					list($user_id) 		= $this->mysql->fetchRow($result_cats);

					if (!$user_id) {
						//регистрируем нового пользователя						
						$posts								= $api->posts;
						$t									= explode('@', $this->posts['email']);
						$posts['nic']						= $t[0];
						$posts['translit']					= '';
						$posts['registration']				= $FRAME_FUNCTIONS->userDateTime(gmdate('Y-m-d H:i:s'), SETTINGS_TIMEZONE, 'Y-m-d H:i:s');
						$posts['password']					= $FRAME_FUNCTIONS->generate_password(8);												
						$api								= $this->getApiObject($this->tablePrefix.'users', $posts);																								
						$api->dataInsert();
						$user_id							= $api->inserted_id;
						
						//добавляем юзера на форум, чтоб была сквозная регистрация
						$this->dataSynchronize($this->tablePrefix.'users', $this->settings['forum_users_table_name'], $user_id);
									

						if (is_numeric($user_id)) {

							$this->smarty->assign('password', 		$this->posts['password']);
							$this->smarty->assign('id', 			$user_id);

							//отправляем уведомление, что пользователь зарегистрирован
							$text_mail_admin 	= $this->smarty->fetch($this->tplLocation.'reg_message.tpl');
							$mail				= $FRAME_FUNCTIONS->getMailObject($this->post['email'], $this->post['name'], SETTINGS_EMAIL_USERNAME, SETTINGS_EMAIL_CAPTION, $this->settings['mailOrderRegSubject'], $text_mail_admin);
							$mail->send();
						};
					}
				}

				//обновляем пользователя для заказа
				$order_body_to_admin	= addslashes($order_body_to_admin);
				$query     				= "UPDATE `{$this->tablePrefix}orders` SET `client_id`='$user_id' WHERE `id`='$order_number'";
				$result    				= $this->mysql->executeSQL($query);

				//выводим форму онлайн оплаты
				if (isset($paysystem_info) && $paysystem_info) {

					//формируем краткую информацию о заказе
					$order_info['id']				= $order_number;					
					$order_info['total_summ']		= str_replace(' ', '', $total_summ);
					$order_info['secret_pay_code']	= $posts['secret_pay_code'];

					//формируем краткую информацию о заказчике
					$user_info['id']				= $user_id;


					//делаем перерасчет стоимости заказа по коэф. перерасчета
					if (is_numeric($paysystem_info['pereschet']) && $paysystem_info['pereschet']!=0) {
						$order_info['total_summ']	= round($order_info['total_summ']*$paysystem_info['pereschet'], $this->roundPriceTo());
					}

					//генерируем форму оплаты по выбранной платёжной системе
					$this->contentOUT				= $this->{$paysystem_info['func_name']}($currency, $paysystem_info, $user_info, $order_info);
				}
				else {
					$this->smarty->assign('res', 				$res);
					$this->smarty->assign('order_numbers', 		$order_number);
					$this->contentOUT = $this->smarty->fetch($this->tplLocation.'sendResult.tpl');
				}

				//очищаем корзину
				if ($res) {					
					$_SESSION['shop_cart_module']['shopingcart']='';
					$_SESSION['shop_cart_module']['totalSumm']='';
					unset($_SESSION['shop_cart_module']['shopingcart']);
					unset($_SESSION['shop_cart_module']['totalSumm']);										
				}
			}
		}
	}

	

	/**
	 * Предварительная проверка реквезитов платежа
	 *
	 */
	function Result_pay() {

		//ID внутренней платежной системы сайта
		$pay_system_id		= $_SESSION['pay_details_info']['pay_system_id'];
		$order_id			= $_SESSION['pay_details_info']['order_id'];

		//берём выбранную платёжную систему
		$query     			= "SELECT t.* FROM `{$this->tablePrefix}pay_systems` AS `t` WHERE t.id='{$pay_system_id}'";
		$result    			= $this->mysql->executeSQL($query);
		$paysystem_info		= $this->mysql->fetchAssoc($result);

		//берём заказ
		$query     			= "SELECT t.* FROM `{$this->tablePrefix}orders` AS `t` WHERE t.id='{$order_id}'";
		$result    			= $this->mysql->executeSQL($query);
		$order_info			= $this->mysql->fetchAssoc($result);

		//проверяем, успешно ли прошла оплата
		list($payed, $pay_details)	= $this->{"{$paysystem_info['func_name']}_result"}($this->posts, $paysystem_info, $order_info);

		//если платёж прошел успешно, обновляем статус заказа на "Оплачен" и сохраняем детали платежа
		if ($payed) {
			$query	    = "UPDATE `{$this->tablePrefix}orders` SET `payed`='1', `pay_details`='$pay_details' WHERE `id`='$order_id'";
			$result 	= $this->mysql->executeSQL($query);
		}

		$this->smarty->assign('order_id', 		$order_id);
		$this->contentOUT 	= $this->smarty->fetch($this->tplLocation.'success_pay.tpl');

	}


	/**
	 * Если платёж проведён успешно
	 *
	 */
	function Success_pay() {
		$order_id	= $_SESSION['pay_details_info']['order_id'];

		//уничтожаем временную сессию c информацией об транзакции оплаты
		unset($_SESSION['pay_details_info']);

		$this->smarty->assign('order_id', 		$order_id);
		$this->contentOUT 	= $this->smarty->fetch($this->tplLocation.'success_pay.tpl');
	}



	/**
	 * Если не удалось провести платёж
	 *
	 */
	function Fail_pay() {
        $order_id	= $_SESSION['pay_details_info']['order_id'];
		//уничтожаем временную сессию c информацией об транзакции оплаты
		unset($_SESSION['pay_details_info']);

		$this->smarty->assign('order_id', 		$order_id);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'fail_pay.tpl');
	}








	///////////////ОБРАБОТЧИКИ ПЛАТЁЖНЫХ СИСТЕМ//////////////////
	/**
	 * Платёжная система Webmoney
	 * 
	 * @param array $currency
	 * @param array $paysystem_info
	 * @param array $user_info
	 * @param array $order_info
	 * @return text
	 */
	function Webmoney($currency, $paysystem_info, $user_info, $order_info) {

		$description				= base64_encode('Оплата заказа №'.$order_info['id']);

		$this->smarty->assign('paysystem_info', 		$paysystem_info);
		$this->smarty->assign('user_info', 				$user_info);
		$this->smarty->assign('order_info', 			$order_info);
		$this->smarty->assign('description', 			$description);
		$this->smarty->assign('pageInfo', 				$this->pageInfo);


		$contentOUT = $this->smarty->fetch($this->tplLocation.'webmoney_pay.tpl');

		return $contentOUT;
	}



	/**
	 * Предварительная проверка реквезитов для оплаты через систему Webmoney
	 *
	 * @param array $status_data
	 * @param array $paysystem_info
	 * @return array
	 */	
	function Webmoney_result($status_data, $paysystem_info, $order_info) {

		//если это форма предварительного запроса
		if (isset($status_data['LMI_PREREQUEST']) && $status_data['LMI_PREREQUEST']==1) {

			if ($order_info['id']!=$status_data['LMI_PAYMENT_NO']) {
				$res	= 'ERR: неправильный id заказа';
			}
			if ($paysystem_info['purse']!=$status_data['LMI_PAYEE_PURSE']) {
				$res	= 'ERR: неправильный кошелёк';
			}
			elseif ($order_info['total_price']!=$status_data['LMI_PAYMENT_AMOUNT']) {
				$res	= 'ERR: неправильная сумма заказа';
			}
			else {
				$res	= 'YES';
			}

			echo $res;
			exit;
		}
		//проверяем форму оповещения о платеже
		else if (isset($status_data['LMI_HASH'])) {
			//Проверяем целостность данных
			$crc = trim($status_data['LMI_PAYEE_PURSE']).
			trim($status_data['LMI_PAYMENT_AMOUNT']).
			trim($status_data['LMI_PAYMENT_NO']).
			trim($status_data['LMI_MODE']).
			trim($status_data['LMI_SYS_INVS_NO']).
			trim($status_data['LMI_SYS_TRANS_NO']).
			trim($status_data['LMI_SYS_TRANS_DATE']).
			trim($paysystem_info['secret_key']).
			trim($status_data['LMI_PAYER_PURSE']).
			trim($status_data['LMI_PAYER_WM']);

			$crc = md5($crc);

			//Сравниваем хэши
			if (mb_strtoupper($crc) == mb_strtoupper(trim($status_data['LMI_HASH']))) {
				//проверяем режим оплаты
				if (trim($status_data['LMI_MODE'])==0) {					
					$payed	= true;
				}
				else {
					$payed	= false;
				}
				$res	= 'YES';
			}
			else {
				$payed	= false;
				$res	= 'ERR: подпись не совпадает';
			}
						
			
			//детали платежа
			$pay_details			= '';
			foreach ($status_data as $key=>$v) {
				$pay_details.="$key = $v\r\n";
			}


			return array($payed, $pay_details);
		}
	}



	/**
	 * Платёжная система Robokassa
	 * 
	 * @param array $currency
	 * @param array $paysystem_info
	 * @param array $user_info
	 * @param array $order_info
	 * @return text
	 */
	function Robokassa($currency, $paysystem_info, $user_info, $order_info) {

		// формирование подписи
		$paysystem_info['crc']		= md5("{$paysystem_info['login']}:{$order_info['total_summ']}:{$order_info['id']}:{$paysystem_info['password']}");

		$this->smarty->assign('paysystem_info', 		$paysystem_info);
		$this->smarty->assign('user_info', 				$user_info);
		$this->smarty->assign('order_info', 			$order_info);
		$this->smarty->assign('pageInfo', 				$this->pageInfo);

		$contentOUT = $this->smarty->fetch($this->tplLocation.'robokassa_pay.tpl');

		return $contentOUT;
	}



	/**
	 * Проверка оплаты через систему Robokassa
	 *
	 * @param array $status_data
	 * @param array $paysystem_info
	 * @return array
	 */
	function Robokassa_result($status_data, $paysystem_info, $order_info) {

		//если это форма предварительного запроса
		if (!isset($status_data['sCulture'])) {
			$mrh_pass2	= $paysystem_info['secret_key'];
			$out_summ 	= $status_data['OutSum'];
			$inv_id 	= $status_data['InvId'];
			$crc 		= strtoupper($status_data['SignatureValue']);
			$my_crc 	= strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));

			if ($crc==$my_crc) {
				$res	= "OK{$order_info['id']}\n";
			}
			else {
				$res	= 'ERR: подпись не совпадает';
			}

			echo $res;
			exit;
		}
		//проверяем форму оповещения о платеже
		else {
			$mrh_pass1	= $paysystem_info['password'];
			$out_summ 	= $status_data['OutSum'];
			$inv_id 	= $status_data['InvId'];
			$crc 		= strtoupper($status_data['SignatureValue']);
			$my_crc 	= strtoupper(md5("$out_summ:$inv_id:$mrh_pass1"));

			//Сравниваем хэши
			if ($crc==$my_crc) {
				$payed	= true;
			}
			else {
				$payed	= false;
			}

			//детали платежа
			$pay_details			= '';
			foreach ($status_data as $key=>$v) {
				$pay_details.="$key = $v".SETTINGS_NEW_LINE;
			}
			
			//проверяем режим оплаты
			if ($status_data['LMI_MODE']!=0) {
				$payed	= false;
			}
			
			return array($payed, $pay_details);
		}

	}



	/**
	 * Платёжная система Interkassa
	 * 
	 * @param array $currency
	 * @param array $paysystem_info
	 * @param array $user_info
	 * @param array $order_info
	 * @return text
	 */
	function Interkassa($currency, $paysystem_info, $user_info, $order_info) {

		$this->smarty->assign('paysystem_info', 		$paysystem_info);
		$this->smarty->assign('user_info', 				$user_info);
		$this->smarty->assign('order_info', 			$order_info);
		$this->smarty->assign('pageInfo', 				$this->pageInfo);

		$contentOUT = $this->smarty->fetch($this->tplLocation.'interkassa_pay.tpl');

		return $contentOUT;
	}



	/**
	 * Проверка оплаты через систему Interkass
	 *
	 * @param array $status_data
	 * @param array $paysystem_info
	 * @return array
	 */
	function Interkassa_result($status_data, $paysystem_info, $order_info) {

		//проверяем форму оповещения о платеже
		if (isset($status_data['ik_payment_state']) && $status_data['ik_payment_state']=='success') {

			$crc = $status_data['ik_shop_id'].':'.
			$status_data['ik_payment_amount'].':'.
			$status_data['ik_payment_id'].':'.
			$status_data['ik_paysystem_alias'].':'.
			$status_data['ik_baggage_fields'].':'.
			$status_data['ik_payment_state'].':'.
			$status_data['ik_trans_id'].':'.
			$status_data['ik_currency_exch'].':'.
			$status_data['ik_fees_payer'].':'.
			$paysystem_info['secret_key'];

			$crc = strtoupper(md5($crc));

			if(strtoupper($status_data['ik_sign_hash']) === $crc) {
				$payed	= true;
			}
			else {
				$payed	= false;
			}

			//детали платежа
			$pay_details			= '';
			foreach ($status_data as $key=>$v) {
				$pay_details.="$key = $v\r\n";
			}

			return array($payed, $pay_details);
		}
		else {
			$payed	= false;
			return array($payed, '');
		}

	}



	/**
	 * Платёжная система YandexMoney
	 * 
	 * @param array $currency
	 * @param array $paysystem_info
	 * @param array $user_info
	 * @param array $order_info
	 * @return text
	 */
	function YandexMoney($currency, $paysystem_info, $user_info, $order_info) {

		// Тип работы обработчика платежной системы:
		// 0 - прямой платеж на кошелек
		// 1 - платеж для магазина (нужно заключить договор с Яндекс.Деньги)
		$type = 0;


		$this->smarty->assign('paysystem_info', 		$paysystem_info);
		$this->smarty->assign('user_info', 				$user_info);
		$this->smarty->assign('order_info', 			$order_info);
		$this->smarty->assign('type', 					$type);
		$this->smarty->assign('pageInfo', 				$this->pageInfo);
		$contentOUT = $this->smarty->fetch($this->tplLocation.'yandex_pay.tpl');

		return $contentOUT;
	}



	/**
	 * Проверка оплаты через систему YandexMoney
	 *
	 * @param array $status_data
	 * @param array $paysystem_info
	 * @return array
	 */
	function YandexMoney_result($status_data, $paysystem_info) {
		/*
		//должна быть проверка платежа

		$Sum 			= $status_data["SHOULD_PAY"];
		$shopId 		= $status_data["SHOP_ID"];
		$orderNumber 	= $status_data["ORDER_ID"];
		$customerNumber = $status_data["USER_ID"];
		$shopPassword 	= $status_data["SHOP_KEY"];

		$shopPassword	= $paysystem_info['secret_key'];

		$strCheck = md5(implode(";", array($orderIsPaid, $orderSumAmount, $orderSumCurrencyPaycash, $orderSumBankPaycash, $shopId, $orderNumber, $customerNumber, $shopPassword)));
		if (strtoUpper($md5) != strtoUpper($strCheck))
		{
		$bCorrectPayment = False;
		$code = "1"; // ошибка авторизации
		}
		*/


		$payed=false;
		//детали платежа
		$pay_details			= '';
		foreach ($status_data as $key=>$v) {
			$pay_details.="$key = $v\r\n";
		}

		return array($payed, $pay_details);
	}



	/**
	 * Оплата наличными при встрече
	 * 
	 * @param array $currency
	 * @param array $paysystem_info
	 * @param array $user_info
	 * @param array $order_info
	 * @return text
	 */
	function Cash($currency, $paysystem_info, $user_info, $order_info) {

		$this->smarty->assign('order_number', 		$order_info['id']);

		$contentOUT = $this->smarty->fetch($this->tplLocation.'sendResult.tpl');

		return $contentOUT;
	}


	//////////////ОКОНЧАНИЕ ФУНКЦИЙ-ОБРАБОТЧИКОВ БЛОКА//////////////////////////////////////////////////////////////////////////////////////

}

?>