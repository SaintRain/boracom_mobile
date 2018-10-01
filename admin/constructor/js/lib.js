if (parent.frames.length<2) {
	document.location='main.php';
}

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



function reloadLeftFrame() {
	parent.frames.treeframe.location.reload();
}



function reloadUrlToFrame(url) {
	parent.frames.basefrm.location=url;
}



function gotoLink(url) {
	parent.frames.treeframe.reselectTree(url);
}



function gotoURLGlobal(url){
	parent.frames.treeframe.reselectTree(url);
	document.location=url;
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
		SetCookie('display_ctr_menu', 'true');
	}
	else {
		element.cols="0,*";
		but.style.marginLeft=0;
		but.title=MSGTEXT.lib_js_show_menu;
		SetCookie('display_ctr_menu', 'false');
	}
}



function clickit(section) {
	element=GetElementById(section);
	if (element.style.display=="none") {element.style.display="";}
	else
	{element.style.display="none";};
}



function hide(section) {
	GetElementById('frameBlock').style.display='none';
	GetElementById('frameBlock2').style.display='none';
}



function getWindowWidth()
{
	var D = document;
	return Math.max(
	Math.max(D.body.scrollWidth, D.documentElement.scrollWidth),
	Math.max(D.body.offsetWidth, D.documentElement.offsetWidth),
	Math.max(D.body.clientWidth, D.documentElement.clientWidth)
	);
}



function getDocumentSize() {

	var maxHeight= Math.max(
	Math.max(document.body.scrollHeight, document.documentElement.scrollHeight),
	Math.max(document.body.offsetHeight, document.documentElement.offsetHeight),
	Math.max(document.body.clientHeight, document.documentElement.clientHeight)
	)

	GetElementById('frameBlock').style.height=maxHeight+'px';
}



function getWindowHeight() {
	var D = document;
	return Math.max(
	Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
	Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
	Math.max(D.body.clientHeight, D.documentElement.clientHeight)
	);

}


///////////////////////////////////////////////////////

var mX; // позиция курсора
var tickerProcess=false;


function getClientWidth(obj) {
	return obj.compatMode=='CSS1Compat' && !window.opera?obj.documentElement.clientWidth:obj.body.clientWidth;
}



function startPoint(event) {

	if (!notdrag) {

		if (window.getSelection) window.getSelection().removeAllRanges();
		else if (document.selection && document.selection.empty) document.selection.empty();

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



function endPoint() {
	if (tickerProcess) {
		if (window.getSelection) window.getSelection().removeAllRanges();
		else if (document.selection && document.selection.empty) document.selection.empty();
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
	}
	return x;
}



function saveLeftFrameWidth(newWidth) {
	var time = Math.random();
	xmlHttp.open("GET", "ajax.php?func=updateCtrGSettins&caption=SETTINGS_CTR_LEFT_FRAME_WIDTH&value="+newWidth+"&time="+time ,true);
	xmlHttp.send(null);
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
