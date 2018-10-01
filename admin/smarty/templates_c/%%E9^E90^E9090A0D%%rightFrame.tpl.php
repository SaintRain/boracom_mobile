<?php /* Smarty version 2.6.26, created on 2018-09-07 05:39:05
         compiled from rightFrame.tpl */ ?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo $this->_tpl_vars['MSGTEXT']['title_general']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<LINK href="css/general.css" type="text/css" rel="stylesheet">
<?php if (! $this->_tpl_vars['hide_menu']): ?>
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript">
var MSGTEXT= new Array();
MSGTEXT["lib_js_hide_menu"]="<?php echo $this->_tpl_vars['MSGTEXT']['lib_js_hide_menu']; ?>
";
MSGTEXT["lib_js_show_menu"]="<?php echo $this->_tpl_vars['MSGTEXT']['lib_js_show_menu']; ?>
";
MSGTEXT["lib_js_do_you_want_del_this_links"]="<?php echo $this->_tpl_vars['MSGTEXT']['lib_js_do_you_want_del_this_links']; ?>
";
MSGTEXT["links_js_cannot_be_empty"]="<?php echo $this->_tpl_vars['MSGTEXT']['links_js_cannot_be_empty']; ?>
";
MSGTEXT["links_js_do_you_want_del_selected_pages"]="<?php echo $this->_tpl_vars['MSGTEXT']['links_js_do_you_want_del_selected_pages']; ?>
";
MSGTEXT["linksedit_do_you_want_del_this_links"]="<?php echo $this->_tpl_vars['MSGTEXT']['linksedit_do_you_want_del_this_links']; ?>
";
MSGTEXT["linksedit_error_deleting"]="<?php echo $this->_tpl_vars['MSGTEXT']['linksedit_error_deleting']; ?>
";
MSGTEXT["linksedit_error_edit"]="<?php echo $this->_tpl_vars['MSGTEXT']['linksedit_error_edit']; ?>
";
MSGTEXT["lib_js_hide_menu_details"]="<?php echo $this->_tpl_vars['MSGTEXT']['lib_js_hide_menu_details']; ?>
";
MSGTEXT["lib_js_show_menu_details"]="<?php echo $this->_tpl_vars['MSGTEXT']['lib_js_show_menu_details']; ?>
";
MSGTEXT["classesmailer_type_group_is_empty"]="<?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_type_group_is_empty']; ?>
";
MSGTEXT["classesmailer_type_group_confirm_delete"]="<?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_type_group_confirm_delete']; ?>
";
MSGTEXT["lib_js_hide_menu_settings"]="<?php echo $this->_tpl_vars['MSGTEXT']['lib_js_hide_menu_settings']; ?>
";
MSGTEXT["lib_js_show_menu_settings"]="<?php echo $this->_tpl_vars['MSGTEXT']['lib_js_show_menu_settings']; ?>
";
MSGTEXT["classesmailer_edit_group_saved"]="<?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_edit_group_saved']; ?>
";

var qs="<?php echo $this->_tpl_vars['qs']; ?>
";
</script>
<script type="text/javascript" src="js/links.js"></script>
<script type="text/javascript" src="js/linksEdit.js"></script>
<script type="text/javascript" src="js/images.js"></script>
<?php else: ?>
<script type="text/javascript">
var MSGTEXT= new Array();
MSGTEXT["lib_js_hide_menu_details"]="<?php echo $this->_tpl_vars['MSGTEXT']['lib_js_hide_menu_details']; ?>
";
MSGTEXT["lib_js_show_menu_details"]="<?php echo $this->_tpl_vars['MSGTEXT']['lib_js_show_menu_details']; ?>
";
MSGTEXT["lib_js_hide_menu_settings"]="<?php echo $this->_tpl_vars['MSGTEXT']['lib_js_hide_menu_settings']; ?>
";
MSGTEXT["lib_js_show_menu_settings"]="<?php echo $this->_tpl_vars['MSGTEXT']['lib_js_show_menu_settings']; ?>
";
</script>
<?php echo '
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript" src="js/images.js"></script>
'; ?>
 <?php endif; ?>
