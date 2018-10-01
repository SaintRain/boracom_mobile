<?php /* Smarty version 2.6.26, created on 2018-09-26 06:16:37
         compiled from modules/modules_form_import_progress.tpl */ ?>
<script language="JavaScript">
<?php echo $this->_tpl_vars['t_info']; ?>

var module_name			= "<?php echo $this->_tpl_vars['module_name']; ?>
";
var workFuncsIndex 		= 0;
var total_records		= <?php echo $this->_tpl_vars['total_records']; ?>
;
var total_obrabotano 	= 0;
var obrabotano 			= 0;
var limit 				= 50;
<?php echo '

function startWork() {

	var xmlhttp 			= getXmlHttp();
	var time 				= Math.random();
	var table_name			= t_info[workFuncsIndex][\'table_name\'];
	var table_data_count	= t_info[workFuncsIndex][\'table_data_count\'];

	xmlhttp.open(\'GET\', \'importTablesData.php?module_name=\'+module_name+\'&table_name=\'+table_name+\'&limit=\'+limit+\'&start=\'+obrabotano+\'&time=\'+time, true);

	xmlhttp.onreadystatechange = function() {

		if (xmlhttp.readyState == 4) {
			if(xmlhttp.status == 200) {
				var response		= xmlhttp.responseText;

				//если успешно
				if (response==1 || response==\'1\') {

					if (table_data_count<limit) {
						obrabotano=table_data_count;
					}
					else if (obrabotano+limit>table_data_count) {
						obrabotano=table_data_count;
					}
					else {
						obrabotano=obrabotano+limit;
					}

					if (obrabotano<table_data_count) {
						total_obrabotano=total_obrabotano+obrabotano;
						drawProgress();
						startWork();
					}
					else {
						workFuncsIndex++;

						if (workFuncsIndex<t_info.length) {
							total_obrabotano=total_obrabotano+obrabotano;
							obrabotano=0;
							drawProgress();
							startWork();
						}
						else {
							total_obrabotano=total_records;
							drawProgress();
							GetElementById(\'msg_done\').innerHTML='; ?>
"<?php echo $this->_tpl_vars['MSGTEXT']['import_module_ok']; ?>
";<?php echo ';
							GetElementById(\'load_status\').src=\'images/progress/done.png\';
						}
					}
				}
				//вывод ошибки
				else {
					GetElementById(\'msg_done\').innerHTML='; ?>
"<?php echo $this->_tpl_vars['MSGTEXT']['import_module_error']; ?>
";<?php echo ';
					GetElementById(\'load_status\').src=\'images/progress/error.png\';
					addMessageToReport(response);	//записываем ответ сервера
				}
			}
		}
	}
	xmlhttp.send(null);
}


function addMessageToReport(mes) {
	GetElementById(\'report_of_saving\').innerHTML=GetElementById(\'report_of_saving\').innerHTML+mes+\'<br>\';
}


function drawProgress () {

	newWidth=(workFuncsIndex/(t_info.length/100))*4.16;
		
	if (isNaN(newWidth)) newWidth = 416;
	else newWidth.toFixed();
	
	GetElementById(\'progress_bar\').style.width=newWidth+\'px\';
}
</script>
'; ?>


<?php if ($this->_tpl_vars['messages']): ?>
<?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['m']):
?>
	<p style="color:yellow"><?php echo $this->_tpl_vars['m']; ?>
</p>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>


<p style="margin-top:10px;margin-bottom:10px">
<table align="left" cellpadding="1" cellspacing="0" class="formborder" border="0">
  <tr>
    <td>
      <table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
        <tr>
        <td>    
    <table width="450px" style="height:100px" align="center" class="formbackground" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2" align="center"><p style="margin-left:0px; margin-top:10px; margin-bottom:0"><b><?php echo $this->_tpl_vars['import_tablesdata_title']; ?>
</b>
            
            <p style="margin-top:5px"><font id="msg_done" style="margin:5px;color:yellow"></font></p></td>
        </tr>
        <tr>
          <td align="left"><table align="left" border="0" cellpadding="10" cellspacing="0">
              <tr>
                <td align="right"><table align="center" border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td valign="top" height="100%">
                      <font id="report_of_saving"></font>
                      
						<table border="0" cellpadding="0" cellspacing="0">
                        	<tr>
                            	<td align="left"><img id="load_status" src="images/progress/load.gif" border="0"></td>
                                <td align="left"><img src="images/progress/import.png"  border="0"></td>
                                </tr>
						</table>
                      
       
                        <table border="0" cellpadding="0" cellspacing="0">
                          <tbody>
                            <tr>
                              <td width="6px"><img width="6px" hspace="0" src="images/progress/left_vote.gif"></td>
                              <td width="1px"><img width="1px" height="7" id="progress_bar" hspace="0" src="images/progress/line_vote.gif"></td>
                              <td width="6px"><img width="6px" hspace="0" src="images/progress/right_vote.gif"></td>
                            </tr>
                          </tbody>
                        </table>
                        </td>
                    </tr>
                  </table></td>
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