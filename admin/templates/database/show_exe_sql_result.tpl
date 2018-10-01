<h5>{$MSGTEXT.database_show_exe_sql_result}</h5>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><table width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#4e86b0">
        {if $sql}
        <tr>
          <td bgcolor="#66a4d3" nowrap align="left"><b>{$MSGTEXT.database_was_exe_query}</b></td>
        </tr>
        <tr>
          <td bgcolor="#66a4d3"><p>{$sql}</p></td>
        </tr>
        {/if}
        
        {if $sql}
        <tr>
          <td bgcolor="#66a4d3" nowrap align="left"><b>{$MSGTEXT.database_was_exe_query_time} {$time}</b></td>
        </tr>

        {/if}
        
        {if $msg!='0: ' && $msg!=': '}
        <tr>
          <td bgcolor="#66a4d3" nowrap align="left"><b>{$MSGTEXT.database_exe_query_error}</b></td>
        </tr>
        <tr>
          <td bgcolor="#66a4d3"><font color="Yellow">{$msg}</font><br></td>
        </tr>
        {/if}
        
        {if $result_affected}
        <tr>
          <td bgcolor="#66a4d3" nowrap align="left"><b>{$MSGTEXT.database_exe_query_info}</b></td>
        </tr>
        <tr>
          <td bgcolor="#66a4d3">{$result_affected}</td>
        </tr>
        {/if}        
        
        {if $total_records_text}
        <tr>
          <td bgcolor="#66a4d3" nowrap align="left"><b>{$MSGTEXT.database_selected_records} {$total_records_count}</b></td>
        </tr>
        <tr>
          <td bgcolor="#66a4d3" nowrap><textarea style="width:100%" rows="40">{$total_records_text}</textarea></td>
        </tr>
        {/if}
      </table>
      </td>
  </tr>
</table>