<?php /* Smarty version 2.6.26, created on 2014-09-14 09:30:09
         compiled from blocks/blocks_list.tpl */ ?>
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
<?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_del_mess']; ?>
<?php echo '");
}
</script>
'; ?>


<p style="margin-top:10px;margin-bottom:10px">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=b_c&do=add"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_create_block']; ?>
</a></td>
</tr>
</table>
</p>
<?php if ($this->_tpl_vars['message']): ?>
<p id="messagetext" style="margin-bottom:10px;color:Yellow"><?php echo $this->_tpl_vars['message']; ?>
</p>
<br>
<script language="JavaScript">Morphing("messagetext", true)</script> 
<?php endif; ?>
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor='#D5D5D5'>
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="top_list" >
          <td width="23%"><b><a href="?act=b_c&sort_by=name&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_name']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'name'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="30%"><b><a href="?act=b_c&sort_by=description&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_description']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'description'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="13%"><b><a href="?act=b_c&sort_by=type&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_type']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'type'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="20%"><b><a href="?act=b_c&sort_by=general_table_id&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_general_table']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'general_table_id'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td align="middle" width="7%" nowrap><b><a href="?act=b_c&sort_by=sort_index&sort_type=low<?php if ($this->_tpl_vars['pageCategoryId'] != ''): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_order']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'sort_index'): ?><img src='images/sort_hight.gif' border='0' alt=''><?php endif; ?></td>
          <td colspan="2" ><b><?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_edit']; ?>
</td>
        </tr>
        <?php $_from = $this->_tpl_vars['blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)">
          <td><?php echo $this->_tpl_vars['block']['name']; ?>
</td>
          <td><?php echo $this->_tpl_vars['block']['description']; ?>
</td>
          <td>          
          
          <?php if ($this->_tpl_vars['block']['type'] == 2): ?><?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_multiple']; ?>
<?php else: ?><?php if ($this->_tpl_vars['block']['type'] == 1): ?><?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_single']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_add_plugin']; ?>
<?php endif; ?><?php endif; ?></td>
          <td><?php echo $this->_tpl_vars['block']['general_table_id_caption']; ?>
</td>
          <td align="center" valign="middle"><a class="moveLink" href="?act=b_c&do=move_block_item&type=up&id=<?php echo $this->_tpl_vars['block']['id']; ?>
&sort_by=sort_index&sort_type=low<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php endif; ?>"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_up']; ?>
" src="images/arrow_up.gif"></a>&nbsp;&nbsp;<a class="moveLink" href="?act=b_c&do=move_block_item&type=down&id=<?php echo $this->_tpl_vars['block']['id']; ?>
&sort_by=sort_index&sort_type=low<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php endif; ?>"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_down']; ?>
" src="images/arrow_down.gif"></a></td>
          <td width="50px" align="right"><a href="?act=b_c&do=edit&b_id=<?php echo $this->_tpl_vars['block']['id']; ?>
"><img border="0" alt="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_edite']; ?>
" src="images/edit.gif"></a></td>
          <td width="50px" align="center"><a href="?act=b_c&do=delete&b_id=<?php echo $this->_tpl_vars['block']['id']; ?>
" onclick='return q();'><img border="0" alt="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_remove']; ?>
" src="images/del_b.gif"></a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
      </table>
      </td>
  </tr>
</table>