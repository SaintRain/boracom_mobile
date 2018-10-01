Здравствуйте, {$name} {$otchestvo}.<br>
Вы сделали заказ в интернет-магазине <a href="{$smarty.const.SETTINGS_HTTP_HOST}">«{$host}»</a>
<br/>
Номер заказа: № <b>{$order_number}</b><br/>
Дата заказа: <b>{$created}</b>
<br/>
<br/>

<table style="width:100%;background-color:#c8c8c8" border="0" cellspacing='1' cellpadding='5'>
  <tr style="background-color:#e1e5e8">
    <td style="width:60%" align="left"><b>{'Наименование товара'|ftext}</b></td>
    <td style="width:10%" align="center"><b>{'Кол-во'|ftext}</b></td>
    <td style="width:10%" align="center"><b>{'Цена'|ftext}</b></td>
    <td style="width:10%" align="center"><b>{'Сумма'|ftext}</b></td>
  </tr>
  {foreach name="products" from=$products item=item}
  <tr style="background-color:ffffff" id="str_{$item.id}">
    <td align='left' valign='midle'>{$item.caption}
    	<br/>
      {'Артикул:'|ftext} {$item.article}
    </td>
    <td align="center">{$item.count}</td>
    <td align="center">{$item.price} {$currency.sign}</td>
    <td align="center">{$item.summ} {$currency.sign}</td>
  </tr>
  {/foreach}
</table>

<table align="center" border='0' cellpadding='0' cellspacing='0' style="width:100%">
  <tr>
    <td align="right">
    <table border='0' cellspacing='0' cellpadding='5'>
        <tr>
          <td align='right' valign='middle'><b>{'Сумма:'|ftext}</b></td>
          <td align='left' valign='middle'>{$total_summ_dustly} {$currency.sign}</td>
        </tr>
        <tr>
          <td align='right' valign='middle'><b>{'Накопительная скидка:'|ftext}</b></td>
          <td align='left' valign='middle'>{$discount_percent}% ({$discount} {$currency.sign})</td>
        </tr>
          <tr>
            <td align='right' valign='middle'><b>{'Оптовая скидка:'|ftext}</b></td>
            <td align='left' valign='middle'>{$discount_by_q_summ} {$currency.sign}</td>
          </tr>        
        <tr>
          <td align='right' valign='middle'><b>{'Итого без доставки:'|ftext}</b></td>
          <td align='left' valign='middle'><span style="color:#336600; font-weight:bold"> {$total_summ} {$currency.sign}</span></td>
        </tr>
        <tr>
          <td align="right" colspan="100%"><span style="font-size:9px">{'*Стоимость доставки отобразится в вашем личном кабинете'|ftext}</span></td>
        </tr>
        <tr>
          <td align='right' valign='center' colspan="2"> {'<br/>Если товар временно отсутствует на складе, с Вами свяжется наш менеджер.<br>Спасибо за заказ.<br/>
            <br/>
            С уважением, администратор.'|ftext} </td>
        </tr>
      </table>
     </td>
  </tr>
</table>