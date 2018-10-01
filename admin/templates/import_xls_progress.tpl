<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>{$MSGTEXT.import_xls_title}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="StyleSheet" href="css/general.css">
<script type="text/javascript" language="javascript" src="js/xls.js"></script>
</head>
<body LEFTMARGIN="0pt" TOPMARGIN="0pt" bgcolor="#70a8d1">
<br>
<script language="JavaScript">
var total_records		= {$total_records}; //всего записей на вставку
var inserted_records	= 0;				//добавленно записей
var oshibka_dobavleno 	= 0;				//ошибка добавления записей
var	limitRecords 		= 50;				//лимит добавления за 1 вызов

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
	xmlhttp.open('GET', 'import_xls.php?insert=true&t_name={$smarty.get.t_name}&price_type={$smarty.get.price_type}&page_id={$smarty.get.page_id}&tag_id={$smarty.get.tag_id}&lang_id={$smarty.get.lang_id}&limitRecords='+limitRecords+'&time'+time, true);
	{literal}

	xmlhttp.onreadystatechange = function() {

		if (xmlhttp.readyState == 4) {
			if(xmlhttp.status == 200) {
				var response	= xmlhttp.responseText;

				var r_check	=/^\d*\|\d*$/g;

				var result=r_check.test(response);
				if (result) {
					mas					= response.split('|');
					inserted_records	= inserted_records + parseInt(mas[0]);
					oshibka_dobavleno	= oshibka_dobavleno + parseInt(mas[1]);
					drawProgress();

					if ((inserted_records+oshibka_dobavleno)<total_records)	startWork();
					else {
						GetElementById('msg_done').innerHTML={/literal}"{$MSGTEXT.import_xls_complete}";{literal};
						GetElementById('load_status').src='images/xls/done.png';
					}
				}
				else {
					GetElementById('msg_done').innerHTML={/literal}"{$MSGTEXT.import_xls_error}<br><br><font style='color:white'>"+response+"</font><br>";{literal};
					GetElementById('load_status').src='images/xls/error.png';
				}

				delete xmlhttp;
			}
		}
	};
	xmlhttp.send(null);
}


function drawProgress () {
	GetElementById('dobavleno').innerHTML=inserted_records;
	GetElementById('error_dobavleno').innerHTML=oshibka_dobavleno;

	newWidth=(inserted_records/(total_records/100))*4.28;
	if (isNaN(newWidth)) newWidth=429;
	else newWidth.toFixed();
	

	GetElementById('progress_bar').style.width=newWidth+'px';
}
</script> 
{/literal}
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-image: url('images/zero.gif');"></td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td><table align="center" cellpadding="1" cellspacing="0" bgcolor="#4D6E8A" border="0">
        <tr>
          <td><table width="450px" style="height:170px" align="center" class="formbackground" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="2" align="center"><p><b>{$MSGTEXT.import_xls_caption_process}</b> </td>
              </tr>
              <tr>
                <td align="left">
                <table align="left" border="0" cellpadding="10" cellspacing="0">
                    <tr>
                      <td align="right">
                      <table align="center" border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
                          <tr>
                            <td align="left" valign="top" height="100%">
                             <p style="margin-top:5px"><font id="msg_done" style="margin:5px;color:yellow"></font></p>
                            <p> {$MSGTEXT.import_xls_aded} <font id="dobavleno">0</font><br>
                                {$MSGTEXT.import_xls_add_error} <font id="error_dobavleno">0</font><br>
                                {$MSGTEXT.import_xls_total} <font id="ostalos">{$total_records}</font></p>
                              <img id="load_status" src="images/xls/load.gif" align="middle" border="0"> <img src="images/xls/page_excel.png" align="middle" border="0">
                              <table border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                  <tr>
                                    <td width="6px"><img width="6px" hspace="0" src="images/xls/left_vote.gif"></td>
                                    <td width="1px"><img width="1px" height="7" id="progress_bar" hspace="0" src="images/xls/line_vote.gif"></td>
                                    <td width="6px"><img width="6px" hspace="0" src="images/xls/right_vote.gif"></td>
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
</body>
</html>