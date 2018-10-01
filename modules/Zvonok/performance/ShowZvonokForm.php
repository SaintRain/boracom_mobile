<?php

/*///////////////////////////////////////////////////////////////////////////////////////////
Форма заказа звонка
*////////////////////////////////////////////////////////////////////////////////////////////
class ShowZvonokForm extends Zvonok {

	/**
     * Определяем какую функцию выполнить
     * 
     */
	function linker() {

		//вызываем функцию - обработчик
		switch ($this->action):
		case ('send'):					$this->send(); 		break;
		default:						$this->START(); 	break;
		endswitch;
	}



	/**
	 * Стартовая функция, вызывается по умолчанию
	 */
	function START() {
		GLOBAL $FRAME_FUNCTIONS;

		$query			= "SELECT t.*, t2.reg FROM `{$this->tablePrefix}data` AS `t` LEFT JOIN `{$this->tablePrefix}regs` AS `t2` ON (t2.id=t.regular) ORDER BY t.sort_index DESC";
		$result			= $this->mysql->executeSQL($query);
		$fields			= $this->mysql->fetchAssocAll($result);

		$fields			= $FRAME_FUNCTIONS->htmlspecialcharsToObject($fields);

		foreach ($fields as $k=>$v) {
			$fields[$k]['select_values']	= explode(SETTINGS_NEW_LINE, $v['select_values']);
		}

		$this->smarty->assign('moduleInfo', 	$this->moduleInfo);
		$this->smarty->assign('errors', 		$this->errors);
		$this->smarty->assign('settings', 		$this->settings);

		$this->smarty->assign('table_name', 	$this->tablePrefix.'data');

		if ($this->settings['formType']==0) {
			$this->smarty->assign('fields', 		$fields);
			$this->contentOUT = $this->smarty->fetch($this->tplLocation.'ContactForm.tpl');
		}
		else {
			//для нестандартной формы поля доступны по ключу
			$f	= array();
			foreach ($fields as $k=>$v) {
				$f[$v['key']]=$v;
			}
			$fields = $f;

			$this->smarty->assign('fields', 		$fields);
			$this->contentOUT = $this->smarty->fetch($this->tplLocation.'DesignerContactForm.tpl');
		}
	}



	/**
	 * Отправка сообщения c проверкой
	 *
	 */
	function send() {
		GLOBAL $FRAME_FUNCTIONS;

		$query			= "SELECT t.*, t2.reg FROM `{$this->tablePrefix}data` AS `t` LEFT JOIN `{$this->tablePrefix}regs` AS `t2` ON (t2.id=t.regular) ORDER BY t.sort_index DESC";
		$result			= $this->mysql->executeSQL($query);
		$fields			= $this->mysql->fetchAssocAll($result);

		//проверяем корректность заполнения полей
		$attachments 	= array();
		$msgFields		= array();
		$mail_from		= '';
		$mail_from_name	= '';
		foreach ($fields as $k=>$v) {
			$reg		= $v['reg'];

			if ($this->settings['formType']==0) {
				$field_name	= 'field_'.$v['id'];
			}
			else {
				$field_name	= $v['key'];
			}

			if (!isset($this->post[$field_name])) {
				$this->post[$field_name]='';
			}

			//если поле должно быть обязательно заполнено
			if ($v['nnull'] && $this->post[$field_name]=='') {
				$this->errors[]	=  sprintf('Неверно заполнено поле «%s».', $v['caption']);
			}

			if ($reg!='' && $this->post[$field_name]!='')	{
				if (!preg_match($reg, $this->post[$field_name])) {
					$this->errors[]	=  sprintf('Неверно заполнено поле «%s».', $v['caption']);
				}
			}

			if ($v['key']=='UserEmail') $mail_from		= $this->post[$field_name];
			if ($v['key']=='UserName') $mail_from_name	= $this->post[$field_name];

			if ($v['type']=='File') {
				$load_res	= $this->checkFile($field_name, $v['extensions']);

				if ($load_res=='bad_ext') {
					$this->errors[]	= sprintf('Допускаются файлы только с расширением  «%s».', $v['extensions']);
				}
				elseif	($load_res!=false) {
					$attachments[]	= $load_res;;
				}
			}

			$tmp['caption']			= $v['caption'];

			if ($v['type']=='MultiSelect' && is_array($this->post[$field_name])) {
				$tmp['userText']	= implode(',', $this->post[$field_name]);
			}
			else if ($v['type']=='Checkbox') {
				if ($this->post[$field_name]==1) {
					$tmp['userText']	= 'Да';
				}
				else {
					$tmp['userText']	= 'Нет';
				}
			}
			else if ($v['type']=='Radio') {
				if ($this->post[$field_name]!='') {
					$tmp['userText']	= $this->post[$field_name];
				}
			}
			elseif ($v['type']!='File' && $v['type']!='Text')  {
				$tmp['userText']		= $this->post[$field_name];
			}

			if ($v['type']!='File' && $v['type']!='Text') {
				$msgFields[]		= $tmp;
			}
		}

		if($this->settings['kcaptcha']==1) {
			if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $this->post['kcaptcha']){
			}
			else{
				$this->errors[]	= 'Неверно введены цифры с изображения.';
			}
		}

