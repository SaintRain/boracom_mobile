{foreach from=$fields item=field}
{if $field.edittype_id==14  && !$translit_setup}{assign var="translit_setup" value=1}
<script type="text/javascript" src="js/translit.js"></script>
{else}
{if ($field.datatype_id==4 || $field.datatype_id==12 || $field.datatype_id==13) && $field.edittype_id>0 && ($field.filter==1 || $smarty.const.SETTINGS_EDIT_MODE)}
{if !$calendar_setup }
{assign var="calendar_setup" value=1}
<link rel="stylesheet" type="text/css" media="all" href="calendar/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-{$interface_lang_prefix}.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
{/if}{/if}{/if}
{/foreach}

<script language="JavaScript">
act_link="?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&mdo=saveedit&id={$currentData.$pk_incr_fieldname}&p={$p_num}&sort_by={$sort_by}&sort_type={$sort_type}{if isset($smarty.get.hide_menu) && $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}&edit=";
{literal}

//работа со списком записей на странице
var otmenitClick=false;
//подсветка записей при наведении
var scolor=true;
var g_obg;


function golink(data_id) {
	if (otmenitClick) {
		otmenitClick=false;
	}
	else {
		{/literal}location.href='?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&id='+data_id+'&p={$p_num}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}#data form';{literal}
	}
}


function otmenit() {
	otmenitClick=true;
}


function selectRow(obg_id) {
	GetElementById('check allrows').value=0;
	GetElementById('main CheckBox').checked=false;
	obj=GetElementById('row '+obg_id);
	setcolor(obj);
	otmenit();
}


function applySorts() {
	otmenit();
	GetElementById('actiontype').value='update';
	GetElementById('primenit obnovlenie').submit();
}


function applyDelete() {

	if (GetElementById('main CheckBox').checked) {
		var messageAlert="{/literal}{$MSGTEXT.edit_data_del_alert3}{literal}"
	}
	else {
		var messageAlert="{/literal}{$MSGTEXT.edit_data_del_alert}{literal}"
	}

	if (confirm(messageAlert)) {
		GetElementById('actiontype').value='delete';
		GetElementById('primenit obnovlenie').submit();
	}
}


function CheckAll(Element, Name) {
	if (Element.checked) GetElementById('check allrows').value=1;
	else GetElementById('check allrows').value=0;
	thisCheckBoxes = Element.parentNode.parentNode.parentNode.getElementsByTagName("input");
	for (i = 1; i < thisCheckBoxes.length; i++) {
		if (thisCheckBoxes[i].name == Name) {
			thisCheckBoxes[i].checked = Element.checked;

			last=thisCheckBoxes[i].id;
			t=last.split(' ');
			obj=GetElementById('row '+t[1]);
			setcolor(obj);
			unsetcolor(obj);
		}
	}
}


function delOneRecord(data_id) {
	otmenit();

	if (confirm("{/literal}{$MSGTEXT.edit_data_del_alert2}{literal}")) {
		{/literal}
		location.href='?act=modules&do=managedata&mdo=updaterows&page_id={$page_id}&tag_id={$tag_id}&id={$currentData.$pk_incr_fieldname}&p={$p_num}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}&del_id='+data_id;
		{literal}
	}
}


function vkl(f_value, f_name, f_id, edittype_id) {
	otmenit();
	{/literal}
	location.href='?act=modules&do=managedata&tag_id={$tag_id}&sort_by={$sort_by}&sort_type={$sort_type}{if $page_id}&page_id={$page_id}{/if}&mdo=setStatus&id='+f_id+'&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}&f_name='+f_name+'&f_value='+f_value+'&edittype_id='+edittype_id+'&p={$p_num}';
	{literal}
}


function setcolor(obj) {
	setUnsetColor();
	g_obg=obj;
	scolor=true;
	g_obg.style.background='#FFF2BE';
}


function unsetcolor(obj) {
	g_obg=obj;
	scolor=false;
	setTimeout('setUnsetColor()', 1);
}


function setUnsetColor() {
	if (!scolor) {
		t=g_obg.id.split(' ');
		if (g_obg.className=='row_selected' || GetElementById('checkbox '+t[1]).checked==true) g_obg.style.background='#dce7fa';
		else g_obg.style.background='white';
	}
}


function set_edit_table(obj) {
	{/literal}	
	url	= '?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&sort_by=sort_index&sort_type=low{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&p=1{if !$smarty.get.filter_for_table}&clean_filter=true{/if}&t_name='+obj.value;
	{literal}
	location.href=url;
}


function set_filter(obj, filterfield) {
	{/literal}
	url	= '?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&p=1&t_name={$table_name}&filterfield='+filterfield+'&filtervalue='+obj.value;
	{literal}
	location.href=url;
}


function set_filter_by_date(id_number, filterfield) {
	{/literal}

	v_from	= GetElementById('calendar_value_from '+id_number).value;
	v_to	= GetElementById('calendar_value_to '+id_number).value;

	if (v_from!='' || v_to!='') v=v_from+'|'+v_to;
	else
	v='';

	url	= '?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&p=1&t_name={$table_name}&filterfield='+filterfield+'&filtervalue='+v;
	{literal}
	location.href=url;
}


function setRecordsForPage(obj) {
	var time = Math.random();
	var sel_value= obj.value;
	var xmlObject = getXmlHttp();	
	xmlObject.open("GET", "ajax.php?func=updateGSettins&caption=SETTINGS_RECORDS_FOR_PAGE&value="+sel_value+"&time="+time ,true);	
	xmlObject.onreadystatechange = function () { getSetRecordsForPage(xmlObject)};
	xmlObject.send(null);
	
	
}


function getSetRecordsForPage(xmlObject) {
	if (xmlObject.readyState == 4) {
		{/literal}
		location.href='?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&id={$currentData.$pk_incr_fieldname}&p=1&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}';
		{literal}
	}
}

{/literal}
{if $smarty.const.SETTINGS_EDIT_MODE==1 || $info.block_type==1}
{literal}

function set_action(action) {
	form=GetElementById('data form');
	form.action=act_link+action;
		
	if (action!='delete') {
		{/literal}
	{foreach from=$fields item=field}{if $field.edittype_id==4  && $field.active}selectAll('{$field.fieldname}'); {/if}{/foreach}
	{literal}
	}
	
	if (action=='delete') {	
		{/literal}
		if (confirm('{$MSGTEXT.edit_data_del_alert2}')) {literal}{
			form.submit();
		}
	}
	else {
		form.submit();
	}
}
//работа с полем типа MultySelect
var elPositions=new Array();

function addSelected(object_id) {
	var del	= new Array();
	k		= 0;
	newtables=GetElementById(object_id+' notselected_data');
	tables=GetElementById(object_id);
	for (i=0;i<newtables.options.length; i++) {
		if (newtables.options[i].selected) {

			//запоминаем позицию
			var temp = new Array(1);
			temp[newtables.options[i].value]=i;
			elPositions[object_id]=temp ;

			tables.options[tables.options.length]=new Option(newtables.options[i].text, newtables.options[i].value);
			del[k]=i;
			k++;
		}
	}
	k=0;
	for (i=0; i<del.length; i++) {
		newtables.options[del[i]-k]=null;
		k++;
	}
}


function deleteSelected(object_id) {
	var del=new Array();
	k=0;
	tables=GetElementById(object_id+' notselected_data');
	newtables=GetElementById(object_id);
	for (i=0;i<newtables.options.length; i++) {
		if (newtables.options[i].selected) {
			tables.options[tables.options.length]=	new Option(newtables.options[i].text, newtables.options[i].value);
			del[k]=i;
			k++;
		}
	}
	k=0;
	for (i=0; i<del.length; i++) {
		newtables.options[del[i]-k]=null;
		k++;
	}
}


function selectAll(object_id) {

	tables=GetElementById(object_id);

	for (i=0;i<tables.options.length; i++) {
		tables.options[i].selected=true;
	}
	
	var tables2=GetElementById(object_id+' notselected_data');
	tables2.options.length=0;
		
	return true;
}


function refreshListByField(selected_field_value, sourse_table, sourse_field, obj_refresh_id_array, selected_field_next) {

	var xmlObject = getXmlHttp();
	var time = Math.random();
	xmlObject.open("GET", "ajax.php?func=refreshListByField&sourse_table="+sourse_table+"&sourse_field="+sourse_field+"&selected_field_next="+selected_field_next+"&selected_field_value="+selected_field_value+"&time="+time, true);

	xmlObject.onreadystatechange = function () { refreshListByFieldGet(xmlObject, obj_refresh_id_array)};
	xmlObject.send(null);
}


function refreshListByFieldGet(xmlObject, obj_refresh_id_array) {

	if (xmlObject.readyState == 4) {
		// получаем ответ скрипта
		var response = xmlObject.responseText;

		eval(response);	//создаем массив m

		for (i2=0; i2<obj_refresh_id_array.length; i2=i2+1) {
			obj_refresh_id=obj_refresh_id_array[i2];

			var objSel = GetElementById(obj_refresh_id);

			if (objSel.type=='select-one') {
				obj_refresh_svalue=selectedValues[obj_refresh_id];
				objSel.options.length = 0;
				el 				= new Option("{/literal}{$MSGTEXT.edit_data_not_specified}{literal}", 0);
				el.style.color	='gray';
				objSel.options[objSel.options.length] =el;


				if (m) {
					for (key in m) {
						objSel.options[objSel.options.length] = new Option(m[key], key);
						if (key==obj_refresh_svalue) objSel.options[objSel.options.length-1].selected=true;
					}
				}
			}
			else if (objSel.type=='select-multiple') {
				objSel2 = GetElementById(obj_refresh_id+' notselected_data');

				obj_refresh_svalue=selectedValues[obj_refresh_id].split(',');
				objSel.options.length = 0;
				objSel2.options.length = 0;
				if (m) {
					for (key in m) {
						add=true;
						for (ii=0; ii<obj_refresh_svalue.length; ii=ii+1) {
							if (key==obj_refresh_svalue[ii]) {
								objSel.options[objSel.options.length] = new Option(m[key], key);
								add=false;
							}
						}

						if(add)
						objSel2.options[objSel2.options.length] = new Option(m[key], key);
					}
				}
			}

			else {
				var objSel = GetElementById('div '+obj_refresh_id);

				if (document.getElementById('radiobox_hide_'+obj_refresh_id)) dop=document.getElementById('radiobox_hide_'+obj_refresh_id).innerHTML;
				else dop='';

				obj_refresh_svalue=selectedValues[obj_refresh_id];
				newText=''	;
				if (m) {
					for (key in m) {
						if (key==obj_refresh_svalue) ch=' checked ';
						else ch='';
						newText=newText+'<input type="radio" name="'+obj_refresh_id+'" '+dop+' value="'+key+'" '+ch+'> '+m[key]+'   ';
					}
				}
				objSel.innerHTML=newText;
			}
		}

		delete xmlObj;
		delete response;
	}
}


