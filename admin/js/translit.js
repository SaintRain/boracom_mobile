//создаёт транслит
var bad_simbols = new Array();
bad_simbols['"']='';
bad_simbols["'"]='';
bad_simbols["("]='';
bad_simbols[")"]='';
bad_simbols["/"]='';
bad_simbols["!"]='';
bad_simbols["\\"]='';
bad_simbols["?"]='';
bad_simbols["+"]='';
bad_simbols["&"]='';
bad_simbols["`"]='';
bad_simbols["$"]='';
bad_simbols["*"]='';
bad_simbols["="]='';
bad_simbols["%"]='';
bad_simbols["#"]='';
bad_simbols["@"]='';
bad_simbols["»"]='';
bad_simbols["«"]='';
bad_simbols["©"]='';
bad_simbols["^"]='';
bad_simbols["."]='';
bad_simbols[","]='';
bad_simbols[":"]='';
bad_simbols[";"]='';
bad_simbols["ь"]='';
bad_simbols["ъ"]='';
bad_simbols["№"]='';



var ruAlpha = new Array();
ruAlpha["а"] = "a";
ruAlpha["б"] = "b";
ruAlpha["в"] = "v";
ruAlpha["г"] = "g";
ruAlpha["д"] = "d";
ruAlpha["е"] = "e";
ruAlpha["ё"] = "yo";
ruAlpha["ж"] = "zh";
ruAlpha["з"] = "z";
ruAlpha["и"] = "i";
ruAlpha["й"] = "y";
ruAlpha["к"] = "k";
ruAlpha["л"] = "l";
ruAlpha["м"] = "m";
ruAlpha["н"] = "n";
ruAlpha["о"] = "o";
ruAlpha["п"] = "p";
ruAlpha["р"] = "r";
ruAlpha["с"] = "s";
ruAlpha["т"] = "t";
ruAlpha["у"] = "u";
ruAlpha["ф"] = "f";
ruAlpha["х"] = "h";
ruAlpha["ц"] = "ts";
ruAlpha["ч"] = "ch";
ruAlpha["ш"] = "sh";
ruAlpha["щ"] = "sh";
ruAlpha["ы"] = "y";
ruAlpha["э"] = "e";
ruAlpha["ю"] = "yu";
ruAlpha["я"] = "ya";
ruAlpha[" "] = "-";
ruAlpha["–"] = "-";
ruAlpha["_"] = "_";
ruAlpha["0"] = "0";
ruAlpha["1"] = "1";
ruAlpha["2"] = "2";
ruAlpha["3"] = "3";
ruAlpha["4"] = "4";
ruAlpha["5"] = "5";
ruAlpha["6"] = "6";
ruAlpha["7"] = "7";
ruAlpha["8"] = "8";
ruAlpha["9"] = "9";


function in_array_by_key(needle, haystack, strict) {
	var found = false, key, strict = !!strict;
	for (key in haystack) {
		if (key === needle) {
			found = true;
			break;
		}
	}
	return found;
}

function transliteMe(val) {
	
	if (val.length>255) {
		val=val.substr(255); 
		}
	
	val = val.toLowerCase();

	var newStr = '';
	for(i = 0; i < val.length; i++) {
		curChar = val.charAt(i);
		curCharCode = val.charCodeAt(i);
				
		if (curCharCode==10) {
				newStr=newStr+'-';
		}
		else
		if (in_array_by_key(curChar, ruAlpha)) {
			newStr=newStr+ ruAlpha[curChar];
		}
		else if (!in_array_by_key(curChar, bad_simbols))	 {
			newStr=newStr+ curChar;
		}
	}

	return newStr;
}
