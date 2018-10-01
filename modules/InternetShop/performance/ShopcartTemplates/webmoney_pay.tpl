<form fastedit:: id=pay name=pay method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp"> 
  <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{$order_info.total_summ}">
  <input type="hidden" name="LMI_PAYMENT_DESC_BASE64" value="{$description}">
  <input type="hidden" name="LMI_PAYMENT_NO" value="{$order_info.id}">
  <input type="hidden" name="LMI_PAYEE_PURSE" value="{$paysystem_info.purse}">
 <input class="button" type="submit" value="Оплатить заказ №{$order_info.id}">
</form> 