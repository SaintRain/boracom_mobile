<?php /* Smarty version 2.6.26, created on 2018-09-07 07:09:30
         compiled from templates/templates_form_settings_edit.tpl */ ?>
<script language="JavaScript">
var el=new Array()
var el2=new Array()
var el3=new Array()
<?php $_from = $this->_tpl_vars['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>

<?php if ($this->_tpl_vars['list']['block_id']): ?>
el['<?php echo $this->_tpl_vars['list']['id']; ?>
']=<?php echo $this->_tpl_vars['list']['block_id']; ?>
;
<?php else: ?>
el['<?php echo $this->_tpl_vars['list']['id']; ?>
']=0;
<?php endif; ?>

<?php if ($this->_tpl_vars['list']['global']): ?>
el2['<?php echo $this->_tpl_vars['list']['id']; ?>
']=<?php echo $this->_tpl_vars['list']['global']; ?>
;
<?php else: ?>
el2['<?php echo $this->_tpl_vars['list']['id']; ?>
']=0;
<?php endif; ?>

<?php if ($this->_tpl_vars['list']['include_tpl_id']): ?>
el3['<?php echo $this->_tpl_vars['list']['id']; ?>
']=<?php echo $this->_tpl_vars['list']['include_tpl_id']; ?>
;
<?php else: ?>
el3['<?php echo $this->_tpl_vars['list']['id']; ?>
']=0;
<?php endif; ?>

<?php endforeach; endif; unset($_from); ?>
<?php echo '


function check_submit() {
	form=GetElementById(\'data form\');

	if (form.tag_id.selectedIndex==-1) {
		alert("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_no_select_tag']; ?>
<?php echo '");
		return false;
	}
	if (form.block_id.selectedIndex==-1) {
		alert("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_no_select_mod']; ?>
<?php echo '");
		return false;
	}

	return true;
}

function setRadioValue(val) {

	if (val) {
		GetElementById(\'tpl_include\').checked=true;
	}
	else {
		GetElementById(\'include_tpl_id\').options[0].selected=true;
	}
}

function checkBlockSelect(obj) {
	var tpls				= GetElementById(\'include_tpl_id\');

	if (tpls.options.selectedIndex>0) {
		obj.selectedIndex=0;
		alert("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_tpl_alert']; ?>
<?php echo '");
	}
}

function set_block(obj) {

	if (obj.selectedIndex>-1) {
		ind=obj.options[obj.selectedIndex].value;
		GetElementById(\'tagname\').value=obj.options[obj.selectedIndex].text;
		obj2=GetElementById(\'block_id\');
		sel=false;
		for (i=0; i<obj2.options.length; i++)
		if 	(obj2.options[i].value==el[ind]) {
			obj2.selectedIndex=i;
			sel=true;
			break;
		}
		if (sel==false) obj2.selectedIndex=0;
		set_name(obj);
	}

}




function check_set_name() {
	obj=GetElementById(\'tag_id\');
	if (obj.selectedIndex>-1) set_name(obj);
}


function set_name(obj) {
	sindex=obj.options[obj.selectedIndex].value;

	if (el2[sindex]==1)	 k=1;
	else
	if (el2[sindex]==2)	 k=2;

	else k=0;

	gl=GetElementById(\'global_\'+k);
	gl.checked=true;

	var tpls				= GetElementById(\'include_tpl_id\');
	var selected_tpl_index	= 0;
	for (i=0;i<tpls.options.length; i++) {
		if (tpls.options[i].value==el3[sindex]) {
			selected_tpl_index=i;
			break;
		}
	}


	tpls.options[selected_tpl_index].selected=true;
	if (selected_tpl_index>0) {
		var obj2=GetElementById(\'block_id\');
		obj2.selectedIndex=0;
		gl=GetElementById(\'tpl_include\');
		gl.checked=true;
	}

}


function setOtnoshenie() {
	if (check_submit()) {
		GetElementById(\'data form\').submit();
	}
}
</script>
'; ?>


<?php $_from = $this->_tpl_vars['errorMsgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
<p style="color:yellow"><?php echo $this->_tpl_vars['error']; ?>
</p>
<?php endforeach; endif; unset($_from); ?>

<form name='dataform' id="data form"  action="?act=templates&do=settings_save_edit<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?>" method="POST" style="margin:0px" onsubmit="return check_submit()">
  <input name="templates_id" id="templates_id" type="hidden" value="<?php echo $this->_tpl_vars['templates_id']; ?>
">
  <input name="tagname" id="tagname" type="hidden" value="<?php echo $this->_tpl_vars['tagname']; ?>
">
  <input name="page_id" id="page_id" type="hidden" value="<?php echo $_GET['page_id']; ?>
">
  <?php if ($this->_tpl_vars['message']): ?>
  <p style="margin-bottom:10px"><font id="messagetext" color="yellow"><?php echo $this->_tpl_vars['message']; ?>
</font></p>
  <script language="JavaScript">Morphing("messagetext", false)</script> 
  <?php endif; ?>
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr>
      <td>
 <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td>      
      <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td rowspan="2" style="width:10px"></td>
            <td width="40%" align="left" valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_tag_in_tpl']; ?>
 <b>«<?php echo $this->_tpl_vars['tamplate_name']; ?>
»</b></td>
            <td width="60%" valign="top"> <?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_plug_block']; ?>
 </td>
          </tr>
          <tr>
            <td>
              <select onchange="set_block(this)" name="tag_id" id="tag_id" style="width:100%; height:450px;" size="30">                
				<?php $_from = $this->_tpl_vars['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <option <?php if ($this->_tpl_vars['sel1']): ?> <?php if ($this->_tpl_vars['sel1'] == $this->_tpl_vars['list']['id']): ?> selected <?php $this->assign('global', $this->_tpl_vars['list']['global']); ?> <?php endif; ?> <?php endif; ?> 
				 <?php if ($this->_tpl_vars['list']['block_id'] == '' || $this->_tpl_vars['list']['block_id'] == 0 || $this->_tpl_vars['list']['include_tpl_id'] > 0): ?>  style="color:gray;"   <?php else: ?> <?php if ($this->_tpl_vars['list']['global'] == 1): ?> style="color:blue;" <?php else: ?> <?php if ($this->_tpl_vars['list']['global'] == 2): ?> style="color:maroon"<?php endif; ?><?php endif; ?>
				<?php endif; ?> value="<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php unset($this->_sections['tags']);
$this->_sections['tags']['name'] = 'tags';
$this->_sections['tags']['loop'] = is_array($_loop=$this->_tpl_vars['list']['deep']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tags']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['tags']['show'] = true;
$this->_sections['tags']['max'] = $this->_sections['tags']['loop'];
$this->_sections['tags']['start'] = $this->_sections['tags']['step'] > 0 ? 0 : $this->_sections['tags']['loop']-1;
if ($this->_sections['tags']['show']) {
    $this->_sections['tags']['total'] = min(ceil(($this->_sections['tags']['step'] > 0 ? $this->_sections['tags']['loop'] - $this->_sections['tags']['start'] : $this->_sections['tags']['start']+1)/abs($this->_sections['tags']['step'])), $this->_sections['tags']['max']);
    if ($this->_sections['tags']['total'] == 0)
        $this->_sections['tags']['show'] = false;
} else
    $this->_sections['tags']['total'] = 0;
if ($this->_sections['tags']['show']):

            for ($this->_sections['tags']['index'] = $this->_sections['tags']['start'], $this->_sections['tags']['iteration'] = 1;
                 $this->_sections['tags']['iteration'] <= $this->_sections['tags']['total'];
                 $this->_sections['tags']['index'] += $this->_sections['tags']['step'], $this->_sections['tags']['iteration']++):
$this->_sections['tags']['rownum'] = $this->_sections['tags']['iteration'];
$this->_sections['tags']['index_prev'] = $this->_sections['tags']['index'] - $this->_sections['tags']['step'];
$this->_sections['tags']['index_next'] = $this->_sections['tags']['index'] + $this->_sections['tags']['step'];
$this->_sections['tags']['first']      = ($this->_sections['tags']['iteration'] == 1);
$this->_sections['tags']['last']       = ($this->_sections['tags']['iteration'] == $this->_sections['tags']['total']);
?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endfor; endif; ?><?php echo $this->_tpl_vars['list']['virtualtagname']; ?>
<?php if ($this->_tpl_vars['list']['include_tpl_id'] > 0): ?> &darr;<?php endif; ?>
                <?php if (( $this->_tpl_vars['list']['block_id'] == '' || $this->_tpl_vars['list']['block_id'] == 0 ) && $this->_tpl_vars['list']['include_tpl_id'] == 0): ?> <?php if ($this->_tpl_vars['list']['global'] == 1): ?>&larr; <?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_glob']; ?>
<?php else: ?> <?php if ($this->_tpl_vars['list']['global'] == 2): ?>&larr; <?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_sglob']; ?>
<?php endif; ?><?php endif; ?><?php endif; ?><?php endforeach; endif; unset($_from); ?>
              </select>
              </td>
            <td><select onChange="checkBlockSelect(this)" name="block_id" id="block_id" style="width:100%;height:450px" size="30">
                <option <?php if ($this->_tpl_vars['sel2'] == '0'): ?> selected <?php endif; ?> style='color:gray;' value="0"><?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_no_block']; ?>

                <?php $_from = $this->_tpl_vars['blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <option <?php if ($this->_tpl_vars['sel2'] == $this->_tpl_vars['list']['block_id']): ?> selected <?php endif; ?> <?php if ($this->_tpl_vars['list']['type'] != 1): ?> style="color:maroon" <?php endif; ?> value="<?php echo $this->_tpl_vars['list']['block_id']; ?>
">
                <?php if ($this->_tpl_vars['list']['module_description'] != ''): ?> <?php echo $this->_tpl_vars['list']['module_description']; ?>

                <?php else: ?>
               		<?php echo $this->_tpl_vars['list']['module_name']; ?>

                <?php endif; ?>
                &rarr; 
                <?php if ($this->_tpl_vars['list']['block_description'] != ''): ?> <?php echo $this->_tpl_vars['list']['block_description']; ?>

                <?php else: ?>
                	<?php echo $this->_tpl_vars['list']['block_name']; ?>

                <?php endif; ?> <br>
                <?php endforeach; endif; unset($_from); ?>
              </select>
              </td>
          </tr>
          <tr>
            <td></td>
            <td nowrap valign="top">
              <p style="margin:5px">              
              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                <td><?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_this_tag_is']; ?>
</td>
                  <td><input onChange="setRadioValue(false)" type="radio" style="margin-top:0px" name="global" id="global_0"  value="0" <?php if ($this->_tpl_vars['global'] == 0): ?>checked<?php endif; ?>></td>
                  <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_simple']; ?>
</td>
                  <td width="10px"></td>
                  <td><input onChange="setRadioValue(false)" type="radio" style="margin-top:0px" name="global" id="global_1"   value="1" <?php if ($this->_tpl_vars['global'] == 1): ?>checked<?php endif; ?>></td>
                  <td>&nbsp;<font color="blue"><?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_global']; ?>
</font></td>
                  <td width="10px"></td>
                  <td><input onChange="setRadioValue(false)" type="radio" style="margin-top:0px" name="global" id="global_2"   value="2" <?php if ($this->_tpl_vars['global'] == 2): ?>checked<?php endif; ?>></td>
                  <td>&nbsp;<font color="Maroon"><?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_superglobal']; ?>
</font></td>
                      <tr>            
              </table>
              </p>
              <p style="margin-top:20px">
              <input class="button" type="Submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_save']; ?>
" style="width:130px" >
              </p>
              </td>
              <td valign="top">
                <?php if ($this->_tpl_vars['all_tpls']): ?>
                <table border="0" style="margin-top:5px" cellpadding="0" cellspacing="0">
                	<tr>
                	<td  valign="middle">                
	                	<input type="radio" style="margin-top:0px" name="global" id="tpl_include" value="0">&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_include_tpl']; ?>
&nbsp;               
                	</td>
                	<td >
	                	<select onChange="setRadioValue(true)" name="include_tpl_id" id="include_tpl_id" style="width:100%">
	                	<option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['templates_form_settings_not_set']; ?>
</option>
    	            	<?php $_from = $this->_tpl_vars['all_tpls']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tpl']):
?>
        	        		<option value="<?php echo $this->_tpl_vars['tpl']['id']; ?>
"><?php echo $this->_tpl_vars['tpl']['description']; ?>
</option>
	            	    <?php endforeach; endif; unset($_from); ?>
    	            	</select>
        	        </td>
        	        </tr>
        	         </table>
                <?php endif; ?>    
                                      
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
<script>
check_set_name();
</script>