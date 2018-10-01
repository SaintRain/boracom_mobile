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
	{/literal}
	if (confirm('{$MSGTEXT.want_delete_group}')) {literal}{
		set_action(action)
	}
}

function set_action(action) {
	f=GetElementById('data');
	f.action=action;
	f.submit();
}

function set_value(sel) {
	if (sel.options[sel.selectedIndex].value>0) {

		GetElementById('butedit').disabled=false;
		GetElementById('butdelete').disabled=false;

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

		GetElementById('name').value=buf;
	}
	else {
		GetElementById('butedit').disabled=true;
		GetElementById('butdelete').disabled=true;


		GetElementById('name').value='';
	}
}

function moveUp() {
	sel=GetElementById('group_id');
	if (sel.selectedIndex>0) {
		id=sel.options[sel.selectedIndex].value;
		location.href="?act=administrators&do=group_move&type=up&id="+id;
	}
}

function moveDown() {
	sel=GetElementById('group_id');
	if (sel.selectedIndex<sel.options.length-1) {
		id=sel.options[sel.selectedIndex].value;
		location.href="?act=administrators&do=group_move&type=down&id="+id;
	}
}
</script> 
{/literal}


<form id="data" name="data" action="?act=administrators&do=group_create" method="POST" style="margin:0px">
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
            <td valign="top">{$MSGTEXT.admin_groups}: </td>
          </tr>
          <tr>
            <td style="width:10"><img vspace="5" style="cursor:pointer" onclick="javascript: moveUp()" src="images/icons/moveUp.gif" border="0" alt="{$MSGTEXT.move_up}"><br>
              <img vspace="5" style="cursor:pointer" onclick="javascript: moveDown();" src="images/icons/moveDown.gif" border="0" alt="{$MSGTEXT.move_down}"></td>
            <td style="width:100%"><select multiple="multiple" name="group_id" onChange="set_value(this)" id="group_id" style="width:100%;height:400px" >
                
				{if $admin_groups}
				{foreach from=$admin_groups item=list}				
                <option value="{$list.id}" {if $groupSelected==$list.id} selected {/if}>{$list.name}</option>
                {/foreach}
                {/if}
              </select></td>
          </tr>
          <tr>
            <td colspan="2" valign="top">{$MSGTEXT.group_name}:<br>
              <input type="text" style="width:100%" name="name" id="name" value="{$groupName}"></td>
          </tr>
          <tr>
            <td colspan="2"><input type="button" class="button" onclick="javascript: set_action('?act=administrators&do=group_create');" value="{$MSGTEXT.create}" style="width:120px">
              <input {if !$groupSelected}disabled{/if} id="butedit" name="butedit" type="button" class="button" onclick="javascript: set_action('?act=administrators&do=group_update');" value="{$MSGTEXT.save}" style="width:120px;">
              <input {if !$groupSelected}disabled{/if} id="butdelete" name="butdelete" type="button" class="button" onclick="javascript: delete_cat('?act=administrators&do=group_delete');" value="{$MSGTEXT.delete}" style="width:120px;"></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
   </td>
  </tr>
  </table>  
</form>