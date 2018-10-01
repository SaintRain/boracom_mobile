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
</script>
{/literal}

<form id="data form" name="data" action="?act=pages&do=category_putdo" method="POST" style="margin:0">
  <input name="cat_id" type="hidden" value="{$cat_id}">
  <p style="margin-bottom:10px"><font color="yellow">{$message}</font></p>
  <p>{$pages_category_putform_move_cat}</p>
  <table style="width:100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      
	<table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
	<tr>
	<td>              
      <table style="width:100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td valign="top">{$MSGTEXT.pages_category} </td>
          </tr>
          <tr>
            <td style="width:100%"><select name="pageCategory" onChange="set_value(this)" id="pageCategory" style="width:100%;height:400px" size="20">
                <option value="0" style="color:gray">{$MSGTEXT.pages_category_putform_par}
                {if $pageCategories}
                {foreach from=$pageCategories item=list}
                <option value="{$list.id}" {if $catSelected==$list.id} selected {/if}> {section name=foo start=0 loop=$list.deep step=1}&nbsp;&nbsp;&nbsp;&nbsp;{/section}{$list.name}
                {/foreach}
                {/if}
              </select></td>
          </tr>
          <tr>
            <td><input type="submit" class="button" value="{$MSGTEXT.pages_category_putform_move}" style="width:120px"></td>
          </tr>
        </table>
        </td>
    	</tr>
  		</table>
       </td>
    </tr>
  </table>  
</form>