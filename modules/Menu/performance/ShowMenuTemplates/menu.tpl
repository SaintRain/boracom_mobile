<table fastedit:: width=100% align="center" valign="top" border="0" cellspacing="0" cellpadding="0">
                    <tr align="center">
                      {foreach name="cat" from=$menuItems item=list}
                      <td fastedit:{$table_name}:{$list.id} width=20%><a href="{$list.name}{$list.url}" class="toplink" {if $list.selected}style="color: #bc0c08; text-decoration: underline;"{/if}>{$list.item|ftext}</a></td>         
                      {/foreach}
                </table>