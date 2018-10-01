<?php
/**
 * класс для работы с css-файлами
 *
 */
class Css  {

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
	function Css($mysql, $smarty, $post, $postr, $get, $getr,  $do) {

		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		$this->post		= $post;
		$this->get		= $get;
		$this->postr	= $postr;
		$this->getr		= $getr;

		switch ($do):
		case ('list'):					$this->css_getlist(); 			break;
		case ('form_add'):				$this->css_form_add(); 			break;
		case ('insert'):				$this->css_insert(); 			break;
		case ('delete'):				$this->css_delete(); 			break;
		case ('edit'):					$this->css_form_edit(); 		break;
		case ('saveedit'):				$this->css_saveedit();	 		break;
		endswitch;
	}


	
	/**
	 * возвращает список всех файлов в заданной директории
	 *
	 * @param  string $dir
	 * @return array
	 */
	function searchdir ( $path , $maxdepth = -1 , $mode = 'FILES' , $d = 0 ) {

		if ( mb_substr ( $path , mb_strlen ( $path ) - 1 ) != '/' )     	$path .= '/';

		$dirlist = array ();
		if ($mode != 'FILES')  $dirlist[] = $path;

		if ($handle = @opendir ($path) ) {
			while (false !== ($file = readdir($handle))) {

				if ($file != '.' && $file != '..' && $file != SETTINGS_ADMIN_PATH  &&  $file != 'ckfinder' && $file != 'tinymce'&& $file != 'ckeditor') {
					$fullName 		= $path.$file;
					$tmp['dirfull']	= $path;
					$tmp['dir']		= mb_substr($path, mb_strlen($_SERVER['DOCUMENT_ROOT'])+1);

					$tmp['name']	= $file;

					if ( ! is_dir ($fullName) ) {
						if ( $mode != 'DIRS' )  $dirlist[] = $tmp;
					}
					elseif ( $d >=0 && ($d < $maxdepth || $maxdepth < 0) ) {
						$result = $this->searchdir ($fullName . '/' , $maxdepth , $mode , $d + 1 ) ;
						$dirlist = array_merge ( $dirlist , $result ) ;
					}
				}
			}
			closedir ($handle);
		}

		return ($dirlist);
	}


	
	/**
	 * получаем списо css-файлов
	 *
	 */
	function css_getlist() {
		GLOBAL $MSGTEXT, $GENERAL_FUNCTIONS;

		$_SESSION['___GoodCMS']['rdo']='list';

		//поиск css-файлов
		$home_dir		= $_SERVER['DOCUMENT_ROOT'].'/';
		$allfiles		= $this->searchdir($home_dir);

		
		//добавляем файл стилей CKeditor-редактора
		$file			= 'contents.css';
		$path 			= $home_dir.'/tools/ckeditor/';
		$tmp['dirfull']	= $path;
		$tmp['dir']		= mb_substr($path, mb_strlen($_SERVER['DOCUMENT_ROOT'])+1);
		$tmp['name']	= $file;
		$tmp['sys']		= true;
		$allfiles[]		= $tmp;

		$allcss			= array();
		for ($i=0; $i<count($allfiles); $i++) {

			$fname	= $allfiles[$i]['name'];

			$ext	= mb_substr($fname, mb_strlen($fname)-4);
			if ($ext=='.css') {

				$fullname 	= $allfiles[$i]['dirfull'].$allfiles[$i]['name'];
				$fs			=  number_format(round(filesize($fullname)/1000, 2), 2, '.', '');

				$allcss[$i]['size']		= $fs;
				$allcss[$i]['name']		= $allfiles[$i]['name'];
				$allcss[$i]['dir']		= $allfiles[$i]['dir'];
				if (isset($allfiles[$i]['sys']))	$allcss[$i]['sys']		= $allfiles[$i]['sys'];


				$mt		= filemtime($fullname);
				$mtime	= date('Y M d H:i:s', $mt);

				$allcss[$i]['modify'] 	=  $mtime;
				$allcss[$i]['mt']		= $mt;
			}
		}

		$sort			= $GENERAL_FUNCTIONS->getSortVariables('name');
		if ($sort['sort_type']=='size') {
			$allcss	= $GENERAL_FUNCTIONS->sort_massiv_by_int($sort['sort_type'], $allcss);
		}
		else {
			$allcss		= $GENERAL_FUNCTIONS->sort_massiv($sort['sort_type'], $allcss);
		}
		
		$obj			= $GENERAL_FUNCTIONS->form_navigations(20, $allcss, '?act=css&sort_by='.$sort['sort_by'].'&sort_type='.$sort['sort_type']);
		$css			= $obj['records'];
		$pages			= $obj['pages'];

		$this->smarty->assign('content_template',	'css/css_list.tpl');
		$this->smarty->assign('css',				$css);
		$this->smarty->assign('pages', 				$pages);
		$this->smarty->assign('content_head',		$MSGTEXT['classescss_files']);
		$this->smarty->assign('sort_by',			$sort['sort_by']);
		$this->smarty->assign('sort_type',			$sort['sort_type']);
	}



