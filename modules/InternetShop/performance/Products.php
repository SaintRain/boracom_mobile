<?php

/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод продукции из категории
*////////////////////////////////////////////////////////////////////////////////////////////
class Products extends InternetShop {

	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {

		//вызываем функцию - обработчик
		switch ($this->action):
		case ('more'):					$this->more(); 				break;
		case ('insert_comments'):		$this->insert_comments(); 	break;
		default:						$this->START(); 			break;
		endswitch;
	}



	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS, $FILE_MANAGER;
		
		//запоминаем фразу по которой производится поиск
		if (isset($this->gets['products_search_text'])) {
			if ($this->get['products_search_text']!='') {
				$_SESSION['products_search_text']	= urldecode($this->get['products_search_text']);
			}
			elseif (isset($_SESSION['products_search_text'])) {
				unset($_SESSION['products_search_text']);
			}
		}


		//обрабатываем условие выборки
		if (isset($this->gets['for_page']) && is_numeric($this->gets['for_page'])) {
			$_SESSION['records_for_products_page']=$this->gets['for_page'];
		}

		if (isset($_SESSION['records_for_products_page'])) {
			$records_for_page	= $_SESSION['records_for_products_page'];
		}
		else {
			$records_for_page	= $this->settings['records_for_page'];
		}

		if (isset($this->gets['category_id']) && is_numeric($this->gets['category_id'])) {
			$query 				= "SELECT * FROM `{$this->tablePrefix}categories` AS `t` WHERE t.id='{$this->gets['category_id']}'";
			$result				= $this->mysql->executeSQL($query);
			$category			= $this->mysql->fetchAssoc($result);

			$where				= "WHERE t.category_id='{$this->gets['category_id']}' AND t.active=1";
		}
		else {
			$where				= '';
			$category			= array();
		}

		//обрабатываем поиск
		if (isset($_SESSION['products_search_text'])) {
			$products_search_text	= $_SESSION['products_search_text'];

			if ($where) {
				$dop	= 'AND';
			}
			else {
				$dop	= 'WHERE t.active=1 AND';
			}

			$search		= $dop."(t.caption LIKE '%$products_search_text%' OR t.article LIKE '%$products_search_text%' OR t.small_description LIKE '%$products_search_text%' OR t.description LIKE '%$products_search_text%')";
		}
		else {
			$search		= '';
		}

		//берем записи, которые нужно вывести на страницу
		$api					= $this->getApiObject($this->tablePrefix.'products');
		$query					= "SELECT t.*,
		t2.caption AS `category_id_caption` ,
		t3.name AS `currency_id_caption` ,
		t4.name AS `discount_type_caption` ,
		t4.discount,
		t5.name AS `brand_id_caption` 
		FROM `{$this->tablePrefix}products` AS `t` 
		LEFT JOIN `{$this->tablePrefix}categories` AS `t2` ON (t2.id=t.category_id)
		LEFT JOIN `{$this->tablePrefix}currencies` AS `t3` ON (t3.id=t.currency_id)
		LEFT JOIN `{$this->tablePrefix}discount` AS `t4` ON (t4.id=t.discount_type)
		LEFT JOIN `{$this->tablePrefix}brands` AS `t5` ON (t5.id=t.brand_id) $where $search
		ORDER BY t.sort_index DESC";

		list($products, $pages)		= $api->dataGet($query, $records_for_page, 'page');

		//берем валюту
		if (isset($_SESSION['shop_cart_module']['currency_id'])) {
			$query 					= "SELECT * FROM `{$this->tablePrefix}currencies` WHERE `id`='{$_SESSION['shop_cart_module']['currency_id']}'";
		}
		else {
			$query 					= "SELECT * FROM `{$this->tablePrefix}currencies` ORDER BY `general` DESC LIMIT 1";
		}

		
		$result						= $this->mysql->executeSQL($query);
		$currency					= $this->mysql->fetchAssoc($result);

