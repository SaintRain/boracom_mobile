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

//////////////////////////////////Обработчик нажатия клавиши F5 и CTRL+S
function doDown (e) {
	
	reloadPage=false;
	if (NameBrouser=='msie') {
		if (event.keyCode == 116) {
			event.keyCode = 0;
			event.cancelBubble = true;
			reloadPage=true;
		}
		else {
			// Определяем нажатие Ctrl+S
			var key = event.keyCode || event.which;
			key = String.fromCharCode(key).toLowerCase() == "s";
			if (event.ctrlKey && key && document.getElementById('data form')) {
				GetElementById('data form').submit();
				event.keyCode = 0;
				event.cancelBubble = true;
				return false;
			}
		}
	}
	else {
		if (e.keyCode == 116) {
			e.stopPropagation();
			reloadPage=true;
		}
		else {
			// Определяем нажатие Ctrl+S
			var key = e.keyCode || e.which;
			key = String.fromCharCode(key).toLowerCase() == "s";
			if (e.ctrlKey && key && document.getElementById('data form')) {
				GetElementById('data form').submit();
				e.stopPropagation();
				return false;
			}
		}
	}

	if (reloadPage) {
		if (window.parent.treeframe) window.parent.treeframe.location.reload();
		if (window.parent.treeframe) window.parent.basefrm.location.reload();
		else window.location.reload();
		return false;
	}
}

window.document.onkeydown = doDown;



/* Создание нового объекта XMLHttpRequest для общения с Web-сервером */
var xmlHttp = false;
/*@cc_on @*/
/*@if (@_jscript_version >= 5)
try {
xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try {
xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
} catch (e2) {
xmlHttp = false;
}
}
@end @*/

if (!xmlHttp && typeof XMLHttpRequest != 'undefined') {
	xmlHttp = new XMLHttpRequest();
}

function chr( ascii ) {	// Return a specific character
	return String.fromCharCode(ascii);
}

function getXmlHttp(){
	var xmlhttp;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}


function GetElementById(id){
	if (document.getElementById) {
		return (document.getElementById(id));
	} else if (document.all) {
		return (document.all[id]);
	} else {
		if ((navigator.appname.indexOf("Netscape") != -1) && parseInt(navigator.appversion == 4)) {
			return (document.layers[id]);
		}
	}
}


function SetCookie (name, value) {
	var dd=new Date();
	dd.setMonth(dd.getMonth()+2);
	document.cookie=name + "=" + escape (value) +"; expires="+dd.toGMTString();
}



function getCookie(name) {
	if(document.cookie == "") return false;
	else {
		var cookieStart, cookieEnd;
		var cookieString = document.cookie;
		cookieStart = cookieString.indexOf(name+"=");
		if(cookieStart != -1) {
			cookieStart += name.length+1;
			cookieEnd = cookieString.indexOf(";", cookieStart);
			if(cookieEnd == -1) cookieEnd = cookieString.length;
			return cookieString.substring(cookieStart, cookieEnd);
		} else {
			return false;
		}
	}
}

function show_hide(section) {
	but=GetElementById('hidebutton');
	element=parent.document.all.mainFrame;
	w=element.cols.split(',');
	w=w[0];

	if (w<=0) {
		but.style.marginLeft=0;
		but.title=MSGTEXT.lib_js_hide_menu;
		if (newLeftFrameWidth<265) newLeftFrameWidth=265;
		element.cols=newLeftFrameWidth+",*";
		SetCookie('display_menu', 'true');
	}
	else {
		element.cols="0,*";
		but.style.marginLeft=0;
		but.title=MSGTEXT.lib_js_show_menu;
		SetCookie('display_menu', 'false');
	}
}



function show_hide_details(object_id, but) {
	var  details	= GetElementById(object_id);

	if (details.style.display=='table-row') {
		details.style.display='none';
		but.title=MSGTEXT.lib_js_show_menu_details;

		SetCookie('display_menu_details', 'false');
	}
	else {
		details.style.display='table-row';
		but.title=MSGTEXT.lib_js_hide_menu_details;
		SetCookie('display_menu_details', 'true');
	}

}



function show_hide_settings(object_id, but) {
	var  details	= GetElementById(object_id);

	if (details.style.display=='table-row') {
		details.style.display='none';
		but.title=MSGTEXT.lib_js_show_menu_settings;

		SetCookie('display_menu_settings', 'false');
	}
	else {
		details.style.display='table-row';
		but.title=MSGTEXT.lib_js_hide_menu_settings;
		SetCookie('display_menu_settings', 'true');
	}

}



function clickit(section) {
	element=GetElementById(section);
	if (element.style.display=="none") {element.style.display="";}
	else {
		element.style.display="none";
	};
}



function hide(section) {
	GetElementById('frameBlock').style.display='none';
	GetElementById('frameBlock2').style.display='none';
}



function openPopupFilter(url) {
	if (!width) var width=1080;
	if (!height) var height=600;

	var NewWin= open(url, "popupFilte", "width="+width+",height="+height+",status=no,toolbar=no,scrollbars=yes, resizable=yes, menubar=no, location=no");
	NewWin.document.close();
	NewWin.focus();
}



function openAutoupdateWindow(url, width, height) {
	if (!width) var width=1050;
	if (!height) var height=600;
	var NewWin= open(url, "manageWindow", "width="+width+",height="+height+",status=no,toolbar=no,scrollbars=yes, resizable=yes, menubar=no, location=no");

	NewWin.focus();
}



