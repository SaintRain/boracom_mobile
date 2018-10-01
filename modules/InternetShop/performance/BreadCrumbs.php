<?php

/*///////////////////////////////////////////////////////////////////////////////////////////
Хлебные крошки
*////////////////////////////////////////////////////////////////////////////////////////////
class BreadCrumbs extends InternetShop {

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

		//если выбрана категория, тогда определяем родительскую категорию и открываем подменю
		if (isset($this->gets['category_id'])) {
			$selected_category_id			= $this->gets['category_id'];
			$parent_id						= $selected_category_id;
			$cats							= array();
			while ($parent_id>0) {
				$query 						= "SELECT t.id, t.parent_id, t.caption FROM `{$this->tablePrefix}categories` AS `t` WHERE t.id='$parent_id'";
				$result						= $this->mysql->executeSQL($query);
				$row						= $this->mysql->fetchAssoc($result);
				$parent_id					= $row['parent_id'];
				$selected_category_id		= $row['id'];
				$cats[]				= $row;
			}
			for ($i=count($cats)-1; $i>-1; $i--) {
				$categories[]=$cats[$i];
			}
		}
		else {
			$categories						= array();
		}
		
		if (isset($this->gets['id'])) {
			$query 						= "SELECT t.id,  t.caption FROM `{$this->tablePrefix}products` AS `t` WHERE t.id='{$this->gets['id']}'";
			$result						= $this->mysql->executeSQL($query);
			if ($product				= $this->mysql->fetchAssoc($result)) {
				$categories[]			= $product;
			}
		}		

		$this->smarty->assign('categories', 				$categories);
		$this->smarty->assign('categories_table_name', 		$this->tablePrefix.'categories');
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_list.tpl');
	}

}

?>