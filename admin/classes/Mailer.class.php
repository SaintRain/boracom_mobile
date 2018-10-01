<?php
/**
 * Класс для рассылки email-сообщений
 *
 */
class Mailer  {

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
   	 * @var unknown_type
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
	function __construct($mysql, $smarty, $post, $postr, $get, $getr,  $do) {

		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		$this->post		= $post;
		$this->get		= $get;
		$this->postr	= $postr;
		$this->getr		= $getr;

		switch ($do):
		case ('list'):					$this->mailer_getlist(); 	break;
		case ('refresh'):				$this->refresh(); 			break;
		case ('save'):					$this->save(); 				break;
		case ('send'):					$this->send(); 				break;
		endswitch;
	}



	/**
	 * Выводим форму рассылки
	 *
	 */
	function mailer_getlist() {
		GLOBAL $MSGTEXT, $GENERAL_FUNCTIONS, $MYSQL_TABLE5, $MYSQL_TABLE9, $MYSQL_TABLE17, $MYSQL_TABLE18, $MYSQL_TABLE25;

		if (isset($this->post['group_name'])) {
			$group_id		= $this->post['group_name'];
		}
		elseif (isset($this->get['group_name'])) {
			$group_id		= $this->get['group_name'];
		}
		else 	$group_id	= '';


		if ($group_id!='' && $group_id>0) {
			$group_id_where	= " WHERE `group_name_id`='$group_id'";
		}
		else {
			$group_id_where	= '';
		}


		if ($group_id_where!='')	 {
			//берем настройки рассылки для определённой группы
			$query				= "SELECT count(*) FROM `$MYSQL_TABLE9` $group_id_where";
			$result				= $this->mysql->executeSQL($query);
			list($s_count) = $this->mysql->fetchRow($result);

			//добавляем автоматически настройки рассылки
			if ($s_count==0) {
				$query			= "SELECT f.* FROM `$MYSQL_TABLE17` AS `f` WHERE (f.fieldname LIKE '%email%' OR f.fieldname LIKE '%e_mail%' OR f.fieldname LIKE '%e-mail%') AND f.datatype_id IN (1, 3, 16, 18, 21, 23)";
				$result			= $this->mysql->executeSQL($query);
				$email_fields 	= $this->mysql->fetchAssocAll($result);
				$flag			= false;
				foreach ($email_fields as $e) {
					$query		= "INSERT INTO `$MYSQL_TABLE9` (`group_name_id`, `table_id`, `email_field_id`, `name_field_id`, `enable_field_id`) VALUES ('$group_id', '{$e['table_id']}', '{$e['id']}', '0', '0')";
					$result		= $this->mysql->executeSQL($query);
					$flag		= true;
				}
				if ($flag)	 {
					$this->smarty->assign('msgs', 		$MSGTEXT['classesmailer_refreshed']);
				}
			}


			//берем настройки рассылки
			$query			= "SELECT * FROM `$MYSQL_TABLE9` $group_id_where";
			$result			= $this->mysql->executeSQL($query);
			$mailer_data 	= $this->mysql->fetchAssocAll($result);


			$tables			= array();
			foreach ($mailer_data as $md)	{
				//берем таблицу
				$query			= "SELECT t.*, t2.description as `module_name` FROM `$MYSQL_TABLE18` AS `t` LEFT JOIN `$MYSQL_TABLE5` AS `t2` ON (t.module_id=t2.id) WHERE t.id='{$md['table_id']}'";
				$result			= $this->mysql->executeSQL($query);
				$tmp			= $this->mysql->fetchAssoc($result);

				//берем все поля таблицы
				$query			= "SELECT * FROM `$MYSQL_TABLE17` WHERE `table_id`='{$md['table_id']}'";
				$result			= $this->mysql->executeSQL($query);
				$tmp['fields'] 	= $this->mysql->fetchAssocAll($result);
				$tables[]		= $tmp;
			}

			//получаем список адресов
			$emails				= $this->getEmails($tables, $mailer_data);

			//берём сохранённое сообщение
			$query			= "SELECT * FROM `$MYSQL_TABLE25` WHERE `id`='$group_id'";
			$result			= $this->mysql->executeSQL($query);
			$message 		= $this->mysql->fetchAssoc($result);
		}
		else {
			$mailer_data	= array();
			$tables			= array();
			$emails			= array();
			$message		= array();
		}


		//берем групы рассылки
		$query			= "SELECT `id`, `email_group_name` FROM `$MYSQL_TABLE25` ORDER BY `email_group_name`";
		$result			= $this->mysql->executeSQL($query);
		$groups 		= $this->mysql->fetchAssocAll($result);

		//генерируем код для подключение редакторов
		$editorsCode	= $GENERAL_FUNCTIONS->editorGenerate();
		$editorsCode.=$GENERAL_FUNCTIONS->editorGenerate('text', 300, '100%');
		$editorsCode.=$GENERAL_FUNCTIONS->editorGenerate('makros_text', 120, '100%');

		$this->smarty->assign('content_template',	'mailer/mailer_list.tpl');

		$this->smarty->assign('message', 			$message);
		$this->smarty->assign('group_id', 			$group_id);
		$this->smarty->assign('groups', 			$groups);
		$this->smarty->assign('mailer_data', 		$mailer_data);
		$this->smarty->assign('tables', 			$tables);
		$this->smarty->assign('emails', 			$emails);
		$this->smarty->assign('finded', 			sprintf($MSGTEXT['classesmailer_total_finded'], count($emails)));
		$this->smarty->assign('content_head',		$MSGTEXT['classesmailer_caption']);
		$this->smarty->assign('editorsCode',		$editorsCode);

	}



