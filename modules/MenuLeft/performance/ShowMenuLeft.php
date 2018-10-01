<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Меню
*////////////////////////////////////////////////////////////////////////////////////////////
class ShowMenuLeft extends MenuLeft {

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
		GLOBAL $MYSQL_TABLE3, $FRAME_FUNCTIONS;

		$query		= "SELECT m.*, $MYSQL_TABLE3.name FROM `{$this->tablePrefix}data` as `m`  LEFT JOIN (`$MYSQL_TABLE3`) ON (m.pageid=$MYSQL_TABLE3.id) ORDER BY m.sort_index DESC";
		$result		= $this->mysql->executeSQL($query);
		$menuItems	= $this->mysql->fetchAssocAll($result);

		for ($i=0; $i<count($menuItems); $i++) {
			if ($menuItems[$i]['name']==$this->pageInfo['name']) {
				$menuItems[$i]['selected']=true;
				break;
			}
		}


		$menuItems = $FRAME_FUNCTIONS->makeTree($menuItems, 'id', 'name', 'parent_id',0,-1);

		$this->smarty->assign('menuItems', 		$menuItems);
		$this->smarty->assign('table_name', 	$this->tablePrefix.'data');
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'menu.tpl');
	}

}

?>