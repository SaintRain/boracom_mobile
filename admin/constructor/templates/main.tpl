<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
    "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>{$MSGTEXT.title_general_constructor}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="favicon.ico" type="image/x-icon">

{literal} 
<script language="JavaScript">
var NameBrouser = getNameBrouser();
function getNameBrouser() {
	var ua = navigator.userAgent.toLowerCase();
	if (ua.indexOf("msie") != -1 && ua.indexOf("opera") == -1 && ua.indexOf("webtv") == -1) { return "msie"}
	if (ua.indexOf("opera") != -1) { return "opera"}
	if (ua.indexOf("gecko") != -1) {return "gecko";}
	if (ua.indexOf("safari") != -1) {return "safari";}
	if (ua.indexOf("konqueror") != -1) {return "konqueror";}
	return "unknown";
}

function doDown (e) {
	reloadPage=false;
	if (NameBrouser=='msie') {
		if (event.keyCode == 116) {
			event.keyCode = 0;
			event.cancelBubble = true;
			reloadPage=true;		}
	}
	else {
		if (e.keyCode == 116) {
			e.stopPropagation();
			reloadPage=true;
		}
	}
	if (reloadPage) {
		window.treeframe.location.reload();
		window.basefrm.location.reload();
		return false;
	}
};
window.document.onkeydown = doDown;
</script>
{/literal}

</head>
<FRAMESET COLS="{if $smarty.cookies.display_ctr_menu=='false'}0{else}{$smarty.const.SETTINGS_CTR_LEFT_FRAME_WIDTH}{/if},*" id="mainFrame" border="0" style="background-color:#FFD965;">
<FRAME SRC="leftFrame.php" bordercolor="#70a8d1" scrolling="auto" noresize style="border:0" name="treeframe" id="treeframe">
<FRAME SRC="index.php" bordercolor="#22364F" scrolling="auto" noresize style="border:0" name="basefrm" id="basefrm">
</FRAMESET>
</html>