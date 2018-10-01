<div fastedit::>
  <table style="width:100%" border='0' cellspacing='0' cellpadding='0'>
    {foreach name="cat" from=$records item=list}
    <tr style="height:37px">
      <td align='center' valign='center' class="fon_news_all">
        <table style="width:100%" border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td align='left' valign='top' fastedit:{$table_name}:{$list.id}>
              <p class="date">
                {$list.datetime}
            </p>
            {if $list.caption}
            <h1>
              {$list.caption}
            </h1>
            {/if}
            {$list.short_text}
          </td>
        </tr>
        {if $list.full_text}
        <tr>
          <td>
          	<table cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td style="width:65px;height:10px"  valign="middle">
                  <a href='{$pageInfo.name}?{$act_variable}=more&id={$list.id}' class="more">
                    {'подробнее'|ftext}
                  </a>
                </td>
                <td style="width:10px" valign="middle" align="right">
                  <img alt="" src="/modules/News/img/str_blue.gif" hspace="0" border="0" />
                </td>
              </tr>
            </table>
          </td>
        </tr>
        {/if}
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
    <td>
    </td>
  </tr>
  </table>
  
  <table border="0" cellpadding="2" cellspacing="0">
    <tr>
      <td>
        {'Страница:'|ftext}&nbsp;
        {section name="pages" start=1 loop=$pageRecords.page_count+1}
        <a {if $smarty.section.pages.index==$pageRecords.page_selected}style="font-weight:bold"{/if}  class="news_navigations" href="{$pageInfo.name}?page={$smarty.section.pages.index}">
          {$smarty.section.pages.index}
        </a>        
        {/section}
      </td>
    </tr>
  </table>
</div>