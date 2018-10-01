<?php
$DATA=array (
  'BDSTRUCTURE' => 
  array (
  ),
  'BLOCKS' => 
  array (
    0 => 
    array (
      'id' => '12',
      'module_id' => '3',
      'type' => '2',
      'name' => 'SearchForm',
      'description' => 'Форма поиска по сайту',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'SearchForm',
      'sort_index' => '593',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '20',
          'block_id' => '12',
          'name' => 'page_result',
          'value' => '',
          'description' => 'Имя страницы вывода результата поиска (если указано,  модуль будет работать быстрее)',
          'edit_s_type_id' => '1',
          'loaded_name' => 'page_result',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '7',
          'block_id' => '12',
          'name' => 'search_form.tpl',
          'description' => 'Форма поиска по сайту',
          'content' => '{literal} 
<script type="text/javascript">
function cleare_search(obj) {
	{/literal}
	if (obj.value=="{if $search_text}{$search_text}{else}{\' Поиск по сайту\'|ftext}{/if}") {literal}	{
		obj.value=\'\';
		obj.style.color=\'black\';
	}
}    
</script> 
{/literal}

<form  fastedit:: action="{$page_result}" method="get">
  <div style="float:left">
    <input name="search_text" onclick="cleare_search(this)" style=\'width: 100px;\' value="{if isset($search_text)}{$search_text}{else}{\' Поиск по сайту\'|ftext}{/if}" />    
  </div>
  <div style="float:left;margin-left:5px">
    <input type="submit" class="button" value="{\'Искать\'|ftext}"  border=\'0\' hspace=\'0\' />
  </div>  
</form>',
          'loaded_name' => 'search_form.tpl',
          'sort_index' => '1000',
          'block_name' => 'SearchForm',
        ),
      ),
    ),
    1 => 
    array (
      'id' => '13',
      'module_id' => '3',
      'type' => '2',
      'name' => 'SearchResult',
      'description' => 'Результат поиска',
      'act_variable' => 'search',
      'act_method' => 'post',
      'url_get_vars' => 'search_text',
      'general_table_id' => NULL,
      'loaded_name' => 'SearchResult',
      'sort_index' => '512',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '21',
          'block_id' => '13',
          'name' => '_blank',
          'value' => '1',
          'description' => 'При клике открывать найденные страницы в новом окне',
          'edit_s_type_id' => '3',
          'loaded_name' => '_blank',
        ),
        1 => 
        array (
          'id' => '22',
          'block_id' => '13',
          'name' => 'strip',
          'value' => '100',
          'description' => 'Сколько символов найденного текста выводить',
          'edit_s_type_id' => '1',
          'loaded_name' => 'strip',
        ),
        2 => 
        array (
          'id' => '23',
          'block_id' => '13',
          'name' => 'register',
          'value' => '0',
          'description' => 'Учитывать регистр при поиске',
          'edit_s_type_id' => '3',
          'loaded_name' => 'register',
        ),
        3 => 
        array (
          'id' => '24',
          'block_id' => '13',
          'name' => 'recordsPerPage',
          'value' => '10',
          'description' => 'Выводить записей на страницу',
          'edit_s_type_id' => '1',
          'loaded_name' => 'recordsPerPage',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '8',
          'block_id' => '13',
          'name' => 'result_list.tpl',
          'description' => 'Вывод результата поиска',
          'content' => '{literal}
<style>
  .highlight {
    background-color:yellow;
  }
</style>
{/literal}

<div fastedit::>
{if $find_text_count>0}
  <h3>
    {\'По ключевой фразе <span color="Green">«%s»</span>найдено товаров: <span color="Olive">%s</span>\'|ftext:$search_text:$find_text_count} 
  </h3>
  
  {foreach from=$find_text item=txt}
  <div>
    <b>
      {$txt.founded_page_description}
    </b>
    <br>
    <a {if $settings._blank} target="_blank" {/if} class="more" href="{$txt.founded_url}" >
      {$txt.founded_text}
    </a>
  </div>
  <div style="background-color:#eaeaea;height:1px;width:100%;margin-top:10px;margin-bottom:10px">
  </div>  
  {/foreach}
  
{if $pages.page_count != \'\'}
  <div style="text-align:right">
  {\'Страница:\'|ftext}
      {if $pages.page_selected>1}<a class="step" href="?page=1&search_text={$search_text}"><<</a>&nbsp; <a class="step" href="?page={$pages.page_selected-1}&search_text={$search_text}"><</a>{/if}
      &nbsp;&nbsp;
      {section name="pages" start=1 loop=$pages.page_count+1} <a {if $smarty.section.pages.index==$pages.page_selected}class="step_selected"{else}class="step"{/if} href="?page={$smarty.section.pages.index}&search_text={$search_text}">{$smarty.section.pages.index}</a> &nbsp;
      {/section}
      {if $pages.page_selected<$pages.page_count}<a class="step" href="?page={$pages.page_selected+1}&search_text={$search_text}">></a>&nbsp; <a class="step" href="?page={$pages.page_count}&search_text={$search_text}">>></a>{/if} 
  </div>

{/if}
{else}
	<h3>{\'По ключевой фразе <span color="Green">«%s»</span> ничего не найдено\'|ftext:$search_text}</h3>
{/if} 
</div>',
          'loaded_name' => 'result_list.tpl',
          'sort_index' => '834',
          'block_name' => 'SearchResult',
        ),
      ),
    ),
  ),
  'TABLES' => 
  array (
  ),
  'MODULE' => 
  array (
    'id' => '3',
    'name' => 'Search',
    'version' => '1',
    'description' => 'Поиск по сайту',
    'loaded' => '1',
    'need_save' => '0',
    'loaded_name' => 'Search',
    'sort_index' => '3',
  ),
  'TABLES_DATA' => 
  array (
  ),
  'TABLES_DATA_MULTISELECT' => 
  array (
  ),
);
?>