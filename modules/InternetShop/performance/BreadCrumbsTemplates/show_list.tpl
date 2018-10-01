{if $categories}
<table fastedit:: style="width:100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>
      {foreach name="categories" from=$categories item=category}
      {if !$smarty.foreach.categories.last}
      <a fastedit:{$categories_table_name}:{$category.id} href="internet-shop?category_id={$category.id}">
        {$category.caption|ftext}
      </a>
      - {else}
      <span fastedit:{$categories_table_name}:{$category.id}>
        {$category.caption|ftext}
      </span>
      {/if}
      {/foreach}
    </td>
  </tr>
</table>
<br/>
{/if}