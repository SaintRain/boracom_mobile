<?php /* Smarty version 2.6.26, created on 2014-09-14 11:07:00
         compiled from E:/Zend/Apache2/htdocs/honda/modules/Contacts/performance/ShowFormTemplates/MessageFormat.tpl */ ?>
<?php $_from = $this->_tpl_vars['msgFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<div>
  <?php echo $this->_tpl_vars['item']['caption']; ?>
  <?php echo $this->_tpl_vars['item']['userText']; ?>

</div>
<?php endforeach; endif; unset($_from); ?>