<?php /* Smarty version 2.6.26, created on 2018-09-14 07:45:08
         compiled from modules/modules_edit_out_tpl.tpl */ ?>
<?php if (! $this->_tpl_vars['hide_menu']): ?>
<p style="margin-top:10px;margin-bottom:10px">
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><a href="?act=modules&do=form_import"><?php echo $this->_tpl_vars['MSGTEXT']['import_module']; ?>
</a> &rarr; </td>
    <td width="20px"></td>
    <td><a href="?act=modules&do=copy_module_form"><?php echo $this->_tpl_vars['MSGTEXT']['create_copy_of_module']; ?>
</a> &rarr;</td>
  </tr>
</table>
</p>
<?php else: ?> <a style="padding-right:10px;padding-left:10px;font-size:14px;margin-bottom:5px" href="index.php?act=modules&do=settings<?php if ($this->_tpl_vars['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>&id=<?php echo $_GET['block_id']; ?>
"><b>&larr; <?php echo $this->_tpl_vars['MSGTEXT']['go_back']; ?>
</b></a> <br>
<br>
<?php endif; ?>
<form id="data form" action="?act=modules&do=saveedit_out_tpl&module_id=<?php echo $this->_tpl_vars['module_id']; ?>
&block_id=<?php echo $this->_tpl_vars['block_id']; ?>
&tpl_id=<?php echo $this->_tpl_vars['tpl_id']; ?>
<?php if ($this->_tpl_vars['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>" method="POST" style="margin:0">
  <?php if ($this->_tpl_vars['message']): ?>
  <p id="messagetext" style="margin-left:10px;margin-bottom:10px;color:yellow;font-size:14px"><?php echo $this->_tpl_vars['message']; ?>
</p>
  <?php if ($_GET['hide_menu'] && $_GET['fastEdit']): ?><script language="JavaScript">opener.location.reload();</script><?php endif; ?> 
  <script language="JavaScript">Morphing("messagetext", false)</script> 
  <?php endif; ?>
  <table <?php if ($this->_tpl_vars['hide_menu']): ?>style="padding-right:10px;padding-left:10px"<?php endif; ?> width="100%" border="0" cellpadding="0" cellspacing="0">
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
                    		<td><?php echo $this->_tpl_vars['MSGTEXT']['edit_tpl']; ?>
 <b>«<?php echo $this->_tpl_vars['tplname']; ?>
»</b></td>
                    		<td width="10px"></td>
                      		<td>
                        	<?php if ($this->_tpl_vars['tpl_type'] == 'xml'): ?><img border="0" src="images/tpls/xml.png"><?php endif; ?>
	          				<?php if ($this->_tpl_vars['tpl_type'] == 'tpl'): ?><img border="0" src="images/tpls/tpl.png"><?php endif; ?>
    	      				<?php if ($this->_tpl_vars['tpl_type'] == 'xsl'): ?><img border="0" src="images/tpls/xsl.png"><?php endif; ?> 
        	  				</td>            	          
            	       </tr>
            	       </table>
            	                           
                	       <p style="margin-top:5px"><?php echo $this->_tpl_vars['MSGTEXT']['address_file']; ?>
 <b><?php echo $this->_tpl_vars['tpl_dir']; ?>
<?php echo $this->_tpl_vars['name']; ?>
</b></p>
                    	    <p style="margin-top:15px; margin-bottom:15px"> <a href="javascript:perekluchit('second_text')"><b><?php echo $this->_tpl_vars['MSGTEXT']['used_tpl']; ?>
</b></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:perekluchit('first_text')"><?php echo $this->_tpl_vars['MSGTEXT']['first_tpl']; ?>
</a> </p>
                      
                        <p style="margin-top:10px">                        
                        <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                    	    <td>
                        	<input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['save']; ?>
" style="width:130px">
                        	<input class="button" type="button" id="makeFormatButton" onClick="autoFormatSelection()" style="display:none" value="<?php echo $this->_tpl_vars['MSGTEXT']['makeFormat']; ?>
" style="width:220px">
                        	</td>
                        	<td width="30px"></td>
	                        <td>
    	                    <input onChange="setHighlight_tpl_code(this)" id="is_highligh" type="checkbox" <?php if (@SETTINGS_HIGHLIGHT_TPL_CODE): ?> checked <?php endif; ?> value="1">
        	                </td>
            	            <td>&nbsp;<?php echo $this->_tpl_vars['MSGTEXT']['tpl_highlight']; ?>

                    	    </td>
                        </tr>
                        </table>
                        </p>
                                            	    
                    	    
                        <textarea class="template" name="tplContent" id="textarea_1" style="width:100%;height:600px"><?php echo $this->_tpl_vars['tplContent']; ?>
</textarea>                        
                        <p style="margin-top:10px">                        
                        <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                    	    <td>
                        	<input class="button" type="submit" value="<?php echo $this->_tpl_vars['MSGTEXT']['save']; ?>
" style="width:130px">
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
                    		<td><?php echo $this->_tpl_vars['MSGTEXT']['edit_tpl']; ?>
 <b>«<?php echo $this->_tpl_vars['tplname']; ?>
»</b></td>
                    		<td width="10px"></td>
                      		<td>
                        	<?php if ($this->_tpl_vars['tpl_type'] == 'xml'): ?><img border="0" src="images/tpls/xml.png"><?php endif; ?>
	          				<?php if ($this->_tpl_vars['tpl_type'] == 'tpl'): ?><img border="0" src="images/tpls/tpl.png"><?php endif; ?>
    	      				<?php if ($this->_tpl_vars['tpl_type'] == 'xsl'): ?><img border="0" src="images/tpls/xsl.png"><?php endif; ?> 
        	  				</td>            	          
            	       </tr>
            	       </table>
            	                                                   
                        <p style="margin-top:5px"><font color="Yellow"><?php echo $this->_tpl_vars['MSGTEXT']['initial_tamplate']; ?>
</font></p>
                        <p style="margin-top:15px; margin-bottom:15px"> <a href="javascript:perekluchit('second_text')"><?php echo $this->_tpl_vars['MSGTEXT']['used_tpl']; ?>
</a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:perekluchit('first_text')"><b><?php echo $this->_tpl_vars['MSGTEXT']['first_tpl']; ?>
</b></a> </p>
                        <textarea class="template" readonly  name="textarea_2" id="textarea_2"  style="width:100%;height:600px"><?php echo $this->_tpl_vars['notModifedTpl']; ?>
</textarea></td>
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

<link rel="stylesheet" href="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/lib/codemirror.css">
<script src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/lib/codemirror.js"></script>
<script src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/lib/util/formatting.js"></script>
<script src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/mode/xml/xml.js"></script>
<script src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/mode/css/css.js"></script>
<script src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/mode/javascript/javascript.js"></script>
<script src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/codemirror/mode/htmlmixed/htmlmixed.js"></script>

<?php echo '
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
	var highligh = GetElementById(\'is_highligh\');
	
	is_loaded=true;
	
	if (highligh.checked) {				
		doHighlight();						
	}
	else {
		document.getElementById(\'makeFormatButton\').style.display=\'none\';
		editor.toTextArea();					
		
		if (editor2) {			
			editor2.toTextArea();
			editor2=false;
			}			
		}
	}
}


function perekluchit(section) {
	element=GetElementById(\'first_text\');
	element2=GetElementById(\'second_text\');	

	if (section==\'first_text\') {
		element.style.display="";
		element2.style.display="none";

		if (!editor2) {
			var highligh = GetElementById(\'is_highligh\');
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
	document.getElementById(\'makeFormatButton\').style.display=\'inline\';
	
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
			cm.setMarker(n, "<span style=\\"color: red;font-weight:bold\\">*</span> %N%");
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


'; ?>

<?php if (@SETTINGS_HIGHLIGHT_TPL_CODE): ?>
doHighlight();
<?php endif; ?>

</script>