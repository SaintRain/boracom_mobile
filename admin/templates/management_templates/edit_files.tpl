{literal}
<link href="SWFUpload/css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="SWFUpload/swfupload/swfupload.js"></script> 
<script type="text/javascript" src="SWFUpload/swfupload/swfupload.queue.js"></script> 
<script type="text/javascript" src="SWFUpload/js/fileprogress.js"></script> 
<script type="text/javascript" src="SWFUpload/js/handlers.js"></script> 
<script type="text/javascript">
var rewreshURL={/literal}"index.php?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&mdo=files_form&hide_menu=true&t_name={$table_name}&f_name={$field_name}&id={$id}";{literal}

var swfu;
window.onload = function() {
	var settings = {
		flash_url : "SWFUpload/swfupload/swfupload.swf",
		flash9_url : "SWFUpload/swfupload/swfupload_fp9.swf",
		upload_url: "index.php",
		use_query_string: true, //запрос передается в $_GET
		post_params: {{/literal}"PHPSESSID" : "{$session_id}", "act" : "modules", "do" : "managedata", "mdo" : "files_edit", "page_id": "{$page_id}", "tag_id": "{$tag_id}", "t_name" : "{$table_name}", "f_name" : "{$field_name}", "id" : "{$id}", "tmp_key": "Filedata", "hide_menu": "true"{literal}},
		file_size_limit : "1900 MB",
		file_types : "*.*",
		file_types_description : "{/literal}{$MSGTEXT.edit_photos_all_files}{literal}",
		file_upload_limit : 500,
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
		button_text: '<span class="theFont">{/literal}{$MSGTEXT.edit_files_file_name}{literal}</span>',
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
		queue_complete_handler : queueComplete
	};

	swfu = new SWFUpload(settings);
};


function CheckAll(Element) {
	thisCheckBoxes=GetElementById('data form');
	for (var i = 1; i < thisCheckBoxes.length; i++) {
		if (thisCheckBoxes[i].type=='checkbox' && thisCheckBoxes[i].id!=Element.id) {
			thisCheckBoxes[i].checked = Element.checked;
		}
	}
}


function setcolor(obj) {
	obj.style.background='#FFF2BE';
}


function unsetcolor(obj) {
	obj.style.background='white';
}

</script>
{/literal}

{if $messages}
<center>
  {foreach from=$messages item=item}
  <p style="color:yellow;margin:5px;font-size:14px">{$item}</p>
  {/foreach}
</center>
{/if}

{if $errors}
<center>
  {foreach from=$errors item=item}
  <p style="color:yellow;margin:5px;font-size:14px">{$item}</p>
  {/foreach}
</center>
{/if}
<p style="margin-bottom:10px"><font color="Red">{$message}</font></p>
<table style="width:100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    <td colspan="3" valign="top" align="center">  
    <form name="data" id="data form" action="?act=modules&do=managedata&mdo=files_save_desc&page_id={$page_id}&tag_id={$tag_id}&t_name={$table_name}&f_name={$field_name}&id={$id}&hide_menu=true" method="POST" enctype="multipart/form-data" style="margin:0px">
  
  <div class="fieldset flash" id="fsUploadProgress"><span class="legend">{$MSGTEXT.edit_files_select_files}</span></div>
  <table cellpadding="10" cellspacing="0" border="0">
    <tr>
      <td width="65px" ><span id="spanButtonPlaceHolder"></span></td>
      <!--
      <td ><input type="button" value="{$MSGTEXT.edit_photos_upload}" onclick="swfu.startUpload();" class="button" style="height: 22px; font-weight:bold" /></td>
      -->
      <td style="display:none"><input id="btnCancel" type="button" value="{$MSGTEXT.edit_photos_upload_chancel}" onclick="swfu.cancelQueue();" disabled="disabled" style="height: 22px; width:200px" /></td>
    </tr>
  </table>
    </div>  
    </td>
    </tr>
  
  {if $allfiles}
  <tr>
    <td colspan="100%" height="20px"></td>
  </tr>
  <tr>
    <td colspan="100%" ><center>
        <h5 style="margin:0px">{$MSGTEXT.edit_files_loaded_files}</h5>
      </center></td>
  </tr>
  <tr>
    <td colspan="100%" height="5px"></td>
  </tr>
  <tr>
    <td colspan="100%" height="1px" bgcolor="#5380a3"></td>
  </tr>
  <tr>
    <td colspan="100%" height="10px" ></td>
  </tr>
  <tr>
    <td colspan="100%" style="width:100%" valign="top" align="center"><input type="submit" class="button" value="{$MSGTEXT.edit_photos_save}" style="margin-bottom:5px">
      <table border="0" width="1020" cellpadding="1" cellspacing="0" align="center">
        <tr bgcolor='#ccdbe6'>
          <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
              <tr class="top_list">
                <td align="left" valign="top" nowrap width="35%"><b>{$MSGTEXT.edit_files_name}</b></td>
                <td align="left" valign="top" nowrap width="15%"><b>{$MSGTEXT.edit_files_changed}</b></td>
                <td align="left" valign="top" nowrap width="12%"><b>{$MSGTEXT.edit_files_size}</b></td>
                <td align="left" valign="top" nowrap width="20%"><b>{$MSGTEXT.edit_files_description}</b></td>
                <td align="left" valign="top" nowrap width="10%"><b>{$MSGTEXT.edit_files_sort_index}</b></td>
                <td align="left" valign="top" nowrap width="10%"><table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td><input onClick="CheckAll(this)" id="main CheckBox" class="checkboxClean" type="checkbox" value="1"></td>
                      <td>&nbsp;<b>{$MSGTEXT.edit_photos_delete}</b></td>
                    </tr>
                  </table>
                  </td>
              </tr>
              {foreach name="files" from=$allfiles item=list}
              <input type="hidden" name="name_{$smarty.foreach.files.iteration}" value="{$list.name}">
              <input type="hidden" name="changed_{$smarty.foreach.files.iteration}" value="{$list.changed}">
              <input type="hidden" name="size_{$smarty.foreach.files.iteration}" value="{$list.size}">
              <tr style="height:1px"></tr>
              <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)">
                <td align="left" valign="middle" width="30%"><a class="popup" target="_blank" href="{$list.file_url}"><b>{$list.name}</b></a></td>
                <td align="left" valign="middle" width="10%">{$list.changed}</font></td>
                <td align="left" valign="middle" width="10%">{$list.size} kb</font></td>
                <td align="left" valign="top" width="30%"><textarea style="width:100%; height:50px" name="description_{$smarty.foreach.files.iteration}">{$list.description}</textarea></td>
                <td align="left" valign="top" width="10%"><input type="text" name="sort_index_{$smarty.foreach.files.iteration}" value="{$list.sort_index}" style="width:100%"></td>
                <td align="left" valign="top" width="10%"><input name="delete_{$smarty.foreach.files.iteration}" value="{$list.name}" class="checkboxClean" type="checkbox"></td>
              </tr>
              {/foreach}
            </table>
            </td>
        </tr>
      </table>
      </td>
  </tr>
  <tr>
    <td colspan="100%" height="10px"></td>
  </tr>
  <tr>
    <td colspan="100%" height="1px" bgcolor="#5380a3"></td>
  </tr>
  <tr>
    <td colspan="100%" height="10px"></td>
  </tr>
  <tr>
    <td align="center" colspan="3"><input type="submit" class="button" value="{$MSGTEXT.edit_photos_save}" style="width:200px"></td>
  </tr>
  <tr>
    <td colspan="100%" height="20px"></td>
  </tr>
</table>
</td>
</tr>
{/if}
</table>
</form>