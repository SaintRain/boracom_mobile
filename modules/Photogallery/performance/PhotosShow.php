<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод фотогалереи
*////////////////////////////////////////////////////////////////////////////////////////////
class PhotosShow extends Photogallery {

	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {
		
		//вызываем функцию - обработчик
		switch ($this->action):
		case ('more'):		$this->more(); 		break;
		default:			$this->START(); 	break;
		endswitch;
	}



	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $MYSQL_TABLE3;

		$query			= "SELECT m.*FROM `{$this->tablePrefix}data` as `m`  ORDER BY m.sort_index DESC";
		$result			=  $this->mysql->executeSQL($query);
		$datalist		=  $this->mysql->fetchAssocAll($result);

		$this->smarty->assign('table_name', 			$this->tablePrefix.'data');
		$this->smarty->assign('datalist', 				$datalist);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_categories.tpl');

	}

	
	
	/**
	 * Вывод подробного описания
	 *
	 */
	function more() {
				
		$query				= "SELECT m.* FROM `{$this->tablePrefix}data` as `m`  WHERE m.id='{$this->get['id']}'";
		$result				= $this->mysql->executeSQL($query);
		$category			= $this->mysql->fetchAssoc($result);
		$category['images']	= eval($category['images']);
		
		$width				= round((100/$this->settings['records_for_row'])-2);

		$this->smarty->assign('table_name', 	$this->tablePrefix.'data');
		$this->smarty->assign('settings', 		$this->settings);
		$this->smarty->assign('category', 		$category);
		$this->smarty->assign('width', 			$width);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_list.tpl');
	}



}

?>