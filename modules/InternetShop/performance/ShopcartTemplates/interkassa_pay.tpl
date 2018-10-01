<form fastedit:: name="payment" action="https://interkassa.com/lib/payment.php" method="post" enctype="application/x-www-form-urlencoded" accept-charset="utf-8">
<input type="hidden" name="ik_shop_id" value="{$paysystem_info.shop_id}">
<input type="hidden" name="ik_payment_amount" value="{$order_info.total_summ}">
<input type="hidden" name="ik_paysystem_alias" value="">

<input type="hidden" name="ik_status_url" value="{$smarty.const.SETTINGS_HTTP_HOST}/{$pageInfo.name}?act=Result_pay">
<input type="hidden" name="ik_status_method" value="POST">

<input type="hidden" name="ik_success_url" value="{$smarty.const.SETTINGS_HTTP_HOST}/{$pageInfo.name}?act=Success_pay">
<input type="hidden" name="ik_success_method" value="POST">

<input type="hidden" name="ik_fail_url" value="{$smarty.const.SETTINGS_HTTP_HOST}/{$pageInfo.name}?act=Fail_pay">
<input type="hidden" name="ik_fail_method" value="POST">

<input type="hidden" name="ik_fees_payer" value="1">

<input type="hidden" name="ik_payment_id" value="{$order_info.id}">
<input type="hidden" name="ik_payment_desc" value="Оплата заказа №{$order_info.id}">
<input class="button" type="submit" name="process" value="Оплатить заказ №{$order_info.id}">
</form>