<?php /* Smarty version 2.6.26, created on 2018-09-07 05:38:43
         compiled from E:/Ampps/www/honda-robot/modules/Contacts/performance/ShowFormTemplates/DesignerContactForm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ftext', 'E:/Ampps/www/honda-robot/modules/Contacts/performance/ShowFormTemplates/DesignerContactForm.tpl', 8, false),)), $this); ?>
<p class="white">Вы можете задать свой вопрос<br> специалисту автосервиса</p>
<p class="small"><font color="#b50a0a">*</font> - поля обязятельны для заполнения<br><font color="#b50a0a">**</font> - одно из полей обязятельно для заполнения</p>

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

<form fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
: style="margin-top:0px" id="contact_form2" action="#contact_form2" method='post' enctype='multipart/form-data' onreset="return confirm('<?php echo ((is_array($_tmp='Вы действительно хотите очистить форму?')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
')">
  <input type="hidden" name="<?php echo $this->_tpl_vars['act_variable']; ?>
" value="send" /> 
	<table align="left" border="0" cellpadding="0" cellspacing="0" style="padding-bottom: 20px;">     
      
	<tr height="24"><td colspan="3" valign="top"><input name="UserName" placeholder="Имя:*"  style="width: 270px; background-color: #ffffff;" value="<?php echo $this->_tpl_vars['UserName']; ?>
"></td></tr>
	<tr height="24"><td colspan="3" valign="top"><input name="UserPhone" placeholder="Ваш телефон:**"  style="width: 270px; background-color: #ffffff;" value="<?php echo $this->_tpl_vars['UserPhone']; ?>
"></td></tr>
      <tr height="24"><td colspan="3" valign="top"><input name="UserEmail" placeholder="Ваш e-mail:**"  style="width: 270px; background-color: #ffffff;" value="<?php echo $this->_tpl_vars['UserEmail']; ?>
"></td></tr>
      <tr height="24"><td colspan="3" valign="top"><textarea name="UserText" placeholder="Ваш вопрос:*" style="height: 90px; width: 270px; background-color: #ffffff;"><?php echo $this->_tpl_vars['UserText']; ?>
</textarea></p></td></tr>


<tr height="30">
		<td width="90" align="center"><img width="80px" style="border:0px"  id="kcaptcha_img2" alt="<?php echo ((is_array($_tmp='Включите отображение изображений')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
" src='/tools/kcaptcha2/index.php' /></td>
		<td align="center"><input placeholder="Код" name="kcaptcha" style="width: 60px;" value=""></td>
		<td width="90" align="center"><a href="javascript:$('#contact_form2').submit()"><img src="/img/tchk2.gif" width="15" height="13" border="0" hspace="0" align="middle" alt="" ></a></td>
		</tr>



	</table>
</form>

<?php echo ' 
<script type="text/javascript"> 
function  reloadKcaptcha2() {	
	var time = Math.random();			
 	document.getElementById(\'kcaptcha_img2\').src="/tools/kcaptcha2/index.php?t="+time;
}
</script> 
'; ?>
 
