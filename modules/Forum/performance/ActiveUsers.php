<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Сейчас на форуме
*////////////////////////////////////////////////////////////////////////////////////////////
class ActiveUsers extends Forum {
	
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
		
		//берём активных пользователей
		$date_time		= $FRAME_FUNCTIONS->userDateTime(gmdate('Y-m-d H:i:s'), -0.2, 'Y-m-d H:i:s');		
		$query			= "SELECT t.* FROM `{$this->tablePrefix}users` AS `t` WHERE t.enable='1' AND t.last_activity>'$date_time' ORDER BY t.sort_index DESC";
		$result			= $this->mysql->executeSQL($query);
		$active_users	= $this->mysql->fetchAssocAll($result);		
		
		
		$this->smarty->assign('table_name', $this->tablePrefix.'users');
		$this->smarty->assign('active_users', $active_users);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_list.tpl');
	}



}

?>