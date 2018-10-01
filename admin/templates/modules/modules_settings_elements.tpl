            
        {if $list.type==1}
        <tr bgcolor="#66a4d3">
          <td valign="middle" align="left">{$list.name}</td>
          <td>
            <i>{$list.description}</i><br>
            <input type="text" style="width:100%" name="{$list.name}" value="{$list.value}">
            </td>
        </tr>
        {/if}
        
        {if $list.type==2}
        <tr bgcolor="#66a4d3">
          <td valign="middle" align="left">{$list.name}</td>
          <td>
          	<i>{$list.description}</i><br>
            <textarea style="width:100%;height:200px" name="{$list.name}">{$list.value}</textarea>
          </td>
        </tr>
        {/if}
        
        {if $list.type==3}
        <tr bgcolor="#66a4d3">
          <td valign="middle" align="left">{$list.name}</td>
          <td>
          	<table cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td><input type="checkbox" class="checkbox" {if $list.value==1 }checked{/if} name="{$list.name}" value="1"></td>
                <td nowrap>&nbsp;<i>{$list.description}</i></td>
              </tr>
            </table>
            </td>
        </tr>
        {/if}
