{literal}
<script language="JavaScript">
var scolor=true;
var g_obg;


function setcolor(obj) {
	setUnsetColor();
	g_obg=obj;
	scolor=true;
	g_obg.style.background='#FFF2BE';
}


function unsetcolor(obj) {
	g_obg=obj;
	scolor=false;
	setTimeout('setUnsetColor()', 1);
}


function setUnsetColor() {
	if (!scolor) {
		if (g_obg.className=='page_selected') g_obg.style.background='#dce7fa';
		else g_obg.style.background='white';
	}
}


function q(){
	return confirm("{/literal}{$MSGTEXT.pages_list_del_mess}{literal}");
}


function show_hide_blocks(section) {
	element=GetElementById(section);
	uzel=GetElementById(section+'_uzel');
	line=GetElementById('td'+section);
	if (element.style.display=="none") {
		element.style.display="";
		uzel.src='images/minus.gif';
		line.className='vertical_line_left';

	}
	else {
		element.style.display="none";
		uzel.src='images/plus.gif';
		line.className='';
	}
}
{/literal}{if $refreshFrame || $smarty.get.refreshFrame}
reloadLeftFrame();
{/if}
</script>

{if $message}
<p style="margin-bottom:10px"><font color="yellow">{$message}</font></p>
{/if}
<p style="margin-top:10px;margin-bottom:10px">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img onclick="javascript:location.href='?act=pages&do=form_add{if $pageCategoryId!=''}&pageCategoryId={$pageCategoryId}{/if}'" style="cursor:pointer" src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=pages&do=form_add{if $pageCategoryId!=''}&pageCategoryId={$pageCategoryId}{/if}">{$MSGTEXT.pages_list_new_page}</a></td>
</tr>
</table>
</p>
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor='#ccdbe6'>
    <td><table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr class="top_list">
          <td width="38%" nowrap><div style="margin:2px"><b><a href="?act=pages&sort_by=description&sort_type={$sort_type}{if $page_id}&page_id={$page_id}{/if}{if $pageCategoryId!=''}&pageCategoryId={$pageCategoryId}{/if}">{$MSGTEXT.pages_list_description}</a> {if $sort_by=='description'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</div></td>
          <td width="15%" nowrap><div style="margin:2px"><b><a href="?act=pages&sort_by=name&sort_type={$sort_type}{if $pageCategoryId!=''}&pageCategoryId={$pageCategoryId}{/if}{if $page_id}&page_id={$page_id}{/if}">{$MSGTEXT.pages_list_name_page}</a> {if $sort_by=='name'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</div></td>
          <td width="20%"><div style="margin:2px"><b><a href="?act=pages&sort_by=tpl_name&sort_type={$sort_type}{if $pageCategoryId!=''}&pageCategoryId={$pageCategoryId}{/if}{if $page_id}&page_id={$page_id}{/if}">{$MSGTEXT.pages_list_template}</a> {if $sort_by=='tpl_name'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</div></td>
          <td align="middle" width="4%" nowrap><div style="margin:2px"><b><a href="?act=pages&sort_by=enable&sort_type={$sort_type}{if $pageCategoryId!=''}&pageCategoryId={$pageCategoryId}{/if}{if $page_id}&page_id={$page_id}{/if}">{$MSGTEXT.pages_list_status}</a> {if $sort_by=='enable'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</div></td>
          <td align="middle" width="4%" nowrap><div style="margin:2px"><b><a href="?act=pages&sort_by=cache&sort_type={$sort_type}{if $pageCategoryId!=''}&pageCategoryId={$pageCategoryId}{/if}{if $page_id}&page_id={$page_id}{/if}">{$MSGTEXT.pages_list_cache}</a> {if $sort_by=='cache'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</div></td>
          <td align="middle" width="4%" nowrap><div style="margin:2px"><b><a href="?act=pages&sort_by=selected&sort_type={$sort_type}{if $pageCategoryId!=''}&pageCategoryId={$pageCategoryId}{/if}{if $page_id}&page_id={$page_id}{/if}">{$MSGTEXT.pages_list_otm}</a> {if $sort_by=='selected'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</div></td>
          <td align="middle" width="7%" nowrap><div style="margin:2px"><b><a href="?act=pages&sort_by=sort_index&sort_type=hight{if $pageCategoryId!=''}&pageCategoryId={$pageCategoryId}{/if}{if $page_id}&page_id={$page_id}{/if}">{$MSGTEXT.pages_list_order}</a> {if $sort_by=='sort_index'}<img src='images/sort_hight.gif' border='0' alt=''>{/if}</div></td>
          <td colspan="3"><div style="margin:2px"><b>{$MSGTEXT.pages_list_edit}</div></td>
        </tr>
        {foreach name="pages" from=$allpages item=page}
        <tr style="height:1px" ></tr>
        <tr {if $page.selected} class="page_selected" {else}class="page_not_selected"{/if} onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this, {$page.selected})" >
          <td id="td{$page.name}" {if $smarty.foreach.pages.total==1 && $page.templates_id && $page.blocks|@count>0}class="vertical_line_left"{/if} valign="top" {if $smarty.foreach.pages.total==1 && $page.blocks}{/if} ><div style="margin-top:5px"> {if $page.blocks}
              <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td  width="23px"  valign="top" align="center"><a style="text-decoration:none;" href="javascript: show_hide_blocks('{$page.name}')"><img border="0" id="{$page.name}_uzel" src="{if $smarty.foreach.pages.total==1}images/minus.gif{else}images/plus.gif{/if}"></a><br><img width="23px" height="1px" src="images/zero.gif"></td>
                  <td valign="top" width="100%" style="height:24px"><div style="margin-top:-3px;height:100%">
                    {if $page.description}{$page.description}{else}{$page.name}{/if}</td>
                </tr>
              </table>
              {else}
              <div style="margin-left:17px"><font color="gray">{$page.description}</font></div>
              {/if}</div></td>
          <td valign="top"><div style="margin-top:5px;margin-left:2px">{$page.name}</div></td>
          <td valign="top"><div style="margin-top:5px;margin-left:2px"> {if $page.templates_id}
              <table cellpadding="0" width="100%" cellspacing="0" border="0">                
                  <td style="width:16px" align="left" valign="top"><a title="{$MSGTEXT.pages_list_edit_tpl} «{$page.tpl_name}»" href="?act=templates&page&template_id={$page.tpl_id}"><img align="left"  border="0" src="images/t_settings.png"><a/></td>
                  <td style="width:16px" align="left" valign="top"><a title="{$MSGTEXT.templates_list_settings}" href="javascript:openBlockSettingsWindow('?act=templates&do=edit_virtual&id={$page.virtual_tpl_id}{if $page_id}&page_id={$page_id}{/if}&hide_menu=true')"><img align="left" hspace="5" border="0" src="images/system.gif"><a/></td>
                  <td align="left" valign="middle" nowrap><a class="list" href="javascript:openBlockSettingsWindow('?act=templates&do=settings_edit&id={$page.virtual_tpl_id}&hide_menu=true')">{$page.tpl_name}</a></td>
              </table>
              {else} <font color="red">{$MSGTEXT.pages_list_no_template_mess}</font> {/if} </div></td>
          <td align="middle" valign="top"><div style="margin-top:5px">{if $page.enable==true}<a href="?act=pages&sort_by={$sort_by}&sort_type={$sort_type}{if $selectedPage}&page={$selectedPage}{else}&page=1{/if}{if $page_id}&page_id={$page.id}{/if}&do=set_page_status&id={$page.id}&enable=0{if $page_category}&pageCategoryId={$page_category}{/if}"><img title="{$MSGTEXT.pages_list_public}" src="images/icons/check.gif" border="0"></a>{else}<a href="?act=pages&sort_by={$sort_by}&sort_type={$sort_type}{if $selectedPage}&page={$selectedPage}{else}&page=1{/if}{if $page_id}&page_id={$page.id}{/if}&do=set_page_status&id={$page.id}&enable=1{if $page_category}&pageCategoryId={$page_category}{/if}"><img border="0" title="{$MSGTEXT.pages_list_public_page}" src="images/icons/not_check.gif"></a>{/if}</div></td>
          <td align="middle" valign="top"><div style="margin-top:5px">{if $page.cache==true}<a href="?act=pages&sort_by={$sort_by}&sort_type={$sort_type}{if $selectedPage}&page={$selectedPage}{else}&page=1{/if}{if $page_id}&page_id={$page.id}{/if}&do=set_cache_status&id={$page.id}&enable=0{if $page_category}&pageCategoryId={$page_category}{/if}&pname={$page.name}"><img title="{$MSGTEXT.pages_list_cancel}" src="images/icons/check.gif" border="0"></a>{else}<a href="?act=pages&sort_by={$sort_by}&sort_type={$sort_type}{if $selectedPage}&page={$selectedPage}{else}&page=1{/if}{if $page_id}&page_id={$page.id}{/if}&do=set_cache_status&id={$page.id}&enable=1{if $page_category}&pageCategoryId={$page_category}{/if}&pname={$page.name}"><img border="0" title="{$MSGTEXT.pages_list_on_cache}" src="images/icons/not_check.gif"></a>{/if}</div></td>
          <td align="middle" valign="top"><div style="margin-top:5px">{if $page.selected==true}<a href="?act=pages&sort_by={$sort_by}&sort_type={$sort_type}{if $selectedPage}&page={$selectedPage}{else}&page=1{/if}{if $page_id}&page_id={$page.id}{/if}&do=set_selected_status&id={$page.id}&enable=0{if $page_category}&pageCategoryId={$page_category}{/if}"><img title="{$MSGTEXT.pages_list_unselect}" src="images/icons/check.gif" border="0"></a>{else}<a href="?act=pages&sort_by={$sort_by}&sort_type={$sort_type}{if $selectedPage}&page={$selectedPage}{else}&page=1{/if}{if $page_id}&page_id={$page.id}{/if}&do=set_selected_status&id={$page.id}&enable=1{if $page_category}&pageCategoryId={$page_category}{/if}"><img border="0" title="{$MSGTEXT.pages_list_select_page}" src="images/icons/not_check.gif"></a>{/if}</div></td>
          <td align="center" valign="top"><div style="margin-top:5px"><a class="moveLink" href="?act=pages{if $page_id}&page_id={$page_id}{/if}{if $pageCategoryId}&pageCategoryId={$pageCategoryId}{/if}&do=movePage&type=up&id={$page.id}&sort_by=sort_index&sort_type=hight{if $selectedPage}&page={$selectedPage}{/if}"><img border="0" title="{$MSGTEXT.pages_list_up}" src="images/icons/arrow_up.gif"></a>&nbsp;&nbsp;<a class="moveLink" href="?act=pages{if $page_id}&page_id={$page_id}{/if}{if $pageCategoryId}&pageCategoryId={$pageCategoryId}{/if}&do=movePage&type=down&id={$page.id}&sort_by=sort_index&sort_type=hight{if $selectedPage}&page={$selectedPage}{/if}"><img border="0" title="{$MSGTEXT.pages_list_down}" src="images/icons/arrow_down.gif"></a></div></td>
          <td align='right' valign="top"><div style="margin-top:2px"><a target="_blank" href="../{$page.name}{if $smarty.const.SETTINGS_FRIENDLY_URL_ADD_END_SLASH}/{/if}"><img src="images/viewmag.png" hspace="2" border="0" title="{$MSGTEXT.pages_list_watch}"></a></div></td>
          <td align="center" valign="top"><div style="margin-top:2px"><a href="?act=pages{if $page_id}&page_id={$page_id}{/if}{if $pageCategoryId}&pageCategoryId={$pageCategoryId}{/if}&do=edit&id={$page.id}&sort_by=sort_by&sort_type={$sort_type}"><img border="0" title="{$MSGTEXT.pages_list_edit2}" src="images/edit.gif"></a></div></td>
          <td align="center" valign="top"><div style="margin-top:2px"><a href="?act=pages&do=delete&id={$page.id}" onclick='return q();'><img border="0" title="{$MSGTEXT.pages_list_del}" src="images/del_b.gif"></a></div></td>
        </tr>
        <tr>
          <td colspan="100%" bgcolor="White" valign="top" style="vertical-align:top">
          <table width="100%" id="{$page.name}" style="margin-top:0px;{if $smarty.foreach.pages.total>1}display:none;{/if}" cellpadding="0" cellspacing="0" border="0">
              {if $page.blocks|@count>1}
              <tr>
                <td width="12px" rowspan="{$page.blocks|@count}" align="right" valign="top" class="vertical_line"><img width="12px" height="1px" src="images/zero.gif"></td>
                <td width="11px"><img src="images/zero.gif" width="11px" height="1px"></td>
                <td></td>
                <td></td>                
              </tr>
              {else}
              <tr>
                <td width="12px" align="left" valign="top" class="vertical_line_center2"><img width="12px" height="1px" src="images/zero.gif"></td>
                <td width="11px"><img src="images/zero.gif" width="11px" height="1px"></td>
                <td></td>
                <td></td>
              </tr>
              {/if}
              {foreach name="blocks" from=$page.blocks item=item}
				
              {if !$smarty.foreach.blocks.last}
              <tr onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this, {$page.selected})">
                <td valign="top" align="left"><img width="11px" hspace="0" src="images/join.gif"></td>
                {else}                
              <tr onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this, {$page.selected})">
                <td colspan="2" align="right" valign="top"><img vspace="0" hspace="0" src="images/joinbottom.gif"><br>
                  <img width="23px" height="1px" src="images/zero.gif"></td>
                {/if}
                <td valign="top" height="24px" nowrap><div style="margin-top:4px"> {if $item.general_table_id>0 && $item.block_name} <a {if $item.global==1}class="g_link"{else}{if $item.global==2}class="sg_link"{else}class="simple_link"{/if}{/if}
		{if $item.block_name!=false}href='?act=modules&do=managedata&page_id={$page.id}&tag_id={$item.virtualtag_id}&page=1'{/if}>{$item.virtualtagname}</a> {else} <font color="gray">{$item.virtualtagname}</font> {/if} </div></td>
                <td valign="top" height="15px"><table style="margin-top:4px" align="left" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td valign="top" align="center" style="color:gray"><a {if $item.block_id} title="{$MSGTEXT.pages_list_way_to_block} {$item.name}" {/if} class="row_link" href="javascript:openBlockSettingsWindow('?act=templates&do=settings_edit&id={$page.virtual_tpl_id}&sel1={$item.virtualtag_id}&sel2={$item.block_id}&page_id={$page.id}&hide_menu=true')"><img hspace="5" border="0" src="images/arrow_right.png"></a></td>
                      <td style="color:gray" valign="top" nowrap>{if $item.block_name!=false}<a class="block_link" href="javascript:openBlockSettingsWindow('?act=modules&do=settings&hide_menu=true&id={$item.block_id}')">{if $item.block_description!=''} {$item.block_description}{else}{$item.block_name}</a>{/if}{else}<a class="noTpl" href="?act=templates&do=settings_edit&id={$page.virtual_tpl_id}&sel1={$item.virtualtag_id}&sel2=0">{$MSGTEXT.pages_list_no_block}</a>{/if} </td>
                    </tr>
                  </table>
                  </td>
                <td colspan="100%" width="100%">&nbsp;</td>                
              </tr>
              
              {/foreach}
              
            </table>
            </td>
        </tr>
        
        {/foreach}
      </table>
      </td>
  </tr>
</table>
{if $page_count}
	<div style="margin-top:5px;font-size:11px" align="right">{$page_count}</div>
{/if}