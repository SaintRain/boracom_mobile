<table fastedit:: cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>
      {foreach from=$categories item=list}
      {if $list.id>0}
      <div style="margin-left:{$list.deep*20}px">
        <p>
          <b style="color:gray">
            {$list.name}
          </b>
            <p>
              {/if}	
              {if $list.pages}					
              {foreach from=$list.pages item=page}
              <div {if $page.page_category>0}{if $list.deep==0}style="margin-left:20px" {else}style="margin-left:{$list.deep*20}px"{/if}{/if}>
                <p style="margin-top:5px; margin-bottom:5px">                  
                  <img alt="" src="/modules/{$moduleInfo.module_name}/img/bullet.gif" />
                  &nbsp;
                  <a class="more" {if $settings._blank} target="_blank" {/if} href="{$page.name}">
                    {$page.description|ftext}
                  </a>                  
                </p>
            </div>
            {/foreach}            
            </div>
            {else}
          {/if}      
          {/foreach}
        </td>
    </tr>
</table>