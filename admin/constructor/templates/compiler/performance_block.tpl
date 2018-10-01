<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
{$block.description}
*////////////////////////////////////////////////////////////////////////////////////////////
class {$block.name} extends {$module.name}{literal} {
	
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

		//$this->smarty->assign('some_data', $some_data);
		//$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_some.tpl');
	}



}

?>{/literal}