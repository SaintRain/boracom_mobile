<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод форума
*////////////////////////////////////////////////////////////////////////////////////////////
class ForumShow extends Forum {

	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {

		//вызываем функцию - обработчик
		switch ($this->action):
		case ('show_forum_thems'):		$this->show_forum_thems(); 		break;
		case ('show_them_messages'):	$this->show_them_messages(); 	break;
		case ('show_user'):				$this->show_user(); 			break;
		case ('update_message'):		$this->update_message(); 		break;
		case ('delete_message'):		$this->delete_message(); 		break;
		default:						$this->START(); 				break;
		endswitch;

		//обновляем последнюю активность пользователя
		if ($user				= $this->getUserInfo()) {
			$current_datetime	= gmdate('Y-m-d H:i:s');
			$query				= "UPDATE `{$this->tablePrefix}users` SET `last_activity`='$current_datetime' WHERE `id`='{$user['id']}'";
			$result				= $this->mysql->executeSQL($query);
		}
	}



	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS;

		if (isset($this->gets['group_id'])) {
			$where	= "WHERE `id`='{$this->gets['group_id']}'";
		}
		else {
			$where	= '';
		}

		//берём группы
		$query		= "SELECT * FROM `{$this->tablePrefix}fgroups` $where ORDER BY `sort_index` DESC";
		$result		= $this->mysql->executeSQL($query);
		$fgroups	= $this->mysql->fetchAssocAll($result);

		//берём список форумов
		$forum_ids	= array();
		$forums		= array();
		$query		= "SELECT * FROM `{$this->tablePrefix}forums` WHERE active='1' ORDER BY `sort_index` DESC";
		$result		= $this->mysql->executeSQL($query);
		while ($row	= $this->mysql->fetchAssoc($result)) {
			$forums[$row['id']]	= $row;
			$forum_ids[]		= $row['id'];
		}

		//берём количество тем и сообщений
		if (count($forum_ids)>0) {
            $query		= "SELECT t.forum_id, t.id, COUNT(*) AS `them_count` FROM `{$this->tablePrefix}thems` AS `t`  WHERE t.active=1 GROUP BY t.forum_id";
            $result		= $this->mysql->executeSQL($query);
            while ($row	= $this->mysql->fetchAssoc($result)) {
                $forums[$row['forum_id']]['them_count']		= $row['them_count'];
            }

            $query		= "SELECT t2.forum_id, COUNT(*) AS `message_count` FROM `{$this->tablePrefix}messages` AS `t` LEFT JOIN `{$this->tablePrefix}thems` AS `t2` ON (t2.id=t.them_id AND t2.active=1) WHERE t.active=1 GROUP BY t.them_id";
            $result		= $this->mysql->executeSQL($query);
            while ($row	= $this->mysql->fetchAssoc($result)) {
                if (isset($forums[$row['forum_id']]['message_count'])) {
                    $forums[$row['forum_id']]['message_count']+= $row['message_count'];
                }
                else {
                    $forums[$row['forum_id']]['message_count']= $row['message_count'];
                }
            }
		}

		if ($user=$this->getUserInfo()) {
			$UMC	= $user['timezone'];
		}
		else {
			$UMC	= SETTINGS_TIMEZONE;
		}

		//вычитаем 24 часа
		$now	= $FRAME_FUNCTIONS->userDateTime(gmdate('Y-m-d H:i:s'), -24, 'Y-m-d H:i:s');


