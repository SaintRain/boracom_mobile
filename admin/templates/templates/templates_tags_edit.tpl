{literal}
<script language="JavaScript">
function showdiv(section) {
	element=GetElementById(section);
	element.style.visibility="visible";
}

function hiddendiv(section) {
	element=GetElementById(section);
	element.style.visibility="hidden";
}

function setdata() {
}
</script>
{/literal}

<p style="margin-top:10px;margin-bottom:10px">{$MSGTEXT.templates_tags_edit_info}</p>
{if $message}
<p style="margin:10px"><font color=yellow><b>{$message}</b></font></p>
{/if}
<form id="data form" action="?act=templates&do=saveedittags" method=post>
  <input name="id" type="hidden" value="{$id}">
  <input name="tags_edit" type="hidden" value="true">
  <input name="description" type="hidden" value="{$description}">
  <textarea name="content" style="display:none">{$content}</textarea>
  <table border="0" width="100%" cellpadding="2" cellspacing="0">
    {foreach from=$bdtags item=item}
    {if $item.edit==true}
    {if $tags}
    <tr>
      <td style="width:10px" valign="middle"><input type="radio" value="1" name="edittype_{$item.id}" onclick="javascript: hiddendiv('block{$item.id}');"></td>
      <td style="width:50px"><font color=red> {$MSGTEXT.templates_tags_edit_delete}</font>&nbsp;&nbsp;&nbsp;</td>
      <td style="width:10px"><input type="radio" value="2" name="edittype_{$item.id}" checked onclick="javascript: showdiv('block{$item.id}');"></td>
      <td style="width:110px"> {$MSGTEXT.templates_tags_edit_rename}</td>
      <td style="width:200px"><input type="text" readonly value="{$item.tagname}" name="{$item.id}" style="width:300px"></td>
      <td id="block{$item.id}" style="visibility:show" valign="middle">&nbsp;&rarr;&nbsp;
        <select name="new_name_{$item.id}" style="width:300px">          
{foreach from=$tags item=item}
          <option value="{$item.name}">{$item.name}</option>          
{/foreach}
        </select></td>
    </tr>
    {else}
    <tr>
      <td style="width:20px" valign="middle"><input checked type="radio" value="1" name="edittype_{$item.id}" ></td>
      <td style="width:50px"><font color=red> {$MSGTEXT.templates_tags_edit_delete}</font></td>
      <td colspan='100%' align='left'><input type="text" readonly value="{$item.tagname}" name="{$item.id}" style="width:200px"></td>
      {/if}
      {/if}
      {/foreach}
    <tr style="height:10px">
      <td colspan="100%"></td>
    </tr>
    <tr>
      <td colspan="100%"><input type="submit" style="width:120px" class="button" value="{$MSGTEXT.templates_ok}"></td>
    </tr>
  </table>
</form>