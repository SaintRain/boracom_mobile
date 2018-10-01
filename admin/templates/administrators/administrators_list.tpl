{literal} 
<script language="JavaScript">
function setcolor(obj) {
	obj.style.background='#FFF2BE';
}
function unsetcolor(obj) {
	obj.style.background='white';
}
function q(){
	{/literal}
	return confirm("{$MSGTEXT.want_del_record}");
	{literal}
}
</script> 
{/literal}
{if $error}
<p style="color:yellow">
  {foreach from=$error item=e}
  {$e}<br>
  {/foreach} </p>
{/if}
<p style="margin-top:10px;margin-bottom:10px">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=administrators&do=form_add">{$MSGTEXT.add_new_admin}</a></td>
  <td width="10px"></td>
  <td valign="middle"><img src='images/uses_grpoups.png'></td>
  <td valign="middle">&nbsp;<a href="?act=administrators&do=group_edit">{$MSGTEXT.edit_group}</a></td>
</tr>
</table>
</p>
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor="#ccdbe6">
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="top_list" >
          <td width="30%" nowrap><b><a href="?act=administrators&sort_by=login&sort_type={$sort_type}">{$MSGTEXT.login}</a> {if $sort_by=='login'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="30%"><b><a href="?act=administrators&sort_by=email&sort_type={$sort_type}">{$MSGTEXT.email}</a> {if $sort_by=='email'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="30%"><b><a href="?act=administrators&sort_by=name&sort_type={$sort_type}">{$MSGTEXT.group}</a> {if $sort_by=='name'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="40px" colspan="2"><b>{$MSGTEXT.edit}</td>
        </tr>
        {foreach from=$administrators item=list}
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)" >
          <td>{$list.login}</td>
          <td><a class="list" href="mailto:{$list.email}">{$list.email}</a></td>
          <td>{if $list.name}{$list.name}{else}{$MSGTEXT.superadmin}{/if}</td>
          <td width="40px" align='right'><a href="?act=administrators&do=edit&id={$list.id}"><img border="0" alt="{$MSGTEXT.edit}" src="images/edit.gif"></a></td>
          <td align="center"><a href="?act=administrators&do=delete&id={$list.id}" onclick='return q();'><img border="0" alt="{$MSGTEXT.delete}" src="images/del_b.gif"></a></td>
        </tr>
        {/foreach}
      </table></td>
  </tr>
</table>