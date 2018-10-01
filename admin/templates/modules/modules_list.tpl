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
	{/literal}
	return confirm("{$MSGTEXT.want_disable_module}");
	{literal}
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
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><a href="?act=modules&do=form_import">{$MSGTEXT.import_module}</a> &rarr; </td>
    <td width="20px"></td>
    <td><a href="?act=modules&do=copy_module_form">{$MSGTEXT.create_copy_of_module}</a> &rarr;</td>
  </tr>
</table>
</p>
{if $message}
{foreach from=$message item=m}
<p style="margin-bottom:10px"><font color="yellow">{$m}</font></p>
{/foreach}
{/if}
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor="#ccdbe6">
      <td>
    <table border="0" width="100%" cellpadding="2" cellspacing="0">
      <tr class="top_list">
        <td width="30%" nowrap><b><a href="?act=modules&sort_by=name&sort_type={$sort_type}">{$MSGTEXT.module}</a> {if $sort_by=='name'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
        <td width="10%" nowrap><b><a href="?act=modules&sort_by=version&sort_type={$sort_type}">{$MSGTEXT.module_version}</a> {if $sort_by=='version'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
        <td width="35%"><b><a href="?act=modules&sort_by=description&sort_type={$sort_type}">{$MSGTEXT.description}</a> {if $sort_by=='description'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
        <td width="15%" nowrap><b>{$MSGTEXT.export_module_data_colum}</td>
        <td width="10%" colspan="3"><b>{$MSGTEXT.edit}</td>
      </tr>
      {foreach name="modules" from=$modules item=list}
      <tr style="height:1px"></tr>
      <tr bgcolor="white" onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)" >
        <td valign="top"> {if $list.blocks}
          <table cellpadding="0" style="margin-top:4px" cellspacing="0" border="0">
            <tr>
              <td id="td{$list.name}" width="23px" {if $smarty.foreach.modules.total==1}class="vertical_line_center"{/if} valign="top" align="center"><a style="text-decoration:none;" href="javascript: show_hide_blocks('{$list.name}');"><img border="0" id="{$list.name}_uzel" src="{if $smarty.foreach.modules.total==1}images/minus.gif{else}images/plus.gif{/if}"></a><br>
                <img width="23px" height="1" src="images/zero.gif"></td>
              <td valign="top" width="100%" height="24px" ><div style="margin-top:-3px">{$list.name}</div></td>
            </tr>
            <tr>
              <td colspan="100%">
              	<table id="{$list.name}" style="{if $smarty.foreach.modules.total>1}display:none;{/if}" cellpadding="0" cellspacing="0" border="0">
                  {if $list.blocks|@count>1}
                  <tr>
                    <td width="12px" rowspan="{$list.blocks|@count}" align="right" valign="top" class="vertical_line"><img width="12" height="1" src="images/zero.gif"></td>
                    <td width="11px" colspan="3"><img src="images/zero.gif" width="11px" height="1px" ></td>
                  </tr>
                  {else}
                  <tr>
                    <td width="12px" align="left" valign="top" class="vertical_line_center2"><img width="12px" height="1" src="images/zero.gif"></td>
                    <td width="11px"><img src="images/zero.gif" width="11px" height="1px"></td>
                    <td></td>
                    <td></td>
                  </tr>
                  {/if}
                  
                  {foreach name="blocks" from=$list.blocks item=item}
                  {if !$smarty.foreach.blocks.last}
                  <tr>
                    <td valign="top" align="left" ><img width="11" hspace="0" src="images/join.gif"></td>
                    {else}                  
                  <tr>
                    <td colspan="2" align="right" valign="top"><img vspace="0" hspace="0" src="images/joinbottom.gif"><br>
                      <img width="23" height="1px" src="images/zero.gif"></td>
                    {/if}
                    <td valign="top" height="24"><div style="margin-top:4px"> <a class="simple_link" href='?act=modules&do=settings&id={$item.block_id}'> {if $item.block_description!=''} {$item.block_description}
                        {else}
                        {$item.block_name}
                        {/if}</a></div>
                        </td>
                    <td></td>
                  </tr>
                  {/foreach}
                </table>
                </td>
            </tr>
          </table>
          {else} <font style="margin-left:6px">{$list.name}</font> {/if}</td>
        <td valign="top">v.{$list.version}</td>
        </td>
      <td valign="top">{$list.description}</td>
        <td nowrap valign="top">{if $list.data_export_datetime!='0000-00-00 00:00:00'}{$list.data_export_datetime}{else}{/if}</td>
        <td align='center' valign="top"><a title="{$MSGTEXT.export_module_data}" href="?act=modules&do=export_module_data&id={$list.id}"><img border="0" src="images/map-export.png"></a></td>
        <td align='center' valign="top"><a title="{$MSGTEXT.edit}" href="?act=modules&do=edit&id={$list.id}"><img border="0" src="images/edit.gif"></a></td>
        <td align="center" valign="top"><a title="{$MSGTEXT.disable_module}" href="?act=modules&do=delete&id={$list.id}" onclick='return q();'><img border="0"  src="images/disconnect.png"></a></td>
      </tr>
      {/foreach}
    </table>
      </td>
  </tr>
</table>