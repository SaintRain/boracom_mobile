<?php /* Smarty version 2.6.26, created on 2018-09-26 06:44:15
         compiled from /var/www/modules/Contacts/performance/ShowFormTemplates/DesignerContactForm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ftext', '/var/www/modules/Contacts/performance/ShowFormTemplates/DesignerContactForm.tpl', 2, false),)), $this); ?>
<form class="contact_form" fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
: style="margin-top:0px" id="contact_form2" action="#contact_form2"
	  method='post' enctype='multipart/form-data' onreset="return confirm('<?php echo ((is_array($_tmp='Вы действительно хотите очистить форму?')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
')">

    <?php if ($this->_tpl_vars['errors']): ?>
        <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
			<div fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
: id="contact_form" style="margin:5px">
				<p style="color:#a20405">
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['error'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>

				</p>
			</div>
        <?php endforeach; endif; unset($_from); ?>
		<br/>
    <?php endif; ?>

	<input type="hidden" name="<?php echo $this->_tpl_vars['act_variable']; ?>
" value="send" />
	<input name="UserEmail" placeholder="Ваш e-mail:"   value="<?php echo $this->_tpl_vars['UserEmail']; ?>
">
	<input name="UserName" placeholder="Ваше имя:"   value="<?php echo $this->_tpl_vars['UserName']; ?>
">
	<input name="UserPhone" placeholder="Телефон (по желанию):"  value="<?php echo $this->_tpl_vars['UserPhone']; ?>
">
	<textarea name="UserText" placeholder="Сообщение:" cols="40" rows="6"><?php echo $this->_tpl_vars['UserText']; ?>
</textarea>

	<table width="100%">
<tr height="30">
		<td  align="center"><img width="80px" style="border:0px"  id="kcaptcha_img2" alt="<?php echo ((is_array($_tmp='Включите отображение изображений')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
" src='/tools/simple-php-captcha/index.php' /></td>
		<td align="center"><input placeholder="Код" name="kcaptcha"  value=""></td>
		</tr>

	</table>
	<button class="submit" type="submit">Отправить</button>
	<p></p>
</form>