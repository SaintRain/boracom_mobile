<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Библиотека общих функций модуля
*////////////////////////////////////////////////////////////////////////////////////////////
class Forum extends MAIN_MODULES_CLASS {

	/**
	 * Возвращает Title, Metakeywords, Metadescription описание
	 *
	 * @param string $field_name
	 * @return string
	 */
	function getSEO($field_name) {
		GLOBAL $FRAME_FUNCTIONS;
		
		$out	= array();
		if (isset($this->gets['group_id'])) {
			$query		= "SELECT t.caption FROM `{$this->tablePrefix}fgroups` AS `t` WHERE t.id='{$this->gets['group_id']}'";
			$result		= $this->mysql->executeSQL($query);
			list($t)= $this->mysql->fetchRow($result);
			if ($t!='')	$out[]=$t;
		}

		if (isset($this->gets['forum_id'])) {
			$query		= "SELECT t.$field_name, t.fgroup_id FROM `{$this->tablePrefix}forums` AS `t` WHERE t.id='{$this->gets['forum_id']}'";
			$result		= $this->mysql->executeSQL($query);
			list($t2, $group_id)= $this->mysql->fetchRow($result);
			
			$query		= "SELECT t.caption FROM `{$this->tablePrefix}fgroups` AS `t` WHERE t.id='{$group_id}'";
			$result		= $this->mysql->executeSQL($query);
			list($t)= $this->mysql->fetchRow($result);
			if ($t!='')	$out[]=$t;
									
			if ($t2!='')	$out[]=$t2;
		}

		if (isset($this->gets['them_id'])) {
			$query		= "SELECT t.$field_name FROM `{$this->tablePrefix}thems` AS `t` WHERE t.id='{$this->gets['them_id']}'";
			$result		= $this->mysql->executeSQL($query);
			list($t)= $this->mysql->fetchRow($result);
			if ($t!='')	$out[]=$t;
		}

		$s		= implode(' : ', $out);
		return $s;
	}
}
?>