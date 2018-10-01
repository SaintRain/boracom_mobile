<table fastedit:{$user_table_name}:{$user.id} style="width:100%;background-color:#dbe5ef" border="0" cellspacing="1" cellpadding="4"> 
  <tr style="background-color:#dbe5ef">    
    <td style="width:20%" align="center" valign="top" class="forum_head">
      {'Аватар'|ftext}
    </td>
    <td style="width:80%" align="left" valign="top" class="forum_head">
      {'Анкетные данные'|ftext}
    </td>
  </tr>  
  <tr style="background-color:white" align="center">    
    <td align="center" valign="top">      
      {if $user.avator}
      <img alt="" src="/modules/Forum/management/storage/images/users/avator/{$user.id}/preview/{$user.avator}" />
      {else}
      <img alt="" src="/modules/Forum/images/noavator.gif" />
      {/if}
      <p style="font-size:10px;text-align:center">{'Сообщений:'|ftext}&nbsp;{$user.message_count}, {'Тем:'|ftext}&nbsp;{$user.them_count}</p>                            
    </td>
    
    <td align="left" valign="middle">      
      <table border="0" cellspacing="2" cellpadding="2">        
	  	<tr>
          <td style="width:100px">
            {'Ник:'|ftext}
          </td>
          <td>
            <b>
              {$user.nic}
            </b>
          </td>
          </tr>
          <tr>
            <td>
              {'Имя:'|ftext}
            </td>
            <td>
              <b>
                {$user.second_name} {$user.name} {$user.otchestvo}
              </b>
            </td>
          </tr>
          {if $user.sex}
          <tr>
            <td>
              {'Пол:'|ftext}
            </td>            
            <td>
              <b>
                {$user.sex}
              </b>
            </td>
          </tr>
          {/if}
          {if $user.company}
          <tr>
            <td>
              {'Компания:'|ftext}
            </td>
            <td>
              <b>
                {$user.company}
              </b>
            </td>
          </tr>
          {/if}  	
          {if $user.country_id_caption}
          <tr>
            <td>
              {'Страна:'|ftext}
            </td>
            <td>
              <b>
                {$user.country_id_caption}
              </b>
            </td>
          </tr>
          {/if}
          {if $user.city}
          <tr>
            <td>
              {'Город:'|ftext}
            </td>
            <td>
              <b>
                {$user.city}
              </b>
            </td>
          </tr>
          {/if}
          {if $user.phone}
          <tr>
            <td>
              {'Телефон:'|ftext}
            </td>
            <td>
              <b>
                {$user.phone}
              </b>
            </td>
          </tr>
          {/if}
          {if $user.fax}
          <tr>
            <td>
              {'Факс:'|ftext}
            </td>
            <td>
              <b>
                {$user.fax}
              </b>
            </td>
          </tr>
          {/if}
          {if $user.skype}
          <tr>
            <td>
              {'skype:'|ftext}
            </td>
            <td>
              <b>
                {$user.skype}
              </b>
            </td>
          </tr>
          {/if}
          {if $user.icq}
          <tr>
            <td>
              {'icq:'|ftext}
            </td>
            <td>
              <b>
                {$user.icq}
              </b>
            </td>
          </tr>
          {/if}
          {if $user.url}
          <tr>
            <td>
              {'Сайт:'|ftext}
            </td>
            <td>
              <b>
                {$user.url}
              </b>
            </td>
          </tr>          
          {/if}          
          <tr>
            <td>
              {'Статус:'|ftext}
            </td>
            <td>
              <b>
                {if $user.moderator}{'Администратор'|ftext}{else}{'Посетитель'|ftext}{/if}
              </b>
            </td>
          </tr>
          <tr>
            <td>
              {'Регистрация:'|ftext}
            </td>
            <td>
              <b>
                {$user.registration}
              </b>
            </td>
          </tr>
      </table>      
    </td>
  </tr>  
</table>
<br/>