<?php /* Smarty version 2.6.26, created on 2014-09-14 09:10:29
         compiled from installation_completed.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'installation_completed.tpl', 36, false),)), $this); ?>
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
<body  LEFTMARGIN="0px" TOPMARGIN="0px" bgcolor="#70a8d1">

<table  style="height:218px; width:100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-image: url('../images/m_font2.gif');"></td>
  </tr>
</table>
<table border='0' cellpadding="0" cellspacing="0"  width="100%">
    <tr>
    <td>  
    
    
  <table align="center" cellpadding="1" cellspacing="0" bgcolor="#4D6E8A" border="0">
    <tr><td>            
    <div class="ten">
	<table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
	<tr>
	<td>  
      <table width="600px" style="height:170px" align="center" class="formbackground" border="0"  cellpadding="0" cellspacing="0">
        <tr>
          <td align="center">
          <table border="0" cellpadding="1" cellspacing="1"  width="450px">
              <tr>
                <td colspan="2" align="center" ><center>
                  <a href="http://www.goodcms.net" target="_blank"><img align="middle" src="images/install.png" border="0"></a>
                  </center>
                  <p style='margin-left:20px; margin-top:10px; margin-bottom:10px'> <?php echo ((is_array($_tmp=@CMS_VERSION)) ? $this->_run_mod_handler('string_format', true, $_tmp, $this->_tpl_vars['MSGTEXT']['install_is_completed']) : smarty_modifier_string_format($_tmp, $this->_tpl_vars['MSGTEXT']['install_is_completed'])); ?>

                  <a href="<?php echo $this->_tpl_vars['http_host']; ?>
/admin"><?php echo $this->_tpl_vars['MSGTEXT']['install_s_enter']; ?>
</a>                  
                   <br><br>
                    <?php echo $this->_tpl_vars['MSGTEXT']['install_s_admin_login']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $this->_tpl_vars['admin_login']; ?>
</b><br>
                    <?php echo $this->_tpl_vars['MSGTEXT']['install_s_admin_password']; ?>
&nbsp;&nbsp;<b><?php echo $this->_tpl_vars['admin_password']; ?>
</b> </td>
              </tr>
            </table>
        	</tr>
          </td>        
      </table>
      </div>
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