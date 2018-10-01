<?php /* Smarty version 2.6.26, created on 2015-08-05 07:47:11
         compiled from forget_send_result.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
    "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title><?php echo $this->_tpl_vars['MSGTEXT']['forget_send_login_cms']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="StyleSheet" href="css/general.css">
</head>
<body LEFTMARGIN="0pt" TOPMARGIN="0pt" bgcolor="#70a8d1">
<table style="height:218px; width:100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td></td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td><form action="?act=forget_send" method="POST" onsubmit="return Mysubmit(this)">
        <table align="center" class="formborder" border="0" cellpadding="1" cellspacing="0">
          <tr>
            <td><div class="ten_light">
                <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
                  <tr>
                    <td><table width="300" style="height:170px" align="center" class="formbackground" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="center"><table class="formbackground" border="0" cellpadding="2" cellspacing="2">
                              <tr>
                                <td align="center"> <?php if ($this->_tpl_vars['send_result'] == 0): ?><?php echo $this->_tpl_vars['MSGTEXT']['forget_send_error_send']; ?>
<br>
                                  <a style="font-size:12;" href="index.php"><?php echo $this->_tpl_vars['MSGTEXT']['forget_send_back']; ?>
</a><?php endif; ?>
                                  <?php if ($this->_tpl_vars['send_result'] == 1): ?><?php echo $this->_tpl_vars['MSGTEXT']['forget_send_message_send']; ?>
<br>
                                  <a style="font-size:12;" href="index.php"><?php echo $this->_tpl_vars['MSGTEXT']['forget_send_login']; ?>
</a><?php endif; ?>
                                  <?php if ($this->_tpl_vars['send_result'] == 2): ?><?php echo $this->_tpl_vars['MSGTEXT']['forget_send_incorect_email']; ?>
<br>
                                  <a style="font-size:12;" href="index.php"><?php echo $this->_tpl_vars['MSGTEXT']['forget_send_back']; ?>
</a><?php endif; ?>
                                  <?php if ($this->_tpl_vars['send_result'] == 3): ?><?php echo $this->_tpl_vars['MSGTEXT']['forget_send_incorrect_kode']; ?>
<br>
                                  <a style="font-size:12;" href="index.php"><?php echo $this->_tpl_vars['MSGTEXT']['forget_send_back']; ?>
</a><?php endif; ?></td>
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
      </form>
      </td>
  </tr>
</table>
</td>
</tr>
</table>
</body>
</html>