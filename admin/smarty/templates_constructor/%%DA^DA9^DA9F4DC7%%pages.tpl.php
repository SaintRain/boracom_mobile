<?php /* Smarty version 2.6.26, created on 2014-09-14 09:29:57
         compiled from pages.tpl */ ?>
<br>
<table align="center" border="0" cellpadding="1" cellspacing="0">
  <tr>
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr>
          <td> <?php $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            &nbsp;<a href="<?php echo $this->_tpl_vars['item']['url']; ?>
&page=<?php echo $this->_tpl_vars['item']['name']; ?>
"><?php if ($this->_tpl_vars['item']['selected'] == true): ?><b><?php echo $this->_tpl_vars['item']['name']; ?>
</b><?php else: ?><?php echo $this->_tpl_vars['item']['name']; ?>
<?php endif; ?></a>&nbsp;
            <?php endforeach; endif; unset($_from); ?>
            </td>
        </tr>
      </table>
      </td>
  </tr>
</table>