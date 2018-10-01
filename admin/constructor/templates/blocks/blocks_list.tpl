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
	return confirm("{/literal}{$MSGTEXT.blocks_list_del_mess}{literal}");
}
</script>
{/literal}

<p style="margin-top:10px;margin-bottom:10px">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=b_c&do=add">{$MSGTEXT.blocks_list_create_block}</a></td>
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
          <td width="23%"><b><a href="?act=b_c&sort_by=name&sort_type={$sort_type}">{$MSGTEXT.blocks_list_name}</a> {if $sort_by=='name'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="30%"><b><a href="?act=b_c&sort_by=description&sort_type={$sort_type}">{$MSGTEXT.blocks_list_description}</a> {if $sort_by=='description'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="13%"><b><a href="?act=b_c&sort_by=type&sort_type={$sort_type}">{$MSGTEXT.blocks_list_type}</a> {if $sort_by=='type'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="20%"><b><a href="?act=b_c&sort_by=general_table_id&sort_type={$sort_type}">{$MSGTEXT.blocks_form_general_table}</a> {if $sort_by=='general_table_id'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td align="middle" width="7%" nowrap><b><a href="?act=b_c&sort_by=sort_index&sort_type=low{if $pageCategoryId!=''}&pageCategoryId={$pageCategoryId}{/if}{if $page_id}&page_id={$page_id}{/if}">{$MSGTEXT.blocks_list_order}</a> {if $sort_by=='sort_index'}<img src='images/sort_hight.gif' border='0' alt=''>{/if}</td>
          <td colspan="2" ><b>{$MSGTEXT.blocks_list_edit}</td>
        </tr>
        {foreach from=$blocks item=block}
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)">
          <td>{$block.name}</td>
          <td>{$block.description}</td>
          <td>          
          
          {if $block.type==2}{$MSGTEXT.blocks_list_multiple}{else}{if $block.type==1}{$MSGTEXT.blocks_list_single}{else}{$MSGTEXT.blocks_form_add_plugin}{/if}{/if}</td>
          <td>{$block.general_table_id_caption}</td>
          <td align="center" valign="middle"><a class="moveLink" href="?act=b_c&do=move_block_item&type=up&id={$block.id}&sort_by=sort_index&sort_type=low{if $selectedPage}&page={$selectedPage}{/if}"><img border="0" title="{$MSGTEXT.blocks_list_up}" src="images/arrow_up.gif"></a>&nbsp;&nbsp;<a class="moveLink" href="?act=b_c&do=move_block_item&type=down&id={$block.id}&sort_by=sort_index&sort_type=low{if $selectedPage}&page={$selectedPage}{/if}"><img border="0" title="{$MSGTEXT.blocks_list_down}" src="images/arrow_down.gif"></a></td>
          <td width="50px" align="right"><a href="?act=b_c&do=edit&b_id={$block.id}"><img border="0" alt="{$MSGTEXT.blocks_list_edite}" src="images/edit.gif"></a></td>
          <td width="50px" align="center"><a href="?act=b_c&do=delete&b_id={$block.id}" onclick='return q();'><img border="0" alt="{$MSGTEXT.blocks_list_remove}" src="images/del_b.gif"></a></td>
        </tr>
        {/foreach}
      </table>
      </td>
  </tr>
</table>
