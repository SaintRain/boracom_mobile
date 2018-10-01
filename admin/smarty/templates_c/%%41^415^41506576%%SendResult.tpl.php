<?php /* Smarty version 2.6.26, created on 2014-09-14 11:07:35
         compiled from E:/Zend/Apache2/htdocs/honda/modules/Contacts/performance/ShowFormTemplates/SendResult.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ftext', 'E:/Zend/Apache2/htdocs/honda/modules/Contacts/performance/ShowFormTemplates/SendResult.tpl', 3, false),)), $this); ?>
<h1 id="contact_form2" fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
:>
  <?php if ($this->_tpl_vars['sendResult'] == true): ?>
  	<?php echo ((is_array($_tmp='Спасибо! Ваше сообщение отправлено.')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>

  <?php else: ?>
  	<?php echo ((is_array($_tmp='Технические неполадки отправки сообщения.')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>

  <?php endif; ?>
</h1>