<?php /* Smarty version 2.6.26, created on 2018-09-07 05:38:52
         compiled from login.tpl */ ?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo $this->_tpl_vars['MSGTEXT']['admin_login_cms']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="StyleSheet" href="css/general.css">
<?php echo '
<script language="JavaScript">
function CheckEnter(form) {
	s=document.forms[form].admin_login.value;
	if (s==\'\') {alert(\''; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['admin_login_type_login']; ?>
<?php echo '\'); return false};
	s=document.forms[form].admin_password.value;
	if (s==\'\') {alert(\''; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['admin_login_type_pass']; ?>
<?php echo '\'); return false};
	return true;
}

function set_lang(obj){
	location.href="main.php?lang="+obj.value;
}

//если сессия закончилась перенаправляем из фреймов на авторизацию
if (parent.frames.length>1) {
	parent.location=\'login.php\';
}
</script>
'; ?>

</head>
<body leftmargin="0px" topmargin="0px" bgcolor="#70a8d1">
<table style="height:218px; width:100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-image: url('images/zerro.gif');"></td>
  </tr>
</table>
<table border='0' cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td>
    <table align="center" cellpadding="1" cellspacing="0" bgcolor="#4D6E8A" border="0">
        <tr>
          <td>
          <div class="ten_light">
            <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
              <tr>
                <td>
                <table width="300px" style="height:170px" align="center" class="formbackground" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="2" align="center" nowrap><p><b> <a title="GoodCMS" style="text-decoration:none" href="http://www.goodcms.net" target="_blank"><?php echo $this->_tpl_vars['MSGTEXT']['admin_login_input_in_menu']; ?>
</b></a></p></td>
                    </tr>
                    <?php if ($this->_tpl_vars['error']): ?>
                    <tr>
                      <td align="center" colspan="2"><p style="color:yellow"><?php echo $this->_tpl_vars['error']; ?>
</p></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                      <td align="center" width="130px"><img width="100"  src="images/login.png" align="middle" border="0"></td>
                      <td align="left"><table align="left" border="0" cellpadding="1" cellspacing="0">
                          <tr>
                          <td>
                          
                          <form name="enter" action="<?php echo $this->_tpl_vars['host']; ?>
/<?php echo @SETTINGS_ADMIN_PATH; ?>
/login.php" method="post" onSubmit="return CheckEnter('enter')">
                            <input type="hidden" value="'" name="check_magic_quotes_gpc">
                            <input type="text" name="admin_login" maxlength='20' style="width:80px">
                            </td>
                            <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['admin_login_login']; ?>
</td>
                            </tr>
                            
                            <tr>
                              <td><input name="admin_password" maxlength='20' type="password" style="width:80px"></td>
                              <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['admin_login_pass']; ?>
</font></td>
                            </tr>
                            <tr>
                              <td><select onchange="set_lang(this)" name="lang" style="width:100%;">                                  
								<?php $_from = $this->_tpl_vars['langs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['langs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['langs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['file_name'] => $this->_tpl_vars['item']):
        $this->_foreach['langs']['iteration']++;
?>
                                  <option <?php if ($_GET['lang']): ?><?php if ($_GET['lang'] == $this->_foreach['langs']['iteration']): ?> selected <?php endif; ?><?php else: ?><?php if ($this->_tpl_vars['file_name'] == @SETTINGS_LANGUAGE): ?> selected <?php endif; ?><?php endif; ?> value="<?php echo $this->_foreach['langs']['iteration']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>                                  
								<?php endforeach; endif; unset($_from); ?>
                                </select></td>
                              <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['admin_login_lang']; ?>
</font></td>
                            </tr>
                            <tr>
                              <td nowrap align="center"><a style="font-size:11px" href="?act=forget_form<?php if ($_GET['lang']): ?>&lang=<?php echo $_GET['lang']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['admin_login_forgotten_pass']; ?>
</a></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td colspan="2" style="height:5px"></td>
                            </tr>
                            <tr>
                              <td><input type="submit" class="button" style="width:82px" value="<?php echo $this->_tpl_vars['MSGTEXT']['admin_login_enter']; ?>
"></td>
                              <td></td>
                            </tr>
                          </form>
                        </table>
                        </td>
                    </tr>
                  </table>
                  </td>
              </tr>
            </table>
            </td>
        </tr>
      </table>
      </div>
      </td>
  </tr>
</table>
</body>
</html>