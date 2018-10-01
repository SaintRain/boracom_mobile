<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод хлебных крошек
*////////////////////////////////////////////////////////////////////////////////////////////
class ShowBreadCrumbs extends BreadCrumbs {
	
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
		$this->smarty->assign('pageInfo', $this->pageInfo);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_list.tpl');
	}



}

?>