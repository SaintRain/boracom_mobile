<form action="?act=b_c&do=insert" method="POST" style="margin:0">
  <input name="id" value="{$id}" type="hidden">
  <p style="margin-bottom:10px"><font color="Yellow">{foreach from=$editError item=item}{$item}{/foreach}</font></p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td><table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td><table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td>{$MSGTEXT.blocks_form_add_name_mess}</td>
                </tr>
                <tr>
                  <td><input type="text" name="name" style="width:100%;" value="{$name}"></td>
                </tr>
                <tr>
                  <td>{$MSGTEXT.blocks_form_add_type_block}<br>
                    <table cellpadding="0" cellpadding="0" border="0">
                <tr>                
                
                  <td><input style="margin:0px" value="2" type="radio" {if $type}{if $type==2}checked{/if}{else}checked{/if} name="type"></td>
                  <td>&nbsp;{$MSGTEXT.blocks_form_add_complex}&nbsp;&nbsp;&nbsp;</td>
                  <td><input style="margin:0px" value="1" type="radio" {if $type}{if $type==1}checked{/if}{/if} name="type"></td>
                  <td>&nbsp;{$MSGTEXT.blocks_form_add_simple}&nbsp;&nbsp;&nbsp;</td>
                  <td><input style="margin:0px" value="3" type="radio" {if $type}{if $type==3}checked{/if}{/if} name="type"></td>
                  <td>&nbsp;{$MSGTEXT.blocks_form_add_plugin}</td>
                </tr>
              </table>
              </td>
          </tr>
          <tr>
            <td>{$MSGTEXT.blocks_form_add_description}</td>
          </tr>
          <tr>
            <td><input type="text" name="description" style="width:100%;" value="{$description}"></td>
          </tr>
          <tr>
            <td>{$MSGTEXT.blocks_form_general_table}</td>
          </tr>
          <tr>
            <td><select name="general_table_id" id="general_table_id" style="width:100%">
                <option value="0" style="color:gray">{$MSGTEXT.blocks_form_t_not_select}</option>                
				{foreach from=$tables item=table}
                	<option {if $table.id==$general_table_id} selected {else}{if $table.general_table_id>0} style="color:gray" {/if}{/if} value="{$table.id}">{$table.description}</option>                
				{/foreach}
              </select>
              </td>
          </tr>
          <tr>
            <td>{$MSGTEXT.blocks_form_add_name_value}</td>
          </tr>
          <tr>
            <td><input type="text" name="act_variable" style="width:100%;" value="{if $act_variable!=''}{$act_variable}{else}act{/if}"></td>
          </tr>
          <tr>
            <td>{$MSGTEXT.blocks_form_add_type_value}</td>
          </tr>
          <tr>
            <td><table cellpadding="0" cellpadding="0" border="0">
          <tr>
            <td><input style="margin:0" name="act_method" checked {if $act_method=='get'}checked{/if} value="get" type="radio"></td>
            <td>&nbsp;GET</td>
          </tr>
        </table>
        </td>
    </tr>
    <tr>
      <td><table cellpadding="0" cellpadding="0" border="0">
    <tr>
      <td><input style="margin:0" name="act_method" {if $act_method=='post'}checked{/if} value="post" type="radio"></td>
      <td>&nbsp;POST</td>
    </tr>
  </table>
  </td>
  <tr>
    <td>{$MSGTEXT.blocks_form_general_used_variables}</td>
  </tr>
  <tr>
    <td><textarea name="url_get_vars" style="width:100%;height:100px">{$url_get_vars}</textarea></td>
  </tr>
  <tr>
    <td height="10px"></td>
  </tr>
  <tr>
    <td><input class="button" type="submit" value="{$MSGTEXT.blocks_form_add_create}" style="width:130px"></td>
  </tr>
  </table>
  </td>
  </tr>
  </table>
  </td>
  </tr>
  </table>
</form>