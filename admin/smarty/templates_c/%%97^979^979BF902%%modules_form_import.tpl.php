<?php /* Smarty version 2.6.26, created on 2018-09-07 07:09:20
         compiled from modules/modules_form_import.tpl */ ?>
<?php echo '
<script language="JavaScript">
function setDescription(obj) {
	GetElementById(\'description\').innerHTML=GetElementById(\'divId\'+obj.value).innerHTML;
}
</script>
'; ?>


<?php if ($this->_tpl_vars['messages']): ?>
<?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['m']):
?>
	<p style="color:yellow"><?php echo $this->_tpl_vars['m']; ?>
</p>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
<div id="divId<?php echo $this->_tpl_vars['list']['filename']; ?>
" style="display:none;"><?php echo $this->_tpl_vars['list']['description']; ?>
</div>
<?php endforeach; endif; unset($_from); ?>
<p style="margin-top:10px;margin-bottom:10px">
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><a <?php if ($_GET['do'] == 'form_import'): ?> style="font-weight:bold" <?php endif; ?> href="?act=modules&do=form_import"><?php echo $this->_tpl_vars['MSGTEXT']['import_module']; ?>
</a> &rarr; </td>
    <td width="20px"></td>
    <td><a <?php if ($_GET['do'] == 'copy_module_form'): ?> style="font-weight:bold" <?php endif; ?> href="?act=modules&do=copy_module_form"><?php echo $this->_tpl_vars['MSGTEXT']['create_copy_of_module']; ?>
</a> &rarr;</td>
  </tr>
</table>
</p>
<?php $_from = $this->_tpl_vars['error']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<p style="margin-top:10px; color:yellow"><?php echo $this->_tpl_vars['item']; ?>
</p>
<?php endforeach; endif; unset($_from); ?>
<form id="data form" action="?act=modules&do=import&m_id=0" method="POST" style="margin:0px">
  <p style="margin-bottom:10"><font color="Yellow"><?php if ($this->_tpl_vars['import_result']): ?><?php echo $this->_tpl_vars['import_result']; ?>
<br>
    <?php endif; ?><?php echo $this->_tpl_vars['message']; ?>
</font></p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
        <tr>
        <td>      
      <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td><?php echo $this->_tpl_vars['MSGTEXT']['select_module']; ?>
:
              <select onchange="setDescription(this)" name="import_modul" style="width:100%;" size="1" >                
				<?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['modules'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['modules']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['modules']['iteration']++;
?>
				<?php if ($this->_foreach['modules']['iteration'] == 1): ?>
					<?php $this->assign('description', $this->_tpl_vars['list']['description']); ?>
				<?php endif; ?>
                <option value="<?php echo $this->_tpl_vars['list']['filename']; ?>
"><?php echo $this->_tpl_vars['list']['filename']; ?>
<?php if ($this->_tpl_vars['list']['version']): ?> v.<?php echo $this->_tpl_vars['list']['version']; ?>
<?php endif; ?><br>
                <?php endforeach; endif; unset($_from); ?>
              </select>
              <p style="margin-top:10px"><?php echo $this->_tpl_vars['MSGTEXT']['description_of_module']; ?>
:<br>
                <textarea name="description" id="description" rows="4" style="width:100%"><?php echo $this->_tpl_vars['description']; ?>
</textarea>
            </td>
          </tr>
          <tr>
            <td><input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['import']; ?>
" style="width:130px"></td>
          </tr>
        </table>
</td>
          </tr>
        </table>        
        </td>
    </tr>
  </table>
</form>