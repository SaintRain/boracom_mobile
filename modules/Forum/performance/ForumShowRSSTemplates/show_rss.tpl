<?xml version="1.0"?>
<rss version="2.0">
  <channel>
    <title>Форум на сайте {$smarty.const.SETTINGS_HTTP_HOST}</title>
    <link>{$smarty.const.SETTINGS_HTTP_HOST}</link>
    <description>Форум на сайте {$smarty.const.SETTINGS_HTTP_HOST}</description>
    <language>ru</language>
    <pubDate>Wed, 02 Oct 2002 13:00:00 GMT</pubDate>
    <lastBuildDate>{$date}</lastBuildDate>
    <docs>{$docs_url}</docs>
    <generator>http://www.GoodCMS.net</generator>
    <managingEditor>{$smarty.const.SETTINGS_EMAIL_USERNAME} ({$smarty.const.SETTINGS_EMAIL_CAPTION})</managingEditor>
    <webMaster>{$smarty.const.SETTINGS_EMAIL_USERNAME} ({$smarty.const.SETTINGS_EMAIL_CAPTION})</webMaster>    
  <item>
      <title>{$them.caption}</title>
      <link>{$them.link}</link>
      <description>{$them.description}</description>
      <pubDate>{$them.datetime}</pubDate>
      <guid>{$them.link}</guid>
    </item>
    {foreach from=$records item=item}
    <item>
      <title>{$item.them_id_caption}</title>
      <link>{$item.link}</link>
      <description>{$item.description}</description>
      <pubDate>{$item.datetime}</pubDate>
      <guid>{$item.link}</guid>
    </item>
    {/foreach}</channel>
</rss>
