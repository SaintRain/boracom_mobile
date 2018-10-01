<div fastedit::>
{if $products}
  <p>
    Оплата заказа осуществляется в валюте 
    <b>
      «{$currency_general.name}»
    </b>
    независимо от выбранной валюты на сайте
  </p>
  <br/>
<form name="data" id="data" action="/shopcart" method="post">
  <p>
    <input type="hidden" name="cdo" value="orderForm">
  </p>
  <table style="width:100%;background-color:#e1e5e8" border='0' cellspacing="1" cellpadding="3">
    <tr style="background-color:white">
      <td align="center" style="width:20%" align="center"><span color="#F98803"><b>{'Фото'|ftext}</b></span></td>
      <td style="width:35%" align="center"><span color="#F98803"><b>{'Название товара'|ftext}</b></span></td>
      <td style="width:10%" align="center"><span color="#F98803"><b>{'Количество'|ftext}</b></span></td>
      <td style="width:15%" align="center"><span color="#F98803"><b>{'Цена'|ftext}</b></span></td>
      <td style="width:15%" align="center"><span color="#F98803"><b>{'Сумма'|ftext}</b></span></td>
      <td style="width:5%" align="center"><a href="javascript:if (confirm('Вы действительно хотите очистить корзину?')) location.href='shopcart?empty=true';"><img alt="" src='/modules/InternetShop/img/del.gif' width='9px' height='9px' border='0' title="{'Удалить весь товар'|ftext}" /></a></td>
    </tr>
    {foreach name="products" from=$products item=item}
    <tr style="background-color:#ffffff" id="str_{$item.id}" fastedit:{$table_name}:{$item.id}>
      <td align="center">
        <a href="internet-shop?act=more&category_id={$item.category_id}&id={$item.id}"><img alt="{$item.caption}" border="0" src="{if $item.image}/modules/InternetShop/management/storage/images/products/image/{$item.id}/preview/{$item.image}{else}/modules/InternetShop/img/nopic.gif{/if}" /></a>
        </td>
      <td align="center" {$item.id}>      
        <a href="internet-shop?act=more&category_id={$item.category_id}&id={$item.id}">{$item.caption}{if $item.article}
        <br/>
        {'Артикл:'|ftext} {$item.article}{/if}</a>
        </td>
      <td align="center"><input class="numbers_only" id="count{$item.id}" name="count{$item.id}" onchange="updateCartForm(false)" style="width:50px" value="{$item.count}" /></td>
      <td align="center"><span id="pstoim_{$item.id}">{$item.price}</span> {$currency.sign}</td>
      <td align="center"><span id="psum_{$item.id}">{$item.summ}</span> {$currency.sign}</td>
      <td align="center"><a href="javascript:deleteFromCart({$item.id})"><img alt="" src='/modules/InternetShop/img/del.gif' width="9px" height="9px" border='0' title="{'Удалить товар'|ftext}" /></a></td>
    </tr>
    {/foreach}
  </table>
  <table align="center" border='0' cellpadding='0' cellspacing='0' style="width:100%">
    <tr>
      <td align="center" valign='top'>
      	<br/>
        <table align='right' border='0' cellspacing='0' cellpadding='5'>
          <tr>
            <td align='right' valign='middle'><b>{'Сумма:'|ftext}</b></td>
            <td align='left' valign='middle'><span id="shopcart_total_summ">{$total_summ_dustly}</span> {$currency.sign}</td>
          </tr>
          <tr>
            <td align='right' valign='middle'><b>{'Накопительная скидка:'|ftext}</b></td>
            <td align='left' valign='middle'>{$discount_percent}% (<span id="shopcart_discount">{$discount}</span> {$currency.sign})</td>
          </tr>
          <tr>
            <td align='right' valign='middle'><b>{'Оптовая скидка:'|ftext}</b></td>
            <td align='left' valign='middle'><span id="shopcart_discount_by_q_summ">{$discount_by_q_summ}</span> {$currency.sign}</td>
          </tr>          
          <tr>
            <td align='right' valign='middle'><b>{'Итого к оплате:'|ftext}</b></td>
            <td align='left' valign='middle'><span style="color:#336600; font-weight:bold" id="shopcart_total">{$total_summ}</span><span style="color:#336600;font-weight:bold"> {$currency.sign}</span> *</td>
          </tr>
          <tr>
            <td colspan='2' align='right' valign='middle'><span style="font-size:12px">{'* В общую стоимость не включена стоимость доставки'|ftext}</span></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</form>


