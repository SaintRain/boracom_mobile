<?php /* Smarty version 2.6.26, created on 2014-09-14 10:45:51
         compiled from E:/Zend/Apache2/htdocs/honda/modules/Contacts/performance/ShowFormTemplates/ContactForm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ftext', 'E:/Zend/Apache2/htdocs/honda/modules/Contacts/performance/ShowFormTemplates/ContactForm.tpl', 3, false),)), $this); ?>
                            <p class="white">Вы можете задать свой вопрос<br> специалисту автосервиса</p>
                            <p class="small"><font color=#b50a0a>*</font> - поля обязятельны для заполнения<br><font color=#b50a0a>**</font> - одно из полей обязятельно для заполнения</p>
<form fastedit:<?php echo $this->_tpl_vars['table_name']; ?>
: style="margin-top:0px" id="contact_form" action="#contact_form" method='post' enctype='multipart/form-data' onreset="return confirm('<?php echo ((is_array($_tmp='Вы действительно хотите очистить форму?')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
')">
  <p>
    <input type="hidden" name="<?php echo $this->_tpl_vars['act_variable']; ?>
" value="send" /> 
  </p>
                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="padding-bottom: 20px;">
    <?php if ($this->_tpl_vars['errors']): ?>
    <tr>
      <td></td>
      <td colspan="2" align="left">                
        <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
        <div>          
          <p style="color:#a20405">
            <?php echo ((is_array($_tmp=$this->_tpl_vars['error'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>

          </p>
        </div>
        <?php endforeach; endif; unset($_from); ?>
        <div style="height:15px"></div>        
      </td>
    </tr>
    <?php endif; ?>	    
    
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
    <?php $this->assign('fieldname', "field_".($this->_tpl_vars['item']['id'])); ?>
    <tr> 
    	<?php if ($this->_tpl_vars['item']['type'] == 'Input'): ?>
      <td align="left" valign="middle" class="contacts_formtext">
        <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['caption'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
<?php if ($this->_tpl_vars['item']['nnull']): ?> 
        <span style="color:#a20405">
          *
        </span>
        <?php endif; ?>&nbsp;&nbsp;
      </td>
      		<td  align="left" colspan="2"><input name="<?php echo $this->_tpl_vars['fieldname']; ?>
" class="<?php if ($this->_tpl_vars['item']['class']): ?><?php echo $this->_tpl_vars['item']['class']; ?>
<?php else: ?>contacts_input<?php endif; ?>"  value="<?php echo $this->_tpl_vars['post'][$this->_tpl_vars['fieldname']]; ?>
"  style="width:<?php if ($this->_tpl_vars['item']['width']): ?><?php echo $this->_tpl_vars['item']['width']; ?>
<?php else: ?>100%<?php endif; ?>;<?php if ($this->_tpl_vars['item']['height']): ?>height:<?php echo $this->_tpl_vars['item']['height']; ?>
<?php endif; ?>;<?php echo $this->_tpl_vars['item']['style']; ?>
" />
        <?php else: ?>
       	<?php if ($this->_tpl_vars['item']['type'] == 'Textarea'): ?>      
    		<td align="left" valign="top" class="contacts_formtext"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['caption'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
<?php if ($this->_tpl_vars['item']['nnull']): ?> <span style="color:#a20405">*</span><?php endif; ?>&nbsp;&nbsp;</td>
		    <td  align="left" colspan="2"><textarea name="<?php echo $this->_tpl_vars['fieldname']; ?>
" class="<?php if ($this->_tpl_vars['item']['class']): ?><?php echo $this->_tpl_vars['item']['class']; ?>
<?php else: ?>contacts_textarea<?php endif; ?>" style="width:<?php if ($this->_tpl_vars['item']['width']): ?><?php echo $this->_tpl_vars['item']['width']; ?>
<?php else: ?>100%<?php endif; ?>;height:<?php if ($this->_tpl_vars['item']['height']): ?><?php echo $this->_tpl_vars['item']['height']; ?>
<?php else: ?>100px<?php endif; ?>;<?php echo $this->_tpl_vars['item']['style']; ?>
"><?php echo $this->_tpl_vars['post'][$this->_tpl_vars['fieldname']]; ?>
</textarea>
        <?php else: ?>
        <?php if ($this->_tpl_vars['item']['type'] == 'Checkbox'): ?>      
      		<td align="left" valign="top"></td>
      		<td  align="left" colspan="2"><input type="checkbox" <?php if ($this->_tpl_vars['post'][$this->_tpl_vars['fieldname']]): ?>checked<?php endif; ?>  value="true" name="<?php echo $this->_tpl_vars['fieldname']; ?>
"  class="<?php if ($this->_tpl_vars['item']['class']): ?><?php echo $this->_tpl_vars['item']['class']; ?>
<?php else: ?>contacts_checkbox<?php endif; ?>"  style="<?php if ($this->_tpl_vars['item']['width']): ?>width:<?php echo $this->_tpl_vars['item']['width']; ?>
;<?php endif; ?><?php if ($this->_tpl_vars['item']['height']): ?>height:<?php echo $this->_tpl_vars['item']['height']; ?>
<?php endif; ?>;<?php echo $this->_tpl_vars['item']['style']; ?>
" />
        	&nbsp;&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['caption'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>

        <?php else: ?>
        <?php if ($this->_tpl_vars['item']['type'] == 'Radio'): ?>      
      		<td align="left" valign="middle" class="contacts_formtext"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['caption'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
<?php if ($this->_tpl_vars['item']['nnull']): ?> <span style="color:#a20405">*</span><?php endif; ?>&nbsp;&nbsp;</td>
      		<td align="left" colspan="2"> <?php $_from = $this->_tpl_vars['item']['select_values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sv']):
?>
        	<input <?php if ($this->_tpl_vars['post'][$this->_tpl_vars['fieldname']] == $this->_tpl_vars['sv']): ?>checked<?php endif; ?> type="radio" value="<?php echo $this->_tpl_vars['sv']; ?>
" name="<?php echo $this->_tpl_vars['fieldname']; ?>
" class="<?php if ($this->_tpl_vars['item']['class']): ?><?php echo $this->_tpl_vars['item']['class']; ?>
<?php else: ?>contacts_checkbox<?php endif; ?>" style="<?php if ($this->_tpl_vars['item']['width']): ?>width:<?php echo $this->_tpl_vars['item']['width']; ?>
;<?php endif; ?><?php if ($this->_tpl_vars['item']['height']): ?>height:<?php echo $this->_tpl_vars['item']['height']; ?>
<?php endif; ?>;<?php echo $this->_tpl_vars['item']['style']; ?>
" />
        	&nbsp;&nbsp;<?php echo $this->_tpl_vars['sv']; ?>

        	<?php endforeach; endif; unset($_from); ?>						        
        <?php else: ?>
        <?php if ($this->_tpl_vars['item']['type'] == 'File'): ?>      
      		<td align="left" valign="middle" style="white-space:nowrap" class="contacts_formtext"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['caption'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
<?php if ($this->_tpl_vars['item']['nnull']): ?> <span style="color:#5acbff">*</span><?php endif; ?>&nbsp;&nbsp;</td>
      		<td  align="left" colspan="2"><input type="file" name="<?php echo $this->_tpl_vars['fieldname']; ?>
" class="<?php if ($this->_tpl_vars['item']['class']): ?><?php echo $this->_tpl_vars['item']['class']; ?>
<?php else: ?>contacts_file<?php endif; ?>" style="width:<?php if ($this->_tpl_vars['item']['width']): ?><?php echo $this->_tpl_vars['item']['width']; ?>
<?php else: ?>100%<?php endif; ?>;<?php if ($this->_tpl_vars['item']['height']): ?>height:<?php echo $this->_tpl_vars['item']['height']; ?>
<?php endif; ?>;<?php echo $this->_tpl_vars['item']['style']; ?>
" />
        <?php else: ?>
        <?php if ($this->_tpl_vars['item']['type'] == 'Select'): ?>      
      		<td align="left" valign="middle" class="contacts_formtext"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['caption'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
<?php if ($this->_tpl_vars['item']['nnull']): ?> <span style="color:#5acbff">*</span><?php endif; ?>&nbsp;&nbsp;</td>
      		<td  align="left">
      		<select <?php if ($this->_tpl_vars['item']['checked']): ?>checked<?php endif; ?> type="radio" value="<?php echo $this->_tpl_vars['item']['id']; ?>
" name="<?php echo $this->_tpl_vars['fieldname']; ?>
" class="<?php if ($this->_tpl_vars['item']['class']): ?><?php echo $this->_tpl_vars['item']['class']; ?>
<?php else: ?>contacts_checkbox<?php endif; ?>" style="<?php if ($this->_tpl_vars['item']['width']): ?>width:<?php echo $this->_tpl_vars['item']['width']; ?>
;<?php endif; ?><?php if ($this->_tpl_vars['item']['height']): ?>height:<?php echo $this->_tpl_vars['item']['height']; ?>
<?php endif; ?>;<?php echo $this->_tpl_vars['item']['style']; ?>
">         
				<?php $_from = $this->_tpl_vars['item']['select_values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sv']):
?>						
					<option <?php if ($this->_tpl_vars['post'][$this->_tpl_vars['fieldname']] == $this->_tpl_vars['sv']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['sv']; ?>
"><?php echo $this->_tpl_vars['sv']; ?>
</option>          
				<?php endforeach; endif; unset($_from); ?>						
        	</select>
        <?php else: ?>
        <?php if ($this->_tpl_vars['item']['type'] == 'MultiSelect'): ?>      
      		<td align="left" valign="middle" class="contacts_formtext"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['caption'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
<?php if ($this->_tpl_vars['item']['nnull']): ?> <span style="color:#5acbff">*</span><?php endif; ?>&nbsp;&nbsp;</td>
      		<td  align="left">
      		<select multiple <?php if ($this->_tpl_vars['item']['checked']): ?>checked<?php endif; ?> type="radio" value="<?php echo $this->_tpl_vars['item']['id']; ?>
" name="<?php echo $this->_tpl_vars['fieldname']; ?>
[]" class="<?php if ($this->_tpl_vars['item']['class']): ?><?php echo $this->_tpl_vars['item']['class']; ?>
<?php else: ?>contacts_checkbox<?php endif; ?>" style="<?php if ($this->_tpl_vars['item']['width']): ?>width:<?php echo $this->_tpl_vars['item']['width']; ?>
;<?php endif; ?><?php if ($this->_tpl_vars['item']['height']): ?>height:<?php echo $this->_tpl_vars['item']['height']; ?>
<?php endif; ?>;<?php echo $this->_tpl_vars['item']['style']; ?>
">          
			<?php $_from = $this->_tpl_vars['item']['select_values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sv']):
?>							
          		<option <?php if (is_array ( $this->_tpl_vars['post'][$this->_tpl_vars['fieldname']] )): ?><?php if (in_array ( $this->_tpl_vars['sv'] , $this->_tpl_vars['post'][$this->_tpl_vars['fieldname']] )): ?> selected <?php endif; ?><?php endif; ?> value="<?php echo $this->_tpl_vars['sv']; ?>
"><?php echo $this->_tpl_vars['sv']; ?>
</option>          
			<?php endforeach; endif; unset($_from); ?>							
        	</select>
        <?php else: ?>						
        <?php if ($this->_tpl_vars['item']['type'] == 'Text'): ?>      
      		<td align="left" valign="middle" class="contacts_formtext"></td>
      		<td  align="left" ><span class="<?php if ($this->_tpl_vars['item']['class']): ?><?php echo $this->_tpl_vars['item']['class']; ?>
<?php else: ?>contacts_formtext<?php endif; ?>" style="<?php if ($this->_tpl_vars['item']['width']): ?>width:<?php echo $this->_tpl_vars['item']['width']; ?>
;<?php endif; ?><?php if ($this->_tpl_vars['item']['height']): ?>height:<?php echo $this->_tpl_vars['item']['height']; ?>
<?php endif; ?>;<?php echo $this->_tpl_vars['item']['style']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['caption'])) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
</span> <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?> 
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
       </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>    
        
    <?php if ($this->_tpl_vars['settings']['kcaptcha'] == 1): ?>
    <tr>    
    <td align='left' valign='middle' style="width:100px;white-space:nowrap"><?php echo ((is_array($_tmp='Введите текст:')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
&nbsp;<span style="color:#a20405">*</span></td>
      <td align="left" valign="top">                    
        <div style="float:left">
          <img style="margin:5px;border:0px"  width="120px" height="50px" id="kcaptcha_img" alt="<?php echo ((is_array($_tmp='Включите отображение изображений')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
" src='/tools/kcaptcha/index.php' />
        </div>
        <div style="float:left">
          <br/>
          <input name="kcaptcha" style="width:115px" />
          <br/>
          <a class="news_navigations" href="javascript:reloadKcaptcha()">
            <?php echo ((is_array($_tmp='поменять картинку')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>

          </a>          
        </div>                            
      </td>
      </tr>    
    <?php endif; ?>
    <tr>
      <td colspan="3" style="height:10px"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" valign="bottom" align="left">        
        <input class="button" style="float:left;width:120px;" type="reset" value="<?php echo ((is_array($_tmp='Очистить')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
" />
        <input class="button" style="float:left;margin-left:10px;width:120px;" type="submit" value="<?php echo ((is_array($_tmp='Отправить')) ? $this->_run_mod_handler('ftext', true, $_tmp) : smarty_modifier_ftext($_tmp)); ?>
" />
      </td>
    </tr>
  </table>
</form>

<?php echo ' 
<script type="text/javascript"> 
function  reloadKcaptcha() {	
	var time = Math.random();			
 	document.getElementById(\'kcaptcha_img\').src="/tools/kcaptcha/index.php?t="+time;
}
</script> 
'; ?>
 