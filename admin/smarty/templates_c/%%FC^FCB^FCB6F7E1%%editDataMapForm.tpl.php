<?php /* Smarty version 2.6.26, created on 2018-09-07 07:13:39
         compiled from editDataMapForm.tpl */ ?>
<div class="ten">
  <table class="formborder" style="width:520px;"  border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table style="width:100%;" bgcolor="#86bae0" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td  valign="top" align="left"><b><?php if ($this->_tpl_vars['friendlyURL']): ?><?php echo $this->_tpl_vars['MSGTEXT']['editData_friendly_url']; ?>
<?php else: ?><?php if ($this->_tpl_vars['CopyNewContent']): ?><?php echo $this->_tpl_vars['MSGTEXT']['editData_CopyNewContent']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['editData_connect']; ?>
<?php endif; ?><?php endif; ?></b></td>
            <td  align="right"><img border="0" style="cursor:pointer" onclick="hideFormBlocks()" src="images/close.gif"></td>
          </tr>
          <tr>
            <td colspan="2">
            <table width="100%" cellpadding="2" cellspacing="2" border="0">                                             
            </tr>
                   
 			<td>
				<?php echo $this->_tpl_vars['MSGTEXT']['editData_from_module']; ?>
<br>
                    <select name="module_id" id="module_id" onChange="getTables()"  style="width:160px">                      
				<?php if ($this->_tpl_vars['modules']): ?>
                      <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['editData_no_module']; ?>
</option>                      
						<?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>
                      <option  value="<?php echo $this->_tpl_vars['module']['id']; ?>
" <?php if ($this->_tpl_vars['module']['id'] == $this->_tpl_vars['current_module']['id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['module']['name']; ?>
</option>                      
					<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
                    </select>            
            </td>
            <td><br><img src="images/next.png"></td>
                <td align="left"><?php echo $this->_tpl_vars['MSGTEXT']['editData_table']; ?>
<br>
                    <select name="table_id" onChange="getFields(<?php if ($this->_tpl_vars['friendlyURL']): ?>'friendlyFilter'<?php else: ?><?php if ($this->_tpl_vars['CopyNewContent']): ?>'CopyNewContent'<?php else: ?>false<?php endif; ?><?php endif; ?>)" id="table_id" style="width:160px">                      
				<?php if ($this->_tpl_vars['tables']): ?>
                      <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['editData_no_table']; ?>
</option>                      
						<?php $_from = $this->_tpl_vars['tables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['table']):
?>
                      <option  value="<?php echo $this->_tpl_vars['table']['id']; ?>
" <?php if ($this->_tpl_vars['table']['id'] == $this->_tpl_vars['saved_field']['table_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['table']['name']; ?>
</option>                      
					<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
                    </select>
                    </td>
                    
                  <td><br><img src="images/next.png"></td>
                  
                  <td align="left">
                  <?php echo $this->_tpl_vars['MSGTEXT']['editData_field']; ?>
<br>
                    <select name="field_id" id="field_id" style="width:160px">
                      <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['editData_no_esteblishid']; ?>
</option>                      
				<?php if ($this->_tpl_vars['saved_field']): ?>
					<?php if ($this->_tpl_vars['fields']): ?>
						<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>								
                      	<option value="<?php echo $this->_tpl_vars['field']['id']; ?>
" <?php if ($this->_tpl_vars['field']['id'] == $this->_tpl_vars['saved_field']['id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['field']['fieldname']; ?>
</option>                      
						<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>
				<?php endif; ?>
                    </select>
                    </td>
                </tr>
                <?php if (! $this->_tpl_vars['friendlyURL'] && ! $this->_tpl_vars['CopyNewContent']): ?>
                <tr>
                  <td colspan="100%" align="left" nowrap>
                  <table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td><input name="delete" id="delete" <?php if ($this->_tpl_vars['delete'] == 1): ?> checked <?php endif; ?> type="checkbox" class="checkbox" value="1"></td>
                        <td>&nbsp;
                        <?php echo $this->_tpl_vars['current_table_description']; ?>

                          </td>
                      </tr>
                      <?php if ($_GET['selected_edit_type'] == 3 || $_GET['selected_edit_type'] == 4): ?>
					  <tr>
                        <td><input name="own_filter" id="own_filter" <?php if ($this->_tpl_vars['own_filter'] == 1): ?> checked <?php endif; ?> type="checkbox" class="checkbox" value="1"></td>
                        <td>&nbsp;
                        <?php echo $this->_tpl_vars['MSGTEXT']['editData_own_filter']; ?>

                        </td>
                      <?php endif; ?>
                      </tr>                      
                    </table>
                    </td>
                </tr>
                <?php endif; ?>
              </table>
              </td>
          </tr>
          <tr>
            <td colspan="100%" height="10px"></td>
          </tr>
          <tr>
            <td colspan="100%"><input <?php if (! $this->_tpl_vars['fields']): ?>disabled<?php endif; ?> type="button" class="button"  onclick="saveSourseFieldId(<?php echo $this->_tpl_vars['c_number']; ?>
)" value="<?php echo $this->_tpl_vars['MSGTEXT']['editData_ok']; ?>
" style="width:100px">
              &nbsp;&nbsp;
              <input type="button" class="button" onclick="hideFormBlocks()" value="<?php echo $this->_tpl_vars['MSGTEXT']['editData_chancel']; ?>
" style="width:100px">
              &nbsp;&nbsp; </td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</div>