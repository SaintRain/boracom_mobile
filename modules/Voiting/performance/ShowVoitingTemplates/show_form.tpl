<div fastedit:: style="margin:5px">
  {if !$user_is_voited}
  <form action="?act=add_voiting" style="margin:0px" method="post">
    <p>
      <input type="hidden" name="ball" value="1"/>
    </p>
    {/if}    
    <h1 fastedit:{$question_table_name}:{$question.id}>
      {$question.caption}
    </h1>
    {if $smarty.post.answer_id}    
      <p style="color:green">
        {'Спасибо! Ваш голос принят!'|ftext}
      </p>    
    <br/>
    {/if}
    <table style="width:{$settings.width}px" border="0" cellpadding="0" cellspacing="2">
      {foreach from=$answers item=item}
      <tr>
        <td fastedit:{$table_name}:{$item.id}>
          {$item.caption} {$item.percent}% ({$item.summ_voiting})
        </td>
      </tr>
      <tr>
        <td>
          <table border="0" cellpadding="0" cellspacing="0">
            <tr>
              {if !$smarty.session.user_is_voited}
              <td style="width:15px">
                <input type="radio" name="answer_id" value="{$item.id}" style="border:0px" />
              </td>
              <td>
                &nbsp;
              </td>
              {/if}
              <td style="width:6px">
                <img alt="" width="6px" style="margin:0px" src="/modules/{$moduleInfo.module_name}/images/left_vote.gif" />
              </td>
              <td style="width:1px">
                <img alt="" width="{$item.width}px" height="7px" id="progress_bar" style="margin:0px" src="/modules/{$moduleInfo.module_name}/images/line_vote.gif" />
              </td>
              <td style="width:6px">
                <img alt="" width="6px" style="margin:0px" src="/modules/{$moduleInfo.module_name}/images/right_vote.gif" />
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="height:3px">
        </td>
      </tr>
      <tr>
        <td style="height:1px;background-color:#d9e4ef">
        </td>
      </tr>
      <tr>
        <td style="height:3px">
        </td>
      </tr>
      {/foreach}
      
      {if !$user_is_voited}
      <tr>
        <td valign="bottom"  align="left">
          <input class="button" type="submit" value="{'Проголосовать'|ftext}" />
        </td>
      </tr>
    </form>
    {/if}
  </table>
</div>
<br/>
<br/>
