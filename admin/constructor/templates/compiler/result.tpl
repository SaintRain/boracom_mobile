<p style="margin-bottom:10px"><font color="Yellow">{foreach from=$editError item=item}{$item}{/foreach}</font></p>
<table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
  <tr>
    <td>
        <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0" style="width:100%">
            <tr>
                <td>
        <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td> {$MSGTEXT.result_blocks}: <font color="Yellow">{$statistics.blocks_total}</font><br>
            {$MSGTEXT.result_tables}: <font color="Yellow">{$statistics.tables_total}</font><br>
            {$MSGTEXT.result_total_files}: <font color="Yellow">{$statistics.file_total}</font><br>
            {$MSGTEXT.result_time_compile}: <font color="Yellow">{$statistics.time} {$MSGTEXT.result_time_compile_in_sec}</font><br>
            {$MSGTEXT.result_address_mod}: <font color="Yellow"><b>{$smarty.server.DOCUMENT_ROOT}/modules/{$module_name}</b></font></td>
        </tr>
      </table>
                </td>
            </tr>
        </table>
      </td>
  </tr>
</table>