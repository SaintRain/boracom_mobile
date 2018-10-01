<?php /* Smarty version 2.6.26, created on 2014-09-14 09:10:08
         compiled from install_step_2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'install_step_2.tpl', 39, false),)), $this); ?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo $this->_tpl_vars['MSGTEXT']['install_title']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="StyleSheet" href="../css/general.css">
</head>
<body  leftmargin="0px" topmargin="0px" bgcolor="#70a8d1">

<table  style="height:218px; width:100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-image: url('../images/m_font2.gif');"></td>
  </tr>
</table>
<table border='0' cellpadding="0" cellspacing="0"  width="100%">
    <tr>
    <td align="center">  
  <table>
     <tr>
     <td></td>
     <td>         
     <div class="ten">
     <table align="center" cellpadding="1" cellspacing="0" bgcolor="#4D6E8A" border="0">
        <tr>
        <td>        
	<table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
	<tr>
	<td>              
      <table width="600px" style="height:170px" align="center" class="formbackground" border="0"  cellpadding="0" cellspacing="0">
          <tr>
          <td align="center">        
        <table  border="0" cellpadding="1" cellspacing="1"  width="100%">
          <tr>
            <td colspan="2" align="center"><center>
                <a href="http://www.goodcms.net" target="_blank"><img align="middle" src="images/install.png" border="0"></a>
              </center>
              <p style='margin-left:20px; margin-top:10px; margin-bottom:10px;font-size:18px'><b><?php echo ((is_array($_tmp=@CMS_VERSION)) ? $this->_run_mod_handler('string_format', true, $_tmp, $this->_tpl_vars['MSGTEXT']['install_s']) : smarty_modifier_string_format($_tmp, $this->_tpl_vars['MSGTEXT']['install_s'])); ?>
</p></td>
          </tr>
          <?php if ($this->_tpl_vars['errors']): ?>
          <tr>
            <td colspan="2" align="center">
            	<table border="0" cellpadding="1" cellspacing="1">
            	<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            		<tr><td style="color:yellow"><?php echo $this->_tpl_vars['item']; ?>
</td></tr>            
              	<?php endforeach; endif; unset($_from); ?>
              	</table>
              </td>
          </tr>
          <?php endif; ?>
            <tr>
          <td></td>
            <td>          
          <table border="0" cellpadding="1" cellspacing="1"  width="100%">
            <form style="margin:0" name="enter" action="" method="post">
              <input name="install" value="1" type="hidden">
              <input name="lang" value="<?php echo $this->_tpl_vars['lang']; ?>
" type="hidden">
              <input name="slashes" value="'" type="hidden">
              <input name="step" value="2" type="hidden">
                                           
              <tr>
                <td colspan="100%" height="10px"><i><?php echo $this->_tpl_vars['MSGTEXT']['install_s_connect']; ?>
</i></td>
              </tr>
              <tr>
                </td>
              <td width="190px"><?php echo $this->_tpl_vars['MSGTEXT']['install_s_host']; ?>
&nbsp;<font color="yellow">*</font></td>
              <td width="100%"><input type="text" name="host" style="width: 100%" value="<?php if ($this->_tpl_vars['host']): ?><?php echo $this->_tpl_vars['host']; ?>
<?php else: ?>localhost<?php endif; ?>"></td>
                </tr>              
              <tr>
                <td><?php echo $this->_tpl_vars['MSGTEXT']['install_s_bdname']; ?>
&nbsp;<font color="yellow">*</font></td>
                <td width="100%"><input type="text" name="base" value="<?php echo $this->_tpl_vars['base']; ?>
"  style="width: 100%">
              </tr>
              <tr>
                <td><?php echo $this->_tpl_vars['MSGTEXT']['install_s_bdlogin']; ?>
&nbsp;<font color="yellow">*</font></td>
                <td><input type="text" name="login"  value="<?php echo $this->_tpl_vars['login']; ?>
" style="width: 100%"></td>
              <tr>
                <td><?php echo $this->_tpl_vars['MSGTEXT']['install_s_bdpassword']; ?>
&nbsp;<font color="yellow">*</font></td>
                <td><input name="password" id="password"  type="password" value="<?php echo $this->_tpl_vars['password']; ?>
" style="width: 100%"></td>
                <?php if ($this->_tpl_vars['ftp_enable']): ?>
              <tr>
                <td colspan="100%" height="10px"></td>
              </tr>
              <tr>
                <td colspan="100%" height="10px"><i><?php echo $this->_tpl_vars['MSGTEXT']['install_s_connect_ftp']; ?>
</i></td>
              </tr>
              <tr>
                <td nowrap><?php echo $this->_tpl_vars['MSGTEXT']['install_s_ftp_host']; ?>
&nbsp;</td>
                <td><input type="text" name="ftp_host"  value="<?php echo $this->_tpl_vars['ftp_host']; ?>
" style="width: 100%"></td>
              <tr>
                <td nowrap><?php echo $this->_tpl_vars['MSGTEXT']['install_s_ftp_login']; ?>
&nbsp;</td>
                <td><input type="text" name="ftp_login"  value="<?php echo $this->_tpl_vars['ftp_login']; ?>
" style="width: 100%"></td>
              <tr>
                <td nowrap><?php echo $this->_tpl_vars['MSGTEXT']['install_s_ftp_password']; ?>
&nbsp;</td>
                <td><input name="ftp_password"  value="<?php echo $this->_tpl_vars['ftp_password']; ?>
" type="password" style="width:100%"></td>
              </tr>
              <?php endif; ?>
              <tr>
                <td colspan="100%" height="10px"></td>
              </tr>
              <tr>
                <td colspan="100%" height="10px"><i><?php echo $this->_tpl_vars['MSGTEXT']['install_s_admin']; ?>
</i></td>
              </tr>
              <tr>
                <td nowrap><?php echo $this->_tpl_vars['MSGTEXT']['install_s_admin_login']; ?>
&nbsp;<font color="yellow">*</font></td>
                <td><input type="text" name="admin_login"  value="<?php echo $this->_tpl_vars['admin_login']; ?>
" style="width:100%"></td>
              <tr>
                <td nowrap><?php echo $this->_tpl_vars['MSGTEXT']['install_s_admin_password']; ?>
&nbsp;<font color="yellow">*</font></td>
                <td><input name="admin_password"  value="<?php echo $this->_tpl_vars['admin_password']; ?>
" type="password" style="width: 100%"></td>
              <tr>
                <td nowrap><?php echo $this->_tpl_vars['MSGTEXT']['install_s_admin_password_retype']; ?>
&nbsp;<font color="yellow">*</font></td>
                <td><input name="admin_password2"  value="<?php echo $this->_tpl_vars['admin_password2']; ?>
" type="password" style="width: 100%"></td>
              <tr>
                <td nowrap><?php echo $this->_tpl_vars['MSGTEXT']['install_s_admin_email']; ?>
&nbsp;<font color="yellow">*</font></td>
                <td><input type="text" name="admin_email"  value="<?php echo $this->_tpl_vars['admin_email']; ?>
" style="width: 100%"></td>
              </tr>
              <tr>
                <td colspan="100%" height="10px"></td>
              </tr>              
    		 <tr>
                <td colspan="100%" height="10px"><i><?php echo $this->_tpl_vars['MSGTEXT']['install_s_type']; ?>
</i></td>
              </tr>
              <tr>
                </td>
              <td width="190px"></td>
              <td width="100%">              
                 <table border="0" cellpadding="1" cellspacing="1">
                 <tr><td  valign="middle"><input style="margin:0px" name="type" type="radio" <?php if ($this->_tpl_vars['type'] == 0): ?>checked<?php endif; ?> value="0"></td><td valign="middle">&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['install_s_type_demo']; ?>
</td></tr>
                 <tr><td  valign="middle"><input style="margin:0px" name="type" type="radio" <?php if ($this->_tpl_vars['type'] == 1): ?>checked<?php endif; ?> value="1"></td><td  valign="middle">&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['install_s_type_empty']; ?>
</td></tr>              
              	 </table>
              </td>
                </tr>                
             <tr>
                <td colspan="100%" height="10px"></td>
              </tr>               
              <tr>
                <td></td>
                <td align="left"><input type="button" onclick="location.href='/admin/install'" class="button" style="width: 80px" value="<?php echo $this->_tpl_vars['MSGTEXT']['install_s_back']; ?>
">
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="submit" class="button" style="width: 80px" value="<?php echo $this->_tpl_vars['MSGTEXT']['install_s_go']; ?>
"></td>
              </tr>
              <tr>
                <td colspan="100%" height="10px"></td>
              </tr>
            </form>
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
      </table>
        </tr>      
        </td>      
    </table>
      </td>
      </tr>    
  </table>
    </td>
    </tr>  
</table>
</body>
</html>