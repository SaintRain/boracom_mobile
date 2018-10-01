{literal}
<script language="JavaScript">
function showHideSettings() {
	var  details	= GetElementById('additional_settings');

	if (details.style.visibility=='hidden') {
		details.style.visibility='visible';
	}
	else {
		details.style.visibility='hidden';
	}
}
</script>
{/literal}

{if !$hide_menu}
<p style="margin-top:10px;margin-bottom:10px">
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><a href="?act=modules&do=form_import">{$MSGTEXT.import_module}</a> &rarr; </td>
    <td width="20px"></td>
    <td><a href="?act=modules&do=copy_module_form">{$MSGTEXT.create_copy_of_module}</a> &rarr;</td>
  </tr>
</table>
</p>
{/if} <br>
<form id="data form" action="?act=modules&do=settings_save&block_id={$block_id}{if $hide_menu}&close=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}" method="POST" style="margin:0px">
  <table width='100%' cellspacing=0 border=0 {if $hide_menu} cellpadding=10{else}cellpadding=0{/if}>
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0" border="0">
        {if $tplFiles}
        <tr>
          <td width="10%" valign="top"><i>{$MSGTEXT.edit_out_tpl}:</i></td>
          <td width="10px">&nbsp;</td>
          <td>
          <table cellpadding="0" cellspacing="2" border="0">
          {foreach from=$tplFiles item=item}
          <tr>
          <td><a class="tpl_link" title="{$MSGTEXT.mod_settings_adress_file} {$tpl_dir}{$item.name}" href="?act=modules&do=edit_out_tpl&block_id={$block.id}{if $hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}&tpl_id={$item.id}">
          {if $item.tpl_type=='xml'}<img border="0" src="images/tpls/xml.png">{/if}
          {if $item.tpl_type=='tpl'}<img border="0" src="images/tpls/tpl.png">{/if}
          {if $item.tpl_type=='xsl'}<img border="0" src="images/tpls/xsl.png">{/if}
          </a></td>
          <td>&nbsp;<a class="tpl_link" title="{$MSGTEXT.mod_settings_adress_file} {$tpl_dir}{$item.name}" href="?act=modules&do=edit_out_tpl&block_id={$block.id}{if $hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}&tpl_id={$item.id}"><b>{$item.description}</b></a></td>
          </tr>
           {/foreach}
           </table>
           
           </td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>
        <tr>
          <td height="1px" colspan="100%" bgcolor="#66a4d3"></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>
        {/if}

        <tr>
          <td nowrap width="10%"><i>{$MSGTEXT.pages_list_way_to_block}</i></td>
          <td width="10px">&nbsp;</td>
          <td>
          <table cellpadding="0" cellspacing="2" border="0">
          <tr>
          <td width="25px"><a title="{$MSGTEXT.mod_settings_adress_file} {$block_patch}" style="font-weight:bold" href="index.php?act=php&do=edit&block_id={$block_id}"><img border="0" src="images/tpls/php.png"/></a></td>
          <td>&nbsp;<a title="{$MSGTEXT.mod_settings_adress_file} {$block_patch}" class="tpl_link" href="index.php?act=php&do=edit&block_id={$block_id}{if $hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}"><b>{$block.block_description}</b></a></td>
          </tr>
          </table>
          </td>          
        </tr> 
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>                        
        <tr>
          <td height="1px" colspan="100%" bgcolor="#66a4d3"></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>                                
        <tr>
          <td nowrap width="10%"><i>{$MSGTEXT.mod_settings_tupe_block}</i></td>
          <td width="10px">&nbsp;</td>
          <td><b>{if $block.type==2}{$MSGTEXT.blocks_list_multiple}{else}{if $block.type==1}{$MSGTEXT.blocks_list_single}{else}{$MSGTEXT.blocks_form_add_plugin}{/if}{/if}</b></td>
        </tr>  

                
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>                        
        <tr>
          <td height="1px" colspan="100%" bgcolor="#66a4d3"></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>    
        <tr>
          <td nowrap><i>{$MSGTEXT.mod_settings_tupe_variable}</i></td>
          <td width="10px">&nbsp;</td>
          <td><b>{$block.act_method}</b></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>                        
        <tr>
          <td height="1px" colspan="100%" bgcolor="#66a4d3"></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>        
		<tr>
          <td nowrap><i>{$MSGTEXT.mod_settings_variable_name_calling}</i></td>
          <td width="10px">&nbsp;</td>
          <td><b>{$block.act_variable}</b></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>        

        {if $block.url_get_vars}
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>
        <tr>
          <td height="1px" colspan="100%" bgcolor="#66a4d3"></td>
        </tr>
        <tr>
          <td height="5px" colspan="100%"></td>
        </tr>
        <tr>
          <td nowrap valign="top" align="left"><i>{$MSGTEXT.mod_settings_url_get_vars}</td>
          <td width="10px">&nbsp;</td>
          <td valign="top" align="left"><b>{$block.url_get_vars}</b></td>
        </tr>
        {/if}
      </table>
      <br>
      {if $smarty.get.refresh}
      {if $smarty.get.hide_menu && $smarty.get.fastEdit}<script language="JavaScript">opener.location.reload();</script>{/if}
      {/if}
      {if $smarty.get.saved}
      <p style="color:yellow">{$MSGTEXT.settings_saved}</p>
      {else}
      <br>
      {/if}
      
	{if $settings}    
	{if $own_settings}  
      <table width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#4e86b0">
        <tr bgcolor="#66a4d3">
          <td nowrap width="20%"><b>{$MSGTEXT.mod_settings_name_variable}</b></td>
          <td width="80%"><b>{$MSGTEXT.mod_settings_value}</b></td>
        </tr>

        {foreach from=$settings item=list} 
        {if $list.block_id==$block.id} 
        {include file="$form_template"}
        {/if}     
        {/foreach}
       
        <tr bgcolor="#66a4d3">
          <td colspan="2"><input style="margin-top:5px;width:130px" class="button" type="submit" value="{$MSGTEXT.save}"></td>
        </tr>
      </table>
      {/if}
      
      {if $addittional_settings}
      <p><b><a href="javascript:showHideSettings()">{$MSGTEXT.mod_settings_additional_settings}</b></a></p>
      <table style="visibility:hidden" id="additional_settings" width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#4e86b0">
        <tr bgcolor="#66a4d3">
          <td nowrap width="20%"><b>{$MSGTEXT.mod_settings_name_variable}</b></td>
          <td width="80%"><b>{$MSGTEXT.mod_settings_value}</b></td>
        </tr>
        
        {foreach from=$settings item=list} 
        {if $list.block_id!=$block.id} 
        {include file="$form_template"}
        {/if}     
        {/foreach}
        
        <tr bgcolor="#66a4d3">
          <td colspan="2"><input style="margin-top:5px;width:130px" class="button" type="submit" value="{$MSGTEXT.save}"></td>
        </tr>
      </table>
      {/if}
   {/if}                 
</form>
</td>
</tr>
</table>
<br>&nbsp;