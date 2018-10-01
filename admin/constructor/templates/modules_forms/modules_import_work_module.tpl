{if $modules}
<form action="?act=m_c&do=import_work_module_do" method="POST" style="margin:0">
  <p style="margin-bottom:10px"><font color="Yellow">{$message}</font></p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td>
            <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td><p style="margin-bottom:10px">{$MSGTEXT.modules_import_selected}</p>
                    <select name="module_id" style="width:700px">                      
					{foreach from=$modules item=module}
                      <option value="{$module.id}"> {$module.name} {if $module.description} - {$module.description}{/if}
                      {/foreach}
                    </select></td>
                </tr>
                <tr>
                  <td height="10px"></td>
                </tr>
                <tr>
                  <td><input class="button" type="submit" value="{$MSGTEXT.modules_import_loaded}" style="width:130px"></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
{else}
	{$MSGTEXT.modules_import_empty}
{/if}