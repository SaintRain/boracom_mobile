<?php /* Smarty version 2.6.26, created on 2018-09-26 06:48:26
         compiled from /var/www/modules/Slider/performance/ShowSliderTemplates/slider.tpl */ ?>
<div class="slider">
    <div class="swiper-wrapper">
        <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['cat']['iteration']++;
?>
            <div class="swiper-slide">
                <img  fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
:<?php echo $this->_tpl_vars['item']['id']; ?>

                     src="/modules/Slider/management/storage/images/data/image/<?php echo $this->_tpl_vars['item']['id']; ?>
/<?php echo $this->_tpl_vars['item']['image']; ?>
"
                     data-thumb="/modules/Slider/management/storage/images/data/image/<?php echo $this->_tpl_vars['item']['id']; ?>
/<?php echo $this->_tpl_vars['item']['image']; ?>
"
                     alt="slide-test"/>
            </div>
        <?php endforeach; endif; unset($_from); ?>
    </div>
    <div class="swiper-pagination"></div>
</div>


<?php echo '
    <script>
        var swiper = new Swiper(\'.slider\', {
            pagination: {
                el: \'.swiper-pagination\',
            },
            clickable: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: true,
            },
        });
    </script>
'; ?>