function translitFields(obj_id, obj_id_sourse) {

	if (GetElementById("create translit "+obj_id).checked) {
		var sourseText		= GetElementById(obj_id).value;
		var translitedText	= transliteMe(sourseText);
		GetElementById(obj_id_sourse).value=translitedText;
	}
}


function CopyNewContent(obj_id, obj_id_arr, obj_id_sourse) {
	if (GetElementById("create copy "+obj_id).checked) {
		var sourseText		= GetElementById(obj_id_sourse).value;

		for (var key in obj_id_arr) {
			GetElementById(obj_id_arr[key]).value=sourseText;
		}
	}
}
{/literal}

var selectedValues= new Array();

{foreach from=$fields item=field}
{assign var=fieldname value=$field.fieldname}
{if $field.edittype_id==4}

selectedValues['{$fieldname}']='{foreach name="v" from=$currentData.$fieldname item=msind}{$msind.id}{if !$smarty.foreach.v.last},{/if}{/foreach}';
{else}
{if $field.edittype_id==3 || $field.edittype_id==6}
selectedValues['{$fieldname}']='{$currentData.$fieldname}';
{/if}
{/if}
{/foreach}

//формируем масив по которому будут скрываться поля
{$hide_masiv}

{literal}
function hideFields(obj, hide_by_field_caption, hide_field_caption, object_value) {

	if (object_value!='') {
		obj=GetElementById(hide_by_field_caption);
	}

	if (obj.type=='select-one') {
		//object_value=obj.value;
		object_value=obj.options[obj.selectedIndex].text;
	}
	else if (obj.type=='select-multiple') {
		//object_value=obj.value;
		object_value=obj.options[obj.selectedIndex].text;
	}
	else if (obj.type=='checkbox') {
		if (obj.checked) object_value=1;
		else object_value=0;
	}
	else if (obj.type=='radio') {
		if (object_value=='') object_value=obj.value;
	}
	else if (obj.type=='textarea') {
		object_value=obj.value;
	}
	else if (obj.type=='text') {
		object_value=obj.value;
	}

	var temp_data			= hideMasiv[hide_by_field_caption];

	for (var hide_field_caption in temp_data) {

		var v				= temp_data[hide_field_caption];
		var operator		= v['operator'];
		var hide_on_value	= v['value'];
		if (hide_on_value) {
			var hv_masiv		= hide_on_value.split(String.fromCharCode(31));
		}
		else {
			var hv_masiv=false;
		}

		if (hv_masiv) {
			for (var i=0; i<hv_masiv.length; i++) {

				var hide_on_value=hv_masiv[i];

				if (operator==0) { 		// ==
					if (object_value==hide_on_value || object_value==hide_on_value) hide_field_element=true;
					else hide_field_element=false;
				}
				else if (operator==1) { // >
					if (object_value>hide_on_value) hide_field_element=true;
					else hide_field_element=false;
				}
				else if (operator==2) { // <
					if (object_value<hide_on_value) hide_field_element=true;
					else hide_field_element=false;
				}
				else if (operator==3) { // =>
					if (object_value>hide_on_value || object_value==hide_on_value) hide_field_element=true;
					else hide_field_element=false;
				}
				else if (operator==4) { // =<
					if (object_value<hide_on_value || object_value==hide_on_value) hide_field_element=true;
					else hide_field_element=false;
				}
				else if (operator==5) { // !=

					if (object_value!=hide_on_value) {
						hide_field_element=true;
					}
					else hide_field_element=false;

				}

				if (hide_field_element)	break;
			}

			if (hide_field_element) {
				show_type='none';
			}
			else	 {
				show_type='table-row';
			}

			GetElementById('tr_'+hide_field_caption).style.display	= show_type;
			GetElementById('tr2_'+hide_field_caption).style.display	= show_type;
		}
	}
}
{/literal}
{/if}
{literal}

function reloadParentForm() {

	var selObject				= window.opener.document.getElementById("{/literal}{$opener_f_name}{literal}");
	selObject.options.length	= 0;	//очищаем родительский список записей

	{/literal}{$ownDataList}{literal}
	

	for (i=0; i<ownDataList.length; i++) {
		if (i==0) {
			if (selObject.type!='select-multiple') {
				selObject.options[selObject.options.length] = new Option("{/literal}{$MSGTEXT.edit_data_not_specified}{literal}", 0);
				if (selObject.type!='select-multiple') {
					selObject.options[selObject.options.length-1].style.color='gray';
				}
			}
		}

		selObject.options[selObject.options.length] = new Option(ownDataList[i]['text value'], ownDataList[i]['id']);

	}
}


function simulateOnChangeTranslit(obj_id) {
	/*
	var text=GetElementById(obj_id).value;
	GetElementById(obj_id).value="";
	GetElementById(obj_id).value=text;
	*/
}


function simulateOnChangeCopy(obj_id) {
	/*
	var text=GetElementById(obj_id).value;
	GetElementById(obj_id).value="";
	GetElementById(obj_id).value=text;
	*/
}


function checkSearchList() {
	if (GetElementById('search by field').value!='' && GetElementById('search field type').value!='') return true;
	else {
		alert({/literal}"{$MSGTEXT.edit_data_search_need_field}"{literal});
		return false;
	}
}
</script>
{/literal}

{if isset($smarty.get.filter_for_table) && isset($smarty.get.filterfield)}
<script language="JavaScript">reloadParentForm();</script>
{/if}



