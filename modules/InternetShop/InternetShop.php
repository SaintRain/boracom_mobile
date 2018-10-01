<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Библиотека общих функций модуля
*////////////////////////////////////////////////////////////////////////////////////////////
class InternetShop extends MAIN_MODULES_CLASS {

	function getPrintOrder($id, $tpl_name) {
		GLOBAL $FRAME_FUNCTIONS;

		//берём основную валюту
		$query 						= "SELECT * FROM `{$this->tablePrefix}currencies` ORDER BY `general` DESC LIMIT 1";
		$result						= $this->mysql->executeSQL($query);
		$currency					= $this->mysql->fetchAssoc($result);

		//берём курсы продажы валюты
		$courses					= array();
		$query 						= "SELECT * FROM `{$this->tablePrefix}courses`  WHERE `sell_currency_id`='{$currency['id']}' ORDER BY `sort_index`";
		$result						= $this->mysql->executeSQL($query);
		while ($row= $this->mysql->fetchAssoc($result)) {
			$courses[$row['sell_currency_id']][$row['by_currency_id']]=$row['quotation'];
		}

		$query     		= "SELECT t.*,
		t2.email AS `client_id_caption` ,
		t2.name, t2.second_name, t2.otchestvo,
		t3.name AS `delivery_id_caption` ,
		t4.name AS `currency_id_caption` ,
		t5.caption AS `pay_system_id_caption` ,
		t6.name AS `status_id_caption` 
		FROM `{$this->tablePrefix}orders` AS `t` 
		LEFT JOIN `{$this->tablePrefix}users` AS `t2` ON (t2.id=t.client_id)
		LEFT JOIN `{$this->tablePrefix}delivery` AS `t3` ON (t3.id=t.delivery_id)
		LEFT JOIN `{$this->tablePrefix}currencies` AS `t4` ON (t4.id=t.currency_id)
		LEFT JOIN `{$this->tablePrefix}pay_systems` AS `t5` ON (t5.id=t.pay_system_id)
		LEFT JOIN `{$this->tablePrefix}orders_status` AS `t6` ON (t6.id=t.status_id)
		WHERE t.id='$id'
		ORDER BY t.sort_index DESC";

		$result	= $this->mysql->executeSQL($query);
		$order 	= $this->mysql->fetchAssoc($result);

		//берём состав заказа
		$price_bez_nds_total	= 0;
		$price_s_nds_total		= 0;
		$nds_total				= 0;
		$price_nds_total		= 0;
		$query 					= "SELECT t2.article, t2.caption, t2.price, t2.nds, t2.nds_in_price, t2.currency_id, t8.caption AS `unit_id_caption`, t.*
		FROM `{$this->tablePrefix}orders_composition` AS `t` 
		LEFT JOIN `{$this->tablePrefix}products` AS `t2` ON (t2.id=t.product_id) 
		LEFT JOIN `{$this->tablePrefix}units` AS `t8` ON (t8.id=t2.unit_id)
		WHERE t.order_id='{$order['id']}'";
		$result					= $this->mysql->executeSQL($query);
		$products				= $this->mysql->fetchAssocAll($result);
		foreach ($products as $key=>$v) {

			//переводим по курсу
			if ($v['currency_id']!=$currency['id']) {
				if (isset($courses[$currency['id']][$v['currency_id']])) {
					$course					= $courses[$currency['id']][$v['currency_id']];
					$v['price']				= $v['price']/$course;
				}
				else {
					$v['price']				= 0;
				}
			}

			//получаем сумму по количеству
			$price_amount	= $v['price']*$v['amount'];

			//считаем сумму без НДС
			if ($v['nds_in_price']) {
				$products[$key]['price_bez_nds']	= $price_amount-($price_amount/100)*$v['nds'];
			}
			else {
				$products[$key]['price_bez_nds']	= $price_amount;
			}

			//считаем НДС
			$products[$key]['price_nds']			= $price_amount-$products[$key]['price_bez_nds'];

			//считаем полную сумму с НДС
			$price_s_nds_total+=$products[$key]['price_bez_nds']+$products[$key]['price_nds'];


			$price_bez_nds_total+=$products[$key]['price_bez_nds'];
			$price_nds_total+=$products[$key]['price_nds'];

			$nds_total+=($v['price']/100)*$v['nds'];

			$products[$key]['price']			= number_format($v['price'], $this->roundPriceTo(), ',', ' ');
			$products[$key]['price_nds']		= number_format($products[$key]['price_nds'], $this->roundPriceTo(), ',', ' ');
			$products[$key]['price_bez_nds']	= number_format($products[$key]['price_bez_nds'], $this->roundPriceTo(), ',', ' ');
		}

		$price_bez_nds_total					= number_format($price_bez_nds_total, $this->roundPriceTo(), ',', ' ');
		$price_s_nds_total						= number_format($price_s_nds_total, $this->roundPriceTo(), ',', ' ');
		$nds_total								= number_format($nds_total, $this->roundPriceTo(), ',', ' ');


		$date 	= $FRAME_FUNCTIONS->userDateTime($order['created'], SETTINGS_TIMEZONE, 'd.m.Y');
		$date	= $this->setDatetime($date);

		$parts			= explode('.', $order['total_price']);
		$total_summ		= $FRAME_FUNCTIONS->num_propis($parts[0]);

		if (isset($parts[1])) {
			$total_ostatok	= $parts[1];
			if ($total_ostatok<10) {
				$total_ostatok	= '0'.$total_ostatok;
			}
		}
		else {
			$total_ostatok		= '00';
		}

		$this->smarty->assign('order', 						$order);
		$this->smarty->assign('products', 					$products);
		$this->smarty->assign('settings', 					$this->settings);
		$this->smarty->assign('date', 						$date);
		$this->smarty->assign('price_bez_nds_total', 		$price_bez_nds_total);
		$this->smarty->assign('price_s_nds_total', 			$price_s_nds_total);
		$this->smarty->assign('nds_total', 					$nds_total);
		$this->smarty->assign('total_summ', 				$total_summ);
		$this->smarty->assign('total_ostatok', 				$total_ostatok);
		$this->smarty->assign('currency', 					$currency);

		return $this->smarty->fetch($this->tplLocation.$tpl_name);
	}



