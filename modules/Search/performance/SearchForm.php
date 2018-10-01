<?php

/*///////////////////////////////////////////////////////////////////////////////////////////
Форма поиска по сайту
*////////////////////////////////////////////////////////////////////////////////////////////
class SearchForm extends Search {

	
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
		GLOBAL $MYSQL_TABLE3, $MYSQL_TABLE6, $MYSQL_TABLE11;

		if ($this->settings['page_result']=='') {
			//автоматически определяем имя страницы вывода результата поиска
			$query				= "SELECT p.name FROM `$MYSQL_TABLE6` AS `b` LEFT JOIN `$MYSQL_TABLE11` AS `v` ON (v.block_id=b.id) LEFT JOIN `$MYSQL_TABLE3` AS `p` ON (p.templates_id=v.virtualtemplate_id) WHERE b.name='SearchResult'";
			$result				= $this->mysql->executeSQL($query);
			list($page_result)	= $this->mysql->fetchRow($result);
		}
		else {
			$page_result		= $this->settings['page_result'];
		}


		$this->smarty->assign('page_result', $page_result);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'search_form.tpl');
		
	}



}

?>