	/**
     * форма создания css-файла
     *
     */
	function css_form_add () {
		GLOBAL $MSGTEXT;

		$this->smarty->assign('content_template',	'css/css_form_add.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['classescss_ceate_new']);
	}


	
	/**
     * обработка формы создания css-файла
     *
     */
	function css_insert() {
		GLOBAL $FILE_MANAGER, $MSGTEXT, $GENERAL_FUNCTIONS, $CSS_DIR;

		$home_dir	= $CSS_DIR;
		if (!is_dir($home_dir)) {
			if (!$FILE_MANAGER->mkdir($home_dir)) {
				$this->smarty->assign('message',			sprintf($MSGTEXT['classescss_canot_makehomedir'], $home_dir));
				$h_dir=false;
			}
			else $h_dir=true;
		}
		else $h_dir=true;

		$fname		= $this->postr['name'];

		$ext		= mb_substr($fname, mb_strlen($fname)-4);
		if ($ext!=='.css') {
			$fname.='.css';
		}

		if ($h_dir && $fname=='.css') {
			$this->smarty->assign('content_template',	'css/css_form_add.tpl');
			$this->smarty->assign('content_head',		$MSGTEXT['classescss_ceate_new']);
			$this->smarty->assign('message',			$MSGTEXT['classescss_err_no_name']);
		}
		elseif ($h_dir && !file_exists($home_dir.$fname)) {
			$file = $FILE_MANAGER->fopen($home_dir.$fname, 'w');
			if ($file==false) {
				$this->smarty->assign('content_template',	'css/css_form_add.tpl');
				foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
				$this->smarty->assign('content_head',		$MSGTEXT['classescss_ceate_new']);
				$this->smarty->assign('message',			$MSGTEXT['classescss_err']);
			}
			else {
				fwrite($file, $this->postr['content']);
				fclose($file);
				$GENERAL_FUNCTIONS->gotoURL('?act=css');
			}
		}
		else {
			$this->smarty->assign('content_template',	'css/css_form_add.tpl');
			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
			$this->smarty->assign('content_head',		$MSGTEXT['classescss_ceate_new']);
			$this->smarty->assign('message',			$MSGTEXT['classescss_err_name']);
		}
	}

	

	/**
     * удаляем css-файл
     *
     */
	function css_delete() {
		GLOBAL $FILE_MANAGER, $GENERAL_FUNCTIONS;



		$FILE_MANAGER->unlink($_SERVER['DOCUMENT_ROOT'].'/'.$this->get['fname']);
		$GENERAL_FUNCTIONS->gotoURL('?act=css');
	}

	
	
	/**
     * форма редактирования css-файла
     *
     */
	function css_form_edit() {
		GLOBAL $MSGTEXT, $FILE_MANAGER;

		if (!file_exists('/'.$this->get['fname'])) {
			$this->smarty->assign('content_template', 'css/css_form_edit.tpl');
			$fcontent 	= $FILE_MANAGER->getfile ($_SERVER['DOCUMENT_ROOT'].'/'.$this->get['fname']);
			$fcontent	= htmlspecialchars($fcontent, ENT_QUOTES);

			$this->smarty->assign('content', 		$fcontent);
			$this->smarty->assign('name', 			basename($this->get['fname']));
			$this->smarty->assign('old_name', 		basename($this->get['fname']));
			$this->smarty->assign('dir_name', 		dirname($this->get['fname']));
			$this->smarty->assign('content_head', 	$MSGTEXT['classescss_edited']);
		}
	}

	

	/**
     * сохранение редактирования css-файла
     *
     */
	function css_saveedit() {
		GLOBAL $FILE_MANAGER, $MSGTEXT;

		if (isset($this->postr['content'])) {
			$this->smarty->assign('content_head', 		$MSGTEXT['classescss_edited']);
			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);

			$old_name	= $_SERVER['DOCUMENT_ROOT'].'/'.$this->postr['dir_name'].'/'.$this->postr['old_name'];
			$new_name	= $_SERVER['DOCUMENT_ROOT'].'/'.$this->postr['dir_name'].'/'.$this->postr['name'];

			if (($this->postr['old_name']!=$this->postr['name']) && (file_exists($new_name))) {
				$this->smarty->assign('name', $this->postr['old_name']);
				$this->smarty->assign('message', sprintf($MSGTEXT['classescss_err_file_name'], $this->postr['name']));
			}
			else {
				if (!mb_strpos($old_name,SETTINGS_ADMIN_PATH.'/ckeditor/contents.css') ) {
					if (!$FILE_MANAGER->rename($old_name, $new_name)) {
						$this->smarty->assign('name', 		$this->postr['old_name']);
						$this->smarty->assign('message', 	sprintf($MSGTEXT['classescss_err_rename'], stripcslashes($this->post['name'])));
					}
					else {
						$this->smarty->assign('message', 	$MSGTEXT['classescss_create_save']);
					}
				}
				else {
					$new_name=$old_name;
					if ($this->postr['old_name']!=$this->postr['name']) {
						$this->smarty->assign('message', 	$MSGTEXT['classescss_canot_rename']);
					}
					else {
						$this->smarty->assign('message', 	$MSGTEXT['classescss_create_save']);
					}
				}

				$content	= $this->postr['content'];
				$file		= $FILE_MANAGER->fopen($new_name, 'w');
				fwrite($file, $content);
				fclose($file);
			}
			$this->smarty->assign('content_template', 'css/css_form_edit.tpl');
		}
		else {
			$this->css_form_edit();
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