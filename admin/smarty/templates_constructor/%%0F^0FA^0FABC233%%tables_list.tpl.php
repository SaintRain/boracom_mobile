<?php /* Smarty version 2.6.26, created on 2014-09-14 09:30:04
         compiled from tables/tables_list.tpl */ ?>
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
<?php echo $this->_tpl_vars['MSGTEXT']['tables_list_alert_del']; ?>
<?php echo '");
}
</script>
'; ?>



<p style="margin-top:10px;margin-bottom:10px">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=t_c&do=add"><?php echo $this->_tpl_vars['MSGTEXT']['tables_list_create_table']; ?>
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
          <td width="33%" nowrap><b><a href="?act=t_c&sort_by=name&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['tables_list_name']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'name'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="53%" nowrap><b><a href="?act=t_c&sort_by=description&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['tables_list_description']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'description'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="10%" align="center" nowrap><b><a href="?act=t_c&sort_by=show_type&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['tables_list_editable']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'show_type'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          
          <!--
          <td width="23%"><b><a href="?act=t_c&sort_by=show_type&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['tables_list_print_data']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'show_type'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          -->
          <td align="center" width="7%" nowrap><b><a href="?act=t_c&sort_by=sort_index&sort_type=low<?php if ($this->_tpl_vars['pageCategoryId'] != ''): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['tables_list_order']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'sort_index'): ?><img src='images/sort_hight.gif' border='0' alt=''><?php endif; ?></td>
          <td colspan="3" nowrap><b><?php echo $this->_tpl_vars['MSGTEXT']['tables_list_edit']; ?>
</td>
        </tr>
        <?php $_from = $this->_tpl_vars['tables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['table']):
?>
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)">
          <td><?php echo $this->_tpl_vars['table']['name']; ?>
</td>
          <td><?php echo $this->_tpl_vars['table']['description']; ?>
</td>
          <td align="center">
          <?php if ($this->_tpl_vars['table']['show_type'] == 1): ?>          
          <a href="?act=t_c&do=setStatus&show_type=0&table_id=<?php echo $this->_tpl_vars['table']['id']; ?>
"><img src="images/check.gif" border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['tables_list_show_off']; ?>
"></a>
          <?php else: ?>
          <a href="?act=t_c&do=setStatus&show_type=1&table_id=<?php echo $this->_tpl_vars['table']['id']; ?>
"><img src="images/not_check.gif" border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['tables_list_show_on']; ?>
"></a>
          <?php endif; ?>
          
          </td>
          <!--
          <td><?php if ($this->_tpl_vars['table']['show_type'] == 0): ?><?php echo $this->_tpl_vars['MSGTEXT']['tables_list_list']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['tables_list_only_edit']; ?>
<?php endif; ?></td>
          -->
          
          <td align="center" valign="middle"><a class="moveLink" href="?act=t_c&do=move_table_item&type=up&id=<?php echo $this->_tpl_vars['table']['id']; ?>
&sort_by=sort_index&sort_type=low<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php endif; ?>"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['tables_list_up']; ?>
" src="images/arrow_up.gif"></a>&nbsp;&nbsp;<a class="moveLink" href="?act=t_c&do=move_table_item&type=down&id=<?php echo $this->_tpl_vars['table']['id']; ?>
&sort_by=sort_index&sort_type=low<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php endif; ?>"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['tables_list_down']; ?>
" src="images/arrow_down.gif"></a></td>
          <td width="50px" align="center"><a href="?act=t_c&do=insert_copy_form&t_id=<?php echo $this->_tpl_vars['table']['id']; ?>
" ><img border="0" alt="<?php echo $this->_tpl_vars['MSGTEXT']['tables_list_create_copy']; ?>
" src="images/copy.png"></a></td>
          <td width="50px" align="center"><a href="?act=t_c&do=edit&t_id=<?php echo $this->_tpl_vars['table']['id']; ?>
" ><img border="0" alt="<?php echo $this->_tpl_vars['MSGTEXT']['tables_list_edit']; ?>
" src="images/edit.gif"></a></td>
          <td width="50px" align="center"><a href="?act=t_c&do=delete&t_id=<?php echo $this->_tpl_vars['table']['id']; ?>
" onclick='return q();'><img border="0" alt="<?php echo $this->_tpl_vars['MSGTEXT']['tables_list_delete']; ?>
" src="images/del_b.gif"></a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
      </table>
      </td>
  </tr>
</table>