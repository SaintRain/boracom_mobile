<?php /* Smarty version 2.6.26, created on 2018-09-07 06:38:16
         compiled from /var/www/modules/Menu/performance/ShowMenuTemplates/menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ftext', '/var/www/modules/Menu/performance/ShowMenuTemplates/menu.tpl', 4, false),)), $this); ?>
<table fastedit:: width=100% align="center" valign="top" border="0" cellspacing="0" cellpadding="0">
                    <tr align="center">
                      <?php $_from = $this->_tpl_vars['menuItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['cat']['iteration']++;
?>
                      <td fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
:<?php echo $this->_tpl_vars['list']['id']; ?>
 width=20%><a href="<?php echo $this->_tpl_vars['list']['name']; ?>
<?php echo $this->_tpl_vars['list']['url']; ?>
" class="toplink" <?php if ($this->_tpl_vars['list']['selected']): ?>style="color: #bc0c08; text-decoration: underline;"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['item'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
</a></td>         
                      <?php endforeach; endif; unset($_from); ?>
                </table>