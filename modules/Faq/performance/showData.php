<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод вопросов
*////////////////////////////////////////////////////////////////////////////////////////////
class showData extends Faq {

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
		
		if (isset($this->gets['category_id'])) {
			$cat_id		= $this->gets['category_id'];
		}
		else {
			$cat_id		= false;
		}
		
		
		//берём список категорий
		$query		= "SELECT t.* FROM `{$this->tablePrefix}categories` as `t` ORDER BY `sort_index` DESC";
		$result		= $this->mysql->executeSQL($query);
		$cats		= $this->mysql->fetchAssocAll($result);		
		
		if (!$cat_id && isset($cats[0]['id'])) {
			$cat_id	= $cats[0]['id'];
			}

		if (isset($this->gets['page'])) {
			$_SESSION['faq_page']	= $this->gets['page'];
			}
		
		$api					= $this->getApiObject($this->tablePrefix.'data');
		$query					= "SELECT t.id, t.category_id, t.author, t.question, t.datetime, left(t.answer, 1) AS `answer` FROM `{$this->tablePrefix}data` AS `t` WHERE t.enable=1 AND t.category_id='$cat_id' ORDER BY t.sort_index DESC";
		list($records, $pages)	= $api->dataGet($query,  $this->settings['records_for_page'], 'page');


		//формируем правильное время для пользователя
		$date_format			= $this->settings['date_format'];
		foreach ($records as $key=>$value) {
			$records[$key]['datetime'] = $FRAME_FUNCTIONS->userDateTime($value['datetime'], SETTINGS_TIMEZONE, $date_format);
			}			
		
		$this->smarty->assign('table_name', 		$this->tablePrefix.'data');
		$this->smarty->assign('moduleInfo', 		$this->moduleInfo);
		$this->smarty->assign('pageInfo', 			$this->pageInfo);
		$this->smarty->assign('act_variable', 		$this->act_variable);
		$this->smarty->assign('pageRecords', 		$pages);
		$this->smarty->assign('records', 			$records);
		$this->smarty->assign('cats', 				$cats);
		$this->smarty->assign('settings', 			$this->settings);
		$this->smarty->assign('cat_id', 			$cat_id);
		$this->smarty->assign('errors', 			$this->errors);
		$this->smarty->assign('form_template',		$this->tplLocation.'form.tpl');
		
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_list.tpl');
	}

	
	
	/**
	 * Вывод подробного описания
	 *
	 */
	function more() {
		GLOBAL $FRAME_FUNCTIONS;

		if (isset($this->gets['category_id'])) {
			$cat_id		= $this->gets['category_id'];
		}
		else {
			$cat_id		= false;
		}		
				
		$query				= "SELECT t.* FROM `{$this->tablePrefix}data` AS `t` WHERE t.id='{$this->gets['id']}'";
		$result				= $this->mysql->executeSQL($query);
		$record				= $this->mysql->fetchAssoc($result);

		$date_format		= $this->settings['date_format'];
		$record['datetime'] = $FRAME_FUNCTIONS->userDateTime($record['datetime'], SETTINGS_TIMEZONE, $date_format);

		//берём список категорий
		$query		= "SELECT t.* FROM `{$this->tablePrefix}categories` as `t` ORDER BY `sort_index`";
		$result		= $this->mysql->executeSQL($query);
		$cats		= $this->mysql->fetchAssocAll($result);		
		
		$this->smarty->assign('table_name', 			$this->tablePrefix.'data');
		$this->smarty->assign('moduleInfo', 			$this->moduleInfo);
		$this->smarty->assign('errors', 				$this->errors);
		$this->smarty->assign('pageInfo', 				$this->pageInfo);
		$this->smarty->assign('act_variable', 			$this->act_variable);
		$this->smarty->assign('record', 				$record);
		$this->smarty->assign('cats', 					$cats);
		$this->smarty->assign('cat_id', 				$cat_id);
		$this->smarty->assign('settings', 				$this->settings);
		$this->smarty->assign('errors', 				$this->errors);
		$this->smarty->assign('form_template',			$this->tplLocation.'form.tpl');
		
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_more.tpl');
	}

	

	/**
	 * добавление вопроса
	 *
	 */
	function insert_comments() {
		GLOBAL $FRAME_FUNCTIONS;
		
		if($this->settings['kcaptcha']==1) {
			if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $this->post['kcaptcha']) {
			}
			else{
				$this->errors[]		= 'Не верно введен код с изображения!';
			}
		}
		if (count($this->errors)==0) {		
			 
			$posts						= $this->posts;
			$posts['enable']			= 0;
			$posts['translit']			= $FRAME_FUNCTIONS->convertKirilToLatin($posts['question']);
			$api						= $this->getApiObject($this->tablePrefix.'data', $posts);
			$api->dataInsert();
			$this->errors				= $api->errors;
		}

		if (count($this->errors)>0) {
			foreach ($this->posts as $key=>$value) {
				$this->smarty->assign($key, $value);
			}
		}
		else {									
			//делаем отправку уведомления администратору			
			$this->smarty->assign('settings', $this->settings);
			$this->smarty->assign('user_text', $this->post['question']);
			$body	= $this->smarty->fetch($this->tplLocation.'message_to_admin.tpl');
			$mail	= $FRAME_FUNCTIONS->getMailObject($this->settings['sendEmailTo'], $this->settings['usernameEmailCaption'], $this->posts['email'], $this->posts['author'], $this->settings['mailSubject'], $body);		
			$res	= $mail->send(); 	
					
			$this->smarty->assign('comment_is_added', true);
			
		}
		
	if (isset($this->gets['id'])) {
		$this->more();
		}
	else {
		$this->START();
		}
	}



}

?>