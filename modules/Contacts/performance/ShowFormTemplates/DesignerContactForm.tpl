<form class="contact_form" fastedit:{$table_name}: style="margin-top:0px" id="contact_form2" action="#contact_form2"
	  method='post' enctype='multipart/form-data' onreset="return confirm('{'Вы действительно хотите очистить форму?'|ftext}')">

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

	<input type="hidden" name="{$act_variable}" value="send" />
	<input name="UserEmail" placeholder="Ваш e-mail:"   value="{$UserEmail}">
	<input name="UserName" placeholder="Ваше имя:"   value="{$UserName}">
	<input name="UserPhone" placeholder="Телефон (по желанию):"  value="{$UserPhone}">
	<textarea name="UserText" placeholder="Сообщение:" cols="40" rows="6">{$UserText}</textarea>

	<table width="100%">
<tr height="30">
		<td  align="center"><img width="80px" style="border:0px"  id="kcaptcha_img2" alt="{'Включите отображение изображений'|ftext}" src='/tools/simple-php-captcha/index.php' /></td>
		<td align="center"><input placeholder="Код" name="kcaptcha"  value=""></td>
		</tr>

	</table>
	<button class="submit" type="submit">Отправить</button>
	<p></p>
</form>