		foreach ($forums as $key => $forum) {

			$last_message	= array();
			$query			= "SELECT t.datetime as `them_datetime`, t.caption AS `them_caption`, t.id AS `them_id`, t.user_id AS `them_user_id` FROM `{$this->tablePrefix}thems` AS `t` WHERE t.forum_id='{$forum['id']}' AND t.active=1 ORDER BY t.datetime DESC LIMIT 1";
			$result			= $this->mysql->executeSQL($query);
			$last_message 	= $this->mysql->fetchAssoc($result);

			//берём информацию о сообщениях
			$query				= "SELECT t.id, t.datetime, t.user_id FROM `{$this->tablePrefix}messages` AS `t` WHERE t.them_id='{$last_message['them_id']}' AND t.active=1 ORDER BY t.datetime DESC LIMIT 1";
			$result				= $this->mysql->executeSQL($query);
			list($last_message['id'], $last_message['datetime'] , $last_message['user_id']) = $this->mysql->fetchRow($result);
			
			//определяем пользователя
			$user_id			= false;
			if (isset($last_message['them_user_id']) && $last_message['them_user_id']) {
				$user_id		= $last_message['them_user_id'];
			}

			if ($last_message['user_id']) {
				$user_id		= $last_message['user_id'];				
				$query			= "SELECT count(*) FROM `{$this->tablePrefix}messages` AS `t` WHERE t.them_id='{$last_message['them_id']}' AND t.active=1 ORDER BY t.datetime DESC LIMIT 1";
				$result			= $this->mysql->executeSQL($query);				
				list($m_count)	= $this->mysql->fetchRow($result);
				$page			= ceil($m_count/$this->settings['messages_for_page']);
				if ($page>1) {
					$last_message['page'] = $page;
				}
			}

			if ($user_id) {
				//берём информацию о пользователе
				$query						= "SELECT t.nic FROM `{$this->tablePrefix}users` AS `t` WHERE t.id='$user_id'";
				$result						= $this->mysql->executeSQL($query);
				list($last_message['nic']) 	= $this->mysql->fetchRow($result);
			}

			if ($last_message && isset($last_message['them_datetime'])) {
				//если в течении 24 часво добавленно новое сообщение
				if ($last_message['datetime']>$now || $last_message['them_datetime']>$now) {
					$last_message['is_new_message']=true;
				}
				else {
					$last_message['is_new_message']=false;
				}

				if ($last_message['datetime']) {
					$last_message['datetime'] 		= $FRAME_FUNCTIONS->userDateTime($last_message['datetime'], $UMC, $this->settings['datetime']);
				}
				else {
					$last_message['them_datetime'] 	= $FRAME_FUNCTIONS->userDateTime($last_message['them_datetime'], $UMC, $this->settings['datetime']);
				}
			}

			$forums[$key]['last_message']=$last_message;
		}

		//формируем по группам
		foreach ($fgroups as $key=>$group) {
			foreach ($forums as $key2=>$forum) {
				if ($forum['fgroup_id']==$group['id']) {
					$fgroups[$key]['forums'][]=$forum;
				}
			}
		}

		unset($forum);

