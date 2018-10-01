<?php /* Smarty version 2.6.26, created on 2014-09-14 09:30:06
         compiled from tables/tables_form_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'tables/tables_form_edit.tpl', 679, false),)), $this); ?>
<?php echo '
<script language="JavaScript">
'; ?>
<?php if ($this->_tpl_vars['refreshFrame'] || $_GET['refreshFrame']): ?> reloadLeftFrame(); <?php endif; ?><?php echo '

var doc = document;
var pred_id;
var name;
var initials;
var posada;
var counter=-1;
var tr_objects=new Array();
var xmlObject2 = getXmlHttp();
var selected_edit_type;


function getTemplate(tpl_name, c_number) {
	var time = Math.random();
	'; ?>

	sf_id=GetElementById('sourse_field_id'+c_number).value;
	delete_value=GetElementById('delete'+c_number).value;
	own_filter_value=GetElementById('own_filter'+c_number).value;

	t_id=GetElementById('id').value;
	f_id=GetElementById('field_id'+c_number).value;

	xmlObject2.open("GET", "ajax.php?func=getTemplate&tpl_name="+tpl_name+"&c_number="+c_number+"&f_id="+f_id+"&sourse_field_id="+sf_id+"&delete="+delete_value+"&own_filter="+own_filter_value+"&module_id=<?php echo $_SESSION['___GoodCMS']['m_id']; ?>
&table_id="+t_id+"&selected_edit_type="+selected_edit_type+"&time="+time ,false);
	<?php echo '

	xmlObject2.send(null);

	if(xmlObject2.status == 200) {
		getTemplateGet();
	}
}


function getTemplateGet() {
	if (xmlObject2.readyState == 4) {
		var response = xmlObject2.responseText;
		GetElementById(\'frameBlock\').style.width=\'100%\';
		getDocumentSize();
		GetElementById(\'frameBlock\').style.display=\'block\';
		GetElementById(\'frameBlock2\').style.display=\'block\';
		GetElementById(\'frameContentBlock\').innerHTML=response;
	}
}


function hideFormBlocks() {
	GetElementById(\'frameBlock\').style.display=\'none\';
	GetElementById(\'frameBlock2\').style.display=\'none\'
}


function getTables(f_filter) {

	if (f_filter) {
		ffilter=\'&\'+f_filter+\'=1\';
	}
	else {
		ffilter=\'\';
	}


	var m_id=GetElementById(\'module_id\').value;
	
	var time = Math.random();
	xmlObject2.open("GET", "ajax.php?func=getTables&module_id="+m_id+"&time="+time+ffilter ,false);
	xmlObject2.send(null);
	if(xmlObject2.status == 200) {
		getTablesGet();
	}
}


function getTablesGet() {
	if (xmlObject2.readyState == 4) {
		var response = xmlObject2.responseText;
		var objSel = GetElementById(\'table_id\');
		objSel.options.length = 0;		

		el=new Option('; ?>
"<?php echo $this->_tpl_vars['MSGTEXT']['editData_no_table']; ?>
"<?php echo ' ,0);
		el.style.color=\'gray\';
		objSel.options[objSel.options.length] =el;

		if (response.length>0) {
			m=response.split(\'|\');

			for (i=0; i<m.length; i=i+2) {
				objSel.options[objSel.options.length] = new Option(m[i+1], m[i]);
			}
			
		}
		
		objSel2=GetElementById(\'field_id\');
		objSel2.options.length = 0;
		el=new Option('; ?>
"<?php echo $this->_tpl_vars['MSGTEXT']['editData_no_esteblishid']; ?>
"<?php echo ' ,0);
		objSel2.options[objSel2.options.length] =el;		
	}
}



function getFields(f_filter) {

	if (f_filter) {
		ffilter=\'&\'+f_filter+\'=1\';
	}
	else {
		ffilter=\'\';
	}


	var m_id=GetElementById(\'module_id\').value;
	var t_id=GetElementById(\'table_id\').value;
	var time = Math.random();
	xmlObject2.open("GET", "ajax.php?func=getFields&table_id="+t_id+"&module_id="+m_id+"&time="+time+ffilter ,false);
	xmlObject2.send(null);
	if(xmlObject2.status == 200) {
		getFieldsGet();
	}
}


function getFieldsGet() {
	if (xmlObject2.readyState == 4) {
		var response = xmlObject2.responseText;
		var objSel = GetElementById(\'field_id\');
		objSel.options.length = 0;

		el=new Option('; ?>
"<?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_not_set']; ?>
"<?php echo ' ,0);
		el.style.color=\'gray\';
		objSel.options[objSel.options.length] =el;

		if (response.length>0) {
			m=response.split(\'|\');

			for (i=0; i<m.length; i=i+2) {
				objSel.options[objSel.options.length] = new Option(m[i+1], m[i]);
			}
		}
	}
}


function saveSourseFieldId(c_number) {
	GetElementById(\'sourse_field_id\'+c_number).value=GetElementById(\'field_id\').value;
	
	if (GetElementById(\'delete\')) {
	if (GetElementById(\'delete\').checked) GetElementById(\'delete\'+c_number).value=1;
	else GetElementById(\'delete\'+c_number).value=0;
	}
	
	if (GetElementById(\'own_filter\')) {
		if (GetElementById(\'own_filter\').checked) GetElementById(\'own_filter\'+c_number).value=1;
		else GetElementById(\'own_filter\'+c_number).value=0;
	}
	

	//обновляем по аджаксу источник
	if (GetElementById(\'field_id\'+c_number).value!=\'\') {
		updateDataMap(GetElementById(\'sourse_field_id\'+c_number).value, GetElementById(\'field_id\'+c_number).value, GetElementById(\'delete\'+c_number).value, GetElementById(\'own_filter\'+c_number).value);
	}

	hideFormBlocks();
}


function updateDataMap(sourse_field_id, field_id, delete_value, own_filter_value) {

	var time = Math.random();
	xmlObject2.open("GET", "ajax.php?func=updateDataMap&field_id="+field_id+"&sourse_field_id="+sourse_field_id+"&delete_value="+delete_value+"&own_filter_value="+own_filter_value+"&time="+time ,false);
	xmlObject2.send(null);
	if(xmlObject2.status == 200) {
				
	}
}


function saveSettingsEditGet() {
	if (xmlObject2.readyState == 4) {
		var response = xmlObject2.responseText;
		hideFormBlocks();
	}
}


function selectByValue(obj_id, val) {
	if (val!=\'\') {
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
	'; ?>

	<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
	addNewField();

	selectByValue('edittype_id'+counter, '<?php echo $this->_tpl_vars['field']['edittype_id']; ?>
');
	GetElementById('sourse_field_id'+counter).value='<?php echo $this->_tpl_vars['field']['sourse_field_id']; ?>
';
	GetElementById('delete'+counter).value='<?php echo $this->_tpl_vars['field']['delete']; ?>
';
	GetElementById('own_filter'+counter).value='<?php echo $this->_tpl_vars['field']['own_filter']; ?>
';
	

	img=GetElementById('imgsettings'+counter);
	edittype=GetElementById('edittype_id'+counter).value;
	if ((edittype==3 || edittype==4 || edittype==6 || edittype==14 || edittype==15) && (<?php echo $this->_tpl_vars['field']['datatype_id']; ?>
!=24 && <?php echo $this->_tpl_vars['field']['datatype_id']; ?>
!=25)) img.style.visibility='visible';
	else img.style.visibility='hidden';

	GetElementById('sort_index'+counter).value='<?php echo $this->_tpl_vars['field']['sort_index']; ?>
';
	GetElementById('field_id'+counter).value='<?php echo $this->_tpl_vars['field']['id']; ?>
';
	GetElementById('comment'+counter).value='<?php echo $this->_tpl_vars['field']['comment']; ?>
';
	GetElementById('fieldname'+counter).value='<?php echo $this->_tpl_vars['field']['fieldname']; ?>
';
	selectByValue('datatype_id'+counter, '<?php echo $this->_tpl_vars['field']['datatype_id']; ?>
');
	GetElementById('len'+counter).value='<?php echo $this->_tpl_vars['field']['len']; ?>
';
	GetElementById('default'+counter).value='<?php echo $this->_tpl_vars['field']['default']; ?>
';
	//selectByValue('collation_id'+counter, '<?php echo $this->_tpl_vars['field']['collation_id']; ?>
');
	
	GetElementById('group_caption'+counter).value='<?php echo $this->_tpl_vars['field']['group_caption']; ?>
';
	
	GetElementById('pk'+counter).checked=<?php if ($this->_tpl_vars['field']['pk'] == 1): ?>true<?php else: ?>false<?php endif; ?>;
	GetElementById('not_null'+counter).checked=<?php if ($this->_tpl_vars['field']['not_null'] == 1): ?>true<?php else: ?>false<?php endif; ?>;
	GetElementById('unsigned'+counter).checked=<?php if ($this->_tpl_vars['field']['unsigned'] == 1): ?>true<?php else: ?>false<?php endif; ?>;
	GetElementById('auto_incr'+counter).checked=<?php if ($this->_tpl_vars['field']['auto_incr'] == 1): ?>true<?php else: ?>false<?php endif; ?>;
	GetElementById('zerofill'+counter).checked=<?php if ($this->_tpl_vars['field']['zerofill'] == 1): ?>true<?php else: ?>false<?php endif; ?>;
	GetElementById('unique'+counter).checked=<?php if ($this->_tpl_vars['field']['unique'] == 1): ?>true<?php else: ?>false<?php endif; ?>;

	checkFields(counter);
	checkIncrenent(counter);
	<?php endforeach; endif; unset($_from); ?>
	<?php echo '
}


function beforeSubmit() {

	form	= GetElementById(\'editForm\');
	if (form.elements.length==8) {
		alert("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_alert_one']; ?>
<?php echo '");
		return false
	}

	for (var i = 0; i < form.elements.length; i++) {
		form.elements[i].disabled=false;
	}

	if (counter!=-1) GetElementById(\'counter\').value=counter;
	return true;
}


function collationsList() {
	'; ?>

	collation_text='<select disabled onfocus="setcolor(\'newRow'+counter+'\');" name="collation_id'+counter+'" id="collation_id'+counter+'" style="width:100%" ><?php $_from = $this->_tpl_vars['collations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['collation']):
?><option value="<?php echo $this->_tpl_vars['collation']['id']; ?>
" ><?php echo $this->_tpl_vars['collation']['collation']; ?>
<?php endforeach; endif; unset($_from); ?></select>';
	return collation_text;
	<?php echo '
}


function datatypesList() {
	'; ?>

	datatype_text='<select disabled onChange="setType('+counter+')" onfocus="setcolor(\'newRow'+counter+'\');" name="datatype_id'+counter+'" id="datatype_id'+counter+'" style="width:100%" ><?php $_from = $this->_tpl_vars['datatypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['datatype']):
?><option value="<?php echo $this->_tpl_vars['datatype']['id']; ?>
" ><?php echo $this->_tpl_vars['datatype']['datatype']; ?>
<?php endforeach; endif; unset($_from); ?></select>';
	return datatype_text;
	<?php echo '
}


function edittypeList() {
	'; ?>


	edittype_text='<table border=0 cellpadding=0 cellspacing=0><tr><td><input type="hidden" name="delete'+counter+'" id="delete'+counter+'" value="0"><input type="hidden" name="own_filter'+counter+'" id="own_filter'+counter+'" value="0"><input type="hidden" name="sourse_field_id'+counter+'" id="sourse_field_id'+counter+'" value="" ><img hspace=0 id="imgsettings'+counter+'" alt="<?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_sourse']; ?>
" style="cursor:pointer;visibility:hidden" onClick="setDataMap('+counter+')" src="images/f_s.gif" align="left" border=0></td><td width="2">&nbsp;<td><td><select disabled onChange="showHideImg('+counter+')" onfocus="setcolor(\'newRow'+counter+'\');" name="edittype_id'+counter+'" id="edittype_id'+counter+'" style="width:125" ><option value="0" selected style="color:gray">Not Edit<?php $_from = $this->_tpl_vars['edittypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['edittype']):
?><option value="<?php echo $this->_tpl_vars['edittype']['id']; ?>
" ><?php echo $this->_tpl_vars['edittype']['edittype']; ?>
<?php endforeach; endif; unset($_from); ?></select></td></tr></table>';
	return edittype_text;
	<?php echo '
}


function setDataMap(c_number) {
	selected_edit_type= GetElementById(\'edittype_id\'+c_number).value;
	setcolor(\'newRow\'+c_number);
	getTemplate(\'editDataMapForm.tpl\',c_number);
}


function getTemplateByWindow(tpl_name, c_number) {
	var time = Math.random();
	'; ?>


	f_id=GetElementById('field_id'+c_number).value;
	url="ajax.php?func=getTemplate&tpl_name="+tpl_name+"&f_id="+f_id+"&module_id=<?php echo $_SESSION['___GoodCMS']['m_id']; ?>
&time="+time+'&t_id=<?php echo $this->_tpl_vars['id']; ?>
';

	NewWin= open(url, "displayWindow", "width="+750+",height="+500+",status=no,toolbar=no,scrollbars=yes, resizable=no, menubar=no");
	NewWin.document.close();
	NewWin.focus();
	<?php echo '
}


function setSettings(c_number) {
	setcolor(\'newRow\'+c_number);
	getTemplateByWindow(\'editFieldSettings.tpl\',c_number);
}


function showHideImg(c_number) {
	edittype=GetElementById(\'edittype_id\'+c_number).value;

	img=GetElementById(\'imgsettings\'+c_number);

	if (edittype==3 || edittype==4 || edittype==6 || edittype==14 || edittype==15) {
		img.style.visibility=\'visible\';
	}
	else img.style.visibility=\'hidden\';

	setType(c_number);
}


function setType(c_number) {

	type_val=GetElementById(\'datatype_id\'+c_number).value;
	def=\'*\';
	if (type_val==7) def=11;
	else if (type_val==2) def=1;
	else if (type_val==4) def="";
	else if (type_val==6) def=9;
	else if (type_val==5) def=6;
	else if (type_val==8) def=20;
	else if (type_val==9) def="";
	else if (type_val==10) def="";
	else if (type_val==11) def=10;
	else if (type_val==12) def="";
	else if (type_val==15) def=4;
	else if (type_val==27) def="";
	else if (type_val==28) def=1;

	if (def!=\'*\') GetElementById(\'len\'+c_number).value=def;

	//выставляем поле по умолчанию для типов SET ENUM
	if (type_val==24 || type_val==25) {
		if (type_val==24) sel_d_type=3;
		else sel_d_type=4;

		GetElementById(\'edittype_id\'+c_number).options[sel_d_type].selected=true;
		img=GetElementById(\'imgsettings\'+c_number);
		img.style.visibility=\'hidden\';
	}

	checkIncrenent(c_number);
}


function checkIncrenentCount(c_number) {
	setcolor(\'newRow\'+c_number);
	
	datatype_id=GetElementById(\'datatype_id\'+c_number).value;
	if (datatype_id==2 || datatype_id==5 || datatype_id==6 || datatype_id==7 || datatype_id==8 || datatype_id==9 || datatype_id==10 || datatype_id==11 || datatype_id==26 || datatype_id==27 || datatype_id==28 || datatype_id==29) {

		for (i=0; i<counter+1; i++)
		if (i!=c_number && GetElementById(\'auto_incr\'+i).checked) {
			GetElementById(\'auto_incr\'+i).checked=false;
			break;
		}
	}
	else GetElementById(\'auto_incr\'+c_number).checked=false;
}


function checkIncrenent(c_number) {
	setcolor(\'newRow\'+c_number);
	datatype_id=GetElementById(\'datatype_id\'+c_number).value;
	if (datatype_id!=2 && datatype_id!=4 && datatype_id!=12 && datatype_id!=5 && datatype_id!=6 && datatype_id!=7 && datatype_id!=8 && datatype_id!=9 && datatype_id!=10 && datatype_id!=14 && datatype_id!=15 && datatype_id!=11 && datatype_id!=26 && datatype_id!=27 && datatype_id!=28 && datatype_id!=29) {
		GetElementById(\'auto_incr\'+c_number).checked=false;
		GetElementById(\'unsigned\'+c_number).checked=false;
		GetElementById(\'zerofill\'+c_number).checked=false;
		//GetElementById(\'collation_id\'+c_number).disabled=false;
	}
	else {
		//GetElementById(\'collation_id\'+c_number).disabled=true;
	}

	//если автоинкремент, то нельзя поставить unique
	if (!GetElementById(\'auto_incr\'+c_number).checked && (datatype_id==1 || datatype_id==7 || datatype_id==8) ) {
		GetElementById(\'unique\'+c_number).disabled=false;
	}
	else {
		GetElementById(\'unique\'+c_number).disabled=true;
	}

	edittype_id=GetElementById(\'edittype_id\'+c_number).value;
	if (edittype_id==4 && (datatype_id!=2 && datatype_id!=5  && datatype_id!=6 && datatype_id!=7 && datatype_id!=8)) {
		alert("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_alert_text']; ?>
<?php echo '");
		GetElementById(\'datatype_id\'+c_number).value=7;
		GetElementById(\'auto_incr\'+c_number).checked=false;
		GetElementById(\'unsigned\'+c_number).checked=false;
		GetElementById(\'zerofill\'+c_number).checked=false;
		GetElementById(\'unique\'+c_number).checked=false;

		//GetElementById(\'collation_id\'+c_number).disabled=false;
		GetElementById(\'len\'+c_number).value=\'\';
	}
	else if (edittype_id==14) {		//Friendly URL
		GetElementById(\'datatype_id\'+c_number).value=1;
		GetElementById(\'auto_incr\'+c_number).checked=false;
		GetElementById(\'unsigned\'+c_number).checked=false;
		GetElementById(\'zerofill\'+c_number).checked=false;
		GetElementById(\'unique\'+c_number).checked=true;
		GetElementById(\'unique\'+c_number).disabled=true;
		//GetElementById(\'collation_id\'+c_number).disabled=false;
		GetElementById(\'len\'+c_number).value=\'255\';
	}
	else if (edittype_id==15) {		//CopyNewContent
		GetElementById(\'datatype_id\'+c_number).value=1;
		GetElementById(\'auto_incr\'+c_number).checked=false;
		GetElementById(\'unsigned\'+c_number).checked=false;
		GetElementById(\'zerofill\'+c_number).checked=false;
		//GetElementById(\'collation_id\'+c_number).disabled=false;
	}

	else if ((edittype_id==10 || edittype_id==12) && datatype_id!=1 && datatype_id!=3 && datatype_id!=23) {		// Images, Files
		GetElementById(\'datatype_id\'+c_number).value=3;
		GetElementById(\'auto_incr\'+c_number).checked=false;
		GetElementById(\'unsigned\'+c_number).checked=false;
		GetElementById(\'zerofill\'+c_number).checked=false;
		GetElementById(\'unique\'+c_number).checked=false;
		GetElementById(\'unique\'+c_number).disabled=true;
		//GetElementById(\'collation_id\'+c_number).disabled=false;
		GetElementById(\'len\'+c_number).value=\'\';
	}
	else if (edittype_id==3 && datatype_id!=7 && datatype_id!=24 && datatype_id!=25) {		// Select
		GetElementById(\'datatype_id\'+c_number).value=7;
		GetElementById(\'auto_incr\'+c_number).checked=false;
		GetElementById(\'unsigned\'+c_number).checked=false;
		GetElementById(\'zerofill\'+c_number).checked=false;
		GetElementById(\'unique\'+c_number).checked=false;
		GetElementById(\'unique\'+c_number).disabled=true;
		//GetElementById(\'collation_id\'+c_number).disabled=true;
		GetElementById(\'len\'+c_number).value=\'11\';
	}

}


function checkFieldsAfterEditing(c_number) {

	fieldname=\'fieldname\'+c_number;
	if (GetElementById(fieldname).value==\'\') {
		GetElementById(\'edittype_id\'+c_number).disabled=true;
		GetElementById(\'comment\'+c_number).disabled=true;
		GetElementById(\'datatype_id\'+c_number).disabled=true;
		GetElementById(\'len\'+c_number).disabled=true;
		GetElementById(\'default\'+c_number).disabled=true;
		//GetElementById(\'collation_id\'+c_number).disabled=true;
		GetElementById(\'pk\'+c_number).disabled=true;
		GetElementById(\'not_null\'+c_number).disabled=true;
		GetElementById(\'unsigned\'+c_number).disabled=true;
		GetElementById(\'auto_incr\'+c_number).disabled=true;
		GetElementById(\'zerofill\'+c_number).disabled=true;
		GetElementById(\'unique\'+c_number).disabled=true;
	}
}


function checkFields(c_number) {

	fieldname=\'fieldname\'+c_number;
	if (GetElementById(fieldname).value!=\'\') {
		GetElementById(\'edittype_id\'+c_number).disabled=false;
		GetElementById(\'comment\'+c_number).disabled=false;
		GetElementById(\'datatype_id\'+c_number).disabled=false;
		GetElementById(\'len\'+c_number).disabled=false;
		GetElementById(\'default\'+c_number).disabled=false;
		//GetElementById(\'collation_id\'+c_number).disabled=false;
		GetElementById(\'pk\'+c_number).disabled=false;
		GetElementById(\'not_null\'+c_number).disabled=false;
		GetElementById(\'unsigned\'+c_number).disabled=false;
		GetElementById(\'auto_incr\'+c_number).disabled=false;
		GetElementById(\'zerofill\'+c_number).disabled=false;
		GetElementById(\'unique\'+c_number).disabled=false;
	}
	datatype=\'datatype\'+c_number;
}


function setPK(c_number){
	setcolor(\'newRow\'+c_number);
	if (GetElementById(\'pk\'+c_number).checked==true) {
		GetElementById(\'not_null\'+c_number).checked=true;
	}
}


function addNewField(){
	counter++;

	// Находим нужную таблицу
	var tbody = doc.getElementById(\'tab1\').getElementsByTagName(\'TBODY\')[0];
	// Создаем строку таблицы и добавляем ее
	var row = doc.createElement("TR");
	row.id=\'newRow\'+counter;
	tr_objects[row.id]=tbody.appendChild(row);

	// Создаем ячейки в вышесозданной строке
	// и добавляем тх
	var td000 = doc.createElement("TD");
	var td00 = doc.createElement("TD");
	var td0 = doc.createElement("TD");
	var td1 = doc.createElement("TD");
	var td2 = doc.createElement("TD");
	var td3 = doc.createElement("TD");
	var td4 = doc.createElement("TD");
	//var td5 = doc.createElement("TD");
	var td5_5 = doc.createElement("TD");
	var td6 = doc.createElement("TD");
	var td7 = doc.createElement("TD");
	var td8 = doc.createElement("TD");
	var td9 = doc.createElement("TD");
	var td10 = doc.createElement("TD");
	var td11 = doc.createElement("TD");

	row.appendChild(td000);
	row.appendChild(td00);
	row.appendChild(td0);
	row.appendChild(td1);
	row.appendChild(td2);
	row.appendChild(td3);
	row.appendChild(td4);
	//row.appendChild(td5);
	row.appendChild(td5_5);
	row.appendChild(td6);
	row.appendChild(td7);
	row.appendChild(td8);
	row.appendChild(td9);
	row.appendChild(td10);
	row.appendChild(td11);

	
	
	'; ?>

	datatype_text=datatypesList();
	//collation_text=collationsList();
	edittype_text=edittypeList();
	<?php echo '

	// Наполняем ячейки
	td000.innerHTML =\'<input type="text" name="sort_index\'+counter+\'" id="sort_index\'+counter+\'" value="" style="width:30px">\';
	td00.innerHTML =edittype_text;
	td00.align=\'left\';
	td00.valign=\'middle\';
	td0.innerHTML =\'<input type="hidden" name="field_id\'+counter+\'" id="field_id\'+counter+\'" value=""><input type="text" onfocus="setcolor(\\\'newRow\'+counter+\'\\\');" disabled style="width:160px" name="comment\'+counter+\'" id="comment\'+counter+\'"	value="">\';
	td1.innerHTML =\'<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td><img alt="'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_settings_more']; ?>
<?php echo '" align="center" style="cursor:pointer;" onClick="setSettings(\'+counter+\')" src="images/f_s.gif"></td><td width="2px">&nbsp;</td><td><input type="text" class="field_name" onblur="checkFieldsAfterEditing(\'+counter+\')" onKeyUp="checkFields(\'+counter+\')" onfocus="setcolor(\\\'newRow\'+counter+\'\\\');" style="width:130px" name="fieldname\'+counter+\'" id="fieldname\'+counter+\'" value=""></td></tr></table>\';
	td2.innerHTML =datatype_text;
	td3.innerHTML =\'<input type="text" onfocus="setcolor(\\\'newRow\'+counter+\'\\\');" disabled style="width:40px" name="len\'+counter+\'" id="len\'+counter+\'" value="">\';
	td4.innerHTML =\'<input type="text" onfocus="setcolor(\\\'newRow\'+counter+\'\\\');" disabled style="width:50px" name="default\'+counter+\'" id="default\'+counter+\'" value="">\';
	//td5.innerHTML = collation_text;
	
	td5_5.innerHTML = \'<input type="text" onfocus="setcolor(\\\'newRow\'+counter+\'\\\');" style="width:50px" name="group_caption\'+counter+\'" id="group_caption\'+counter+\'" value="">\';;
		
	
	td6.align=\'center\';
	td6.innerHTML =\'<input onClick="setPK(\'+counter+\')" disabled type="checkbox" name="pk\'+counter+\'" id="pk\'+counter+\'" value="1">\';
	td7.align=\'center\';
	td7.innerHTML =\'<input onClick="setPK(\'+counter+\')" disabled type="checkbox" name="not_null\'+counter+\'" id="not_null\'+counter+\'" value="1">\';
	td8.align=\'center\';
	td8.innerHTML =\'<input onClick="checkIncrenent(\'+counter+\')" disabled type="checkbox" name="unsigned\'+counter+\'" id="unsigned\'+counter+\'"	value="1">\';
	td9.align=\'center\';
	td9.innerHTML =\'<input onClick="checkIncrenentCount(\'+counter+\');" disabled type="checkbox" name="auto_incr\'+counter+\'" id="auto_incr\'+counter+\'" value="1">\';
	td10.align=\'center\';
	td10.innerHTML =\'<input onClick="checkIncrenent(\'+counter+\')" disabled type="checkbox" name="zerofill\'+counter+\'" id="zerofill\'+counter+\'" value="1">\';
	td11.align=\'center\';
	td11.innerHTML =\'<input onClick="checkIncrenent(\'+counter+\')" disabled type="checkbox" name="unique\'+counter+\'" id="unique\'+counter+\'" value="1">\';

	//selectByValue(\'collation_id\'+counter,56);
}


function setcolor(id) {
	obj=doc.getElementById(id);
	obj.style.background=\'#D0DCFF\';
	if (pred_id && pred_id!=id) {
		obj=doc.getElementById(pred_id);
		obj.style.background=\'white\';
	}

	pred_id=id;
	GetElementById(\'deleteButton\').disabled=false;
}


function unsetcolor(obj) {
	obj.style.background=\'white\';
}


function q(){
	return confirm("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_alert_del']; ?>
<?php echo '");
}


function deleteField() {
	if (q()) {
		var tbody = doc.getElementById(\'tab1\').getElementsByTagName(\'TBODY\')[0];
		tbody.removeChild(tr_objects[pred_id]);
		pred_id=false;
		GetElementById(\'deleteButton\').disabled=true;
		if (beforeSubmit()) GetElementById(\'editForm\').submit();
	}
}


function MoveFieldRow(t) {
	alert(pred_id);
}


function createIdFirst() {
	addNewField();

	//selectByValue(\'edittype_id\'+counter, \'0\');
	GetElementById(\'sourse_field_id\'+counter).value=\'0\';
	GetElementById(\'delete\'+counter).value=\'0\';
	GetElementById(\'own_filter\'+counter).value=\'0\';
	
	img		= GetElementById(\'imgsettings\'+counter);
	edittype= GetElementById(\'edittype_id\'+counter).value;
	img.style.visibility=\'hidden\';
	GetElementById(\'sort_index\'+counter).value=\'\';
	GetElementById(\'field_id\'+counter).value=\'\';
	GetElementById(\'comment\'+counter).value=\'id\';
	GetElementById(\'fieldname\'+counter).value=\'id\';
	selectByValue(\'datatype_id\'+counter, \'7\');
	GetElementById(\'len\'+counter).value=\'11\';
	GetElementById(\'default\'+counter).value=\'\';	
	//selectByValue(\'collation_id\'+counter, \'0\');
	
	GetElementById(\'group_caption\'+counter).value=\'\';
	
	GetElementById(\'pk\'+counter).checked=true;
	GetElementById(\'not_null\'+counter).checked=true;
	GetElementById(\'unsigned\'+counter).checked=false;
	GetElementById(\'auto_incr\'+counter).checked=true;
	GetElementById(\'zerofill\'+counter).checked=false;
	GetElementById(\'unique\'+counter).checked=false;
	checkFields(counter);
	checkIncrenent(counter);
}
</script>
'; ?>



<form id="editForm" action="?act=t_c&do=<?php echo $this->_tpl_vars['do']; ?>
<?php if ($this->_tpl_vars['id']): ?>&t_id=<?php echo $this->_tpl_vars['id']; ?>
<?php endif; ?>" method="POST" style="margin:0px" onsubmit="return beforeSubmit()">
  <input id="id" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" type="hidden">
  <input id="counter" name="counter" value="<?php echo $this->_tpl_vars['counter']; ?>
" type="hidden">
  <?php if ($this->_tpl_vars['message']): ?>
  <p id="messagetext" style="margin-bottom:10px;color:Yellow"><?php echo $this->_tpl_vars['message']; ?>
</p>
  <script language="JavaScript">Morphing("messagetext", false)</script> 
  <?php endif; ?>
  
  <?php $_from = $this->_tpl_vars['editError']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
  <p style="color:yellow"><?php echo $this->_tpl_vars['item']; ?>
</p>
  <?php endforeach; endif; unset($_from); ?> </font>
  </p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td><table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td> <?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_name_table']; ?>
 <font color="Yellow">*</font><br>
                    <table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td><font color="Yellow"><?php echo ((is_array($_tmp=$this->_tpl_vars['CurrentModule']['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
_</td>
                        <td><input type="text" name="name" style="width:300px;" value="<?php echo $this->_tpl_vars['name']; ?>
"></td>
                      </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                  <td> <?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_description']; ?>
<font color="Yellow">*</font><br>
                    <input type="text" name="description" style="width:100%;" value="<?php echo $this->_tpl_vars['description']; ?>
"></td>
                </tr>
                <tr>
                  <td> <?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_additional_buttons']; ?>
<br>
                    <textarea type="text" name="additional_buttons" style="width:100%;height:30px"><?php echo $this->_tpl_vars['additional_buttons']; ?>
</textarea></td>
                </tr>                
                <tr>
                  <td><table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td><input name="show_type" type="checkbox" class="checkbox" value="1" <?php if ($this->_tpl_vars['show_type'] == 1): ?> checked <?php else: ?><?php if (! $this->_tpl_vars['name']): ?> checked <?php endif; ?><?php endif; ?>></td>
                        <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_show_type_table']; ?>
</td>
                      </tr>
                    </table>
                    <br></td>
                </tr>
                <tr>
                  <td><p style="margin-top:0px; margin-bottom:2px"><b><?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_fields_table']; ?>
</p>
                    <table width="100%" id='tab1' cellpadding="2" cellspacing="1" border="0" bgcolor="White">
                      <tbody>
                        <tr style="height:19px">
                          <td class="top_list" valign="top" width="4%">Sort</td>
                          <td class="top_list" valign="top" width="10%"><?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_edited']; ?>
</td>
                          <td class="top_list" valign="top" width="14%" nowrap><?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_desc_field']; ?>
</td>
                          <td class="top_list" valign="top" nowrap width="12%"><?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_name_field']; ?>
</td>
                          <td class="top_list" valign="top" width="11%" nowrap><?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_type_data']; ?>
</td>
                          <td class="top_list" valign="top" width="5%" nowrap><?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_long']; ?>
</td>
                          <td class="top_list" valign="top" width="6%">Default</td>
                          <!--
                          <td class="top_list" valign="top" width="14%" nowrap><?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_coding']; ?>
</td>
                          -->
                          <td class="top_list" valign="top" width="5%" nowrap><?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_group']; ?>
</td>
                          
                          <td class="top_list" valign="top" align="center" width="2%">PK</td>
                          <td class="top_list" valign="top" align="center" width="3%">NNull</td>
                          <td class="top_list" valign="top" align="center" width="3%">Un.</td>
                          <td class="top_list" valign="top" align="center" width="3%">Incr</td>
                          <td class="top_list" valign="top" align="center" width="3%">Zerro</td>
                          <td class="top_list" valign="top" align="center" width="3%">Uniq</td>
                          <!--
                          <td class="top_list" valign="top" align="center" width="2%" nowrap>!Fedit</td>
                          -->                           
                        </tr>
                      </tbody>
                    </table>
                    </td>
                </tr>
                <tr>
                  <td>
                  <table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td><input style="width:170px" value="<?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_del_field']; ?>
" id='deleteButton' disabled class="button" onclick="deleteField()" type="button"></td>
                        <td width="25px"></td>
                        <td><input style="width:130px" value="<?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_add_field']; ?>
" class="button" onclick="addNewField()" type="button"></td>
                        <td width="5px"></td>
                        <td><input style="width:130px" value="<?php echo $this->_tpl_vars['MSGTEXT']['tables_edit_save']; ?>
" class="button" type="submit" type="button"></td>
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
<?php if ($_GET['do'] == 'add'): ?>
createIdFirst();
<?php else: ?>
createFieldsFromList();
<?php endif; ?>
</script>