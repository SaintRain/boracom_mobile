{if $msg} <font color="Yellow">{$msg}</font><br>
{/if}
<h5>{$MSGTEXT.tablesconstructor_sqlmaster_caption}</h5>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><table width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#4e86b0">
        <form action="?act=dumper&page&id={$smarty.get.id}&func=do" method="POST" style="margin:0px">
          <tr bgcolor="#66a4d3">
            <td align="left"  colspan="2" bgcolor="#66a4d3" height="10px"><b>{$MSGTEXT.database_sql_master_caption}</b></td>
          </tr>
          <tr bgcolor="#66a4d3">
            <td width="180px" nowrap valign="top" align="left">{$MSGTEXT.database_full_table_name}&nbsp;</td>
            <td><table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td><select style="width:380px" name="table_id">                      
					{foreach from=$all_tables item=t}
                      <option {if $smarty.post.table_id==$t.id} selected {/if} value="{$t.id}">{$t.table_name}</option>                      
					{/foreach}
                    </select>
                    </td>
                  <td width="10px">&nbsp;</td>
                  <td><table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td><input name="split" {if $smarty.post.split} {if $smarty.post.split==1} checked {/if}{else} checked {/if} type="checkbox" value="1"></td>
                        <td>&nbsp;{$MSGTEXT.database_split_sql}</td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <input style="width:200px;margin-top:5px" class="button" type="submit" value="{$MSGTEXT.database_create_select_sql}"></td>
          </tr>
        </form>        
        </table>
	</td>
	</tr>
</table>

<br><br>  
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>
    <table width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#4e86b0">        
        <form action="?act=dumper&page&id={$smarty.get.id}&func=gen_form_fields" method="POST" style="margin:0">
          <tr bgcolor="#66a4d3">
            <td align="left"  colspan="2" bgcolor="#66a4d3" height="10px"><b>{$MSGTEXT.database_create_form_fields_caption}</b></td>
          </tr>
          <tr bgcolor="#66a4d3">
            <td width="180px" nowrap valign="top" align="left">{$MSGTEXT.database_full_table_name}&nbsp;</td>
            <td><table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td><select style="width:380px" name="table_id">                      
					{foreach from=$all_tables item=t}
                      <option {if $smarty.post.table_id==$t.id} selected {/if} value="{$t.id}">{$t.table_name}</option>                      
					{/foreach}
                    </select>
                    </td>
                </tr>
              </table>
              <input style="width:200px;margin-top:5px" class="button" type="submit" value="{$MSGTEXT.database_create_form_fields}"></td>
          </tr>
        </form>
        </table>
	</td>
	</tr>
</table>
        
<br><br>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>
    <table width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#4e86b0">                    
        <tr bgcolor="#66a4d3">
         <td align="left" colspan="2" bgcolor="#66a4d3" height="10px"><b>{$MSGTEXT.database_execute_sql}</b></td>
        </tr>
        <tr bgcolor="#66a4d3">
          <td width="180px" nowrap  valign="top" align="left">{$MSGTEXT.database_execute_your_sql}&nbsp;</td>
          <td><form action="?act=dumper&page&id={$smarty.get.id}&func=ex_sql" method="POST" style="margin:0px">
              <textarea name="sql" rows="15" style="width:100%"></textarea>
              <br>
              <input class="button" type="submit" value="{$MSGTEXT.database_execute_sql_button}" style="width:200px;margin-top:5px">
            </form>
            </td>
        </tr>
      </table>
      </td>
  </tr>
</table>