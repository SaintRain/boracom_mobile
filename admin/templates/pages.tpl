{if $pages} <br>
<table align="center" border="0" cellpadding="1" cellspacing="0">
  <tr>
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr>
          <td>{$MSGTEXT.pages_page}:&nbsp;
            {foreach from=$pages item=item}
            &nbsp;<a href="{$item.url}&page={$item.name}" {if $item.selected==true} class="sel_page_navigate" {/if}>{$item.name}</a>&nbsp;
            {/foreach} </td>
        </tr>
      </table></td>
  </tr>
</table>
{/if}