{literal} 
<script type="text/javascript">
function cleare_search2(obj) {	
	if (obj.value=="{/literal} {'Поиск товара'|ftext}{literal}") {
		obj.value='';
		obj.style.color='black';
	}
}

function checkSubmit() {
	if (document.getElementById('products_search_text').value=="{/literal} {'Поиск товара'|ftext}{literal}") {
		return false;
		}	
} 
</script> 
{/literal}

<form fastedit:: id="SearchProductsForm" action="internet-shop" method="get" onSubmit="return checkSubmit()">
  <table  border='0' cellspacing='2' cellpadding='0'>
    <tr>
      <td style="width:110px" align='center' valign='center'>
        <input name="products_search_text" id="products_search_text" onclick="cleare_search2(this)" style='width:400px;' value="{if $products_search_text}{$products_search_text}{else} {'Поиск товара'|ftext}{/if}" />
      </td>
      <td style="width:5px">
      </td>
      <td align='center' valign='center'>
        <input type="submit" class="button" value="{'Искать товар'|ftext}" />
      </td>
    </tr>
    {if $products_search_text}
    <tr>
      <td colspan="100%" align="center">
        <a href="internet-shop?{if $smarty.get.category_id}category_id={$smarty.get.category_id}&{/if}products_search_text=">
          {'Очистить форму поиска'|ftext}
        </a>
      </td>
    </tr>
    {/if}
  </table>
</form>
<br/>