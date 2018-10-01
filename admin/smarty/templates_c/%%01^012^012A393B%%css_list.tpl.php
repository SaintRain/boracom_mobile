<?php /* Smarty version 2.6.26, created on 2018-09-07 06:39:59
         compiled from css/css_list.tpl */ ?>
<?php echo ' 
<script language="JavaScript">
function setcolor(obj) {
	obj.style.background=\'#FFF2BE\';
}
function unsetcolor(obj) {
	obj.style.background=\'white\';
}
function q(){
	return confirm("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['css_list_alert_del']; ?>
<?php echo '");
}
</script>
'; ?>

<p style="margin-top:10;margin-bottom:10">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=css&do=form_add"><?php echo $this->_tpl_vars['MSGTEXT']['css_list_new']; ?>
</a></td>
</tr>
</table>
</p>
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor='#ccdbe6'>
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="top_list">
        <td width="50%"><b><a href="?act=css&sort_by=dir&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['css_list_dir']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'dir'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="20%"><b><a href="?act=css&sort_by=name&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['css_list_name']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'name'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          
          <td width="20%"><b><a href="?act=css&sort_by=mt&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['css_list_date_edit']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'mt'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="10%"><b><a href="?act=css&sort_by=size&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['css_list_size']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'size'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td colspan="3"><b><?php echo $this->_tpl_vars['MSGTEXT']['css_delete']; ?>
</td>
        </tr>
        <?php $_from = $this->_tpl_vars['css']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)">
          <td><?php echo $this->_tpl_vars['list']['dir']; ?>
</td>
          <td><?php echo $this->_tpl_vars['list']['name']; ?>
</td>          
          <td><?php echo $this->_tpl_vars['list']['modify']; ?>
</td>
          <td><?php echo $this->_tpl_vars['list']['size']; ?>
 kb.</td>
          <td width="50px" align="center"><a href="?act=css&do=edit&fname=<?php echo $this->_tpl_vars['list']['dir']; ?>
<?php echo $this->_tpl_vars['list']['name']; ?>
" ><img border="0" alt="<?php echo $this->_tpl_vars['MSGTEXT']['css_list_edit']; ?>
" src="images/edit.gif"></a></td>
          <td width="50px" align="center"><?php if (! $this->_tpl_vars['list']['sys']): ?><a href="?act=css&do=delete&fname=<?php echo $this->_tpl_vars['list']['dir']; ?>
<?php echo $this->_tpl_vars['list']['name']; ?>
" onclick='return q();'><img border="0" alt="<?php echo $this->_tpl_vars['MSGTEXT']['css_delete']; ?>
" src="images/del_b.gif"></a><?php endif; ?></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
      </table></td>
  </tr>
</table>