		if (count($this->errors)==0) {
			$this->smarty->assign('msgFields', 	$msgFields);
			$body 	= $this->smarty->fetch($this->tplLocation.'MessageFormat.tpl');


			$mail	= $FRAME_FUNCTIONS->getMailObject($this->settings['sendEmailTo'], $this->settings['usernameEmailCaption'], $mail_from, $mail_from_name, $this->settings['mailSubject'], $body);


			//добавляем вложения
			foreach ($attachments as $atach) {
				$mail->add_attachment($atach['file'],$atach['file_name']);
			}

			$res	= $mail->send(); 	//делаем отправку

			$this->smarty->assign('table_name', 	$this->tablePrefix.'data');
			$this->smarty->assign('sendResult', 	$res);
			$this->contentOUT = $this->smarty->fetch($this->tplLocation.'SendResult.tpl');
			$this->smarty->assign($this->tagInfo['system_tagname'], $this->contentOUT);
			$_SESSION['captcha_keystring']='';
                        $FRAME_FUNCTIONS->gotoURL('/zayavka-zvonka');
		}
		else {
			if ($this->settings['formType']==0) {
				$this->smarty->assign('post', $this->post);
			}
			else {
				foreach ($this->post as $key=>$val) {
					$this->smarty->assign($key, $val);
				}
			}

			$this->START();
		}
	}



	/**
	 * Проверяет расширения закачиваемого файла
	 *
	 * @param string $filename
	 * @param string $fileExtensions
	 * @return array
	 */
	function checkFile($filename, $fileExtensions) {

		if	(isset($_FILES[$filename]['name']) && $_FILES[$filename]['name']!='') {

			if ($fileExtensions!='') {
				$fileExtensions	= str_replace(' ', '', $fileExtensions);
				$ext_array		= explode(',', $fileExtensions);

				$fname			= $_FILES[$filename]['name'];
				$k				= mb_strpos($fname, '.');
				$f_extension	= mb_strtolower(mb_substr($fname,	$k));

				$god_ext		= false;
				for ($i=0; $i<count($ext_array); $i++) {
					if ($f_extension==$ext_array[$i]) {
						$god_ext	= true;
						break;
					}
				}
			}
			else {
				$god_ext	= true;
			}

			if ($god_ext) {
				$attachment['file'] 		= $_FILES[$filename]['tmp_name'];
				$attachment['file_name']	= $_FILES[$filename]['name'];
				return $attachment;
			}
			else return 'bad_ext';
		}
		else return false;
	}



}

?>