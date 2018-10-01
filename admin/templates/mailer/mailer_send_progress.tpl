<script language="JavaScript">
var total_records		= {$total_records}; //всего записей на вставку
var inserted_records	= 0;				//добавленно записей
var oshibka_dobavleno 	= 0;				//ошибка добавления записей
var	limitRecords 		= 10;				//лимит рассылки писем за 1 вызов
var pause				= 10000;			//пауза в милисекундах, чтоб не заспамили

{literal}

//обновляет состояние парсинга, сколько осталось
function refreshData() {
	GetElementById('start_button').disabled=true;
	GetElementById('add_task_button').disabled=true;
	refreshTasks();
}


function startWork() {
	var xmlhttp = getXmlHttp();
	var time = Math.random();
	{/literal}
	xmlhttp.open('GET', 'email_sender.php?limitRecords='+limitRecords+'{if $atachName!=''}&atachName={$atachName}{/if}&time='+time, true);
	{literal}

	xmlhttp.onreadystatechange = function() {

		if (xmlhttp.readyState == 4) {
			if(xmlhttp.status == 200) {
				var response		= xmlhttp.responseText;

				mas					= response.split('|');
				if (!mas[1]) alert('ERROR \r\n'+response);
				inserted_records	= inserted_records + parseInt(mas[0]);
				oshibka_dobavleno	= oshibka_dobavleno + parseInt(mas[1]);

				drawProgress();
				delete xmlhttp;
				if ((inserted_records+oshibka_dobavleno)<total_records)	{
					window.setTimeout(startWork, pause);
				}
				else {
					GetElementById('msg_done').innerHTML={/literal}"{$MSGTEXT.classesmailer_progress_complete}";{literal};
					GetElementById('load_status').src='images/mailer/done.png';
				}
			}
		}
	};
	xmlhttp.send(null);
}


function drawProgress () {
	GetElementById('dobavleno').innerHTML=inserted_records;
	GetElementById('error_dobavleno').innerHTML=oshibka_dobavleno;

	var total	= oshibka_dobavleno+inserted_records;

	newWidth=(total/(total_records/100))*4.28;
	if (isNaN(newWidth)) newWidth = 428;
	else newWidth.toFixed();

	GetElementById('progress_bar').style.width=newWidth;
}
</script>

{/literal}
<p style="margin-top:10;margin-bottom:10">

     
<table align="left" cellpadding="1" cellspacing="0"  class="formborder" border="0">
	<tr>
     <td>
    <table align="left" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
        <tr>
          <td>
          <table width="450px" style="height:170px" align="center" class="formbackground" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="2" align="center"><p style='margin-left:0px; margin-top:10px; margin-bottom:0'><b>{$MSGTEXT.classesmailer_progress_title}</b>                  
                  <p style="margin-top:5px"><font id="msg_done" style="margin:5px;color:yellow"></font></p></td>
              </tr>
              <tr>
                <td align="left">
                <table align="left" border="0" cellpadding="10" cellspacing="0">
                    <tr>
                      <td align="right"><table align="center" border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
                          <tr>
                            <td valign="top" height="100%"><p style="margin-bottom:5px">
                              
                              <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                  <td>{$MSGTEXT.classesmailer_progress_razoslano}</td>
                                  <td>&nbsp;<font id="dobavleno">0</font></td>
                                </tr>
                                <tr>
                                  <td>{$MSGTEXT.classesmailer_progress_errors}</td>
                                  <td>&nbsp;<font id="error_dobavleno">0</font></td>
                                </tr>
                                <tr>
                                  <td>{$MSGTEXT.classesmailer_progress_ostalos}</td>
                                  <td>&nbsp;<font id="ostalos">{$total_records}</td>
                                </tr>
                              </table>
                              </p>
                              <img id="load_status" src="images/mailer/load.gif" align="middle" border="0"> <img src="images/mailer/mail.png" align="middle" border="0">
                              <table border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                  <tr>
                                    <td width="6px"><img width="6px" hspace="0" src="images/mailer/left_vote.gif"></td>
                                    <td width="1px"><img width="1px" height="7" id="progress_bar" hspace="0" src="images/mailer/line_vote.gif"></td>
                                    <td width="6px"><img width="6px" hspace="0" src="images/mailer/right_vote.gif"></td>
                                  </tr>
                                </tbody>
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
<script language="JavaScript">
startWork();
</script>