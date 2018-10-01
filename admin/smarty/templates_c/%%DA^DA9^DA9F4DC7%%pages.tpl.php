<?php /* Smarty version 2.6.26, created on 2018-09-07 05:39:05
         compiled from pages.tpl */ ?>
<?php if ($this->_tpl_vars['pages']): ?> <br>
<table align="center" border="0" cellpadding="1" cellspacing="0">
  <tr>
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr>
          <td><?php echo $this->_tpl_vars['MSGTEXT']['pages_page']; ?>
:&nbsp;
            <?php $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            &nbsp;<a href="<?php echo $this->_tpl_vars['item']['url']; ?>
&page=<?php echo $this->_tpl_vars['item']['name']; ?>
" <?php if ($this->_tpl_vars['item']['selected'] == true): ?> class="sel_page_navigate" <?php endif; ?>><?php echo $this->_tpl_vars['item']['name']; ?>
</a>&nbsp;
            <?php endforeach; endif; unset($_from); ?> </td>
        </tr>
      </table></td>
  </tr>
</table>
<?php endif; ?>