<div fastedit::>
  {if $user}
  <br/>
  <p style="margin-bottom:10px">
    <a href="javascript:showHideEditor()">
      <b>
        {'НАЧАТЬ НОВУЮ ТЕМУ'|ftext}
      </b>
    </a>
  </p>
  {else}
  <p style="margin-bottom:10px">
    {'Чтобы начать новую тему необходимо авторизироваться.'|ftext}
  </p>
  {/if}
  
  {if $thems}
  <table style="width:100%;background-color:#dbe5ef" border="0" cellspacing="1" cellpadding="4">    
    <tr style="background-color:#dbe5ef">
      <td colspan="2" style="width:60%" class="forum_head">
        {'Темы'|ftext}
      </td>
      <td style="width:10%" align="center" valign="top" class="forum_head">
        {'Ответы'|ftext}
      </td>
      <td style="width:10%" align="center" valign="top" class="forum_head">
        {'Просмотры'|ftext}
      </td>
      <td style="width:20%" align="center" valign="top" class="forum_head">
        {'Обновления'|ftext}
      </td>
    </tr>
    {foreach from=$thems item=them}
    <tr style="background-color:white" align="center" valign="middle">
      <td style="width:5%">
        {if !$them.discuse}
    	<img alt="" title="{'Закрытая тема'|ftext}" src="/modules/Forum/images/theme_notice_close.png" />
      {else}
      {if $them.important}
      <img alt="" title="{'Важная тема'|ftext}" src="/modules/Forum/images/important.gif" />
      {/if}
      {/if}
    </td>
    <td align="left" valign="top" fastedit:{$thems_table_name}:{$them.id}>
      <a class="forum_theme" href="?act=show_them_messages&forum_id={$them.forum_id}&them_id={$them.id}">
        {$them.caption}
      </a>
      <br/>
      {'Автор:'|ftext}&nbsp;
      <a href="?act=show_user&id={$them.user_id}">
        {$them.nic}
      </a>
    </td>
    <td align="center" valign="middle">
      {$them.answers}
    </td>
    <td align="center" valign="middle">
      {$them.view}
    </td>
    {assign var="last_message" value=$them.last_message}
    <td align="center" valign="middle">      
      <a href="?act=show_them_messages&forum_id={$them.forum_id}&them_id={$them.id}{if $last_message.page}&page={$last_message.page}{/if}#{$last_message.id}">
        {$last_message.datetime}
      </a>
      <br/>
      <a href="?act=show_user&id={$them.user_id}">
        <b>
          {$last_message.nic}
        </b>
      </a>
    </td>
  </tr>
  {/foreach}
  </table>
  
  <table style="margin-top:5px;width:100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
      <td align="right">
        {'Страница:'|ftext}
        {if $pageRecords.page_selected>1}
        <a class="step" href="?act=show_forum_thems&forum_id={$forum.id}&page=1"><<</a>
          &nbsp; 
          <a class="step" href="?act=show_forum_thems&forum_id={$forum.id}&page={$pageRecords.page_selected-1}"><</a>
            {/if}
            &nbsp;&nbsp;
            {section name="pages" start=1 loop=$pageRecords.page_count+1}
            <a {if $smarty.section.pages.index==$pageRecords.page_selected}class="step_selected"{else}class="step"{/if} href="?act=show_forum_thems&forum_id={$forum.id}&page={$smarty.section.pages.index}">
              {$smarty.section.pages.index}
            </a>
            &nbsp;
            {/section}
            {if $pageRecords.page_selected<$pageRecords.page_count}
            <a class="step" href="?act=show_forum_thems&forum_id={$forum.id}&page={$pageRecords.page_selected+1}">></a>
            &nbsp; 
            <a class="step" href="?act=show_forum_thems&forum_id={$forum.id}&page={$pageRecords.page_count}">>></a>
            {/if}
        </td>
      </tr>
  </table>
	{else}
    	<br/>
        <p style="color:gray">
       		{'Еще нет тем для обсуждения...'|ftext}
        </p>
	{/if}
</div>
        
{include file="$editor_template"}