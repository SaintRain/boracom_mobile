{literal} 
<script language="JavaScript">
function setcolor(obj) {
	obj.style.background='#FFF2BE';
}
function unsetcolor(obj) {
	obj.style.background='white';
}
function q(){
	return confirm("{/literal}{$MSGTEXT.css_list_alert_del}{literal}");
}
</script>
{/literal}
<p style="margin-top:10;margin-bottom:10">
  <table cellpadding="0" cellpadding="0" border="0">
<tr>
  <td valign="middle"><img src='images/addrecord.png'></td>
  <td valign="middle">&nbsp;<a href="?act=css&do=form_add">{$MSGTEXT.css_list_new}</a></td>
</tr>
</table>
</p>
<table border="0" width="100%" cellpadding="1" cellspacing="0">
  <tr bgcolor='#ccdbe6'>
    <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="top_list">
        <td width="50%"><b><a href="?act=css&sort_by=dir&sort_type={$sort_type}">{$MSGTEXT.css_list_dir}</a> {if $sort_by=='dir'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="20%"><b><a href="?act=css&sort_by=name&sort_type={$sort_type}">{$MSGTEXT.css_list_name}</a> {if $sort_by=='name'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          
          <td width="20%"><b><a href="?act=css&sort_by=mt&sort_type={$sort_type}">{$MSGTEXT.css_list_date_edit}</a> {if $sort_by=='mt'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td width="10%"><b><a href="?act=css&sort_by=size&sort_type={$sort_type}">{$MSGTEXT.css_list_size}</a> {if $sort_by=='size'}<img src='images/sort_{$sort_type}.gif' border='0' alt=''>{/if}</td>
          <td colspan="3"><b>{$MSGTEXT.css_delete}</td>
        </tr>
        {foreach from=$css item=list}
        <tr style="height:1px"></tr>
        <tr bgcolor='white' onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)">
          <td>{$list.dir}</td>
          <td>{$list.name}</td>          
          <td>{$list.modify}</td>
          <td>{$list.size} kb.</td>
          <td width="50px" align="center"><a href="?act=css&do=edit&fname={$list.dir}{$list.name}" ><img border="0" alt="{$MSGTEXT.css_list_edit}" src="images/edit.gif"></a></td>
          <td width="50px" align="center">{if !$list.sys}<a href="?act=css&do=delete&fname={$list.dir}{$list.name}" onclick='return q();'><img border="0" alt="{$MSGTEXT.css_delete}" src="images/del_b.gif"></a>{/if}</td>
        </tr>
        {/foreach}
      </table></td>
  </tr>
</table>