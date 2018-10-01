<table fastedit:: style="width:100%;background-color:#dbe5ef"  border="0" cellspacing="1" cellpadding="4">
  {foreach from=$fgroups item=group}
  {if $group.forums}
  <tr style="background-color:#dbe5ef">
    <td colspan="2" style="width:60%" class="forum_head" fastedit:{$group_table_name}:{$group.id}>
      <a href="?group_id={$group.id}">
        <b>
          {$group.caption|ftext}
        </b>
      </a>
    </td>
    <td style="width:10%" align="center" valign="top" class="forum_head">
      {'Темы'|ftext}
    </td>
    <td style="width:10%" align="center" valign="top" class="forum_head">
      {'Сообщения'|ftext}
    </td>
    <td style="width:20%" align="center" valign="top" class="forum_head">
      {'Обновления'|ftext}
    </td>
  </tr>
  {foreach from=$group.forums item=forum}
  {assign var="last_message" value=$forum.last_message}
  <tr style="background-color:white" align="center" valign="middle">
    <td style="width:5%">
      {if $last_message.is_new_message}
      <img alt="" title="{'Есть новые сообщения'|ftext}" src="/modules/Forum/images/message.gif" />
      {else}
      <img alt="" title="{'Нет новых сообщений'|ftext}" src="/modules/Forum/images/old_message.gif" />
      {/if}      
    </td>
    <td align="left" valign="top" fastedit:{$forum_table_name}:{$forum.id}>
      <a class="forum_theme" href="?act=show_forum_thems&forum_id={$forum.id}">
        {$forum.caption}
      </a>
      {$forum.description}
    </td>
    <td align="center" valign="middle">
     {if $forum.them_count}
      	{$forum.them_count}
      {else}
      	0
      {/if}       
    </td>
    <td align="center" valign="middle">
      {if $forum.message_count}
      	{$forum.message_count}
      {else}
      	0
      {/if}
    </td>    
    <td align="center" valign="middle">
      {if $last_message.them_id}      
      <a href="?act=show_them_messages&forum_id={$forum.id}&them_id={$last_message.them_id}{if $last_message.page}&page={$last_message.page}{/if}{if $last_message.id}#{$last_message.id}{/if}">
        {$last_message.them_caption|truncate:50:'...':false:false}
      </a>      
      <a href="?act=show_user&id={if $last_message.user_id}{$last_message.user_id}{else}{$last_message.them_user_id}{/if}">
        <b>
          {$last_message.nic}
        </b>
      </a>
      <br/>
      <span style="font-size:10px">
        {if $last_message.datetime}
        	{$last_message.datetime}
        {else}
        	{$last_message.them_datetime}
        {/if}
      </span>
      {/if}
    </td>
  </tr>
  {/foreach}
  {/if}  
  {/foreach}
</table>
<br/>