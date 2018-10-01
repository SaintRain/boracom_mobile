<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Печать накладной
*////////////////////////////////////////////////////////////////////////////////////////////
class GeneratePrintOrder extends InternetShop {

	/**
     * Определяем какой метод выполнить
     * 
     */
	function linker() {

		//вызываем метод - обработчик
		switch ($this->action):
		//case (''):					$this->; 			break;
		default:						$this->START(); 	break;
		endswitch;
	}



	/**
	 * Стартовый метод, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS;

		//вызываем общую функцию, которая описана в файле /modules/InternetShop/InternetShop.php
		$this->contentOUT = $this->getPrintOrder($this->gets['id'], 'print.tpl');
				
	}

}

?>