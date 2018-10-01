<table fastedit:: cellpadding="0" cellspacing="0" border="0">
  <tr>
    {foreach from=$langs item=item}
    <td>
      <a href="{$smarty.const.SETTINGS_HTTP_HOST}{if $smarty.const.LANGUAGE_PREFIX!=$item.lang_prefix}/{$item.lang_prefix}{/if}{$url}">
        <img src="/modules/SiteLanguage/management/storage/images/data/image/{$item.id}/preview/{$item.image}" title="{$item.caption}">
      </a>
    </td>
    <td width="5px">
      &nbsp;
    </td>
    {/foreach}
  </tr>
</table>