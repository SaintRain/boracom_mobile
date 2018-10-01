if (parent.frames.length<2) {
	document.location='main.php';
}




function getTemplate(tpl_name) {
	xmlObject2 = getXmlHttp();

	var time = Math.random();

	xmlObject2.open("GET", "ajax.php?func=getTemplate&tpl_name="+tpl_name+"&time="+time ,false);

	xmlObject2.send(null);
	if(xmlObject2.status == 200) {
		getTemplateGet(xmlObject2, tpl_name);
	}
}



function getTemplateGet(xmlObject2, tpl_name) {
	if (xmlObject2.readyState == 4) {
		var response = xmlObject2.responseText;
		delete xmlObject2;
		getDocumentSize();
		GetElementById('frameBlock').style.width='100%';
		GetElementById('frameBlock').style.height=getWindowHeight();
		GetElementById('frameBlock').style.display='block';
		GetElementById('frameBlock2').style.display='block';
		GetElementById('frameContentBlock').innerHTML=response;
		if (tpl_name=='findPage.tpl'){
			GetElementById('searchpage').focus();
		}
		if (tpl_name=='addLinkForm.tpl'){
			GetElementById('linkName').focus();
		}
		else
		if (tpl_name=='addEmailGroup.tpl'){
			GetElementById('groupName').focus();
		}
	}
}



function addUrl() {

	n=encodeURIComponent(GetElementById('linkName').value);

	if (n !='' ) {
		var time = Math.random();
		url			= escape(parent.frames.basefrm.location);
		xmlObject2 = getXmlHttp();
		xmlObject2.open("GET", "ajax.php?func=addLink&url="+url+"&name="+n+"&time="+time , false);
		xmlObject2.send(null);
		if(xmlObject2.status == 200) {
			addUrlGet(xmlObject2);
		}
	}
	else alert(MSGTEXT.links_js_cannot_be_empty);
}



function addUrlGet(xmlObject2) {

	if (xmlObject2.readyState == 4) {
		delete xmlObject2;
		GetElementById('frameBlock').style.display='none';
		GetElementById('frameBlock2').style.display='none';
		GetElementById('frameContentBlock').innerHTML='';
		getLinks();
	}
}



function addPageToGroup() {

	xmlObject2 = getXmlHttp();

	caption =	encodeURIComponent(GetElementById('pageHeaderCaption').innerHTML);
	groupid =	GetElementById('group_id').value;

	if (caption !='' ) {

		var time = Math.random();
		url		 = escape(qs);
		xmlObject2.open("GET", "ajax.php?func=addPageToGroup&group_id="+groupid+"&url="+url+"&caption="+caption+"&time="+time , false);
		xmlObject2.send(null);
		if(xmlObject2.status == 200) {

			addPageToGroupGet(xmlObject2);
		}
	}
	else alert(MSGTEXT.links_js_cannot_be_empty);
}



function addPageToGroupGet(xmlObject2) {
	if (xmlObject2.readyState == 4) {
		var response = xmlObject2.responseText;

		delete xmlObject2;
		get_group_urls();
	}
}



function deleteGP() {
	if (confirm(MSGTEXT.links_js_do_you_want_del_selected_pages)) {

		xmlObject2 = getXmlHttp();

		var time 	= Math.random();
		var sel		= GetElementById('data_id');

		d_id='';
		for (i=0; i<sel.options.length; i++) {
			if (sel.options[i].selected) {
				d_id=d_id+sel.options[i].value+',';
			}
		}
		d_id=d_id.substr(0, d_id.length-1);

		xmlObject2.open("GET", "ajax.php?func=deleteGroupPage&id="+d_id+"&time="+time , false);
		xmlObject2.send(null);
		if(xmlObject2.status == 200) {
			deleteGroupPageGet(xmlObject2);
		}
	}
}



function deleteGroupPageGet(xmlObject2) {
	if (xmlObject2.readyState == 4) {
		delete xmlObject2;
		get_group_urls();
	}
}


