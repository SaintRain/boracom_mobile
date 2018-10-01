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
	return confirm("{/literal}{$MSGTEXT.modules_list_allert_del}{literal}");
}
</script>
{/literal}

{if $message}
<p id="messagetext" style="margin-bottom:10px;color:Yellow">{$message}</p>
<br>
<script language="JavaScript">Morphing("messagetext", true)</script> 
{/if}
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor='#D5D5D5'>
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="top_list">
          <td width="20%"><b><a href="?act=m_c&sort_by=name&sort_type={$sort_type}">{$MSGTEXT.modules_list_title}</a> {if $sort_by=='name'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="10%"><b><a href="?act=m_c&sort_by=version&sort_type={$sort_type}">{$MSGTEXT.modules_list_version}</a> {if $sort_by=='version'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="35%"><b><a href="?act=m_c&sort_by=description&sort_type={$sort_type}">{$MSGTEXT.modules_list_description}</a> {if $sort_by=='description'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="10%"><b><a href="?act=m_c&sort_by=loaded&sort_type={$sort_type}">{$MSGTEXT.modules_list_status}</a> {if $sort_by=='loaded'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td align="middle" width="9%" nowrap><b><a href="?act=m_c&sort_by=sort_index&sort_type=hight{if $pageCategoryId!=''}&pageCategoryId={$pageCategoryId}{/if}{if $page_id}&page_id={$page_id}{/if}">{$MSGTEXT.modules_list_order}</a> {if $sort_by=='sort_index'}<img src='images/sort_hight.gif' border='0' alt=''>{/if}</td>
          <td colspan="4" ><b>{$MSGTEXT.modules_list_edit}</td>
        </tr>
        {foreach from=$modules item=module}
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)" >
          <td>{$module.name}</td>
          <td>v.{$module.version}</td>
          <td>{$module.description}</td>
          <td>{if $module.loaded==0}{$MSGTEXT.modules_list_create}{else}{$MSGTEXT.modules_list_load}{/if}</td>
          <td align="center" valign="middle"><a class="moveLink" href="?act=m_c&do=move_module_item&type=up&id={$module.id}&sort_by=sort_index&sort_type=hight{if $selectedPage}&page={$selectedPage}{/if}"><img border="0" title="{$MSGTEXT.modules_list_up}" src="images/arrow_up.gif"></a>&nbsp;&nbsp;<a class="moveLink" href="?act=m_c&do=move_module_item&type=down&id={$module.id}&sort_by=sort_index&sort_type=hight{if $selectedPage}&page={$selectedPage}{/if}"><img border="0" title="{$MSGTEXT.modules_list_down}" src="images/arrow_down.gif"></a></td>
          <td width="50px" align="center"><a href="?act=compiler&m_id={$module.id}" ><img border="0" title="{$MSGTEXT.modules_list_compile}" src="images/compile.png"></a></td>
          <td width="50px" align="center"><a href="?act=m_c&do=insert_copy_form&id={$module.id}" ><img border="0" title="{$MSGTEXT.modules_list_create_copy}" src="images/copy.png"></a></td>
          <td width="50px" align="center"><a href="?act=m_c&do=edit&id={$module.id}" ><img border="0" title="{$MSGTEXT.modules_list_ed}" src="images/edit.gif"></a></td>
          <td width="50px" align="center"><a href="?act=m_c&do=delete&id={$module.id}" onclick='return q();'><img border="0" title="{$MSGTEXT.modules_list_delete}" src="images/del_b.gif"></a></td>
        </tr>
        {/foreach}
      </table>
      </td>
  </tr>
</table>