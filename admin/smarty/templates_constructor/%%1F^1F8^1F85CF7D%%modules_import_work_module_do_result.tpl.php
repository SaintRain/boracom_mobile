<?php /* Smarty version 2.6.26, created on 2014-09-14 09:30:02
         compiled from modules_forms/modules_import_work_module_do_result.tpl */ ?>
<?php echo '
<script language="JavaScript">
'; ?>
<?php if ($this->_tpl_vars['refreshFrame'] || $_GET['refreshFrame']): ?> reloadLeftFrame(); <?php endif; ?><?php echo '
</script>
'; ?>


<table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
  <tr>
    <td><table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
        <tr>
          <td><table height="100" width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
              <tr>
                <td align="center" valign="middle"><font color="Yellow"><?php echo $this->_tpl_vars['MSGTEXT']['modules_import_res_mod']; ?>
 <b><?php echo $this->_tpl_vars['m']['name']; ?>
</b> <?php echo $this->_tpl_vars['MSGTEXT']['modules_import_res_successfully_load']; ?>
</font></td>
              </tr>
              <tr>
                <td height="10px"></td>
              </tr>
            </table>
            </td>
        </tr>
      </table>
      </td>
  </tr>
</table>