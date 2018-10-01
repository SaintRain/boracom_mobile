<?php /* Smarty version 2.6.26, created on 2018-09-07 07:08:50
         compiled from modules/modules_settings.tpl */ ?>
<?php echo '
<script language="JavaScript">
function showHideSettings() {
	var  details	= GetElementById(\'additional_settings\');

	if (details.style.visibility==\'hidden\') {
		details.style.visibility=\'visible\';
	}
	else {
		details.style.visibility=\'hidden\';
	}
}
</script>
'; ?>


<?php if (! $this->_tpl_vars['hide_menu']): ?>
<p style="margin-top:10px;margin-bottom:10px">
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><a href="?act=modules&do=form_import"><?php echo $this->_tpl_vars['MSGTEXT']['import_module']; ?>
</a> &rarr; </td>
    <td width="20px"></td>
    <td><a href="?act=modules&do=copy_module_form"><?php echo $this->_tpl_vars['MSGTEXT']['create_copy_of_module']; ?>
</a> &rarr;</td>
  </tr>
</table>
</p>
<?php endif; ?> <br>
<form id="data form" action="?act=modules&do=settings_save&block_id=<?php echo $this->_tpl_vars['block_id']; ?>
<?php if ($this->_tpl_vars['hide_menu']): ?>&close=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>" method="POST" style="margin:0px">
  <table width='100%' cellspacing=0 border=0 <?php if ($this->_tpl_vars['hide_menu']): ?> cellpadding=10<?php else: ?>cellpadding=0<?php endif; ?>>
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <?php if ($this->_tpl_vars['tplFiles']): ?>
        <tr>
          <td width="10%" valign="top"><i><?php echo $this->_tpl_vars['MSGTEXT']['edit_out_tpl']; ?>
:</i></td>
          <td width="10px">&nbsp;</td>
          <td>
          <table cellpadding="0" cellspacing="2" border="0">
          <?php $_from = $this->_tpl_vars['tplFiles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
          <tr>
          <td><a class="tpl_link" title="<?php echo $this->_tpl_vars['MSGTEXT']['mod_settings_adress_file']; ?>
 <?php echo $this->_tpl_vars['tpl_dir']; ?>
<?php echo $this->_tpl_vars['item']['name']; ?>
" href="?act=modules&do=edit_out_tpl&block_id=<?php echo $this->_tpl_vars['block']['id']; ?>
<?php if ($this->_tpl_vars['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>&tpl_id=<?php echo $this->_tpl_vars['item']['id']; ?>
">
          <?php if ($this->_tpl_vars['item']['tpl_type'] == 'xml'): ?><img border="0" src="images/tpls/xml.png"><?php endif; ?>
          <?php if ($this->_tpl_vars['item']['tpl_type'] == 'tpl'): ?><img border="0" src="images/tpls/tpl.png"><?php endif; ?>
          <?php if ($this->_tpl_vars['item']['tpl_type'] == 'xsl'): ?><img border="0" src="images/tpls/xsl.png"><?php endif; ?>
          </a></td>
          <td>&nbsp;<a class="tpl_link" title="<?php echo $this->_tpl_vars['MSGTEXT']['mod_settings_adress_file']; ?>
 <?php echo $this->_tpl_vars['tpl_dir']; ?>
<?php echo $this->_tpl_vars['item']['name']; ?>
" href="?act=modules&do=edit_out_tpl&block_id=<?php echo $this->_tpl_vars['block']['id']; ?>
<?php if ($this->_tpl_vars['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>&tpl_id=<?php echo $this->_tpl_vars['item']['id']; ?>
"><b><?php echo $this->_tpl_vars['item']['description']; ?>
</b></a></td>
          </tr>
           <?php endforeach; endif; unset($_from); ?>
           </table>
           
           </td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>
        <tr>
          <td height="1px" colspan="100%" bgcolor="#66a4d3"></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>
        <?php endif; ?>

        <tr>
          <td nowrap width="10%"><i><?php echo $this->_tpl_vars['MSGTEXT']['pages_list_way_to_block']; ?>
</i></td>
          <td width="10px">&nbsp;</td>
          <td>
          <table cellpadding="0" cellspacing="2" border="0">
          <tr>
          <td width="25px"><a title="<?php echo $this->_tpl_vars['MSGTEXT']['mod_settings_adress_file']; ?>
 <?php echo $this->_tpl_vars['block_patch']; ?>
" style="font-weight:bold" href="index.php?act=php&do=edit&block_id=<?php echo $this->_tpl_vars['block_id']; ?>
"><img border="0" src="images/tpls/php.png"/></a></td>
          <td>&nbsp;<a title="<?php echo $this->_tpl_vars['MSGTEXT']['mod_settings_adress_file']; ?>
 <?php echo $this->_tpl_vars['block_patch']; ?>
" class="tpl_link" href="index.php?act=php&do=edit&block_id=<?php echo $this->_tpl_vars['block_id']; ?>
<?php if ($this->_tpl_vars['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>"><b><?php echo $this->_tpl_vars['block']['block_description']; ?>
</b></a></td>
          </tr>
          </table>
          </td>          
        </tr> 
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>                        
        <tr>
          <td height="1px" colspan="100%" bgcolor="#66a4d3"></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>                                
        <tr>
          <td nowrap width="10%"><i><?php echo $this->_tpl_vars['MSGTEXT']['mod_settings_tupe_block']; ?>
</i></td>
          <td width="10px">&nbsp;</td>
          <td><b><?php if ($this->_tpl_vars['block']['type'] == 2): ?><?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_multiple']; ?>
<?php else: ?><?php if ($this->_tpl_vars['block']['type'] == 1): ?><?php echo $this->_tpl_vars['MSGTEXT']['blocks_list_single']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['blocks_form_add_plugin']; ?>
<?php endif; ?><?php endif; ?></b></td>
        </tr>  

                
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>                        
        <tr>
          <td height="1px" colspan="100%" bgcolor="#66a4d3"></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>    
        <tr>
          <td nowrap><i><?php echo $this->_tpl_vars['MSGTEXT']['mod_settings_tupe_variable']; ?>
</i></td>
          <td width="10px">&nbsp;</td>
          <td><b><?php echo $this->_tpl_vars['block']['act_method']; ?>
</b></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>                        
        <tr>
          <td height="1px" colspan="100%" bgcolor="#66a4d3"></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>        
		<tr>
          <td nowrap><i><?php echo $this->_tpl_vars['MSGTEXT']['mod_settings_variable_name_calling']; ?>
</i></td>
          <td width="10px">&nbsp;</td>
          <td><b><?php echo $this->_tpl_vars['block']['act_variable']; ?>
</b></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>        

        <?php if ($this->_tpl_vars['block']['url_get_vars']): ?>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>
        <tr>
          <td height="1px" colspan="100%" bgcolor="#66a4d3"></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>
        <tr>
          <td nowrap valign="top" align="left"><i><?php echo $this->_tpl_vars['MSGTEXT']['mod_settings_url_get_vars']; ?>
</td>
          <td width="10px">&nbsp;</td>
          <td valign="top" align="left"><b><?php echo $this->_tpl_vars['block']['url_get_vars']; ?>
</b></td>
        </tr>
        <?php endif; ?>
      </table>
      <br>
      <?php if ($_GET['refresh']): ?>
      <?php if ($_GET['hide_menu'] && $_GET['fastEdit']): ?><script language="JavaScript">opener.location.reload();</script><?php endif; ?>
      <?php endif; ?>
      <?php if ($_GET['saved']): ?>
      <p style="color:yellow"><?php echo $this->_tpl_vars['MSGTEXT']['settings_saved']; ?>
</p>
      <?php else: ?>
      <br>
      <?php endif; ?>
      
	<?php if ($this->_tpl_vars['settings']): ?>    
	<?php if ($this->_tpl_vars['own_settings']): ?>  
      <table width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#4e86b0">
        <tr bgcolor="#66a4d3">
          <td nowrap width="20%"><b><?php echo $this->_tpl_vars['MSGTEXT']['mod_settings_name_variable']; ?>
</b></td>
          <td width="80%"><b><?php echo $this->_tpl_vars['MSGTEXT']['mod_settings_value']; ?>
</b></td>
        </tr>

        <?php $_from = $this->_tpl_vars['settings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?> 
        <?php if ($this->_tpl_vars['list']['block_id'] == $this->_tpl_vars['block']['id']): ?> 
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['form_template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>     
        <?php endforeach; endif; unset($_from); ?>
       
        <tr bgcolor="#66a4d3">
          <td colspan="2"><input style="margin-top:5px;width:130px" class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['save']; ?>
"></td>
        </tr>
      </table>
      <?php endif; ?>
      
      <?php if ($this->_tpl_vars['addittional_settings']): ?>
      <p><b><a href="javascript:showHideSettings()"><?php echo $this->_tpl_vars['MSGTEXT']['mod_settings_additional_settings']; ?>
</b></a></p>
      <table style="visibility:hidden" id="additional_settings" width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#4e86b0">
        <tr bgcolor="#66a4d3">
          <td nowrap width="20%"><b><?php echo $this->_tpl_vars['MSGTEXT']['mod_settings_name_variable']; ?>
</b></td>
          <td width="80%"><b><?php echo $this->_tpl_vars['MSGTEXT']['mod_settings_value']; ?>
</b></td>
        </tr>
        
        <?php $_from = $this->_tpl_vars['settings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?> 
        <?php if ($this->_tpl_vars['list']['block_id'] != $this->_tpl_vars['block']['id']): ?> 
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['form_template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>     
        <?php endforeach; endif; unset($_from); ?>
        
        <tr bgcolor="#66a4d3">
          <td colspan="2"><input style="margin-top:5px;width:130px" class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['save']; ?>
"></td>
        </tr>
      </table>
      <?php endif; ?>
   <?php endif; ?>                 
</form>
</td>
</tr>
</table>
<br>&nbsp;