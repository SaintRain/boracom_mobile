<div fastedit::>  
  <table fastedit:{$table_name}:{$record.id} style="width:100%" border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td style="width:670px" align='left' valign='top'>
        <p class="date">
          {$record.datetime}
        </p>
        {if $record.caption}
        <h1>
          {$record.caption}
        </h1>
        {/if}
        {$record.short_text} 
      </td>
    </tr>
    <tr>
      <td align='left' valign='top'>
        {$record.full_text} 
      </td>
    </tr>
  </table>
  <br/>
  <center>
    <a class="news_navigations"  href="javascript: history.go(-1)">
      {'&larr; Вернуться назад'|ftext}
    </a>
  </center>
  <br/>
  
  {if $comments_pages} 
  <br/>
  <h1>
    <i>
      {'Комментарии пользователей:'|ftext}
    </i>
  </h1>
  <table style="width:100%" border='0' cellspacing='0' cellpadding='0'>
    {foreach name="com" from=$comments_records item=list}
    <tr style="height:37px">
      <td align='center' valign='center' class=fon_news_all>
        <table align='center' style="width:100%" border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td align='left' valign='top' fastedit:{$table_name_comments}:{$record.id}>
              <p class="date">
                {$list.datetime}{',  %s'|ftext:$list.name}
              </p>
              <br/>
              {$list.text}
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="height:15px">
      </td>
    </tr>
    <tr>
      <td style="height:1px;background-color:#eaeaea">
      </td>
    </tr>
    <tr>
      <td style="height:10px">
      </td>
    </tr>
    {/foreach}
    <tr style="height:20px">
      <td align='left' valign='center'>
        <img alt="" src='/modules/News/img/zero.gif' width='3' height='20px' border='0' />
      </td>
    </tr>
  </table>
  
  {if $comments_pages.records_count>0}
  <table border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
      <td>
        {'Страница:'|ftext}&nbsp;
        {section name="pages" start=1 loop=$comments_pages.page_count+1}
        <a {if $smarty.section.pages.index==$comments_pages.p_selected}style="font-weight:bold"{/if}  class="news_navigations" href="{$pageInfo.name}?{$tagInfo.act_variable}=more&id={$record.id}&page={$smarty.section.pages.index}">
          {$smarty.section.pages.index}
        </a>        
        {/section}
      </td>
    </tr>
  </table>
  {/if}
  
  <br/>
  <p style="color:gray">
    {'Вы также можете добавить свой комментарий:'|ftext}
  </p>
  <br/>
  {if $errors}
  {foreach from=$errors item=error}
  <p style="color:red">
    {$error|ftext}
  </p>
  {/foreach}
  <br/>
  {/if}
  
  {if $comment_is_added}
  <center>
    <h1>
      {'Спасибо, Ваш комментарий будет добавлен после проверки администрацией сайта.'|ftext}
    </h1>
  </center>
  {/if}
  
  <form id="comments_form" action="news?act=insert_comments&id={$record.id}#comments_form" method="post">
    <p>
      <input type="hidden" name="datetime" value="" />
      <input type="hidden" name="news_id" value="{$smarty.get.id}" />
    </p>    
    <table cellpadding="2" cellspacing="2">
      <tr>
        <td style="width:100px">
          {'Ваше имя:'|ftext}&nbsp;
          <span style="color:#5acbff">*</span>
        </td>
        <td>
          <input value="{$name}"  name="name" style="width:500px" />
        </td>
      </tr>
      <tr>
        <td>
          {'Ваше email:'|ftext}&nbsp;
          <span style="color:#5acbff">*</span>
          </td>
          <td>
            <input value="{$email}" name="email" style="width:500px" />
        </td>
      </tr>
      <tr>
        <td style="white-space:nowrap" valign="top">
          {'Комментарий:'|ftext}&nbsp;
          <span style="color:#5acbff">*</span>
        </td>
        <td>
          <textarea style="width:500px" rows="5" name="text" id="text">
            {$text}
          </textarea>
        </td>
      </tr>
      
      {if $settings.kcaptcha==1}
      <tr>        
        <td align='left' valign='center' style="width:100px">
          {'Введите число:'|ftext}&nbsp;
          <span style="color:#5acbff">*</span>
          </td>
          <td align="left" valign="top">            
            <table cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td align='left' valign='center' style="width:120px">
                  <img width="120px" height="50px"  id="kcaptcha_img" alt="{'Включите отображеине изображений'|ftext}" src='/tools/kcaptcha/index.php' border='0' />
                </td>
                <td  valign='center' align="center">
                  <input name="kcaptcha" style="WIDTH: 105px" class=i_black>
                  <br/>
                  <a class="news_navigations" href="javascript:reloadKcaptcha()">
                    {'поменять картинку'|ftext}
                  </a>
                </td>                
              </tr>              
            </table>
        </td>
      </tr>      
      {/if}      
      <tr>
        <td style="height:30px">
        </td>
        <td valign="bottom">
          <input style="width:150px" class="button" type="submit" value="{'Добавить комментарий'|ftext}" />
        </td>
      </tr>
    </table>
  </form>
  <br/>
  <br/>  
  {/if}
</div>

{literal} 
<script type="text/javascript"> 
  function  reloadKcaptcha() {	
  var time = Math.random();  
  document.getElementById('kcaptcha_img').src="/tools/kcaptcha/index.php?t="+time;
}
</script>
{/literal}