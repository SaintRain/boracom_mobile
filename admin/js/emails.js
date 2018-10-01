function addEmailGroupName() {

	n=encodeURIComponent(GetElementById('groupName').value);

	if (n !='' ) {
		var time = Math.random();

		xmlObject2 = getXmlHttp();
		xmlObject2.open("GET", "ajax.php?func=addEmailGroup&name="+n+"&time="+time , false);
		xmlObject2.send(null);
		if(xmlObject2.status == 200) {
			addEmailGroupNameGet(xmlObject2);
		}
	}
	else alert(MSGTEXT.classesmailer_type_group_is_empty);
}



function addEmailGroupNameGet(xmlObject2) {

	if (xmlObject2.readyState == 4) {
		var response_id = xmlObject2.responseText;

		delete xmlObject2;
		GetElementById('frameBlock').style.display='none';
		GetElementById('frameBlock2').style.display='none';
		GetElementById('frameContentBlock').innerHTML='';

		document.location.href='index.php?act=mailer&page&group_name='+response_id;
	}
}



function save_GroupEmail() {

	xmlObject2 = getXmlHttp();

	var time 	= Math.random();
	var sel		= GetElementById('data_id');
	var data_id = sel.options[sel.selectedIndex].value;

	selected_id = data_id;
	var name	= encodeURIComponent(GetElementById('name').value);

	xmlObject2.open("GET", "ajax.php?func=updateGroupName&id="+data_id+"&name="+name+"&time="+time , false);
	xmlObject2.send(null);
	if(xmlObject2.status == 200) {
		save_GroupEmailGet(xmlObject2, selected_id);
		sel.options[sel.selectedIndex].text=GetElementById('name').value;
	}
}



function save_GroupEmailGet(xmlObject2, selected_id) {
	if (xmlObject2.readyState == 4) {
		var response = xmlObject2.responseText;

		delete xmlObject2;
		var obj	= GetElementById('group_name');

		for (var i=0; i<obj.options.length; i++) {
			if (obj.options[i].value==selected_id) {
				obj.options[i].text=GetElementById('name').value;
				break;
			}
		}
		alert(MSGTEXT.classesmailer_edit_group_saved);
	}
}



function delete_GroupEmail() {
	if (confirm(MSGTEXT.classesmailer_type_group_confirm_delete)) {
		xmlObject2 = getXmlHttp();

		var time 	= Math.random();
		var sel		= GetElementById('data_id');

		d_id='';
		for (var i=0; i<sel.options.length; i++) {
			if (sel.options[i].selected) {
				d_id=d_id+sel.options[i].value+',';
			}
		}
		d_id=d_id.substr(0, d_id.length-1);

		xmlObject2.open("GET", "ajax.php?func=deleteGroup&id="+d_id+"&time="+time , false);
		xmlObject2.send(null);
		if(xmlObject2.status == 200) {
			delete_GroupEmailGet(xmlObject2);
		}
	}
}



function delete_GroupEmailGet(xmlObject2) {

	if (xmlObject2.readyState == 4) {
		var response = xmlObject2.responseText;
		delete xmlObject2;

		if (response) {
			GetElementById('butedit').disabled=true;
			GetElementById('butdelete').disabled=true;
			GetElementById('name').value='';
			GetElementById('name').disabled=false;

			document.location.href='index.php?act=mailer&page';
		}
		else alert(response);
	}
}