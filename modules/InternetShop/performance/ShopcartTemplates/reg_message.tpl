Здравствуйте {$name} {$otchestvo} !
<br/>
Вы зарегистрировались на сайте интернет-магазина 
<a href="{$smarty.const.SETTINGS_HTTP_HOST}">
  «{$host}»
</a>
<br/>
Ваш логин: {$email}
<br/>
Ваш пароль: {$password}
<br/>
Для подтверждения правильности ввода e-mail перейдите, пожалуйста, по этой ссылке:
<br>
<a href="{$smarty.const.SETTINGS_HTTP_HOST}/registratsiya?act=confirm_r&id={$id}&email={$smarty.post.email}">
  подтвердить правильность ввода e-mail
</a>
<br/>
<br/>
С уважением, администрация интернет-магазина «{$host}»