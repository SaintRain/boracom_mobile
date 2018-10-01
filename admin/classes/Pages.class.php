<?php
/**
 * класс для работы со страницами 
 *
 */
class Pages  {

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
     * нужно ли обновлять левы фрейм
     *
     * @var bool
     */
	public 		$refreshFrame;
	
	/**
     * Конструктор
     * 
     * @param class $smarty
     */
	function Pages($mysql, $smarty, $post=null, $postr=null, $get=null, $getr=null,  $do=null) {

		$this->mysql	= $mysql;
		$this->smarty	= $smarty;
		$this->post		= $post;
		$this->get		= $get;
		$this->postr	= $postr;
		$this->getr		= $getr;

		switch ($do):
		case (null):					return null;
		case ('list'):					$this->pages_getlist(); 			break;
		case ('form_add'):				$this->pages_form_add();			break;
		case ('insert'):				$this->pages_insert(); 				break;
		case ('delete'):				$this->pages_delete(); 				break;
		case ('edit'):					$this->pages_form_edit();			break;
		case ('saveedit'):				$this->pages_saveedit(); 			break;
		case ('category_form'):			$this->pages_category_form(); 		break;
		case ('category_create'):		$this->pages_category_create(); 	break;
		case ('category_update'):		$this->pages_category_update(); 	break;
		case ('category_delete'):		$this->pages_category_delete(); 	break;
		case ('category_put'):			$this->pages_category_putForm(); 	break;
		case ('category_putdo'):		$this->pages_category_putDo(); 		break;
		case ('moveCategory'):			$this->pages_moveCategory(); 		break;
		case ('movePage'):				$this->pages_movePage(); 			break;
		case ('set_page_status'):		$this->setPageStatus(); 			break;
		case ('set_cache_status'):		$this->setCacheStatus(); 			break;
		case ('set_selected_status'):	$this->setSelectedStatus(); 		break;
		endswitch;


		if ((isset($this->get['pageCategoryId'])) && ($this->get['pageCategoryId']!='')) $this->smarty->assign('pageCategoryId', $this->get['pageCategoryId']);
	}



	/**
	 * меняет статус публикации страницы
	 *
	 */
	function setPageStatus() {
		GLOBAL $MYSQL_TABLE3;

		$query		= "SELECT `templates_id` FROM `$MYSQL_TABLE3` WHERE  `id`='{$this->get['id']}'";
		$result		= $this->mysql->executeSQL($query);
		$page		= $this->mysql->fetchAssoc($result);
		//если назначен шаблон
		if ($page['templates_id']) {
			$query		= "UPDATE `$MYSQL_TABLE3` SET `enable`='{$this->get['enable']}' WHERE  `id`='{$this->get['id']}'";
			$result		= $this->mysql->executeSQL($query);
			$this->refreshFrame=1;
		}
		$this->pages_getlist();
	}



	/**
	 * меняет статус публикации страницы
	 *
	 */
	function setCacheStatus() {
		GLOBAL $MYSQL_TABLE3;

		$query		= "UPDATE `$MYSQL_TABLE3` SET `cache`='{$this->get['enable']}' WHERE  `id`='{$this->get['id']}'";
		$result		= $this->mysql->executeSQL($query);


		$this->deleteFromMemcache($this->get['pname']);

		$this->refreshFrame	= 1;
		$this->pages_getlist();
	}



	/**
	 * удаляет из кеша, если поменялся стутус
	 *
	 * @param string $memcache_page_key
	 */
	function deleteFromMemcache($p_name) {
		GLOBAL $MSGTEXT;

		if (class_exists('Memcache')) {
			$memcache 			= new Memcache();
			if (@$memcache->connect(SETTINGS_MEMCACHED_HOST, SETTINGS_MEMCACHED_PORT)) {

				if (SETTINGS_INDEX_PAGE==$p_name) $pagename='/';
				else $pagename			= $p_name;
				$memcache_page_key		= $pagename.'&session='.$_SESSION['___GoodCMS']['adminlogin'];

				$memcache->delete($pagename, 1);
				$memcache->delete($memcache_page_key, 1);
				return true;
			}
			else return false;
		}
		else return false;
	}



	/**
	 * меняет статус отмеченной страницы
	 *
	 */
	function setSelectedStatus () {
		GLOBAL $MYSQL_TABLE3;

		$query		= "UPDATE `$MYSQL_TABLE3` SET `selected`='{$this->get['enable']}' WHERE  `id`='{$this->get['id']}'";
		$result		= $this->mysql->executeSQL($query);
		$this->refreshFrame	= 1;
		$this->pages_getlist();
	}



