<?php /* Smarty version 2.6.26, created on 2018-09-28 06:56:19
         compiled from /var/www/modules/MenuLeft/performance/ShowMenuLeftTemplates/menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ftext', '/var/www/modules/MenuLeft/performance/ShowMenuLeftTemplates/menu.tpl', 19, false),)), $this); ?>
<section fastedit:: class="mobilemenu">
    <div class="mobilebutton">X</div>
    <div class="menucontact">
        <p>+7(495) 640 21 99</p>
        <p>+7(495) 640 22 07</p>
        <p class="adress">Московская область, г. Красногорск,<br/>
            Павшинский бульвар, дом 17</p>
    </div>
    <ul>
        <?php $this->assign('needClose', 0); ?>
        <?php $_from = $this->_tpl_vars['menuItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['cat']['iteration']++;
?>

        <?php if (! $this->_tpl_vars['list']['deep'] && $this->_tpl_vars['needClose'] == 1): ?>
            <?php $this->assign('needClose', 0); ?>
            </ul>
        <?php endif; ?>
            <?php if (! $this->_tpl_vars['list']['deep'] && ! $this->_tpl_vars['list']['otstup']): ?>
            <li ><a fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
:<?php echo $this->_tpl_vars['list']['id']; ?>
 <?php if ($this->_tpl_vars['list']['selected']): ?>class="active"<?php endif; ?>
                    href="<?php echo $this->_tpl_vars['list']['name']; ?>
<?php echo $this->_tpl_vars['list']['url']; ?>
" ><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['item'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
</a></li>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['list']['otstup'] == 1): ?>
                <?php $this->assign('needClose', 1); ?>
                <li class="parent"><a  fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
:<?php echo $this->_tpl_vars['list']['id']; ?>
 href="<?php echo $this->_tpl_vars['list']['name']; ?>
<?php echo $this->_tpl_vars['list']['url']; ?>
" ><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['item'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
</a>
                <ul>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['list']['deep'] == 1): ?>
                <li><a  fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
:<?php echo $this->_tpl_vars['list']['id']; ?>
 href="<?php echo $this->_tpl_vars['list']['name']; ?>
<?php echo $this->_tpl_vars['list']['url']; ?>
" <?php if ($this->_tpl_vars['list']['selected']): ?>class="active"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['list']['item'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
</a></li>
            <?php endif; ?>

        <?php endforeach; endif; unset($_from); ?>
    </ul>
</section>