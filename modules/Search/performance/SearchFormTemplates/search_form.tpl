{literal} 
<script type="text/javascript">
function cleare_search(obj) {
	{/literal}
	if (obj.value=="{if $search_text}{$search_text}{else}{' Поиск по сайту'|ftext}{/if}") {literal}	{
		obj.value='';
		obj.style.color='black';
	}
}    
</script> 
{/literal}

<form  fastedit:: action="{$page_result}" method="get">
  <div style="float:left">
    <input name="search_text" onclick="cleare_search(this)" style='width: 100px;' value="{if isset($search_text)}{$search_text}{else}{' Поиск по сайту'|ftext}{/if}" />    
  </div>
  <div style="float:left;margin-left:5px">
    <input type="submit" class="button" value="{'Искать'|ftext}"  border='0' hspace='0' />
  </div>  
</form>