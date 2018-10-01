{literal}
<script language="javascript" type="text/javascript">	
tinyMCE.init({
	theme : "advanced",
	width : "{/literal}{$width}{literal}",
	height : "{/literal}{$height}{literal}",
	mode : "exact",
	theme_advanced_path : false,
	relative_urls : false,
	convert_urls : false,
	remove_script_host : false,
	
	language : "ru",
	elements : "{/literal}{$element_id}{literal}",
	plugins : "spellchecker,pagebreak,style,layer,emotions,iespell,paste,directionality,visualchars,nonbreaking,xhtmlxtras",
	// Theme options
	theme_advanced_buttons1 : 			"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,sub,sup,blockquote,link,|,charmap,emotions,|,image,insertimage",
	theme_advanced_buttons2 : 			"",
	theme_advanced_buttons3 : 			"",
	theme_advanced_toolbar_location : 	"top",
	theme_advanced_toolbar_align : 		"left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : false,
	autosave_ask_before_unload : false
});
</script>
{/literal}
