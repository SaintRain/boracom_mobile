{literal}
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
          <img alt="" src="/modules/Faq/img/rss_small.png" border='0' />
        </a>
      </td>
      <td style="width:10px">
      </td>
      <td>
        <h1>
          {'Выберите тему:'|ftext}
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
      {'Вернуться назад'|ftext}
    </a>
  
<br/>     
</div>	

{include file="$form_template"}