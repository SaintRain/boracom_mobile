{literal}
<script language="JavaScript">
function Mysubmit(form) {
	s=form.new_name.value;
	if (s=='') {
		{/literal}
		form.new_name.focus(); alert("{$MSGTEXT.p_set_m_copy_name}"); return false
		{literal}
	};
	return true;
}
</script>
{/literal}

<p style="margin-top:10px;margin-bottom:10px">
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><a {if $smarty.get.do=='form_import'} style="font-weight:bold" {/if} href="?act=modules&do=form_import">{$MSGTEXT.import_module}</a> &rarr; </td>
    <td width="20px"></td>
    <td><a {if $smarty.get.do=='copy_module_form'} style="font-weight:bold" {/if} href="?act=modules&do=copy_module_form">{$MSGTEXT.create_copy_of_module}</a> &rarr;</td>
  </tr>
</table>
</p>
{foreach from=$error item=item}
<p style="margin-top:10px; color:yellow">{$item}</p>
{/foreach}
<form id="data form" action="?act=modules&do=copy_module" method="POST" onsubmit="return Mysubmit(this)" style="margin:0px">
  <p style="margin-bottom:10px"><font color="Yellow">{if $import_result}{$import_result}<br>{/if}{$message}</font></p>
  
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
          <table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
              <tr>
                  <td>
          <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td>{$MSGTEXT.select_copied_module}:
              <select name="copy_module" style="width:100%;" size="1">                
				{foreach from=$modules item=list}
                <option {if $copy_module==$list.filename} selected {/if} value="{$list.filename}">{$list.filename}{if $list.version} v.{$list.version}{/if}</option>                
				{/foreach}
              </select>
              <br><br>
              <table cellpadding="0" cellspacing="0" border="0">
  				<tr>
  					<td><input name="import" {if $smarty.post.import}checked{/if} type="checkbox" class="checkbox" value="1"></td>
  					<td>&nbsp;{$MSGTEXT.to_copy_now}</td>
  				</tr>	
  			  </table>
              <p style="margin-top:10px">{$MSGTEXT.name_of_m_copy}:<font color="Yellow">*</font><br>
                <input type="text" name="new_name" style="width:100%" value="{$new_name}">
            </td>
          </tr>
          <tr>
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