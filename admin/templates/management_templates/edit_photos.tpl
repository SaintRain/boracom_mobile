{literal}
<link href="SWFUpload/css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="SWFUpload/swfupload/swfupload.js"></script> 
<script type="text/javascript" src="SWFUpload/swfupload/swfupload.queue.js"></script> 
<script type="text/javascript" src="SWFUpload/js/fileprogress.js"></script> 
<script type="text/javascript" src="SWFUpload/js/handlers.js"></script> 
<script type="text/javascript">
var rewreshURL={/literal}"index.php?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&mdo=photos_form&hide_menu=true&t_name={$table_name}&f_name={$field_name}&id={$id}";{literal}

var swfu;
window.onload = function() {
	var settings = {
		flash_url : "SWFUpload/swfupload/swfupload.swf",
		flash9_url : "SWFUpload/swfupload/swfupload_fp9.swf",
		upload_url: "index.php",
		use_query_string: true, //запрос передается в $_GET
		post_params: {{/literal}"PHPSESSID" : "{$session_id}", "act" : "modules", "do" : "managedata", "mdo" : "photos_edit", "page_id": "{$page_id}", "tag_id": "{$tag_id}", "t_name" : "{$table_name}", "f_name" : "{$field_name}", "id" : "{$id}", "tmp_key": "Filedata", "hide_menu": "true"{literal}},
		file_size_limit : "1900 MB",
		file_types : "*.jpg; *.jpeg; *.png; *.gif; *.bmp;",
		file_types_description : "{/literal}{$MSGTEXT.edit_photos_only_images}{literal}",
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
		button_text: '<span class="theFont">{/literal}{$MSGTEXT.edit_photos_file_name}{literal}</span>',
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
		queue_complete_handler : queueComplete	// Queue plugin event

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
	obj.style.background='#a6d0ee';
}
function unsetcolor(obj) {
	obj.style.background='#71a7ce';
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
    <form name="data" id="data form" action="?act=modules&do=managedata&mdo=photos_save_desc&page_id={$page_id}&tag_id={$tag_id}&t_name={$table_name}&f_name={$field_name}&id={$id}&hide_menu=true" method="POST" enctype="multipart/form-data" style="margin:0px">
  
  <div class="fieldset flash" id="fsUploadProgress"><span class="legend">{$MSGTEXT.edit_photos_select_files}</span></div>
  <table cellpadding="0" cellspacing="10" border="0">
    <tr>
      <td width="65px" ><span id="spanButtonPlaceHolder"></span></td>
      <!--
      <td><input type="button" value="{$MSGTEXT.edit_photos_upload}" onclick="swfu.startUpload();" class="button" style="height: 22px; font-weight:bold" /></td>
      -->
      <td style="display:none"><input id="btnCancel" type="button" value="{$MSGTEXT.edit_photos_upload_chancel}" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" /></td>
      {if $allphotos}
      <td><input onClick="CheckAll(this)" id="main CheckBox" class="checkboxClean" type="checkbox" value="1"></td>
      <td>{$MSGTEXT.edit_photos_select_all}</td>
      {/if} </tr>
  </table>
    </div>  
    </td>
    </tr>
  
  {if $allphotos}
  <tr>
    <td colspan="100%" height="20px"></td>
  </tr>
  <tr>
    <td colspan="100%" ><center>
        <h5 style="margin:0px">{$MSGTEXT.edit_photos_images}</h5>
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
    <td colspan="100%" style="width:100%" valign="top" align="center"><input type="submit" class="button" value="{$MSGTEXT.edit_photos_save}" style="margin-bottom:10px">
      {foreach name="photos" from=$allphotos item=list}
      {if $list.new_row_begin}
      <table border="0" cellpadding="0" cellspacing="0" >
        <tr> {/if}
          <td valign="top" align="center" width="170px"><table align="center" border="0" height="160px" cellpadding="1" cellspacing="0" style="margin-right:5px">
              <tr>
                <td bgcolor="#5380a3"><table align="left" border="0" height="100%" bgcolor="#71a7ce" onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)">
                    <tr>
                      <td style="height:90px" valign="top" align="center"><a target="_blank" href="{$list.big_img}"><img class="ramka2" src="{$list.small_img}" border="0" alt="{$list.name}"></a></td>
                    </tr>
                    <tr>
                      <td><table cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td colspan="2"><font style="font-size:10px">{$MSGTEXT.edit_photos_sort_index}</font><br>
                              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <input type="hidden" name="name_{$smarty.foreach.photos.iteration}" value="{$list.name}">
                                <tr>
                                  <td><input type="text" name="sort_index_{$smarty.foreach.photos.iteration}" value="{$list.sort_index}" style="width:80px"></td>
                                  <td align="center"><input name="delete_{$smarty.foreach.photos.iteration}" value="{$list.name}" type="checkbox"></td>
                                  <td><font style="font-size:10px">&nbsp;{$MSGTEXT.edit_photos_delete}</></td>
                              </table>
                          </tr>
                          <tr>
                            <td colspan="2"><font style="font-size:10px">{$MSGTEXT.edit_photos_description}</font><br>
                              <textarea name="description_{$smarty.foreach.photos.iteration}" rows="3" style="width:150px">{$list.description}</textarea>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          {if $list.new_row_end} </tr>
      </table>
      <br>
      {/if}      
      {/foreach} </td>
  </tr>
  <tr>
    <td colspan="100%" height="10px" ></td>
  </tr>
  <tr>
    <td colspan="100%" height="1px" bgcolor="#5380a3"></td>
  </tr>
  <tr>
    <td colspan="100%" height="10px" ></td>
  </tr>
  <tr>
    <td align="center" colspan="3"><input type="submit" class="button" value="{$MSGTEXT.edit_photos_save}" style="width:200px"></td>
  </tr>
  <tr>
    <td colspan="100%" height="20px" ></td>
  </tr>
</table>
</td>
</tr>
{/if}
</table>
</form>