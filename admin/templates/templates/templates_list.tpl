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
	if (!scolor) g_obg.style.background='white';
}


function q(){
	return confirm("{/literal}{$MSGTEXT.templates_list_del_alert}{literal}");
}


function show_hide_blocks(section) {
	element=GetElementById(section);
	uzel=GetElementById(section+'_uzel');
	line=GetElementById('td'+section);
	if (element.style.display=="none") {
		element.style.display="";
		uzel.src='images/minus.gif';
		line.className='vertical_line_center';

	}
	else {
		element.style.display="none";
		uzel.src='images/plus.gif';
		line.className='';
	}
}
</script>
{/literal}

<p style="margin-top:10px;margin-bottom:10px">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=templates&do=form_add">{$MSGTEXT.templates_list_ctrate_tpl}</a></td>
</tr>
</table>
</p>
{if $message}
<p style="margin:10px"><font color=yellow><b>{$message}</b></font></p>
{/if}
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor="#ccdbe6">
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="top_list">
          <td width="90%"><b><a href="?act=templates&sort_by=description&sort_type={$sort_type}{if $template_id_text}{$template_id_text}{/if}">{$MSGTEXT.templates_list_name}</a> {if $sort_by=='description'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td colspan="3" ><b>{$MSGTEXT.templates_list_edit}</td>
        </tr>
        {foreach name="tpl" from=$templates item=list}
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)" >
          <td valign="middle"> {if $list.virtual_tamplates}
            <table cellpadding="0" style="margin-top:4px" cellspacing="0" border="0">
              <tr>
                <td id="td{$list.id}" width="23px" {if $smarty.foreach.tpl.total==1}class="vertical_line_center"{/if} valign="top" align="center"><a class="list" style="text-decoration:none;" href="javascript: show_hide_blocks('{$list.id}');"> <img border="0" id="{$list.id}_uzel" src="{if $smarty.foreach.tpl.total==1}images/minus.gif{else}images/plus.gif{/if}"></a><br>
                  <img width="23px" height="1" src="images/zero.gif"></td>
                <td valign="top" width="100%" height="24px" ><div style="margin-top:-3px">
                  {$list.description}</td>
              </tr>
              <tr>
                <td colspan="100%"><table id="{$list.id}" style="{if $smarty.foreach.tpl.total>1}display:none;{/if}" cellpadding="0" cellspacing="0" border="0">
                    {if $list.virtual_tamplates|@count>1}
                    <tr>
                      <td width="12px" rowspan="{$list.virtual_tamplates|@count}" align="right" valign="top" class="vertical_line"><img width="12px" height="1px" src="images/zero.gif"></td>
                      <td width="11px" colspan="3"><img src="images/zero.gif" width="11px" height="1px" ></td>
                    </tr>
                    {else}
                    <tr>
                      <td width="12px" align="right" valign="top" class="vertical_line_center2"><img width="12px" height="1px" src="images/zero.gif"></td>
                      <td width="11px" align="left"><img src="images/zero.gif" width="11px" height="1px"></td>
                      <td></td>
                      <td></td>
                    </tr>
                    {/if}
                    {foreach name="tpls" from=$list.virtual_tamplates item=item}
                    {if !$smarty.foreach.tpls.last}
                    <tr>
                      <td valign="top" align="left" ><img width="11px" hspace="0" src="images/join.gif"></td>
                      {else}
                    
                    <tr>
                      <td colspan="2" align="right" valign="top"><img vspace="0" hspace="0" src="images/joinbottom.gif"><br>
                        <img width="23px" height="1px" src="images/zero.gif"></td>
                      {/if}
                      <td valign="top" height="24px"><div style="margin-top:4px"> <a class="simple_link" href="?act=templates&do=settings_edit&id={$item.id}">{$item.name}</a> </div></td>
                      <td><a style="margin-left:10px" href='?act=templates&do=edit_virtual&id={$item.id}'><img hspace="3" border="0" title="{$MSGTEXT.templates_list_settings}" src="images/system.gif"></a> <img src="images/line2.gif" border="0"> <a href="?act=templates&do=copy&id={$item.id}" ><img hspace="3" border="0" title="{$MSGTEXT.templates_list_copy}" src="images/copy.png"></a> <img src="images/line2.gif" border="0"> <a href="?act=templates&do=delete_virtual&id={$item.id}" onclick='return q();'><img border="0" title="{$MSGTEXT.templates_list_delete}" src="images/icons/delete.gif"></a></td>
                    </tr>
                    {/foreach}
                  </table></td>
              </tr>
            </table>
            {else} <font style="margin-left:6px" color="gray">{$list.description}</font> {/if} </td>
          <td width="50px" valign="top" align='center'><a href="?act=templates&do=add_virtual_tamplate&tamplate_id={$list.id}"><img border="0" title="{$MSGTEXT.templates_list_create_end_tpl}" src="images/add.gif"></a></td>
          <td width="50px" valign="top" align='center'><a href="?act=templates&do=edit&id={$list.id}"><img border="0" title="{$MSGTEXT.templates_list_edit_htmlcode}" src="images/edit.gif"></a></td>
          <td width="50px" valign="top" align="center"><a href="?act=templates&do=delete&id={$list.id}" onclick='return q();'><img border="0" title="{$MSGTEXT.templates_list_delete}" src="images/del_b.gif"></a></td>
        </tr>
        {/foreach}
      </table>
      </td>
  </tr>
</table>