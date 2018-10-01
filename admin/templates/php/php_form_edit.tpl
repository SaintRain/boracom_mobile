{if $message}
<p id="messagetext" style="margin-bottom:10px;{if $smarty.get.hide_menu}margin-left:10px{/if}"><font color="yellow">{$message}</font></p>
<script language="JavaScript">Morphing("messagetext", true)</script> 
{/if}
{if $smarty.get.hide_menu}
 <a style="padding-right:10px;padding-left:10px;font-size:14px;" href="index.php?act=modules&do=settings{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}&id={$smarty.get.block_id}"><b>&larr; {$MSGTEXT.go_back}</b></a>
<br>
<br> 
 {/if}

<form id="data form" action="?act=php&do=saveedit{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}&block_id={$block.id}" method="POST"  style="margin:0px"> 
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr>
      <td><table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0" width="100%">
          <tr>
            <td><table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td>{$MSGTEXT.php_edit_name_file} <b>{$file}</b></td>
                </tr>
                
                <tr>
                  <td>
                     <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                    	    <td>
                        	<input class="button" type="submit" value="{$MSGTEXT.php_edit_save}" style="width:130px">
                        	<input class="button" type="button" id="makeFormatButton" onClick="autoFormatSelection()" style="display:none" value="{$MSGTEXT.makeFormat}" style="width:220px">
                        	</td>
                        	<td width="30px"></td>
	                        <td>
    	                    <input onChange="setHighlight_tpl_code(this)" id="is_highligh" type="checkbox" {if $smarty.const.SETTINGS_HIGHLIGHT_TPL_CODE} checked {/if} value="1">
        	                </td>
            	            <td>&nbsp;{$MSGTEXT.php_highlight}
                    	    </td>
                        </tr>
                     </table>                                       
                  </td>
                </tr>                
                <tr>
                  <td>
                    <textarea class="editarea_field" rows="37%" style="width:100%" name="content" id="content">{$content}</textarea></td>
                </tr>
                
                <tr>
                  <td><input class="button" type="submit" value="{$MSGTEXT.php_edit_save}" style="width:130px"></td>
                </tr>                
                

              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>



<link rel="stylesheet" href="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/lib/codemirror.css">
<script src="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/lib/codemirror.js"></script>
<script src="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/mode/xml/xml.js"></script>
<script src="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/mode/javascript/javascript.js"></script>
<script src="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/mode/css/css.js"></script>
<script src="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/mode/clike/clike.js"></script>
<script src="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/mode/php/php.js"></script>

{literal}
<script language="JavaScript">
var editor=false;
var is_loaded;

function setHighlight_tpl_code(obj) {
	var time = Math.random();
	
	if (obj.checked) var value=1;
	else var value=0;
	is_loaded=false;
	
	xmlHttp.open("GET", "ajax.php?func=updateGSettins&caption=SETTINGS_HIGHLIGHT_TPL_CODE&value="+value+"&time="+time ,true);
	xmlHttp.onreadystatechange=setHighlight_tpl_codeGet;
	xmlHttp.send(null);
}


function setHighlight_tpl_codeGet() {

	if (xmlHttp.readyState == 4 && !is_loaded) {
	
	is_loaded=true;
	var highligh = GetElementById('is_highligh');
	
	if (highligh.checked) {		
		doHighlight();						
	}
	else {
		document.getElementById('makeFormatButton').style.display='none';
		editor.toTextArea();
		delete editor;			
		}	
	}
}


function doHighlight() {
			
	 editor = CodeMirror.fromTextArea(GetElementById("content"), {
		mode: "application/x-httpd-php",
		matchBrackets: true,
		tabMode: "indent",
		lineWrapping:true,
		lineNumbers: true,

		onGutterClick: function(cm, n) {
			var info = cm.lineInfo(n);
			if (info.markerText)
			cm.clearMarker(n);
			else
			cm.setMarker(n, "<span style=\"color: red;font-weight:bold\">*</span> %N%");
		},

		onCursorActivity: function() {
			editor.setLineClass(hlLine, null, null);
			hlLine = editor.setLineClass(editor.getCursor().line, null, "activeline");
		}
	}
	);
	var hlLine = editor.setLineClass(0, "activeline");
}

function getSelectedRange() {
	return { from: editor.getCursor(true), to: editor.getCursor(false) };
}

function autoFormatSelection() {
	var range = getSelectedRange();
	editor.autoFormatRange(range.from, range.to);
}





{/literal}
{if $smarty.const.SETTINGS_HIGHLIGHT_TPL_CODE}
doHighlight();
{/if}

</script>