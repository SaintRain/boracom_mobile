<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>{$MSGTEXT.editField_title} «{$field.fieldname}», {$MSGTEXT.editField_title2} «{$table_name}»</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="css/general.css" type="text/css" rel="stylesheet">
</head>
{literal}
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
	obj.style.background='#FFF2BE';
	if (pred_id && pred_id!=id) {
		obj=GetElementById(pred_id);
		obj.style.background='white';
	}
	pred_id=id;
}


function unsetcolor(obj) {
	obj.style.background='white';
}


function set_other_regular() {
	obj = GetElementById('regex_other');
	obj2 = GetElementById('check_regular_id');
	reg_id = obj2.options[obj2.selectedIndex].value;
	if (reg_id==-1 || reg_id==-2) disp='block';
	else disp='none';

	obj.style.display=disp;
}
</script>
{/literal}

<body bgcolor="#BED4F4">
{if $smarty.get.f_id}
<table style="width:100%;" bgcolor="#86bae0" height="100%" border="0" cellpadding="1" cellspacing="0">
<tr>
  <td>
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="2" valign="top">{$MSGTEXT.editField_sett_field} <b>«{$field.fieldname}»</b> {$MSGTEXT.editField_in_table} <b>«{$table_name}»</b>
  </tr>
  <tr>
  <td colspan="2" height="300px" valign="top">
  <form id="editForm" action="ajax.php?func=save_fsettings" method="POST" style="margin:0px">
    <input type="hidden" name="id" value="{$field.id}">
    <table width="100%" cellpadding="2" cellspacing="1" border="0" bgcolor="White">
      <tbody>
        <tr style="height:23px" ><td width="200px" bgcolor="#BED4F4" width="160px">
          {$MSGTEXT.editField_name_field}
      </td>
      <td bgcolor="#CBDCF0" colspan="2"><b>{$field.fieldname}</td>
      </tr>
      <tr style="height:23px">
        <td bgcolor="#BED4F4" width="160px">{$MSGTEXT.editField_description}</td>
        <td bgcolor="#CBDCF0" colspan="2">{$field.comment}</td>
      </tr>
      <tr style="height:23px">
        <td bgcolor="#BED4F4" width="160px">{$MSGTEXT.editField_type_edited}</td>
        <td bgcolor="#CBDCF0" colspan="2"><b>{if $field.edittype}{$field.edittype}{else}<font color="white">{$MSGTEXT.editField_no_edit}</font>{/if}</td>
      </tr>
      <tr style="height:23px" id="tr{$k}">
        <td bgcolor="#BED4F4">{$MSGTEXT.editField_ability_edit}</td>
        <td align="left"><table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><input {if $field.auto_incr==1} disabled {/if} onfocus="setcolor('tr{$k}')" value="1" {if $field.active==1}checked{/if} type="checkbox" class="checkbox" name="active"></td>
            </tr>
          </table>
          </td>
      </tr>
      {assign var='k' value=$k+1}
      <tr style="height:23" id="tr{$k}">
        <td bgcolor="#BED4F4">{$MSGTEXT.editField_field_in_filter}</td>
        <td align="left">
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><input {if  ($field.edittype_id==14 || $field.edittype_id==15) || ($field.sourse_field_id==0 && $field.edittype_id<>5  && $field.datatype_id!=24 && $field.datatype_id!=25 && $field.datatype_id!=4 && $field.datatype_id!=12 && $field.datatype_id!=13)} disabled {/if} onfocus="setcolor('tr{$k}')" value="1" {if $field.filter==1}checked{/if} type="checkbox" class="checkbox" name="filter"></td>              
            </tr>
          </table>
          </td>
      </tr>
      {assign var='k' value=$k+1}
      <tr style="height:23px" id="tr{$k}" >
        <td bgcolor="#BED4F4">{$MSGTEXT.editField_print_fields}</td>
        <td align="left">
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><input onFocus="setcolor('tr{$k}')" value="1" {if $field.show_in_list==1}checked{/if} type="checkbox" class="checkbox" name="show_in_list"></td>
            </tr>
          </table>
          </td>
      </tr>
      {assign var='k' value=$k+1}
      <tr style="height:23px" id="tr{$k}">
      <td bgcolor="#BED4F4">{$MSGTEXT.editField_cheking_filling}</td>
      <td align="left">      
      <table cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td><select onChange="set_other_regular()" {if $field.edittype_id==5}disabled{/if} onFocus="setcolor('tr{$k}')" name="check_regular_id" id="check_regular_id" style="width:290px">
              <option value="0" style="color:gray">{$MSGTEXT.editField_no_checking}</option>              
			{foreach from=$check_regular item=reg}
              <option {if $reg.id==$field.check_regular_id}selected {/if} value="{$reg.id}">{$reg.name}{/foreach}
              <option {if $field.check_regular_id==-1}selected {/if} value="-1" style="color:gray">{$MSGTEXT.editField_other} &rarr;
              <option {if $field.check_regular_id==-2}selected {/if} value="-2" style="color:gray">{$MSGTEXT.editField_allowed_file} &rarr;</option>
            </select>
          <td align="left"><input type="text" style="width:210px" name="regex_other" id="regex_other" style="width:180px;{if $field.check_regular_id>-1 }display:none{/if}" value="{$field.regex_other}" title="{$MSGTEXT.editField_other_exten}"></td>
        </td>        
        </tr>        
      </table>
      </td>
      </tr>
      
      {if $field.edittype_id==9 || $field.edittype_id==10}      
      {assign var='k' value=$k+1}
      <tr style="height:20px" id="tr{$k}">
        <td bgcolor="#BED4F4">{$MSGTEXT.editField_avator}</td>
        <td align="left"><table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td>{$MSGTEXT.editField_avator_width}</td>
              <td>{$MSGTEXT.editField_avator_height}</td>
              <td>{$MSGTEXT.editField_avator_q}</td>
            </tr>
            <tr>
              <td><input type="text" onFocus="setcolor('tr{$k}')" value="{$field.avator_width}" name="avator_width" style="width:100px"></td>
              <td><input type="text" onFocus="setcolor('tr{$k}')" value="{$field.avator_height}" name="avator_height" style="width:100px"></td>
              <td><input type="text" onFocus="setcolor('tr{$k}')" value="{$field.avator_quality}" name="avator_quality" style="width:160px"></td>
            </tr>
          </table>
          </td>
      </tr>
      {assign var='k' value=$k+1}
      <tr style="height:20px" id="tr{$k}" >
        <td bgcolor="#BED4F4">{$MSGTEXT.editField_avator_big}</td>
        <td align="left"><table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td>{$MSGTEXT.editField_avator_width}</td>
              <td>{$MSGTEXT.editField_avator_height}</td>
              <td>{$MSGTEXT.editField_avator_q}</td>
            </tr>
            <tr>
              <td><input type="text" onFocus="setcolor('tr{$k}')" value="{$field.avator_width_big}" name="avator_width_big" style="width:100px"></td>
              <td><input type="text" onFocus="setcolor('tr{$k}')" value="{$field.avator_height_big}" name="avator_height_big" style="width:100px"></td>
              <td><input type="text" onFocus="setcolor('tr{$k}')" value="{$field.avator_quality_big}" name="avator_quality_big" style="width:160px"></td>
            </tr>
          </table>
          </td>
      </tr>
      {/if}      
      
      {assign var='k' value=$k+1}
      <tr style="height:20px" id="tr{$k}">
        <td bgcolor="#BED4F4">{$MSGTEXT.editField_height}</td>
        <td align="left">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><input type="text" onFocus="setcolor('tr{$k}')" value="{$field.height}" name="height" style="width:500px"></td>
            </tr>
          </table>
          </td>
      </tr>
      {assign var='k' value=$k+1}
      <tr style="height:20px" id="tr{$k}">
        <td bgcolor="#BED4F4">{$MSGTEXT.editField_width}</td>
        <td align="left">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><input type="text" onFocus="setcolor('tr{$k}')" value="{$field.width}" name="width" style="width:500px"></td>
            </tr>
          </table>
          </td>
      </tr>
      {assign var='k' value=$k+1}
      <tr style="height:20px" id="tr{$k}">
        <td bgcolor="#BED4F4">{$MSGTEXT.editField_style}</td>
        <td align="left">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><input type="text" onFocus="setcolor('tr{$k}')" value="{$field.style}"name="style" style="width:500px"></td>
            </tr>
          </table>
          </td>
      </tr>
      {assign var='k' value=$k+1}
      <tr style="height:20px" id="tr{$k}">
        <td bgcolor="#BED4F4" valign="top">{$MSGTEXT.editField_hide_field}</td>
        <td align="left"><table cellpadding="0" width="100%" cellspacing="0" border="0">
            <tr>
              <td width="35%">{$MSGTEXT.editField_field}</td>
              <td width="20%">{$MSGTEXT.editField_comparison}</td>
              <td width="45%">{$MSGTEXT.editField_value}</td>
            </tr>
            <tr>
              <td valign="top"><select onFocus="setcolor('tr{$k}')" name="hide_by_field" style="width:100%">
                  <option selected value="0" style="color:gray"> {$MSGTEXT.editField_not_sepcified}
                  {foreach from=$f_list item=f}
                  <option {if $field.hide_by_field==$f.id} selected {/if} value="{$f.id}">{$f.fieldname}</option>                  
				 {/foreach}
                </select></td>
              <td valign="top"><select onFocus="setcolor('tr{$k}')" name="hide_operator" style="width:100%">
                  <option {if $field.hide_operator==0} selected {/if} value="0">==</option>
                  <option {if $field.hide_operator==5} selected {/if} value="5">!=</option>
                  <option {if $field.hide_operator==1} selected {/if} value="1">></option>
                  <option {if $field.hide_operator==2} selected {/if} value="2"><</option>
                  <option {if $field.hide_operator==3} selected {/if} value="3">=></option>
                  <option {if $field.hide_operator==4} selected {/if} value="4">=<</option>
                </select></td>
              <td valign="top"><textarea style="margin-top:0px" title="{$MSGTEXT.editField_hide_field_title}" onFocus="setcolor('tr{$k}')" rows="3" name="hide_on_value" style="width:205px">{$field.hide_on_value}</textarea></td>
            </tr>
          </table>
          </td>
      </tr>
      </tbody>      
    </table>
    
    <br>
    <input type="submit" class="button" name="butedit" id="butedit" value="{$MSGTEXT.editField_save}" style="width:100px">
    &nbsp;&nbsp;
    <input type="button" class="button" name="butdelete" id="butdelete" onClick="window.close()" value="{$MSGTEXT.editField_cancel}" style="width:100px">
    &nbsp;&nbsp;
  </form>
  {else}
  <br>
  <center>
    <h4>{$MSGTEXT.editField_info}</h4>
  </center>
  {/if}
</body>
</html>