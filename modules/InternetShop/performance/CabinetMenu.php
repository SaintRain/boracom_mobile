<?php

/*///////////////////////////////////////////////////////////////////////////////////////////
Меню в личном кабинете
*////////////////////////////////////////////////////////////////////////////////////////////
class CabinetMenu extends InternetShop {

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

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_menu.tpl');
	}


}

?>