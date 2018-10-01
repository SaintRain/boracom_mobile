{literal}
<script language="JavaScript">
function setDescription(obj) {
	GetElementById('description').innerHTML=GetElementById('divId'+obj.value).innerHTML;
}
</script>
{/literal}

{if $messages}
{foreach from=$messages item=m}
	<p style="color:yellow">{$m}</p>
{/foreach}
{/if}

{foreach from=$modules item=list}
<div id="divId{$list.filename}" style="display:none;">{$list.description}</div>
{/foreach}
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
<form id="data form" action="?act=modules&do=import&m_id=0" method="POST" style="margin:0px">
  <p style="margin-bottom:10"><font color="Yellow">{if $import_result}{$import_result}<br>
    {/if}{$message}</font></p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
        <tr>
        <td>      
      <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td>{$MSGTEXT.select_module}:
              <select onchange="setDescription(this)" name="import_modul" style="width:100%;" size="1" >                
				{foreach name="modules" from=$modules item=list}
				{if $smarty.foreach.modules.iteration==1}
					{assign var=description value=$list.description}
				{/if}
                <option value="{$list.filename}">{$list.filename}{if $list.version} v.{$list.version}{/if}<br>
                {/foreach}
              </select>
              <p style="margin-top:10px">{$MSGTEXT.description_of_module}:<br>
                <textarea name="description" id="description" rows="4" style="width:100%">{$description}</textarea>
            </td>
          </tr>
          <tr>
            <td><input class="button" type="submit" value="{$MSGTEXT.import}" style="width:130px"></td>
          </tr>
        </table>
</td>
          </tr>
        </table>        
        </td>
    </tr>
  </table>
</form>