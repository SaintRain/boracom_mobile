<?php /* Smarty version 2.6.26, created on 2014-09-14 09:29:57
         compiled from modules_forms/modules_list.tpl */ ?>
<?php echo '
<script language="JavaScript">
'; ?>
<?php if ($this->_tpl_vars['refreshFrame'] || $_GET['refreshFrame']): ?> reloadLeftFrame(); <?php endif; ?><?php echo '
function setcolor(obj) {
	obj.style.background=\'#FFF2BE\';
}
function unsetcolor(obj) {
	obj.style.background=\'white\';
}
function q(){
	return confirm("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['modules_list_allert_del']; ?>
<?php echo '");
}
</script>
'; ?>


<?php if ($this->_tpl_vars['message']): ?>
<p id="messagetext" style="margin-bottom:10px;color:Yellow"><?php echo $this->_tpl_vars['message']; ?>
</p>
<br>
<script language="JavaScript">Morphing("messagetext", true)</script> 
<?php endif; ?>
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor='#D5D5D5'>
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="top_list">
          <td width="20%"><b><a href="?act=m_c&sort_by=name&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['modules_list_title']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'name'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="10%"><b><a href="?act=m_c&sort_by=version&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['modules_list_version']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'version'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="35%"><b><a href="?act=m_c&sort_by=description&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['modules_list_description']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'description'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="10%"><b><a href="?act=m_c&sort_by=loaded&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['modules_list_status']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'loaded'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td align="middle" width="9%" nowrap><b><a href="?act=m_c&sort_by=sort_index&sort_type=hight<?php if ($this->_tpl_vars['pageCategoryId'] != ''): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['modules_list_order']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'sort_index'): ?><img src='images/sort_hight.gif' border='0' alt=''><?php endif; ?></td>
          <td colspan="4" ><b><?php echo $this->_tpl_vars['MSGTEXT']['modules_list_edit']; ?>
</td>
        </tr>
        <?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)" >
          <td><?php echo $this->_tpl_vars['module']['name']; ?>
</td>
          <td>v.<?php echo $this->_tpl_vars['module']['version']; ?>
</td>
          <td><?php echo $this->_tpl_vars['module']['description']; ?>
</td>
          <td><?php if ($this->_tpl_vars['module']['loaded'] == 0): ?><?php echo $this->_tpl_vars['MSGTEXT']['modules_list_create']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['modules_list_load']; ?>
<?php endif; ?></td>
          <td align="center" valign="middle"><a class="moveLink" href="?act=m_c&do=move_module_item&type=up&id=<?php echo $this->_tpl_vars['module']['id']; ?>
&sort_by=sort_index&sort_type=hight<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php endif; ?>"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['modules_list_up']; ?>
" src="images/arrow_up.gif"></a>&nbsp;&nbsp;<a class="moveLink" href="?act=m_c&do=move_module_item&type=down&id=<?php echo $this->_tpl_vars['module']['id']; ?>
&sort_by=sort_index&sort_type=hight<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php endif; ?>"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['modules_list_down']; ?>
" src="images/arrow_down.gif"></a></td>
          <td width="50px" align="center"><a href="?act=compiler&m_id=<?php echo $this->_tpl_vars['module']['id']; ?>
" ><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['modules_list_compile']; ?>
" src="images/compile.png"></a></td>
          <td width="50px" align="center"><a href="?act=m_c&do=insert_copy_form&id=<?php echo $this->_tpl_vars['module']['id']; ?>
" ><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['modules_list_create_copy']; ?>
" src="images/copy.png"></a></td>
          <td width="50px" align="center"><a href="?act=m_c&do=edit&id=<?php echo $this->_tpl_vars['module']['id']; ?>
" ><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['modules_list_ed']; ?>
" src="images/edit.gif"></a></td>
          <td width="50px" align="center"><a href="?act=m_c&do=delete&id=<?php echo $this->_tpl_vars['module']['id']; ?>
" onclick='return q();'><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['modules_list_delete']; ?>
" src="images/del_b.gif"></a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
      </table>
      </td>
  </tr>
</table>