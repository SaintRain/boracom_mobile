<br>
<table align="center" border="0" cellpadding="1" cellspacing="0">
  <tr>
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr>
          <td> {foreach from=$pages item=item}
            &nbsp;<a href="{$item.url}&page={$item.name}">{if $item.selected==true}<b>{$item.name}</b>{else}{$item.name}{/if}</a>&nbsp;
            {/foreach}
            </td>
        </tr>
      </table>
      </td>
  </tr>
</table>