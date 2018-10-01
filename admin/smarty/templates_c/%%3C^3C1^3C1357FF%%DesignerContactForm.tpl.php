<?php /* Smarty version 2.6.26, created on 2018-09-07 06:38:16
         compiled from /var/www/modules/Zvonok/performance/ShowZvonokFormTemplates/DesignerContactForm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ftext', '/var/www/modules/Zvonok/performance/ShowZvonokFormTemplates/DesignerContactForm.tpl', 31, false),)), $this); ?>
<div class="z-shadow" style="position: absolute;display: none; height: 2477px;"></div>
<div class="pre_pal_form_background" style="position: absolute; z-index:9999; top: 0px; left: 0px; display: none;">
<form fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
: id="cont_form" style="margin-top:0px" action="" method='post' enctype='multipart/form-data'>
    <input type="hidden" name="cont" value="send" />  
  <div class="pre_pal_form" style="margin: 15px 0px 0px 331.5px; position: relative; background-color: white; width: 600px; -webkit-box-shadow: rgb(102, 102, 102) 0px 3px 5px; box-shadow: rgb(102, 102, 102) 0px 3px 5px; padding: 15px;">
    <div class="close" style="position:absolute;margin:15px 0 0 500px">
      <span>
        × 
      </span>
      <span class="close" style="cursor:pointer;font-size:13px;color:#2a3369;border-bottom:1px dotted #2a3369">
        Закрыть
      </span>
    </div>
    <div>
      <div xmlns="" class="callback-form" style="">
        <form action="" method="post">
          <h1>
            Заказать звонок
          </h1>
          <p>
            Нет времени или возможности позвонить? Оставьте свой номер
            <br>
            телефона и наш менеджер свяжется с вами в любое удобное время.
          </p>
          
    <?php if ($this->_tpl_vars['errors']): ?>
          <br>
        <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
        <div>          
          <p style="color:#992d31">
            <?php echo ((is_array($_tmp=$this->_tpl_vars['error'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>

          </p>
        </div>
        <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>
          
          <br>
          <table cellspacing="0" cellpadding="4px">
            <tbody>
              <tr>
                <th>

<strong style="color:#424b55">
  Имя:
          </strong>
                </th>
                <td>
                  <input type="text" size="25" name="UserName" value="<?php echo $this->_tpl_vars['UserName']; ?>
" class="text">
                </td>
              </tr>
              <tr>
                <th>
 <strong style="color:#424b55">
  Телефон:
          </strong>
                </th>
                <td>
                  <input type="text" size="25" name="UserPhone" value="<?php echo $this->_tpl_vars['UserPhone']; ?>
" class="text">
                  <p>
                    &nbsp;Например, +7 926 869-72-57
                  </p>
                </td>
              </tr>
            
              <tr>
                <th>
                  <strong style="color:#424b55">
                  Время звонка:&nbsp;
                  </strong>
                </th>
                <td>
                    <input type="text" size="25" name="UserTime" value="<?php echo $this->_tpl_vars['UserTime']; ?>
" class="text">
                  <p>
                    &nbsp;Например, «с 6 до 9 вечера в понедельник, 29 января»
                  </p>
                </td>
              </tr>
              <tr>
                <th>
                </th>
                <td>
                  <table class="arrow-button red-on-white">
                    <tbody>
                      <tr>
                        <td class="submitZvonok">
                            <input type="submit" value="Заказать звонок" />                          
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
        <div class="contacts">
            <br/>
          <p>
            Вы также можете позвонить нам самостоятельно по телефонам
          </p>
          <p class="phones">
            <b>
              <span id="phone31">
                <nobr>                  
+7 (965) 395 6404, +7 (905) 557 4046
                </nobr>
              </span>
            </b>
            &nbsp;&nbsp;
          </p>
        </div>
</div></div></div>
</form>  
  </div>



<?php echo '
<script>
    $( document ).ready(function() {
	//callback
	var dh = jQuery(document).height(),
		w = jQuery(document).width(),
		nw = w/2-250;
        
        
	jQuery(\'.callback\').click(function(){
		var st = jQuery(document).scrollTop(),
			stn = st+200;
		jQuery(\'.z-shadow, .pre_pal_form_background\').show();
		jQuery(\'.z-shadow\').css(\'height\', dh);
      //jQuery(\'.pre_pal_form_background\').css({\'left\':nw, \'top\':stn});
	});

    jQuery(\'.submitZvonok\').click(function(){
      $(\'#cont_form\').submit();
    });
	jQuery(\'.z-shadow, .close\').click(function(){
		jQuery(\'.z-shadow, .pre_pal_form_background\').hide();
	});
'; ?>
  
  <?php if ($this->_tpl_vars['errors']): ?>
    jQuery('.z-shadow, .pre_pal_form_background').show();
  <?php echo '
'; ?>
      
    <?php endif; ?>
    });
</script>  