		//берём курсы продажы валюты
		$courses					= array();
		$query 						= "SELECT * FROM `{$this->tablePrefix}courses` WHERE `sell_currency_id`='{$currency['id']}' ORDER BY `sort_index`";
		$result						= $this->mysql->executeSQL($query);
		while ($row= $this->mysql->fetchAssoc($result)) {
			$courses[$row['sell_currency_id']][$row['by_currency_id']]=$row['quotation'];
		}

		//переводим по курсу
		$ids	= array();
		foreach ($products as $key => $record) {
			if ($products[$key]['currency_id']!=$currency['id']) {
				if (isset($courses[$currency['id']][$products[$key]['currency_id']])) {
					$course							= $courses[$currency['id']][$products[$key]['currency_id']];
					$products[$key]['price']		= $products[$key]['price']/$course;
					$products[$key]['old_price']	= $products[$key]['old_price']/$course;
				}
				else {
					$products[$key]['price']			= 0;
					$products[$key]['old_price']		= 0;
				}
			}



			$products[$key]['price']					= number_format($products[$key]['price'], $this->roundPriceTo(), ',', ' ');
			$products[$key]['old_price']				= number_format($products[$key]['old_price'], $this->roundPriceTo(), ',', ' ');
			$ids[]										= $record['id'];
		}

		if (count($ids)>0) {
			$ids					= implode(',', $ids);
			$comments_info			= array();
			$query					= "SELECT product_id, count(*) AS `count`, sum(points) AS `points_width` FROM internetshop_products_comments WHERE enable=1 AND points>0 AND product_id IN ($ids) GROUP BY product_id";
			$result					= $this->mysql->executeSQL($query);
			while ($row				= $this->mysql->fetchAssoc($result)) {
				$comments_info[$row['product_id']]			= $row;
			}
		}

		foreach ($products as $key => $record) {
			if (isset($comments_info[$record['id']])) {
				$products[$key]['comments_points_width']	= round( (110/5)*($comments_info[$record['id']]['points_width']/$comments_info[$record['id']]['count']), 0);
				$products[$key]['comments_count']			= $comments_info[$record['id']]['count'];
			}
		}


