<html>
<head>
<title>{$MSGTEXT.export_title}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="StyleSheet" href="css/general.css">
<script language="JavaScript">
{literal}
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


function CheckAll(Element) {
	var thisCheckBoxes=GetElementById('data form');
	for (var i = 1; i < thisCheckBoxes.length; i++) {
		if (thisCheckBoxes[i].type=='checkbox' && thisCheckBoxes[i].id!=Element.id) {
			thisCheckBoxes[i].checked = Element.checked;
		}
	}
}
{/literal}
</script>
</head>
<body LEFTMARGIN="0pt" TOPMARGIN="0pt" bgcolor="#70a8d1">
<br>
<table  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-image: url('images/zero.gif');"></td>
  </tr>
</table>
<table border='0' cellpadding="0" cellspacing="0" width="100%">
  <tr>
  <td>
  
  <table align="center" cellpadding="1" cellspacing="0" bgcolor="#4D6E8A" border="0">
    <tr><td>
      <table width="450px" style="height:170px" align="center" class="formbackground" border="0" cellpadding="5" cellspacing="0">
        <tr>
          <td colspan="2" align="center"><p><b>{$export_caption}</b>
            <p> {if $msgs}
            <p style=' color:#b1ff88'><b>{$msgs}</p>
            {/if} </td>
        </tr>
        {if $error}
        <tr>
          <td align="center" colspan="3"><p style=' color:red'>{$error}</p></td>
        </tr>
        {/if}
        <tr>
          <td align="left">
          <form id="data form" action="export_data.php?saveExportSettings=true&page_id={$page_id}&tag_id={$tag_id}&mdo=form_data&p={$p_num}&sort_by={$sort_by}&sort_type={$sort_type}&hide_menu=true&lang_id={$lang_id}{if $smarty.get.filter_for_table}&filter_for_table={$smarty.get.filter_for_table}{/if}&t_name={$table.table_name}&create_report=true" method="post" enctype="multipart/form-data">
              <table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="left"  valign="middle" width="10px"><input id="select_all" onClick="CheckAll(this)" type="checkbox" value="1" ></td>
                  <td colspan="2" width="100%" align="left" valign="middle">&nbsp;<b>{$MSGTEXT.export_sel_all_fields}</b></td>
                </tr>
                {foreach from=$fields item=item}
                {if ($item.active || $item.fieldname=='id') && $item.edittype_id!=12 && $item.edittype_id!=10 && $item.edittype_id!=7 && $item.edittype_id!=8}
                <tr style="height:20px">
                  <td align="left"  valign="middle" width="15px"><input {if isset($item.export_this_field)} checked {/if} value="1" type="checkbox" name="{$item.fieldname}"></td>
                  <td align="left" valign="middle" nowrap>&nbsp;{$item.comment}</td>
                  <td align="left" valign="middle" width="100%" nowrap>
                  {if $item.edittype_id==3 || $item.edittype_id==4 || $item.edittype_id==5 || $item.edittype_id==6}
                    <table align="left" border="0" cellpadding="0" cellspacing="0">
                	<tr>
						<td>&nbsp;&nbsp;<input {if $fieldsSettings[$item.fieldname].show_id} checked {/if} value="1" type="checkbox" name="{$item.fieldname}+id"><td>
						<td>&nbsp;{$MSGTEXT.export_show_id}</td>
					</tr>
					</table>
                  {/if}
                  </td>
                </tr>
                {/if}
                {/foreach}
                <tr>
                  <td colspan="3" height="10px"></td>
                </tr>
                <tr>
                  <td colspan="3">
                  <table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td>{$MSGTEXT.export_format}&nbsp;</td>
                        <td><select name="report_type">
                            <option value="html_report">Html</option>
                            <option value="csv_report">Excel .csv</option>
                          </select></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td colspan="3" style="height:10px"></td>
                </tr>
                <tr>
                  <td colspan="3" style="height:1px" bgcolor="#558ab1"></td>
                </tr>
                <tr>
                  <td colspan="3" style="height:5px"></td>
                </tr>
                <tr>
                  <td colspan="3" align="center"><input type="submit" class="button" style="width:200px" value="{$MSGTEXT.export_button}"></td>
                </tr>
              </table>
            </form>
        </tr>
        </td>        
      </table>
    </td>
    </tr>    
  </table>
  </td>
  </tr>
</table>
<br>
&nbsp;
</body>
</html>