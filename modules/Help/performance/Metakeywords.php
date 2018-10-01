<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод metakeywords
*////////////////////////////////////////////////////////////////////////////////////////////
class Metakeywords extends Help {
	
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

		if (isset($this->gets['id'])) {
			$query 					= "SELECT t.metakeywords FROM `{$this->tablePrefix}data` AS `t` WHERE t.id='{$this->gets['id']}'";
			$result					= $this->mysql->executeSQL($query);
			list($this->contentOUT)	= $this->mysql->fetchRow($result);
		}
		else {
			$this->contentOUT=$this->settings['metakeywords'];
		}
	}



}

?>