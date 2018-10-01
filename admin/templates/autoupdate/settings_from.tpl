<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>{$MSGTEXT.autoupdate_title}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="StyleSheet" href="css/general.css">
{literal}
<link href="SWFUpload/css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="SWFUpload/swfupload/swfupload.js"></script>
<script type="text/javascript" src="SWFUpload/swfupload/swfupload.queue.js"></script>
<script type="text/javascript" src="SWFUpload/js/fileprogress.js"></script>
<script type="text/javascript" src="SWFUpload/js/handlers.js"></script>
<script type="text/javascript">
var swfu;

window.onload = function() {

	var settings = {
		flash_url : "SWFUpload/swfupload/swfupload.swf",
		flash9_url : "SWFUpload/swfupload/swfupload_fp9.swf",
		upload_url: "autoupdate.php",
		use_query_string: true, //запрос передается в $_GET
		post_params: {{/literal}"PHPSESSID" : "{$session_id}", "loadZipFile" : "true", "update_type": "2"{literal}},
		file_size_limit : "1900 MB",
		file_types : "*.zip",
		file_types_description : "{/literal}{$MSGTEXT.edit_photos_all_files}{literal}",
		file_upload_limit : 1,
		file_queue_limit : 0,
		custom_settings : {
			progressTarget : "fsUploadProgress",
			cancelButtonId : "btnCancel"
		},
		debug: false,

		// Button settings
		button_image_url: "SWFUpload/images/file.gif",
		button_width: "61",
		button_height: "22",
		button_placeholder_id: "spanButtonPlaceHolder",
		button_text: '<span class="theFont">{/literal}{$MSGTEXT.autoupdate_select_file}{literal}</span>',
		button_text_style: ".theFont {margin:0px; font-size: 16; }",
		button_text_left_padding: 5,
		button_text_top_padding: 0,

		// The event handler functions are defined in handlers.js
		file_queued_handler : fileQueued,
		file_queue_error_handler : fileQueueError,
		file_dialog_complete_handler : fileDialogComplete,
		upload_start_handler : uploadStart,
		upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_success_handler : uploadSuccess,
		upload_complete_handler : uploadComplete,
		queue_complete_handler : function gotoNext() {window.location.href='autoupdate.php?infoForm=true';}
	};

	swfu = new SWFUpload(settings);
};


function GetElementById(id){
	if (document.getElementById) {
		return (document.getElementById(id));
	} else if (document.all) {
		return (document.all[id]);
	} else {
		if ((navigator.appname.indexOf("Netscape") != -1) && parseInt(navigator.appversion == 4)) {
			return (document.layers[id]);
		}
	}
}


function showHideLoadForm(Element) {

	var showHide=Element.value;

	if (showHide==1) {
		GetElementById('file_load').style.display='none';
		GetElementById('find_updates').style.display='table-row';
	}
	else {
		GetElementById('file_load').style.display='table-row';
		GetElementById('find_updates').style.display='none';
	}
}

