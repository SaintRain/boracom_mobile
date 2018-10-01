<?php /* Smarty version 2.6.26, created on 2018-09-19 05:30:48
         compiled from /var/www/admin/templates/global_error_handler.tpl */ ?>
<br>
&nbsp;
<table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#dcdcdc" border="0">
  <tr>
    <td><table width="100%" cellpadding="3" cellspacing="1" border="0">
        <tr bgcolor="White">
          <td colspan="100%" align="center">
              <table align="center" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td width="20px" valign="middle"><img  src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/images/bug.png" border="0" hspace="10"></td>
                <td valign="middle"><b style="color:red;font-size:18px"><b><?php echo $this->_tpl_vars['title_error']; ?>
</b></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="White">
          <td><b style="color:#8e8e8e"><?php echo $this->_tpl_vars['MSGTEXT']['e_handle_code']; ?>
&nbsp;</b></td>
          <td><b style="color:#8e8e8e"><?php echo $this->_tpl_vars['MSGTEXT']['e_handle_type']; ?>
</b>&nbsp;</td>
          <td><b style="color:#8e8e8e"><?php echo $this->_tpl_vars['MSGTEXT']['e_handle_description']; ?>
</b></td>
        </tr>
        <?php $_from = $this->_tpl_vars['GLOBAL_ERRORS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
        <tr bgcolor="White">
          <td align="left" valign="top"><b style="color:#8e8e8e"><?php echo $this->_tpl_vars['error']['code']; ?>
</b></td>
          <td align="left" valign="top"><b style="color:black"><?php echo $this->_tpl_vars['error']['type']; ?>
</b></td>
          <td align="left" valign="top" style="color:black"><?php echo $this->_tpl_vars['error']['description']; ?>
</td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
      </table></td>
  </tr>
</table>
<br>
&nbsp; 