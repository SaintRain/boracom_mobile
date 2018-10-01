<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Результат поиска
*////////////////////////////////////////////////////////////////////////////////////////////
class SearchResult extends Search {

	public $search_text;
	
	
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
		GLOBAL $FRAME_FUNCTIONS, $FILE_MANAGER, $MYSQL_TABLE3, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE7, $MYSQL_TABLE10, $MYSQL_TABLE11, $MYSQL_TABLE17, $MYSQL_TABLE18;

		if (isset($this->gets['search_text']) && $this->gets['search_text']!='') {

			$this->search_text	= $FRAME_FUNCTIONS->stripTagsFromObject(urldecode($this->get['search_text']));
			$find_text			= array();

			//берем все настройки поиска
			$query			= "SELECT s.block_id, s.value, b.act_variable, m.name AS `module_name`FROM `$MYSQL_TABLE7` AS `s`
			LEFT JOIN `$MYSQL_TABLE6` AS `b` ON (b.id=s.block_id) 
			LEFT JOIN `$MYSQL_TABLE5` AS `m` ON (m.id=b.module_id)		
			WHERE s.name LIKE 'SearchSettings%' AND m.name!=''";
			$result			= $this->mysql->executeSQL($query);
			$SearchSettings	= $this->mysql->fetchAssocAll($result);

			if (count($SearchSettings)>0) {

				$pagesInfoAll		= array();
				foreach ($SearchSettings as $s) {

					$query				= "SELECT p.templates_id, p.name AS `page_name`, p.description AS `page_description`, t.virtualtemplate_id, t.block_id FROM `$MYSQL_TABLE3` AS `p`
					LEFT JOIN `$MYSQL_TABLE11` AS `t` ON (t.block_id='{$s['block_id']}')
					WHERE p.enable='1' AND p.templates_id=t.virtualtemplate_id GROUP BY p.id";

					$result								= $this->mysql->executeSQL($query);
					$pagesInfoAll[$s['block_id']]		= $this->mysql->fetchAssoc($result);
				}
			}
			
			foreach ($SearchSettings as $ss) {

				//из строки создаём массив
				$searches	= $this->getSearchArray($ss['value']);

				foreach ($searches as $t_no_prefix => $search) {

					if (isset($search['sql']) && $search['sql']!='') {
						
						$profile['`'.strtolower($this->moduleInfo['module_name']).'_']			= '`'.strtolower($ss['module_name']).'_';

						//берём записи
						$query			= $this->setSQL($profile, $search['sql']);
						$result			= $this->mysql->executeSQL($query);
						$records		= $this->mysql->fetchAssocAll($result);

						//определяем страницы
						if (count($records)>0 && isset($pagesInfoAll[$ss['block_id']])) {
							$pageInfo		= $pagesInfoAll[$ss['block_id']];

							foreach ($records as $r)	{

								$url		= $this->setURL($r, $search['url']);
								$page_name	= $pageInfo['page_name'].$url;

								$text		= '';
								foreach ($r as $k=>$t)	{
									if ($k!='id' && !is_numeric($t)) {
										$text.=$t.' ';
									}
								}
								$find_text	= $this->findTextFromPage($text, $this->search_text, $find_text, $page_name, $pageInfo['page_description'], $r);
							}
						}
					}
				}
			}

			$page_number_name	= 'page';
			$limit				= $this->settings['recordsPerPage'];

			if (!isset($this->gets[$page_number_name])) {
				$page_number				= 1;
			}
			else $page_number				= $this->gets[$page_number_name];

			if ($limit!=NULL) {
				$start_limit				= ($page_number-1)*$limit;
				if ($start_limit<0) {
					$start_limit			= 0;
				}
			}

			$records_count					= count($find_text);
			if ($limit!=NULL) {
				$total_pages				= ceil($records_count/$limit);
			}
			else {
				$total_pages				= 0;
			}

			$pageRecords['page_selected']	= $page_number;
			$pageRecords['page_count']		= $total_pages;
			$pageRecords['records_count']	= $records_count;

			$find_text = array_slice($find_text, 		$start_limit, $limit);
			
			$this->smarty->assign('search_text',   		$this->search_text);
			$this->smarty->assign('find_text_count', 	$records_count);
			$this->smarty->assign('find_text', 			$find_text);
			$this->smarty->assign('pages', 				$pageRecords);
			$this->smarty->assign('settings', 			$this->settings);
		}

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'result_list.tpl');
	}

	
	
	function setSQL($record, $url_format) {
		$fields=array();
		$values=array();

		foreach ($record as $key=>$value) {
			$fields[]	= $key;
			$values[]	= $value;
		}

		$url_format	= str_replace($fields, $values,  $url_format);
		return $url_format;
	}
	
	

	function setURL($record, $url_format) {
		$fields=array();
		$values=array();

		foreach ($record as $key=>$value) {
			$fields[]	= '{$'.$key.'}';
			$values[]	= $value;
		}

		$url_format	= str_replace($fields, $values,  $url_format);
		return $url_format;
	}

	
	
	/**
	 * Из строки создаёт массив
	 *
	 * @param string $str
	 * @return array
	 */
	function getSearchArray($str) {
		eval('$masiv='.$str);

		return $masiv;
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
	function findTextFromPage($document, $search_text, $find_text, $page_name, $page_description, $r) {
		GLOBAL $FRAME_FUNCTIONS;
		$pk_id		= $r['id'];
		$out 		= $FRAME_FUNCTIONS->strip_tags_smart($document);

		if ($find	= $this->select_finded_text($out, $search_text, $this->settings['strip'])) {

			$temp						= $r;//назначаем найдненную строку
			
			//добавляем поля
			$temp['founded_page_description']	= $page_description;
			$temp['founded_url']				= $page_name;
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

			$text	=	mb_substr($sourse, $start, $end);

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