<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>  
  <td width="2px" class="leftline"><img width="2px" src="images/zero.gif"></td>
  <td bgcolor="#66a4d3">  
  	<table width="100%" cellpadding="5" cellspacing="0" border="0">
      <tr>
      <td>
      
    	{if $smarty.get.hide_menu && $smarty.get.fastEdit && ($smarty.get.mdo=='saveedit' || $smarty.get.mdo=='updaterows')}
	    	<script language="JavaScript">opener.location.reload();</script>
    	{/if}
    	{if $smarty.session.___GoodCMS.t_backup}
    		{foreach from=$smarty.session.___GoodCMS.t_backup item=item}
    		{if $item==$table_name}
    			<center>
      			<p style="color:yellow">{$MSGTEXT.edit_data_restore_table} <br>
        		<br>
        		<input class="button" value="{$MSGTEXT.edit_data_otmenit}" onclick="location.href='index.php?act=modules&do=managedata&mdo=backupXLSresult&page_id={$page_id}&tag_id={$tag_id}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}&p=1&chancel=1'" type="button">
        		<input class="button" value="{$MSGTEXT.edit_data_podtverdit}" onclick="location.href='index.php?act=modules&do=managedata&mdo=backupXLSresult&page_id={$page_id}&tag_id={$tag_id}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}&p=1&chancel=0'" type="button">
      			</p>
    			</center>
    		{/if}
    		{/foreach}
    	{/if}
    
    	{if $messages}    					
    	{if !$smarty.session.___GoodCMS.read_only}
   	 		<center>
      		<p id="messages block" style="margin-top:0px;color:yellow;font-weight:normal">
      		{foreach from=$messages item=msg}
      			{$msg}<br>
        	{/foreach}
        	</p>
    		</center>
    		<script language="JavaScript">
    		Morphing("messages block", false);
    		</script> 
    	{else}
    		<center>
    		<p id="messages block" style="margin-top:0px;color:yellow;font-weight:normal">{$MSGTEXT.edit_data_forbidden}<br>
    		</center>    
    	{/if}
    {/if}
    
    {if $search!==false && $info.block_type==2}
    	<center>
      	<p style="color:yellow">
      	{if $pages_navigations.records_count>0}
        	{$MSGTEXT.edit_data_search_result|sprintf:$search:$pages_navigations.records_count}
        {else}
        	{$MSGTEXT.edit_data_no_result|sprintf:$search}
        {/if}
        <a style="color:yellow" href="?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}&p=1&clean_seacrh=true"><b>{$MSGTEXT.edit_data_show_all_ent}</b></a></p>
   		 </center>
    {/if}
    
    {if $errors}    	
    	<table align="center" cellpadding="0" cellspacing="0" border="0">
      	{foreach from=$errors item=error}
      		{if $error!=''}
		      	<tr><td style="color:yellow">{$error}</td></tr>
        	{/if}
        {/foreach}
        </table>
        <br/>
    {/if}
    
    
    {if $messages || ($search!==false && $info.block_type==2) || $errors }
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td height="1px" bgcolor="#5b97c4"><img height="1px" src="images/zero.gif"></td>
            </tr>
            <tr>
              <td height="1px" bgcolor="#74a9d3"><img height="1px" src="images/zero.gif"></td>
           </tr>
      <tr>
        <td height="10px"></td>
      </tr>
    </table>
    {/if}
    
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="{if $info.block_type==2}margin-top:0px;{/if} margin-bottom:5px">
      {if $info.block_type==2 && !isset($smarty.get.filter_for_table)}
      <tr style="height:24px"> 
      {if $module_blocksTables|@count>1}
        <td align="left" width="40%">
        <table cellpadding="0" width="100%" align="left" cellspacing="0" border="0">
            <tr>
              <td align="left" nowrap><b>{$MSGTEXT.edit_data_edit}</b>&nbsp; </td>
              <td style="width:100%">
              <select class="edit_tables" style="width:100%" onchange="set_edit_table(this)">                  
				{foreach from=$module_blocksTables item=t}
					{if $t.show_type==1 || $table_name==$t.table_name}
                		<option {if $table_name==$t.table_name} selected {/if} value="{$t.table_name}">{$t.description}</option>
                  	{/if}
				{/foreach}
                </select>
                </td>
              
            </tr>
          </table>
          </td>
        <td width="30px"><img width="15px" src="images/zero.gif"></td>
        {/if}
        
        <td align="right">
        <form onsubmit="return checkSearchList()" action="index.php?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}&p=1" method="POST" style="margin:0px">            
	    <table cellpadding="0" cellspacing="0" border="0">        	
          <tr>                        
            <td align="left" nowrap>{$MSGTEXT.edit_data_search}&nbsp;</td>
            <td><input type="text" name="search" title="{$MSGTEXT.edit_data_search_type}" id="search field type" value="{$search}" style="width:120px"></td>
              
			 <td>
              <select style="width:50px" title="{$MSGTEXT.edit_data_select_rule}" name="search_by_rule" id="search by rule">
              <option {if $search_by_rule==0} selected {/if} value="0">%</option>                
              <option {if $search_by_rule==1} selected {/if} value="1">=</option>                
              </select>
              </td>
                                      
            <td width="100%"><input type="hidden" value="{$page_id}" name="page_id">
              <input type="hidden" value="{$tag_id}" name="tag_id">
              <input type="hidden" value="{$table_name}" name="t_name">
              <input type="hidden" value="modules" name="act">
              <input type="hidden" value="managedata" name="do">
              <select style="width:100%" title="{$MSGTEXT.edit_data_select_field}" name="search_by_field" id="search by field">
              <option style="color:gray" value="">{$MSGTEXT.edit_data_select_field}</option>                
			  {foreach from=$fields item=field}
                <option {if $search_by_field==$field.fieldname} selected {/if} value="{$field.fieldname}">{$field.comment}</option>                
			  {/foreach}
              </select>
              </td>                            
              
            <td width="5px">&nbsp;</td>
            <td width="15px"><input type="submit" class="button" value="{$MSGTEXT.edit_data_search2}"></td>
            </tr>            
          </table>
          </td>
      	</tr>
       </form>      
      {/if}
      
      {if $filter}
      <tr>
        <td colspan="100%">
        <table {if $info.block_type==2}style="margin-top:10px"{/if} cellpadding="0" cellspacing="0" border="0" width="100%">
            {if $info.block_type==2 && !$smarty.get.filter_for_table}
            <tr>
              <td height="1px" bgcolor="#5b97c4"></td>
            </tr>
            <tr>
              <td height="1px" bgcolor="#74a9d3"></td>
            </tr>
            <tr>
              <td height="5"></td>
            </tr>
            {/if}
            
            {if $smarty.get.hide_menu && !$smarty.get.fastEdit}
            <tr>
              <td height="25px" align="left" valign="top"><b>{$MSGTEXT.edit_data_filter_sempling}:</b>{if $smarty.get.opener_f_name}&nbsp;&nbsp;&nbsp;<b style="color:yellow">{$MSGTEXT.edit_data_filter_select_filter}</b>{/if}</td>
            </tr>
            {/if}
            
            <tr>
              <td width="100%">
              <table title="{$MSGTEXT.edit_data_filter_sempling}" width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                  {assign var='ind_k' value=3}
                  {foreach from=$fields item=field}
                  	{if $field.filter==1}
                    	{if $field.sourse_field_name!='' || $field.edittype_id==5 || $field.edittype_id==13 || $field.datatype_id==24 || $field.datatype_id==25 || $field.datatype_id==4 || $field.datatype_id==12 || $field.datatype_id==13}
                    		{assign var='dfilter' value=$data_filter.$table_name}
                    		{assign var='dfieldname' value=$field.fieldname}
                    		{if $ind_k==3}{assign var='ind_k' value=0}
                    			</tr>
	                  			<tr>
                  			{/if}
    		                {assign var='ind_k' value=$ind_k+1}
                    <td width="1%" nowrap valign="middle"><font color="#35678d">{$field.comment}: </font></td>
                    <td width="30%" align="left" valign="middle" style="height:25px">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td width="100%" align="left">
                          {if $field.edittype_id==5}
                            <select style="width:100%" onchange="set_filter(this, '{$field.fieldname}')">
                              <option selected style="color:gray" value="">{$MSGTEXT.edit_data_not_set}</option>
                              <option {if $dfilter.$dfieldname==1} selected {/if} value="1">{$MSGTEXT.edit_data_yes}</option>
                              <option {if $dfilter.$dfieldname==0 && $dfilter.$dfieldname!=""} selected {/if} value="{if $field.datatype_id!=24 && $field.datatype_id!=25}0{/if}">{$MSGTEXT.edit_data_no}</option>
                            </select>
                            {else}
                            {if $field.datatype_id==4 || $field.datatype_id==12 || $field.datatype_id==13}
                           		{if !$calid}{assign var="calid" value=1}{else}{assign var="calid" value=$calid++}
                           	{/if}
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                              <tr>
                                <td valign="middle"><input type="text" onclick="this.value=''; set_filter_by_date({$calid}, '{$field.fieldname}')" readonly id="calendar_value_from {$calid}" type="text" style="width:115px" onchange="set_filter_by_date({$calid}, '{$field.fieldname}')" value="{$dfilter.$dfieldname[0]}"></td>
                                <td><img style="cursor:pointer" id="set_calendar_from {$calid}" src="images/calendar_add.png"></td>
                                <td align="center" width="20px"> <font color="#35678d">{$MSGTEXT.edit_data_do}</font> </td>
                                <td valign="middle"><input type="text" onclick="this.value=''; set_filter_by_date({$calid}, '{$field.fieldname}')" onclick="this.value=''" readonly id="calendar_value_to {$calid}" type="text" style="width:115px" onchange="set_filter_by_date({$calid}, '{$field.fieldname}')" value="{$dfilter.$dfieldname[1]}"></td>
                                <td><img style="cursor:pointer" id="set_calendar_to {$calid}" src="images/calendar_add.png"></td>
                              </tr>
                            </table>
                            
                            {literal} 
                            <script type="text/javascript">Calendar.setup({inputField : '{/literal}calendar_value_from {$calid}', ifFormat : "{if $field.datatype_id==4}%Y-%m-%d{else}%Y-%m-%d %H:%M{/if}", button: 'set_calendar_from {$calid}{literal}'});</script>{/literal}
                            {literal} 
                            <script type="text/javascript">Calendar.setup({inputField : '{/literal}calendar_value_to {$calid}', ifFormat : "{if $field.datatype_id==4}%Y-%m-%d{else}%Y-%m-%d %H:%M{/if}", button: 'set_calendar_to {$calid}{literal}'});</script>{/literal}
                            {else}                            
                            {if $field.edittype_id==13}
                            	<select style="width:100%" onchange="set_filter(this, '{$field.fieldname}')">                              
								{assign var='sourse_values' value="list_filter_`$field.fieldname`"}
    	                          <option value="" style="color:gray">{$MSGTEXT.edit_data_not_specified}</option>                              
								{foreach from=$field.$sourse_values item=list}
            		            <option value="{$list.id}" {if $dfilter.$dfieldname==$list.id} selected{/if}>{$list.name} → {$list.description}</option>
                    	        {/foreach}
                            </select>
                            {else}
                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                              <tr>
                                <td width="100%">
                                <select id="filterselect {$field.fieldname}" style="width:100%" onchange="set_filter(this, '{$field.fieldname}')">
                                    <option value="" style="color:gray">{$MSGTEXT.edit_data_not_specified}</option>                                    
									{assign var='sourse_values' value="list_filter_`$field.fieldname`"}
									{if $field.datatype_id!=24 && $field.datatype_id!=25}
										{assign var='sourse_list' value=$field.$sourse_values}
										{assign var='sourse_field_name' value=$field.sourse_field_name}
										{foreach from=$sourse_list item=s}
	                                    	<option {if $dfilter.$dfieldname==$s.id} selected{/if} value="{$s.id}">{if $field.is_tree}{assign var='deep' value="`$field.fieldname`_deep"}{section name=foo start=0 loop=$s.$deep step=1}    {/section}{/if}{$s.$sourse_field_name}</option>
    	                                {/foreach}
									{else}
										{foreach from=$field.$sourse_values item=list}
                                    	<option value="{$list}" {if $dfilter.$dfieldname==$list}selected{/if}>{$list}</option>
                                    {/foreach}
                                    {/if}
                                  </select></td>
                                {if $field.have_sourse_filter  && !$search}
                                	<td><img style="cursor:pointer" onclick="openPopupFilter('index.php?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&p=1&hide_menu=true&t_name={$field.table_name}&opener_f_name=filterselect+{$field.fieldname}&own_f_name={$field.sourse_field_name}&f_name={$field.fieldname}&filter_for_table={$field.table_id}')" border="0" title="{$MSGTEXT.edit_data_filter_settings}" height="16px" src="images/filter.png"></td>
                                {/if}
                                </tr>
                            </table>
                            {/if}
                            {/if}
                            {/if}
                            </td>
                        </tr>
                      </table>
                      </td>
                    {if $ind_k<3}
                    <td width="1%"><img width="15px" src="images/zero.gif"></td>
                    {/if}
                    {/if}
                    {/if}
                    {/foreach}
                    {if $ind_k<3 || $ind_k==3}
                    <td width="100%" colspan="100%"></td>
                    {/if}
                    </tr>
                </table>
                </td>
            </tr>
          </table>
          </td>
      </tr>
    </table>
    {/if}
    
    {if $info.block_type==2}    
    <table border="0" width="100%" cellpadding="1" cellspacing="0">
        <tr bgcolor="#ccdbe6">
        <td valign="top">        
        <table style="margin-top:0px" align="center" border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="top_list" nowrap>
        {foreach from=$fields item=field}
          {if $field.show_in_list==1}
          	<td style="width:{$field.width_percent}%" {if $field.edittype_id==5 || $field.edittype_id==10 || $field.edittype_id==11 || $field.edittype_id==12 || $field.edittype_id==16} align="center" {/if} nowrap><a class="table_top" href="?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&sort_by={$field.fieldname}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}">{if $field.comment!=''}{$field.comment}{else}{$field.fieldname}{/if}</a> {if $sort_by==$field.fieldname}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}&nbsp;</td>
          {/if}
        {/foreach}
          <td nowrap style="width:65px" align="center" valign="middle"><img width="13px" title="{$MSGTEXT.edit_data_apply}" onclick="javascript:applySorts()" hspace="0" src="images/apply.gif" style="cursor:pointer">&nbsp;<a class="table_top" href="?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&sort_by=sort_index&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}">{$MSGTEXT.edit_data_sort}</a>{if $sort_by=='sort_index'}&nbsp;<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td><img width="3px" src="images/zero.gif"></td>
          <td><input onClick="CheckAll(this, 'rows[]');" id="main CheckBox" type="checkbox" value="1">
          <td><img width="3px" src="images/zero.gif"></td>
          <td><img title="{$MSGTEXT.edit_data_remove}" onclick="applyDelete()" src="images/delete_b.gif" border="0" style="cursor:pointer"></td>
        </tr>
        
        
        {if $needData}
        <form style="margin:0px" id="primenit obnovlenie" action="?act=modules&do=managedata&mdo=updaterows&page_id={$page_id}&tag_id={$tag_id}&id={$currentData.$pk_incr_fieldname}&p={$p_num}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}" method="POST">
          <input name="actiontype" id="actiontype" value="update" type="hidden">
          <input name="check_allrows" id="check allrows" value="0" type="hidden">
          {foreach name="data_rows" from=$needData item=item}
          <tr style="height:1px"></tr>
          
          <tr bgcolor='white' style="z-index:10px" id="row {$item.$pk_incr_fieldname}" onclick="golink('{$item.$pk_incr_fieldname}')" {if $item.$pk_incr_fieldname==$currentData.$pk_incr_fieldname}class="row_selected"{else}class="row_not_selected"{/if} onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)">
          {foreach name="fieldlist" from=$fields item=field}
            {if $field.show_in_list==1}
              <td {if $field.edittype_id==5 || $field.edittype_id==10 || $field.edittype_id==11 || $field.edittype_id==12 || $field.edittype_id==16} align="center" {/if}  valign="top">
              
            {assign var="ind" value=$field.fieldname}
            {if $field.edittype_id!=5}            
            	{if $field.edittype_id==1}
		            {$item.$ind}
        	    {else}            
            	{if $field.edittype_id==2 || $field.edittype_id==7 || $field.edittype_id==8}
            		{$item.$ind|truncate:400:'...':false:false}
            	{else}            
            	{if $field.edittype_id==3 || $field.edittype_id==6}
            		{if $field.datatype_id!=24 && $field.datatype_id!=25}
            			{assign var='sv' value="`$field.fieldname`_caption"}
            			{if $item.$sv}
            				{$item.$sv}
            			{else}
            				<font color="Gray">{$MSGTEXT.edit_data_not_specified}</font>
            			{/if}
            		{else}
            		{if $item.$ind}
            			{$item.$ind}
            		{else}
            			<font color="Gray">{$MSGTEXT.edit_data_not_specified}</font>
            		{/if}
            	{/if}            
            {else}            
            {if $field.edittype_id==4}
            	{assign var='sourse_values' 	value="list_`$field.fieldname`"}
            	{foreach name='foreach_multy' from=$item.$sourse_values item=m}
            		{if $m!=''}
            			<img hspace="5" src="images/active.gif">{$m}<br>
		            {else}
		            	<font color="Gray">{$MSGTEXT.edit_data_not_specified}</font>
		            {/if}
	            {/foreach}            
    	    {else}            
        	    {if $field.edittype_id==13}
            		{assign var='sourse_values' 	value="list_`$field.fieldname`"}
            		{assign var='sourse_list' 		value=$field.$sourse_values}
            		{assign var='source_id' 		value="id`$item.$ind`"}
            		{if $source_id!='id0'}
            			{$sourse_list.$source_id.name}<br>
            		{else}
            			<font color="Gray">{$MSGTEXT.edit_data_not_specified}</font>
            		{/if}            
            	{else}            
            	{if $field.edittype_id==9}
            		{if $item.$ind}
	            		<a onclick="otmenit()" href="../modules/{$module_name}/management/storage/images/{$current_tablename_no_prefix}/{$field.fieldname}/{$item.$pk_incr_fieldname}/{$item.$ind}" target="_blank"> <img {if $field.avator_width>40}width="40px"{/if} class="ramka" src="../modules/{$module_name}/management/storage/images/{$current_tablename_no_prefix}/{$field.fieldname}/{$item.$pk_incr_fieldname}/preview/{$item.$ind}" border="0"></a>
            		{/if}
    	        {else}
        		    {if $field.edittype_id==10} 
        		    	<a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&mdo=photos_form&hide_menu=true&t_name={$table_name}&f_name={$fieldname}&id={$currentData.$pk_incr_fieldname}')"><img border="0" src="images/picture_edit.png"></a> 
        		    {else}
            			{if $field.edittype_id==11}
            				{if $item.$ind}
            					<a onclick="otmenit()" href="../modules/{$module_name}/management/storage/files/{$current_tablename_no_prefix}/{$field.fieldname}/{$item.$pk_incr_fieldname}/{$item.$ind}" target="_blank"><img border="0" src="images/attach.png"></a> 
           					{/if}
            				{else}
            					{if $field.edittype_id==12}
            						<a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&mdo=files_form&hide_menu=true&t_name={$table_name}&f_name={$fieldname}&id={$currentData.$pk_incr_fieldname}')"><img border="0" src="images/tag_blue_edit.png"></a> 
            					{else}
            					{if $field.edittype_id==16}
	            					<input onChange="vkl(1, '{$ind}', '{$item.$pk_incr_fieldname}', '{$field.edittype_id}')" type="radio" name="{$field.fieldname}" id="{$field.fieldname}" {if $item.$ind==1} checked {/if} value="1">
    					        {else}
            						{$item.$ind}
            					{/if}
            				{/if}
            			{/if}
            		{/if}
            	{/if}
            {/if}
            {/if}
            {/if}
            {/if}
            {/if}
            {else}            
            	{if $item.$ind==1} 
            		<img title="{$MSGTEXT.edit_data_off}" onclick="vkl(0, '{$ind}', '{$item.$pk_incr_fieldname}', '{$field.edittype_id}')" src="images/icons/check.gif" border="0"> {else} <img title="{$MSGTEXT.edit_data_on}" onclick="vkl(1, '{$ind}', '{$item.$pk_incr_fieldname}', '{$field.edittype_id}')" src="images/icons/not_check.gif" border="0"> 
            	{/if}
            {/if}
            </td>          
            {/if}            
          {/foreach}                     
          
          <td align="center" valign="top" nowrap><input type="text" onclick="otmenit()" name="sortindexes_{$item.$pk_incr_fieldname}" value="{$item.sort_index}" style="width:50px"></td>
          <td><img width="3px" src="images/zero.gif"></td>
          <td height="22px" valign="top"><input value="{$item.$pk_incr_fieldname}" id="checkbox {$item.$pk_incr_fieldname}" onclick="selectRow({$item.$pk_incr_fieldname})" type="checkbox" name="rows[]"></td>
          <td><img width="3px" src="images/zero.gif"></td>
          <td valign="top"><img title="{$MSGTEXT.edit_data_remove}"  onclick="delOneRecord({$item.$pk_incr_fieldname})" src="images/delete_b.gif" border="0"></a><input type="hidden" name="ids_{$smarty.foreach.data_rows.iteration}" value="{$item.$pk_incr_fieldname}"></td>
         </tr>          
       {/foreach}
        </form>        
        
        {else}
        <tr>
          <td align="center" height="30px" colspan="100%" bgcolor='white' style="z-index:10px"><font color="gray"><i>{$MSGTEXT.edit_data_not_found}</i></font></td>
        </tr>
        {/if}                          
      </table>                  
        </td>
        </tr>      
    </table>
    
    
    <table  style="margin-top:0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr id="records details buttons" style="{if $smarty.cookies.display_menu_details=='true'}display:table-row{else}display:none{/if}" class="show_details_place" bgcolor="#cde1f0">
        <td align="left">
        	<table width="100%" cellpadding="2" cellspacing="2" border="0">            
        	<tr>
              <td valign="middle" nowrap><font style="color:#254c6b">{$MSGTEXT.edit_data_print_page}: &nbsp;</td>
              <td valign="middle">
               <select style="color:#254c6b" onchange="setRecordsForPage(this)">
                  <option {if $smarty.const.SETTINGS_RECORDS_FOR_PAGE==5} selected {/if} value="5">5</option>
                  <option {if $smarty.const.SETTINGS_RECORDS_FOR_PAGE==10} selected {/if} value="10">10</option>
                  <option {if $smarty.const.SETTINGS_RECORDS_FOR_PAGE==15} selected {/if} value="15">15</option>
                  <option {if $smarty.const.SETTINGS_RECORDS_FOR_PAGE==20} selected {/if} value="20">20</option>
                  <option {if $smarty.const.SETTINGS_RECORDS_FOR_PAGE==30} selected {/if} value="30">30</option>
                  <option {if $smarty.const.SETTINGS_RECORDS_FOR_PAGE==40} selected {/if} value="40">40</option>
                  <option {if $smarty.const.SETTINGS_RECORDS_FOR_PAGE==50} selected {/if} value="50">50</option>
                  <option {if $smarty.const.SETTINGS_RECORDS_FOR_PAGE==100} selected {/if} value="100">100</option>
                </select>
                </td>
              <td nowrap><font style="color:#254c6b">&nbsp;&nbsp;&nbsp;{$MSGTEXT.edit_data_founded_records} <b>{$pages_navigations.records_count}</b></font></td>
              <td width="100%">&nbsp;</td>
              <td><input type="button" class="button_details" value="{$MSGTEXT.edit_data_create_report}" onclick="openManageWindow('export_data.php?page_id={$page_id}&tag_id={$tag_id}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}','500','450')" ></td>
              <td><img width="5px" src="images/zero.gif"></td>
              <td><input class="button_details" type="button" value="{$MSGTEXT.edit_data_import_report}" onclick="openManageWindow('import_xls.php?page_id={$page_id}&tag_id={$tag_id}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}','500','350')"></td>
              <td><img width="15px" src="images/zero.gif"></td>
              <td><a class="records_settings" href="javascript:applySorts()"><img border="0" src="images/apply.gif"></a></td>
              <td nowrap><a class="records_settings" href="javascript:applySorts()">{$MSGTEXT.edit_data_apply}</a></td>
              <td><img width="5px" src="images/zero.gif"></td>
              <td><a class="records_settings" href="javascript:applyDelete()"><img border="0" src="images/delete_b.gif"></a></td>
              <td nowrap><a class="records_settings" href="javascript:applyDelete()">{$MSGTEXT.edit_data_remove_selected}</a></td>
            </tr>
          </table>
          </td>
      </tr>
      <tr>
        <td  style="height:6px" class="show_details_fon" align="center" valign="top"><img title="{if $smarty.cookies.display_menu_details=='false'}{$MSGTEXT.lib_js_show_menu_details}{else}{$MSGTEXT.lib_js_hide_menu_details}{/if}" class="show_details" onmouseover="on('hidebutton for records details')" onmouseout= "off()" id="hidebutton for records details" onclick="show_hide_details('records details buttons', this)" src="images/more_show.png"></td>
      </tr>
      <tr>
        <td  height="1px" bgcolor="#5b97c4"></td>
      </tr>
      <tr>
        <td>
        <table  cellpadding="0" cellspacing="0" border="0" width="100%">
            <tr id="records details settings" style="{if $smarty.cookies.display_menu_settings=='true'}display:table-row{else}display:none{/if}" class="show_details_place" bgcolor="#cde1f0">
              <td>
              <table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td colspan="100%"  height="5px"></td>
                  </tr>
                  <tr>
                    <td valign="middle">&nbsp;<a href="javascript:openBlockSettingsWindow('?act=modules&do=settings&hide_menu=true&id={$edit_block.block_id}{if $smarty.get.fastEdit}&fastEdit=true{/if}')"><img border="0" src="images/config_small.png"></a></td>
                    <td width="5px">&nbsp;</td>
                    <td valign="middle"><a class="records_settings" href="javascript:openBlockSettingsWindow('?act=modules&do=settings&hide_menu=true&id={$edit_block.block_id}{if $smarty.get.fastEdit}&fastEdit=true{/if}')">{$MSGTEXT.block_settings}</a></td>
                    <td>
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td width="20px">&nbsp;</td>
                          <td><a href="/admin/index.php?act=languagesofmaterial&page"><img border="0" hspace="5" src="images/config-language.png"></a></td>
                          <td><select style="width:150px;color:#254c6b" onchange="setLang(this)">
                              <option value="0" style="color:gray">{$MSGTEXT.edit_data_uncnown_lang}</option>                              
								{foreach key="prefix" from=$LANGUAGES_OF_MATERIAL item=lang}
                            	  <option {if !$smarty.get.lang_id}{if $smarty.const.SETTINGS_LANGUAGE_OF_MATERIALS==$prefix}selected{/if}{else}{if $smarty.get.lang_id==$lang.id}selected{/if}{/if} value="{$prefix}">{$lang.caption}</option>                              
								{/foreach}
                            </select>
                            </td>
                          <td style="color:#254c6b">&nbsp;{$MSGTEXT.lang_set}</td>
                        </tr>
                      </table>
                      </td>
                    <td>
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td width="20px"></td>
                          <td><input {if $smarty.const.SETTINGS_EDIT_MODE==1} checked{/if} type="checkbox" onclick="setEditMode(this)" value="1"></td>
                          <td style="color:#254c6b">&nbsp;{$MSGTEXT.set_edit_type}</td>
                        </tr>
                      </table>
                      </td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td height="6px" class="show_details_fon" align="center"><img title="{if $smarty.cookies.display_menu_settings=='false'}{$MSGTEXT.lib_js_show_menu_settings}{else}{$MSGTEXT.lib_js_hide_menu_settings}{/if}" class="show_details" onmouseover="on('hidebutton for records settings')" onmouseout= "off()" id="hidebutton for records settings" onclick="show_hide_settings('records details settings', this)" src="images/more_show_settings.png"></td>
            </tr>
          </table>
          </td>
      </tr>
      <tr>
        <td height="5px"></td>
      </tr>
      {if $pages_navigations.page_count>0}
      <tr>
        <td  align="left"> {$MSGTEXT.edit_data_pages}:&nbsp;
          {section name=foo start=0 loop=$pages_navigations.page_count step=1} <a {if $smarty.section.foo.iteration==$pages_navigations.p_selected} class="sel_page_navigate" {/if} href="?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}&p={$smarty.section.foo.iteration}">{$smarty.section.foo.iteration}</a>  
          {/section} <br>
          &nbsp; </td>
      </tr>
      {/if}
    </table>
    {else}
    	{if $module_blocksTables|@count>1}
    	<table cellpadding="2" cellspacing="2" border="0">
	      <tr>
    	    <td align="left" nowrap><b>{$MSGTEXT.edit_data_edit}</b>&nbsp; </td>
        	<td><select onchange="set_edit_table(this)">            
			{foreach from=$module_blocksTables item=t}
            	<option {if $table_name==$t.table_name} selected {/if} value="{$t.table_name}">{$t.description}</option>            
			{/foreach}
          </select>
          </td>        
      </tr>
    </table>
    {/if}
    {/if}        
    
  {if $info.block_type==1}
  <table cellpadding="0" cellpadding="0" border="0">
    <tr>
      <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=settings&hide_menu=true&id={$info.block_id}{if $smarty.get.fastEdit}&fastEdit=true{/if}')"><img border="0" src="images/config.png"></a></td>
      <td valign="middle">&nbsp;<a href="javascript:openBlockSettingsWindow('?act=modules&do=settings&hide_menu=true&id={$info.block_id}{if $smarty.get.fastEdit}&fastEdit=true{/if}')">{$MSGTEXT.block_settings}</a></td>
      <td>
      	<table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td width="20px"></td>
                  <td><a href="/admin/index.php?act=languagesofmaterial&page"><img border="0" hspace="5" src="images/config-language.png"></a></td>
                  <td><select style="width:150px" onchange="setLang(this)">
                      <option value="0" style="color:gray">{$MSGTEXT.edit_data_uncnown_lang}</option>                      
						{foreach key="prefix" from=$LANGUAGES_OF_MATERIAL item=lang}
                      		<option {if !$smarty.get.lang_id}{if $smarty.const.SETTINGS_LANGUAGE_OF_MATERIALS==$prefix}selected{/if}{else}{if $smarty.get.lang_id==$lang.id}selected{/if}{/if} value="{$prefix}">{$lang.caption}</option>                      
						{/foreach}
                    </select>
                    </td>
                  <td>&nbsp;{$MSGTEXT.lang_set}</td>
                  </tr>
             </table>
              </td>
          </tr>
      	</table>
      </td>
    </tr>
  </table>
  {/if}

	{foreach from=$additional_buttons item=ab}
		{if $ab.target==''}
		<p style="text-align:right">
			<input type="button" class="button_additional" onclick="window.open('{$ab.url}', '_blank')" value="{$ab.caption}" >
		</p>
		{/if}
	{/foreach}
	
  {if ($smarty.const.SETTINGS_EDIT_MODE==1 || $info.block_type==1) && !isset($smarty.get.filter_for_table) && $activated}
  <form id="data form" action="?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&mdo=saveedit&id={$currentData.$pk_incr_fieldname}&p={$p_num}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}&edit={if $currentData.$pk_incr_fieldname==0}insert{else}save{/if}" method="POST" enctype="multipart/form-data" 
  style="width:100%;margin:0;margin-top:10px">
    <table class="formborder" border="0" cellpadding="0" cellspacing="1" style="width:100%">
      <tr>
        <td>
        <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0" width="100%">
            <tr>
              <td width="100%" valign="top">
              <table class="formbackground" border="0" cellpadding="0" cellspacing="4" width="100%">
                  <tr {if $info.block_type==2}height="35px"{/if} valign="top">
                    <td align="right"> 
                    {if $info.block_type==2}
                      {if $currentData.$pk_incr_fieldname==0}
                      	<input type="button" class="button_insert" onclick="set_action('insert')" value="{$MSGTEXT.edit_data_add}" style="width:100px">
                      {else}
                      {foreach from=$additional_buttons item=ab}
                      	{if $ab.target!=''}
                      		<input type="button" class="button_additional" onclick="{if $ab.target=='_self'}location.href='{$ab.url}&id={$currentData.$pk_incr_fieldname}'{/if}{if $ab.target=='_new'}openManageWindow('{$ab.url}&id={$currentData.$pk_incr_fieldname}', 850, 800){else}{if $ab.target=='_blank'}window.open('{$ab.url}&id={$currentData.$pk_incr_fieldname}', '_blank'){/if}{/if}" value="{$ab.caption}" >
                      	{/if}
                      {/foreach}
                     	 <input type="button" class="button_update" onclick="set_action('save')" value="{$MSGTEXT.edit_data_save}" style="width:100px">
                      	<input type="button" class="button_insert" onclick="set_action('insert')" value="{$MSGTEXT.edit_data_add}" style="width:100px">	                      
    	                  <input type="button" class="button_new" onclick="location.href='?act=modules&do=managedata&page_id={$page_id}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}&tag_id={$tag_id}&p={$p_num}#data form'" value="{$MSGTEXT.edit_data_add_rec}" style="width:110px">
    	                  <input type="button" class="button_delete" onclick="set_action('delete')" value="{$MSGTEXT.edit_data_remove}" style="width:100px">
                      {/if}
                    {else}
                    	<input type="button" class="button_update" onclick="set_action('save')" value="{$MSGTEXT.edit_data_save}" style="width:100px">
                    {/if}
                    </td>
                  </tr>
                  
                  {assign var="enable_fiedls" value=0}
                  {foreach name="fields" from=$fields item=field}                  
                  	{if $field.active==1 && $field.edittype_id>0}
                  	  {assign var="enable_fiedls" value=$enable_fiedls+1}	                       	
            		  {if $field.group_caption!=$group_caption || $field.group_caption==''}	
    		          	{if $st}    	    		          		      	
	    		      		</tr>
	    		      			</table>
	    		      				</td>
	    		      					</tr>	    		      					
	    		      	{/if}	
	    		      	{assign var="st" value=true}    	    		              		          
	  
	    		      		<tr>
	    		      			<td>
	    		      			<table cellpadding="1" cellspacing="1" border="0" width="100%">	
	    		      				<tr>
	    		  	   {/if}
	    		  	  {assign var="group_caption" value=$field.group_caption}    	    		              		          
	    		  	   						    		  	 
	    		  	 <td valign="bottom" width="20%">
    		          <table cellpadding="0" cellspacing="1" border="0" width="100%">	    		              		          	    		  	          	
                  	               	
	                  {assign var=fieldname value=$field.fieldname}
    		          {if  $field.edittype_id!=5 && $field.edittype_id!=8 && $field.edittype_id!=10 && $field.edittype_id!=12 && $field.edittype_id!=16}
    		          	<tr style="display:table-row" id="tr_{$field.fieldname}">    		          
                    	   <td>
                    			<table cellpadding="0" cellspacing="0" border="0">
                        			<tr> 
	                         		{if $field.sourse_table_name!='' && $field.edittype_id!=14 && $field.edittype_id!=15}
    	                      			<td valign="bottom"> {assign var=sourse_block value=$field.sourse_block} <a href="javascript:openManageWindow('index.php?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&p=1&hide_menu=true&t_name={if $field.sourse_table_name==''}{$field.table_name}{else}{$field.sourse_table_name}{/if}{if $field.edittype_id==4}&search={foreach name="mas" from=$currentData.$fieldname item=msind}{$msind.id}{if !$smarty.foreach.mas.last},{/if}{/foreach}{else}{if $currentData.$fieldname}&search={$currentData.$fieldname}{/if}{/if}', '1000', '700')"><img title="{$MSGTEXT.edit_edit_list}" border="0" width="16px" src="images/editlist.png"></a></td>
        	                 			<td width="5px"></td>
            	             			
                	          			{if $field.own_filter && $field.edittype_id!=4}
                    	      				<td>
                        	  					<table border="0" cellpadding="0" cellspacing="0">
                          							<tr>
                          								<td><img style="cursor:pointer" onclick="openPopupFilter('index.php?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&p=1&hide_menu=true&t_name={$field.table_name}&opener_f_name={$field.fieldname}&own_f_name={$field.sourse_field_name}&filter_for_table={$field.table_id}')" border="0" title="{$MSGTEXT.edit_data_filter_settings}" height="16px" src="images/filter.png"></td>                          							
	                          						</tr>
    	                      					</table>
                           					</td>
										{/if}
    	                     		{/if}
        	                  		<td valign="middle" class="fcaption">{$field.comment}:</td>
            	            		</tr>
                	    		</table>
                    		</td>
                    	</tr>	
                  
                  	{else}                  		    		                		    		      					    		      				                  
    		          <tr style="display:table-row" id="tr_{$field.fieldname}">                  		
	                  	<td height="10px"></td>
					  </tr>
    	            {/if}
    	                	            
                  <tr style="display:table-row" id="tr2_{$field.fieldname}">
                    <td id="td {$field.fieldname}"  >
                    
                    {if $field.edittype_id==1}
                      <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td width="100%" align="left"><input type="text" {if ($CopyNewContent.$fieldname) || $translit_fields.$fieldname}onkeyup="{if $CopyNewContent.$fieldname }CopyNewContent('{$field.fieldname}', new Array({foreach name='fa' from=$CopyNewContent.$fieldname item=cnc}'{$cnc}'{if !$smarty.foreach.fa.last},{/if}{/foreach}), '{$field.fieldname}');{/if}{if $translit_fields.$fieldname}translitFields('{$field.fieldname}', '{$translit_fields.$fieldname}'){/if};" {/if}   {if $hide_fields.$fieldname} onchange="{$fieldname}', '{$hide_fields.$fieldname}', '')" {/if} value="{$currentData.$fieldname}" name="{$field.fieldname}" id="{$field.fieldname}" style=";{$field.style}{if $field.width}width:{$field.width};{else}width:100%;{/if}{if $field.height!=''}height:{$field.height}px{/if}"></td>
                          {if $translit_fields.$fieldname}
                          	<td nowrap align="left">
                          		<table border="0" cellpadding="0" cellspacing="0">
	                              <tr>
    	                            <td width="10px">&nbsp;&nbsp;</td>
        	                        <td><input type="checkbox" onclick="simulateOnChangeTranslit('{$field.fieldname}')" {if $currentData.$pk_incr_fieldname==0} checked {/if} value="1" id="create translit {$field.fieldname}"></td>
            	                    <td class="fcaption_small">&nbsp;{$MSGTEXT.edit_data_create_translit}</td>
                	              </tr>
                    	        </table>
                            </td>
                          	{/if}
                          {if $CopyNewContent.$fieldname}
                          	<td nowrap align="left">
	                          <table border="0" cellpadding="0" cellspacing="0">
    	                          <tr>
        	                        <td width="10px">&nbsp;&nbsp;</td>
            	                    <td align="left"><input type="checkbox" onclick="simulateOnChangeCopy('{$field.fieldname}')"  {if $currentData.$pk_incr_fieldname==0} checked {/if} value="1" id="create copy {$field.fieldname}"></td>
                	                <td class="fcaption_small">&nbsp;{$MSGTEXT.edit_data_create_podstanovky}</td>
                    	          </tr>
                        	    </table>
                            	</td>
                          {/if}
                          </tr>
                      </table>
                      {/if}
                      
                      {if $field.edittype_id==2}
                      	<table width="100%" cellpadding="0" cellspacing="0" border="0">
                        	<tr>
                          	<td width="100%" align="left">
	                      		<textarea                       
    	                  		{if ($CopyNewContent.$fieldname) || $translit_fields.$fieldname}onkeyup="{if $CopyNewContent.$fieldname }CopyNewContent('{$field.fieldname}', new Array({foreach name='fa' from=$CopyNewContent.$fieldname item=cnc}'{$cnc}'{if !$smarty.foreach.fa.last},{/if}{/foreach}), '{$field.fieldname}');{/if}{if $translit_fields.$fieldname}translitFields('{$field.fieldname}', '{$translit_fields.$fieldname}'){/if};" {/if}                        
        	              		{if $hide_fields.$fieldname} onkeyup="hideFields(this, '{$fieldname}', '{$hide_fields.$fieldname}', '')" {/if} name="{$field.fieldname}" id="{$field.fieldname}" style="width:100%;height:{if $field.height!=''}{$field.height}px{else}80px{/if}">{$currentData.$fieldname}</textarea>
                                            
           				  		{if $translit_fields.$fieldname}
                		          <td nowrap align="left">
                        			  <table border="0" cellpadding="0" cellspacing="0">
                        				<tr>
	                        			<td width="10px">&nbsp;&nbsp;</td>
    	                        		<td><input type="checkbox" onclick="simulateOnChangeTranslit('{$field.fieldname}')" {if $currentData.$pk_incr_fieldname==0} checked {/if} value="1" id="create translit {$field.fieldname}"></td>
        	                    		<td>&nbsp;{$MSGTEXT.edit_data_create_translit}</td>
										</tr>
                        			  </table>
								  </td>
                          		{/if}
                          		
                          		{if $CopyNewContent.$fieldname}
                          			<td nowrap align="left">
                          			<table border="0" cellpadding="0" cellspacing="0" >
                              		<tr>
                                		<td width="10px">&nbsp;&nbsp;</td>
                                		<td align="left"><input type="checkbox" onclick="simulateOnChangeCopy('{$field.fieldname}')"  {if $currentData.$pk_incr_fieldname==0} checked {/if} value="1" id="create copy {$field.fieldname}"></td>
                                		<td>&nbsp;{$MSGTEXT.edit_data_create_podstanovky}</td>
                              		</tr>
                            		</table>
                            	</td>
                          	{/if}                                     
                      		</tr>
                     	 </table>
                      {/if}                      
                                            
                      {if $field.edittype_id==3}
						<select 
						{if $field.obnovit} 
						onchange="{foreach from=$field.obnovit item=obnovit}refreshListByField(this.value, '{$obnovit.sourse_table_name}', '{$obnovit.sourse_field_name}', Array({foreach name='fa' from=$obnovit.fieldname_array item=fa}'{$fa}'{if !$smarty.foreach.fa.last},{/if}{/foreach}), '{$obnovit.sourse_field_name_next}');{/foreach}"
						{/if}
						{if $hide_fields.$fieldname} onchange="hideFields(this, '{$fieldname}', '{$hide_fields.$fieldname}', '')"{/if} name="{$field.fieldname}" id="{$field.fieldname}" style="width:100%;{if $field.height!=''}height:{$field.height}px{/if}">
                      {assign var='sourse_values' value="list_`$field.fieldname`"}
                      <option value="{if $field.datatype_id!=24 && $field.datatype_id!=25}0{/if}" style="color:gray">{$MSGTEXT.edit_data_not_specified}</option>
                      {assign var='dfieldname' value=$field.fieldname}
                      {if $field.datatype_id!=24 && $field.datatype_id!=25}
                      {assign var='sourse_field_name' value=$field.sourse_field_name}
                      {foreach from=$field.$sourse_values item=list}
                      <option {if $field.filter==1 && $dfilter.$dfieldname}{if $dfilter.$dfieldname==$list.id}selected{/if}{/if} value="{$list.id}" {if $list.id==$currentData.$fieldname}selected{/if}>
                      {if $field.is_tree}{assign var='deep' value="`$field.fieldname`_deep"}{section name=foo start=0 loop=$list.$deep step=1}    {/section}{/if}{$list.$sourse_field_name}
                      </option>
                      {/foreach}
                      {else}
                      {foreach from=$field.$sourse_values item=list}
                      <option value="{$list}" {if $field.filter==1 && $dfilter.$dfieldname}{if $dfilter.$dfieldname==$list}selected{/if}{else}{if $currentData.$fieldname}{if $list==$currentData.$fieldname}selected{/if}{else}{if $field.default==$list}selected{/if}{/if}{/if}>{$list}</option>
                      {/foreach}
                      {/if}
                      </select>
                      {/if}
                      
                      {if $field.edittype_id==4}
                      <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="50%" valign="bottom"><font color="#35678d">{$MSGTEXT.edit_data_selected_rec}:</font><br/>
                          	<input type="hidden" value="" name="{$field.fieldname}" />
                            <select style="width:100%;height:{if $field.height!=''}{$field.height}px{else}100px{/if}" name="{$field.fieldname}[]" id="{$field.fieldname}"
							{if $field.obnovit}onchange="{foreach from=$field.obnovit item=obnovit}refreshListByField(this.value, '{$obnovit.sourse_table_name}', '{$obnovit.sourse_field_name}', Array({foreach name='fa' from=$obnovit.fieldname_array item=fa}'{$fa}'{if !$smarty.foreach.fa.last},{/if}{/foreach}), '{$obnovit.sourse_field_name_next}' );{/foreach}"
							{/if}
							{if $hide_fields.$fieldname} onchange="hideFields(this, '{$fieldname}', '{$hide_fields.$fieldname}', '')"{/if} size="10" style="width:100%;height:{if $field.height!=''}{$field.height}px{else}80px{/if}" multiple>
                            {assign var='sourse_values' 	value="list_`$field.fieldname`"}
                            {assign var='sourse_field_name' value=$field.sourse_field_name}
                            {assign var='sourse_list' 		value=$field.$sourse_values}
                            
                            {if $currentData.$fieldname}
                            	{foreach from=$currentData.$fieldname item=msind}
                            		<option value="{$msind.id}">{$msind.caption}</option>
                            	{/foreach}
                            {/if}
                            </select></td>
                          <td width="20px" valign="middle"><img title="{$MSGTEXT.edit_data_add}" src="images/left.png" onclick="addSelected('{$field.fieldname}')" vspace="10" style="cursor:pointer"><br>
                            <img title="{$MSGTEXT.edit_data_remove}" src="images/right.png" onclick="deleteSelected('{$field.fieldname}')" style="cursor:pointer"></td>
                          <td width="50%" valign="bottom">
                          {if $field.own_filter}
                          	<table border="0" cellpadding="0" cellspacing="0">
                          		<tr>
                          			<td><img style="cursor:pointer" onclick="openPopupFilter('index.php?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&p=1&hide_menu=true&t_name={$field.table_name}&opener_f_name={$field.fieldname}+notselected_data&own_f_name={$field.sourse_field_name}&filter_for_table={$field.table_id}')" border="0" title="{$MSGTEXT.edit_data_filter_settings}" height="16px" src="images/filter.png"></td>
                          			<td>&nbsp;<font color="#35678d">{$MSGTEXT.edit_data_list_of_free_records}</font></td>
	                          	</tr>
    	                      </table>
                           {else}
        	                  <font color="#35678d">{$MSGTEXT.edit_data_list_of_free_records}</font> <br>
                           {/if}                          
                            <select id="{$field.fieldname} notselected_data" size="10" style="width:100%;height:{if $field.height!=''}{$field.height}px{else}100px{/if}" multiple>                              
							{foreach from=$field.$sourse_values item=list}
								{assign var='dobavit' value=1}
								{foreach from=$currentData.$fieldname item=msind}
									{if $list.id==$msind.id}{assign var='dobavit' value=0}{break}{/if}
								{/foreach}
								{if $dobavit}
                	              <option value="{$list.id}">{if $field.is_tree}{assign var='deep' value="`$field.fieldname`_deep"}{section name=foo start=0 loop=$list.$deep step=1}    {/section}{/if}{$list.$sourse_field_name}</option>
                    	        {/if}
                             {/foreach}
                            </select>
                            </td>
                        </tr>
                      </table>
                      {/if}                      
                      
                      {if $field.edittype_id==5}                      
                        <table cellpadding="0" cellspacing="0" border="0" class="fcaption_small">
                          <tr>
                            <td width="20px" valign="middle"><input {if $hide_fields.$fieldname} onclick="hideFields(this, '{$fieldname}', '{$hide_fields.$fieldname}', '')" {/if} type="checkbox"  class="checkbox" value="1" {if isset($currentData.$fieldname)} {if $currentData.$fieldname==1}checked{/if}{else}{if $field.default==1}checked{/if}{/if} name="{$field.fieldname}" id="{$field.fieldname}"></td>
                            <td valign="middle">{$field.comment}</td>
                          </tr>
                        </table>                      
                      {/if}
                      
                      {if $field.edittype_id==6}
                      <input checked type="radio" name="{$field.fieldname}" id="{$field.fieldname}" {if $currentData.$fieldname==''} checked {/if} value="{if $field.datatype_id!=24 && $field.datatype_id!=25}0{/if}">
                      <font color=white><i>{$MSGTEXT.edit_data_not_specified}</i></font> 
                      {assign var='sourse_values' value="list_`$field.fieldname`"}
                      {assign var='sourse_field_name' value=$field.sourse_field_name} <font id="div {$field.fieldname}"> {foreach from=$field.$sourse_values item=list}
                      <input {if $field.obnovit} onClick="{foreach from=$field.obnovit item=obnovit}refreshListByField(this.value, '{$obnovit.sourse_table_name}', '{$obnovit.sourse_field_name}', Array({foreach name='fa' from=$obnovit.fieldname_array item=fa}'{$fa}'{if !$smarty.foreach.fa.last},{/if}{/foreach}), '{$obnovit.sourse_field_name_next}');{/foreach}"{/if}
						{if $hide_fields.$fieldname} onchange="hideFields(this, '{$fieldname}', '{$hide_fields.$fieldname}', '')"{/if}
						class="radiobox" type="radio" name="{$field.fieldname}" value="{$list.id}" {if $list.id==$currentData.$fieldname} checked {/if}>
                      {$list.$sourse_field_name}   
                      {/foreach} </font> 
                      {if $hide_fields.$fieldname}
                      <div style="display:none" id="radiobox_hide_{$fieldname}">onClick="hideFields(this, '{$fieldname}', '{$hide_fields.$fieldname}', '')"</div>
                      {/if}
                      {/if}
                      
                      {if $field.edittype_id==7}
                      <textarea id="{$fieldname}" name="{$fieldname}" width="100%">{$currentData.$fieldname}</textarea>
                      {/if}
                      
                      {if $field.edittype_id==8}
                      <div class="fcaption_none"> {if $currentData.$pk_incr_fieldname}
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&mdo=popup_form&hide_menu=true&t_name={$table_name}&f_name={$fieldname}&id={$currentData.$pk_incr_fieldname}')"><img border="0" src="images/page_white_edit.png"></a></td>
                            <td width="5px"></td>
                            <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&mdo=popup_form&hide_menu=true&t_name={$table_name}&f_name={$fieldname}&id={$currentData.$pk_incr_fieldname}')"><b>{if $field.comment!=''}{$field.comment}{else}{$field.fieldname}{/if}</b></a></td>
                          </tr>
                        </table>
                        {else}
                        {$MSGTEXT.edit_data_edit_field} <b>«{if $field.comment!=''}{$field.comment}{else}{$field.fieldname}{/if}»</b> {$MSGTEXT.edit_data_can_only_be}
                        {/if}
                        </div>
                      {/if}
                      
                      {if $field.edittype_id==9}
                      {if $currentData.$fieldname}
                      <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td><a href="../modules/{$module_name}/management/storage/images/{$current_tablename_no_prefix}/{$field.fieldname}/{$currentData.$pk_incr_fieldname}/{$currentData.$fieldname}" target="_blank"><img class="ramka" hspace="1" align="left" src="../modules/{$module_name}/management/storage/images/{$current_tablename_no_prefix}/{$field.fieldname}/{$currentData.$pk_incr_fieldname}/preview/{$currentData.$fieldname}" border="0"></a></td>
                          <td width="15px"> </td>
                          <td>
                          <table cellpadding="0" cellspacing="0" border="0" class="fcaption_small">
                              <tr>
                                <td><input name="{$field.fieldname}_delete" value="{$currentData.$fieldname}" type="checkbox"></td>
                                <td>&nbsp;{$MSGTEXT.edit_data_remove}</td>
                              </tr>
                          </table>
                          </td>
                        </tr>
                      </table>
                      {/if}
                      <input type="file" value="{$MSGTEXT.edit_data_selected}" name="{$field.fieldname}" id="{$field.fieldname}" style="width:100%;{if $field.height!=''}height:{$field.height}px{/if}">
                      {/if}
                      
                      {if $field.edittype_id==10}
                      <div class="fcaption_small"> {if $currentData.$pk_incr_fieldname}
                        {assign var='count_images' value="count_`$field.fieldname`"}
                        
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&mdo=photos_form&hide_menu=true&t_name={$table_name}&f_name={$fieldname}&id={$currentData.$pk_incr_fieldname}')"><img border="0" src="images/picture_edit.png"></a></td>
                            <td width="5px"></td>
                            <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&mdo=photos_form&hide_menu=true&t_name={$table_name}&f_name={$fieldname}&id={$currentData.$pk_incr_fieldname}')"><b style="font-size:14px">{if $field.comment!=''}{$field.comment}{else}{$field.fieldname}{/if}</b></a>  {$MSGTEXT.edit_data_added} <b>{$field.$count_images}</b> {$MSGTEXT.edit_data_files} </td>
                          </tr>
                        </table>
                        
                        {else}
                        {$MSGTEXT.edit_data_edit_field} <b>«{if $field.comment!=''}{$field.comment}{else}{$field.fieldname}{/if}»</b> {$MSGTEXT.edit_data_can_only_be}
                        {/if}
                        </div>
                      {/if}
                      
                      {if $field.edittype_id==11}
                      {if $currentData.$fieldname}
                      <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td><a href="../modules/{$module_name}/management/storage/files/{$current_tablename_no_prefix}/{$field.fieldname}/{$currentData.$pk_incr_fieldname}/{$currentData.$fieldname}" target="_blank"><b>{$currentData.$fieldname}</b></a><br>
                            {assign var='file_size' value="size_`$field.fieldname`"}
                            {assign var='file_create' value="create_`$field.fieldname`"} <font style="font-size:9px">{$MSGTEXT.edit_data_creat}: <b>{$field.$file_create}</b></font><br>
                            <font style="font-size:9px">{$MSGTEXT.edit_data_size}: <b>{$field.$file_size} kb</b></font><br></td>
                          <td width="15px"> </td>
                          <td><input name="{$field.fieldname}_delete" value="{$currentData.$fieldname}" type="checkbox"></td>
                          <td>&nbsp;{$MSGTEXT.edit_data_remove}</td>
                        </tr>
                      </table>
                      {/if}
                      <input type="file" value="{$MSGTEXT.edit_data_selected}" name="{$field.fieldname}" id="{$field.fieldname}" style="width:100%;{if $field.height!=''}height:{$field.height}px{/if}">
                      {/if}
                      
                      {if $field.edittype_id==12}
                      <div class="fcaption_none"> {if $currentData.$pk_incr_fieldname}
                        {assign var='count_files' value="count_`$field.fieldname`"}
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&mdo=files_form&hide_menu=true&t_name={$table_name}&f_name={$fieldname}&id={$currentData.$pk_incr_fieldname}')"><img border="0" src="images/tag_blue_edit.png"></a></td>
                            <td width="5px"></td>
                            <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&mdo=files_form&hide_menu=true&t_name={$table_name}&f_name={$fieldname}&id={$currentData.$pk_incr_fieldname}')"><b>{if $field.comment!=''}{$field.comment}{else}{$field.fieldname}{/if}</b></a>  {$MSGTEXT.edit_data_added} <b>{$field.$count_files}</b> {$MSGTEXT.edit_data_files}</td>
                          </tr>
                        </table>
                        {else}
                        {$MSGTEXT.edit_data_edit_field} <b>{if $field.comment!=''}{$field.comment}{else}{$field.fieldname}{/if}</b> {$MSGTEXT.edit_data_can_only_be}
                        {/if}
                        </div>
                      {/if}
                      
                      {if $field.edittype_id==13}
                      <select
						{if $hide_fields.$fieldname} onchange="hideFields(this, '{$fieldname}', '{$hide_fields.$fieldname}', '')"{/if} name="{$field.fieldname}" id="{$field.fieldname}" style="width:100%;{if $field.height!=''}height:{$field.height}px{/if}">                        
						{assign var='sourse_values' value="list_`$field.fieldname`"}
                        <option value="{if $field.datatype_id!=24 && $field.datatype_id!=25}0{/if}" style="color:gray">{$MSGTEXT.edit_data_not_specified}</option>                        
						{foreach from=$field.$sourse_values item=list}
                        <option value="{$list.id}" {if $list.id==$currentData.$fieldname}selected{/if}>{$list.name} → {$list.description}</option>
                        {/foreach}
                      </select>
                      {/if}
                      
                      {if $field.edittype_id==14}
                      <input type="text" {if $hide_fields.$fieldname} onkeyup="hideFields(this, '{$fieldname}', '{$hide_fields.$fieldname}', '')" {/if} value="{$currentData.$fieldname}" name="{$field.fieldname}" id="{$field.fieldname}" style="{$field.style}{if $field.width}width:{$field.width};{else}width:100%;{/if}{if $field.height!=''}height:{$field.height}px{/if}">
                      {/if}
                      
                      {if $field.edittype_id==15}
                      <textarea {if $hide_fields.$fieldname} onkeyup="hideFields(this, '{$fieldname}', '{$hide_fields.$fieldname}', '')" {/if} name="{$field.fieldname}" id="{$field.fieldname}" style="width:100%;height:{if $field.height!=''}{$field.height}px{else}80px{/if}">{$currentData.$fieldname}</textarea>
                      {/if}
                      
                      {if $field.edittype_id==16}
                      <div class="fcaption_small">
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td width="20px" valign="middle"><input style="margin:0" type="radio" name="{$field.fieldname}" id="{$field.fieldname}" {if isset($currentData.$fieldname)} {if $currentData.$fieldname==0}checked{/if}{else}{if $field.default==1}checked{/if}{/if} value="0"></td>
                            <td valign="middle"><font color=white><i>{$MSGTEXT.edit_data_not_specified}</i></font> </td>
                            <td width="20px" valign="middle"></td>
                            <td width="20px" valign="middle"><input style="margin:0" type="radio" name="{$field.fieldname}" id="{$field.fieldname}" {if isset($currentData.$fieldname)} {if $currentData.$fieldname==1}checked{/if}{else}{if $field.default==1}checked{/if}{/if} value="1"></td>
                            <td valign="middle">{$field.comment}</td>
                          </tr>
                        </table>
                      </div>
                      {/if}                                                    
                   			</td>
                   			</tr>
	    		     	</table>
	    		     </td>
	    		     	    							    		      			
    	              {if $field.datatype_id==4 || $field.datatype_id==12}
                  		{literal}<script type="text/javascript">Calendar.setup({inputField : '{/literal}{$field.fieldname}', ifFormat : "{if $field.datatype_id==4}%Y-%m-%d{else}%Y-%m-%d %H:%M:00{/if}", button: '{$field.fieldname}{literal}'	});</script>{/literal}
	                  {/if}                                                                        	    		     
                  {/if}                  
                  {/foreach}                  
   				  			</tr>
						</table>
				  	</td>
				  </tr>
	    		      		
	    		      		
				 {if $enable_fiedls>4}
                  <tr>
                    <td height="10px"></td>
                  </tr>
                  <tr>
                    <td align="right">
                     {if $info.block_type==2}
                      {if $currentData.$pk_incr_fieldname==0}
                      	<input type="button" class="button_insert" onclick="set_action('insert')" value="{$MSGTEXT.edit_data_add}" style="width:100px">
                      {else}
                     	 <input type="button" class="button_update" onclick="set_action('save')" value="{$MSGTEXT.edit_data_save}" style="width:100px">
                      	<input type="button" class="button_insert" onclick="set_action('insert')" value="{$MSGTEXT.edit_data_add}" style="width:100px">	                      
    	                  <input type="button" class="button_new" onclick="location.href='?act=modules&do=managedata&page_id={$page_id}&sort_by={$sort_by}&sort_type={$sort_type}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}{if $smarty.get.lang_id}&lang_id={$smarty.get.lang_id}{/if}{if $smarty.get.opener_f_name}&opener_f_name={$smarty.get.opener_f_name}{/if}{if $smarty.get.own_f_name}&own_f_name={$smarty.get.own_f_name}{/if}{if $smarty.get.f_name}&f_name={$smarty.get.f_name}{/if}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table_name}&tag_id={$tag_id}&p={$p_num}'" value="{$MSGTEXT.edit_data_add_rec}" style="width:110px">
    	                  <input type="button" class="button_delete" onclick="set_action('delete')" value="{$MSGTEXT.edit_data_remove}" style="width:100px">
                      {/if}
                    {else}
                    	<input type="button" class="button_update" onclick="set_action('save')" value="{$MSGTEXT.edit_data_save}" style="width:100px">
                    {/if}
                      </td>
                  </tr>
                 {/if}                                    
                </table>
                </td>
            </tr>
          </table>
          </td>
      </tr>
    </table>
  </form>
  
  <script language="JavaScript">
  {foreach from=$fields item=field}
  {assign var=fieldname value=$field.fieldname}
  {if $hide_fields.$fieldname} hideFields('', '{$fieldname}', '{$hide_fields.$fieldname}', '{$currentData.$fieldname}'); {/if}
  {/foreach}
  </script>
  
  {$editorsCode}
  {/if}    
    </td>
    </tr>
</table>
</td>
<td width="2px" class="rightline"><img width="2px" src="images/zero.gif"></td>
</tr>
<tr>
  <td width="2px" height="2px" class="tabs_lc"><img height="2px" width="2px" src="images/zero.gif"></td>
  <td width="100%" height="2px" class="bottomline"><img height="2px" src="images/zero.gif"></td>
  <td width="2px" height="2px" class="tabs_rc"><img height="2px" width="2px" src="images/zero.gif"></td>
</tr>
</table>
<br>
<br>
<br>