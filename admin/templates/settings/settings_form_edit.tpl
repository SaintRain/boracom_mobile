{literal}
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

				if (setname=='checkMailConfig') {

					GetElementById('email_img_reload').style.display='none';
					if(response==1) {
						GetElementById('email_img_error').style.display='none';
						GetElementById('email_img').style.display='block';
					}
					else {
						GetElementById('email_img_error').style.display='block';
						GetElementById('email_img').style.display='none';
					}

					{/literal}
					{if $smarty.const.SETTINGS_FTP_CLIENT_HOST!='' && $smarty.const.SETTINGS_FTP_CLIENT_USERNAME!='' && $smarty.const.SETTINGS_FTP_CLIENT_PASSWORD!=''}
					getSet('checkFtpConfig');
					{else}
					GetElementById('ftp_img_error').style.display='block';
					GetElementById('ftp_img_reload').style.display='none';

					{/if}
					{literal}
				}
				else if (setname=='checkFtpConfig') {
					GetElementById('ftp_img_reload').style.display='none';
					if(response==1) {
						GetElementById('ftp_img_error').style.display='none';
						GetElementById('ftp_img').style.display='block';
					}
					else {
						GetElementById('ftp_img_error').style.display='block';
						GetElementById('ftp_img').style.display='none';
					}
				}
			}
		}
	}
	xmlObject2.send(null);
}


function conf(obj) {

	if (obj.checked) {
		if (!confirm("{/literal}{$MSGTEXT.settings_stat_sql}{literal}")) {
			obj.checked=false;
		}
	}

	inp=GetElementById('max_log_file_size');
	if (obj.checked) {
		inp.disabled=false;
	}
	else inp.disabled=true;
}


function conf2(obj) {

	if (obj.checked) {
		if (!confirm("{/literal}{$MSGTEXT.settings_stat_info}{literal}")) obj.checked=false;
	}
}


function showHideEmailSettings() {
	var v=GetElementById('email_type').value;
	var obj=GetElementById('settings_email');

	if (v!='') {
		obj.style.display='table-row';
	}
	else {
		obj.style.display='none';
	}
}
</script>
{/literal}

