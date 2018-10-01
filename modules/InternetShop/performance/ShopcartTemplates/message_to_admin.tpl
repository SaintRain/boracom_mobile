<table style="width:100%;background-color:#c8c8c8" align='center'  border='0' cellspacing='1' cellpadding='5'>
  <tr style="background-color:#e1e5e8">
    <td style="width:60%" align="left"><b>{'Наименование товара'|ftext}</b></td>
    <td style="width:10%" align="center"><b>{'Кол-во'|ftext}</b></td>
    <td style="width:10%" align="center"><b>{'Цена'|ftext}</b></td>
    <td style="width:10%" align="center"><b>{'Сумма'|ftext}</b></td>
  </tr>
  {foreach name="products" from=$products item=item}
  <tr style="background-color:#ffffff" id="str_{$item.id}">
    <td align='left' valign='center'>{$item.caption}<br/>
      {'Артикул:'|ftext} {$item.article}</td>
    <td align="center">{$item.count}</td>
    <td align="center">{$item.price} {$currency.sign}</td>
    <td align="center">{$item.summ} {$currency.sign}</td>
  </tr>
  {/foreach}
</table>

<table  border='0' cellpadding='0' cellspacing='0' style="width:100%">
  <tr>
    <td align="center">
    <table align='right' border='0' cellspacing='0' cellpadding='5'>
        <tr>
          <td align='right' valign="middle"><b>{'Сумма:'|ftext}</b></td>
          <td align='left' valign="middle">{$total_summ_dustly} {$currency.sign}</td>
        </tr>
        <tr>
          <td align='right' valign="middle"><b>{'Накопительная скидка:'|ftext}</b></td>
          <td align='left' valign="middle">{$discount_percent}% ({$discount} {$currency.sign})</td>
        </tr>
          <tr>
            <td align='right' valign="middle"><b>{'Оптовая скидка:'|ftext}</b></td>
            <td align='left' valign="middle">{$discount_by_q_summ} {$currency.sign}</td>
          </tr>        
        <tr>
          <td align='right' valign="middle"><b>{'Итого без доставки:'|ftext}</b></td>
          <td align='left' valign="middle"><span style="color:#336600; font-weight:bold"> {$total_summ} {$currency.sign}</span></td>
        </tr>
        <tr>
          <td align="right" colspan="100%"><span style="font-size:9px">{'*Стоимость доставки отобразится в вашем личном кабинете'|ftext}</span></td>
        </tr>
    </table>
   </td>
  </tr>
</table>

<table style="width:500px;background-color:#e1e5e8"  border='0' cellpadding='5' cellspacing='1'>
  <tr style="background-color:white">
    <td colspan="2" align="center" valign="top" style="background-color:#ffffff"><b>{'КОНТАКТНЫЕ ДАННЫЕ'|ftext}</b></td>
  </tr>
  <tr style="background-color:white" >
    <td  align="left" valign="middle">{'Ваша фамилия:'|ftext}</td>
    <td valign="top">{$second_name}</td>
  </tr>
  <tr style="background-color:white" >
    <td  align="left" valign="middle">{'Ваше имя:'|ftext}</td>
    <td valign="top">{$name}</td>
  </tr>
  <tr style="background-color:white">
    <td  align="left" valign="middle">{'Ваше отчество:'|ftext}</td>
    <td valign="top">{$otchestvo}</td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{'Юридический статус:'|ftext}</td>
    <td valign="top">
    {$ur_status_id_caption}    	
    </td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{'Ваш телефон:'|ftext}</td>
    <td valign="top">{$phone}</td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{'Ваш e-mail:'|ftext}&nbsp;&nbsp;</td>
    <td valign="top">{$email}</td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{'Почтовый индекс:'|ftext}&nbsp;&nbsp;</td>
    <td valign="top">{$mail_index}</td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{'Почтовый адрес доставки:'|ftext}</td>
    <td valign="top">{$address_of_delivery}</td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{'Доставка:'|ftext}</td>
    <td valign="top">
    {foreach from=$delivery item=item}
    	{if $item.id==$delivery_id}
    		{$item.name|ftext}
    	{/if}
    {/foreach}
    </td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{'Вариант оплаты:'|ftext}</td>
    <td valign="top">
    {foreach from=$pay_systems item=item}
    	{if $item.id==$pay_system_id}
    		{$item.caption|ftext}
	    {/if}
    {/foreach}
    </td>
  </tr>
</table>