	/**
	 * Находит адреса по заданным источникам
	 *
	 * @param array $tables
	 * @param array $mailer_data
	 * @return array
	 */
	function getEmails($tables, $mailer_data, $full=false) {

		$emails	= array();
		foreach ($tables as $t) {
			foreach ($mailer_data as $md) {
				if (isset($t['id']) && $md['table_id']==$t['id']) {

					$email_field	= '';
					$name_field		= '';
					$enable_field	= '';

					//определяем как называются искомые поля
					foreach ($t['fields'] as $f) {
						if ($f['id']==$md['email_field_id']) 	$email_field		= $f['fieldname'];
						elseif ($f['id']==$md['name_field_id']) 	$name_field		= $f['fieldname'];
						elseif ($f['id']==$md['enable_field_id']) 	$enable_field	= $f['fieldname'];
					}

					if ($name_field!='') $select_fields	= " `$email_field`, `$name_field`";
					else $select_fields	= " `$email_field`";

					if ($enable_field!='') $s_enable_field	= "WHERE `$enable_field`='1'";
					else $s_enable_field='';

					$query			= "SELECT `id`, $select_fields FROM `{$t['table_name']}` $s_enable_field";
					$result			= $this->mysql->executeSQL($query);
					while ($email	= $this->mysql->fetchAssoc($result)) {

						if (preg_match("/^[\.\-_A-Za-z0-9]+?@[\.\-A-Za-z0-9]+?\.[a-z0-9]{2,6}$/u", $email[$email_field])) {

							if ($full) {
								if ($name_field!='') {
									$tem=array('name'=>$email[$name_field],'table_name'=>$t['table_name'], 'table_id'=>$md['table_id'], 'id'=>$email['id']);
								}
								else {
									$tem=array('name'=>'','table_name'=>$t['table_name'], 'table_id'=>$md['table_id'], 'id'=>$email['id']);
								}
							}
							else {
								if ($name_field!='') $tem=$email[$name_field];
								else $tem=false;
							}

							$emails[$email[$email_field]]	= $tem;
						}
					}
					break;
				}
			}
		}

		return $emails;
	}



	/**
	 * Формирует данные для отправки и запускает самц отправку
	 *
	 */
	function send() {
		GLOBAL $CMSProtection, $MSGTEXT, $GENERAL_FUNCTIONS, $FILE_MANAGER, $MYSQL_TABLE9, $MYSQL_TABLE18, $MYSQL_TABLE17, $MYSQL_TABLE25;

		//проверяем лицензию на рассылку
		if ($CMSProtection->checkActivationMailer()) {

			if (isset($this->post['group_name'])) {
				$group_id		= $this->post['group_name'];
			}
			elseif (isset($this->get['group_name'])) {
				$group_id		= $this->get['group_name'];
			}
			else 	$group_id	= '';


			//если администратор обновил страницу и нет post данных
			if (!isset($this->post['subject'])) {
				$GENERAL_FUNCTIONS->gotoURL('?act=mailer&page');
				exit;
			}

			//сохранение сообщения
			$subject		= $this->post['subject'];
			$message		= $this->post['text'];
			$signature		= $this->post['makros_text'];

			$query			= "UPDATE `$MYSQL_TABLE25` SET `subject`='$subject', `message`='$message', `signature`='$signature'  WHERE `id`='{$group_id}'";
			$result			= $this->mysql->executeSQL($query);

			$upload_patch	= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/upload_tmp/';  	//папка, куда будут закачиваться файлы

			//закачиваем файл
			if (isset($_FILES['filename']) && $_FILES['filename']['name']!='') {
				$FILES_tmp_name	= $_FILES['filename']['tmp_name'];
				$name			= $GENERAL_FUNCTIONS->convertKirilToLatin($_FILES['filename']['name']);
				$mas			= explode('.', $name);
				$rash			= '.'.$mas[count($mas)-1];
				$name			= $mas[0];

				//находим свободное имя
				$NewName		= $name.$rash;
				$findex			= 1;
				while (is_readable($upload_patch.$NewName))  {
					$NewName	= $name.'_'.$findex.$rash;
					$findex++;
				}

				//закачиваем во временную папку под новым именем
				if (is_uploaded_file($FILES_tmp_name)) {
					if (move_uploaded_file($FILES_tmp_name, $upload_patch.$NewName)) {

					}
				}
			}
			else {
				$NewName='';
			}

			//берем настройки рассылки
			$query			= "SELECT * FROM `$MYSQL_TABLE9` WHERE `group_name_id`='$group_id'";
			$result			= $this->mysql->executeSQL($query);
			$mailer_data 	= $this->mysql->fetchAssocAll($result);


			$tables			= array();
			foreach ($mailer_data as $md)	{
				//берем таблицу
				$query			= "SELECT * FROM `$MYSQL_TABLE18` WHERE `id`='{$md['table_id']}'";
				$result			= $this->mysql->executeSQL($query);
				$tmp			= $this->mysql->fetchAssoc($result);

				//берем все поля таблицы
				$query			= "SELECT * FROM `$MYSQL_TABLE17` WHERE `table_id`='{$md['table_id']}'";
				$result			= $this->mysql->executeSQL($query);
				$tmp['fields'] 	= $this->mysql->fetchAssocAll($result);
				$tables[]		= $tmp;
			}

			//записываем список адресов во временный файл
			$emails_list		= $this->getEmails($tables, $mailer_data, true);

			$this->smarty->assign('emails', var_export($emails_list, true));
			$emails				= $this->smarty->fetch('mailer/mailer_masiv.tpl');

			$emails_file		= $upload_patch.'emails.php';
			$fd					= $FILE_MANAGER->fopen($emails_file, 'w');
			fwrite($fd, $emails);
			fclose($fd);

			//записываем сообщение во временный файл
			$butoforiya_start 	= "<!--".$this->generatePassword(50)."-->".SETTINGS_NEW_LINE;
			$butoforiya_end 	= SETTINGS_NEW_LINE."<!--".$this->generatePassword(50)."-->";

			if ($subject=='') $subject=' ';

			$msg				= $subject.SETTINGS_NEW_LINE.$butoforiya_start.$this->postr['text'].$this->postr['makros_text'].$butoforiya_end;
			$msg_file			= $upload_patch.'message.php';
			$FILE_MANAGER->putfile($msg_file, $msg);


			$this->smarty->assign('content_template',	'mailer/mailer_send_progress.tpl');
			$this->smarty->assign('total_records', 		count($emails_list));
			$this->smarty->assign('atachName', 			$NewName);
			$this->smarty->assign('content_head',		$MSGTEXT['classesmailer_caption']);
		}
		else {
			$this->smarty->assign('content_template',	'mailer/mailer_error_license.tpl');
			$this->smarty->assign('content_head',		$MSGTEXT['classesmailer_caption']);
		}
	}



