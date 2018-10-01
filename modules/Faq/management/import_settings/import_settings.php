<?php
$DATA=array (
  'BDSTRUCTURE' => 
  array (
    'data' => 
    array (
      0 => 'CREATE TABLE `data` (
`id` INT(11)  NOT NULL auto_increment ,
`datetime` DATETIME      ,
`category_id` INT(11)     default NULL ,
`question` VARCHAR(450) character set utf8 collate utf8_general_ci    default NULL ,
`translit` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`author` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`email` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`answer` LONGTEXT character set utf8 collate utf8_general_ci    default NULL ,
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
    'categories' => 
    array (
      0 => 'CREATE TABLE `categories` (
`id` INT(11)  NOT NULL auto_increment ,
`name` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`translit` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
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
      'id' => '13',
      'module_id' => '2',
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
          'id' => '12',
          'block_id' => '13',
          'name' => 'metakeywords',
          'value' => '',
          'description' => 'Meta-ключевые слова по умолчанию',
          'edit_s_type_id' => '2',
          'loaded_name' => 'metakeywords',
        ),
      ),
      'templates' => 
      array (
      ),
    ),
    1 => 
    array (
      'id' => '14',
      'module_id' => '2',
      'type' => '2',
      'name' => 'Title',
      'description' => 'Заголовок title',
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
          'id' => '13',
          'block_id' => '14',
          'name' => 'title',
          'value' => '',
          'description' => 'Title-заголовок по умолчанию',
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
      'id' => '15',
      'module_id' => '2',
      'type' => '2',
      'name' => 'showData',
      'description' => 'Вывод вопросов',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '10',
      'loaded_name' => 'showData',
      'sort_index' => '578',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '14',
          'block_id' => '15',
          'name' => 'records_for_page',
          'value' => '11',
          'description' => 'Выводить записей на страницу',
          'edit_s_type_id' => '1',
          'loaded_name' => 'records_for_page',
        ),
        1 => 
        array (
          'id' => '15',
          'block_id' => '15',
          'name' => 'page_target',
          'value' => 'faq',
          'description' => 'Имя страницы, на которую делать переход',
          'edit_s_type_id' => '1',
          'loaded_name' => 'page_target',
        ),
        2 => 
        array (
          'id' => '16',
          'block_id' => '15',
          'name' => 'date_format',
          'value' => 'd.m.Y H:i:s',
          'description' => 'Формат даты (например, d.m.Y)',
          'edit_s_type_id' => '1',
          'loaded_name' => 'date_format',
        ),
        3 => 
        array (
          'id' => '17',
          'block_id' => '15',
          'name' => 'kcaptcha',
          'value' => '1',
          'description' => 'Использовать kcaptcha-защиту',
          'edit_s_type_id' => '3',
          'loaded_name' => 'kcaptcha',
        ),
        4 => 
        array (
          'id' => '18',
          'block_id' => '15',
          'name' => 'SearchSettings',
          'value' => '	array (
	//имя таблицы без префикса
	\'data\'=>array (
	\'sql\'=>"
SELECT t.id, t.category_id, t.author, t.question, t.answer 
FROM `{$this->tablePrefix}data` AS `t` 
LEFT JOIN `{$this->tablePrefix}categories` AS `t2` ON (t2.id=t.category_id)
WHERE t.lang_id=\'{$this->lang_id}\' AND t.enable=1
AND (t.author LIKE \'%{$this->search_text}%\' OR t.question LIKE \'%{$this->search_text}%\' OR t.answer LIKE \'%{$this->search_text}%\')
ORDER BY t.sort_index DESC",  					
	//Формат URL
	\'url\'=>\'?act=more&category_id={$category_id}&id={$id}\'
	)
	);',
          'description' => 'Настройки для модуля Search',
          'edit_s_type_id' => '2',
          'loaded_name' => 'SearchSettings',
        ),
        5 => 
        array (
          'id' => '19',
          'block_id' => '15',
          'name' => 'date_format_comments',
          'value' => 'd.m.Y H:i:s',
          'description' => 'Формат даты в комментариях (например, d.m.Y H:i:s)',
          'edit_s_type_id' => '1',
          'loaded_name' => 'date_format_comments',
        ),
        6 => 
        array (
          'id' => '20',
          'block_id' => '15',
          'name' => 'mailSubject',
          'value' => 'Новый вопрос на вашем сайте!',
          'description' => 'Тема уведомления',
          'edit_s_type_id' => '1',
          'loaded_name' => 'mailSubject',
        ),
        7 => 
        array (
          'id' => '21',
          'block_id' => '15',
          'name' => 'usernameEmailCaption',
          'value' => '',
          'description' => 'Имя получателя уведомления',
          'edit_s_type_id' => '1',
          'loaded_name' => 'usernameEmailCaption',
        ),
        8 => 
        array (
          'id' => '22',
          'block_id' => '15',
          'name' => 'sendEmailTo',
          'value' => '',
          'description' => 'Отправлять уведомление о новом вопросе на Email',
          'edit_s_type_id' => '1',
          'loaded_name' => 'sendEmailTo',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '21',
          'block_id' => '15',
          'name' => 'show_more.tpl',
          'description' => 'Подробное описание',
          'content' => '{literal}
<script type="text/javascript">
function refreshFAQ(cat_id) {	
	location.href={/literal}"/{$pageInfo.name}/"{literal}+cat_id.value;
}
</script>
{/literal}

<div fastedit:{$table_name}:>
  <table valign="top" border="0" cellspacing="0" cellpadding="0">
	<tr>
      <td>
        <a href="rss_faq" alt="" title="Подписаться  на RSS канал">
          <img alt="" src="/modules/Faq/img/rss_small.png" border=\'0\' />
        </a>
      </td>
      <td style="width:10px">
      </td>
      <td>
        <h1>
          {\'Выберите тему:\'|ftext}
        </h1>
      </td>
      <tr>
  </table>

<select onChange="refreshFAQ(this)" name="category_id" style="width:300px">
   {foreach from=$cats item=item}
      <option {if $item.id==$cat_id} selected {/if} value="{$item.translit}">{$item.name}</option>
   {/foreach}
</select>
      	
  <br/>
  <br/>

  <table fastedit:{$table_name}:{$record.id} style="width:100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" valign="top"><p style="font-size:11px">{$record.datetime} {$record.author}</p>
        {if $record.question}        
        	<p style="margin-top:5px"><b>{$record.question}</b></p>
        {/if}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">{$record.answer}</td>
    </tr>
  <tr>
    <td style="height:15px" ></td>
  </tr>
  <tr>
    <td style="height:1px;background-color:#eaeaea"></td>
  </tr>
  <tr>
    <td style="height:10px"></td>
  </tr>  
  </table>

  
    <a style="text-align:center" class="moor" href="?category_id={$cat_id}{if $smarty.session.faq_page}&page={$smarty.session.faq_page}{/if}">
      {\'Вернуться назад\'|ftext}
    </a>
  
<br/>     
</div>	

{include file="$form_template"}',
          'loaded_name' => 'show_more.tpl',
          'sort_index' => '968',
          'block_name' => 'showData',
        ),
        1 => 
        array (
          'id' => '22',
          'block_id' => '15',
          'name' => 'show_list.tpl',
          'description' => 'Список',
          'content' => '{literal}
<script type="text/javascript">
function refreshFAQ(cat_id) {
	location.href=cat_id.value;
}
</script>
{/literal}

<div fastedit:{$table_name}:>
  <table border="0" cellspacing="0" cellpadding="0">
	<tr>
      <td>
        <a href="rss_faq" title="{\'Подписаться  на RSS канал\'|ftext}">
          <img alt="" src="/modules/Faq/img/rss_small.png" border=\'0\' />
        </a>
      </td>
      <td style="width:10px">
      </td>
      <td>
        <h1 style="margin:0px">
          {\'Выберите тему:\'|ftext}
        </h1>
      </td>
      <tr>
  </table>

<select onChange="refreshFAQ(this)" name="category_id" style="width:300px">
{foreach from=$cats item=item}
	<option {if $item.id==$cat_id} selected {/if} value="{"?category_id=`$item.id`"|furl}">{$item.name}</option>
{/foreach}
</select>      	

  <br/>
  <br/>

{if $records}
<table style="width:100%" border="0" cellspacing="0" cellpadding="0">
  {foreach name="cat" from=$records item=list}
  <tr style="height:37px">
    <td align="center" valign="middle" class="fon_news_all">
    <table style="width:100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top" fastedit:{$table_name}:{$list.id}>          
              <p style="font-size:11px">{$list.datetime} {$list.author}</p>              
              <p style="margin-top:5px"><b>{$list.question}</b></p>          
              </td>
        </tr>
        {if $list.answer}
        <tr>
          <td>
          <table cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td style="height:10px;white-space:nowrap" valign="middle"><a href="{$pageInfo.name}?{$act_variable}=more&category_id={$list.category_id}&id={$list.id}" class="more">{"смотреть ответ"|ftext}</a></td>
                <td style="width:10px"></td>
              </tr>
          </table>
          </td>
        </tr>
        {/if}
      </table></td>
  </tr>
  <tr>
    <td style="height:15px"></td>
  </tr>
  <tr>
    <td style="height:1px;background-color:#eaeaea"></td>
  </tr>
  <tr>
    <td style="height:10px"></td>
  </tr>
  {/foreach}
</table>


<table border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td>{"Страница:"|ftext}&nbsp;
      {section name="pages" start=1 loop=$pageRecords.page_count+1}
      	 <a {if $smarty.section.pages.index==$pageRecords.page_selected}style="font-weight:bold"{/if} href="{$pageInfo.name}?category_id={$cat_id}&page={$smarty.section.pages.index}">{$smarty.section.pages.index}</a> 
      {/section}
    </td>
  </tr>
</table>
{else}
	<h2>{"В данной категории еще нет вопросов"|ftext}</h2>
{/if}
  
  <div style="width:100%;height:1px;background-color:#e1e5e8">
  </div>
<br/>
</div>

{include file="$form_template"}',
          'loaded_name' => 'show_list.tpl',
          'sort_index' => '967',
          'block_name' => 'showData',
        ),
        2 => 
        array (
          'id' => '23',
          'block_id' => '15',
          'name' => 'message_to_admin.tpl',
          'description' => 'Уведомление о новом вопросе',
          'content' => '<p>Здравствуйте {$settings.usernameEmailCaption}!</p>
<p>На вашем сайте добавлен новый вопрос:</p>
<br/>
<pre>{$user_text}</pre>
<br/>
<p>Для ответа и публикации данного материала перейдите в <a href="{$smarty.const.SETTINGS_HTTP_HOST}/admin">админзону</a></p>',
          'loaded_name' => 'message_to_admin.tpl',
          'sort_index' => '1573',
          'block_name' => 'showData',
        ),
        3 => 
        array (
          'id' => '24',
          'block_id' => '15',
          'name' => 'form.tpl',
          'description' => 'Форма добавления вопроса',
          'content' => '<div fastedit:{$table_name}:>
{if $errors}
	{foreach from=$errors item=error}
		<p style="color:red">{$error|ftext}</p>
	{/foreach} 
	<br/>
{/if}

{if $comment_is_added}
	<h2>{\'Спасибо, Ваш комментарий будет добавлен после проверки администрацией сайта.\'|ftext}</h2>
	<br/>
	<br/>
	<br/>
{/if}

<h1>{\'Вы можете задать свой вопрос\'|ftext}</h1>
<form id="comments_form" action="{$settings.page_target}?act=insert_comments&category_id={$cat_id}{if $record.id}&id={$record.id}{/if}#comments_form" method="post">
<p>
  <input type="hidden" name="title" value="" />
  <input type="hidden" name="metadescription" value="" />
  <input type="hidden" name="metakeywords" value="" />
  <input type="hidden" name="datetime" value="" />
  <input type="hidden" name="news_id" value="{$smarty.get.id}" />
</p>  
  <table cellpadding="2" cellspacing="2">  
	<tr>
      <td style="width:100px">{\'Тема:\'|ftext}&nbsp;<span style="color:red">*</span></td>
      <td>
      <select name="category_id" style="width:300px">
      {foreach from=$cats item=item}
      	<option {if $item.id==$category_id || $item.id==$cat_id} selected {/if} value="{$item.id}">{$item.name}</option>
      {/foreach}
      </select>
      </td>
    </tr>      
    <tr>
      <td>{\'Ваше имя:\'|ftext}&nbsp;<span style="color:red">*</span></td>
      <td><input value="{$author}"  name="author" style="width:300px" /></td>
    </tr>
    <tr>
      <td>{\'Ваш email:\'|ftext}&nbsp;<span style="color:red">*</span></td>
      <td><input value="{$email}" name="email" style="width:300px" /></td>
    </tr>
    <tr>
      <td style="white-space:nowrap" valign="top">{\'Ваш вопрос:\'|ftext}&nbsp;<span style="color:red">*</span></td>
      <td><textarea style="width:500px" rows="5" name="question" id="question">{$question}</textarea></td>
    </tr>
    
    {if $settings.kcaptcha==1}
    <tr>    
      <td align="left" valign="center" style="white-space:nowrap">{\'Введите текст:\'|ftext}&nbsp;<span style="color:red">*</span></td>
      <td align="left" valign="top">    
    	<table cellpadding="0" cellspacing="0" border="0">
          <tr>
        	<td align="left" valign="center" style="width:120px">
              <img width="120px" height="50px"  id="kcaptcha_img" alt="{\'Включите отображеине изображений\'|ftext}" src="/modules/{$moduleInfo.module_name}/kcaptcha/index.php" border="0" hspace="0" />
          </td>
          <td  valign="center" align="center">
            <input name="kcaptcha" style="width:105px" />
            <p>
              <a href="javascript:reloadKcaptcha()">{"поменять картинку"|ftext}</a>
            </p>
          </td>
          </tr>          
    	</table>
       </td>
      </tr>    
    {/if}
        
    <tr>
      <td style="height:30px"></td>
      <td valign="bottom"><input style="width:120px" class="button" type="submit" value="{\'Задать вопрос\'|ftext}" /></td>
    </tr>
  </table>
</form>
</div>

{literal} 
<script type="text/javascript"> 
function  reloadKcaptcha() {	
	var time = Math.random();			
 	document.getElementById("kcaptcha_img").src="/modules/{/literal}{$moduleInfo.module_name}{literal}/kcaptcha/index.php?t="+time;    
}
</script> 
{/literal}      ',
          'loaded_name' => 'form.tpl',
          'sort_index' => '1560',
          'block_name' => 'showData',
        ),
      ),
    ),
    3 => 
    array (
      'id' => '16',
      'module_id' => '2',
      'type' => '2',
      'name' => 'RSS',
      'description' => 'Выгрузка RSS',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '10',
      'loaded_name' => 'RSS',
      'sort_index' => '1056',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '25',
          'block_id' => '16',
          'name' => 'show_rss.tpl',
          'description' => 'Выгрузка RSS',
          'content' => '<?xml version="1.0"?>
<rss version="2.0">
  <channel>
    <title>FAQ на сайте {$smarty.const.SETTINGS_HTTP_HOST}</title>
    <link>{$smarty.const.SETTINGS_HTTP_HOST}</link>
    <description>FAQ на сайте {$smarty.const.SETTINGS_HTTP_HOST}</description>
    <language>ru</language>
    <pubDate>Wed, 02 Oct 2002 13:00:00 GMT</pubDate>
    <lastBuildDate>{$date}</lastBuildDate>
    <docs>{$smarty.const.SETTINGS_HTTP_HOST}/rss_faq</docs>
    <generator>http://www.GoodCMS.net</generator>
    <managingEditor>{$smarty.const.SETTINGS_EMAIL_USERNAME} ({$smarty.const.SETTINGS_EMAIL_CAPTION})</managingEditor>
    <webMaster>{$smarty.const.SETTINGS_EMAIL_USERNAME} ({$smarty.const.SETTINGS_EMAIL_CAPTION})</webMaster>
    {foreach from=$records item=item}
    <item>
      <title>{$item.question}</title>
      <link>{$smarty.const.SETTINGS_HTTP_HOST}/faq/{$item.cat_translit}/{$item.translit}</link>
      <description>{$item.answer}</description>
      <pubDate>{$item.datetime}</pubDate>
      <guid>{$smarty.const.SETTINGS_HTTP_HOST}/faq/{$item.cat_translit}/{$item.translit}</guid>
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
    4 => 
    array (
      'id' => '17',
      'module_id' => '2',
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
          'id' => '23',
          'block_id' => '17',
          'name' => 'metadescription',
          'value' => '',
          'description' => 'Meta-описание по умолчанию',
          'edit_s_type_id' => '2',
          'loaded_name' => 'metadescription',
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
      'id' => '10',
      'module_id' => '2',
      'name' => 'data',
      'description' => 'Вопросы ',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'data',
      'sort_index' => '982',
      'table_name' => 'data',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '74',
          'field_id' => '74',
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
          'edittype_id' => '3',
          'fieldname' => 'category_id',
          'comment' => 'Категория',
          'sourse_field_id' => '88',
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
          'sort_index' => '87',
          'table_name' => 'data',
          'sourse_table_name' => 'categories',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '75',
          'field_id' => '75',
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
          'regex' => '/^[\\.\\-_A-Za-z0-9]+?@[\\.\\-A-Za-z0-9]+?\\.[a-z0-9]{2,6}$/u',
          'edittype_id' => '1',
          'fieldname' => 'email',
          'comment' => 'Ваше email',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '1',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '72',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '76',
          'field_id' => '76',
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
          'comment' => 'Публиковать',
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
        3 => 
        array (
          'id' => '77',
          'field_id' => '77',
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
          'fieldname' => 'answer',
          'comment' => 'Ответ',
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
        4 => 
        array (
          'id' => '78',
          'field_id' => '78',
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
          'sourse_field_id' => '79',
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
          'sourse_field_name' => 'question',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '79',
          'field_id' => '79',
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
          'edittype_id' => '2',
          'fieldname' => 'question',
          'comment' => 'Вопрос',
          'sourse_field_id' => NULL,
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
          'sort_index' => '85',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '80',
          'field_id' => '80',
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
          'edittype_id' => '1',
          'fieldname' => 'author',
          'comment' => 'Ваше имя',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '1',
          'not_null' => '1',
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
          'id' => '81',
          'field_id' => '81',
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
          'sourse_field_id' => '79',
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
          'sourse_field_name' => 'question',
          'hide_by_field_caption' => '',
        ),
        8 => 
        array (
          'id' => '82',
          'field_id' => '82',
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
        9 => 
        array (
          'id' => '83',
          'field_id' => '83',
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
          'sort_index' => '100',
          'table_name' => 'data',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        10 => 
        array (
          'id' => '84',
          'field_id' => '84',
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
          'sourse_field_id' => '79',
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
          'sourse_field_name' => 'question',
          'hide_by_field_caption' => '',
        ),
        11 => 
        array (
          'id' => '85',
          'field_id' => '85',
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
          'sourse_field_id' => '79',
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
          'sourse_field_name' => 'question',
          'hide_by_field_caption' => '',
        ),
        12 => 
        array (
          'id' => '86',
          'field_id' => '86',
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
      ),
    ),
    1 => 
    array (
      'id' => '11',
      'module_id' => '2',
      'name' => 'categories',
      'description' => 'Категории',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'categories',
      'sort_index' => '1301',
      'table_name' => 'categories',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '88',
          'field_id' => '88',
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
          'comment' => 'Тема обсуждений',
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
          'sort_index' => '90',
          'table_name' => 'categories',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '89',
          'field_id' => '89',
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
          'sourse_field_id' => '88',
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
          'sort_index' => '0',
          'table_name' => 'categories',
          'sourse_table_name' => 'categories',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '90',
          'field_id' => '90',
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
          'table_name' => 'categories',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
  ),
  'MODULE' => 
  array (
    'id' => '2',
    'name' => 'Faq',
    'version' => '1',
    'description' => 'FAQ',
    'loaded' => '1',
    'need_save' => '0',
    'loaded_name' => 'Faq',
    'sort_index' => '2',
  ),
  'TABLES_DATA' => 
  array (
    'data' => 
    array (
      0 => 
      array (
        'id' => '1',
        'datetime' => '2012-02-15 09:42:55',
        'category_id' => '1',
        'question' => 'werwer 
werwe
r',
        'translit' => 'werwer-werwe-r',
        'author' => 'wer',
        'email' => 'saintrain@mail.ru',
        'answer' => '<p>
	erterterter</p>
<p>
	t</p>
<p>
	ert</p>
',
        'enable' => '1',
        'rss' => '0',
        'title' => 'werwer 
werwe
r',
        'metadescription' => 'werwer 
werwe
r',
        'metakeywords' => 'werwer 
werwe
r',
        'page_id' => '0',
        'tag_id' => '97',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
      1 => 
      array (
        'id' => '2',
        'datetime' => '2012-02-15 10:33:30',
        'category_id' => '2',
        'question' => 'qweqweqwe',
        'translit' => 'qweqweqwe',
        'author' => 'фывфыв',
        'email' => 'saintrain@mail.ru',
        'answer' => '',
        'enable' => '0',
        'rss' => '0',
        'title' => 'qweqweqwe',
        'metadescription' => 'qweqweqwe',
        'metakeywords' => 'qweqweqwe',
        'page_id' => '0',
        'tag_id' => '97',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
    ),
    'categories' => 
    array (
      0 => 
      array (
        'id' => '1',
        'name' => 'Как получить ответ?',
        'translit' => 'kak-poluchit-otvet',
        'page_id' => '0',
        'tag_id' => '97',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      1 => 
      array (
        'id' => '2',
        'name' => 'Как получить помощь?',
        'translit' => 'kak-poluchit-pomosh',
        'page_id' => '0',
        'tag_id' => '97',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
    ),
  ),
  'TABLES_DATA_MULTISELECT' => 
  array (
    'cms_multiselect_data' => 
    array (
      0 => 
      array (
        'field_id' => '796',
        'data_id' => '2',
        'value_id' => '1',
      ),
    ),
  ),
);
?>