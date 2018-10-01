<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод заголовка
*////////////////////////////////////////////////////////////////////////////////////////////
class Caption extends News {
	
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
			$id					= $this->gets['id'];
			$query				= "SELECT t.caption FROM `{$this->tablePrefix}data` AS `t` WHERE t.enable=1 AND t.id='$id'";
			$result				= $this->mysql->executeSQL($query);
			$data				= $this->mysql->fetchAssoc($result);
			$this->contentOUT	= $data['caption'];
		}
		else {
			$this->contentOUT	= $this->settings['caption_default'];
		}
	}



}

?>