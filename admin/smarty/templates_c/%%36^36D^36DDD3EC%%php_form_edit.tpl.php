<?php /* Smarty version 2.6.26, created on 2018-09-07 07:08:51
         compiled from php/php_form_edit.tpl */ ?>
<?php if ($this->_tpl_vars['message']): ?>
<p id="messagetext" style="margin-bottom:10px;<?php if ($_GET['hide_menu']): ?>margin-left:10px<?php endif; ?>"><font color="yellow"><?php echo $this->_tpl_vars['message']; ?>
</font></p>
<script language="JavaScript">Morphing("messagetext", true)</script> 
<?php endif; ?>
<?php if ($_GET['hide_menu']): ?>
 <a style="padding-right:10px;padding-left:10px;font-size:14px;" href="index.php?act=modules&do=settings<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>&id=<?php echo $_GET['block_id']; ?>
"><b>&larr; <?php echo $this->_tpl_vars['MSGTEXT']['go_back']; ?>
</b></a>
<br>
<br> 
 <?php endif; ?>

<form id="data form" action="?act=php&do=saveedit<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>&block_id=<?php echo $this->_tpl_vars['block']['id']; ?>
" method="POST"  style="margin:0px"> 
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr>
      <td><table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0" width="100%">
          <tr>
            <td><table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td><?php echo $this->_tpl_vars['MSGTEXT']['php_edit_name_file']; ?>
 <b><?php echo $this->_tpl_vars['file']; ?>
</b></td>
                </tr>
                
                <tr>
                  <td>
                     <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                    	    <td>
                        	<input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['php_edit_save']; ?>
" style="width:130px">
                        	<input class="button" type="button" id="makeFormatButton" onClick="autoFormatSelection()" style="display:none" value="<?php echo $this->_tpl_vars['MSGTEXT']['makeFormat']; ?>
" style="width:220px">
                        	</td>
                        	<td width="30px"></td>
	                        <td>
    	                    <input onChange="setHighlight_tpl_code(this)" id="is_highligh" type="checkbox" <?php if (@SETTINGS_HIGHLIGHT_TPL_CODE): ?> checked <?php endif; ?> value="1">
        	                </td>
            	            <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['php_highlight']; ?>

                    	    </td>
                        </tr>
                     </table>                                       
                  </td>
                </tr>                
                <tr>
                  <td>
                    <textarea class="editarea_field" rows="37%" style="width:100%" name="content" id="content"><?php echo $this->_tpl_vars['content']; ?>
</textarea></td>
                </tr>
                
                <tr>
                  <td><input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['php_edit_save']; ?>
" style="width:130px"></td>
                </tr>                
                

              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>



<link rel="stylesheet" href="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/lib/codemirror.css">
<script src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/lib/codemirror.js"></script>
<script src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/mode/xml/xml.js"></script>
<script src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/mode/javascript/javascript.js"></script>
<script src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/mode/css/css.js"></script>
<script src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/mode/clike/clike.js"></script>
<script src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/mode/php/php.js"></script>

<?php echo '
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
	var highligh = GetElementById(\'is_highligh\');
	
	if (highligh.checked) {		
		doHighlight();						
	}
	else {
		document.getElementById(\'makeFormatButton\').style.display=\'none\';
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
			cm.setMarker(n, "<span style=\\"color: red;font-weight:bold\\">*</span> %N%");
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





'; ?>

<?php if (@SETTINGS_HIGHLIGHT_TPL_CODE): ?>
doHighlight();
<?php endif; ?>

</script>