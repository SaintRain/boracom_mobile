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


function delete_cat(action){
	if (confirm("{/literal}{$MSGTEXT.pages_category_form_del_mes}{literal}")) {
		set_action(action)
	}
}


function set_action(action) {
	f=GetElementById('data form');
	f.action=action;
	f.submit();
}


function set_value(sel) {
	if (sel.options[sel.selectedIndex].value>0) {

		GetElementById('butedit_category').disabled=false;
		GetElementById('butdelete_category').disabled=false;
		GetElementById('butput_category').disabled=false;
		txt=sel.options[sel.selectedIndex].text;

		var buf="";
		flag=false;
		for (i=0; i<txt.length; i++) {
			if (flag==false) {
				if (txt.charCodeAt(i)!=160) {
					flag=true;
				}
			}
			if (flag) {
				buf=buf+txt.charAt(i);
			}
		}

		GetElementById('name_category').value=buf;
	}
	else {
		GetElementById('butedit_category').disabled=true;
		GetElementById('butdelete_category').disabled=true;
		GetElementById('butput_category').disabled=true;

		GetElementById('name_category').value='';
	}
}


function moveUp() {
	sel=GetElementById('pageCategory');
	if (sel.selectedIndex>0) {
		id=sel.options[sel.selectedIndex].value;
		location.href="?act=pages&do=moveCategory&type=up&id="+id;
	}
}


function moveDown() {
	sel=GetElementById('pageCategory');
	if (sel.selectedIndex<sel.options.length-1) {
		id=sel.options[sel.selectedIndex].value;
		location.href="?act=pages&do=moveCategory&type=down&id="+id;
	}
}
{/literal}{if $refreshFrame} reloadLeftFrame(); {/if}
</script>

<form id="data form" name="data" action="?act=pages&do=category_create" method="POST" style="margin:0">
  <p style="margin-bottom:10px"><font color="yellow">{$message}</font></p>
  <table style="width:100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
	<table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
	<tr>
	<td>           
      <table style="width:100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td></td>
            <td valign="top">{$MSGTEXT.pages_category_form_cat} </td>
          </tr>
          <tr>
            <td style="width:10px"><img vspace="5" style="cursor:pointer" onclick="javascript: moveUp()" src="images/icons/moveUp.gif" border=0 alt="{$MSGTEXT.pages_category_form_up}"><br>
              <img vspace="5" style="cursor:pointer" onclick="javascript: moveDown();" src="images/icons/moveDown.gif" border=0 alt="{$MSGTEXT.pages_category_form_down}"></td>
            <td style="width:100%"><select name="pageCategory" onChange="set_value(this)" id="pageCategory" style="width:100%;height:300px" size="20">
                <option value="0" style="color:gray">{$MSGTEXT.pages_category_form_par}
                {if $pageCategories}
                {foreach from=$pageCategories item=list}
                <option value="{$list.id}" {if $catSelected==$list.id} selected {/if}> {section name=foo start=0 loop=$list.deep step=1}&nbsp;&nbsp;&nbsp;&nbsp;{/section}{$list.name}
                {/foreach}
                {/if}
              </select>
              </td>
          </tr>
          <tr>
            <td colspan="2" valign="top">{$MSGTEXT.pages_category_form_name_cat}<br>
              <input type="text" style="width:100%" name="name" id="name_category" value="{$catName}"></td>
          </tr>
          <tr>
            <td colspan="2"><input type="button" class="button" onclick="javascript: set_action('?act=pages&do=category_create');" value="{$MSGTEXT.pages_category_form_create}" style="width:120px">
              <input {if !$catSelected}disabled{/if} id="butedit_category" name="butedit" type="button" class="button" onclick="javascript: set_action('?act=pages&do=category_update');" value="{$MSGTEXT.pages_category_form_save}" style="width:120px;">
              <input {if !$catSelected}disabled{/if} id="butdelete_category" name="butdelete" type="button" class="button" onclick="javascript: delete_cat('?act=pages&do=category_delete');" value="{$MSGTEXT.pages_category_form_del}" style="width:120px;">
              <input {if !$catSelected}disabled{/if} id="butput_category" name="butput" type="button" class="button" onclick="javascript: set_action('?act=pages&do=category_put');" value="{$MSGTEXT.pages_category_form_move}" style="width:120px;"></td>
          </tr>
        </table>
        </td>
  	  </tr>
  	</table>
      </td>
    </tr>
  </table>  
</form>