<script type="text/javascript">
	var discount_percent={$discount_percent};
</script> 
<br/>
<br/>

{if $errors}  
  <center>
    <div>      
      {foreach from=$errors item=error}
      <p style="color:red">
        {$error|ftext}
      </p>
      {/foreach}
    </div>    
  </center> 
{/if}

<table align="center" border='0' cellpadding='0' cellspacing='0' style="width:100%">
  <tr>
    <td align="center">     
      <form id="formdata" style="margin-top:0px"  action="/shopcart" method='post' name='loadresume' id="loadresume">      
       <p>
         <input type="hidden" name="cdo" value="sendOrder"/>
       </p>
      <table align="center" border='0' cellpadding='5' cellspacing='0' style="width:600px">
        <tr style="height:30px">
          <td colspan='100%' align="left" valign="middle"><span style="color:#5a7bca"><b>*</b></span>{' - поле обязательно для заполнения'|ftext}</td>
        </tr>
        <tr style="height:2px">
          <td colspan='100%' align="right" valign="top" style="background-color:#ffffff;"  class="top"></td>
        </tr>
        <tr>
          <td style="width:30%" align="left" valign="middle">{'Ваша фамилия:'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top"><input name="second_name" id="second_name" value="{$second_name}" style="width:100%" /></td>
        </tr>
        <tr>
          <td style="width:30%" align="left" valign="middle">{'Ваше имя:'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top"><input name="name" id="name" value="{$name}" style="width:100%" /></td>
        </tr>
        <tr>
          <td style="width:30%" align="left" valign="middle">{'Ваше отчество:'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top"><input name="otchestvo" id="otchestvo" value="{$otchestvo}" style="width:100%" /></td>
        </tr>
        <tr>
          <td align="left" valign="middle">{'Юридический статус:'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top">
           <select name="ur_status_id" style="width:100%">
           {foreach from=$ur_statuses item=item}
              <option {if $ur_status_id==$item.id} selected {/if} value="{$item.id}">{$item.caption|ftext}</option>
              {/foreach}             
            </select>
           </td>
        </tr>
        <tr>
          <td align="left" valign="middle">{'Ваш телефон:'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top"><input name="phone" id="phone" value="{$phone}" style="width:100%" /></td>
        </tr>
        <tr>
          <td align="left" valign="middle">{'Ваш e-mail:'|ftext}<span style="color:#5a7bca">*</span>&nbsp;&nbsp;</td>
          <td valign="top"><input name="email" id="email" value="{$email}" style="width:100%" /></td>
        </tr>
        <tr>
          <td align="left" valign="middle">{'Почтовый индекс:'|ftext}<span style="color:#5a7bca">*</span>&nbsp;&nbsp;</td>
          <td valign="top"><input name="mail_index" id="mail_index" value="{$mail_index}" style="width:100%" /></td>
        </tr>
        <tr>
          <td align="left" valign="middle">{'Почтовый адрес доставки:'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top"><input name="address_of_delivery" id="address_of_delivery" value="{$address_of_delivery}" style="width:100%" /></td>
        </tr>
        <tr>
          <td align="left" valign="middle">{'Доставка:'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top">
          	<select name="delivery_id" style="width:100%">              
			{foreach from=$delivery item=item}	
              <option {if $item.id==$delivery_id} selected {/if} value="{$item.id}">{$item.name|ftext}</option>              
			{/foreach}		
            </select>
           </td>
        </tr>
        <tr>
          <td align="left" valign="middle">{'Вариант оплаты:'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top">
          	<select name="pay_system_id" style="width:100%">              
				{foreach from=$pay_systems item=item}
    	          <option {if $item.id==$pay_system_id} selected {/if} value="{$item.id}">{$item.caption|ftext}</option>              
				{/foreach}		
            </select>
          </td>
        </tr>
        <tr style="height:25px">
          <td valign="top" align="left">
            &nbsp;
          </td>
          <td align="right" valign="bottom">
            <input  type="submit" class="button" value="{'ОФОРМИТЬ ЗАКАЗ'|ftext}" onclick="updateCartForm(true)" />
          </td>
        </tr>
      </table>
      </form>
     </td>
  </tr>
</table>
{else}
  <h3 style="text-align:center">
    {'Ваша корзина пуста!'|ftext}
  </h3>
{/if} 
</div>