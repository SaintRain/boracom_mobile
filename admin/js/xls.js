scriptExecute = 30000;

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

xmlHttp=getXmlHttp();

function GetElementById(id){
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


var d = document;
var allTasks=Array();	//список всех заданий
var started=false;
var runSim=-1;
var handleId=null;
var ind=0;

function classEdit(){
	javascript:window.open('http://sergeev.in/temp/updateAccountNumbers/clasessForGroup.php?id='+GetElementById('group_id').value,'','…')
}

/////////////////Добавить задание
function addTask() {

	xmlObj=getXmlHttp();

	var time = Math.random();

	settings='&group_id='+GetElementById('group_id').value;
	settings+='&start_date='+GetElementById('start_date').value;
	settings+='&end_date='+GetElementById('end_date').value;
	settings+='&period='+GetElementById('period').value;

	settings+='&g1s1='+GetElementById('g1s1').value;
	settings+='&g1s2='+GetElementById('g1s2').value;
	settings+='&g1u1='+GetElementById('g1u1').value;
	settings+='&g1u2='+GetElementById('g1u2').value;

	settings+='&g2s1='+GetElementById('g2s1').value;
	settings+='&g2s2='+GetElementById('g2s2').value;
	settings+='&g2s3='+GetElementById('g2s3').value;
	settings+='&g2s4='+GetElementById('g2s4').value;
	settings+='&g2u1='+GetElementById('g2u1').value;
	settings+='&g2u2='+GetElementById('g2u2').value;
	settings+='&g2u3='+GetElementById('g2u3').value;
	settings+='&g2u4='+GetElementById('g2u4').value;

	settings+='&g3s1='+GetElementById('g3s1').value;
	settings+='&g3s2='+GetElementById('g3s2').value;
	settings+='&g3s3='+GetElementById('g3s3').value;
	settings+='&g3s4='+GetElementById('g3s4').value;
	settings+='&g3s5='+GetElementById('g3s5').value;
	settings+='&g3u1='+GetElementById('g3u1').value;
	settings+='&g3u2='+GetElementById('g3u2').value;
	settings+='&g3u3='+GetElementById('g3u3').value;
	settings+='&g3u4='+GetElementById('g3u4').value;
	settings+='&g3u5='+GetElementById('g3u5').value;

	settings+='&g4s1='+GetElementById('g4s1').value;
	settings+='&g4s2='+GetElementById('g4s2').value;
	settings+='&g4u1='+GetElementById('g4u1').value;
	settings+='&g4u2='+GetElementById('g4u2').value;

	if (GetElementById('notAddDeadCell').checked) v=1;
	else v=0;
	settings+='&notAddDeadCell='+v;

	settings+='&dead_period='+GetElementById('dead_period').value;

	if (GetElementById('active').checked) v=1;
	else v=0;

	settings+='&active='+v;

	settings+='&cell_count='+GetElementById('cell_count').value;
	settings+='&period_dlitsa='+GetElementById('period_dlitsa').value;

	xmlObj.open("GET", "taskQ.php?func=addTask"+settings+"&time="+time , false);

	xmlObj.send(null);
	if(xmlObj.status == 200) {
		addTaskGet(xmlObj);
	}
}



function addTaskGet(xmlObj) {
	if (xmlObj.readyState == 4) {
		// получаем ответ скрипта
		var response = xmlObj.responseText;
		if (response=='ok') refreshData();
		else if (response=='baddate'){
			alert('Конечная дата не может быть раньше стартовой!!');
		}
		else if (response=='bad_settings') {
			alert('Неверные параметры группы!');
		}
		else alert('Такое задание уже добавлено!');

	}
}


/////////////старт симулятора
function perebor() {
	ind++;

	if (handleId!=null) {
		clearInterval(handleId);
	}

	if (ind-1==allTasks.length) {
		runSim=-1;
		handleId=null;
		refreshData();
	}
	else {
		set=GetElementById('iswork'+allTasks[ind-1][0]);
		if (allTasks[ind-1][1]<100 && set.checked) {
			if (handleId!=null) {
				runSim=allTasks[ind-1][0];
				refreshData();
			}
			else {
				zapustitSimulator(allTasks[ind-1][0]);
			}
			handleId=setInterval("perebor()", scriptExecute+ 5000);
		}
		else {
			perebor();
		}
	}

}



function start_simulator() {

	if (!started) {
		started=true;
		GetElementById('start_button').value='Остановить';
		runSim=-1;
		handleId=null;
		ind=0;
		perebor();
	}
	else {
		clearInterval(handleId);
		runSim=-1;
		handleId=null;
		ind=0;
		started=false;
		GetElementById('start_button').value='Старт';
		refreshData();
	}
}



function zapustitSimulator(timeout_id) {

	currentImage=GetElementById('statusImg'+timeout_id);
	currentImage.src='img/load.gif';
}


function zapustitSimulatorGet(xmlObj) {
	if (xmlObj.readyState == 4) {

		delete xmlObj;
	}
}



function refreshData() {
	GetElementById('start_button').disabled=true;
	GetElementById('add_task_button').disabled=true;
	refreshTasks();
}



//рисуем форму заданий и их положение
function drawTasks() {

	var imgMaxWidth=260;
	var tbody = GetElementById('tasks_table').getElementsByTagName('TBODY')[0]; // Находим нужную таблицу

	tr_count=tbody.rows.length;
	for (i=0; i<tr_count; i++) {
		tbody.deleteRow(0);
	}

	var r = d.createElement("TR");// Создаем строку таблицы и добавляем ее
	tbody.appendChild(r);

	// Создаем ячейки в вышесозданной строке
	// и добавляем тх
	var t1 = d.createElement("TD");
	var t2 = d.createElement("TD");
	var t3 = d.createElement("TD");
	var t4 = d.createElement("TD");
	var t5 = d.createElement("TD");


	t1.innerHTML ='Задание';
	t2.innerHTML ='Обработано';
	t3.innerHTML ='Окончание';
	t4.innerHTML ='Считать';
	t5.innerHTML ='';

	t1.width='10%';
	t2.width='50%';
	t3.width='130';
	t4.width='30';

	r.appendChild(t1);
	r.appendChild(t2);
	r.appendChild(t3);
	r.appendChild(t4);
	r.appendChild(t5);

	for (i=0; i<allTasks.length; i++) {

		task=allTasks[i];

		var row = d.createElement("TR");// Создаем строку таблицы и добавляем ее

		tbody.appendChild(row);

		// Создаем ячейки в вышесозданной строке
		// и добавляем тх
		var td1 = d.createElement("TD");
		var td2 = d.createElement("TD");
		var td3 = d.createElement("TD");
		var td4 = d.createElement("TD");
		var td5 = d.createElement("TD");
		var td6 = d.createElement("TD");

		// Наполняем ячейки
		info='<b>'+task[4]+'</b><br>Cтартовая дата: <b>'+task[3]+'</b><br>Конечная дата: <b>'+task[2]+'</b><br>Период: <b>'+task[5]+'</b> минут';
		if (task[1]==100) {
			imgRes='<a target=_blank href=showResult.php?timeout_id='+task[0]+'><img id=statusImg'+task[0]+' border=0 onmouseover="tooltip.show(\''+info+'\')" onmouseout="tooltip.hide()" src="img/search.png"></a>';
		}
		else {
			imgRes='<img id=statusImg'+task[0]+' border=0 onmouseover="tooltip.show(\''+info+'\')" onmouseout="tooltip.hide()" src="img/drawing.png">';
		}

		td1.innerHTML =imgRes;
		imgWidth=task[1]*(imgMaxWidth/100);

		td2.innerHTML ='<font class="small_text" id=procents'+task[0]+'>'+task[1]+'%</font><table border="0" cellpadding="0" cellspacing="0"><tr><td><img src="img/left_vote.gif"></td><td><img id="img_progress'+task[0]+'" width='+imgWidth+' height="7" src="img/line_vote.gif"></td><td><img src="img/right_vote.gif"</td></tr></table>';
		td3.innerHTML ='<input onchange="setEndDate(this, '+task[0]+')" readonly name="end_date'+task[0]+'" id="end_date'+task[0]+'" style="width:130;cursor:pointer;" value="'+task[2]+'">';


		if (task[6]==1) ch='checked ';
		else ch='';

		td4.innerHTML ='<input style="border:0" onClick="setStatus(this, '+task[0]+')" id="iswork'+task[0]+'" '+ch+' type="checkbox" value="1">';
		td5.innerHTML ='<img title="Удалить" style="cursor:pointer;" border=0 src="img/delete.gif" onclick="deleteTask('+task[0]+')">&nbsp;&nbsp;&nbsp;<img title="Очистить" style="cursor:pointer" border=0 src="img/basket.png" onclick="cleanTask('+task[0]+')">';
		td6.innerHTML='<input title="Смотреть настройки" style="border:0" name="selected_task" id="selected_task" onClick="javascript: setSettings('+task[0]+')" type=radio value='+task[0]+'>';

		td5.className='alignCenter';
		td4.className='alignCenter';

		row.appendChild(td1);
		row.appendChild(td2);
		row.appendChild(td3);
		row.appendChild(td4);
		row.appendChild(td5);
		row.appendChild(td6);
		Calendar.setup({inputField : "end_date"+task[0], ifFormat : "%Y-%m-%d %H:%M:00", button: "end_date"+task[0]});
	}

	GetElementById('start_button').disabled=false;
	GetElementById('add_task_button').disabled=false;
}


//загружаем настройки задачи
function setSettings(timeout_id) {
	xmlObj=getXmlHttp();

	var time = Math.random();
	xmlObj.open("GET", "taskQ.php?func=getSettings&timeout_id="+timeout_id+"&time="+time , false);
	xmlObj.send(null);
	if(xmlObj.status == 200) {
		setSettingsGet(xmlObj)
	}

}


function setSettingsGet(xmlObj) {
	if (xmlObj.readyState == 4) {
		var response = xmlObj.responseText;

		m=response.split('|');
		for (i=0; i<m.length-1; i=i+2){

			if (m[i]=='notAddDeadCell' || m[i]=='active') {
				if (m[i+1]==1) GetElementById(m[i]).checked=true;
				else GetElementById(m[i]).checked=false;
			}
			else{

				GetElementById(m[i]).value=m[i+1];
			}
		}

		delete xmlObj;
	}
}


function cleanTask(timeout_id) {
	if (confirm('Вы действительно хотите очистить это задание?')) {
		xmlObj=getXmlHttp();

		var time = Math.random();
		xmlObj.open("GET", "taskQ.php?func=cleanTask&timeout_id="+timeout_id+"&time="+time , false);
		xmlObj.send(null);
		if(xmlObj.status == 200) {
			cleanTaskGet(xmlObj)
		}
	}
}



function cleanTaskGet(xmlObj) {
	if (xmlObj.readyState == 4) {
		delete xmlObj;
		refreshData();
	}
}



function deleteTask(timeout_id) {
	if (confirm('Вы действительно хотите удалить это задание?')) {
		xmlObj=getXmlHttp();

		var time = Math.random();
		xmlObj.open("GET", "taskQ.php?func=deleteTask&timeout_id="+timeout_id+"&time="+time , false);
		xmlObj.send(null);
		if(xmlObj.status == 200) {
			deleteTaskGet(xmlObj)
		}
	}
}


function deleteTaskGet(xmlObj) {
	if (xmlObj.readyState == 4) {
		delete xmlObj;
		refreshData();
	}
}


/////////ставим настройку обрабатывать данную задачу
function setStatus(el, timeout_id) {
	xmlObj=getXmlHttp();

	if (el.checked) status=1;
	else status=0;

	var time = Math.random();
	xmlObj.open("GET", "taskQ.php?func=setStatus&timeout_id="+timeout_id+"&status="+status+"&time="+time , false);
	xmlObj.send(null);
	if(xmlObj.status == 200) {
		setStatusGet(xmlObj)
	}

}

function setStatusGet(xmlObj) {

	if (xmlObj.readyState == 4) {
		// получаем ответ скрипта
		var response = xmlObj.responseText;

		delete xmlObj;
	}
}



/////////обновляем конечную дату
function setEndDate(el, timeout_id) {

	for (i=0; i<allTasks.length; i++) {
		if (allTasks[i][0]==timeout_id) {
			old=allTasks[i][2];
			break;
		}
	}

	end_datetime=el.value;

	xmlObj=getXmlHttp();

	var time = Math.random();
	xmlObj.open("GET", "taskQ.php?func=updateEndDate&timeout_id="+timeout_id+"&end_date="+end_datetime+"&time="+time , false);
	xmlObj.send(null);
	if(xmlObj.status == 200) {
		setEndDateGet(xmlObj, el,old);
	}
}



function setEndDateGet(xmlObj, el, old) {

	if (xmlObj.readyState == 4) {
		// получаем ответ скрипта
		var response = xmlObj.responseText;
		delete xmlObj;

		if (response=='ok') {
			refreshData();
		}
		else if (response=='baddate'){
			el.value=old;
			alert('Конечная дата не может быть раньше стартовой!');
		}
		else {
			el.value=old;
			alert('Неправильная дата!');
		}
	}
}



///подключаемся к серверу и берём все задания
function refreshTasks() {
	if (!xmlHttp) 	xmlHttp=getXmlHttp();

	var time = Math.random();
	xmlHttp.open("GET", "taskQ.php?func=getTasks&time="+time , true);

	xmlHttp.onreadystatechange=refreshTasksGet;
	xmlHttp.send(null);
}


function refreshTasksGet() {

	if (xmlHttp.readyState == 4) {
		// получаем ответ скрипта
		var response = xmlHttp.responseText;

		m=response.split('?');

		allTasks=Array();
		for (i=0; i<m.length-1; i++){
			allTasks[i]=m[i].split('|');
		}

		drawTasks();
		if (runSim>-1) zapustitSimulator(runSim);

		if (ind-1==allTasks.length) {
			flag=false;
			for (i=0; i<allTasks.length; i++) {
				set=GetElementById('iswork'+allTasks[i][0]);
				if (allTasks[i][1]<100 && set.checked) {
					flag=true;
					break;
				}
			}

			ind=0;
			if (flag) {
				started=true;
				runSim=-1;
				handleId=null;
				perebor();
			}
			else {
				started=false;
				GetElementById('start_button').value='Старт';
				alert('Все задачи выполнены!');
			}
		}
	}
}



function activateSettings() {
	if (confirm('Вы действительно хотите назначить эти настройки рабочей группе?')) {

		xmlObj=getXmlHttp();

		var time = Math.random();

		settings='&group_id='+GetElementById('group_id').value;

		settings+='&profit_period='+GetElementById('g1s1').value;
		settings+='&loss_period_for_set='+GetElementById('g1s2').value;
		settings+='&profit_period_for_unset='+GetElementById('g1u1').value;
		settings+='&loss_period='+GetElementById('g1u2').value;

		settings+='&equity_profit='+GetElementById('g2s1').value;
		settings+='&equity_profit_periods='+GetElementById('g2s2').value;
		settings+='&equity_loss_for_set2='+GetElementById('g2s3').value;
		settings+='&equity_loss_periods_for_set='+GetElementById('g2s4').value;
		settings+='&equity_profit_for_unset='+GetElementById('g2u1').value;
		settings+='&equity_profit_periods_for_unset='+GetElementById('g2u2').value;
		settings+='&equity_loss='+GetElementById('g2u3').value;
		settings+='&equity_loss_periods='+GetElementById('g2u4').value;

		settings+='&nominal_profit_for_set='+GetElementById('g3s1').value;
		settings+='&equity_loss_for_set='+GetElementById('g3s2').value;
		settings+='&nominal_ubil_for_set='+GetElementById('g3s3').value;
		settings+='&nominal_ubil_for_set_period='+GetElementById('g3s4').value;
		settings+='&treyling_set='+GetElementById('g3s5').value;
		settings+='&nominal_uvelichenie_for_unset='+GetElementById('g3u1').value;
		settings+='&nominal_uvelichenie_for_unset_period='+GetElementById('g3u2').value;
		settings+='&nominal_profit_for_unset='+GetElementById('g3u3').value;
		settings+='&equity_loss_for_unset='+GetElementById('g3u4').value;
		settings+='&treyling_unset='+GetElementById('g3u5').value;

		settings+='&equity_zalog_for_set='+GetElementById('g4s1').value;
		settings+='&valatilnost_profit_for_set='+GetElementById('g4s2').value;
		settings+='&equity_zalog_for_unset='+GetElementById('g4u1').value;
		settings+='&valatilnost_profit_for_unset='+GetElementById('g4u2').value;

		if (GetElementById('notAddDeadCell').checked) v=1;
		else v=0;
		settings+='&disable_dead_cell='+v;

		settings+='&dead_cell_periods='+GetElementById('dead_period').value;

		if (GetElementById('active').checked) v=1;
		else v=0;

		settings+='&enable_cell='+v;

		settings+='&cell_count='+GetElementById('cell_count').value;
		settings+='&hours_in_period='+GetElementById('period_dlitsa').value;

		xmlObj.open("GET", "taskQ.php?func=activateSettings"+settings+"&time="+time , false);
		xmlObj.send(null);
		if(xmlObj.status == 200) {
			activateSettingsGet(xmlObj);
		}
	}
}



function activateSettingsGet(xmlObj) {
	if (xmlObj.readyState == 4) {
		// получаем ответ скрипта
		var response = xmlObj.responseText;
		if (response=='ok') {
			alert('Параметры назначены!');
		}
		else
		alert('Ошибка! Парметры не назначены!');
	}
}
