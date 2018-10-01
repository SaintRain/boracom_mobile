<?php /* Smarty version 2.6.26, created on 2014-09-14 10:34:00
         compiled from compiler/compiler_form.tpl */ ?>
<?php echo '
<script language="JavaScript">
function checkBut(obj) {
	obj2=GetElementById(\'submit_button\');
	if (obj.checked) obj2.disabled=false;
	else obj2.disabled=true;
}
</script>
'; ?>


<form action="?act=compiler&do=compile&m_id=<?php echo $this->_tpl_vars['m_id']; ?>
" method="POST" style="margin:0px" >
  <input name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" type="hidden">
  <input name="general" id="general" type="hidden" value="<?php echo $this->_tpl_vars['general']; ?>
">
  <p style="margin-bottom:10px"><font color="Yellow"><?php $_from = $this->_tpl_vars['editError']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?><?php echo $this->_tpl_vars['item']; ?>
<br>
    <br>
    <?php endforeach; endif; unset($_from); ?></font></p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0" style="width:100%">
          <tr>
            <td>
            <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td><b><?php echo $this->_tpl_vars['MSGTEXT']['compiler_form_settings']; ?>
</b><br>
              <br>
              <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td><input type="checkbox" value="1" name="drop_tables"></td>
                  <td>&nbsp; <?php echo $this->_tpl_vars['MSGTEXT']['compiler_form_include']; ?>
</td>
                </tr>
              </table>
              </td>
          </tr>
          <?php if ($this->_tpl_vars['perezapisat'] == 1): ?>
          <tr>
            <td><table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td><input type="checkbox" value="1" onclick="checkBut(this)" name="perezapisat"></td>
                  <td>&nbsp; <?php echo $this->_tpl_vars['MSGTEXT']['compiler_perezapisat']; ?>
</td>
                </tr>
              </table>
              </td>
          </tr>
          <?php endif; ?>
          <tr>
            <td height="10px"></td>
          </tr>
          <tr>
            <td colspan="100%"><input <?php if ($this->_tpl_vars['editError']): ?>disabled<?php endif; ?> class="button" id="submit_button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['compiler_form_compile']; ?>
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