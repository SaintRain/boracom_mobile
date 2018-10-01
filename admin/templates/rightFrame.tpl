<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>{$MSGTEXT.title_general}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<LINK href="css/general.css" type="text/css" rel="stylesheet">
{if !$hide_menu}
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript">
var MSGTEXT= new Array();
MSGTEXT["lib_js_hide_menu"]="{$MSGTEXT.lib_js_hide_menu}";
MSGTEXT["lib_js_show_menu"]="{$MSGTEXT.lib_js_show_menu}";
MSGTEXT["lib_js_do_you_want_del_this_links"]="{$MSGTEXT.lib_js_do_you_want_del_this_links}";
MSGTEXT["links_js_cannot_be_empty"]="{$MSGTEXT.links_js_cannot_be_empty}";
MSGTEXT["links_js_do_you_want_del_selected_pages"]="{$MSGTEXT.links_js_do_you_want_del_selected_pages}";
MSGTEXT["linksedit_do_you_want_del_this_links"]="{$MSGTEXT.linksedit_do_you_want_del_this_links}";
MSGTEXT["linksedit_error_deleting"]="{$MSGTEXT.linksedit_error_deleting}";
MSGTEXT["linksedit_error_edit"]="{$MSGTEXT.linksedit_error_edit}";
MSGTEXT["lib_js_hide_menu_details"]="{$MSGTEXT.lib_js_hide_menu_details}";
MSGTEXT["lib_js_show_menu_details"]="{$MSGTEXT.lib_js_show_menu_details}";
MSGTEXT["classesmailer_type_group_is_empty"]="{$MSGTEXT.classesmailer_type_group_is_empty}";
MSGTEXT["classesmailer_type_group_confirm_delete"]="{$MSGTEXT.classesmailer_type_group_confirm_delete}";
MSGTEXT["lib_js_hide_menu_settings"]="{$MSGTEXT.lib_js_hide_menu_settings}";
MSGTEXT["lib_js_show_menu_settings"]="{$MSGTEXT.lib_js_show_menu_settings}";
MSGTEXT["classesmailer_edit_group_saved"]="{$MSGTEXT.classesmailer_edit_group_saved}";

var qs="{$qs}";
</script>
<script type="text/javascript" src="js/links.js"></script>
<script type="text/javascript" src="js/linksEdit.js"></script>
<script type="text/javascript" src="js/images.js"></script>
{else}
<script type="text/javascript">
var MSGTEXT= new Array();
MSGTEXT["lib_js_hide_menu_details"]="{$MSGTEXT.lib_js_hide_menu_details}";
MSGTEXT["lib_js_show_menu_details"]="{$MSGTEXT.lib_js_show_menu_details}";
MSGTEXT["lib_js_hide_menu_settings"]="{$MSGTEXT.lib_js_hide_menu_settings}";
MSGTEXT["lib_js_show_menu_settings"]="{$MSGTEXT.lib_js_show_menu_settings}";
</script>
{literal}
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript" src="js/images.js"></script>
{/literal} {/if}
</head>
<body {if !$hide_menu}onmouseup="endPoint()"{/if}>