	/**
	 * устонавливает порядок сортировки для категории
	 *
	 */
	function pages_movePage() {
		GLOBAL  $MSGTEXT, $MYSQL_TABLE3;

		if (isset($this->get['pageCategoryId'])) {
			$where		= "WHERE `page_category`='{$this->get['pageCategoryId']}' ";
		}
		else  $where	= 'WHERE `page_category`=0 ';

		$id			= $this->get['id'];
		$query		= "SELECT * FROM  `$MYSQL_TABLE3` WHERE  `id`='$id'";
		$result		= $this->mysql->executeSQL($query);
		$cat		= $this->mysql->fetchAssoc($result);

		$query		= "SELECT * FROM  `$MYSQL_TABLE3` $where ORDER BY `sort_index`";
		$result		= $this->mysql->executeSQL($query);
		$catItems	= $this->mysql->fetchAssocAll($result);

		if ($catItems>1) {
			$min	= $catItems[0]['sort_index'];
			$max	= $catItems[count($catItems)-1]['sort_index'];

			for ($i=0; $i<count($catItems); $i++) {
				if ($catItems[$i]['id']==$cat['id']) {

					if ($this->get['type']=='up') {
						if ($i>0) $next	= $i-1;
						else {
							$this->smarty->assign('message',		$MSGTEXT['pages_class_cannot_move_page_top']);
							$next	= 0;
						}
					}
					elseif ($this->get['type']=='down') {
						if ($i<count($catItems)-1) $next = $i+1;
						else {
							$this->smarty->assign('message',		$MSGTEXT['pages_class_cannot_move_page_bottom']);
							$next	= count($catItems)-1;
						}
					}

					$moved		= $i;

					$query		= "UPDATE `$MYSQL_TABLE3` SET `sort_index`='{$catItems[$moved]['sort_index']}' WHERE  `id`='{$catItems[$next]['id']}'";
					$result		= $this->mysql->executeSQL($query);

					$query		= "UPDATE `$MYSQL_TABLE3` SET `sort_index`='{$catItems[$next]['sort_index']}' WHERE  `id`='{$catItems[$moved]['id']}'";
					$result		= $this->mysql->executeSQL($query);
					$this->refreshFrame=1;
					break;
				}
			}
		}
		$this->pages_getlist();
	}



	/**
	 * устонавливает порядок сортировки для категории
	 *
	 */
	function pages_moveCategory() {
		GLOBAL  $MSGTEXT, $MYSQL_TABLE8;

		$id			= $this->get['id'];

		$query		= "SELECT * FROM  `$MYSQL_TABLE8` WHERE  `id`='$id'";
		$result		= $this->mysql->executeSQL($query);
		$cat		= $this->mysql->fetchAssoc($result);

		$query		= "SELECT * FROM  `$MYSQL_TABLE8` WHERE  `parent`='{$cat['parent']}' ORDER BY `sort_index`";
		$result		= $this->mysql->executeSQL($query);
		$catItems	= $this->mysql->fetchAssocAll($result);

		if ($catItems>1) {
			$min	= $catItems[0]['sort_index'];
			$max	= $catItems[count($catItems)-1]['sort_index'];

			for ($i=0; $i<count($catItems); $i++) {
				if ($catItems[$i]['id']==$cat['id']) {

					if ($this->get['type']=='up') {
						if ($i>0) $next	= $i-1;
						else {
							$this->smarty->assign('message',		$MSGTEXT['pages_class_cannot_move_cat_top']);
							$next	= 0;
						}
					}
					elseif ($this->get['type']=='down') {
						if ($i<count($catItems)-1) $next = $i+1;
						else {
							$this->smarty->assign('message',		$MSGTEXT['pages_class_cannot_move_cat_bottom']);
							$next	= count($catItems)-1;
						}
					}

					$moved		= $i;
					$query		= "UPDATE `$MYSQL_TABLE8` SET `sort_index`='{$catItems[$moved]['sort_index']}' WHERE  `id`='{$catItems[$next]['id']}'";
					$result		= $this->mysql->executeSQL($query);

					$query		= "UPDATE `$MYSQL_TABLE8` SET `sort_index`='{$catItems[$next]['sort_index']}' WHERE  `id`='{$catItems[$moved]['id']}'";
					$result		= $this->mysql->executeSQL($query);

					$this->refreshFrame=1;
					break;
				}
			}
		}

		$this->smarty->assign('catSelected',	$cat['id']);
		$this->smarty->assign('catName',		$cat['name']);

		$this->pages_category_form();
	}



	/**
     * создаёт новую категорию
     *
     */
	function pages_category_create() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE8;

		if (isset($this->post['pageCategory'])) {
			$parent=$this->post['pageCategory'];
		}
		else {
			$parent=0;
		}

		$name		= addslashes($this->post['name']);

		$query		= "INSERT INTO `$MYSQL_TABLE8`  (`parent`, `name`, `sort_index`) VALUES ('$parent', '$name', '0')";
		$result		= $this->mysql->executeSQL($query);

