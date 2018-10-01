{literal}
<script language="JavaScript">
{/literal}{if $refreshFrame || $smarty.get.refreshFrame} reloadLeftFrame(); {/if}{literal}

function setcolor(obj) {
	obj.style.background='#FFF2BE';
}


function unsetcolor(obj) {
	obj.style.background='white';
}


function q(){
	return confirm("{/literal}{$MSGTEXT.tables_list_alert_del}{literal}");
}
</script>
{/literal}


<p style="margin-top:10px;margin-bottom:10px">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=t_c&do=add">{$MSGTEXT.tables_list_create_table}</a></td>
</tr>
</table>
</p>
{if $message}
<p id="messagetext" style="margin-bottom:10px;color:Yellow">{$message}</p>
<br>
<script language="JavaScript">Morphing("messagetext", true)</script> 
{/if}
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor='#D5D5D5'>
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="top_list" >
          <td width="33%" nowrap><b><a href="?act=t_c&sort_by=name&sort_type={$sort_type}">{$MSGTEXT.tables_list_name}</a> {if $sort_by=='name'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="53%" nowrap><b><a href="?act=t_c&sort_by=description&sort_type={$sort_type}">{$MSGTEXT.tables_list_description}</a> {if $sort_by=='description'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="10%" align="center" nowrap><b><a href="?act=t_c&sort_by=show_type&sort_type={$sort_type}">{$MSGTEXT.tables_list_editable}</a> {if $sort_by=='show_type'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          
          <!--
          <td width="23%"><b><a href="?act=t_c&sort_by=show_type&sort_type={$sort_type}">{$MSGTEXT.tables_list_print_data}</a> {if $sort_by=='show_type'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          -->
          <td align="center" width="7%" nowrap><b><a href="?act=t_c&sort_by=sort_index&sort_type=low{if $pageCategoryId!=''}&pageCategoryId={$pageCategoryId}{/if}{if $page_id}&page_id={$page_id}{/if}">{$MSGTEXT.tables_list_order}</a> {if $sort_by=='sort_index'}<img src='images/sort_hight.gif' border='0' alt=''>{/if}</td>
          <td colspan="3" nowrap><b>{$MSGTEXT.tables_list_edit}</td>
        </tr>
        {foreach from=$tables item=table}
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)">
          <td>{$table.name}</td>
          <td>{$table.description}</td>
          <td align="center">
          {if $table.show_type==1}          
          <a href="?act=t_c&do=setStatus&show_type=0&table_id={$table.id}"><img src="images/check.gif" border="0" title="{$MSGTEXT.tables_list_show_off}"></a>
          {else}
          <a href="?act=t_c&do=setStatus&show_type=1&table_id={$table.id}"><img src="images/not_check.gif" border="0" title="{$MSGTEXT.tables_list_show_on}"></a>
          {/if}
          
          </td>
          <!--
          <td>{if $table.show_type==0}{$MSGTEXT.tables_list_list}{else}{$MSGTEXT.tables_list_only_edit}{/if}</td>
          -->
          
          <td align="center" valign="middle"><a class="moveLink" href="?act=t_c&do=move_table_item&type=up&id={$table.id}&sort_by=sort_index&sort_type=low{if $selectedPage}&page={$selectedPage}{/if}"><img border="0" title="{$MSGTEXT.tables_list_up}" src="images/arrow_up.gif"></a>&nbsp;&nbsp;<a class="moveLink" href="?act=t_c&do=move_table_item&type=down&id={$table.id}&sort_by=sort_index&sort_type=low{if $selectedPage}&page={$selectedPage}{/if}"><img border="0" title="{$MSGTEXT.tables_list_down}" src="images/arrow_down.gif"></a></td>
          <td width="50px" align="center"><a href="?act=t_c&do=insert_copy_form&t_id={$table.id}" ><img border="0" alt="{$MSGTEXT.tables_list_create_copy}" src="images/copy.png"></a></td>
          <td width="50px" align="center"><a href="?act=t_c&do=edit&t_id={$table.id}" ><img border="0" alt="{$MSGTEXT.tables_list_edit}" src="images/edit.gif"></a></td>
          <td width="50px" align="center"><a href="?act=t_c&do=delete&t_id={$table.id}" onclick='return q();'><img border="0" alt="{$MSGTEXT.tables_list_delete}" src="images/del_b.gif"></a></td>
        </tr>
        {/foreach}
      </table>
      </td>
  </tr>
</table>