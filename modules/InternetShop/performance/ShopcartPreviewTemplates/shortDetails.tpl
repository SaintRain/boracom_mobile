<div fastedit:: style="margin:5px">  
  <h2>
    {'Товары в корзине'|ftext}
  </h2>

  <table id="shopcart_info"  valign='top'  border='0' cellpadding='0' style="width:100%;{if !$total_count}display:none{/if}">
    <tr>
      <td style="white-space:nowrap" align='left' valign='middle'>
        {'Товаров в корзине'|ftext}: 
        <span id="total_count">{$total_count}</span>
      </td>
    </tr>
    <tr>
      <td style="white-space:nowrap" align='left' valign='middle' >
        {'На сумму:'|ftext} 
        <span id="total_summ" style="font-weight:bold">{$total_summ}</span>
        {$currency.sign}
      </td>
    </tr>
    <tr>
      <td align='left' valign='middle'>
        <a style="font-size:16px" href='shopcart'>
          <b>
            {'Oформить заказ'|ftext}
          </b>
        </a>
      </td>
    </tr>
  </table>
  
  <table align='left' style="width:100%" border='0' cellpadding='0'>
    <tr>
      <td colspan="2" style="white-space:nowrap;">
        <span id="shopcart_info_empty" {if $total_count}style="display:none;"{/if}>
          {'Корзина пуста...'|ftext}
        </span>
        <br/>
      </td>
      <tr>
        <tr>
          <td style="white-space:nowrap">
            <select onchange="setCurrency(this)" style="width:90px;margin:0px">              
              {foreach from=$currencies item=item}
              <option {if $currency.id==$item.id}selected{/if} value="{$item.id}">
                {$item.name}
              </option>              
              {/foreach}
            </select>
            {'Валюта'|ftext} 
          </td>
          <td>
          </td>
    </tr>
  </table>
</div>


