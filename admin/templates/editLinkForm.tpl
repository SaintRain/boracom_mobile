<div class="ten">
  <table style="width:450px" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr><td>
      <table style="width:100%"  bgcolor="#86bae0" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td valign="top" align="left"><b>{$MSGTEXT.edit_link_mess}</b></td>
          <td align="right"><img border=0 style="cursor:pointer" onclick="hideFormBlocks()" src="images/close.gif"></td>
        </tr>
        <tr>
        </td>        
        <td style="width:100%" colspan="2"><select name="data_id" multiple onChange="set_link_value(this)" id="data_id" style="width:100%;height:200px" size="10">              
				{if $datalist}
				{foreach from=$datalist item=links}				
              <option value="{$links.id}" {if $currentData.id==$links.id} selected {/if}>{$links.name}</option>              
				{/foreach}
				{/if}				
            </select></td>
        </tr>
        <tr>
          <td colspan="2" valign="top" align="left">{$MSGTEXT.edit_link_name}:<br>
            <input type="text" style="width:440px" name="name" id="name" value="{$currentData.name}"></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input {if !$currentData.id}disabled{/if} type="button" class="button" name="butedit" id="butedit" onclick="save_links()" value="{$MSGTEXT.edit_link_save}" style="width:130px">
            &nbsp;&nbsp;
            <input {if !$currentData.id}disabled{/if} type="button" class="button" name="butdelete" id="butdelete" onclick="delete_links()" value="{$MSGTEXT.edit_link_delete}" style="width:130px">
            &nbsp;&nbsp; </td>
        </tr>
      </table>
      </td>
    </tr>
  </table>
</div>