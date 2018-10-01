<ul>
{foreach name="cat" from=$menuItems item=list}
<li  {if $list.class}class="{$list.class}"{/if}><a fastedit:{$table_name}:{$list.id} href="{$list.name}{$list.url}" >{$list.item|ftext}</a></li>
{/foreach}
</ul>