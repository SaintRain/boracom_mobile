{literal}
<script type="text/javascript" src="js/translit.js"></script>
<script language="JavaScript">

function Mysubmit(form) {
	s=form.name.value;
	if (s=='') {
		form.name.focus(); alert("{$MSGTEXT.pages_edit_mess_err_name"); return false
	};
	return true;
}


function set_status_for_checkbox(manager) {
	el=GetElementById('disable_cache_if_get');
	if (manager.checked) {
		el.disabled=false;
	}
	else {
		el.disabled=true;
	}
}

var check_translite	= false;


function set_status_for_translite_name(translite) {
	if (translite.checked) {
		check_translite=true;
		transliteMe(GetElementById('description').value);
	}
	else {
		check_translite=false;
		GetElementById('transVal').value = "{/literal}{$name}{literal}" ;
	}
}


function checkTotransliteMe(val) {
	if (check_translite) {
		newStr=transliteMe(val);
		GetElementById('transVal').value = newStr;
	}
}
</script>
{/literal}

<form id="data form" action="?act=pages&page_id={$id}{if $page_category}&pageCategoryId={$page_category}{/if}&do=saveedit" method="POST" onsubmit="return Mysubmit(this)" style="margin:0">
  <input name="id" value="{$id}" type="hidden">
  <p style="margin-bottom:10px"><font color="yellow">{$message}</font></p>
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr><td>
    <table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
	<tr>
	<td>     
      <table class="formbackground" width="100%" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td valign="top">{$MSGTEXT.pages_edit_description}</td>
          <td><table cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td width="100%"><input type="text" id="description" name="description" style="width:100%" value="{$description}" onkeyup="javascript:checkTotransliteMe(this.value)"></td>
                <td>&nbsp;&nbsp;</td>
                <td nowrap><table border="0" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td><input value="1" type="checkbox" id="setTranslit" onclick="javascript:set_status_for_translite_name(this)"></td>
                      <td>&nbsp;{$MSGTEXT.pages_edit_translit_mess}</td>
                    </tr>
                  </table>
                  </td>
              </tr>
            </table>
            </td>
        </tr>
        <tr>
          <td width="100px">{$MSGTEXT.pages_edit_name_page} <font color="yellow">*</font></td>
          <td><input type="text" style="width:100%" name="name" value="{$name}" id="transVal"></td>
        </tr>
        <tr>
          <td>{$MSGTEXT.pages_edit_tamplate} <font color="yellow">*</font></td>
          <td><select name="templates_id" style="width:100%">
              <option style="color:gray" value="0" {$list.selected}>{$MSGTEXT.pages_edit_no_tamplate}
              {foreach from=$templates item=list}
              <option value="{$list.id}" {if $list.id==$templates_id} selected {/if}>{$list.tpl_name} &rarr; {$list.name}
              {/foreach}
            </select>
            </td>
        </tr>
        <tr>
          <td>{$MSGTEXT.pages_edit_category} </td>
          </td>        
          <td><select name="page_category" id="page_category" style="width:100%">
              <option value="0" style="color:gray">{$MSGTEXT.pages_edit_no_parent}
              {if $pageCategories}
              {foreach from=$pageCategories item=list}
              <option value="{$list.id}" {if $page_category==$list.id} selected {/if}> {section name=foo start=0 loop=$list.deep step=1}&nbsp;&nbsp;&nbsp;&nbsp;{/section}{$list.name}
              {/foreach}
              {/if}
            </select>
            </td>
        </tr>
        <tr>
          <td></td>
          <td><table border="0" cellpadding="0" cellspacing="0" >
              <tr>
                <td><input value="1" type="checkbox" class="checkbox" {if $enable==true} checked {/if} name="enable" id="enable"></td>
                <td>&nbsp;{$MSGTEXT.pages_edit_publish}</td>
                <td width="15px"></td>
                <td><input value="1" type="checkbox" {if $cache==true} checked {/if} onclick="javascript:set_status_for_checkbox(this)" name="cache" id="cache"></td>
                <td>&nbsp;{$MSGTEXT.pages_edit_cached}</td>
                <td width="15px"></td>
                <td><input value="1" type="checkbox"  {if !$cache} disabled {/if} {if $disable_cache_if_get==true} checked {/if} name="disable_cache_if_get" id="disable_cache_if_get"></td>
                <td>&nbsp;{$MSGTEXT.pages_edit_mess_cache}</td>
                <td width="15px"></td>
                <td><input value="1" type="checkbox" {if $selected==true} checked {/if} name="selected" id="selected"></td>
                <td>&nbsp;{$MSGTEXT.pages_edit_page_marked}</td>
              </tr>
            </table>
            </td>
        </tr>
        <tr>
          <td colspan="100%" height="10px"></td>
        </tr>
        <tr>
          <td></td>
          <td><input class="button" type="submit" value="{$MSGTEXT.pages_edit_save}" style="width:120px"></td>
        </tr>
      </table>
        </td>
    </tr>
  </table>
      </td>
    </tr>
  </table>  
</form>