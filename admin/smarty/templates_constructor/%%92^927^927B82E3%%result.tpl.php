<?php /* Smarty version 2.6.26, created on 2014-09-14 10:34:09
         compiled from compiler/result.tpl */ ?>
<p style="margin-bottom:10px"><font color="Yellow"><?php $_from = $this->_tpl_vars['editError']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?><?php echo $this->_tpl_vars['item']; ?>
<?php endforeach; endif; unset($_from); ?></font></p>
<table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
  <tr>
    <td>
        <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0" style="width:100%">
            <tr>
                <td>
        <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td> <?php echo $this->_tpl_vars['MSGTEXT']['result_blocks']; ?>
: <font color="Yellow"><?php echo $this->_tpl_vars['statistics']['blocks_total']; ?>
</font><br>
            <?php echo $this->_tpl_vars['MSGTEXT']['result_tables']; ?>
: <font color="Yellow"><?php echo $this->_tpl_vars['statistics']['tables_total']; ?>
</font><br>
            <?php echo $this->_tpl_vars['MSGTEXT']['result_total_files']; ?>
: <font color="Yellow"><?php echo $this->_tpl_vars['statistics']['file_total']; ?>
</font><br>
            <?php echo $this->_tpl_vars['MSGTEXT']['result_time_compile']; ?>
: <font color="Yellow"><?php echo $this->_tpl_vars['statistics']['time']; ?>
 <?php echo $this->_tpl_vars['MSGTEXT']['result_time_compile_in_sec']; ?>
</font><br>
            <?php echo $this->_tpl_vars['MSGTEXT']['result_address_mod']; ?>
: <font color="Yellow"><b><?php echo $_SERVER['DOCUMENT_ROOT']; ?>
/modules/<?php echo $this->_tpl_vars['module_name']; ?>
</b></font></td>
        </tr>
      </table>
                </td>
            </tr>
        </table>
      </td>
  </tr>
</table>