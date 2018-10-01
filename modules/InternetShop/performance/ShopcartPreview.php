<?php

/*///////////////////////////////////////////////////////////////////////////////////////////
Предпросмотр корзины
*////////////////////////////////////////////////////////////////////////////////////////////
class ShopcartPreview extends InternetShop {
	
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

		$currency	= array();
		$currencies	= array();
		$query 		= "SELECT * FROM `{$this->tablePrefix}currencies` ORDER BY `sort_index` DESC";
		$result		= $this->mysql->executeSQL($query);
		while ($row	= $this->mysql->fetchAssoc($result)) {
			if (isset($_SESSION['shop_cart_module']['currency_id']) && $_SESSION['shop_cart_module']['currency_id']==$row['id']) {
				$currency	= $row;
			}
			elseif (!isset($_SESSION['shop_cart_module']['currency_id']) && !isset($currency['sign']) && $row['general']==1) {
				$currency	= $row;
			}
			$currencies[]	= $row;
		}

        $sum								= $this->ShopcartTotalSumm(true);

        $this->smarty->assign('total_summ',     $sum['total_summ2']);
        $this->smarty->assign('total_count',    $sum['total_count']);
		$this->smarty->assign('currency', 		$currency);
		$this->smarty->assign('currencies', 	$currencies);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'shortDetails.tpl');
	}

}

?>