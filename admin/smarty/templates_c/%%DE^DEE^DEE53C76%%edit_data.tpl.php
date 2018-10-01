<?php /* Smarty version 2.6.26, created on 2018-09-07 06:40:10
         compiled from /var/www/admin/templates/management_templates/edit_data.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'sprintf', '/var/www/admin/templates/management_templates/edit_data.tpl', 600, false),array('modifier', 'count', '/var/www/admin/templates/management_templates/edit_data.tpl', 637, false),array('modifier', 'truncate', '/var/www/admin/templates/management_templates/edit_data.tpl', 856, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
<?php if ($this->_tpl_vars['field']['edittype_id'] == 14 && ! $this->_tpl_vars['translit_setup']): ?><?php $this->assign('translit_setup', 1); ?>
<script type="text/javascript" src="js/translit.js"></script>
<?php else: ?>
<?php if (( $this->_tpl_vars['field']['datatype_id'] == 4 || $this->_tpl_vars['field']['datatype_id'] == 12 || $this->_tpl_vars['field']['datatype_id'] == 13 ) && $this->_tpl_vars['field']['edittype_id'] > 0 && ( $this->_tpl_vars['field']['filter'] == 1 || @SETTINGS_EDIT_MODE )): ?>
<?php if (! $this->_tpl_vars['calendar_setup']): ?>
<?php $this->assign('calendar_setup', 1); ?>
<link rel="stylesheet" type="text/css" media="all" href="calendar/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-<?php echo $this->_tpl_vars['interface_lang_prefix']; ?>
.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<?php endif; ?><?php endif; ?><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<script language="JavaScript">
act_link="?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&mdo=saveedit&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
&p=<?php echo $this->_tpl_vars['p_num']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if (isset ( $_GET['hide_menu'] ) && $_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&edit=";
<?php echo '

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
		'; ?>
location.href='?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&id='+data_id+'&p=<?php echo $this->_tpl_vars['p_num']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
#data form';<?php echo '
	}
}


function otmenit() {
	otmenitClick=true;
}


function selectRow(obg_id) {
	GetElementById(\'check allrows\').value=0;
	GetElementById(\'main CheckBox\').checked=false;
	obj=GetElementById(\'row \'+obg_id);
	setcolor(obj);
	otmenit();
}


function applySorts() {
	otmenit();
	GetElementById(\'actiontype\').value=\'update\';
	GetElementById(\'primenit obnovlenie\').submit();
}


function applyDelete() {

	if (GetElementById(\'main CheckBox\').checked) {
		var messageAlert="'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_del_alert3']; ?>
<?php echo '"
	}
	else {
		var messageAlert="'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_del_alert']; ?>
<?php echo '"
	}

	if (confirm(messageAlert)) {
		GetElementById(\'actiontype\').value=\'delete\';
		GetElementById(\'primenit obnovlenie\').submit();
	}
}


function CheckAll(Element, Name) {
	if (Element.checked) GetElementById(\'check allrows\').value=1;
	else GetElementById(\'check allrows\').value=0;
	thisCheckBoxes = Element.parentNode.parentNode.parentNode.getElementsByTagName("input");
	for (i = 1; i < thisCheckBoxes.length; i++) {
		if (thisCheckBoxes[i].name == Name) {
			thisCheckBoxes[i].checked = Element.checked;

			last=thisCheckBoxes[i].id;
			t=last.split(\' \');
			obj=GetElementById(\'row \'+t[1]);
			setcolor(obj);
			unsetcolor(obj);
		}
	}
}


function delOneRecord(data_id) {
	otmenit();

	if (confirm("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_del_alert2']; ?>
<?php echo '")) {
		'; ?>

		location.href='?act=modules&do=managedata&mdo=updaterows&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
&p=<?php echo $this->_tpl_vars['p_num']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&del_id='+data_id;
		<?php echo '
	}
}


function vkl(f_value, f_name, f_id, edittype_id) {
	otmenit();
	'; ?>

	location.href='?act=modules&do=managedata&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($this->_tpl_vars['page_id']): ?>&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
<?php endif; ?>&mdo=setStatus&id='+f_id+'&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&f_name='+f_name+'&f_value='+f_value+'&edittype_id='+edittype_id+'&p=<?php echo $this->_tpl_vars['p_num']; ?>
';
	<?php echo '
}


function setcolor(obj) {
	setUnsetColor();
	g_obg=obj;
	scolor=true;
	g_obg.style.background=\'#FFF2BE\';
}


function unsetcolor(obj) {
	g_obg=obj;
	scolor=false;
	setTimeout(\'setUnsetColor()\', 1);
}


function setUnsetColor() {
	if (!scolor) {
		t=g_obg.id.split(\' \');
		if (g_obg.className==\'row_selected\' || GetElementById(\'checkbox \'+t[1]).checked==true) g_obg.style.background=\'#dce7fa\';
		else g_obg.style.background=\'white\';
	}
}


function set_edit_table(obj) {
	'; ?>
	
	url	= '?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&sort_by=sort_index&sort_type=low<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&p=1<?php if (! $_GET['filter_for_table']): ?>&clean_filter=true<?php endif; ?>&t_name='+obj.value;
	<?php echo '
	location.href=url;
}


function set_filter(obj, filterfield) {
	'; ?>

	url	= '?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&p=1&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&filterfield='+filterfield+'&filtervalue='+obj.value;
	<?php echo '
	location.href=url;
}


function set_filter_by_date(id_number, filterfield) {
	'; ?>


	v_from	= GetElementById('calendar_value_from '+id_number).value;
	v_to	= GetElementById('calendar_value_to '+id_number).value;

	if (v_from!='' || v_to!='') v=v_from+'|'+v_to;
	else
	v='';

	url	= '?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&p=1&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&filterfield='+filterfield+'&filtervalue='+v;
	<?php echo '
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
		'; ?>

		location.href='?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
&p=1&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
';
		<?php echo '
	}
}

'; ?>

<?php if (@SETTINGS_EDIT_MODE == 1 || $this->_tpl_vars['info']['block_type'] == 1): ?>
<?php echo '

function set_action(action) {
	form=GetElementById(\'data form\');
	form.action=act_link+action;
		
	if (action!=\'delete\') {
		'; ?>

	<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?><?php if ($this->_tpl_vars['field']['edittype_id'] == 4 && $this->_tpl_vars['field']['active']): ?>selectAll('<?php echo $this->_tpl_vars['field']['fieldname']; ?>
'); <?php endif; ?><?php endforeach; endif; unset($_from); ?>
	<?php echo '
	}
	
	if (action==\'delete\') {	
		'; ?>

		if (confirm('<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_del_alert2']; ?>
')) <?php echo '{
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
	newtables=GetElementById(object_id+\' notselected_data\');
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
	tables=GetElementById(object_id+\' notselected_data\');
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
	
	var tables2=GetElementById(object_id+\' notselected_data\');
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

			if (objSel.type==\'select-one\') {
				obj_refresh_svalue=selectedValues[obj_refresh_id];
				objSel.options.length = 0;
				el 				= new Option("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_specified']; ?>
<?php echo '", 0);
				el.style.color	=\'gray\';
				objSel.options[objSel.options.length] =el;


				if (m) {
					for (key in m) {
						objSel.options[objSel.options.length] = new Option(m[key], key);
						if (key==obj_refresh_svalue) objSel.options[objSel.options.length-1].selected=true;
					}
				}
			}
			else if (objSel.type==\'select-multiple\') {
				objSel2 = GetElementById(obj_refresh_id+\' notselected_data\');

				obj_refresh_svalue=selectedValues[obj_refresh_id].split(\',\');
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
				var objSel = GetElementById(\'div \'+obj_refresh_id);

				if (document.getElementById(\'radiobox_hide_\'+obj_refresh_id)) dop=document.getElementById(\'radiobox_hide_\'+obj_refresh_id).innerHTML;
				else dop=\'\';

				obj_refresh_svalue=selectedValues[obj_refresh_id];
				newText=\'\'	;
				if (m) {
					for (key in m) {
						if (key==obj_refresh_svalue) ch=\' checked \';
						else ch=\'\';
						newText=newText+\'<input type="radio" name="\'+obj_refresh_id+\'" \'+dop+\' value="\'+key+\'" \'+ch+\'> \'+m[key]+\'   \';
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
'; ?>


var selectedValues= new Array();

<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
<?php $this->assign('fieldname', $this->_tpl_vars['field']['fieldname']); ?>
<?php if ($this->_tpl_vars['field']['edittype_id'] == 4): ?>

selectedValues['<?php echo $this->_tpl_vars['fieldname']; ?>
']='<?php $_from = $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['v'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['v']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['msind']):
        $this->_foreach['v']['iteration']++;
?><?php echo $this->_tpl_vars['msind']['id']; ?>
<?php if (! ($this->_foreach['v']['iteration'] == $this->_foreach['v']['total'])): ?>,<?php endif; ?><?php endforeach; endif; unset($_from); ?>';
<?php else: ?>
<?php if ($this->_tpl_vars['field']['edittype_id'] == 3 || $this->_tpl_vars['field']['edittype_id'] == 6): ?>
selectedValues['<?php echo $this->_tpl_vars['fieldname']; ?>
']='<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
';
<?php endif; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

//формируем масив по которому будут скрываться поля
<?php echo $this->_tpl_vars['hide_masiv']; ?>


<?php echo '
function hideFields(obj, hide_by_field_caption, hide_field_caption, object_value) {

	if (object_value!=\'\') {
		obj=GetElementById(hide_by_field_caption);
	}

	if (obj.type==\'select-one\') {
		//object_value=obj.value;
		object_value=obj.options[obj.selectedIndex].text;
	}
	else if (obj.type==\'select-multiple\') {
		//object_value=obj.value;
		object_value=obj.options[obj.selectedIndex].text;
	}
	else if (obj.type==\'checkbox\') {
		if (obj.checked) object_value=1;
		else object_value=0;
	}
	else if (obj.type==\'radio\') {
		if (object_value==\'\') object_value=obj.value;
	}
	else if (obj.type==\'textarea\') {
		object_value=obj.value;
	}
	else if (obj.type==\'text\') {
		object_value=obj.value;
	}

	var temp_data			= hideMasiv[hide_by_field_caption];

	for (var hide_field_caption in temp_data) {

		var v				= temp_data[hide_field_caption];
		var operator		= v[\'operator\'];
		var hide_on_value	= v[\'value\'];
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
				show_type=\'none\';
			}
			else	 {
				show_type=\'table-row\';
			}

			GetElementById(\'tr_\'+hide_field_caption).style.display	= show_type;
			GetElementById(\'tr2_\'+hide_field_caption).style.display	= show_type;
		}
	}
}
'; ?>

<?php endif; ?>
<?php echo '

function reloadParentForm() {

	var selObject				= window.opener.document.getElementById("'; ?>
<?php echo $this->_tpl_vars['opener_f_name']; ?>
<?php echo '");
	selObject.options.length	= 0;	//очищаем родительский список записей

	'; ?>
<?php echo $this->_tpl_vars['ownDataList']; ?>
<?php echo '
	

	for (i=0; i<ownDataList.length; i++) {
		if (i==0) {
			if (selObject.type!=\'select-multiple\') {
				selObject.options[selObject.options.length] = new Option("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_specified']; ?>
<?php echo '", 0);
				if (selObject.type!=\'select-multiple\') {
					selObject.options[selObject.options.length-1].style.color=\'gray\';
				}
			}
		}

		selObject.options[selObject.options.length] = new Option(ownDataList[i][\'text value\'], ownDataList[i][\'id\']);

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
	if (GetElementById(\'search by field\').value!=\'\' && GetElementById(\'search field type\').value!=\'\') return true;
	else {
		alert('; ?>
"<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_search_need_field']; ?>
"<?php echo ');
		return false;
	}
}
</script>
'; ?>


<?php if (isset ( $_GET['filter_for_table'] ) && isset ( $_GET['filterfield'] )): ?>
<script language="JavaScript">reloadParentForm();</script>
<?php endif; ?>



<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>  
  <td width="2px" class="leftline"><img width="2px" src="images/zero.gif"></td>
  <td bgcolor="#66a4d3">  
  	<table width="100%" cellpadding="5" cellspacing="0" border="0">
      <tr>
      <td>
      
    	<?php if ($_GET['hide_menu'] && $_GET['fastEdit'] && ( $_GET['mdo'] == 'saveedit' || $_GET['mdo'] == 'updaterows' )): ?>
	    	<script language="JavaScript">opener.location.reload();</script>
    	<?php endif; ?>
    	<?php if ($_SESSION['___GoodCMS']['t_backup']): ?>
    		<?php $_from = $_SESSION['___GoodCMS']['t_backup']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
    		<?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['table_name']): ?>
    			<center>
      			<p style="color:yellow"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_restore_table']; ?>
 <br>
        		<br>
        		<input class="button" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_otmenit']; ?>
" onclick="location.href='index.php?act=modules&do=managedata&mdo=backupXLSresult&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&p=1&chancel=1'" type="button">
        		<input class="button" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_podtverdit']; ?>
" onclick="location.href='index.php?act=modules&do=managedata&mdo=backupXLSresult&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&p=1&chancel=0'" type="button">
      			</p>
    			</center>
    		<?php endif; ?>
    		<?php endforeach; endif; unset($_from); ?>
    	<?php endif; ?>
    
    	<?php if ($this->_tpl_vars['messages']): ?>    					
    	<?php if (! $_SESSION['___GoodCMS']['read_only']): ?>
   	 		<center>
      		<p id="messages block" style="margin-top:0px;color:yellow;font-weight:normal">
      		<?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
      			<?php echo $this->_tpl_vars['msg']; ?>
<br>
        	<?php endforeach; endif; unset($_from); ?>
        	</p>
    		</center>
    		<script language="JavaScript">
    		Morphing("messages block", false);
    		</script> 
    	<?php else: ?>
    		<center>
    		<p id="messages block" style="margin-top:0px;color:yellow;font-weight:normal"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_forbidden']; ?>
<br>
    		</center>    
    	<?php endif; ?>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['search'] !== false && $this->_tpl_vars['info']['block_type'] == 2): ?>
    	<center>
      	<p style="color:yellow">
      	<?php if ($this->_tpl_vars['pages_navigations']['records_count'] > 0): ?>
        	<?php echo ((is_array($_tmp=$this->_tpl_vars['MSGTEXT']['edit_data_search_result'])) ? $this->_run_mod_handler('sprintf', true, $_tmp, $this->_tpl_vars['search'], $this->_tpl_vars['pages_navigations']['records_count']) : sprintf($_tmp, $this->_tpl_vars['search'], $this->_tpl_vars['pages_navigations']['records_count'])); ?>

        <?php else: ?>
        	<?php echo ((is_array($_tmp=$this->_tpl_vars['MSGTEXT']['edit_data_no_result'])) ? $this->_run_mod_handler('sprintf', true, $_tmp, $this->_tpl_vars['search']) : sprintf($_tmp, $this->_tpl_vars['search'])); ?>

        <?php endif; ?>
        <a style="color:yellow" href="?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&p=1&clean_seacrh=true"><b><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_show_all_ent']; ?>
</b></a></p>
   		 </center>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['errors']): ?>    	
    	<table align="center" cellpadding="0" cellspacing="0" border="0">
      	<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
      		<?php if ($this->_tpl_vars['error'] != ''): ?>
		      	<tr><td style="color:yellow"><?php echo $this->_tpl_vars['error']; ?>
</td></tr>
        	<?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
        </table>
        <br/>
    <?php endif; ?>
    
    
    <?php if ($this->_tpl_vars['messages'] || ( $this->_tpl_vars['search'] !== false && $this->_tpl_vars['info']['block_type'] == 2 ) || $this->_tpl_vars['errors']): ?>
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
    <?php endif; ?>
    
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="<?php if ($this->_tpl_vars['info']['block_type'] == 2): ?>margin-top:0px;<?php endif; ?> margin-bottom:5px">
      <?php if ($this->_tpl_vars['info']['block_type'] == 2 && ! isset ( $_GET['filter_for_table'] )): ?>
      <tr style="height:24px"> 
      <?php if (count($this->_tpl_vars['module_blocksTables']) > 1): ?>
        <td align="left" width="40%">
        <table cellpadding="0" width="100%" align="left" cellspacing="0" border="0">
            <tr>
              <td align="left" nowrap><b><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_edit']; ?>
</b>&nbsp; </td>
              <td style="width:100%">
              <select class="edit_tables" style="width:100%" onchange="set_edit_table(this)">                  
				<?php $_from = $this->_tpl_vars['module_blocksTables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
					<?php if ($this->_tpl_vars['t']['show_type'] == 1 || $this->_tpl_vars['table_name'] == $this->_tpl_vars['t']['table_name']): ?>
                		<option <?php if ($this->_tpl_vars['table_name'] == $this->_tpl_vars['t']['table_name']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['t']['table_name']; ?>
"><?php echo $this->_tpl_vars['t']['description']; ?>
</option>
                  	<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
                </select>
                </td>
              
            </tr>
          </table>
          </td>
        <td width="30px"><img width="15px" src="images/zero.gif"></td>
        <?php endif; ?>
        
        <td align="right">
        <form onsubmit="return checkSearchList()" action="index.php?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&p=1" method="POST" style="margin:0px">            
	    <table cellpadding="0" cellspacing="0" border="0">        	
          <tr>                        
            <td align="left" nowrap><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_search']; ?>
&nbsp;</td>
            <td><input type="text" name="search" title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_search_type']; ?>
" id="search field type" value="<?php echo $this->_tpl_vars['search']; ?>
" style="width:120px"></td>
              
			 <td>
              <select style="width:50px" title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_select_rule']; ?>
" name="search_by_rule" id="search by rule">
              <option <?php if ($this->_tpl_vars['search_by_rule'] == 0): ?> selected <?php endif; ?> value="0">%</option>                
              <option <?php if ($this->_tpl_vars['search_by_rule'] == 1): ?> selected <?php endif; ?> value="1">=</option>                
              </select>
              </td>
                                      
            <td width="100%"><input type="hidden" value="<?php echo $this->_tpl_vars['page_id']; ?>
" name="page_id">
              <input type="hidden" value="<?php echo $this->_tpl_vars['tag_id']; ?>
" name="tag_id">
              <input type="hidden" value="<?php echo $this->_tpl_vars['table_name']; ?>
" name="t_name">
              <input type="hidden" value="modules" name="act">
              <input type="hidden" value="managedata" name="do">
              <select style="width:100%" title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_select_field']; ?>
" name="search_by_field" id="search by field">
              <option style="color:gray" value=""><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_select_field']; ?>
</option>                
			  <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
                <option <?php if ($this->_tpl_vars['search_by_field'] == $this->_tpl_vars['field']['fieldname']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
"><?php echo $this->_tpl_vars['field']['comment']; ?>
</option>                
			  <?php endforeach; endif; unset($_from); ?>
              </select>
              </td>                            
              
            <td width="5px">&nbsp;</td>
            <td width="15px"><input type="submit" class="button" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_search2']; ?>
"></td>
            </tr>            
          </table>
          </td>
      	</tr>
       </form>      
      <?php endif; ?>
      
      <?php if ($this->_tpl_vars['filter']): ?>
      <tr>
        <td colspan="100%">
        <table <?php if ($this->_tpl_vars['info']['block_type'] == 2): ?>style="margin-top:10px"<?php endif; ?> cellpadding="0" cellspacing="0" border="0" width="100%">
            <?php if ($this->_tpl_vars['info']['block_type'] == 2 && ! $_GET['filter_for_table']): ?>
            <tr>
              <td height="1px" bgcolor="#5b97c4"></td>
            </tr>
            <tr>
              <td height="1px" bgcolor="#74a9d3"></td>
            </tr>
            <tr>
              <td height="5"></td>
            </tr>
            <?php endif; ?>
            
            <?php if ($_GET['hide_menu'] && ! $_GET['fastEdit']): ?>
            <tr>
              <td height="25px" align="left" valign="top"><b><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_filter_sempling']; ?>
:</b><?php if ($_GET['opener_f_name']): ?>&nbsp;&nbsp;&nbsp;<b style="color:yellow"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_filter_select_filter']; ?>
</b><?php endif; ?></td>
            </tr>
            <?php endif; ?>
            
            <tr>
              <td width="100%">
              <table title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_filter_sempling']; ?>
" width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                  <?php $this->assign('ind_k', 3); ?>
                  <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
                  	<?php if ($this->_tpl_vars['field']['filter'] == 1): ?>
                    	<?php if ($this->_tpl_vars['field']['sourse_field_name'] != '' || $this->_tpl_vars['field']['edittype_id'] == 5 || $this->_tpl_vars['field']['edittype_id'] == 13 || $this->_tpl_vars['field']['datatype_id'] == 24 || $this->_tpl_vars['field']['datatype_id'] == 25 || $this->_tpl_vars['field']['datatype_id'] == 4 || $this->_tpl_vars['field']['datatype_id'] == 12 || $this->_tpl_vars['field']['datatype_id'] == 13): ?>
                    		<?php $this->assign('dfilter', $this->_tpl_vars['data_filter'][$this->_tpl_vars['table_name']]); ?>
                    		<?php $this->assign('dfieldname', $this->_tpl_vars['field']['fieldname']); ?>
                    		<?php if ($this->_tpl_vars['ind_k'] == 3): ?><?php $this->assign('ind_k', 0); ?>
                    			</tr>
	                  			<tr>
                  			<?php endif; ?>
    		                <?php $this->assign('ind_k', $this->_tpl_vars['ind_k']+1); ?>
                    <td width="1%" nowrap valign="middle"><font color="#35678d"><?php echo $this->_tpl_vars['field']['comment']; ?>
: </font></td>
                    <td width="30%" align="left" valign="middle" style="height:25px">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td width="100%" align="left">
                          <?php if ($this->_tpl_vars['field']['edittype_id'] == 5): ?>
                            <select style="width:100%" onchange="set_filter(this, '<?php echo $this->_tpl_vars['field']['fieldname']; ?>
')">
                              <option selected style="color:gray" value=""><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_set']; ?>
</option>
                              <option <?php if ($this->_tpl_vars['dfilter'][$this->_tpl_vars['dfieldname']] == 1): ?> selected <?php endif; ?> value="1"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_yes']; ?>
</option>
                              <option <?php if ($this->_tpl_vars['dfilter'][$this->_tpl_vars['dfieldname']] == 0 && $this->_tpl_vars['dfilter'][$this->_tpl_vars['dfieldname']] != ""): ?> selected <?php endif; ?> value="<?php if ($this->_tpl_vars['field']['datatype_id'] != 24 && $this->_tpl_vars['field']['datatype_id'] != 25): ?>0<?php endif; ?>"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_no']; ?>
</option>
                            </select>
                            <?php else: ?>
                            <?php if ($this->_tpl_vars['field']['datatype_id'] == 4 || $this->_tpl_vars['field']['datatype_id'] == 12 || $this->_tpl_vars['field']['datatype_id'] == 13): ?>
                           		<?php if (! $this->_tpl_vars['calid']): ?><?php $this->assign('calid', 1); ?><?php else: ?><?php $this->assign('calid', $this->_tpl_vars['calid']++); ?>
                           	<?php endif; ?>
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                              <tr>
                                <td valign="middle"><input type="text" onclick="this.value=''; set_filter_by_date(<?php echo $this->_tpl_vars['calid']; ?>
, '<?php echo $this->_tpl_vars['field']['fieldname']; ?>
')" readonly id="calendar_value_from <?php echo $this->_tpl_vars['calid']; ?>
" type="text" style="width:115px" onchange="set_filter_by_date(<?php echo $this->_tpl_vars['calid']; ?>
, '<?php echo $this->_tpl_vars['field']['fieldname']; ?>
')" value="<?php echo $this->_tpl_vars['dfilter'][$this->_tpl_vars['dfieldname']][0]; ?>
"></td>
                                <td><img style="cursor:pointer" id="set_calendar_from <?php echo $this->_tpl_vars['calid']; ?>
" src="images/calendar_add.png"></td>
                                <td align="center" width="20px"> <font color="#35678d"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_do']; ?>
</font> </td>
                                <td valign="middle"><input type="text" onclick="this.value=''; set_filter_by_date(<?php echo $this->_tpl_vars['calid']; ?>
, '<?php echo $this->_tpl_vars['field']['fieldname']; ?>
')" onclick="this.value=''" readonly id="calendar_value_to <?php echo $this->_tpl_vars['calid']; ?>
" type="text" style="width:115px" onchange="set_filter_by_date(<?php echo $this->_tpl_vars['calid']; ?>
, '<?php echo $this->_tpl_vars['field']['fieldname']; ?>
')" value="<?php echo $this->_tpl_vars['dfilter'][$this->_tpl_vars['dfieldname']][1]; ?>
"></td>
                                <td><img style="cursor:pointer" id="set_calendar_to <?php echo $this->_tpl_vars['calid']; ?>
" src="images/calendar_add.png"></td>
                              </tr>
                            </table>
                            
                            <?php echo ' 
                            <script type="text/javascript">Calendar.setup({inputField : \''; ?>
calendar_value_from <?php echo $this->_tpl_vars['calid']; ?>
', ifFormat : "<?php if ($this->_tpl_vars['field']['datatype_id'] == 4): ?>%Y-%m-%d<?php else: ?>%Y-%m-%d %H:%M<?php endif; ?>", button: 'set_calendar_from <?php echo $this->_tpl_vars['calid']; ?>
<?php echo '\'});</script>'; ?>

                            <?php echo ' 
                            <script type="text/javascript">Calendar.setup({inputField : \''; ?>
calendar_value_to <?php echo $this->_tpl_vars['calid']; ?>
', ifFormat : "<?php if ($this->_tpl_vars['field']['datatype_id'] == 4): ?>%Y-%m-%d<?php else: ?>%Y-%m-%d %H:%M<?php endif; ?>", button: 'set_calendar_to <?php echo $this->_tpl_vars['calid']; ?>
<?php echo '\'});</script>'; ?>

                            <?php else: ?>                            
                            <?php if ($this->_tpl_vars['field']['edittype_id'] == 13): ?>
                            	<select style="width:100%" onchange="set_filter(this, '<?php echo $this->_tpl_vars['field']['fieldname']; ?>
')">                              
								<?php $this->assign('sourse_values', "list_filter_".($this->_tpl_vars['field']['fieldname'])); ?>
    	                          <option value="" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_specified']; ?>
</option>                              
								<?php $_from = $this->_tpl_vars['field'][$this->_tpl_vars['sourse_values']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
            		            <option value="<?php echo $this->_tpl_vars['list']['id']; ?>
" <?php if ($this->_tpl_vars['dfilter'][$this->_tpl_vars['dfieldname']] == $this->_tpl_vars['list']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['list']['name']; ?>
 → <?php echo $this->_tpl_vars['list']['description']; ?>
</option>
                    	        <?php endforeach; endif; unset($_from); ?>
                            </select>
                            <?php else: ?>
                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                              <tr>
                                <td width="100%">
                                <select id="filterselect <?php echo $this->_tpl_vars['field']['fieldname']; ?>
" style="width:100%" onchange="set_filter(this, '<?php echo $this->_tpl_vars['field']['fieldname']; ?>
')">
                                    <option value="" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_specified']; ?>
</option>                                    
									<?php $this->assign('sourse_values', "list_filter_".($this->_tpl_vars['field']['fieldname'])); ?>
									<?php if ($this->_tpl_vars['field']['datatype_id'] != 24 && $this->_tpl_vars['field']['datatype_id'] != 25): ?>
										<?php $this->assign('sourse_list', $this->_tpl_vars['field'][$this->_tpl_vars['sourse_values']]); ?>
										<?php $this->assign('sourse_field_name', $this->_tpl_vars['field']['sourse_field_name']); ?>
										<?php $_from = $this->_tpl_vars['sourse_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['s']):
?>
	                                    	<option <?php if ($this->_tpl_vars['dfilter'][$this->_tpl_vars['dfieldname']] == $this->_tpl_vars['s']['id']): ?> selected<?php endif; ?> value="<?php echo $this->_tpl_vars['s']['id']; ?>
"><?php if ($this->_tpl_vars['field']['is_tree']): ?><?php $this->assign('deep', ($this->_tpl_vars['field']['fieldname'])."_deep"); ?><?php unset($this->_sections['foo']);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['start'] = (int)0;
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['s'][$this->_tpl_vars['deep']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
if ($this->_sections['foo']['start'] < 0)
    $this->_sections['foo']['start'] = max($this->_sections['foo']['step'] > 0 ? 0 : -1, $this->_sections['foo']['loop'] + $this->_sections['foo']['start']);
else
    $this->_sections['foo']['start'] = min($this->_sections['foo']['start'], $this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] : $this->_sections['foo']['loop']-1);
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = min(ceil(($this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] - $this->_sections['foo']['start'] : $this->_sections['foo']['start']+1)/abs($this->_sections['foo']['step'])), $this->_sections['foo']['max']);
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>    <?php endfor; endif; ?><?php endif; ?><?php echo $this->_tpl_vars['s'][$this->_tpl_vars['sourse_field_name']]; ?>
</option>
    	                                <?php endforeach; endif; unset($_from); ?>
									<?php else: ?>
										<?php $_from = $this->_tpl_vars['field'][$this->_tpl_vars['sourse_values']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                                    	<option value="<?php echo $this->_tpl_vars['list']; ?>
" <?php if ($this->_tpl_vars['dfilter'][$this->_tpl_vars['dfieldname']] == $this->_tpl_vars['list']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['list']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php endif; ?>
                                  </select></td>
                                <?php if ($this->_tpl_vars['field']['have_sourse_filter'] && ! $this->_tpl_vars['search']): ?>
                                	<td><img style="cursor:pointer" onclick="openPopupFilter('index.php?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&p=1&hide_menu=true&t_name=<?php echo $this->_tpl_vars['field']['table_name']; ?>
&opener_f_name=filterselect+<?php echo $this->_tpl_vars['field']['fieldname']; ?>
&own_f_name=<?php echo $this->_tpl_vars['field']['sourse_field_name']; ?>
&f_name=<?php echo $this->_tpl_vars['field']['fieldname']; ?>
&filter_for_table=<?php echo $this->_tpl_vars['field']['table_id']; ?>
')" border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_filter_settings']; ?>
" height="16px" src="images/filter.png"></td>
                                <?php endif; ?>
                                </tr>
                            </table>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                            </td>
                        </tr>
                      </table>
                      </td>
                    <?php if ($this->_tpl_vars['ind_k'] < 3): ?>
                    <td width="1%"><img width="15px" src="images/zero.gif"></td>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                    <?php if ($this->_tpl_vars['ind_k'] < 3 || $this->_tpl_vars['ind_k'] == 3): ?>
                    <td width="100%" colspan="100%"></td>
                    <?php endif; ?>
                    </tr>
                </table>
                </td>
            </tr>
          </table>
          </td>
      </tr>
    </table>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['info']['block_type'] == 2): ?>    
    <table border="0" width="100%" cellpadding="1" cellspacing="0">
        <tr bgcolor="#ccdbe6">
        <td valign="top">        
        <table style="margin-top:0px" align="center" border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="top_list" nowrap>
        <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
          <?php if ($this->_tpl_vars['field']['show_in_list'] == 1): ?>
          	<td style="width:<?php echo $this->_tpl_vars['field']['width_percent']; ?>
%" <?php if ($this->_tpl_vars['field']['edittype_id'] == 5 || $this->_tpl_vars['field']['edittype_id'] == 10 || $this->_tpl_vars['field']['edittype_id'] == 11 || $this->_tpl_vars['field']['edittype_id'] == 12 || $this->_tpl_vars['field']['edittype_id'] == 16): ?> align="center" <?php endif; ?> nowrap><a class="table_top" href="?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&sort_by=<?php echo $this->_tpl_vars['field']['fieldname']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
"><?php if ($this->_tpl_vars['field']['comment'] != ''): ?><?php echo $this->_tpl_vars['field']['comment']; ?>
<?php else: ?><?php echo $this->_tpl_vars['field']['fieldname']; ?>
<?php endif; ?></a> <?php if ($this->_tpl_vars['sort_by'] == $this->_tpl_vars['field']['fieldname']): ?><img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?>&nbsp;</td>
          <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
          <td nowrap style="width:65px" align="center" valign="middle"><img width="13px" title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_apply']; ?>
" onclick="javascript:applySorts()" hspace="0" src="images/apply.gif" style="cursor:pointer">&nbsp;<a class="table_top" href="?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&sort_by=sort_index&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_sort']; ?>
</a><?php if ($this->_tpl_vars['sort_by'] == 'sort_index'): ?>&nbsp;<img src='images/sort_<?php echo $this->_tpl_vars['sort_type']; ?>
.gif' border='0' alt=''><?php endif; ?></td>
          <td><img width="3px" src="images/zero.gif"></td>
          <td><input onClick="CheckAll(this, 'rows[]');" id="main CheckBox" type="checkbox" value="1">
          <td><img width="3px" src="images/zero.gif"></td>
          <td><img title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_remove']; ?>
" onclick="applyDelete()" src="images/delete_b.gif" border="0" style="cursor:pointer"></td>
        </tr>
        
        
        <?php if ($this->_tpl_vars['needData']): ?>
        <form style="margin:0px" id="primenit obnovlenie" action="?act=modules&do=managedata&mdo=updaterows&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
&p=<?php echo $this->_tpl_vars['p_num']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
" method="POST">
          <input name="actiontype" id="actiontype" value="update" type="hidden">
          <input name="check_allrows" id="check allrows" value="0" type="hidden">
          <?php $_from = $this->_tpl_vars['needData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['data_rows'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['data_rows']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['data_rows']['iteration']++;
?>
          <tr style="height:1px"></tr>
          
          <tr bgcolor='white' style="z-index:10px" id="row <?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
" onclick="golink('<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
')" <?php if ($this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']] == $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]): ?>class="row_selected"<?php else: ?>class="row_not_selected"<?php endif; ?> onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)">
          <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fieldlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fieldlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['fieldlist']['iteration']++;
?>
            <?php if ($this->_tpl_vars['field']['show_in_list'] == 1): ?>
              <td <?php if ($this->_tpl_vars['field']['edittype_id'] == 5 || $this->_tpl_vars['field']['edittype_id'] == 10 || $this->_tpl_vars['field']['edittype_id'] == 11 || $this->_tpl_vars['field']['edittype_id'] == 12 || $this->_tpl_vars['field']['edittype_id'] == 16): ?> align="center" <?php endif; ?>  valign="top">
              
            <?php $this->assign('ind', $this->_tpl_vars['field']['fieldname']); ?>
            <?php if ($this->_tpl_vars['field']['edittype_id'] != 5): ?>            
            	<?php if ($this->_tpl_vars['field']['edittype_id'] == 1): ?>
		            <?php echo $this->_tpl_vars['item'][$this->_tpl_vars['ind']]; ?>

        	    <?php else: ?>            
            	<?php if ($this->_tpl_vars['field']['edittype_id'] == 2 || $this->_tpl_vars['field']['edittype_id'] == 7 || $this->_tpl_vars['field']['edittype_id'] == 8): ?>
            		<?php echo ((is_array($_tmp=$this->_tpl_vars['item'][$this->_tpl_vars['ind']])) ? $this->_run_mod_handler('truncate', true, $_tmp, 400, '...', false, false) : smarty_modifier_truncate($_tmp, 400, '...', false, false)); ?>

            	<?php else: ?>            
            	<?php if ($this->_tpl_vars['field']['edittype_id'] == 3 || $this->_tpl_vars['field']['edittype_id'] == 6): ?>
            		<?php if ($this->_tpl_vars['field']['datatype_id'] != 24 && $this->_tpl_vars['field']['datatype_id'] != 25): ?>
            			<?php $this->assign('sv', ($this->_tpl_vars['field']['fieldname'])."_caption"); ?>
            			<?php if ($this->_tpl_vars['item'][$this->_tpl_vars['sv']]): ?>
            				<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['sv']]; ?>

            			<?php else: ?>
            				<font color="Gray"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_specified']; ?>
</font>
            			<?php endif; ?>
            		<?php else: ?>
            		<?php if ($this->_tpl_vars['item'][$this->_tpl_vars['ind']]): ?>
            			<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['ind']]; ?>

            		<?php else: ?>
            			<font color="Gray"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_specified']; ?>
</font>
            		<?php endif; ?>
            	<?php endif; ?>            
            <?php else: ?>            
            <?php if ($this->_tpl_vars['field']['edittype_id'] == 4): ?>
            	<?php $this->assign('sourse_values', "list_".($this->_tpl_vars['field']['fieldname'])); ?>
            	<?php $_from = $this->_tpl_vars['item'][$this->_tpl_vars['sourse_values']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foreach_multy'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foreach_multy']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['m']):
        $this->_foreach['foreach_multy']['iteration']++;
?>
            		<?php if ($this->_tpl_vars['m'] != ''): ?>
            			<img hspace="5" src="images/active.gif"><?php echo $this->_tpl_vars['m']; ?>
<br>
		            <?php else: ?>
		            	<font color="Gray"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_specified']; ?>
</font>
		            <?php endif; ?>
	            <?php endforeach; endif; unset($_from); ?>            
    	    <?php else: ?>            
        	    <?php if ($this->_tpl_vars['field']['edittype_id'] == 13): ?>
            		<?php $this->assign('sourse_values', "list_".($this->_tpl_vars['field']['fieldname'])); ?>
            		<?php $this->assign('sourse_list', $this->_tpl_vars['field'][$this->_tpl_vars['sourse_values']]); ?>
            		<?php $this->assign('source_id', "id".($this->_tpl_vars['item'][$this->_tpl_vars['ind']])); ?>
            		<?php if ($this->_tpl_vars['source_id'] != 'id0'): ?>
            			<?php echo $this->_tpl_vars['sourse_list'][$this->_tpl_vars['source_id']]['name']; ?>
<br>
            		<?php else: ?>
            			<font color="Gray"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_specified']; ?>
</font>
            		<?php endif; ?>            
            	<?php else: ?>            
            	<?php if ($this->_tpl_vars['field']['edittype_id'] == 9): ?>
            		<?php if ($this->_tpl_vars['item'][$this->_tpl_vars['ind']]): ?>
	            		<a onclick="otmenit()" href="../modules/<?php echo $this->_tpl_vars['module_name']; ?>
/management/storage/images/<?php echo $this->_tpl_vars['current_tablename_no_prefix']; ?>
/<?php echo $this->_tpl_vars['field']['fieldname']; ?>
/<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
/<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['ind']]; ?>
" target="_blank"> <img <?php if ($this->_tpl_vars['field']['avator_width'] > 40): ?>width="40px"<?php endif; ?> class="ramka" src="../modules/<?php echo $this->_tpl_vars['module_name']; ?>
/management/storage/images/<?php echo $this->_tpl_vars['current_tablename_no_prefix']; ?>
/<?php echo $this->_tpl_vars['field']['fieldname']; ?>
/<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
/preview/<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['ind']]; ?>
" border="0"></a>
            		<?php endif; ?>
    	        <?php else: ?>
        		    <?php if ($this->_tpl_vars['field']['edittype_id'] == 10): ?> 
        		    	<a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&mdo=photos_form&hide_menu=true&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&f_name=<?php echo $this->_tpl_vars['fieldname']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
')"><img border="0" src="images/picture_edit.png"></a> 
        		    <?php else: ?>
            			<?php if ($this->_tpl_vars['field']['edittype_id'] == 11): ?>
            				<?php if ($this->_tpl_vars['item'][$this->_tpl_vars['ind']]): ?>
            					<a onclick="otmenit()" href="../modules/<?php echo $this->_tpl_vars['module_name']; ?>
/management/storage/files/<?php echo $this->_tpl_vars['current_tablename_no_prefix']; ?>
/<?php echo $this->_tpl_vars['field']['fieldname']; ?>
/<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
/<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['ind']]; ?>
" target="_blank"><img border="0" src="images/attach.png"></a> 
           					<?php endif; ?>
            				<?php else: ?>
            					<?php if ($this->_tpl_vars['field']['edittype_id'] == 12): ?>
            						<a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&mdo=files_form&hide_menu=true&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&f_name=<?php echo $this->_tpl_vars['fieldname']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
')"><img border="0" src="images/tag_blue_edit.png"></a> 
            					<?php else: ?>
            					<?php if ($this->_tpl_vars['field']['edittype_id'] == 16): ?>
	            					<input onChange="vkl(1, '<?php echo $this->_tpl_vars['ind']; ?>
', '<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
', '<?php echo $this->_tpl_vars['field']['edittype_id']; ?>
')" type="radio" name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" <?php if ($this->_tpl_vars['item'][$this->_tpl_vars['ind']] == 1): ?> checked <?php endif; ?> value="1">
    					        <?php else: ?>
            						<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['ind']]; ?>

            					<?php endif; ?>
            				<?php endif; ?>
            			<?php endif; ?>
            		<?php endif; ?>
            	<?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
            <?php else: ?>            
            	<?php if ($this->_tpl_vars['item'][$this->_tpl_vars['ind']] == 1): ?> 
            		<img title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_off']; ?>
" onclick="vkl(0, '<?php echo $this->_tpl_vars['ind']; ?>
', '<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
', '<?php echo $this->_tpl_vars['field']['edittype_id']; ?>
')" src="images/icons/check.gif" border="0"> <?php else: ?> <img title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_on']; ?>
" onclick="vkl(1, '<?php echo $this->_tpl_vars['ind']; ?>
', '<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
', '<?php echo $this->_tpl_vars['field']['edittype_id']; ?>
')" src="images/icons/not_check.gif" border="0"> 
            	<?php endif; ?>
            <?php endif; ?>
            </td>          
            <?php endif; ?>            
          <?php endforeach; endif; unset($_from); ?>                     
          
          <td align="center" valign="top" nowrap><input type="text" onclick="otmenit()" name="sortindexes_<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
" value="<?php echo $this->_tpl_vars['item']['sort_index']; ?>
" style="width:50px"></td>
          <td><img width="3px" src="images/zero.gif"></td>
          <td height="22px" valign="top"><input value="<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
" id="checkbox <?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
" onclick="selectRow(<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
)" type="checkbox" name="rows[]"></td>
          <td><img width="3px" src="images/zero.gif"></td>
          <td valign="top"><img title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_remove']; ?>
"  onclick="delOneRecord(<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
)" src="images/delete_b.gif" border="0"></a><input type="hidden" name="ids_<?php echo $this->_foreach['data_rows']['iteration']; ?>
" value="<?php echo $this->_tpl_vars['item'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
"></td>
         </tr>          
       <?php endforeach; endif; unset($_from); ?>
        </form>        
        
        <?php else: ?>
        <tr>
          <td align="center" height="30px" colspan="100%" bgcolor='white' style="z-index:10px"><font color="gray"><i><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_found']; ?>
</i></font></td>
        </tr>
        <?php endif; ?>                          
      </table>                  
        </td>
        </tr>      
    </table>
    
    
    <table  style="margin-top:0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr id="records details buttons" style="<?php if ($_COOKIE['display_menu_details'] == 'true'): ?>display:table-row<?php else: ?>display:none<?php endif; ?>" class="show_details_place" bgcolor="#cde1f0">
        <td align="left">
        	<table width="100%" cellpadding="2" cellspacing="2" border="0">            
        	<tr>
              <td valign="middle" nowrap><font style="color:#254c6b"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_print_page']; ?>
: &nbsp;</td>
              <td valign="middle">
               <select style="color:#254c6b" onchange="setRecordsForPage(this)">
                  <option <?php if (@SETTINGS_RECORDS_FOR_PAGE == 5): ?> selected <?php endif; ?> value="5">5</option>
                  <option <?php if (@SETTINGS_RECORDS_FOR_PAGE == 10): ?> selected <?php endif; ?> value="10">10</option>
                  <option <?php if (@SETTINGS_RECORDS_FOR_PAGE == 15): ?> selected <?php endif; ?> value="15">15</option>
                  <option <?php if (@SETTINGS_RECORDS_FOR_PAGE == 20): ?> selected <?php endif; ?> value="20">20</option>
                  <option <?php if (@SETTINGS_RECORDS_FOR_PAGE == 30): ?> selected <?php endif; ?> value="30">30</option>
                  <option <?php if (@SETTINGS_RECORDS_FOR_PAGE == 40): ?> selected <?php endif; ?> value="40">40</option>
                  <option <?php if (@SETTINGS_RECORDS_FOR_PAGE == 50): ?> selected <?php endif; ?> value="50">50</option>
                  <option <?php if (@SETTINGS_RECORDS_FOR_PAGE == 100): ?> selected <?php endif; ?> value="100">100</option>
                </select>
                </td>
              <td nowrap><font style="color:#254c6b">&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_founded_records']; ?>
 <b><?php echo $this->_tpl_vars['pages_navigations']['records_count']; ?>
</b></font></td>
              <td width="100%">&nbsp;</td>
              <td><input type="button" class="button_details" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_create_report']; ?>
" onclick="openManageWindow('export_data.php?page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
','500','450')" ></td>
              <td><img width="5px" src="images/zero.gif"></td>
              <td><input class="button_details" type="button" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_import_report']; ?>
" onclick="openManageWindow('import_xls.php?page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
<?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
','500','350')"></td>
              <td><img width="15px" src="images/zero.gif"></td>
              <td><a class="records_settings" href="javascript:applySorts()"><img border="0" src="images/apply.gif"></a></td>
              <td nowrap><a class="records_settings" href="javascript:applySorts()"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_apply']; ?>
</a></td>
              <td><img width="5px" src="images/zero.gif"></td>
              <td><a class="records_settings" href="javascript:applyDelete()"><img border="0" src="images/delete_b.gif"></a></td>
              <td nowrap><a class="records_settings" href="javascript:applyDelete()"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_remove_selected']; ?>
</a></td>
            </tr>
          </table>
          </td>
      </tr>
      <tr>
        <td  style="height:6px" class="show_details_fon" align="center" valign="top"><img title="<?php if ($_COOKIE['display_menu_details'] == 'false'): ?><?php echo $this->_tpl_vars['MSGTEXT']['lib_js_show_menu_details']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['lib_js_hide_menu_details']; ?>
<?php endif; ?>" class="show_details" onmouseover="on('hidebutton for records details')" onmouseout= "off()" id="hidebutton for records details" onclick="show_hide_details('records details buttons', this)" src="images/more_show.png"></td>
      </tr>
      <tr>
        <td  height="1px" bgcolor="#5b97c4"></td>
      </tr>
      <tr>
        <td>
        <table  cellpadding="0" cellspacing="0" border="0" width="100%">
            <tr id="records details settings" style="<?php if ($_COOKIE['display_menu_settings'] == 'true'): ?>display:table-row<?php else: ?>display:none<?php endif; ?>" class="show_details_place" bgcolor="#cde1f0">
              <td>
              <table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td colspan="100%"  height="5px"></td>
                  </tr>
                  <tr>
                    <td valign="middle">&nbsp;<a href="javascript:openBlockSettingsWindow('?act=modules&do=settings&hide_menu=true&id=<?php echo $this->_tpl_vars['edit_block']['block_id']; ?>
<?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>')"><img border="0" src="images/config_small.png"></a></td>
                    <td width="5px">&nbsp;</td>
                    <td valign="middle"><a class="records_settings" href="javascript:openBlockSettingsWindow('?act=modules&do=settings&hide_menu=true&id=<?php echo $this->_tpl_vars['edit_block']['block_id']; ?>
<?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>')"><?php echo $this->_tpl_vars['MSGTEXT']['block_settings']; ?>
</a></td>
                    <td>
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td width="20px">&nbsp;</td>
                          <td><a href="/admin/index.php?act=languagesofmaterial&page"><img border="0" hspace="5" src="images/config-language.png"></a></td>
                          <td><select style="width:150px;color:#254c6b" onchange="setLang(this)">
                              <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_uncnown_lang']; ?>
</option>                              
								<?php $_from = $this->_tpl_vars['LANGUAGES_OF_MATERIAL']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prefix'] => $this->_tpl_vars['lang']):
?>
                            	  <option <?php if (! $_GET['lang_id']): ?><?php if (@SETTINGS_LANGUAGE_OF_MATERIALS == $this->_tpl_vars['prefix']): ?>selected<?php endif; ?><?php else: ?><?php if ($_GET['lang_id'] == $this->_tpl_vars['lang']['id']): ?>selected<?php endif; ?><?php endif; ?> value="<?php echo $this->_tpl_vars['prefix']; ?>
"><?php echo $this->_tpl_vars['lang']['caption']; ?>
</option>                              
								<?php endforeach; endif; unset($_from); ?>
                            </select>
                            </td>
                          <td style="color:#254c6b">&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['lang_set']; ?>
</td>
                        </tr>
                      </table>
                      </td>
                    <td>
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td width="20px"></td>
                          <td><input <?php if (@SETTINGS_EDIT_MODE == 1): ?> checked<?php endif; ?> type="checkbox" onclick="setEditMode(this)" value="1"></td>
                          <td style="color:#254c6b">&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['set_edit_type']; ?>
</td>
                        </tr>
                      </table>
                      </td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td height="6px" class="show_details_fon" align="center"><img title="<?php if ($_COOKIE['display_menu_settings'] == 'false'): ?><?php echo $this->_tpl_vars['MSGTEXT']['lib_js_show_menu_settings']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['lib_js_hide_menu_settings']; ?>
<?php endif; ?>" class="show_details" onmouseover="on('hidebutton for records settings')" onmouseout= "off()" id="hidebutton for records settings" onclick="show_hide_settings('records details settings', this)" src="images/more_show_settings.png"></td>
            </tr>
          </table>
          </td>
      </tr>
      <tr>
        <td height="5px"></td>
      </tr>
      <?php if ($this->_tpl_vars['pages_navigations']['page_count'] > 0): ?>
      <tr>
        <td  align="left"> <?php echo $this->_tpl_vars['MSGTEXT']['edit_data_pages']; ?>
:&nbsp;
          <?php unset($this->_sections['foo']);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['start'] = (int)0;
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['pages_navigations']['page_count']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
if ($this->_sections['foo']['start'] < 0)
    $this->_sections['foo']['start'] = max($this->_sections['foo']['step'] > 0 ? 0 : -1, $this->_sections['foo']['loop'] + $this->_sections['foo']['start']);
else
    $this->_sections['foo']['start'] = min($this->_sections['foo']['start'], $this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] : $this->_sections['foo']['loop']-1);
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = min(ceil(($this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] - $this->_sections['foo']['start'] : $this->_sections['foo']['start']+1)/abs($this->_sections['foo']['step'])), $this->_sections['foo']['max']);
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?> <a <?php if ($this->_sections['foo']['iteration'] == $this->_tpl_vars['pages_navigations']['p_selected']): ?> class="sel_page_navigate" <?php endif; ?> href="?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&p=<?php echo $this->_sections['foo']['iteration']; ?>
"><?php echo $this->_sections['foo']['iteration']; ?>
</a>  
          <?php endfor; endif; ?> <br>
          &nbsp; </td>
      </tr>
      <?php endif; ?>
    </table>
    <?php else: ?>
    	<?php if (count($this->_tpl_vars['module_blocksTables']) > 1): ?>
    	<table cellpadding="2" cellspacing="2" border="0">
	      <tr>
    	    <td align="left" nowrap><b><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_edit']; ?>
</b>&nbsp; </td>
        	<td><select onchange="set_edit_table(this)">            
			<?php $_from = $this->_tpl_vars['module_blocksTables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
            	<option <?php if ($this->_tpl_vars['table_name'] == $this->_tpl_vars['t']['table_name']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['t']['table_name']; ?>
"><?php echo $this->_tpl_vars['t']['description']; ?>
</option>            
			<?php endforeach; endif; unset($_from); ?>
          </select>
          </td>        
      </tr>
    </table>
    <?php endif; ?>
    <?php endif; ?>        
    
  <?php if ($this->_tpl_vars['info']['block_type'] == 1): ?>
  <table cellpadding="0" cellpadding="0" border="0">
    <tr>
      <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=settings&hide_menu=true&id=<?php echo $this->_tpl_vars['info']['block_id']; ?>
<?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>')"><img border="0" src="images/config.png"></a></td>
      <td valign="middle">&nbsp;<a href="javascript:openBlockSettingsWindow('?act=modules&do=settings&hide_menu=true&id=<?php echo $this->_tpl_vars['info']['block_id']; ?>
<?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>')"><?php echo $this->_tpl_vars['MSGTEXT']['block_settings']; ?>
</a></td>
      <td>
      	<table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td width="20px"></td>
                  <td><a href="/admin/index.php?act=languagesofmaterial&page"><img border="0" hspace="5" src="images/config-language.png"></a></td>
                  <td><select style="width:150px" onchange="setLang(this)">
                      <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_uncnown_lang']; ?>
</option>                      
						<?php $_from = $this->_tpl_vars['LANGUAGES_OF_MATERIAL']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prefix'] => $this->_tpl_vars['lang']):
?>
                      		<option <?php if (! $_GET['lang_id']): ?><?php if (@SETTINGS_LANGUAGE_OF_MATERIALS == $this->_tpl_vars['prefix']): ?>selected<?php endif; ?><?php else: ?><?php if ($_GET['lang_id'] == $this->_tpl_vars['lang']['id']): ?>selected<?php endif; ?><?php endif; ?> value="<?php echo $this->_tpl_vars['prefix']; ?>
"><?php echo $this->_tpl_vars['lang']['caption']; ?>
</option>                      
						<?php endforeach; endif; unset($_from); ?>
                    </select>
                    </td>
                  <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['lang_set']; ?>
</td>
                  </tr>
             </table>
              </td>
          </tr>
      	</table>
      </td>
    </tr>
  </table>
  <?php endif; ?>

	<?php $_from = $this->_tpl_vars['additional_buttons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ab']):
?>
		<?php if ($this->_tpl_vars['ab']['target'] == ''): ?>
		<p style="text-align:right">
			<input type="button" class="button_additional" onclick="window.open('<?php echo $this->_tpl_vars['ab']['url']; ?>
', '_blank')" value="<?php echo $this->_tpl_vars['ab']['caption']; ?>
" >
		</p>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	
  <?php if (( @SETTINGS_EDIT_MODE == 1 || $this->_tpl_vars['info']['block_type'] == 1 ) && ! isset ( $_GET['filter_for_table'] ) && $this->_tpl_vars['activated']): ?>
  <form id="data form" action="?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&mdo=saveedit&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
&p=<?php echo $this->_tpl_vars['p_num']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&edit=<?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']] == 0): ?>insert<?php else: ?>save<?php endif; ?>" method="POST" enctype="multipart/form-data" 
  style="width:100%;margin:0;margin-top:10px">
    <table class="formborder" border="0" cellpadding="0" cellspacing="1" style="width:100%">
      <tr>
        <td>
        <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0" width="100%">
            <tr>
              <td width="100%" valign="top">
              <table class="formbackground" border="0" cellpadding="0" cellspacing="4" width="100%">
                  <tr <?php if ($this->_tpl_vars['info']['block_type'] == 2): ?>height="35px"<?php endif; ?> valign="top">
                    <td align="right"> 
                    <?php if ($this->_tpl_vars['info']['block_type'] == 2): ?>
                      <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']] == 0): ?>
                      	<input type="button" class="button_insert" onclick="set_action('insert')" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_add']; ?>
" style="width:100px">
                      <?php else: ?>
                      <?php $_from = $this->_tpl_vars['additional_buttons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ab']):
?>
                      	<?php if ($this->_tpl_vars['ab']['target'] != ''): ?>
                      		<input type="button" class="button_additional" onclick="<?php if ($this->_tpl_vars['ab']['target'] == '_self'): ?>location.href='<?php echo $this->_tpl_vars['ab']['url']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
'<?php endif; ?><?php if ($this->_tpl_vars['ab']['target'] == '_new'): ?>openManageWindow('<?php echo $this->_tpl_vars['ab']['url']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
', 850, 800)<?php else: ?><?php if ($this->_tpl_vars['ab']['target'] == '_blank'): ?>window.open('<?php echo $this->_tpl_vars['ab']['url']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
', '_blank')<?php endif; ?><?php endif; ?>" value="<?php echo $this->_tpl_vars['ab']['caption']; ?>
" >
                      	<?php endif; ?>
                      <?php endforeach; endif; unset($_from); ?>
                     	 <input type="button" class="button_update" onclick="set_action('save')" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_save']; ?>
" style="width:100px">
                      	<input type="button" class="button_insert" onclick="set_action('insert')" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_add']; ?>
" style="width:100px">	                      
    	                  <input type="button" class="button_new" onclick="location.href='?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&p=<?php echo $this->_tpl_vars['p_num']; ?>
#data form'" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_add_rec']; ?>
" style="width:110px">
    	                  <input type="button" class="button_delete" onclick="set_action('delete')" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_remove']; ?>
" style="width:100px">
                      <?php endif; ?>
                    <?php else: ?>
                    	<input type="button" class="button_update" onclick="set_action('save')" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_save']; ?>
" style="width:100px">
                    <?php endif; ?>
                    </td>
                  </tr>
                  
                  <?php $this->assign('enable_fiedls', 0); ?>
                  <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['fields']['iteration']++;
?>                  
                  	<?php if ($this->_tpl_vars['field']['active'] == 1 && $this->_tpl_vars['field']['edittype_id'] > 0): ?>
                  	  <?php $this->assign('enable_fiedls', $this->_tpl_vars['enable_fiedls']+1); ?>	                       	
            		  <?php if ($this->_tpl_vars['field']['group_caption'] != $this->_tpl_vars['group_caption'] || $this->_tpl_vars['field']['group_caption'] == ''): ?>	
    		          	<?php if ($this->_tpl_vars['st']): ?>    	    		          		      	
	    		      		</tr>
	    		      			</table>
	    		      				</td>
	    		      					</tr>	    		      					
	    		      	<?php endif; ?>	
	    		      	<?php $this->assign('st', true); ?>    	    		              		          
	  
	    		      		<tr>
	    		      			<td>
	    		      			<table cellpadding="1" cellspacing="1" border="0" width="100%">	
	    		      				<tr>
	    		  	   <?php endif; ?>
	    		  	  <?php $this->assign('group_caption', $this->_tpl_vars['field']['group_caption']); ?>    	    		              		          
	    		  	   						    		  	 
	    		  	 <td valign="bottom" width="20%">
    		          <table cellpadding="0" cellspacing="1" border="0" width="100%">	    		              		          	    		  	          	
                  	               	
	                  <?php $this->assign('fieldname', $this->_tpl_vars['field']['fieldname']); ?>
    		          <?php if ($this->_tpl_vars['field']['edittype_id'] != 5 && $this->_tpl_vars['field']['edittype_id'] != 8 && $this->_tpl_vars['field']['edittype_id'] != 10 && $this->_tpl_vars['field']['edittype_id'] != 12 && $this->_tpl_vars['field']['edittype_id'] != 16): ?>
    		          	<tr style="display:table-row" id="tr_<?php echo $this->_tpl_vars['field']['fieldname']; ?>
">    		          
                    	   <td>
                    			<table cellpadding="0" cellspacing="0" border="0">
                        			<tr> 
	                         		<?php if ($this->_tpl_vars['field']['sourse_table_name'] != '' && $this->_tpl_vars['field']['edittype_id'] != 14 && $this->_tpl_vars['field']['edittype_id'] != 15): ?>
    	                      			<td valign="bottom"> <?php $this->assign('sourse_block', $this->_tpl_vars['field']['sourse_block']); ?> <a href="javascript:openManageWindow('index.php?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&p=1&hide_menu=true&t_name=<?php if ($this->_tpl_vars['field']['sourse_table_name'] == ''): ?><?php echo $this->_tpl_vars['field']['table_name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['field']['sourse_table_name']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['field']['edittype_id'] == 4): ?>&search=<?php $_from = $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mas'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mas']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['msind']):
        $this->_foreach['mas']['iteration']++;
?><?php echo $this->_tpl_vars['msind']['id']; ?>
<?php if (! ($this->_foreach['mas']['iteration'] == $this->_foreach['mas']['total'])): ?>,<?php endif; ?><?php endforeach; endif; unset($_from); ?><?php else: ?><?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]): ?>&search=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
<?php endif; ?><?php endif; ?>', '1000', '700')"><img title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_edit_list']; ?>
" border="0" width="16px" src="images/editlist.png"></a></td>
        	                 			<td width="5px"></td>
            	             			
                	          			<?php if ($this->_tpl_vars['field']['own_filter'] && $this->_tpl_vars['field']['edittype_id'] != 4): ?>
                    	      				<td>
                        	  					<table border="0" cellpadding="0" cellspacing="0">
                          							<tr>
                          								<td><img style="cursor:pointer" onclick="openPopupFilter('index.php?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&p=1&hide_menu=true&t_name=<?php echo $this->_tpl_vars['field']['table_name']; ?>
&opener_f_name=<?php echo $this->_tpl_vars['field']['fieldname']; ?>
&own_f_name=<?php echo $this->_tpl_vars['field']['sourse_field_name']; ?>
&filter_for_table=<?php echo $this->_tpl_vars['field']['table_id']; ?>
')" border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_filter_settings']; ?>
" height="16px" src="images/filter.png"></td>                          							
	                          						</tr>
    	                      					</table>
                           					</td>
										<?php endif; ?>
    	                     		<?php endif; ?>
        	                  		<td valign="middle" class="fcaption"><?php echo $this->_tpl_vars['field']['comment']; ?>
:</td>
            	            		</tr>
                	    		</table>
                    		</td>
                    	</tr>	
                  
                  	<?php else: ?>                  		    		                		    		      					    		      				                  
    		          <tr style="display:table-row" id="tr_<?php echo $this->_tpl_vars['field']['fieldname']; ?>
">                  		
	                  	<td height="10px"></td>
					  </tr>
    	            <?php endif; ?>
    	                	            
                  <tr style="display:table-row" id="tr2_<?php echo $this->_tpl_vars['field']['fieldname']; ?>
">
                    <td id="td <?php echo $this->_tpl_vars['field']['fieldname']; ?>
"  >
                    
                    <?php if ($this->_tpl_vars['field']['edittype_id'] == 1): ?>
                      <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td width="100%" align="left"><input type="text" <?php if (( $this->_tpl_vars['CopyNewContent'][$this->_tpl_vars['fieldname']] ) || $this->_tpl_vars['translit_fields'][$this->_tpl_vars['fieldname']]): ?>onkeyup="<?php if ($this->_tpl_vars['CopyNewContent'][$this->_tpl_vars['fieldname']]): ?>CopyNewContent('<?php echo $this->_tpl_vars['field']['fieldname']; ?>
', new Array(<?php $_from = $this->_tpl_vars['CopyNewContent'][$this->_tpl_vars['fieldname']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fa'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fa']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cnc']):
        $this->_foreach['fa']['iteration']++;
?>'<?php echo $this->_tpl_vars['cnc']; ?>
'<?php if (! ($this->_foreach['fa']['iteration'] == $this->_foreach['fa']['total'])): ?>,<?php endif; ?><?php endforeach; endif; unset($_from); ?>), '<?php echo $this->_tpl_vars['field']['fieldname']; ?>
');<?php endif; ?><?php if ($this->_tpl_vars['translit_fields'][$this->_tpl_vars['fieldname']]): ?>translitFields('<?php echo $this->_tpl_vars['field']['fieldname']; ?>
', '<?php echo $this->_tpl_vars['translit_fields'][$this->_tpl_vars['fieldname']]; ?>
')<?php endif; ?>;" <?php endif; ?>   <?php if ($this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]): ?> onchange="<?php echo $this->_tpl_vars['fieldname']; ?>
', '<?php echo $this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]; ?>
', '')" <?php endif; ?> value="<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
" name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" style=";<?php echo $this->_tpl_vars['field']['style']; ?>
<?php if ($this->_tpl_vars['field']['width']): ?>width:<?php echo $this->_tpl_vars['field']['width']; ?>
;<?php else: ?>width:100%;<?php endif; ?><?php if ($this->_tpl_vars['field']['height'] != ''): ?>height:<?php echo $this->_tpl_vars['field']['height']; ?>
px<?php endif; ?>"></td>
                          <?php if ($this->_tpl_vars['translit_fields'][$this->_tpl_vars['fieldname']]): ?>
                          	<td nowrap align="left">
                          		<table border="0" cellpadding="0" cellspacing="0">
	                              <tr>
    	                            <td width="10px">&nbsp;&nbsp;</td>
        	                        <td><input type="checkbox" onclick="simulateOnChangeTranslit('<?php echo $this->_tpl_vars['field']['fieldname']; ?>
')" <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']] == 0): ?> checked <?php endif; ?> value="1" id="create translit <?php echo $this->_tpl_vars['field']['fieldname']; ?>
"></td>
            	                    <td class="fcaption_small">&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_create_translit']; ?>
</td>
                	              </tr>
                    	        </table>
                            </td>
                          	<?php endif; ?>
                          <?php if ($this->_tpl_vars['CopyNewContent'][$this->_tpl_vars['fieldname']]): ?>
                          	<td nowrap align="left">
	                          <table border="0" cellpadding="0" cellspacing="0">
    	                          <tr>
        	                        <td width="10px">&nbsp;&nbsp;</td>
            	                    <td align="left"><input type="checkbox" onclick="simulateOnChangeCopy('<?php echo $this->_tpl_vars['field']['fieldname']; ?>
')"  <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']] == 0): ?> checked <?php endif; ?> value="1" id="create copy <?php echo $this->_tpl_vars['field']['fieldname']; ?>
"></td>
                	                <td class="fcaption_small">&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_create_podstanovky']; ?>
</td>
                    	          </tr>
                        	    </table>
                            	</td>
                          <?php endif; ?>
                          </tr>
                      </table>
                      <?php endif; ?>
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 2): ?>
                      	<table width="100%" cellpadding="0" cellspacing="0" border="0">
                        	<tr>
                          	<td width="100%" align="left">
	                      		<textarea                       
    	                  		<?php if (( $this->_tpl_vars['CopyNewContent'][$this->_tpl_vars['fieldname']] ) || $this->_tpl_vars['translit_fields'][$this->_tpl_vars['fieldname']]): ?>onkeyup="<?php if ($this->_tpl_vars['CopyNewContent'][$this->_tpl_vars['fieldname']]): ?>CopyNewContent('<?php echo $this->_tpl_vars['field']['fieldname']; ?>
', new Array(<?php $_from = $this->_tpl_vars['CopyNewContent'][$this->_tpl_vars['fieldname']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fa'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fa']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cnc']):
        $this->_foreach['fa']['iteration']++;
?>'<?php echo $this->_tpl_vars['cnc']; ?>
'<?php if (! ($this->_foreach['fa']['iteration'] == $this->_foreach['fa']['total'])): ?>,<?php endif; ?><?php endforeach; endif; unset($_from); ?>), '<?php echo $this->_tpl_vars['field']['fieldname']; ?>
');<?php endif; ?><?php if ($this->_tpl_vars['translit_fields'][$this->_tpl_vars['fieldname']]): ?>translitFields('<?php echo $this->_tpl_vars['field']['fieldname']; ?>
', '<?php echo $this->_tpl_vars['translit_fields'][$this->_tpl_vars['fieldname']]; ?>
')<?php endif; ?>;" <?php endif; ?>                        
        	              		<?php if ($this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]): ?> onkeyup="hideFields(this, '<?php echo $this->_tpl_vars['fieldname']; ?>
', '<?php echo $this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]; ?>
', '')" <?php endif; ?> name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" style="width:100%;height:<?php if ($this->_tpl_vars['field']['height'] != ''): ?><?php echo $this->_tpl_vars['field']['height']; ?>
px<?php else: ?>80px<?php endif; ?>"><?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
</textarea>
                                            
           				  		<?php if ($this->_tpl_vars['translit_fields'][$this->_tpl_vars['fieldname']]): ?>
                		          <td nowrap align="left">
                        			  <table border="0" cellpadding="0" cellspacing="0">
                        				<tr>
	                        			<td width="10px">&nbsp;&nbsp;</td>
    	                        		<td><input type="checkbox" onclick="simulateOnChangeTranslit('<?php echo $this->_tpl_vars['field']['fieldname']; ?>
')" <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']] == 0): ?> checked <?php endif; ?> value="1" id="create translit <?php echo $this->_tpl_vars['field']['fieldname']; ?>
"></td>
        	                    		<td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_create_translit']; ?>
</td>
										</tr>
                        			  </table>
								  </td>
                          		<?php endif; ?>
                          		
                          		<?php if ($this->_tpl_vars['CopyNewContent'][$this->_tpl_vars['fieldname']]): ?>
                          			<td nowrap align="left">
                          			<table border="0" cellpadding="0" cellspacing="0" >
                              		<tr>
                                		<td width="10px">&nbsp;&nbsp;</td>
                                		<td align="left"><input type="checkbox" onclick="simulateOnChangeCopy('<?php echo $this->_tpl_vars['field']['fieldname']; ?>
')"  <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']] == 0): ?> checked <?php endif; ?> value="1" id="create copy <?php echo $this->_tpl_vars['field']['fieldname']; ?>
"></td>
                                		<td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_create_podstanovky']; ?>
</td>
                              		</tr>
                            		</table>
                            	</td>
                          	<?php endif; ?>                                     
                      		</tr>
                     	 </table>
                      <?php endif; ?>                      
                                            
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 3): ?>
						<select 
						<?php if ($this->_tpl_vars['field']['obnovit']): ?> 
						onchange="<?php $_from = $this->_tpl_vars['field']['obnovit']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['obnovit']):
?>refreshListByField(this.value, '<?php echo $this->_tpl_vars['obnovit']['sourse_table_name']; ?>
', '<?php echo $this->_tpl_vars['obnovit']['sourse_field_name']; ?>
', Array(<?php $_from = $this->_tpl_vars['obnovit']['fieldname_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fa'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fa']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['fa']):
        $this->_foreach['fa']['iteration']++;
?>'<?php echo $this->_tpl_vars['fa']; ?>
'<?php if (! ($this->_foreach['fa']['iteration'] == $this->_foreach['fa']['total'])): ?>,<?php endif; ?><?php endforeach; endif; unset($_from); ?>), '<?php echo $this->_tpl_vars['obnovit']['sourse_field_name_next']; ?>
');<?php endforeach; endif; unset($_from); ?>"
						<?php endif; ?>
						<?php if ($this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]): ?> onchange="hideFields(this, '<?php echo $this->_tpl_vars['fieldname']; ?>
', '<?php echo $this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]; ?>
', '')"<?php endif; ?> name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" style="width:100%;<?php if ($this->_tpl_vars['field']['height'] != ''): ?>height:<?php echo $this->_tpl_vars['field']['height']; ?>
px<?php endif; ?>">
                      <?php $this->assign('sourse_values', "list_".($this->_tpl_vars['field']['fieldname'])); ?>
                      <option value="<?php if ($this->_tpl_vars['field']['datatype_id'] != 24 && $this->_tpl_vars['field']['datatype_id'] != 25): ?>0<?php endif; ?>" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_specified']; ?>
</option>
                      <?php $this->assign('dfieldname', $this->_tpl_vars['field']['fieldname']); ?>
                      <?php if ($this->_tpl_vars['field']['datatype_id'] != 24 && $this->_tpl_vars['field']['datatype_id'] != 25): ?>
                      <?php $this->assign('sourse_field_name', $this->_tpl_vars['field']['sourse_field_name']); ?>
                      <?php $_from = $this->_tpl_vars['field'][$this->_tpl_vars['sourse_values']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                      <option <?php if ($this->_tpl_vars['field']['filter'] == 1 && $this->_tpl_vars['dfilter'][$this->_tpl_vars['dfieldname']]): ?><?php if ($this->_tpl_vars['dfilter'][$this->_tpl_vars['dfieldname']] == $this->_tpl_vars['list']['id']): ?>selected<?php endif; ?><?php endif; ?> value="<?php echo $this->_tpl_vars['list']['id']; ?>
" <?php if ($this->_tpl_vars['list']['id'] == $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]): ?>selected<?php endif; ?>>
                      <?php if ($this->_tpl_vars['field']['is_tree']): ?><?php $this->assign('deep', ($this->_tpl_vars['field']['fieldname'])."_deep"); ?><?php unset($this->_sections['foo']);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['start'] = (int)0;
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['list'][$this->_tpl_vars['deep']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
if ($this->_sections['foo']['start'] < 0)
    $this->_sections['foo']['start'] = max($this->_sections['foo']['step'] > 0 ? 0 : -1, $this->_sections['foo']['loop'] + $this->_sections['foo']['start']);
else
    $this->_sections['foo']['start'] = min($this->_sections['foo']['start'], $this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] : $this->_sections['foo']['loop']-1);
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = min(ceil(($this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] - $this->_sections['foo']['start'] : $this->_sections['foo']['start']+1)/abs($this->_sections['foo']['step'])), $this->_sections['foo']['max']);
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>    <?php endfor; endif; ?><?php endif; ?><?php echo $this->_tpl_vars['list'][$this->_tpl_vars['sourse_field_name']]; ?>

                      </option>
                      <?php endforeach; endif; unset($_from); ?>
                      <?php else: ?>
                      <?php $_from = $this->_tpl_vars['field'][$this->_tpl_vars['sourse_values']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                      <option value="<?php echo $this->_tpl_vars['list']; ?>
" <?php if ($this->_tpl_vars['field']['filter'] == 1 && $this->_tpl_vars['dfilter'][$this->_tpl_vars['dfieldname']]): ?><?php if ($this->_tpl_vars['dfilter'][$this->_tpl_vars['dfieldname']] == $this->_tpl_vars['list']): ?>selected<?php endif; ?><?php else: ?><?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]): ?><?php if ($this->_tpl_vars['list'] == $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]): ?>selected<?php endif; ?><?php else: ?><?php if ($this->_tpl_vars['field']['default'] == $this->_tpl_vars['list']): ?>selected<?php endif; ?><?php endif; ?><?php endif; ?>><?php echo $this->_tpl_vars['list']; ?>
</option>
                      <?php endforeach; endif; unset($_from); ?>
                      <?php endif; ?>
                      </select>
                      <?php endif; ?>
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 4): ?>
                      <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="50%" valign="bottom"><font color="#35678d"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_selected_rec']; ?>
:</font><br/>
                          	<input type="hidden" value="" name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" />
                            <select style="width:100%;height:<?php if ($this->_tpl_vars['field']['height'] != ''): ?><?php echo $this->_tpl_vars['field']['height']; ?>
px<?php else: ?>100px<?php endif; ?>" name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
[]" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
"
							<?php if ($this->_tpl_vars['field']['obnovit']): ?>onchange="<?php $_from = $this->_tpl_vars['field']['obnovit']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['obnovit']):
?>refreshListByField(this.value, '<?php echo $this->_tpl_vars['obnovit']['sourse_table_name']; ?>
', '<?php echo $this->_tpl_vars['obnovit']['sourse_field_name']; ?>
', Array(<?php $_from = $this->_tpl_vars['obnovit']['fieldname_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fa'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fa']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['fa']):
        $this->_foreach['fa']['iteration']++;
?>'<?php echo $this->_tpl_vars['fa']; ?>
'<?php if (! ($this->_foreach['fa']['iteration'] == $this->_foreach['fa']['total'])): ?>,<?php endif; ?><?php endforeach; endif; unset($_from); ?>), '<?php echo $this->_tpl_vars['obnovit']['sourse_field_name_next']; ?>
' );<?php endforeach; endif; unset($_from); ?>"
							<?php endif; ?>
							<?php if ($this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]): ?> onchange="hideFields(this, '<?php echo $this->_tpl_vars['fieldname']; ?>
', '<?php echo $this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]; ?>
', '')"<?php endif; ?> size="10" style="width:100%;height:<?php if ($this->_tpl_vars['field']['height'] != ''): ?><?php echo $this->_tpl_vars['field']['height']; ?>
px<?php else: ?>80px<?php endif; ?>" multiple>
                            <?php $this->assign('sourse_values', "list_".($this->_tpl_vars['field']['fieldname'])); ?>
                            <?php $this->assign('sourse_field_name', $this->_tpl_vars['field']['sourse_field_name']); ?>
                            <?php $this->assign('sourse_list', $this->_tpl_vars['field'][$this->_tpl_vars['sourse_values']]); ?>
                            
                            <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]): ?>
                            	<?php $_from = $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msind']):
?>
                            		<option value="<?php echo $this->_tpl_vars['msind']['id']; ?>
"><?php echo $this->_tpl_vars['msind']['caption']; ?>
</option>
                            	<?php endforeach; endif; unset($_from); ?>
                            <?php endif; ?>
                            </select></td>
                          <td width="20px" valign="middle"><img title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_add']; ?>
" src="images/left.png" onclick="addSelected('<?php echo $this->_tpl_vars['field']['fieldname']; ?>
')" vspace="10" style="cursor:pointer"><br>
                            <img title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_remove']; ?>
" src="images/right.png" onclick="deleteSelected('<?php echo $this->_tpl_vars['field']['fieldname']; ?>
')" style="cursor:pointer"></td>
                          <td width="50%" valign="bottom">
                          <?php if ($this->_tpl_vars['field']['own_filter']): ?>
                          	<table border="0" cellpadding="0" cellspacing="0">
                          		<tr>
                          			<td><img style="cursor:pointer" onclick="openPopupFilter('index.php?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&p=1&hide_menu=true&t_name=<?php echo $this->_tpl_vars['field']['table_name']; ?>
&opener_f_name=<?php echo $this->_tpl_vars['field']['fieldname']; ?>
+notselected_data&own_f_name=<?php echo $this->_tpl_vars['field']['sourse_field_name']; ?>
&filter_for_table=<?php echo $this->_tpl_vars['field']['table_id']; ?>
')" border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_filter_settings']; ?>
" height="16px" src="images/filter.png"></td>
                          			<td>&nbsp;<font color="#35678d"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_list_of_free_records']; ?>
</font></td>
	                          	</tr>
    	                      </table>
                           <?php else: ?>
        	                  <font color="#35678d"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_list_of_free_records']; ?>
</font> <br>
                           <?php endif; ?>                          
                            <select id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
 notselected_data" size="10" style="width:100%;height:<?php if ($this->_tpl_vars['field']['height'] != ''): ?><?php echo $this->_tpl_vars['field']['height']; ?>
px<?php else: ?>100px<?php endif; ?>" multiple>                              
							<?php $_from = $this->_tpl_vars['field'][$this->_tpl_vars['sourse_values']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
								<?php $this->assign('dobavit', 1); ?>
								<?php $_from = $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msind']):
?>
									<?php if ($this->_tpl_vars['list']['id'] == $this->_tpl_vars['msind']['id']): ?><?php $this->assign('dobavit', 0); ?><?php break; ?><?php endif; ?>
								<?php endforeach; endif; unset($_from); ?>
								<?php if ($this->_tpl_vars['dobavit']): ?>
                	              <option value="<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php if ($this->_tpl_vars['field']['is_tree']): ?><?php $this->assign('deep', ($this->_tpl_vars['field']['fieldname'])."_deep"); ?><?php unset($this->_sections['foo']);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['start'] = (int)0;
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['list'][$this->_tpl_vars['deep']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
if ($this->_sections['foo']['start'] < 0)
    $this->_sections['foo']['start'] = max($this->_sections['foo']['step'] > 0 ? 0 : -1, $this->_sections['foo']['loop'] + $this->_sections['foo']['start']);
else
    $this->_sections['foo']['start'] = min($this->_sections['foo']['start'], $this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] : $this->_sections['foo']['loop']-1);
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = min(ceil(($this->_sections['foo']['step'] > 0 ? $this->_sections['foo']['loop'] - $this->_sections['foo']['start'] : $this->_sections['foo']['start']+1)/abs($this->_sections['foo']['step'])), $this->_sections['foo']['max']);
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>    <?php endfor; endif; ?><?php endif; ?><?php echo $this->_tpl_vars['list'][$this->_tpl_vars['sourse_field_name']]; ?>
</option>
                    	        <?php endif; ?>
                             <?php endforeach; endif; unset($_from); ?>
                            </select>
                            </td>
                        </tr>
                      </table>
                      <?php endif; ?>                      
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 5): ?>                      
                        <table cellpadding="0" cellspacing="0" border="0" class="fcaption_small">
                          <tr>
                            <td width="20px" valign="middle"><input <?php if ($this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]): ?> onclick="hideFields(this, '<?php echo $this->_tpl_vars['fieldname']; ?>
', '<?php echo $this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]; ?>
', '')" <?php endif; ?> type="checkbox"  class="checkbox" value="1" <?php if (isset ( $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']] )): ?> <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']] == 1): ?>checked<?php endif; ?><?php else: ?><?php if ($this->_tpl_vars['field']['default'] == 1): ?>checked<?php endif; ?><?php endif; ?> name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
"></td>
                            <td valign="middle"><?php echo $this->_tpl_vars['field']['comment']; ?>
</td>
                          </tr>
                        </table>                      
                      <?php endif; ?>
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 6): ?>
                      <input checked type="radio" name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']] == ''): ?> checked <?php endif; ?> value="<?php if ($this->_tpl_vars['field']['datatype_id'] != 24 && $this->_tpl_vars['field']['datatype_id'] != 25): ?>0<?php endif; ?>">
                      <font color=white><i><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_specified']; ?>
</i></font> 
                      <?php $this->assign('sourse_values', "list_".($this->_tpl_vars['field']['fieldname'])); ?>
                      <?php $this->assign('sourse_field_name', $this->_tpl_vars['field']['sourse_field_name']); ?> <font id="div <?php echo $this->_tpl_vars['field']['fieldname']; ?>
"> <?php $_from = $this->_tpl_vars['field'][$this->_tpl_vars['sourse_values']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                      <input <?php if ($this->_tpl_vars['field']['obnovit']): ?> onClick="<?php $_from = $this->_tpl_vars['field']['obnovit']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['obnovit']):
?>refreshListByField(this.value, '<?php echo $this->_tpl_vars['obnovit']['sourse_table_name']; ?>
', '<?php echo $this->_tpl_vars['obnovit']['sourse_field_name']; ?>
', Array(<?php $_from = $this->_tpl_vars['obnovit']['fieldname_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fa'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fa']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['fa']):
        $this->_foreach['fa']['iteration']++;
?>'<?php echo $this->_tpl_vars['fa']; ?>
'<?php if (! ($this->_foreach['fa']['iteration'] == $this->_foreach['fa']['total'])): ?>,<?php endif; ?><?php endforeach; endif; unset($_from); ?>), '<?php echo $this->_tpl_vars['obnovit']['sourse_field_name_next']; ?>
');<?php endforeach; endif; unset($_from); ?>"<?php endif; ?>
						<?php if ($this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]): ?> onchange="hideFields(this, '<?php echo $this->_tpl_vars['fieldname']; ?>
', '<?php echo $this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]; ?>
', '')"<?php endif; ?>
						class="radiobox" type="radio" name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" <?php if ($this->_tpl_vars['list']['id'] == $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]): ?> checked <?php endif; ?>>
                      <?php echo $this->_tpl_vars['list'][$this->_tpl_vars['sourse_field_name']]; ?>
   
                      <?php endforeach; endif; unset($_from); ?> </font> 
                      <?php if ($this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]): ?>
                      <div style="display:none" id="radiobox_hide_<?php echo $this->_tpl_vars['fieldname']; ?>
">onClick="hideFields(this, '<?php echo $this->_tpl_vars['fieldname']; ?>
', '<?php echo $this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]; ?>
', '')"</div>
                      <?php endif; ?>
                      <?php endif; ?>
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 7): ?>
                      <textarea id="<?php echo $this->_tpl_vars['fieldname']; ?>
" name="<?php echo $this->_tpl_vars['fieldname']; ?>
" width="100%"><?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
</textarea>
                      <?php endif; ?>
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 8): ?>
                      <div class="fcaption_none"> <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]): ?>
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&mdo=popup_form&hide_menu=true&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&f_name=<?php echo $this->_tpl_vars['fieldname']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
')"><img border="0" src="images/page_white_edit.png"></a></td>
                            <td width="5px"></td>
                            <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&mdo=popup_form&hide_menu=true&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&f_name=<?php echo $this->_tpl_vars['fieldname']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
')"><b><?php if ($this->_tpl_vars['field']['comment'] != ''): ?><?php echo $this->_tpl_vars['field']['comment']; ?>
<?php else: ?><?php echo $this->_tpl_vars['field']['fieldname']; ?>
<?php endif; ?></b></a></td>
                          </tr>
                        </table>
                        <?php else: ?>
                        <?php echo $this->_tpl_vars['MSGTEXT']['edit_data_edit_field']; ?>
 <b>«<?php if ($this->_tpl_vars['field']['comment'] != ''): ?><?php echo $this->_tpl_vars['field']['comment']; ?>
<?php else: ?><?php echo $this->_tpl_vars['field']['fieldname']; ?>
<?php endif; ?>»</b> <?php echo $this->_tpl_vars['MSGTEXT']['edit_data_can_only_be']; ?>

                        <?php endif; ?>
                        </div>
                      <?php endif; ?>
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 9): ?>
                      <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]): ?>
                      <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td><a href="../modules/<?php echo $this->_tpl_vars['module_name']; ?>
/management/storage/images/<?php echo $this->_tpl_vars['current_tablename_no_prefix']; ?>
/<?php echo $this->_tpl_vars['field']['fieldname']; ?>
/<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
/<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
" target="_blank"><img class="ramka" hspace="1" align="left" src="../modules/<?php echo $this->_tpl_vars['module_name']; ?>
/management/storage/images/<?php echo $this->_tpl_vars['current_tablename_no_prefix']; ?>
/<?php echo $this->_tpl_vars['field']['fieldname']; ?>
/<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
/preview/<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
" border="0"></a></td>
                          <td width="15px"> </td>
                          <td>
                          <table cellpadding="0" cellspacing="0" border="0" class="fcaption_small">
                              <tr>
                                <td><input name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
_delete" value="<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
" type="checkbox"></td>
                                <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_remove']; ?>
</td>
                              </tr>
                          </table>
                          </td>
                        </tr>
                      </table>
                      <?php endif; ?>
                      <input type="file" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_selected']; ?>
" name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" style="width:100%;<?php if ($this->_tpl_vars['field']['height'] != ''): ?>height:<?php echo $this->_tpl_vars['field']['height']; ?>
px<?php endif; ?>">
                      <?php endif; ?>
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 10): ?>
                      <div class="fcaption_small"> <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]): ?>
                        <?php $this->assign('count_images', "count_".($this->_tpl_vars['field']['fieldname'])); ?>
                        
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&mdo=photos_form&hide_menu=true&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&f_name=<?php echo $this->_tpl_vars['fieldname']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
')"><img border="0" src="images/picture_edit.png"></a></td>
                            <td width="5px"></td>
                            <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&mdo=photos_form&hide_menu=true&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&f_name=<?php echo $this->_tpl_vars['fieldname']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
')"><b style="font-size:14px"><?php if ($this->_tpl_vars['field']['comment'] != ''): ?><?php echo $this->_tpl_vars['field']['comment']; ?>
<?php else: ?><?php echo $this->_tpl_vars['field']['fieldname']; ?>
<?php endif; ?></b></a>  <?php echo $this->_tpl_vars['MSGTEXT']['edit_data_added']; ?>
 <b><?php echo $this->_tpl_vars['field'][$this->_tpl_vars['count_images']]; ?>
</b> <?php echo $this->_tpl_vars['MSGTEXT']['edit_data_files']; ?>
 </td>
                          </tr>
                        </table>
                        
                        <?php else: ?>
                        <?php echo $this->_tpl_vars['MSGTEXT']['edit_data_edit_field']; ?>
 <b>«<?php if ($this->_tpl_vars['field']['comment'] != ''): ?><?php echo $this->_tpl_vars['field']['comment']; ?>
<?php else: ?><?php echo $this->_tpl_vars['field']['fieldname']; ?>
<?php endif; ?>»</b> <?php echo $this->_tpl_vars['MSGTEXT']['edit_data_can_only_be']; ?>

                        <?php endif; ?>
                        </div>
                      <?php endif; ?>
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 11): ?>
                      <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]): ?>
                      <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td><a href="../modules/<?php echo $this->_tpl_vars['module_name']; ?>
/management/storage/files/<?php echo $this->_tpl_vars['current_tablename_no_prefix']; ?>
/<?php echo $this->_tpl_vars['field']['fieldname']; ?>
/<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
/<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
" target="_blank"><b><?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
</b></a><br>
                            <?php $this->assign('file_size', "size_".($this->_tpl_vars['field']['fieldname'])); ?>
                            <?php $this->assign('file_create', "create_".($this->_tpl_vars['field']['fieldname'])); ?> <font style="font-size:9px"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_creat']; ?>
: <b><?php echo $this->_tpl_vars['field'][$this->_tpl_vars['file_create']]; ?>
</b></font><br>
                            <font style="font-size:9px"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_size']; ?>
: <b><?php echo $this->_tpl_vars['field'][$this->_tpl_vars['file_size']]; ?>
 kb</b></font><br></td>
                          <td width="15px"> </td>
                          <td><input name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
_delete" value="<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
" type="checkbox"></td>
                          <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_remove']; ?>
</td>
                        </tr>
                      </table>
                      <?php endif; ?>
                      <input type="file" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_selected']; ?>
" name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" style="width:100%;<?php if ($this->_tpl_vars['field']['height'] != ''): ?>height:<?php echo $this->_tpl_vars['field']['height']; ?>
px<?php endif; ?>">
                      <?php endif; ?>
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 12): ?>
                      <div class="fcaption_none"> <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]): ?>
                        <?php $this->assign('count_files', "count_".($this->_tpl_vars['field']['fieldname'])); ?>
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&mdo=files_form&hide_menu=true&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&f_name=<?php echo $this->_tpl_vars['fieldname']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
')"><img border="0" src="images/tag_blue_edit.png"></a></td>
                            <td width="5px"></td>
                            <td valign="middle"><a href="javascript:openBlockSettingsWindow('?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&mdo=files_form&hide_menu=true&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&f_name=<?php echo $this->_tpl_vars['fieldname']; ?>
&id=<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']]; ?>
')"><b><?php if ($this->_tpl_vars['field']['comment'] != ''): ?><?php echo $this->_tpl_vars['field']['comment']; ?>
<?php else: ?><?php echo $this->_tpl_vars['field']['fieldname']; ?>
<?php endif; ?></b></a>  <?php echo $this->_tpl_vars['MSGTEXT']['edit_data_added']; ?>
 <b><?php echo $this->_tpl_vars['field'][$this->_tpl_vars['count_files']]; ?>
</b> <?php echo $this->_tpl_vars['MSGTEXT']['edit_data_files']; ?>
</td>
                          </tr>
                        </table>
                        <?php else: ?>
                        <?php echo $this->_tpl_vars['MSGTEXT']['edit_data_edit_field']; ?>
 <b><?php if ($this->_tpl_vars['field']['comment'] != ''): ?><?php echo $this->_tpl_vars['field']['comment']; ?>
<?php else: ?><?php echo $this->_tpl_vars['field']['fieldname']; ?>
<?php endif; ?></b> <?php echo $this->_tpl_vars['MSGTEXT']['edit_data_can_only_be']; ?>

                        <?php endif; ?>
                        </div>
                      <?php endif; ?>
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 13): ?>
                      <select
						<?php if ($this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]): ?> onchange="hideFields(this, '<?php echo $this->_tpl_vars['fieldname']; ?>
', '<?php echo $this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]; ?>
', '')"<?php endif; ?> name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" style="width:100%;<?php if ($this->_tpl_vars['field']['height'] != ''): ?>height:<?php echo $this->_tpl_vars['field']['height']; ?>
px<?php endif; ?>">                        
						<?php $this->assign('sourse_values', "list_".($this->_tpl_vars['field']['fieldname'])); ?>
                        <option value="<?php if ($this->_tpl_vars['field']['datatype_id'] != 24 && $this->_tpl_vars['field']['datatype_id'] != 25): ?>0<?php endif; ?>" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_specified']; ?>
</option>                        
						<?php $_from = $this->_tpl_vars['field'][$this->_tpl_vars['sourse_values']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                        <option value="<?php echo $this->_tpl_vars['list']['id']; ?>
" <?php if ($this->_tpl_vars['list']['id'] == $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['list']['name']; ?>
 → <?php echo $this->_tpl_vars['list']['description']; ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                      </select>
                      <?php endif; ?>
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 14): ?>
                      <input type="text" <?php if ($this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]): ?> onkeyup="hideFields(this, '<?php echo $this->_tpl_vars['fieldname']; ?>
', '<?php echo $this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]; ?>
', '')" <?php endif; ?> value="<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
" name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" style="<?php echo $this->_tpl_vars['field']['style']; ?>
<?php if ($this->_tpl_vars['field']['width']): ?>width:<?php echo $this->_tpl_vars['field']['width']; ?>
;<?php else: ?>width:100%;<?php endif; ?><?php if ($this->_tpl_vars['field']['height'] != ''): ?>height:<?php echo $this->_tpl_vars['field']['height']; ?>
px<?php endif; ?>">
                      <?php endif; ?>
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 15): ?>
                      <textarea <?php if ($this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]): ?> onkeyup="hideFields(this, '<?php echo $this->_tpl_vars['fieldname']; ?>
', '<?php echo $this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]; ?>
', '')" <?php endif; ?> name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" style="width:100%;height:<?php if ($this->_tpl_vars['field']['height'] != ''): ?><?php echo $this->_tpl_vars['field']['height']; ?>
px<?php else: ?>80px<?php endif; ?>"><?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
</textarea>
                      <?php endif; ?>
                      
                      <?php if ($this->_tpl_vars['field']['edittype_id'] == 16): ?>
                      <div class="fcaption_small">
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td width="20px" valign="middle"><input style="margin:0" type="radio" name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" <?php if (isset ( $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']] )): ?> <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']] == 0): ?>checked<?php endif; ?><?php else: ?><?php if ($this->_tpl_vars['field']['default'] == 1): ?>checked<?php endif; ?><?php endif; ?> value="0"></td>
                            <td valign="middle"><font color=white><i><?php echo $this->_tpl_vars['MSGTEXT']['edit_data_not_specified']; ?>
</i></font> </td>
                            <td width="20px" valign="middle"></td>
                            <td width="20px" valign="middle"><input style="margin:0" type="radio" name="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" id="<?php echo $this->_tpl_vars['field']['fieldname']; ?>
" <?php if (isset ( $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']] )): ?> <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']] == 1): ?>checked<?php endif; ?><?php else: ?><?php if ($this->_tpl_vars['field']['default'] == 1): ?>checked<?php endif; ?><?php endif; ?> value="1"></td>
                            <td valign="middle"><?php echo $this->_tpl_vars['field']['comment']; ?>
</td>
                          </tr>
                        </table>
                      </div>
                      <?php endif; ?>                                                    
                   			</td>
                   			</tr>
	    		     	</table>
	    		     </td>
	    		     	    							    		      			
    	              <?php if ($this->_tpl_vars['field']['datatype_id'] == 4 || $this->_tpl_vars['field']['datatype_id'] == 12): ?>
                  		<?php echo '<script type="text/javascript">Calendar.setup({inputField : \''; ?>
<?php echo $this->_tpl_vars['field']['fieldname']; ?>
', ifFormat : "<?php if ($this->_tpl_vars['field']['datatype_id'] == 4): ?>%Y-%m-%d<?php else: ?>%Y-%m-%d %H:%M:00<?php endif; ?>", button: '<?php echo $this->_tpl_vars['field']['fieldname']; ?>
<?php echo '\'	});</script>'; ?>

	                  <?php endif; ?>                                                                        	    		     
                  <?php endif; ?>                  
                  <?php endforeach; endif; unset($_from); ?>                  
   				  			</tr>
						</table>
				  	</td>
				  </tr>
	    		      		
	    		      		
				 <?php if ($this->_tpl_vars['enable_fiedls'] > 4): ?>
                  <tr>
                    <td height="10px"></td>
                  </tr>
                  <tr>
                    <td align="right">
                     <?php if ($this->_tpl_vars['info']['block_type'] == 2): ?>
                      <?php if ($this->_tpl_vars['currentData'][$this->_tpl_vars['pk_incr_fieldname']] == 0): ?>
                      	<input type="button" class="button_insert" onclick="set_action('insert')" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_add']; ?>
" style="width:100px">
                      <?php else: ?>
                     	 <input type="button" class="button_update" onclick="set_action('save')" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_save']; ?>
" style="width:100px">
                      	<input type="button" class="button_insert" onclick="set_action('insert')" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_add']; ?>
" style="width:100px">	                      
    	                  <input type="button" class="button_new" onclick="location.href='?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
&sort_by=<?php echo $this->_tpl_vars['sort_by']; ?>
&sort_type=<?php echo $this->_tpl_vars['sort_type']; ?>
<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?><?php if ($_GET['lang_id']): ?>&lang_id=<?php echo $_GET['lang_id']; ?>
<?php endif; ?><?php if ($_GET['opener_f_name']): ?>&opener_f_name=<?php echo $_GET['opener_f_name']; ?>
<?php endif; ?><?php if ($_GET['own_f_name']): ?>&own_f_name=<?php echo $_GET['own_f_name']; ?>
<?php endif; ?><?php if ($_GET['f_name']): ?>&f_name=<?php echo $_GET['f_name']; ?>
<?php endif; ?><?php if ($_GET['filter_for_table']): ?>&filter_for_table=<?php echo $_GET['filter_for_table']; ?>
<?php endif; ?>&t_name=<?php echo $this->_tpl_vars['table_name']; ?>
&tag_id=<?php echo $this->_tpl_vars['tag_id']; ?>
&p=<?php echo $this->_tpl_vars['p_num']; ?>
'" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_add_rec']; ?>
" style="width:110px">
    	                  <input type="button" class="button_delete" onclick="set_action('delete')" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_remove']; ?>
" style="width:100px">
                      <?php endif; ?>
                    <?php else: ?>
                    	<input type="button" class="button_update" onclick="set_action('save')" value="<?php echo $this->_tpl_vars['MSGTEXT']['edit_data_save']; ?>
" style="width:100px">
                    <?php endif; ?>
                      </td>
                  </tr>
                 <?php endif; ?>                                    
                </table>
                </td>
            </tr>
          </table>
          </td>
      </tr>
    </table>
  </form>
  
  <script language="JavaScript">
  <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
  <?php $this->assign('fieldname', $this->_tpl_vars['field']['fieldname']); ?>
  <?php if ($this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]): ?> hideFields('', '<?php echo $this->_tpl_vars['fieldname']; ?>
', '<?php echo $this->_tpl_vars['hide_fields'][$this->_tpl_vars['fieldname']]; ?>
', '<?php echo $this->_tpl_vars['currentData'][$this->_tpl_vars['fieldname']]; ?>
'); <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
  </script>
  
  <?php echo $this->_tpl_vars['editorsCode']; ?>

  <?php endif; ?>    
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