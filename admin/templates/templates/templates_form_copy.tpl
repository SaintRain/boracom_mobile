{literal}
<script language="JavaScript">
function Mysubmit(form) {
	s=form.name.value;
	if (s=='') {
		{/literal}
		form.name.focus(); alert("{$MSGTEXT.set_tpl_filename}"); return false
		{literal}
	}
	return true;
}
</script>
{/literal}

<form id="data form" action="?act=templates&do=savecopy" method="POST" onsubmit="return Mysubmit(this)" style="margin:0">
  <input type="hidden" name="id" value="{$id}">
  <input type="hidden" name="tamplate_id" value="{$tamplates_id}">
  <p style="margin-bottom:10"><font color="yellow">{$message}</font></p>
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td>      
      <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td colspan="2">{$MSGTEXT.tpl_copy_name} <font color="yellow">*</font><br>
              <input type="text" style="width:100%;font-weight:bold" name="name" value="{$name}"></td>
          </tr>
          {if $tags}
          <tr>
            <td colspan="2" style="height:10px"></td>
          </tr>
          <tr>
            <td nowrap><b>{$MSGTEXT.tag_name}</b></td>
            <td nowrap><b>{$MSGTEXT.you_cat_edit_tags_caption}</b></td>
          </tr>
          {foreach name="tags" from=$tags item=item}
          <tr>
            <td nowrap>{$item.virtualtagname} </td>
            <td width="100%"><input type="text" {if ($item.global==1) } style="color:blue;width:100%" {else} {if ($item.global==2) } style="color:maroon;width:100%" {else} style="width:100%"{/if} {/if} name="tagid{$smarty.foreach.tags.iteration}--{$item.virtualtag_id}" value="{$item.virtualtagname}"></td>
          </tr>
          {/foreach}
          {/if}
          <tr>
            <td></td>
            <td><input class="button" type="submit" value="{$MSGTEXT.copy}" style="width:130px"></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
        </td>
    </tr>
  </table>  
</form>