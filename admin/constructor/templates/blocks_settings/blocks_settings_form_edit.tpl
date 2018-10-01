
{literal}
<script language="JavaScript">
var doc = document;
var pred_id;
var name;
var initials;
var posada;
var counter=-1;
var tr_objects=new Array();


function selectByValue(obj_id, val) {
	if (val!='') {
		sel=GetElementById(obj_id);
		for (i=0; i<sel.options.length; i++) {
			if (sel.options[i].value==val) {
				sel.options[i].selected=true;
				break;
			}
		}
	}
}


function createFieldsFromList() {
	var symbol	= String.fromCharCode(31);
	var reg	= new RegExp("(" + symbol + ")", "g");

	{/literal}
	{foreach from=$settings item=field}
	addNewField();
	GetElementById('id_'+counter).value='{$field.id}';
	GetElementById('name_'+counter).value='{$field.name}';
	descr='{$field.value}';
	descr2='{$field.description}';
	GetElementById('value_'+counter).value=descr.replace(reg, "\r");
	GetElementById('description_'+counter).value=descr2.replace(reg, "\r");
	GetElementById('loaded_name_'+counter).value='{$field.loaded_name}';
	selectByValue('edit_s_type_id_'+counter, '{$field.edit_s_type_id}');
	selectByValue('block_id_'+counter, '{$field.block_id}');
	{/foreach}
	{literal}
}


function beforeSubmit() {
	form	= GetElementById('editForm');
	for (var i = 0; i < form.elements.length; i++) {
		form.elements[i].disabled=false;
	}

	if (counter!=-1) GetElementById('counter').value=counter;
	return true;
}


function edittypeList() {
	{/literal}
	edittype_text='<select onfocus="setcolor(\'newRow'+counter+'\');" name="edit_s_type_id_'+counter+'" id="edit_s_type_id_'+counter+'" style="width:100px">{foreach from=$edit_s_types item=edit_s_type}<option value="{$edit_s_type.id}">{$edit_s_type.name}</option>{/foreach}</select>';
	return edittype_text;
	{literal}
}

function blockList() {
	{/literal}
	blockList_text='<select onfocus="setcolor(\'newRow'+counter+'\');" name="block_id_'+counter+'" id="block_id_'+counter+'" style="width:100%">{foreach from=$blocks item=block}<option value="{$block.id}">{$block.description}</option>{/foreach}</select>';
	return blockList_text;
	{literal}
}

function addNewField() {
	counter++;

	// Находим нужную таблицу
	var tbody = doc.getElementById('tab1').getElementsByTagName('TBODY')[0];

	// Создаем строку таблицы и добавляем ее
	var row = doc.createElement("TR");
	row.id='newRow'+counter;
	tr_objects[row.id]=tbody.appendChild(row);

	// Создаем ячейки в вышесозданной строке
	// и добавляем их
	var td00 = doc.createElement("TD");
	var td0 = doc.createElement("TD");
	var td1 = doc.createElement("TD");
	var td2 = doc.createElement("TD");
	var td3 = doc.createElement("TD");

	row.appendChild(td00);
	row.appendChild(td0);
	row.appendChild(td1);
	row.appendChild(td2);
	row.appendChild(td3);

	{/literal}
	edittype_text	= edittypeList();
	block_list		= blockList();
	{literal}	
	
	// Наполняем ячейки
	td00.innerHTML ='<input type="hidden" name="loaded_name_'+counter+'" id="loaded_name_'+counter+'" value=""><input type="hidden" name="id_'+counter+'" id="id_'+counter+'" value=""><input type="text" class="field_name" onfocus="setcolor(\'newRow'+counter+'\');" style="width:150px" name="name_'+counter+'" id="name_'+counter+'"	value="">';
	td00.vAlign='top';
	td0.innerHTML ='<textarea onfocus="setcolor(\'newRow'+counter+'\')" style="width:250px;height:100px" name="value_'+counter+'" id="value_'+counter+'"></textarea>';
	td0.valign='top';
	td1.innerHTML ='<textarea onfocus="setcolor(\'newRow'+counter+'\');" style="width:250px; height:100px" name="description_'+counter+'" id="description_'+counter+'"></textarea>';
	td1.vAlign='top';
	td2.innerHTML =edittype_text;
	td2.vAlign='top';	
	td3.innerHTML =block_list;
	td3.vAlign='top';			                          
}


function setcolor(id) {
	obj=doc.getElementById(id);
	obj.style.background='#D0DCFF';
	if (pred_id && pred_id!=id) {
		obj=doc.getElementById(pred_id);
		obj.style.background='white';
	}

	pred_id=id;
	GetElementById('deleteButton').disabled=false;
}


function unsetcolor(obj) {
	obj.style.background='white';
}


function q(){
	return confirm("{/literal}{$MSGTEXT.blocks_settings_del_mess}{literal}");
}


function deleteField() {
	if (q()) {
		var tbody = doc.getElementById('tab1').getElementsByTagName('TBODY')[0];
		tbody.removeChild(tr_objects[pred_id]);
		pred_id=false;
		GetElementById('deleteButton').disabled=true;
		GetElementById('editForm').submit();
	}
}
</script>
{/literal}


<form id="editForm" action="?act=b_s_c&do=saveedit" method="POST" style="margin:0px" onsubmit="return beforeSubmit()">
  <input id="counter" name="counter" value="{$counter}" type="hidden">
  {if $message}
  <p id="messagetext" style="margin-bottom:10px;color:Yellow">{$message}</p>
  <script language="JavaScript">Morphing("messagetext", false)</script> 
  {/if}
  
  {foreach from=$editError item=item}
  {$item}<br>
  {/foreach} </font>
  </p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td>
            <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td><p style="margin-top:0px; margin-bottom:2px">{$MSGTEXT.blocks_settings_settings}</p>
                    <table width="100%" id="tab1" cellpadding="2" cellspacing="1" border="0" bgcolor="White">
                      <tbody>
                        <tr style="height:19px">
                          <td class="top_list" style="width:150px" valign="top">{$MSGTEXT.blocks_settings_name_setting}</td>
                          <td class="top_list" style="width:250px" nowrap>{$MSGTEXT.blocks_settings_value}</td>
                          <td class="top_list" style="width:250px">{$MSGTEXT.blocks_settings_description}</td>
                          <td class="top_list" nowrap>{$MSGTEXT.blocks_settings_type}</td>
                          <td class="top_list" nowrap>{$MSGTEXT.blocks_settings_block_name}</td>
                        </tr>
                      </tbody>
                    </table>
                    </td>
                </tr>
                <tr>
                  <td>
                  <table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td>
                        <td><input style="width:150px" value="{$MSGTEXT.blocks_settings_remove_field}" id='deleteButton' disabled class="button" onclick="deleteField()" type="button"></td>
                        <td width="5px"></td>
                        <td><input style="width:150px" value="{$MSGTEXT.blocks_settings_add_field}" class="button" onclick="addNewField()" type="button"></td>
                        <td width="5px"></td>
                        <td><input style="width:150px" value="{$MSGTEXT.blocks_settings_save}" class="button" type="submit" type="button"></td>
                      </tr>
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
</form>

<script language="JavaScript">
createFieldsFromList();
</script>