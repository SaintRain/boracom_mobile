<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод справки
*////////////////////////////////////////////////////////////////////////////////////////////
class ShowHelp extends Help {

	public $search_text;	//искомый текст
	
	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {

		//вызываем функцию - обработчик
		switch ($this->action):
		default:						$this->START(); 	break;
		endswitch;
	}



	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS;

		$query				= "SELECT `id`, `caption`, `parent_id`, left(`description`, 1) AS `description` FROM `{$this->tablePrefix}data` WHERE `enable`='1' ORDER BY `sort_index` DESC";
		$result				= $this->mysql->executeSQL($query);
		$categories			= $this->mysql->fetchAssocAll($result);

		//получаем текущую запись
		if (isset($this->gets['id'])) {
			$query				= "SELECT * FROM `{$this->tablePrefix}data` WHERE `enable`='1' AND `id`='{$this->gets['id']}'";
			$result				= $this->mysql->executeSQL($query);
			$view_data			= $this->mysql->fetchAssoc($result);
			$id					= $this->gets['id'];
		}
		else {
			$view_data			= array();
			$id					= false;
		}

		//делаем правильную последовательность, чтоб легче было в шаблоне построить дерево
		$categories 		= $FRAME_FUNCTIONS->makeTree($categories, 'id', 'caption', 'parent_id',   0, -1);

		foreach ($categories as $k=>$v) {
			foreach ($categories as $k2=>$v2) {
				if ($v['id']==$v2['parent_id']) {
					$categories[$k]['folder']=true;
					break;
				}
			}
		}

		//если произведен поиск
		if (isset($this->gets['search_text'])) {
			$this->search_text=$this->gets['search_text'];
			$found_data	= $this->find();
		}
		else {
			$found_data	= false;
		}		

		$this->smarty->assign('categories', 		$categories);
		$this->smarty->assign('found_data', 		$found_data);
		$this->smarty->assign('view_data',		 	$view_data);
		$this->smarty->assign('id', 				$id);
		$this->smarty->assign('tablename', 			$this->tablePrefix.'data');		

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_list.tpl');
	}


	
	/**
	 * Поиск по справке
	 *
	 * @return text
	 */
	function find() {
		$find_text			= array();
		$query				= "SELECT * FROM `{$this->tablePrefix}data` WHERE (`caption` LIKE '%{$this->search_text}%' OR `description` LIKE '%{$this->search_text}%') AND `enable`='1' ORDER BY `sort_index` DESC";
		$result				= $this->mysql->executeSQL($query);
		while ($row			= $this->mysql->fetchAssoc($result)) {
			$text			= $row['caption'].' '.$row['description'];
			$find_text		= $this->findTextFromPage($text, $this->search_text, $find_text, $this->pageInfo['name'], $row);
		}

		//определяем на какую страницу следует перейти
		$page_number_name	= 'page';
		$limit				= $this->settings['recordsPerPage'];

		if (!isset($this->gets[$page_number_name])) {
			$page_number	= 1;
		}
		else $page_number	= $this->gets[$page_number_name];

		if ($limit!=NULL) {
			$start_limit	= ($page_number-1)*$limit;
			if ($start_limit<0) {
				$start_limit= 0;
			}
		}

		$records_count		= count($find_text);
		if ($limit!=NULL) {
			$total_pages	= ceil($records_count/$limit);
		}
		else {
			$total_pages	= 0;
		}

		$pageRecords['page_selected']	= $page_number;
		$pageRecords['page_count']		= $total_pages;
		$pageRecords['records_count']	= $records_count;

		//выводим только одну страницу
		$find_text = array_slice($find_text, 		$start_limit, $limit);

		$this->smarty->assign('search_text',   		$FRAME_FUNCTIONS->stripTagsFromObject(urldecode($this->search_text)));
		$this->smarty->assign('find_text_count', 	count($find_text));
		$this->smarty->assign('find_text', 			$find_text);
		$this->smarty->assign('pages', 				$pageRecords);
		$this->smarty->assign('settings', 			$this->settings);

		$contentOut			= $this->smarty->fetch($this->tplLocation.'show_founded.tpl');

		return $contentOut;
	}


	
	/**
	 * Ищет текст
	 *
	 * @param text $document
	 * @param string $search_text
	 * @param string $find_text
	 * @param string $page_name
	 * @param string $page_description
	 * @param array $r
	 * @return string
	 */
	function findTextFromPage($document, $search_text, $find_text, $page_name,  $r) {
		GLOBAL $FRAME_FUNCTIONS;
		$pk_id		= $r['id'];
		$out 		= $FRAME_FUNCTIONS->strip_tags_smart($document);

		if ($find	= $this->select_finded_text($out, $search_text, $this->settings['strip'])) {

			$temp								= $r;//назначаем найдненную строку

			//добавляем поля
			$temp['founded_text']				= $find;
			$find_text[]						= $temp;
		}
		return $find_text;
	}



	/**
     * Выделяет найденный текст
     *
     * @param string $sourse
     * @param string $find_text
     * @param string $select_size
     * @return string
     */
	function select_finded_text($sourse, $find_text, $select_size) {

		if ($this->settings['register']) $pos	= mb_strpos($sourse, $find_text);
		else {
			$pos=mb_stripos($sourse, $find_text);
		}

		if  (($pos-$select_size)<0) {
			$start	= 0;
			$left	= '';
		}
		else {
			$start	= $pos-$select_size;
			$left	= '...';
		}

		if  (((2*$select_size)+mb_strlen($find_text))>mb_strlen($sourse)) {
			$end	= mb_strlen($sourse);
			$right	= '';
		}
		else {
			$end	= (2*$select_size)+mb_strlen($find_text);
			$right	= '...';
		}

		if ($pos!==false) {

			$text		=	mb_substr($sourse, $start, $end);

			if ($this->settings['register']) $text	= str_replace($find_text, '<b>'.$find_text.'</b>', $text);
			else {
				$pos 	= mb_stripos($text, $find_text);
				$str1	= mb_substr($text, 0 , $pos);
				$str2	= mb_substr($text, $pos, mb_strlen($find_text));
				$str3	= mb_substr($text, $pos+mb_strlen($find_text));
				$text	= $str1.'<b class="highlight">'.$str2.'</b>'.$str3;
			}
			$text	=	$left.$text.$right;
			return  $text;
		}
		else {
			return false;
		}

	}

}

?>