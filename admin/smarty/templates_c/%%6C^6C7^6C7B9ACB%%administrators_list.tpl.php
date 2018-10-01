<?php /* Smarty version 2.6.26, created on 2018-09-07 05:39:05
         compiled from administrators/administrators_list.tpl */ ?>
<?php echo ' 
<script language="JavaScript">
function setcolor(obj) {
	obj.style.background=\'#FFF2BE\';
}
function unsetcolor(obj) {
	obj.style.background=\'white\';
}
function q(){
	'; ?>

	return confirm("<?php echo $this->_tpl_vars['MSGTEXT']['want_del_record']; ?>
");
	<?php echo '
}
</script> 
'; ?>

<?php if ($this->_tpl_vars['error']): ?>
<p style="color:yellow">
  <?php $_from = $this->_tpl_vars['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['e']):
?>
  <?php echo $this->_tpl_vars['e']; ?>
<br>
  <?php endforeach; endif; unset($_from); ?> </p>
<?php endif; ?>
<p style="margin-top:10px;margin-bottom:10px">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=administrators&do=form_add"><?php echo $this->_tpl_vars['MSGTEXT']['add_new_admin']; ?>
</a></td>
  <td width="10px"></td>
  <td valign="middle"><img src='images/uses_grpoups.png'></td>
  <td valign="middle">&nbsp;<a href="?act=administrators&do=group_edit"><?php echo $this->_tpl_vars['MSGTEXT']['edit_group']; ?>
</a></td>
</tr>
</table>
</p>
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor="#ccdbe6">
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="top_list" >
          <td width="30%" nowrap><b><a href="?act=administrators&sort_by=login&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['login']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'login'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="30%"><b><a href="?act=administrators&sort_by=email&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['email']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'email'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="30%"><b><a href="?act=administrators&sort_by=name&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['group']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'name'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="40px" colspan="2"><b><?php echo $this->_tpl_vars['MSGTEXT']['edit']; ?>
</td>
        </tr>
        <?php $_from = $this->_tpl_vars['administrators']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)" >
          <td><?php echo $this->_tpl_vars['list']['login']; ?>
</td>
          <td><a class="list" href="mailto:<?php echo $this->_tpl_vars['list']['email']; ?>
"><?php echo $this->_tpl_vars['list']['email']; ?>
</a></td>
          <td><?php if ($this->_tpl_vars['list']['name']): ?><?php echo $this->_tpl_vars['list']['name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['superadmin']; ?>
<?php endif; ?></td>
          <td width="40px" align='right'><a href="?act=administrators&do=edit&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><img border="0" alt="<?php echo $this->_tpl_vars['MSGTEXT']['edit']; ?>
" src="images/edit.gif"></a></td>
          <td align="center"><a href="?act=administrators&do=delete&id=<?php echo $this->_tpl_vars['list']['id']; ?>
" onclick='return q();'><img border="0" alt="<?php echo $this->_tpl_vars['MSGTEXT']['delete']; ?>
" src="images/del_b.gif"></a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
      </table></td>
  </tr>
</table>