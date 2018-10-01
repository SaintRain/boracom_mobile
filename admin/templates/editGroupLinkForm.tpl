<div class="ten">
  <table style="width:550px" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table style="width:100%;" bgcolor="#86bae0" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td align="left" valign="top"><b>{$MSGTEXT.edit_group_edit_access}:</b></td>
            <td align="right"><img border=0 style="cursor:pointer" onclick="hideFormBlocks()" src="images/close.gif"></td>
          </tr>
          <tr>
            <td align="left" style="width:100%" colspan="2"><a href="?act=administrators&do=group_edit">{$MSGTEXT.edit_group_user}:</a>
              <select name="group_id" onChange="get_group_urls()" id="group_id" style="margin-top:3px;width:100%;">                
				{if $groups}
				{foreach from=$groups item=group}				
                <option value="{$group.id}" {if $currentData.id==$group.id} selected {/if}>{$group.name}</option>                
				{/foreach}
				{/if}				
              </select>
              </td>
          </tr>
          <tr>
            <td align="left" style="width:100%" colspan="2"> {$MSGTEXT.edit_group_access_not_allowed_page}:<br>
              <select name="data_id" multiple onchange="getPageGroupUrl(this)" id="data_id" style="margin-top:3px;width:100%;height:200px;font-size:10" size="6">                
				{if $urls}
				{foreach from=$urls item=url}				
                <option value="{$url.id}" {if $currentData.id==$url.id} selected {/if}>{$url.caption}</option>                
				{/foreach}
				{/if}				
              </select>
              </td>
          </tr>
          <!--
          <tr>
            <td align="left" colspan="2" valign="top">{$MSGTEXT.edit_group_url_page}:<br>
              <input type="text" readonly style="width:540px;background-color:#70a8d1" id="group_page_caption" value="{$currentData.caption}"></td>
          </tr>
          -->
          <tr>
            <td align="center" colspan="2">
              <input type="button" class="button" name="butedit" id="butedit" onclick="addPageToGroup()" value="{$MSGTEXT.edit_group_add_current_page}" style="width:250px">
              &nbsp;&nbsp;
              <input  {if !$currentData.id}disabled{/if} type="button" class="button" name="butdelete" id="butdelete" onclick="deleteGP()" value="{$MSGTEXT.edit_group_delete}" style="width:150px">
              &nbsp;&nbsp; </td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</div>