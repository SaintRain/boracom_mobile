<?php
/**
 * класс для создания/редактирования правил обработки дружественных ссылок 
 *
 */
class FriendlyURLRules  {

	/**
	 * смарти-класс
	 * @var class
	 */
	public		$smarty;

	/**
     * переменные из массива $_POST с заменёнными спец-символами
     *
     * @var array
     */
	public		$post;

	/**
     *  переменные из массива $_POST как они вводились пользователем (спец символы не заменены)
     *
     * @var array
     */
	public		$postr;

	/**
     *  экранированые переменные функцией addslashes() из массива $_POST 
     *
     * @var array
     */
	public		$posts;

	/**
     * переменные из массива $_GET с заменёнными символами
     *
     * @var array
     */
	public		$get;


	/**
     *  переменные из массива $_GET (спец символы не заменены)
     *
     * @var array
     */
	public		$getr;

	/**
     *  экранированые переменные функцией addslashes() из массива $_GET 
     *
     * @var array
     */
	public		$gets;

	/**
   	 * класс для работы с MYSQL
   	 *
   	 * @var class
   	 */
	public		$mysql;

	/**
     * Хранит переданные ошибки
     *
     * @var array
     */
	public 		$errorMsgs;

	/**
     * сообщения
     *
     * @var array
     */
	public  	$messages;

	

	/**
     * Конструктор
     * 
     * @param class $smarty
     */
	function __construct($mysql, $smarty, $post, $postr, $posts, $get, $getr, $gets,  $do) {


		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		$this->post		= $post;
		$this->get		= $get;
		$this->postr	= $postr;
		$this->posts	= $posts;
		$this->getr		= $getr;
		$this->gets		= $gets;

		switch ($do):
		case ('list'):					$this->getlist(); 			break;
		case ('saveedit'):				$this->saveedit();	 		break;
		endswitch;
	}


	/**
	 * Выводит форму редактирования правил
	 *
	 */
	function getlist() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE3, $MYSQL_TABLE23, $MYSQL_TABLE24, $MYSQL_TABLE17, $MYSQL_TABLE18;

		$query				= "SELECT * FROM `$MYSQL_TABLE3` ORDER BY `sort_index`";
		$result				= $this->mysql->executeSQL($query);
		$page_records		= $this->mysql->fetchAssocAll($result);

		$query				= "SELECT * FROM `$MYSQL_TABLE23` ORDER BY `page_id`";
		$result				= $this->mysql->executeSQL($query);
		$urls_settings		= $this->mysql->fetchAssocAll($result);

		if (count($this->errorMsgs)==0) {
			//берем правила обработки записей
			foreach ($urls_settings as $key=>$up) {
				$query							= "SELECT * FROM `$MYSQL_TABLE24` WHERE `urls_settings_id`='{$up['id']}' ORDER BY `sort_index` DESC";
				$result							= $this->mysql->executeSQL($query);
				$rules							= $this->mysql->fetchAssocAll($result);
				$urls_settings[$key]['rules']	= $rules;
			}

		}
		else {
			$urls_settings=$this->getFields(true);
		}

		//берем подходящие таблицы
		$query				= "SELECT t2.* FROM `$MYSQL_TABLE17` AS `t` LEFT JOIN `$MYSQL_TABLE18` AS `t2` ON (t.table_id=t2.id) WHERE t.unique=1 AND t.edittype_id=14 GROUP BY t2.id ORDER BY t2.module_id";
		$result				= $this->mysql->executeSQL($query);
		$tables_records		= $this->mysql->fetchAssocAll($result);

