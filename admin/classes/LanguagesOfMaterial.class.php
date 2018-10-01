<?php
/**
 * класс для редактирования списка языков материала
 *
 */
class LanguagesOfMaterial  {

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
	function LanguagesOfMaterial($mysql, $smarty, $post, $postr, $posts, $get, $getr, $gets,  $do) {

		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		$this->post		= $post;
		$this->get		= $get;
		$this->postr	= $postr;
		$this->posts	= $posts;
		$this->getr		= $getr;
		$this->gets		= $gets;

		switch ($do):
		case ('list'):					$this->languagesofmaterial_getlist(); 			break;
		case ('saveedit'):				$this->languagesofmaterial_saveedit();	 		break;
		case ('dictionary_edit'):		$this->languagesofmaterial_dictionary_edit(); 	break;
		case ('dictionary_save'):		$this->languagesofmaterial_dictionary_save(); 	break;
		endswitch;
	}


	/**
   * получаем список фраз в словаре
   *
   */
	function languagesofmaterial_dictionary_edit($DICTIONARY_TEXT=null) {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT;

		include ($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/dictionary/configLanguage.php');  //подключаем языки материала

		if ($DICTIONARY_TEXT==null) {
			include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/dictionary/dictionary.php');  //подключаем словарь
		}

		foreach ($LANGUAGES_OF_MATERIAL as $prefix=>$lang) {
			$LANGUAGES_OF_MATERIAL[$prefix]['prefix']=$prefix;
		}

		if (isset($this->get['lang_edit']) && $this->get['lang_edit']!='') {
			//получаем префикс языка
			foreach ($LANGUAGES_OF_MATERIAL as $prefix=>$l) {
				if ($l['id']==$this->get['lang_edit']) {
					$lang_prefix	= $prefix;
					break;
				}
			}

			//получаем префикс языка сайта по умолчанию
			$lang_prefix_default= 'key_phrases';
			$current_dictionary	= array();
			$k					= 0;


			foreach ($DICTIONARY_TEXT[$lang_prefix_default] as $key=>$d) {
				$current_dictionary[$k]['phrase']=$key;


				if ($el=@array_slice($DICTIONARY_TEXT[$lang_prefix], $k,1)) {
					foreach ($el as $perevod=>$e) {
						$current_dictionary[$k]['perevod']=$perevod;
					}
				}
				else {
					$current_dictionary[$k]['perevod']='';
				}

				if (mb_strlen($current_dictionary[$k]['phrase'])>100) {
					$current_dictionary[$k]['edit_type']='textarea';
				}
				else {
					$current_dictionary[$k]['edit_type']='input';
				}

				$k++;
			}


			$this->smarty->assign('current_dictionary',				$current_dictionary);
			$this->smarty->assign('lang_prefix_default',			$lang_prefix_default);
			$this->smarty->assign('lang_prefix',					$lang_prefix);
		}

		$_SESSION['___GoodCMS']['SORT_BY_FIELD']	= 'sort_index';	//устанавливаем по какому полю отсортировать ассоциативный массив

		usort($LANGUAGES_OF_MATERIAL, array($GENERAL_FUNCTIONS, 'sortByIntGrow'));

		$this->smarty->assign('content_template',		'languagesofmaterial/dictionary_edit.tpl');
		$this->smarty->assign('LANGUAGES_OF_MATERIAL',	$LANGUAGES_OF_MATERIAL);
		$this->smarty->assign('content_head',			$MSGTEXT['classeslanguagesofmaterial_files']);
		$this->smarty->assign('errorMsgs',				$this->errorMsgs);
		$this->smarty->assign('messages',				$this->messages);
	}



	/**
     * сохранение редактирования css-файла
     *
     */
	function languagesofmaterial_dictionary_save() {
		GLOBAL $FILE_MANAGER, $MSGTEXT;

		require_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/dictionary/configLanguage.php');  	//подключаем языки материала
		require_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/dictionary/dictionary.php');  		//подключаем фразы из словаря

		if (count($this->posts)>0) {
			//получаем префикс языка
			foreach ($LANGUAGES_OF_MATERIAL as $prefix=>$l) {
				if ($l['id']==$this->get['lang_edit']) {
					$lang_prefix	= $prefix;
					break;
				}
			}

			//получаем префикс языка сайта по умолчанию
			$lang_prefix_default	= 'key_phrases';
			$languages				= array();
			$del_records			= array();
			if (isset($this->post['perevod'])) {
				$ind=0;
				foreach ($this->post['perevod'] as $caption) {
					$del=false;
					if (isset($this->post['delete'])) {
						foreach ($this->post['delete'] as $delete) {
							if ($delete==($ind+1)) {
								$del=true;
								break;
							}
						}
					}

					if (!$del) {
						$tmp['perevod']	= $caption;
						$languages[]	= $tmp;
					}
					else {
						$del_records[]	= $ind;
					}
					$ind++;
				}
			}

			//удаляем ненужные записи
			foreach ($DICTIONARY_TEXT as $prefix=>$dt) {
				$clean_data	= array();
				$ind		= 0;
				$position	= 0;
				foreach ($dt as $d_caption=>$d) {
					if (!in_array($ind, $del_records)) {
						$clean_data[$d_caption]	= $position;
						$position++;
					}
					$ind++;
				}
				$DICTIONARY_TEXT[$prefix]		= $clean_data;
			}

			//проверяем на корректность заполнения полей
			$k	= 0;
			foreach ($languages as $key=>$lan) {
				if ($lan['perevod']=='') {
					if ($el=@array_slice($DICTIONARY_TEXT[$lang_prefix_default], $k, 1)) {
						foreach ($el as $perevod=>$e) {
							$languages[$key]['perevod']=$perevod;
						}
					}
				}
				elseif (is_numeric($lan['perevod']))	{
					$this->errorMsgs[]	= $MSGTEXT['classeslanguagesofmaterial_b_for_caption'];
					break;
				}
				$k++;
			}


			$povtor=true;
			while ($povtor) {
				foreach ($languages as $key=>$lan) {
					$flag	= false;
					$povt	= 0;
					$povt2	= 0;
					$povt3	= 0;
					$povt4	= 0;
					foreach ($languages as $key2=>$lan2) {
						if ($lan['perevod']==$lan2['perevod']) {
							$povt4++;
							if ($povt4==2) {
								$languages[$key2]['perevod'].=chr(1);	//добавляем символ, чтоб отличалось
								break;
							}
						}
					}
					if ($povt4>1) {
						break;
					}
				}

				if (!isset($povt4) || $povt4<2) {
					break;
				}
			}


			//сохранение в файл
			if (count($this->errorMsgs)==0) {
				$new_data	= array();
				$tmp		= array();
				$position	= 0;
				foreach ($languages as $lang) {
					$new_data[$lang['perevod']]	= $position;
					$position++;
				}

				$DICTIONARY_TEXT[$lang_prefix]	= $new_data;

				$data		= var_export($DICTIONARY_TEXT,true);

				$this->smarty->assign('data',	$data);
				$content	= $this->smarty->fetch( $_SERVER['DOCUMENT_ROOT']. '/'.SETTINGS_ADMIN_PATH.'/templates/languagesofmaterial/dictionary_massiv.tpl');
				$fname		= $_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/dictionary/dictionary.php';
				if ($fd		= $FILE_MANAGER->fopen($fname, 'w')) {
					fwrite($fd, $content);
					fclose($fd);
					$this->messages		= $MSGTEXT['classeslanguagesofmaterial_is_save'];
				}
				else {
					$this->errorMsgs[]	= sprintf($MSGTEXT['classeslanguagesofmaterial_canot_write'], $fname);
				}
			}
			else {
				$DICTIONARY_TEXT=array();
				$d=array();
				include($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/dictionary/dictionary.php');  //подключаем разделы категории

				$position	= 0;
				foreach ($this->post['perevod'] as $value) {
					if ($value=='' || isset($d[$value])) {
						if ($el=@array_slice($DICTIONARY_TEXT[$lang_prefix_default], $position, 1)) {
							foreach ($el as $perevod=>$e) {
								$value=$perevod;
							}
						}
					}

					$d[$value]=$position;

					$position++;
				}

				$DICTIONARY_TEXT[$lang_prefix]=$d;
			}
		}

		$this->languagesofmaterial_dictionary_edit($DICTIONARY_TEXT);
	}



	/**
	 * получаем список языков
	 *
	 */
	function languagesofmaterial_getlist() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT;

		if (count($this->errorMsgs)==0) {
			require_once($_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/dictionary/configLanguage.php');  //подключаем языки материала
			foreach ($LANGUAGES_OF_MATERIAL as $prefix=>$lang) {
				$LANGUAGES_OF_MATERIAL[$prefix]['prefix']=$prefix;
			}
			$_SESSION['___GoodCMS']['SORT_BY_FIELD']	= 'sort_index';	//устанавливаем по какому полю отсортировать ассоциативный массив
			usort($LANGUAGES_OF_MATERIAL, array($GENERAL_FUNCTIONS, 'sortByIntGrow'));
		}

		$this->smarty->assign('content_template',			'languagesofmaterial/languagesofmaterial_edit.tpl');
		if (isset($LANGUAGES_OF_MATERIAL)) 		{
			$this->smarty->assign('LANGUAGES_OF_MATERIAL',	$LANGUAGES_OF_MATERIAL);
		}
		$this->smarty->assign('content_head',				$MSGTEXT['classeslanguagesofmaterial_files']);
		$this->smarty->assign('errorMsgs',					$this->errorMsgs);
		$this->smarty->assign('messages',					$this->messages);
	}



	/**
     * сохранение редактирования css-файла
     *
     */
	function languagesofmaterial_saveedit() {
		GLOBAL $FILE_MANAGER, $MSGTEXT;

		$languages	= array();
		if (isset($this->post['id'])) {
			$ind=0;
			foreach ($this->post['id'] as $lang_id) {
				$del=false;
				if (isset($this->post['delete'])) {

					foreach ($this->post['delete'] as $delete) {

						if ($delete==($ind+1)) {
							$del=true;
							break;
						}
					}
				}

				if (!$del) {
					$tmp['id']					= $lang_id;
					$tmp['prefix']				= $this->post['prefix'][$ind];
					$tmp['caption']				= $this->post['caption'][$ind];
					$tmp['sort_index']			= $this->post['sort_index'][$ind];
					$languages[]				= $tmp;
				}
				$ind++;
			}
		}

		//проверяем на корректность заполнения полей
		foreach ($languages as $key=>$lan) {
			if (!preg_match('/^(\d){1,}$/iu', $lan['id']) )	{
				$languages[$key]['id_edit']=true;
				$this->errorMsgs[]	= $MSGTEXT['classeslanguagesofmaterial_b_for_id'];
				break;
			}

			if (!preg_match('/^(\d){1,}$/iu', $lan['sort_index']) )	{
				$this->errorMsgs[]	= $MSGTEXT['classeslanguagesofmaterial_b_for_sort_index'];
				break;
			}

			if (!preg_match('/^[a-z]*$/iu', $lan['prefix']))	{
				$this->errorMsgs[]	= $MSGTEXT['classeslanguagesofmaterial_b_for_prefix'];
				break;
			}

			if ($lan['caption']=='')	{
				$this->errorMsgs[]	= $MSGTEXT['classeslanguagesofmaterial_b_for_caption'];
				break;
			}
		}


		foreach ($languages as $key=>$lan) {
			$flag	= false;
			$povt	= 0;
			$povt2	= 0;
			$povt3	= 0;
			$povt4	= 0;
			foreach ($languages as $key2=>$lan2) {

				if ($lan['id']==$lan2['id']) {
					$povt++;
					if ($povt==2) {
						$languages[$key]['id_edit']		= true;
						$languages[$key2]['id_edit']	= true;
						$this->errorMsgs[]	= $MSGTEXT['classeslanguagesofmaterial_twins_id'];
						$flag				= true;
						break;
					}
				}

				if ($lan['prefix']==$lan2['prefix']) {
					$povt2++;
					if ($povt2==2) {
						$this->errorMsgs[]	= $MSGTEXT['classeslanguagesofmaterial_twins_prefix'];
						$flag				= true;
						break;
					}
				}

				if ($lan['sort_index']==$lan2['sort_index']) {
					$povt3++;
					if ($povt3==2) {
						$this->errorMsgs[]	= $MSGTEXT['classeslanguagesofmaterial_twins_sort_index'];
						$flag				= true;
						break;
					}
				}

				if ($lan['caption']==$lan2['caption']) {
					$povt4++;
					if ($povt4==2) {
						$this->errorMsgs[]	= $MSGTEXT['classeslanguagesofmaterial_twins_caption'];
						$flag				= true;
						break;
					}
				}
			}

			if ($flag) break;
		}


		//сохранение в файл
		if (count($this->errorMsgs)==0) {
			$lang_save	= array();
			$tmp		= array();
			foreach ($languages as $lang) {
				$tmp['id']					= $lang['id'];
				$tmp['caption']				= $lang['caption'];
				$tmp['sort_index']			= $lang['sort_index'];
				$lang_save[$lang['prefix']]	= $tmp;
			}

			$data		= var_export($lang_save,true);
			$this->smarty->assign('data',	$data);
			$content	= $this->smarty->fetch('languagesofmaterial/languagesofmaterial_massiv.tpl');

			$fname=$_SERVER['DOCUMENT_ROOT'].'/'.SETTINGS_ADMIN_PATH.'/dictionary/configLanguage.php';
			if ($fd		= $FILE_MANAGER->fopen($fname, 'w')) {
				fwrite($fd, $content);
				fclose($fd);
				$this->messages		= $MSGTEXT['classeslanguagesofmaterial_is_save'];
			}
			else {
				$this->errorMsgs[]	= sprintf($MSGTEXT['classeslanguagesofmaterial_canot_write'], $fname);
				$this->smarty->assign('LANGUAGES_OF_MATERIAL',		$languages);
			}

		}
		else {
			$this->smarty->assign('LANGUAGES_OF_MATERIAL',		$languages);
		}

		$this->languagesofmaterial_getlist();
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