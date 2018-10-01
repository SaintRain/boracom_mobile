На сайте 
<a href="{$smarty.const.SETTINGS_HTTP_HOST}">
  {$smarty.const.SETTINGS_HTTP_HOST}
</a>
к товару 
<a href="{$smarty.const.SETTINGS_HTTP_HOST}/internet-shop/?act=more&category_id={$category_id}&id={$id}">
  «{$caption}»
</a>
оставили комментарий. 
<br/>
<a href="{$smarty.const.SETTINGS_HTTP_HOST}/{$smarty.const.SETTINGS_ADMIN_PATH}/">
  Перейти в админзону
</a>
<hr>
Комментарий:
<pre>
{$user_comment}
</pre>