<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
JavaScript - библиотеки
*////////////////////////////////////////////////////////////////////////////////////////////
class JavaScriptInclude extends InternetShop {

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
		GLOBAL $FRAME_FUNCTIONS;

        //если заходим на страницу оформления заказа, тогда меняем выбранную валюту на валюту по умолчанию
        if (isset($_SESSION['shop_cart_module']['currency_id'])) {
            if ($this->pageInfo['name']=='shopcart') {
                $query 			= "SELECT * FROM `{$this->tablePrefix}currencies` ORDER BY `general` DESC LIMIT 1";
                $result			= $this->mysql->executeSQL($query);
                $currency		= $this->mysql->fetchAssoc($result);
                if ($currency['id']!=$_SESSION['shop_cart_module']['currency_id']) {
                    $_SESSION['shop_cart_module']['temp_currency_id']=$_SESSION['shop_cart_module']['currency_id'];
                    $_SESSION['shop_cart_module']['currency_id']=$currency['id'];
                }
            }
        else if (isset($_SESSION['shop_cart_module']['temp_currency_id'])) {
            $_SESSION['shop_cart_module']['currency_id']=$_SESSION['shop_cart_module']['temp_currency_id'];
            unset($_SESSION['shop_cart_module']['temp_currency_id']);
            }
        }

		//берем стоимость предварительного заказа
		if (!isset($_SESSION['shop_cart_module'])) {
			$sum								= $this->ShopcartTotalSumm(true);
			$_SESSION['shop_cart_module']['totalSummInDefault']		= $sum['total_summ'];
			$_SESSION['shop_cart_module']['totalSumm']				= $sum['total_summ2'];
			$_SESSION['shop_cart_module']['totalSummDiscount_by_q']	= $sum['discount_by_q_summ'];
			$_SESSION['shop_cart_module']['totalCount']				= $sum['total_count'];
		}

		if (isset($_SESSION['shop_cart_module']['shopingcart'])) {
			$shopingcart=json_encode($_SESSION['shop_cart_module']['shopingcart']);
		}
		else {
			$shopingcart='';
		}
        $this->smarty->assign('round_price_to', 	$this->roundPriceTo());
		$this->smarty->assign('shopingcart', 	$shopingcart);
		$this->smarty->assign('moduleInfo', 	$this->moduleInfo);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_list.tpl');
	}



}

?>