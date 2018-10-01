<?xml version="1.0"?>
<rss version="2.0">
  <channel>
    <title>FAQ на сайте {$smarty.const.SETTINGS_HTTP_HOST}</title>
    <link>{$smarty.const.SETTINGS_HTTP_HOST}</link>
    <description>FAQ на сайте {$smarty.const.SETTINGS_HTTP_HOST}</description>
    <language>ru</language>
    <pubDate>Wed, 02 Oct 2002 13:00:00 GMT</pubDate>
    <lastBuildDate>{$date}</lastBuildDate>
    <docs>{$smarty.const.SETTINGS_HTTP_HOST}/rss_faq</docs>
    <generator>http://www.GoodCMS.net</generator>
    <managingEditor>{$smarty.const.SETTINGS_EMAIL_USERNAME} ({$smarty.const.SETTINGS_EMAIL_CAPTION})</managingEditor>
    <webMaster>{$smarty.const.SETTINGS_EMAIL_USERNAME} ({$smarty.const.SETTINGS_EMAIL_CAPTION})</webMaster>
    {foreach from=$records item=item}
    <item>
      <title>{$item.question}</title>
      <link>{$smarty.const.SETTINGS_HTTP_HOST}/faq/{$item.cat_translit}/{$item.translit}</link>
      <description>{$item.answer}</description>
      <pubDate>{$item.datetime}</pubDate>
      <guid>{$smarty.const.SETTINGS_HTTP_HOST}/faq/{$item.cat_translit}/{$item.translit}</guid>
    </item>
    {/foreach}</channel>
</rss>
