<form action="?act=m_c&do=insert" method="POST" style="margin:0">
  <input name="id" value="{$id}" type="hidden">
  <p style="margin-bottom:10"><font color="Yellow">{$message}</font></p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0" style="width:100%">
          <tr>
            <td>
            <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td> {$MSGTEXT.modules_form_add_name}<br>
                    <input type="text" name="name" style="width:100%;" value="{$name}"></td>
                </tr>
                <tr>
                  <td> {$MSGTEXT.modules_form_edit_version}<br>
                    <input type="text" name="version" style="width:100%;" value="{if $version}{$version}{else}1{/if}"></td>
                </tr>
                <tr>
                  <td> {$MSGTEXT.modules_form_add_des}<br>
                    <textarea name="description" style="width:100%;" rows="4">{$description}</textarea>
                <tr>
                  <td height="10px"></td>
                </tr>
                <tr>
                  <td><input class="button" type="submit" value="{$MSGTEXT.modules_form_add_create_copy}" style="width:130px"></td>
                </tr>
              </table>
              </td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</form>