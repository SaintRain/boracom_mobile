<script type="text/javascript" src="js/emails.js"></script>

{literal}
<script language="JavaScript">
function setcolor(obj) {
	obj.style.background='#FFF2BE';
}


function unsetcolor(obj) {
	obj.style.background='white';
}

function refresh() {
	if (confirm("{/literal}{$MSGTEXT.classesmailer_refresh_confirm}{literal}")) {
		location.href="?act=mailer&do=refresh&group_name="+GetElementById('group_name').value;
	}
}


function gotoGroupEmail(obj) {
	document.location.href='index.php?act=mailer&page&group_name='+obj.value;
}


function sendMessage() {
	GetElementById('email_contents').action='?act=mailer&do=send';
	GetElementById('email_contents').submit();
}


function saveMessage() {
	GetElementById('email_contents').action='?act=mailer&do=save&group_name={/literal}{$group_id}{literal}';
	GetElementById('email_contents').submit();
}
</script>
{/literal}


{if $group_id}
<form id="email_contents" action="?act=mailer&do=save&group_name={$group_id}" method="POST" enctype="multipart/form-data">
  {/if}
  <table cellpadding="0" cellpadding="0" border="0">
  <tr>
    <td><b>{$MSGTEXT.classesmailer_groups}</b>&nbsp;</td>
    <td valign="middle"><select onchange="gotoGroupEmail(this)" name="group_name" id="group_name" style="width:350px">
        <option value="0" style="color:gray">{$MSGTEXT.classesmailer_select_group}</option>        
{foreach from=$groups item=group}
        <option {if $group_id==$group.id} selected {/if} value="{$group.id}">{$group.email_group_name}</option>        
{/foreach}
      </select></td>
    <td width="5px">&nbsp;</td>
    <td valign="middle"><a title="{$MSGTEXT.classesmailer_edit_group}" href="javascript:getTemplate('editEmailGroup.tpl')"><img hspace="" vspace="" border="0" src="images/edit.png"></a></td>
    <td width="5px">&nbsp;</td>
    <td valign="middle"><a title="{$MSGTEXT.classesmailer_add_group}" href="javascript:getTemplate('addEmailGroup.tpl')"><img hspace="" vspace="" border="0" src="images/add_group.png"></a></td>
  </tr>
  </table>
  {if $group_id}
  <p style="margin-top:10px;margin-bottom:10px">
    <table cellpadding="0" cellpadding="0" border="0">
  <tr>
    <td valign="middle"><img src='images/reset.png'></td>
    <td valign="middle"><a href="javascript:refresh()">{$MSGTEXT.classesmailer_refresh}</a></td>
  </tr>
  </table>
  </p>
  {if $msgs}
  <p id="messagetext" style="color:yellow">{$msgs}</p>
  <script language="JavaScript">Morphing("messagetext", false)</script> 
  {/if}
  <table border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr bgcolor="#ccdbe6">
      <td><table border="0" width="100%" cellpadding="2" cellspacing="0">
          <tr class="top_list" >
            <td nowrap width="12%"><b>{$MSGTEXT.classesmailer_sourse_module}</b></td>
            <td nowrap width="22%"><b>{$MSGTEXT.classesmailer_sourse}</b></td>
            <td nowrap width="22%"><b>{$MSGTEXT.classesmailer_email}</b></td>
            <td nowrap width="22%"><b>{$MSGTEXT.classesmailer_name}</b></td>
            <td nowrap width="22%"><b>{$MSGTEXT.classesmailer_enable}</b></td>
            <td nowrap align="center" width="11%"><b>{$MSGTEXT.classesmailer_del}</b></td>
          </tr>
          {foreach from=$mailer_data item=list}
          <tr style="height:1px"></tr>
          <tr bgcolor="white" onMouseOver="setcolor(this)" onMouseOut="unsetcolor(this)">
            <td> {foreach from=$tables item=t}
              {if $t.id==$list.table_id} {$t.module_name} {break} {/if}
              {/foreach}
              {$list.module_name} </td>
            <td><input type="hidden" name="id[]" value="{$list.id}">
              {foreach from=$tables item=t}
              {if $t.id==$list.table_id} {$t.description} {break} {/if}
              {/foreach} </td>
            <td><select style="width:100%" name="email_{$list.id}">                
{foreach from=$tables item=t}
{if $t.id==$list.table_id} 
{foreach from=$t.fields item=fields}
                <option {if $fields.id==$list.email_field_id} selected {/if} value="{$fields.id}">{$fields.comment}</option>                
{/foreach}
{break}
{/if} 
{/foreach}
              </select></td>
            <td><select style="width:100%" name="name_{$list.id}">
                <option value="0" style="color:gray">{$MSGTEXT.classesmailer_not_set}</option>                
{foreach from=$tables item=t}
{if $t.id==$list.table_id} 
{foreach from=$t.fields item=fields}
                <option {if $fields.id==$list.name_field_id} selected {/if} value="{$fields.id}">{$fields.comment}</option>                
{/foreach}
{break}
{/if} 
{/foreach}
              </select></td>
            <td><select style="width:100%" name="enable_{$list.id}">
                <option value="0" style="color:gray">{$MSGTEXT.classesmailer_not_set}</option>                
{foreach from=$tables item=t}
{if $t.id==$list.table_id} 
{foreach from=$t.fields item=fields}
{if $fields.datatype_id==27}
                <option {if $fields.id==$list.enable_field_id} selected {/if} value="{$fields.id}">{$fields.comment}</option>                
{/if}
{/foreach}
{break}
{/if} 
{/foreach}
              </select></td>
            <td align="center"><input type="checkbox" value="{$list.id}" name="delete[]"></td>
          </tr>
          {/foreach}
        </table></td>
    </tr>
  </table>
  <p style="text-align:right;margin-top:5px">
    <input style="width:130px" type="button" onclick="saveMessage()" value="{$MSGTEXT.classesmailer_save}" class="button">
  </p>
  <i>{$finded}</i>
  <textarea style="width:100%" rows="10">
{foreach from=$emails key="email" item=name}
{$email}
{/foreach}
</textarea>
  
  
  {if $messages}
  <center>
    {foreach from=$messages item=item}
    <p style="color:yellow;margin:5px">{$item}</p>
    {/foreach}
  </center>
  {/if}
  <center>
    <i>{$MSGTEXT.classesmailer_vnimanie}</i>
  </center>
  <br>
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td bgcolor="#558ab1" height="1px"></td>
    </tr>
  </table>
  <br>
  <center>
    {$MSGTEXT.classesmailer_makros_text}
  </center>
  <br>
  <table width="100%">
  <tr>
    <td><p style="margin-top:5px;margin-bottom:5px"><i>{$MSGTEXT.classesmailer_subject}</i></p>
      <input type="text" name="subject" value="{$message.subject}" style="width:100%">
      <p style="margin-top:5px;margin-bottom:5px"><i>{$MSGTEXT.classesmailer_text}</i></p>
      <textarea name="text" id="text" style="height:300px;width:100%">{$message.message}</textarea>
      <p style="margin-top:5px;margin-bottom:5px"><i>{$MSGTEXT.classesmailer_podpis}</i></p>
      <textarea name="makros_text" id="makros_text" style="height:100;width:100%">{$message.signature}</textarea>
      <i>{$MSGTEXT.classesmailer_atach}</i><br>
      <input type="file" name="filename" style="width:100%">
      <p style="text-align:center;margin-top:10px">
        <input type="button" onclick="saveMessage()" value="{$MSGTEXT.classesmailer_save}" class="button" style="width:130px">
        &nbsp;&nbsp;
        <input type="button" class="button" onclick="sendMessage()" value="{$MSGTEXT.classesmailer_razoslat}" style="font-weight:bold;width:130px" >
      </p>
</form>
</td>
</tr>
</table>
{$editorsCode}

<br>
<br>
<br>
&nbsp;
{/if}