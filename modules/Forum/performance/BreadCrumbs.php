<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Хлебные крошки
*////////////////////////////////////////////////////////////////////////////////////////////
class BreadCrumbs extends Forum {

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
		GLOBAL $FRAME_FUNCTIONS;


		//берём описание темы форума
		if (isset($this->gets['group_id'])) {
			//берём форум
			$query		= "SELECT t.* FROM `{$this->tablePrefix}fgroups` AS `t` WHERE t.id='{$this->gets['group_id']}'";
			$result		= $this->mysql->executeSQL($query);
			$group		= $this->mysql->fetchAssoc($result);
			$this->smarty->assign('group', $group);
		}
		elseif (isset($this->gets['act']) && ($this->gets['act']=='show_forum_thems' || $this->gets['act']=='update_message')) {

			//берём форум
			$query		= "SELECT t.id, t.caption, t2.id AS `group_id`, t2.caption AS `group_caption` FROM `{$this->tablePrefix}forums` AS `t`
			LEFT JOIN `{$this->tablePrefix}fgroups` AS `t2` ON (t.fgroup_id=t2.id) WHERE t.id='{$this->gets['forum_id']}' AND t.active='1'";
			$result		= $this->mysql->executeSQL($query);
			$forum		= $this->mysql->fetchAssoc($result);
			$this->smarty->assign('forum', $forum);
		}

		elseif (isset($this->gets['act']) && isset($this->gets['them_id']) && ($this->gets['act']=='show_them_messages' || $this->gets['act']=='update_message' || $this->gets['act']=='delete_message')) {

			//берём тему
			$query		= "SELECT t.id AS `forum_id`, t.caption AS `forum_caption`, t2.id AS `forum_group_id`, t2.caption AS `forum_group_caption`, t3.caption FROM `{$this->tablePrefix}forums` AS `t`
			LEFT JOIN `{$this->tablePrefix}fgroups` AS `t2` ON (t.fgroup_id=t2.id) 
			LEFT JOIN `{$this->tablePrefix}thems` AS `t3` ON (t3.forum_id=t.id) 
			WHERE t3.id='{$this->gets['them_id']}' AND t.active='1'";
			$result		= $this->mysql->executeSQL($query);
			$them		= $this->mysql->fetchAssoc($result);

			$this->smarty->assign('them', $them);
		}
		elseif (isset($this->gets['act']) && $this->gets['act']=='show_user') 
		{

			//берём информацию о пользователе
			$query		= "SELECT t.*,
				t2.name AS `country_id_caption` ,
				t3.caption AS `timezone_id_caption`,
				count(t4.id) AS `message_count`
				FROM `{$this->tablePrefix}users` AS `t` 
				LEFT JOIN `{$this->tablePrefix}country` AS `t2` ON (t2.id=t.country_id)
				LEFT JOIN `{$this->tablePrefix}timezones` AS `t3` ON (t3.id=t.timezone_id)
				LEFT JOIN `{$this->tablePrefix}messages` AS `t4` ON (t4.user_id=t.id) 
				WHERE t.id='{$this->gets['id']}'
				GROUP BY t.id
				ORDER BY t.sort_index DESC";

			$result		= $this->mysql->executeSQL($query);
			$user		= $this->mysql->fetchAssoc($result);

			$this->smarty->assign('user_info', $user);
		}

		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'show_list.tpl');
	}



}

?>