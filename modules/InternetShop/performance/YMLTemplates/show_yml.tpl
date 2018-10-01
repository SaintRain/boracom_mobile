<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="{$time}">
  <shop>
    <name>Интернет магазин</name>
    <company>Интернет магазин</company>
    <url>{$smarty.const.SETTINGS_HTTP_HOST}</url>
    <currencies>
      <currency id="RUR" rate="1"/>
      <currency id="USD" rate="CBRF"/>
      <currency id="EUR" rate="CBRF"/>
    </currencies>
    <categories> {foreach from=$categories item=c}
      <category id="{$c.id}" {if $c.parent_id>0} parentId="{$c.parent_id}"{/if}>{$c.caption}</category>
      {/foreach} </categories>
    <local_delivery_cost>0</local_delivery_cost>
    <offers> {foreach from=$data item=d}
      <offer id="{$d.id}" available="{if $d.no_have==0}true{else}false{/if}" bid="{$d.id}">
        <url>{$smarty.const.SETTINGS_HTTP_HOST}/internet-shop/{$d.category_translit}/{$d.translit}</url>
        <price>{$d.price}</price>
        <currencyId>RUR</currencyId>
        <categoryId>{$d.category_id}</categoryId>
        <picture>{$smarty.const.SETTINGS_HTTP_HOST}/modules/InternetShop/management/storage/images/products/image/{$d.id}/preview/{$d.image}</picture>
        <delivery>true</delivery>
        <name>{$d.caption}</name>
        <vendor></vendor>
        <vendorCode></vendorCode>
        <description>{$d.small_description}</description>
      </offer>
      {/foreach} </offers>
  </shop>
</yml_catalog>