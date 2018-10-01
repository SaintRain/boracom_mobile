<?php /* Smarty version 2.6.26, created on 2018-09-07 05:38:43
         compiled from E:/Ampps/www/honda-robot/modules/MenuBottom/performance/ShowMenuBottomTemplates/menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ftext', 'E:/Ampps/www/honda-robot/modules/MenuBottom/performance/ShowMenuBottomTemplates/menu.tpl', 2, false),)), $this); ?>
 <?php $_from = $this->_tpl_vars['menuItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['cat']['iteration']++;
?>
<a fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
:<?php echo $this->_tpl_vars['list']['id']; ?>
 href="<?php echo $this->_tpl_vars['list']['name']; ?>
<?php echo $this->_tpl_vars['list']['url']; ?>
" class="footlink"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['item'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
</a><br>
<?php endforeach; endif; unset($_from); ?>