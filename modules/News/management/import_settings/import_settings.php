<?php
$DATA=array (
  'BDSTRUCTURE' => 
  array (
    'comments' => 
    array (
      0 => 'CREATE TABLE `comments` (
`id` INT(11)  NOT NULL auto_increment ,
`datetime` DATETIME      ,
`news_id` INT(11)     default NULL ,
`name` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`email` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`text` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`enable` BOOL     default \'0\' ,
`show_data` BOOL     default \'1\' ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'data' => 
    array (
      0 => 'CREATE TABLE `data` (
`id` INT(11)  NOT NULL auto_increment ,
`delayed_publication` BOOL     default \'0\' ,
`datetime_start` DATETIME      ,
`datetime_end` DATETIME      ,
`datetime` DATETIME      ,
`caption` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`translit` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`short_text` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`full_text` LONGTEXT character set utf8 collate utf8_general_ci    default NULL ,
`enable` BOOL     default \'1\' ,
`rss` BOOL     default \'0\' ,
`title` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`metadescription` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`metakeywords` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
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
      'name' => 'Caption',
      'description' => 'Вывод заголовка',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Caption',
      'sort_index' => '1346',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '1',
          'block_id' => '1',
          'name' => 'caption_default',
          'value' => '',
          'description' => 'Заголовок по умолчанию',
          'edit_s_type_id' => '1',
          'loaded_name' => 'caption_default',
        ),
      ),
      'templates' => 
      array (
      ),
    ),
    1 => 
    array (
      'id' => '2',
      'module_id' => '1',
      'type' => '2',
      'name' => 'RSS',
      'description' => 'Выгрузка RSS',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '2',
      'loaded_name' => 'RSS',
      'sort_index' => '1056',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '1',
          'block_id' => '2',
          'name' => 'show_rss.tpl',
          'description' => 'Выгрузка RSS',
          'content' => '<?xml version="1.0"?>
<rss version="2.0">
  <channel>
    <title>Новости на сайте {$smarty.const.SETTINGS_HTTP_HOST}</title>
    <link>{$smarty.const.SETTINGS_HTTP_HOST}</link>
    <description>Новости на сайте {$smarty.const.SETTINGS_HTTP_HOST}</description>
    <language>ru</language>
    <pubDate>Wed, 02 Oct 2002 13:00:00 GMT</pubDate>
    <lastBuildDate>{$date}</lastBuildDate>
    <docs>{$smarty.const.SETTINGS_HTTP_HOST}/rss</docs>
    <generator>http://www.GoodCMS.net</generator>
    <managingEditor>{$smarty.const.SETTINGS_EMAIL_USERNAME} ({$smarty.const.SETTINGS_EMAIL_CAPTION})</managingEditor>
    <webMaster>{$smarty.const.SETTINGS_EMAIL_USERNAME} ({$smarty.const.SETTINGS_EMAIL_CAPTION})</webMaster>
    {foreach from=$records item=item}
    <item>
      <title>{$item.caption}</title>
      <link>{$smarty.const.SETTINGS_HTTP_HOST}/news/{$item.translit}</link>
      <description>{$item.short_text}</description>
      <pubDate>{$item.datetime}</pubDate>
      <guid>{$smarty.const.SETTINGS_HTTP_HOST}/news/{$item.translit}</guid>
    </item>
    {/foreach}</channel>
</rss>
',
          'loaded_name' => 'show_rss.tpl',
          'sort_index' => '1547',
          'block_name' => 'RSS',
        ),
      ),
    ),
    2 => 
    array (
      'id' => '3',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Metakeywords',
      'description' => 'Meta - ключевые слова',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Metakeywords',
      'sort_index' => '658',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '2',
          'block_id' => '3',
          'name' => 'metakeywords',
          'value' => '',
          'description' => 'Meta - ключевые слова по умолчанию',
          'edit_s_type_id' => '2',
          'loaded_name' => 'metakeywords',
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
      'name' => 'Metadescription',
      'description' => 'Мета - описание',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Metadescription',
      'sort_index' => '657',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '3',
          'block_id' => '4',
          'name' => 'metadescription',
          'value' => '',
          'description' => 'Meta - описание по умолчанию',
          'edit_s_type_id' => '2',
          'loaded_name' => 'metadescription',
        ),
      ),
      'templates' => 
      array (
      ),
    ),
    4 => 
    array (
      'id' => '5',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Title',
      'description' => 'Title - заголовок',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Title',
      'sort_index' => '659',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '4',
          'block_id' => '5',
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
    5 => 
    array (
      'id' => '6',
      'module_id' => '1',
      'type' => '2',
      'name' => 'DataShow',
      'description' => 'Вывод новостей',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '2',
      'loaded_name' => 'DataShow',
      'sort_index' => '578',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '5',
          'block_id' => '6',
          'name' => 'show_comments',
          'value' => '1',
          'description' => 'Возможность добавления комментарий',
          'edit_s_type_id' => '3',
          'loaded_name' => 'show_comments',
        ),
        1 => 
        array (
          'id' => '6',
          'block_id' => '6',
          'name' => 'date_format',
          'value' => 'd.m.Y',
          'description' => 'Формат даты (например, d.m.Y)',
          'edit_s_type_id' => '1',
          'loaded_name' => 'date_format',
        ),
        2 => 
        array (
          'id' => '7',
          'block_id' => '6',
          'name' => 'records_for_page',
          'value' => '10',
          'description' => 'Записей на страницу',
          'edit_s_type_id' => '1',
          'loaded_name' => 'records_for_page',
        ),
        3 => 
        array (
          'id' => '8',
          'block_id' => '6',
          'name' => 'SearchSettings',
          'value' => 'array( 
//имя таблицы без префикса
\'data\'=>array (
\'sql\'=>"
SELECT t.id, t.caption, t.short_text
FROM `{$this->tablePrefix}data` AS `t` 
WHERE t.lang_id=\'{$this->lang_id}\' AND t.enable=1 AND (t.caption LIKE \'%{$this->search_text}%\' OR t.short_text LIKE \'%{$this->search_text}%\' OR t.full_text LIKE \'%{$this->search_text}%\')
ORDER BY t.sort_index DESC",  					
//Формат URL			 
\'url\'=>\'?act=more&id={$id}\'
)
);
',
          'description' => 'Настройки для модуля Search',
          'edit_s_type_id' => '2',
          'loaded_name' => 'SearchSettings',
        ),
        4 => 
        array (
          'id' => '9',
          'block_id' => '6',
          'name' => 'kcaptcha',
          'value' => '1',
          'description' => 'Использовать kcaptcha-защиту',
          'edit_s_type_id' => '3',
          'loaded_name' => 'kcaptcha',
        ),
        5 => 
        array (
          'id' => '10',
          'block_id' => '6',
          'name' => 'date_format_comments',
          'value' => 'd.m.Y H:i:s',
          'description' => 'Формат даты в комментариях (например, d.m.Y H:i:s)',
          'edit_s_type_id' => '1',
          'loaded_name' => 'date_format_comments',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '2',
          'block_id' => '6',
          'name' => 'show_more.tpl',
          'description' => 'Подробное описание',
          'content' => '<div fastedit::>  
  <table fastedit:{$table_name}:{$record.id} style="width:100%" border=\'0\' cellspacing=\'0\' cellpadding=\'0\'>
    <tr>
      <td style="width:670px" align=\'left\' valign=\'top\'>
        <p class="date">
          {$record.datetime}
        </p>
        {if $record.caption}
        <h1>
          {$record.caption}
        </h1>
        {/if}
        {$record.short_text} 
      </td>
    </tr>
    <tr>
      <td align=\'left\' valign=\'top\'>
        {$record.full_text} 
      </td>
    </tr>
  </table>
  <br/>
  <center>
    <a class="news_navigations"  href="javascript: history.go(-1)">
      {\'&larr; Вернуться назад\'|ftext}
    </a>
  </center>
  <br/>
  
  {if $comments_pages} 
  <br/>
  <h1>
    <i>
      {\'Комментарии пользователей:\'|ftext}
    </i>
  </h1>
  <table style="width:100%" border=\'0\' cellspacing=\'0\' cellpadding=\'0\'>
    {foreach name="com" from=$comments_records item=list}
    <tr style="height:37px">
      <td align=\'center\' valign=\'center\' class=fon_news_all>
        <table align=\'center\' style="width:100%" border=\'0\' cellspacing=\'0\' cellpadding=\'0\'>
          <tr>
            <td align=\'left\' valign=\'top\' fastedit:{$table_name_comments}:{$record.id}>
              <p class="date">
                {$list.datetime}{\',  %s\'|ftext:$list.name}
              </p>
              <br/>
              {$list.text}
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="height:15px">
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
    <tr style="height:20px">
      <td align=\'left\' valign=\'center\'>
        <img alt="" src=\'/modules/News/img/zero.gif\' width=\'3\' height=\'20px\' border=\'0\' />
      </td>
    </tr>
  </table>
  
  {if $comments_pages.records_count>0}
  <table border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
      <td>
        {\'Страница:\'|ftext}&nbsp;
        {section name="pages" start=1 loop=$comments_pages.page_count+1}
        <a {if $smarty.section.pages.index==$comments_pages.p_selected}style="font-weight:bold"{/if}  class="news_navigations" href="{$pageInfo.name}?{$tagInfo.act_variable}=more&id={$record.id}&page={$smarty.section.pages.index}">
          {$smarty.section.pages.index}
        </a>        
        {/section}
      </td>
    </tr>
  </table>
  {/if}
  
  <br/>
  <p style="color:gray">
    {\'Вы также можете добавить свой комментарий:\'|ftext}
  </p>
  <br/>
  {if $errors}
  {foreach from=$errors item=error}
  <p style="color:red">
    {$error|ftext}
  </p>
  {/foreach}
  <br/>
  {/if}
  
  {if $comment_is_added}
  <center>
    <h1>
      {\'Спасибо, Ваш комментарий будет добавлен после проверки администрацией сайта.\'|ftext}
    </h1>
  </center>
  {/if}
  
  <form id="comments_form" action="news?act=insert_comments&id={$record.id}#comments_form" method="get">
    <p>
      <input type="hidden" name="datetime" value="" />
      <input type="hidden" name="news_id" value="{$smarty.get.id}" />
    </p>    
    <table cellpadding="2" cellspacing="2">
      <tr>
        <td style="width:100px">
          {\'Ваше имя:\'|ftext}&nbsp;
          <span style="color:red">*</span>
        </td>
        <td>
          <input value="{$name}"  name="name" style="width:500px" />
        </td>
      </tr>
      <tr>
        <td>
          {\'Ваше email:\'|ftext}&nbsp;
          <span style="color:red">*</span>
          </td>
          <td>
            <input value="{$email}" name="email" style="width:500px" />
        </td>
      </tr>
      <tr>
        <td style="white-space:nowrap" valign="top">
          {\'Комментарий:\'|ftext}&nbsp;
          <span style="color:red">*</span>
        </td>
        <td>
          <textarea style="width:500px" rows="5" name="text" id="text">
            {$text}
          </textarea>
        </td>
      </tr>
      
      {if $settings.kcaptcha==1}
      <tr>        
        <td align=\'left\' valign=\'center\' style="width:100px">
          {\'Введите число:\'|ftext}&nbsp;
          <span style="color:red">*</span>
          </td>
          <td align="left" valign="top">            
            <table cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td align=\'left\' valign=\'center\' style="width:120px">
                  <img width="120px" height="50px"  id="kcaptcha_img" alt="{\'Включите отображеине изображений\'|ftext}" src=\'/modules/{$moduleInfo.module_name}/kcaptcha/index.php\' border=\'0\' />
                </td>
                <td  valign=\'center\' align="center">
                  <input name="kcaptcha" style="WIDTH: 105px" class=i_black>
                  <br/>
                  <a class="news_navigations" href="javascript:reloadKcaptcha()">
                    {\'поменять картинку\'|ftext}
                  </a>
                </td>                
              </tr>              
            </table>
        </td>
      </tr>      
      {/if}      
      <tr>
        <td style="height:30px">
        </td>
        <td valign="bottom">
          <input style="width:150px" class="button" type="submit" value="{\'Добавить комментарий\'|ftext}" />
        </td>
      </tr>
    </table>
  </form>
  <br/>
  <br/>  
  {/if}
</div>

{literal} 
<script type="text/javascript"> 
  function  reloadKcaptcha() {	
  var time = Math.random();  
  document.getElementById(\'kcaptcha_img\').src="/modules/{/literal}{$moduleInfo.module_name}{literal}/kcaptcha/index.php?t="+time;  
}
</script>
{/literal}',
          'loaded_name' => 'show_more.tpl',
          'sort_index' => '968',
          'block_name' => 'DataShow',
        ),
        1 => 
        array (
          'id' => '3',
          'block_id' => '6',
          'name' => 'show_list.tpl',
          'description' => 'Список',
          'content' => '<div fastedit::>
  <table style="width:100%" border=\'0\' cellspacing=\'0\' cellpadding=\'0\'>
    {foreach name="cat" from=$records item=list}
    <tr style="height:37px">
      <td align=\'center\' valign=\'center\' class="fon_news_all">
        <table style="width:100%" border=\'0\' cellspacing=\'0\' cellpadding=\'0\'>
          <tr>
            <td align=\'left\' valign=\'top\' fastedit:{$table_name}:{$list.id}>
              <p class="date">
                {$list.datetime}
            </p>
            {if $list.caption}
            <h1>
              {$list.caption}
            </h1>
            {/if}
            {$list.short_text}
          </td>
        </tr>
        {if $list.full_text}
        <tr>
          <td>
          	<table cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td style="width:65px;height:10px"  valign="middle">
                  <a href=\'{$pageInfo.name}?{$act_variable}=more&id={$list.id}\' class="more">
                    {\'подробнее\'|ftext}
                  </a>
                </td>
                <td style="width:10px" valign="middle" align="right">
                  <img alt="" src="/modules/News/img/str_blue.gif" hspace="0" border="0" />
                </td>
              </tr>
            </table>
          </td>
        </tr>
        {/if}
      </table>
    </td>
  </tr>
  <tr>
    <td style="height:15px">
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
  <tr style="height:20px">
    <td>
    </td>
  </tr>
  </table>
  
  <table border="0" cellpadding="2" cellspacing="0">
    <tr>
      <td>
        {\'Страница:\'|ftext}&nbsp;
        {section name="pages" start=1 loop=$pageRecords.page_count+1}
        <a {if $smarty.section.pages.index==$pageRecords.page_selected}style="font-weight:bold"{/if}  class="news_navigations" href="{$pageInfo.name}?page={$smarty.section.pages.index}">
          {$smarty.section.pages.index}
        </a>        
        {/section}
      </td>
    </tr>
  </table>
</div>',
          'loaded_name' => 'show_list.tpl',
          'sort_index' => '967',
          'block_name' => 'DataShow',
        ),
      ),
    ),
    6 => 
    array (
      'id' => '7',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Anonse',
      'description' => 'Вывод анонса',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '2',
      'loaded_name' => 'Anonse',
      'sort_index' => '577',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '11',
          'block_id' => '7',
          'name' => 'page_target',
          'value' => 'news',
          'description' => 'Имя страницы, на которую делать переход',
          'edit_s_type_id' => '1',
          'loaded_name' => 'page_target',
        ),
        1 => 
        array (
          'id' => '12',
          'block_id' => '7',
          'name' => 'records_in_anonse',
          'value' => '2',
          'description' => 'Выводить записей в анонсе',
          'edit_s_type_id' => '1',
          'loaded_name' => 'records_in_anonse',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '4',
          'block_id' => '7',
          'name' => 'anonse_list.tpl',
          'description' => 'Вывод анонса',
          'content' => '<div style="margin-left:5px;" fastedit:: >
  <div style="float:left">
    <h2 style="margin-top:0px">
      {\'Анонс новостей\'|ftext}
    </h2>
  </div>
  <div style="float:left;margin-left:10px;height:30px">
    <a alt="" href="rss" title="{\'Подписаться  на RSS канал\'|ftext}">
      <img src="/modules/{$moduleInfo.module_name}/img/rss_small.png" border=\'0\' />
    </a>
  </div>
  
  {foreach name="anonse" from=$records item=item}
  <div style="clear:both" fastedit:{$table_name}:{$item.id}>
    <span class="date">
      {$item.datetime}
    </span>
    <br/>
    <p class="news_anonse_capt">
      {$item.caption}
    </p>
    {if $item.short_text}
    <p class="news_anonse">
      {$item.short_text}
    </p>
    {/if}
    {if $item.full_text!=\'\'}
    <div style="float:left">
      <a href="{$settings.page_target}?{$act_variable}=more&id={$item.id}" class="more">
        {\'подробнее\'|ftext}
      </a>      
    </div>
    <div style="float:left;margin-left:5px">
      <img alt="" src="/modules/{$moduleInfo.module_name}/img/str_blue.gif" hspace="0" border="0" />
    </div>    
    {if !$smarty.foreach.anonse.last}
    <div style="width:100%;height:1px;background-color:#d9e4ef">
    </div>    
    {/if}      
    {/if}
  </div>
  {/foreach}
</div>',
          'loaded_name' => 'anonse_list.tpl',
          'sort_index' => '969',
          'block_name' => 'Anonse',
        ),
      ),
    ),
  ),
  'TABLES' => 
  array (
    0 => 
    array (
      'id' => '1',
      'module_id' => '1',
      'name' => 'comments',
      'description' => 'Комментарии',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'comments',
      'sort_index' => '1132',
      'table_name' => 'comments',
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
          'edittype_id' => '5',
          'fieldname' => 'enable',
          'comment' => 'Активно',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
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
          'table_name' => 'comments',
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
          'fieldname' => 'datetime',
          'comment' => 'Дата добавления',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '12',
          'len' => '',
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
          'sort_index' => '100',
          'table_name' => 'comments',
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
          'fieldname' => 'news_id',
          'comment' => 'Новость',
          'sourse_field_id' => '16',
          'delete' => '1',
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
          'sort_index' => '95',
          'table_name' => 'comments',
          'sourse_table_name' => 'data',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '4',
          'field_id' => '4',
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
          'fieldname' => 'text',
          'comment' => 'Комментарий',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '3',
          'len' => '',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '70',
          'table_name' => 'comments',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '5',
          'field_id' => '5',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => '4',
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
          'regex' => '/^[a-z0-9](?:[a-z0-9_\\.-]*[a-z0-9])*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])*\\.)+[a-z]{2,4}$/i',
          'edittype_id' => '1',
          'fieldname' => 'email',
          'comment' => 'Email',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '80',
          'table_name' => 'comments',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '6',
          'field_id' => '6',
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
          'sort_index' => '110',
          'table_name' => 'comments',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '7',
          'field_id' => '7',
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
          'fieldname' => 'show_data',
          'comment' => 'Выводить дату',
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
          'sort_index' => '50',
          'table_name' => 'comments',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        7 => 
        array (
          'id' => '8',
          'field_id' => '8',
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
          'fieldname' => 'name',
          'comment' => 'Имя',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '250',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '90',
          'table_name' => 'comments',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    1 => 
    array (
      'id' => '2',
      'module_id' => '1',
      'name' => 'data',
      'description' => 'Новости',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'data',
      'sort_index' => '982',
      'table_name' => 'data',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '9',
          'field_id' => '9',
          'active' => '1',
          'show_in_list' => '1',
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
          'edittype_id' => '5',
          'fieldname' => 'rss',
          'comment' => 'Выводить в RSS',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '62',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '10',
          'field_id' => '10',
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
          'comment' => 'Title - описание',
          'sourse_field_id' => '16',
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
          'sort_index' => '60',
          'table_name' => 'data',
          'sourse_table_name' => 'data',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '11',
          'field_id' => '11',
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
          'sourse_field_id' => '16',
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
          'sort_index' => '80',
          'table_name' => 'data',
          'sourse_table_name' => 'data',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '12',
          'field_id' => '12',
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
          'sort_index' => '200',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '13',
          'field_id' => '13',
          'active' => '1',
          'show_in_list' => '1',
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
          'edittype_id' => '1',
          'fieldname' => 'datetime',
          'comment' => 'Дата добавления',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '12',
          'len' => '',
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
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '14',
          'field_id' => '14',
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
          'sourse_field_id' => '16',
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
          'sort_index' => '55',
          'table_name' => 'data',
          'sourse_table_name' => 'data',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '15',
          'field_id' => '15',
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
          'fieldname' => 'short_text',
          'comment' => 'Краткое описание',
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
          'sort_index' => '75',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        7 => 
        array (
          'id' => '16',
          'field_id' => '16',
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
          'comment' => 'Название',
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
          'sort_index' => '85',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        8 => 
        array (
          'id' => '17',
          'field_id' => '17',
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
          'sourse_field_id' => '16',
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
        9 => 
        array (
          'id' => '18',
          'field_id' => '18',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '500',
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
          'fieldname' => 'full_text',
          'comment' => 'Полное описание',
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
          'sort_index' => '70',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        10 => 
        array (
          'id' => '19',
          'field_id' => '19',
          'active' => '1',
          'show_in_list' => '1',
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
          'edittype_id' => '5',
          'fieldname' => 'enable',
          'comment' => 'Активно',
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
          'sort_index' => '65',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        11 => 
        array (
          'id' => '20',
          'field_id' => '20',
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
          'fieldname' => 'delayed_publication',
          'comment' => 'Отложенная публикация',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '150',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        12 => 
        array (
          'id' => '21',
          'field_id' => '21',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => '0',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => '20',
          'hide_operator' => '0',
          'hide_on_value' => '0',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'datetime_start',
          'comment' => 'Начало публикации',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '12',
          'len' => '',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '1',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '140',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => 'delayed_publication',
        ),
        13 => 
        array (
          'id' => '22',
          'field_id' => '22',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => '0',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => '20',
          'hide_operator' => '0',
          'hide_on_value' => '0',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'datetime_end',
          'comment' => 'Публикация в анонсе до',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '12',
          'len' => '',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '1',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '130',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => 'delayed_publication',
        ),
      ),
    ),
  ),
  'MODULE' => 
  array (
    'id' => '1',
    'name' => 'News',
    'version' => '1',
    'description' => 'Новости',
    'loaded' => '1',
    'need_save' => '0',
    'loaded_name' => 'News',
    'sort_index' => '1',
  ),
);
?>