<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Выгрузка RSS
*////////////////////////////////////////////////////////////////////////////////////////////
class RSS extends Faq {

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

		$query		= "SELECT t.*, t2.translit AS `cat_translit` FROM `{$this->tablePrefix}data` AS `t` 
		LEFT JOIN `{$this->tablePrefix}categories` AS `t2` ON (t2.id=t.category_id)
		WHERE t.enable=1 AND t.rss='1' ORDER BY t.sort_index DESC";
		$result		= $this->mysql->executeSQL($query);
		$records	= $this->mysql->fetchAssocAll($result);

		foreach ($records as $k=>$v) {
			$v['answer']				= preg_replace('/&(.*?);/i', '', $v['answer']);
			$records[$k]['answer']		= strip_tags($v['answer']);
			
			$v['question']				= preg_replace('/&(.*?);/i', '', $v['question']);
			$records[$k]['question']	= strip_tags($v['question']);
			
			$dateTime 					= $FRAME_FUNCTIONS->userDateTime($v['datetime'], SETTINGS_TIMEZONE, 'Y-m-d H:i:s');
		}

		$this->smarty->assign('date', 		gmdate('r'));
		$this->smarty->assign('records', 	$records);

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_rss.tpl');
	}



}

?>