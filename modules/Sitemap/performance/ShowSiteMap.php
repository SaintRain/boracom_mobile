<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Карта сайта
*////////////////////////////////////////////////////////////////////////////////////////////
class ShowSiteMap extends Sitemap {

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
		GLOBAL $MYSQL_TABLE3, $MYSQL_TABLE8;


		//берём запрещенные адреса
		$b_urls				= array();
		$query 				= "SELECT `url` FROM `{$this->tablePrefix}data` WHERE `enable`='1'";
		$result 			= $this->mysql->executeSQL($query);
		while ($bad_urls	= $this->mysql->fetchAssoc($result)) {
			$b_urls[]		= str_replace('/', '', "'{$bad_urls['url']}'");
		}

		$badPages			= array();
		if (count($b_urls)>0) {
			$b_urls			= implode(',', $b_urls);
			$sql_part		= "AND t.name IN ($b_urls)";
			//берём страницы, которые не следует выводить в карту
			$query 			= "SELECT t.name FROM  `$MYSQL_TABLE3` AS `t` WHERE t.enable=1 $sql_part";
			$result 		= $this->mysql->executeSQL($query);
			while ($row		= $this->mysql->fetchAssoc($result)) {
				$badPages[]	= "'{$row['name']}'";
			}
		}
		else {
			$badPages		= array();
		}

		if (count($badPages)>0)	 {
			$badPages		= implode(',', $badPages);
			$badPages		= "AND `name` NOT IN ($badPages)";
		}
		else {
			$badPages		= '';
		}

		//берем все категории
		$query 			= "SELECT * FROM `$MYSQL_TABLE8`  ORDER BY `sort_index`";
		$result 		= $this->mysql->executeSQL($query);
		$allCats 		= $this->mysql->fetchAssocAll($result);
		$allCats		= $this->makeTree($allCats, 'id', 'parent', 0, -1);

		$categories 	= array();
		foreach ($allCats as $cat) {
			$categories[$cat['id']]=$cat;
		}

		//берем все страницы
		$query 			= "SELECT * FROM `$MYSQL_TABLE3` WHERE `enable`=1 $badPages ORDER BY `sort_index`";
		$result 		= $this->mysql->executeSQL($query);
		$allPages 		= $this->mysql->fetchAssocAll($result);

		foreach ($allPages as $data) {
			if ($data['name']==SETTINGS_INDEX_PAGE) {
				$data['name'] = '';
			}
			$categories[$data['page_category']]['pages'][]	= $data;
		}

		$this->smarty->assign('settings', 		$this->settings);
		$this->smarty->assign('moduleInfo', 	$this->moduleInfo);
		$this->smarty->assign('categories', 	$categories);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_sitemap.tpl');
	}



	/**
	 * Формирует дерево категорй
	 *
	 * @param string $pk_field
	 * @param string $selected_filed
	 * @param string $parent_field
	 * @param int $ParentID
	 * @param int $lvl
	 * @return array
	 */	
	function makeTree($all_tree_records, $pk_field,  $parent_field,   $ParentID, $lvl) {
		$lvl++;
		$tree		=   array();
		foreach ($all_tree_records as $key=>$row) {
			if ($row[$parent_field]==$ParentID) {
				$row['deep']	= $lvl;
				$tree[]			= $row;
				$tmp			= $this->makeTree($all_tree_records, $pk_field, $parent_field,  $row['id'], $lvl);
				if (is_array($tmp)) $tree	= array_merge($tree, $tmp);
			}
		}
		return $tree;
	}



}

?>