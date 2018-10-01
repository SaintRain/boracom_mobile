<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Meta - ключевые слова
*////////////////////////////////////////////////////////////////////////////////////////////
class Metakeywords extends Forum {
	
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

		$s		= $this->getSEO('metakeywords');

		if ($s=='') 	{
			$s	= $this->settings['metakeywords'];
		}
		$this->contentOUT 	= $s;
	}



}

?>