{literal}
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
          {'По ключевой фразе <span color="#016cc3">«%s»</span>найдено записей: <span color="#016cc3">%s</span>'|ftext:$search_text:$find_text_count}
        </h3>
      </td>
    </tr>
  </table>

  <table style="width:100%" cellpadding="0" cellspacing="0" border="0">
    {foreach from=$find_text item=txt}
    <tr>
      <td>
        {'Глава'|ftext} 
        <b>
          «{$txt.caption}»
        </b>
        <br/>
        {'Найденный текст:'|ftext} 
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

{if $pages.page_count != ''}
<table style="width:100%" border="0" cellpadding="0" cellspacing="0" align="center">  
    <td align="right"> {'Страница:'|ftext}
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
	{'По ключевой фразе <span color="#016cc3">«%s»</span> ничего не найдено'|ftext:$search_text}              
</h3>
{/if} 
</div>