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
	return confirm("{/literal}{$MSGTEXT.blocks_templates_list_del_mess}{literal}");
}
</script>
{/literal}

<p style="margin-top:10px;margin-bottom:10px">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=b_temp_c&do=add&b_id={$b_id}">{$MSGTEXT.blocks_templates_list_create_tpl}</a></td>
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
          <td  width="23%"><b><a href="?act=b_temp_c&sort_by=name&sort_type={$sort_type}&b_id={$b_id}">{$MSGTEXT.blocks_templates_list_name}</a> {if $sort_by=='name'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="63%"><b><a href="?act=b_temp_c&sort_by=description&sort_type={$sort_type}&b_id={$b_id}">{$MSGTEXT.blocks_templates_list_desc}</a> {if $sort_by=='description'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td align="middle" width="7%" nowrap><b><a href="?act=b_temp_c&sort_by=sort_index&sort_type=low{if $pageCategoryId!=''}&pageCategoryId={$pageCategoryId}{/if}{if $page_id}&page_id={$page_id}{/if}&b_id={$b_id}">{$MSGTEXT.blocks_templates_list_order}</a> {if $sort_by=='sort_index'}<img src='images/sort_hight.gif' border='0' alt=''>{/if}</td>
          <td colspan="3"><b>{$MSGTEXT.blocks_templates_list_edit}</td>
        </tr>
        {foreach from=$templates item=template}
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)" >

          <td>
          <table  border="0" width="0" cellpadding="0" cellspacing="0">
          <tr>
          <td>
          
          {if $template.tpl_type=='xml'}<img border="0" src="images/tpls/xml.png">{/if}
          {if $template.tpl_type=='tpl'}<img border="0" src="images/tpls/tpl.png">{/if}
          {if $template.tpl_type=='xsl'}<img border="0" src="images/tpls/xsl.png">{/if}          
          </td>
          <td>&nbsp;&nbsp;{$template.name}</td>
          </tr>
          </table>
          
          </td>
          
          <td>{$template.description}</td>
          <td align="center" valign="middle"><a class="moveLink" href="?act=b_temp_c&do=move_table_item&type=up&temp_id={$template.id}&sort_by=sort_index&sort_type=low{if $selectedPage}&page={$selectedPage}{/if}&b_id={$b_id}"><img border="0" title="{$MSGTEXT.blocks_templates_list_up}" src="images/arrow_up.gif"></a>&nbsp;&nbsp;<a class="moveLink" href="?act=b_temp_c&do=move_table_item&type=down&temp_id={$template.id}&sort_by=sort_index&sort_type=low{if $selectedPage}&page={$selectedPage}{/if}&b_id={$b_id}"><img border="0" title="{$MSGTEXT.blocks_templates_list_down}" src="images/arrow_down.gif"></a></td>
          <td width="50px" align="center"><a href="?act=b_temp_c&do=insert_copy_form&id={$template.id}&b_id={$b_id}"><img border="0" title="{$MSGTEXT.blocks_templates_list_copy}" src="images/copy.png"></a></td>
          <td width="50px" align="center"><a href="?act=b_temp_c&do=edit&id={$template.id}&b_id={$b_id}" ><img border="0" title="{$MSGTEXT.blocks_templates_list_edite}" src="images/edit.gif"></a></td>
          <td width="50px" align="center"><a href="?act=b_temp_c&do=delete&id={$template.id}&b_id={$b_id}" onclick='return q();'><img border="0" title="{$MSGTEXT.blocks_templates_list_remove}" src="images/del_b.gif"></a></td>
        </tr>
        {/foreach}
      </table>
      </td>
  </tr>
</table>