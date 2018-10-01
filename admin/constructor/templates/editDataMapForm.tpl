<div class="ten">
  <table class="formborder" style="width:520px;"  border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table style="width:100%;" bgcolor="#86bae0" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td  valign="top" align="left"><b>{if $friendlyURL}{$MSGTEXT.editData_friendly_url}{else}{if $CopyNewContent}{$MSGTEXT.editData_CopyNewContent}{else}{$MSGTEXT.editData_connect}{/if}{/if}</b></td>
            <td  align="right"><img border="0" style="cursor:pointer" onclick="hideFormBlocks()" src="images/close.gif"></td>
          </tr>
          <tr>
            <td colspan="2">
            <table width="100%" cellpadding="2" cellspacing="2" border="0">                                             
            </tr>
                   
 			<td>
				{$MSGTEXT.editData_from_module}<br>
                    <select name="module_id" id="module_id" onChange="getTables()"  style="width:160px">                      
				{if $modules}
                      <option value="0" style="color:gray">{$MSGTEXT.editData_no_module}</option>                      
						{foreach from=$modules item=module}
                      <option  value="{$module.id}" {if $module.id==$current_module.id}selected{/if}>{$module.name}</option>                      
					{/foreach}
				{/if}
                    </select>            
            </td>
            <td><br><img src="images/next.png"></td>
                <td align="left">{$MSGTEXT.editData_table}<br>
                    <select name="table_id" onChange="getFields({if $friendlyURL}'friendlyFilter'{else}{if $CopyNewContent}'CopyNewContent'{else}false{/if}{/if})" id="table_id" style="width:160px">                      
				{if $tables}
                      <option value="0" style="color:gray">{$MSGTEXT.editData_no_table}</option>                      
						{foreach from=$tables item=table}
                      <option  value="{$table.id}" {if $table.id==$saved_field.table_id}selected{/if}>{$table.name}</option>                      
					{/foreach}
				{/if}
                    </select>
                    </td>
                    
                  <td><br><img src="images/next.png"></td>
                  
                  <td align="left">
                  {$MSGTEXT.editData_field}<br>
                    <select name="field_id" id="field_id" style="width:160px">
                      <option value="0" style="color:gray">{$MSGTEXT.editData_no_esteblishid}</option>                      
				{if $saved_field}
					{if $fields}
						{foreach from=$fields item=field}								
                      	<option value="{$field.id}" {if $field.id==$saved_field.id}selected{/if}>{$field.fieldname}</option>                      
						{/foreach}
					{/if}
				{/if}
                    </select>
                    </td>
                </tr>
                {if !$friendlyURL && !$CopyNewContent}
                <tr>
                  <td colspan="100%" align="left" nowrap>
                  <table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td><input name="delete" id="delete" {if $delete==1} checked {/if} type="checkbox" class="checkbox" value="1"></td>
                        <td>&nbsp;
                        {$current_table_description}
                          </td>
                      </tr>
                      {if $smarty.get.selected_edit_type==3 || $smarty.get.selected_edit_type==4}
					  <tr>
                        <td><input name="own_filter" id="own_filter" {if $own_filter==1} checked {/if} type="checkbox" class="checkbox" value="1"></td>
                        <td>&nbsp;
                        {$MSGTEXT.editData_own_filter}
                        </td>
                      {/if}
                      </tr>                      
                    </table>
                    </td>
                </tr>
                {/if}
              </table>
              </td>
          </tr>
          <tr>
            <td colspan="100%" height="10px"></td>
          </tr>
          <tr>
            <td colspan="100%"><input {if !$fields}disabled{/if} type="button" class="button"  onclick="saveSourseFieldId({$c_number})" value="{$MSGTEXT.editData_ok}" style="width:100px">
              &nbsp;&nbsp;
              <input type="button" class="button" onclick="hideFormBlocks()" value="{$MSGTEXT.editData_chancel}" style="width:100px">
              &nbsp;&nbsp; </td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</div>