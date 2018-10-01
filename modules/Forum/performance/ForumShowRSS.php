<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод RSS
*////////////////////////////////////////////////////////////////////////////////////////////
class ForumShowRSS extends Forum {

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
		GLOBAL $FRAME_FUNCTIONS, $PAGE_INFO;

		header('Content-type: application/xml');

		//берём тему
		$query						= "SELECT t.*, t2.nic, count(t3.id) AS `answers`, t.view FROM `{$this->tablePrefix}thems` AS `t`
										LEFT JOIN `{$this->tablePrefix}users` AS `t2` ON (t.user_id=t2.id)
										LEFT JOIN `{$this->tablePrefix}messages` AS `t3` ON (t3.them_id=t.id AND t3.active=1)
										WHERE t.id='{$this->gets['them_id']}' AND t.active=1 GROUP BY t.id ORDER BY t.sort_index";
		$result		= $this->mysql->executeSQL($query);
		$them		= $this->mysql->fetchAssoc($result);
		$them['link']				= $FRAME_FUNCTIONS->furl(SETTINGS_HTTP_HOST."/forums?act=show_them_messages&forum_id={$them['forum_id']}&them_id={$them['id']}");
		$them['description']		= preg_replace('/&(.*?);/i', '', $them['description']);
		$them['description']		= strip_tags($them['description']);


		$records	= array();
		$query		= "
		SELECT t.*,
		t2.caption AS `them_id_caption` ,
		t2.forum_id,
		t3.nic AS `user_id_caption` 
		FROM `{$this->tablePrefix}messages` AS `t` 
		LEFT JOIN `{$this->tablePrefix}thems` AS `t2` ON (t2.id=t.them_id)
		LEFT JOIN `{$this->tablePrefix}users` AS `t3` ON (t3.id=t.user_id)
		WHERE t.active='1' AND t.them_id='{$this->gets['them_id']}'
		ORDER BY t.datetime";	
		$result			= $this->mysql->executeSQL($query);
		while ($record	= $this->mysql->fetchAssoc($result)) {
			$records[]	= $record;
		}

		$count=1;
		foreach ($records as $k=>$v) {
			$v['description']				= preg_replace('/&(.*?);/i', '', $v['description']);
			$records[$k]['description']		= strip_tags($v['description']);

			$v['them_id_caption']			= preg_replace('/&(.*?);/i', '', $v['them_id_caption']);
			$records[$k]['them_id_caption']	= strip_tags($v['them_id_caption']);

			//считаем страницу
			$page			= ceil($count/$this->settings['messages_for_page']);
			if ($page>1) {
				$p = '&page='.$page;
			}
			else {
				$p='';
			}

			$records[$k]['datetime']		= $FRAME_FUNCTIONS->userDateTime($v['datetime'], SETTINGS_TIMEZONE, 'Y-m-d H:i:s');
			$records[$k]['link']			= $FRAME_FUNCTIONS->furl(SETTINGS_HTTP_HOST."/forums?act=show_them_messages&forum_id={$v['forum_id']}&them_id={$v['them_id']}$p#{$v['id']}");

			$count++;
		}

		$docs_url							= SETTINGS_HTTP_HOST.$_SERVER['REQUEST_URI'];
		$this->smarty->assign('date', 		gmdate('r'));
		$this->smarty->assign('records', 	$records);
		$this->smarty->assign('docs_url', 	$docs_url);
		$this->smarty->assign('them', 		$them);

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_rss.tpl');
	}



}

?>