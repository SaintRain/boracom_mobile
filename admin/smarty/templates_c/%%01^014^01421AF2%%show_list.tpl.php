<?php /* Smarty version 2.6.26, created on 2014-09-14 10:13:28
         compiled from E:/Zend/Apache2/htdocs/honda/modules/BreadCrumbs/performance/ShowBreadCrumbsTemplates/show_list.tpl */ ?>
<div fastedit:: class="way">
  <a href="/" class="waylink">Главная</a>
  <?php if ($this->_tpl_vars['pageInfo']['name'] != 'index'): ?>
  <?php if ($this->_tpl_vars['pageInfo']['templates_id'] == 5): ?>
  - <a href="uslugi-avtotsentra" class="waylink">Услуги автоцентра</a>
  <?php endif; ?>
  - <?php echo $this->_tpl_vars['pageInfo']['description']; ?>

  <?php else: ?>
  - Ремонт мозгов Honda Civic 5D 2006 - 2009
  <?php endif; ?>
</div>