{if !$hide_menu}
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" style="position:absolute">
	<tr>
		<td rowspan="2" onmousedown="startPoint()" class="flitter"
			valign="top" align="left"><img onmousedown="endPoint(event)"
			name="show_hide_but" onmouseover="on('show_hide_but')"
			onmouseout="off()" id="hidebutton" onclick="show_hide('adminmenu')"
			style="margin-top: 180px; margin-left: 0px; z-index: 100;"
			class="ukaz" border="0" title="{if $smarty.const.SETTINGS_LEFT_FRAME_WIDTH==0 || $smarty.cookies.display_menu=='false'}{$MSGTEXT.show_menu}{else}{$MSGTEXT.hide_menu}{/if}" src="images/m_hide.png"></td>
		<td rowspan="2"><img width="15px" src="images/zero.gif"></td>
		<td valign="top" style="width: 100%">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>
						
						
						<table height="26px" align="left" cellpadding="0" cellspacing="0"
							border="0">
							<tr>
								<td><a target="_blank" href="{$page_url}"><img
									title="{$MSGTEXT.your_site}" style="cursor: pointer"
									src="images/folder_home.png" border="0">
								<td width="5px"></td>
								<td nowrap><a target="_blank" class="links"
									href="{$page_url}">{$MSGTEXT.your_site}</a></td>
								<td width="30px">&nbsp;</td>

								<td><img title="{$MSGTEXT.add_link}" style="cursor: pointer"
									onclick="getTemplate('addLinkForm.tpl')"
									src="images/link_add.png" border="0">
								<td width="5px"></td>
								<td><a class="links"
									href="javascript:getTemplate('editLinkForm.tpl')">{$MSGTEXT.links}</a></td>
								<td width="30px">&nbsp;</td>

								<td valign="middle"><img
									onclick="javascript:getTemplate('findPage.tpl')"
									style="cursor: pointer" src='images/search.png'></td>
								<td width="5px"></td>
								<td valign="middle" nowrap><a class="links"
									href="javascript:getTemplate('findPage.tpl')">{$MSGTEXT.find_page}</a>&nbsp;
								</td>

								<td width="20px"></td>
								<td valign="middle"><a style="font-size: 11px"
									href="index.php?act=pages&do=form_add"><img border="0"
									style="cursor: pointer" src='images/add_s.gif'></a></td>
								<td width="5px"></td>
								<td valign="middle" nowrap><a class="links"
									href="index.php?act=pages&do=form_add">{$MSGTEXT.add_page}</a>&nbsp;
								</td>

								{if $smarty.session.___GoodCMS.group_id==0}
								<td width="20px"></td>
								<td valign="middle"><img
									onclick="javascript:getTemplate('editGroupLinkForm.tpl')"
									style="cursor: pointer" src='images/public.png'></td>
								<td width="5px"></td>
								<td valign="middle" nowrap><a class="links"
									href="javascript:getTemplate('editGroupLinkForm.tpl')">{$MSGTEXT.access_admin}</a>&nbsp;
								</td>

								<td width="20px"></td>
								<td valign="middle"><a class="links" target="_blank"
									href="constructor/main.php"><img border="0"
									style="cursor: pointer" src='images/blockdevice.png'></a></td>
								<td width="5px"></td>
								<td valign="middle" nowrap><a class="links" target="_blank"
									href="constructor/main.php">{$MSGTEXT.go_to_module_constructor}</a>&nbsp;
								</td>

								<td width="20px"></td>
								<td valign="middle"><a class="links"
									href="javaScript:openAutoupdateWindow('autoupdate.php', 700, 450)"><img
									border="0" style="cursor: pointer"
									src='images/arrow_refresh_small.png'></a></td>
								<td width="5px"></td>
								<td valign="middle" nowrap><a class="links"
									href="javaScript:openAutoupdateWindow('autoupdate.php', 700, 450)">{$MSGTEXT.autoupdate}</a>&nbsp;
								</td>
								
								<td width="20px"></td>
								<td valign="middle"><a class="links" target="_blank"
									href="http://www.goodcms.net/help/"><img border="0"
									style="cursor: pointer" src='images/help.png'></a></td>
								<td width="5px"></td>
								<td valign="middle" nowrap><a class="links" target="_blank"
									href="http://www.goodcms.net/help/">{$MSGTEXT.help}</a>&nbsp;
								</td>								
								
								{/if}							
							</tr>
						</table>

						</td>
						<tr>
							<tr>
								<td>
								<table width="100%" style="margin-top: 5px" cellpadding="0"
									cellspacing="0" border="0" id="links_table">
									<tbody>
										<tr>
											<td valign="middle">
											{foreach name="links" from=$allLinks item=item} <a href="javascript: gotoLink('?{$item.link}')">
												{if $item.link==$smarty.server.QUERY_STRING}<b>{$item.name}</b>{else}{$item.name}{/if}</a>{if !$smarty.foreach.links.last}<img hspace="7"
													src="images/line_link.gif" border="0">
												{/if} 
											{/foreach}</td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
				</table>
				</td>
			</tr>
		</table>
		{else} {/if} {if !$ImagesFiles} {if !$zakladky}		
		<h5 id="pageHeaderCaption" {if $hide_menu} style="padding-right:10px;padding-left:10px;margin-top:{if !$hide_menu}0px{else}10px{/if}; margin-bottom:0px"{/if}>{$content_head}</h5>				
		{else} {$zakladky} {/if} {/if} {include file="$content_template"} {if !$hide_menu} {include file="$pages_template"}</td>
		<td rowspan="2"><img src="images/zero.gif" width="5px"></td>
	</tr>
	<tr>
		<td valign="bottom" align="right" height="2%">
		<table cellpadding="2" cellspacing="0" border="0" style="margin-top:50px">
			<tr>
				<td>
				<table align="right" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td><img border="0" hspace="5" src="{if $smarty.session.___GoodCMS.CMS_ACTIVE}images/activated.png{else}images/notactivated.png{/if}"></td>
						<td style="font-size: 10px" color="#23326C">{if $smarty.session.___GoodCMS.CMS_ACTIVE}<b>{$MSGTEXT.the_system_is_activated}</b>{else}<a
							style="color: red" target="_blank" href="http://www.goodcms.net">{$MSGTEXT.to_activate_the_system}</a>{/if}</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td align="right" style="font-size: 10px" color="#23326C">GoodCMS v{$smarty.const.CMS_VERSION} All rights reserved © 2012</td>
			</tr>
		</table>	
	</tr>
</table>

<div id="frameBlock" align="center" class="fon_div" style="display: none; z-index: 1000000; position: absolute; width: 100%; height: 100%"></div>
<div id="frameBlock2" align="center" style="display: none; z-index: 1001000; position: absolute; width: 100%; height: 100%">
<table style="height: 100%" border="0">
	<tr>
		<td height="100%" style="height: 100%" valign="middle"><font id="frameContentBlock"></font></td>
	</tr>
</table>
</div>

<script>
var newLeftFrameWidth={$smarty.const.SETTINGS_LEFT_FRAME_WIDTH};
{literal}{/literal}

{if $format_url}
if (parent.frames.treeframe.reselectTree)
	parent.frames.treeframe.reselectTree('{$format_url}');	
	
{/if}
</script>
{/if}

</body>
</html>