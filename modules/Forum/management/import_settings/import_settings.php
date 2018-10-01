<?php
$DATA=array (
  'BDSTRUCTURE' => 
  array (
    'country' => 
    array (
      0 => 'CREATE TABLE `country` (
`id` INT(11)  NOT NULL auto_increment ,
`name` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'timezones' => 
    array (
      0 => 'CREATE TABLE `timezones` (
`id` INT(11)  NOT NULL auto_increment ,
`caption` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`timezone` FLOAT     default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'thems' => 
    array (
      0 => 'CREATE TABLE `thems` (
`id` INT(11)  NOT NULL auto_increment ,
`datetime` DATETIME      ,
`forum_id` INT(11)     default NULL ,
`user_id` INT(11)     default NULL ,
`caption` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`translit` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`description` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`active` BOOL     default \'1\' ,
`discuse` BOOL     default \'1\' ,
`title` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`metadescription` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`metakeywords` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`important` BOOL     default \'0\' ,
`attach` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`view` DOUBLE     default \'0\' ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'fgroups' => 
    array (
      0 => 'CREATE TABLE `fgroups` (
`id` INT(11)  NOT NULL auto_increment ,
`caption` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`translit` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'regions' => 
    array (
      0 => 'CREATE TABLE `regions` (
`id` INT(11)  NOT NULL auto_increment ,
`country_id` INT(11)     default NULL ,
`name` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'city' => 
    array (
      0 => 'CREATE TABLE `city` (
`id` INT(11)  NOT NULL auto_increment ,
`country_id` INT(11)     default NULL ,
`region_id` INT(11)     default NULL ,
`name` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'forums' => 
    array (
      0 => 'CREATE TABLE `forums` (
`id` INT(11)  NOT NULL auto_increment ,
`fgroup_id` INT(11)     default NULL ,
`caption` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`translit` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`description` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`image` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`active` BOOL     default \'1\' ,
`title` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`metadescription` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`metakeywords` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'messages' => 
    array (
      0 => 'CREATE TABLE `messages` (
`id` INT(11)  NOT NULL auto_increment ,
`datetime` DATETIME      ,
`them_id` INT(11)     default NULL ,
`user_id` INT(11)     default NULL ,
`description` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`active` BOOL     default \'1\' ,
`attach` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'users' => 
    array (
      0 => 'CREATE TABLE `users` (
`id` INT(11)  NOT NULL auto_increment ,
`registration` DATETIME      ,
`nic` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`translit` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`second_name` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`name` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`otchestvo` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`company` VARCHAR(200) character set utf8 collate utf8_general_ci    default NULL ,
`email` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`password` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`country_id` INT(11)     default NULL ,
`city` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`phone` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`fax` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`url` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`skype` VARCHAR(50) character set utf8 collate utf8_general_ci    default NULL ,
`icq` VARCHAR(50) character set utf8 collate utf8_general_ci    default NULL ,
`sex` ENUM(\'Мужской\',\'Женский\',\'Робот\') character set utf8 collate utf8_general_ci    default NULL ,
`timezone_id` INT(11)     default NULL ,
`enable` BOOL     default \'0\' ,
`confirm` BOOL     default \'0\' ,
`get_emails` BOOL     default \'0\' ,
`avator` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`moderator` BOOL     default \'0\' ,
`signature` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`last_activity` DATETIME      ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
  ),
  'BLOCKS' => 
  array (
    0 => 
    array (
      'id' => '27',
      'module_id' => '3',
      'type' => '2',
      'name' => 'Authorization',
      'description' => 'Авторизация',
      'act_variable' => 'act',
      'act_method' => 'post',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Authorization',
      'sort_index' => '999',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '43',
          'block_id' => '27',
          'name' => 'info_form.tpl',
          'description' => 'Краткая информация о пользователе',
          'content' => '<div fastedit::>
  <br/>
  <br/>
  Здравствуйте 
  <b>
    {$user.name} {$user.otchestvo} !
  </b>
  <br/>
  Вы можете 
  <a href="cabinet">
    перейти
  </a>
  в свой личный кабинет.
</div>',
          'loaded_name' => 'info_form.tpl',
          'sort_index' => '1446',
          'block_name' => 'Authorization',
        ),
        1 => 
        array (
          'id' => '44',
          'block_id' => '27',
          'name' => 'login_form.tpl',
          'description' => 'Форма атризации',
          'content' => '<form fastedit:: action="" method="post" style="margin:5px">
  <p><input type="hidden" name="act" value="checkLogin"></p>
  <table style="width:180px" cellpadding="0" cellspacing="0" border="0" >
    <tr>
      <td align="left" valign="top"  style="height:20px"><h2>{\'Авторизация\'|ftext}</h2></td>
    </tr>
    <tr>
      <td align="left" valign="top"><span class="title3">Email:</span><br/>
        <input class="input" style="width:150px" name="email" value="" /></td>
    </tr>
    <tr>
      <td style="height:10px" colspan="100%"></td>
    </tr>
    <tr>
      <td align="left" valign="top"><span class="title3">{\'Пароль:\'|ftext}</span><br/>
        <input class="input" style="width:150px" name="password" value="" type="password" /></td>
    </tr>
    <tr>
      <td align="left" valign="top">
      	<table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td style="height:10px" colspan="100%"></td>
          </tr>
          <tr>
            <td align="right" valign="middle"><input checked type="checkbox" value="1" name="zapomnit" /></td>
            <td style="white-space:nowrap">&nbsp;{\'запомнить меня\'|ftext}</td>
          </tr>
        </table>
        </td>
    </tr>
    {if $error}
    <tr>
      <td style="height:30px;color:red" valign="bottom" align="left">{\'Неправильные данные!\'|ftext}</td>
    </tr>
    {/if}
    <tr>
      <td align="left" valign="top" style="height:10px"></td>
    </tr>
    <tr>
      <td align="left" valign="top"><input class="button"  style="width:150px" value="Войти" type="submit" /></td>
    </tr>
    <tr>
      <td align="left" valign="top" style="height:10px"></td>
    </tr>
    <tr>
      <td align="left" valign="top"><a href="vosstanovlenie-parolya">{\'Забыли пароль?\'|ftext}</a></td>
    </tr>
    <tr>
      <td align="left" valign="top"><a href="registratsiya">{\'Регистрация на сайте\'|ftext}</a></td>
    </tr>
  </table>
</form>',
          'loaded_name' => 'login_form.tpl',
          'sort_index' => '1447',
          'block_name' => 'Authorization',
        ),
      ),
    ),
    1 => 
    array (
      'id' => '28',
      'module_id' => '3',
      'type' => '2',
      'name' => 'Registration',
      'description' => 'Регистрация на сайте',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '36',
      'loaded_name' => 'Registration',
      'sort_index' => '1001',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '37',
          'block_id' => '28',
          'name' => 'send_com_theme_confirm',
          'value' => 'Подтвердите регистрацию на сайте ',
          'description' => 'Тема сообщения которое высылается для подтверждения регистрации',
          'edit_s_type_id' => '1',
          'loaded_name' => 'send_com_theme_confirm',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '45',
          'block_id' => '28',
          'name' => 'confirm_result.tpl',
          'description' => 'Результат подтверждения регистрации',
          'content' => '<div fastedit::>
{if $confirm}
	Спасибо, ваша регистраци на нашем сайте подтверждена! Теперь вы можете авторизироваться, использую свой email и пароль.
{else}
	Неправильные данные подтверждения регистрации.
{/if}
</div>',
          'loaded_name' => 'confirm_result.tpl',
          'sort_index' => '1448',
          'block_name' => 'Registration',
        ),
        1 => 
        array (
          'id' => '46',
          'block_id' => '28',
          'name' => 'registration_form.tpl',
          'description' => 'Регистрация пользователя',
          'content' => '<div fastedit::>
{if $errors}
	{foreach from=$errors item=error}
		<p style="color:red">{$error}</p>
	{/foreach}
  <br/>
{/if}

<form action="?act=check_reg" method="post" enctype="multipart/form-data" fasteditt>
<input type="hidden" name="translit" value="{$translit}">
  <table cellpadding="2" cellspacing="2" border="0">
    <tr>
      <td colspan="2" style="height:30px" valign="top" align="right"><span color="#5a7bca">*</span> {\'Поля обязятельные для заполнения\'|ftext}&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="width:150px" valign="top" align="left">{\'Фамилия:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$second_name}" name="second_name" id="second_name" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Имя:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$name}" name="name" id="name" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Отчество:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$otchestvo}" name="otchestvo" id="otchestvo" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'E-Mail:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$email}" name="email" id="email" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Пароль:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$password}" type="password" name="password" id="password" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Повторите пароль:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$retype_password}" type="password" name="retype_password" id="retype_password" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Контактный телефон:\'|ftext}</td>
      <td><input value="{$phone}" name="phone" id="phone" class="form_element" /></td>
    </tr>
    
    <tr>
      <td  valign="top" align="left">{\'Пол:\'|ftext}</td>
      <td><select name="sex" id="sex" class="form_element">
          <option style="color:gray" value="">{\'Не указано\'|ftext}</option>
          <option {if $sex==\'Мужской\'} selected {/if} value="Мужской">{\'Мужской\'|ftext}</option>
          <option {if $sex==\'Женский\'} selected {/if} value="Женский">{\'Женский\'|ftext}</option>
          <option {if $sex==\'Робот\'} selected {/if} value="Робот">{\'Робот\'|ftext}</option>
        </select></td>
    </tr>
        
    <tr>
      <td valign="top" align="left">{\'Ник на форуме:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$nic}" name="nic" id="nic" class="form_element" /></td>
    </tr>       
    <tr>
      <td style="width:150px" valign="top" align="left">{\'Аватор:\'|ftext}</td>
      <td><input type="file" value="" name="avator" id="avator" class="form_element" /></td>
    </tr>    
    <tr>
      <td valign="top" align="left">{\'Временная зона:\'|ftext}</td>
      <td>
      <select name="timezone_id" class="form_element">
      <option style="color:gray" value="">{\'Не указано\'|ftext}</option>
      {foreach from=$timezones item=item}
      <option {if $smarty.post.timezone_id==$item.id} selected {/if} value="{$item.id}">{$item.caption}</option>
      {/foreach}
      </select>
      </td>
    </tr>            
    <tr>
      <td valign="top" align="left"></td>
      <td>
      	<table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td valign="top"><input {if $get_emails} checked {/if} type="checkbox" value="1" name="get_emails" id="get_emails" /></td>
            <td>&nbsp;</td>
            <td>{\'Получать рассылку\'|ftext}</td>
          <tr>
        </table>
        </td>
    </tr>              
    <tr>
      <td></td>
      <td>
      	<table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td valign="top"><input {if $confirm} checked {/if} type="checkbox" value="1" name="confirm" id="confirm" /></td>
            <td>&nbsp;</td>
            <td>{\'Я подтверждаю достоверность указанных данных\'|ftext}</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="2" style="height:15px"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" class="button" value="{\'Зарегистрироваться\'|ftext}"></td>
    </tr>
  </table>
</form>
</div>',
          'loaded_name' => 'registration_form.tpl',
          'sort_index' => '1449',
          'block_name' => 'Registration',
        ),
        2 => 
        array (
          'id' => '47',
          'block_id' => '28',
          'name' => 'reg_message.tpl',
          'description' => 'Сообщение подтверждения авторизации',
          'content' => 'Здравствуйте, уважаемый пользователь! Вы подали заявку на регистрацию на сайте {$smarty.const.SETTINGS_HTTP_HOST}
<br>
Для подтверждения регистрации перейдтите, пожалуйста, по ссылке 
<a href="{$smarty.const.SETTINGS_HTTP_HOST}/registratsiya?act=confirm_r&id={$id}&email={$email}">
  подтвердить регистрацию.
</a>

<br/>
<br/>
С уважением, администрация сайта {$smarty.const.SETTINGS_HTTP_HOST}',
          'loaded_name' => 'reg_message.tpl',
          'sort_index' => '1450',
          'block_name' => 'Registration',
        ),
        3 => 
        array (
          'id' => '48',
          'block_id' => '28',
          'name' => 'reg_result.tpl',
          'description' => 'Сообщение успешной регистрации',
          'content' => '<div fastedit::>
{if $sendResult}
	На ваш контактный адрес электронной почты отправлено подтверждение прохождения регистрации.
{else}
	Не удалось отправить сообщение для подтверждения регистрации.
{/if}
</div>',
          'loaded_name' => 'reg_result.tpl',
          'sort_index' => '1451',
          'block_name' => 'Registration',
        ),
      ),
    ),
    2 => 
    array (
      'id' => '29',
      'module_id' => '3',
      'type' => '2',
      'name' => 'ForumShow',
      'description' => 'Вывод форума',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '35',
      'loaded_name' => 'ForumShow',
      'sort_index' => '1003',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '38',
          'block_id' => '29',
          'name' => 'messages_for_page',
          'value' => '5',
          'description' => 'Выводить сообщений на страницу',
          'edit_s_type_id' => '1',
          'loaded_name' => 'messages_for_page',
        ),
        1 => 
        array (
          'id' => '39',
          'block_id' => '29',
          'name' => 'thems_for_page',
          'value' => '10',
          'description' => 'Выводить тем на страницу',
          'edit_s_type_id' => '1',
          'loaded_name' => 'thems_for_page',
        ),
        2 => 
        array (
          'id' => '40',
          'block_id' => '29',
          'name' => 'datetime',
          'value' => 'Y.m.d H:i:s',
          'description' => 'Формат даты сообщений',
          'edit_s_type_id' => '1',
          'loaded_name' => 'datetime',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '49',
          'block_id' => '29',
          'name' => 'show_forums.tpl',
          'description' => 'Список форумов',
          'content' => '<table fastedit:: style="width:100%;background-color:#dbe5ef"  border="0" cellspacing="1" cellpadding="4">
  {foreach from=$fgroups item=group}
  {if $group.forums}
  <tr style="background-color:#dbe5ef">
    <td colspan="2" style="width:60%" class="forum_head" fastedit:{$group_table_name}:{$group.id}>
      <a href="?group_id={$group.id}">
        <b>
          {$group.caption|ftext}
        </b>
      </a>
    </td>
    <td style="width:10%" align="center" valign="top" class="forum_head">
      {\'Темы\'|ftext}
    </td>
    <td style="width:10%" align="center" valign="top" class="forum_head">
      {\'Сообщения\'|ftext}
    </td>
    <td style="width:20%" align="center" valign="top" class="forum_head">
      {\'Обновления\'|ftext}
    </td>
  </tr>
  {foreach from=$group.forums item=forum}
  {assign var="last_message" value=$forum.last_message}
  <tr style="background-color:white" align="center" valign="middle">
    <td style="width:5%">
      {if $last_message.is_new_message}
      <img alt="" title="{\'Есть новые сообщения\'|ftext}" src="/modules/Forum/images/message.gif" />
      {else}
      <img alt="" title="{\'Нет новых сообщений\'|ftext}" src="/modules/Forum/images/old_message.gif" />
      {/if}      
    </td>
    <td align="left" valign="top" fastedit:{$forum_table_name}:{$forum.id}>
      <a class="forum_theme" href="?act=show_forum_thems&forum_id={$forum.id}">
        {$forum.caption}
      </a>
      {$forum.description}
    </td>
    <td align="center" valign="middle">
      {$forum.them_count}
    </td>
    <td align="center" valign="middle">
      {$forum.message_count}
    </td>    
    <td align="center" valign="middle">
      {if $last_message.them_id}      
      <a href="?act=show_them_messages&forum_id={$forum.id}&them_id={$last_message.them_id}{if $last_message.page}&page={$last_message.page}{if $last_message.id}#{$last_message.id}{/if}">
        {$last_message.them_caption|truncate:50:\'...\':false:false}
      </a>      
      <a href="?act=show_user&id={if $last_message.user_id}{$last_message.user_id}{else}{$last_message.them_user_id}{/if}">
        <b>
          {$last_message.nic}
        </b>
      </a>
      <br/>
      <span style="font-size:10px">
        {if $last_message.datetime}{$last_message.datetime}{else}{$last_message.them_datetime}{/if}
      </span>
      {/if}
    </td>
  </tr>
  {/foreach}
  {/if}  
  {/foreach}
</table>
<br/>',
          'loaded_name' => 'show_forums.tpl',
          'sort_index' => '1455',
          'block_name' => 'ForumShow',
        ),
        1 => 
        array (
          'id' => '50',
          'block_id' => '29',
          'name' => 'show_messages.tpl',
          'description' => 'Вывод сообщений',
          'content' => '<div fastedit::>
  {if !$them.discuse}
    <h1 style="text-align:center">
      {\'Данная тема является закрытой.\'|ftext}
    </h1>
  {/if}
  
  {if $pageRecords.records_count}
  <table style="margin-bottom:5px;width:100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="right">
        {\'Страница:\'|ftext}
        {if $pageRecords.page_selected>1}
        <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page=1">&lt;&lt;</a>
          &nbsp; 
          <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$pageRecords.page_selected-1}">&lt;</a>
            {/if}
            &nbsp;&nbsp;
            {section name="pages" start=1 loop=$pageRecords.page_count+1}
            <a {if $smarty.section.pages.index==$pageRecords.page_selected}class="step_selected"{else}class="step"{/if} href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$smarty.section.pages.index}">
              {$smarty.section.pages.index}
            </a>
            &nbsp;
            {/section}
            {if $pageRecords.page_selected
            <$pageRecords.page_count}
            <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$pageRecords.page_selected+1}">&gt;</a>
            &nbsp; 
            <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$pageRecords.page_count}">&gt;&gt;</a>
            {/if}
            </td>
          </tr>
          </table>
          {/if}
          
          <table style="width:100%;background-color:#dbe5ef" border="0" cellspacing="1" cellpadding="4">
            {if $messages}  
            {foreach name="mes" from=$messages item=message}            
            <tr align="center" valign="middle">
              <td style="width:150px;background-color:white" rowspan="2"  valign="top" fastedit:{$user_table_name}:{$message.user_id}>
                
                <a href="?act=show_user&id={$message.user_id}">
                  {if $message.user_avator}
                  <img alt="" style="border:0" src="/modules/Forum/management/storage/images/users/avator/{$message.user_id}/preview/{$message.user_avator}" />
                  {else}
                  <img alt="" style="border:0" src="/modules/Forum/images/noavator.gif" />
                  {/if}
                </a>
                <br/>
                <a href="?act=show_user&id={$message.user_id}">
                  {$message.user_nic}
                </a>
                <p>
                  <b>
                    {if $message.moderator}{\'Администратор\'|ftext}{else}{\'Посетитель\'|ftext}{/if}
                  </b>
                </p>
                <p style="font-size:10px">
                  {\'Пол:\'|ftext}&nbsp;{$message.user_sex|ftext}
                </p>
                <p style="font-size:10px">
                  {\'Регистрация:\'|ftext}&nbsp;{$message.user_registration}
                </p>
                
              </td>
              <td style="background-color:#e7f3ff">                
                <table id="{$message.id}" fastedit:{if $smarty.foreach.mes.iteration>1}{$messages_table_name}:{$message.id}{else}{$thems_table_name}:{$them.id}{/if} style="width:100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="width:70%" align="left">
                      {$message.datetime}
                    </td>
                    
                    <td style="width:5%">
                    {if $them.discuse && $user}
                      <a href="javascript:setAnswer()">
                        {\'Ответить\'|ftext}
                      </a>
                      {/if}
                      <td>
                        <td align="center" valign="middle">
                         {if $them.discuse && $user}
                          	<img alt="" hspace="5px" src="/modules/Forum/images/line.gif" />
                          {/if}
                          <td>                            
                            <td style="width:5%">
                            {if $them.discuse && $user}
                              <a href="javascript:setQUOTE({$smarty.foreach.mes.iteration})">
                                {\'Цитировать\'|ftext}
                              </a>
                              {/if}
                              <td>
                                <td align="center" valign="middle">
                                {if $them.discuse && $user}
                                  <img alt="" hspace="5px" src="/modules/Forum/images/line.gif" />
                                  {/if}
                                  <td>                                    
                                    
                                    <td style="width:5%">
                                    {if $message.can_edit}
                                      <a href="javascript:setEdit({$smarty.foreach.mes.iteration}, {$message.id}, {if $message.forum_id}true{else}false{/if})">
                                        {\'Редактировать\'|ftext}
                                      </a>
                                      {/if}
                                      <td>
                                        <td align="center" valign="middle">
                                        {if $message.can_edit}
                                          <img alt="" hspace="5px" src="/modules/Forum/images/line.gif" />
                                           {/if}
                                          <td>                                            
                                            <td style="width:5%">
                                             {if $message.can_edit}
                                              <a href="javascript:if (confirm(\'{\'Вы действительно хотите удалить это сообщение\'|ftext}\')) location.href=\'?act=delete_message&forum_id={$forum.id}&them_id={$them.id}{if !$message.forum_id}&id={$message.id}{/if}&page={$pageRecords.page_selected}\';">
                                                {\'Удалить\'|ftext}                                                
                                              </a>
                                                {/if}
                                              <td>
                                                <td align="center" valign="middle">
                                                {if $message.can_edit}
                                                  <img alt="" hspace="5px" src="/modules/Forum/images/line.gif" />
                                                  {/if}
                                                  <td>
                                                                                                                                                            
                                                    <td style="width:8%" align="right">
                                                      <a href="forums_rss?forum_id={$forum.id}&them_id={$them.id}">
                                                        <img alt="" title="{\'Подписаться на RSS\'|ftext}" src="/modules/Forum/images/rss_small.png" border="0" />
                                                      </a>
                                                      <td>
                                                        <td style="width:2%;white-space:nowrap" align="right">&nbsp;
                                                          <a onclick="prompt(\'Скопируйте в буфер обмена адрес ссылки на это сообщение\', \'{"`$smarty.const.SETTINGS_HTTP_HOST`/forums?act=show_them_messages&forum_id=`$forum.id`&them_id=`$them.id`&page=`$pageRecords.page_selected`#`$message.id`"|furl}\')"
                                                           href="#">
                                                            # {$smarty.foreach.mes.iteration}
                                                          </a>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            
            <tr style="background-color:white">
              <td  align="left" valign="top">
                <table fastedit:{if $smarty.foreach.mes.iteration>1}{$messages_table_name}:{$message.id}{else}{$thems_table_name}:{$them.id}{/if} style="background-color:white;width:100%;height:100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="height:100px" valign="top" id="message_description_id_{$smarty.foreach.mes.iteration}">
                      {$message.description}
                    </td>
                  </tr>
                  {if $message.attach}
                  <tr>
                    <td style="height:5px">
                    </td>
                  </tr>
                  <tr>
                    <td style="height:1px;background-color:#dbe5ef">
                    </td>
                  </tr>
                  <tr>
                    <td style="height:5px">
                    </td>
                  </tr>
                  <tr>
                    <td fastedit:{$messages_table_name}:{$message.id}>
                      <table border="0" cellspacing="0" cellpadding="0" style="background-color:white">
                        <tr>
                          <td valign="middle">
                            <a target="_blank" href="modules/Forum/management/storage/files/messages/attach/{$message.id}/{$message.attach}">
                              <img alt="" title="{\'Загрузить вложение\'|ftext}" src="/modules/Forum/images/attach.png" border="0" />
                            </a>
                          </td>
                          <td valign="middle">
                            &nbsp;
                            <a target="_blank" href="modules/Forum/management/storage/files/{if $message.forum_id}thems{else}messages{/if}/attach/{$message.id}/{$message.attach}">
                              <b>
                                {$message.attach}
                              </b>
                              </a>
                            </td>
                          </tr>
                      </table>
                    </td>
                  </tr>
                  {/if}
                  
                  {if $message.user_signature}
                  <tr>
                    <td style="height:5px">
                    </td>
                  </tr>
                  <tr>
                    <td style="height:1px;background-color:#dbe5ef">
                    </td>
                  </tr>
                  <tr>
                    <td style="height:5px">
                    </td>
                  </tr>
                  <tr>
                    <td fastedit:{$user_table_name}:{$message.user_id}>
                      <pre style="color:gray">
						{$message.user_signature}
					  </pre>
                    </td>
                  </tr>
      {/if}
      </table>
    </td>
  </tr>  
  {/foreach}
  {/if}
</table>            
            
            {if $pageRecords.records_count}
            <table style="margin-top:5px;width:100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="right">
                  {\'Страница:\'|ftext}
                  {if $pageRecords.page_selected>1}
                  <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page=1">&lt;&lt;</a>
                    &nbsp; 
                    <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$pageRecords.page_selected-1}">&lt;</a>
                      {/if}
                      &nbsp;&nbsp;
                      {section name="pages" start=1 loop=$pageRecords.page_count+1}
                      <a {if $smarty.section.pages.index==$pageRecords.page_selected}class="step_selected"{else}class="step"{/if} href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$smarty.section.pages.index}">
                        {$smarty.section.pages.index}
                      </a>
                      &nbsp;
                      {/section}
                      {if $pageRecords.page_selected<$pageRecords.page_count}
                      <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$pageRecords.page_selected+1}">&gt;</a>
                      &nbsp; 
                      <a class="step" href="?act=show_them_messages&forum_id={$forum.id}&them_id={$them.id}&page={$pageRecords.page_count}">&gt;&gt;</a>
                      {/if}
                      </td>
                    </tr>
                    </table>
                    {/if}
                  
                  <p>
                    <input type="hidden" id="caption_hidden" value="{$them.caption}" />
                    <input type="hidden" id="important_hidden" value="{$them.important}" />
                  </p>
</div>                  
                  {if $them.discuse}
                  {include file="$editor_template"}
                  <br/>
                  {/if}                                    ',
          'loaded_name' => 'show_messages.tpl',
          'sort_index' => '1457',
          'block_name' => 'ForumShow',
        ),
        2 => 
        array (
          'id' => '51',
          'block_id' => '29',
          'name' => 'show_thems.tpl',
          'description' => 'Вывод обсуждаемых тем',
          'content' => '<div fastedit::>
  {if $user}
  <br/>
  <p style="margin-bottom:10px">
    <a href="javascript:showHideEditor()">
      <b>
        {\'НАЧАТЬ НОВУЮ ТЕМУ\'|ftext}
      </b>
    </a>
  </p>
  {else}
  <p style="margin-bottom:10px">
    {\'Чтобы начать новую тему необходимо авторизироваться.\'|ftext}
  </p>
  {/if}
  
  {if $thems}
  <table style="width:100%;background-color:#dbe5ef" border="0" cellspacing="1" cellpadding="4">    
    <tr style="background-color:#dbe5ef">
      <td colspan="2" style="width:60%" class="forum_head">
        {\'Темы\'|ftext}
      </td>
      <td style="width:10%" align="center" valign="top" class="forum_head">
        {\'Ответы\'|ftext}
      </td>
      <td style="width:10%" align="center" valign="top" class="forum_head">
        {\'Просмотры\'|ftext}
      </td>
      <td style="width:20%" align="center" valign="top" class="forum_head">
        {\'Обновления\'|ftext}
      </td>
    </tr>
    {foreach from=$thems item=them}
    <tr style="background-color:white" align="center" valign="middle">
      <td style="width:5%">
        {if !$them.discuse}
    	<img alt="" title="{\'Закрытая тема\'|ftext}" src="/modules/Forum/images/theme_notice_close.png" />
      {else}
      {if $them.important}
      <img alt="" title="{\'Важная тема\'|ftext}" src="/modules/Forum/images/important.gif" />
      {/if}
      {/if}
    </td>
    <td align="left" valign="top" fastedit:{$thems_table_name}:{$them.id}>
      <a class="forum_theme" href="?act=show_them_messages&forum_id={$them.forum_id}&them_id={$them.id}">
        {$them.caption}
      </a>
      <br/>
      {\'Автор:\'|ftext}&nbsp;
      <a href="?act=show_user&id={$them.user_id}">
        {$them.nic}
      </a>
    </td>
    <td align="center" valign="middle">
      {$them.answers}
    </td>
    <td align="center" valign="middle">
      {$them.view}
    </td>
    {assign var="last_message" value=$them.last_message}
    <td align="center" valign="middle">      
      <a href="?act=show_them_messages&forum_id={$them.forum_id}&them_id={$them.id}{if $last_message.page}&page={$last_message.page}{/if}#{$last_message.id}">
        {$last_message.datetime}
      </a>
      <br/>
      <a href="?act=show_user&id={$them.user_id}">
        <b>
          {$last_message.nic}
        </b>
      </a>
    </td>
  </tr>
  {/foreach}
  </table>
  
  <table style="margin-top:5px;width:100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
      <td align="right">
        {\'Страница:\'|ftext}
        {if $pageRecords.page_selected>1}
        <a class="step" href="?act=show_forum_thems&forum_id={$forum.id}&page=1"><<</a>
          &nbsp; 
          <a class="step" href="?act=show_forum_thems&forum_id={$forum.id}&page={$pageRecords.page_selected-1}"><</a>
            {/if}
            &nbsp;&nbsp;
            {section name="pages" start=1 loop=$pageRecords.page_count+1}
            <a {if $smarty.section.pages.index==$pageRecords.page_selected}class="step_selected"{else}class="step"{/if} href="?act=show_forum_thems&forum_id={$forum.id}&page={$smarty.section.pages.index}">
              {$smarty.section.pages.index}
            </a>
            &nbsp;
            {/section}
            {if $pageRecords.page_selected<$pageRecords.page_count}
            <a class="step" href="?act=show_forum_thems&forum_id={$forum.id}&page={$pageRecords.page_selected+1}">></a>
            &nbsp; 
            <a class="step" href="?act=show_forum_thems&forum_id={$forum.id}&page={$pageRecords.page_count}">>></a>
            {/if}
        </td>
      </tr>
  </table>
	{else}
    	<br/>
        <p style="color:gray">
       		{\'Еще нет тем для обсуждения...\'|ftext}
        </p>
	{/if}
</div>
        
{include file="$editor_template"}',
          'loaded_name' => 'show_thems.tpl',
          'sort_index' => '1456',
          'block_name' => 'ForumShow',
        ),
        3 => 
        array (
          'id' => '52',
          'block_id' => '29',
          'name' => 'show_user.tpl',
          'description' => 'Вывод пользователя',
          'content' => '<table fastedit:{$user_table_name}:{$user.id} style="width:100%;background-color:#dbe5ef" border="0" cellspacing="1" cellpadding="4"> 
  <tr style="background-color:#dbe5ef">    
    <td style="width:20%" align="center" valign="top" class="forum_head">
      {\'Аватор\'|ftext}
    </td>
    <td style="width:80%" align="left" valign="top" class="forum_head">
      {\'Анкетные данные\'|ftext}
    </td>
  </tr>  
  <tr style="background-color:white" align="center">    
    <td align="center" valign="top">      
      {if $user.avator}
      <img alt="" src="/modules/Forum/management/storage/images/users/avator/{$user.id}/preview/{$user.avator}" />
      {else}
      <img alt="" src="/modules/Forum/images/noavator.gif" />
      {/if}
      <p style="font-size:10px;text-align:center">{\'Сообщений:\'|ftext}&nbsp;{$user.message_count}, {\'Тем:\'|ftext}&nbsp;{$user.them_count}</p>                            
    </td>
    
    <td align="left" valign="middle">      
      <table border="0" cellspacing="2" cellpadding="2">        
	  	<tr>
          <td style="width:100px">
            {\'Ник:\'|ftext}
          </td>
          <td>
            <b>
              {$user.nic}
            </b>
          </td>
          </tr>
          <tr>
            <td>
              {\'Имя:\'|ftext}
            </td>
            <td>
              <b>
                {$user.second_name} {$user.name} {$user.otchestvo}
              </b>
            </td>
          </tr>
          <tr>
            <td>
              {\'Пол:\'|ftext}
            </td>
            <td>
              <b>
                {$user.sex}
              </b>
            </td>
          </tr>
          {if $user.company}
          <tr>
            <td>
              {\'Компания:\'|ftext}
            </td>
            <td>
              <b>
                {$user.company}
              </b>
            </td>
          </tr>
          {/if}  	
          {if $user.country_id_caption}
          <tr>
            <td>
              {\'Страна:\'|ftext}
            </td>
            <td>
              <b>
                {$user.country_id_caption}
              </b>
            </td>
          </tr>
          {/if}
          {if $user.city}
          <tr>
            <td>
              {\'Город:\'|ftext}
            </td>
            <td>
              <b>
                {$user.city}
              </b>
            </td>
          </tr>
          {/if}
          {if $user.phone}
          <tr>
            <td>
              {\'Телефон:\'|ftext}
            </td>
            <td>
              <b>
                {$user.phone}
              </b>
            </td>
          </tr>
          {/if}
          {if $user.fax}
          <tr>
            <td>
              {\'Факс:\'|ftext}
            </td>
            <td>
              <b>
                {$user.fax}
              </b>
            </td>
          </tr>
          {/if}
          {if $user.skype}
          <tr>
            <td>
              {\'skype:\'|ftext}
            </td>
            <td>
              <b>
                {$user.skype}
              </b>
            </td>
          </tr>
          {/if}
          {if $user.icq}
          <tr>
            <td>
              {\'icq:\'|ftext}
            </td>
            <td>
              <b>
                {$user.icq}
              </b>
            </td>
          </tr>
          {/if}
          {if $user.url}
          <tr>
            <td>
              {\'Сайт:\'|ftext}
            </td>
            <td>
              <b>
                {$user.url}
              </b>
            </td>
          </tr>          
          {/if}          
          <tr>
            <td>
              {\'Статус:\'|ftext}
            </td>
            <td>
              <b>
                {if $user.moderator}{\'Администратор\'|ftext}{else}{\'Посетитель\'|ftext}{/if}
              </b>
            </td>
          </tr>
          <tr>
            <td>
              {\'Регистрация:\'|ftext}
            </td>
            <td>
              <b>
                {$user.registration}
              </b>
            </td>
          </tr>
      </table>      
    </td>
  </tr>  
</table>
<br/>',
          'loaded_name' => 'show_user.tpl',
          'sort_index' => '1845',
          'block_name' => 'ForumShow',
        ),
        4 => 
        array (
          'id' => '53',
          'block_id' => '29',
          'name' => 'show_editor.tpl',
          'description' => 'Редактор',
          'content' => '<div fastedit::>
  <br/>
  <br/>
  {if $errors}
  {foreach from=$errors item=error}
  <p style="color:red">
    {$error|ftext}
  </p>
  {/foreach}
  <br/>
  {/if}
  
  {if $message_is_updated}
  <h1 style="text-align:center">
	{if $smarty.post.edit_type==\'insert\'}      
        {\'Ваше сообщение добавленно!\'|ftext}
      {else}       
        {\'Изменения сохранены!\'|ftext}      
      {/if}  
  </h1>
  {/if}
  
  {if $user}
  <form {if !$messages && !$errors} style="display:none"{/if} id="editor_form_place" action="?act=update_message&forum_id={$forum.id}{if $them.id}&them_id={$them.id}{/if}&page={$pageRecords.page_count}#editor_form" method="post" enctype="multipart/form-data">    
	<p>
      <input type="hidden" name="translit" id="translit" value="" />
      <input type="hidden" name="title" id="title" value="" />
      <input type="hidden" name="metadescription" id="metadescription" value="" />
      <input type="hidden" name="metakeywords" id="metakeywords" value="" />
      <input type="hidden" name="datetime" id="datetime" value="" />      
      <input type="hidden" name="data_id" id="data_id" value="{$data_id}" />
      <input type="hidden" name="user_id" value="{$user.id}" />      
      <input type="hidden" name="edit_type" id="edit_type" value="{if $edit_type}{$edit_type}{else}insert{/if}" />
      <input type="hidden" name="datetime" value="" />
      <input type="hidden" name="is_them" id="is_them" value="{if $is_them}{$is_them}{else}{if !$messages}true{/if}{/if}" />
      </p>
      <table id="editor_form" style="margin-top:5px;width:100%" border="0" cellpadding="2" cellspacing="2">
		<tr id="caption_display" {if $messages && ($smarty.post.is_them!=\'true\' || !$errors)} style="display:none"{/if}>
          <td style="width:80px">
            <b>
              {\'Тема:\'|ftext}
            </b>
          </td>
          <td>
            <input value="{$caption}" name="caption" id="caption" style="width:500px" />
          </td>
      </tr>
      <tr id="important_display" {if $messages && ($smarty.post.is_them!=\'true\' || !$errors)} style="display:none"{/if}>
        <td align="right" style="white-space:nowrap">
          <b>
            {\'Важная тема:\'|ftext}
          </b>
        </td>
        <td>
          <input {if $important} checked {/if} type="checkbox" value="1" name="important" id="important" />
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <textarea name="description" id="description">
            {$description}
          </textarea>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input name="attach" type="file" />
        </td>
      </tr>
      <tr>
        <td colspan="2" style="height:10px">
          &nbsp;
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input id="submit_forum_button" style="width:150px" class="button" type="submit" value="{if $smarty.post.edit_type==\'update\' && $errors}{\'Сохранить\'|ftext}{else}{\'Добавить\'|ftext}{/if}" />
        </td>
      </tr>
      </table>
  </form>
  {$editor}
  {else}  
    <h2 style="text-align:center">
      {\'Необходима авторизация, чтобы добавлять сообщения.\'|ftext}
    </h2>
  {/if}

  <br/>
</div>

{literal}
<script type="text/javascript">

function setQUOTE(id) {
	var message_html =document.getElementById("message_description_id_"+id).innerHTML;
	message_html=\'<BLOCKQUOTE style="color:gray;background-color:#e9eaea;border:1px solid #d7d8d8"><div style="margin:5px;">\'+message_html+\'</div></BLOCKQUOTE><p> </p>\';
	tinyMCE.get(\'description\').focus();
	tinyMCE.activeEditor.setContent(message_html);
	document.location.href=\'#editor_form\';
}

function setEdit(id, data_id, is_them) {
	var message_html =document.getElementById("message_description_id_"+id).innerHTML;

	if (is_them) {		
		document.getElementById("caption").value=document.getElementById("caption_hidden").value;
		if (document.getElementById("important_hidden").value==1)  document.getElementById("important").checked=true;
		else document.getElementById("important").checked=false;		
		document.getElementById("caption_display").style.display=\'table-row\';
		document.getElementById("important_display").style.display=\'table-row\';
	}
	else {
		document.getElementById("caption").value=\'\';
		document.getElementById("caption_display").style.display=\'none\';
		document.getElementById("important_display").style.display=\'none\';
	}
	
	document.getElementById("is_them").value=is_them;
	document.getElementById("data_id").value=data_id;
	document.getElementById("edit_type").value=\'update\';
	document.getElementById("submit_forum_button").value="{/literal}{\'Сохранить\'|ftext}{literal}";
	tinyMCE.get(\'description\').focus();
	tinyMCE.activeEditor.setContent(message_html);
	document.location.href=\'#editor_form\';
}

function setAnswer() {
	tinyMCE.get(\'description\').focus();
	document.getElementById("is_them").value=false;
	tinyMCE.activeEditor.setContent(\'\');
	document.getElementById("edit_type").value=\'insert\';
	document.getElementById("caption_display").style.display=\'none\';
	document.getElementById("important_display").style.display=\'none\';	
	document.getElementById("submit_forum_button").value="{/literal}{\'Добавить\'|ftext}{literal}";	
	document.location.href=\'#editor_form\';
}

function showHideEditor() {
	document.getElementById("editor_form_place").style.display=\'block\';
	document.location.href=\'#editor_form\';	
}
</script>
{/literal}
',
          'loaded_name' => 'show_editor.tpl',
          'sort_index' => '1846',
          'block_name' => 'ForumShow',
        ),
      ),
    ),
    3 => 
    array (
      'id' => '30',
      'module_id' => '3',
      'type' => '2',
      'name' => 'BreadCrumbs',
      'description' => 'Хлебные крошки',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'BreadCrumbs',
      'sort_index' => '995',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '54',
          'block_id' => '30',
          'name' => 'show_list.tpl',
          'description' => 'Вывод хлебных крошек',
          'content' => '<div fastedit::>
<p style="margin-bottom:5px"><a href="forums">{\'Все форумы\'|ftext}</a>
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
</div>',
          'loaded_name' => 'show_list.tpl',
          'sort_index' => '1453',
          'block_name' => 'BreadCrumbs',
        ),
      ),
    ),
    4 => 
    array (
      'id' => '31',
      'module_id' => '3',
      'type' => '2',
      'name' => 'Metadescription',
      'description' => 'Meta - описание',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Metadescription',
      'sort_index' => '987',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '41',
          'block_id' => '31',
          'name' => 'metadescription',
          'value' => '',
          'description' => 'Metadescription - по умолчанию',
          'edit_s_type_id' => '1',
          'loaded_name' => 'metadescription',
        ),
        1 => 
        array (
          'id' => '42',
          'block_id' => '31',
          'name' => 'SearchSettings',
          'value' => 'array( 
//имя таблицы без префикса
\'messages\'=>array (
//SQL запрос выборки
\'sql\'=>"
SELECT t.id, t.them_id, t2.forum_id, t.description
FROM `{$this->tablePrefix}messages` AS `t` 
LEFT JOIN `{$this->tablePrefix}thems` AS `t2` ON (t2.id=t.them_id)
WHERE 
t.lang_id=\'{$this->lang_id}\' AND t.active=1 AND t2.active=1 AND 
t.description LIKE \'%{$this->search_text}%\'
ORDER BY t.sort_index DESC",  					
//Формат URL			 
\'url\'=>\'?act=show_them_messages&forum_id={$forum_id}&them_id={$them_id}#{$id}\'
),

\'thems\'=>array (
//SQL запрос выборки
\'sql\'=>"
SELECT t.id, t.caption, t.description, t2.id AS `forum_id`
FROM `{$this->tablePrefix}thems` AS `t` 
LEFT JOIN `{$this->tablePrefix}forums` AS `t2` ON (t2.id=t.forum_id)
WHERE t.lang_id=\'{$this->lang_id}\' AND t.active=1 AND 
(t.caption LIKE \'%{$this->search_text}%\' OR t.description LIKE \'%{$this->search_text}%\')
ORDER BY t.sort_index DESC",  					
//Формат URL			 
\'url\'=>\'?act=show_them_messages&forum_id={$forum_id}&them_id={$id}\',
)
);',
          'description' => 'Настройки для модуля Search',
          'edit_s_type_id' => '2',
          'loaded_name' => 'SearchSettings',
        ),
      ),
      'templates' => 
      array (
      ),
    ),
    5 => 
    array (
      'id' => '32',
      'module_id' => '3',
      'type' => '2',
      'name' => 'ActiveUsers',
      'description' => 'Сейчас на форуме',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '36',
      'loaded_name' => 'ActiveUsers',
      'sort_index' => '1302',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '55',
          'block_id' => '32',
          'name' => 'show_list.tpl',
          'description' => 'Список активных пользователей',
          'content' => '<div fastedit::>
{if $active_users}
	{\'Сейчас на форуме:\'}
	{foreach from=$active_users item=a_user}
		<a href="?act=show_user&id={$a_user.id}">{$a_user.nic}</a>&nbsp; &nbsp;
	{/foreach}
{else}
	<p style="text-align:center">{\'Сейчас нет других пользователей на форуме\'}</p>
{/if}
</div>',
          'loaded_name' => 'show_list.tpl',
          'sort_index' => '1968',
          'block_name' => 'ActiveUsers',
        ),
      ),
    ),
    6 => 
    array (
      'id' => '33',
      'module_id' => '3',
      'type' => '2',
      'name' => 'ForumShowRSS',
      'description' => 'Вывод RSS',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '35',
      'loaded_name' => 'ForumShowRSS',
      'sort_index' => '1303',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '56',
          'block_id' => '33',
          'name' => 'show_rss.tpl',
          'description' => 'Вывод RSS',
          'content' => '<?xml version="1.0"?>
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
',
          'loaded_name' => 'show_rss.tpl',
          'sort_index' => '1969',
          'block_name' => 'ForumShowRSS',
        ),
      ),
    ),
    7 => 
    array (
      'id' => '34',
      'module_id' => '3',
      'type' => '2',
      'name' => 'Cabinet',
      'description' => 'Личный кабинет пользователя',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Cabinet',
      'sort_index' => '997',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '43',
          'block_id' => '34',
          'name' => 'send_com_theme',
          'value' => 'Подтверждение Email',
          'description' => 'Тема сообщения, которое высылается при смене Email',
          'edit_s_type_id' => '1',
          'loaded_name' => 'send_com_theme',
        ),
        1 => 
        array (
          'id' => '44',
          'block_id' => '34',
          'name' => 'records_for_page',
          'value' => '10',
          'description' => 'Выводить заказов на страницу в кабинете',
          'edit_s_type_id' => '1',
          'loaded_name' => 'records_for_page',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '57',
          'block_id' => '34',
          'name' => 'profile.tpl',
          'description' => 'Редактирование профиля',
          'content' => '<div fastedit::>
{if $messages}
	{foreach from=$messages item=mes}
		<p style="color:green"><b>{$mes}</b></p>
	{/foreach}
{/if}

{if $errors}
	{foreach from=$errors item=error}
		<p style="color:red">{$error}</p>
	{/foreach}
{/if}

<form action="/cabinet?act=update_profile" method="post" enctype="multipart/form-data">
	<p>
	<input type="hidden" name="translit" value="{$translit}">
  	<input type="hidden" value="{$id}" name="id">
  	</p>
  <table cellpadding="2" cellspacing="2" border="0">
    <tr>
      <td colspan="2" style="height:30px" valign="top" align="right"><span color="#5a7bca">*</span> {\'Поля обязятельные для заполнения\'|ftext}&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="width:150px" valign="top" align="left">{\'Фамилия:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$second_name}" name="second_name" id="second_name" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Имя:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$name}" name="name" id="name" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Отчество:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$otchestvo}" name="otchestvo" id="otchestvo" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'E-Mail:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$email}" name="email" id="email" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Пароль:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$password}" type="password" name="password" id="password" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Повторите пароль:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$retype_password}" type="password" name="retype_password" id="retype_password" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Контактный телефон:\'|ftext}</td>
      <td><input value="{$phone}" name="phone" id="phone" class="form_element" /></td>
    </tr>
    <tr>
      <td class="form_text" valign="top" align="left">{\'Страна:\'|ftext}</td>
      <td>
      	<select name="country_id" id="country_id" class="form_element">
          <option style="color:gray" value="">{\'Не указано\'|ftext}</option>          
			{foreach from=$country item=item}
          		<option {if $item.id==$country_id} selected {/if} value="{$item.id}">{$item.name|ftext}</option>          
			{/foreach}
        </select>
        </td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Город:\'|ftext}</td>
      <td><input value="{$city}" name="city" id="city" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Название компании:\'|ftext}</td>
      <td><input value="{$company}" name="company" id="company" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'ICQ:\'|ftext}</td>
      <td><input value="{$icq}" name="icq" id="icq" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Skype:\'|ftext}</td>
      <td><input value="{$skype}" name="skype" id="skype" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Факс:\'|ftext}</td>
      <td><input value="{$fax}" name="fax" id="fax" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Пол:\'|ftext}</td>
      <td><select name="sex" id="sex" class="form_element">
          <option style="color:gray" value="">{\'Не указано\'|ftext}</option>
          <option {if $sex==\'Мужской\'} selected {/if} value="Мужской">{\'Мужской\'|ftext}</option>
          <option {if $sex==\'Женский\'} selected {/if} value="Женский">{\'Женский\'|ftext}</option>
          <option {if $sex==\'Робот\'} selected {/if} value="Робот">{\'Робот\'|ftext}</option>
        </select></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Почтовый индекс:\'|ftext}</td>
      <td><input value="{$mail_index}" name="mail_index" id="mail_index" class="form_element" /></td>
    </tr>
    <tr>
      <td valign="top" align="left">{\'Адрес доставки заказа:\'|ftext}</td>
      <td><input value="{$address_of_delivery}" name="address_of_delivery" id="address_of_delivery" class="form_element" /></td>
    </tr>      
        
    <tr>
      <td valign="top" align="left"></td>
      <td>
      	<table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td valign="top"><input {if $get_emails} checked {/if} type="checkbox" value="1" name="get_emails" id="get_emails" /></td>
            <td>&nbsp;</td>
            <td>{\'Получать рассылку\'|ftext}</td>
          <tr>
        </table>
        </td>
    </tr>
    
    <tr>
      <td valign="top" align="left">{\'Ник на форуме:\'|ftext} <span color="#5a7bca">*</span></td>
      <td><input value="{$nic}" name="nic" id="nic" class="form_element" /></td>
    </tr> 
        
    <tr>
      <td style="width:150px" valign="top" align="left">{\'Аватор:\'|ftext}</td>
      <td> {if $avator}
        <table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td><img alt="" class="ramka" src="/modules/Forum/management/storage/images/users/avator/{$id}/preview/{$avator}" /><br/></td>
            <td>
               <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td>&nbsp;<input name="avator_delete" value="{$avator}" type="checkbox" /></td>
                  <td>&nbsp;{\'Удалить\'|ftext}</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        {/if}
        <input type="file" value="" name="avator" id="avator" class="form_element" /></td>
    </tr>
    
    <tr>
      <td valign="top" align="left">{\'Временная зона:\'|ftext}</td>
      <td>
      <select name="timezone_id" class="form_element">
      <option style="color:gray" value="">{\'Не указано\'|ftext}</option>
      {foreach from=$timezones item=item}
      <option {if $smarty.post.timezone_id==$item.id || $timezone_id==$item.id} selected {/if} value="{$item.id}">{$item.caption}</option>
      {/foreach}
      </select>
      </td>
    </tr>     
    <tr>
      <td colspan="2" style="height:15px"></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" class="button" value="{\'Сохранить\'|ftext}" /></td>
    </tr>
  </table>
</form>
</div>',
          'loaded_name' => 'profile.tpl',
          'sort_index' => '1442',
          'block_name' => 'Cabinet',
        ),
        1 => 
        array (
          'id' => '58',
          'block_id' => '34',
          'name' => 'reg_message.tpl',
          'description' => 'Сообщение на подтверждение изменения email адреса',
          'content' => 'Здравствуйте, уважаемый пользователь! Вы изменили свой контактный Email на сайте {$smarty.const.SETTINGS_HTTP_HOST}.
<br/>
Для подтверждения изменения перейдтите, пожалуйста, по ссылке <a href="{$smarty.const.SETTINGS_HTTP_HOST}/registratsiya?act=confirm_r&id={$id}&email={$email}">подтвердить Email</a>.
В противном случае, вы не сможете авторизироваться нк сайте {$smarty.const.SETTINGS_HTTP_HOST}. 
<br/>
<br/>
С уважением, администрация.',
          'loaded_name' => 'reg_message.tpl',
          'sort_index' => '1444',
          'block_name' => 'Cabinet',
        ),
      ),
    ),
    8 => 
    array (
      'id' => '35',
      'module_id' => '3',
      'type' => '2',
      'name' => 'CabinetMenu',
      'description' => 'Меню в личном кабинете',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'CabinetMenu',
      'sort_index' => '998',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '59',
          'block_id' => '35',
          'name' => 'show_menu.tpl',
          'description' => 'Отобразить меню',
          'content' => '<table fastedit:: cellpadding="2" cellspacing="2" border="0">
  <tr>
    <td>
      <a {if !$smarty.get.act || $smarty.get.act==\'profile\' || $smarty.get.act==\'update_profile\'} style="font-size:16px;font-weight:bold"{else} style="font-size:16px"{/if} href="?act=profile">
        {\'Мои данные\'|ftext}
      </a>
    </td>    
    <td style="width:10px">
    </td>
    <td>
      <a style="font-size:16px;" href="?act=logout">
        {\'Выйти\'|ftext}
      </a>
    </td>
  </tr>
</table>

<table style="width:100%" cellpadding="0" cellspacing="0" border="0">
  <tr style="height:14px">
    <td align=\'left\' valign=\'center\' class="cont_line">
      <img alt="" src=\'/img/zero.gif\' width="9px" height="14px" border="0" />
    </td>
  </tr>
</table>',
          'loaded_name' => 'show_menu.tpl',
          'sort_index' => '1445',
          'block_name' => 'CabinetMenu',
        ),
      ),
    ),
    9 => 
    array (
      'id' => '36',
      'module_id' => '3',
      'type' => '2',
      'name' => 'RemindPassword',
      'description' => 'Восстановление пароля',
      'act_variable' => 'act',
      'act_method' => 'post',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'RemindPassword',
      'sort_index' => '996',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '45',
          'block_id' => '36',
          'name' => 'send_com_theme_forget',
          'value' => 'Восстановление пароля на сайте ',
          'description' => 'Тема сообщения, которое высылается для восстановления пароля',
          'edit_s_type_id' => '1',
          'loaded_name' => 'send_com_theme_forget',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '60',
          'block_id' => '36',
          'name' => 'remind_result.tpl',
          'description' => 'Результат проверки восстановления пароля',
          'content' => '<div fastedit::>
{if $send}
	Ваш пароль успешно выслан на ваш контактный Email.
{else}
	Сообщение не отправленно. Возможно вы неправильно указали свой Email.
{/if}
</div>',
          'loaded_name' => 'remind_result.tpl',
          'sort_index' => '1441',
          'block_name' => 'RemindPassword',
        ),
        1 => 
        array (
          'id' => '61',
          'block_id' => '36',
          'name' => 'remind_message.tpl',
          'description' => 'Сообщение о востановлении пароля',
          'content' => 'Ваш пароль 
<b>
  {$password}
</b>
для авторизации на сайте {$smarty.const.SETTINGS_HTTP_HOST}
<br/>
С уважением, администрация.',
          'loaded_name' => 'remind_message.tpl',
          'sort_index' => '1440',
          'block_name' => 'RemindPassword',
        ),
        2 => 
        array (
          'id' => '62',
          'block_id' => '36',
          'name' => 'remind_form.tpl',
          'description' => 'Форма восстановления пароля',
          'content' => '<form method="post" style="margin:0px" fastedit::>
  	<p>
    	<input name="act" value="remind_send" type="hidden" />
    </p>
    <table border=\'0\' cellpadding=\'0\' cellspacing=\'0\' style="width:470px">
      <tr style="height:40px" align="left" valign="center">
        <td style="width:50px" align="left">
        {\'Email:\'|ftext}
        </td>
        <td style="width:350px" colspan=\'2\' align="left">
          <input style=\'width: 350px;\' name="email" value="" />
        </td>
      </tr>
      <tr style="height:30px">
        <td>
        </td>
        <td colspan=\'2\' align="left" valign="bottom">
          <input class="button"  type="submit" value="{\'Выслать пароль\'|ftext}" />
        </td>
      </tr>
    </table>
</form>',
          'loaded_name' => 'remind_form.tpl',
          'sort_index' => '1439',
          'block_name' => 'RemindPassword',
        ),
      ),
    ),
    10 => 
    array (
      'id' => '37',
      'module_id' => '3',
      'type' => '2',
      'name' => 'Title',
      'description' => 'Title - заголовок',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Title',
      'sort_index' => '988',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '46',
          'block_id' => '37',
          'name' => 'title',
          'value' => '',
          'description' => 'Title - заголовок по умолчанию ',
          'edit_s_type_id' => '1',
          'loaded_name' => 'title',
        ),
      ),
      'templates' => 
      array (
      ),
    ),
    11 => 
    array (
      'id' => '38',
      'module_id' => '3',
      'type' => '2',
      'name' => 'Metakeywords',
      'description' => 'Meta - ключевые слова',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Metakeywords',
      'sort_index' => '989',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '47',
          'block_id' => '38',
          'name' => 'metakeywords',
          'value' => '',
          'description' => 'Metakeywords - по умолчанию ',
          'edit_s_type_id' => '1',
          'loaded_name' => 'metakeywords',
        ),
      ),
      'templates' => 
      array (
      ),
    ),
  ),
  'MODULE' => 
  array (
    'id' => '3',
    'name' => 'Forum',
    'version' => '1',
    'description' => 'Форумы',
    'loaded' => '1',
    'need_save' => '0',
    'loaded_name' => 'Forum',
    'sort_index' => '3',
  ),
  'TABLES' => 
  array (
    0 => 
    array (
      'id' => '28',
      'module_id' => '3',
      'name' => 'country',
      'description' => 'Страна',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'country',
      'sort_index' => '1239',
      'table_name' => 'country',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '202',
          'field_id' => '202',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'name',
          'comment' => 'Страна',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '50',
          'table_name' => 'country',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '203',
          'field_id' => '203',
          'active' => '0',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => NULL,
          'fieldname' => 'id',
          'comment' => 'id',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '1',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '1',
          'sort_index' => '100',
          'table_name' => 'country',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    1 => 
    array (
      'id' => '29',
      'module_id' => '3',
      'name' => 'timezones',
      'description' => 'Временные зоны',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'timezones',
      'sort_index' => '1237',
      'table_name' => 'timezones',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '204',
          'field_id' => '204',
          'active' => '0',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => NULL,
          'fieldname' => 'id',
          'comment' => 'id',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '1',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '1',
          'sort_index' => '100',
          'table_name' => 'timezones',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '205',
          'field_id' => '205',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'caption',
          'comment' => 'Временная зона',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '50',
          'table_name' => 'timezones',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '206',
          'field_id' => '206',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'timezone',
          'comment' => 'Значение',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '9',
          'len' => '',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '40',
          'table_name' => 'timezones',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    2 => 
    array (
      'id' => '30',
      'module_id' => '3',
      'name' => 'thems',
      'description' => 'Обсуждаемые темы',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'thems',
      'sort_index' => '1234',
      'table_name' => 'thems',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '207',
          'field_id' => '207',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '15',
          'fieldname' => 'metadescription',
          'comment' => 'Meta - описание',
          'sourse_field_id' => '212',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '350',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '45',
          'table_name' => 'thems',
          'sourse_table_name' => 'thems',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '208',
          'field_id' => '208',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '15',
          'fieldname' => 'title',
          'comment' => 'Title - Заголовок',
          'sourse_field_id' => '212',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '350',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '50',
          'table_name' => 'thems',
          'sourse_table_name' => 'thems',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '209',
          'field_id' => '209',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '15',
          'fieldname' => 'metakeywords',
          'comment' => 'Meta - ключевые слова',
          'sourse_field_id' => '212',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '350',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '40',
          'table_name' => 'thems',
          'sourse_table_name' => 'thems',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '210',
          'field_id' => '210',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '7',
          'fieldname' => 'description',
          'comment' => 'Описание',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '3',
          'len' => '',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '65',
          'table_name' => 'thems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '211',
          'field_id' => '211',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '14',
          'fieldname' => 'translit',
          'comment' => 'URL - адрес',
          'sourse_field_id' => '212',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '255',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '1',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '70',
          'table_name' => 'thems',
          'sourse_table_name' => 'thems',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '212',
          'field_id' => '212',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'caption',
          'comment' => 'Название темы',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '350',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '75',
          'table_name' => 'thems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '213',
          'field_id' => '213',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '5',
          'fieldname' => 'active',
          'comment' => 'Показывать тему',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '1',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '60',
          'table_name' => 'thems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        7 => 
        array (
          'id' => '214',
          'field_id' => '214',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'user_id',
          'comment' => 'Добавил пользователь',
          'sourse_field_id' => '260',
          'delete' => '0',
          'own_filter' => '1',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '80',
          'table_name' => 'thems',
          'sourse_table_name' => 'users',
          'sourse_field_name' => 'nic',
          'hide_by_field_caption' => '',
        ),
        8 => 
        array (
          'id' => '215',
          'field_id' => '215',
          'active' => '0',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => NULL,
          'fieldname' => 'id',
          'comment' => 'id',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '1',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '1',
          'sort_index' => '100',
          'table_name' => 'thems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        9 => 
        array (
          'id' => '216',
          'field_id' => '216',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'forum_id',
          'comment' => 'Форум',
          'sourse_field_id' => '232',
          'delete' => '1',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '90',
          'table_name' => 'thems',
          'sourse_table_name' => 'forums',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        10 => 
        array (
          'id' => '217',
          'field_id' => '217',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '5',
          'fieldname' => 'discuse',
          'comment' => 'Тема обсуждается',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '1',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '55',
          'table_name' => 'thems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        11 => 
        array (
          'id' => '218',
          'field_id' => '218',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'view',
          'comment' => 'Просмотры',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '10',
          'len' => '',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '25',
          'table_name' => 'thems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        12 => 
        array (
          'id' => '219',
          'field_id' => '219',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '5',
          'fieldname' => 'important',
          'comment' => 'Важная тема',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '35',
          'table_name' => 'thems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        13 => 
        array (
          'id' => '220',
          'field_id' => '220',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'datetime',
          'comment' => 'Дата добавления',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '12',
          'len' => '',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '95',
          'table_name' => 'thems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        14 => 
        array (
          'id' => '221',
          'field_id' => '221',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '11',
          'fieldname' => 'attach',
          'comment' => 'Вложение',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '30',
          'table_name' => 'thems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    3 => 
    array (
      'id' => '31',
      'module_id' => '3',
      'name' => 'fgroups',
      'description' => 'Группы форумов',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'fgroups',
      'sort_index' => '1229',
      'table_name' => 'fgroups',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '222',
          'field_id' => '222',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'caption',
          'comment' => 'Название группы',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '250',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '90',
          'table_name' => 'fgroups',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '223',
          'field_id' => '223',
          'active' => '0',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => NULL,
          'fieldname' => 'id',
          'comment' => 'id',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '1',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '1',
          'sort_index' => '100',
          'table_name' => 'fgroups',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '224',
          'field_id' => '224',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '14',
          'fieldname' => 'translit',
          'comment' => 'Транслит',
          'sourse_field_id' => '222',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '255',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '1',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '80',
          'table_name' => 'fgroups',
          'sourse_table_name' => 'fgroups',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    4 => 
    array (
      'id' => '32',
      'module_id' => '3',
      'name' => 'regions',
      'description' => 'Регионы',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'regions',
      'sort_index' => '1354',
      'table_name' => 'regions',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '225',
          'field_id' => '225',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'name',
          'comment' => 'Регион',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '80',
          'table_name' => 'regions',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '226',
          'field_id' => '226',
          'active' => '0',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => NULL,
          'fieldname' => 'id',
          'comment' => 'id',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '1',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '1',
          'sort_index' => '100',
          'table_name' => 'regions',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '227',
          'field_id' => '227',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'country_id',
          'comment' => 'Страна',
          'sourse_field_id' => '202',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '90',
          'table_name' => 'regions',
          'sourse_table_name' => 'country',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    5 => 
    array (
      'id' => '33',
      'module_id' => '3',
      'name' => 'city',
      'description' => 'Город',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'city',
      'sort_index' => '1238',
      'table_name' => 'city',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '228',
          'field_id' => '228',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'name',
          'comment' => 'Город',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '70',
          'table_name' => 'city',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '229',
          'field_id' => '229',
          'active' => '0',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => NULL,
          'fieldname' => 'id',
          'comment' => 'id',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '1',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '1',
          'sort_index' => '100',
          'table_name' => 'city',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '230',
          'field_id' => '230',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'region_id',
          'comment' => 'Регион',
          'sourse_field_id' => '225',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '1',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '80',
          'table_name' => 'city',
          'sourse_table_name' => 'regions',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '231',
          'field_id' => '231',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'country_id',
          'comment' => 'Страна',
          'sourse_field_id' => '202',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '1',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '90',
          'table_name' => 'city',
          'sourse_table_name' => 'country',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    6 => 
    array (
      'id' => '34',
      'module_id' => '3',
      'name' => 'forums',
      'description' => 'Форумы',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'forums',
      'sort_index' => '1226',
      'table_name' => 'forums',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '232',
          'field_id' => '232',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'caption',
          'comment' => 'Название форума',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '350',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '15',
          'table_name' => 'forums',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '233',
          'field_id' => '233',
          'active' => '0',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => NULL,
          'fieldname' => 'id',
          'comment' => 'id',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '1',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '1',
          'sort_index' => '30',
          'table_name' => 'forums',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '234',
          'field_id' => '234',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '5',
          'fieldname' => 'active',
          'comment' => 'Форум активен',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '1',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '7',
          'table_name' => 'forums',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '235',
          'field_id' => '235',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '15',
          'fieldname' => 'metadescription',
          'comment' => 'Meta - описание',
          'sourse_field_id' => '232',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '350',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '3',
          'table_name' => 'forums',
          'sourse_table_name' => 'forums',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '236',
          'field_id' => '236',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '7',
          'fieldname' => 'description',
          'comment' => 'Описание',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '3',
          'len' => '',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '12',
          'table_name' => 'forums',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '237',
          'field_id' => '237',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '100',
          'avator_width_big' => '29',
          'avator_height_big' => '26',
          'regex' => NULL,
          'edittype_id' => '9',
          'fieldname' => 'image',
          'comment' => 'Картинка',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '8',
          'table_name' => 'forums',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '238',
          'field_id' => '238',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '15',
          'fieldname' => 'title',
          'comment' => 'Title - Заголовок',
          'sourse_field_id' => '232',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '350',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '5',
          'table_name' => 'forums',
          'sourse_table_name' => 'forums',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        7 => 
        array (
          'id' => '239',
          'field_id' => '239',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '14',
          'fieldname' => 'translit',
          'comment' => 'URL - адрес',
          'sourse_field_id' => '232',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '255',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '1',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '14',
          'table_name' => 'forums',
          'sourse_table_name' => 'forums',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        8 => 
        array (
          'id' => '240',
          'field_id' => '240',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '15',
          'fieldname' => 'metakeywords',
          'comment' => 'Meta - ключевые слова',
          'sourse_field_id' => '232',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '350',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '2',
          'table_name' => 'forums',
          'sourse_table_name' => 'forums',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        9 => 
        array (
          'id' => '241',
          'field_id' => '241',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'fgroup_id',
          'comment' => 'Группа',
          'sourse_field_id' => '222',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '20',
          'table_name' => 'forums',
          'sourse_table_name' => 'fgroups',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    7 => 
    array (
      'id' => '35',
      'module_id' => '3',
      'name' => 'messages',
      'description' => 'Сообщения пользователей',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'messages',
      'sort_index' => '1235',
      'table_name' => 'messages',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '242',
          'field_id' => '242',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '7',
          'fieldname' => 'description',
          'comment' => 'Сообщение',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '3',
          'len' => '',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '12',
          'table_name' => 'messages',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '243',
          'field_id' => '243',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '5',
          'fieldname' => 'active',
          'comment' => 'Показывать сообщение',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '1',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '7',
          'table_name' => 'messages',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '244',
          'field_id' => '244',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'user_id',
          'comment' => 'Добавил пользователь',
          'sourse_field_id' => '260',
          'delete' => '1',
          'own_filter' => '1',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '18',
          'table_name' => 'messages',
          'sourse_table_name' => 'users',
          'sourse_field_name' => 'nic',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '245',
          'field_id' => '245',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'them_id',
          'comment' => 'Тема',
          'sourse_field_id' => '212',
          'delete' => '1',
          'own_filter' => '1',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '20',
          'table_name' => 'messages',
          'sourse_table_name' => 'thems',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '246',
          'field_id' => '246',
          'active' => '0',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => NULL,
          'fieldname' => 'id',
          'comment' => 'id',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '1',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '1',
          'sort_index' => '30',
          'table_name' => 'messages',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '247',
          'field_id' => '247',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'datetime',
          'comment' => 'Дата добавления',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '12',
          'len' => '',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '25',
          'table_name' => 'messages',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '248',
          'field_id' => '248',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '11',
          'fieldname' => 'attach',
          'comment' => 'Вложение',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '3',
          'table_name' => 'messages',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    8 => 
    array (
      'id' => '36',
      'module_id' => '3',
      'name' => 'users',
      'description' => 'Пользователи',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'users',
      'sort_index' => '1236',
      'table_name' => 'users',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '249',
          'field_id' => '249',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'phone',
          'comment' => 'Контактный телефон',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '3',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '100',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '250',
          'field_id' => '250',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'registration',
          'comment' => 'Дата регистрации',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '12',
          'len' => '',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '200',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '251',
          'field_id' => '251',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'name',
          'comment' => 'Имя',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '1',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '160',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '252',
          'field_id' => '252',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'otchestvo',
          'comment' => 'Отчество',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '1',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '150',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '253',
          'field_id' => '253',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'icq',
          'comment' => 'ICQ',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '50',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '3',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '85',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '254',
          'field_id' => '254',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'skype',
          'comment' => 'Skype',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '50',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '4',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '90',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '255',
          'field_id' => '255',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'password',
          'comment' => 'Пароль',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '2',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '130',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        7 => 
        array (
          'id' => '256',
          'field_id' => '256',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => '4',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => '/^[\\.\\-_A-Za-z0-9]+?@[\\.\\-A-Za-z0-9]+?\\.[a-z0-9]{2,6}$/u',
          'edittype_id' => '1',
          'fieldname' => 'email',
          'comment' => 'E-Mail',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '2',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '140',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        8 => 
        array (
          'id' => '257',
          'field_id' => '257',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'city',
          'comment' => 'Город',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '3',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '110',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        9 => 
        array (
          'id' => '258',
          'field_id' => '258',
          'active' => '0',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => NULL,
          'fieldname' => 'id',
          'comment' => 'id',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '1',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '1',
          'sort_index' => '210',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        10 => 
        array (
          'id' => '259',
          'field_id' => '259',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'second_name',
          'comment' => 'Фамилия',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '1',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '170',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        11 => 
        array (
          'id' => '260',
          'field_id' => '260',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => '9',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => '/^[a-zA-Z0-9]{3,25}$/u',
          'edittype_id' => '1',
          'fieldname' => 'nic',
          'comment' => 'Отображаемый ник',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '1',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '190',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        12 => 
        array (
          'id' => '261',
          'field_id' => '261',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'fax',
          'comment' => 'Факс',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '4',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '95',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        13 => 
        array (
          'id' => '262',
          'field_id' => '262',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'country_id',
          'comment' => 'Страна',
          'sourse_field_id' => '202',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '3',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '120',
          'table_name' => 'users',
          'sourse_table_name' => 'country',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        14 => 
        array (
          'id' => '263',
          'field_id' => '263',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '5',
          'fieldname' => 'get_emails',
          'comment' => 'Получать рассылку',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '65',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        15 => 
        array (
          'id' => '264',
          'field_id' => '264',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '5',
          'fieldname' => 'enable',
          'comment' => 'Пользователь активен',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '75',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        16 => 
        array (
          'id' => '265',
          'field_id' => '265',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '5',
          'fieldname' => 'confirm',
          'comment' => 'Регистрация подтверждена',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '70',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        17 => 
        array (
          'id' => '266',
          'field_id' => '266',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '150',
          'avator_height' => '150',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '5',
          'fieldname' => 'moderator',
          'comment' => 'Модератор',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '45',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        18 => 
        array (
          'id' => '267',
          'field_id' => '267',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '100',
          'avator_width' => '100',
          'avator_height' => '100',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '9',
          'fieldname' => 'avator',
          'comment' => 'Аватар',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '60',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        19 => 
        array (
          'id' => '268',
          'field_id' => '268',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '14',
          'fieldname' => 'translit',
          'comment' => 'Транслит',
          'sourse_field_id' => '260',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '255',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '1',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '180',
          'table_name' => 'users',
          'sourse_table_name' => 'users',
          'sourse_field_name' => 'nic',
          'hide_by_field_caption' => '',
        ),
        20 => 
        array (
          'id' => '269',
          'field_id' => '269',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'timezone_id',
          'comment' => 'Часовой пояс',
          'sourse_field_id' => '205',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '3',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '78',
          'table_name' => 'users',
          'sourse_table_name' => 'timezones',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        21 => 
        array (
          'id' => '270',
          'field_id' => '270',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'sex',
          'comment' => 'Пол',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '24',
          'len' => '\'Мужской\',\'Женский\',\'Робот\'',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '3',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '80',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        22 => 
        array (
          'id' => '271',
          'field_id' => '271',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '2',
          'fieldname' => 'signature',
          'comment' => 'Подпись',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '250',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '40',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        23 => 
        array (
          'id' => '272',
          'field_id' => '272',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'company',
          'comment' => 'Компания',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '200',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '2',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '145',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        24 => 
        array (
          'id' => '273',
          'field_id' => '273',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => '11',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => '/^(http?:\\/\\/)?([\\w\\.]+)\\.([a-z]{2,6}\\.?)(\\/[\\w\\.\\?\\=\\&]*)*\\/?$/iu',
          'edittype_id' => '1',
          'fieldname' => 'url',
          'comment' => 'Сайт',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '250',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '4',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '92',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        25 => 
        array (
          'id' => '274',
          'field_id' => '274',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '1',
          'fieldname' => 'last_activity',
          'comment' => 'Последняя активность',
          'sourse_field_id' => NULL,
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '12',
          'len' => '',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '35',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
  ),
);
?>