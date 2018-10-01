<?php /* Smarty version 2.6.26, created on 2018-09-14 07:26:56
         compiled from pages/pages_form_add.tpl */ ?>
<?php echo '
<script type="text/javascript" src="js/translit.js"></script>
<script language="JavaScript">
function Mysubmit(form) {
	s=form.name.value;
	if (s==\'\') {
		form.name.focus(); alert("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['pages_add_mess_err_name']; ?>
<?php echo '"); return false
	};
	return true;
}

function set_status_for_checkbox(manager) {
	el=GetElementById(\'disable_cache_if_get\');
	if (manager.checked) {
		el.disabled=false;
	}
	else {
		el.disabled=true;
	}
}

var check_translite	= true;


function set_status_for_translite_name(translite) {
	if (translite.checked) {
		check_translite=true;
		transliteMe(GetElementById(\'description\').value);
	}
	else {
		check_translite=false;
		GetElementById(\'transVal\').value = "'; ?>
<?php echo $this->_tpl_vars['name']; ?>
<?php echo '" ;
	}
}


function checkTotransliteMe(val) {
	if (check_translite) {
		newStr=transliteMe(val);
		GetElementById(\'transVal\').value = newStr;
	}
}
</script>
'; ?>


<form id="data form" action="?act=pages&do=insert" method="POST" onsubmit="return Mysubmit(this)" style="margin:0">
  <input name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" type="hidden">
  <p style="margin-bottom:10px"><font color="yellow"><?php echo $this->_tpl_vars['message']; ?>
</font></p>
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr><td>
    <table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
	<tr>
	<td>  
      <table class="formbackground" width="100%" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['pages_add_description']; ?>
</td>
          <td><table cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td width="100%"><input type="text" id="description" name="description" style="width:100%" value="<?php echo $this->_tpl_vars['description']; ?>
" onkeyup="javascript:checkTotransliteMe(this.value)"></td>
                <td>&nbsp;&nbsp;</td>
                <td nowrap><table border="0" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td><input value="1" type="checkbox" id="setTranslit" onclick="javascript:set_status_for_translite_name(this)" checked></td>
                      <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['pages_add_translit_mess']; ?>
</td>
                    </tr>
                  </table>
                  </td>
              </tr>
            </table>
            </td>
        </tr>
        <tr>
          <td width="100"><?php echo $this->_tpl_vars['MSGTEXT']['pages_add_name_page']; ?>
 <font color="yellow">*</font></td>
          <td><input type="text" style="width:100%" name="name" value="<?php echo $this->_tpl_vars['name']; ?>
" id="transVal"></td>
        </tr>
        <tr>
          <td><?php echo $this->_tpl_vars['MSGTEXT']['pages_add_tamplate']; ?>
 <font color="yellow">*</font></td>
          <td><select name="templates_id" style="width:100%">
              <option style="color:gray" value="0" ><?php echo $this->_tpl_vars['MSGTEXT']['pages_add_no_tamplate']; ?>

              <?php $_from = $this->_tpl_vars['templates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
              <option value="<?php echo $this->_tpl_vars['list']['id']; ?>
" <?php if ($this->_tpl_vars['list']['id'] == $this->_tpl_vars['templates_id']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['list']['tpl_name']; ?>
 &rarr; <?php echo $this->_tpl_vars['list']['name']; ?>

              <?php endforeach; endif; unset($_from); ?>
            </select>
            </td>
        </tr>
        <tr>
          <td><?php echo $this->_tpl_vars['MSGTEXT']['pages_add_category']; ?>
 </td>
          </td>        
          <td><select name="page_category" id="page_category" style="width:100%" >
              <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['pages_add_no_parent']; ?>

              <?php if ($this->_tpl_vars['pageCategories']): ?>
              <?php $_from = $this->_tpl_vars['pageCategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
              <option value="<?php echo $this->_tpl_vars['list']['id']; ?>
" <?php if ($this->_tpl_vars['page_category'] == $this->_tpl_vars['list']['id']): ?> selected <?php endif; ?>> <?php unset($this->_sections['foo']);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['start'] = (int)0;
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['list']['deep']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endfor; endif; ?><?php echo $this->_tpl_vars['list']['name']; ?>

              <?php endforeach; endif; unset($_from); ?>
              <?php endif; ?>
            </select>
            </td>
        </tr>
        <tr>
          <td></td>
          <td><table border="0" cellpadding="0" cellspacing="0" >
              <tr>
                <td><input value="1" type="checkbox" class="checkbox" checked name="enable" id="enable"></td>
                <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['pages_edit_publish']; ?>
</td>
                <td width="15px"></td>
                <td><input value="1" type="checkbox" onclick="javascript:set_status_for_checkbox(this)" name="cache" id="cache"></td>
                <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['pages_edit_cached']; ?>
</td>
                <td width="15px"></td>
                <td><input value="1" type="checkbox" disabled checked name="disable_cache_if_get" id="disable_cache_if_get"></td>
                <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['pages_edit_mess_cache']; ?>
</td>
                <td width="15px"></td>
                <td><input value="1" type="checkbox" name="selected" id="selected"></td>
                <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['pages_edit_page_marked']; ?>
</td>
              </tr>
            </table>
            </td>
        </tr>
        <tr>
          <td colspan="100%" height="10px"></td>
        </tr>
        <tr>
          <td></td>
          <td><input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['pages_add_create']; ?>
" style="width:120px;margin-right:5px">
            &nbsp;&nbsp;
            <input class="button" type="button" onclick="javascript:window.history.back()" value="<?php echo $this->_tpl_vars['MSGTEXT']['pages_add_cancel']; ?>
" style="width:120px"></td>
        </tr>
      </table>
        </td>
    </tr>
  </table>
      </td>
    </tr>
  </table>  
  
</form>