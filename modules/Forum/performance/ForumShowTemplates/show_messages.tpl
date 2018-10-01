<div fastedit::>
  {if !$them.discuse}
    <h1 style="text-align:center">
      {'Данная тема является закрытой.'|ftext}
    </h1>
  {/if}
  
  {if $pageRecords.records_count}
  <table style="margin-bottom:5px;width:100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="right">
        {'Страница:'|ftext}
        {if $pageRecords.page_selected>1}
        <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page=1">&lt;&lt;</a>
          &nbsp; 
          <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$pageRecords.page_selected-1}">&lt;</a>
            {/if}
            &nbsp;&nbsp;
            {section name="pages" start=1 loop=$pageRecords.page_count+1}
            <a {if $smarty.section.pages.index==$pageRecords.page_selected}class="step_selected"{else}class="step"{/if} href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$smarty.section.pages.index}">
              {$smarty.section.pages.index}
            </a>
            &nbsp;
            {/section}
            {if $pageRecords.page_selected
            <$pageRecords.page_count}
            <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$pageRecords.page_selected+1}">&gt;</a>
            &nbsp; 
            <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$pageRecords.page_count}">&gt;&gt;</a>
            {/if}
            </td>
          </tr>
          </table>
          {/if}
          
          <table style="width:100%;background-color:#dbe5ef" border="0" cellspacing="1" cellpadding="4">
            {if $messages}  
            {foreach name="mes" from=$messages item=message}            
            <tr align="center" valign="middle">
              <td style="width:150px;background-color:white" rowspan="2"  valign="top" fastedit:{$user_table_name}:{$message.user_id}>                                
               {if $message.user_avator}
                <a href="?act=show_user&id={$message.user_id}"><img alt="" style="border:0" src="/modules/Forum/management/storage/images/users/avator/{$message.user_id}/preview/{$message.user_avator}" /></a>
				{else}	                
					<a href="?act=show_user&id={$message.user_id}"><img alt="" style="border:0" src="/modules/Forum/images/noavator.gif" /></a>
                {/if}
                <br/>
                <a href="?act=show_user&id={$message.user_id}">
                  {$message.user_nic}
                </a>
                <p>
                  <b>
                    {if $message.moderator}{'Администратор'|ftext}{else}{'Посетитель'|ftext}{/if}
                  </b>
                </p>
                {if $message.user_sex}
                <p style="font-size:10px">
                  {'Пол:'|ftext}&nbsp;{$message.user_sex|ftext}
                </p>
                {/if}
                <p style="font-size:10px">
                  {'Регистрация:'|ftext}&nbsp;{$message.user_registration}
                </p>
                
              </td>
              <td style="background-color:#e7f3ff">                
                <table id="{$message.id}" fastedit:{if $smarty.foreach.mes.iteration>1}{$messages_table_name}:{$message.id}{else}{$thems_table_name}:{$them.id}{/if} style="width:100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="width:70%" align="left">
                      {$message.datetime}
                    </td>
                    
                    <td style="width:5%">
                    {if $them.discuse && $user}
                      <a href="javascript:setAnswer()">
                        {'Ответить'|ftext}
                      </a>
                      {/if}
                      <td>
                        <td align="center" valign="middle">
                         {if $them.discuse && $user}
                          	<img alt="" hspace="5px" src="/modules/Forum/images/line.gif" />
                          {/if}
                          <td>                            
                            <td style="width:5%">
                            {if $them.discuse && $user}
                              <a href="javascript:setQUOTE({$smarty.foreach.mes.iteration})">
                                {'Цитировать'|ftext}
                              </a>
                              {/if}
                              <td>
                                <td align="center" valign="middle">
                                {if $them.discuse && $user}
                                  <img alt="" hspace="5px" src="/modules/Forum/images/line.gif" />
                                  {/if}
                                  <td>                                    
                                    
                                    <td style="width:5%">
                                    {if $message.can_edit}
                                      <a href="javascript:setEdit({$smarty.foreach.mes.iteration}, {$message.id}, {if $message.forum_id}true{else}false{/if})">
                                        {'Редактировать'|ftext}
                                      </a>
                                      {/if}
                                      <td>
                                        <td align="center" valign="middle">
                                        {if $message.can_edit}
                                          <img alt="" hspace="5px" src="/modules/Forum/images/line.gif" />
                                           {/if}
                                          <td>                                            
                                            <td style="width:5%">
                                             {if $message.can_edit}
                                              <a href="javascript:if (confirm('{'Вы действительно хотите удалить это сообщение'|ftext}')) location.href='?act=delete_message&forum_id={$forum.id}&them_id={$them.id}{if !$message.forum_id}&id={$message.id}{/if}&page={$pageRecords.page_selected}';">
                                                {'Удалить'|ftext}                                                
                                              </a>
                                                {/if}
                                              <td>
                                                <td align="center" valign="middle">
                                                {if $message.can_edit}
                                                  <img alt="" hspace="5px" src="/modules/Forum/images/line.gif" />
                                                  {/if}
                                                  <td>
                                                                                                                                                            
                                                    <td style="width:8%" align="right">
                                                      <a href="forums_rss?forum_id={$forum.id}&them_id={$them.id}">
                                                        <img alt="" title="{'Подписаться на RSS'|ftext}" src="/modules/Forum/images/rss_small.png" border="0" />
                                                      </a>
                                                      <td>
                                                        <td style="width:2%;white-space:nowrap" align="right">&nbsp;
                                                          <a onclick="prompt('Скопируйте в буфер обмена адрес ссылки на это сообщение', '{"`$smarty.const.SETTINGS_HTTP_HOST`/forums?act=show_them_messages&forum_id=`$forum.id`&them_id=`$them.id`&page=`$pageRecords.page_selected`#`$message.id`"|furl}')"
                                                           href="#">
                                                            # {$smarty.foreach.mes.iteration}
                                                          </a>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            
            <tr style="background-color:white">
              <td  align="left" valign="top">
                <table fastedit:{if $smarty.foreach.mes.iteration>1}{$messages_table_name}:{$message.id}{else}{$thems_table_name}:{$them.id}{/if} style="background-color:white;width:100%;height:100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="height:100px" valign="top" id="message_description_id_{$smarty.foreach.mes.iteration}">
                      {$message.description}
                    </td>
                  </tr>
                  {if $message.attach}
                  <tr>
                    <td style="height:5px">
                    </td>
                  </tr>
                  <tr>
                    <td style="height:1px;background-color:#dbe5ef">
                    </td>
                  </tr>
                  <tr>
                    <td style="height:5px">
                    </td>
                  </tr>
                  <tr>
                    <td fastedit:{$messages_table_name}:{$message.id}>
                      <table border="0" cellspacing="0" cellpadding="0" style="background-color:white">
                        <tr>
                          <td valign="middle">
                            <a target="_blank" href="modules/Forum/management/storage/files/messages/attach/{$message.id}/{$message.attach}">
                              <img alt="" title="{'Загрузить вложение'|ftext}" src="/modules/Forum/images/attach.png" border="0" />
                            </a>
                          </td>
                          <td valign="middle">
                            &nbsp;
                            <a target="_blank" href="modules/Forum/management/storage/files/{if $message.forum_id}thems{else}messages{/if}/attach/{$message.id}/{$message.attach}">
                              <b>
                                {$message.attach}
                              </b>
                              </a>
                            </td>
                          </tr>
                      </table>
                    </td>
                  </tr>
                  {/if}
                  
                  {if $message.user_signature}
                  <tr>
                    <td style="height:5px">
                    </td>
                  </tr>
                  <tr>
                    <td style="height:1px;background-color:#dbe5ef">
                    </td>
                  </tr>
                  <tr>
                    <td style="height:5px">
                    </td>
                  </tr>
                  <tr>
                    <td fastedit:{$user_table_name}:{$message.user_id}>
                      <pre style="color:gray">
						{$message.user_signature}
					  </pre>
                    </td>
                  </tr>
      {/if}
      </table>
    </td>
  </tr>  
  {/foreach}
  {/if}
