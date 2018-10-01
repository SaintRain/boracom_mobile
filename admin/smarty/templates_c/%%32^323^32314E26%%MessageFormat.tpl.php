<?php /* Smarty version 2.6.26, created on 2015-08-18 16:28:40
         compiled from /home/u347973/honda-robot.ru/www/modules/ContactsZadatVopros/performance/ShowFormZadatVoprosTemplates/MessageFormat.tpl */ ?>
<?php $_from = $this->_tpl_vars['msgFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<div>
  <?php echo $this->_tpl_vars['item']['caption']; ?>
  <?php echo $this->_tpl_vars['item']['userText']; ?>

</div>
<?php endforeach; endif; unset($_from); ?>