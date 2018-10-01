<form fastedit:: method="post" action="http://money.yandex.ru/select-wallet.xml">
<input type="hidden" name="TargetCurrency" value="643">
<input type="hidden" name="currency" value="643">
<input type="hidden" name="wbp_InactivityPeriod" value="2">
<input type="hidden" name="wbp_ShopAddress" value="wn1.paycash.ru:8828">
<input type="hidden" name="wbp_Version" value="1.0">
<input type="hidden" name="BankID" value="100">
<input type="hidden" name="TargetBankID" value="1001">
<input type="hidden" name="PaymentTypeCD" value="PC">
{if $type==0}
<input type="hidden" name="ShopID" value="{$paysystem_info.shop_id}">
<input type="hidden" name="scid" value="{$paysystem_info.scid}">
{/if}

<input type="hidden" name="CustomerNumber" value="{$order_info.id}">
<input type="hidden" name="Sum" value="{$order_info.total_summ}">
<input type="hidden" name="CustName" value="{$user_info.second_name} {$user_info.name} {$user_info.otchestvo}">
<input type="hidden" name="CustAddr" value="{$user_info.address_of_delivery}">
<input type="hidden" name="CustEMail" value="{$user_info.email}">

<input type="hidden" name="OrderDetails" value="Оплата заказа №{$order_info.id}">
<input class="button" type="submit" value="Оплатить заказ №{$order_info.id} через Яндекс.Кошелек">
</form>


{if $type==0}
<form action="http://127.0.0.1:8129/wallet" method="POST">
<input type="hidden" name="wbp_Version" value="2">
<input type="hidden" name="wbp_MessageType" value="DirectPaymentIntoAccountRequest">
<input type="hidden" name="wbp_ShopAddress" value="{$paysystem_info.email}">
<input type="hidden" name="wbp_accountid" value="{$paysystem_info.purse}">
<input type="hidden" name="wbp_currencyamount" value="643;{$order_info.total_summ}">
<input type="hidden" name="wbp_ShopErrorInfo" value="Деньги не отправлены">
<input type="hidden" name="wbp_shortdescription" value="{$order_info.id}">
<input type="hidden" name="wbp_template_1" value="Оплата заказа №{$order_info.id}">
<input class="button" type="submit" name="submit" value="Оплатить заказ №{$order_info.id} через «Интернет.Кошелек» на моем компьютере" >
<p style="font-size:11px">{'Проверьте, не забыли ли вы запустить программу.'|ftext}</p>
</form>

{/if}