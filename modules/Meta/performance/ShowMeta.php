<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Вывод заголовков
*////////////////////////////////////////////////////////////////////////////////////////////
class ShowMeta extends Meta {
	
	/**
     * Определяем какой метод выполнить
     * 
     */
	function linker() {

		//вызываем метод - обработчик
		switch ($this->action):
		//case (''):					$this->; 			break;
		default:						$this->START(); 	break;
		endswitch;
	}



	/**
	 * Стартовый метод, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS;

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
		$query			= "SELECT * FROM `{$this->tablePrefix}data` WHERE ($whereSQL) AND (`lang_id`='{$this->lang_id}' OR `global`='1')";
		$result			= $this->mysql->executeSQL($query);

		while ($row     = $this->mysql->fetchAssoc($result)) {
			$this->smarty->assign('data', $row);								
			$this->contentOUT[$this->tagInfo[$row['tag_id']]['system_tagname']]=$this->smarty->fetch($this->tplLocation.'show_meta.tpl');
		}

        //если нет записей, тогда возвращаем пустой шаблон
        if (!$row) {
            foreach ($this->tagInfo as $v) {
                $this->contentOUT[$this->tagInfo[$v['id']]['system_tagname']]=$this->smarty->fetch($this->tplLocation.'show_meta.tpl');
            }
        }


	}



}

?>