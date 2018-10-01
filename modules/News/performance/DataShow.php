<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод новостей
*////////////////////////////////////////////////////////////////////////////////////////////
class DataShow extends News {

	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {

		//вызываем функцию - обработчик
		switch ($this->action):
		case ('insert_comments'):	$this->insert_comments(); 		break;
		case ('more'):				$this->more(); 					break;
		default:					$this->START(); 				break;
		endswitch;
	}



	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS, $FILE_MANAGER;

		$api					= $this->getApiObject($this->tablePrefix.'data');
		$query					= "SELECT t.id, t.caption, t.short_text, left(t.full_text, 1) AS `full_text`, t.datetime FROM `{$this->tablePrefix}data` AS `t` WHERE t.enable=1 ORDER BY t.sort_index DESC";
		list($records, $pages)	= $api->dataGet($query,  $this->settings['records_for_page'], 'page');

		//формируем правильное время для пользователя
		$date_format			= $this->settings['date_format'];
		foreach ($records as $key=>$value) {
			$records[$key]['datetime'] = $FRAME_FUNCTIONS->userDateTime($value['datetime'], SETTINGS_TIMEZONE, $date_format);
		}

		
		$this->smarty->assign('table_name', 	$this->tablePrefix.'data');
		$this->smarty->assign('pageInfo', 		$this->pageInfo);
		$this->smarty->assign('act_variable', 	$this->act_variable);
		$this->smarty->assign('pageRecords', 	$pages);
		$this->smarty->assign('records', 		$records);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_list.tpl');
	}

	
	
	/**
	 * Вывод подробного описания
	 *
	 */
	function more() {
		GLOBAL $FRAME_FUNCTIONS;

		$query				= "SELECT t.* FROM `{$this->tablePrefix}data` AS `t` WHERE t.id='{$this->gets['id']}'";
		$result				= $this->mysql->executeSQL($query);
		$record				= $this->mysql->fetchAssoc($result);

		$date_format		= $this->settings['date_format'];
		
		$record['datetime'] = $FRAME_FUNCTIONS->userDateTime($record['datetime'], SETTINGS_TIMEZONE, $date_format);

		if ($this->settings['show_comments']) {
			$api					= $this->getApiObject($this->tablePrefix.'comments');
			$query					= "SELECT t.* FROM `{$this->tablePrefix}comments` AS `t` WHERE t.news_id='{$this->gets['id']}' AND t.enable=1 ORDER BY t.sort_index";
			list($comments_records, $comments_pages)	= $api->dataGet($query, $this->settings['records_for_page'], 'page');

			//формируем правильное время для пользователя
			$date_format			= $this->settings['date_format_comments'];
			foreach ($comments_records as $key=>$value) {
				$comments_records[$key]['datetime'] = $FRAME_FUNCTIONS->userDateTime($value['datetime'], SETTINGS_TIMEZONE, $date_format);
			}

			$this->smarty->assign('comments_records', 	$comments_records);
			$this->smarty->assign('comments_pages', 	$comments_pages);
		}

		$this->smarty->assign('table_name', 			$this->tablePrefix.'data');
		$this->smarty->assign('table_name_comments', 	$this->tablePrefix.'comments');

		$this->smarty->assign('moduleInfo', 			$this->moduleInfo);
		$this->smarty->assign('errors', 				$this->errors);
		$this->smarty->assign('pageInfo', 				$this->pageInfo);
		$this->smarty->assign('act_variable', 			$this->act_variable);
		$this->smarty->assign('record', 				$record);
		$this->smarty->assign('settings', 				$this->settings);

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_more.tpl');
	}

	

	/**
	 * добавление комментария
	 *
	 */
	function insert_comments() {

		if($this->settings['kcaptcha']==1) {
			if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $this->post['kcaptcha']) {
			}
			else{
				$this->errors[]	= 'Не верно введены цифры с изображения!';
			}
		}
		if (count($this->errors)==0)			 {
			$api					= $this->getApiObject($this->tablePrefix.'comments', $this->posts);
			$api->dataInsert();
			$this->errors			= $api->errors;
		}

		if (count($this->errors)>0) {
			foreach ($this->post as $key=>$value) {
				$this->smarty->assign($key, $value);
			}
		}
		else {

			$this->smarty->assign('comment_is_added', true);
		}

		$this->more();
	}



}

?>