<?php

/*///////////////////////////////////////////////////////////////////////////////////////////
Категории в меню
*////////////////////////////////////////////////////////////////////////////////////////////
class CategoriesInMenu extends InternetShop {


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

		//берем все активные категории магазина
		$all_tree_records 	= array();
		$ids				= array();
		$query 				= "SELECT t.id, t.caption, t.parent_id FROM `{$this->tablePrefix}categories` AS `t` WHERE t.active=1 ORDER BY t.sort_index DESC";
		$result				= $this->mysql->executeSQL($query);
		while ($row			= $this->mysql->fetchAssoc($result)) {
			$all_tree_records['id'.$row['id']] 	= $row;
			$ids[]			= $row['id'];
		}

		if (count($ids)>0) {
			$ids				= implode(',', $ids);
			$counts				= array();
			$query 				= "SELECT `category_id`, count(*) AS `count` FROM `{$this->tablePrefix}products` WHERE `active`=1 AND `category_id` IN ($ids) GROUP BY `category_id`";
			$result				= $this->mysql->executeSQL($query);
			while ($row			= $this->mysql->fetchAssoc($result)) {
				$counts[$row['category_id']]		= $row['count'];
			}
		}
		else {
			$counts				= array();
		}
		//делаем правильную последовательность, чтоб легче было в шаблоне построить дерево
		$categories 		= $FRAME_FUNCTIONS->makeTree($all_tree_records, 'id', 'caption', 'parent_id',   0, -1);

		foreach ($categories as $key=>$val) {
			if (isset($counts[$val['id']])) {
				$categories[$key]['products_in_category']=$counts[$val['id']];
			}
		}

		//если выбрана категория, тогда определяем родительскую категорию и открываем подменю
		if (isset($this->gets['category_id'])) {
			$selected_category_id			= $this->gets['category_id'];
			$parent_id						= $selected_category_id;
			while ($parent_id>0) {
				$query 						= "SELECT t.id, t.parent_id FROM `{$this->tablePrefix}categories` AS `t` WHERE t.id='$parent_id'";
				$result						= $this->mysql->executeSQL($query);
				$row						= $this->mysql->fetchAssoc($result);
				$parent_id					= $row['parent_id'];
				$selected_category_id		= $row['id'];
			}
		}
		else {
			$selected_category_id=false;
		}

		$this->smarty->assign('selected_category_id', 		$selected_category_id);
		$this->smarty->assign('categories', 				$categories);
		$this->smarty->assign('categories_table_name', 		$this->tablePrefix.'categories');
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_list.tpl');
	}



}

?>