		$this->smarty->assign('content_template',			'friendly_url_rules/edit_rules.tpl');
		$this->smarty->assign('content_head',				$MSGTEXT['settings_friendly_caption']);
		$this->smarty->assign('errorMsgs',					$this->errorMsgs);
		$this->smarty->assign('messages',					$this->messages);
		$this->smarty->assign('page_records',				$page_records);
		$this->smarty->assign('urls_settings',				$urls_settings);
		$this->smarty->assign('tables_records',				$tables_records);
	}



	/**
	 * Обрабатываем поля с формы
	 *
	 * @return array
	 */
	function getFields($dontReportErrors=false) {
		GLOBAL $MSGTEXT,$MYSQL_CTR_TABLE18, $MYSQL_CTR_TABLE20, $MYSQL_CTR_TABLE25;

		//проверка зополненых полей таблицы
		$pages_count	= 0;
		$pages			= array();

		while (isset($this->post['id'.$pages_count])) {
			$tmp['id']		= $this->post['id'.$pages_count];
			$tmp['page_id']	= $this->post['page_id'.$pages_count];

			if (isset($this->post['enable'.$pages_count])) {
				$tmp['enable']	= $this->post['enable'.$pages_count];
			}
			else {
				$tmp['enable']	= 0;
			}

			if (isset($this->post['delete'.$pages_count])) {
				$tmp['delete']	= $this->post['delete'.$pages_count];
			}
			else {
				$tmp['delete']	= 0;
			}

			//берем правила для станиц
			$rules			= array();
			$rules_counter	= 0;
			while (isset($this->post['id'.$pages_count.'_'.$rules_counter])) {

				$rules_prefif		= $pages_count.'_'.$rules_counter;
				$rule				= array();
				$rule['id']			= $this->post['id'.$rules_prefif];
				$rule['var_name']	= $this->post['var_name'.$rules_prefif];

				if (isset($this->post['table_id'.$rules_prefif]) && is_numeric($this->post['table_id'.$rules_prefif])) {
					$rule['table_id']	= $this->post['table_id'.$rules_prefif];
				}
				else {
					$rule['table_id']	= 0;
				}

				$rule['value']			= $this->post['value'.$rules_prefif];

				if (is_numeric($this->post['sort_index'.$rules_prefif])) {
					$rule['sort_index']		= $this->post['sort_index'.$rules_prefif];
				}
				else {
					$rule['sort_index']		= 0;
				}

				if (isset($this->post['is_value'.$rules_prefif])) {
					$rule['is_value']		= $this->post['is_value'.$rules_prefif];
				}
				else {
					$rule['is_value']		= 0;
				}
				if (isset( $this->post['delete'.$rules_prefif])) {
					$rule['delete']			= $this->post['delete'.$rules_prefif];
				}
				else {
					$rule['delete']			= 0;
				}

				$rules[]					= $rule;

				$rules_counter++;
			}

			//проверяем, чтоб не было двух одинаковых переменных в пределах одного правила
			if (!$dontReportErrors) {
				foreach ($rules as $rule) {
					$povtor=0;
					if ($rule['var_name']=='' && $rule['delete']==0) {
						$this->errorMsgs[]=sprintf($MSGTEXT['friendlyurlrules_empty_var_name'], $rule['var_name']);
						break;
					}
					foreach ($rules as $rule2) {
						if ($rule['var_name']==$rule2['var_name']) {
							$povtor++;
						}

						if ($povtor>1)	 {
							$this->errorMsgs[]=sprintf($MSGTEXT['friendlyurlrules_double_var_name'], $rule['var_name']);
							break;
						}
					}

					if ($povtor>1)	 {
						break;
					}
				}
			}


			$tmp['rules']	= $rules;
			$pages[]		= $tmp;
			$pages_count++;
		}

		return $pages;
	}


	
	/**
     * Cохранение редактирования 
     *
     */
	function saveedit() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $MYSQL_TABLE3, $MYSQL_TABLE23, $MYSQL_TABLE24, $MYSQL_TABLE22;

		$pages						= $this->getFields();

		if (count($this->errorMsgs)==0) {
			foreach ($pages as $p) {

				//удаляем запись
				if (is_numeric($p['id']) && $p['delete'])	{
					$query				= "DELETE FROM `$MYSQL_TABLE23` WHERE `id`='{$p['id']}'";
					$result				= $this->mysql->executeSQL($query);

					//удаляем правила для страницы
					$del_ids			= array();
					$query				= "SELECT `id` FROM `$MYSQL_TABLE24` WHERE `urls_settings_id`='{$p['id']}'";
					$result				= $this->mysql->executeSQL($query);
					while (list($row)	= $this->mysql->fetchRow($result)) {
						$del_ids[]		= $row;
					}

					if (count($del_ids)>0) {
						$del_ids_str		= implode(',', $del_ids);
						$query				= "DELETE FROM `$MYSQL_TABLE24` WHERE `urls_settings_id`= '{$p['id']}'";
						$result				= $this->mysql->executeSQL($query);

						$query				= "DELETE FROM `$MYSQL_TABLE22` WHERE `urls_settings_id` IN ($del_ids_str)";
						$result				= $this->mysql->executeSQL($query);
					}
				}

				//добавляем запись
				elseif (!is_numeric($p['id']) && !$p['delete'])	{
					$regular			= '';
					$query				= "INSERT INTO `$MYSQL_TABLE23` (`page_id`, `enable`, `regular`) VALUES ('{$p['page_id']}', '{$p['enable']}', '$regular')";
					$result				= $this->mysql->executeSQL($query);
					$inserted_id		= $this->mysql->insertID();

					//добавляем правила
					foreach ($p['rules'] as $rule) {
						if (!$rule['delete']) {
							$query				= "INSERT INTO `$MYSQL_TABLE24` (`urls_settings_id`, `var_name`, `table_id`, `is_value`, `value`, `sort_index`)
			 				VALUES ('$inserted_id', '{$rule['var_name']}', '{$rule['table_id']}', '{$rule['is_value']}', '{$rule['value']}', '{$rule['sort_index']}')";
							$result				= $this->mysql->executeSQL($query);
						}
					}
				}


				//обновляем запись
				elseif (!$p['delete']) {
					$query				= "UPDATE `$MYSQL_TABLE23` SET `page_id`='{$p['page_id']}', `enable`='{$p['enable']}' WHERE `id`='{$p['id']}'";
					$result				= $this->mysql->executeSQL($query);

					//обрабатываем правила
					foreach ($p['rules'] as $rule) {

						//удаляем правило
						if ($rule['delete'] && is_numeric($rule['id'])) {
							$query				= "DELETE FROM `$MYSQL_TABLE24` WHERE `id`='{$rule['id']}'";
							$result				= $this->mysql->executeSQL($query);

							$query				= "DELETE FROM `$MYSQL_TABLE22` WHERE `urls_settings_id`='{$rule['id']}'";
							$result				= $this->mysql->executeSQL($query);
						}
						//переписываем правило
						elseif (is_numeric($rule['id'])) {
							$query				= "UPDATE `$MYSQL_TABLE24` SET  `var_name`='{$rule['var_name']}', `table_id`='{$rule['table_id']}', `is_value`='{$rule['is_value']}', `value`='{$rule['value']}', `sort_index`='{$rule['sort_index']}' WHERE `id`='{$rule['id']}'";
							$result				= $this->mysql->executeSQL($query);
						}
						//добавляем правило
						else {
							$query				= "INSERT INTO `$MYSQL_TABLE24` (`urls_settings_id`, `var_name`, `table_id`, `is_value`, `value`, `sort_index`)
				 			VALUES ('{$p['id']}', '{$rule['var_name']}', '{$rule['table_id']}', '{$rule['is_value']}', '{$rule['value']}', '{$rule['sort_index']}')";
							$result				= $this->mysql->executeSQL($query);
						}
					}
				}
			}

			$this->messages	= $MSGTEXT['friendlyurlrules_saved'];
		}


		//Генерируем регулярные выражения
		$query				= "SELECT * FROM `$MYSQL_TABLE23` ORDER BY `page_id`";
		$result				= $this->mysql->executeSQL($query);
		$urls_settings		= $this->mysql->fetchAssocAll($result);

		//берем правила обработки записей
		foreach ($urls_settings as $key=>$up) {
			$query							= "SELECT * FROM `$MYSQL_TABLE24` WHERE `urls_settings_id`='{$up['id']}' ORDER BY `sort_index` DESC";
			$result							= $this->mysql->executeSQL($query);
			$rules							= $this->mysql->fetchAssocAll($result);
			$urls_settings[$key]['rules']	= $rules;
		}

		foreach ($urls_settings as $s) {
			$regular			= $this->generateRegexe($s['rules']);

			//удаляем ссылки если правило изменилось, иначе будут подставляться старые ссылки
			if ($s['regular']!=$regular) {
				$query			= "DELETE FROM `$MYSQL_TABLE22` WHERE `urls_settings_id`='{$s['id']}'";
				$result			= $this->mysql->executeSQL($query);
			}

			$regular			= addslashes($regular);
			$query				= "UPDATE `$MYSQL_TABLE23` SET `regular`='$regular' WHERE `id`='{$s['id']}'";
			$result				= $this->mysql->executeSQL($query);
		}

		$this->updateSavedURLS();

		$this->getlist();
	}


	
	/**
	 * Генерирует регулярное выражение
	 *
	 * @param array $rules
	 * @return string
	 */
	function generateRegexe($rules) {

		$regexe	='';
		foreach ($rules as $rule) {
			if ($rule['is_value']) {
				$regexe.="[\\&\\?]{$rule['var_name']}={$rule['value']}(.*?)";
			}
			else {
				$regexe.="[\\&\\?]{$rule['var_name']}=(\\d*?)(.*?)";
			}
		}

		return $regexe;
	}


	
	/**
	 * Обновляет таблицу, в которой храняться URL
	 *
	 */
	function updateSavedURLS() {
		GLOBAL $MYSQL_TABLE22, $MYSQL_TABLE23;

		//берем все правила подстановки
		$query				= "SELECT * FROM `$MYSQL_TABLE23` WHERE `enable`=1 ORDER BY `page_id`";
		$result				= $this->mysql->executeSQL($query);
		$urls_settings		= $this->mysql->fetchAssocAll($result);

		//берем все сохранённые URL
		$ids				= array();
		$urls				= array();
		$query				= "SELECT * FROM `$MYSQL_TABLE22`";
		$result				= $this->mysql->executeSQL($query);
		while ($row			= $this->mysql->fetchAssoc($result)) {
			$urls[$row['page_id']][]	= $row;
		}

		foreach ($urls_settings as $s)  {
			if (isset($urls[$s['page_id']]))
			foreach ($urls[$s['page_id']] as $url) {
				
				$regular		= '/^'.$s['regular'].'$/';
				

				if (!in_array($url['id'], $ids) &&  preg_match($regular, '?'.$url['request_uri']) && is_numeric($url['friendly_url'])) {
					
					$ids[]		= $url['id'];
				}
			}
		}

		if (count($ids)>0) {
			$ids				= implode(',', $ids);
			$query				= "DELETE FROM `$MYSQL_TABLE22` WHERE `id` IN ($ids)";
			$result				= $this->mysql->executeSQL($query);
		}
	}

	

	/**
	 * возвращает смарти
	 *
	 * @return class
	 */
	function getSmarty() {
		return $this->smarty;
	}
}

?>