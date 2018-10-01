<?php /* Smarty version 2.6.26, created on 2018-09-07 06:39:41
         compiled from templates/templates_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'templates/templates_list.tpl', 82, false),)), $this); ?>
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
	if (!scolor) g_obg.style.background=\'white\';
}


function q(){
	return confirm("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['templates_list_del_alert']; ?>
<?php echo '");
}


function show_hide_blocks(section) {
	element=GetElementById(section);
	uzel=GetElementById(section+\'_uzel\');
	line=GetElementById(\'td\'+section);
	if (element.style.display=="none") {
		element.style.display="";
		uzel.src=\'images/minus.gif\';
		line.className=\'vertical_line_center\';

	}
	else {
		element.style.display="none";
		uzel.src=\'images/plus.gif\';
		line.className=\'\';
	}
}
</script>
'; ?>


<p style="margin-top:10px;margin-bottom:10px">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=templates&do=form_add"><?php echo $this->_tpl_vars['MSGTEXT']['templates_list_ctrate_tpl']; ?>
</a></td>
</tr>
</table>
</p>
<?php if ($this->_tpl_vars['message']): ?>
<p style="margin:10px"><font color=yellow><b><?php echo $this->_tpl_vars['message']; ?>
</b></font></p>
<?php endif; ?>
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor="#ccdbe6">
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="top_list">
          <td width="90%"><b><a href="?act=templates&sort_by=description&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['template_id_text']): ?><?php echo $this->_tpl_vars['template_id_text']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['templates_list_name']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'description'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td colspan="3" ><b><?php echo $this->_tpl_vars['MSGTEXT']['templates_list_edit']; ?>
</td>
        </tr>
        <?php $_from = $this->_tpl_vars['templates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tpl'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tpl']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['tpl']['iteration']++;
?>
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)" >
          <td valign="middle"> <?php if ($this->_tpl_vars['list']['virtual_tamplates']): ?>
            <table cellpadding="0" style="margin-top:4px" cellspacing="0" border="0">
              <tr>
                <td id="td<?php echo $this->_tpl_vars['list']['id']; ?>
" width="23px" <?php if ($this->_foreach['tpl']['total'] == 1): ?>class="vertical_line_center"<?php endif; ?> valign="top" align="center"><a class="list" style="text-decoration:none;" href="javascript: show_hide_blocks('<?php echo $this->_tpl_vars['list']['id']; ?>
');"> <img border="0" id="<?php echo $this->_tpl_vars['list']['id']; ?>
_uzel" src="<?php if ($this->_foreach['tpl']['total'] == 1): ?>images/minus.gif<?php else: ?>images/plus.gif<?php endif; ?>"></a><br>
                  <img width="23px" height="1" src="images/zero.gif"></td>
                <td valign="top" width="100%" height="24px" ><div style="margin-top:-3px">
                  <?php echo $this->_tpl_vars['list']['description']; ?>
</td>
              </tr>
              <tr>
                <td colspan="100%"><table id="<?php echo $this->_tpl_vars['list']['id']; ?>
" style="<?php if ($this->_foreach['tpl']['total'] > 1): ?>display:none;<?php endif; ?>" cellpadding="0" cellspacing="0" border="0">
                    <?php if (count($this->_tpl_vars['list']['virtual_tamplates']) > 1): ?>
                    <tr>
                      <td width="12px" rowspan="<?php echo count($this->_tpl_vars['list']['virtual_tamplates']); ?>
" align="right" valign="top" class="vertical_line"><img width="12px" height="1px" src="images/zero.gif"></td>
                      <td width="11px" colspan="3"><img src="images/zero.gif" width="11px" height="1px" ></td>
                    </tr>
                    <?php else: ?>
                    <tr>
                      <td width="12px" align="right" valign="top" class="vertical_line_center2"><img width="12px" height="1px" src="images/zero.gif"></td>
                      <td width="11px" align="left"><img src="images/zero.gif" width="11px" height="1px"></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <?php endif; ?>
                    <?php $_from = $this->_tpl_vars['list']['virtual_tamplates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tpls'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tpls']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['tpls']['iteration']++;
?>
                    <?php if (! ($this->_foreach['tpls']['iteration'] == $this->_foreach['tpls']['total'])): ?>
                    <tr>
                      <td valign="top" align="left" ><img width="11px" hspace="0" src="images/join.gif"></td>
                      <?php else: ?>
                    
                    <tr>
                      <td colspan="2" align="right" valign="top"><img vspace="0" hspace="0" src="images/joinbottom.gif"><br>
                        <img width="23px" height="1px" src="images/zero.gif"></td>
                      <?php endif; ?>
                      <td valign="top" height="24px"><div style="margin-top:4px"> <a class="simple_link" href="?act=templates&do=settings_edit&id=<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</a> </div></td>
                      <td><a style="margin-left:10px" href='?act=templates&do=edit_virtual&id=<?php echo $this->_tpl_vars['item']['id']; ?>
'><img hspace="3" border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['templates_list_settings']; ?>
" src="images/system.gif"></a> <img src="images/line2.gif" border="0"> <a href="?act=templates&do=copy&id=<?php echo $this->_tpl_vars['item']['id']; ?>
" ><img hspace="3" border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['templates_list_copy']; ?>
" src="images/copy.png"></a> <img src="images/line2.gif" border="0"> <a href="?act=templates&do=delete_virtual&id=<?php echo $this->_tpl_vars['item']['id']; ?>
" onclick='return q();'><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['templates_list_delete']; ?>
" src="images/icons/delete.gif"></a></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                  </table></td>
              </tr>
            </table>
            <?php else: ?> <font style="margin-left:6px" color="gray"><?php echo $this->_tpl_vars['list']['description']; ?>
</font> <?php endif; ?> </td>
          <td width="50px" valign="top" align='center'><a href="?act=templates&do=add_virtual_tamplate&tamplate_id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['templates_list_create_end_tpl']; ?>
" src="images/add.gif"></a></td>
          <td width="50px" valign="top" align='center'><a href="?act=templates&do=edit&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['templates_list_edit_htmlcode']; ?>
" src="images/edit.gif"></a></td>
          <td width="50px" valign="top" align="center"><a href="?act=templates&do=delete&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" onclick='return q();'><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['templates_list_delete']; ?>
" src="images/del_b.gif"></a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
      </table>
      </td>
  </tr>
</table>