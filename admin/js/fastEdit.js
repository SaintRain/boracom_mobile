// Функция для определения координат указателя мыши
function ___GoodCMS_defPosition(event) {
	var x = y = 0;
	if (document.attachEvent != null) { // Internet Explorer & Opera
		x = window.event.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
		y = window.event.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
	}
	else if (!document.attachEvent && document.addEventListener) { // Gecko
		x = event.clientX + window.scrollX;
		y = event.clientY + window.scrollY;
	}
	else {
		// Do nothing
	}

	var width=getClientWidth();
	var height=getClientHeight();

	x=x-55;

	if ((height-y)<100) {
		y=y-(110-(height-y));
		y=y-15;
	}
	else {
		y=y-22;
	}

	return {x:x, y:y};
}

function getClientWidth() {
	return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientWidth:document.body.clientWidth;
}

function getClientHeight() {
	var D = document;
	return Math.max(
	Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
	Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
	Math.max(D.body.clientHeight, D.documentElement.clientHeight)
	);
}


function ___GoodCMS_menu(type, evt, url, block_id, table_description, edit_able) {
	// Блокируем всплывание события contextmenu
	evt = evt || window.event;
	evt.cancelBubble = true;
	// Показываем собственное контекстное меню
	var menu = document.getElementById("___GoodCMS_contextMenuId");
	var html = "";

	switch (type) {
		case (1) :

		html += "<table id='t_width' style='border: 1px solid  #2e5874;' border='0' cellpadding='0px' cellspacing='0px'>";

		if (table_description!='') {

			if (edit_able) {
				var reg=/&search=\d*&/

				var edit_all=url.replace(reg, "&clean_seacrh=true&");

				var reg=/\#data form/
				edit_all=edit_all.replace(reg, "");

				html += "<tr onMouseMove='this.style.background=\"#d4e7ef\"' onMouseOut='this.style.background=\"#e8f8ff\"' style='cursor:pointer' onClick='javascript: ___GoodCMS_openManageWindow(\""+edit_all+"\", \"1100\", \"700\")')'><td width='5px'>&nbsp;</td><td width='15px' align='left' valign='middle' style='height:25px;vertical-align:middle' nowrap><img src='/"+SETTINGS_ADMIN_PATH+"/images/popupMenu/info.png' border='0' vspace='0px' hspace='0px'></td><td align='left' valign='middle' style='height:25px;vertical-align:middle' nowrap>&nbsp;<font style='font-size:12px;font-family:Verdana;color:black;text-decoration:none;font-weight:none'>"+MSGTEXT["fedit_menu_all_records_from"]+" «"+table_description+"»&nbsp;</font></td></tr>";
			}
			else {
				html += "<tr><td width='5px'>&nbsp;</td><td width='15px' align='left' valign='middle' style='height:25px;vertical-align:middle'><img src='/"+SETTINGS_ADMIN_PATH+"/images/popupMenu/info.png' border='0' vspace='0px' hspace='0px'></td><td align='left' valign='middle' style='height:25px;vertical-align:middle' nowrap>&nbsp;<font style='font-size:12px;font-family:Verdana;color:gray;text-decoration:none;font-weight:none'>«"+table_description+"»&nbsp;</font></td></tr>";
			}
			html +="<tr><td colspan='3' style='height:1px;background-color:#d6e8f0'></td></tr>";
		}

		var reg2=/&search=\d+&/
		if (reg2.test(url)) {
			
			html += "<tr onMouseMove='this.style.background=\"#d4e7ef\"' onMouseOut='this.style.background=\"#e8f8ff\"' style='cursor:pointer' onClick='javascript: ___GoodCMS_openManageWindow(\""+url+"\", \"1100\", \"700\")'><td width='5px'>&nbsp;</td><td width='15px' align='left' valign='middle' style='height:25px;vertical-align:middle'><img  src='/"+SETTINGS_ADMIN_PATH+"/images/popupMenu/edit.png' border='0' vspace='0px' hspace='0px'></td><td align='left' valign='middle' nowrap>&nbsp;<font style='font-size:12px;font-family:Verdana;color:black;text-decoration:none'>"+MSGTEXT["fedit_menu_edit_current_record"]+"&nbsp;</font></td></tr>";
			var edit_one=true;
		}
		else var edit_one=false;

		if	 (block_id!='') {
			if (edit_one) html +="<tr><td colspan='3' style='height:1px;background-color:#d6e8f0'></td></tr>";
			html += "<tr onMouseMove='this.style.background=\"#d4e7ef\"' onMouseOut='this.style.background=\"#e8f8ff\"' style='cursor:pointer' onClick='javascript: ___GoodCMS_openBlockSettingsWindow(\"/"+SETTINGS_ADMIN_PATH+"/index.php?act=modules&do=settings&hide_menu=true&id="+block_id+"&fastEdit=true\")'><td width='5px'>&nbsp;</td><td width='15px' align='left' valign='middle' style='height:25px;vertical-align:middle'><img  src='/"+SETTINGS_ADMIN_PATH+"/images/popupMenu/settings.png' border=0 vspace=0px hspace='0px'></td><td align='left' valign='middle'>&nbsp;<font style='font-size:12px;font-family:Verdana;color:black;text-decoration:none'>"+MSGTEXT["fedit_menu_settings"]+"&nbsp;</font></td></tr>";
		}

		html += "</table>";
		break;
		default :
		// Nothing
		break;
	}
	// Если есть что показать - показываем
	if (html) {
		menu.innerHTML = html;
		menu.style.display = "block";
		menu.style.top = ___GoodCMS_defPosition(evt).y + "px";
		menu.style.left = ___GoodCMS_defPosition(evt).x + "px";
		
		
	}
	// Блокируем всплывание стандартного браузерного меню
	return false;
}



// Закрываем контекстное при клике левой или правой кнопкой по документу
// Функция для добавления обработчиков событий
function ___GoodCMS_addHandler(object, event, handler, useCapture) {
	if (object.addEventListener) {
		object.addEventListener(event, handler, useCapture ? useCapture : false);
	} else if (object.attachEvent) {
		object.attachEvent('on' + event, handler);
	} else alert("Add handler is not supported");
}

___GoodCMS_addHandler(document, "contextmenu", function() {
	document.getElementById("___GoodCMS_contextMenuId").style.display = "none";
});
___GoodCMS_addHandler(document, "click", function() {
	document.getElementById("___GoodCMS_contextMenuId").style.display = "none";
});



function ___GoodCMS_openManageWindow(url, width, height) {
	
	if (!width) var width=1050;
	if (!height) var height=600;
	
	//url=encodeURI(url);
	
	var NewWin= open(url, "manageWindow", "width="+width+",height="+height+",status=no,toolbar=no,scrollbars=yes, resizable=yes, menubar=no, location=no");
	NewWin.focus();
}



function ___GoodCMS_openBlockSettingsWindow(url, width, height) {
	if (!width) var width=1050;
	if (!height) var height=600;
	var NewWin= open(url, "displayWindow", "width="+width+",height="+height+",status=no,toolbar=no,scrollbars=yes, resizable=yes, menubar=no, location=no");
	NewWin.focus();
}