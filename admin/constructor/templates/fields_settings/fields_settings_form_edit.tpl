{literal}
<script language="JavaScript">
var pred_id;

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


function setOther(f_id) {
	obj = GetElementById('regex_other'+f_id);
	obj2 = GetElementById('check_regular_id'+f_id);
	reg_id = obj2.options[obj2.selectedIndex].value;
	if (reg_id==-1 || reg_id==-2) disp='block';
	else disp='none';

	obj.style.display=disp;
}
</script>
{/literal}

<form id="editForm" action="?act=b_fs_c&do=saveedit&t_id={$t_id}&b_id={$b_id}" method="POST" style="margin:0px">
  <p style="margin-bottom:10px"><font color="Yellow">{$message}<br>
    {foreach from=$editError item=item}
    {$item}<br>
    {/foreach}
    </font></p>
  <a style="text-decoration:none" href="?act=b_fs_c&do=list&b_id={$b_id}">&larr; {$MSGTEXT.fields_settings_form_all_tables}<a><br>
  <br>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
      <tr>
      <td>    
    <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
      <tr>
        <td> {$MSGTEXT.fields_settings_form_name_tables}:<font style="margin-left:10;margin-top:0;color:yellow;font-weight:bold">{$table_name}</font></td>
      </tr>
      <tr>
        <td> {$MSGTEXT.fields_settings_form_description}:<font style="margin-left:10;margin-top:0;color:yellow;font-weight:bold">{$table_description}</font></td>
      </tr>
        <tr>
        <td>
      <p style="margin-top:0px; margin-bottom:2px"><b>{if $fields}{$MSGTEXT.fields_settings_form_table_field}:{else}{$MSGTEXT.fields_settings_form_no_editable}{/if}</b><br>
        <br>
      <table cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td><input value="{$MSGTEXT.fields_settings_form_save}" class="button" type="submit" type="button"></td>
        </tr>
      </table>
        </p>
      <br>
      {assign var='k' value=0}
      {foreach from=$fields item=field}
      {assign var='k' value=$k+1}
      <table width="100%" cellpadding="2" cellspacing="1" border="0" bgcolor="White">
        <tbody>
          <tr style="height:23px"><td width="200px" bgcolor="#BED4F4" width="160px">
            {$MSGTEXT.fields_settings_form_title_field}
          </td>
        
          <td bgcolor="#CBDCF0" colspan="2"><b>{$field.fieldname}</td>
        </tr>
        <tr style="height:23px">
          <td bgcolor="#BED4F4" width="160px">{$MSGTEXT.fields_settings_form_desc_field}</td>
          <td bgcolor="#CBDCF0" colspan="2">{$field.comment}</td>
        </tr>
        <tr style="height:23px">
          <td bgcolor="#BED4F4" width="160px">{$MSGTEXT.fields_settings_form_type_of_edit}</td>
          <td bgcolor="#CBDCF0" colspan="2"><b>{if $field.edittype}{$field.edittype}{else}<font color="white">{$MSGTEXT.fields_settings_form_no_edit}</font>{/if}</td>
        </tr>
        <tr style="height:23px" id="tr{$k}" >
          <td bgcolor="#BED4F4">{$MSGTEXT.fields_settings_form_edit_this_field}</td>
          <td align="left">
          <table cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td><input {if $field.auto_incr==1} disabled {/if} onfocus="setcolor('tr{$k}')" value="1" {if $field.active==1}checked{/if} type="checkbox" name="active{$field.id}"></td>
                <td width="100%"></td>
                <td><input type="text" onfocus="setcolor('tr{$k}')" style="width:150; border:1 solid #E6E6E6" value="{$field.ac_comment}" name="ac_comment{$field.id}" title="{$MSGTEXT.fields_settings_form_another_desc}" {if $field.auto_incr==1} readonly {/if} ></td>
                <td><input onfocus="setcolor('tr{$k}')" value="1" style="border:0" type="checkbox" {if $field.auto_incr!=1} {if $field.ac_disabled==1}checked{/if}{else} disabled{/if} name="ac_disabled{$field.id}" title="{$MSGTEXT.fields_settings_form_on_off_sett}"></td>
              </tr>
            </table>
            </td>
        </tr>
        {assign var='k' value=$k+1}
        <tr style="height:23px" id="tr{$k}" >
          <td bgcolor="#BED4F4">{$MSGTEXT.fields_settings_form_print_field}</td>
          <td align="left">
          <table cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td><input onfocus="setcolor('tr{$k}')" value="1" {if $field.show_in_list==1}checked{/if} type="checkbox" name="show_in_list{$field.id}"></td>
                <td width="100%"></td>
                <td><input type="text" onfocus="setcolor('tr{$k}')" style="width:150; border:1 solid #E6E6E6" value="{$field.show_comment}" name="show_comment{$field.id}" title="{$MSGTEXT.fields_settings_form_another_desc}"></td>
                <td><input onfocus="setcolor('tr{$k}')" value="1" style="border:0" type="checkbox" {if $field.show_disabled==1}checked{/if} name="show_disabled{$field.id}" title="{$MSGTEXT.fields_settings_form_on_off_sett}"></td>
              </tr>
            </table>
            </td>
        </tr>
        {assign var='k' value=$k+1}
        <tr style="height:23px" id="tr{$k}">
          <td bgcolor="#BED4F4">{$MSGTEXT.fields_settings_form_checking}</td>
            <td align="left">
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><select onchange="setOther({$field.id})" {if $field.edittype_id==5}disabled{/if} onfocus="setcolor('tr{$k}')" name="check_regular_id{$field.id}" id="check_regular_id{$field.id}" style="width:250px">
                  <option value="0" style="color:gray">{$MSGTEXT.fields_settings_form_no_checking}
                  {foreach from=$check_regular item=reg}
                  <option {if $reg.id==$field.check_regular_id}selected {/if} value="{$reg.id}" >{$reg.name}{/foreach}
                  <option {if $field.check_regular_id==-1}selected {/if} value="-1" style="color:gray">{$MSGTEXT.fields_settings_form_other} &rarr;
                  <option {if $field.check_regular_id==-2}selected {/if} value="-2" style="color:gray">{$MSGTEXT.fields_settings_form_file_exte} &rarr;
                </select>
              <td><input type="text" name="regex_other{$field.id}" id="regex_other{$field.id}" style="width:150px;{if $field.check_regular_id!=-1}display:none{/if}" value="{$field.regex_other}" title="{$MSGTEXT.fields_settings_form_another_format}"></td>
              </td>                        
              <td width="100%"></td>
              <td><input type="text" {if $field.edittype_id==5}disabled{/if} onfocus="setcolor('tr{$k}')" style="width:150px; border:1 solid #E6E6E6" value="{$field.ch_comment}" name="ch_comment{$field.id}" title="{$MSGTEXT.fields_settings_form_another_desc}"></td>
              <td><input {if $field.edittype_id==5}disabled{/if} onfocus="setcolor('tr{$k}')" value="1" style="border:0" type="checkbox" {if $field.ch_disabled==1}checked{/if} name="ch_disabled{$field.id}" title="{$MSGTEXT.fields_settings_form_on_off_sett}"></td>
            </tr>
          </table>
          </td>
          </tr>
        
        {assign var='k' value=$k+1}
        <tr style="height:20px" id="tr{$k}" >
          <td bgcolor="#BED4F4">{$MSGTEXT.fields_settings_form_height}</td>
          <td align="left"><table cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td><input type="text" onfocus="setcolor('tr{$k}')" value="{$field.height}" name="height{$field.id}" style="width:150px"></td>
                <td width="100%"></td>
                <td><input type="text" onfocus="setcolor('tr{$k}')" style="width:150px; border:1 solid #E6E6E6" value="{$field.he_comment}" name="he_comment{$field.id}" title="{$MSGTEXT.fields_settings_form_another_desc}"></td>
                <td><input onfocus="setcolor('tr{$k}')" value="1" style="border:0" type="checkbox" {if $field.he_disabled==1}checked{/if} name="he_disabled{$field.id}" title="{$MSGTEXT.fields_settings_form_on_off_sett2}"></td>
              </tr>
            </table>
            </td>
        </tr>
          </tbody>        
      </table>
      <br>
      {/foreach}
        </td>
        </tr>      
      <tr>
        <td><table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td><input value="{$MSGTEXT.fields_settings_form_save}" class="button" type="submit" type="button"></td>
            </tr>
          </table>
          </td>
      </tr>
    </table>
      </td>
      </tr>
  </table>
</form>