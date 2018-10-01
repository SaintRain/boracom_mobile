<?php /* Smarty version 2.6.26, created on 2018-09-14 07:58:05
         compiled from settings/settings_form_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars', 'settings/settings_form_edit.tpl', 378, false),)), $this); ?>
<?php echo '
<style>
.div_title {
	position: absolute;
	background-color: #7cb3db;
	padding: 0px 4px 0px 4px;
	margin: -8px 0px 0px 20px;
	font-weight: bold;
}
.div_content {
	border: 1px dotted #4D6E8A;
	padding: 10px 5px 10px 5px;
	height: 100%;
}
.values {
	color: yellow;
	
}
</style>

<script language="JavaScript">

function getSet(setname) {

	var xmlObject2 = getXmlHttp();

	var time 	= Math.random();

	xmlObject2.open("GET", "ajax.php?func="+setname+"&time="+time , true);

	xmlObject2.onreadystatechange = function () {

		if (xmlObject2.readyState == 4) {
			if(xmlObject2.status == 200) {
				var response = xmlObject2.responseText;
				delete xmlObject2;

				if (setname==\'checkMailConfig\') {

					GetElementById(\'email_img_reload\').style.display=\'none\';
					if(response==1) {
						GetElementById(\'email_img_error\').style.display=\'none\';
						GetElementById(\'email_img\').style.display=\'block\';
					}
					else {
						GetElementById(\'email_img_error\').style.display=\'block\';
						GetElementById(\'email_img\').style.display=\'none\';
					}

					'; ?>

					<?php if (@SETTINGS_FTP_CLIENT_HOST != '' && @SETTINGS_FTP_CLIENT_USERNAME != '' && @SETTINGS_FTP_CLIENT_PASSWORD != ''): ?>
					getSet('checkFtpConfig');
					<?php else: ?>
					GetElementById('ftp_img_error').style.display='block';
					GetElementById('ftp_img_reload').style.display='none';

					<?php endif; ?>
					<?php echo '
				}
				else if (setname==\'checkFtpConfig\') {
					GetElementById(\'ftp_img_reload\').style.display=\'none\';
					if(response==1) {
						GetElementById(\'ftp_img_error\').style.display=\'none\';
						GetElementById(\'ftp_img\').style.display=\'block\';
					}
					else {
						GetElementById(\'ftp_img_error\').style.display=\'block\';
						GetElementById(\'ftp_img\').style.display=\'none\';
					}
				}
			}
		}
	}
	xmlObject2.send(null);
}


function conf(obj) {

	if (obj.checked) {
		if (!confirm("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['settings_stat_sql']; ?>
<?php echo '")) {
			obj.checked=false;
		}
	}

	inp=GetElementById(\'max_log_file_size\');
	if (obj.checked) {
		inp.disabled=false;
	}
	else inp.disabled=true;
}


function conf2(obj) {

	if (obj.checked) {
		if (!confirm("'; ?>
<?php echo $this->_tpl_vars['MSGTEXT']['settings_stat_info']; ?>
<?php echo '")) obj.checked=false;
	}
}


function showHideEmailSettings() {
	var v=GetElementById(\'email_type\').value;
	var obj=GetElementById(\'settings_email\');

	if (v!=\'\') {
		obj.style.display=\'table-row\';
	}
	else {
		obj.style.display=\'none\';
	}
}
</script>
'; ?>


<?php if ($_GET['saved']): ?>
<p id="messagetext" style="color:yellow"><?php echo $this->_tpl_vars['MSGTEXT']['settings_saved']; ?>
</p>
<script language="JavaScript">Morphing("messagetext", true)</script> 
<?php endif; ?>
<form id="data form" action="?act=settings&do=saveedit" method="POST" style="margin:0px" enctype="multipart/form-data">
  <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
  <p style="margin-bottom:10px"><font color="yellow"><?php echo $this->_tpl_vars['error']; ?>
</font></p>
  <?php endforeach; endif; unset($_from); ?>
  <?php if ($this->_tpl_vars['flash_result']): ?>
  <p style="margin-bottom:10px"><font color="yellow"><?php if ($this->_tpl_vars['flash_result']): ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_memcache_flash_res_true']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_memcache_flash_res_false']; ?>
<?php endif; ?></font></p>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['friendly_url_flash_result']): ?>
  <p style="margin-bottom:10px"><font color="yellow"><?php if ($this->_tpl_vars['friendly_url_flash_result']): ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_friendly_url_flash_res_true']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_friendly_url_flash_res_false']; ?>
<?php endif; ?></font></p>
  <?php endif; ?>
    
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr><td>
      <table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
        <tr>
        <td>
          <table class="formbackground" style="width:100%" border="0" cellpadding="2" cellspacing="2">
          
            <tr>
              <td style="width:150px"><?php echo $this->_tpl_vars['MSGTEXT']['settings_url_domain_name']; ?>
 </td>
              <td><input type="text" style="width:100%" name="http_host" value="<?php echo @SETTINGS_HTTP_HOST; ?>
"></td>
            </tr>          
            <!--
            <tr>
              <td style="width:150px"><?php echo $this->_tpl_vars['MSGTEXT']['settings_url_check_license']; ?>
 </td>
              <td><input type="text" style="width:100%" name="activated_url_check" value="<?php echo @SETTINGS_LICENSE_URL_CHECK; ?>
"></td>
            </tr>
            -->
            <tr>
              <td style="width:150px"><?php echo $this->_tpl_vars['MSGTEXT']['settings_registration_update']; ?>
 </td>
              <td><input type="text" style="width:100%" name="update_url" value="<?php echo @SETTINGS_UPDATE_URL; ?>
"></td>
            </tr>

            <tr>
              <td><?php echo $this->_tpl_vars['MSGTEXT']['settings_index_page']; ?>
</td>
              </td>
            
              <td><select name="index_page" id="index_page" style="width:100%">
                  <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['settings_no_page']; ?>
</option>                  
			<?php if ($this->_tpl_vars['userPages']): ?>
				<?php $_from = $this->_tpl_vars['userPages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                  <option value="<?php echo $this->_tpl_vars['list']['name']; ?>
" <?php if (@SETTINGS_INDEX_PAGE == $this->_tpl_vars['list']['name']): ?> selected <?php endif; ?>> <?php echo $this->_tpl_vars['list']['name']; ?>
<?php if ($this->_tpl_vars['list']['description'] != ''): ?> - <?php echo $this->_tpl_vars['list']['description']; ?>
<?php endif; ?></option>                  
				<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $this->_tpl_vars['MSGTEXT']['settings_page400']; ?>
: </td>
              </td>            
              <td><select name="error_400" id="page_category" style="width:100%">
                  <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['settings_no_page400']; ?>
</option>                  
			<?php if ($this->_tpl_vars['userPages']): ?>
				<?php $_from = $this->_tpl_vars['userPages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                  <option value="<?php echo $this->_tpl_vars['list']['name']; ?>
" <?php if (@SETTINGS_ERORR_PAGE_400 == $this->_tpl_vars['list']['name']): ?> selected <?php endif; ?>> <?php echo $this->_tpl_vars['list']['name']; ?>
<?php if ($this->_tpl_vars['list']['description'] != ''): ?> - <?php echo $this->_tpl_vars['list']['description']; ?>
<?php endif; ?></option>                  
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
                </select>
                </td>
            </tr>
            <tr>
              <td><?php echo $this->_tpl_vars['MSGTEXT']['settings_page404']; ?>
: </td>
                </td>
              <td><select name="error_404" id="page_category" style="width:100%">
                  <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['settings_no_page404']; ?>
</option>
			<?php if ($this->_tpl_vars['userPages']): ?>
				<?php $_from = $this->_tpl_vars['userPages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                  <option value="<?php echo $this->_tpl_vars['list']['name']; ?>
" <?php if (@SETTINGS_ERORR_PAGE_404 == $this->_tpl_vars['list']['name']): ?> selected <?php endif; ?>> <?php echo $this->_tpl_vars['list']['name']; ?>
<?php if ($this->_tpl_vars['list']['description'] != ''): ?> - <?php echo $this->_tpl_vars['list']['description']; ?>
<?php endif; ?></option>                  
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
                </select>
                </td>
            </tr>
            <tr>
              <td><?php echo $this->_tpl_vars['MSGTEXT']['settings_page500']; ?>
: </td>
                </td>
              <td><select name="error_500" id="page_category" style="width:100%">
                  <option value="" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['settings_no_page500']; ?>
</option>                  
			<?php if ($this->_tpl_vars['userPages']): ?>
				<?php $_from = $this->_tpl_vars['userPages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
                  <option value="<?php echo $this->_tpl_vars['list']['name']; ?>
" <?php if (@SETTINGS_ERORR_PAGE_500 == $this->_tpl_vars['list']['name']): ?> selected <?php endif; ?>> <?php echo $this->_tpl_vars['list']['name']; ?>
<?php if ($this->_tpl_vars['list']['description'] != ''): ?> - <?php echo $this->_tpl_vars['list']['description']; ?>
<?php endif; ?></option>                  
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
                </select>
                </td>
            </tr>
            <tr>
              <td style="width:150px"><?php echo $this->_tpl_vars['MSGTEXT']['settings_update_cache']; ?>
</td>
              <td>
				<table cellpadding="0" cellspacing="0" border="0">
                <tr>              
                <td width="250px"><input type="text" style="width:100px" name="cach_refresh_period" value="<?php echo @SETTINGS_CACHE_REFRESH_PERIOD; ?>
">&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['settings_update_cache_sec']; ?>
</td>              	
                <?php if ($this->_tpl_vars['setups']['memcache'] == 1): ?>                
                <td>
					<table style="margin-left:50px;" cellpadding="0" cellspacing="0" border="0">
                    	<tr>
                    	<td><a title="<?php echo $this->_tpl_vars['MSGTEXT']['settings_memcache_flash']; ?>
" href="javascript: if (confirm('<?php echo $this->_tpl_vars['MSGTEXT']['settings_memcache_flash_confirm']; ?>
')) location.href='?act=settings&flash_memcache=true'"><img src="images/trashblue.png" border="0"></a></td>
                    	<td>&nbsp;&nbsp;<a style="font-weight:bold" href="javascript: if (confirm('<?php echo $this->_tpl_vars['MSGTEXT']['settings_memcache_flash_confirm']; ?>
')) location.href='?act=settings&flash_memcache=true'"><?php echo $this->_tpl_vars['MSGTEXT']['settings_memcache_flash']; ?>
</a></td>
                    	</tr>
                    </table>                    	                
                </td>                     	                                
                <?php endif; ?>
                </tr>
                </table>                  
                </td>    	
            </tr>
            <tr>
              <td style="width:150px"><?php echo $this->_tpl_vars['MSGTEXT']['settings_timezone']; ?>
</td>
              <td valign="top"><input type="text" style="width:100px" name="timezone" value="<?php echo @SETTINGS_TIMEZONE; ?>
">
                <?php echo $this->_tpl_vars['MSGTEXT']['settings_timezone_example']; ?>
</td>
            </tr>
            <tr>
              <td style="width:150px"></td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td><table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td><input onclick="conf(this)" type="checkbox" class="checkbox" name="sql_requests_analize" value="1" <?php if (@SETTINGS_LOG_SQL_REQUESTS == 1): ?> checked<?php endif; ?>></td>
                          <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['settings_stat_sql_check']; ?>
</td>
                        </tr>
                      </table>
                      </td>
                    <td width="10px"></td>
                    <td valign="middle"><input type="text" <?php if (@SETTINGS_LOG_SQL_REQUESTS == 0): ?> disabled<?php endif; ?> style="width:100px" name="max_log_file_size" id="max_log_file_size" value="<?php echo @SETTINGS_LOG_SQL_MAX_FILE_SIZE; ?>
"></td>
                    <td width="5px"></td>
                    <td><?php echo $this->_tpl_vars['MSGTEXT']['settings_max_file_size_stat']; ?>
</td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px"></td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td><input onclick="conf2(this)" type="checkbox" class="checkbox" name="show_errors" value="1" <?php if (@SETTINGS_SHOW_ERRORS == 1): ?> checked<?php endif; ?>></td>
                    <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['settings_on_error']; ?>
</td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px"></td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td><input type="checkbox" class="checkbox" name="fast_edit_mode" value="1" <?php if (@SETTINGS_FAST_EDIT_MODE == 1): ?> checked<?php endif; ?>></td>
                    <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['settings_fast_edit_one']; ?>
</td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px"></td>
              <td>
              <table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td><input type="checkbox" class="checkbox" name="friendly_url" value="1" <?php if (@SETTINGS_FRIENDLY_URL == 1): ?> checked<?php endif; ?>></td>
                    <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['settings_friendly_url']; ?>
</td>
                    <td width="5px"></td>
                    <td width="50px" valign="middle"><a href="?act=friendly_url_rules&page"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['settings_friendly_rules']; ?>
" hspace="0px" src="images/editlist.png"></a></td>
                    <td>
                    	<table style="margin-left:50px;" cellpadding="0" cellspacing="0" border="0">
                    	<tr>
                    	<td><a title="<?php echo $this->_tpl_vars['MSGTEXT']['settings_friendly_url_flash']; ?>
" style="font-weight:bold" href="javascript: if (confirm('<?php echo $this->_tpl_vars['MSGTEXT']['settings_friendly_url_flash_confirm']; ?>
')) location.href='?act=settings&friendly_url_flash=true'"><img src="images/trashblue.png" border="0"></a></td>
                    	<td>&nbsp;&nbsp;<a style="font-weight:bold" href="javascript: if (confirm('<?php echo $this->_tpl_vars['MSGTEXT']['settings_friendly_url_flash_confirm']; ?>
')) location.href='?act=settings&friendly_url_flash=true'"><?php echo $this->_tpl_vars['MSGTEXT']['settings_friendly_url_flash']; ?>
</a></td>
                    	</tr>
                    	</table>
                    </td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px" valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['settings_editor']; ?>
</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td height="28px" valign="middle"><input type="radio" <?php if (@SETTINGS_EDITOR_TYPE == 'ckeditor'): ?> checked <?php endif; ?> name="editor_type" value="ckeditor" style="margin:0"></td>
                    <td valign="middle">&nbsp;CKEditor</td>
                  </tr>
                  <tr>
                    <td height="28px" valign="middle"><input type="radio" <?php if (@SETTINGS_EDITOR_TYPE == 'tinymce'): ?> checked <?php endif; ?> name="editor_type" value="tinymce" style="margin:0"></td>
                    <td>&nbsp;TinyMCE</td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px" valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['settings_language']; ?>
</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td height="28px" valign="top">
                    <select name="lang" style="width:200px">                        
					<?php $_from = $this->_tpl_vars['langs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['file_name'] => $this->_tpl_vars['item']):
?>
                        <option <?php if ($this->_tpl_vars['file_name'] == @SETTINGS_LANGUAGE): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['file_name']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>                        
					<?php endforeach; endif; unset($_from); ?>
                      </select>
                      </td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px" valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['settings_language_default']; ?>
</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td height="28px" valign="top"><select name="lang_default" style="width:200px">                        
					<?php $_from = $this->_tpl_vars['LANGUAGES_OF_MATERIAL']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prefix'] => $this->_tpl_vars['item']):
?>
                        <option <?php if ($this->_tpl_vars['prefix'] == @SETTINGS_LANGUAGE_OF_MATERIALS_DEFAULT): ?> selected <?php endif; ?> value="<?php echo $this->_tpl_vars['prefix']; ?>
"><?php echo $this->_tpl_vars['item']['caption']; ?>
</option>                        
					<?php endforeach; endif; unset($_from); ?>
                      </select>
                      </td>
                    <td width="5px"></td>
                    <td valign="top"><a href="?act=languagesofmaterial&page"><img border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['settings_lang_edit']; ?>
" hspace="0px" src="images/editlist.png"></a></td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px" valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['settings_watermark_title']; ?>
</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <?php if (@SETTINGS_WATERMARK_FILENAME): ?>
                  <tr>
                    <td align="left" valign="middle"><a target="_blank" href="upload_tmp/<?php echo @SETTINGS_WATERMARK_FILENAME; ?>
"><img class="ramka" src="upload_tmp/<?php echo @SETTINGS_WATERMARK_FILENAME; ?>
"></a><br></td>
                    <td valign="middle" align="left">&nbsp;
                      <input type="checkbox"  value="1" name="delete_watermark"></td>
                    <td valign="middle" align="left">&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['settings_watermark_delete']; ?>
</td>
                  </tr>                  
                  <?php endif; ?>
                  <tr>
                    <td colspan="100%" height="5px" align="left" valign="middle"></td>
                  </tr>
                  
                  <tr>
                    <td colspan="100%" align="left" valign="middle"><input style="width:200px" type="file" name="watermark_filename"></td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px" valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['settings_email_type']; ?>
</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td height="28px" valign="top"><select onchange="showHideEmailSettings()"  name="email_type" id="email_type" style="width:200px">
                        <option <?php if (@SETTINGS_EMAIL_TYPE == ''): ?> selected <?php endif; ?> value=""><?php echo $this->_tpl_vars['MSGTEXT']['settings_email_bez_avtor']; ?>
</option>
                        <option <?php if (@SETTINGS_EMAIL_TYPE == 'smtp'): ?> selected <?php endif; ?> value="smtp"><?php echo $this->_tpl_vars['MSGTEXT']['settings_email_cherez_smtp']; ?>
</option>
                        <!--
                        <option <?php if (@SETTINGS_EMAIL_TYPE == 'pop3'): ?> selected <?php endif; ?> value="pop3">Через сервер POP3</option>
                        -->
                      </select>
                      </td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr id="settings_email" <?php if (@SETTINGS_EMAIL_TYPE == ''): ?> style="display:none"<?php else: ?>style="display:table-row"<?php endif; ?>>
              <td style="width:150px" valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['settings_email_settings']; ?>
</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td> <?php echo $this->_tpl_vars['MSGTEXT']['settings_email_caption']; ?>
<br>
                      <input type="text" style="width:130px" name="email_caption" value="<?php echo ((is_array($_tmp=@SETTINGS_EMAIL_CAPTION)) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" ></td>
                    <td width="10px"></td>
                    <td valign="middle"><?php echo $this->_tpl_vars['MSGTEXT']['settings_email_host']; ?>
<br>
                      <input type="text" style="width:130px" name="email_host" value="<?php echo ((is_array($_tmp=@SETTINGS_EMAIL_HOST)) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" ></td>
                    <td width="10px"></td>
                    <td valign="middle"><?php echo $this->_tpl_vars['MSGTEXT']['settings_email_port']; ?>
<br>
                      <input type="text" style="width:130px" name="email_port" value="<?php echo ((is_array($_tmp=@SETTINGS_EMAIL_PORT)) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" ></td>
                    <td width="10px"></td>
                    <td valign="middle"><?php echo $this->_tpl_vars['MSGTEXT']['settings_email_username']; ?>
<br>
                      <input type="text" style="width:130px" name="email_username" value="<?php echo ((is_array($_tmp=@SETTINGS_EMAIL_USERNAME)) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" ></td>
                    <td width="10px"></td>
                    <td valign="middle"><?php echo $this->_tpl_vars['MSGTEXT']['settings_email_password']; ?>
<br>
                      <input style="width:130px" type="password" name="email_password" value="<?php echo ((is_array($_tmp=@SETTINGS_EMAIL_PASSWORD)) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" ></td>
                    <td width="10px"></td>
                    <td valign="bottom"><img id="email_img_reload" src="images/reload.gif"><img style="display:none" id="email_img" border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['settings_email_is_connect']; ?>
" src="images/email_accept.png"><img style="display:none" id="email_img_error" border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['settings_email_no_connect']; ?>
" src="images/email_error.png"></td>
                  <tr>
                    <td  colspan="100%" valign="middle"><table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td><input <?php if (@SETTINGS_EMAIL_SSL == 1): ?> checked <?php endif; ?> type="checkbox" class="checkbox" name="email_ssl" value="1"></td>
                          <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['settings_email_ssl']; ?>
</td>
                        </tr>
                      </table>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px" valign="top"><?php echo $this->_tpl_vars['MSGTEXT']['settings_ftp_settings']; ?>
</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td valign="middle"><?php echo $this->_tpl_vars['MSGTEXT']['settings_ftp_host']; ?>
<br>
                      <input type="text" style="width:130px" name="ftp_client_host" value="<?php echo ((is_array($_tmp=@SETTINGS_FTP_CLIENT_HOST)) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" ></td>
                    <td width="10px"></td>
                    <td valign="middle"><?php echo $this->_tpl_vars['MSGTEXT']['settings_ftp_username']; ?>
<br>
                      <input type="text" style="width:130px" name="ftp_client_username" value="<?php echo ((is_array($_tmp=@SETTINGS_FTP_CLIENT_USERNAME)) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" ></td>
                    <td width="10px"></td>
                    <td valign="middle"><?php echo $this->_tpl_vars['MSGTEXT']['settings_ftp_password']; ?>
<br>
                      <input style="width:130px" type="password" name="ftp_client_password" value="<?php echo ((is_array($_tmp=@SETTINGS_FTP_CLIENT_PASSWORD)) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" ></td>
                    <td width="10px"></td>
                    <td valign="bottom"><img id="ftp_img_reload" src="images/reload.gif"><img style="display:none" id="ftp_img" border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['settings_ftp_is_connect']; ?>
" src="images/ftp_accept.png"><img style="display:none" id="ftp_img_error" border="0" title="<?php echo $this->_tpl_vars['MSGTEXT']['settings_ftp_no_connect']; ?>
" src="images/ftp_error.png"></td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td colspan="100%" height="10px"></td>
            </tr>
            <tr>
              <td></td>
              <td><input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['settings_save']; ?>
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
<br>
<br>
<table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div> <span class="div_title"><?php echo $this->_tpl_vars['MSGTEXT']['settings_tehnical_data']; ?>
</span>
        <div class="div_content">
          <table border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td valign="top"><a target="_blank" href="phpinfo.php"><?php echo $this->_tpl_vars['MSGTEXT']['settings_php_ver']; ?>
</a>: <span class="values"><?php echo $this->_tpl_vars['setups']['phpversion']; ?>
</span> <br>
                <?php echo $this->_tpl_vars['MSGTEXT']['settings_mysql_ver']; ?>
: <span class="values"><?php echo $this->_tpl_vars['setups']['mysqlversion']; ?>
</span> <br>
                <?php echo $this->_tpl_vars['MSGTEXT']['settings_gd_ver']; ?>
: <span class="values"><?php echo $this->_tpl_vars['setups']['gdversion']; ?>
</span> <br>
                <?php echo $this->_tpl_vars['MSGTEXT']['settings_max_update_filesize']; ?>
: <span class="values"><?php echo $this->_tpl_vars['setups']['maxloadfilesize']; ?>
</span> <br>
                <?php echo $this->_tpl_vars['MSGTEXT']['settings_max_exec_time']; ?>
: <span class="values"><?php echo $this->_tpl_vars['setups']['maxexecutetime']; ?>
 <?php echo $this->_tpl_vars['MSGTEXT']['settings_in_seconds']; ?>
</span></td>
              <td style="padding-left:20px" valign="top"> <?php echo $this->_tpl_vars['MSGTEXT']['settings_available_space']; ?>
: <span class="values"><?php echo $this->_tpl_vars['setups']['free_space']; ?>
М</span> <br>
                <?php echo $this->_tpl_vars['MSGTEXT']['settings_available_memory']; ?>
: <span class="values"><?php echo $this->_tpl_vars['setups']['memory_limit']; ?>
</span> <br>
                <?php echo $this->_tpl_vars['MSGTEXT']['settings_protected_mode']; ?>
 (SAFE_MODE): <span class="values"><?php if ($this->_tpl_vars['setups']['safe_mode']): ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_on']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_off']; ?>
<?php endif; ?></span> <br>
                REGISTER_GLOBALS: <span class="values"><?php if ($this->_tpl_vars['setups']['register_globals']): ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_on']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_off']; ?>
<?php endif; ?></span> <br>
                MAGIC_QUOTES_GPC: <span class="values"><?php if ($this->_tpl_vars['setups']['magic_quotes_gpc']): ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_on']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_off']; ?>
<?php endif; ?></span></td>
              <td style="padding-left:20px" valign="top"> <?php echo $this->_tpl_vars['MSGTEXT']['settings_ftp']; ?>
 <span class="values"><?php if ($this->_tpl_vars['setups']['ftp'] == 1): ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_ftp_on']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_ftp_off']; ?>
<?php endif; ?></span>
              <br>
                <?php echo $this->_tpl_vars['MSGTEXT']['settings_memcache']; ?>
 <span class="values"><?php if ($this->_tpl_vars['setups']['memcache'] == 1): ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_memcache_on']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['settings_memcache_off']; ?>
<?php endif; ?></span> <br>
                <?php echo $this->_tpl_vars['MSGTEXT']['settings_gt_time']; ?>
 : <span class="values"><?php echo $this->_tpl_vars['setups']['server_time']; ?>
</span> <br>
                <?php echo $this->_tpl_vars['MSGTEXT']['settings_tmp_dir']; ?>
: <span class="values"><?php echo $this->_tpl_vars['setups']['upload_tmp_dir']; ?>
</span> <br>
                <?php echo $this->_tpl_vars['MSGTEXT']['settings_way_save_session']; ?>
: <span class="values"><?php echo $this->_tpl_vars['setups']['session_save_path']; ?>
</span></td>
            </tr>
          </table>
        </div>
      </div>
      </td>
  </tr>
</table>

<script language="JavaScript">
<?php if (@SETTINGS_EMAIL_TYPE == 'smtp' && @SETTINGS_EMAIL_HOST != '' && @SETTINGS_EMAIL_USERNAME != '' && @SETTINGS_EMAIL_PASSWORD != ''): ?>
getSet('checkMailConfig');
<?php else: ?>
GetElementById('email_img_error').style.display='block';
GetElementById('email_img_reload').style.display='none';

<?php if (@SETTINGS_FTP_CLIENT_HOST != '' && @SETTINGS_FTP_CLIENT_USERNAME != '' && @SETTINGS_FTP_CLIENT_PASSWORD != ''): ?>
getSet('checkFtpConfig');
<?php else: ?>
GetElementById('ftp_img_error').style.display='block';
GetElementById('ftp_img_reload').style.display='none';
<?php endif; ?>
<?php endif; ?>
</script>