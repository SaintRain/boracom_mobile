<font style="color: #b21a1a; font-size: 17px; margin-left: 7px;">ОФОРМИТЬ ЗАКАЗ</font><br>
{if $errors}
        {foreach from=$errors item=error}
<div fastedit:{$table_name}: id="contact_form" style="margin:5px">          
          <p style="color:#a20405">
            {$error|ftext}
          </p>
        </div>
        {/foreach}
<br/>
    {/if}	    

<form fastedit:{$table_name}: style="margin-top:0px" id="contact_form" action="#contact_form" method='post' enctype='multipart/form-data' onreset="return confirm('{'Вы действительно хотите очистить форму?'|ftext}')">
  <input type="hidden" name="{$act_variable}" value="send" /> 
	<table align="right" border="0" cellpadding="0" cellspacing="5" width=245>
	<tr><td colspan="3"><input name="UserName" placeholder="Имя:*" style="width: 230px;" value="{$UserName}"></td></tr>
	<tr><td colspan="3"><input name="UserPhone" placeholder="Ваш телефон:*" style="width: 230px;" value="{$UserPhone}"></td></tr>
      <tr><td colspan="3"><input name="UserEmail" placeholder="Ваш e-mail:*" style="width: 230px;" value="{$UserEmail}"></td></tr>
      <tr><td colspan="3"><textarea name="UserText" placeholder="Ваш вопрос:" style="height: 60px; width: 230px; background-color: #ffffff;">{$UserText}</textarea></p></td></tr>
	<tr>
	<td align="center" align="middle"><img width="80px" style="border:0px"  id="kcaptcha_img" alt="{'Включите отображение изображений'|ftext}" src='/tools/kcaptcha/index.php' />
      <br/><a style="font-size:12px" href="javascript:reloadKcaptcha()">
            {'поменять'|ftext}
          </a>
      </td>
	<td align="center" align="middle"><input placeholder="Код" name="kcaptcha" style="width: 60px;" value=""></td>
      <td align="right" align="middle"><a href="javascript:$('#contact_form').submit()"><img src="/ckfinder/userfiles/images/send.png" width=65 height=20 border="0" hspace="0" align="middle" alt=""></a></td>
	</tr>
	</table>
</form>

{literal} 
<script type="text/javascript"> 
function  reloadKcaptcha() {	
	var time = Math.random();			
 	document.getElementById('kcaptcha_img').src="/tools/kcaptcha/index.php?t="+time;
}
</script> 
{/literal} 

