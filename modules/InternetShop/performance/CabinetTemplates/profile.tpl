<div fastedit::>
  {if $messages}
  {foreach from=$messages item=mes}
  <p style="color:green">
    <b>
      {$mes}
    </b>
  </p>
  {/foreach}
  {/if}
  
  {if $errors}
  {foreach from=$errors item=error}
  <p style="color:red">
    {$error}
  </p>
  {/foreach}
  {/if}
  
  <form action="/cabinet?act=update_profile" method="post" enctype="multipart/form-data">
    <p>
      <input type="hidden" name="translit" value="{$translit}" />
      <input type="hidden" value="{$id}" name="id" />
    </p>
    <table cellpadding="2" cellspacing="2" border="0">
      <tr>
        <td colspan="2" style="height:30px" valign="top" align="right">
          <span style="color:#5acbff">
            *
          </span>
          {'Поля обязятельные для заполнения'|ftext}&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
      </tr>
      <tr>
        <td style="width:150px" valign="top" align="left">
          {'Фамилия:'|ftext} 
          <span style="color:#5acbff">
            *
          </span>
        </td>
        <td>
          <input value="{$second_name}" name="second_name" id="second_name" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {'Имя:'|ftext} 
          <span style="color:#5acbff">
            *
          </span>
        </td>
        <td>
          <input value="{$name}" name="name" id="name" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {'Отчество:'|ftext} 
          <span style="color:#5acbff">
            *
          </span>
        </td>
        <td>
          <input value="{$otchestvo}" name="otchestvo" id="otchestvo" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {'E-Mail:'|ftext} 
          <span style="color:#5acbff">
            *
          </span>
        </td>
        <td>
          <input value="{$email}" name="email" id="email" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {'Пароль:'|ftext} 
          <span style="color:#5acbff">
            *
          </span>
        </td>
        <td>
          <input value="{$password}" type="password" name="password" id="password" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {'Повторите пароль:'|ftext} 
          <span style="color:#5acbff">
            *
          </span>
        </td>
        <td>
          <input value="{$retype_password}" type="password" name="retype_password" id="retype_password" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {'Контактный телефон:'|ftext}
        </td>
        <td>
          <input value="{$phone}" name="phone" id="phone" class="form_element" />
        </td>
      </tr>
      
      <tr>
        <td class="form_text" valign="top" align="left">
          {'Юридический статус:'|ftext}
        </td>
        <td>
          <select name="ur_status_id" id="ur_status_id" class="form_element">
            
			{foreach from=$ur_statuses item=item}
            <option {if $ur_status_id==$item.id} selected {/if} value="{$item.id}">
              {$item.caption|ftext}
            </option>
            {/foreach}                                     
          </select>
        </td>
      </tr>
      
      <tr>
        <td class="form_text" valign="top" align="left">
          {'Страна:'|ftext}
        </td>
        <td>
          <select name="country_id" id="country_id" class="form_element">
            <option style="color:gray" value="">
              {'Не указано'|ftext}
            </option>
            
            {foreach from=$country item=item}
            <option {if $item.id==$country_id} selected {/if} value="{$item.id}">
              {$item.name|ftext}
            </option>
            
            {/foreach}
          </select>
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {'Город:'|ftext}
        </td>
        <td>
          <input value="{$city}" name="city" id="city" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {'Название компании:'|ftext}
        </td>
        <td>
          <input value="{$company}" name="company" id="company" class="form_element" />
        </td>
      </tr>
      
      <tr>
        <td valign="top" align="left">
          {'Сайт:'|ftext}
        </td>
        <td>
          <input value="{$url}" name="url" id="url" class="form_element" />
        </td>
      </tr>
      
      <tr>
        <td valign="top" align="left">
          {'ICQ:'|ftext}
        </td>
        <td>
          <input value="{$icq}" name="icq" id="icq" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {'Skype:'|ftext}
        </td>
        <td>
          <input value="{$skype}" name="skype" id="skype" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {'Факс:'|ftext}
        </td>
        <td>
          <input value="{$fax}" name="fax" id="fax" class="form_element" />
        </td>
      </tr>
      <tr>
        <td  valign="top" align="left">
          {'Пол:'|ftext}
        </td>
        <td>
          <select name="sex" id="sex" class="form_element">
            <option style="color:gray" value="">
              {'Не указано'|ftext}
            </option>
            <option {if $sex=='Мужской'} selected {/if} value="Мужской">
              {'Мужской'|ftext}
            </option>
            <option {if $sex=='Женский'} selected {/if} value="Женский">
              {'Женский'|ftext}
            </option>
            <option {if $sex=='Робот'} selected {/if} value="Робот">
              {'Робот'|ftext}
            </option>
          </select>
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {'Почтовый индекс:'|ftext}
        </td>
        <td>
          <input value="{$mail_index}" name="mail_index" id="mail_index" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {'Адрес доставки заказа:'|ftext}
        </td>
        <td>
          <input value="{$address_of_delivery}" name="address_of_delivery" id="address_of_delivery" class="form_element" />
        </td>
      </tr>
      
      <tr>
        <td valign="top" align="left">
        </td>
        <td>
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td valign="top">
                <input {if $get_emails} checked {/if} type="checkbox" value="1" name="get_emails" id="get_emails" />
              </td>
              <td>
                &nbsp;
              </td>
              <td>
                {'Получать рассылку'|ftext}
              </td>
              <tr>
            </table>
        </td>
      </tr>
      
      <tr>
        <td valign="top" align="left">
          {'Ник на форуме:'|ftext} 
          <span style="color:#5acbff">
            *
          </span>
        </td>
        <td>
          <input value="{$nic}" name="nic" id="nic" class="form_element" />
        </td>
      </tr>
      
      <tr>
        <td style="width:150px" valign="top" align="left">
          {'Аватар:'|ftext}
        </td>
        <td>
          
          {if $avator}
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td>
                <img alt="" class="ramka" src="/modules/InternetShop/management/storage/images/users/avator/{$id}/preview/{$avator}" />
                <br/>
              </td>
              <td>
                <table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td>
                      &nbsp;
                      <input name="avator_delete" value="{$avator}" type="checkbox" />
                    </td>
                    <td>
                      &nbsp;{'Удалить'|ftext}
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          {/if}
          <input type="file" value="" name="avator" id="avator" class="form_element" />
        </td>
      </tr>
      
      <tr>
        <td valign="top" align="left">
          {'Временная зона:'|ftext}
        </td>
        <td>
          <select name="timezone_id" class="form_element">
            <option style="color:gray" value="">
              {'Не указано'|ftext}
            </option>
            {foreach from=$timezones item=item}
            <option {if $smarty.post.timezone_id==$item.id || $timezone_id==$item.id} selected {/if} value="{$item.id}">
              {$item.caption}
            </option>
            {/foreach}
          </select>
        </td>
      </tr>
      
      <tr>
        <td valign="top" align="left">
          {'Подпись на форуме:'|ftext}
        </td>
        <td>
          <input value="{$signature}" name="signature" id="signature" class="form_element" />
        </td>
      </tr>
            
      <tr>
        <td colspan="2" style="height:15px">
        </td>
      </tr>
      <tr>
        <td>
        </td>
        <td>
          <input type="submit" class="button" value="{'Сохранить'|ftext}" />
        </td>
      </tr>
    </table>
  </form>
</div>