		$this->smarty->assign('fgroups', 				$fgroups);
		$this->smarty->assign('group_table_name', 		$this->tablePrefix.'fgroups');
		$this->smarty->assign('forum_table_name', 		$this->tablePrefix.'forums');

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_forums.tpl');
	}



	/**
	 * Отобразить список тем в форуме
	 *
	 */
	function show_forum_thems() {
		GLOBAL $FRAME_FUNCTIONS;

		//берём форум
		$query		= "SELECT * FROM `{$this->tablePrefix}forums` AS `t` WHERE t.id='{$this->gets['forum_id']}' AND t.active='1'";
		$result		= $this->mysql->executeSQL($query);
		$forum		= $this->mysql->fetchAssoc($result);

		//берём последние сообщения в темах
		$api						= $this->getApiObject($this->tablePrefix.'thems');
		$query						= "SELECT t.*, t2.nic, count(t3.id) AS `answers`, t.view FROM `{$this->tablePrefix}thems` AS `t`
										LEFT JOIN `{$this->tablePrefix}users` AS `t2` ON (t.user_id=t2.id)
										LEFT JOIN `{$this->tablePrefix}messages` AS `t3` ON (t3.them_id=t.id AND t3.active=1)
										WHERE t.forum_id='{$forum['id']}' AND t.active=1 GROUP BY t.id ORDER BY t.sort_index DESC";

		list($thems, $pageRecords)	= $api->dataGet($query, $this->settings['thems_for_page'], 'page');


		if ($user=$this->getUserInfo()) {
			$UMC	= $user['timezone'];
		}
		else {
			$UMC	= SETTINGS_TIMEZONE;
		}

		foreach ($thems as $key=>$them) {
			$query		= "SELECT t.id, t.datetime, t.user_id, t2.nic FROM `{$this->tablePrefix}messages` AS `t`
							LEFT JOIN `{$this->tablePrefix}users` AS `t2` ON (t.user_id=t2.id)	
							WHERE t.them_id='{$them['id']}' && t.active=1 ORDER BY t.datetime DESC LIMIT 1";
			$result		= $this->mysql->executeSQL($query);

			if ($thems[$key]['last_message'] = $this->mysql->fetchAssoc($result)) {
				$thems[$key]['last_message']['datetime'] = $FRAME_FUNCTIONS->userDateTime($thems[$key]['last_message']['datetime'], $UMC, $this->settings['datetime']);
			}

			if ($thems[$key]['last_message']['user_id']) {

				$query			= "SELECT count(*) FROM `{$this->tablePrefix}messages` AS `t` WHERE t.them_id='{$them['id']}' AND t.active=1 ORDER BY t.datetime DESC LIMIT 1";
				$result			= $this->mysql->executeSQL($query);
				list($m_count)	= $this->mysql->fetchRow($result);
				$page			= ceil($m_count/$this->settings['messages_for_page']);
				if ($page>1) {
					$thems[$key]['last_message']['page'] = $page;
				}
			}
		}

		//подключение редактора
		$editor		 = $FRAME_FUNCTIONS->editorSimpleGenerate();
		$editor		.= $FRAME_FUNCTIONS->editorSimpleGenerate('description', $height=200, $width='100%');

		$this->smarty->assign('forum', 					$forum);
		$this->smarty->assign('thems', 					$thems);
		$this->smarty->assign('pageRecords', 			$pageRecords);
		$this->smarty->assign('thems_table_name', 		$this->tablePrefix.'thems');
		$this->smarty->assign('forum_table_name', 		$this->tablePrefix.'forums');
		$this->smarty->assign('errors', 				$this->errors);
		$this->smarty->assign('editor', 				$editor);
		$this->smarty->assign('user', 					$user);
		$this->smarty->assign('editor_template',		$this->tplLocation.'show_editor.tpl');
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_thems.tpl');
	}



	/**
	 * Отобразить список сообщений в теме
	 *
	 */
	function show_them_messages() {
		GLOBAL $FRAME_FUNCTIONS;

		//берём тему форума
		$query		= "SELECT t.*, t2.moderator,  t2.nic AS `user_nic`, t2.id AS `user_id`, t2.avator AS `user_avator`, t2.registration AS `user_registration`, t2.sex AS `user_sex`, t2.signature AS `user_signature`
			FROM `{$this->tablePrefix}thems` AS `t` 
			LEFT JOIN `{$this->tablePrefix}users` AS `t2` ON (t.user_id=t2.id)
			WHERE t.id='{$this->gets['them_id']}' AND t.active='1'";
		$result		= $this->mysql->executeSQL($query);
		$them		= $this->mysql->fetchAssoc($result);

		//берём форум
		$query		= "SELECT * FROM `{$this->tablePrefix}forums` AS `t` WHERE t.id='{$them['forum_id']}' AND t.active='1'";
		$result		= $this->mysql->executeSQL($query);
		$forum		= $this->mysql->fetchAssoc($result);

		//добавляем тему, как первое сообщение только на первую страницу
		if (isset($this->gets['page']) && $this->gets['page']>1) {
			$messages				= array();
		}
		else {
			$messages[]				= $them;
		}

		//берём сообщения в теме
		$api						= $this->getApiObject($this->tablePrefix.'messages');
		$query						= "SELECT t.*, t2.moderator, t2.nic AS `user_nic`, t2.id AS `user_id`, t2.avator AS `user_avator`, t2.registration AS `user_registration`, t2.sex AS `user_sex`, t2.signature AS `user_signature` FROM `{$this->tablePrefix}messages` AS `t`
										LEFT JOIN `{$this->tablePrefix}users` AS `t2` ON (t.user_id=t2.id)
										WHERE t.them_id='{$them['id']}' AND t.active=1 ORDER BY t.datetime";

		list($mes, $pageRecords)	= $api->dataGet($query, $this->settings['messages_for_page'], 'page');

		$messages	= array_merge($messages, $mes);

		if ($user	= $this->getUserInfo()) {
			$UMC	= $user['timezone'];
		}
		else {
			$UMC	= SETTINGS_TIMEZONE;
		}

		foreach ($messages as $key=>$message) {
			$messages[$key]['user_registration'] 	= $FRAME_FUNCTIONS->userDateTime($messages[$key]['user_registration'], $UMC, 'Y-m-d');
			$messages[$key]['datetime'] 			= $FRAME_FUNCTIONS->userDateTime($messages[$key]['datetime'], $UMC, $this->settings['datetime']);
			if ($user['id']==$message['user_id'] || $user['moderator']) {
				$messages[$key]['can_edit']=true;
			}
			else {
				$messages[$key]['can_edit']=false;
			}
		}

		//добавляем просмотр
		if (!isset($_SESSION['forum_view_them']) || $_SESSION['forum_view_them']!=$them['id']) {
			$query		= "UPDATE `{$this->tablePrefix}thems` AS `t` SET t.view=t.view+1 WHERE t.id='{$them['id']}'";
			$result		= $this->mysql->executeSQL($query);
		}
		$query		= "UPDATE `{$this->tablePrefix}thems` AS `t` SET t.view=t.view+1 WHERE t.id='{$them['id']}'";
		$result		= $this->mysql->executeSQL($query);


		//подключение редактора
		$editor			= $FRAME_FUNCTIONS->editorSimpleGenerate();
		$editor			.= $FRAME_FUNCTIONS->editorSimpleGenerate('description', $height=200, $width='100%');

		$this->smarty->assign('messages', 				$messages);
		$this->smarty->assign('them', 					$them);
		$this->smarty->assign('forum', 					$forum);
		$this->smarty->assign('user', 					$user);
		$this->smarty->assign('pageRecords', 			$pageRecords);
		$this->smarty->assign('editor', 				$editor);
		$this->smarty->assign('thems_table_name', 		$this->tablePrefix.'thems');
		$this->smarty->assign('messages_table_name', 	$this->tablePrefix.'messages');
		$this->smarty->assign('user_table_name', 		$this->tablePrefix.'users');
		$this->smarty->assign('errors', 				$this->errors);
		$this->smarty->assign('editor_template',		$this->tplLocation.'show_editor.tpl');

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_messages.tpl');
	}



	/**
	 * Отобразить профайл пользователя
	 *
	 */
	function show_user() {
		GLOBAL $FRAME_FUNCTIONS;

		$user_id	= $this->gets['id'];

		//берём информацию о пользователе
		$query		= "SELECT t.*,
				t2.name AS `country_id_caption` ,
				t3.caption AS `timezone_id_caption`				
				FROM `{$this->tablePrefix}users` AS `t` 
				LEFT JOIN `{$this->tablePrefix}country` AS `t2` ON (t2.id=t.country_id)
				LEFT JOIN `{$this->tablePrefix}timezones` AS `t3` ON (t3.id=t.timezone_id)				
				WHERE t.id='$user_id'
				GROUP BY t.id
				ORDER BY t.sort_index DESC";

		$result		= $this->mysql->executeSQL($query);
		$user		= $this->mysql->fetchAssoc($result);

		//берём количество сообщений
		$query						= "SELECT count(*) FROM `{$this->tablePrefix}messages` AS `t` WHERE t.user_id='$user_id'";
		$result						= $this->mysql->executeSQL($query);
		if (!list($message_count)	= $this->mysql->fetchRow($result)) {
			$message_count=0;
		}
		//берём количество тем
		$query						= "SELECT count(*) FROM `{$this->tablePrefix}thems` AS `t` WHERE t.user_id='$user_id'";
		$result						= $this->mysql->executeSQL($query);
		if (!list($them_count)		= $this->mysql->fetchRow($result)) {
			$them_count=0;
		}

		$user['message_count']		= $message_count;
		$user['them_count']			= $them_count;


		if ($userInfo	= $this->getUserInfo()) {
			$UMC	= $userInfo['timezone'];
		}
		else {
			$UMC	= SETTINGS_TIMEZONE;
		}

		$user['registration'] 	= $FRAME_FUNCTIONS->userDateTime($user['registration'], $UMC, 'Y-m-d');

		$this->smarty->assign('user', 					$user);
		$this->smarty->assign('user_table_name', 		$this->tablePrefix.'users');

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_user.tpl');
	}



	/**
	 * добавление сообщения
	 *
	 */
	function update_message() {
		GLOBAL $FRAME_FUNCTIONS;

		//разрешенные теги
		$allowable_tags	= array('b', 'i', 'u', 'strong', 'p', 'a', 'img', 'blockquote', 'sub', 'em', 'span', 'div');

		$posts			= $this->posts;
		
		//добавление сообщения
		if ($this->posts['edit_type']=='insert') {
			if ($this->posts['is_them']=='true') {
				$posts['active']			= true;
				$posts['discuse']			= true;
				$posts['forum_id']			= $this->gets['forum_id'];
				$api						= $this->getApiObject($this->tablePrefix.'thems', $posts, 'description', $allowable_tags);
			}
			else {
				$posts['active']			= true;
				$posts['forum_id']			= $this->gets['forum_id'];
				$posts['them_id']			= $this->gets['them_id'];
				$api						= $this->getApiObject($this->tablePrefix.'messages', $posts, 'description', $allowable_tags);
			}
			$api->dataInsert();

		}
		//обновление сообщения
		elseif ($this->posts['edit_type']=='update') {
			$posts['active']		= true;
			$posts['discuse']		= true;
			//$this->gets['id']		= $this->posts['data_id'];
			$posts['id']			= $this->posts['data_id'];
			if ($this->posts['is_them']=='true') {
				$api				= $this->getApiObject($this->tablePrefix.'thems', $posts, 'description', $allowable_tags);
			}
			else {
				$api				= $this->getApiObject($this->tablePrefix.'messages', $posts, 'description', $allowable_tags);
			}

			$api->dataUpdate();
		}

		$this->errors				= $api->errors;

		if (count($this->errors)>0) {
			foreach ($this->post as $key=>$value) {
				$this->smarty->assign($key, $value);
			}
		}
		else {
			$this->smarty->assign('message_is_updated', true);
		}

		if ($this->posts['is_them']=='true' && $this->posts['edit_type']=='insert') {

			if (count($this->errors)==0) {
				//формируем ссылку перехода
				$new_url	= $FRAME_FUNCTIONS->furl("?act=show_them_messages&forum_id={$this->gets['forum_id']}&them_id={$api->inserted_id}");
				$FRAME_FUNCTIONS->gotoURL($new_url);
			}
			else {
				$this->show_forum_thems();
			}
		}
		else {

			if ($this->posts['edit_type']=='insert') {

				$this->getPageById($api->inserted_id, $this->gets['them_id'], $this->settings['messages_for_page']);
			}

			$this->show_them_messages();
		}
	}



	/**
	 * Удалить сообщение/темы
	 *
	 */
	function delete_message() {
		GLOBAL $FRAME_FUNCTIONS;

		$user	= $this->getUserInfo();

		if (isset($this->gets['id'])) {
			$query				= "SELECT count(*) FROM `{$this->tablePrefix}messages` AS `t` WHERE t.user_id='{$user['id']}'";
			$result				= $this->mysql->executeSQL($query);
			list($can_delete)	= $this->mysql->fetchRow($result);
			if ($can_delete || $user['moderator']) {
				$posts			= $this->gets;
				$api			= $this->getApiObject($this->tablePrefix.'messages', $posts);

				$api->dataDelete();

				$this->getPageById($this->gets['id'], $this->gets['them_id'], $this->settings['messages_for_page']);

			}
			$this->show_them_messages();
		}
		else {
			$query				= "SELECT count(*) FROM `{$this->tablePrefix}thems` AS `t` WHERE t.user_id='{$user['id']}'";
			$result				= $this->mysql->executeSQL($query);
			list($can_delete)	= $this->mysql->fetchRow($result);
			if ($can_delete || $user['moderator']) {
				$posts['id']		= $this->gets['them_id'];
				$api				= $this->getApiObject($this->tablePrefix.'thems', $posts);
				$api->dataDelete();

				//формируем ссылку перехода
				$new_url	= $FRAME_FUNCTIONS->furl("?act=show_forum_thems&forum_id={$this->gets['forum_id']}");
				$FRAME_FUNCTIONS->gotoURL($new_url);
			}
		}
	}



	/**
	 * Считает страницу на которой находится сообщение с указаным ID
	 *
	 * @param int $id
	 * @param int $them_id
	 * @param int $page_limit
	 * @return int
	 */
	function getPageById($id, $them_id, $page_limit) {
		//берём исходное сообщение
		$query				= "SELECT * FROM `{$this->tablePrefix}messages` AS `t` WHERE t.id='$id'";
		$result				= $this->mysql->executeSQL($query);
		$message			= $this->mysql->fetchAssoc($result);

		$page_number		= 0;
		$records_count		= 0;
		if ($message) {
			$query				= "SELECT `id` FROM `{$this->tablePrefix}messages` AS `t` WHERE t.them_id='$them_id' AND t.active=1 ORDER BY t.datetime";
			$result				= $this->mysql->executeSQL($query);
			while (list($mes_id)=$this->mysql->fetchRow($result)) {
				if ($mes_id!=$id) {
					$records_count++;
				}
				else {
					$records_count++;
					break;
				}
			}
		}
		else {
			$query				= "SELECT count(*) FROM `{$this->tablePrefix}messages` AS `t` WHERE t.them_id='$them_id' AND t.active=1 ORDER BY t.datetime";
			$result				= $this->mysql->executeSQL($query);
			list($records_count)= $this->mysql->fetchRow($result);
		}

		$page_number			= ceil($records_count/$page_limit);

		if ($page_number==0) {
			$page_number	= 1;
		}

		if ($message) {
			if ($this->gets['page']!=$page_number) {
				$this->gets['page']=$page_number;
			}
		}
		else {

			if ($this->gets['page']>$page_number) {
				$this->gets['page']=$page_number;
			}

		}

		return $page_number;
	}



	/**
	 * Возвращает информацию об авторизированном пользователе
	 *
	 * @return unknown
	 */
	function getUserInfo() {

		if (isset($_SESSION['logined_user']['id'])) {
			$query     	= "SELECT t.*, t2.timezone FROM `{$this->tablePrefix}users` AS `t`
			LEFT JOIN `{$this->tablePrefix}timezones` AS `t2` ON (t2.id=t.timezone_id) 
			WHERE t.id='{$_SESSION['logined_user']['id']}'";
			$result    	= $this->mysql->executeSQL($query);
			$user 		= $this->mysql->fetchAssoc($result);
		}
		else {
			$user		= false;
		}

		return $user;
	}

}

?>