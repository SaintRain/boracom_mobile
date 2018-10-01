<?php /* Smarty version 2.6.26, created on 2018-09-19 05:46:27
         compiled from editLinkForm.tpl */ ?>
<div class="ten">
  <table style="width:450px" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr><td>
      <table style="width:100%"  bgcolor="#86bae0" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td valign="top" align="left"><b><?php echo $this->_tpl_vars['MSGTEXT']['edit_link_mess']; ?>
</b></td>
          <td align="right"><img border=0 style="cursor:pointer" onclick="hideFormBlocks()" src="images/close.gif"></td>
        </tr>
        <tr>
        </td>        
        <td style="width:100%" colspan="2"><select name="data_id" multiple onChange="set_link_value(this)" id="data_id" style="width:100%;height:200px" size="10">              
				<?php if ($this->_tpl_vars['datalist']): ?>
				<?php $_from = $this->_tpl_vars['datalist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['links']):
?>				
              <option value="<?php echo $this->_tpl_vars['links']['id']; ?>
" <?php if ($this->_tpl_vars['currentData']['id'] == $this->_tpl_vars['links']['id']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['links']['name']; ?>
</option>              
				<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>				
            </select></td>
        </tr>
        <tr>
          <td colspan="2" valign="top" align="left"><?php echo $this->_tpl_vars['MSGTEXT']['edit_link_name']; ?>
:<br>
            <input type="text" style="width:440px" name="name" id="name" value="<?php echo $this->_tpl_vars['currentData']['name']; ?>
"></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input <?php if (! $this->_tpl_vars['currentData']['id']): ?>disabled<?php endif; ?> type="button" class="button" name="butedit" id="butedit" onclick="save_links()" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_link_save']; ?>
" style="width:130px">
            &nbsp;&nbsp;
            <input <?php if (! $this->_tpl_vars['currentData']['id']): ?>disabled<?php endif; ?> type="button" class="button" name="butdelete" id="butdelete" onclick="delete_links()" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_link_delete']; ?>
" style="width:130px">
            &nbsp;&nbsp; </td>
        </tr>
      </table>
      </td>
    </tr>
  </table>
</div>