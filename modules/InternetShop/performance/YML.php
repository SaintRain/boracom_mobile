<?php

/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод YML
*////////////////////////////////////////////////////////////////////////////////////////////
class YML extends InternetShop {
	
	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {
		if (isset($this->{$this->act_method}[$this->act_variable])) $do	= $this->{$this->act_method}[$this->act_variable];
		else  {
			$do = '';
		}

		//вызываем функцию - обработчик
		switch ($do):
		//case (''):					$this->; 			break;
		default:						$this->START(); 	break;
		endswitch;
	}


	//////////////НАЧАЛО ФУНКЦИЙ-ОБРАБОТЧИКОВ БЛОКА//////////////////////////////////////////////////////////////////////////////////////

	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS;

		header('Content-type: application/xml');

		//берём категории
		$query 		= "SELECT * FROM `{$this->tablePrefix}categories` ORDER BY `sort_index`";
		$result 	= $this->mysql->executeSQL($query);
		$categories	= $this->mysql->fetchAssocAll($result);

		//берём продукцию
		$query					= "SELECT t.*,
		t2.caption AS `category_id_caption` ,
		t2.translit AS `category_translit` ,		
		t3.name AS `currency_id_caption` ,
		t4.name AS `discount_type_caption` ,
		t4.discount,
		t5.name AS `brand_id_caption` 
		FROM `{$this->tablePrefix}products` AS `t` 
		LEFT JOIN `{$this->tablePrefix}categories` AS `t2` ON (t2.id=t.category_id)
		LEFT JOIN `{$this->tablePrefix}currencies` AS `t3` ON (t3.id=t.currency_id)
		LEFT JOIN `{$this->tablePrefix}discount` AS `t4` ON (t4.id=t.discount_type)
		LEFT JOIN `{$this->tablePrefix}brands` AS `t5` ON (t5.id=t.brand_id) WHERE t.market=1 AND t.active=1
		ORDER BY t.sort_index DESC";	

		$result	= $this->mysql->executeSQL($query);
		$data	= $this->mysql->fetchAssocAll($result);
		$time	= gmdate('Y-m-d h:i');

		foreach ($data as $k=> $d) {
			foreach ($d as $k2=> $d2) {
				$d2					= strip_tags($d2);
				$d2					= str_replace('&', '&amp;',$d2);
				$d2					= str_replace('"','&quot;',$d2);
				$d2					= str_replace('>','&gt;',$d2);
				$d2					= str_replace('<','&lt;',$d2);
				$d2					= str_replace('\'','&apos;',$d2);
				$data[$k][$k2]		= $d2;
			}
		}

		$this->smarty->assign('categories', $categories);
		$this->smarty->assign('time', $time);
		$this->smarty->assign('data', $data);

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_yml.tpl');
	}



	//////////////ОКОНЧАНИЕ ФУНКЦИЙ-ОБРАБОТЧИКОВ БЛОКА//////////////////////////////////////////////////////////////////////////////////////

}

?>