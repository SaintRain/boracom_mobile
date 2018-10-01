<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Выгрузка RSS
*////////////////////////////////////////////////////////////////////////////////////////////
class RSS extends News {

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

		header('Content-type: application/xml');

		$query		= "SELECT * FROM `{$this->tablePrefix}data` AS `t` WHERE t.enable=1 AND t.rss='1' ORDER BY t.sort_index DESC";
		$result		= $this->mysql->executeSQL($query);
		$records	= $this->mysql->fetchAssocAll($result);

		foreach ($records as $k=>$v) {
			$v['short_text']			= preg_replace('/&(.*?);/i', '', $v['short_text']);
			$records[$k]['short_text']	= strip_tags($v['short_text']);
			$dateTime 					= $FRAME_FUNCTIONS->userDateTime($v['datetime'], SETTINGS_TIMEZONE, 'Y-m-d H:i:s');
		}

		$this->smarty->assign('date', 		gmdate('r'));
		$this->smarty->assign('records', 	$records);

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_rss.tpl');
	}



}

?>