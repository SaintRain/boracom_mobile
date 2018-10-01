<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Meta - описание
*////////////////////////////////////////////////////////////////////////////////////////////
class Metadescription extends Forum {
	
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

		$s		= $this->getSEO('metadescription');

		if ($s=='') 	{
			$s	= $this->settings['metadescription'];
		}
		$this->contentOUT 	= $s;
	}



}

?>