<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Простой текст
*////////////////////////////////////////////////////////////////////////////////////////////
class SimpleTextShow extends SimpleText {

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

		$where	= array();
		foreach ($this->tagInfo as $v) {

			if ($v['global']==2) {
				$page_id = -1;
			}
			elseif ($v['global']==1) {
				$page_id = 0;
			}
			else {
				$page_id = $this->pageInfo['id'];
			}
			$where[]	 = "(`page_id`='{$page_id}' AND `tag_id`='{$v['id']}')";
		}
		
		$whereSQL		= implode(' OR ', $where);
		$query			= "SELECT `text`, `tag_id` FROM `{$this->tablePrefix}data` WHERE ($whereSQL) AND (`lang_id`='{$this->lang_id}' OR `global`='1')";
		$result			= $this->mysql->executeSQL($query);
		while ($row=$this->mysql->fetchAssoc($result)) {
			$this->contentOUT[$this->tagInfo[$row['tag_id']]['system_tagname']]=$row['text'];
		}
	}
	
	

}

?>