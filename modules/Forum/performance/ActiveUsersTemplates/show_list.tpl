<div fastedit::>
{if $active_users}
	{'Сейчас на форуме:'}
	{foreach from=$active_users item=a_user}
		<a href="?act=show_user&id={$a_user.id}">{$a_user.nic}</a>&nbsp; &nbsp;
	{/foreach}
{else}
	<p style="text-align:center">{'Сейчас нет других пользователей на форуме'}</p>
{/if}
</div>