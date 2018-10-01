{literal}
<script language="JavaScript">
function setcolor(obj) {
	obj.style.background='#FFF2BE';
}
function unsetcolor(obj) {
	obj.style.background='white';
}
function q(){
	return confirm("{/literal}{$MSGTEXT.fields_settings_list_allert_del}{literal}");
}
</script>
{/literal}

{if $message}
<p style="margin-bottom:10px"><font color="yellow">{$message}</font></p>
{/if}
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor="#D5D5D5">
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="top_list">
          <td width="23%"><b><a href="?act=b_fs_c&sort_by=name&sort_type={$sort_type}&b_id={$b_id}">{$MSGTEXT.fields_settings_list_title}</a> {if $sort_by=='name'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="83%"><b><a href="?act=b_fs_c&sort_by=description&sort_type={$sort_type}&b_id={$b_id}">{$MSGTEXT.fields_settings_list_description}</a> {if $sort_by=='description'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td colspan="2"><b>{$MSGTEXT.fields_settings_list_edit}</td>
        </tr>
        {foreach from=$tables item=table}
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)" >
          <td>{$table.name}</td>
          <td>{$table.description}</td>
          <td width="50px" align="right"><a href="?act=b_fs_c&do=edit&t_id={$table.table_id}&b_id={$b_id}" ><img border="0" alt="{$MSGTEXT.fields_settings_list_edit_alt}" src="images/edit.gif"></a></td>
          <td width="50px" align="center"><a href="?act=b_fs_c&do=delete&t_id={$table.table_id}&b_id={$b_id}" onclick='return q();'><img border="0" alt="{$MSGTEXT.fields_settings_list_delete}" src="images/del_b.gif"></a></td>
        </tr>
        {/foreach}
      </table>
      </td>
  </tr>
</table>