</head>
<body <?php if (! $this->_tpl_vars['hide_menu']): ?>onmouseup="endPoint()"<?php endif; ?>>

<?php if (! $this->_tpl_vars['hide_menu']): ?>
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" style="position:absolute">
	<tr>
		<td rowspan="2" onmousedown="startPoint()" class="flitter"
			valign="top" align="left"><img onmousedown="endPoint(event)"
			name="show_hide_but" onmouseover="on('show_hide_but')"
			onmouseout="off()" id="hidebutton" onclick="show_hide('adminmenu')"
			style="margin-top: 180px; margin-left: 0px; z-index: 100;"
			class="ukaz" border="0" title="<?php if (@SETTINGS_LEFT_FRAME_WIDTH == 0 || $_COOKIE['display_menu'] == 'false'): ?><?php echo $this->_tpl_vars['MSGTEXT']['show_menu']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['hide_menu']; ?>
<?php endif; ?>" src="images/m_hide.png"></td>
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
								<td><a target="_blank" href="<?php echo $this->_tpl_vars['page_url']; ?>
"><img
									title="<?php echo $this->_tpl_vars['MSGTEXT']['your_site']; ?>
" style="cursor: pointer"
									src="images/folder_home.png" border="0">
								<td width="5px"></td>
								<td nowrap><a target="_blank" class="links"
									href="<?php echo $this->_tpl_vars['page_url']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['your_site']; ?>
</a></td>
								<td width="30px">&nbsp;</td>

								<td><img title="<?php echo $this->_tpl_vars['MSGTEXT']['add_link']; ?>
" style="cursor: pointer"
									onclick="getTemplate('addLinkForm.tpl')"
									src="images/link_add.png" border="0">
								<td width="5px"></td>
								<td><a class="links"
									href="javascript:getTemplate('editLinkForm.tpl')"><?php echo $this->_tpl_vars['MSGTEXT']['links']; ?>
</a></td>
								<td width="30px">&nbsp;</td>

								<td valign="middle"><img
									onclick="javascript:getTemplate('findPage.tpl')"
									style="cursor: pointer" src='images/search.png'></td>
								<td width="5px"></td>
								<td valign="middle" nowrap><a class="links"
									href="javascript:getTemplate('findPage.tpl')"><?php echo $this->_tpl_vars['MSGTEXT']['find_page']; ?>
</a>&nbsp;
								</td>

								<td width="20px"></td>
								<td valign="middle"><a style="font-size: 11px"
									href="index.php?act=pages&do=form_add"><img border="0"
									style="cursor: pointer" src='images/add_s.gif'></a></td>
								<td width="5px"></td>
								<td valign="middle" nowrap><a class="links"
									href="index.php?act=pages&do=form_add"><?php echo $this->_tpl_vars['MSGTEXT']['add_page']; ?>
</a>&nbsp;
								</td>

								<?php if ($_SESSION['___GoodCMS']['group_id'] == 0): ?>
								<td width="20px"></td>
								<td valign="middle"><img
									onclick="javascript:getTemplate('editGroupLinkForm.tpl')"
									style="cursor: pointer" src='images/public.png'></td>
								<td width="5px"></td>
								<td valign="middle" nowrap><a class="links"
									href="javascript:getTemplate('editGroupLinkForm.tpl')"><?php echo $this->_tpl_vars['MSGTEXT']['access_admin']; ?>
</a>&nbsp;
								</td>

								<td width="20px"></td>
								<td valign="middle"><a class="links" target="_blank"
									href="constructor/main.php"><img border="0"
									style="cursor: pointer" src='images/blockdevice.png'></a></td>
								<td width="5px"></td>
								<td valign="middle" nowrap><a class="links" target="_blank"
									href="constructor/main.php"><?php echo $this->_tpl_vars['MSGTEXT']['go_to_module_constructor']; ?>
