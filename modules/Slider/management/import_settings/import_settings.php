<?php
$DATA=array (
  'BDSTRUCTURE' => 
  array (
    'data' => 
    array (
      0 => 'CREATE TABLE `data` (
`id` INT(11)  NOT NULL auto_increment ,
`image` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
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
      'id' => '3',
      'module_id' => '3',
      'type' => '2',
      'name' => 'ShowSlider',
      'description' => 'Слайдер',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '3',
      'loaded_name' => 'ShowSlider',
      'sort_index' => '2',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '3',
          'block_id' => '3',
          'name' => 'slider.tpl',
          'description' => 'Вывод слайдера',
          'content' => '{literal} 
<script type="text/javascript">
function setcolor(obj) {
  obj.style.background=\'#00c4fe\'; 
 }
 
function unsetcolor(obj) {
	if (obj.className==\'page_selected\') obj.style.background=\'#00c4fe\';	 
	else  obj.style.background=\'#0573ab\';	 			 		  
 } 
</script> 
{/literal}

<table fastedit:: cellpadding="0" cellspacing="0" border="0">
  <tr> {foreach name="cat" from=$menuItems item=list}
    <td fastedit:{$table_name}:{$list.id} style="height:25px" class="menu" onclick="location.href=\'{$list.name}{$list.url}\'" {if $list.selected} bgcolor="#00c4fe" {else}onmouseover="setcolor(this)" onmouseout="unsetcolor(this)"{/if} align="center">
      &nbsp;<b>{$list.item|ftext}</b>&nbsp;
    </td>
    {if !$smarty.foreach.cat.last}
    	<td align="center" valign="middle" style="width:20px"><img alt="" src="/img/line.gif" /></td>
    {/if}
    {/foreach}
   </tr>
</table>',
          'loaded_name' => 'slider.tpl',
          'sort_index' => '2',
          'block_name' => 'ShowSlider',
        ),
      ),
    ),
  ),
  'TABLES' => 
  array (
    0 => 
    array (
      'id' => '3',
      'module_id' => '3',
      'name' => 'data',
      'description' => 'Слайдер',
      'show_type' => '0',
      'additional_buttons' => 'data',
      'loaded_name' => 'data',
      'sort_index' => '2',
      'table_name' => 'data',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '13',
          'field_id' => '13',
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
          'id' => '14',
          'field_id' => '14',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => '0',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => '0',
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '9',
          'fieldname' => 'image',
          'comment' => 'Изображение',
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
          'sort_index' => '50',
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
    'id' => '3',
    'name' => 'Slider',
    'version' => '1',
    'description' => 'Слайдер',
    'loaded' => '1',
    'need_save' => '0',
    'loaded_name' => 'Slider',
    'sort_index' => '3',
  ),
);
?>