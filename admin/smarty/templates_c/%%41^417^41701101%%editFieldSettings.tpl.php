<?php /* Smarty version 2.6.26, created on 2018-09-14 07:54:53
         compiled from editFieldSettings.tpl */ ?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo $this->_tpl_vars['MSGTEXT']['editField_title']; ?>
 «<?php echo $this->_tpl_vars['field']['fieldname']; ?>
», <?php echo $this->_tpl_vars['MSGTEXT']['editField_title2']; ?>
 «<?php echo $this->_tpl_vars['table_name']; ?>
»</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="css/general.css" type="text/css" rel="stylesheet">
</head>
<?php echo '
<script language="JavaScript">
var pred_id;


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


function setcolor(id) {
	obj=GetElementById(id);
	obj.style.background=\'#FFF2BE\';
	if (pred_id && pred_id!=id) {
		obj=GetElementById(pred_id);
		obj.style.background=\'white\';
	}
	pred_id=id;
}


function unsetcolor(obj) {
	obj.style.background=\'white\';
}


function set_other_regular() {
	obj = GetElementById(\'regex_other\');
	obj2 = GetElementById(\'check_regular_id\');
	reg_id = obj2.options[obj2.selectedIndex].value;
	if (reg_id==-1 || reg_id==-2) disp=\'block\';
	else disp=\'none\';

	obj.style.display=disp;
}
</script>
'; ?>


<body bgcolor="#BED4F4">
<?php if ($_GET['f_id']): ?>
<table style="width:100%;" bgcolor="#86bae0" height="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
  <td>
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="2" valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['editField_sett_field']; ?>
 <b>«<?php echo $this->_tpl_vars['field']['fieldname']; ?>
»</b> <?php echo $this->_tpl_vars['MSGTEXT']['editField_in_table']; ?>
 <b>«<?php echo $this->_tpl_vars['table_name']; ?>
»</b>
  </tr>
  <tr>
  <td colspan="2" height="300px" valign="top">
  <form id="editForm" action="ajax.php?func=save_fsettings" method="POST" style="margin:0px">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['field']['id']; ?>
">
    <table width="100%" cellpadding="2" cellspacing="1" border="0" bgcolor="White">
      <tbody>
        <tr style="height:23px" ><td width="200px" bgcolor="#BED4F4" width="160px">
          <?php echo $this->_tpl_vars['MSGTEXT']['editField_name_field']; ?>

      </td>
      <td bgcolor="#CBDCF0" colspan="2"><b><?php echo $this->_tpl_vars['field']['fieldname']; ?>
</td>
      </tr>
      <tr style="height:23px">
        <td bgcolor="#BED4F4" width="160px"><?php echo $this->_tpl_vars['MSGTEXT']['editField_description']; ?>
</td>
        <td bgcolor="#CBDCF0" colspan="2"><?php echo $this->_tpl_vars['field']['comment']; ?>
</td>
      </tr>
      <tr style="height:23px">
        <td bgcolor="#BED4F4" width="160px"><?php echo $this->_tpl_vars['MSGTEXT']['editField_type_edited']; ?>
</td>
        <td bgcolor="#CBDCF0" colspan="2"><b><?php if ($this->_tpl_vars['field']['edittype']): ?><?php echo $this->_tpl_vars['field']['edittype']; ?>
<?php else: ?><font color="white"><?php echo $this->_tpl_vars['MSGTEXT']['editField_no_edit']; ?>
</font><?php endif; ?></td>
      </tr>
      <tr style="height:23px" id="tr<?php echo $this->_tpl_vars['k']; ?>
">
        <td bgcolor="#BED4F4"><?php echo $this->_tpl_vars['MSGTEXT']['editField_ability_edit']; ?>
</td>
        <td align="left"><table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><input <?php if ($this->_tpl_vars['field']['auto_incr'] == 1): ?> disabled <?php endif; ?> onfocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" value="1" <?php if ($this->_tpl_vars['field']['active'] == 1): ?>checked<?php endif; ?> type="checkbox" class="checkbox" name="active"></td>
            </tr>
          </table>
          </td>
      </tr>
      <?php $this->assign('k', $this->_tpl_vars['k']+1); ?>
      <tr style="height:23" id="tr<?php echo $this->_tpl_vars['k']; ?>
">
        <td bgcolor="#BED4F4"><?php echo $this->_tpl_vars['MSGTEXT']['editField_field_in_filter']; ?>
</td>
        <td align="left">
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><input <?php if (( $this->_tpl_vars['field']['edittype_id'] == 14 || $this->_tpl_vars['field']['edittype_id'] == 15 ) || ( $this->_tpl_vars['field']['sourse_field_id'] == 0 && $this->_tpl_vars['field']['edittype_id'] <> 5 && $this->_tpl_vars['field']['datatype_id'] != 24 && $this->_tpl_vars['field']['datatype_id'] != 25 && $this->_tpl_vars['field']['datatype_id'] != 4 && $this->_tpl_vars['field']['datatype_id'] != 12 && $this->_tpl_vars['field']['datatype_id'] != 13 )): ?> disabled <?php endif; ?> onfocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" value="1" <?php if ($this->_tpl_vars['field']['filter'] == 1): ?>checked<?php endif; ?> type="checkbox" class="checkbox" name="filter"></td>              
            </tr>
          </table>
          </td>
      </tr>
      <?php $this->assign('k', $this->_tpl_vars['k']+1); ?>
      <tr style="height:23px" id="tr<?php echo $this->_tpl_vars['k']; ?>
" >
        <td bgcolor="#BED4F4"><?php echo $this->_tpl_vars['MSGTEXT']['editField_print_fields']; ?>
</td>
        <td align="left">
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><input onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" value="1" <?php if ($this->_tpl_vars['field']['show_in_list'] == 1): ?>checked<?php endif; ?> type="checkbox" class="checkbox" name="show_in_list"></td>
            </tr>
          </table>
          </td>
      </tr>
      <?php $this->assign('k', $this->_tpl_vars['k']+1); ?>
      <tr style="height:23px" id="tr<?php echo $this->_tpl_vars['k']; ?>
">
      <td bgcolor="#BED4F4"><?php echo $this->_tpl_vars['MSGTEXT']['editField_cheking_filling']; ?>
</td>
      <td align="left">      
      <table cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td><select onChange="set_other_regular()" <?php if ($this->_tpl_vars['field']['edittype_id'] == 5): ?>disabled<?php endif; ?> onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" name="check_regular_id" id="check_regular_id" style="width:290px">
              <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['editField_no_checking']; ?>
</option>              
			<?php $_from = $this->_tpl_vars['check_regular']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['reg']):
?>
              <option <?php if ($this->_tpl_vars['reg']['id'] == $this->_tpl_vars['field']['check_regular_id']): ?>selected <?php endif; ?> value="<?php echo $this->_tpl_vars['reg']['id']; ?>
"><?php echo $this->_tpl_vars['reg']['name']; ?>
<?php endforeach; endif; unset($_from); ?>
              <option <?php if ($this->_tpl_vars['field']['check_regular_id'] == -1): ?>selected <?php endif; ?> value="-1" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['editField_other']; ?>
 &rarr;
              <option <?php if ($this->_tpl_vars['field']['check_regular_id'] == -2): ?>selected <?php endif; ?> value="-2" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['editField_allowed_file']; ?>
 &rarr;</option>
            </select>
          <td align="left"><input type="text" style="width:210px" name="regex_other" id="regex_other" style="width:180px;<?php if ($this->_tpl_vars['field']['check_regular_id'] > -1): ?>display:none<?php endif; ?>" value="<?php echo $this->_tpl_vars['field']['regex_other']; ?>
" title="<?php echo $this->_tpl_vars['MSGTEXT']['editField_other_exten']; ?>
"></td>
        </td>        
        </tr>        
      </table>
      </td>
      </tr>
      
      <?php if ($this->_tpl_vars['field']['edittype_id'] == 9 || $this->_tpl_vars['field']['edittype_id'] == 10): ?>      
      <?php $this->assign('k', $this->_tpl_vars['k']+1); ?>
      <tr style="height:20px" id="tr<?php echo $this->_tpl_vars['k']; ?>
">
        <td bgcolor="#BED4F4"><?php echo $this->_tpl_vars['MSGTEXT']['editField_avator']; ?>
</td>
        <td align="left"><table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><?php echo $this->_tpl_vars['MSGTEXT']['editField_avator_width']; ?>
</td>
              <td><?php echo $this->_tpl_vars['MSGTEXT']['editField_avator_height']; ?>
</td>
              <td><?php echo $this->_tpl_vars['MSGTEXT']['editField_avator_q']; ?>
</td>
            </tr>
            <tr>
              <td><input type="text" onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" value="<?php echo $this->_tpl_vars['field']['avator_width']; ?>
" name="avator_width" style="width:100px"></td>
              <td><input type="text" onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" value="<?php echo $this->_tpl_vars['field']['avator_height']; ?>
" name="avator_height" style="width:100px"></td>
              <td><input type="text" onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" value="<?php echo $this->_tpl_vars['field']['avator_quality']; ?>
" name="avator_quality" style="width:160px"></td>
            </tr>
          </table>
          </td>
      </tr>
      <?php $this->assign('k', $this->_tpl_vars['k']+1); ?>
      <tr style="height:20px" id="tr<?php echo $this->_tpl_vars['k']; ?>
" >
        <td bgcolor="#BED4F4"><?php echo $this->_tpl_vars['MSGTEXT']['editField_avator_big']; ?>
</td>
        <td align="left"><table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><?php echo $this->_tpl_vars['MSGTEXT']['editField_avator_width']; ?>
</td>
              <td><?php echo $this->_tpl_vars['MSGTEXT']['editField_avator_height']; ?>
</td>
              <td><?php echo $this->_tpl_vars['MSGTEXT']['editField_avator_q']; ?>
</td>
            </tr>
            <tr>
              <td><input type="text" onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" value="<?php echo $this->_tpl_vars['field']['avator_width_big']; ?>
" name="avator_width_big" style="width:100px"></td>
              <td><input type="text" onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" value="<?php echo $this->_tpl_vars['field']['avator_height_big']; ?>
" name="avator_height_big" style="width:100px"></td>
              <td><input type="text" onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" value="<?php echo $this->_tpl_vars['field']['avator_quality_big']; ?>
" name="avator_quality_big" style="width:160px"></td>
            </tr>
          </table>
          </td>
      </tr>
      <?php endif; ?>      
      
      <?php $this->assign('k', $this->_tpl_vars['k']+1); ?>
      <tr style="height:20px" id="tr<?php echo $this->_tpl_vars['k']; ?>
">
        <td bgcolor="#BED4F4"><?php echo $this->_tpl_vars['MSGTEXT']['editField_height']; ?>
</td>
        <td align="left">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><input type="text" onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" value="<?php echo $this->_tpl_vars['field']['height']; ?>
" name="height" style="width:500px"></td>
            </tr>
          </table>
          </td>
      </tr>
      <?php $this->assign('k', $this->_tpl_vars['k']+1); ?>
      <tr style="height:20px" id="tr<?php echo $this->_tpl_vars['k']; ?>
">
        <td bgcolor="#BED4F4"><?php echo $this->_tpl_vars['MSGTEXT']['editField_width']; ?>
</td>
        <td align="left">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><input type="text" onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" value="<?php echo $this->_tpl_vars['field']['width']; ?>
" name="width" style="width:500px"></td>
            </tr>
          </table>
          </td>
      </tr>
      <?php $this->assign('k', $this->_tpl_vars['k']+1); ?>
      <tr style="height:20px" id="tr<?php echo $this->_tpl_vars['k']; ?>
">
        <td bgcolor="#BED4F4"><?php echo $this->_tpl_vars['MSGTEXT']['editField_style']; ?>
</td>
        <td align="left">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><input type="text" onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" value="<?php echo $this->_tpl_vars['field']['style']; ?>
"name="style" style="width:500px"></td>
            </tr>
          </table>
          </td>
      </tr>
      <?php $this->assign('k', $this->_tpl_vars['k']+1); ?>
      <tr style="height:20px" id="tr<?php echo $this->_tpl_vars['k']; ?>
">
        <td bgcolor="#BED4F4" valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['editField_hide_field']; ?>
</td>
        <td align="left"><table cellpadding="0" width="100%" cellspacing="0" border="0">
            <tr>
              <td width="35%"><?php echo $this->_tpl_vars['MSGTEXT']['editField_field']; ?>
</td>
              <td width="20%"><?php echo $this->_tpl_vars['MSGTEXT']['editField_comparison']; ?>
</td>
              <td width="45%"><?php echo $this->_tpl_vars['MSGTEXT']['editField_value']; ?>
</td>
            </tr>
            <tr>
              <td valign="top"><select onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" name="hide_by_field" style="width:100%">
                  <option selected value="0" style="color:gray"> <?php echo $this->_tpl_vars['MSGTEXT']['editField_not_sepcified']; ?>

                  <?php $_from = $this->_tpl_vars['f_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['f']):
?>
                  <option <?php if ($this->_tpl_vars['field']['hide_by_field'] == $this->_tpl_vars['f']['id']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['f']['id']; ?>
"><?php echo $this->_tpl_vars['f']['fieldname']; ?>
</option>                  
				 <?php endforeach; endif; unset($_from); ?>
                </select></td>
              <td valign="top"><select onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" name="hide_operator" style="width:100%">
                  <option <?php if ($this->_tpl_vars['field']['hide_operator'] == 0): ?> selected <?php endif; ?> value="0">==</option>
                  <option <?php if ($this->_tpl_vars['field']['hide_operator'] == 5): ?> selected <?php endif; ?> value="5">!=</option>
                  <option <?php if ($this->_tpl_vars['field']['hide_operator'] == 1): ?> selected <?php endif; ?> value="1">></option>
                  <option <?php if ($this->_tpl_vars['field']['hide_operator'] == 2): ?> selected <?php endif; ?> value="2"><</option>
                  <option <?php if ($this->_tpl_vars['field']['hide_operator'] == 3): ?> selected <?php endif; ?> value="3">=></option>
                  <option <?php if ($this->_tpl_vars['field']['hide_operator'] == 4): ?> selected <?php endif; ?> value="4">=<</option>
                </select></td>
              <td valign="top"><textarea style="margin-top:0px" title="<?php echo $this->_tpl_vars['MSGTEXT']['editField_hide_field_title']; ?>
" onFocus="setcolor('tr<?php echo $this->_tpl_vars['k']; ?>
')" rows="3" name="hide_on_value" style="width:205px"><?php echo $this->_tpl_vars['field']['hide_on_value']; ?>
</textarea></td>
            </tr>
          </table>
          </td>
      </tr>
      </tbody>      
    </table>
    
    <br>
    <input type="submit" class="button" name="butedit" id="butedit" value="<?php echo $this->_tpl_vars['MSGTEXT']['editField_save']; ?>
" style="width:100px">
    &nbsp;&nbsp;
    <input type="button" class="button" name="butdelete" id="butdelete" onClick="window.close()" value="<?php echo $this->_tpl_vars['MSGTEXT']['editField_cancel']; ?>
" style="width:100px">
    &nbsp;&nbsp;
  </form>
  <?php else: ?>
  <br>
  <center>
    <h4><?php echo $this->_tpl_vars['MSGTEXT']['editField_info']; ?>
</h4>
  </center>
  <?php endif; ?>
</body>
</html>