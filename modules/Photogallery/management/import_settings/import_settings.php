<?php
$DATA=array (
  'BDSTRUCTURE' => 
  array (
    'data' => 
    array (
      0 => 'CREATE TABLE `data` (
`id` INT(11)  NOT NULL auto_increment ,
`caption` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`translit` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`description` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`image` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`images` LONGTEXT character set utf8 collate utf8_general_ci    default NULL ,
`title` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`metadescription` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`metakeywords` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`enable` BOOL     default \'1\' ,
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
      'name' => 'PhotosShow',
      'description' => 'Вывод фотогалереи',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '1',
      'loaded_name' => 'PhotosShow',
      'sort_index' => '528',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '1',
          'block_id' => '1',
          'name' => 'records_for_row',
          'value' => '4',
          'description' => 'Выводить изображений в строчку',
          'edit_s_type_id' => '1',
          'loaded_name' => 'records_for_row',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '1',
          'block_id' => '1',
          'name' => 'show_categories.tpl',
          'description' => 'Вывод разделов',
          'content' => '<div fastedit::>  
  {foreach name="products" from=$datalist item=item}
  <div style="float:left;width:33%;margin-right:10px;" fastedit:{$table_name}:{$item.id}>        
    <div style="height:220px;">
      {if $item.image}
      <a href="?act=more&id={$item.id}">
        <img alt="{$item.caption}" class="ramka" style="margin:3px" src="/modules/Photogallery/management/storage/images/data/image/{$item.id}/preview/{$item.image}" border="0" />
      </a>
      {/if}
    </div>
    <div>
      <a href="?act=more&id={$item.id}">
        <b>
          {$item.caption}
        </b>
      </a>
    </div>               
  </div>
  {/foreach}    
</div>',
          'loaded_name' => 'show_categories.tpl',
          'sort_index' => '853',
          'block_name' => 'PhotosShow',
        ),
        1 => 
        array (
          'id' => '2',
          'block_id' => '1',
          'name' => 'show_list.tpl',
          'description' => 'Вывод списка изображений',
          'content' => '<div fastedit:{$table_name}:{$category.id}>
  <div style="margin-left:0px;margin-right:10px">    
      <a href="javascript:history.back();">
        &larr; {\'Вернуться назад\'|ftext}
      </a>
    <br/>
    <br/>
    <b>
      <span color="#035f6e">
        {$category.caption}
      </span>
    </b>
    <br/>
    <br/>
      <span color="#035f6e">
        {$category.description}
      </span>
    <br/>
        
    {if $category.images}
    {foreach from=$category.images item=img}
    <div style="float:left;width:{$width}%;margin:5px">
      <div style="float:left;width:100%;height:160px;border:1px #e1e5e8 solid;">        
        <a href="/modules/Photogallery/management/storage/images/data/images/{$category.id}/{$img.name}" class="colorbox">          
          <img alt="{$img.description}" style="margin:3px" src="/modules/Photogallery/management/storage/images/data/images/{$category.id}/preview/{$img.name}" border="0" />
        </a>
      </div>
      <div style="float:left;width:100%;font-size:11px;margin-top:5px">                
          {$img.description}
      </div>      
    </div>
    {/foreach}
    {/if}       	             
  </div>
</div>


{literal} 
<script type="text/javascript">
if(window.jQuery==undefined) {
	document.write(unescape("%3Cscript src=\'/admin/js/jquery.js\' type=\'text/javascript\'%3E%3C/script%3E"));
	}
</script>
<link media="screen" rel="stylesheet" href="/modules/Photogallery/colorbox/example1/colorbox.css" />
<script type="text/javascript" src="/modules/Photogallery/colorbox/colorbox/jquery.colorbox.js"></script> 
<script type="text/javascript">$(document).ready(function(){$(".colorbox").colorbox({rel:\'colorbox\'});			});</script> 
{/literal}',
          'loaded_name' => 'show_list.tpl',
          'sort_index' => '854',
          'block_name' => 'PhotosShow',
        ),
      ),
    ),
    1 => 
    array (
      'id' => '2',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Title',
      'description' => 'Title - заголовок',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Title',
      'sort_index' => '879',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '2',
          'block_id' => '2',
          'name' => 'title',
          'value' => '',
          'description' => 'Title - заголовок по умолчанию',
          'edit_s_type_id' => '1',
          'loaded_name' => 'title',
        ),
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
      'name' => 'Metadescription',
      'description' => 'Meta - описание',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Metadescription',
      'sort_index' => '880',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '3',
          'block_id' => '3',
          'name' => 'metadescription',
          'value' => '',
          'description' => 'Meta - описание по умолчанию',
          'edit_s_type_id' => '1',
          'loaded_name' => 'metadescription',
        ),
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
      'name' => 'Metakeywords',
      'description' => 'Meta - ключевые слова',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Metakeywords',
      'sort_index' => '881',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '4',
          'block_id' => '4',
          'name' => 'metakeywords',
          'value' => '',
          'description' => 'Meta - ключевые слова по умолчанию',
          'edit_s_type_id' => '1',
          'loaded_name' => 'metakeywords',
        ),
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
      'description' => 'Фотогалерея',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'data',
      'sort_index' => '876',
      'table_name' => 'data',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '1',
          'field_id' => '1',
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
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '350',
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
          'sort_index' => '90',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '2',
          'field_id' => '2',
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
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => NULL,
          'fieldname' => 'id',
          'comment' => 'id',
          'sourse_field_id' => NULL,
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
        2 => 
        array (
          'id' => '3',
          'field_id' => '3',
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
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '7',
          'fieldname' => 'description',
          'comment' => 'Описание раздела',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '3',
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
          'sort_index' => '80',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
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
          'avator_width' => '200',
          'avator_height' => '200',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '9',
          'fieldname' => 'image',
          'comment' => 'Аватар раздела',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
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
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '10',
          'fieldname' => 'images',
          'comment' => 'Изображения раздела',
          'sourse_field_id' => NULL,
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
          'sort_index' => '60',
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
          'sourse_field_id' => '1',
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
          'sort_index' => '85',
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
          'fieldname' => 'title',
          'comment' => 'Title - заголовок',
          'sourse_field_id' => '1',
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
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '50',
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
          'fieldname' => 'metadescription',
          'comment' => 'Meta - описание',
          'sourse_field_id' => '1',
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
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '40',
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
          'fieldname' => 'metakeywords',
          'comment' => 'Meta - ключевые слова',
          'sourse_field_id' => '1',
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
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '30',
          'table_name' => 'data',
          'sourse_table_name' => 'data',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        9 => 
        array (
          'id' => '10',
          'field_id' => '10',
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
          'comment' => 'Раздел активен',
          'sourse_field_id' => NULL,
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
          'sort_index' => '20',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
  ),
  'MODULE' => 
  array (
    'id' => '1',
    'name' => 'Photogallery',
    'version' => '1',
    'description' => 'Фотогалерея',
    'loaded' => '1',
    'need_save' => '0',
    'loaded_name' => 'Photogallery',
    'sort_index' => '1',
  ),
);
?>