<div fastedit::>
{if $cat.description}{$cat.description}{/if}
{foreach from=$categories item=item}
	{if $cat.id!=$item.id}
		<div style="margin-top:5px"><a href="internet-shop?category_id={$item.id}">{$item.caption}</a></div>
	{/if}
{/foreach}
<br/>
&nbsp;
</div>