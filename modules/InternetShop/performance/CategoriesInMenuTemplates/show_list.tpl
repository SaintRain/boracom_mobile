{literal} 
<script type="text/javascript">
function openSubCategories(obj_id) {
	var obj=document.getElementById(obj_id);
	
	if (obj.style.display=='none') {
		obj.style.display='block';
		}
	else {
		obj.style.display='none';
	}
}
</script> 
{/literal}

<div fastedit::>
<h2 style="margin-top:15px">{'Каталог товаров'|ftext}</h2>

{foreach name="categories" from=$categories item=category}
	{if $category.deep==0}
		{if $subItems}
			</div>
		{/if}
		{assign var='subItemsCheck' value=true}
		{assign var='subItems' 		value=false}
		{assign var='pred_id' 		value=$category.id}
		{else}
		{if $subItemsCheck}
			{assign var='subItemsCheck' value=false}
			{assign var='subItems' value=true}
<div id="menuCategories_{$pred_id}" {if $pred_id!=$selected_category_id} {else}style="display:block"{/if}>
		{/if}
	{/if}
  	<div style="margin-left:{$category.deep*15}px">
    <a fastedit:{$categories_table_name}:{$category.id} 
	{if $category.deep==0} 
    	{if $smarty.get.category_id==$category.id} class="shopCategoriesMainSelected" {else} class="shopCategoriesMain" {/if}  
	    onclick="openSubCategories('menuCategories_{$category.id}')"     	
    {else}	
    {if $smarty.get.category_id==$category.id} class="shopCategoriesSupSelected" {else} class="shopCategoriesSup"  {/if}
    {/if} 
    href="{if $category.products_in_category>0}internet-shop?category_id={$category.id}{else}#{/if}">{$category.caption|ftext}{if $category.products_in_category>0} ({$category.products_in_category}){/if}</a>
  </div>  
{/foreach}
</div> 