function getPageGroupUrl(obj) {

	xmlObject2 = getXmlHttp();

	var time = Math.random();

	url_id	 = obj.value;
	xmlObject2.open("GET", "ajax.php?func=getPageGroupUrl&id="+url_id+"&time="+time , false);
	xmlObject2.send(null);
	if(xmlObject2.status == 200) {
		getPageGroupUrlGet(xmlObject2);
	}
}



function getPageGroupUrlGet(xmlObject2) {
	if (xmlObject2.readyState == 4) {

		var response = xmlObject2.responseText;

		delete xmlObject2;

		//GetElementById('group_page_caption').value=response;
		GetElementById('butdelete').disabled=false;
	}
}



function get_group_urls() {

	xmlObject2 = getXmlHttp();

	groupid	 = GetElementById('group_id').value;

	GetElementById('butdelete').disabled=true;
	//GetElementById('group_page_caption').value='';

	var time = Math.random();

	xmlObject2.open("GET", "ajax.php?func=getGroupPages&id="+groupid+"&time="+time , false);
	xmlObject2.send(null);
	if(xmlObject2.status == 200) {
		get_group_urlsGet(xmlObject2);
	}
}



function get_group_urlsGet(xmlObject2) {
	if (xmlObject2.readyState == 4) {

		var response = xmlObject2.responseText;

		delete xmlObject2;

		var objSel = GetElementById('data_id');
		objSel.options.length = 0;
		if (response!='') {
			if (response.length>1) {
				m=response.split('|');
				for (i=0; i<m.length; i=i+3) {
					objSel.options[objSel.options.length] = new Option(m[i+1], m[i]);
					if (m[i]==selected_id) {
						objSel.options[objSel.options.length-1].selected=true;
					}
				}
			}
		}
	}
}



function getLinks() {
	xmlObject2 = getXmlHttp();
	var time = Math.random();
	xmlObject2.open("GET", "ajax.php?func=getLinks&time="+time ,false);

	xmlObject2.send(null);
	if(xmlObject2.status == 200) {
		getLinksGet(xmlObject2);
	}
}



function getLinksGet(xmlObject2) {
	if (xmlObject2.readyState == 4) {
		var response = xmlObject2.responseText;
		delete xmlObject2;

		m=response.split('|');
		drawLinks(m);
	}
}



function drawLinks(allTasks) {
	var tbody = GetElementById('links_table').getElementsByTagName('TBODY')[0]; // Находим нужную таблицу

	tr_count=tbody.rows.length;
	for (i=0; i<tr_count; i++) {
		tbody.deleteRow(0);
	}

	str='';
	url			= document.URL;
	zapros=url.split('?');
	for (i=0; i<allTasks.length; i=i+3) {
		if (zapros[1]==allTasks[i+2]) {
			b='<b>';
			b2='</b>';
		}
		else {
			b='';
			b2='';
		}

		if (allTasks[i]>0)
		str=str+'<a href="javascript: gotoLink(\'?'+allTasks[i+2]+'\')">'+b+allTasks[i+1]+b2+'</a>';
		if (i+3<allTasks.length) str=str+'<img hspace="7" src="images/line_link.gif" border="0">';

	}
	var r = document.createElement("TR");// Создаем строку таблицы и добавляем ее
	var t1 = document.createElement("TD");
	t1.innerHTML=str;
	r.appendChild(t1);
	tbody.appendChild(r);
}


function deleteUrl(link_id) {
	xmlObject2 = getXmlHttp();

	var time = Math.random();
	xmlObject2.open("GET", "ajax.php?func=deleteLink&id="+link_id+"&time="+time , false);
	xmlObject2.send(null);
	if(xmlObject2.status == 200) {
		deleteUrlGet(xmlObject2);
	}
}



function deleteUrlGet(xmlObject2) {
	if (xmlObject2.readyState == 4) {
		delete xmlObject2;
		getLinks();
	}
}