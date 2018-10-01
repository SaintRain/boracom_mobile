<?php /* Smarty version 2.6.26, created on 2014-12-07 13:59:31
         compiled from administrators/administrators_form_edit.tpl */ ?>
<?php echo ' 
<script language="JavaScript">
function Mysubmit(form) {
	s=form.login.value;
	if (s==\'\') {
		'; ?>

		form.login.focus(); alert("<?php echo $this->_tpl_vars['MSGTEXT']['enter_login']; ?>
"); return false
		<?php echo '
	};
	s=form.email.value;
	if (s.indexOf(\'@\',0)==-1) {form.email.focus(); '; ?>
alert("<?php echo $this->_tpl_vars['MSGTEXT']['incorrect_email']; ?>
");<?php echo ' return false};
	s=form.password.value;
	s2=form.password2.value;
	if (s!=s2) {form.password2.focus(); '; ?>
alert("<?php echo $this->_tpl_vars['MSGTEXT']['pas_is_different']; ?>
");<?php echo ' return false};
	if (s==\'\') {
		form.password.focus(); '; ?>
alert("<?php echo $this->_tpl_vars['MSGTEXT']['type_password']; ?>
");<?php echo ' return false
	};
	return true;
}
</script> 
'; ?>

<form id="data form" action="?act=administrators&do=saveedit&id=<?php echo $this->_tpl_vars['id']; ?>
" method="POST" onsubmit="return Mysubmit(this)" style="margin:0">
  <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
  <input type="hidden" name="old_password" value="<?php echo $this->_tpl_vars['password']; ?>
" >
  <table class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
	<table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
	<tr>
	<td>      
      <table class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td><?php echo $this->_tpl_vars['MSGTEXT']['login']; ?>
: </td>
            <td><input type="text" style="width:300px; background-color:#DBDBDB" readonly name="login" value="<?php echo $this->_tpl_vars['login']; ?>
"></td>
          </tr>
          <tr>
            <td><?php echo $this->_tpl_vars['MSGTEXT']['email']; ?>
: <font color="Yellow">*</font></td>
            <td><input type="text" style="width:300px" name="email" value="<?php echo $this->_tpl_vars['email']; ?>
"></td>
          </tr>
          <tr>
            <td><?php echo $this->_tpl_vars['MSGTEXT']['password']; ?>
: <font color="Yellow">*</font></td>
            <td><input type="password" style="width:300px" name="password" ></td>
          </tr>
          <tr>
            <td><?php echo $this->_tpl_vars['MSGTEXT']['confirmation']; ?>
: <font color="Yellow">*</font></td>
            <td><input type="password" style="width:300px" name="password2"></td>
          </tr>
          <tr>
            <td>            
            <a href="index.php?act=administrators&do=group_edit"><?php echo $this->_tpl_vars['MSGTEXT']['group']; ?>
</a>: <font color="Yellow">*</font></td>
            <td><select name="group_id" style="width:300px">
                <option style="color:gray" value="0"><?php echo $this->_tpl_vars['MSGTEXT']['superadmin']; ?>

                <?php $_from = $this->_tpl_vars['admin_groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
                <option <?php if ($this->_tpl_vars['group']['id'] == $this->_tpl_vars['group_id']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['group']['id']; ?>
"><?php echo $this->_tpl_vars['group']['name']; ?>
</option>                
				<?php endforeach; endif; unset($_from); ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $this->_tpl_vars['MSGTEXT']['your_ip']; ?>
 </td>
            <td align="left">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><input type="text" style="width:150px;" name="ip" value="<?php echo $this->_tpl_vars['ip']; ?>
"></td>
                  <td width="10px"></td>
                  <td><input type="checkbox"  name="check_ip" <?php if ($this->_tpl_vars['check_ip'] == 1): ?> checked <?php endif; ?> value="1"></td>
                  <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['check_ip']; ?>
</td>
                </tr>
              </table>
              </td>
          </tr>
          
          <tr>
            <td></td>
            <td>
			  <table border="0" cellpadding="0" cellspacing="0">
                <tr>                  
                  <td><input type="checkbox" class="checkbox" name="read_only" <?php if ($this->_tpl_vars['read_only'] == 1): ?> checked <?php endif; ?> value="1"></td>
                  <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['read_only']; ?>
</td>
                </tr>
              </table>            
            </td>
          </tr>          
          
          <tr>
            <td colspan="100%" height="10px"></td>            
          </tr>
                    
          <tr>
            <td></td>
            <td><input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['save']; ?>
" style="width:130px"/></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
  </td>
  </tr>
 </table>
</form>