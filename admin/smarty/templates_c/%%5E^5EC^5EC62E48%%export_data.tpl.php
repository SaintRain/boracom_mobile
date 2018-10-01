<?php /* Smarty version 2.6.26, created on 2018-09-07 07:14:37
         compiled from export_data.tpl */ ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['MSGTEXT']['export_title']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="StyleSheet" href="css/general.css">
<script language="JavaScript">
<?php echo '
function GetElementById(id){
	if (document.getElementById) {
		return (document.getElementById(id));
	} else if (document.all) {
		return (document.all[id]);
	} else {
		if ((navigator.appname.indexOf("Netscape") != -1) && parseInt(navigator.appversion == 4)) {
			return (document.layers[id]);
		}
	}
}


function CheckAll(Element) {
	var thisCheckBoxes=GetElementById(\'data form\');
	for (var i = 1; i < thisCheckBoxes.length; i++) {
		if (thisCheckBoxes[i].type==\'checkbox\' && thisCheckBoxes[i].id!=Element.id) {
			thisCheckBoxes[i].checked = Element.checked;
		}
	}
}
'; ?>

</script>
</head>
<body LEFTMARGIN="0pt" TOPMARGIN="0pt" bgcolor="#70a8d1">
<br>
<table  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-image: url('images/zero.gif');"></td>
  </tr>
</table>
<table border='0' cellpadding="0" cellspacing="0" width="100%">
  <tr>
  <td>
  
  <table align="center" cellpadding="1" cellspacing="0" bgcolor="#4D6E8A" border="0">
    <tr><td>
      <table width="450px" style="height:170px" align="center" class="formbackground" border="0" cellpadding="5" cellspacing="0">
        <tr>
          <td colspan="2" align="center"><p><b><?php echo $this->_tpl_vars['export_caption']; ?>
</b>
            <p> <?php if ($this->_tpl_vars['msgs']): ?>
            <p style=' color:#b1ff88'><b><?php echo $this->_tpl_vars['msgs']; ?>
</p>
            <?php endif; ?> </td>
        </tr>
        <?php if ($this->_tpl_vars['error']): ?>
        <tr>
          <td align="center" colspan="3"><p style=' color:red'><?php echo $this->_tpl_vars['error']; ?>
</p></td>
        </tr>
        <?php endif; ?>
        <tr>
          <td align="left">
          <form id="data form" action="export_data.php?saveExportSettings=true&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&mdo=form_data&p=<?php echo $this->_tpl_vars['p_num']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
&hide_menu=true&lang_id=<?php echo $this->_tpl_vars['lang_id']; ?>
<?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table']['table_name']; ?>
&create_report=true" method="post" enctype="multipart/form-data">
              <table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="left"  valign="middle" width="10px"><input id="select_all" onClick="CheckAll(this)" type="checkbox" value="1" ></td>
                  <td colspan="2" width="100%" align="left" valign="middle">&nbsp;<b><?php echo $this->_tpl_vars['MSGTEXT']['export_sel_all_fields']; ?>
</b></td>
                </tr>
                <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <?php if (( $this->_tpl_vars['item']['active'] || $this->_tpl_vars['item']['fieldname'] == 'id' ) && $this->_tpl_vars['item']['edittype_id'] != 12 && $this->_tpl_vars['item']['edittype_id'] != 10 && $this->_tpl_vars['item']['edittype_id'] != 7 && $this->_tpl_vars['item']['edittype_id'] != 8): ?>
                <tr style="height:20px">
                  <td align="left"  valign="middle" width="15px"><input <?php if (isset ( $this->_tpl_vars['item']['export_this_field'] )): ?> checked <?php endif; ?> value="1" type="checkbox" name="<?php echo $this->_tpl_vars['item']['fieldname']; ?>
"></td>
                  <td align="left" valign="middle" nowrap>&nbsp;<?php echo $this->_tpl_vars['item']['comment']; ?>
</td>
                  <td align="left" valign="middle" width="100%" nowrap>
                  <?php if ($this->_tpl_vars['item']['edittype_id'] == 3 || $this->_tpl_vars['item']['edittype_id'] == 4 || $this->_tpl_vars['item']['edittype_id'] == 5 || $this->_tpl_vars['item']['edittype_id'] == 6): ?>
                    <table align="left" border="0" cellpadding="0" cellspacing="0">
                	<tr>
						<td>&nbsp;&nbsp;<input <?php if ($this->_tpl_vars['fieldsSettings'][$this->_tpl_vars['item']['fieldname']]['show_id']): ?> checked <?php endif; ?> value="1" type="checkbox" name="<?php echo $this->_tpl_vars['item']['fieldname']; ?>
+id"><td>
						<td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['export_show_id']; ?>
</td>
					</tr>
					</table>
                  <?php endif; ?>
                  </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                <tr>
                  <td colspan="3" height="10px"></td>
                </tr>
                <tr>
                  <td colspan="3">
                  <table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td><?php echo $this->_tpl_vars['MSGTEXT']['export_format']; ?>
&nbsp;</td>
                        <td><select name="report_type">
                            <option value="html_report">Html</option>
                            <option value="csv_report">Excel .csv</option>
                          </select></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td colspan="3" style="height:10px"></td>
                </tr>
                <tr>
                  <td colspan="3" style="height:1px" bgcolor="#558ab1"></td>
                </tr>
                <tr>
                  <td colspan="3" style="height:5px"></td>
                </tr>
                <tr>
                  <td colspan="3" align="center"><input type="submit" class="button" style="width:200px" value="<?php echo $this->_tpl_vars['MSGTEXT']['export_button']; ?>
"></td>
                </tr>
              </table>
            </form>
        </tr>
        </td>        
      </table>
    </td>
    </tr>    
  </table>
  </td>
  </tr>
</table>
<br>
&nbsp;
</body>
</html>