{if $errors}
	{foreach from=$errors item=error}
		<p style="color:red">{$error}</p>
	{/foreach}
	<br/>
{/if}

<form fastedit:: action="?act=check_reg" method="post" enctype="multipart/form-data">
<p><input type="hidden" name="translit" value="{$translit}"/></p>
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
      <td  valign="top" align="left">{'Пол:'|ftext}</td>
      <td>
        <select name="sex" id="sex" class="form_element" >
          	<option style="color:gray" value="">{'Не указано'|ftext}</option>
  			<option {if $sex=='Мужской'} selected {/if} value="Мужской">{'Мужской'|ftext}</option>
  			<option {if $sex=='Женский'} selected {/if} value="Женский">{'Женский'|ftext}</option>
  			<option {if $sex=='Робот'} selected {/if} value="Робот">{'Робот'|ftext}</option>
        </select>
      </td>
    </tr>
        
    <tr>
      <td valign="top" align="left">{'Ник на форуме:'|ftext} <span style="color:#5acbff">*</span></td>
      <td>
        <input value="{$nic}" name="nic" id="nic" class="form_element" />
      </td>
    </tr>       
    <tr>
      <td style="width:150px" valign="top" align="left">{'Аватар:'|ftext}</td>
      <td>
        <input type="file" value="" name="avator" id="avator" class="form_element" />
      </td>
    </tr>    
    <tr>
      <td valign="top" align="left">{'Временная зона:'|ftext}</td>
      <td>
      <select name="timezone_id" class="form_element" >
      <option style="color:gray" value="">{'Не указано'|ftext}</option>
      	{foreach from=$timezones item=item}
      		<option {if $smarty.post.timezone_id==$item.id} selected {/if} value="{$item.id}">{$item.caption}</option>
      	{/foreach}
      </select>
      </td>
    </tr>            
    <tr>
      <td valign="top" align="left"></td>
      <td>
      	<table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td valign="top"><input {if $get_emails} checked {/if} type="checkbox" value="1" name="get_emails" id="get_emails" /></td>
            <td>&nbsp;</td>
            <td>{'Получать рассылку'|ftext}</td>
          <tr>
        </table>
      </td>
    </tr>              
    <tr>
      <td></td>
      <td>
        <table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td valign="top">
              <input {if $confirm} checked {/if} type="checkbox" value="1" name="confirm" id="confirm" />
            </td>
            <td>
              &nbsp;
            </td>
            <td>
              {'Я подтверждаю достоверность указанных данных'|ftext}
            </td>
          </tr>
        </table>
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
        <input type="submit" class="button" value="{'Зарегистрироваться'|ftext}"/>
      </td>
    </tr>
  </table>
</form>