function getXmlHttp(){
	var xmlhttp;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

//загрузка обновления с сервера
function findUpdates() {

	GetElementById('find_updates').style.display='none';
	GetElementById('poisk_obnovleniy_info').style.display='table-row';

	var xmlhttp 	= getXmlHttp();
	var time 		= Math.random();

	xmlhttp.open('GET', 'autoupdate.php?func=loadArhive&time='+time, true);
	xmlhttp.onreadystatechange = function() {

		if (xmlhttp.readyState == 4) {
			if(xmlhttp.status == 200) {
				var response		= xmlhttp.responseText;

				//если успешно
				if (response==1 || response=='1') {
					document.location.href='autoupdate.php?infoForm=true';
				}
				else if (response==2 || response=='2') {
					document.location.href='autoupdate.php?infoForm=true&noactual=true';
				}				
				else {
					GetElementById('msg_done').innerHTML={/literal}"{$MSGTEXT.autoupdate_error_restore}"+"<br>"+response;{literal};
					GetElementById('load_status').src='images/autoupdate/error.png';
				}
			}
		}
	}

	xmlhttp.send(null);
}

{/literal}
</script>
</head><body LEFTMARGIN="0pt" TOPMARGIN="0pt" bgcolor="#70a8d1">
<br>
<table  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-image: url('images/zero.gif');"></td>
  </tr>
</table>
<table border='0' cellpadding="0" cellspacing="0" width="100%">
  <tr>
  <td align="center">
   
  

  
   <table class="formborder" border="0"  cellpadding="1" cellspacing="0">
    <tr><td>
    <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
    <tr><td>
      <table width="450px" style="height:150px" align="center" class="formbackground" border="0" cellpadding="5" cellspacing="0">
        <tr>
          <td colspan="2" align="center"><p style='margin-left:0px; margin-top:10px; margin-bottom:0'><b>{$autoupdate_caption}</b>
            <p style="margin-top:5px"> </td>
        </tr>
        {if $msgs}
        {foreach from=$msgs item=msg}
        <tr>
          <td align="center" colspan="2"><p style='margin:10px; color:#b1ff88'>{$msg}</p></td>
        </tr>
        {/foreach}
        {/if}
        
        {if $errors}
        {foreach from=$errors item=error}
        <tr>
          <td align="center" colspan="2"><p style='margin:10px; color:red'>{$error}</p></td>
        </tr>
        {/foreach}
        {/if}
        <tr>
          <td align="left"><table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
              <tr style="height:20px">
                <td align="left"  valign="middle" width="10px"><input onClick="showHideLoadForm(this)" name="update_type"  {if !$update_type || $update_type==1} checked {/if} style="margin-top:0px"  type="radio" value="1" ></td>
                <td width="100%" align="left" valign="middle">&nbsp;{$MSGTEXT.autoupdate_variant1}</td>
              </tr>
              <tr style="height:20px">
                <td align="left"  valign="middle" width="10px"><input onClick="showHideLoadForm(this)" name="update_type"  {if $update_type==2} checked {/if} style="margin-top:0px"  type="radio" value="2" ></td>
                <td width="100%" align="left" valign="middle">&nbsp;{$MSGTEXT.autoupdate_variant2}</td>
              </tr>
              <tr id="poisk_obnovleniy_info" style="display:none">
                <td colspan="2" align="center"><table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td colspan="2" height="10px"></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><img id="load_status" src="images/autoupdate/load.gif" align="middle" border="0"></td>
                      <td>&nbsp;<font id="msg_done">{$MSGTEXT.autoupdate_load_updates}</font></td>
                    </tr>
                    <tr>
                      <td colspan="2" height="10px"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td colspan="2" style="height:10px"></td>
              </tr>
              <tr>
                <td colspan="2" style="height:1px" bgcolor="#558ab1"></td>
              </tr>
              <tr>
                <td colspan="2" style="height:5px"></td>
              </tr>
              <tr id="file_load" {if !$update_type || $update_type==1}style="display:none"{/if}>
                <td align="left"  valign="middle" width="10px"></td>
                <td width="100%" align="center" valign="middle"><table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td ><div id="fsUploadProgress"></div></td>
                    </tr>
                    <tr>
                      <td width="65px"><span id="spanButtonPlaceHolder"></span>
                        <input style="display:none" id="btnCancel" type="button" value="{$MSGTEXT.edit_photos_upload_chancel}" onclick="swfu.cancelQueue();" disabled="disabled" style="height: 22px; width:100px" /></td>
                    </tr>
                  </table></td>
              </tr>
              <tr id="find_updates">
                <td colspan="2" align="center"><input type="button" onClick="findUpdates()" class="button" style="width:200px" value="{$MSGTEXT.autoupdate_button}"></td>
              </tr>
            </table>
            </form>
        </tr>
        </td>        
      </table>
		</tr>
        </td>        
      </table>      
    </td>
    </tr>    
  </table>
  </td>
  </tr>  
</table>
</body>
</html>