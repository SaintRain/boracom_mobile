<?php

/*///////////////////////////////////////////////////////////////////////////////////////////
Форма поиска товара
*////////////////////////////////////////////////////////////////////////////////////////////
class ProductsSearchForm extends InternetShop {

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

		if (isset($this->gets['products_search_text'])) {
			$products_search_text=urldecode($this->get['products_search_text']);
		}
		elseif (isset($_SESSION['products_search_text'])) {
			$products_search_text=$_SESSION['products_search_text'];

		}
		else {
			$products_search_text	= false;
		}

		$this->smarty->assign('products_search_text', $products_search_text);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_form.tpl');
	}

}

?>