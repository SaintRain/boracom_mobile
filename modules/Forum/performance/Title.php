<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Title - заголовок
*////////////////////////////////////////////////////////////////////////////////////////////
class Title extends Forum {

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
		
		$s		= $this->getSEO('title');

		if ($s=='') 	{
			$s	= $this->settings['title'];
		}
		$this->contentOUT 	= $s;
	}



}

?>