		$this->smarty->assign('category', 			$category);
		$this->smarty->assign('currency', 			$currency);
		$this->smarty->assign('products', 			$products);
		$this->smarty->assign('pages', 				$pages);
		$this->smarty->assign('table_name', 		$this->tablePrefix.'products');
		$this->smarty->assign('settings', 			$this->settings);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_list.tpl');
	}




	/**
	 * вывод подробной информации о продукте
	 */
	function more() {
		GLOBAL $FRAME_FUNCTIONS, $FILE_MANAGER, $MYSQL_TABLE13;

		if (isset($this->gets['id']) && is_numeric($this->gets['id'])) {

			$where					= "WHERE t.id='{$this->gets['id']}' AND t.active=1";

			$query					= "SELECT t.*,
			t2.caption AS `category_id_caption` ,
			t3.name AS `currency_id_caption` ,
			t4.name AS `discount_type_caption` ,
			t4.discount,			
			t5.name AS `brand_id_caption` 
			FROM `{$this->tablePrefix}products` AS `t` 
			LEFT JOIN `{$this->tablePrefix}categories` AS `t2` ON (t2.id=t.category_id)
			LEFT JOIN `{$this->tablePrefix}currencies` AS `t3` ON (t3.id=t.currency_id)
			LEFT JOIN `{$this->tablePrefix}discount` AS `t4` ON (t4.id=t.discount_type)
			LEFT JOIN `{$this->tablePrefix}brands` AS `t5` ON (t5.id=t.brand_id) $where
			ORDER BY t.sort_index DESC";

			$result			= $this->mysql->executeSQL($query);
			$product		= $this->mysql->fetchAssoc($result);

			//берем валюту
			if (isset($_SESSION['shop_cart_module']['currency_id'])) {
				$query 					= "SELECT * FROM `{$this->tablePrefix}currencies` WHERE `id`='{$_SESSION['shop_cart_module']['currency_id']}'";
			}
			else {
				$query 					= "SELECT * FROM `{$this->tablePrefix}currencies` ORDER BY `general` DESC LIMIT 1";
			}
			
			$result						= $this->mysql->executeSQL($query);
			$currency					= $this->mysql->fetchAssoc($result);

			//берём курсы продажы валюты
			$courses					= array();
			$query 						= "SELECT * FROM `{$this->tablePrefix}courses` WHERE `sell_currency_id`='{$currency['id']}' ORDER BY `sort_index`";
			$result						= $this->mysql->executeSQL($query);
			while ($row= $this->mysql->fetchAssoc($result)) {
				$courses[$row['sell_currency_id']][$row['by_currency_id']]=$row['quotation'];
			}


			//переводим по курсу
			if ($product['currency_id']!=$currency['id']) {
				if (isset($courses[$currency['id']][$product['currency_id']])) {
					$course		= $courses[$currency['id']][$product['currency_id']];
					$product['price']		= $product['price']/$course;
					$product['old_price']	= $product['old_price']/$course;

				}
				else {
					$product['price']		= 0;
					$product['old_price']	= 0;
				}
			}

			$product['price']		= number_format($product['price'], $this->roundPriceTo(), ',', ' ');
			$product['old_price']	= number_format($product['old_price'], $this->roundPriceTo(), ',', ' ');

			//комментарии
			if ($this->settings['show_comments']) {
				$api										= $this->getApiObject($this->tablePrefix.'products_comments');
				$query										= "SELECT t.* FROM `{$this->tablePrefix}products_comments` AS `t` WHERE t.product_id='{$this->gets['id']}' AND t.enable=1";
				list($comments_records, $comments_pages)	= $api->dataGet($query, $this->settings['records_for_page'], 'page_com');

				//формируем правильное время для пользователя
				$points_width	= 0;
				$golosov		= 0;
				foreach ($comments_records as $key=>$value) {
					$comments_records[$key]['datetime'] = $FRAME_FUNCTIONS->userDateTime($value['datetime'], SETTINGS_TIMEZONE, $this->settings['date_format_comments']);
					if ($value['points']>0) {
						$points_width=$points_width+$value['points'];
						$golosov++;
					}
				}
				if ($points_width>0 && $golosov>0) {
					$points_width		= round( (110/5)*($points_width/$golosov), 0);
				}
			}
			else {
				$comments_records	= false;
				$comments_pages		= false;
				$points_width		= 0;
			}

			if (isset($product['images'])) {
				$product['images']		= eval($product['images']);
			}
									

			//берем товар, который обычно покупают с этим товаром
			if (isset($product['same_products']) && $product['same_products']) {
				
				$query					= "SELECT t.*,
			t2.caption AS `category_id_caption` ,
			t3.name AS `currency_id_caption` ,
			t4.name AS `discount_type_caption` ,
			t4.discount,
			t5.name AS `brand_id_caption` 
			FROM `{$this->tablePrefix}products` AS `t` 
			LEFT JOIN `{$this->tablePrefix}categories` AS `t2` ON (t2.id=t.category_id)
			LEFT JOIN `{$this->tablePrefix}currencies` AS `t3` ON (t3.id=t.currency_id)
			LEFT JOIN `{$this->tablePrefix}discount` AS `t4` ON (t4.id=t.discount_type)
			LEFT JOIN `{$this->tablePrefix}brands` AS `t5` ON (t5.id=t.brand_id)
			LEFT JOIN `$MYSQL_TABLE13` AS `t6` ON (t6.data_id='{$product['id']}' AND t6.field_id='{$product['same_products']}')			
			
			WHERE t.id=t6.value_id AND t.id!='{$product['id']}' ORDER BY t.sort_index DESC";
				$result			= $this->mysql->executeSQL($query);
				$products		= $this->mysql->fetchAssocAll($result);

				//переводим по курсу
				$ids	= array();
				foreach ($products as $key => $record) {
					if ($products[$key]['currency_id']!=$currency['id']) {
						if (isset($courses[$currency['id']][$products[$key]['currency_id']])) {
							$course							= $courses[$currency['id']][$products[$key]['currency_id']];

							$products[$key]['price']		= $products[$key]['price']/$course;
							$products[$key]['old_price']	= $products[$key]['old_price']/$course;
						}
						else {
							$products[$key]['price']			= 0;
							$products[$key]['old_price']		= 0;
						}
					}

					$products[$key]['price']					= number_format($products[$key]['price'], $this->roundPriceTo(), ',', ' ');
					$products[$key]['old_price']				= number_format($products[$key]['old_price'], $this->roundPriceTo(), ',', ' ');
					$ids[]										= $record['id'];
				}

				if (count($ids)>0) {
					$ids					= implode(',', $ids);
					$comments_info			= array();
					$query					= "SELECT product_id, count(*) AS `count`, sum(points) AS `points_width` FROM internetshop_products_comments WHERE enable=1 AND points>0 AND product_id IN ($ids) GROUP BY product_id";
					$result					= $this->mysql->executeSQL($query);
					while ($row				= $this->mysql->fetchAssoc($result)) {
						$comments_info[$row['product_id']]			= $row;
					}
				}

				foreach ($products as $key => $record) {
					if (isset($comments_info[$record['id']])) {
						$products[$key]['comments_points_width']	= round( (110/5)*($comments_info[$record['id']]['points_width']/$comments_info[$record['id']]['count']), 0);
						$products[$key]['comments_count']			= $comments_info[$record['id']]['count'];
					}
				}
			}
			else {
				$products=array();
			}

			$this->smarty->assign('comments_records', 		$comments_records);
			$this->smarty->assign('comments_pages', 		$comments_pages);
			$this->smarty->assign('currency', 				$currency);
			$this->smarty->assign('product', 				$product);
			$this->smarty->assign('same_products', 			$products);
			$this->smarty->assign('points_width', 			$points_width);
			$this->smarty->assign('table_name', 			$this->tablePrefix.'products');
			$this->smarty->assign('table_name_comments', 	$this->tablePrefix.'products_comments');
			$this->smarty->assign('settings', 				$this->settings);
			$this->smarty->assign('errors', 				$this->errors);

			$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_more.tpl');
		}
	}




	/**
	 * Вставка коментария
	 *
	 */
	function insert_comments() {
		GLOBAL $FRAME_FUNCTIONS;

		if($this->settings['kcaptcha']==1) {
			if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $this->post['kcaptcha']){
			}
			else{
				$this->errors[]		= 'Не верно введен код изображения!';
			}
		}
		if (count($this->errors)==0) {
			$api					= $this->getApiObject($this->tablePrefix.'products_comments', $this->posts);
			$api->dataInsert();
			$this->errors			= $api->errors;
		}

		if (count($this->errors)>0) {
			foreach ($this->post as $key=>$value) {
				$this->smarty->assign($key, $value);
			}
		}
		else {
			//отправка уведомления
			$query_cats     	= "SELECT `caption`  FROM `{$this->tablePrefix}products` WHERE id='{$this->posts['product_id']}'";
			$result_cats    	= $this->mysql->executeSQL($query_cats);
			list($caption) 		= $this->mysql->fetchRow($result_cats);

			$this->smarty->assign('caption', 			$caption);
			$this->smarty->assign('id', 				$this->posts['product_id']);
			$this->smarty->assign('user_comment', 		$this->post['comment']);
			$this->smarty->assign('category_id', 		$this->gets['category_id']);
			$body	= $this->smarty->fetch($this->tplLocation.'com_message.tpl');

			$mail	= $FRAME_FUNCTIONS->getMailObject($this->settings['send_comments_toEmail'], SETTINGS_EMAIL_CAPTION,  $this->posts['user_email'], $this->posts['user_name'], $this->settings['send_com_theme_add_comments'], $body);
			$mail->send();

			$this->smarty->assign('comment_is_added', true);
		}

		$this->more();
	}


}

?>