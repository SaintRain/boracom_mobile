<?php
$DATA=array (
  'BDSTRUCTURE' => 
  array (
    'regs' => 
    array (
      0 => 'CREATE TABLE `regs` (
`id` INT(11)  NOT NULL auto_increment ,
`caption` VARCHAR(500) character set utf8 collate utf8_general_ci    default NULL ,
`reg` VARCHAR(500) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(11) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

',
    ),
    'data' => 
    array (
      0 => 'CREATE TABLE `data` (
`id` INT(11)  NOT NULL auto_increment ,
`caption` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`type` ENUM(\'Input\',\'Textarea\',\'Select\',\'MultiSelect\',\'Checkbox\',\'Radio\',\'Text\',\'File\') character set utf8 collate utf8_general_ci    default NULL ,
`select_values` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`regular` INT(11)     default NULL ,
`extensions` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`nnull` BOOL     default \'0\' ,
`height` VARCHAR(10) character set utf8 collate utf8_general_ci    default NULL ,
`width` VARCHAR(10) character set utf8 collate utf8_general_ci    default NULL ,
`class` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`style` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`key` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(11) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

',
    ),
  ),
  'BLOCKS' => 
  array (
    0 => 
    array (
      'id' => '43',
      'module_id' => '8',
      'type' => '2',
      'name' => 'ShowZvonokForm',
      'description' => 'Форма заказа звонка',
      'act_variable' => 'cont',
      'act_method' => 'post',
      'url_get_vars' => '',
      'general_table_id' => '38',
      'loaded_name' => 'ShowZvonokForm',
      'sort_index' => '466',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '66',
          'block_id' => '43',
          'name' => 'formType',
          'value' => '0',
          'description' => 'Использовать не стандартный шаблон формы контактов',
          'edit_s_type_id' => '3',
          'loaded_name' => 'formType',
        ),
        1 => 
        array (
          'id' => '67',
          'block_id' => '43',
          'name' => 'usernameEmailCaption',
          'value' => '',
          'description' => 'Ваше имя',
          'edit_s_type_id' => '1',
          'loaded_name' => 'usernameEmailCaption',
        ),
        2 => 
        array (
          'id' => '68',
          'block_id' => '43',
          'name' => 'mailSubject',
          'value' => 'Новое сообщение на вашем сайте',
          'description' => 'Тема сообщения',
          'edit_s_type_id' => '1',
          'loaded_name' => 'mailSubject',
        ),
        3 => 
        array (
          'id' => '69',
          'block_id' => '43',
          'name' => 'kcaptcha',
          'value' => '1',
          'description' => 'Выводить kcaptcha - защиту',
          'edit_s_type_id' => '3',
          'loaded_name' => 'kcaptcha',
        ),
        4 => 
        array (
          'id' => '70',
          'block_id' => '43',
          'name' => 'sendEmailTo',
          'value' => '',
          'description' => 'Отправлять сообщение на адрес',
          'edit_s_type_id' => '1',
          'loaded_name' => 'sendEmailTo',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '57',
          'block_id' => '43',
          'name' => 'DesignerContactForm.tpl',
          'description' => 'Нестандартная форма контактов',
          'content' => '<form fastedit:{$table_name}: action="" method=\'post\'>
  {foreach from=$msgFields item=item}
  <div>
    {$item.caption}  {$item.userText}
  </div>
  {/foreach}
</form>',
          'loaded_name' => 'DesignerContactForm.tpl',
          'sort_index' => '890',
          'block_name' => 'ShowZvonokForm',
        ),
        1 => 
        array (
          'id' => '58',
          'block_id' => '43',
          'name' => 'MessageFormat.tpl',
          'description' => 'Формат отправляемого сообщения',
          'content' => '{foreach from=$msgFields item=item}
<div>
  {$item.caption}  {$item.userText}
</div>
{/foreach}',
          'loaded_name' => 'MessageFormat.tpl',
          'sort_index' => '760',
          'block_name' => 'ShowZvonokForm',
        ),
        2 => 
        array (
          'id' => '59',
          'block_id' => '43',
          'name' => 'SendResult.tpl',
          'description' => 'Результат отправки сообщения',
          'content' => '<p fastedit:{$table_name}:>
  {if $sendResult==true}
  	{\'Спасибо! Ваше сообщение отправлено.\'|ftext}
  {else}
  	{\'Технические неполадки отправки сообщения.\'|ftext}
  {/if}
</p>',
          'loaded_name' => 'SendResult.tpl',
          'sort_index' => '761',
          'block_name' => 'ShowZvonokForm',
        ),
        3 => 
        array (
          'id' => '60',
          'block_id' => '43',
          'name' => 'ContactForm.tpl',
          'description' => 'Стандартная форма контактов',
          'content' => '<br/>
<br/>
<form fastedit:{$table_name}: id="contact_form" style="margin-top:0px" action="#contact_form" method=\'post\' enctype=\'multipart/form-data\' onreset="return confirm(\'{\'Вы действительно хотите очистить форму?\'|ftext}\')">
  <p>
    <input type="hidden" name="contact" value="send" />
  </p>
  <table border=\'0\' cellpadding=\'0\' cellspacing=\'2\'>
    {if $errors}
    <tr>
      <td></td>
      <td colspan="2" align="left">                
        {foreach from=$errors item=error}
        <div>          
          <p style="color:red">
            {$error|ftext}
          </p>
        </div>
        {/foreach}
        <div style="height:15px"></div>        
      </td>
    </tr>
    {/if}	    
    
{foreach from=$fields item=item}
    {assign var="fieldname" value="field_`$item.id`"}
    <tr> 
    	{if $item.type==\'Input\'}
      <td align="left" valign="middle" class="contacts_formtext">
        {$item.caption|ftext}{if $item.nnull} 
        <span style="color:red">
          *
        </span>
        {/if}&nbsp;&nbsp;
      </td>
      		<td  align="left" colspan="2"><input name="{$fieldname}" class="{if $item.class}{$item.class}{else}contacts_input{/if}"  value="{$post.$fieldname}"  style="width:{if $item.width}{$item.width}{else}100%{/if};{if $item.height}height:{$item.height}{/if};{$item.style}" />
        {else}
       	{if $item.type==\'Textarea\'}      
    		<td align="left" valign="top" class="contacts_formtext">{$item.caption|ftext}{if $item.nnull} <span style="color:red">*</span>{/if}&nbsp;&nbsp;</td>
		    <td  align="left" colspan="2"><textarea name="{$fieldname}" class="{if $item.class}{$item.class}{else}contacts_textarea{/if}" style="width:{if $item.width}{$item.width}{else}100%{/if};height:{if $item.height}{$item.height}{else}100px{/if};{$item.style}">{$post.$fieldname}</textarea>
        {else}
        {if $item.type==\'Checkbox\'}      
      		<td align="left" valign="top"></td>
      		<td  align="left" colspan="2"><input type="checkbox" {if $post.$fieldname}checked{/if}  value="true" name="{$fieldname}"  class="{if $item.class}{$item.class}{else}contacts_checkbox{/if}"  style="{if $item.width}width:{$item.width};{/if}{if $item.height}height:{$item.height}{/if};{$item.style}" />
        	&nbsp;&nbsp;{$item.caption|ftext}
        {else}
        {if $item.type==\'Radio\'}      
      		<td align="left" valign="middle" class="contacts_formtext">{$item.caption|ftext}{if $item.nnull} <span style="color:red">*</span>{/if}&nbsp;&nbsp;</td>
      		<td align="left" colspan="2"> {foreach from=$item.select_values item=sv}
        	<input {if $post.$fieldname==$sv}checked{/if} type="radio" value="{$sv}" name="{$fieldname}" class="{if $item.class}{$item.class}{else}contacts_checkbox{/if}" style="{if $item.width}width:{$item.width};{/if}{if $item.height}height:{$item.height}{/if};{$item.style}" />
        	&nbsp;&nbsp;{$sv}
        	{/foreach}						        
        {else}
        {if $item.type==\'File\'}      
      		<td align="left" valign="middle" style="white-space:nowrap" class="contacts_formtext">{$item.caption|ftext}{if $item.nnull} <span style="color:red">*</span>{/if}&nbsp;&nbsp;</td>
      		<td  align="left" colspan="2"><input type="file" name="{$fieldname}" class="{if $item.class}{$item.class}{else}contacts_file{/if}" style="width:{if $item.width}{$item.width}{else}100%{/if};{if $item.height}height:{$item.height}{/if};{$item.style}" />
        {else}
        {if $item.type==\'Select\'}      
      		<td align="left" valign="middle" class="contacts_formtext">{$item.caption|ftext}{if $item.nnull} <span style="color:red">*</span>{/if}&nbsp;&nbsp;</td>
      		<td  align="left">
      		<select {if $item.checked}checked{/if} type="radio" value="{$item.id}" name="{$fieldname}" class="{if $item.class}{$item.class}{else}contacts_checkbox{/if}" style="{if $item.width}width:{$item.width};{/if}{if $item.height}height:{$item.height}{/if};{$item.style}">         
				{foreach from=$item.select_values item=sv}						
					<option {if $post.$fieldname==$sv} selected {/if} value="{$sv}">{$sv}</option>          
				{/foreach}						
        	</select>
        {else}
        {if $item.type==\'MultiSelect\'}      
      		<td align="left" valign="middle" class="contacts_formtext">{$item.caption|ftext}{if $item.nnull} <span style="color:red">*</span>{/if}&nbsp;&nbsp;</td>
      		<td  align="left">
      		<select multiple {if $item.checked}checked{/if} type="radio" value="{$item.id}" name="{$fieldname}[]" class="{if $item.class}{$item.class}{else}contacts_checkbox{/if}" style="{if $item.width}width:{$item.width};{/if}{if $item.height}height:{$item.height}{/if};{$item.style}">          
			{foreach from=$item.select_values item=sv}							
          		<option {if is_array($post.$fieldname)}{if in_array($sv, $post.$fieldname) } selected {/if}{/if} value="{$sv}">{$sv}</option>          
			{/foreach}							
        	</select>
        {else}						
        {if $item.type==\'Text\'}      
      		<td align="left" valign="middle" class="contacts_formtext"></td>
      		<td  align="left" ><span class="{if $item.class}{$item.class}{else}contacts_formtext{/if}" style="{if $item.width}width:{$item.width};{/if}{if $item.height}height:{$item.height}{/if};{$item.style}">{$item.caption|ftext}</span> {/if}
        {/if}
        {/if}
        {/if} 
        {/if}
        {/if}
        {/if}
        {/if}
       </td>
    </tr>
    {/foreach}    
        
    {if $settings.kcaptcha==1}
    <tr>    
    <td align=\'left\' valign=\'middle\' style="width:100px;white-space:nowrap">{\'Введите текст:\'|ftext}&nbsp;<span style="color:red">*</span></td>
      <td align="left" valign="top">                    
        <div style="float:left">
          <img style="margin:5px;border:0px"  width="120px" height="50px" id="kcaptcha_img" alt="{\'Включите отображение изображений\'|ftext}" src=\'/modules/{$moduleInfo.module_name}/kcaptcha/index.php\' />
        </div>
        <div style="float:left">
          <br/>
          <input name="kcaptcha" style="width:115px" />
          <br/>
          <a class="news_navigations" href="javascript:reloadKcaptcha()">
            {\'поменять картинку\'|ftext}
          </a>          
        </div>                            
      </td>
      </tr>    
    {/if}
    <tr>
      <td colspan="3" style="height:10px"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" valign="bottom" align="left">        
        <input class="button" style="float:left;width:120px;" type="reset" value="{\'Очистить\'|ftext}" />
        <input class="button" style="float:left;margin-left:10px;width:120px;" type="submit" value="{\'Отправить\'|ftext}" />
      </td>
    </tr>
  </table>
</form>

{literal} 
<script type="text/javascript"> 
function  reloadKcaptcha() {	
	var time = Math.random();			
 	document.getElementById(\'kcaptcha_img\').src="/modules/{/literal}{$moduleInfo.module_name}{literal}/kcaptcha/index.php?t="+time;    
}
</script> 
{/literal} ',
          'loaded_name' => 'ContactForm.tpl',
          'sort_index' => '759',
          'block_name' => 'ShowZvonokForm',
        ),
      ),
    ),
  ),
  'TABLES' => 
  array (
    0 => 
    array (
      'id' => '37',
      'module_id' => '8',
      'name' => 'regs',
      'description' => 'Правила проверки полей',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'regs',
      'sort_index' => '1129',
      'table_name' => 'regs',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '281',
          'field_id' => '281',
          'active' => '0',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => '0',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => '0',
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '0',
          'fieldname' => 'id',
          'comment' => 'id',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => '0',
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '1',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '1',
          'sort_index' => '100',
          'table_name' => 'regs',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '282',
          'field_id' => '282',
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
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'caption',
          'comment' => 'Описание правила',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '500',
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
          'table_name' => 'regs',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '283',
          'field_id' => '283',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => '0',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => '0',
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'reg',
          'comment' => 'Регулярное выражение',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '500',
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
          'table_name' => 'regs',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    1 => 
    array (
      'id' => '38',
      'module_id' => '8',
      'name' => 'data',
      'description' => 'Поля формы',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'data',
      'sort_index' => '818',
      'table_name' => 'data',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '284',
          'field_id' => '284',
          'active' => '0',
          'show_in_list' => '0',
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
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '0',
          'fieldname' => 'id',
          'comment' => 'id',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => '0',
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '1',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '1',
          'sort_index' => '110',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '285',
          'field_id' => '285',
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
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'caption',
          'comment' => 'Название',
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
          'sort_index' => '100',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '286',
          'field_id' => '286',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => '6',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => '0',
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => '/^[a-z]*$/iu',
          'edittype_id' => '1',
          'fieldname' => 'key',
          'comment' => 'Уникальный ключ поля (используется программистом)',
          'sourse_field_id' => '0',
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
          'sort_index' => '20',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '287',
          'field_id' => '287',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => '0',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => '0',
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'class',
          'comment' => 'CSS - класс',
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
          'sort_index' => '40',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '288',
          'field_id' => '288',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => '0',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => '0',
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'style',
          'comment' => 'CSS - cтиль',
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
          'sort_index' => '30',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '289',
          'field_id' => '289',
          'active' => '1',
          'show_in_list' => '0',
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
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'width',
          'comment' => 'Ширина',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '10',
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
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '290',
          'field_id' => '290',
          'active' => '1',
          'show_in_list' => '0',
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
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'height',
          'comment' => 'Высота',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '10',
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
        7 => 
        array (
          'id' => '291',
          'field_id' => '291',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => '0',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => '294',
          'hide_operator' => '5',
          'hide_on_value' => 'File',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'extensions',
          'comment' => 'Допустимые расширения файлов(например, .doc, docx)',
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
          'sort_index' => '60',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => 'type',
        ),
        8 => 
        array (
          'id' => '292',
          'field_id' => '292',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => '0',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => '294',
          'hide_operator' => '0',
          'hide_on_value' => 'Input
Textarea
Checkbox
Text
File',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '2',
          'fieldname' => 'select_values',
          'comment' => 'Подставляемые в список значения (новое значение с новой строки)',
          'sourse_field_id' => '0',
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
          'sort_index' => '78',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => 'type',
        ),
        9 => 
        array (
          'id' => '293',
          'field_id' => '293',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => '0',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => '0',
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
          'fieldname' => 'regular',
          'comment' => 'Проверять данные поля по правилу',
          'sourse_field_id' => '282',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => '0',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '75',
          'table_name' => 'data',
          'sourse_table_name' => 'regs',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        10 => 
        array (
          'id' => '294',
          'field_id' => '294',
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
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'type',
          'comment' => 'Тип поля',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '24',
          'len' => '\'Input\',\'Textarea\',\'Select\',\'MultiSelect\',\'Checkbox\',\'Radio\',\'Text\',\'File\'',
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
        11 => 
        array (
          'id' => '295',
          'field_id' => '295',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => '0',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => '0',
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '5',
          'fieldname' => 'nnull',
          'comment' => 'Обязательно должно быть заполнено',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
          'collation_id' => '0',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '55',
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
    'id' => '8',
    'name' => 'Zvonok',
    'version' => '1',
    'description' => 'Заказ звонка',
    'loaded' => '1',
    'need_save' => '1',
    'loaded_name' => 'Zvonok',
    'sort_index' => '8',
  ),
  'TABLES_DATA' => 
  array (
    'regs' => 
    array (
      0 => 
      array (
        'id' => '2',
        'caption' => 'День месяца',
        'reg' => '/^([1-9]{1})(?(?<=[1-2])([0-9]?)|(?(?<=3)1?|$))$/u',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      1 => 
      array (
        'id' => '3',
        'caption' => 'Месяц',
        'reg' => '/^([1-9]{1})(?(?<=1)([0-2]{1})|$)$/u',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
      2 => 
      array (
        'id' => '4',
        'caption' => 'Год',
        'reg' => '/^(1|2)([0-9]{3})$/u',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '20',
      ),
      3 => 
      array (
        'id' => '5',
        'caption' => 'Домен',
        'reg' => '/^(http?:\\/\\/)?([\\w\\.]+)\\.([a-z]{2,6}\\.?)(\\/?)$/iu',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '25',
      ),
      4 => 
      array (
        'id' => '6',
        'caption' => 'URL-адрес',
        'reg' => '/^(http?:\\/\\/)?([\\w\\.]+)\\.([a-z]{2,6}\\.?)(\\/[\\w\\.\\?\\=\\&]*)*\\/?$/iu',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '30',
      ),
      5 => 
      array (
        'id' => '7',
        'caption' => 'Пароль пользователя',
        'reg' => '/^[a-zA-Z0-9]{6,16}$/u',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '35',
      ),
      6 => 
      array (
        'id' => '8',
        'caption' => 'Логин пользователя',
        'reg' => '/^[a-zA-Z0-9]{6,16}$/u',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '40',
      ),
      7 => 
      array (
        'id' => '9',
        'caption' => 'Номер кредитные карты Visa, MasterCard',
        'reg' => '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\\d{3})\\d{11})$./u',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '45',
      ),
      8 => 
      array (
        'id' => '10',
        'caption' => 'IP-адрес',
        'reg' => '/^([0-9]|[0-9][0-9]|[01][0-9][0-9]|2[0-4][0-9]|25[0-5])(\\.([0-9]|[0-9][0-9]|[01][0-9][0-9]|2[0-4][0-9]|25[0-5])){3}$/u',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '50',
      ),
      9 => 
      array (
        'id' => '11',
        'caption' => 'Только латинские буквы',
        'reg' => '/^[a-z]*$/iu',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '55',
      ),
      10 => 
      array (
        'id' => '12',
        'caption' => 'Номер телефона',
        'reg' => '/^[()-\\d ]*$/u',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '60',
      ),
      11 => 
      array (
        'id' => '13',
        'caption' => 'Email адрес',
        'reg' => '/^[\\.\\-_A-Za-z0-9]+?@[\\.\\-A-Za-z0-9]+?\\.[a-z0-9]{2,6}$/u',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '65',
      ),
      12 => 
      array (
        'id' => '14',
        'caption' => 'Дробное число',
        'reg' => '/^[\\d\\.\\,]{1,}$/u',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '70',
      ),
      13 => 
      array (
        'id' => '15',
        'caption' => 'Целое число',
        'reg' => '/^\\d{1,}$/u',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '75',
      ),
      14 => 
      array (
        'id' => '16',
        'caption' => 'Обязательное для заполнения',
        'reg' => '/.+/u',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '80',
      ),
    ),
    'data' => 
    array (
      0 => 
      array (
        'id' => '1',
        'caption' => 'Ваше имя:',
        'type' => 'Input',
        'select_values' => '',
        'regular' => '16',
        'extensions' => '',
        'nnull' => '1',
        'height' => '',
        'width' => '',
        'class' => '',
        'style' => '',
        'key' => 'UserName',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      1 => 
      array (
        'id' => '2',
        'caption' => 'Ваш телефон:',
        'type' => 'Input',
        'select_values' => '',
        'regular' => '0',
        'extensions' => '',
        'nnull' => '1',
        'height' => '',
        'width' => '',
        'class' => '',
        'style' => '',
        'key' => 'UserPhone',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
      2 => 
      array (
        'id' => '4',
        'caption' => 'Удобное время:',
        'type' => 'Input',
        'select_values' => '',
        'regular' => '0',
        'extensions' => '',
        'nnull' => '1',
        'height' => '',
        'width' => '',
        'class' => '',
        'style' => '',
        'key' => 'UserTime',
        'page_id' => '0',
        'tag_id' => '4',
        'lang_id' => '1',
        'sort_index' => '3',
      ),
    ),
  ),
  'TABLES_DATA_MULTISELECT' => 
  array (
    'cms_multiselect_data' => 
    array (
    ),
  ),
);
?>