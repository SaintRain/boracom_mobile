{literal} 
<script language="JavaScript">
var doc = document;
var counter={/literal}{$LANGUAGES_OF_MATERIAL|@count}{literal};
var tr_objects=new Array();

function addField() {
	counter++;
	// Находим нужную таблицу
	var tbody = doc.getElementById('tab1').getElementsByTagName('TBODY')[0];
	// Создаем строку таблицы и добавляем ее
	var row = doc.createElement("TR");
	row.id='newRow'+counter;
	tr_objects[row.id]=tbody.appendChild(row);

	// Создаем ячейки в вышесозданной строке
	// и добавляем тх
	var td1 = doc.createElement("TD");
	var td2 = doc.createElement("TD");
	var td3 = doc.createElement("TD");
	var td4 = doc.createElement("TD");
	var td5 = doc.createElement("TD");

	row.appendChild(td1);
	row.appendChild(td2);
	row.appendChild(td3);
	row.appendChild(td4);
	row.appendChild(td5);

	// Наполняем ячейки
	td1.innerHTML ='<input type="text" value="" name="id[]" style="width:100%">';
	td2.innerHTML ='<input type="text" value="" name="prefix[]" style="width:100%">';
	td3.innerHTML ='<input type="text" value="" name="caption[]" style="width:100%">';
	td4.innerHTML ='<input type="text" value="" name="sort_index[]" style="width:100%">';
	td5.innerHTML = '';
}
</script>
{/literal}
{if $errorMsgs}
{foreach from=$errorMsgs item=error}
<p style="margin-bottom:10px"><font color="yellow">{$error}</font></p>
{/foreach}
{/if}
<form id="data form" action="?act=languagesofmaterial&do=saveedit" method="POST" style="margin:0px">
  {if $messages}
  <p style="margin-bottom:10px"><font id="messagetext" color="yellow">{$messages}</font></p>
  <script language="JavaScript">Morphing("messagetext", false)</script> 
  {/if}
  <table cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td><a href="?act=languagesofmaterial&do=dictionary_edit"><img border="0" title="{$MSGTEXT.classeslanguagesofmaterial_dictionary_e}" src="images/accessories-dictionary.png"></a></td>
      <td width="10px"></td>
      <td><a href="?act=languagesofmaterial&do=dictionary_edit"><b>{$MSGTEXT.classeslanguagesofmaterial_dictionary_e}</b></a></td>
    </tr>
  </table>
  <br>
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr>
      <td>
          <table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
              <tr>
                  <td>
          <table id="tab1" width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tbody>
            <tr>
              <td width="10%"><b>{$MSGTEXT.classeslanguagesofmaterial_id}</b></td>
              <td width="35%"><b>{$MSGTEXT.classeslanguagesofmaterial_prefix}</b></td>
              <td width="40%"><b>{$MSGTEXT.classeslanguagesofmaterial_caption}</b></td>
              <td width="10%"><b>{$MSGTEXT.classeslanguagesofmaterial_sort_index}</b></td>
              <td width="5%"><b>{$MSGTEXT.classeslanguagesofmaterial_del}</b></td>
            </tr>
          {foreach name="langs" from=$LANGUAGES_OF_MATERIAL item=item}
          <tr id="newRow{$smarty.foreach.langs.iteration}">
            <td><input type="text" {if $item.id_edit==1} style="width:100%"{else}readonly style="width:100%;color:gray"{/if} value="{$item.id}" name="id[]"></td>
            <td><input type="text" name="prefix[]" value="{$item.prefix}" style="width:100%"></td>
            <td><input type="text" name="caption[]" value="{$item.caption}" style="width:100%"></td>
            <td><input type="text" name="sort_index[]" value="{$item.sort_index}" style="width:100%"></td>
            <td align="center"><input type="checkbox" name="delete[]" value="{$smarty.foreach.langs.iteration}"></td>
          </tr>
          {/foreach}
            </tbody>          
        </table>
        </td>
    </tr>
  </table>
      </td>
    </tr>
  </table>
  <br>
  <input class="button" type="button" onclick="addField()" value="{$MSGTEXT.classeslanguagesofmaterial_add}" style="width:100px">
  <input class="button" type="submit" value="{$MSGTEXT.classeslanguagesofmaterial_save}" style="width:100px">
</form>