	/**
	 * Возвращает скидку для пользователя
	 *
	 * @param array $courses
	 * @param array $currency
	 * @return int
	 */	
	function getdiscount($courses, $currency) {

		if (isset($_SESSION['logined_user']['id'])) {

			$id			= $_SESSION['logined_user']['id'];

			//берем оплаченные заказы
			$query     	= "SELECT `total_price`, `currency_id` FROM `{$this->tablePrefix}orders` WHERE  `client_id`='$id' AND `payed`='1'";
			$result    	= $this->mysql->executeSQL($query);
			$orders 	= $this->mysql->fetchAssocAll($result);

			$total_summ = 0;
			foreach ($orders as $key=>$tmp) {
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


			$discount	= 0;
			$query     	= "SELECT pieces_before, discount_perc, currency_id FROM `{$this->tablePrefix}discount_user` WHERE `discount_active`=1 ORDER BY `pieces_before`";
			$result    	= $this->mysql->executeSQL($query);
			$discounts 	= $this->mysql->fetchAssocAll($result);
			foreach ($discounts as $key=>$tmp) {

				//если валюта скидки и выбранная на сайте не совпадают, тогда переводим по курсу
				if ($tmp['currency_id']!=$currency['id']) {

					if (isset($courses[$currency['id']][$tmp['currency_id']])) {
						$course						= $courses[$currency['id']][$tmp['currency_id']];
						$tmp['pieces_before']		= $tmp['pieces_before']/$course;

					}
					else {
						$tmp['pieces_before']		= 0;
					}
				}

				if ($total_summ>=$tmp['pieces_before'])	 {
					$discount=$tmp['discount_perc'];
				}
			}
		}
		else $discount=0;

		return 	$discount;
	}



	/**
	 * Синхронизирует одну таблицу на основе исходной таблицы
	 *
	 * @param string $main_table_name
	 * @param string $child_table_name
	 * @param int $main_data_id
	 * @return bool
	 */
	function dataSynchronize($main_table_name, $child_table_name, $main_data_id) {
		GLOBAL $MYSQL_TABLE5, $MYSQL_TABLE18;

		$res			= true;

		//получаем имя модуля
		$query					= "SELECT t2.name FROM `$MYSQL_TABLE18` AS `t` LEFT JOIN `$MYSQL_TABLE5` AS `t2` ON (t2.id=t.module_id) WHERE t.table_name='$child_table_name'";
		$result					= $this->mysql->executeSQL($query);
		list($module_name)		= $this->mysql->fetchRow($result);

		//если модуль существует
		if ($module_name) {
			$update_fields		= array();	//одинаковые поля, которые следует обновить
			$insert_fields		= array();	//одинаковые поля, которые следует добавить
			$delete_fields		= false;	//нужно ли удалить запись из обновляемой таблицы
			$main_columns		= array();
			$chaild_columns 	= array();
			$not_check_fields	= array('page_id', 'tag_id', 'lang_id', 'sort_index');

			//берём поля обновляемой таблицы
			$query			= "SHOW COLUMNS FROM `$child_table_name`";
			if ($result		= $this->mysql->executeSQL($query)){
				while ($row	= $this->mysql->fetchAssoc($result)) {
					$chaild_columns[$row['Field']]	= $row;
				}
			}

			if (count($chaild_columns)>0) {
				//берём поля главной таблиц
				$query			= "SHOW COLUMNS FROM `$main_table_name`";
				if ($result		= $this->mysql->executeSQL($query)) {
					while ($row	= $this->mysql->fetchAssoc($result)) {
						$main_columns[$row['Field']]	= $row;
					}
				}
			}


			if (count($main_columns)>0 && count($chaild_columns)>0) {

				//формируем название таблицы без префикса
				$child_table_name_no_prefix	= mb_substr($child_table_name, strlen($module_name)+1);

				//берём исходную строку из основной таблицы
				$query					= "SELECT * FROM `$main_table_name` WHERE `id`='$main_data_id'";
				$result					= $this->mysql->executeSQL($query);
				if ($main_data_row		= $this->mysql->fetchAssoc($result)) {

					$query				= "SELECT * FROM `$child_table_name` WHERE `id`='$main_data_id'";
					$result				= $this->mysql->executeSQL($query);
					if ($child_data_row	= $this->mysql->fetchAssoc($result)) {
						//определяем какие поля следует обновить
						foreach ($main_data_row as $field_name => $m_data) {
							if (!in_array($field_name, $not_check_fields) && isset($child_data_row[$field_name]) && $child_data_row[$field_name]!=$m_data && $main_columns[$field_name]['Type']==$chaild_columns[$field_name]['Type']) {
								$update_fields[$field_name]	= $m_data;
							}
						}
					}
					//определяем общие поля
					else {
						//определяем поля для вставки
						foreach ($main_data_row as $field_name => $m_data) {
							if (!in_array($field_name, $not_check_fields) && isset($chaild_columns[$field_name]) &&  $main_columns[$field_name]['Type']==$chaild_columns[$field_name]['Type']) {
								$insert_fields[$field_name]	=  $m_data;
							}
						}
					}
				}
				else {
					$delete_fields 	 = true;
				}

				//формируем запрос на обновление
				$posts				= $this->posts;
				$posts['id']		= $main_data_id;
				if (count($update_fields)>0) {

					foreach ($update_fields as $field_name => $data) {
						$posts[$field_name]		= $data;
					}
					$api 								= $this->getApiObject($child_table_name, $posts);
					$api->dataUpdate();
				}
				//формируем запрос на вставку
				elseif (count($insert_fields)>0) {

					foreach ($insert_fields as $field_name => $data) {
						$posts[$field_name]		= $data;
					}

					$api 								= $this->getApiObject($child_table_name, $posts);
					$api->dataInsert();
				}
				//удаляем запись
				elseif ($delete_fields) {
					$api 								= $this->getApiObject($child_table_name, $posts);
					$api->dataDelete();
				}
			}
			else {
				$res	= false;
			}
		}

		return $res;
	}



	/**
	 * Формирует дату
	 *
	 * @param unknown_type $date
	 * @return unknown
	 */
	function setDatetime($date) {
		$montharray 	= array('1' => 'января','2' => 'февраля','3' => 'марта','4' => 'апреля','5' => 'мая','6' => 'июня','7' => 'июля','8' => 'августа','9' => 'сентября','10' => 'октября','11' => 'ноября','12' => 'декабря');
		$dateconvert 	= explode('.',$date);
		$dateconvert[1]	= intval($dateconvert[1]);
		$month 			= $montharray[$dateconvert[1]];
		$day   			= $dateconvert[0];
		$year  			= $dateconvert[2];

		return $day.' '.$month.' '.$year;
	}



	/**
	 * Просчитываем заказ по составу
	 *
	 * @param array $list
	 * @return array
	 */
	function getOrderSumm($list, $price_from_products=true, $user_currency=true) {

		//берем выбранную на сайте валюту
		if (isset($_SESSION['shop_cart_module']['currency_id']) && $user_currency) {
			$query 					= "SELECT * FROM `{$this->tablePrefix}currencies` WHERE `id`='{$_SESSION['shop_cart_module']['currency_id']}'";
		}
		else {
			$query 					= "SELECT * FROM `{$this->tablePrefix}currencies` ORDER BY `general` DESC LIMIT 1";
		}
        $result						= $this->mysql->executeSQL($query);
        $currency					= $this->mysql->fetchAssoc($result);

		//берём платёжные системы
		$query     					= "SELECT `id`, `caption` FROM `{$this->tablePrefix}pay_systems` WHERE `enable`=1 ORDER BY `sort_index` DESC";
		$result    					= $this->mysql->executeSQL($query);
		$pay_systems				= $this->mysql->fetchAssocAll($result);

		$query     					= "SELECT * FROM `{$this->tablePrefix}delivery` WHERE `enable`=1 ORDER BY `sort_index` DESC";
		$result    					= $this->mysql->executeSQL($query);
		$delivery 					= $this->mysql->fetchAssocAll($result);

		//берем скидки на количество заказываемого товара
		$query 						= "SELECT * FROM `{$this->tablePrefix}discount_user_by_q` WHERE `discount_active`=1 ORDER BY `pieces_before`";
		$result						= $this->mysql->executeSQL($query);
		$discount_user_count		= $this->mysql->fetchAssocAll($result);

        //берём основную валюту
		$query 						= "SELECT * FROM `{$this->tablePrefix}currencies` ORDER BY `general` DESC LIMIT 1";
		$result						= $this->mysql->executeSQL($query);
		$currency_general			= $this->mysql->fetchAssoc($result);

		//берём курсы продажы валюты
		$courses					= array();
		$query 						= "SELECT * FROM `{$this->tablePrefix}courses`  WHERE `sell_currency_id`='{$currency['id']}' ORDER BY `sort_index`";
		$result						= $this->mysql->executeSQL($query);
		while ($row= $this->mysql->fetchAssoc($result)) {
			$courses[$row['sell_currency_id']][$row['by_currency_id']]=$row['quotation'];
		}

		$ordersList	= array();
		for ($i=0; $i<count($list); $i=$i+2) {
			$tmp['id']		= $list[$i];
			$tmp['count']	= $list[$i+1];
			$ordersList[]	= $tmp;
		}

		$discount_by_q_summ = 0;
		$total_summ			= 0;
		$total_count		= 0;
		$products 			= array();

		for ($i=0; $i<count($ordersList); $i++) {

			$id				= $ordersList[$i]['id'];
			$query			= "SELECT t.*,
					t2.caption AS `category_id_caption`,
					t4.name AS `discount_type_caption`,
					t5.price AS `composition_price`,
					t5.currency_id AS `composition_currency_id`
					FROM `{$this->tablePrefix}products` AS `t` 
					LEFT JOIN `{$this->tablePrefix}categories` AS `t2` ON (t2.id=t.category_id)				
					LEFT JOIN `{$this->tablePrefix}discount` AS `t4` ON (t4.id=t.discount_type)					
					LEFT JOIN `{$this->tablePrefix}orders_composition` AS `t5` ON (t5.product_id=t.id)
					WHERE t.id='$id'";
			$result			= $this->mysql->executeSQL($query);
			$tmp			= $this->mysql->fetchAssoc($result);

			//берём стоимость по продукту, либо по составу
			if (!$price_from_products) {
				$tmp['price']				= $tmp['composition_price'];
				$tmp['currency_id']			= $tmp['composition_currency_id'];
			}


			//переводим по курсу
			if ($tmp['currency_id']!=$currency['id']) {
				if (isset($courses[$currency['id']][$tmp['currency_id']])) {
					$course					= $courses[$currency['id']][$tmp['currency_id']];
					$tmp['price']			= $tmp['price']/$course;
				}
				else {
					$tmp['price']			= 0;
				}
			}

			$tmp['count']	= $ordersList[$i]['count'];


			//вычисляем скидку по количеству товара
			$discount_by_q=0;
			if (is_array($discount_user_count)) {
				foreach ($discount_user_count as $d) {
					if ($tmp['count']>=$d['pieces_before']) {
						$discount_by_q=$d['discount_perc'];
					}
				}
			}

			//считаем сумму скидки по количеству товара
			$discount_by_q_summ	+= ceil((($tmp['price']*$tmp['count'])/100)*$discount_by_q);

			$summ			= round($tmp['price']*$tmp['count'], $this->roundPriceTo());
			$tmp['summ'] 	= $summ;
			$total_summ		+=$summ;
			$total_count	+=$tmp['count'];
			$tmp['price']	= number_format($tmp['price'], $this->roundPriceTo(), ',', ' ');
			$tmp['summ']	= number_format($tmp['summ'], $this->roundPriceTo(), ',', ' ');
			$products[]		= $tmp;
		}

		$total_summ_dustly	= $total_summ;
		$discount_percent	= $this->getdiscount($courses, $currency);

		$discount	 		= ceil(($total_summ_dustly/100)*$discount_percent);
		$total_summ			= round($total_summ_dustly-($discount+$discount_by_q_summ), $this->roundPriceTo());

		return array($products, $total_summ, $total_summ_dustly, $discount, $discount_by_q_summ, $total_count, $discount_percent, $currency, $currency_general, $pay_systems, $delivery);
	}



	/**
	 * Возвращает сумму заказа
	 *
	 */
	function ShopcartTotalSumm($price_from_products=false) {

		if (isset ($_SESSION['shop_cart_module']['shopingcart'])) $cookieData	= $_SESSION['shop_cart_module']['shopingcart'];
		else  $cookieData	= '';

		$list 				= explode(';', $cookieData);

		if (isset($list[1])) {

			list($products, $total_summ, $total_summ_dustly, $discount, $discount_by_q_summ, $total_count, $discount_percent, $currency, $currency_general, $pay_systems, $delivery) = $this->getOrderSumm($list, $price_from_products, true);

			//приводим к нужному формату
			$total_summ2		= number_format($total_summ, $this->roundPriceTo(), ',', ' ');
			$total_summ_dustly	= number_format($total_summ_dustly, $this->roundPriceTo(), ',', ' ');
			$discount			= number_format($discount, $this->roundPriceTo(), ',', ' ');
			$discount_by_q_summ	= number_format($discount_by_q_summ, $this->roundPriceTo(), ',', ' ');
			
			return array('total_summ'=>$total_summ, 'total_summ2'=>$total_summ2, 'discount_by_q_summ'=>$discount_by_q_summ, 'total_count'=>$total_count);
		}
	}


    /**
     * настройки округления
     * @return int
     */
    function roundPriceTo() {
        if ($this->settings['round_price']) {
            return 0;
        }
        else {
            return 2;
        }
    }

}
?>