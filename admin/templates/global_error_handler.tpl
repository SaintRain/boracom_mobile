<br>
&nbsp;
<table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#dcdcdc" border="0">
  <tr>
    <td><table width="100%" cellpadding="3" cellspacing="1" border="0">
        <tr bgcolor="White">
          <td colspan="100%" align="center">
              <table align="center" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td width="20px" valign="middle"><img  src="/{$smarty.const.SETTINGS_ADMIN_PATH}/images/bug.png" border="0" hspace="10"></td>
                <td valign="middle"><b style="color:red;font-size:18px"><b>{$title_error}</b></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="White">
          <td><b style="color:#8e8e8e">{$MSGTEXT.e_handle_code}&nbsp;</b></td>
          <td><b style="color:#8e8e8e">{$MSGTEXT.e_handle_type}</b>&nbsp;</td>
          <td><b style="color:#8e8e8e">{$MSGTEXT.e_handle_description}</b></td>
        </tr>
        {foreach from=$GLOBAL_ERRORS item=error}
        <tr bgcolor="White">
          <td align="left" valign="top"><b style="color:#8e8e8e">{$error.code}</b></td>
          <td align="left" valign="top"><b style="color:black">{$error.type}</b></td>
          <td align="left" valign="top" style="color:black">{$error.description}</td>
        </tr>
        {/foreach}
      </table></td>
  </tr>
</table>
<br>
&nbsp; 