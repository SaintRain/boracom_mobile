<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Title - заголовок
*////////////////////////////////////////////////////////////////////////////////////////////
class Title extends News {

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
		GLOBAL $FRAME_FUNCTIONS, $FILE_MANAGER;

		if (isset($this->gets['id'])) {
			$id					= $this->gets['id'];
			$query				= "SELECT t.title FROM `{$this->tablePrefix}data` AS `t`  WHERE t.enable=1 AND t.id='$id'";
			$result				= $this->mysql->executeSQL($query);
			$data				= $this->mysql->fetchAssoc($result);
			$this->contentOUT	= $data['title'];
		}
		else {
			$this->contentOUT	= $this->settings['title'];
		}
	}



}

?>