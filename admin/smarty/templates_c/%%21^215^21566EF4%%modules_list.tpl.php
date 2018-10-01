<?php /* Smarty version 2.6.26, created on 2018-09-07 06:38:48
         compiled from modules/modules_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'modules/modules_list.tpl', 90, false),)), $this); ?>
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
	'; ?>

	return confirm("<?php echo $this->_tpl_vars['MSGTEXT']['want_disable_module']; ?>
");
	<?php echo '
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
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><a href="?act=modules&do=form_import"><?php echo $this->_tpl_vars['MSGTEXT']['import_module']; ?>
</a> &rarr; </td>
    <td width="20px"></td>
    <td><a href="?act=modules&do=copy_module_form"><?php echo $this->_tpl_vars['MSGTEXT']['create_copy_of_module']; ?>
</a> &rarr;</td>
  </tr>
</table>
</p>
<?php if ($this->_tpl_vars['message']): ?>
<?php $_from = $this->_tpl_vars['message']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['m']):
?>
<p style="margin-bottom:10px"><font color="yellow"><?php echo $this->_tpl_vars['m']; ?>
</font></p>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor="#ccdbe6">
      <td>
    <table border="0" width="100%" cellpadding="2" cellspacing="0">
      <tr class="top_list">
        <td width="30%" nowrap><b><a href="?act=modules&sort_by=name&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['module']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'name'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
        <td width="10%" nowrap><b><a href="?act=modules&sort_by=version&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['module_version']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'version'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
        <td width="35%"><b><a href="?act=modules&sort_by=description&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['description']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'description'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
        <td width="15%" nowrap><b><?php echo $this->_tpl_vars['MSGTEXT']['export_module_data_colum']; ?>
</td>
        <td width="10%" colspan="3"><b><?php echo $this->_tpl_vars['MSGTEXT']['edit']; ?>
</td>
      </tr>
      <?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['modules'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['modules']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['modules']['iteration']++;
?>
      <tr style="height:1px"></tr>
      <tr bgcolor="white" onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)" >
        <td valign="top"> <?php if ($this->_tpl_vars['list']['blocks']): ?>
          <table cellpadding="0" style="margin-top:4px" cellspacing="0" border="0">
            <tr>
              <td id="td<?php echo $this->_tpl_vars['list']['name']; ?>
" width="23px" <?php if ($this->_foreach['modules']['total'] == 1): ?>class="vertical_line_center"<?php endif; ?> valign="top" align="center"><a style="text-decoration:none;" href="javascript: show_hide_blocks('<?php echo $this->_tpl_vars['list']['name']; ?>
');"><img border="0" id="<?php echo $this->_tpl_vars['list']['name']; ?>
_uzel" src="<?php if ($this->_foreach['modules']['total'] == 1): ?>images/minus.gif<?php else: ?>images/plus.gif<?php endif; ?>"></a><br>
                <img width="23px" height="1" src="images/zero.gif"></td>
              <td valign="top" width="100%" height="24px" ><div style="margin-top:-3px"><?php echo $this->_tpl_vars['list']['name']; ?>
</div></td>
            </tr>
            <tr>
              <td colspan="100%">
              	<table id="<?php echo $this->_tpl_vars['list']['name']; ?>
" style="<?php if ($this->_foreach['modules']['total'] > 1): ?>display:none;<?php endif; ?>" cellpadding="0" cellspacing="0" border="0">
                  <?php if (count($this->_tpl_vars['list']['blocks']) > 1): ?>
                  <tr>
                    <td width="12px" rowspan="<?php echo count($this->_tpl_vars['list']['blocks']); ?>
" align="right" valign="top" class="vertical_line"><img width="12" height="1" src="images/zero.gif"></td>
                    <td width="11px" colspan="3"><img src="images/zero.gif" width="11px" height="1px" ></td>
                  </tr>
                  <?php else: ?>
                  <tr>
                    <td width="12px" align="left" valign="top" class="vertical_line_center2"><img width="12px" height="1" src="images/zero.gif"></td>
                    <td width="11px"><img src="images/zero.gif" width="11px" height="1px"></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <?php endif; ?>
                  
                  <?php $_from = $this->_tpl_vars['list']['blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['blocks'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['blocks']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['blocks']['iteration']++;
?>
                  <?php if (! ($this->_foreach['blocks']['iteration'] == $this->_foreach['blocks']['total'])): ?>
                  <tr>
                    <td valign="top" align="left" ><img width="11" hspace="0" src="images/join.gif"></td>
                    <?php else: ?>                  
                  <tr>
                    <td colspan="2" align="right" valign="top"><img vspace="0" hspace="0" src="images/joinbottom.gif"><br>
                      <img width="23" height="1px" src="images/zero.gif"></td>
                    <?php endif; ?>
                    <td valign="top" height="24"><div style="margin-top:4px"> <a class="simple_link" href='?act=modules&do=settings&id=<?php echo $this->_tpl_vars['item']['block_id']; ?>
'> <?php if ($this->_tpl_vars['item']['block_description'] != ''): ?> <?php echo $this->_tpl_vars['item']['block_description']; ?>

                        <?php else: ?>
                        <?php echo $this->_tpl_vars['item']['block_name']; ?>

                        <?php endif; ?></a></div>
                        </td>
                    <td></td>
                  </tr>
                  <?php endforeach; endif; unset($_from); ?>
                </table>
                </td>
            </tr>
          </table>
          <?php else: ?> <font style="margin-left:6px"><?php echo $this->_tpl_vars['list']['name']; ?>
</font> <?php endif; ?></td>
        <td valign="top">v.<?php echo $this->_tpl_vars['list']['version']; ?>
</td>
        </td>
      <td valign="top"><?php echo $this->_tpl_vars['list']['description']; ?>
</td>
        <td nowrap valign="top"><?php if ($this->_tpl_vars['list']['data_export_datetime'] != '0000-00-00 00:00:00'): ?><?php echo $this->_tpl_vars['list']['data_export_datetime']; ?>
<?php else: ?><?php endif; ?></td>
        <td align='center' valign="top"><a title="<?php echo $this->_tpl_vars['MSGTEXT']['export_module_data']; ?>
" href="?act=modules&do=export_module_data&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><img border="0" src="images/map-export.png"></a></td>
        <td align='center' valign="top"><a title="<?php echo $this->_tpl_vars['MSGTEXT']['edit']; ?>
" href="?act=modules&do=edit&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><img border="0" src="images/edit.gif"></a></td>
        <td align="center" valign="top"><a title="<?php echo $this->_tpl_vars['MSGTEXT']['disable_module']; ?>
" href="?act=modules&do=delete&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" onclick='return q();'><img border="0"  src="images/disconnect.png"></a></td>
      </tr>
      <?php endforeach; endif; unset($_from); ?>
    </table>
      </td>
  </tr>
</table>