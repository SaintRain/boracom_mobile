<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Обработчик JS- запросов
*////////////////////////////////////////////////////////////////////////////////////////////
class JSActions extends InternetShop {

	/**
     * Определяем какой метод выполнить
     * 
     */
	function linker() {

		//вызываем метод - обработчик
		switch ($this->action):
		case ('SetCookie'):					$this->SetCookie(); 			break;
		case ('getCookie'):					$this->getCookie(); 			break;
		case ('getTotalSumm'):				$this->getTotalSumm(); 			break;
		case ('SetEmpty'):					$this->SetEmpty(); 				break;
		
		endswitch;


	}



	/**
	 * Устанавливает куки
	 *
	 */	
	function SetCookie() {
		if (isset($this->getr['shop_cart_module'])) {
			$vars	= json_decode($this->getr['shop_cart_module']);			
			foreach ($vars as $key=>$v) {
				$_SESSION['shop_cart_module'][$key]=$v;
			}
		}		
	}
	
	
	
	/**
	 * Очищаем куки
	 *
	 */	
	function SetEmpty() {

		if (isset($_SESSION['shop_cart_module'])) {
			$_SESSION['shop_cart_module']='';			
			unset($_SESSION['shop_cart_module']);
		}
	}	



	/**
	 * Берёт куки
	 *
	 */
	function getCookie() {

		//отдаём масив данных
		if (isset($this->getr['shop_cart_module']) && isset($_SESSION['shop_cart_module'])) {
			$this->contentOUT	= json_encode($_SESSION['shop_cart_module']);
		}

	}



	/**
	 * Возвращает сумму заказа
	 *
	 */
	function getTotalSumm() {

		$this->contentOUT	= json_encode($this->ShopcartTotalSumm(true));
		
	}



}

?>