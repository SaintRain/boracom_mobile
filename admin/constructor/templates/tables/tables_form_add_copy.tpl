<form action="?act=t_c&do=insert_copy" method="POST" style="margin:0px">
  <input name="id" value="{$id}" type="hidden">
  <p style="margin-bottom:10px"><font color="Yellow">{$message}</font></p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td><table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td><p style="margin-top:10px">{$MSGTEXT.tables_copy_title_table}:<br>
                    <table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td><font color="Yellow">{$CurrentModule.name|lower}_</td>
                        <td><input type="text" name="name" style="width:300px;" value="{$name}"></td>
                      </tr>
                    </table>
                    <br>
                    {$MSGTEXT.tables_copy_description}:<br>
                    <input type="text" name="description" style="width:100%;" value="{$description}">
                    <br><br>
 					{$MSGTEXT.tables_edit_additional_buttons}<br>
                    <textarea type="text" name="additional_buttons" style="width:100%;height:30px">{$additional_buttons}</textarea>
                                                            
                    </p>
                    </td>
                </tr>
                <tr>
                  <td><table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td><input name="show_type" type="checkbox" value="1" {if $show_type==1} checked {/if}></td>
                        <td>&nbsp;{$MSGTEXT.tables_edit_show_type_table}</td>
                      </tr>
                    </table>
                    </td>
                </tr>
                
<!--
<tr><td>
{$MSGTEXT.tables_copy_content_table}:<br>
<select name="show_type" style="width:200">
<option {if $show_type==0} selected {/if} value="0">{$MSGTEXT.tables_copy_list}
<option {if $show_type==1} selected {/if} value="1">{$MSGTEXT.tables_copy_only_edit}
</select>
</td></tr>
-->
                <tr>
                  <td><input class="button" type="submit" value="{$MSGTEXT.tables_copy_create}" style="width:120px"></td>
                </tr>
              </table>
              </td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</form>