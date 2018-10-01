{literal}
<script type="text/javascript">
function refreshFAQ(cat_id) {
	location.href=cat_id.value;
}
</script>
{/literal}

<div fastedit:{$table_name}:>
  <table border="0" cellspacing="0" cellpadding="0">
	<tr>
      <td>
        <a href="rss_faq" title="{'Подписаться  на RSS канал'|ftext}">
          <img alt="" src="/modules/Faq/img/rss_small.png" border='0' />
        </a>
      </td>
      <td style="width:10px">
      </td>
      <td>
        <h1 style="margin:0px">
          {'Выберите тему:'|ftext}
        </h1>
      </td>
      <tr>
  </table>

<select onChange="refreshFAQ(this)" name="category_id" style="width:300px">
{foreach from=$cats item=item}
	<option {if $item.id==$cat_id} selected {/if} value="{"?category_id=`$item.id`"|furl}">{$item.name}</option>
{/foreach}
</select>      	

  <br/>
  <br/>

{if $records}
<table style="width:100%" border="0" cellspacing="0" cellpadding="0">
  {foreach name="cat" from=$records item=list}
  <tr style="height:37px">
    <td align="center" valign="middle" class="fon_news_all">
    <table style="width:100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top" fastedit:{$table_name}:{$list.id}>          
              <p style="font-size:11px">{$list.datetime} {$list.author}</p>              
              <p style="margin-top:5px"><b>{$list.question}</b></p>          
              </td>
        </tr>
        {if $list.answer}
        <tr>
          <td>
          <table cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td style="height:10px;white-space:nowrap" valign="middle"><a href="{$pageInfo.name}?{$act_variable}=more&category_id={$list.category_id}&id={$list.id}" class="more">{"смотреть ответ"|ftext}</a></td>
                <td style="width:10px"></td>
              </tr>
          </table>
          </td>
        </tr>
        {/if}
      </table></td>
  </tr>
  <tr>
    <td style="height:15px"></td>
  </tr>
  <tr>
    <td style="height:1px;background-color:#eaeaea"></td>
  </tr>
  <tr>
    <td style="height:10px"></td>
  </tr>
  {/foreach}
</table>


<table border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td>{"Страница:"|ftext}&nbsp;
      {section name="pages" start=1 loop=$pageRecords.page_count+1}
      	 <a {if $smarty.section.pages.index==$pageRecords.page_selected}style="font-weight:bold"{/if} href="{$pageInfo.name}?category_id={$cat_id}&page={$smarty.section.pages.index}">{$smarty.section.pages.index}</a> 
      {/section}
    </td>
  </tr>
</table>
{else}
	<h2>{"В данной категории еще нет вопросов"|ftext}</h2>
{/if}
  
  <div style="width:100%;height:1px;background-color:#e1e5e8">
  </div>
<br/>
</div>

{include file="$form_template"}