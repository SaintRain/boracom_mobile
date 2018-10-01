{literal} 
<script language="JavaScript">
function setcolor(obj) {
	obj.style.background='#7dc7ff';
}
function unsetcolor(obj) {
	obj.style.background='#66a4d3';
}
function q(){
	return confirm('{/literal}{$MSGTEXT.database_slow_sql_del}{literal}');
}
</script>
{/literal}
{if $msg} <font color="Yellow">{$msg}</font><br>
{else}
<h5>{$MSGTEXT.database_slow_sql_statistic}</h5>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><table width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#4e86b0">
        <tr>
          <td bgcolor="#66a4d3" nowrap><b>{$MSGTEXT.database_slow_sql_num}</td>
          <td bgcolor="#66a4d3" nowrap><b>{$MSGTEXT.database_slow_sql_average_time}</td>
          <td bgcolor="#66a4d3" nowrap><b>{$MSGTEXT.database_slow_sql_call}</td>
          <td width="100%" bgcolor="#66a4d3"><b>{$MSGTEXT.database_slow_sql_request}</td>
        </tr>
        {foreach name='sqls' key=sql_query from=$sqls item=sql}
        <tr bgcolor="#66a4d3" onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)">
          <td valign="top" style="color:#48799f">{$smarty.foreach.sqls.iteration}</td>
          <td valign="top">{$sql.time} {$MSGTEXT.database_slow_sql_ms}</td>
          <td valign="top">{$sql.count}</td>
          <td ><textarea class="sqlTXT">{$sql_query}</textarea></td>
        </tr>
        {/foreach}
      </table>
      </td>
  </tr>
</table>
{/if}