{literal}
<script language="JavaScript">
function checkBut(obj) {
	obj2=GetElementById('submit_button');
	if (obj.checked) obj2.disabled=false;
	else obj2.disabled=true;
}
</script>
{/literal}

<form action="?act=compiler&do=compile&m_id={$m_id}" method="POST" style="margin:0px" >
  <input name="id" value="{$id}" type="hidden">
  <input name="general" id="general" type="hidden" value="{$general}">
  <p style="margin-bottom:10px"><font color="Yellow">{foreach from=$editError item=item}{$item}<br>
    <br>
    {/foreach}</font></p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0" style="width:100%">
          <tr>
            <td>
            <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td><b>{$MSGTEXT.compiler_form_settings}</b><br>
              <br>
              <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td><input type="checkbox" value="1" name="drop_tables"></td>
                  <td>&nbsp; {$MSGTEXT.compiler_form_include}</td>
                </tr>
              </table>
              </td>
          </tr>
          {if $perezapisat==1}
          <tr>
            <td><table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td><input type="checkbox" value="1" onclick="checkBut(this)" name="perezapisat"></td>
                  <td>&nbsp; {$MSGTEXT.compiler_perezapisat}</td>
                </tr>
              </table>
              </td>
          </tr>
          {/if}
          <tr>
            <td height="10px"></td>
          </tr>
          <tr>
            <td colspan="100%"><input {if $editError}disabled{/if} class="button" id="submit_button" type="submit" value="{$MSGTEXT.compiler_form_compile}" style="width:120px"></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
          </td>
    </tr>
  </table>
</form>