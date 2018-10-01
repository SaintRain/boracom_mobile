{literal} 
<script language="JavaScript">
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

var doc = document;
var counter=-1;
var rules_counter=-1;
var tr_objects=new Array();
var tables_td4 = new Array();
var list_rules_counter = new Array();

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


function getPageList(page_id) {
	var text='<select style="width:100%" name="page_id'+counter+'" id="page_id'+counter+'">';
	{/literal}
	{foreach from=$page_records item=item}text=text+'<option value="{$item.id}">{$item.description}</option>';{/foreach}
	{literal}
	text=text+'</select>';

	return text;
}


function getTablesList() {
	var text	='<select style="width:100%"  name="table_id'+counter+'_'+rules_counter+'" id="table_id'+counter+'_'+rules_counter+'">';
	{/literal}
	{foreach from=$tables_records item=item}text=text+'<option value="{$item.id}">{$item.table_name}</option>';{/foreach}
	{literal}
	text=text+'</select>';

	return text;
}


function show_hide_fields(obj, prefix_id) {

	if (obj.checked) {
		GetElementById('rules_tables_list'+prefix_id).style.display='none';
		GetElementById('value'+prefix_id).style.display='block';
	}
	else {
		GetElementById('rules_tables_list'+prefix_id).style.display='block';
		GetElementById('value'+prefix_id).style.display='none';
	}
}


function addNewField() {

	counter++;
	rules_counter=-1;

	// Находим нужную таблицу
	var tbody = doc.getElementById('tab1').getElementsByTagName('TBODY')[0];

	// Создаем строку таблицы и добавляем ее
	var row = doc.createElement("TR");

	row.bgColor="#66a4d3";

	row.onmouseover= function d() {
		setcolor(row);
	}

	row.onmouseout= function d2() {
		unsetcolor(row);
	}

	row.id='newRow'+counter;
	tr_objects[row.id]=tbody.appendChild(row);

	// Создаем ячейки в вышесозданной строке
	// и добавляем тх
	var td1 = doc.createElement("TD");
	var td2 = doc.createElement("TD");
	var td3 = doc.createElement("TD");
	var td4 = doc.createElement("TD");

	row.appendChild(td1);
	row.appendChild(td2);
	row.appendChild(td3);
	row.appendChild(td4);

	td1.vAlign='top';
	td2.vAlign='top';
	td3.vAlign='top';
	td4.vAlign='top';

	td1.align='center';
	td2.align='center';
	td3.align='center';
	td4.align='left';

	var pagesList=getPageList();
	var rules_text='<input onClick="addNewRules('+counter+')" type="button" class="sub_small" value="{/literal}{$MSGTEXT.friendlyurlrules_add_rule}{literal}">';

	// Наполняем ячейки
	td3.innerHTML = pagesList;
	td2.innerHTML = '<input style="margin:0" name="enable'+counter+'" id="enable'+counter+'"  type="checkbox" checked value="1">';
	td1.innerHTML = '<input style="margin:0" name="delete'+counter+'" id="delete'+counter+'" type="checkbox" value="1"><input name="id'+counter+'" id="id'+counter+'" type="hidden" value="">';
	td4.innerHTML = rules_text;

	tables_td4[counter]=td4;
}


