{literal}
<script language="JavaScript">

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

function CheckAll(Element, Name) {
	thisCheckBoxes = Element.parentNode.parentNode.parentNode.getElementsByTagName("input");
	for (i = 1; i < thisCheckBoxes.length; i++) {
		if (thisCheckBoxes[i].name == Name) {
			thisCheckBoxes[i].checked = Element.checked;

			last=thisCheckBoxes[i].id;
			t=last.split(' ');
		}
	}
}
function setcolor(obj) {
	obj.style.background='#7dc7ff';
}
function unsetcolor(obj) {
	obj.style.background='#629bc8';
}

function setLang(obj) {
	l_e=document.getElementById('lang_edit').value;
	location.href='?act=languagesofmaterial&do=dictionary_edit&lang_edit='+l_e;
}

</script>
{/literal}
<table cellpadding="0" cellspacing="0" border="0">  
    <td>&larr; <a href="?act=languagesofmaterial&page"><b>{$MSGTEXT.classeslanguagesofmaterial_d_back}</b></a></td>
  </tr>
</table>
<br>
{if $errorMsgs}
{foreach from=$errorMsgs item=error}
<p style="margin-bottom:10"><font color="yellow">{$error}</font></p>
{/foreach}
{/if}

{$MSGTEXT.classeslanguagesofmaterial_dict_sel}
<select onchange="setLang(this)" name="lang_edit" id="lang_edit" >
  <option value="" style="color:gray">{$MSGTEXT.classeslanguagesofmaterial_dict_not_set}</option>  
{foreach from=$LANGUAGES_OF_MATERIAL item=item}
  <option {if $smarty.get.lang_edit==$item.id} selected {/if} value="{$item.id}">{$item.caption}</option>  
{/foreach}
</select>
{if $smarty.get.lang_edit!=''}
{if $messages}
<p style="margin-bottom:10px"><font id="messagetext" color="yellow">{$messages}</font></p>
<script language="JavaScript">Morphing("messagetext", false)</script> 
{else}
<br/><br/>
{/if}
<form id="data form" action="?act=languagesofmaterial&do=dictionary_save&lang_edit={$smarty.get.lang_edit}" method="POST" style="margin:0px">
  {if $current_dictionary|@count>20}
  <input class="button" type="submit" value="{$MSGTEXT.classeslanguagesofmaterial_save}" style="width:100px" >
  <br>
  <br>
  {/if}
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr>
      <td>
          <table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
              <tr>
                  <td>
          <table id='tab1' width="100%" class="formbackground" border="0" cellpadding="1" cellspacing="1">
          <tbody>
            <tr>
              <td width="47%" nowrap><b>{$MSGTEXT.classeslanguagesofmaterial_d_lk}</b></td>
              <td width="48%"><b>{$MSGTEXT.classeslanguagesofmaterial_d_perevod}</b></td>
              <td width="5%" align="center"><b>{$MSGTEXT.classeslanguagesofmaterial_del}</b><br>
                <input onClick="CheckAll(this, 'delete[]');" id="main CheckBox" type="checkbox" value="1"></td>
            </tr>
          {foreach name="langs" from=$current_dictionary item=item}
          <tr onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)" id="newRow{$smarty.foreach.langs.iteration}">
            <td>{$item.phrase|htmlspecialchars}</td>
            <td>
            {if $item.edit_type=='textarea'}
              <textarea name="perevod[]" style="width:100%" rows="4">{if $item.perevod!=$item.phrase}{$item.perevod|htmlspecialchars}{/if}</textarea>
              {else}
              <input type="text" name="perevod[]" value="{if $item.perevod!=$item.phrase}{$item.perevod|htmlspecialchars}{/if}" style="width:100%">
              {/if} </td>
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
  <input class="button" type="submit" value="{$MSGTEXT.classeslanguagesofmaterial_save}" style="width:100px">
</form>
{/if}