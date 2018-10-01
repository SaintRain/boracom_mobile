<?php /* Smarty version 2.6.26, created on 2018-09-28 06:40:00
         compiled from pages/pages_category_form.tpl */ ?>
<?php echo '
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


function delete_cat(action){
	if (confirm("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['pages_category_form_del_mes']; ?>
<?php echo '")) {
		set_action(action)
	}
}


function set_action(action) {
	f=GetElementById(\'data form\');
	f.action=action;
	f.submit();
}


function set_value(sel) {
	if (sel.options[sel.selectedIndex].value>0) {

		GetElementById(\'butedit_category\').disabled=false;
		GetElementById(\'butdelete_category\').disabled=false;
		GetElementById(\'butput_category\').disabled=false;
		txt=sel.options[sel.selectedIndex].text;

		var buf="";
		flag=false;
		for (i=0; i<txt.length; i++) {
			if (flag==false) {
				if (txt.charCodeAt(i)!=160) {
					flag=true;
				}
			}
			if (flag) {
				buf=buf+txt.charAt(i);
			}
		}

		GetElementById(\'name_category\').value=buf;
	}
	else {
		GetElementById(\'butedit_category\').disabled=true;
		GetElementById(\'butdelete_category\').disabled=true;
		GetElementById(\'butput_category\').disabled=true;

		GetElementById(\'name_category\').value=\'\';
	}
}


function moveUp() {
	sel=GetElementById(\'pageCategory\');
	if (sel.selectedIndex>0) {
		id=sel.options[sel.selectedIndex].value;
		location.href="?act=pages&do=moveCategory&type=up&id="+id;
	}
}


function moveDown() {
	sel=GetElementById(\'pageCategory\');
	if (sel.selectedIndex<sel.options.length-1) {
		id=sel.options[sel.selectedIndex].value;
		location.href="?act=pages&do=moveCategory&type=down&id="+id;
	}
}
'; ?>
<?php if ($this->_tpl_vars['refreshFrame']): ?> reloadLeftFrame(); <?php endif; ?>
</script>

<form id="data form" name="data" action="?act=pages&do=category_create" method="POST" style="margin:0">
  <p style="margin-bottom:10px"><font color="yellow"><?php echo $this->_tpl_vars['message']; ?>
</font></p>
  <table style="width:100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
	<table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
	<tr>
	<td>           
      <table style="width:100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td></td>
            <td valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['pages_category_form_cat']; ?>
 </td>
          </tr>
          <tr>
            <td style="width:10px"><img vspace="5" style="cursor:pointer" onclick="javascript: moveUp()" src="images/icons/moveUp.gif" border=0 alt="<?php echo $this->_tpl_vars['MSGTEXT']['pages_category_form_up']; ?>
"><br>
              <img vspace="5" style="cursor:pointer" onclick="javascript: moveDown();" src="images/icons/moveDown.gif" border=0 alt="<?php echo $this->_tpl_vars['MSGTEXT']['pages_category_form_down']; ?>
"></td>
            <td style="width:100%"><select name="pageCategory" onChange="set_value(this)" id="pageCategory" style="width:100%;height:300px" size="20">
                <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['pages_category_form_par']; ?>

                <?php if ($this->_tpl_vars['pageCategories']): ?>
                <?php $_from = $this->_tpl_vars['pageCategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <option value="<?php echo $this->_tpl_vars['list']['id']; ?>
" <?php if ($this->_tpl_vars['catSelected'] == $this->_tpl_vars['list']['id']): ?> selected <?php endif; ?>> <?php unset($this->_sections['foo']);
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
            <td colspan="2" valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['pages_category_form_name_cat']; ?>
<br>
              <input type="text" style="width:100%" name="name" id="name_category" value="<?php echo $this->_tpl_vars['catName']; ?>
"></td>
          </tr>
          <tr>
            <td colspan="2"><input type="button" class="button" onclick="javascript: set_action('?act=pages&do=category_create');" value="<?php echo $this->_tpl_vars['MSGTEXT']['pages_category_form_create']; ?>
" style="width:120px">
              <input <?php if (! $this->_tpl_vars['catSelected']): ?>disabled<?php endif; ?> id="butedit_category" name="butedit" type="button" class="button" onclick="javascript: set_action('?act=pages&do=category_update');" value="<?php echo $this->_tpl_vars['MSGTEXT']['pages_category_form_save']; ?>
" style="width:120px;">
              <input <?php if (! $this->_tpl_vars['catSelected']): ?>disabled<?php endif; ?> id="butdelete_category" name="butdelete" type="button" class="button" onclick="javascript: delete_cat('?act=pages&do=category_delete');" value="<?php echo $this->_tpl_vars['MSGTEXT']['pages_category_form_del']; ?>
" style="width:120px;">
              <input <?php if (! $this->_tpl_vars['catSelected']): ?>disabled<?php endif; ?> id="butput_category" name="butput" type="button" class="button" onclick="javascript: set_action('?act=pages&do=category_put');" value="<?php echo $this->_tpl_vars['MSGTEXT']['pages_category_form_move']; ?>
" style="width:120px;"></td>
          </tr>
        </table>
        </td>
  	  </tr>
  	</table>
      </td>
    </tr>
  </table>  
</form>