</a>&nbsp;
								</td>

								<td width="20px"></td>
								<td valign="middle"><a class="links"
									href="javaScript:openAutoupdateWindow('autoupdate.php', 700, 450)"><img
									border="0" style="cursor: pointer"
									src='images/arrow_refresh_small.png'></a></td>
								<td width="5px"></td>
								<td valign="middle" nowrap><a class="links"
									href="javaScript:openAutoupdateWindow('autoupdate.php', 700, 450)"><?php echo $this->_tpl_vars['MSGTEXT']['autoupdate']; ?>
</a>&nbsp;
								</td>
								
								<td width="20px"></td>
								<td valign="middle"><a class="links" target="_blank"
									href="http://www.goodcms.net/help/"><img border="0"
									style="cursor: pointer" src='images/help.png'></a></td>
								<td width="5px"></td>
								<td valign="middle" nowrap><a class="links" target="_blank"
									href="http://www.goodcms.net/help/"><?php echo $this->_tpl_vars['MSGTEXT']['help']; ?>
</a>&nbsp;
								</td>								
								
								<?php endif; ?>							
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
											<?php $_from = $this->_tpl_vars['allLinks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['links'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['links']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['links']['iteration']++;
?> <a href="javascript: gotoLink('?<?php echo $this->_tpl_vars['item']['link']; ?>
')">
												<?php if ($this->_tpl_vars['item']['link'] == $_SERVER['QUERY_STRING']): ?><b><?php echo $this->_tpl_vars['item']['name']; ?>
</b><?php else: ?><?php echo $this->_tpl_vars['item']['name']; ?>
<?php endif; ?></a><?php if (! ($this->_foreach['links']['iteration'] == $this->_foreach['links']['total'])): ?><img hspace="7"
													src="images/line_link.gif" border="0">
												<?php endif; ?> 
											<?php endforeach; endif; unset($_from); ?></td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
				</table>
				</td>
			</tr>
		</table>
		<?php else: ?> <?php endif; ?> <?php if (! $this->_tpl_vars['ImagesFiles']): ?> <?php if (! $this->_tpl_vars['zakladky']): ?>		
		<h5 id="pageHeaderCaption" <?php if ($this->_tpl_vars['hide_menu']): ?> style="padding-right:10px;padding-left:10px;margin-top:<?php if (! $this->_tpl_vars['hide_menu']): ?>0px<?php else: ?>10px<?php endif; ?>; margin-bottom:0px"<?php endif; ?>><?php echo $this->_tpl_vars['content_head']; ?>
</h5>				
		<?php else: ?> <?php echo $this->_tpl_vars['zakladky']; ?>
 <?php endif; ?> <?php endif; ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['content_template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php if (! $this->_tpl_vars['hide_menu']): ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['pages_template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
		<td rowspan="2"><img src="images/zero.gif" width="5px"></td>
	</tr>
	<tr>
		<td valign="bottom" align="right" height="2%">
		<table cellpadding="2" cellspacing="0" border="0" style="margin-top:50px">
			<tr>
				<td>
				<table align="right" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td><img border="0" hspace="5" src="<?php if ($_SESSION['___GoodCMS']['CMS_ACTIVE']): ?>images/activated.png<?php else: ?>images/notactivated.png<?php endif; ?>"></td>
						<td style="font-size: 10px" color="#23326C"><?php if ($_SESSION['___GoodCMS']['CMS_ACTIVE']): ?><b><?php echo $this->_tpl_vars['MSGTEXT']['the_system_is_activated']; ?>
</b><?php else: ?><a
							style="color: red" target="_blank" href="http://www.goodcms.net"><?php echo $this->_tpl_vars['MSGTEXT']['to_activate_the_system']; ?>
</a><?php endif; ?></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td align="right" style="font-size: 10px" color="#23326C">GoodCMS v<?php echo @CMS_VERSION; ?>
 All rights reserved © 2012</td>
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
var newLeftFrameWidth=<?php echo @SETTINGS_LEFT_FRAME_WIDTH; ?>
;
<?php echo ''; ?>


<?php if ($this->_tpl_vars['format_url']): ?>
if (parent.frames.treeframe.reselectTree)
	parent.frames.treeframe.reselectTree('<?php echo $this->_tpl_vars['format_url']; ?>
');	
	
<?php endif; ?>
</script>
<?php endif; ?>

</body>
</html>