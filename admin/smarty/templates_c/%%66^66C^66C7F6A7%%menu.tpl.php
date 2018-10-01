<?php /* Smarty version 2.6.26, created on 2014-09-15 12:43:30
         compiled from /home/u347973/honda-robot.ru/www/modules/MenuLeft/performance/ShowMenuLeftTemplates/menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ftext', '/home/u347973/honda-robot.ru/www/modules/MenuLeft/performance/ShowMenuLeftTemplates/menu.tpl', 3, false),)), $this); ?>
<table fastedit:: align="left" valign="top" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 230px;">
   <?php $_from = $this->_tpl_vars['menuItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['cat']['iteration']++;
?>
  <tr fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
:<?php echo $this->_tpl_vars['list']['id']; ?>
><td class="point"><a <?php if ($this->_tpl_vars['list']['selected']): ?>style="color: #bc0c08; text-decoration: underline;"<?php endif; ?> href="<?php echo $this->_tpl_vars['list']['name']; ?>
<?php echo $this->_tpl_vars['list']['url']; ?>
" class="leftlink"><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['item'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
</a></td></tr>
  <?php endforeach; endif; unset($_from); ?>
                    </table>