function openManageWindow(url, width, height) {
	if (!width) var width=1050;
	if (!height) var height=600;
	var NewWin= open(url, "manageWindow", "width="+width+",height="+height+",status=no,toolbar=no,scrollbars=yes, resizable=yes, menubar=no, location=no");

	NewWin.focus();
}



function openBlockSettingsWindow(url, width, height) {

	if (!width) var width=1050;
	if (!height) var height=600;
	var NewWin= open(url, "displayWindow", "width="+width+",height="+height+",status=no,toolbar=no,scrollbars=yes, resizable=yes, menubar=no, location=no");
	NewWin.document.close();
	NewWin.focus();
}



function setEditMode(el) {
	var time = Math.random();
	if (el.checked) value=1;
	else value=0;

	xmlHttp.open("GET", "ajax.php?func=updateGSettins&caption=SETTINGS_EDIT_MODE&value="+value+"&time="+time ,true);
	xmlHttp.onreadystatechange=setContentToEditField;
	xmlHttp.send(null);
}



function qdel(){
	return confirm(MSGTEXT.lib_js_do_you_want_del_this_links);
}



function getWindowWidth() {
	var D = document;
	return Math.max(
	Math.max(D.body.scrollWidth, D.documentElement.scrollWidth),
	Math.max(D.body.offsetWidth, D.documentElement.offsetWidth),
	Math.max(D.body.clientWidth, D.documentElement.clientWidth)
	);
}



function getWindowHeight() {
	var D = document;
	return Math.max(
	Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
	Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
	Math.max(D.body.clientHeight, D.documentElement.clientHeight)
	);
}



function reloadLeftFrame() {
	parent.frames.treeframe.location.reload();
}



function reloadUrlToFrame(url) {
	parent.frames.basefrm.location=url;
}



function gotoLink(url) {
	parent.frames.treeframe.reselectTree(url);
	document.location=url;
}



///////////////////////////////////////////////////////

var mX; // позиция курсора
var tickerProcess=false;


function getClientWidth(obj) {
	return obj.compatMode=='CSS1Compat' && !window.opera?obj.documentElement.clientWidth:obj.body.clientWidth;
}

function startPoint(event) {

	if (!notdrag) {

		deleteSelection();

		leftFrameWidth=getClientWidth(parent.frames.treeframe.document);
		tickerProcess=true;

		window.document.onmousemove = function(event) {
			var event = event || window.event;
			if (tickerProcess) {
				mX=defPosition(event);
				c=parent.document.all.mainFrame.cols;
				c=c.split(',');
				c=parseInt(c[0]);
				newLeftFrameWidth=(c+mX-3);
				parent.document.all.mainFrame.cols = newLeftFrameWidth+",*";
			}
		}
	}
}



function deleteSelection() {
	if (window.getSelection) window.getSelection().removeAllRanges();
	else if (document.selection && document.selection.empty) document.selection.empty();
}



function endPoint() {
	if (tickerProcess) {
		deleteSelection();
	}
	tickerProcess=false;
	document.onmousemove	= '';
	document.onmousedown 	= '';
	saveLeftFrameWidth(newLeftFrameWidth);
}



// Пишем функцию, определяющую координаты
function defPosition(event) {
	var x = 0;
	if (document.attachEvent != null) { // Internet Explorer & Opera
		x = window.event.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
	} else if (!document.attachEvent && document.addEventListener) { // Gecko
		x = event.clientX + window.scrollX;

	} else {
		// Do nothing
	}
	return x;
}



function saveLeftFrameWidth(newWidth) {
	var time = Math.random();
	xmlHttp.open("GET", "ajax.php?func=updateGSettins&caption=SETTINGS_LEFT_FRAME_WIDTH&value="+newWidth+"&time="+time ,true);
	xmlHttp.send(null);
}

/////////////////////////таёмер сесиии
function calcage(secs, num1, num2) {
	s = ((Math.floor(secs/num1))%num2).toString();
	if (LeadingZero && s.length < 2)
	s = "0" + s;
	return '<b>'+s+'</b>';
}



function CountBack(secs) {
	if (secs < 0) {
		document.getElementById("cntdwn").innerHTML = FinishMessage;
		return;
	}

	DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
	DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
	DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
	DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));
	document.getElementById("cntdwn").innerHTML = DisplayStr;

	if (CountActive)
	setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
}



function putspan() {
	document.write("<span id='cntdwn' style='font-weight:normal;font-size:10px; color:#23326C'></span>");
}



function getDocumentSize() {

	var maxHeight= Math.max(
	Math.max(document.body.scrollHeight, document.documentElement.scrollHeight),
	Math.max(document.body.offsetHeight, document.documentElement.offsetHeight),
	Math.max(document.body.clientHeight, document.documentElement.clientHeight)
	)

	GetElementById('frameBlock').style.height=maxHeight+'px';
}



var	morphing_object;
var	morphing_object_opacity=10;
var hide_element=false;



function Morphing(obj_id, h_element) {
	hide_element=h_element
	morphing_object=GetElementById(obj_id);
	setTimeout(MorphingDo, 5000);
}


function MorphingDo() {
	setOpacity(morphing_object, morphing_object_opacity);

	morphing_object_opacity=morphing_object_opacity-1;
	if (morphing_object_opacity>0) {
		setTimeout(MorphingDo, 100);
	}
	else {
		if (hide_element) {
			morphing_object.style.display='none';
		}
		else {
			morphing_object.style.visibility='hidden';
		}
	}
}



function setOpacity(testObj, value) {
	testObj.style.opacity = value/10;
	testObj.style.filter = 'alpha(opacity=' + value*10 + ')';
}