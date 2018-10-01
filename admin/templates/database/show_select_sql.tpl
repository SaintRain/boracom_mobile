{if $msg} <font color="Yellow">{$msg}</font><br>
{/if}
<h5>{$MSGTEXT.database_sql_master_caption_is_ready}</h5>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><table width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#4e86b0">
        <tr bgcolor="#66a4d3">
          <td>{$res}</td>
        </tr>
        <tr bgcolor="#66a4d3">
          <td><textarea style="width:100%" rows="40">{$select_sql}</textarea></td>
        </tr>
      </table></td>
  </tr>
</table>