<?php

/*///////////////////////////////////////////////////////////////////////////////////////////
Новинки
*////////////////////////////////////////////////////////////////////////////////////////////
class ProductsNew extends InternetShop {


	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {
		
		//вызываем функцию - обработчик
		switch ($this->action):
		//case (''):					$this->; 			break;
		default:						$this->START(); 	break;
		endswitch;
	}


	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS, $FILE_MANAGER;

		//обрабатываем условие выборки
		if (isset($this->gets['for_page']) && is_numeric($this->gets['for_page'])) {
			$_SESSION['records_for_products_page']=$this->gets['for_page'];
		}

		if (isset($_SESSION['records_for_products_page'])) {
			$records_for_page	= $_SESSION['records_for_products_page'];
		}
		else {
			$records_for_page	= $this->settings['records_for_page_new'];
		}

		//берем записи, которые нужно вывести на страницу
		$api					= $this->getApiObject($this->tablePrefix.'products');
		$query					= "SELECT t.*,
		t2.caption AS `category_id_caption` ,
		t4.name AS `discount_type_caption` ,
		t4.discount
		FROM `{$this->tablePrefix}products` AS `t` 
		LEFT JOIN `{$this->tablePrefix}categories` AS `t2` ON (t2.id=t.category_id)
		LEFT JOIN `{$this->tablePrefix}discount` AS `t4` ON (t4.id=t.discount_type)
		WHERE t.nova=1   ORDER BY t.sort_index DESC";
		list($products, $pages)		= $api->dataGet($query, $this->settings['records_for_page_new'], 'page');

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
			if (isset($products[$key]['currency_id']) && $products[$key]['currency_id']!=$currency['id']) {
				if (isset($courses[$currency['id']][$products[$key]['currency_id']])) {
					$course							= $courses[$currency['id']][$products[$key]['currency_id']];
					$products[$key]['price']		= $products[$key]['price']/$course;
					$products[$key]['old_price']	= $products[$key]['old_price']/$course;
				}
				else {
					$products[$key]['price']		= 0;
					$products[$key]['old_price']	= 0;
				}
			}

			$products[$key]['price']				= number_format($products[$key]['price'], $this->roundPriceTo(), ',', ' ');
			$products[$key]['old_price']			= number_format($products[$key]['old_price'], $this->roundPriceTo(), ',', ' ');
			$ids[]									= $record['id'];
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

		$this->smarty->assign('currency', 			$currency);
		$this->smarty->assign('products', 			$products);
		$this->smarty->assign('pages', 				$pages);
		$this->smarty->assign('table_name', 		$this->tablePrefix.'products');
		$this->smarty->assign('settings', 			$this->settings);

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_list.tpl');
	}



}

?>