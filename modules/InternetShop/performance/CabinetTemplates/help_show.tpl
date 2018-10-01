<div fastedit::>
{if $help}
  <p>
    {'Ваша переписка с техподдержкой'|ftext}
  </p>
  <br/>
<table style="width:100%;background-color:#e1e5e8" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>
    <table style="width:100%" cellpadding="2" cellspacing="1" border="0">
        <tr style="background-color:white">
          <td width="15%"><span color="#F98803"><b>{'Дата'|ftext}</b></span></td>
          <td width="85%"><span color="#F98803"><b>{'Переписка'|ftext}</b></span></td>          
        </tr>
        
        {foreach from=$help item=h}
         {if $h.show_answer} 
        <tr style="background-color:#f0f0f0">
          <td valign="top">
          <p style="font-size:11px"><b>{'Ответ'}</b></p>
          </td>
          <td fastedit:{$table_name}:{$h.id}>
          	{$h.answer}
          	{if $h.answer_attach}
          		<br/>
          		<a target="_blank" href="/modules/InternetShop/management/storage/files/help/answer_attach/{$h.id}/{$h.answer_attach}">
          		<img alt="" border="0" src="/modules/InternetShop/img/attachment.png" /> {'ВЛОЖЕНИЕ'|ftext}
          		</a>
          	{/if}
          </td>          
        </tr>
        {/if}        
        
        <tr style="background-color:white">
          <td valign="top"><p style="font-size:11px">{$h.datetime}</p>          
          </td>
          <td valign="top" fastedit:{$table_name}:{$h.id}>        
          {$h.question}
          	{if $h.question_attach}
          		<br/>
          		<a target="_blank" href="/modules/InternetShop/management/storage/files/help/question_attach/{$h.id}/{$h.question_attach}">
          		<img alt="" border="0" src="/modules/InternetShop/img/attachment.png"/> {'ВЛОЖЕНИЕ'|ftext}
          		</a>
          	{/if}                    
          </td>          
        </tr>                                        
        {/foreach}
      </table>
      </td>
  </tr>
</table>
{else}
	{'Еще нет добавленных вопросов.'|ftext}
{/if}

<br/>
<br/>
{if $pages.page_count != ''}
<table style="margin-top:3px;width:100%;"  border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td style="height:25px">
    <td align="right">{'Страница:'|ftext}
      {if $pages.page_selected>1}
      	<a class="step" href="?act=help&page=1">&lt;&lt;</a>&nbsp; <a class="step" href="?act=help&page={$pages.page_selected-1}">&lt;</a>
      {/if}
      &nbsp;&nbsp;
      {section name="pages" start=1 loop=$pages.page_count+1}
       	<a {if $smarty.section.pages.index==$pages.page_selected}class="step_selected"{else}class="step"{/if} href="{$pageInfo.name}?act=help&page={$smarty.section.pages.index}">{$smarty.section.pages.index}</a> &nbsp;
      {/section}
      {if $pages.page_selected<$pages.page_count}
      	<a class="step" href="?act=help&page={$pages.page_selected+1}">&gt;</a>&nbsp; <a class="step" href="?act=help&page={$pages.page_count}">&gt;&gt;</a>
      {/if}
      </td>
  </tr>
</table>
{/if}
      
<h3>{'Задать вопрос в техподдержку'|ftext}</h3>
{if $errors}
	<br/>
	<center>
    	{foreach from=$errors item=error}
        	<p style="color:red">{$error|ftext}</p>
	    {/foreach}	
    </center>
    <br/>
    <br/>
{/if}
            
<form id="help_form" action='?act=help_add_q#help_form' method="post" enctype="multipart/form-data">
	{if $q_is_added}
		<br/>
        <center>
          <h2>{'Благодарим за ваш вопрос! В ближайшее время наши специалисты дадут ответ на ваш вопрос.'|ftext}</h2>
        </center>
        <br/>
    {/if}
    
 <p>
 	<input type="hidden" name="datetime" value="" />
 </p>
        
  <table style="width:100%" cellpadding="2" cellspacing="2" border="0">    
      <tr>
        <td style="white-space:nowrap" valign="top">
          {'Ваш вопрос:'|ftext}&nbsp;
          <span style="color:#5acbff">
            *
          </span>
        </td>
        <td>
          <textarea style="width:600px" rows="10" name="question" id="question">
            {$question}
          </textarea>
        </td>
      </tr>
      <tr>
        <td>
          {'Вложение:'|ftext}&nbsp;
        </td>
        <td>
          <input type="file" value="" name="question_attach"/>
        </td>
      </tr>      
      <tr>
        <td style="height:30px">
        </td>
        <td valign="bottom">
          <input class="button" type="submit" value="{'Добавить вопрос'|ftext}" name='send_com' />
        </td>
      </tr>
  </table>
      </form>
</div>      

{$editor}            