{literal}
<script language="JavaScript">
{/literal}{if $refreshFrame || $smarty.get.refreshFrame} reloadLeftFrame(); {/if}{literal}
</script>
{/literal}

<table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
  <tr>
    <td><table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
        <tr>
          <td><table height="100" width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
              <tr>
                <td align="center" valign="middle"><font color="Yellow">{$MSGTEXT.modules_import_res_mod} <b>{$m.name}</b> {$MSGTEXT.modules_import_res_successfully_load}</font></td>
              </tr>
              <tr>
                <td height="10px"></td>
              </tr>
            </table>
            </td>
        </tr>
      </table>
      </td>
  </tr>
</table>