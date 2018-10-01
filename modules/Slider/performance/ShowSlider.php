<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Слайдер
*////////////////////////////////////////////////////////////////////////////////////////////
class ShowSlider extends Slider {
	
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

		GLOBAL $MYSQL_TABLE3, $FRAME_FUNCTIONS;

		$query		= "SELECT * FROM `{$this->tablePrefix}data` ORDER BY sort_index DESC";
		$result		= $this->mysql->executeSQL($query);
		$data	= $this->mysql->fetchAssocAll($result);

      
		$this->smarty->assign('data', $data);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'slider.tpl');
	}



}

?>