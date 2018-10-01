<?php /* Smarty version 2.6.26, created on 2014-09-14 10:03:14
         compiled from E:/Zend/Apache2/htdocs/honda/admin/templates/modules/modules_settings_elements.tpl */ ?>
            
        <?php if ($this->_tpl_vars['list']['type'] == 1): ?>
        <tr bgcolor="#66a4d3">
          <td valign="middle" align="left"><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
          <td>
            <i><?php echo $this->_tpl_vars['list']['description']; ?>
</i><br>
            <input type="text" style="width:100%" name="<?php echo $this->_tpl_vars['list']['name']; ?>
" value="<?php echo $this->_tpl_vars['list']['value']; ?>
">
            </td>
        </tr>
        <?php endif; ?>
        
        <?php if ($this->_tpl_vars['list']['type'] == 2): ?>
        <tr bgcolor="#66a4d3">
          <td valign="middle" align="left"><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
          <td>
          	<i><?php echo $this->_tpl_vars['list']['description']; ?>
</i><br>
            <textarea style="width:100%;height:200px" name="<?php echo $this->_tpl_vars['list']['name']; ?>
"><?php echo $this->_tpl_vars['list']['value']; ?>
</textarea>
          </td>
        </tr>
        <?php endif; ?>
        
        <?php if ($this->_tpl_vars['list']['type'] == 3): ?>
        <tr bgcolor="#66a4d3">
          <td valign="middle" align="left"><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
          <td>
          	<table cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td><input type="checkbox" class="checkbox" <?php if ($this->_tpl_vars['list']['value'] == 1): ?>checked<?php endif; ?> name="<?php echo $this->_tpl_vars['list']['name']; ?>
" value="1"></td>
                <td nowrap>&nbsp;<i><?php echo $this->_tpl_vars['list']['description']; ?>
</i></td>
              </tr>
            </table>
            </td>
        </tr>
        <?php endif; ?>