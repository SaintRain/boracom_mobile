<?php /* Smarty version 2.6.26, created on 2015-08-18 16:28:40
         compiled from /home/u347973/honda-robot.ru/www/modules/ContactsZadatVopros/performance/ShowFormZadatVoprosTemplates/SendResult.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ftext', '/home/u347973/honda-robot.ru/www/modules/ContactsZadatVopros/performance/ShowFormZadatVoprosTemplates/SendResult.tpl', 3, false),)), $this); ?>
<h1 id="contact_form" fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
:>
  <?php if ($this->_tpl_vars['sendResult'] == true): ?>
  	<?php echo ((is_array($_tmp='Спасибо! Ваше сообщение отправлено.')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>

  <?php else: ?>
  	<?php echo ((is_array($_tmp='Технические неполадки отправки сообщения.')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>

  <?php endif; ?>
</h1>