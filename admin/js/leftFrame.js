
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
		window.parent.treeframe.location.reload();
		window.parent.basefrm.location.reload();
		return false;
	}
};
window.document.onkeydown = doDown;


function reselectTree(url) {
	if (lastClicked) {
		var lc=getElById('itemTextLink'+lastClicked.id);
		clean_url			= url;		 //берем чистый адрес с правого фрейма
		clean_url_current	= lc.href; 	//берем чистый адрес с левого фрейма
		if (clean_url!=clean_url_current) {
			if (!getAllTree(initializeTREE, clean_url, '')) {
				getAllTree(initializeTREE, clean_url, 'page');
			}
		}
	}
}

function getAllTree(tree, clean_url) {
	var i=0;
	for (i=0; i < tree.nChildren; i++) {
		nodeObj=tree.children[i];

		if (nodeObj.link) hlink=nodeObj.link;
		else hlink=nodeObj.hreference;
		clean_url_current=hlink;

		if (clean_url_current==clean_url) {
			var lastClicked=nodeObj;
			nodeObj.forceOpeningOfAncestorFolders();
			highlightObjLink(nodeObj);
			return true;
		}

		if (nodeObj.nChildren>0) {
			getAllTree(nodeObj, clean_url);
		}
	}
	return false;
}
