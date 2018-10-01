<?php
$DATA=array (
  'BDSTRUCTURE' => 
  array (
    'data' => 
    array (
      0 => 'CREATE TABLE `data` (
`id` INT(11)  NOT NULL auto_increment ,
`parent_id` INT(11)     default NULL ,
`caption` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`description` LONGTEXT character set utf8 collate utf8_general_ci    default NULL ,
`enable` BOOL     default \'1\' ,
`translit` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`title` VARCHAR(450) character set utf8 collate utf8_general_ci    default NULL ,
`metakeywords` VARCHAR(450) character set utf8 collate utf8_general_ci    default NULL ,
`metadescription` VARCHAR(450) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
  ),
  'BLOCKS' => 
  array (
    0 => 
    array (
      'id' => '1',
      'module_id' => '1',
      'type' => '2',
      'name' => 'ShowHelp',
      'description' => 'Вывод справки',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '1',
      'loaded_name' => 'ShowHelp',
      'sort_index' => '1343',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '1',
          'block_id' => '1',
          'name' => 'recordsPerPage',
          'value' => '10',
          'description' => 'Выводить на страницу найденных записей',
          'edit_s_type_id' => '1',
          'loaded_name' => 'recordsPerPage',
        ),
        1 => 
        array (
          'id' => '2',
          'block_id' => '1',
          'name' => 'metadescription',
          'value' => '',
          'description' => 'Meta - описание по умолчанию',
          'edit_s_type_id' => '1',
          'loaded_name' => 'metadescription',
        ),
        2 => 
        array (
          'id' => '3',
          'block_id' => '1',
          'name' => 'title',
          'value' => '',
          'description' => 'Title - заголовок по умолчанию',
          'edit_s_type_id' => '1',
          'loaded_name' => 'title',
        ),
        3 => 
        array (
          'id' => '4',
          'block_id' => '1',
          'name' => 'register',
          'value' => '0',
          'description' => 'Учитывать регистр при поиске
',
          'edit_s_type_id' => '3',
          'loaded_name' => 'register',
        ),
        4 => 
        array (
          'id' => '5',
          'block_id' => '1',
          'name' => '_blank',
          'value' => '1',
          'description' => 'При клике открывать найденные страницы в новом окне
',
          'edit_s_type_id' => '3',
          'loaded_name' => '_blank',
        ),
        5 => 
        array (
          'id' => '6',
          'block_id' => '1',
          'name' => 'strip',
          'value' => '100',
          'description' => 'Сколько символов найденного текста выводить',
          'edit_s_type_id' => '1',
          'loaded_name' => 'strip',
        ),
        6 => 
        array (
          'id' => '7',
          'block_id' => '1',
          'name' => 'metakeywords',
          'value' => '',
          'description' => 'Meta - ключевые слова по умолчанию',
          'edit_s_type_id' => '1',
          'loaded_name' => 'metakeywords',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '1',
          'block_id' => '1',
          'name' => 'show_founded.tpl',
          'description' => 'Результат поиска',
          'content' => '{literal}
<style>
  .highlight {
	background-color:yellow;
  }
</style>
{/literal}

<div fastedit::>
{if $find_text_count>0}
  <table cellpadding="0"  cellspacing="0" border="0" style="width:100%">
    <tr>
      <td style="height:30px" valign="top">
        <h3>
          {\'По ключевой фразе <span color="#016cc3">«%s»</span>найдено записей: <span color="#016cc3">%s</span>\'|ftext:$search_text:$find_text_count}
        </h3>
      </td>
    </tr>
  </table>

  <table style="width:100%" cellpadding="0" cellspacing="0" border="0">
    {foreach from=$find_text item=txt}
    <tr>
      <td>
        {\'Глава\'|ftext} 
        <b>
          «{$txt.caption}»
        </b>
        <br/>
        {\'Найденный текст:\'|ftext} 
        <a {if $settings._blank} target="_blank" {/if} class="more" href="?id={$txt.id}">
          {$txt.founded_text}
        </a>
      </td>
    </tr>
    <tr>
      <td style="height:10px">
      </td>
    </tr>
    <tr>
      <td style="height:1px;background-color:#eaeaea">
      </td>
    </tr>
    <tr>
      <td style="height:10px">
      </td>
    </tr>
    {/foreach}
  </table>

{if $pages.page_count != \'\'}
<table style="width:100%" border="0" cellpadding="0" cellspacing="0" align="center">  
    <td align="right"> {\'Страница:\'|ftext}
      {if $pages.page_selected>1}
	      <a class="step" href="?page=1&search_text={$search_text}">&lt;&lt;</a>&nbsp; <a class="step" href="?page={$pages.page_selected-1}&search_text={$search_text}">&lt;</a>
      {/if}
      &nbsp;&nbsp;
      {section name="pages" start=1 loop=$pages.page_count+1}
	       <a {if $smarty.section.pages.index==$pages.page_selected}class="step_selected"{else}class="step"{/if} href="?page={$smarty.section.pages.index}&search_text={$search_text}">{$smarty.section.pages.index}</a> &nbsp;
      {/section}
      {if $pages.page_selected<$pages.page_count}
	      <a class="step" href="?page={$pages.page_selected+1}&search_text={$search_text}">&gt;</a>&nbsp; <a class="step" href="?page={$pages.page_count}&search_text={$search_text}">&gt;&gt;</a>
      {/if}
      </td>
  </tr>
</table>
{/if}
{else}
<h3>
	{\'По ключевой фразе <span color="#016cc3">«%s»</span> ничего не найдено\'|ftext:$search_text}              
</h3>
{/if} 
</div>',
          'loaded_name' => 'show_founded.tpl',
          'sort_index' => '2024',
          'block_name' => 'ShowHelp',
        ),
        1 => 
        array (
          'id' => '2',
          'block_id' => '1',
          'name' => 'show_list.tpl',
          'description' => 'Вывод справки',
          'content' => '<script type="text/javascript" src="/modules/Help/Treeview/ua.js"></script>
<script type="text/javascript" src="/modules/Help/Treeview/ftiens4.js"></script>

<table fastedit:: style="width:100%" border="0" cellpadding="0" cellspacing="5">
<tr>
<td style="width:25%" valign="top" align="left">
<noindex>
<a style="display:none" rel="nofollow"  href="http://www.treemenu.net/" target="_blank"></a>
</noindex>

{literal}
<script type="text/javascript">
function cleare_help_search(obj) {
	if (obj.value=="Поиск...") {
		obj.value=\'\';
		obj.style.color=\'black\';
	}
}

function getAllTree(tree, clean_url) {
	var i=0;
	for (i=0; i < tree.nChildren; i++) {
		nodeObj=tree.children[i];

		if (nodeObj.link) hlink=nodeObj.link;
		else hlink=nodeObj.hreference;


		if (hlink==clean_url) {
			var lastClicked=nodeObj;
			nodeObj.forceOpeningOfAncestorFolders();
			highlightObjLink(nodeObj);
			return true;
		}

		if (nodeObj.nChildren>0) {
			getAllTree(nodeObj, clean_url);
		}
	}
	return false;
}

{/literal}

  var ICONPATH=\'/modules/Help/Treeview/img/\';
var USETEXTLINKS = 1
var STARTALLOPEN = 0
var HIGHLIGHT = 1
var PRESERVESTATE = 1
var GLOBALTARGET=\'S\';
var WRAPTEXT=0;
var HIGHLIGHT_COLOR="black";
var PRESERVESTATE=1;
var USEFRAMES=0;

foldersTree = gFld("<b>Справочная информация</b>", "/help")
{foreach name="cat" from=$categories item=list}
{if $list.deep==0}
  parent{$list.id} = insFld(foldersTree, gFld("{$list.caption}",  {if $list.description}\'{"?id=`$list.id`"|furl}\'{else}\'#\'{/if}))
{else}
{if $list.folder}
parent{$list.id} = insFld(parent{$list.parent_id}, gFld("{$list.caption}", {if $list.description}\'{"?id=`$list.id`"|furl}\'{else}\'#\'{/if}))
{else}
parent{$list.id}= insDoc(parent{$list.parent_id}, gLnk("T", "{$list.caption}",\'{"?id=`$list.id`"|furl}\'))
{/if}
{/if}
{/foreach}

var initializeTREE=initializeDocument();

{if $id}
getAllTree(initializeTREE, \'{"?id=`$id`"|furl}\');
{/if}
</SCRIPT>

</td>
<td><img alt="" width="20px" src=\'/modules/Help/img/zero.gif\' /></td>
<td style="height:1px;background-color:#eaeaea"><img alt="" width="1px" src=\'/modules/Help/img/zero.gif\' /></td>
<td><img alt="" width="20px" src=\'/modules/Help/img/zero.gif\' /></td>
<td style="width:75%" valign="top" align="left">
  <form action="" method="get" style="margin:0px">	
      <table cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td>
            <input name="search_text" class="search_field" style="color:gray;width:500px" onclick="cleare_help_search(this)" value="{\'Поиск...\'|ftext}" />
          </td>
          <td style="width:5px">
            &nbsp;&nbsp;
          </td>
          <td align="left">
            <input class="search_button" type="submit" title="{\'Поиск по документации\'|ftext}" value="ПОИСК" />
          </td>
        </tr>
      </table>
  </form>
    {if $found_data}
    	{$found_data}
    {else}
    	<div fastedit:{$tablename}:{$id}>    
	    <h3>{$view_data.caption}</h3>
		{$view_data.description}
		</div>
	{/if}
	</td>
</tr>
</table>

<div style="display:none">
    {foreach name="cat" from=$categories item=list}
    <a title="{$list.caption}" href="?id={$list.id}">{$list.caption}</a>
    {/foreach}
</div>
  ',
          'loaded_name' => 'show_list.tpl',
          'sort_index' => '2022',
          'block_name' => 'ShowHelp',
        ),
      ),
    ),
    1 => 
    array (
      'id' => '2',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Metadescription',
      'description' => 'Вывод metadescription',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Metadescription',
      'sort_index' => '1346',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
      ),
    ),
    2 => 
    array (
      'id' => '3',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Metakeywords',
      'description' => 'Вывод metakeywords',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Metakeywords',
      'sort_index' => '1347',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
      ),
    ),
    3 => 
    array (
      'id' => '4',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Title',
      'description' => 'Вывод Title',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Title',
      'sort_index' => '1345',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
      ),
    ),
  ),
  'TABLES' => 
  array (
    0 => 
    array (
      'id' => '1',
      'module_id' => '1',
      'name' => 'data',
      'description' => 'Категории',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'data',
      'sort_index' => '1552',
      'table_name' => 'data',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '1',
          'field_id' => '1',
          'active' => '0',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => NULL,
          'fieldname' => 'id',
          'comment' => 'id',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '1',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '1',
          'sort_index' => '100',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '2',
          'field_id' => '2',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'caption',
          'comment' => 'Название раздела',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '250',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '80',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '3',
          'field_id' => '3',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'parent_id',
          'comment' => 'Родительский раздел',
          'sourse_field_id' => '2',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '90',
          'table_name' => 'data',
          'sourse_table_name' => 'data',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '4',
          'field_id' => '4',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '5',
          'fieldname' => 'enable',
          'comment' => 'Публиковать',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '1',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '60',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '5',
          'field_id' => '5',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '7',
          'fieldname' => 'description',
          'comment' => 'Справочная информация',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '23',
          'len' => '',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '70',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '6',
          'field_id' => '6',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '14',
          'fieldname' => 'translit',
          'comment' => 'Транслит',
          'sourse_field_id' => '2',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '255',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '1',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '50',
          'table_name' => 'data',
          'sourse_table_name' => 'data',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '7',
          'field_id' => '7',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '15',
          'fieldname' => 'metakeywords',
          'comment' => 'Meta - описание',
          'sourse_field_id' => '2',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '450',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '40',
          'table_name' => 'data',
          'sourse_table_name' => 'data',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        7 => 
        array (
          'id' => '8',
          'field_id' => '8',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '15',
          'fieldname' => 'title',
          'comment' => 'Title - заголовок',
          'sourse_field_id' => '2',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '450',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '45',
          'table_name' => 'data',
          'sourse_table_name' => 'data',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        8 => 
        array (
          'id' => '9',
          'field_id' => '9',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '15',
          'fieldname' => 'metadescription',
          'comment' => 'Meta - ключевые слова',
          'sourse_field_id' => '2',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '450',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '35',
          'table_name' => 'data',
          'sourse_table_name' => 'data',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
  ),
  'MODULE' => 
  array (
    'id' => '1',
    'name' => 'Help',
    'version' => '1',
    'description' => 'Справочная информация',
    'loaded' => '1',
    'need_save' => '0',
    'loaded_name' => 'Help',
    'sort_index' => '1',
  ),
);
?>