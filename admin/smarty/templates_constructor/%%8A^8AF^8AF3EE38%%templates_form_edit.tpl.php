<?php /* Smarty version 2.6.26, created on 2014-09-14 10:39:33
         compiled from blocks_templates/templates_form_edit.tpl */ ?>
<p style="margin-bottom:10px"><font color="yellow"> <?php $_from = $this->_tpl_vars['editError']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
  <?php echo $this->_tpl_vars['item']; ?>
<br>
  <?php endforeach; endif; unset($_from); ?>
  <?php echo $this->_tpl_vars['message']; ?>
</font>
  </p>
<form action="?act=b_temp_c&do=<?php echo $this->_tpl_vars['do']; ?>
&b_id=<?php echo $this->_tpl_vars['b_id']; ?>
" method="POST" style="margin:0px">
  <input value="<?php echo $this->_tpl_vars['id']; ?>
" name="id" id="id" type="hidden">
  <input value="<?php echo $this->_tpl_vars['loaded_name']; ?>
" name="loaded_name" id="loaded_name" type="hidden">
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td>
            <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td>
                  <table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td><?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_form_ed_name']; ?>
 <font color="yellow">*</font><br>
                          <input type="text" style="width:250px" name="name" id="name" value="<?php echo $this->_tpl_vars['name']; ?>
">
                          <select name="tpl_prefix">
                          <option <?php if ($this->_tpl_vars['tpl_prefix'] == '.tpl'): ?> selected <?php endif; ?> value=".tpl">.tpl</option>
                          <option <?php if ($this->_tpl_vars['tpl_prefix'] == '.xsl'): ?> selected <?php endif; ?> value=".xsl">.xsl</option>
                          <option <?php if ($this->_tpl_vars['tpl_prefix'] == '.xml'): ?> selected <?php endif; ?> value=".xml">.xml</option>                                                    
                          </select>
                          </td>
                        <td width="10px"></td>
                      </tr>
                    </table>
                    </td>
                <tr>
                  <td><?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_form_ed_description']; ?>
 <font color="yellow">*</font><br>
                    <textarea class="editarea_field" style="height:50px" name="description" id="description"><?php echo $this->_tpl_vars['description']; ?>
</textarea></td>
                </tr>
                <tr style="display:none">
                  <td><?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_form_ed_content']; ?>
 </font><br>
                    <textarea class="editarea_field" rows="37%" name="content" id="textarea_1" ><?php echo $this->_tpl_vars['content']; ?>
</textarea></td>
                </tr>
                <tr>
                  <td> 
                  <?php if ($this->_tpl_vars['do'] == 'insert'): ?>
                    <input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_form_create']; ?>
" style="width:130px" >
                    <?php else: ?>
                    <input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_templates_form_save']; ?>
" style="width:130px" >
                    <?php endif; ?>
                    </td>
                </tr>
              </table>
              </td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</form>