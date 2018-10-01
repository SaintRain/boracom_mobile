<?php
/*///////////////////////////////////////////////////////////////////////////////////////////
Генерация sitemap.xml
*////////////////////////////////////////////////////////////////////////////////////////////
class GenerateGoogleSitemap extends Sitemap {

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
		GLOBAL $FRAME_FUNCTIONS, $MYSQL_TABLE22, $MYSQL_TABLE3, $PAGE_INFO;

		$info				= array();
		$stop				= false;
		//подсчитываем количество обработанных ссылок
		$query 				= "SELECT count(*) FROM `{$this->tablePrefix}urls` WHERE `used`='1'";
		$result 			= $this->mysql->executeSQL($query);
		list($total_links)	= $this->mysql->fetchRow($result);

		$query 				= "SELECT * FROM `{$this->tablePrefix}urls` WHERE `used`='0' ORDER BY `sort_index` LIMIT 1";
		$result 			= $this->mysql->executeSQL($query);
		if (!$info			= $this->mysql->fetchAssoc($result)) {

			//очищаем таблицу
			if ($total_links>0) {

				//берём ссылки, которые не выводить в карту
				$b_urls				= array();
				$query 				= "SELECT `url` FROM `{$this->tablePrefix}data` WHERE `enable`='1'";
				$result 			= $this->mysql->executeSQL($query);
				while ($bad_urls	= $this->mysql->fetchAssoc($result)) {
					$b_urls[]			= "'{$bad_urls['url']}'";
				}

				if (count($b_urls)>0) {
					$b_urls			= implode(',', $b_urls);
					$sql_part		= "AND `url` NOT IN ($b_urls)";
				}
				else {
					$sql_part		= '';
				}

				//сохраняем ссылки в файл
				if (mb_substr(SETTINGS_HTTP_HOST,-1)=='/') {
					$slash			= '';
				}
				else {
					$slash			= '/';
				}

				$urls				= array();
				$query 				= "SELECT `url` FROM `{$this->tablePrefix}urls` WHERE `used`='1' $sql_part";
				$result 			= $this->mysql->executeSQL($query);
				while ($row			= $this->mysql->fetchAssoc($result)) {
					if (SETTINGS_HTTP_HOST!=$row['url']) {
						$urls[]			= SETTINGS_HTTP_HOST.str_replace('//','/', $slash.$row['url']);
					}
					else {
						$urls[]			= SETTINGS_HTTP_HOST;
					}
				}

				$this->smarty->assign('urls', $urls);
				$sitemap_content = $this->smarty->fetch($this->tplLocation.'show_list.tpl');

				//перезаписываем файл
				$fd=fopen($_SERVER['DOCUMENT_ROOT'].'/sitemap.xml', 'w');
				fwrite($fd, $sitemap_content);
				fclose($fd);

				$this->contentOUT= $this->smarty->fetch($this->tplLocation.'res.tpl');

				$query 			= "TRUNCATE TABLE `{$this->tablePrefix}urls`";
				$result 		= $this->mysql->executeSQL($query);
				$stop			= true;
			}
			else {
				//обновляем статус текущего URL
				$host			= SETTINGS_HTTP_HOST;
				$query 			= "INSERT INTO `{$this->tablePrefix}urls` (`url`, `used`, `lang_id`) VALUES ('$host', '0', '{$this->lang_id}')";
				$result 		= $this->mysql->executeSQL($query);

				header ("Location: ".$_SERVER['REQUEST_URI']);
				exit;
			}
		}


		if (!$stop) {
			
			//берём содержимое страницы
			if (SETTINGS_HTTP_HOST!=$info['url']) {
				$url	= SETTINGS_HTTP_HOST.$info['url'];
			}
			else {
				$url	= $info['url'];
			}

			if ($html		= @file_get_contents($url)) {

				//ссылки, которые не следует изменять
				$bad_links	= array('#', '/', '\\', '');

				//парсинг простых ссылок
				$regexp	= "/<a(.*?) (href=)['\"]([^\@]*?)(['\"])/is";
				preg_match_all($regexp, $html, $mathes, PREG_SET_ORDER);

				//парсинг ссылок в формах
				$regexp	= "/<form(.*?) (action=)['\"]([^\@|:]*?)(['\"])/is";
				preg_match_all($regexp, $html, $mathes2, PREG_SET_ORDER);
				$mathes	= array_merge($mathes, $mathes2);

				//парсинг ссылок location.href
				$regexp	= "/(\.)(href=)['\"](.*?)(['\"])/is";
				preg_match_all($regexp, $html, $mathes2, PREG_SET_ORDER);
				$mathes	= array_merge($mathes, $mathes2);

				//сортируем, чтоб небыло одинаковых ссылок
				$links		= array();

				foreach ($mathes as $m) {
					$t		= explode('#', $m[3]);
					$m[3]	= $t[0];
					if (!in_array($m[3], $bad_links) && mb_strpos($m[3], 'javascript:')===false && mb_strpos($m[3], 'goto.php?url=')===false) {
						$links[$m[3]]['qote'][$m[4]]	= true;
						$links[$m[3]]['type']			= $m[2];
					}
				}

				unset($mathes);

				//формируем правильный массив с некоторыми информационными элементами
				$site_links	= array();
				foreach ($links as $link=>$v) {
					$url_info	= parse_url($link);

					if (isset($links[$link]['host']) && $links[$link]['host']!=$_SERVER['HTTP_HOST']) {
						$add=false;
					}
					else {
						if (isset($links[$link]['host']) && $links[$link]['host']!=$_SERVER['HTTP_HOST']) {
							$pos	= mb_strpos($link, $_SERVER['HTTP_HOST']);
							$link	= mb_substr($link, ($pos+mb_strlen(SETTINGS_HTTP_HOST)));
						}
						$add=true;
					}

					if ($add) {
						$site_links[]=$link;
					}
				}

				//берем все обработанные ссылки
				$t_links	= array();
				$query 			= "SELECT * FROM `{$this->tablePrefix}urls`";
				$result 		= $this->mysql->executeSQL($query);
				while ($row		= $this->mysql->fetchAssoc($result)) {
					$t_links[$row['url']]=$row;
				}

				//добавляем новые ссылки
				$data			= array();
				foreach ($site_links AS $link) {
					if (!isset($t_links[$link])) {
						$data[]		= "('$link', '0', '{$this->lang_id}')";
					}
				}
				if (count($data)>0) {
					$data		= implode($data,',');
					$query 		= "INSERT INTO `{$this->tablePrefix}urls` (`url`, `used`, `lang_id`) VALUES $data";
					$result 	= $this->mysql->executeSQL($query);
				}

				//обновляем статус текущего URL
				$query 			= "UPDATE `{$this->tablePrefix}urls` SET `used`='1' WHERE `id`='{$info['id']}'";
				$result 		= $this->mysql->executeSQL($query);
			}
			else {
				$query 			= "DELETE FROM `{$this->tablePrefix}urls` WHERE `id`='{$info['id']}'";
				$result 		= $this->mysql->executeSQL($query);
			}
			//обновляем
			$this->smarty->assign('total_links', $total_links);
			$this->smarty->assign('time', time());
			$this->smarty->assign('block_name', $this->get['block_name']);
			$this->smarty->assign('module_name', $this->get['module_name']);
			$this->smarty->assign('table_name', $this->get['table_name']);
			$this->contentOUT	= $this->smarty->fetch($this->tplLocation.'process.tpl');
		}
	}
}

?>