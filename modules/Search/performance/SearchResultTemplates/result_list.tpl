{literal}
<style>
  .highlight {
    background-color:yellow;
  }
</style>
{/literal}

<div fastedit::>
{if $find_text_count>0}
  <h3>
    {'По ключевой фразе <span color="Green">«%s»</span>найдено товаров: <span color="Olive">%s</span>'|ftext:$search_text:$find_text_count} 
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
  
{if $pages.page_count != ''}
  <div style="text-align:right">
  {'Страница:'|ftext}
      {if $pages.page_selected>1}<a class="step" href="?page=1&search_text={$search_text}"><<</a>&nbsp; <a class="step" href="?page={$pages.page_selected-1}&search_text={$search_text}"><</a>{/if}
      &nbsp;&nbsp;
      {section name="pages" start=1 loop=$pages.page_count+1} <a {if $smarty.section.pages.index==$pages.page_selected}class="step_selected"{else}class="step"{/if} href="?page={$smarty.section.pages.index}&search_text={$search_text}">{$smarty.section.pages.index}</a> &nbsp;
      {/section}
      {if $pages.page_selected<$pages.page_count}<a class="step" href="?page={$pages.page_selected+1}&search_text={$search_text}">></a>&nbsp; <a class="step" href="?page={$pages.page_count}&search_text={$search_text}">>></a>{/if} 
  </div>

{/if}
{else}
	<h3>{'По ключевой фразе <span color="Green">«%s»</span> ничего не найдено'|ftext:$search_text}</h3>
{/if} 
</div>