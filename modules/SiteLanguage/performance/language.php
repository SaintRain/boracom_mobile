<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Форма смены языка сайта
*////////////////////////////////////////////////////////////////////////////////////////////
class language extends SiteLanguage {

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
		GLOBAL $LANGUAGES_OF_MATERIAL, $LANGUAGE_PREFIX;

		//берем префиксы созданных в настройках системы языков
		$langs		= array();
		$prefix		= array();
		foreach ($LANGUAGES_OF_MATERIAL as $key=>$v) {
			if ($LANGUAGE_PREFIX!=$key) {
				$prefix[]="'$key'";
			}
		}
		$prefix		= implode(',', $prefix);

		$query		= "SELECT * FROM `{$this->tablePrefix}data` WHERE `enable`=1 AND `lang_prefix` IN ($prefix) ORDER BY `sort_index` DESC";
		$result		= $this->mysql->executeSQL($query);
		while ($row	= $this->mysql->fetchAssoc($result)) {
			$row['caption']	= $LANGUAGES_OF_MATERIAL[$row['lang_prefix']]['caption'];
			$langs[]		= $row;
		}

		if (SETTINGS_FRIENDLY_URL_ADD_END_SLASH) {
			$url	= str_replace('/'.$LANGUAGE_PREFIX.'/', '/', $_SERVER['REQUEST_URI']);
		}
		else {
			$url	= str_replace('/'.$LANGUAGE_PREFIX, '/', $_SERVER['REQUEST_URI']);
		}
		
		$url	= str_replace('//','/',$url);

		$this->smarty->assign('url', 	$url);
		$this->smarty->assign('langs', $langs);
		$this->contentOUT = $this->smarty->fetch($this->tplLocation.'lang_set_form.tpl');
	}



}

?>