	/**
	 * Генерирует случайную строку
	 *
	 * @param int $length
	 * @return string
	 */
	function generatePassword($length = 8){
		$chars 		= 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
		$numChars 	= strlen($chars);
		$string 	= '';
		for ($i = 0; $i < $length; $i++) {
			$string .= substr($chars, rand(1, $numChars) - 1, 1);
		}
		return $string;
	}



	/**
	 * Удаляет все источники и выводит форму поиска новых источников
	 *
	 */
	function refresh() {
		GLOBAL $MYSQL_TABLE9;

		$query				= "DELETE FROM `$MYSQL_TABLE9` WHERE `group_name_id`='{$this->get['group_name']}'";
		$result				= $this->mysql->executeSQL($query);

		$this->mailer_getlist();
	}



	/**
	 * Сохранение редактирования источников
	 *
	 */
	function save() {
		GLOBAL $MYSQL_TABLE9, $MSGTEXT, $MYSQL_TABLE25;

		if (isset($this->post['group_name'])) {
			//определяем группу с которой работаем
			if (isset($this->post['group_name'])) {
				$group_id=$this->post['group_name'];
			}
			elseif (isset($this->get['group_name'])) {
				$group_id=$this->get['group_name'];
			}
			else $group_id='';

			//если выбрано удаление
			if (isset($this->post['delete'])) $delete	= $this->post['delete'];
			else $delete	= array();

			$del	= array();
			foreach ($delete as $d) {
				$del[$d]	= true;
			}

			$ids	= $this->post['id'];
			foreach ($ids as $id) {

				//удаляем источник
				if (isset($del[$id]))	{
					$query		= "DELETE FROM `$MYSQL_TABLE9` WHERE `id`='$id'";
					$result		= $this->mysql->executeSQL($query);
				}
				//сохраняем редактирование источников
				else {
					$email_field_id		= $this->post['email_'.$id];
					$name_field_id		= $this->post['name_'.$id];
					$enable_field_id	= $this->post['enable_'.$id];

					$query		= "UPDATE `$MYSQL_TABLE9` SET `email_field_id`='$email_field_id', `name_field_id`='$name_field_id', `enable_field_id`='$enable_field_id' WHERE `id`='$id'";
					$result		= $this->mysql->executeSQL($query);
				}
			}


			$subject	= $this->post['subject'];
			$message	= $this->post['text'];
			$signature	= $this->post['makros_text'];

			$query		= "UPDATE `$MYSQL_TABLE25` SET `subject`='$subject', `message`='$message', `signature`='$signature'  WHERE `id`='$group_id'";
			$result		= $this->mysql->executeSQL($query);

			$this->smarty->assign('msgs', 	$MSGTEXT['classesmailer_saved']);
		}

		$this->mailer_getlist();
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