		$sort_index	= $this->mysql->insertID();
		$query		= "UPDATE `$MYSQL_TABLE8`  SET `sort_index`='$sort_index' WHERE `id`='$sort_index'";
		$result		= $this->mysql->executeSQL($query);

		$this->smarty->assign('catSelected',	$sort_index);
		$this->smarty->assign('catName',		$this->post['name']);
		$this->smarty->assign('message',		$MSGTEXT['pages_class_new_cat_is_created']);
		$this->refreshFrame=1;

		$this->pages_category_form();
	}



	/**
	 * перемещаем каталог
	 *
	 */
	function pages_category_putDo() {
		GLOBAL $MYSQL_TABLE8;

		if ($this->post['cat_id']!=$this->post['pageCategory']) {
			$query	= "UPDATE `$MYSQL_TABLE8` SET `parent`='{$this->post['pageCategory']}' WHERE `id`='{$this->post['cat_id']}'";
			$result	= $this->mysql->executeSQL($query);
			$this->refreshFrame=1;
		}

		$this->pages_category_form();
	}



	/**
	 * форма перемещения категории
	 *
	 */
	function pages_category_putForm() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE8;

		$pageCategories	= $this->getPageCategoryTree();

		$query	= "SELECT `name` FROM `$MYSQL_TABLE8` WHERE `id`='{$this->post['pageCategory']}'";
		$result	= $this->mysql->executeSQL($query);
		list($cat_name) = $this->mysql->fetchRow($result);

		$this->smarty->assign('pages_category_putform_move_cat',	sprintf($MSGTEXT['pages_category_putform_move_cat'], $cat_name));
		$this->smarty->assign('content_template',		'pages/pages_category_putform.tpl');
		$this->smarty->assign('content_head',			$MSGTEXT['pages_class_edit_cat']);
		$this->smarty->assign('pageCategories',			$pageCategories);
		$this->smarty->assign('cat_name',				$cat_name);
		$this->smarty->assign('cat_id',					$this->post['pageCategory']);
	}



	/**
	 * обновляет название категории
	 *
	 */
	function pages_category_update() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE8;

		$name	= addslashes($this->post['name']);

		$query	= "UPDATE `$MYSQL_TABLE8` SET `name`='$name' WHERE `id`='{$this->post['pageCategory']}'";
		$result	= $this->mysql->executeSQL($query);

		$this->refreshFrame=1;
		$this->smarty->assign('catSelected',	$this->post['pageCategory']);
		$this->smarty->assign('catName',		$this->post['name']);

		$this->smarty->assign('message',		$MSGTEXT['pages_class_edit_save']);
		$this->pages_category_form();
	}



	/**
	 * удаляет категорию
	 *
	 */
	function pages_category_delete() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE8, $MYSQL_TABLE3;

		$query			= "SELECT * FROM `$MYSQL_TABLE8` WHERE `parent`='{$this->post['pageCategory']}'";
		$result			= $this->mysql->executeSQL($query);

		if ($this->mysql->numRows($result)>0) {
			$this->smarty->assign('message',		$MSGTEXT['pages_class_cannot_del_main_cat'] );
		}
		else {
			$query			= "UPDATE `$MYSQL_TABLE3` SET `page_category`='0' WHERE `page_category`='{$this->post['pageCategory']}'";
			$result			= $this->mysql->executeSQL($query);

			$query			= "SELECT * FROM `$MYSQL_TABLE8` WHERE `id`='{$this->post['pageCategory']}'";
			$result			= $this->mysql->executeSQL($query);
			$cat			= $this->mysql->fetchAssoc($result);

			$query			= "DELETE FROM `$MYSQL_TABLE8` WHERE `id`='{$this->post['pageCategory']}'";
			$result			= $this->mysql->executeSQL($query);
			$this->smarty->assign('message',		sprintf($MSGTEXT['pages_class_cat_is_del'], $cat['name']) );
			$this->refreshFrame=1;
		}

		$this->pages_category_form();
	}



	/**
	 * Получает категорию страницы и все страницы этой категории
	 *
	 * @return array
	 */
	function  getPageCategoryTreeAndPages() {
		GLOBAL $MYSQL_TABLE3, $MYSQL_TABLE8;

		$query 			= "SELECT * FROM `$MYSQL_TABLE8` ORDER BY `sort_index`";
		$result 		= $this->mysql->executeSQL($query);
		$allCats 		= $this->mysql->fetchAssocAll($result);
		$allCats		= $this->makeTree($allCats, 'id', 'parent', 0, -1);

		$categories 	= array();
		foreach ($allCats as $cat) {
			$categories[$cat['id']]=$cat;
		}

		$query 			= "SELECT * FROM `$MYSQL_TABLE3` ORDER BY `sort_index`";
		$result 		= $this->mysql->executeSQL($query);
		$allPages 		= $this->mysql->fetchAssocAll($result);

		foreach ($allPages as $data) {
			$categories[$data['page_category']]['pages'][]	= $data;
		}

		return $categories;
	}



	/**
	 * Формирует дерево категорй
	 *
	 * @param string $pk_field
	 * @param string $selected_filed
	 * @param string $parent_field
	 * @param int $ParentID
	 * @param int $lvl
	 * @return array
	 */	
	function makeTree($all_tree_records, $pk_field,  $parent_field,   $ParentID, $lvl) {
		$lvl++;
		$tree		=   array();
		foreach ($all_tree_records as $key=>$row) {
			if ($row[$parent_field]==$ParentID) {
				$row['deep']	= $lvl;
				$tree[]			= $row;
				$tmp			= $this->makeTree($all_tree_records, $pk_field, $parent_field,  $row['id'], $lvl);
				if (is_array($tmp)) $tree	= array_merge($tree, $tmp);
			}
		}
		return $tree;
	}



	/**
	 * Возвращает все существующие категории страниц в виде дерева
	 * 
	 * @return array|boolean - значение параметра или null если в БД он не найден
	 */	

	function getPageCategoryTree() {
		GLOBAL $MYSQL_TABLE3;

		$tree=$this->ShowTree(0, -1);
		return $tree;
	}



	/**
	 * формирует дерево каталогов
	 *
	 * @param int $ParentID
	 * @param int $lvl
	 * @return array
	 */
	function ShowTree($ParentID, $lvl) {
		GLOBAL  $MYSQL_TABLE8;

		$all_tree_records	= array();
		$query 				= "SELECT * FROM `$MYSQL_TABLE8` ORDER BY `sort_index`";
		$result				= $this->mysql->executeSQL($query);
		while ($row			= $this->mysql->fetchAssoc($result)) {
			$all_tree_records['id'.$row['id']] 	= $row;
		}

		$tree=$this->makeTree($all_tree_records, 'id', 'parent',   $ParentID, $lvl);
		return $tree;
	}



	/**
	 * Выводит форму редактирования категорий
	 *
	 */
	function pages_category_form() {
		GLOBAL $MSGTEXT;

		$pageCategories	= $this->getPageCategoryTree();

		$this->smarty->assign('content_template',	'pages/pages_category_form.tpl');
		$this->smarty->assign('content_head',		$MSGTEXT['pages_class_edit_cat']);
		$this->smarty->assign('pageCategories',		$pageCategories);
		$this->smarty->assign('refreshFrame',		$this->refreshFrame);
	}

	

	/**
     * получаем список страниц
     *
     */
	function pages_getlist() {
		GLOBAL $MSGTEXT, $GENERAL_FUNCTIONS, $MODULES_PERFORMANCE_PATCH_NAME, $MYSQL_TABLE2, $MYSQL_TABLE3,  $MYSQL_TABLE4, $MYSQL_TABLE5, $MYSQL_TABLE6, $MYSQL_TABLE7, $MYSQL_TABLE8, $MYSQL_TABLE10, $MYSQL_TABLE11,  $MYSQL_TABLE18;

		$_SESSION['___GoodCMS']['rdo']='list';

		if ((isset($this->get['pageCategoryId'])) && ($this->get['pageCategoryId']!=''))       {
			$query		= "SELECT `name` FROM `$MYSQL_TABLE8` WHERE `id`='{$this->get['pageCategoryId']}'";
			$result		= $this->mysql->executeSQL($query);
			list($pageCategoryName)	= $this->mysql->fetchRow($result);
			if ($pageCategoryName!='') $pageCategoryName	= sprintf($MSGTEXT['pages_class_p_from_cats'], $pageCategoryName);
			else $pageCategoryName	= $MSGTEXT['pages_class_p_without_cat'];

			$where		= " WHERE p.page_category='{$this->get['pageCategoryId']}' ";
			$pageCategoryId='&pageCategoryId='.$this->get['pageCategoryId'];
		}
		else  {
			$where				= '';
			$pageCategoryId		= '';
			$pageCategoryName	= $MSGTEXT['pages_class_p_from_all_cats'];
		}

		if (isset($this->get['page_id'])) {
			if ($where!='') $where.=" AND p.id='{$this->get['page_id']}'";
			else $where		= " WHERE p.id='{$this->get['page_id']}'";
			$page_id_text	= '&page_id='.$this->get['page_id'];
			$this->smarty->assign('page_id',			$this->get['page_id']);
		}
		else {
			$page_id_text	= '';
		}

		if (isset($this->post['searchpage'])) {
			$where	= " WHERE p.name LIKE '%{$this->post['searchpage']}%' OR p.description LIKE '%{$this->post['searchpage']}%'";
			$_SERVER['QUERY_STRING']='';
		}

		$query		= "SELECT p.*, t.name as `tpl_name`, t.tamplates_id as `tpl_id`, t.id as `virtual_tpl_id` FROM `$MYSQL_TABLE3` AS `p` LEFT JOIN `$MYSQL_TABLE10` AS `t` ON (t.id=p.templates_id) ".$where;
		$result		= $this->mysql->executeSQL($query);
		$allpages	= $this->mysql->fetchAssocAll($result);


		if (isset($this->get['sort_by']) && $this->get['sort_by']!='sort_index') {
			$sort		= $GENERAL_FUNCTIONS->getSortVariables('sort_index');
		}
		else {
			$sort['sort_type']			= 'hight';
			$sort['sort_by']			= 'sort_index';
			$_SESSION['___GoodCMS']['SORT_BY_FIELD']	= $sort['sort_by'];
		}

		if ($sort['sort_by']=='sort_index' ) {
			$allpages	= $GENERAL_FUNCTIONS->sort_massiv_by_int($sort['sort_type'], $allpages);
		}
		else {
			$allpages	= $GENERAL_FUNCTIONS->sort_massiv($sort['sort_type'], $allpages);
		}

		$obj		= $GENERAL_FUNCTIONS->form_navigations(20, $allpages, '?act=pages&sort_by='.$sort['sort_by'].'&sort_type='.$sort['sort_type'].$pageCategoryId.$page_id_text);
		$needPages	= $obj['records'];
		$pages		= $obj['pages'];

		$_SESSION['___GoodCMS']['SORT_BY_FIELD']	= 'sort_index';
		$tpls_tags									= array();
		for ($i=0; $i<count($needPages); $i++) {

			//берём новые теги подгружаемых шаблонов
			if (!isset($tpls_tags[$needPages[$i]['templates_id']])) {
				$tags	= $GENERAL_FUNCTIONS->getTagsTree($needPages[$i]['tpl_id'], $needPages[$i]['virtual_tpl_id'], 0);
				
				//убираем из тегов повторяющиеся, а также те, которые подгружают шаблоны				
				$temp	= array();	
				foreach ($tags AS $key=>$t) {
					if ($t['include_tpl_id']==0) {
						$temp[$t['tag_id']]	= $t;
					}
				}
				$tpls_tags[$needPages[$i]['templates_id']]=$temp;
			}
			
			$blocks	= $tpls_tags[$needPages[$i]['templates_id']];			

			foreach ($blocks as $k=>$b) {
				$blocks[$k]['name']='modules/'.$blocks[$k]['module_name'].'/'.$MODULES_PERFORMANCE_PATCH_NAME.'/'.$blocks[$k]['block_name'].'.php';
				if ($blocks[$k]['description']!='') {
					$blocks[$k]['block_name']	= $blocks[$k]['description'];
				}
				else $blocks[$k]['block_name']	= false;
			}
			
			$needPages[$i]['blocks']			= $blocks;
		}

		if (isset($this->get['page'])) $selectedPage=$this->get['page'];
		else $selectedPage=1;

		$this->smarty->assign('content_template',	'pages/pages_list.tpl');
		$this->smarty->assign('allpages', 			$needPages);
		$this->smarty->assign('content_head',		$pageCategoryName);
		$this->smarty->assign('pages',				$pages);
		$this->smarty->assign('selectedPage',		$selectedPage);
		$this->smarty->assign('sort_by',			$sort['sort_by']);
		$this->smarty->assign('refreshFrame',		$this->refreshFrame);

		if (!isset($this->get['page_id'])) {

			$this->smarty->assign('page_count',		sprintf($MSGTEXT['pages_list_category'], count($allpages)));
		}

		if (isset($this->get['pageCategoryId'])) {
			$this->smarty->assign('page_category',	$this->get['pageCategoryId']);
		}

		$this->smarty->assign('sort_type',			$sort['sort_type']);
	}



	/**
     * форма добавления новой страницы
     *
     */
	function pages_form_add() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE10, $MYSQL_TABLE2;

		$query			= "SELECT $MYSQL_TABLE2.description as `tpl_name`, $MYSQL_TABLE10.* FROM `$MYSQL_TABLE2`, `$MYSQL_TABLE10` WHERE $MYSQL_TABLE2.id=$MYSQL_TABLE10.tamplates_id ORDER BY $MYSQL_TABLE2.description";
		$result			= $this->mysql->executeSQL($query);
		$templates		= $this->mysql->fetchAssocAll($result);
		$pageCategories	= $this->getPageCategoryTree();

		$this->smarty->assign('pageCategories',		$pageCategories);

		if (isset($this->get['pageCategoryId'])) {
			$page_category=$this->get['pageCategoryId'];
			$this->smarty->assign('page_category',		$page_category);
		}

		$this->smarty->assign('templates', 			$templates);
		$this->smarty->assign('content_template',	'pages/pages_form_add.tpl');
		$this->smarty->assign('content_head', 		$MSGTEXT['pages_class_p_add_new_p']);
	}



	/**
     * обработка формы добавления новой страницы
     *
     */    
	function pages_insert() {
		GLOBAL $GENERAL_FUNCTIONS, $MSGTEXT, $CMSProtection, $MYSQL_TABLE2, $MYSQL_TABLE3, $MYSQL_TABLE10, $MYSQL_TABLE2_TEMPLATES;

		//берем количество страниц
		$query				= "SELECT  count(*) FROM `$MYSQL_TABLE3`";
		$result				= $this->mysql->executeSQL($query);
		list($total_pages)	= $this->mysql->fetchRow($result);

		//проверк формата имени страницы
		$this->post['name']	= addslashes($this->post['name']);
		if (!preg_match("/^([A-Z0-9,\.\_\-]*)$/iu", $this->post['name']) || is_numeric($this->post['name'])) {
			$errorMsg	= $MSGTEXT['pages_class_bad_p_name'];
		}
		else {
			$query	= "SELECT * FROM `$MYSQL_TABLE3` WHERE `name`='{$this->post['name']}' ";
			$result	= $this->mysql->executeSQL($query);

			if ($this->mysql->numRows($result)>0)  {
				$errorMsg	= $MSGTEXT['pages_class_p_is_exist'];
			}
			elseif  ((isset($this->post['enable']) && $this->post['templates_id']==0)) {
				$errorMsg	= $MSGTEXT['pages_class_p_cannot_publick'];
			}
		}

		if (isset($errorMsg)) {
			$query			= "SELECT $MYSQL_TABLE2.description as `tpl_name`, $MYSQL_TABLE10.* FROM `$MYSQL_TABLE2`, `$MYSQL_TABLE10` WHERE $MYSQL_TABLE2.id=$MYSQL_TABLE10.tamplates_id ORDER BY $MYSQL_TABLE10.name";
			$result			= $this->mysql->executeSQL($query);
			$templates		= $this->mysql->fetchAssocAll($result);
			$pageCategories	= $this->getPageCategoryTree();

			$this->smarty->assign('content_template', 	'pages/pages_form_add.tpl');
			$this->smarty->assign('content_head',		$MSGTEXT['pages_class_p_create_new']);
			$this->smarty->assign('templates', 			$templates);
			$this->smarty->assign('message',			$errorMsg);
			$this->smarty->assign('pageCategories',		$pageCategories);

			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, stripcslashes($value));
		}
		else {
			if (isset($this->post['enable']))         	$enable=$this->post['enable'];
			else $enable=0;

			if (isset($this->post['cache']))         	$cache=$this->post['cache'];
			else $cache=0;

			if (isset($this->post['disable_cache_if_get']))    	$disable_cache_if_get=$this->post['disable_cache_if_get'];
			else $disable_cache_if_get=0;

			if (isset($this->post['selected']))         	$selected=$this->post['selected'];
			else $selected=0;

			$query				= "INSERT INTO `$MYSQL_TABLE3`  (`name`, `templates_id`, `description`, `page_category`, `enable`, `cache`, `sort_index`, `disable_cache_if_get`, `selected`) VALUES ('{$this->post['name']}', '{$this->post['templates_id']}', '{$this->post['description']}', '{$this->post['page_category']}', '$enable', '$cache', '0', '$disable_cache_if_get', '$selected')";
			$this->mysql->executeSQL($query);
			$sort_index			= $this->mysql->insertID();


			$query				= "UPDATE `$MYSQL_TABLE3`  SET `sort_index`='$sort_index' WHERE `id`='$sort_index'";
			$result				= $this->mysql->executeSQL($query);
			$this->refreshFrame	= 1;

			//ставим страницу главной
			if ($total_pages==0) {
				$GENERAL_FUNCTIONS->updateGSettings('SETTINGS_INDEX_PAGE', $this->post['name']);
			}

			//удаляем кеш, если вдруг была такая старая страница
			$this->deleteFromMemcache($this->post['name']);

			$this->get['page_id']				= $sort_index;
			$this->get['page_category']			= $this->post['page_category'];
			/*
			$newPageUrl	= "?act=pages&page_id=$sort_index&pageCategoryId={$this->post['page_category']}";

			$_SESSION['___GoodCMS']['select_page_by_url']		= $newPageUrl;

			$_SESSION['___GoodCMS']['back_url']	= "index.php?act=pages&page_id=$sort_index&pageCategoryId={$this->post['page_category']}";
			*/


			$this->pages_getlist();
		}
	}



	/**
     * удалить страницу
     *
     */    
	function pages_delete() {
		GLOBAL  $GENERAL_FUNCTIONS, $MYSQL_TABLE2, $MYSQL_TABLE3, $MYSQL_TABLE4;

		$GENERAL_FUNCTIONS->delete_modules_records($this->get['id'], 'page_id');

		$query	= "DELETE FROM `$MYSQL_TABLE3` WHERE `id`='{$this->get['id']}'";
		$this->mysql->executeSQL($query);

		unset($this->get['do']);
		unset($this->get['id']);
		$this->refreshFrame	= 1;
		$this->pages_getlist();
	}



	/**
     * форма редактирования страницы
     *
     */
	function pages_form_edit() {
		GLOBAL $MSGTEXT, $MYSQL_TABLE10,  $MYSQL_TABLE2,   $MYSQL_TABLE3,  $TEMPLATES_PATH, $MYSQL_TABLE2_TEMPLATES;

		$query	= "SELECT * FROM `$MYSQL_TABLE3` WHERE `id`='{$this->get['id']}'";
		$result	= $this->mysql->executeSQL($query);
		$fields	= $this->mysql->fetchAssoc($result);

		$query			= "SELECT $MYSQL_TABLE2.description as `tpl_name`, $MYSQL_TABLE10.* FROM `$MYSQL_TABLE2`, `$MYSQL_TABLE10` WHERE $MYSQL_TABLE2.id=$MYSQL_TABLE10.tamplates_id ORDER BY $MYSQL_TABLE2.description";
		$result			= $this->mysql->executeSQL($query);
		$templates		= $this->mysql->fetchAssocAll($result);

		$pageCategories=$this->getPageCategoryTree();

		$this->smarty->assign('content_template', 	'pages/pages_form_edit.tpl');
		foreach  ($fields as $key=>$value) $this->smarty->assign($key, $value);

		$this->smarty->assign('pageCategories',		$pageCategories);
		$this->smarty->assign('templates',			$templates);
		$this->smarty->assign('content_head',		$MSGTEXT['pages_class_p_edit_p']);
	}



	/**
     * сохранение редактирования страницы
     *
     */
	function pages_saveedit()    {
		GLOBAL $MSGTEXT, $MYSQL_TABLE2, $MYSQL_TABLE3, $MYSQL_TABLE10, $MYSQL_TABLE2_TEMPLATES;

		$message	= '';

		//проверка формата имени страницы
		if (!preg_match("/^([A-Z0-9,\.\_\-]*)$/iu", $this->postr['name']) || is_numeric($this->post['name'])) {
			$query			= "SELECT * FROM `$MYSQL_TABLE3` WHERE `id`='{$this->postr['id']}'";
			$result			= $this->mysql->executeSQL($query);
			$fields			= $this->mysql->fetchAssoc($result);

			$query			= "SELECT $MYSQL_TABLE2.description as `tpl_name`, $MYSQL_TABLE10.* FROM `$MYSQL_TABLE2`, `$MYSQL_TABLE10` WHERE $MYSQL_TABLE2.id=$MYSQL_TABLE10.tamplates_id ORDER BY $MYSQL_TABLE10.name";
			$result			= $this->mysql->executeSQL($query);
			$templates		= $this->mysql->fetchAssocAll($result);

			$pageCategories	= $this->getPageCategoryTree();

			$this->smarty->assign('content_template', 	'pages/pages_form_edit.tpl');
			foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);

			$this->smarty->assign('pageCategories',		$pageCategories);
			$this->smarty->assign('templates',			$templates);
			$this->smarty->assign('content_head',		$MSGTEXT['pages_class_p_edit_p']);
			$this->smarty->assign('message',			$MSGTEXT['pages_class_bad_p_name']);
		}
		else {
			$query		= "SELECT * FROM `$MYSQL_TABLE3` WHERE `name`='{$this->post['name']}' AND `id`<>'{$this->post['id']}'";
			$result	= $this->mysql->executeSQL($query);

			//имя страницы файла задано неверно
			if ($this->mysql->numRows($result)>0) {
				$query			= "SELECT * FROM `$MYSQL_TABLE3` WHERE `id`='{$this->post['id']}'";
				$result			= $this->mysql->executeSQL($query);
				$fields			= $this->mysql->fetchAssoc($result);

				$query			= "SELECT $MYSQL_TABLE2.description as `tpl_name`, $MYSQL_TABLE10.* FROM `$MYSQL_TABLE2`, `$MYSQL_TABLE10` WHERE $MYSQL_TABLE2.id=$MYSQL_TABLE10.tamplates_id ORDER BY $MYSQL_TABLE10.name";
				$result			= $this->mysql->executeSQL($query);
				$templates		= $this->mysql->fetchAssocAll($result);

				$pageCategories	= $this->getPageCategoryTree();

				$this->smarty->assign('content_template', 	'pages/pages_form_edit.tpl');
				foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
				$this->smarty->assign('name',		$fields['name']);

				$this->smarty->assign('pageCategories',		$pageCategories);
				$this->smarty->assign('templates',			$templates);
				$this->smarty->assign('content_head',		$MSGTEXT['pages_class_p_edit_p']);
				$this->smarty->assign('message',			sprintf($MSGTEXT['pages_class_p_name_is_used'], $this->post['name']) );
			}

			elseif ($message!='') {
				$query			= "SELECT * FROM `$MYSQL_TABLE3` WHERE `id`='{$this->post['id']}'";
				$result			= $this->mysql->executeSQL($query);
				$fields			= $this->mysql->fetchAssoc($result);

				$query			= "SELECT $MYSQL_TABLE2.description as `tpl_name`, $MYSQL_TABLE10.* FROM `$MYSQL_TABLE2`, `$MYSQL_TABLE10` WHERE $MYSQL_TABLE2.id=$MYSQL_TABLE10.tamplates_id ORDER BY $MYSQL_TABLE10.name";
				$result			= $this->mysql->executeSQL($query);
				$templates		= $this->mysql->fetchAssocAll($result);

				$pageCategories	= $this->getPageCategoryTree();

				$this->smarty->assign('content_template', 	'pages/pages_form_edit.tpl');
				foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
				$this->smarty->assign('name',	$fields['name']);

				$this->smarty->assign('pageCategories',		$pageCategories);
				$this->smarty->assign('templates',			$templates);
				$this->smarty->assign('content_head',		$MSGTEXT['pages_class_p_edit_p']);
				$this->smarty->assign('message',			$message);
			}

			//если неназначен шаблон и поставлена голочка "публиковать"
			elseif  ((isset($this->post['enable']) && $this->post['templates_id']==0)) {
				$query			= "SELECT * FROM `$MYSQL_TABLE3` WHERE `id`='{$this->post['id']}'";
				$result			= $this->mysql->executeSQL($query);
				$fields			= $this->mysql->fetchAssoc($result);

				$query			= "SELECT $MYSQL_TABLE2.description as `tpl_name`, $MYSQL_TABLE10.* FROM `$MYSQL_TABLE2`, `$MYSQL_TABLE10` WHERE $MYSQL_TABLE2.id=$MYSQL_TABLE10.tamplates_id ORDER BY $MYSQL_TABLE10.name";
				$result			= $this->mysql->executeSQL($query);
				$templates		= $this->mysql->fetchAssocAll($result);

				$pageCategories	= $this->getPageCategoryTree();

				$this->smarty->assign('content_template', 	'pages/pages_form_edit.tpl');
				foreach  ($this->post as $key=>$value) $this->smarty->assign($key, $value);
				$this->smarty->assign('name',		$fields['name']);

				$this->smarty->assign('enable',				0);
				$this->smarty->assign('pageCategories',		$pageCategories);
				$this->smarty->assign('templates',			$templates);
				$this->smarty->assign('content_head',		$MSGTEXT['pages_class_p_edit_p']);
				$this->smarty->assign('message',			$MSGTEXT['pages_class_p_cannot_publick']);
			}
			else {
				$query			= "SELECT `cache`, `name` FROM `$MYSQL_TABLE3` WHERE `id`='{$this->post['id']}'";
				$result			= $this->mysql->executeSQL($query);
				$page_old		= $this->mysql->fetchAssoc($result);

				if (isset($this->post['enable']))    	$enable=$this->post['enable'];
				else $enable=0;

				if (isset($this->post['cache']))       	$cache=$this->post['cache'];
				else $cache=0;

				if (isset($this->post['disable_cache_if_get']))         	$disable_cache_if_get=$this->post['disable_cache_if_get'];
				else $disable_cache_if_get=0;

				if (isset($this->post['selected']))         			$selected=$this->post['selected'];
				else $selected=0;

				$this->postr['name']=addslashes($this->postr['name']);
				$query	= "UPDATE `$MYSQL_TABLE3` SET  `name`='{$this->postr['name']}', `templates_id`='{$this->post['templates_id']}', `description`='{$this->post['description']}', `page_category`='{$this->post['page_category']}', `enable`='$enable', `cache`='$cache', `disable_cache_if_get`='$disable_cache_if_get', `selected`='$selected' WHERE `id`='{$this->post['id']}'";
				$this->mysql->executeSQL($query);

				//удаляем кеш
				if ($page_old['cache']!=$cache || $page_old['name']!=$this->post['name']) {
					$this->deleteFromMemcache($page_old['name']);
				}

				$this->refreshFrame=1;
				$this->pages_getlist();
			}
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