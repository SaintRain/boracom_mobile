<?php /* Smarty version 2.6.26, created on 2014-09-14 09:30:00
         compiled from modules_forms/modules_import_work_module.tpl */ ?>
<?php if ($this->_tpl_vars['modules']): ?>
<form action="?act=m_c&do=import_work_module_do" method="POST" style="margin:0">
  <p style="margin-bottom:10px"><font color="Yellow"><?php echo $this->_tpl_vars['message']; ?>
</font></p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td>
            <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td><p style="margin-bottom:10px"><?php echo $this->_tpl_vars['MSGTEXT']['modules_import_selected']; ?>
</p>
                    <select name="module_id" style="width:700px">                      
					<?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>
                      <option value="<?php echo $this->_tpl_vars['module']['id']; ?>
"> <?php echo $this->_tpl_vars['module']['name']; ?>
 <?php if ($this->_tpl_vars['module']['description']): ?> - <?php echo $this->_tpl_vars['module']['description']; ?>
<?php endif; ?>
                      <?php endforeach; endif; unset($_from); ?>
                    </select></td>
                </tr>
                <tr>
                  <td height="10px"></td>
                </tr>
                <tr>
                  <td><input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['modules_import_loaded']; ?>
" style="width:130px"></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php else: ?>
	<?php echo $this->_tpl_vars['MSGTEXT']['modules_import_empty']; ?>

<?php endif; ?>