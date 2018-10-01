<div style="margin-left:5px;" fastedit:: >
  <div style="float:left">
    <h2 style="margin-top:0px">
      {'Анонс новостей'|ftext}
    </h2>
  </div>
  <div style="float:left;margin-left:10px;height:30px">
    <a alt="" href="rss" title="{'Подписаться  на RSS канал'|ftext}">
      <img src="/modules/{$moduleInfo.module_name}/img/rss_small.png" border='0' />
    </a>
  </div>
  
  {foreach name="anonse" from=$records item=item}
  <div style="clear:both" fastedit:{$table_name}:{$item.id}>
    <span class="date">
      {$item.datetime}
    </span>
    <br/>
    <p class="news_anonse_capt">
      {$item.caption}
    </p>
    {if $item.short_text}
    <p class="news_anonse">
      {$item.short_text}
    </p>
    {/if}
    {if $item.full_text!=''}
    <div style="float:left">
      <a href="{$settings.page_target}?{$act_variable}=more&id={$item.id}" class="more">
        {'подробнее'|ftext}
      </a>      
    </div>
    <div style="float:left;margin-left:5px">
      <img alt="" src="/modules/{$moduleInfo.module_name}/img/str_blue.gif" hspace="0" border="0" />
    </div>

    {/if}      
    {if !$smarty.foreach.anonse.last}
    <div style="margin-top:5px;margin-bottom:5px;width:100%;height:1px;background-color:#d6d9db">
    </div>        
    {/if}
  </div>
  {/foreach}
</div>