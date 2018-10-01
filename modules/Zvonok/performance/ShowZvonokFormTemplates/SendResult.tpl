<p fastedit:{$table_name}:>
  {if $sendResult==true}
  	{'Спасибо! Ваше сообщение отправлено.'|ftext}
  {else}
  	{'Технические неполадки отправки сообщения.'|ftext}
  {/if}
</p>