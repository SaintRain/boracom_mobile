<span fastedit::>
<h2>Онлайн оплата заказа №{$order_info.id}</h2>
<script type="text/javascript" src='https://merchant.roboxchange.com/Handler/MrchSumPreview.ashx?MrchLogin={$paysystem_info.login}&OutSum={$order_info.total_summ}&InvId={$order_info.id}&IncCurrLabel=WMRM&Desc=Оплата+заказа+№{$order_info.id}&SignatureValue={$paysystem_info.crc}&Culture={$paysystem_info.culture}&Encoding=utf-8&sCulture=ru'></script>
</span>