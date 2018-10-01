<?php /* Smarty version 2.6.26, created on 2014-09-14 10:39:30
         compiled from blocks_templates/templates_list.tpl */ ?>
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
<?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_list_del_mess']; ?>
<?php echo '");
}
</script>
'; ?>


<p style="margin-top:10px;margin-bottom:10px">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=b_temp_c&do=add&b_id=<?php echo $this->_tpl_vars['b_id']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_list_create_tpl']; ?>
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
          <td  width="23%"><b><a href="?act=b_temp_c&sort_by=name&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
&b_id=<?php echo $this->_tpl_vars['b_id']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_list_name']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'name'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td width="63%"><b><a href="?act=b_temp_c&sort_by=description&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
&b_id=<?php echo $this->_tpl_vars['b_id']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_list_desc']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'description'): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td align="middle" width="7%" nowrap><b><a href="?act=b_temp_c&sort_by=sort_index&sort_type=low<?php if ($this->_tpl_vars['pageCategoryId'] != ''): ?>&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?>&b_id=<?php echo $this->_tpl_vars['b_id']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_list_order']; ?>
</a> <?php if ($this->_tpl_vars['sort_by'] == 'sort_index'): ?><img src='images/sort_hight.gif' border='0' alt=''><?php endif; ?></td>
          <td colspan="3"><b><?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_list_edit']; ?>
</td>
        </tr>
        <?php $_from = $this->_tpl_vars['templates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['template']):
?>
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)" >

          <td>
          <table  border="0" width="0" cellpadding="0" cellspacing="0">
          <tr>
          <td>
          
          <?php if ($this->_tpl_vars['template']['tpl_type'] == 'xml'): ?><img border="0" src="images/tpls/xml.png"><?php endif; ?>
          <?php if ($this->_tpl_vars['template']['tpl_type'] == 'tpl'): ?><img border="0" src="images/tpls/tpl.png"><?php endif; ?>
          <?php if ($this->_tpl_vars['template']['tpl_type'] == 'xsl'): ?><img border="0" src="images/tpls/xsl.png"><?php endif; ?>          
          </td>
          <td>&nbsp;&nbsp;<?php echo $this->_tpl_vars['template']['name']; ?>
</td>
          </tr>
          </table>
          
          </td>
          
          <td><?php echo $this->_tpl_vars['template']['description']; ?>
</td>
          <td align="center" valign="middle"><a class="moveLink" href="?act=b_temp_c&do=move_table_item&type=up&temp_id=<?php echo $this->_tpl_vars['template']['id']; ?>
&sort_by=sort_index&sort_type=low<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php endif; ?>&b_id=<?php echo $this->_tpl_vars['b_id']; ?>
"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_list_up']; ?>
" src="images/arrow_up.gif"></a>&nbsp;&nbsp;<a class="moveLink" href="?act=b_temp_c&do=move_table_item&type=down&temp_id=<?php echo $this->_tpl_vars['template']['id']; ?>
&sort_by=sort_index&sort_type=low<?php if ($this->_tpl_vars['selectedPage']): ?>&page=<?php echo $this->_tpl_vars['selectedPage']; ?>
<?php endif; ?>&b_id=<?php echo $this->_tpl_vars['b_id']; ?>
"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_list_down']; ?>
" src="images/arrow_down.gif"></a></td>
          <td width="50px" align="center"><a href="?act=b_temp_c&do=insert_copy_form&id=<?php echo $this->_tpl_vars['template']['id']; ?>
&b_id=<?php echo $this->_tpl_vars['b_id']; ?>
"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_list_copy']; ?>
" src="images/copy.png"></a></td>
          <td width="50px" align="center"><a href="?act=b_temp_c&do=edit&id=<?php echo $this->_tpl_vars['template']['id']; ?>
&b_id=<?php echo $this->_tpl_vars['b_id']; ?>
" ><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_list_edite']; ?>
" src="images/edit.gif"></a></td>
          <td width="50px" align="center"><a href="?act=b_temp_c&do=delete&id=<?php echo $this->_tpl_vars['template']['id']; ?>
&b_id=<?php echo $this->_tpl_vars['b_id']; ?>
" onclick='return q();'><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_list_remove']; ?>
" src="images/del_b.gif"></a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
      </table>
      </td>
  </tr>
</table>