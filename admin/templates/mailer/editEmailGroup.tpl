<div class="ten">
  <table style="width:450px" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr><td>
      <table style="width:100%;" bgcolor="#86bae0" border="0" cellpadding="4" cellspacing="">
        <tr>
          <td align="left" valign="top"><b>{$MSGTEXT.classesmailer_edit_group_list}</b></td>
          <td align="right"><img border="0" style="cursor:pointer" onclick="hideFormBlocks()" src="images/close.gif"></td>
        </tr>
        <tr>
        </td>        
        <td style="width:100%" colspan="2"><select name="data_id" multiple onChange="set_link_value(this)" id="data_id" style="width:100%;height:150px" size="10">              
				{if $groups}
				{foreach from=$groups item=group}				
              <option value="{$group.id}" {if $currentData.id==$group.id} selected {/if}>{$group.email_group_name}</option>              
				{/foreach}
				{/if}				
            </select></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top">{$MSGTEXT.classesmailer_edit_group_caption}<br>
            <input type="text" style="width:100%" name="name" id="name" value="{$currentData.name}"></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input {if !$currentData.id}disabled{/if} type="button" class="button" name="butedit" id="butedit" onclick="save_GroupEmail()" value="{$MSGTEXT.classesmailer_type_group_save}" style="width:130px">
            &nbsp;&nbsp;
            <input {if !$currentData.id}disabled{/if} type="button" class="button" name="butdelete" id="butdelete" onclick="delete_GroupEmail()" value="{$MSGTEXT.classesmailer_type_group_delete}" style="width:130px">
            &nbsp;&nbsp; </td>
        </tr>
      </table>
      </td>
    </tr>
  </table>
</div>