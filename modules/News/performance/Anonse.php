<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод анонса
*////////////////////////////////////////////////////////////////////////////////////////////
class Anonse extends News {

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

        //берём текущую дату
        $now        = gmdate('Y-m-d H:i:s');
        $query      = "SELECT t.id, t.caption, t.short_text, LEFT(t.full_text, 1) AS `full_text`, t.datetime FROM `{$this->tablePrefix}data` AS `t` WHERE t.enable=1 AND IF (t.delayed_publication=1 AND t.datetime_start<t.datetime_end, IF ('$now' BETWEEN t.datetime_start AND t.datetime_end,1,0)=1,1)=1 ORDER BY t.sort_index DESC LIMIT {$this->settings['records_in_anonse']}";
		$result		= $this->mysql->executeSQL($query);
		$records	= $this->mysql->fetchAssocAll($result);

		//формируем правильное время для пользователя
		$date_format			= $this->settings['date_format'];
		
		foreach ($records as $key=>$value) {
			$records[$key]['datetime'] = $FRAME_FUNCTIONS->userDateTime($value['datetime'], SETTINGS_TIMEZONE, $date_format);
		}

		$this->smarty->assign('table_name', 	$this->tablePrefix.'data');
		$this->smarty->assign('pageInfo', 		$this->pageInfo);
		$this->smarty->assign('act_variable', 	$this->act_variable);
		$this->smarty->assign('records', 		$records);
		$this->smarty->assign('settings', 		$this->settings);
		$this->smarty->assign('moduleInfo', 	$this->moduleInfo);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'anonse_list.tpl');
	}



}

?>