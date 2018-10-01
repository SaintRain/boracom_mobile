{if !$hide_menu}
<p style="margin-top:10px;margin-bottom:10px">
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><a href="?act=modules&do=form_import">{$MSGTEXT.import_module}</a> &rarr; </td>
    <td width="20px"></td>
    <td><a href="?act=modules&do=copy_module_form">{$MSGTEXT.create_copy_of_module}</a> &rarr;</td>
  </tr>
</table>
</p>
{else} <a style="padding-right:10px;padding-left:10px;font-size:14px;margin-bottom:5px" href="index.php?act=modules&do=settings{if $hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}&id={$smarty.get.block_id}"><b>&larr; {$MSGTEXT.go_back}</b></a> <br>
<br>
{/if}
<form id="data form" action="?act=modules&do=saveedit_out_tpl&module_id={$module_id}&block_id={$block_id}&tpl_id={$tpl_id}{if $hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}" method="POST" style="margin:0">
  {if $message}
  <p id="messagetext" style="margin-left:10px;margin-bottom:10px;color:yellow;font-size:14px">{$message}</p>
  {if $smarty.get.hide_menu && $smarty.get.fastEdit}<script language="JavaScript">opener.location.reload();</script>{/if} 
  <script language="JavaScript">Morphing("messagetext", false)</script> 
  {/if}
  <table {if $hide_menu}style="padding-right:10px;padding-left:10px"{/if} width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
        <tr>
          <td><table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
              <tr>
                <td>
                <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                    <tr id="second_text" style="display:true">
                      <td>
                      
                        <table style="margin-top:10px" border="0" cellpadding="0" cellspacing="0">
                    	<tr>
                    		<td>{$MSGTEXT.edit_tpl} <b>«{$tplname}»</b></td>
                    		<td width="10px"></td>
                      		<td>
                        	{if $tpl_type=='xml'}<img border="0" src="images/tpls/xml.png">{/if}
	          				{if $tpl_type=='tpl'}<img border="0" src="images/tpls/tpl.png">{/if}
    	      				{if $tpl_type=='xsl'}<img border="0" src="images/tpls/xsl.png">{/if} 
        	  				</td>            	          
            	       </tr>
            	       </table>
            	                           
                	       <p style="margin-top:5px">{$MSGTEXT.address_file} <b>{$tpl_dir}{$name}</b></p>
                    	    <p style="margin-top:15px; margin-bottom:15px"> <a href="javascript:perekluchit('second_text')"><b>{$MSGTEXT.used_tpl}</b></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:perekluchit('first_text')">{$MSGTEXT.first_tpl}</a> </p>
                      
                        <p style="margin-top:10px">                        
                        <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                    	    <td>
                        	<input class="button" type="submit" value="{$MSGTEXT.save}" style="width:130px">
                        	<input class="button" type="button" id="makeFormatButton" onClick="autoFormatSelection()" style="display:none" value="{$MSGTEXT.makeFormat}" style="width:220px">
                        	</td>
                        	<td width="30px"></td>
	                        <td>
    	                    <input onChange="setHighlight_tpl_code(this)" id="is_highligh" type="checkbox" {if $smarty.const.SETTINGS_HIGHLIGHT_TPL_CODE} checked {/if} value="1">
        	                </td>
            	            <td>&nbsp;{$MSGTEXT.tpl_highlight}
                    	    </td>
                        </tr>
                        </table>
                        </p>
                                            	    
                    	    
                        <textarea class="template" name="tplContent" id="textarea_1" style="width:100%;height:600px">{$tplContent}</textarea>                        
                        <p style="margin-top:10px">                        
                        <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                    	    <td>
                        	<input class="button" type="submit" value="{$MSGTEXT.save}" style="width:130px">
                        	</td>
                        	
                        </tr>
                        </table>
                        </p>
                        </td>
                    </tr>
                    <tr id="first_text" style="display:none">
                      <td>
                        <table style="margin-top:10px" border="0" cellpadding="0" cellspacing="0">
                    	<tr>
                    		<td>{$MSGTEXT.edit_tpl} <b>«{$tplname}»</b></td>
                    		<td width="10px"></td>
                      		<td>
                        	{if $tpl_type=='xml'}<img border="0" src="images/tpls/xml.png">{/if}
	          				{if $tpl_type=='tpl'}<img border="0" src="images/tpls/tpl.png">{/if}
    	      				{if $tpl_type=='xsl'}<img border="0" src="images/tpls/xsl.png">{/if} 
        	  				</td>            	          
            	       </tr>
            	       </table>
            	                                                   
                        <p style="margin-top:5px"><font color="Yellow">{$MSGTEXT.initial_tamplate}</font></p>
                        <p style="margin-top:15px; margin-bottom:15px"> <a href="javascript:perekluchit('second_text')">{$MSGTEXT.used_tpl}</a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:perekluchit('first_text')"><b>{$MSGTEXT.first_tpl}</b></a> </p>
                        <textarea class="template" readonly  name="textarea_2" id="textarea_2"  style="width:100%;height:600px">{$notModifedTpl}</textarea></td>
                    </tr>
                  </table>
                  </td>
              </tr>
            </table>
            </td>
        </tr>
      </table>
   </td>
  </tr>
  </table>
</form>
<br/>
&nbsp;

<link rel="stylesheet" href="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/lib/codemirror.css">
<script src="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/lib/codemirror.js"></script>
<script src="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/lib/util/formatting.js"></script>
<script src="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/mode/xml/xml.js"></script>
<script src="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/mode/css/css.js"></script>
<script src="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/mode/javascript/javascript.js"></script>
<script src="/{$smarty.const.SETTINGS_ADMIN_PATH}/codemirror/mode/htmlmixed/htmlmixed.js"></script>

{literal}
<script language="JavaScript">

var editor=false;
var editor2=false;
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
	var highligh = GetElementById('is_highligh');
	
	is_loaded=true;
	
	if (highligh.checked) {				
		doHighlight();						
	}
	else {
		document.getElementById('makeFormatButton').style.display='none';
		editor.toTextArea();					
		
		if (editor2) {			
			editor2.toTextArea();
			editor2=false;
			}			
		}
	}
}


function perekluchit(section) {
	element=GetElementById('first_text');
	element2=GetElementById('second_text');	

	if (section=='first_text') {
		element.style.display="";
		element2.style.display="none";

		if (!editor2) {
			var highligh = GetElementById('is_highligh');
			if (highligh.checked) {
				doHighlight2();
			}
		}
	}
	else {
		element.style.display="none";
		element2.style.display="";
	}
}


function doHighlight() {
	document.getElementById('makeFormatButton').style.display='inline';
	
	editor = CodeMirror.fromTextArea(document.getElementById("textarea_1"), {
		mode: "text/html",
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


function doHighlight2() {		
		
	 	editor2 = CodeMirror.fromTextArea(document.getElementById("textarea_2"), {
		mode: "text/html",

		lineWrapping:true,
		lineNumbers: true,
		readOnly :true,
		height:"100px",
		onGutterClick: function(cm, n) {
			var info = cm.lineInfo(n);
			if (info.markerText)
			cm.clearMarker(n);
			else
			cm.setMarker(n, "<span style=\"color: red;font-weight:bold\">*</span> %N%");
		},

		onCursorActivity: function() {

			
			editor2.setLineClass(hlLine2, null, null);
			hlLine2 = editor2.setLineClass(editor2.getCursor().line, null, "activeline");			
		}
	});

	var hlLine2 = editor2.setLineClass(0, "activeline");
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