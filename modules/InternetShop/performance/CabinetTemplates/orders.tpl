{literal} 
<script type="text/javascript">
  function openZakaz(obj_id) {
	if (GetElementById(obj_id).style.display!='none') {
      GetElementById(obj_id).style.display='none';      
    }
  else {
    GetElementById(obj_id).style.display='table-row';    
  }
}
</script>
{/literal}

<div fastedit::>
  <table cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td>        
        {'Ваша накопительная скидка составляет:'|ftext} 
        <b>
          {$discount}%
        </b>
        <br/>
        {'Сумма оплаченных заказов:'|ftext} 
        <b>
          {$total_summ} {$currency.sign}
        </b>
        <br/>
        <br/>
        {if $orders}
        <h4>
          {'Список ваших заказов'|ftext}
        </h4>
        {/if}        
      </td>
    </tr>
  </table>

{if $orders}
<table style="width:100%;background-color:#e1e5e8" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>
      <table style="width:100%" cellpadding="2" cellspacing="1" border="0" >
        <tr style="background-color:white">
          <td style="width:5%">
            <span color="#F98803">
              <b>№</b>
            </span>
          </td>
          <td style="width:15%">
            <span color="#F98803">
              <b>
                {'Дата создания'|ftext}
              </b>
            </span>
          </td>
          <td style="width:20%">
            <span color="#F98803">
              <b>
                {'Идентификатор получения'|ftext}
              </b>
            </span>
          </td>
          <td style="width:15%">
            <span color="#F98803">
              <b>
                {'Доставка'|ftext}
              </b>
            </span>
          </td>
          <td style="width:20%">
            <span color="#F98803">
              <b>
                {'Полная стоимость'|ftext}
              </b>
            </span>
          </td>
          <td style="width:15%">
            <span color="#F98803">
              <b>
                {'Статус'|ftext}
              </b>
            </span>
          </td>
          <td style="width:10%">
            <span color="#F98803">
              <b>
                {'Оплачен'|ftext}
              </b>
            </span>
          </td>
        </tr>
        {foreach from=$orders item=item}
        <tr fastedit:{$table_name}:{$item.id} {if $item.payed} style="background-color:#e3f4fe"{else} style="background-color:#f9f6ed"{/if}>
          <td>
            <a title="{'Подробности заказа'|ftext}" href="javascript:openZakaz('zakaz{$item.id}')">
              <b>
                {$item.id}
              </b>
            </a>
          </td>
          <td>
            {$item.created}
          </td>
          <td>
            {$item.send_number}
          </td>
          <td>
            {if $item.delivery_cost}{$item.delivery_cost} {$currency.sign}{else}{'Не указано'|ftext}{/if}
          </td>
          <td>
            <b>
              {$item.total_price} {$currency.sign}
            </b>
            {if !$item.delivery_cost}
            <br/>
            <span style="color:gray;font-weight:normal;font-size:10px">
              {'*неучтена доставка'|ftext}
            </span>
            {/if}
          </td>
          <td>
            {$item.status_id_caption}
          </td>
          <td align="center">
            {if $item.payed}{'Да'|ftext}{else}{'Нет'|ftext}{/if}
          </td>
        </tr>
        <tr {if $item.payed}style="background-color:#e3f4fe;display:none" {else}style="background-color:#f9f6ed;display:none"{/if} id="zakaz{$item.id}">
          <td colspan="7" style="background-color:#e1e5e8">
            {$item.composition}                   
          </td>
        </tr>
        {/foreach}
      </table>
    </td>
  </tr>
</table>
{else}
	{'У вас нет еще заказов.'|ftext}
{/if}

<br/>
<br/>
{if $pages.page_count != ''}
<table style="margin-top:3px;width:100%"  border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td style="height:25px">
      <td align="right">
        {'Страница:'|ftext}
        {if $pages.page_selected>1}
      	<a class="step" href="?act=orders&page=1">&lt;&lt;</a>
        &nbsp; 
        <a class="step" href="?act=orders&page={$pages.page_selected-1}">&lt;</a>
          {/if}
          &nbsp;&nbsp;
          {section name="pages" start=1 loop=$pages.page_count+1}
          <a {if $smarty.section.pages.index==$pages.page_selected}class="step_selected"{else}class="step"{/if} href="{$pageInfo.name}?act=orders&page={$smarty.section.pages.index}">
            {$smarty.section.pages.index}
          </a>
          &nbsp;
          {/section}
          {if $pages.page_selected<$pages.page_count}
          <a class="step" href="?act=orders&page={$pages.page_selected+1}">&gt;</a>
          &nbsp; 
          <a class="step" href="?act=orders&page={$pages.page_count}">&gt;&gt;</a>
          {/if}
       </td>
    </tr>
</table>
{/if} 
</div>