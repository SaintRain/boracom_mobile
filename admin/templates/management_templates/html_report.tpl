<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<title>«{$table_name}»</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>{literal}
<style>
.caption {
	color:black;
	font-family: Arial, Verdana, Helvetica, sans-serif;
	font-size:12px;
	font-weight:normal;
	background-color:#dcdcdc;
}
.text {
	color:black;
	font-family: Arial, Verdana, Helvetica, sans-serif;
	font-size:12px;
	font-weight:normal;
	margin-bottom:5px;
}
.tdline {
	border-bottom:1px solid #dcdcdc;
	border-left:1px solid #dcdcdc;
	border-right:1px solid #dcdcdc;
	color:black;
	font-family: Arial, Verdana, Helvetica, sans-serif;
	font-size:12px;
	font-weight:normal;
}
</style>{/literal}
</head>
<body>
<table width="100%" cellpadding="2" cellspacing="1" border="0">
<tr nowrap class="caption">
{foreach from=$fields item=field}
{if $field.edittype_id!=12 && $field.edittype_id!=10}
{assign var='check' 	value=$field.fieldname}
{if isset($fieldsExportSettings.$check)}
<td {if $field.edittype_id==5 || $field.edittype_id==9 || $field.edittype_id==10 || $field.edittype_id==11 || $field.edittype_id==12} align="center" style="width:5%"{else} style="width:{$field.width_percent}%"{/if} nowrap><b>&nbsp;{if $field.comment!=''}{$field.comment}{else}{$field.fieldname}{/if}&nbsp;</b></td>
{/if}
{/if}
{/foreach}
</tr>
{foreach name="data_rows" from=$needData item=item}
<tr>
{foreach name="fieldlist" from=$fields item=field}
{if  $field.edittype_id!=12 && $field.edittype_id!=10}
{assign var='check' 	value=$field.fieldname}
{if isset($fieldsExportSettings.$check)}
<td class="tdline" {if $field.edittype_id==5 || $field.edittype_id==9 || $field.edittype_id==10 || $field.edittype_id==11 || $field.edittype_id==12} align="center" {/if} valign="top">{assign var="ind" value=$field.fieldname}
{if $item.$ind!=''}
{if $field.edittype_id!=5}
{if $field.datatype_id==9 || $field.datatype_id==10}
{$item.$ind|make_price}
{else}
{if $field.edittype_id==1 || $field.edittype_id==2 || $field.edittype_id==7 || $field.edittype_id==8}
{$item.$ind|strip_tags}
{else}
{if $field.edittype_id==3 || $field.edittype_id==6}
{assign var='sourse_values' 	value="list_`$field.fieldname`"}
{if $field.datatype_id!=24 && $field.datatype_id!=25}
{assign var='sourse_list' 		value=$field.$sourse_values}
{assign var='sourse_field_name' value=$field.sourse_field_name}
{assign var='source_id' 		value="id`$item.$ind`"}
{if isset($sourse_list.$source_id.$sourse_field_name)}{$sourse_list.$source_id.$sourse_field_name}<br>{else}<font color="Gray">{$MSGTEXT.report_not_set}</font>{/if}
{else}
{if $item.$ind}{$item.$ind}{else}<font color="Gray">{$MSGTEXT.report_not_set}</font>{/if}
{/if}
{else}
{if $field.edittype_id==4}
{assign var='sourse_values' 	value="list_`$field.fieldname`"}
{foreach name='foreach_multy' from=$item.$sourse_values item=m}
{if $m!=''}
<li>{$m}</li><br>{else}<font color="Gray">{$MSGTEXT.report_not_set}</font>{/if}
{/foreach}
{else}
{if $field.edittype_id==13}
{assign var='sourse_values' 	value="list_`$field.fieldname`"}
{assign var='sourse_list' 		value=$field.$sourse_values}
{assign var='source_id' 		value="id`$item.$ind`"}
{if isset($sourse_list.$source_id.name)}{$sourse_list.$source_id.name}<br>{else}<font color="Gray">{$MSGTEXT.report_not_set}</font>{/if}
{else}
{if $field.edittype_id==9 || $field.edittype_id==10}
{if $item.$ind}
{$item.$ind}
{/if}
{else}
{if $field.edittype_id==11 || $field.edittype_id==12}
{if $item.$ind}
{$item.$ind}
{/if}
{else}
{$item.$ind}{/if}{/if}{/if}{/if}{/if}{/if}{/if}
{else}
{if $item.$ind==1}
{$MSGTEXT.report_yes}{else}{$MSGTEXT.report_no}{/if}{/if}{else}&nbsp;{/if}</td>
{/if}{/if}
{/foreach}
{/foreach}</td></tr>
</table>
<font class="text">{$total}</font>
</body>
</html>