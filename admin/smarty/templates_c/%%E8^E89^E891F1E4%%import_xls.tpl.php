<?php /* Smarty version 2.6.26, created on 2018-09-07 07:14:44
         compiled from import_xls.tpl */ ?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo $this->_tpl_vars['MSGTEXT']['import_xls_title']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="StyleSheet" href="css/general.css">
</head>
<body LEFTMARGIN="0pt" TOPMARGIN="0pt" bgcolor="#70a8d1">
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-image: url('images/zero.gif');"></td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>  
  <td>  
   <table class="formborder" border="0"  cellpadding="1" cellspacing="0" align="center">
    <tr><td>
    <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
    <tr><td>
      <table width="450px" style="height:170px" align="center" class="formbackground" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2" align="center"><p><b><?php echo $this->_tpl_vars['MSGTEXT']['import_xls_caption']; ?>
</b>
            <p> <?php if ($this->_tpl_vars['msgs']): ?>
            <p style='color:#b1ff88'><b><?php echo $this->_tpl_vars['msgs']; ?>
</p>
            <?php else: ?> <font color="Yellow"><?php echo $this->_tpl_vars['MSGTEXT']['import_xls_help']; ?>
</font>
            </p>
            <?php endif; ?></td>
        </tr>
        <?php if ($this->_tpl_vars['error']): ?>
        <tr>
          <td align="center" colspan="2"><p style="color:red"><?php echo $this->_tpl_vars['error']; ?>
</p></td>
        </tr>
        <?php endif; ?>
        <tr>
          <td align="center" valign="middle" width="130px"><img src="images/xls/excel.png" align="middle" border="0"><br>&nbsp;</td>
          <td align="left"><table align="left" border="0" cellpadding="1" cellspacing="0">
              <tr>
                <td align="right"><form action="import_xls.php?page_id=<?php echo $_GET['page_id']; ?>
&tag_id=<?php echo $_GET['tag_id']; ?>
&lang_id=<?php echo $this->_tpl_vars['lang_id']; ?>
&t_name=<?php echo $_GET['t_name']; ?>
" method="post" enctype="multipart/form-data">
                    <tr>
                        <td align="right"><input type="file" name="filename" style="width:200px"></td>
                      </tr>
                    <tr>
                        <td style="height:5px"></td>
                      </tr>
                    <tr>
                        <td align="left"><input type="submit" class="button" style="width:200px" value="<?php echo $this->_tpl_vars['MSGTEXT']['import_xls_load']; ?>
"></td>
                      </tr>
                  </form>
            </table>
        </tr>
        </td>        
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