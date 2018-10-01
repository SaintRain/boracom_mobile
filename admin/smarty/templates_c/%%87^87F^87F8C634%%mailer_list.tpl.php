<?php /* Smarty version 2.6.26, created on 2018-09-07 06:40:00
         compiled from mailer/mailer_list.tpl */ ?>
<script type="text/javascript" src="js/emails.js"></script>

<?php echo '
<script language="JavaScript">
function setcolor(obj) {
	obj.style.background=\'#FFF2BE\';
}


function unsetcolor(obj) {
	obj.style.background=\'white\';
}

function refresh() {
	if (confirm("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_refresh_confirm']; ?>
<?php echo '")) {
		location.href="?act=mailer&do=refresh&group_name="+GetElementById(\'group_name\').value;
	}
}


function gotoGroupEmail(obj) {
	document.location.href=\'index.php?act=mailer&page&group_name=\'+obj.value;
}


function sendMessage() {
	GetElementById(\'email_contents\').action=\'?act=mailer&do=send\';
	GetElementById(\'email_contents\').submit();
}


function saveMessage() {
	GetElementById(\'email_contents\').action=\'?act=mailer&do=save&group_name='; ?>
<?php echo $this->_tpl_vars['group_id']; ?>
<?php echo '\';
	GetElementById(\'email_contents\').submit();
}
</script>
'; ?>



<?php if ($this->_tpl_vars['group_id']): ?>
<form id="email_contents" action="?act=mailer&do=save&group_name=<?php echo $this->_tpl_vars['group_id']; ?>
" method="POST" enctype="multipart/form-data">
  <?php endif; ?>
  <table cellpadding="0" cellpadding="0" border="0">
  <tr>
    <td><b><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_groups']; ?>
</b>&nbsp;</td>
    <td valign="middle"><select onchange="gotoGroupEmail(this)" name="group_name" id="group_name" style="width:350px">
        <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_select_group']; ?>
</option>        
<?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
        <option <?php if ($this->_tpl_vars['group_id'] == $this->_tpl_vars['group']['id']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['group']['id']; ?>
"><?php echo $this->_tpl_vars['group']['email_group_name']; ?>
</option>        
<?php endforeach; endif; unset($_from); ?>
      </select></td>
    <td width="5px">&nbsp;</td>
    <td valign="middle"><a title="<?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_edit_group']; ?>
" href="javascript:getTemplate('editEmailGroup.tpl')"><img hspace="" vspace="" border="0" src="images/edit.png"></a></td>
    <td width="5px">&nbsp;</td>
    <td valign="middle"><a title="<?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_add_group']; ?>
" href="javascript:getTemplate('addEmailGroup.tpl')"><img hspace="" vspace="" border="0" src="images/add_group.png"></a></td>
  </tr>
  </table>
  <?php if ($this->_tpl_vars['group_id']): ?>
  <p style="margin-top:10px;margin-bottom:10px">
    <table cellpadding="0" cellpadding="0" border="0">
  <tr>
    <td valign="middle"><img src='images/reset.png'></td>
    <td valign="middle"><a href="javascript:refresh()"><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_refresh']; ?>
</a></td>
  </tr>
  </table>
  </p>
  <?php if ($this->_tpl_vars['msgs']): ?>
  <p id="messagetext" style="color:yellow"><?php echo $this->_tpl_vars['msgs']; ?>
</p>
  <script language="JavaScript">Morphing("messagetext", false)</script> 
  <?php endif; ?>
  <table border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr bgcolor="#ccdbe6">
      <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
          <tr class="top_list" >
            <td nowrap width="12%"><b><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_sourse_module']; ?>
</b></td>
            <td nowrap width="22%"><b><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_sourse']; ?>
</b></td>
            <td nowrap width="22%"><b><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_email']; ?>
</b></td>
            <td nowrap width="22%"><b><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_name']; ?>
</b></td>
            <td nowrap width="22%"><b><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_enable']; ?>
</b></td>
            <td nowrap align="center" width="11%"><b><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_del']; ?>
</b></td>
          </tr>
          <?php $_from = $this->_tpl_vars['mailer_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
          <tr style="height:1px"></tr>
          <tr bgcolor="white" onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)">
            <td> <?php $_from = $this->_tpl_vars['tables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
              <?php if ($this->_tpl_vars['t']['id'] == $this->_tpl_vars['list']['table_id']): ?> <?php echo $this->_tpl_vars['t']['module_name']; ?>
 <?php break; ?> <?php endif; ?>
              <?php endforeach; endif; unset($_from); ?>
              <?php echo $this->_tpl_vars['list']['module_name']; ?>
 </td>
            <td><input type="hidden" name="id[]" value="<?php echo $this->_tpl_vars['list']['id']; ?>
">
              <?php $_from = $this->_tpl_vars['tables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
              <?php if ($this->_tpl_vars['t']['id'] == $this->_tpl_vars['list']['table_id']): ?> <?php echo $this->_tpl_vars['t']['description']; ?>
 <?php break; ?> <?php endif; ?>
              <?php endforeach; endif; unset($_from); ?> </td>
            <td><select style="width:100%" name="email_<?php echo $this->_tpl_vars['list']['id']; ?>
">                
<?php $_from = $this->_tpl_vars['tables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
<?php if ($this->_tpl_vars['t']['id'] == $this->_tpl_vars['list']['table_id']): ?> 
<?php $_from = $this->_tpl_vars['t']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fields']):
?>
                <option <?php if ($this->_tpl_vars['fields']['id'] == $this->_tpl_vars['list']['email_field_id']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['fields']['id']; ?>
"><?php echo $this->_tpl_vars['fields']['comment']; ?>
</option>                
<?php endforeach; endif; unset($_from); ?>
<?php break; ?>
<?php endif; ?> 
<?php endforeach; endif; unset($_from); ?>
              </select></td>
            <td><select style="width:100%" name="name_<?php echo $this->_tpl_vars['list']['id']; ?>
">
                <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_not_set']; ?>
</option>                
<?php $_from = $this->_tpl_vars['tables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
<?php if ($this->_tpl_vars['t']['id'] == $this->_tpl_vars['list']['table_id']): ?> 
<?php $_from = $this->_tpl_vars['t']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fields']):
?>
                <option <?php if ($this->_tpl_vars['fields']['id'] == $this->_tpl_vars['list']['name_field_id']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['fields']['id']; ?>
"><?php echo $this->_tpl_vars['fields']['comment']; ?>
</option>                
<?php endforeach; endif; unset($_from); ?>
<?php break; ?>
<?php endif; ?> 
<?php endforeach; endif; unset($_from); ?>
              </select></td>
            <td><select style="width:100%" name="enable_<?php echo $this->_tpl_vars['list']['id']; ?>
">
                <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_not_set']; ?>
</option>                
<?php $_from = $this->_tpl_vars['tables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
<?php if ($this->_tpl_vars['t']['id'] == $this->_tpl_vars['list']['table_id']): ?> 
<?php $_from = $this->_tpl_vars['t']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fields']):
?>
<?php if ($this->_tpl_vars['fields']['datatype_id'] == 27): ?>
                <option <?php if ($this->_tpl_vars['fields']['id'] == $this->_tpl_vars['list']['enable_field_id']): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['fields']['id']; ?>
"><?php echo $this->_tpl_vars['fields']['comment']; ?>
</option>                
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php break; ?>
<?php endif; ?> 
<?php endforeach; endif; unset($_from); ?>
              </select></td>
            <td align="center"><input type="checkbox" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" name="delete[]"></td>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
        </table></td>
    </tr>
  </table>
  <p style="text-align:right;margin-top:5px">
    <input style="width:130px" type="button" onclick="saveMessage()" value="<?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_save']; ?>
" class="button">
  </p>
  <i><?php echo $this->_tpl_vars['finded']; ?>
</i>
  <textarea style="width:100%" rows="10">
<?php $_from = $this->_tpl_vars['emails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['email'] => $this->_tpl_vars['name']):
?>
<?php echo $this->_tpl_vars['email']; ?>

<?php endforeach; endif; unset($_from); ?>
</textarea>
  
  
  <?php if ($this->_tpl_vars['messages']): ?>
  <center>
    <?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
    <p style="color:yellow;margin:5px"><?php echo $this->_tpl_vars['item']; ?>
</p>
    <?php endforeach; endif; unset($_from); ?>
  </center>
  <?php endif; ?>
  <center>
    <i><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_vnimanie']; ?>
</i>
  </center>
  <br>
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td bgcolor="#558ab1" height="1px"></td>
    </tr>
  </table>
  <br>
  <center>
    <?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_makros_text']; ?>

  </center>
  <br>
  <table width="100%">
  <tr>
    <td><p style="margin-top:5px;margin-bottom:5px"><i><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_subject']; ?>
</i></p>
      <input type="text" name="subject" value="<?php echo $this->_tpl_vars['message']['subject']; ?>
" style="width:100%">
      <p style="margin-top:5px;margin-bottom:5px"><i><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_text']; ?>
</i></p>
      <textarea name="text" id="text" style="height:300px;width:100%"><?php echo $this->_tpl_vars['message']['message']; ?>
</textarea>
      <p style="margin-top:5px;margin-bottom:5px"><i><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_podpis']; ?>
</i></p>
      <textarea name="makros_text" id="makros_text" style="height:100;width:100%"><?php echo $this->_tpl_vars['message']['signature']; ?>
</textarea>
      <i><?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_atach']; ?>
</i><br>
      <input type="file" name="filename" style="width:100%">
      <p style="text-align:center;margin-top:10px">
        <input type="button" onclick="saveMessage()" value="<?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_save']; ?>
" class="button" style="width:130px">
        &nbsp;&nbsp;
        <input type="button" class="button" onclick="sendMessage()" value="<?php echo $this->_tpl_vars['MSGTEXT']['classesmailer_razoslat']; ?>
" style="font-weight:bold;width:130px" >
      </p>
</form>
</td>
</tr>
</table>
<?php echo $this->_tpl_vars['editorsCode']; ?>


<br>
<br>
<br>
&nbsp;
<?php endif; ?>