if (document.images){
	browserOK = true;
	pics = new Array();
}

var objCount = 0;



function preload(name, first, second) {
	if (browserOK) {
		pics[objCount] = new Array(1);
		pics[objCount][0] = new Image();
		pics[objCount][0].src = first;
		pics[objCount][1] = new Image();
		pics[objCount][1].src = second;
		pics[objCount][2] = name;
		objCount++;
	}
}

var notdrag;


function on(name){
	if (browserOK) {
		notdrag=true;
		for (i = 0; i < objCount; i++) {
			if (document.images[pics[i][2]] != null)
			if (name != pics[i][2]) {
				document.images[pics[i][2]].src = pics[i][0].src;
			} else {
				document.images[pics[i][2]].src = pics[i][1].src;
			}
		}
	}
}



function off() {
	if (browserOK) {
		notdrag=false;
		for (i = 0; i < objCount; i++) {
			if (document.images[pics[i][2]] != null)
			document.images[pics[i][2]].src = pics[i][0].src;
		}
	}
}



function popuphide(layer) {
	off();
	NC = (document.layers);
	IE = (document.all);
	Opera = (document.getElementById);
	if(IE) eval('document.all[layer].style.visibility = "hidden"');
	if(NC) eval('document.layers[layer].visibility = "hidden"');
	if(Opera) eval('document.getElementById(layer).style.visibility = "hidden"');
}



function popupshow(name,layer) {
	on(name);
	NC = (document.layers);
	IE = (document.all);
	Opera = (document.getElementById);
	if(IE) eval('document.all[layer].style.visibility = "visible"');
	if(NC) eval('document.layers[layer].visibility = "visible"');
	if(Opera) eval('document.getElementById(layer).style.visibility = "visible"');
}


preload("show_hide_but", "images/m_hide.png", "images/m_hide_s.png");