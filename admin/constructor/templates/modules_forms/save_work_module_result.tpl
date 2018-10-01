<script language="JavaScript">
var workFuncs 			= new Array('makeFilesDump', 'makeTablesDump', 'saveChanges', 'deleteFilesDump', 'deleteTablesDump');
var restoreFuncs 		= new Array('restoreFilesDump', 'restoreTablesDump');
var cleanFuncs 			= new Array('deleteFilesDump', 'deleteTablesDump');

var workFuncsMessages	= new Array("{$MSGTEXT.save_work_module_msg_makeFilesDump}", "{$MSGTEXT.save_work_module_msg_makeTablesDump}", "{$MSGTEXT.save_work_module_msg_saveChanges}", "{$MSGTEXT.save_work_module_msg_deleteFilesDump}", "{$MSGTEXT.save_work_module_msg_deleteTablesDump}");
var restoreFuncsMessages= new Array("{$MSGTEXT.save_work_module_msg_restoreFilesDump}", "{$MSGTEXT.save_work_module_msg_restoreTablesDump}");
var cleanFuncsMessages	= new Array("{$MSGTEXT.save_work_module_msg_deleteFilesDump}", "{$MSGTEXT.save_work_module_msg_deleteTablesDump}");

var workFuncsIndex 		= 0;
var restoreFuncsIndex 	= 0;
var is_restore			= false;
{if $workFuncs}
var workFuncs			= {$workFuncs};
{/if}

{if $workFuncsMessages}
var workFuncsMessages	= {$workFuncsMessages};
{/if}

{literal}


function startWork() {

	addMessageToReport(workFuncsMessages[workFuncsIndex]);	//записываем ответ сервера

	var xmlhttp 	= getXmlHttp();
	var time 		= Math.random();
	var funcName	= workFuncs[workFuncsIndex];

	xmlhttp.open('GET', 'saveChangesToModule.php?func='+funcName+'&time='+time, true);

	xmlhttp.onreadystatechange = function() {

		if (xmlhttp.readyState == 4) {
			if(xmlhttp.status == 200) {
				var response		= xmlhttp.responseText;

				//если успешно
				if (response==1 || response=='1') {
					//если еще не все функции выполнились
					if (workFuncsIndex<workFuncs.length-1) {

						workFuncsIndex++;
						drawProgress();
						startWork();
					}
					else {
						workFuncsIndex=workFuncs.length;
						drawProgress();
						if (!is_restore) {

							if (workFuncs.length==5) {
								GetElementById('msg_done').innerHTML={/literal}"{$MSGTEXT.save_work_module_mess}";{literal};
								GetElementById('load_status').src='images/save_progress/done.png';
							}
							else	{
								GetElementById('msg_done').innerHTML={/literal}"{$MSGTEXT.save_work_module_mess2}";{literal};
								GetElementById('load_status').src='images/save_progress/error.png';
							}

						}
						else {
							GetElementById('msg_done').innerHTML={/literal}"{$MSGTEXT.save_work_module_error_save_error}";{literal};
							GetElementById('load_status').src='images/save_progress/error.png';
						}
					}
				}
				//если произошла ошибка запускаем восстановление
				else {
					if (!is_restore && funcName!='deleteFilesDump' && funcName!='deleteTablesDump') {

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
						GetElementById('msg_done').innerHTML={/literal}"{$MSGTEXT.save_work_module_error_restore}";{literal};
						GetElementById('load_status').src='images/save_progress/error.png';
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


function drawProgress () {

	newWidth=(workFuncsIndex/(workFuncs.length/100))*4.16;
	if (isNaN(newWidth)) newWidth = 416;
	else newWidth.toFixed();
	GetElementById('progress_bar').style.width=newWidth+'px';
}

</script>
{/literal}


<p style="margin-top:10px;margin-bottom:10px">
<table align="left" border='0' cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td><table align="left" cellpadding="1" cellspacing="0" bgcolor="#4D6E8A" border="0">
        <tr>
          <td><table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
              <tr>
                <td><table width="450px" style="height:170" align="center" class="formbackground" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="2" align="center"><p style='margin-left:0px; margin-top:10px; margin-bottom:0'><b>{$MSGTEXT.save_work_module_title}</b>                        
                        <p style="margin-top:5px"><font id="msg_done" style="margin:5px;color:yellow"></font></p></td>
                    </tr>
                    <tr>
                      <td align="left">
                      <table align="left" border="0" cellpadding="10" cellspacing="0">
                          <tr>
                            <td align="right">
                            <table align="center" border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td valign="top" height="100%" align="left">
                                  {if $editError}
                                    {foreach from=$editError item=error}
                                    <p style="margin-bottom:10px"><font color="yellow">{$error}</font></p>
                                    {/foreach}
                                    {else}
                                    <p style="margin-bottom:5px">
                                    <table cellpadding="0" cellspacing="0" border="0">
                                      <tr>
                                        <td valign="top" align="left"><i><b>{$MSGTEXT.save_work_module_report_title}</b></i></td>
                                      </tr>
                                      <tr>
                                        <td style="height:100px" valign="top" align="left" id="report_of_saving"></td>
                                      </tr>
                                    </table>
                                    </p>
                                    <table border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td align="left"><img id="load_status" src="images/save_progress/load.gif" border="0"></td>
                                        <td align="left"><img src="images/save_progress/save.png"  border="0"></td>
                                        </tr>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0">
                                      <tbody>
                                        <tr>
                                          <td width="6px"><img width="6px" hspace="0" src="images/save_progress/left_vote.gif"></td>
                                          <td width="1px"><img width="1px" height="7" id="progress_bar" hspace="0" src="images/save_progress/line_vote.gif"></td>
                                          <td width="6px"><img width="6px" hspace="0" src="images/save_progress/right_vote.gif"></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    
                                    <script language="JavaScript">startWork()</script> 
                                    
                                    {/if}
                                    </td>
                                </tr>
                              </table>
                              </td>
                          </tr>
                        </table>
                        </td>
                    </tr>
                  </table>
                  </td>
              </tr>
            </table>
            </td>
        </tr>
      </table>
      </td>
  </tr>
</table>