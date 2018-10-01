<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Мета - описание
*////////////////////////////////////////////////////////////////////////////////////////////
class Metadescription extends News {

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
		if (isset($this->gets['id'])) {
			$id						= $this->gets['id'];
			$query					= "SELECT t.metadescription FROM `{$this->tablePrefix}data` AS `t` WHERE t.enable=1 AND t.id='$id'";
			$result					= $this->mysql->executeSQL($query);
			$data					= $this->mysql->fetchAssoc($result);
			$this->contentOUT		= $data['metadescription'];
		}
		else {
			$this->contentOUT		= $this->settings['metadescription'];
		}		
	}



}

?>