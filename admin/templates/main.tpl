<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
    "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<LINK href="css/leftFrame.css" type="text/css" rel="stylesheet">
<title>{$MSGTEXT.title_general}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<link rel="SHORTCUT ICON" href="favicon.ico" type="image/x-icon">
<script language="javaScript">
{literal}

function setcookie(name, value, expires, path, domain, secure) {
	expires instanceof Date ? expires = expires.toGMTString() : typeof(expires) == 'number' && (expires = (new Date(+(new Date) + expires * 1e3)).toGMTString());
	var r = [name + "=" + escape(value)], s, i;
	for(i in s = {expires: expires, path: path, domain: domain}){
		s[i] && r.push(i + "=" + s[i]);
	}
	return secure && r.push("secure"), document.cookie = r.join(";"), true;
}

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

setcookie('highlightedTreeviewLinkmain', 1,'','/','', false);
{/literal}
</script>
</head>
<FRAMESET
	COLS="{if $smarty.cookies.display_menu=='false'}0{else}{$smarty.const.SETTINGS_LEFT_FRAME_WIDTH}{/if},*"
	id="mainFrame" border="0" style="background-color: #FFD965">
	<FRAME SRC="leftFrame.php" bordercolor="#70a8d1" scrolling="auto"
		noresize style="border: 0" name="treeframe" id="treeframe">
	<FRAME SRC="{$url}" bordercolor="#22364F" scrolling="auto" noresize style="border: 0" name="basefrm" id="basefrm">
</FRAMESET>
<noframes></noframes>
</html>