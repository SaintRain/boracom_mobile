<?php /* Smarty version 2.6.26, created on 2018-10-01 07:08:20
         compiled from blocks/blocks_form_add.tpl */ ?>
<form action="?act=b_c&do=insert" method="POST" style="margin:0">
  <input name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" type="hidden">
  <p style="margin-bottom:10px"><font color="Yellow"><?php $_from = $this->_tpl_vars['editError']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?><?php echo $this->_tpl_vars['item']; ?>
<?php endforeach; endif; unset($_from); ?></font></p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td><table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td><table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td><?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_add_name_mess']; ?>
</td>
                </tr>
                <tr>
                  <td><input type="text" name="name" style="width:100%;" value="<?php echo $this->_tpl_vars['name']; ?>
"></td>
                </tr>
                <tr>
                  <td><?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_add_type_block']; ?>
<br>
                    <table cellpadding="0" cellpadding="0" border="0">
                <tr>                
                
                  <td><input style="margin:0px" value="2" type="radio" <?php if ($this->_tpl_vars['type']): ?><?php if ($this->_tpl_vars['type'] == 2): ?>checked<?php endif; ?><?php else: ?>checked<?php endif; ?> name="type"></td>
                  <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_add_complex']; ?>
&nbsp;&nbsp;&nbsp;</td>
                  <td><input style="margin:0px" value="1" type="radio" <?php if ($this->_tpl_vars['type']): ?><?php if ($this->_tpl_vars['type'] == 1): ?>checked<?php endif; ?><?php endif; ?> name="type"></td>
                  <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_add_simple']; ?>
&nbsp;&nbsp;&nbsp;</td>
                  <td><input style="margin:0px" value="3" type="radio" <?php if ($this->_tpl_vars['type']): ?><?php if ($this->_tpl_vars['type'] == 3): ?>checked<?php endif; ?><?php endif; ?> name="type"></td>
                  <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_add_plugin']; ?>
</td>
                </tr>
              </table>
              </td>
          </tr>
          <tr>
            <td><?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_add_description']; ?>
</td>
          </tr>
          <tr>
            <td><input type="text" name="description" style="width:100%;" value="<?php echo $this->_tpl_vars['description']; ?>
"></td>
          </tr>
          <tr>
            <td><?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_general_table']; ?>
</td>
          </tr>
          <tr>
            <td><select name="general_table_id" id="general_table_id" style="width:100%">
                <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_t_not_select']; ?>
</option>                
				<?php $_from = $this->_tpl_vars['tables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['table']):
?>
                	<option <?php if ($this->_tpl_vars['table']['id'] == $this->_tpl_vars['general_table_id']): ?> selected <?php else: ?><?php if ($this->_tpl_vars['table']['general_table_id'] > 0): ?> style="color:gray" <?php endif; ?><?php endif; ?> value="<?php echo $this->_tpl_vars['table']['id']; ?>
"><?php echo $this->_tpl_vars['table']['description']; ?>
</option>                
				<?php endforeach; endif; unset($_from); ?>
              </select>
              </td>
          </tr>
          <tr>
            <td><?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_add_name_value']; ?>
</td>
          </tr>
          <tr>
            <td><input type="text" name="act_variable" style="width:100%;" value="<?php if ($this->_tpl_vars['act_variable'] != ''): ?><?php echo $this->_tpl_vars['act_variable']; ?>
<?php else: ?>act<?php endif; ?>"></td>
          </tr>
          <tr>
            <td><?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_add_type_value']; ?>
</td>
          </tr>
          <tr>
            <td><table cellpadding="0" cellpadding="0" border="0">
          <tr>
            <td><input style="margin:0" name="act_method" checked <?php if ($this->_tpl_vars['act_method'] == 'get'): ?>checked<?php endif; ?> value="get" type="radio"></td>
            <td>&nbsp;GET</td>
          </tr>
        </table>
        </td>
    </tr>
    <tr>
      <td><table cellpadding="0" cellpadding="0" border="0">
    <tr>
      <td><input style="margin:0" name="act_method" <?php if ($this->_tpl_vars['act_method'] == 'post'): ?>checked<?php endif; ?> value="post" type="radio"></td>
      <td>&nbsp;POST</td>
    </tr>
  </table>
  </td>
  <tr>
    <td><?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_general_used_variables']; ?>
</td>
  </tr>
  <tr>
    <td><textarea name="url_get_vars" style="width:100%;height:100px"><?php echo $this->_tpl_vars['url_get_vars']; ?>
</textarea></td>
  </tr>
  <tr>
    <td height="10px"></td>
  </tr>
  <tr>
    <td><input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_add_create']; ?>
" style="width:130px"></td>
  </tr>
  </table>
  </td>
  </tr>
  </table>
  </td>
  </tr>
  </table>
</form>