<?php

/*///////////////////////////////////////////////////////////////////////////////////////////
Заголовок содержимого
*////////////////////////////////////////////////////////////////////////////////////////////
class Caption extends InternetShop {

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
			$query 				= "SELECT t.caption, t.id FROM `{$this->tablePrefix}products` AS `t` WHERE t.id='{$this->gets['id']}'";
			$table_name			= $this->tablePrefix.'products';
		}
		elseif (isset($this->gets['category_id'])) {
			$query 				= "SELECT t.caption, t.id FROM `{$this->tablePrefix}categories` AS `t` WHERE t.id='{$this->gets['category_id']}'";
			$table_name			= $this->tablePrefix.'categories';
		}

		if (isset($query)) {
			$result					= $this->mysql->executeSQL($query);
			list($out, $id)			= $this->mysql->fetchRow($result);

			$this->smarty->assign('id', 						$id);
			$this->smarty->assign('caption', 					$out);
			$this->smarty->assign('table_name', 				$table_name);
		}
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_caption.tpl');
	}



}

?>