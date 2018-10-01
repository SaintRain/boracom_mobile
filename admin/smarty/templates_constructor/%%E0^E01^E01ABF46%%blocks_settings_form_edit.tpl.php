<?php /* Smarty version 2.6.26, created on 2018-09-07 07:11:46
         compiled from blocks_settings/blocks_settings_form_edit.tpl */ ?>

<?php echo '
<script language="JavaScript">
var doc = document;
var pred_id;
var name;
var initials;
var posada;
var counter=-1;
var tr_objects=new Array();


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
	var symbol	= String.fromCharCode(31);
	var reg	= new RegExp("(" + symbol + ")", "g");

	'; ?>

	<?php $_from = $this->_tpl_vars['settings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
	addNewField();
	GetElementById('id_'+counter).value='<?php echo $this->_tpl_vars['field']['id']; ?>
';
	GetElementById('name_'+counter).value='<?php echo $this->_tpl_vars['field']['name']; ?>
';
	descr='<?php echo $this->_tpl_vars['field']['value']; ?>
';
	descr2='<?php echo $this->_tpl_vars['field']['description']; ?>
';
	GetElementById('value_'+counter).value=descr.replace(reg, "\r");
	GetElementById('description_'+counter).value=descr2.replace(reg, "\r");
	GetElementById('loaded_name_'+counter).value='<?php echo $this->_tpl_vars['field']['loaded_name']; ?>
';
	selectByValue('edit_s_type_id_'+counter, '<?php echo $this->_tpl_vars['field']['edit_s_type_id']; ?>
');
	selectByValue('block_id_'+counter, '<?php echo $this->_tpl_vars['field']['block_id']; ?>
');
	<?php endforeach; endif; unset($_from); ?>
	<?php echo '
}


function beforeSubmit() {
	form	= GetElementById(\'editForm\');
	for (var i = 0; i < form.elements.length; i++) {
		form.elements[i].disabled=false;
	}

	if (counter!=-1) GetElementById(\'counter\').value=counter;
	return true;
}


function edittypeList() {
	'; ?>

	edittype_text='<select onfocus="setcolor(\'newRow'+counter+'\');" name="edit_s_type_id_'+counter+'" id="edit_s_type_id_'+counter+'" style="width:100px"><?php $_from = $this->_tpl_vars['edit_s_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['edit_s_type']):
?><option value="<?php echo $this->_tpl_vars['edit_s_type']['id']; ?>
"><?php echo $this->_tpl_vars['edit_s_type']['name']; ?>
</option><?php endforeach; endif; unset($_from); ?></select>';
	return edittype_text;
	<?php echo '
}

function blockList() {
	'; ?>

	blockList_text='<select onfocus="setcolor(\'newRow'+counter+'\');" name="block_id_'+counter+'" id="block_id_'+counter+'" style="width:100%"><?php $_from = $this->_tpl_vars['blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?><option value="<?php echo $this->_tpl_vars['block']['id']; ?>
"><?php echo $this->_tpl_vars['block']['description']; ?>
</option><?php endforeach; endif; unset($_from); ?></select>';
	return blockList_text;
	<?php echo '
}

function addNewField() {
	counter++;

	// Находим нужную таблицу
	var tbody = doc.getElementById(\'tab1\').getElementsByTagName(\'TBODY\')[0];

	// Создаем строку таблицы и добавляем ее
	var row = doc.createElement("TR");
	row.id=\'newRow\'+counter;
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

	'; ?>

	edittype_text	= edittypeList();
	block_list		= blockList();
	<?php echo '	
	
	// Наполняем ячейки
	td00.innerHTML =\'<input type="hidden" name="loaded_name_\'+counter+\'" id="loaded_name_\'+counter+\'" value=""><input type="hidden" name="id_\'+counter+\'" id="id_\'+counter+\'" value=""><input type="text" class="field_name" onfocus="setcolor(\\\'newRow\'+counter+\'\\\');" style="width:150px" name="name_\'+counter+\'" id="name_\'+counter+\'"	value="">\';
	td00.vAlign=\'top\';
	td0.innerHTML =\'<textarea onfocus="setcolor(\\\'newRow\'+counter+\'\\\')" style="width:250px;height:100px" name="value_\'+counter+\'" id="value_\'+counter+\'"></textarea>\';
	td0.valign=\'top\';
	td1.innerHTML =\'<textarea onfocus="setcolor(\\\'newRow\'+counter+\'\\\');" style="width:250px; height:100px" name="description_\'+counter+\'" id="description_\'+counter+\'"></textarea>\';
	td1.vAlign=\'top\';
	td2.innerHTML =edittype_text;
	td2.vAlign=\'top\';	
	td3.innerHTML =block_list;
	td3.vAlign=\'top\';			                          
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
<?php echo $this->_tpl_vars['MSGTEXT']['blocks_settings_del_mess']; ?>
<?php echo '");
}


function deleteField() {
	if (q()) {
		var tbody = doc.getElementById(\'tab1\').getElementsByTagName(\'TBODY\')[0];
		tbody.removeChild(tr_objects[pred_id]);
		pred_id=false;
		GetElementById(\'deleteButton\').disabled=true;
		GetElementById(\'editForm\').submit();
	}
}
</script>
'; ?>



<form id="editForm" action="?act=b_s_c&do=saveedit" method="POST" style="margin:0px" onsubmit="return beforeSubmit()">
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
  <?php echo $this->_tpl_vars['item']; ?>
<br>
  <?php endforeach; endif; unset($_from); ?> </font>
  </p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td>
            <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td><p style="margin-top:0px; margin-bottom:2px"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_settings_settings']; ?>
</p>
                    <table width="100%" id="tab1" cellpadding="2" cellspacing="1" border="0" bgcolor="White">
                      <tbody>
                        <tr style="height:19px">
                          <td class="top_list" style="width:150px" valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_settings_name_setting']; ?>
</td>
                          <td class="top_list" style="width:250px" nowrap><?php echo $this->_tpl_vars['MSGTEXT']['blocks_settings_value']; ?>
</td>
                          <td class="top_list" style="width:250px"><?php echo $this->_tpl_vars['MSGTEXT']['blocks_settings_description']; ?>
</td>
                          <td class="top_list" nowrap><?php echo $this->_tpl_vars['MSGTEXT']['blocks_settings_type']; ?>
</td>
                          <td class="top_list" nowrap><?php echo $this->_tpl_vars['MSGTEXT']['blocks_settings_block_name']; ?>
</td>
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
                        <td><input style="width:150px" value="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_settings_remove_field']; ?>
" id='deleteButton' disabled class="button" onclick="deleteField()" type="button"></td>
                        <td width="5px"></td>
                        <td><input style="width:150px" value="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_settings_add_field']; ?>
" class="button" onclick="addNewField()" type="button"></td>
                        <td width="5px"></td>
                        <td><input style="width:150px" value="<?php echo $this->_tpl_vars['MSGTEXT']['blocks_settings_save']; ?>
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
createFieldsFromList();
</script>