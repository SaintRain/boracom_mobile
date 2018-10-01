var selected_id=0;

function delete_links() {
	if (confirm(MSGTEXT.linksedit_do_you_want_del_this_links)) {
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

		xmlObject2.open("GET", "ajax.php?func=deleteLink&id="+d_id+"&time="+time , false);
		xmlObject2.send(null);
		if(xmlObject2.status == 200) {
			delete_linksGet(xmlObject2);
		}
	}
}



function delete_linksGet(xmlObject2) {

	if (xmlObject2.readyState == 4) {
		var response = xmlObject2.responseText;
		delete xmlObject2;

		if (response) {
			GetElementById('butedit').disabled=true;
			GetElementById('butdelete').disabled=true;
			GetElementById('name').value='';
			GetElementById('name').disabled=false;
			get_total_links();
		}
		else alert(response+MSGTEXT.linksedit_error_deleting);
	}
}



function save_links() {

	xmlObject2 = getXmlHttp();

	var time 	= Math.random();
	var sel		= GetElementById('data_id');
	var data_id = sel.options[sel.selectedIndex].value;

	selected_id = data_id;
	var name	= encodeURIComponent(GetElementById('name').value);

	xmlObject2.open("GET", "ajax.php?func=updateLink&id="+data_id+"&name="+name+"&time="+time , false);
	xmlObject2.send(null);
	if(xmlObject2.status == 200) {
		save_linksGet(xmlObject2);
	}
}



function save_linksGet(xmlObject2) {
	if (xmlObject2.readyState == 4) {
		var response = xmlObject2.responseText;

		delete xmlObject2;

		if (response) get_total_links();
		else alert(response+MSGTEXT.linksedit_error_edit);
	}
}


function get_total_links() {
	xmlObject2 = getXmlHttp();

	var time = Math.random();
	xmlObject2.open("GET", "ajax.php?func=getLinks&time="+time , false);
	xmlObject2.send(null);
	if(xmlObject2.status == 200) {
		get_total_linksGet(xmlObject2);
	}
}


function get_total_linksGet(xmlObject2) {
	if (xmlObject2.readyState == 4) {

		var response = xmlObject2.responseText;
		delete xmlObject2;

		var objSel = GetElementById('data_id');
		objSel.options.length = 0;
		if (response!='') {
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



function set_link_value(sel) {
	k=0;
	flag=false;
	for (i=0; i<sel.options.length; i++) {
		if (sel.options[i].selected) {
			k++;
			if (k>1) {
				flag=true;
				break;
			}
		}
	}

	if (flag) {
		GetElementById('butedit').disabled=true;
		GetElementById('butdelete').disabled=false;
		GetElementById('name').disabled=true;
	}
	else {
		if (sel.selectedIndex>-1 && sel.options[sel.selectedIndex].value>0) {
			selected_id=sel.options[sel.selectedIndex].value;
			GetElementById('butedit').disabled=false;
			GetElementById('butdelete').disabled=false;

			txt=sel.options[sel.selectedIndex].text;
			GetElementById('name').value=txt;
			GetElementById('name').disabled=false;
		}
		else {
			GetElementById('butedit').disabled=true;
			GetElementById('butdelete').disabled=true;
			GetElementById('name').value='';
		}
	}
}



function hideFormBlocks() {
	GetElementById('frameBlock').style.display='none';
	GetElementById('frameBlock2').style.display='none'
	getLinks();
}