{if $messages}
<center>
  {foreach from=$messages item=item}
  <p style="color:yellow;">{$item}</p>
  {/foreach}
</center>
{/if}
<table width="100%">
  <tr>
    <td><form name="data" id="data form" action="?act=modules&do=managedata&page_id={$page_id}&tag_id={$tag_id}&mdo=popup_save&t_name={$smarty.get.t_name}&f_name={$smarty.get.f_name}&id={$smarty.get.id}" method="POST">
        <textarea name="{$field}" id="{$field}" style="height:{$height};width:100%">{$text}</textarea>
        <input type="submit" class="button" value="{$MSGTEXT.edit_popup_save}" style="width:100px" >
      </form></td>
  </tr>
</table>

{$editorsCode}