<div fastedit:{$table_name}:>
{if $errors}
	{foreach from=$errors item=error}
		<p style="color:red">{$error|ftext}</p>
	{/foreach} 
	<br/>
{/if}

{if $comment_is_added}
	<h2>{'Спасибо, Ваш комментарий будет добавлен после проверки администрацией сайта.'|ftext}</h2>
	<br/>
	<br/>
	<br/>
{/if}

<h1>{'Вы можете задать свой вопрос'|ftext}</h1>
<form id="comments_form" action="{$settings.page_target}?act=insert_comments&category_id={$cat_id}{if $record.id}&id={$record.id}{/if}#comments_form" method="post">
<p>
  <input type="hidden" name="title" value="" />
  <input type="hidden" name="metadescription" value="" />
  <input type="hidden" name="metakeywords" value="" />
  <input type="hidden" name="datetime" value="" />
  <input type="hidden" name="news_id" value="{$smarty.get.id}" />
</p>  
  <table cellpadding="2" cellspacing="2">  
	<tr>
      <td style="width:100px">{'Тема:'|ftext}&nbsp;<span style="color:#5acbff">*</span></td>
      <td>
      <select name="category_id" style="width:300px">
      {foreach from=$cats item=item}
      	<option {if $item.id==$category_id || $item.id==$cat_id} selected {/if} value="{$item.id}">{$item.name}</option>
      {/foreach}
      </select>
      </td>
    </tr>      
    <tr>
      <td>{'Ваше имя:'|ftext}&nbsp;<span style="color:#5acbff">*</span></td>
      <td><input value="{$author}"  name="author" style="width:300px" /></td>
    </tr>
    <tr>
      <td>{'Ваш email:'|ftext}&nbsp;<span style="color:#5acbff">*</span></td>
      <td><input value="{$email}" name="email" style="width:300px" /></td>
    </tr>
    <tr>
      <td style="white-space:nowrap" valign="top">{'Ваш вопрос:'|ftext}&nbsp;<span style="color:#5acbff">*</span></td>
      <td><textarea style="width:500px" rows="5" name="question" id="question">{$question}</textarea></td>
    </tr>
    
    {if $settings.kcaptcha==1}
    <tr>    
      <td align="left" valign="center" style="white-space:nowrap">{'Введите код:'|ftext}&nbsp;<span style="color:#5acbff">*</span></td>
      <td align="left" valign="top">    
    	<table cellpadding="0" cellspacing="0" border="0">
          <tr>
        	<td align="left" valign="center" style="width:120px">
              <img width="120px" height="50px"  id="kcaptcha_img" alt="{'Включите отображеине изображений'|ftext}" src="/tools/kcaptcha/index.php" border="0" hspace="0" />
          </td>
          <td  valign="center" align="center">
            <input name="kcaptcha" style="width:105px" />
            <p>
              <a href="javascript:reloadKcaptcha()">{"поменять картинку"|ftext}</a>
            </p>
          </td>
          </tr>          
    	</table>
       </td>
      </tr>    
    {/if}
        
    <tr>
      <td style="height:30px"></td>
      <td valign="bottom"><input style="width:120px" class="button" type="submit" value="{'Задать вопрос'|ftext}" /></td>
    </tr>
  </table>
</form>
</div>

{literal} 
<script type="text/javascript"> 
function  reloadKcaptcha() {	
	var time = Math.random();			
 	document.getElementById("kcaptcha_img").src="/tools/kcaptcha/index.php?t="+time;
}
</script> 
{/literal}      