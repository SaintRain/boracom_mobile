<form fastedit:: action="" method="post" style="margin:5px">
  <p>
    <input type="hidden" name="reg" value="checkLogin"/>
  </p>
  <table style="width:180px" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td align="left" valign="top"  style="height:20px;white-space:nowrap">
        <h2>
          {'Авторизация'|ftext}
        </h2>
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        {'Email:'|ftext}
        <br/>
        <input class="input" style="width:150px" name="email" value="" />
      </td>
    </tr>
    <tr>
      <td style="height:10px" colspan="100%">
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        {'Пароль:'|ftext}
        <br/>
        <input class="input" style="width:150px" name="password" value="" type="password" />
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        <table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td style="height:10px" colspan="100%">
            </td>
        </tr>
        <tr>
          <td align="right" valign="middle">
            <input checked="checked" type="checkbox" value="1" name="zapomnit"/>
          </td>
          <td style="white-space:nowrap">
            &nbsp;{'запомнить меня'|ftext}
          </td>
        </tr>
        </table>
      </td>
    </tr>
    {if $error}
    <tr>
      <td style="color:red;height:30px" valign="bottom" align="left">
        {'Неправильные данные!'|ftext}
      </td>
    </tr>
    {/if}
    <tr>
      <td style="height:10px" align="left" valign="top">
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        <input class="button" style="width:150px" value="Войти" type="submit" />
      </td>
    </tr>
    <tr>
      <td style="height:10px" align="left" valign="top">
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        <a href="vosstanovlenie-parolya">
          {'Забыли пароль?'|ftext}
        </a>
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        <a href="registratsiya">
          {'Регистрация на сайте'|ftext}
        </a>
      </td>
    </tr>
  </table>
</form>