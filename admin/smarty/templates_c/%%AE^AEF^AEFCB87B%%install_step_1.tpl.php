<?php /* Smarty version 2.6.26, created on 2014-09-14 09:10:06
         compiled from install_step_1.tpl */ ?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">	
<html>
<head>
<title>GoodCMS INSTALL</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="favicon.ico" type="image/x-icon"> 
<link type="text/css" rel="StyleSheet" href="../css/general.css">
</head>
<form style="margin:0;" name="enter" action="" method="post" >
<input name="step" value="2" type="hidden">
<input name="slashes" value="\'" type="hidden">
<body  LEFTMARGIN="0pt" TOPMARGIN="0pt"  bgcolor="#70a8d1">

<table  style="height:218px; width:100%" border="0" cellpadding="0" cellspacing="0">
<tr><td style="background-image: url(\'../images/m_font2.gif\');"></td></tr>
</table>

<table border="0" cellpadding="0" cellspacing="0"  width="100%">
<tr><td>

<table align="center" cellpadding="1" cellspacing="0" bgcolor="#4D6E8A" border="0">
<tr><td>
<div class="ten_light">
<table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
<tr>
<td>

<table width="300px" style="height:170px" align="center" class="formbackground" border="0" cellpadding="0" cellspacing="0">
<tr><td align="center">

<table  border="0" cellpadding="1" cellspacing="1" width="600px">
<tr><td colspan="2" align="center"><center>
<a href="http://www.goodcms.net" target="_blank"><img align="middle" src="images/install.png" border="0"></a>
</center><br><br>&nbsp;
<table  border="0" cellpadding="0" cellspacing="0">
<tr><td>
<select style="width:150px;height:20px" name="lang">  
<?php $_from = $this->_tpl_vars['langs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lang_key'] => $this->_tpl_vars['lang']):
?>
<option value='<?php echo $this->_tpl_vars['lang_key']; ?>
'><?php echo $this->_tpl_vars['lang']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
<td align=center>&nbsp;<input class="button" style="width:30px;height:20px" type=submit value="GO"></td></tr>
</table>
</div>
</td></tr></table>


</tr>
</td>
</table>

</td></tr>
</table>

</td>
</tr>
</table>

</td>
</tr>
</table>
</body
</form>
</html>