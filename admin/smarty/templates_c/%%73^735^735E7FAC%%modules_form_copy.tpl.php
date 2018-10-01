<?php /* Smarty version 2.6.26, created on 2014-09-14 09:29:41
         compiled from modules/modules_form_copy.tpl */ ?>
<?php echo '
<script language="JavaScript">
function Mysubmit(form) {
	s=form.new_name.value;
	if (s==\'\') {
		'; ?>

		form.new_name.focus(); alert("<?php echo $this->_tpl_vars['MSGTEXT']['p_set_m_copy_name']; ?>
"); return false
		<?php echo '
	};
	return true;
}
</script>
'; ?>


<p style="margin-top:10px;margin-bottom:10px">
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><a <?php if ($_GET['do'] == 'form_import'): ?> style="font-weight:bold" <?php endif; ?> href="?act=modules&do=form_import"><?php echo $this->_tpl_vars['MSGTEXT']['import_module']; ?>
</a> &rarr; </td>
    <td width="20px"></td>
    <td><a <?php if ($_GET['do'] == 'copy_module_form'): ?> style="font-weight:bold" <?php endif; ?> href="?act=modules&do=copy_module_form"><?php echo $this->_tpl_vars['MSGTEXT']['create_copy_of_module']; ?>
</a> &rarr;</td>
  </tr>
</table>
</p>
<?php $_from = $this->_tpl_vars['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<p style="margin-top:10px; color:yellow"><?php echo $this->_tpl_vars['item']; ?>
</p>
<?php endforeach; endif; unset($_from); ?>
<form id="data form" action="?act=modules&do=copy_module" method="POST" onsubmit="return Mysubmit(this)" style="margin:0px">
  <p style="margin-bottom:10px"><font color="Yellow"><?php if ($this->_tpl_vars['import_result']): ?><?php echo $this->_tpl_vars['import_result']; ?>
<br><?php endif; ?><?php echo $this->_tpl_vars['message']; ?>
</font></p>
  
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
          <table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
              <tr>
                  <td>
          <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td><?php echo $this->_tpl_vars['MSGTEXT']['select_copied_module']; ?>
:
              <select name="copy_module" style="width:100%;" size="1">                
				<?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                <option <?php if ($this->_tpl_vars['copy_module'] == $this->_tpl_vars['list']['filename']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['list']['filename']; ?>
"><?php echo $this->_tpl_vars['list']['filename']; ?>
<?php if ($this->_tpl_vars['list']['version']): ?> v.<?php echo $this->_tpl_vars['list']['version']; ?>
<?php endif; ?></option>                
				<?php endforeach; endif; unset($_from); ?>
              </select>
              <br><br>
              <table cellpadding="0" cellspacing="0" border="0">
  				<tr>
  					<td><input name="import" <?php if ($_POST['import']): ?>checked<?php endif; ?> type="checkbox" class="checkbox" value="1"></td>
  					<td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['to_copy_now']; ?>
</td>
  				</tr>	
  			  </table>
              <p style="margin-top:10px"><?php echo $this->_tpl_vars['MSGTEXT']['name_of_m_copy']; ?>
:<font color="Yellow">*</font><br>
                <input type="text" name="new_name" style="width:100%" value="<?php echo $this->_tpl_vars['new_name']; ?>
">
            </td>
          </tr>
          <tr>
            <td><input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['copy']; ?>
" style="width:130px"></td>
          </tr>
        </table>
                  </td>
              </tr>
          </table>
        </td>
    </tr>
  </table>
</form>