</table>            
            
            {if $pageRecords.records_count}
            <table style="margin-top:5px;width:100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="right">
                  {'Страница:'|ftext}
                  {if $pageRecords.page_selected>1}
                  <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page=1">&lt;&lt;</a>
                    &nbsp; 
                    <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$pageRecords.page_selected-1}">&lt;</a>
                      {/if}
                      &nbsp;&nbsp;
                      {section name="pages" start=1 loop=$pageRecords.page_count+1}
                      <a {if $smarty.section.pages.index==$pageRecords.page_selected}class="step_selected"{else}class="step"{/if} href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$smarty.section.pages.index}">
                        {$smarty.section.pages.index}
                      </a>
                      &nbsp;
                      {/section}
                      {if $pageRecords.page_selected<$pageRecords.page_count}
                      <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$pageRecords.page_selected+1}">&gt;</a>
                      &nbsp; 
                      <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$pageRecords.page_count}">&gt;&gt;</a>
                      {/if}
                      </td>
                    </tr>
                    </table>
                    {/if}
                  
                  <p>
                    <input type="hidden" id="caption_hidden" value="{$them.caption}" />
                    <input type="hidden" id="important_hidden" value="{$them.important}" />
                  </p>
</div>                  
                  {if $them.discuse}
                  {include file="$editor_template"}
                  <br/>
                  {/if}                                    