function addNewRules(counter_number) {
	rules_counter++;

	//работаем через массив, что при добавлении новых правил все правильно считалось
	if (!list_rules_counter[counter_number]) {
		list_rules_counter[counter_number]=1;
	}
	else {
		list_rules_counter[counter_number]=list_rules_counter[counter_number]+1;
	}
	var current_counter=list_rules_counter[counter_number]-1;


	if (tables_td4[counter_number]) {
		var rules_text='<table width="100%" id="tab_rules'+counter_number+'" cellpadding="2" cellspacing="1" bgcolor="#4e86b0" border="0"><tr><td width="20%" bgcolor="#7cb6e2" style="font-size:11">{/literal}{$MSGTEXT.friendlyurlrules_vars}{literal}</td><td width="60%" bgcolor="#7cb6e2" style="font-size:11">{/literal}{$MSGTEXT.friendlyurlrules_table}{literal}</td><td width="10%" bgcolor="#7cb6e2" align="center" style="font-size:11">{/literal}{$MSGTEXT.friendlyurlrules_sort}{literal}</td><td width=8%" bgcolor="#7cb6e2" align="center" style="font-size:11">{/literal}{$MSGTEXT.friendlyurlrules_delete}{literal}</td></tr></table><input onClick="addNewRules('+counter_number+')" style="margin-top:5px" type="button" class="sub_small" value="{/literal}{$MSGTEXT.friendlyurlrules_add_rule}{literal}"><br>&nbsp;';
		td4=tables_td4[counter_number];
		td4.innerHTML=rules_text;
		tables_td4[counter_number]=false;
	}

	// Находим нужную таблицу
	var tbody = doc.getElementById('tab_rules'+counter_number).getElementsByTagName('TBODY')[0];

	// Создаем строку таблицы и добавляем ее
	var row = doc.createElement("TR");

	row.bgColor="#7cb6e2";

	row.id='newRowRules'+counter_number+'_'+current_counter;
	tr_objects[row.id]=tbody.appendChild(row);

	// Создаем ячейки в вышесозданной строке
	// и добавляем тх
	var td1 = doc.createElement("TD");
	var td2 = doc.createElement("TD");
	var td3 = doc.createElement("TD");
	var td4 = doc.createElement("TD");

	row.appendChild(td1);
	row.appendChild(td2);
	row.appendChild(td3);
	row.appendChild(td4);

	td1.vAlign='top';
	td2.vAlign='top';
	td3.vAlign='top';
	td4.vAlign='top';

	td1.align='left';
	td2.align='left';
	td3.align='center';
	td4.align='center';

	var tablesList=getTablesList();

	// Наполняем ячейки
	td1.innerHTML = '<input type="text" style="width:98%" name="var_name'+counter_number+'_'+current_counter+'" id="var_name'+counter_number+'_'+current_counter+'" value="">';
	td2.innerHTML = '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="100%"><div style="display:block;width:100%" id="rules_tables_list'+counter_number+'_'+current_counter+'">'+tablesList+'</div><input type="text" name="value'+counter_number+'_'+current_counter+'" id="value'+counter_number+'_'+current_counter+'" value="" style="display:none;width:150px"></td><td nowrap><table  border="0" cellpadding="0" cellspacing="0"><tr><td nowrap>&nbsp;&nbsp;<input style="margin:0" onClick=\'show_hide_fields(this, "'+counter_number+'_'+current_counter+'")\' name="is_value'+counter_number+'_'+current_counter+'" id="is_value'+counter_number+'_'+current_counter+'" type="checkbox" value="1"></td><td nowrap>&nbsp;<font style="font-size:11">{/literal}{$MSGTEXT.friendlyurlrules_is_value}{literal}</font></td></tr></table> </td></tr></table>';
	td3.innerHTML = '<input type="text" name="sort_index'+counter_number+'_'+current_counter+'" id="sort_index'+counter_number+'_'+current_counter+'" value="" style="width:60px">';
	td4.innerHTML = '<input style="margin:0" type="checkbox" name="delete'+counter_number+'_'+current_counter+'" id="delete'+counter_number+'_'+current_counter+'" value="1"><input type="hidden" name="id'+counter_number+'_'+current_counter+'" id="id'+counter_number+'_'+current_counter+'" value="">';
}


function createFieldsFromList() {
	{/literal}
	{foreach from=$urls_settings item=item}
	addNewField();
	selectByValue('page_id'+counter, '{$item.page_id}');
	GetElementById('enable'+counter).checked={if $item.enable==1}true{else}false{/if};
	GetElementById('id'+counter).value="{$item.id}";

	{foreach from=$item.rules item=rule}
	addNewRules(counter);
	GetElementById('id'+counter+'_'+rules_counter).value="{$rule.id}";
	GetElementById('var_name'+counter+'_'+rules_counter).value="{$rule.var_name}";
	selectByValue('table_id'+counter+'_'+rules_counter, '{$rule.table_id}');
	GetElementById('value'+counter+'_'+rules_counter).value="{$rule.value}";
	GetElementById('is_value'+counter+'_'+rules_counter).checked={if $rule.is_value==1}true;{else}false;{/if};

	{if $rule.is_value==1}
	//скрываем список таблиц
	GetElementById('rules_tables_list'+counter+'_'+rules_counter).style.display='none';
	GetElementById('value'+counter+'_'+rules_counter).style.display='block';
	{/if}

	GetElementById('sort_index'+counter+'_'+rules_counter).value="{$rule.sort_index}";
	{/foreach}

	{/foreach}
	{literal}
}


function setcolor(obj) {
	obj.style.background='#7cb6e2';
}

function unsetcolor(obj) {
	obj.style.background='#66a4d3';
}
</script>
{/literal}


{if $errorMsgs}
{foreach from=$errorMsgs item=error}
<p style="margin-bottom:10px"><font color="yellow">{$error}</font></p>
{/foreach}
{/if}
<form id="data form" action="?act=friendly_url_rules&do=saveedit" method="POST" style="margin:0">
  <input type="hidden" name="counter" id="counter" value="0">
  <p style="margin-bottom:10px"><font color="yellow">{$messages}</font></p>
  <table id='tab1' width="100%" class="formbackground" border="0" cellpadding="3" cellspacing="1">
    <tbody>
      <tr bgcolor="#66a4d3">
        <td align="center" width="5%"><b>{$MSGTEXT.friendlyurlrules_delete}</b></td>
        <td align="center" width="5%"><b>{$MSGTEXT.friendlyurlrules_enable}</b></td>
        <td width="20%"><b>{$MSGTEXT.friendlyurlrules_page}</b></td>
        <td width="70%"><b>{$MSGTEXT.friendlyurlrules_rules}</b></td>
      </tr>
    </tbody>
  </table>
  <br>
  <input class="button" type="button" onclick="addNewField()" value="{$MSGTEXT.friendlyurlrules_add_new}" style="width:180px" >
  <input class="button" type="submit" value="{$MSGTEXT.friendlyurlrules_save}" style="width:180px" >
</form>
<script language="JavaScript">
createFieldsFromList();
</script>