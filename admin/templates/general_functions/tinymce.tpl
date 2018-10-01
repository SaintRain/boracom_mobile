{literal}
<script language="javascript" type="text/javascript">
tinyMCE.init({
	theme : "advanced",
	width : "{/literal}{$width}{literal}",
	height : "{/literal}{$height}{literal}",
	mode : "exact",
	relative_urls : true,
	convert_urls : true,
	remove_script_host : true,
	media_strict: false,
	language : "ru",
	elements : "{/literal}{$element_id}{literal}",
	plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,images,autosave,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
	
	// Theme options
	theme_advanced_buttons1 : 			"save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : 			"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,images,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : 			"tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons4 : 			"insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,restoredraft,|,insertfile",
	theme_advanced_toolbar_location : 	"top",
	theme_advanced_toolbar_align : 		"left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	theme_advanced_font_sizes : 		"8pt=8,9pt=9,10pt=10,11pt=11,12pt=12, 13pt=13,14pt=14,15pt=15,16pt=16,17pt=17,18pt=18,19pt=19,20pt=20,21pt=21,22pt=22,23pt=23,24pt=24,25pt=25,30pt=30,35pt=35",
	font_size_style_values : 			"7pt,8pt,9pt,10pt,11pt,12pt,13pt,14pt,15pt,16pt,17pt,18pt,19pt,20pt,21pt,22pt,23pt,24pt,25pt,30pt,35pt",
	autosave_ask_before_unload : false
});

</script>
{/literal}
