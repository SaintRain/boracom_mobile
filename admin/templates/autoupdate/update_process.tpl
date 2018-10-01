<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>{$MSGTEXT.autoupdate_title}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="StyleSheet" href="css/general.css">
<script language="JavaScript">
var zipfilename="{$zipfilename}";
{literal}

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

function GetElementById(id) {
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
{/literal}
var workFuncs 			= new Array( 'makeFilesDump', 'makeTablesDump', 'autoupdateFiles', 'autoupdateBD', 'deleteFilesDump', 'deleteTablesDump');

var restoreFuncs 		= new Array('restoreFilesDump', 'restoreTablesDump');
var cleanFuncs 			= new Array('deleteFilesDump', 'deleteTablesDump');

var workFuncsMessages	= new Array("{$MSGTEXT.autoupdate_msg_makeFilesDump}", "{$MSGTEXT.autoupdate_msg_makeTablesDump}", "{$MSGTEXT.autoupdate_msg_saveFilesChanges}", "{$MSGTEXT.autoupdate_msg_saveBDChanges}", "{$MSGTEXT.autoupdate_msg_deleteFilesDump}", "{$MSGTEXT.autoupdate_msg_deleteTablesDump}");
var restoreFuncsMessages= new Array("{$MSGTEXT.autoupdate_msg_restoreFilesDump}", "{$MSGTEXT.autoupdate_msg_restoreTablesDump}");
var cleanFuncsMessages	= new Array("{$MSGTEXT.autoupdate_msg_deleteFilesDump}", "{$MSGTEXT.autoupdate_msg_deleteTablesDump}");

var workFuncsIndex 		= 0;
var restoreFuncsIndex 	= 0;
var is_restore			= false;
{literal}


function startWork() {

	addMessageToReport(workFuncsMessages[workFuncsIndex]);	//записываем ответ сервера

	var xmlhttp 	= getXmlHttp();
	var time 		= Math.random();
	var funcName	= workFuncs[workFuncsIndex];

	xmlhttp.open('GET', 'autoupdate.php?func='+funcName+'&zipfilename='+zipfilename+'&time='+time, true);
	xmlhttp.onreadystatechange = function() {

		if (xmlhttp.readyState == 4) {
			if(xmlhttp.status == 200) {
				var response		= xmlhttp.responseText;

				//если успешно
				if (response==1 || response=='1') {
					//если еще не все функции выполнились
					if (workFuncsIndex<workFuncs.length-1) {
						workFuncsIndex++;
						drawautoupdate();
						startWork();
					}
					else {
						workFuncsIndex=workFuncs.length;
						drawautoupdate();
						if (!is_restore) {
							GetElementById('msg_done').innerHTML={/literal}"{$MSGTEXT.autoupdate_mess}";{literal};
							GetElementById('load_status').src='images/autoupdate/done.png';
						}
						else {
							GetElementById('msg_done').innerHTML={/literal}"{$MSGTEXT.autoupdate_error_save_error}";{literal};
							GetElementById('load_status').src='images/autoupdate/error.png';
						}
					}
				}
				//запускаем восстановление
				else {
					if (!is_restore) {

						if (workFuncsIndex<2) {	//очищаем таблицы
							workFuncs			= cleanFuncs;
							workFuncsMessages	= cleanFuncsMessages;
						}
						else {
							workFuncs			= restoreFuncs;
							workFuncsMessages	= restoreFuncsMessages;
						}

						is_restore			= true;
						workFuncsIndex		= 0;
						addMessageToReport(response);	//записываем ответ сервера
						startWork();
					}
					else {
						GetElementById('msg_done').innerHTML={/literal}"{$MSGTEXT.autoupdate_error_restore}";{literal};
						GetElementById('load_status').src='images/autoupdate/error.png';
						addMessageToReport(response);	//записываем ответ сервера
					}
				}
			}
		}
	}
	xmlhttp.send(null);
}


function addMessageToReport(mes) {
	GetElementById('report_of_saving').innerHTML=GetElementById('report_of_saving').innerHTML+mes+'<br>';
}


function drawautoupdate () {

	newWidth=(workFuncsIndex/(workFuncs.length/100))*4.16;
	if (isNaN(newWidth)) newWidth = 416;
	else newWidth.toFixed();	
	GetElementById('autoupdate_bar').style.width=newWidth+'px';
}

</script>
{/literal}
</head>
<body LEFTMARGIN="0pt" TOPMARGIN="0pt" bgcolor="#70a8d1">
<br>
<table  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-image: url('images/zero.gif');"></td>
  </tr>
</table>
<table border='0' cellpadding="0" cellspacing="0" width="100%">
  <tr>
  <td align="center">     
  <table class="formborder" border="0"  cellpadding="1" cellspacing="0">
    <tr>
    <td>
    <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
    <tr><td>     
      <table width="450px" style="height:170px" align="center" class="formbackground" border="0" cellpadding="5" cellspacing="0">
        <tr>
          <td colspan="2" align="center"><p style='margin-left:0px; margin-top:10px; margin-bottom:0'><b>{$MSGTEXT.autoupdate_update_progress}</b>
            <p style="margin-top:5px"> </td>
        </tr>
        {if $msgs}
        {foreach from=$msgs item=msg}
        <tr>
          <td align="center" colspan="2"><p style='margin:10px; color:#b1ff88'>{$msg}</p></td>
        </tr>
        {/foreach}
        {/if}
        
        {if $errors}
        {foreach from=$errors item=error}
        <tr>
          <td align="center" colspan="2"><p style='margin:10px; color:red'>{$error}</p></td>
        </tr>
        {/foreach}
        {/if}
        <tr>
          <td style="height:10px;color:yellow" valign="top" align="center" id="msg_done"></td>
        </tr>
        <tr>
          <td style="height:100px" valign="top" align="left" id="report_of_saving"></td>
        </tr>
        <tr>
          <td align="left"><img id="load_status" src="images/autoupdate/load.gif" align="middle" border="0"> <img src="images/autoupdate/update.png" align="middle" border="0">
            <table border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td width="6px"><img width="6px" hspace="0" src="images/autoupdate/left_vote.gif"></td>
                  <td width="1px"><img width="1px" height="7" id="autoupdate_bar" hspace="0" src="images/autoupdate/line_vote.gif"></td>
                  <td width="6px"><img width="6px" hspace="0" src="images/autoupdate/right_vote.gif"></td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        </td>        
      </table>
        </tr>
        </td>        
      </table>      
    </td>
    </tr>    
  </table>
  </td>
  </tr>  
</table>
<script language="JavaScript">
startWork();
</script>
</body>
</html>