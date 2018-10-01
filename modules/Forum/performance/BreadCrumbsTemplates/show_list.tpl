<div fastedit::>
  <p style="margin-bottom:5px"><a href="/forums">{'Все форумы'|ftext}</a>
{if $group}
 &raquo; <a href="#"><b>{$group.caption}</b></a>
{/if}

{if $forum}
 &raquo; <a href="?group_id={$forum.group_id}">{$forum.group_caption}</a> &raquo; <a href="#"><b>{$forum.caption}</b></a>
{/if}

{if $them}
 &raquo; <a href="?group_id={$them.forum_group_id}">{$them.forum_group_caption}</a> &raquo; <a href="?act=show_forum_thems&forum_id={$them.forum_id}">{$them.forum_caption}</a> &raquo; <a href="#"><b>{$them.caption}</b></a>
 </p>
{/if}

{if $user_info}
 &raquo; <a href="#"><b>{$user_info.nic}</b></a></a>
 </p>
{/if}
</p>
</div>