{if $smarty.get.saved}
<p id="messagetext" style="color:yellow">{$MSGTEXT.settings_saved}</p>
<script language="JavaScript">Morphing("messagetext", true)</script> 
{/if}
<form id="data form" action="?act=settings&do=saveedit" method="POST" style="margin:0px" enctype="multipart/form-data">
  {foreach from=$errors item=error}
  <p style="margin-bottom:10px"><font color="yellow">{$error}</font></p>
  {/foreach}
  {if $flash_result}
  <p style="margin-bottom:10px"><font color="yellow">{if $flash_result}{$MSGTEXT.settings_memcache_flash_res_true}{else}{$MSGTEXT.settings_memcache_flash_res_false}{/if}</font></p>
  {/if}
  
  {if $friendly_url_flash_result}
  <p style="margin-bottom:10px"><font color="yellow">{if $friendly_url_flash_result}{$MSGTEXT.settings_friendly_url_flash_res_true}{else}{$MSGTEXT.settings_friendly_url_flash_res_false}{/if}</font></p>
  {/if}
    
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr><td>
      <table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
        <tr>
        <td>
          <table class="formbackground" style="width:100%" border="0" cellpadding="2" cellspacing="2">
          
            <tr>
              <td style="width:150px">{$MSGTEXT.settings_url_domain_name} </td>
              <td><input type="text" style="width:100%" name="http_host" value="{$smarty.const.SETTINGS_HTTP_HOST}"></td>
            </tr>          
            <!--
            <tr>
              <td style="width:150px">{$MSGTEXT.settings_url_check_license} </td>
              <td><input type="text" style="width:100%" name="activated_url_check" value="{$smarty.const.SETTINGS_LICENSE_URL_CHECK}"></td>
            </tr>
            -->
            <tr>
              <td style="width:150px">{$MSGTEXT.settings_registration_update} </td>
              <td><input type="text" style="width:100%" name="update_url" value="{$smarty.const.SETTINGS_UPDATE_URL}"></td>
            </tr>

            <tr>
              <td>{$MSGTEXT.settings_index_page}</td>
              </td>
            
              <td><select name="index_page" id="index_page" style="width:100%">
                  <option value="0" style="color:gray">{$MSGTEXT.settings_no_page}</option>                  
			{if $userPages}
				{foreach from=$userPages item=list}
                  <option value="{$list.name}" {if $smarty.const.SETTINGS_INDEX_PAGE==$list.name} selected {/if}> {$list.name}{if $list.description!=''} - {$list.description}{/if}</option>                  
				{/foreach}
				{/if}
                </select></td>
            </tr>
            <tr>
              <td>{$MSGTEXT.settings_page400}: </td>
              </td>            
              <td><select name="error_400" id="page_category" style="width:100%">
                  <option value="0" style="color:gray">{$MSGTEXT.settings_no_page400}</option>                  
			{if $userPages}
				{foreach from=$userPages item=list}
                  <option value="{$list.name}" {if $smarty.const.SETTINGS_ERORR_PAGE_400==$list.name} selected {/if}> {$list.name}{if $list.description!=''} - {$list.description}{/if}</option>                  
				{/foreach}
			{/if}
                </select>
                </td>
            </tr>
            <tr>
              <td>{$MSGTEXT.settings_page404}: </td>
                </td>
              <td><select name="error_404" id="page_category" style="width:100%">
                  <option value="0" style="color:gray">{$MSGTEXT.settings_no_page404}</option>
			{if $userPages}
				{foreach from=$userPages item=list}
                  <option value="{$list.name}" {if $smarty.const.SETTINGS_ERORR_PAGE_404==$list.name} selected {/if}> {$list.name}{if $list.description!=''} - {$list.description}{/if}</option>                  
				{/foreach}
			{/if}
                </select>
                </td>
            </tr>
            <tr>
              <td>{$MSGTEXT.settings_page500}: </td>
                </td>
              <td><select name="error_500" id="page_category" style="width:100%">
                  <option value="" style="color:gray">{$MSGTEXT.settings_no_page500}</option>                  
			{if $userPages}
				{foreach from=$userPages item=list}
                  <option value="{$list.name}" {if $smarty.const.SETTINGS_ERORR_PAGE_500==$list.name} selected {/if}> {$list.name}{if $list.description!=''} - {$list.description}{/if}</option>                  
				{/foreach}
			{/if}
                </select>
                </td>
            </tr>
            <tr>
              <td style="width:150px">{$MSGTEXT.settings_update_cache}</td>
              <td>
				<table cellpadding="0" cellspacing="0" border="0">
                <tr>              
                <td width="250px"><input type="text" style="width:100px" name="cach_refresh_period" value="{$smarty.const.SETTINGS_CACHE_REFRESH_PERIOD}">&nbsp;{$MSGTEXT.settings_update_cache_sec}</td>              	
                {if $setups.memcache==1}                
                <td>
					<table style="margin-left:50px;" cellpadding="0" cellspacing="0" border="0">
                    	<tr>
                    	<td><a title="{$MSGTEXT.settings_memcache_flash}" href="javascript: if (confirm('{$MSGTEXT.settings_memcache_flash_confirm}')) location.href='?act=settings&flash_memcache=true'"><img src="images/trashblue.png" border="0"></a></td>
                    	<td>&nbsp;&nbsp;<a style="font-weight:bold" href="javascript: if (confirm('{$MSGTEXT.settings_memcache_flash_confirm}')) location.href='?act=settings&flash_memcache=true'">{$MSGTEXT.settings_memcache_flash}</a></td>
                    	</tr>
                    </table>                    	                
                </td>                     	                                
                {/if}
                </tr>
                </table>                  
                </td>    	
            </tr>
            <tr>
              <td style="width:150px">{$MSGTEXT.settings_timezone}</td>
              <td valign="top"><input type="text" style="width:100px" name="timezone" value="{$smarty.const.SETTINGS_TIMEZONE}">
                {$MSGTEXT.settings_timezone_example}</td>
            </tr>
            <tr>
              <td style="width:150px"></td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td><table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td><input onclick="conf(this)" type="checkbox" class="checkbox" name="sql_requests_analize" value="1" {if $smarty.const.SETTINGS_LOG_SQL_REQUESTS==1} checked{/if}></td>
                          <td>&nbsp;{$MSGTEXT.settings_stat_sql_check}</td>
                        </tr>
                      </table>
                      </td>
                    <td width="10px"></td>
                    <td valign="middle"><input type="text" {if $smarty.const.SETTINGS_LOG_SQL_REQUESTS==0} disabled{/if} style="width:100px" name="max_log_file_size" id="max_log_file_size" value="{$smarty.const.SETTINGS_LOG_SQL_MAX_FILE_SIZE}"></td>
                    <td width="5px"></td>
                    <td>{$MSGTEXT.settings_max_file_size_stat}</td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px"></td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td><input onclick="conf2(this)" type="checkbox" class="checkbox" name="show_errors" value="1" {if $smarty.const.SETTINGS_SHOW_ERRORS==1} checked{/if}></td>
                    <td>&nbsp;{$MSGTEXT.settings_on_error}</td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px"></td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td><input type="checkbox" class="checkbox" name="fast_edit_mode" value="1" {if $smarty.const.SETTINGS_FAST_EDIT_MODE==1} checked{/if}></td>
                    <td>&nbsp;{$MSGTEXT.settings_fast_edit_one}</td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px"></td>
              <td>
              <table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td><input type="checkbox" class="checkbox" name="friendly_url" value="1" {if $smarty.const.SETTINGS_FRIENDLY_URL==1} checked{/if}></td>
                    <td>&nbsp;{$MSGTEXT.settings_friendly_url}</td>
                    <td width="5px"></td>
                    <td width="50px" valign="middle"><a href="?act=friendly_url_rules&page"><img border="0" title="{$MSGTEXT.settings_friendly_rules}" hspace="0px" src="images/editlist.png"></a></td>
                    <td>
                    	<table style="margin-left:50px;" cellpadding="0" cellspacing="0" border="0">
                    	<tr>
                    	<td><a title="{$MSGTEXT.settings_friendly_url_flash}" style="font-weight:bold" href="javascript: if (confirm('{$MSGTEXT.settings_friendly_url_flash_confirm}')) location.href='?act=settings&friendly_url_flash=true'"><img src="images/trashblue.png" border="0"></a></td>
                    	<td>&nbsp;&nbsp;<a style="font-weight:bold" href="javascript: if (confirm('{$MSGTEXT.settings_friendly_url_flash_confirm}')) location.href='?act=settings&friendly_url_flash=true'">{$MSGTEXT.settings_friendly_url_flash}</a></td>
                    	</tr>
                    	</table>
                    </td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px" valign="top">{$MSGTEXT.settings_editor}</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td height="28px" valign="middle"><input type="radio" {if $smarty.const.SETTINGS_EDITOR_TYPE=='ckeditor'} checked {/if} name="editor_type" value="ckeditor" style="margin:0"></td>
                    <td valign="middle">&nbsp;CKEditor</td>
                  </tr>
                  <tr>
                    <td height="28px" valign="middle"><input type="radio" {if $smarty.const.SETTINGS_EDITOR_TYPE=='tinymce'} checked {/if} name="editor_type" value="tinymce" style="margin:0"></td>
                    <td>&nbsp;TinyMCE</td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px" valign="top">{$MSGTEXT.settings_language}</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td height="28px" valign="top">
                    <select name="lang" style="width:200px">                        
					{foreach key=file_name from=$langs item=item}
                        <option {if $file_name==$smarty.const.SETTINGS_LANGUAGE} selected {/if} value="{$file_name}">{$item}</option>                        
					{/foreach}
                      </select>
                      </td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px" valign="top">{$MSGTEXT.settings_language_default}</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td height="28px" valign="top"><select name="lang_default" style="width:200px">                        
					{foreach key="prefix" from=$LANGUAGES_OF_MATERIAL item=item}
                        <option {if $prefix==$smarty.const.SETTINGS_LANGUAGE_OF_MATERIALS_DEFAULT} selected {/if} value="{$prefix}">{$item.caption}</option>                        
					{/foreach}
                      </select>
                      </td>
                    <td width="5px"></td>
                    <td valign="top"><a href="?act=languagesofmaterial&page"><img border="0" title="{$MSGTEXT.settings_lang_edit}" hspace="0px" src="images/editlist.png"></a></td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px" valign="top">{$MSGTEXT.settings_watermark_title}</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  {if $smarty.const.SETTINGS_WATERMARK_FILENAME}
                  <tr>
                    <td align="left" valign="middle"><a target="_blank" href="upload_tmp/{$smarty.const.SETTINGS_WATERMARK_FILENAME}"><img class="ramka" src="upload_tmp/{$smarty.const.SETTINGS_WATERMARK_FILENAME}"></a><br></td>
                    <td valign="middle" align="left">&nbsp;
                      <input type="checkbox"  value="1" name="delete_watermark"></td>
                    <td valign="middle" align="left">&nbsp;{$MSGTEXT.settings_watermark_delete}</td>
                  </tr>                  
                  {/if}
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
              <td style="width:150px" valign="top">{$MSGTEXT.settings_email_type}</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td height="28px" valign="top"><select onchange="showHideEmailSettings()"  name="email_type" id="email_type" style="width:200px">
                        <option {if $smarty.const.SETTINGS_EMAIL_TYPE==''} selected {/if} value="">{$MSGTEXT.settings_email_bez_avtor}</option>
                        <option {if $smarty.const.SETTINGS_EMAIL_TYPE=='smtp'} selected {/if} value="smtp">{$MSGTEXT.settings_email_cherez_smtp}</option>
                        <!--
                        <option {if  $smarty.const.SETTINGS_EMAIL_TYPE=='pop3'} selected {/if} value="pop3">Через сервер POP3</option>
                        -->
                      </select>
                      </td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr id="settings_email" {if $smarty.const.SETTINGS_EMAIL_TYPE==''} style="display:none"{else}style="display:table-row"{/if}>
              <td style="width:150px" valign="top">{$MSGTEXT.settings_email_settings}</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td> {$MSGTEXT.settings_email_caption}<br>
                      <input type="text" style="width:130px" name="email_caption" value="{$smarty.const.SETTINGS_EMAIL_CAPTION|htmlspecialchars}" ></td>
                    <td width="10px"></td>
                    <td valign="middle">{$MSGTEXT.settings_email_host}<br>
                      <input type="text" style="width:130px" name="email_host" value="{$smarty.const.SETTINGS_EMAIL_HOST|htmlspecialchars}" ></td>
                    <td width="10px"></td>
                    <td valign="middle">{$MSGTEXT.settings_email_port}<br>
                      <input type="text" style="width:130px" name="email_port" value="{$smarty.const.SETTINGS_EMAIL_PORT|htmlspecialchars}" ></td>
                    <td width="10px"></td>
                    <td valign="middle">{$MSGTEXT.settings_email_username}<br>
                      <input type="text" style="width:130px" name="email_username" value="{$smarty.const.SETTINGS_EMAIL_USERNAME|htmlspecialchars}" ></td>
                    <td width="10px"></td>
                    <td valign="middle">{$MSGTEXT.settings_email_password}<br>
                      <input style="width:130px" type="password" name="email_password" value="{$smarty.const.SETTINGS_EMAIL_PASSWORD|htmlspecialchars}" ></td>
                    <td width="10px"></td>
                    <td valign="bottom"><img id="email_img_reload" src="images/reload.gif"><img style="display:none" id="email_img" border="0" title="{$MSGTEXT.settings_email_is_connect}" src="images/email_accept.png"><img style="display:none" id="email_img_error" border="0" title="{$MSGTEXT.settings_email_no_connect}" src="images/email_error.png"></td>
                  <tr>
                    <td  colspan="100%" valign="middle"><table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td><input {if $smarty.const.SETTINGS_EMAIL_SSL==1} checked {/if} type="checkbox" class="checkbox" name="email_ssl" value="1"></td>
                          <td>&nbsp;{$MSGTEXT.settings_email_ssl}</td>
                        </tr>
                      </table>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td style="width:150px" valign="top">{$MSGTEXT.settings_ftp_settings}</td>
              <td><table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td valign="middle">{$MSGTEXT.settings_ftp_host}<br>
                      <input type="text" style="width:130px" name="ftp_client_host" value="{$smarty.const.SETTINGS_FTP_CLIENT_HOST|htmlspecialchars}" ></td>
                    <td width="10px"></td>
                    <td valign="middle">{$MSGTEXT.settings_ftp_username}<br>
                      <input type="text" style="width:130px" name="ftp_client_username" value="{$smarty.const.SETTINGS_FTP_CLIENT_USERNAME|htmlspecialchars}" ></td>
                    <td width="10px"></td>
                    <td valign="middle">{$MSGTEXT.settings_ftp_password}<br>
                      <input style="width:130px" type="password" name="ftp_client_password" value="{$smarty.const.SETTINGS_FTP_CLIENT_PASSWORD|htmlspecialchars}" ></td>
                    <td width="10px"></td>
                    <td valign="bottom"><img id="ftp_img_reload" src="images/reload.gif"><img style="display:none" id="ftp_img" border="0" title="{$MSGTEXT.settings_ftp_is_connect}" src="images/ftp_accept.png"><img style="display:none" id="ftp_img_error" border="0" title="{$MSGTEXT.settings_ftp_no_connect}" src="images/ftp_error.png"></td>
                  </tr>
                </table>
                </td>
            </tr>
            <tr>
              <td colspan="100%" height="10px"></td>
            </tr>
            <tr>
              <td></td>
              <td><input class="button" type="submit" value="{$MSGTEXT.settings_save}" style="width:130px"></td>
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
    <td><div> <span class="div_title">{$MSGTEXT.settings_tehnical_data}</span>
        <div class="div_content">
          <table border="0" cellpadding="2" cellspacing="2">
            <tr>
              <td valign="top"><a target="_blank" href="phpinfo.php">{$MSGTEXT.settings_php_ver}</a>: <span class="values">{$setups.phpversion}</span> <br>
                {$MSGTEXT.settings_mysql_ver}: <span class="values">{$setups.mysqlversion}</span> <br>
                {$MSGTEXT.settings_gd_ver}: <span class="values">{$setups.gdversion}</span> <br>
                {$MSGTEXT.settings_max_update_filesize}: <span class="values">{$setups.maxloadfilesize}</span> <br>
                {$MSGTEXT.settings_max_exec_time}: <span class="values">{$setups.maxexecutetime} {$MSGTEXT.settings_in_seconds}</span></td>
              <td style="padding-left:20px" valign="top"> {$MSGTEXT.settings_available_space}: <span class="values">{$setups.free_space}М</span> <br>
                {$MSGTEXT.settings_available_memory}: <span class="values">{$setups.memory_limit}</span> <br>
                {$MSGTEXT.settings_protected_mode} (SAFE_MODE): <span class="values">{if $setups.safe_mode}{$MSGTEXT.settings_on}{else}{$MSGTEXT.settings_off}{/if}</span> <br>
                REGISTER_GLOBALS: <span class="values">{if $setups.register_globals}{$MSGTEXT.settings_on}{else}{$MSGTEXT.settings_off}{/if}</span> <br>
                MAGIC_QUOTES_GPC: <span class="values">{if $setups.magic_quotes_gpc}{$MSGTEXT.settings_on}{else}{$MSGTEXT.settings_off}{/if}</span></td>
              <td style="padding-left:20px" valign="top"> {$MSGTEXT.settings_ftp} <span class="values">{if $setups.ftp==1}{$MSGTEXT.settings_ftp_on}{else}{$MSGTEXT.settings_ftp_off}{/if}</span>
              <br>
                {$MSGTEXT.settings_memcache} <span class="values">{if $setups.memcache==1}{$MSGTEXT.settings_memcache_on}{else}{$MSGTEXT.settings_memcache_off}{/if}</span> <br>
                {$MSGTEXT.settings_gt_time} : <span class="values">{$setups.server_time}</span> <br>
                {$MSGTEXT.settings_tmp_dir}: <span class="values">{$setups.upload_tmp_dir}</span> <br>
                {$MSGTEXT.settings_way_save_session}: <span class="values">{$setups.session_save_path}</span></td>
            </tr>
          </table>
        </div>
      </div>
      </td>
  </tr>
</table>

<script language="JavaScript">
{if $smarty.const.SETTINGS_EMAIL_TYPE=='smtp' && $smarty.const.SETTINGS_EMAIL_HOST!='' && $smarty.const.SETTINGS_EMAIL_USERNAME!='' && $smarty.const.SETTINGS_EMAIL_PASSWORD!=''}
getSet('checkMailConfig');
{else}
GetElementById('email_img_error').style.display='block';
GetElementById('email_img_reload').style.display='none';

{if $smarty.const.SETTINGS_FTP_CLIENT_HOST!='' && $smarty.const.SETTINGS_FTP_CLIENT_USERNAME!='' && $smarty.const.SETTINGS_FTP_CLIENT_PASSWORD!=''}
getSet('checkFtpConfig');
{else}
GetElementById('ftp_img_error').style.display='block';
GetElementById('ftp_img_reload').style.display='none';
{/if}
{/if}
</script>