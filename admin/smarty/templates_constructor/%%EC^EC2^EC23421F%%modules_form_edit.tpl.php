<?php /* Smarty version 2.6.26, created on 2014-09-14 09:30:22
         compiled from modules_forms/modules_form_edit.tpl */ ?>
<form action="?act=m_c&do=saveedit" method="POST" style="margin:0">
  <input name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" type="hidden">
  <p style="margin-bottom:10"><font color="Yellow"><?php echo $this->_tpl_vars['message']; ?>
</font></p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td><table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td><table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td> <?php echo $this->_tpl_vars['MSGTEXT']['modules_form_edit_name']; ?>
<br>
                    <input type="text" name="name" style="width:100%;" value="<?php echo $this->_tpl_vars['name']; ?>
"></td>
                </tr>
                <tr>
                  <td> <?php echo $this->_tpl_vars['MSGTEXT']['modules_form_edit_version']; ?>
<br>
                    <input type="text" name="version" style="width:100%;" value="<?php echo $this->_tpl_vars['version']; ?>
"></td>
                </tr>
                <tr>
                  <td> <?php echo $this->_tpl_vars['MSGTEXT']['modules_form_edit_des']; ?>
<br>
                    <textarea name="description" style="width:100%;" rows="4"><?php echo $this->_tpl_vars['description']; ?>
</textarea>
                <tr>
                  <td height="10px"></td>
                </tr>
                <tr>
                  <td><input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['modules_form_edit']; ?>
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