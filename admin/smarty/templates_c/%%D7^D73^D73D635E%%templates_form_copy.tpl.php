<?php /* Smarty version 2.6.26, created on 2018-09-26 06:15:22
         compiled from templates/templates_form_copy.tpl */ ?>
<?php echo '
<script language="JavaScript">
function Mysubmit(form) {
	s=form.name.value;
	if (s==\'\') {
		'; ?>

		form.name.focus(); alert("<?php echo $this->_tpl_vars['MSGTEXT']['set_tpl_filename']; ?>
"); return false
		<?php echo '
	}
	return true;
}
</script>
'; ?>


<form id="data form" action="?act=templates&do=savecopy" method="POST" onsubmit="return Mysubmit(this)" style="margin:0">
  <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
  <input type="hidden" name="tamplate_id" value="<?php echo $this->_tpl_vars['tamplates_id']; ?>
">
  <p style="margin-bottom:10"><font color="yellow"><?php echo $this->_tpl_vars['message']; ?>
</font></p>
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td>      
      <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td colspan="2"><?php echo $this->_tpl_vars['MSGTEXT']['tpl_copy_name']; ?>
 <font color="yellow">*</font><br>
              <input type="text" style="width:100%;font-weight:bold" name="name" value="<?php echo $this->_tpl_vars['name']; ?>
"></td>
          </tr>
          <?php if ($this->_tpl_vars['tags']): ?>
          <tr>
            <td colspan="2" style="height:10px"></td>
          </tr>
          <tr>
            <td nowrap><b><?php echo $this->_tpl_vars['MSGTEXT']['tag_name']; ?>
</b></td>
            <td nowrap><b><?php echo $this->_tpl_vars['MSGTEXT']['you_cat_edit_tags_caption']; ?>
</b></td>
          </tr>
          <?php $_from = $this->_tpl_vars['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tags'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tags']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['tags']['iteration']++;
?>
          <tr>
            <td nowrap><?php echo $this->_tpl_vars['item']['virtualtagname']; ?>
 </td>
            <td width="100%"><input type="text" <?php if (( $this->_tpl_vars['item']['global'] == 1 )): ?> style="color:blue;width:100%" <?php else: ?> <?php if (( $this->_tpl_vars['item']['global'] == 2 )): ?> style="color:maroon;width:100%" <?php else: ?> style="width:100%"<?php endif; ?> <?php endif; ?> name="tagid<?php echo $this->_foreach['tags']['iteration']; ?>
--<?php echo $this->_tpl_vars['item']['virtualtag_id']; ?>
" value="<?php echo $this->_tpl_vars['item']['virtualtagname']; ?>
"></td>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
          <?php endif; ?>
          <tr>
            <td></td>
            <td><input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['copy']; ?>
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