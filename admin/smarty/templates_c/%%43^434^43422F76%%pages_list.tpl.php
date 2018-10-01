<?php /* Smarty version 2.6.26, created on 2018-09-07 06:40:08
         compiled from pages/pages_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'pages/pages_list.tpl', 83, false),)), $this); ?>
<?php echo '
<script language="JavaScript">
var scolor=true;
var g_obg;


function setcolor(obj) {
	setUnsetColor();
	g_obg=obj;
	scolor=true;
	g_obg.style.background=\'#FFF2BE\';
}


function unsetcolor(obj) {
	g_obg=obj;
	scolor=false;
	setTimeout(\'setUnsetColor()\', 1);
}


function setUnsetColor() {
	if (!scolor) {
		if (g_obg.className==\'page_selected\') g_obg.style.background=\'#dce7fa\';
		else g_obg.style.background=\'white\';
	}
}


function q(){
	return confirm("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_del_mess']; ?>
<?php echo '");
}


function show_hide_blocks(section) {
	element=GetElementById(section);
	uzel=GetElementById(section+\'_uzel\');
	line=GetElementById(\'td\'+section);
	if (element.style.display=="none") {
		element.style.display="";
		uzel.src=\'images/minus.gif\';
		line.className=\'vertical_line_left\';

	}
	else {
		element.style.display="none";
		uzel.src=\'images/plus.gif\';
		line.className=\'\';
	}
}
'; ?>
<?php if ($this->_tpl_vars['refreshFrame'] || $_GET['refreshFrame']): ?>
reloadLeftFrame();
<?php endif; ?>
</script>

<?php if ($this->_tpl_vars['message']): ?>
<p style="margin-bottom:10px"><font color="yellow"><?php echo $this->_tpl_vars['message']; ?>
</font></p>
<?php endif; ?>
<p style="margin-top:10px;margin-bottom:10px">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img onclick="javascript:location.href='?act=pages&do=form_add<?php if ($this->_tpl_vars['pageCategoryId'] != ''): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?>'" style="cursor:pointer" src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=pages&do=form_add<?php if ($this->_tpl_vars['pageCategoryId'] != ''): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['pages_list_new_page']; ?>
</a></td>
</tr>
</table>
</p>
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor='#ccdbe6'>
    <td><table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr class="top_list">
          <td width="38%" nowrap><div style="margin:2px"><b><a href="?act=pages&sort_by=description&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['pageCategoryId'] != ''): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['pages_list_description']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'description'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></div></td>
          <td width="15%" nowrap><div style="margin:2px"><b><a href="?act=pages&sort_by=name&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['pageCategoryId'] != ''): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['pages_list_name_page']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'name'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></div></td>
          <td width="20%"><div style="margin:2px"><b><a href="?act=pages&sort_by=tpl_name&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['pageCategoryId'] != ''): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['pages_list_template']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'tpl_name'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></div></td>
          <td align="middle" width="4%" nowrap><div style="margin:2px"><b><a href="?act=pages&sort_by=enable&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['pageCategoryId'] != ''): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['pages_list_status']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'enable'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></div></td>
          <td align="middle" width="4%" nowrap><div style="margin:2px"><b><a href="?act=pages&sort_by=cache&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['pageCategoryId'] != ''): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['pages_list_cache']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'cache'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></div></td>
          <td align="middle" width="4%" nowrap><div style="margin:2px"><b><a href="?act=pages&sort_by=selected&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['pageCategoryId'] != ''): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['pages_list_otm']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'selected'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></div></td>
          <td align="middle" width="7%" nowrap><div style="margin:2px"><b><a href="?act=pages&sort_by=sort_index&sort_type=hight<?php if ($this->_tpl_vars['pageCategoryId'] != ''): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['pages_list_order']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'sort_index'): ?><img src='images/sort_hight.gif' border='0' alt=''><?php endif; ?></div></td>
          <td colspan="3"><div style="margin:2px"><b><?php echo $this->_tpl_vars['MSGTEXT']['pages_list_edit']; ?>
</div></td>
        </tr>
        <?php $_from = $this->_tpl_vars['allpages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['pages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['page']):
        $this->_foreach['pages']['iteration']++;
?>
        <tr style="height:1px" ></tr>
        <tr <?php if ($this->_tpl_vars['page']['selected']): ?> class="page_selected" <?php else: ?>class="page_not_selected"<?php endif; ?> onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this, <?php echo $this->_tpl_vars['page']['selected']; ?>
)" >
          <td id="td<?php echo $this->_tpl_vars['page']['name']; ?>
" <?php if ($this->_foreach['pages']['total'] == 1 && $this->_tpl_vars['page']['templates_id'] && count($this->_tpl_vars['page']['blocks']) > 0): ?>class="vertical_line_left"<?php endif; ?> valign="top" <?php if ($this->_foreach['pages']['total'] == 1 && $this->_tpl_vars['page']['blocks']): ?><?php endif; ?> ><div style="margin-top:5px"> <?php if ($this->_tpl_vars['page']['blocks']): ?>
              <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td  width="23px"  valign="top" align="center"><a style="text-decoration:none;" href="javascript: show_hide_blocks('<?php echo $this->_tpl_vars['page']['name']; ?>
')"><img border="0" id="<?php echo $this->_tpl_vars['page']['name']; ?>
_uzel" src="<?php if ($this->_foreach['pages']['total'] == 1): ?>images/minus.gif<?php else: ?>images/plus.gif<?php endif; ?>"></a><br><img width="23px" height="1px" src="images/zero.gif"></td>
                  <td valign="top" width="100%" style="height:24px"><div style="margin-top:-3px;height:100%">
                    <?php if ($this->_tpl_vars['page']['description']): ?><?php echo $this->_tpl_vars['page']['description']; ?>
<?php else: ?><?php echo $this->_tpl_vars['page']['name']; ?>
<?php endif; ?></td>
                </tr>
              </table>
              <?php else: ?>
              <div style="margin-left:17px"><font color="gray"><?php echo $this->_tpl_vars['page']['description']; ?>
</font></div>
              <?php endif; ?></div></td>
          <td valign="top"><div style="margin-top:5px;margin-left:2px"><?php echo $this->_tpl_vars['page']['name']; ?>
</div></td>
          <td valign="top"><div style="margin-top:5px;margin-left:2px"> <?php if ($this->_tpl_vars['page']['templates_id']): ?>
              <table cellpadding="0" width="100%" cellspacing="0" border="0">                
                  <td style="width:16px" align="left" valign="top"><a title="<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_edit_tpl']; ?>
 «<?php echo $this->_tpl_vars['page']['tpl_name']; ?>
»" href="?act=templates&page&template_id=<?php echo $this->_tpl_vars['page']['tpl_id']; ?>
"><img align="left"  border="0" src="images/t_settings.png"><a/></td>
                  <td style="width:16px" align="left" valign="top"><a title="<?php echo $this->_tpl_vars['MSGTEXT']['templates_list_settings']; ?>
" href="javascript:openBlockSettingsWindow('?act=templates&do=edit_virtual&id=<?php echo $this->_tpl_vars['page']['virtual_tpl_id']; ?>
<?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?>&hide_menu=true')"><img align="left" hspace="5" border="0" src="images/system.gif"><a/></td>
                  <td align="left" valign="middle" nowrap><a class="list" href="javascript:openBlockSettingsWindow('?act=templates&do=settings_edit&id=<?php echo $this->_tpl_vars['page']['virtual_tpl_id']; ?>
&hide_menu=true')"><?php echo $this->_tpl_vars['page']['tpl_name']; ?>
</a></td>
              </table>
              <?php else: ?> <font color="red"><?php echo $this->_tpl_vars['MSGTEXT']['pages_list_no_template_mess']; ?>
</font> <?php endif; ?> </div></td>
          <td align="middle" valign="top"><div style="margin-top:5px"><?php if ($this->_tpl_vars['page']['enable'] == true): ?><a href="?act=pages&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php else: ?>&page=1<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page']['id']; ?>
<?php endif; ?>&do=set_page_status&id=<?php echo $this->_tpl_vars['page']['id']; ?>
&enable=0<?php if ($this->_tpl_vars['page_category']): ?>&pageCategoryId=<?php echo $this->_tpl_vars['page_category']; ?>
<?php endif; ?>"><img title="<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_public']; ?>
" src="images/icons/check.gif" border="0"></a><?php else: ?><a href="?act=pages&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php else: ?>&page=1<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page']['id']; ?>
<?php endif; ?>&do=set_page_status&id=<?php echo $this->_tpl_vars['page']['id']; ?>
&enable=1<?php if ($this->_tpl_vars['page_category']): ?>&pageCategoryId=<?php echo $this->_tpl_vars['page_category']; ?>
<?php endif; ?>"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_public_page']; ?>
" src="images/icons/not_check.gif"></a><?php endif; ?></div></td>
          <td align="middle" valign="top"><div style="margin-top:5px"><?php if ($this->_tpl_vars['page']['cache'] == true): ?><a href="?act=pages&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php else: ?>&page=1<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page']['id']; ?>
<?php endif; ?>&do=set_cache_status&id=<?php echo $this->_tpl_vars['page']['id']; ?>
&enable=0<?php if ($this->_tpl_vars['page_category']): ?>&pageCategoryId=<?php echo $this->_tpl_vars['page_category']; ?>
<?php endif; ?>&pname=<?php echo $this->_tpl_vars['page']['name']; ?>
"><img title="<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_cancel']; ?>
" src="images/icons/check.gif" border="0"></a><?php else: ?><a href="?act=pages&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php else: ?>&page=1<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page']['id']; ?>
<?php endif; ?>&do=set_cache_status&id=<?php echo $this->_tpl_vars['page']['id']; ?>
&enable=1<?php if ($this->_tpl_vars['page_category']): ?>&pageCategoryId=<?php echo $this->_tpl_vars['page_category']; ?>
<?php endif; ?>&pname=<?php echo $this->_tpl_vars['page']['name']; ?>
"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_on_cache']; ?>
" src="images/icons/not_check.gif"></a><?php endif; ?></div></td>
          <td align="middle" valign="top"><div style="margin-top:5px"><?php if ($this->_tpl_vars['page']['selected'] == true): ?><a href="?act=pages&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php else: ?>&page=1<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page']['id']; ?>
<?php endif; ?>&do=set_selected_status&id=<?php echo $this->_tpl_vars['page']['id']; ?>
&enable=0<?php if ($this->_tpl_vars['page_category']): ?>&pageCategoryId=<?php echo $this->_tpl_vars['page_category']; ?>
<?php endif; ?>"><img title="<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_unselect']; ?>
" src="images/icons/check.gif" border="0"></a><?php else: ?><a href="?act=pages&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php else: ?>&page=1<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page']['id']; ?>
<?php endif; ?>&do=set_selected_status&id=<?php echo $this->_tpl_vars['page']['id']; ?>
&enable=1<?php if ($this->_tpl_vars['page_category']): ?>&pageCategoryId=<?php echo $this->_tpl_vars['page_category']; ?>
<?php endif; ?>"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_select_page']; ?>
" src="images/icons/not_check.gif"></a><?php endif; ?></div></td>
          <td align="center" valign="top"><div style="margin-top:5px"><a class="moveLink" href="?act=pages<?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['pageCategoryId']): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?>&do=movePage&type=up&id=<?php echo $this->_tpl_vars['page']['id']; ?>
&sort_by=sort_index&sort_type=hight<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php endif; ?>"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_up']; ?>
" src="images/icons/arrow_up.gif"></a>&nbsp;&nbsp;<a class="moveLink" href="?act=pages<?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['pageCategoryId']): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?>&do=movePage&type=down&id=<?php echo $this->_tpl_vars['page']['id']; ?>
&sort_by=sort_index&sort_type=hight<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php endif; ?>"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_down']; ?>
" src="images/icons/arrow_down.gif"></a></div></td>
          <td align='right' valign="top"><div style="margin-top:2px"><a target="_blank" href="../<?php echo $this->_tpl_vars['page']['name']; ?>
<?php if (@SETTINGS_FRIENDLY_URL_ADD_END_SLASH): ?>/<?php endif; ?>"><img src="images/viewmag.png" hspace="2" border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_watch']; ?>
"></a></div></td>
          <td align="center" valign="top"><div style="margin-top:2px"><a href="?act=pages<?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['pageCategoryId']): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?>&do=edit&id=<?php echo $this->_tpl_vars['page']['id']; ?>
&sort_by=sort_by&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_edit2']; ?>
" src="images/edit.gif"></a></div></td>
          <td align="center" valign="top"><div style="margin-top:2px"><a href="?act=pages&do=delete&id=<?php echo $this->_tpl_vars['page']['id']; ?>
" onclick='return q();'><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_del']; ?>
" src="images/del_b.gif"></a></div></td>
        </tr>
        <tr>
          <td colspan="100%" bgcolor="White" valign="top" style="vertical-align:top">
          <table width="100%" id="<?php echo $this->_tpl_vars['page']['name']; ?>
" style="margin-top:0px;<?php if ($this->_foreach['pages']['total'] > 1): ?>display:none;<?php endif; ?>" cellpadding="0" cellspacing="0" border="0">
              <?php if (count($this->_tpl_vars['page']['blocks']) > 1): ?>
              <tr>
                <td width="12px" rowspan="<?php echo count($this->_tpl_vars['page']['blocks']); ?>
" align="right" valign="top" class="vertical_line"><img width="12px" height="1px" src="images/zero.gif"></td>
                <td width="11px"><img src="images/zero.gif" width="11px" height="1px"></td>
                <td></td>
                <td></td>                
              </tr>
              <?php else: ?>
              <tr>
                <td width="12px" align="left" valign="top" class="vertical_line_center2"><img width="12px" height="1px" src="images/zero.gif"></td>
                <td width="11px"><img src="images/zero.gif" width="11px" height="1px"></td>
                <td></td>
                <td></td>
              </tr>
              <?php endif; ?>
              <?php $_from = $this->_tpl_vars['page']['blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['blocks'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['blocks']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['blocks']['iteration']++;
?>
				
              <?php if (! ($this->_foreach['blocks']['iteration'] == $this->_foreach['blocks']['total'])): ?>
              <tr onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this, <?php echo $this->_tpl_vars['page']['selected']; ?>
)">
                <td valign="top" align="left"><img width="11px" hspace="0" src="images/join.gif"></td>
                <?php else: ?>                
              <tr onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this, <?php echo $this->_tpl_vars['page']['selected']; ?>
)">
                <td colspan="2" align="right" valign="top"><img vspace="0" hspace="0" src="images/joinbottom.gif"><br>
                  <img width="23px" height="1px" src="images/zero.gif"></td>
                <?php endif; ?>
                <td valign="top" height="24px" nowrap><div style="margin-top:4px"> <?php if ($this->_tpl_vars['item']['general_table_id'] > 0 && $this->_tpl_vars['item']['block_name']): ?> <a <?php if ($this->_tpl_vars['item']['global'] == 1): ?>class="g_link"<?php else: ?><?php if ($this->_tpl_vars['item']['global'] == 2): ?>class="sg_link"<?php else: ?>class="simple_link"<?php endif; ?><?php endif; ?>
		<?php if ($this->_tpl_vars['item']['block_name'] != false): ?>href='?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page']['id']; ?>
&tag_id=<?php echo $this->_tpl_vars['item']['virtualtag_id']; ?>
&page=1'<?php endif; ?>><?php echo $this->_tpl_vars['item']['virtualtagname']; ?>
</a> <?php else: ?> <font color="gray"><?php echo $this->_tpl_vars['item']['virtualtagname']; ?>
</font> <?php endif; ?> </div></td>
                <td valign="top" height="15px"><table style="margin-top:4px" align="left" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td valign="top" align="center" style="color:gray"><a <?php if ($this->_tpl_vars['item']['block_id']): ?> title="<?php echo $this->_tpl_vars['MSGTEXT']['pages_list_way_to_block']; ?>
 <?php echo $this->_tpl_vars['item']['name']; ?>
" <?php endif; ?> class="row_link" href="javascript:openBlockSettingsWindow('?act=templates&do=settings_edit&id=<?php echo $this->_tpl_vars['page']['virtual_tpl_id']; ?>
&sel1=<?php echo $this->_tpl_vars['item']['virtualtag_id']; ?>
&sel2=<?php echo $this->_tpl_vars['item']['block_id']; ?>
&page_id=<?php echo $this->_tpl_vars['page']['id']; ?>
&hide_menu=true')"><img hspace="5" border="0" src="images/arrow_right.png"></a></td>
                      <td style="color:gray" valign="top" nowrap><?php if ($this->_tpl_vars['item']['block_name'] != false): ?><a class="block_link" href="javascript:openBlockSettingsWindow('?act=modules&do=settings&hide_menu=true&id=<?php echo $this->_tpl_vars['item']['block_id']; ?>
')"><?php if ($this->_tpl_vars['item']['block_description'] != ''): ?> <?php echo $this->_tpl_vars['item']['block_description']; ?>
<?php else: ?><?php echo $this->_tpl_vars['item']['block_name']; ?>
</a><?php endif; ?><?php else: ?><a class="noTpl" href="?act=templates&do=settings_edit&id=<?php echo $this->_tpl_vars['page']['virtual_tpl_id']; ?>
&sel1=<?php echo $this->_tpl_vars['item']['virtualtag_id']; ?>
&sel2=0"><?php echo $this->_tpl_vars['MSGTEXT']['pages_list_no_block']; ?>
</a><?php endif; ?> </td>
                    </tr>
                  </table>
                  </td>
                <td colspan="100%" width="100%">&nbsp;</td>                
              </tr>
              
              <?php endforeach; endif; unset($_from); ?>
              
            </table>
            </td>
        </tr>
        
        <?php endforeach; endif; unset($_from); ?>
      </table>
      </td>
  </tr>
</table>
<?php if ($this->_tpl_vars['page_count']): ?>
	<div style="margin-top:5px;font-size:11px" align="right"><?php echo $this->_tpl_vars['page_count']; ?>
</div>
<?php endif; ?>