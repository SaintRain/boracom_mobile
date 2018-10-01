<?php
$DATA=array (
  'BDSTRUCTURE' => 
  array (
    'users' => 
    array (
      0 => 'CREATE TABLE `users` (
`id` INT(11)  NOT NULL auto_increment ,
`registration` DATETIME      ,
`ur_status_id` INT(11)     default NULL ,
`timezone_id` INT(11)     default NULL ,
`second_name` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`name` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`otchestvo` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`email` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`password` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`sex` ENUM(\'Мужской\',\'Женский\',\'Робот\') character set utf8 collate utf8_general_ci    default NULL ,
`country_id` INT(11)     default NULL ,
`city` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`phone` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`company` VARCHAR(200) character set utf8 collate utf8_general_ci    default NULL ,
`icq` VARCHAR(50) character set utf8 collate utf8_general_ci    default NULL ,
`skype` VARCHAR(50) character set utf8 collate utf8_general_ci    default NULL ,
`url` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`fax` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`mail_index` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`enable` BOOL     default \'0\' ,
`confirm` BOOL     default \'0\' ,
`get_emails` BOOL     default \'0\' ,
`address_of_delivery` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`signature` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`avator` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`nic` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`translit` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`last_activity` DATETIME      ,
`moderator` BOOL     default \'0\' ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'orders' => 
    array (
      0 => 'CREATE TABLE `orders` (
`id` INT(11)  NOT NULL auto_increment ,
`created` DATETIME      ,
`client_id` INT(11)     default NULL ,
`delivery_id` INT(11)     default NULL ,
`second_name` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`name` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`otchestvo` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`phone` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`email` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`mail_index` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`delivery_cost` DOUBLE     default NULL ,
`order_cost_gross` DOUBLE     default NULL ,
`total_price` DOUBLE     default NULL ,
`currency_id` INT(11)     default NULL ,
`pay_system_id` INT(11)     default NULL ,
`send_number` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`status_id` INT(11)     default NULL ,
`payed` BOOL     default \'0\' ,
`reason_of_rejection` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`address_of_delivery` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`secret_pay_code` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`note` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`pay_details` TEXT character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'discount_user' => 
    array (
      0 => 'CREATE TABLE `discount_user` (
`id` INT(11)  NOT NULL auto_increment ,
`pieces_before` DOUBLE     default NULL ,
`currency_id` INT(11)     default NULL ,
`discount_perc` DOUBLE     default NULL ,
`discount_active` BOOL     default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'categories' => 
    array (
      0 => 'CREATE TABLE `categories` (
`id` INT(11)  NOT NULL auto_increment ,
`parent_id` INT(11)     default NULL ,
`caption` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`translit` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`description` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`image` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`active` BOOL     default \'1\' ,
`title` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`metadescription` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`metakeywords` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`id_1c` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'products' => 
    array (
      0 => 'CREATE TABLE `products` (
`id` BIGINT(20)  NOT NULL auto_increment ,
`caption` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`translit` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`date_add` DATETIME      ,
`category_id` INT(11)     default NULL ,
`brand_id` INT(11)     default NULL ,
`type_kind_id` INT(11)     default NULL ,
`article` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`kind_id` INT(11)     default NULL ,
`distribution_channel_id` INT(11)     default NULL ,
`price` DOUBLE     default NULL ,
`old_price` DOUBLE     default NULL ,
`currency_id` INT(11)     default NULL ,
`stock` INT(11)     default \'0\' ,
`unit_id` INT(11)     default NULL ,
`weight` DOUBLE     default NULL ,
`discount_type` INT(11)     default NULL ,
`nds` FLOAT     default NULL ,
`nds_in_price` BOOL     default NULL ,
`small_description` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`description` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`image` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`images` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`active` BOOL     default \'1\' ,
`nova` BOOL     default NULL ,
`recomenduem` BOOL     default NULL ,
`market` BOOL     default \'0\' ,
`same_products` BIGINT(20)     default NULL ,
`title` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`metadescription` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`metakeywords` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`id_1c` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'products_comments' => 
    array (
      0 => 'CREATE TABLE `products_comments` (
`datetime` DATETIME      ,
`id` INT(11)  NOT NULL auto_increment ,
`product_id` INT(11)     default NULL ,
`comment` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`user_name` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`user_email` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`points` INT(11)     default \'0\' ,
`enable` BOOL     default \'0\' ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'orders_status' => 
    array (
      0 => 'CREATE TABLE `orders_status` (
`id` INT(11)  NOT NULL auto_increment ,
`name` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
`code` VARCHAR(10) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'currencies' => 
    array (
      0 => 'CREATE TABLE `currencies` (
`id` INT(11)  NOT NULL auto_increment ,
`name` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`sign` VARCHAR(10) character set utf8 collate utf8_general_ci    default NULL ,
`sign_fraction` VARCHAR(20) character set utf8 collate utf8_general_ci    default NULL ,
`code` VARCHAR(15) character set utf8 collate utf8_general_ci    default NULL ,
`general` BOOL     default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'discount' => 
    array (
      0 => 'CREATE TABLE `discount` (
`id` INT(11)  NOT NULL auto_increment ,
`name` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`discount` FLOAT     default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'brands' => 
    array (
      0 => 'CREATE TABLE `brands` (
`id` INT(11)  NOT NULL auto_increment ,
`name` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`translit` VARCHAR(255) character set utf8 collate utf8_general_ci    default NULL ,
`description` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`title` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`metakeywords` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
`metadescription` VARCHAR(350) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'delivery' => 
    array (
      0 => 'CREATE TABLE `delivery` (
`id` INT(11)  NOT NULL auto_increment ,
`name` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`enable` BOOL     default \'1\' ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'courses' => 
    array (
      0 => 'CREATE TABLE `courses` (
`id` INT(11)  NOT NULL auto_increment ,
`sell_currency_id` INT(11)     default NULL ,
`by_currency_id` INT(11)     default NULL ,
`quotation` FLOAT     default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'pay_systems' => 
    array (
      0 => 'CREATE TABLE `pay_systems` (
`id` INT(11)  NOT NULL auto_increment ,
`name` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`caption` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`shop_id` VARCHAR(200) character set utf8 collate utf8_general_ci    default NULL ,
`login` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`password` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`pereschet` FLOAT     default NULL ,
`secret_key` VARCHAR(200) character set utf8 collate utf8_general_ci    default NULL ,
`func_name` VARCHAR(200) character set utf8 collate utf8_general_ci    default NULL ,
`enable` BOOL     default \'1\' ,
`purse` VARCHAR(450) character set utf8 collate utf8_general_ci    default NULL ,
`scid` VARCHAR(250) character set utf8 collate utf8_general_ci    default NULL ,
`currency_id` INT(11)     default NULL ,
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
    'discount_user_by_q' => 
    array (
      0 => 'CREATE TABLE `discount_user_by_q` (
`id` INT(11)  NOT NULL auto_increment ,
`pieces_before` DOUBLE     default NULL ,
`currency_id` INT(11)     default NULL ,
`discount_perc` DOUBLE     default NULL ,
`discount_active` BOOL     default NULL ,
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
`caption` VARCHAR(300) character set utf8 collate utf8_general_ci    default NULL ,
`timezone` FLOAT     default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'help' => 
    array (
      0 => 'CREATE TABLE `help` (
`id` INT(11)  NOT NULL auto_increment ,
`datetime` DATETIME      ,
`user_id` INT(11)     default NULL ,
`question` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`question_attach` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`answer` TEXT character set utf8 collate utf8_general_ci    default NULL ,
`answer_attach` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
`show_answer` BOOL     default \'1\' ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'units' => 
    array (
      0 => 'CREATE TABLE `units` (
`id` INT(11)  NOT NULL auto_increment ,
`caption` VARCHAR(50) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'products_types' => 
    array (
      0 => 'CREATE TABLE `products_types` (
`id` INT(11)  NOT NULL auto_increment ,
`caption` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'distribution_channel' => 
    array (
      0 => 'CREATE TABLE `distribution_channel` (
`id` INT(11)  NOT NULL auto_increment ,
`caption` VARCHAR(150) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'products_types_kinds' => 
    array (
      0 => 'CREATE TABLE `products_types_kinds` (
`id` INT(11)  NOT NULL auto_increment ,
`type_id` INT(11)     default NULL ,
`caption` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'products_kinds' => 
    array (
      0 => 'CREATE TABLE `products_kinds` (
`id` INT(11)  NOT NULL auto_increment ,
`caption` VARCHAR(100) character set utf8 collate utf8_general_ci    default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'orders_composition' => 
    array (
      0 => 'CREATE TABLE `orders_composition` (
`id` INT(11)  NOT NULL auto_increment ,
`order_id` INT(11)     default NULL ,
`product_id` INT(11)     default NULL ,
`amount` INT(11)     default NULL ,
`price` DOUBLE     default NULL ,
`currency_id` INT(11)     default NULL ,
 `page_id` int(11) default NULL,
 `tag_id` int(11) default NULL,
 `lang_id` int(6) default NULL,
 `sort_index` bigint default \'0\' 
, PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

',
    ),
    'ur_statuses' => 
    array (
      0 => 'CREATE TABLE `ur_statuses` (
`id` INT(11)  NOT NULL auto_increment ,
`caption` VARCHAR(50) character set utf8 collate utf8_general_ci    default NULL ,
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
      'id' => '1',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Registration',
      'description' => 'Регистрация на сайте',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => 'act
id
email',
      'general_table_id' => '1',
      'loaded_name' => 'Registration',
      'sort_index' => '599',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '1',
          'block_id' => '1',
          'name' => 'send_com_theme_confirm',
          'value' => 'Подтвердите регистрацию на сайте ',
          'description' => 'Тема сообщения, которое высылается для подтверждения регистрации',
          'edit_s_type_id' => '1',
          'loaded_name' => 'send_com_theme_confirm',
        ),
        1 => 
        array (
          'id' => '2',
          'block_id' => '1',
          'name' => 'forum_users_table_name',
          'value' => 'forum_users',
          'description' => 'Название таблицы из модуля «Форум», где хранятся данные пользователей',
          'edit_s_type_id' => '1',
          'loaded_name' => 'forum_users_table_name',
        ),
        2 => 
        array (
          'id' => '3',
          'block_id' => '1',
          'name' => 'sendQSubject',
          'value' => 'Добавлен новый вопрос в техподдержку',
          'description' => 'Тема сообщения, которое высылается при добавлении вопроса в техподдержку',
          'edit_s_type_id' => '1',
          'loaded_name' => 'sendQSubject',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '1',
          'block_id' => '1',
          'name' => 'confirm_result.tpl',
          'description' => 'Результат подтверждения регистрации',
          'content' => '{if $confirm}
Спасибо, ваша регистраци на нашем сайте подтверждена! Теперь вы можете авторизироваться, использую свой email и пароль.
{else}
Неправильные данные подтверждения регистрации.
{/if}',
          'loaded_name' => 'confirm_result.tpl',
          'sort_index' => '1138',
          'block_name' => 'Registration',
        ),
        1 => 
        array (
          'id' => '2',
          'block_id' => '1',
          'name' => 'reg_message.tpl',
          'description' => 'Сообщение подтверждения авторизации',
          'content' => 'Здравствуйте, уважаемый пользователь! Вы подали заявку на регистрацию на сайте {$smarty.const.SETTINGS_HTTP_HOST}
<br/>
Для подтверждения регистрации перейдтите, пожалуйста, по ссылке <a href="{$smarty.const.SETTINGS_HTTP_HOST}/registratsiya?act=confirm_r&id={$id}&email={$email}">подтвердить регистрацию</a>.
<br/>
<br/>
С уважением, администрация сайта {$smarty.const.SETTINGS_HTTP_HOST}',
          'loaded_name' => 'reg_message.tpl',
          'sort_index' => '1137',
          'block_name' => 'Registration',
        ),
        2 => 
        array (
          'id' => '3',
          'block_id' => '1',
          'name' => 'reg_result.tpl',
          'description' => 'Сообщение успешной регистрации',
          'content' => '{if $sendResult}
На ваш контактный адрес электронной почты отправлено подтверждение прохождения регистрации.
{else}
Не удалось отправить сообщение для подтверждения регистрации.
{/if}',
          'loaded_name' => 'reg_result.tpl',
          'sort_index' => '1420',
          'block_name' => 'Registration',
        ),
        3 => 
        array (
          'id' => '4',
          'block_id' => '1',
          'name' => 'registration_form.tpl',
          'description' => 'Регистрация пользователя',
          'content' => '{if $errors}
	{foreach from=$errors item=error}
		<p style="color:red">{$error}</p>
	{/foreach}
	<br/>
{/if}

<form fastedit:: action="?act=check_reg" method="post" enctype="multipart/form-data">
<p><input type="hidden" name="translit" value="{$translit}"/></p>
  <table cellpadding="2" cellspacing="2" border="0">
    <tr>
      <td colspan="2" style="height:30px" valign="top" align="right">
        <span style="color:#5a7bca">
          *
        </span>
        {\'Поля обязятельные для заполнения\'|ftext}&nbsp;&nbsp;&nbsp;&nbsp;
      </td>
    </tr>
    <tr>
      <td style="width:150px" valign="top" align="left">
        {\'Фамилия:\'|ftext} 
        <span style="color:#5a7bca">
          *
        </span>
      </td>
      <td>
        <input value="{$second_name}" name="second_name" id="second_name" class="form_element" />
      </td>
    </tr>
    <tr>
      <td valign="top" align="left">
        {\'Имя:\'|ftext} 
        <span style="color:#5a7bca">
          *
        </span>
      </td>
      <td>
        <input value="{$name}" name="name" id="name" class="form_element" />
      </td>
    </tr>
    <tr>
      <td valign="top" align="left">
        {\'Отчество:\'|ftext} 
        <span style="color:#5a7bca">
          *
        </span>
      </td>
      <td>
        <input value="{$otchestvo}" name="otchestvo" id="otchestvo" class="form_element" />
      </td>
    </tr>
    <tr>
      <td valign="top" align="left">
        {\'E-Mail:\'|ftext} 
        <span style="color:#5a7bca">
          *
        </span>
      </td>
      <td>
        <input value="{$email}" name="email" id="email" class="form_element" />
      </td>
    </tr>
    <tr>
      <td valign="top" align="left">
        {\'Пароль:\'|ftext} 
        <span style="color:#5a7bca">
          *
        </span>
      </td>
      <td>
        <input value="{$password}" type="password" name="password" id="password" class="form_element" />
      </td>
    </tr>
    <tr>
      <td valign="top" align="left">
        {\'Повторите пароль:\'|ftext} 
        <span style="color:#5a7bca">
          *
        </span>
      </td>
      <td>
        <input value="{$retype_password}" type="password" name="retype_password" id="retype_password" class="form_element" />
      </td>
    </tr>
    <tr>
      <td valign="top" align="left">
        {\'Контактный телефон:\'|ftext}
      </td>
      <td>
        <input value="{$phone}" name="phone" id="phone" class="form_element" />
      </td>
    </tr>
    <tr>
      <td valign="top" align="left">
        {\'Почтовый индекс:\'|ftext}
      </td>
      <td>
        <input value="{$mail_index}" name="mail_index" id="mail_index" class="form_element" />
      </td>
    </tr>
    <tr>
      <td valign="top" align="left">
        {\'Адрес доставки заказа:\'|ftext}
      </td>
      <td>
        <input value="{$address_of_delivery}" name="address_of_delivery" id="address_of_delivery" class="form_element" />
      </td>
    </tr>
    
    <tr>
      <td  valign="top" align="left">{\'Пол:\'|ftext}</td>
      <td>
        <select name="sex" id="sex" class="form_element" >
          	<option style="color:gray" value="">{\'Не указано\'|ftext}</option>
  			<option {if $sex==\'Мужской\'} selected {/if} value="Мужской">{\'Мужской\'|ftext}</option>
  			<option {if $sex==\'Женский\'} selected {/if} value="Женский">{\'Женский\'|ftext}</option>
  			<option {if $sex==\'Робот\'} selected {/if} value="Робот">{\'Робот\'|ftext}</option>
        </select>
      </td>
    </tr>
        
    <tr>
      <td valign="top" align="left">{\'Ник на форуме:\'|ftext} <span style="color:#5a7bca">*</span></td>
      <td>
        <input value="{$nic}" name="nic" id="nic" class="form_element" />
      </td>
    </tr>       
    <tr>
      <td style="width:150px" valign="top" align="left">{\'Аватор:\'|ftext}</td>
      <td>
        <input type="file" value="" name="avator" id="avator" class="form_element" />
      </td>
    </tr>    
    <tr>
      <td valign="top" align="left">{\'Временная зона:\'|ftext}</td>
      <td>
      <select name="timezone_id" class="form_element" >
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
            <td valign="top">
              <input {if $confirm} checked {/if} type="checkbox" value="1" name="confirm" id="confirm" />
            </td>
            <td>
              &nbsp;
            </td>
            <td>
              {\'Я подтверждаю достоверность указанных данных\'|ftext}
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="height:15px">
      </td>
    </tr>
    <tr>
      <td>
      </td>
      <td>
        <input type="submit" class="button" value="{\'Зарегистрироваться\'|ftext}"/>
      </td>
    </tr>
  </table>
</form>',
          'loaded_name' => 'registration_form.tpl',
          'sort_index' => '1425',
          'block_name' => 'Registration',
        ),
      ),
    ),
    1 => 
    array (
      'id' => '2',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Authorization',
      'description' => 'Авторизация',
      'act_variable' => 'reg',
      'act_method' => 'post',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Authorization',
      'sort_index' => '600',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '5',
          'block_id' => '2',
          'name' => 'info_form.tpl',
          'description' => 'Краткая информация о пользователе',
          'content' => '<div fastedit:: style="margin:0px">
  <br/>
  <br/>
  Здравствуйте <b>{$user.name} {$user.otchestvo}</b>!
  <br/>
  Вы можете <a href="cabinet">перейти</a> в свой личный кабинет.
</div>',
          'loaded_name' => 'info_form.tpl',
          'sort_index' => '1135',
          'block_name' => 'Authorization',
        ),
        1 => 
        array (
          'id' => '6',
          'block_id' => '2',
          'name' => 'login_form.tpl',
          'description' => 'Форма авторизации',
          'content' => '<form fastedit:: action="" method="post" style="margin:5px">
  <p>
    <input type="hidden" name="reg" value="checkLogin"/>
  </p>
  <table style="width:180px" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td align="left" valign="top"  style="height:20px;white-space:nowrap">
        <h2>
          {\'Авторизация\'|ftext}
        </h2>
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        {\'Email:\'|ftext}
        <br/>
        <input class="input" style="width:150px" name="email" value="" />
      </td>
    </tr>
    <tr>
      <td style="height:10px" colspan="100%">
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        {\'Пароль:\'|ftext}
        <br/>
        <input class="input" style="width:150px" name="password" value="" type="password" />
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        <table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td style="height:10px" colspan="100%">
            </td>
        </tr>
        <tr>
          <td align="right" valign="middle">
            <input checked="checked" type="checkbox" value="1" name="zapomnit"/>
          </td>
          <td style="white-space:nowrap">
            &nbsp;{\'запомнить меня\'|ftext}
          </td>
        </tr>
        </table>
      </td>
    </tr>
    {if $error}
    <tr>
      <td style="color:red;height:30px" valign="bottom" align="left">
        {\'Неправильные данные!\'|ftext}
      </td>
    </tr>
    {/if}
    <tr>
      <td style="height:10px" align="left" valign="top">
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        <input class="button" style="width:150px" value="Войти" type="submit" />
      </td>
    </tr>
    <tr>
      <td style="height:10px" align="left" valign="top">
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        <a href="vosstanovlenie-parolya">
          {\'Забыли пароль?\'|ftext}
        </a>
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        <a href="registratsiya">
          {\'Регистрация на сайте\'|ftext}
        </a>
      </td>
    </tr>
  </table>
</form>',
          'loaded_name' => 'login_form.tpl',
          'sort_index' => '1134',
          'block_name' => 'Authorization',
        ),
      ),
    ),
    2 => 
    array (
      'id' => '3',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Cabinet',
      'description' => 'Личный кабинет пользователя',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Cabinet',
      'sort_index' => '602',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '4',
          'block_id' => '3',
          'name' => 'orders_for_page',
          'value' => '10',
          'description' => 'Выводить заказов на страницу в кабинете',
          'edit_s_type_id' => '1',
          'loaded_name' => 'orders_for_page',
        ),
        1 => 
        array (
          'id' => '5',
          'block_id' => '3',
          'name' => 'send_com_theme',
          'value' => 'Подтверждение Email',
          'description' => 'Тема сообщения, которое высылается при смене Email',
          'edit_s_type_id' => '1',
          'loaded_name' => 'send_com_theme',
        ),
        2 => 
        array (
          'id' => '6',
          'block_id' => '3',
          'name' => 'sendQToEmail',
          'value' => '',
          'description' => 'Отправлять уведомление о новом вопросе в техподдержку на Email',
          'edit_s_type_id' => '1',
          'loaded_name' => 'sendQToEmail',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '7',
          'block_id' => '3',
          'name' => 'profile.tpl',
          'description' => 'Редактирование профиля',
          'content' => '<div fastedit::>
  {if $messages}
  {foreach from=$messages item=mes}
  <p style="color:green">
    <b>
      {$mes}
    </b>
  </p>
  {/foreach}
  {/if}
  
  {if $errors}
  {foreach from=$errors item=error}
  <p style="color:red">
    {$error}
  </p>
  {/foreach}
  {/if}
  
  <form action="/cabinet?act=update_profile" method="post" enctype="multipart/form-data">
    <p>
      <input type="hidden" name="translit" value="{$translit}" />
      <input type="hidden" value="{$id}" name="id" />
    </p>
    <table cellpadding="2" cellspacing="2" border="0">
      <tr>
        <td colspan="2" style="height:30px" valign="top" align="right">
          <span style="color:#5a7bca">
            *
          </span>
          {\'Поля обязятельные для заполнения\'|ftext}&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
      </tr>
      <tr>
        <td style="width:150px" valign="top" align="left">
          {\'Фамилия:\'|ftext} 
          <span style="color:#5a7bca">
            *
          </span>
        </td>
        <td>
          <input value="{$second_name}" name="second_name" id="second_name" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {\'Имя:\'|ftext} 
          <span style="color:#5a7bca">
            *
          </span>
        </td>
        <td>
          <input value="{$name}" name="name" id="name" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {\'Отчество:\'|ftext} 
          <span style="color:#5a7bca">
            *
          </span>
        </td>
        <td>
          <input value="{$otchestvo}" name="otchestvo" id="otchestvo" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {\'E-Mail:\'|ftext} 
          <span style="color:#5a7bca">
            *
          </span>
        </td>
        <td>
          <input value="{$email}" name="email" id="email" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {\'Пароль:\'|ftext} 
          <span style="color:#5a7bca">
            *
          </span>
        </td>
        <td>
          <input value="{$password}" type="password" name="password" id="password" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {\'Повторите пароль:\'|ftext} 
          <span style="color:#5a7bca">
            *
          </span>
        </td>
        <td>
          <input value="{$retype_password}" type="password" name="retype_password" id="retype_password" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {\'Контактный телефон:\'|ftext}
        </td>
        <td>
          <input value="{$phone}" name="phone" id="phone" class="form_element" />
        </td>
      </tr>
      
      <tr>
        <td class="form_text" valign="top" align="left">
          {\'Юридический статус:\'|ftext}
        </td>
        <td>
          <select name="ur_status_id" id="ur_status_id" class="form_element">
            
			{foreach from=$ur_statuses item=item}
            <option {if $ur_status_id==$item.id} selected {/if} value="{$item.id}">
              {$item.caption|ftext}
            </option>
            {/foreach}                                     
          </select>
        </td>
      </tr>
      
      <tr>
        <td class="form_text" valign="top" align="left">
          {\'Страна:\'|ftext}
        </td>
        <td>
          <select name="country_id" id="country_id" class="form_element">
            <option style="color:gray" value="">
              {\'Не указано\'|ftext}
            </option>
            
            {foreach from=$country item=item}
            <option {if $item.id==$country_id} selected {/if} value="{$item.id}">
              {$item.name|ftext}
            </option>
            
            {/foreach}
          </select>
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {\'Город:\'|ftext}
        </td>
        <td>
          <input value="{$city}" name="city" id="city" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {\'Название компании:\'|ftext}
        </td>
        <td>
          <input value="{$company}" name="company" id="company" class="form_element" />
        </td>
      </tr>
      
      <tr>
        <td valign="top" align="left">
          {\'Сайт:\'|ftext}
        </td>
        <td>
          <input value="{$url}" name="url" id="url" class="form_element" />
        </td>
      </tr>
      
      <tr>
        <td valign="top" align="left">
          {\'ICQ:\'|ftext}
        </td>
        <td>
          <input value="{$icq}" name="icq" id="icq" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {\'Skype:\'|ftext}
        </td>
        <td>
          <input value="{$skype}" name="skype" id="skype" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {\'Факс:\'|ftext}
        </td>
        <td>
          <input value="{$fax}" name="fax" id="fax" class="form_element" />
        </td>
      </tr>
      <tr>
        <td  valign="top" align="left">
          {\'Пол:\'|ftext}
        </td>
        <td>
          <select name="sex" id="sex" class="form_element">
            <option style="color:gray" value="">
              {\'Не указано\'|ftext}
            </option>
            <option {if $sex==\'Мужской\'} selected {/if} value="Мужской">
              {\'Мужской\'|ftext}
            </option>
            <option {if $sex==\'Женский\'} selected {/if} value="Женский">
              {\'Женский\'|ftext}
            </option>
            <option {if $sex==\'Робот\'} selected {/if} value="Робот">
              {\'Робот\'|ftext}
            </option>
          </select>
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {\'Почтовый индекс:\'|ftext}
        </td>
        <td>
          <input value="{$mail_index}" name="mail_index" id="mail_index" class="form_element" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left">
          {\'Адрес доставки заказа:\'|ftext}
        </td>
        <td>
          <input value="{$address_of_delivery}" name="address_of_delivery" id="address_of_delivery" class="form_element" />
        </td>
      </tr>
      
      <tr>
        <td valign="top" align="left">
        </td>
        <td>
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td valign="top">
                <input {if $get_emails} checked {/if} type="checkbox" value="1" name="get_emails" id="get_emails" />
              </td>
              <td>
                &nbsp;
              </td>
              <td>
                {\'Получать рассылку\'|ftext}
              </td>
              <tr>
            </table>
        </td>
      </tr>
      
      <tr>
        <td valign="top" align="left">
          {\'Ник на форуме:\'|ftext} 
          <span style="color:#5a7bca">
            *
          </span>
        </td>
        <td>
          <input value="{$nic}" name="nic" id="nic" class="form_element" />
        </td>
      </tr>
      
      <tr>
        <td style="width:150px" valign="top" align="left">
          {\'Аватор:\'|ftext}
        </td>
        <td>
          
          {if $avator}
          <table cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td>
                <img alt="" class="ramka" src="/modules/InternetShop/management/storage/images/users/avator/{$id}/preview/{$avator}" />
                <br/>
              </td>
              <td>
                <table cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td>
                      &nbsp;
                      <input name="avator_delete" value="{$avator}" type="checkbox" />
                    </td>
                    <td>
                      &nbsp;{\'Удалить\'|ftext}
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          {/if}
          <input type="file" value="" name="avator" id="avator" class="form_element" />
        </td>
      </tr>
      
      <tr>
        <td valign="top" align="left">
          {\'Временная зона:\'|ftext}
        </td>
        <td>
          <select name="timezone_id" class="form_element">
            <option style="color:gray" value="">
              {\'Не указано\'|ftext}
            </option>
            {foreach from=$timezones item=item}
            <option {if $smarty.post.timezone_id==$item.id || $timezone_id==$item.id} selected {/if} value="{$item.id}">
              {$item.caption}
            </option>
            {/foreach}
          </select>
        </td>
      </tr>
      
      <tr>
        <td valign="top" align="left">
          {\'Подпись на форуме:\'|ftext}
        </td>
        <td>
          <input value="{$signature}" name="signature" id="signature" class="form_element" />
        </td>
      </tr>
            
      <tr>
        <td colspan="2" style="height:15px">
        </td>
      </tr>
      <tr>
        <td>
        </td>
        <td>
          <input type="submit" class="button" value="{\'Сохранить\'|ftext}" />
        </td>
      </tr>
    </table>
  </form>
</div>',
          'loaded_name' => 'profile.tpl',
          'sort_index' => '1144',
          'block_name' => 'Cabinet',
        ),
        1 => 
        array (
          'id' => '8',
          'block_id' => '3',
          'name' => 'orders.tpl',
          'description' => 'Список заказов',
          'content' => '{literal} 
<script type="text/javascript">
  function openZakaz(obj_id) {
	if (GetElementById(obj_id).style.display!=\'none\') {
      GetElementById(obj_id).style.display=\'none\';      
    }
  else {
    GetElementById(obj_id).style.display=\'table-row\';    
  }
}
</script>
{/literal}

<div fastedit::>
  <table cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td>        
        {\'Ваша накопительная скидка составляет:\'|ftext} 
        <b>
          {$discount}%
        </b>
        <br/>
        {\'Сумма оплаченных заказов:\'|ftext} 
        <b>
          {$total_summ} {$currency.sign}
        </b>
        <br/>
        <br/>
        {if $orders}
        <h4>
          {\'Список ваших заказов\'|ftext}
        </h4>
        {/if}        
      </td>
    </tr>
  </table>

{if $orders}
<table style="width:100%;background-color:#e1e5e8" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>
      <table style="width:100%" cellpadding="2" cellspacing="1" border="0" >
        <tr style="width:100%;background-color:white">
          <td style="width:3%">
            <span color="#F98803">
              <b>№</b>
            </span>
          </td>
          <td style="width:15%">
            <span color="#F98803">
              <b>
                {\'Дата создания\'|ftext}
              </b>
            </span>
          </td>
          <td style="width:15%">
            <span color="#F98803">
              <b>
                {\'Идентификатор получения\'|ftext}
              </b>
            </span>
          </td>
          <td style="width:10%">
            <span color="#F98803">
              <b>
                {\'Доставка\'|ftext}
              </b>
            </span>
          </td>
          <td style="width:15%">
            <span color="#F98803">
              <b>
                {\'Полная стоимость\'|ftext}
              </b>
            </span>
          </td>
          <td style="width:10%">
            <span color="#F98803">
              <b>
                {\'Статус\'|ftext}
              </b>
            </span>
          </td>
          <td style="width:5%">
            <span color="#F98803">
              <b>
                {\'Оплачен\'|ftext}
              </b>
            </span>
          </td>
        </tr>
        {foreach from=$orders item=item}
        <tr fastedit:{$table_name}:{$item.id} {if $item.payed} style="background-color:#e3f4fe"{else} style="background-color:#f9f6ed"{/if}>
          <td>
            <a title="{\'Подробности заказа\'|ftext}" href="javascript:openZakaz(\'zakaz{$item.id}\')">
              <b>
                {$item.id}
              </b>
            </a>
          </td>
          <td>
            {$item.created}
          </td>
          <td>
            {$item.send_number}
          </td>
          <td>
            {if $item.delivery_cost}{$item.delivery_cost} {$currency.sign}{else}{\'Не указано\'|ftext}{/if}
          </td>
          <td>
            <b>
              {$item.total_price} {$currency.sign}
            </b>
            {if !$item.delivery_cost}
            <br/>
            <span style="color:gray;font-weight:normal;font-size:10px">
              {\'*неучтена доставка\'|ftext}
            </span>
            {/if}
          </td>
          <td>
            {$item.status_id_caption}
          </td>
          <td align="center">
            {if $item.payed}{\'Да\'|ftext}{else}{\'Нет\'|ftext}{/if}
          </td>
        </tr>
        <tr {if $item.payed}style="background-color:#e3f4fe;display:none" {else}style="background-color:#f9f6ed;display:none"{/if} id="zakaz{$item.id}">
          <td colspan="100%" style="width:100%;background-color:#e1e5e8">            
            {$item.composition}                   
          </td>
        </tr>
        {/foreach}
      </table>
    </td>
  </tr>
</table>
{else}
	{\'У вас нет еще заказов.\'|ftext}
{/if}

<br/>
<br/>
{if $pages.page_count != \'\'}
<table style="margin-top:3px;width:100%"  border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td style="height:25px">
      <td align="right">
        {\'Страница:\'|ftext}
        {if $pages.page_selected>1}
      	<a class="step" href="?act=orders&page=1">&lt;&lt;</a>
        &nbsp; 
        <a class="step" href="?act=orders&page={$pages.page_selected-1}">&lt;</a>
          {/if}
          &nbsp;&nbsp;
          {section name="pages" start=1 loop=$pages.page_count+1}
          <a {if $smarty.section.pages.index==$pages.page_selected}class="step_selected"{else}class="step"{/if} href="{$pageInfo.name}?act=orders&page={$smarty.section.pages.index}">
            {$smarty.section.pages.index}
          </a>
          &nbsp;
          {/section}
          {if $pages.page_selected<$pages.page_count}
          <a class="step" href="?act=orders&page={$pages.page_selected+1}">&gt;</a>
          &nbsp; 
          <a class="step" href="?act=orders&page={$pages.page_count}">&gt;&gt;</a>
          {/if}
       </td>
    </tr>
</table>
{/if} 
</div>',
          'loaded_name' => 'orders.tpl',
          'sort_index' => '1145',
          'block_name' => 'Cabinet',
        ),
        2 => 
        array (
          'id' => '9',
          'block_id' => '3',
          'name' => 'reg_message.tpl',
          'description' => 'Сообщение на подтверждение изменения email адреса',
          'content' => 'Здравствуйте, уважаемый пользователь! Вы изменили свой контактный Email на сайте {$smarty.const.SETTINGS_HTTP_HOST}.
<br/>
Для подтверждения изменения перейдтите, пожалуйста, по ссылке 
<a href="{$smarty.const.SETTINGS_HTTP_HOST}/registratsiya?act=confirm_r&id={$id}&email={$email}">
  подтвердить Email.
</a>

В противном случае, вы не сможете авторизироваться нк сайте {$smarty.const.SETTINGS_HTTP_HOST}. 
<br/>
<br/>
С уважением, администрация.',
          'loaded_name' => 'reg_message.tpl',
          'sort_index' => '1147',
          'block_name' => 'Cabinet',
        ),
        3 => 
        array (
          'id' => '10',
          'block_id' => '3',
          'name' => 'help_show.tpl',
          'description' => 'Вывод переписки с техподдержкой',
          'content' => '<div fastedit::>
{if $help}
  <p>
    {\'Ваша переписка с техподдержкой\'|ftext}
  </p>
  <br/>
<table style="width:100%;background-color:#e1e5e8" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>
    <table style="width:100%" cellpadding="2" cellspacing="1" border="0">
        <tr style="background-color:white">
          <td width="15%"><span color="#F98803"><b>{\'Дата\'|ftext}</b></span></td>
          <td width="85%"><span color="#F98803"><b>{\'Переписка\'|ftext}</b></span></td>          
        </tr>
        
        {foreach from=$help item=h}
         {if $h.show_answer} 
        <tr style="background-color:#f0f0f0">
          <td valign="top">
          <p style="font-size:11px"><b>{\'Ответ\'}</b></p>
          </td>
          <td fastedit:{$table_name}:{$h.id}>
          	{$h.answer}
          	{if $h.answer_attach}
          		<br/>
          		<a target="_blank" href="/modules/InternetShop/management/storage/files/help/answer_attach/{$h.id}/{$h.answer_attach}">
          		<img alt="" border="0" src="/modules/InternetShop/img/attachment.png" /> {\'ВЛОЖЕНИЕ\'|ftext}
          		</a>
          	{/if}
          </td>          
        </tr>
        {/if}        
        
        <tr style="background-color:white">
          <td valign="top"><p style="font-size:11px">{$h.datetime}</p>          
          </td>
          <td valign="top" fastedit:{$table_name}:{$h.id}>        
          {$h.question}
          	{if $h.question_attach}
          		<br/>
          		<a target="_blank" href="/modules/InternetShop/management/storage/files/help/question_attach/{$h.id}/{$h.question_attach}">
          		<img alt="" border="0" src="/modules/InternetShop/img/attachment.png"/> {\'ВЛОЖЕНИЕ\'|ftext}
          		</a>
          	{/if}                    
          </td>          
        </tr>                                        
        {/foreach}
      </table>
      </td>
  </tr>
</table>
{else}
	{\'Еще нет добавленных вопросов.\'|ftext}
{/if}

<br/>
<br/>
{if $pages.page_count != \'\'}
<table style="margin-top:3px;width:100%;"  border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td style="height:25px">
    <td align="right">{\'Страница:\'|ftext}
      {if $pages.page_selected>1}
      	<a class="step" href="?act=help&page=1">&lt;&lt;</a>&nbsp; <a class="step" href="?act=help&page={$pages.page_selected-1}">&lt;</a>
      {/if}
      &nbsp;&nbsp;
      {section name="pages" start=1 loop=$pages.page_count+1}
       	<a {if $smarty.section.pages.index==$pages.page_selected}class="step_selected"{else}class="step"{/if} href="{$pageInfo.name}?act=help&page={$smarty.section.pages.index}">{$smarty.section.pages.index}</a> &nbsp;
      {/section}
      {if $pages.page_selected<$pages.page_count}
      	<a class="step" href="?act=help&page={$pages.page_selected+1}">&gt;</a>&nbsp; <a class="step" href="?act=help&page={$pages.page_count}">&gt;&gt;</a>
      {/if}
      </td>
  </tr>
</table>
{/if}
      
<h3>{\'Задать вопрос в техподдержку\'|ftext}</h3>
{if $errors}
	<br/>
	<center>
    	{foreach from=$errors item=error}
        	<p style="color:red">{$error|ftext}</p>
	    {/foreach}	
    </center>
    <br/>
    <br/>
{/if}
            
<form id="help_form" action=\'?act=help_add_q#help_form\' method="post" enctype="multipart/form-data">
	{if $q_is_added}
		<br/>
        <center>
          <h2>{\'Благодарим за ваш вопрос! В ближайшее время наши специалисты дадут ответ на ваш вопрос.\'|ftext}</h2>
        </center>
        <br/>
    {/if}
    
 <p>
 	<input type="hidden" name="datetime" value="" />
 </p>
        
  <table style="width:100%" cellpadding="2" cellspacing="2" border="0">    
      <tr>
        <td style="white-space:nowrap" valign="top">
          {\'Ваш вопрос:\'|ftext}&nbsp;
          <span style="color:#5acbff">
            *
          </span>
        </td>
        <td>
          <textarea style="width:600px" rows="10" name="question" id="question">
            {$question}
          </textarea>
        </td>
      </tr>
      <tr>
        <td>
          {\'Вложение:\'|ftext}&nbsp;
        </td>
        <td>
          <input type="file" value="" name="question_attach"/>
        </td>
      </tr>      
      <tr>
        <td style="height:30px">
        </td>
        <td valign="bottom">
          <input class="button" type="submit" value="{\'Добавить вопрос\'|ftext}" name=\'send_com\' />
        </td>
      </tr>
  </table>
      </form>
</div>      

{$editor}            ',
          'loaded_name' => 'help_show.tpl',
          'sort_index' => '1970',
          'block_name' => 'Cabinet',
        ),
        4 => 
        array (
          'id' => '11',
          'block_id' => '3',
          'name' => 'help_message_confirm.tpl',
          'description' => 'Уведомление администратора о новом вопросе',
          'content' => 'Здравствуйте, уважаемый администратор! На вашем сайте пользователь <a href="mailto:{$user.email}">{$user.email}</a> добавил новый вопрос в техническую поддержку.
<hr>
{$user_question}',
          'loaded_name' => 'help_message_confirm.tpl',
          'sort_index' => '1971',
          'block_name' => 'Cabinet',
        ),
        5 => 
        array (
          'id' => '12',
          'block_id' => '3',
          'name' => 'print_composition.tpl',
          'description' => 'Вывод товарного чека в личном кабинете',
          'content' => '<br/>
<h4 style="text-align:center;margin:0px">
  {\'Товарный чек №\'|ftext}{$order.id} {\'от\'|ftext} {$date}{\'г.\'|ftext}
</h4>

<table cellpadding="2" cellspacing="1" style="border:0px" >
  <tr>
    <td>
      <b>
        {\'Плательщик:\'|ftext}
      </b>
    </td>
    <td>
      {$order.second_name} {$order.name} {$order.otchestvo}
    </td>
  </tr>
</table>

<table cellpadding="2" cellspacing="1" style="width:100%;margin-top:5px;background-color:#e1e5e8">
  <tr style="background-color:#efefef">
    <td style="width:5%">
      <b>№</b>
    </td>
    <td style="width:40%">
      <b>
        {\'Наименование\'|ftext}
      </b>
    </td>
    <td style="width:5%">
      <b>
        {\'Единица\'|ftext}
      </b>
    </td>
    <td style="width:10%">
      <b>
        {\'Кол-во\'|ftext}
      </b>
    </td>
    <td style="width:10%">
      <b>
        {\'Цена\'|ftext}
      </b>
    </td>
    <td style="width:15%">
      <b>
        {\'Сумма без НДС\'|ftext}
      </b>
    </td>
    <td style="width:15%">
      <b>
        {\'Сумма НДС\'|ftext}
      </b>
    </td>
  </tr>
  {foreach name="products_comp" from=$products item=item}
  <tr style="width:100%;background-color:white">
    <td>
      {$smarty.foreach.products_comp.iteration}
    </td>
    <td>
      {$item.article} {$item.caption}
    </td>
    <td>
      {$item.unit_id_caption}
    </td>
    <td>
      {$item.amount}
    </td>
    <td>
      {$item.price}
    </td>
    <td>
      {$item.price_bez_nds}
    </td>
    <td>
      {$item.price_nds}
    </td>
  </tr>
  {/foreach}
</table>

<table cellpadding="0" cellspacing="0" style="width:100%;border:0px">  
  <tr>
    <td>
      <table cellpadding="2" cellspacing="1" style="border:0px;margin-right:20px" align="right">
        <tr>
          <td>
            <b>
              {\'Итого без НДС:\'|ftext}
            </b>
          </td>
          <td>
            {$price_bez_nds_total}
          </td>
        </tr>
        <tr>
          <td>
            <b>
              {\'НДС:\'|ftext}
            </b>
          </td>
          <td>
            {$nds_total}
          </td>
        </tr>
        <tr>
          <td>
            <b>
              {\'Итого с НДС:\'|ftext}
            </b>
          </td>
          <td>
            {$price_s_nds_total}
          </td>
        </tr>
      </table>      
    </td>
  </tr>
</table>

<table cellpadding="2" cellspacing="1" style="border:0px">
  <tr>
    <td>
      <b>
        {\'Итого с НДС прописью:\'|ftext}
      </b>
    </td>
    <td>
      {$total_summ} {$currency.sign} {$total_ostatok} {$currency.sign_fraction}
    </td>
  </tr>
</table>
<br/>',
          'loaded_name' => 'print_composition.tpl',
          'sort_index' => '83',
          'block_name' => 'Cabinet',
        ),
      ),
    ),
    3 => 
    array (
      'id' => '4',
      'module_id' => '1',
      'type' => '2',
      'name' => 'ShopcartPreview',
      'description' => 'Предпросмотр корзины',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'ShopcartPreview',
      'sort_index' => '933',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '13',
          'block_id' => '4',
          'name' => 'shortDetails.tpl',
          'description' => 'Предпросмотр корзины',
          'content' => '<div fastedit:: style="margin:5px">  
  <h2>
    {\'Товары в корзине\'|ftext}
  </h2>
  <table id="shopcart_info"  valign=\'top\'  border=\'0\' cellpadding=\'0\' style="width:100%;display:none">
    <tr>
      <td style="white-space:nowrap" align=\'left\' valign=\'middle\'>
        {\'Товаров в корзине\'|ftext}: 
        <span id="total_count">0</span>
      </td>
    </tr>
    <tr>
      <td style="white-space:nowrap" align=\'left\' valign=\'middle\' >
        {\'На сумму:\'|ftext} 
        <span id="total_summ" style="font-weight:bold">0</span>
        {$currency.sign}
      </td>
    </tr>
    <tr>
      <td align=\'left\' valign=\'middle\'>
        <a style="font-size:16px" href=\'shopcart\'>
          <b>
            {\'Oформить заказ\'|ftext}
          </b>
        </a>
      </td>
    </tr>
  </table>
  
  <table align=\'left\' style="width:100%" border=\'0\' cellpadding=\'0\'>
    <tr>
      <td colspan="2" style="white-space:nowrap;">
        <span id="shopcart_info_empty" style="display:none;">
          {\'Корзина пуста...\'|ftext}
        </span>
        <br/>
      </td>
      <tr>
        <tr>
          <td style="white-space:nowrap">
            <select onchange="setCurrency(this)" style="width:90px;margin:0px">              
              {foreach from=$currencies item=item}
              <option {if $currency.id==$item.id}selected{/if} value="{$item.id}">
                {$item.name}
              </option>              
              {/foreach}
            </select>
            {\'Валюта\'|ftext} 
          </td>
          <td>
          </td>
    </tr>
  </table>
</div>',
          'loaded_name' => 'shortDetails.tpl',
          'sort_index' => '1325',
          'block_name' => 'ShopcartPreview',
        ),
      ),
    ),
    4 => 
    array (
      'id' => '5',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Products',
      'description' => 'Вывод продукции из категории',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '5',
      'loaded_name' => 'Products',
      'sort_index' => '598',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '7',
          'block_id' => '5',
          'name' => 'kcaptcha',
          'value' => '0',
          'description' => 'Использовать капчу при добавлении комментариев к товару',
          'edit_s_type_id' => '3',
          'loaded_name' => 'kcaptcha',
        ),
        1 => 
        array (
          'id' => '8',
          'block_id' => '5',
          'name' => 'records_for_page',
          'value' => '10',
          'description' => 'Выводить товаров на страницу',
          'edit_s_type_id' => '1',
          'loaded_name' => 'records_for_page',
        ),
        2 => 
        array (
          'id' => '9',
          'block_id' => '5',
          'name' => 'date_format_comments',
          'value' => 'Y-m-d H:i:s',
          'description' => 'Формат отображения даты у комментариев',
          'edit_s_type_id' => '1',
          'loaded_name' => 'date_format_comments',
        ),
        3 => 
        array (
          'id' => '10',
          'block_id' => '5',
          'name' => 'show_comments',
          'value' => '1',
          'description' => 'Показывать комментарии',
          'edit_s_type_id' => '3',
          'loaded_name' => 'show_comments',
        ),
        4 => 
        array (
          'id' => '11',
          'block_id' => '5',
          'name' => 'send_comments_toEmail',
          'value' => '',
          'description' => 'Отправлять уведомление о новом комментарии на Email',
          'edit_s_type_id' => '1',
          'loaded_name' => 'send_comments_toEmail',
        ),
        5 => 
        array (
          'id' => '12',
          'block_id' => '5',
          'name' => 'send_com_theme_add_comments',
          'value' => 'Добавлен новый комментарий на вашем сайте',
          'description' => 'Тема письма, которое отсылается при добавлении нового комментария',
          'edit_s_type_id' => '1',
          'loaded_name' => 'send_com_theme_add_comments',
        ),
        6 => 
        array (
          'id' => '13',
          'block_id' => '5',
          'name' => 'SearchSettings',
          'value' => 'array( 
//имя таблицы без префикса
\'products\'=>array (
\'sql\'=>"SELECT t.id, t.category_id, t.caption, t.small_description, t.description 
FROM `{$this->tablePrefix}products` AS `t` 
WHERE t.lang_id=\'{$this->lang_id}\' AND t.active=1 AND (t.caption LIKE \'%{$this->search_text}%\' OR t.small_description LIKE \'%{$this->search_text}%\' OR t.description LIKE \'%{$this->search_text}%\' OR t.article LIKE \'%{$this->search_text}%\')
ORDER BY t.sort_index DESC",  					
//Формат URL			 
\'url\'=>\'?act=more&category_id={$category_id}&id={$id}\'
)
);',
          'description' => 'Настройка для модуля Поиск',
          'edit_s_type_id' => '2',
          'loaded_name' => 'SearchSettings',
        ),
        7 => 
        array (
          'id' => '14',
          'block_id' => '5',
          'name' => 'round_price',
          'value' => '0',
          'description' => 'Округлять цены до целого',
          'edit_s_type_id' => '3',
          'loaded_name' => 'round_price',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '14',
          'block_id' => '5',
          'name' => 'show_more.tpl',
          'description' => 'Вывод подробного описания',
          'content' => '<div fastedit::>
<table align=\'center\' style="width:100%" border=\'0\' cellspacing=\'0\' cellpadding=\'0\'>
  <tr>
    <td  style="height:1px;background-color:#e1e5e8"></td>
  </tr>
  <tr>
    <td fastedit:{$table_name}:{$product.id}>
      <br/>
        <table style="width:100%" border=\'0\' cellspacing=\'0\' cellpadding=\'0\'>
          <tr>
            <td style="width:150px" align=\'left\' valign=\'top\'>
              <a {if $product.image} class="colorbox"  href="/modules/InternetShop/management/storage/images/products/image/{$product.id}/{$product.image}"{else} href="#"{/if}><img alt="{$product.caption}" title="{$product.caption}" border="0" src="/{if $product.image}modules/InternetShop/management/storage/images/products/image/{$product.id}/preview/{$product.image}{else}modules/InternetShop/img/nopic.gif{/if}" /></a> {if $settings.show_comments}
              
                <div style="margin-left:20px;text-align:left;width:110px;height:20px;background-image:url(\'/modules/InternetShop/img/stars_null.png\');background-repeat:repeat-x;">
                  <div style="width:{$points_width}px;height:20px;background-image:url(\'/modules/InternetShop/img/stars.png\');background-repeat:repeat-x;"></div>
                </div>
                <span style="margin-left:45px;font-size:11px;color:#966e4e">{if $comments_pages.records_count}{$comments_pages.records_count} {\'голосов\'|ftext}{else}{\'нет голосов\'|ftext}{/if}</span>
            
              {/if}
            </td>
            <td style="width:25px">&nbsp;</td>
            <td align=\'left\' valign=\'top\'><h1>{$product.caption}</h1>
              {$product.small_description}
              <br/>
              {$product.description}
              <br/>
              <table style="width:100%" cellpadding="0" cellspacing="0" border="0">                
                <tr>
                  <td style="white-space:nowrap;" align="left">
                    <span class="price_caption">
                      {\'Цена:\'|ftext}
                    </span>                    
                    <span class="price">
                      &nbsp;{$product.price} {$currency.sign}
                    </span>
                  </td>
                  <td colspan="100%"  style="white-space:nowrap;"  align="left">
                  {if $product.old_price}                  
                    {if $product.discount_type}
                    <span class="price_caption">
                      {\'Скидка:\'|ftext}
                    </span>
                    &nbsp;
                    <span class="discount">
                      {$product.discount}%
                    </span>
                    &nbsp; 
                    {/if}
                    <span class="price_caption">
                      {\'Старая цена:\'|ftext}
                    </span>
                    &nbsp;
                    <span class="price_old">
                      {$product.old_price} {$currency.sign}
                    </span>                  
                  {/if}    
                    </td>
                </tr>
                
                <tr>
                  <td style="white-space:nowrap;" colspan="100%" align=\'right\' valign=\'top\'>
                    <a href="javascript: addToCart(\'{$product.id}\')">
                      <img alt="" src="/{\'img/buy.png\'|ftext}"  border="0" />
                    </a>
                    <input type="hidden" value="1" id="ind{$product.id}" name="ind{$product.id}" />
                 </td>
                </tr>
                
                <tr>
                  <td style="white-space:nowrap;" colspan="100%" align=\'right\' valign=\'top\'>
                    <div id="inShop{$product.id}">
                    </div>
                  </td>
                </tr>
              </table>
              
              {if $product.images}
              {assign var="k" value=0} 
              <br/>
              <table align="left" cellpadding="0" cellspacing="0" border="0" style="width:100%">
                <tr> 
                  {foreach from=$product.images item=img}
                  {if $k eq 3}
                  {assign var="k" value=1}
                </tr>
                <tr>
                  {else} 
                  {assign var="k" value=$k+1}
                  {/if}
                  <td valign="top">
                  	<table align="left" cellpadding="0" cellspacing="0" border="0" style="width:100px">
                      <tr>
                        <td><a class="colorbox" href="/modules/InternetShop/management/storage/images/products/images/{$product.id}/{$img.name}"><img class="ramka" style="margin:3px" src="/modules/InternetShop/management/storage/images/products/images/{$product.id}/preview/{$img.name}" border="0" alt="{$img.description}" /></a></td>
                      </tr>
                      <tr>
                        <td>
                          <span style="font-size:11px">{$img.description}</span>
                        </td>
                      </tr>
                    </table>
                  </td>
                  {/foreach}
                  {if $k<3}
                  <td style="width:100%" colspan="100%"></td>
                  {/if}
                </tr>
              </table>
              {/if}
            </td>
          </tr>
        </table>
      <br/>
      <script type="text/javascript">$(document).ready(showProductAded({$product.id}));</script>
      </td>
  </tr>
  <tr>
    <td style="height:1px;background-color:#e1e5e8" valign="middle" align="center"></td>
  </tr>
</table>

{if $comments_pages}
{if $comments_pages.page_count != \'\'}
<table style="width:100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td align=\'left\' valign=\'center\'><h3>{\'Отзыв, комментарий\'|ftext}:</h3>
      {foreach name="com" from=$comments_records item=list}
  <tr style="height:9px">
    <td></td>
  </tr>
  <tr>
    <td align=\'left\' valign=\'middle\' fastedit:{$table_name_comments}:{$list.id}>
        <table style="width:100%;background-color:#eff9ff" align=\'center\' border=\'0\' cellspacing=\'0\' cellpadding=\'0\'>
          <tr>
            <td style="height:25px" align=\'left\' valign=\'middle\'><b>{$list.datetime}&nbsp;&nbsp;  {\'оценка:\'|ftext} {$list.points}&nbsp;&nbsp; {$list.user_name}:</b></td>
          </tr>
          <tr>
            <td align=\'left\' valign=\'top\'>{$list.comment}</td>
          </tr>
        </table>
      </td>
  </tr>
  <tr style="height:9px">
    <td></td>
  </tr>
  {/foreach}
    </td>
    </tr>  
  <tr>
    <td style="width:1px;background-color:#e1e5e8"></td>
  </tr>
  <tr>
    <td>
    <table style="margin-top:3px;width:100%"  border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td align="right">
            {\'Страница:\'|ftext}
            {if $comments_pages.page_selected>1}
	            <a class="step" href="?act=more&category_id={$category.id}&id={$product.id}&page_com=1">&lt;&lt;</a>&nbsp; <a class="step" href="?act=more&category_id={$category.id}&id={$product.id}&page_com={$comments_pages.page_selected-1}">&lt;</a>
            {/if}
            &nbsp;&nbsp;
            {section name="pages" start=1 loop=$comments_pages.page_count+1}
            	 <a {if $smarty.section.pages.index==$comments_pages.page_selected}class="step_selected"{else}class="step"{/if} href="{$pageInfo.name}?act=more&category_id={$category.id}&id={$product.id}&page_com={$smarty.section.pages.index}">{$smarty.section.pages.index}</a> &nbsp;
            {/section}
            {if $comments_pages.page_selected<$comments_pages.page_count}
            	<a class="step" href="?act=more&category_id={$category.id}&id={$product.id}&page_com={$comments_pages.page_selected+1}">&gt;</a>&nbsp; <a class="step" href="?act=more&category_id={$category.id}&id={$product.id}&page_com={$comments_pages.page_count}">&gt;&gt;</a>
            {/if} 
            </td>
        </tr>
      </table>
      </td>
  </tr>
</table>
{/if}
{/if}
      
<table style="width:100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td align=\'left\' valign=\'center\' id="comments_form">
    	{if $errors}
    		<br/>
      		<center>
        	{foreach from=$errors item=error}
        		<p style="color:red">{$error|ftext}</p>
        	{/foreach}
        	<br/>
      		</center>
      	{/if}
      <br/>
      <h3>{\'Оставить отзыв\'|ftext}</h3>
      <form action=\'?act=insert_comments&category_id={$smarty.get.category_id}&id={$product.id}#comments_form\' method="post">
        {if $comment_is_added}
        	<br/>
        	<center><h2>{\'Благодарим за отзыв! Ваше мнение очень важно для нас. Ваш отзыв обязательно будет размещен, после проверки администратора.\'|ftext} </h2></center>
        	<br/>
        {/if}
        <p>
        <input type="hidden" name="datetime" value="" />
        <input type="hidden" name="product_id" value="{$product.id}" />
        </p>
        <table style="width:100%"  cellpadding="2" cellspacing="2" border="0">
          <tr>
            <td style="width:100px">{\'Имя:\'|ftext}&nbsp;<span style="color:#5acbff">*<span></td>
            <td><input value="{if $user_name}{$user_name}{else}{$smarty.session.logined_user.contact_name}{/if}"  name="user_name" style="width:330px" /></td>
          </tr>
          <tr>
            <td>{\'E-mail:\'|ftext}&nbsp;<span style="color:#5acbff">*<span></td>
              <td><input value="{if $user_email}{$user_email}{else}{$smarty.session.logined_user.email}{/if}" name="user_email" style="width:330px" /></td>
          </tr>
          <tr>
            <td>{\'Ваше мнение:\'|ftext}&nbsp;<span style="color:#5acbff">*<span></td>
            <td><select name="points" style="width:330px">
                <option {if $points==0} selected {/if} value="0" style="color:gray">{\'Выберите оценку товару\'|ftext}</option>
                <option {if $post.points==1} selected {/if} value="1">{\'Ужасно\'|ftext}</option>
                <option {if $points==2} selected {/if} value="2">{\'Плохо\'|ftext}</option>
                <option {if $points==3} selected {/if} value="3">{\'Нормально\'|ftext}</option>
                <option {if $points==4} selected {/if} value="4">{\'Хорошо\'|ftext}</option>
                <option {if $points==5} selected {/if} value="5">{\'Отлично\'|ftext}</option>
              </select>
              </td>
          </tr>
          <tr>
            <td style="white-space:nowrap" valign="top">{\'Комментарий:\'|ftext}&nbsp;<span style="color:#5acbff">*<span></td>
            <td><textarea style="width:330px" rows="5" name="comment" id="comment">{$comment}</textarea></td>
          </tr>
          {if $settings.kcaptcha==1}
          <tr>
            <td align=\'left\' valign=\'center\' style="width:100px">{\'Введите код:\'|ftext}&nbsp;<span style="color:#5acbff">*<span></td>
            <td align="left" valign="top">
               <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td align=\'left\' valign=\'center\' style="width:120px"><img width="120px" height="50px" id="kcaptcha_img" alt="{\'Включите отображеине изображений\'|ftext}" src=\'/modules/InternetShop/kcaptcha/index.php\' border=\'0\' /></td>
                  <td  valign=\'center\' align="center"><input name="kcaptcha" style="width:75px" class="i_black" />
                    <br/>
                    <a class="news_navigations" href="javascript:reloadKcaptcha(\'kcaptcha_img\')">{\'поменять код\'|ftext}</a></td>
                </tr>
              </table>
              </td>
          </tr>
          {/if}
          <tr>
            <td style="height:30px"></td>
            <td valign="bottom"><input  class="button" type="submit" value="{\'Добавить комментарий\'|ftext}" name=\'send_com\' /></td>
          </tr>
        </table>
      </form>
      </td>
  </tr>
</table>
                                       
{if $same_products}
<br/>
<br/>
 <div style="clear:both;height:1px;width:100%;background-color:#e1e5e8">
  </div>  
  {foreach name="cat" from=$same_products item=product}  
  <div fastedit:{$table_name}:{$product.id} style="clear:both;width:100%;">
    <br/>    
    <div style="float:left;width:150px;">
      <a href="?act=more&category_id={$product.category_id}&id={$product.id}">
        <img alt="{$product.caption}" title="{$product.caption}" border="0" src="/{if $product.image}modules/InternetShop/management/storage/images/products/image/{$product.id}/preview/{$product.image}{else}modules/InternetShop/img/nopic.gif{/if}" />
      </a>
      {if $settings.show_comments}     
      <div style="clear:left;margin-left:20px;width:110px;height:20px;background-image:url(\'/modules/InternetShop/img/stars_null.png\');background-repeat:repeat-x;">
          <div style="width:{if $product.comments_points_width}{$product.comments_points_width}{else}0{/if}px;height:20px;background-image:url(\'/modules/InternetShop/img/stars.png\');background-repeat:repeat-x;">
          </div>
        </div>
        <span style="margin-left:45px;font-size:11px;color:#966e4e">
          {if $product.comments_count}{$product.comments_count} {\'голосов\'|ftext}{else}{\'нет голосов\'|ftext}{/if}
        </span>     
      {/if}
    </div>
    <div style="float:left;width:25px;">
      &nbsp;
    </div>
    <div style="float:left;width:620px">
      <a class="product_caption" href="?act=more&category_id={$product.category_id}&id={$product.id}">
        {$product.caption}
      </a>
      <br/>
      <br/>
      {$product.small_description}
      <br/>            
      <div style="clear:both;white-space:nowrap;width:100%">  
        {if $product.discount_type}              
        <span class="price_caption">
          {\'Скидка:\'|ftext}
        </span>        
        
        <span class="discount">
          {$product.discount}%
        </span>
        {/if}
          
        <span class="price_caption">
          &nbsp;&nbsp;{\'Цена:\'|ftext}
        </span>
        
        <span class="price">
          {$product.price} {$currency.sign}
        </span>
                        
        {if $product.old_price}             
          <span class="price_caption">
            &nbsp;&nbsp;{\'Старая цена:\'|ftext}
          </span>
          
          <span class="price_old">
            {$product.old_price} {$currency.sign}
          </span>       
        {/if}          
      </div>
      <div style="clear:both;width:100%;text-align:right;">
        <a href="javascript: addToCart(\'{$product.id}\')">
          <img style="text-a;ign:right" alt="" src="{\'/img/buy.png\'|ftext}" border="0" />
        </a>
        <input type="hidden" style="width:20px" value="1" id="ind{$product.id}" name="ind{$product.id}" />
      </div>
      
      <div style="clear:both;text-align:right;" id="inShop{$product.id}">
      </div>      
 </div>
    
    <script type="text/javascript">
      $(document).ready(showProductAded({
        $product.id}
        ));
    </script>

    <div style="clear:both;height:10px;width:100%;">
    </div>    
    <div style="clear:both;height:1px;width:100%;background-color:#e1e5e8">
    </div>    
    <div style="clear:both;height:5px;width:100%;">
    </div>    
  {/foreach}
                                   
{/if}                                          
</div>

{literal}
<link media="screen" rel="stylesheet" href="/modules/InternetShop/colorbox/example1/colorbox.css" />
<script type="text/javascript" src="/modules/InternetShop/colorbox/colorbox/jquery.colorbox.js"></script> 
<script type="text/javascript">$(document).ready(function(){$(".colorbox").colorbox({rel:\'colorbox\'});			});</script> 
{/literal}
              ',
          'loaded_name' => 'show_more.tpl',
          'sort_index' => '1131',
          'block_name' => 'Products',
        ),
        1 => 
        array (
          'id' => '15',
          'block_id' => '5',
          'name' => 'com_message.tpl',
          'description' => 'Уведомление о новом комментарии',
          'content' => 'На сайте 
<a href="{$smarty.const.SETTINGS_HTTP_HOST}">
  {$smarty.const.SETTINGS_HTTP_HOST}
</a>
к товару 
<a href="{$smarty.const.SETTINGS_HTTP_HOST}/internet-shop/?act=more&category_id={$category_id}&id={$id}">
  «{$caption}»
</a>
оставили комментарий. 
<br/>
<a href="{$smarty.const.SETTINGS_HTTP_HOST}/admin/">
  Перейти в админку
</a>
<hr>
Комментарий:
<pre>
{$user_comment}
</pre>',
          'loaded_name' => 'com_message.tpl',
          'sort_index' => '1132',
          'block_name' => 'Products',
        ),
        2 => 
        array (
          'id' => '16',
          'block_id' => '5',
          'name' => 'show_subcats.tpl',
          'description' => 'Показать подкатегории',
          'content' => '<div fastedit::>
{if $cat.description}{$cat.description}{/if}
{foreach from=$categories item=item}
	{if $cat.id!=$item.id}
		<div style="margin-top:5px"><a href="internet-shop?category_id={$item.id}">{$item.caption}</a></div>
	{/if}
{/foreach}
<br/>
&nbsp;
</div>',
          'loaded_name' => 'show_subcats.tpl',
          'sort_index' => '1011',
          'block_name' => 'Products',
        ),
        3 => 
        array (
          'id' => '17',
          'block_id' => '5',
          'name' => 'show_list.tpl',
          'description' => 'Вывод списка продуктов из категории',
          'content' => '<div fastedit::>
{if $products}
  <div style="float:left;margin-top:3px;width:30%;height:23px">
    {\'Показывать товаров по\'|ftext}&nbsp; 
    <a {if $smarty.session.records_for_products_page==5}class="step_selected"{else}class="step"{/if} href="?category_id={$category.id}&for_page=5">5</a>/ 
    <a {if $smarty.session.records_for_products_page==10}class="step_selected"{else}class="step"{/if} href="?category_id={$category.id}&for_page=10">10</a>/ 
    <a {if $smarty.session.records_for_products_page==15}class="step_selected"{else}class="step"{/if} href="?category_id={$category.id}&for_page=15">15</a>
  </div>
  <div style="float:left;width:70%;text-align:right;height:23px">
    {\'Страница:\'|ftext}
    {if $pages.page_selected>1}
    <a class="step" href="?page=1">&lt;&lt;</a>
    &nbsp; 
    <a class="step" href="?category_id={$category.id}&page={$pages.page_selected-1}">&lt;</a>
    {/if}
    &nbsp;&nbsp;
    {section name="pages" start=1 loop=$pages.page_count+1} 
    <a {if $smarty.section.pages.index==$pages.page_selected}class="step_selected"{else}class="step"{/if} href="{$pageInfo.name}?category_id={$category.id}&page={$smarty.section.pages.index}">
      {$smarty.section.pages.index}
    </a>
    &nbsp;
    {/section}
    {if $pages.page_selected<$pages.page_count}
    <a class="step" href="?category_id={$category.id}&page={$pages.page_selected+1}">&gt;</a>
    &nbsp; 
    <a class="step" href="?category_id={$category.id}&page={$pages.page_count}">&gt;&gt;</a>
    {/if}
  </div>

  <div style="clear:both;height:1px;width:100%;background-color:#e1e5e8">
  </div>  
  {foreach name="cat" from=$products item=product}  
  <div fastedit:{$table_name}:{$product.id} style="clear:both;width:100%;">
    <br/>    
    <div style="float:left;width:150px;">
      <a href="?act=more&category_id={$product.category_id}&id={$product.id}">
        <img alt="{$product.caption}" title="{$product.caption}" border="0" src="/{if $product.image}modules/InternetShop/management/storage/images/products/image/{$product.id}/preview/{$product.image}{else}modules/InternetShop/img/nopic.gif{/if}" />
      </a>
      {if $settings.show_comments}     
      <div style="clear:left;margin-left:20px;width:110px;height:20px;background-image:url(\'/modules/InternetShop/img/stars_null.png\');background-repeat:repeat-x;">
          <div style="width:{if $product.comments_points_width}{$product.comments_points_width}{else}0{/if}px;height:20px;background-image:url(\'/modules/InternetShop/img/stars.png\');background-repeat:repeat-x;">
          </div>
        </div>
        <span style="margin-left:45px;font-size:11px;color:#966e4e">
          {if $product.comments_count}{$product.comments_count} {\'голосов\'|ftext}{else}{\'нет голосов\'|ftext}{/if}
        </span>     
      {/if}
    </div>
    <div style="float:left;width:25px;">
      &nbsp;
    </div>
    <div style="float:left;width:620px;">
      <a class="product_caption" href="?act=more&category_id={$product.category_id}&id={$product.id}">
        {$product.caption}
      </a>
      <br/>
      <br/>
      {$product.small_description}
      <br/>            
      <div style="clear:both;white-space:nowrap;width:100%">  
        {if $product.discount_type}              
        <span class="price_caption">
          {\'Скидка:\'|ftext}
        </span>        
        
        <span class="discount">
          {$product.discount}%
        </span>
        &nbsp;&nbsp;
        {/if}
          
        <span class="price_caption">
          {\'Цена:\'|ftext}
        </span>
        
        <span class="price">
          {$product.price} {$currency.sign}
        </span>
                        
        {if $product.old_price}             
          <span class="price_caption">
            &nbsp;&nbsp;{\'Старая цена:\'|ftext}
          </span>
          
          <span class="price_old">
            {$product.old_price} {$currency.sign}
          </span>       
        {/if}          
      </div>
      <div style="clear:both;width:100%;text-align:right;">
        <a href="javascript: addToCart(\'{$product.id}\')">
          <img style="text-a;ign:right" alt="" src="{\'/img/buy.png\'|ftext}" border="0" />
        </a>
        <input type="hidden" style="width:20px" value="1" id="ind{$product.id}" name="ind{$product.id}" />
      </div>
      
      <div style="clear:both;text-align:right;" id="inShop{$product.id}">
      </div>      
 </div>
    
    <script type="text/javascript">
      $(document).ready(showProductAded({
        $product.id}
        ));
    </script>

    <div style="clear:both;height:10px;width:100%;">
    </div>    
    <div style="clear:both;height:1px;width:100%;background-color:#e1e5e8">
    </div>    
    <div style="clear:both;height:5px;width:100%;">
    </div>    
  {/foreach}
</div>

  <div style="clear:left;float:left;margin-top:5px;width:30%;">
    {\'Показывать товаров по\'|ftext}&nbsp; 
    <a {if $smarty.session.records_for_products_page==5}class="step_selected"{else}class="step"{/if} href="?category_id={$category.id}&for_page=5">5</a>/ 
    <a {if $smarty.session.records_for_products_page==10}class="step_selected"{else}class="step"{/if} href="?category_id={$category.id}&for_page=10">10</a>/ 
    <a {if $smarty.session.records_for_products_page==15}class="step_selected"{else}class="step"{/if} href="?category_id={$category.id}&for_page=15">15</a>
  </div>
  <div style="float:left;width:70%;margin-top:5px;text-align:right;">
    {\'Страница:\'|ftext}
    {if $pages.page_selected>1}
    <a class="step" href="?category_id={$category.id}&page=1">&lt;&lt;</a>
    &nbsp; 
    <a class="step" href="?category_id={$category.id}&page={$pages.page_selected-1}">&lt;</a>
    {/if}
    &nbsp;&nbsp;
    {section name="pages" start=1 loop=$pages.page_count+1} 
    <a {if $smarty.section.pages.index==$pages.page_selected}class="step_selected"{else}class="step"{/if} href="{$pageInfo.name}?category_id={$category.id}&page={$smarty.section.pages.index}">
      {$smarty.section.pages.index}
    </a>
    &nbsp;
    {/section}
    {if $pages.page_selected<$pages.page_count}
    <a class="step" href="?category_id={$category.id}&page={$pages.page_selected+1}">&gt;</a>
    &nbsp; 
    <a class="step" href="?category_id={$category.id}&page={$pages.page_count}">&gt;&gt;</a>
    {/if}
  </div>
{else}
	<h1>{\'В данной категории нет товаров\'|ftext}</h1>
{/if}
</div>',
          'loaded_name' => 'show_list.tpl',
          'sort_index' => '1010',
          'block_name' => 'Products',
        ),
      ),
    ),
    5 => 
    array (
      'id' => '6',
      'module_id' => '1',
      'type' => '2',
      'name' => 'YML',
      'description' => 'Вывод YML',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '5',
      'loaded_name' => 'YML',
      'sort_index' => '1055',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '18',
          'block_id' => '6',
          'name' => 'show_yml.tpl',
          'description' => 'Вывод YML-файла',
          'content' => '<?xml version="1.0" encoding="utf-8"?>
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
</yml_catalog>',
          'loaded_name' => 'show_yml.tpl',
          'sort_index' => '1546',
          'block_name' => 'YML',
        ),
      ),
    ),
    6 => 
    array (
      'id' => '7',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Shopcart',
      'description' => 'Корзина товаров',
      'act_variable' => 'cdo',
      'act_method' => 'post',
      'url_get_vars' => 'Result_pay
Success_pay
Fail_pay',
      'general_table_id' => NULL,
      'loaded_name' => 'Shopcart',
      'sort_index' => '607',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '15',
          'block_id' => '7',
          'name' => 'mailOrderRegSubject',
          'value' => 'Подтверждение регистрации на сайте',
          'description' => 'Тема сообщения, которое высылается автоматически зарегистрированному пользователю для подтверждения регистрации',
          'edit_s_type_id' => '1',
          'loaded_name' => 'mailOrderRegSubject',
        ),
        1 => 
        array (
          'id' => '16',
          'block_id' => '7',
          'name' => 'sendOrderToEmail',
          'value' => '',
          'description' => 'Email-адрес, куда отсылаются заказы',
          'edit_s_type_id' => '1',
          'loaded_name' => 'sendOrderToEmail',
        ),
        2 => 
        array (
          'id' => '17',
          'block_id' => '7',
          'name' => 'mailOrderSubject',
          'value' => 'Заказ товара №',
          'description' => 'Тема сообщения, которое высылается клиенту и администратору, как уведомление о новом заказе',
          'edit_s_type_id' => '1',
          'loaded_name' => 'mailOrderSubject',
        ),
        3 => 
        array (
          'id' => '18',
          'block_id' => '7',
          'name' => 'receipt_postavshik',
          'value' => '',
          'description' => 'Товарный чек. Поставщик:',
          'edit_s_type_id' => '1',
          'loaded_name' => 'receipt_postavshik',
        ),
        4 => 
        array (
          'id' => '19',
          'block_id' => '7',
          'name' => 'receipt_rashetniy_shet',
          'value' => '',
          'description' => 'Товарный чек. Расчётный счёт:',
          'edit_s_type_id' => '1',
          'loaded_name' => 'receipt_rashetniy_shet',
        ),
        5 => 
        array (
          'id' => '20',
          'block_id' => '7',
          'name' => 'receipt_BIK',
          'value' => '',
          'description' => 'Товарный чек. БИК:',
          'edit_s_type_id' => '1',
          'loaded_name' => 'receipt_BIK',
        ),
        6 => 
        array (
          'id' => '21',
          'block_id' => '7',
          'name' => 'receipt_INN',
          'value' => '',
          'description' => 'Товарный чек. ИНН:',
          'edit_s_type_id' => '1',
          'loaded_name' => 'receipt_INN',
        ),
        7 => 
        array (
          'id' => '22',
          'block_id' => '7',
          'name' => 'receipt_uridicheskiy_address',
          'value' => '',
          'description' => 'Товарный чек. Юр. адрес:',
          'edit_s_type_id' => '1',
          'loaded_name' => 'receipt_uridicheskiy_address',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '19',
          'block_id' => '7',
          'name' => 'message.tpl',
          'description' => 'Сообщение о заказе пользователю ',
          'content' => 'Здравствуйте, {$name} {$otchestvo}.<br>
Вы сделали заказ в интернет-магазине <a href="{$smarty.const.SETTINGS_HTTP_HOST}">«{$host}»</a>
<br/>
Номер заказа: № <b>{$order_number}</b><br/>
Дата заказа: <b>{$created}</b>
<br/>
<br/>

<table style="width:100%;background-color:#c8c8c8" border="0" cellspacing=\'1\' cellpadding=\'5\'>
  <tr style="background-color:#e1e5e8">
    <td style="width:60%" align="left"><b>{\'Наименование товара\'|ftext}</b></td>
    <td style="width:10%" align="center"><b>{\'Кол-во\'|ftext}</b></td>
    <td style="width:10%" align="center"><b>{\'Цена\'|ftext}</b></td>
    <td style="width:10%" align="center"><b>{\'Сумма\'|ftext}</b></td>
  </tr>
  {foreach name="products" from=$products item=item}
  <tr style="background-color:ffffff" id="str_{$item.id}">
    <td align=\'left\' valign=\'midle\'>{$item.caption}
    	<br/>
      {\'Артикул:\'|ftext} {$item.article}
    </td>
    <td align="center">{$item.count}</td>
    <td align="center">{$item.price} {$currency.sign}</td>
    <td align="center">{$item.summ} {$currency.sign}</td>
  </tr>
  {/foreach}
</table>

<table align="center" border=\'0\' cellpadding=\'0\' cellspacing=\'0\' style="width:100%">
  <tr>
    <td align="right">
    <table border=\'0\' cellspacing=\'0\' cellpadding=\'5\'>
        <tr>
          <td align=\'right\' valign=\'middle\'><b>{\'Сумма:\'|ftext}</b></td>
          <td align=\'left\' valign=\'middle\'>{$total_summ_dustly} {$currency.sign}</td>
        </tr>
        <tr>
          <td align=\'right\' valign=\'middle\'><b>{\'Накопительная скидка:\'|ftext}</b></td>
          <td align=\'left\' valign=\'middle\'>{$discount_percent}% ({$discount} {$currency.sign})</td>
        </tr>
          <tr>
            <td align=\'right\' valign=\'middle\'><b>{\'Оптовая скидка:\'|ftext}</b></td>
            <td align=\'left\' valign=\'middle\'>{$discount_by_q_summ} {$currency.sign}</td>
          </tr>        
        <tr>
          <td align=\'right\' valign=\'middle\'><b>{\'Итого без доставки:\'|ftext}</b></td>
          <td align=\'left\' valign=\'middle\'><span style="color:#336600; font-weight:bold"> {$total_summ} {$currency.sign}</span></td>
        </tr>
        <tr>
          <td align="right" colspan="100%"><span style="font-size:9px">{\'*Стоимость доставки отобразится в вашем личном кабинете\'|ftext}</span></td>
        </tr>
        <tr>
          <td align=\'right\' valign=\'center\' colspan="2"> {\'<br/>Если товар временно отсутствует на складе, с Вами свяжется наш менеджер.<br>Спасибо за заказ.<br/>
            <br/>
            С уважением, администратор.\'|ftext} </td>
        </tr>
      </table>
     </td>
  </tr>
</table>',
          'loaded_name' => 'message.tpl',
          'sort_index' => '1024',
          'block_name' => 'Shopcart',
        ),
        1 => 
        array (
          'id' => '20',
          'block_id' => '7',
          'name' => 'sendResult.tpl',
          'description' => 'Результат отправки заказа',
          'content' => '<div fastedit::>
  <br/>
  <h3>
    <b>
      {if $res}
      Мы приняли Ваш заказ, спасибо.
      <br/>
      <br/>
      НОМЕР ВАШЕГО ЗАКАЗА: №{$order_number}
      {else}
      Собщение не отправлено. Технические неполадки.
      {/if} 
    </b>    
  </h3>
  <br/>
  <br/>
</div>',
          'loaded_name' => 'sendResult.tpl',
          'sort_index' => '1025',
          'block_name' => 'Shopcart',
        ),
        2 => 
        array (
          'id' => '21',
          'block_id' => '7',
          'name' => 'message_to_admin.tpl',
          'description' => 'Сообщение о заказе администратору',
          'content' => '<table style="width:100%;background-color:#c8c8c8" align=\'center\'  border=\'0\' cellspacing=\'1\' cellpadding=\'5\'>
  <tr style="background-color:#e1e5e8">
    <td style="width:60%" align="left"><b>{\'Наименование товара\'|ftext}</b></td>
    <td style="width:10%" align="center"><b>{\'Кол-во\'|ftext}</b></td>
    <td style="width:10%" align="center"><b>{\'Цена\'|ftext}</b></td>
    <td style="width:10%" align="center"><b>{\'Сумма\'|ftext}</b></td>
  </tr>
  {foreach name="products" from=$products item=item}
  <tr style="background-color:#ffffff" id="str_{$item.id}">
    <td align=\'left\' valign=\'center\'>{$item.caption}<br/>
      {\'Артикул:\'|ftext} {$item.article}</td>
    <td align="center">{$item.count}</td>
    <td align="center">{$item.price} {$currency.sign}</td>
    <td align="center">{$item.summ} {$currency.sign}</td>
  </tr>
  {/foreach}
</table>

<table  border=\'0\' cellpadding=\'0\' cellspacing=\'0\' style="width:100%">
  <tr>
    <td align="center">
    <table align=\'right\' border=\'0\' cellspacing=\'0\' cellpadding=\'5\'>
        <tr>
          <td align=\'right\' valign="middle"><b>{\'Сумма:\'|ftext}</b></td>
          <td align=\'left\' valign="middle">{$total_summ_dustly} {$currency.sign}</td>
        </tr>
        <tr>
          <td align=\'right\' valign="middle"><b>{\'Накопительная скидка:\'|ftext}</b></td>
          <td align=\'left\' valign="middle">{$discount_percent}% ({$discount} {$currency.sign})</td>
        </tr>
          <tr>
            <td align=\'right\' valign="middle"><b>{\'Оптовая скидка:\'|ftext}</b></td>
            <td align=\'left\' valign="middle">{$discount_by_q_summ} {$currency.sign}</td>
          </tr>        
        <tr>
          <td align=\'right\' valign="middle"><b>{\'Итого без доставки:\'|ftext}</b></td>
          <td align=\'left\' valign="middle"><span style="color:#336600; font-weight:bold"> {$total_summ} {$currency.sign}</span></td>
        </tr>
        <tr>
          <td align="right" colspan="100%"><span style="font-size:9px">{\'*Стоимость доставки отобразится в вашем личном кабинете\'|ftext}</span></td>
        </tr>
    </table>
   </td>
  </tr>
</table>

<table style="width:500px;background-color:#e1e5e8"  border=\'0\' cellpadding=\'5\' cellspacing=\'1\'>
  <tr style="background-color:white">
    <td colspan="2" align="center" valign="top" style="background-color:#ffffff"><b>{\'КОНТАКТНЫЕ ДАННЫЕ\'|ftext}</b></td>
  </tr>
  <tr style="background-color:white" >
    <td  align="left" valign="middle">{\'Ваша фамилия:\'|ftext}</td>
    <td valign="top">{$second_name}</td>
  </tr>
  <tr style="background-color:white" >
    <td  align="left" valign="middle">{\'Ваше имя:\'|ftext}</td>
    <td valign="top">{$name}</td>
  </tr>
  <tr style="background-color:white">
    <td  align="left" valign="middle">{\'Ваше отчество:\'|ftext}</td>
    <td valign="top">{$otchestvo}</td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{\'Юридический статус:\'|ftext}</td>
    <td valign="top">
    {$ur_status_id_caption}    	
    </td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{\'Ваш телефон:\'|ftext}</td>
    <td valign="top">{$phone}</td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{\'Ваш e-mail:\'|ftext}&nbsp;&nbsp;</td>
    <td valign="top">{$email}</td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{\'Почтовый индекс:\'|ftext}&nbsp;&nbsp;</td>
    <td valign="top">{$mail_index}</td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{\'Почтовый адрес доставки:\'|ftext}</td>
    <td valign="top">{$address_of_delivery}</td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{\'Доставка:\'|ftext}</td>
    <td valign="top">
    {foreach from=$delivery item=item}
    	{if $item.id==$delivery_id}
    		{$item.name|ftext}
    	{/if}
    {/foreach}
    </td>
  </tr>
  <tr style="background-color:white">
    <td align="left" valign="middle">{\'Вариант оплаты:\'|ftext}</td>
    <td valign="top">
    {foreach from=$pay_systems item=item}
    	{if $item.id==$pay_system_id}
    		{$item.caption|ftext}
	    {/if}
    {/foreach}
    </td>
  </tr>
</table>',
          'loaded_name' => 'message_to_admin.tpl',
          'sort_index' => '1182',
          'block_name' => 'Shopcart',
        ),
        3 => 
        array (
          'id' => '22',
          'block_id' => '7',
          'name' => 'reg_message.tpl',
          'description' => 'Сообщение о подтверждении регистрации пользователя',
          'content' => 'Здравствуйте {$name} {$otchestvo} !
<br/>
Вы зарегистрировались на сайте интернет-магазина 
<a href="{$smarty.const.SETTINGS_HTTP_HOST}">
  «{$host}»
</a>
<br/>
Ваш логин: {$email}
<br/>
Ваш пароль: {$password}
<br/>
Для подтверждения правильности ввода e-mail перейдите, пожалуйста, по этой ссылке:
<br>
<a href="{$smarty.const.SETTINGS_HTTP_HOST}/registratsiya?act=confirm_r&id={$id}&email={$smarty.post.email}">
  подтвердить правильность ввода e-mail
</a>
<br/>
<br/>
С уважением, администрация интернет-магазина «{$host}»',
          'loaded_name' => 'reg_message.tpl',
          'sort_index' => '1183',
          'block_name' => 'Shopcart',
        ),
        4 => 
        array (
          'id' => '23',
          'block_id' => '7',
          'name' => 'show_list.tpl',
          'description' => 'Список товаров в корзине',
          'content' => '<div fastedit::>
{if $products}
  <p>
    Оплата заказа осуществляется в валюте 
    <b>
      «{$currency_general.name}»
    </b>
    независимо от выбранной валюты на сайте
  </p>
  <br/>
<form name="data" id="data" action="/shopcart" method="post">
  <p>
    <input type="hidden" name="cdo" value="orderForm">
  </p>
  <table style="width:100%;background-color:#e1e5e8" border=\'0\' cellspacing="1" cellpadding="3">
    <tr style="background-color:white">
      <td align="center" style="width:20%" align="center"><span color="#F98803"><b>{\'Фото\'|ftext}</b></span></td>
      <td style="width:35%" align="center"><span color="#F98803"><b>{\'Название товара\'|ftext}</b></span></td>
      <td style="width:10%" align="center"><span color="#F98803"><b>{\'Количество\'|ftext}</b></span></td>
      <td style="width:15%" align="center"><span color="#F98803"><b>{\'Цена\'|ftext}</b></span></td>
      <td style="width:15%" align="center"><span color="#F98803"><b>{\'Сумма\'|ftext}</b></span></td>
      <td style="width:5%" align="center"><a href="javascript:if (confirm(\'Вы действительно хотите очистить корзину?\')) location.href=\'shopcart?empty=true\';"><img alt="" src=\'/modules/InternetShop/img/del.gif\' width=\'9px\' height=\'9px\' border=\'0\' title="{\'Удалить весь товар\'|ftext}" /></a></td>
    </tr>
    {foreach name="products" from=$products item=item}
    <tr style="background-color:#ffffff" id="str_{$item.id}" fastedit:{$table_name}:{$item.id}>
      <td align="center">
        <a href="internet-shop?act=more&category_id={$item.category_id}&id={$item.id}"><img alt="{$item.caption}" border="0" src="{if $item.image}/modules/InternetShop/management/storage/images/products/image/{$item.id}/preview/{$item.image}{else}/modules/InternetShop/img/nopic.gif{/if}" /></a>
        </td>
      <td align="center" {$item.id}>      
        <a href="internet-shop?act=more&category_id={$item.category_id}&id={$item.id}">{$item.caption}{if $item.article}
        <br/>
        {\'Артикл:\'|ftext} {$item.article}{/if}</a>
        </td>
      <td align="center"><input class="numbers_only" id="count{$item.id}" name="count{$item.id}" onchange="updateCartForm(false)" style="width:50px" value="{$item.count}" /></td>
      <td align="center"><span id="pstoim_{$item.id}">{$item.price}</span> {$currency.sign}</td>
      <td align="center"><span id="psum_{$item.id}">{$item.summ}</span> {$currency.sign}</td>
      <td align="center"><a href="javascript:deleteFromCart({$item.id})"><img alt="" src=\'/modules/InternetShop/img/del.gif\' width="9px" height="9px" border=\'0\' title="{\'Удалить товар\'|ftext}" /></a></td>
    </tr>
    {/foreach}
  </table>
  <table align="center" border=\'0\' cellpadding=\'0\' cellspacing=\'0\' style="width:100%">
    <tr>
      <td align="center" valign=\'top\'>
      	<br/>
        <table align=\'right\' border=\'0\' cellspacing=\'0\' cellpadding=\'5\'>
          <tr>
            <td align=\'right\' valign=\'middle\'><b>{\'Сумма:\'|ftext}</b></td>
            <td align=\'left\' valign=\'middle\'><span id="shopcart_total_summ">{$total_summ_dustly}</span> {$currency.sign}</td>
          </tr>
          <tr>
            <td align=\'right\' valign=\'middle\'><b>{\'Накопительная скидка:\'|ftext}</b></td>
            <td align=\'left\' valign=\'middle\'>{$discount_percent}% (<span id="shopcart_discount">{$discount}</span> {$currency.sign})</td>
          </tr>
          <tr>
            <td align=\'right\' valign=\'middle\'><b>{\'Оптовая скидка:\'|ftext}</b></td>
            <td align=\'left\' valign=\'middle\'><span id="shopcart_discount_by_q_summ">{$discount_by_q_summ}</span> {$currency.sign}</td>
          </tr>          
          <tr>
            <td align=\'right\' valign=\'middle\'><b>{\'Итого к оплате:\'|ftext}</b></td>
            <td align=\'left\' valign=\'middle\'><span style="color:#336600; font-weight:bold" id="shopcart_total">{$total_summ}</span><span style="color:#336600;font-weight:bold"> {$currency.sign}</span> *</td>
          </tr>
          <tr>
            <td colspan=\'2\' align=\'right\' valign=\'middle\'><span style="font-size:12px">{\'* В общую стоимость не включена стоимость доставки\'|ftext}</span></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</form>


<script type="text/javascript">
	var discount_percent={$discount_percent};
</script> 
<br/>
<br/>

{if $errors}  
  <center>
    <div>      
      {foreach from=$errors item=error}
      <p style="color:red">
        {$error|ftext}
      </p>
      {/foreach}
    </div>    
  </center> 
{/if}

<table align="center" border=\'0\' cellpadding=\'0\' cellspacing=\'0\' style="width:100%">
  <tr>
    <td align="center">     
      <form id="formdata" style="margin-top:0px"  action="/shopcart" method=\'post\' name=\'loadresume\' id="loadresume">      
       <p>
         <input type="hidden" name="cdo" value="sendOrder"/>
       </p>
      <table align="center" border=\'0\' cellpadding=\'5\' cellspacing=\'0\' style="width:600px">
        <tr style="height:30px">
          <td colspan=\'100%\' align="left" valign="middle"><span style="color:#5a7bca"><b>*</b></span>{\' - поле обязательно для заполнения\'|ftext}</td>
        </tr>
        <tr style="height:2px">
          <td colspan=\'100%\' align="right" valign="top" style="background-color:#ffffff;"  class="top"></td>
        </tr>
        <tr>
          <td style="width:30%" align="left" valign="middle">{\'Ваша фамилия:\'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top"><input name="second_name" id="second_name" value="{$second_name}" style="width:100%" /></td>
        </tr>
        <tr>
          <td style="width:30%" align="left" valign="middle">{\'Ваше имя:\'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top"><input name="name" id="name" value="{$name}" style="width:100%" /></td>
        </tr>
        <tr>
          <td style="width:30%" align="left" valign="middle">{\'Ваше отчество:\'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top"><input name="otchestvo" id="otchestvo" value="{$otchestvo}" style="width:100%" /></td>
        </tr>
        <tr>
          <td align="left" valign="middle">{\'Юридический статус:\'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top">
           <select name="ur_status_id" style="width:100%">
           {foreach from=$ur_statuses item=item}
              <option {if $ur_status_id==$item.id} selected {/if} value="{$item.id}">{$item.caption|ftext}</option>
              {/foreach}             
            </select>
           </td>
        </tr>
        <tr>
          <td align="left" valign="middle">{\'Ваш телефон:\'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top"><input name="phone" id="phone" value="{$phone}" style="width:100%" /></td>
        </tr>
        <tr>
          <td align="left" valign="middle">{\'Ваш e-mail:\'|ftext}<span style="color:#5a7bca">*</span>&nbsp;&nbsp;</td>
          <td valign="top"><input name="email" id="email" value="{$email}" style="width:100%" /></td>
        </tr>
        <tr>
          <td align="left" valign="middle">{\'Почтовый индекс:\'|ftext}<span style="color:#5a7bca">*</span>&nbsp;&nbsp;</td>
          <td valign="top"><input name="mail_index" id="mail_index" value="{$mail_index}" style="width:100%" /></td>
        </tr>
        <tr>
          <td align="left" valign="middle">{\'Почтовый адрес доставки:\'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top"><input name="address_of_delivery" id="address_of_delivery" value="{$address_of_delivery}" style="width:100%" /></td>
        </tr>
        <tr>
          <td align="left" valign="middle">{\'Доставка:\'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top">
          	<select name="delivery_id" style="width:100%">              
			{foreach from=$delivery item=item}	
              <option {if $item.id==$delivery_id} selected {/if} value="{$item.id}">{$item.name|ftext}</option>              
			{/foreach}		
            </select>
           </td>
        </tr>
        <tr>
          <td align="left" valign="middle">{\'Вариант оплаты:\'|ftext}<span style="color:#5a7bca">*</span></td>
          <td valign="top">
          	<select name="pay_system_id" style="width:100%">              
				{foreach from=$pay_systems item=item}
    	          <option {if $item.id==$pay_system_id} selected {/if} value="{$item.id}">{$item.caption|ftext}</option>              
				{/foreach}		
            </select>
          </td>
        </tr>
        <tr style="height:25px">
          <td valign="top" align="left">
            &nbsp;
          </td>
          <td align="right" valign="bottom">
            <input  type="submit" class="button" value="{\'ОФОРМИТЬ ЗАКАЗ\'|ftext}" onclick="updateCartForm(true)" />
          </td>
        </tr>
      </table>
      </form>
     </td>
  </tr>
</table>
{else}
  <h3 style="text-align:center">
    {\'Ваша корзина пуста!\'|ftext}
  </h3>
{/if} 
</div>',
          'loaded_name' => 'show_list.tpl',
          'sort_index' => '1022',
          'block_name' => 'Shopcart',
        ),
        5 => 
        array (
          'id' => '24',
          'block_id' => '7',
          'name' => 'robokassa_pay.tpl',
          'description' => 'Форма оплаты через Robokassa',
          'content' => '<span fastedit::>
<h2>Онлайн оплата заказа №{$order_info.id}</h2>
<script type="text/javascript" src=\'https://merchant.roboxchange.com/Handler/MrchSumPreview.ashx?MrchLogin={$paysystem_info.login}&OutSum={$order_info.total_summ}&InvId={$order_info.id}&IncCurrLabel=WMRM&Desc=Оплата+заказа+№{$order_info.id}&SignatureValue={$paysystem_info.crc}&Culture={$paysystem_info.culture}&Encoding=utf-8&sCulture=ru\'></script>
</span>',
          'loaded_name' => 'robokassa_pay.tpl',
          'sort_index' => '1552',
          'block_name' => 'Shopcart',
        ),
        6 => 
        array (
          'id' => '25',
          'block_id' => '7',
          'name' => 'fail_pay.tpl',
          'description' => 'Результат не успешного платежа',
          'content' => '<span fastedit::>
<h2>Не удалось оплатить заказ №{$order_id}</h2>
<p>Для уточнения подробностей свяжитесь с нашим менеджером</p>
</span>
',
          'loaded_name' => 'fail_pay.tpl',
          'sort_index' => '1554',
          'block_name' => 'Shopcart',
        ),
        7 => 
        array (
          'id' => '26',
          'block_id' => '7',
          'name' => 'success_pay.tpl',
          'description' => 'Результат успешного платежа',
          'content' => '<h2 fastedit::>
  Заказ №{$order_id} успешно оплачен!
</h2>',
          'loaded_name' => 'success_pay.tpl',
          'sort_index' => '1553',
          'block_name' => 'Shopcart',
        ),
        8 => 
        array (
          'id' => '27',
          'block_id' => '7',
          'name' => 'interkassa_pay.tpl',
          'description' => 'Оплата через Interkassa',
          'content' => '<form fastedit:: name="payment" action="https://interkassa.com/lib/payment.php" method="post" enctype="application/x-www-form-urlencoded" accept-charset="utf-8">
<input type="hidden" name="ik_shop_id" value="{$paysystem_info.shop_id}">
<input type="hidden" name="ik_payment_amount" value="{$order_info.total_summ}">
<input type="hidden" name="ik_paysystem_alias" value="">

<input type="hidden" name="ik_status_url" value="{$smarty.const.SETTINGS_HTTP_HOST}/{$pageInfo.name}?act=Result_pay">
<input type="hidden" name="ik_status_method" value="POST">

<input type="hidden" name="ik_success_url" value="{$smarty.const.SETTINGS_HTTP_HOST}/{$pageInfo.name}?act=Success_pay">
<input type="hidden" name="ik_success_method" value="POST">

<input type="hidden" name="ik_fail_url" value="{$smarty.const.SETTINGS_HTTP_HOST}/{$pageInfo.name}?act=Fail_pay">
<input type="hidden" name="ik_fail_method" value="POST">

<input type="hidden" name="ik_fees_payer" value="1">

<input type="hidden" name="ik_payment_id" value="{$order_info.id}">
<input type="hidden" name="ik_payment_desc" value="Оплата заказа №{$order_info.id}">
<input class="button" type="submit" name="process" value="Оплатить заказ №{$order_info.id}">
</form>',
          'loaded_name' => 'interkassa_pay.tpl',
          'sort_index' => '1555',
          'block_name' => 'Shopcart',
        ),
        9 => 
        array (
          'id' => '28',
          'block_id' => '7',
          'name' => 'webmoney_pay.tpl',
          'description' => 'Форма оплаты через Webmoney',
          'content' => '<form fastedit:: id=pay name=pay method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp"> 
  <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{$order_info.total_summ}">
  <input type="hidden" name="LMI_PAYMENT_DESC_BASE64" value="{$description}">
  <input type="hidden" name="LMI_PAYMENT_NO" value="{$order_info.id}">
  <input type="hidden" name="LMI_PAYEE_PURSE" value="{$paysystem_info.purse}">
 <input class="button" type="submit" value="Оплатить заказ №{$order_info.id}">
</form> ',
          'loaded_name' => 'webmoney_pay.tpl',
          'sort_index' => '1972',
          'block_name' => 'Shopcart',
        ),
        10 => 
        array (
          'id' => '29',
          'block_id' => '7',
          'name' => 'yandex_pay.tpl',
          'description' => 'Форма оплаты через YandexMoney',
          'content' => '<form fastedit:: method="post" action="http://money.yandex.ru/select-wallet.xml">
<input type="hidden" name="TargetCurrency" value="643">
<input type="hidden" name="currency" value="643">
<input type="hidden" name="wbp_InactivityPeriod" value="2">
<input type="hidden" name="wbp_ShopAddress" value="wn1.paycash.ru:8828">
<input type="hidden" name="wbp_Version" value="1.0">
<input type="hidden" name="BankID" value="100">
<input type="hidden" name="TargetBankID" value="1001">
<input type="hidden" name="PaymentTypeCD" value="PC">
{if $type==0}
<input type="hidden" name="ShopID" value="{$paysystem_info.shop_id}">
<input type="hidden" name="scid" value="{$paysystem_info.scid}">
{/if}

<input type="hidden" name="CustomerNumber" value="{$order_info.id}">
<input type="hidden" name="Sum" value="{$order_info.total_summ}">
<input type="hidden" name="CustName" value="{$user_info.second_name} {$user_info.name} {$user_info.otchestvo}">
<input type="hidden" name="CustAddr" value="{$user_info.address_of_delivery}">
<input type="hidden" name="CustEMail" value="{$user_info.email}">

<input type="hidden" name="OrderDetails" value="Оплата заказа №{$order_info.id}">
<input class="button" type="submit" value="Оплатить заказ №{$order_info.id} через Яндекс.Кошелек">
</form>


{if $type==0}
<form action="http://127.0.0.1:8129/wallet" method="POST">
<input type="hidden" name="wbp_Version" value="2">
<input type="hidden" name="wbp_MessageType" value="DirectPaymentIntoAccountRequest">
<input type="hidden" name="wbp_ShopAddress" value="{$paysystem_info.email}">
<input type="hidden" name="wbp_accountid" value="{$paysystem_info.purse}">
<input type="hidden" name="wbp_currencyamount" value="643;{$order_info.total_summ}">
<input type="hidden" name="wbp_ShopErrorInfo" value="Деньги не отправлены">
<input type="hidden" name="wbp_shortdescription" value="{$order_info.id}">
<input type="hidden" name="wbp_template_1" value="Оплата заказа №{$order_info.id}">
<input class="button" type="submit" name="submit" value="Оплатить заказ №{$order_info.id} через «Интернет.Кошелек» на моем компьютере" >
<p style="font-size:11px">{\'Проверьте, не забыли ли вы запустить программу.\'|ftext}</p>
</form>

{/if}',
          'loaded_name' => 'yandex_pay.tpl',
          'sort_index' => '1973',
          'block_name' => 'Shopcart',
        ),
      ),
    ),
    7 => 
    array (
      'id' => '8',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Caption',
      'description' => 'Заголовок содержимого',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Caption',
      'sort_index' => '610',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '23',
          'block_id' => '8',
          'name' => 'captionDefault',
          'value' => '',
          'description' => 'Заголовок по умолчанию',
          'edit_s_type_id' => '1',
          'loaded_name' => 'captionDefault',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '30',
          'block_id' => '8',
          'name' => 'show_caption.tpl',
          'description' => 'Вывод заголовка содержимого',
          'content' => '{if $caption}
<span fastedit:{$table_name}:{$id}>{$caption}</span>
{else}
{\'Поиск товаров\'|ftext}
{/if}',
          'loaded_name' => 'show_caption.tpl',
          'sort_index' => '1324',
          'block_name' => 'Caption',
        ),
      ),
    ),
    8 => 
    array (
      'id' => '9',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Title',
      'description' => 'Title - заголовок',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Title',
      'sort_index' => '611',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '24',
          'block_id' => '9',
          'name' => 'catMapTitleDefault',
          'value' => '',
          'description' => 'Title - заголовок по умолчанию для карты категорий',
          'edit_s_type_id' => '1',
          'loaded_name' => 'catMapTitleDefault',
        ),
      ),
      'templates' => 
      array (
      ),
    ),
    9 => 
    array (
      'id' => '10',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Metakeywords',
      'description' => 'Meta - ключевые слова',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Metakeywords',
      'sort_index' => '612',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '25',
          'block_id' => '10',
          'name' => 'catMapMetakeywordsDefault',
          'value' => '',
          'description' => 'Metakeywords - по умолчанию для карты категорий',
          'edit_s_type_id' => '1',
          'loaded_name' => 'catMapMetakeywordsDefault',
        ),
      ),
      'templates' => 
      array (
      ),
    ),
    10 => 
    array (
      'id' => '11',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Metadescription',
      'description' => 'Meta - описание',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'Metadescription',
      'sort_index' => '613',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '26',
          'block_id' => '11',
          'name' => 'catMapMetadescriptionDefault',
          'value' => '',
          'description' => 'Metadescription - по умолчанию для карты категорий',
          'edit_s_type_id' => '1',
          'loaded_name' => 'catMapMetadescriptionDefault',
        ),
      ),
      'templates' => 
      array (
      ),
    ),
    11 => 
    array (
      'id' => '12',
      'module_id' => '1',
      'type' => '2',
      'name' => 'ProductsNew',
      'description' => 'Новинки',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '5',
      'loaded_name' => 'ProductsNew',
      'sort_index' => '616',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '27',
          'block_id' => '12',
          'name' => 'records_for_page_new',
          'value' => '10',
          'description' => 'Выводить новинок на страницу',
          'edit_s_type_id' => '1',
          'loaded_name' => 'records_for_page_new',
        ),
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '31',
          'block_id' => '12',
          'name' => 'show_list.tpl',
          'description' => 'Вывод новинок',
          'content' => '<div fastedit::>
{if $products}
<h2>{\'Новые поступления товаров\'|ftext}</h2>

  <div style="float:left;margin-top:3px;width:30%;height:23px">
    {\'Показывать товаров по\'|ftext}&nbsp; 
    <a {if $smarty.session.records_for_products_page==5}class="step_selected"{else}class="step"{/if} href="?for_page=5">5</a>/ 
    <a {if $smarty.session.records_for_products_page==10}class="step_selected"{else}class="step"{/if} href="?for_page=10">10</a>/ 
    <a {if $smarty.session.records_for_products_page==15}class="step_selected"{else}class="step"{/if} href="?for_page=15">15</a>
  </div>
  <div style="float:left;width:70%;text-align:right;height:23px">
    {\'Страница:\'|ftext}
    {if $pages.page_selected>1}
    <a class="step" href="?page=1">&lt;&lt;</a>
    &nbsp; 
    <a class="step" href="?page={$pages.page_selected-1}">&lt;</a>
    {/if}
    &nbsp;&nbsp;
    {section name="pages" start=1 loop=$pages.page_count+1} 
    <a {if $smarty.section.pages.index==$pages.page_selected}class="step_selected"{else}class="step"{/if} href="{$pageInfo.name}?page={$smarty.section.pages.index}">
      {$smarty.section.pages.index}
    </a>
    &nbsp;
    {/section}
    {if $pages.page_selected<$pages.page_count}
    <a class="step" href="?page={$pages.page_selected+1}">&gt;</a>
    &nbsp; 
    <a class="step" href="?page={$pages.page_count}">&gt;&gt;</a>
    {/if}
  </div>

  <div style="clear:both;height:1px;width:100%;background-color:#e1e5e8">
  </div>  
  {foreach name="cat" from=$products item=product}  
  <div fastedit:{$table_name}:{$product.id} style="clear:both;width:100%;">
    <br/>    
    <div style="float:left;width:150px;">
      <a href="internet-shop?act=more&category_id={$product.category_id}&id={$product.id}">
        <img alt="{$product.caption}" title="{$product.caption}" border="0" src="/{if $product.image}modules/InternetShop/management/storage/images/products/image/{$product.id}/preview/{$product.image}{else}modules/InternetShop/img/nopic.gif{/if}" />
      </a>
      {if $settings.show_comments}     
      <div style="clear:left;margin-left:20px;width:110px;height:20px;background-image:url(\'/modules/InternetShop/img/stars_null.png\');background-repeat:repeat-x;">
          <div style="width:{if $product.comments_points_width}{$product.comments_points_width}{else}0{/if}px;height:20px;background-image:url(\'/modules/InternetShop/img/stars.png\');background-repeat:repeat-x;">
          </div>
        </div>
        <span style="margin-left:45px;font-size:11px;color:#966e4e">
          {if $product.comments_count}{$product.comments_count} {\'голосов\'|ftext}{else}{\'нет голосов\'|ftext}{/if}
        </span>     
      {/if}
    </div>
    <div style="float:left;width:25px;">
      &nbsp;
    </div>
    <div style="float:left;width:620px">
      <a class="product_caption" href="internet-shop?act=more&category_id={$product.category_id}&id={$product.id}">
        {$product.caption}
      </a>
      <br/>
      <br/>
      {$product.small_description}
      <br/>            
      <div style="clear:both;white-space:nowrap;width:100%">  
        {if $product.discount_type}              
        <span class="price_caption">
          {\'Скидка:\'|ftext}
        </span>        
        
        <span class="discount">
          {$product.discount}%
        </span>
        &nbsp;&nbsp;
        {/if}
          
        <span class="price_caption">
          {\'Цена:\'|ftext}
        </span>
        
        <span class="price">
          {$product.price} {$currency.sign}
        </span>
                        
        {if $product.old_price}             
          <span class="price_caption">
            &nbsp;&nbsp;{\'Старая цена:\'|ftext}
          </span>
          
          <span class="price_old">
            {$product.old_price} {$currency.sign}
          </span>       
        {/if}          
      </div>
      <div style="clear:both;width:100%;text-align:right;">
        <a href="javascript: addToCart(\'{$product.id}\')">
          <img style="text-a;ign:right" alt="" src="{\'/img/buy.png\'|ftext}" border="0" />
        </a>
        <input type="hidden" style="width:20px" value="1" id="ind{$product.id}" name="ind{$product.id}" />
      </div>
      
      <div style="clear:both;text-align:right;" id="inShop{$product.id}">
      </div>      
 </div>
    
    <script type="text/javascript">
      $(document).ready(showProductAded({
        $product.id}
        ));
    </script>

    <div style="clear:both;height:10px;width:100%;">
    </div>    
    <div style="clear:both;height:1px;width:100%;background-color:#e1e5e8">
    </div>    
    <div style="clear:both;height:5px;width:100%;">
    </div>    
  {/foreach}
</div>

  <div style="clear:left;float:left;margin-top:5px;width:30%;">
    {\'Показывать товаров по\'|ftext}&nbsp; 
    <a {if $smarty.session.records_for_products_page==5}class="step_selected"{else}class="step"{/if} href="?for_page=5">5</a>/ 
    <a {if $smarty.session.records_for_products_page==10}class="step_selected"{else}class="step"{/if} href="?for_page=10">10</a>/ 
    <a {if $smarty.session.records_for_products_page==15}class="step_selected"{else}class="step"{/if} href="?for_page=15">15</a>
  </div>
  <div style="float:left;width:70%;margin-top:5px;text-align:right;">
    {\'Страница:\'|ftext}
    {if $pages.page_selected>1}
    <a class="step" href="?page=1">&lt;&lt;</a>
    &nbsp; 
    <a class="step" href="?page={$pages.page_selected-1}">&lt;</a>
    {/if}
    &nbsp;&nbsp;
    {section name="pages" start=1 loop=$pages.page_count+1} 
    <a {if $smarty.section.pages.index==$pages.page_selected}class="step_selected"{else}class="step"{/if} href="{$pageInfo.name}?page={$smarty.section.pages.index}">
      {$smarty.section.pages.index}
    </a>
    &nbsp;
    {/section}
    {if $pages.page_selected<$pages.page_count}
    <a class="step" href="?page={$pages.page_selected+1}">&gt;</a>
    &nbsp; 
    <a class="step" href="?page={$pages.page_count}">&gt;&gt;</a>
    {/if}
  </div>
{else}
	<h1>{\'В данной категории нет товаров\'|ftext}</h1>
{/if}
</div>',
          'loaded_name' => 'show_list.tpl',
          'sort_index' => '1016',
          'block_name' => 'ProductsNew',
        ),
      ),
    ),
    12 => 
    array (
      'id' => '13',
      'module_id' => '1',
      'type' => '2',
      'name' => 'BreadCrumbs',
      'description' => 'Хлебные крошки',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '4',
      'loaded_name' => 'BreadCrumbs',
      'sort_index' => '798',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '32',
          'block_id' => '13',
          'name' => 'show_list.tpl',
          'description' => 'Вывод хлебных крошек',
          'content' => '{if $categories}
<table fastedit:: style="width:100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>
      {foreach name="categories" from=$categories item=category}
      {if !$smarty.foreach.categories.last}
      <a fastedit:{$categories_table_name}:{$category.id} href="internet-shop?category_id={$category.id}">
        {$category.caption|ftext}
      </a>
      - {else}
      <span fastedit:{$categories_table_name}:{$category.id}>
        {$category.caption|ftext}
      </span>
      {/if}
      {/foreach}
    </td>
  </tr>
</table>
<br/>
{/if}',
          'loaded_name' => 'show_list.tpl',
          'sort_index' => '1126',
          'block_name' => 'BreadCrumbs',
        ),
      ),
    ),
    13 => 
    array (
      'id' => '14',
      'module_id' => '1',
      'type' => '2',
      'name' => 'CategoriesInMenu',
      'description' => 'Категории в меню',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '4',
      'loaded_name' => 'CategoriesInMenu',
      'sort_index' => '799',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '33',
          'block_id' => '14',
          'name' => 'show_list.tpl',
          'description' => 'Категории слева',
          'content' => '{literal} 
<script type="text/javascript">
function openSubCategories(obj_id) {
	var obj=document.getElementById(obj_id);
	
	if (obj.style.display==\'none\') {
		obj.style.display=\'block\';
		}
	else {
		obj.style.display=\'none\';
	}
}
</script> 
{/literal}

<div fastedit::>
<h2 style="margin-top:15px">{\'Каталог товаров\'|ftext}</h2>

{foreach name="categories" from=$categories item=category}
	{if $category.deep==0}
		{if $subItems}
			</div>
		{/if}
		{assign var=\'subItemsCheck\' value=true}
		{assign var=\'subItems\' 		value=false}
		{assign var=\'pred_id\' 		value=$category.id}
		{else}
		{if $subItemsCheck}
			{assign var=\'subItemsCheck\' value=false}
			{assign var=\'subItems\' value=true}
<div id="menuCategories_{$pred_id}" {if $pred_id!=$selected_category_id}style="display:none"{else}style="display:block"{/if}>
		{/if}
	{/if}
  	<div style="margin-left:{$category.deep*15}px">
    <a fastedit:{$categories_table_name}:{$category.id} 
	{if $category.deep==0} 
    	{if $smarty.get.category_id==$category.id} class="shopCategoriesMainSelected" {else} class="shopCategoriesMain" {/if}  
	    onclick="openSubCategories(\'menuCategories_{$category.id}\')"     	
    {else}	
    {if $smarty.get.category_id==$category.id} class="shopCategoriesSupSelected" {else} class="shopCategoriesSup"  {/if}
    {/if} 
    href="{if $category.products_in_category>0}internet-shop?category_id={$category.id}{else}#{/if}">{$category.caption|ftext}{if $category.products_in_category>0} ({$category.products_in_category}){/if}</a>
  </div>  
{/foreach}
</div> ',
          'loaded_name' => 'show_list.tpl',
          'sort_index' => '1127',
          'block_name' => 'CategoriesInMenu',
        ),
      ),
    ),
    14 => 
    array (
      'id' => '15',
      'module_id' => '1',
      'type' => '2',
      'name' => 'CabinetMenu',
      'description' => 'Меню в личном кабинете',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'CabinetMenu',
      'sort_index' => '986',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '34',
          'block_id' => '15',
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
      <a {if $smarty.get.act==\'orders\'} style="font-size:16px;font-weight:bold"{else} style="font-size:16px"{/if} href="?act=orders">
        {\'Мои заказы\'|ftext}
      </a>
    </td>
    <td style="width:10px">
    </td>
    <td>
      <a {if $smarty.get.act==\'help\' || $smarty.get.act==\'help_add_q\'} style="font-size:16px;font-weight:bold"{else} style="font-size:16px"{/if} href="?act=help">
        {\'Техподдержка\'|ftext}
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
      <img alt="" src=\'/modules/InternetShop/img/zero.gif\' width="9px" height="14px" border=\'0\' hspace=\'0\'/>
    </td>
  </tr>
</table>',
          'loaded_name' => 'show_menu.tpl',
          'sort_index' => '1424',
          'block_name' => 'CabinetMenu',
        ),
      ),
    ),
    15 => 
    array (
      'id' => '16',
      'module_id' => '1',
      'type' => '2',
      'name' => 'RemindPassword',
      'description' => 'Восстановление пароля',
      'act_variable' => 'act',
      'act_method' => 'post',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'RemindPassword',
      'sort_index' => '985',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '28',
          'block_id' => '16',
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
          'id' => '35',
          'block_id' => '16',
          'name' => 'remind_message.tpl',
          'description' => 'Сообщение о востановлении пароля',
          'content' => 'Ваш пароль <b>{$password}</b> для авторизации на сайте {$smarty.const.SETTINGS_HTTP_HOST}
<br/>
С уважением, администрация.',
          'loaded_name' => 'remind_message.tpl',
          'sort_index' => '1422',
          'block_name' => 'RemindPassword',
        ),
        1 => 
        array (
          'id' => '36',
          'block_id' => '16',
          'name' => 'remind_result.tpl',
          'description' => 'Результат проверки восстановления пароля',
          'content' => '<h2 fastedit::>
{if $send}
  {\'Ваш пароль успешно выслан на ваш контактный Email.\'|ftext}
{else}
  {\'Сообщение не отправленно. Возможно вы неправильно указали свой Email.\'|ftext}
{/if}
</h2>',
          'loaded_name' => 'remind_result.tpl',
          'sort_index' => '1423',
          'block_name' => 'RemindPassword',
        ),
        2 => 
        array (
          'id' => '37',
          'block_id' => '16',
          'name' => 'remind_form.tpl',
          'description' => 'Форма восстановления пароля',
          'content' => '<noindex>
  <form method="post" style="margin:0px" fastedit::>
  <p><input name="act" value="remind_send" type="hidden" /></p>
    <table border=\'0\' cellpadding=\'0\' cellspacing=\'0\' style="width:470px">
      <tr style="height:40px" align="left" valign="center">
        <td style="width:50px" align="left">Email:</td>
        <td style="width:350px" colspan=\'2\' align="left"><input style=\'width: 350px;\' name="email" value="" /></td>
      </tr>
      <tr style="height:30px">
        <td></td>
        <td colspan=\'2\' align="left" valign="bottom"><input class="button"  type="submit" value="Выслать пароль" /></td>
      </tr>
    </table>
  </form>
</noindex>
',
          'loaded_name' => 'remind_form.tpl',
          'sort_index' => '1421',
          'block_name' => 'RemindPassword',
        ),
      ),
    ),
    16 => 
    array (
      'id' => '17',
      'module_id' => '1',
      'type' => '2',
      'name' => 'ProductsSearchForm',
      'description' => 'Форма поиска товара',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => 'products_search_text',
      'general_table_id' => NULL,
      'loaded_name' => 'ProductsSearchForm',
      'sort_index' => '1054',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '38',
          'block_id' => '17',
          'name' => 'show_form.tpl',
          'description' => 'Форма поиска товара',
          'content' => '{literal} 
<script type="text/javascript">
function cleare_search2(obj) {	
	if (obj.value=="{/literal} {\'Поиск товара\'|ftext}{literal}") {
		obj.value=\'\';
		obj.style.color=\'black\';
	}
}

function checkSubmit() {
	if (document.getElementById(\'products_search_text\').value=="{/literal} {\'Поиск товара\'|ftext}{literal}") {
		return false;
		}	
} 
</script> 
{/literal}

<form fastedit:: id="SearchProductsForm" action="internet-shop" method="get" onSubmit="return checkSubmit()">
  <table  border=\'0\' cellspacing=\'2\' cellpadding=\'0\'>
    <tr>
      <td style="width:110px" align=\'center\' valign=\'center\'>
        <input name="products_search_text" id="products_search_text" onclick="cleare_search2(this)" style=\'width:400px;\' value="{if $products_search_text}{$products_search_text}{else} {\'Поиск товара\'|ftext}{/if}" />
      </td>
      <td style="width:5px">
      </td>
      <td align=\'center\' valign=\'center\'>
        <input type="submit" class="button" value="{\'Искать товар\'|ftext}" />
      </td>
    </tr>
    {if $products_search_text}
    <tr>
      <td colspan="100%" align="center">
        <a href="internet-shop?{if $smarty.get.category_id}category_id={$smarty.get.category_id}&{/if}products_search_text=">
          {\'Очистить форму поиска\'|ftext}
        </a>
      </td>
    </tr>
    {/if}
  </table>
</form>
<br/>',
          'loaded_name' => 'show_form.tpl',
          'sort_index' => '1545',
          'block_name' => 'ProductsSearchForm',
        ),
      ),
    ),
    17 => 
    array (
      'id' => '18',
      'module_id' => '1',
      'type' => '2',
      'name' => 'Exchange_1C',
      'description' => 'Обмен данными с 1С',
      'act_variable' => 'mode',
      'act_method' => 'get',
      'url_get_vars' => 'type
mode
filename',
      'general_table_id' => NULL,
      'loaded_name' => 'Exchange_1C',
      'sort_index' => '1306',
      'settings' => 
      array (
        0 => 
        array (
          'id' => '29',
          'block_id' => '18',
          'name' => '1c_zip',
          'value' => 'no',
          'description' => '1С. Если сервер поддерживает обмен в zip-формате',
          'edit_s_type_id' => '1',
          'loaded_name' => '1c_zip',
        ),
        1 => 
        array (
          'id' => '30',
          'block_id' => '18',
          'name' => '1c_file_limit',
          'value' => '100000000',
          'description' => '1С. Максимально допустимый размер файла в байтах для передачи за один запрос',
          'edit_s_type_id' => '1',
          'loaded_name' => '1c_file_limit',
        ),
        2 => 
        array (
          'id' => '31',
          'block_id' => '18',
          'name' => '1c_password',
          'value' => '123456',
          'description' => '1С. Пароль',
          'edit_s_type_id' => '1',
          'loaded_name' => '1c_password',
        ),
        3 => 
        array (
          'id' => '32',
          'block_id' => '18',
          'name' => '1c_login',
          'value' => 'admin',
          'description' => '1С. Логин',
          'edit_s_type_id' => '1',
          'loaded_name' => '1c_login',
        ),
        4 => 
        array (
          'id' => '33',
          'block_id' => '18',
          'name' => 'last_orders_export_date',
          'value' => '2012-10-10 10:41:18',
          'description' => '1С. Дата последней выгрузки заказов',
          'edit_s_type_id' => '1',
          'loaded_name' => 'last_orders_export_date',
        ),
      ),
      'templates' => 
      array (
      ),
    ),
    18 => 
    array (
      'id' => '19',
      'module_id' => '1',
      'type' => '2',
      'name' => 'JavaScriptInclude',
      'description' => 'JavaScript - библиотеки',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'JavaScriptInclude',
      'sort_index' => '1307',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '39',
          'block_id' => '19',
          'name' => 'show_list.tpl',
          'description' => 'Подключение JavaScript - библиотек',
          'content' => '<script type="text/javascript" src="/admin/js/jquery.js"></script>
<script type="text/javascript" src="/modules/{$moduleInfo.module_name}/shopcart.js"></script>',
          'loaded_name' => 'show_list.tpl',
          'sort_index' => '1975',
          'block_name' => 'JavaScriptInclude',
        ),
      ),
    ),
    19 => 
    array (
      'id' => '20',
      'module_id' => '1',
      'type' => '2',
      'name' => 'GeneratePrintOrder',
      'description' => 'Печать накладной',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => '2',
      'loaded_name' => 'GeneratePrintOrder',
      'sort_index' => '1539',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
        0 => 
        array (
          'id' => '40',
          'block_id' => '20',
          'name' => 'print.tpl',
          'description' => 'Печать товарного чека',
          'content' => '<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Товарный чек №{$order.id} от {$date}г.</title>
{literal}
  <style>
    td {
      font-size: 12px;
    }	
  </style>
{/literal}
</head>
<body onload="window.print();">

<center>
	<div style="width:800px;text-align:left;">
	<table cellpadding="2" cellspacing="1" >
		<tr><td><b>Поставщик:</b></td><td>{$settings.receipt_postavshik}</td></tr>
		<tr><td>Р/с:</td><td>{$settings.receipt_rashetniy_shet}</td></tr>
		<tr><td>БИК:</td><td>{$settings.receipt_BIK}</td></tr>
		<tr><td>ИНН:</td><td>{$settings.receipt_INN}</td></tr>
		<tr><td>Юр. адрес:</td><td>{$settings.receipt_uridicheskiy_address}</td></tr>
	</table>

      <center>
        <h4 style="margin:0px">
          Товарный чек №{$order.id} от {$date}г.
        </h4>
      </center>

	<table cellpadding="2" cellspacing="1" style="border:0px" >
		<tr><td><b>Плательщик:</b></td><td>{$order.second_name} {$order.name} {$order.otchestvo}</td></tr>
	</table>

	<table cellpadding="2" cellspacing="0" style="width:100%;margin-top:5px;border: 1px solid black;">
		<tr style="background-color:#efefef">
		<td style="width:5%;border: 1px solid black"><b>№</b></td>
		<td style="width:40%;border: 1px solid black"><b>Наименование</b></td>
		<td style="width:5%;border: 1px solid black"><b>Единица</b></td>
		<td style="width:10%;border: 1px solid black"><b>Кол-во</b></td>
		<td style="width:10%;border: 1px solid black"><b>Цена</b></td>
		<td style="width:15%;border: 1px solid black"><b>Сумма без НДС</b></td>
		<td style="width:15%;border: 1px solid black"><b>Сумма НДС</b></td>
		</tr>
		{foreach name="products" from=$products item=item}
			<tr>
			<td style="border: 1px solid black;">{$smarty.foreach.products.iteration}</td>
			<td style="border: 1px solid black;">{$item.article} {$item.caption}</td>
			<td style="border: 1px solid black;">{$item.unit_id_caption}</td>
			<td style="border: 1px solid black;">{$item.amount}</td>
			<td style="border: 1px solid black;">{$item.price}</td>
			<td style="border: 1px solid black;">{$item.price_bez_nds}</td>
			<td style="border: 1px solid black;">{$item.price_nds}</td>
			</tr>
		{/foreach}
	</table>

      <table cellpadding="0" cellspacing="0" style="width:100%;border:0px">
		<tr>
          <td>
            <table cellpadding="2" cellspacing="1" style="border:0px;margin-right:20px" align="right">
              <tr>
                <td>
                  <b>
                    Итого без НДС:
                  </b>
                </td>
                <td>
                  {$price_bez_nds_total}
                </td>
              </tr>
              <tr>
                <td>
                  <b>
                    НДС:
                  </b>
                </td>
                <td>
                  {$nds_total}
                </td>
              </tr>
              <tr>
                <td>
                  <b>
                    Итого с НДС:
                  </b>
                </td>
                <td>
                  {$price_s_nds_total}
                </td>
              </tr>
            </table>
          </td>
      </tr>
      </table>

      <table cellpadding="2" cellspacing="1" style="border:0px">
		<tr>
          <td>
            <b>
              Итого с НДС прописью:
            </b>
          </td>
          <td>
            {$total_summ} {$currency.sign} {$total_ostatok} {$currency.sign_fraction}
          </td>
      </tr>
      </table>
      <br/>
      <br/>

	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
		<td><b>Выдал</b></td><td>_____________________</td>
		<td style="width:100%"></td>
		<td><b>Получил</b></td><td>_____________________</td>
		</tr>
	</table>
</div>
</center>
</body>
</html>',
          'loaded_name' => 'print.tpl',
          'sort_index' => '82',
          'block_name' => 'GeneratePrintOrder',
        ),
      ),
    ),
    20 => 
    array (
      'id' => '21',
      'module_id' => '1',
      'type' => '2',
      'name' => 'ComputeOrderTotal',
      'description' => 'Вычислить стоимость заказа',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'ComputeOrderTotal',
      'sort_index' => '1617',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
      ),
    ),
    21 => 
    array (
      'id' => '22',
      'module_id' => '1',
      'type' => '2',
      'name' => 'JSActions',
      'description' => 'Обработчик JS- запросов',
      'act_variable' => 'func',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'JSActions',
      'sort_index' => '46',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
      ),
    ),
    22 => 
    array (
      'id' => '23',
      'module_id' => '1',
      'type' => '2',
      'name' => 'ViewOrderComposition',
      'description' => 'Просмотр состава заказа',
      'act_variable' => 'act',
      'act_method' => 'get',
      'url_get_vars' => '',
      'general_table_id' => NULL,
      'loaded_name' => 'ViewOrderComposition',
      'sort_index' => '23',
      'settings' => 
      array (
      ),
      'templates' => 
      array (
      ),
    ),
  ),
  'TABLES' => 
  array (
    0 => 
    array (
      'id' => '1',
      'module_id' => '1',
      'name' => 'users',
      'description' => 'Пользователи',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'users',
      'sort_index' => '1023',
      'table_name' => 'users',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '1',
          'field_id' => '1',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '3',
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
        1 => 
        array (
          'id' => '2',
          'field_id' => '2',
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
          'edittype_id' => '1',
          'fieldname' => 'second_name',
          'comment' => 'Фамилия',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
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
          'sort_index' => '180',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '3',
          'field_id' => '3',
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
          'fieldname' => 'mail_index',
          'comment' => 'Почтовый индекс',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '6',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '77',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '4',
          'field_id' => '4',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '3',
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
        4 => 
        array (
          'id' => '5',
          'field_id' => '5',
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
          'regex' => '/^[a-z0-9](?:[a-z0-9_\\.-]*[a-z0-9])*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])*\\.)+[a-z]{2,4}$/i',
          'edittype_id' => '1',
          'fieldname' => 'email',
          'comment' => 'E-Mail',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '3',
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
        5 => 
        array (
          'id' => '6',
          'field_id' => '6',
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
          'sort_index' => '210',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '7',
          'field_id' => '7',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '12',
          'len' => '',
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
          'sort_index' => '190',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        7 => 
        array (
          'id' => '8',
          'field_id' => '8',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '3',
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
        8 => 
        array (
          'id' => '9',
          'field_id' => '9',
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
          'edittype_id' => '1',
          'fieldname' => 'otchestvo',
          'comment' => 'Отчество',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
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
          'sort_index' => '160',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        9 => 
        array (
          'id' => '10',
          'field_id' => '10',
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
          'fieldname' => 'address_of_delivery',
          'comment' => 'Адрес доставки заказа',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '250',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '5',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '56',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        10 => 
        array (
          'id' => '11',
          'field_id' => '11',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '3',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '58',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        11 => 
        array (
          'id' => '12',
          'field_id' => '12',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
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
          'sort_index' => '110',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        12 => 
        array (
          'id' => '13',
          'field_id' => '13',
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
          'comment' => 'Имя',
          'sourse_field_id' => '0',
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
          'sort_index' => '170',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        13 => 
        array (
          'id' => '14',
          'field_id' => '14',
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
          'avator_width' => '100',
          'avator_height' => '100',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '9',
          'fieldname' => 'avator',
          'comment' => 'Аватaр',
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
          'sort_index' => '40',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        14 => 
        array (
          'id' => '15',
          'field_id' => '15',
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
          'fieldname' => 'sex',
          'comment' => 'Пол',
          'sourse_field_id' => '0',
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
          'sort_index' => '135',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        15 => 
        array (
          'id' => '16',
          'field_id' => '16',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '6',
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
        16 => 
        array (
          'id' => '17',
          'field_id' => '17',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '50',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '5',
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
        17 => 
        array (
          'id' => '18',
          'field_id' => '18',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '50',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '5',
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
        18 => 
        array (
          'id' => '19',
          'field_id' => '19',
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
          'comment' => 'Название компании',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '200',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '5',
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
        19 => 
        array (
          'id' => '20',
          'field_id' => '20',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
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
          'sort_index' => '120',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        20 => 
        array (
          'id' => '21',
          'field_id' => '21',
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
          'sourse_field_id' => '155',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '4',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '130',
          'table_name' => 'users',
          'sourse_table_name' => 'country',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        21 => 
        array (
          'id' => '22',
          'field_id' => '22',
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
          'sourse_field_id' => '162',
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
          'sort_index' => '182',
          'table_name' => 'users',
          'sourse_table_name' => 'timezones',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        22 => 
        array (
          'id' => '23',
          'field_id' => '23',
          'active' => '1',
          'show_in_list' => '0',
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
          'comment' => 'Отображаемый ник на форуме',
          'sourse_field_id' => '0',
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
          'unique' => '1',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '25',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        23 => 
        array (
          'id' => '24',
          'field_id' => '24',
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
          'sourse_field_id' => '23',
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
          'sort_index' => '20',
          'table_name' => 'users',
          'sourse_table_name' => 'users',
          'sourse_field_name' => 'nic',
          'hide_by_field_caption' => '',
        ),
        24 => 
        array (
          'id' => '25',
          'field_id' => '25',
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
          'comment' => 'Подпись на форуме',
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
          'sort_index' => '55',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        25 => 
        array (
          'id' => '26',
          'field_id' => '26',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '250',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '6',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '87',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        26 => 
        array (
          'id' => '27',
          'field_id' => '27',
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
          'sort_index' => '15',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        27 => 
        array (
          'id' => '28',
          'field_id' => '28',
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
          'edittype_id' => '5',
          'fieldname' => 'moderator',
          'comment' => 'Модератор',
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
          'sort_index' => '10',
          'table_name' => 'users',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        28 => 
        array (
          'id' => '29',
          'field_id' => '29',
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
          'fieldname' => 'ur_status_id',
          'comment' => 'Юридический статус',
          'sourse_field_id' => '191',
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
          'sort_index' => '185',
          'table_name' => 'users',
          'sourse_table_name' => 'ur_statuses',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    1 => 
    array (
      'id' => '2',
      'module_id' => '1',
      'name' => 'orders',
      'description' => 'Заказы',
      'show_type' => '1',
      'additional_buttons' => 'Состав заказа:_new:ViewOrderComposition
Печать товарного чека:_blank:GeneratePrintOrder
ComputeOrderTotal',
      'loaded_name' => 'orders',
      'sort_index' => '993',
      'table_name' => 'orders',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '30',
          'field_id' => '30',
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
          'fieldname' => 'address_of_delivery',
          'comment' => 'Адрес доставки заказа',
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
          'sort_index' => '18',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '31',
          'field_id' => '31',
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
          'fieldname' => 'send_number',
          'comment' => 'Номер для получения посылки',
          'sourse_field_id' => '0',
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
          'sort_index' => '25',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '32',
          'field_id' => '32',
          'active' => '0',
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
          'edittype_id' => NULL,
          'fieldname' => 'id',
          'comment' => '№',
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
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '33',
          'field_id' => '33',
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
          'fieldname' => 'client_id',
          'comment' => 'Пользователь',
          'sourse_field_id' => '5',
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
          'sort_index' => '95',
          'table_name' => 'orders',
          'sourse_table_name' => 'users',
          'sourse_field_name' => 'email',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '34',
          'field_id' => '34',
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
          'fieldname' => 'created',
          'comment' => 'Дата создания заказа',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '12',
          'len' => '',
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
          'sort_index' => '97',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '35',
          'field_id' => '35',
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
          'fieldname' => 'delivery_id',
          'comment' => 'Способ доставки',
          'sourse_field_id' => '129',
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
          'sort_index' => '85',
          'table_name' => 'orders',
          'sourse_table_name' => 'delivery',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '36',
          'field_id' => '36',
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
          'fieldname' => 'email',
          'comment' => 'Email',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '150',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '4',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '60',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        7 => 
        array (
          'id' => '37',
          'field_id' => '37',
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
          'fieldname' => 'delivery_cost',
          'comment' => 'Стоимость доставки',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '10',
          'len' => '',
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
          'sort_index' => '35',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        8 => 
        array (
          'id' => '38',
          'field_id' => '38',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '3',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '63',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        9 => 
        array (
          'id' => '39',
          'field_id' => '39',
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
          'edittype_id' => '1',
          'fieldname' => 'mail_index',
          'comment' => 'Почтовый индекс',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '4',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '56',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        10 => 
        array (
          'id' => '40',
          'field_id' => '40',
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
          'edittype_id' => '1',
          'fieldname' => 'phone',
          'comment' => 'Контактный телефон',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '4',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '61',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        11 => 
        array (
          'id' => '41',
          'field_id' => '41',
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
          'fieldname' => 'status_id',
          'comment' => 'Статус заказа',
          'sourse_field_id' => '110',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '2',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '23',
          'table_name' => 'orders',
          'sourse_table_name' => 'orders_status',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        12 => 
        array (
          'id' => '42',
          'field_id' => '42',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => 'font-weight:bold;',
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
          'fieldname' => 'total_price',
          'comment' => 'Полная стоимость со скидкой, но без доставки',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '10',
          'len' => '',
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
          'sort_index' => '30',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        13 => 
        array (
          'id' => '43',
          'field_id' => '43',
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
          'fieldname' => 'order_cost_gross',
          'comment' => 'Стоимость без скидки и без доставки',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '10',
          'len' => '',
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
          'sort_index' => '33',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        14 => 
        array (
          'id' => '44',
          'field_id' => '44',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => '41',
          'hide_operator' => '5',
          'hide_on_value' => 'Отклонен',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '2',
          'fieldname' => 'reason_of_rejection',
          'comment' => 'Причина отклонения заказа',
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
          'sort_index' => '21',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => 'status_id',
        ),
        15 => 
        array (
          'id' => '45',
          'field_id' => '45',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '3',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '65',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        16 => 
        array (
          'id' => '46',
          'field_id' => '46',
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
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '3',
          'not_null' => '1',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '62',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        17 => 
        array (
          'id' => '47',
          'field_id' => '47',
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
          'fieldname' => 'note',
          'comment' => 'Примечание',
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
          'sort_index' => '15',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        18 => 
        array (
          'id' => '48',
          'field_id' => '48',
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
          'fieldname' => 'currency_id',
          'comment' => 'Валюта заказа',
          'sourse_field_id' => '113',
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
          'sort_index' => '29',
          'table_name' => 'orders',
          'sourse_table_name' => 'currencies',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        19 => 
        array (
          'id' => '49',
          'field_id' => '49',
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
          'fieldname' => 'pay_system_id',
          'comment' => 'Вариант оплаты',
          'sourse_field_id' => '147',
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
          'sort_index' => '27',
          'table_name' => 'orders',
          'sourse_table_name' => 'pay_systems',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        20 => 
        array (
          'id' => '50',
          'field_id' => '50',
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
          'fieldname' => 'payed',
          'comment' => 'Оплачен',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '2',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '22',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        21 => 
        array (
          'id' => '51',
          'field_id' => '51',
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
          'fieldname' => 'secret_pay_code',
          'comment' => 'Секретный код оплаты',
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
          'sort_index' => '16',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        22 => 
        array (
          'id' => '52',
          'field_id' => '52',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '300',
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
          'fieldname' => 'pay_details',
          'comment' => 'Детали платежа',
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
          'sort_index' => '3',
          'table_name' => 'orders',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    2 => 
    array (
      'id' => '3',
      'module_id' => '1',
      'name' => 'discount_user',
      'description' => 'Накопительные скидки',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'discount_user',
      'sort_index' => '1110',
      'table_name' => 'discount_user',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '53',
          'field_id' => '53',
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
          'fieldname' => 'discount_perc',
          'comment' => 'Скидка %',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '10',
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
          'sort_index' => '70',
          'table_name' => 'discount_user',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '54',
          'field_id' => '54',
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
          'table_name' => 'discount_user',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '55',
          'field_id' => '55',
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
          'fieldname' => 'pieces_before',
          'comment' => 'Сумма накопления',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '10',
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
          'sort_index' => '90',
          'table_name' => 'discount_user',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '56',
          'field_id' => '56',
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
          'fieldname' => 'discount_active',
          'comment' => 'Скидка активна',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
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
          'sort_index' => '60',
          'table_name' => 'discount_user',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '57',
          'field_id' => '57',
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
          'edittype_id' => '3',
          'fieldname' => 'currency_id',
          'comment' => 'Валюта',
          'sourse_field_id' => '113',
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
          'sort_index' => '80',
          'table_name' => 'discount_user',
          'sourse_table_name' => 'currencies',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    3 => 
    array (
      'id' => '4',
      'module_id' => '1',
      'name' => 'categories',
      'description' => 'Категории товаров',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'categories',
      'sort_index' => '989',
      'table_name' => 'categories',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '58',
          'field_id' => '58',
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
          'comment' => 'Категория активна',
          'sourse_field_id' => NULL,
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
          'sort_index' => '70',
          'table_name' => 'categories',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '59',
          'field_id' => '59',
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
          'fieldname' => 'parent_id',
          'comment' => 'Родительская категория',
          'sourse_field_id' => '66',
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
          'sort_index' => '95',
          'table_name' => 'categories',
          'sourse_table_name' => 'categories',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '60',
          'field_id' => '60',
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
          'sort_index' => '75',
          'table_name' => 'categories',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '61',
          'field_id' => '61',
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
          'sourse_field_id' => '66',
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
          'sort_index' => '55',
          'table_name' => 'categories',
          'sourse_table_name' => 'categories',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '62',
          'field_id' => '62',
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
          'sourse_field_id' => '66',
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
          'sort_index' => '60',
          'table_name' => 'categories',
          'sourse_table_name' => 'categories',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '63',
          'field_id' => '63',
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
          'sourse_field_id' => '66',
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
          'sort_index' => '85',
          'table_name' => 'categories',
          'sourse_table_name' => 'categories',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '64',
          'field_id' => '64',
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
          'sourse_field_id' => '66',
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
          'sort_index' => '65',
          'table_name' => 'categories',
          'sourse_table_name' => 'categories',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        7 => 
        array (
          'id' => '65',
          'field_id' => '65',
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
          'sort_index' => '100',
          'table_name' => 'categories',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        8 => 
        array (
          'id' => '66',
          'field_id' => '66',
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
          'comment' => 'Название категории',
          'sourse_field_id' => NULL,
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
          'sort_index' => '90',
          'table_name' => 'categories',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        9 => 
        array (
          'id' => '67',
          'field_id' => '67',
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
          'sourse_field_id' => NULL,
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
          'sort_index' => '80',
          'table_name' => 'categories',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        10 => 
        array (
          'id' => '68',
          'field_id' => '68',
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
          'fieldname' => 'id_1c',
          'comment' => 'ID в 1с',
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
          'sort_index' => '50',
          'table_name' => 'categories',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    4 => 
    array (
      'id' => '5',
      'module_id' => '1',
      'name' => 'products',
      'description' => 'Продукты',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'products',
      'sort_index' => '986',
      'table_name' => 'products',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '69',
          'field_id' => '69',
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
          'edittype_id' => '1',
          'fieldname' => 'article',
          'comment' => 'Артикул',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '100',
          'default' => '',
          'collation_id' => '56',
          'group_caption' => '1',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '186',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '70',
          'field_id' => '70',
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
          'comment' => 'Адрес URL',
          'sourse_field_id' => '74',
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
          'sort_index' => '210',
          'table_name' => 'products',
          'sourse_table_name' => 'products',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '71',
          'field_id' => '71',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '1',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => '',
          'hide_by_field' => NULL,
          'hide_operator' => '5',
          'hide_on_value' => 'Другое',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => NULL,
          'edittype_id' => '3',
          'fieldname' => 'brand_id',
          'comment' => 'Производитель',
          'sourse_field_id' => '124',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '2',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '188',
          'table_name' => 'products',
          'sourse_table_name' => 'brands',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '72',
          'field_id' => '72',
          'active' => '0',
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
          'edittype_id' => NULL,
          'fieldname' => 'id',
          'comment' => 'ID',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '8',
          'len' => '20',
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
          'sort_index' => '250',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '73',
          'field_id' => '73',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '200',
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
          'fieldname' => 'small_description',
          'comment' => 'Краткое описание товара',
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
          'sort_index' => '145',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '74',
          'field_id' => '74',
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
          'comment' => 'Название продукта',
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
          'sort_index' => '220',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '75',
          'field_id' => '75',
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
          'comment' => 'Title - заголовок',
          'sourse_field_id' => '74',
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
          'sort_index' => '100',
          'table_name' => 'products',
          'sourse_table_name' => 'products',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        7 => 
        array (
          'id' => '76',
          'field_id' => '76',
          'active' => '1',
          'show_in_list' => '1',
          'filter' => '0',
          'check_regular_id' => '3',
          'regex_other' => '',
          'height' => '',
          'width' => '',
          'style' => 'font-weight:bold;',
          'hide_by_field' => NULL,
          'hide_operator' => '0',
          'hide_on_value' => '',
          'avator_quality' => '0',
          'avator_width' => '0',
          'avator_height' => '0',
          'avator_quality_big' => '0',
          'avator_width_big' => '0',
          'avator_height_big' => '0',
          'regex' => '/^[\\d\\.\\,]{1,}$/u',
          'edittype_id' => '1',
          'fieldname' => 'price',
          'comment' => 'Розничная цена',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '10',
          'len' => '',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '2',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '170',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        8 => 
        array (
          'id' => '77',
          'field_id' => '77',
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
          'edittype_id' => '3',
          'fieldname' => 'currency_id',
          'comment' => 'Валюта',
          'sourse_field_id' => '113',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '2',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '160',
          'table_name' => 'products',
          'sourse_table_name' => 'currencies',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        9 => 
        array (
          'id' => '78',
          'field_id' => '78',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '350',
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
          'comment' => 'Полное описание товара',
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
          'sort_index' => '140',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        10 => 
        array (
          'id' => '79',
          'field_id' => '79',
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
          'fieldname' => 'active',
          'comment' => 'Продукт активен',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '1',
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
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        11 => 
        array (
          'id' => '80',
          'field_id' => '80',
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
          'avator_height' => '110',
          'avator_quality_big' => '100',
          'avator_width_big' => '800',
          'avator_height_big' => '600',
          'regex' => NULL,
          'edittype_id' => '10',
          'fieldname' => 'images',
          'comment' => 'Еще фото',
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
          'sort_index' => '130',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        12 => 
        array (
          'id' => '81',
          'field_id' => '81',
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
          'fieldname' => 'nova',
          'comment' => 'Новинка',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
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
          'sort_index' => '115',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        13 => 
        array (
          'id' => '82',
          'field_id' => '82',
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
          'fieldname' => 'category_id',
          'comment' => 'Категория',
          'sourse_field_id' => '66',
          'delete' => '0',
          'own_filter' => '1',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '2',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '190',
          'table_name' => 'products',
          'sourse_table_name' => 'categories',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        14 => 
        array (
          'id' => '83',
          'field_id' => '83',
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
          'edittype_id' => NULL,
          'fieldname' => 'date_add',
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
          'sort_index' => '195',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        15 => 
        array (
          'id' => '84',
          'field_id' => '84',
          'active' => '1',
          'show_in_list' => '0',
          'filter' => '0',
          'check_regular_id' => 0,
          'regex_other' => '',
          'height' => '200',
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
          'edittype_id' => '4',
          'fieldname' => 'same_products',
          'comment' => 'Похожие товары',
          'sourse_field_id' => '74',
          'delete' => '0',
          'own_filter' => '1',
          'datatype_id' => '8',
          'len' => '20',
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
          'sort_index' => '102',
          'table_name' => 'products',
          'sourse_table_name' => 'products',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        16 => 
        array (
          'id' => '85',
          'field_id' => '85',
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
          'fieldname' => 'stock',
          'comment' => 'Количество на складе',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '4',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '159',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        17 => 
        array (
          'id' => '86',
          'field_id' => '86',
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
          'edittype_id' => '5',
          'fieldname' => 'market',
          'comment' => 'ЯндексМаркет',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '3',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '105',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        18 => 
        array (
          'id' => '87',
          'field_id' => '87',
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
          'edittype_id' => '9',
          'fieldname' => 'image',
          'comment' => 'Изображение',
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
          'sort_index' => '135',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        19 => 
        array (
          'id' => '88',
          'field_id' => '88',
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
          'fieldname' => 'discount_type',
          'comment' => 'Тип скидки',
          'sourse_field_id' => '120',
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
          'sort_index' => '156',
          'table_name' => 'products',
          'sourse_table_name' => 'discount',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        20 => 
        array (
          'id' => '89',
          'field_id' => '89',
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
          'fieldname' => 'old_price',
          'comment' => 'Старая розничная цена',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '10',
          'len' => '',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '2',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '165',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        21 => 
        array (
          'id' => '90',
          'field_id' => '90',
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
          'sourse_field_id' => '74',
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
          'sort_index' => '90',
          'table_name' => 'products',
          'sourse_table_name' => 'products',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        22 => 
        array (
          'id' => '91',
          'field_id' => '91',
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
          'edittype_id' => '5',
          'fieldname' => 'recomenduem',
          'comment' => 'Рекомендуем',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
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
          'sort_index' => '110',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        23 => 
        array (
          'id' => '92',
          'field_id' => '92',
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
          'sourse_field_id' => '74',
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
          'sort_index' => '95',
          'table_name' => 'products',
          'sourse_table_name' => 'products',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        24 => 
        array (
          'id' => '93',
          'field_id' => '93',
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
          'fieldname' => 'id_1c',
          'comment' => 'ID в 1c',
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
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        25 => 
        array (
          'id' => '94',
          'field_id' => '94',
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
          'fieldname' => 'unit_id',
          'comment' => 'Единица измерения',
          'sourse_field_id' => '174',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '4',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '158',
          'table_name' => 'products',
          'sourse_table_name' => 'units',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        26 => 
        array (
          'id' => '95',
          'field_id' => '95',
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
          'fieldname' => 'type_kind_id',
          'comment' => 'Вид номенклатуры',
          'sourse_field_id' => '180',
          'delete' => '0',
          'own_filter' => '1',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '2',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '187',
          'table_name' => 'products',
          'sourse_table_name' => 'products_types_kinds',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        27 => 
        array (
          'id' => '96',
          'field_id' => '96',
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
          'fieldname' => 'weight',
          'comment' => 'Вес (кг.)',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '10',
          'len' => '',
          'default' => '',
          'collation_id' => NULL,
          'group_caption' => '4',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '157',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        28 => 
        array (
          'id' => '97',
          'field_id' => '97',
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
          'fieldname' => 'nds',
          'comment' => 'Ставка НДС',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '9',
          'len' => '',
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
          'sort_index' => '155',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        29 => 
        array (
          'id' => '98',
          'field_id' => '98',
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
          'edittype_id' => '5',
          'fieldname' => 'nds_in_price',
          'comment' => 'НДС включен в цену',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
          'len' => '',
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
          'sort_index' => '154',
          'table_name' => 'products',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        30 => 
        array (
          'id' => '99',
          'field_id' => '99',
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
          'fieldname' => 'distribution_channel_id',
          'comment' => 'Канал сбыта',
          'sourse_field_id' => '178',
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
          'sort_index' => '184',
          'table_name' => 'products',
          'sourse_table_name' => 'distribution_channel',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        31 => 
        array (
          'id' => '100',
          'field_id' => '100',
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
          'fieldname' => 'kind_id',
          'comment' => 'Вид товара',
          'sourse_field_id' => '183',
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
          'sort_index' => '185',
          'table_name' => 'products',
          'sourse_table_name' => 'products_kinds',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    5 => 
    array (
      'id' => '6',
      'module_id' => '1',
      'name' => 'products_comments',
      'description' => 'Комментарии к продуктам',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'products_comments',
      'sort_index' => '990',
      'table_name' => 'products_comments',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '101',
          'field_id' => '101',
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
          'fieldname' => 'user_name',
          'comment' => 'Имя',
          'sourse_field_id' => '0',
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
          'sort_index' => '50',
          'table_name' => 'products_comments',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '102',
          'field_id' => '102',
          'active' => '1',
          'show_in_list' => '0',
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
          'regex' => '/^[a-z0-9](?:[a-z0-9_\\.-]*[a-z0-9])*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])*\\.)+[a-z]{2,4}$/i',
          'edittype_id' => '1',
          'fieldname' => 'user_email',
          'comment' => 'Email',
          'sourse_field_id' => '0',
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
          'sort_index' => '40',
          'table_name' => 'products_comments',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '103',
          'field_id' => '103',
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
          'fieldname' => 'product_id',
          'comment' => 'Продукт',
          'sourse_field_id' => '74',
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
          'table_name' => 'products_comments',
          'sourse_table_name' => 'products',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '104',
          'field_id' => '104',
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
          'fieldname' => 'comment',
          'comment' => 'Комментарий',
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
          'sort_index' => '70',
          'table_name' => 'products_comments',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '105',
          'field_id' => '105',
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
          'comment' => 'Комментарий активен',
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
          'sort_index' => '30',
          'table_name' => 'products_comments',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '106',
          'field_id' => '106',
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
          'comment' => 'Дата',
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
          'sort_index' => '110',
          'table_name' => 'products_comments',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '107',
          'field_id' => '107',
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
          'table_name' => 'products_comments',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        7 => 
        array (
          'id' => '108',
          'field_id' => '108',
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
          'fieldname' => 'points',
          'comment' => 'Оценка',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '7',
          'len' => '11',
          'default' => '0',
          'collation_id' => NULL,
          'group_caption' => '1',
          'not_null' => '0',
          'unsigned' => '0',
          'auto_incr' => '0',
          'zerofill' => '0',
          'unique' => '0',
          'notfedit' => '0',
          'pk' => '0',
          'sort_index' => '35',
          'table_name' => 'products_comments',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    6 => 
    array (
      'id' => '7',
      'module_id' => '1',
      'name' => 'orders_status',
      'description' => 'Статусы заказа',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'orders_status',
      'sort_index' => '1219',
      'table_name' => 'orders_status',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '109',
          'field_id' => '109',
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
          'sort_index' => '20',
          'table_name' => 'orders_status',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '110',
          'field_id' => '110',
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
          'comment' => 'Название статуса',
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
          'sort_index' => '15',
          'table_name' => 'orders_status',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '111',
          'field_id' => '111',
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
          'fieldname' => 'code',
          'comment' => 'Код',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '10',
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
          'sort_index' => '10',
          'table_name' => 'orders_status',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    7 => 
    array (
      'id' => '8',
      'module_id' => '1',
      'name' => 'currencies',
      'description' => 'Список валют',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'currencies',
      'sort_index' => '1178',
      'table_name' => 'currencies',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '112',
          'field_id' => '112',
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
          'fieldname' => 'sign_fraction',
          'comment' => 'Название дробной части',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '20',
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
          'table_name' => 'currencies',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '113',
          'field_id' => '113',
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
          'comment' => 'Название валюты',
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
          'sort_index' => '90',
          'table_name' => 'currencies',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '114',
          'field_id' => '114',
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
          'table_name' => 'currencies',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '115',
          'field_id' => '115',
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
          'fieldname' => 'sign',
          'comment' => 'Знак валюты',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '10',
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
          'table_name' => 'currencies',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '116',
          'field_id' => '116',
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
          'edittype_id' => '16',
          'fieldname' => 'general',
          'comment' => 'Основная валюта',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
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
          'sort_index' => '30',
          'table_name' => 'currencies',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '117',
          'field_id' => '117',
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
          'fieldname' => 'code',
          'comment' => 'Код валюты в 1C',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '15',
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
          'table_name' => 'currencies',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    8 => 
    array (
      'id' => '9',
      'module_id' => '1',
      'name' => 'discount',
      'description' => 'Дополнительные скидки',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'discount',
      'sort_index' => '1153',
      'table_name' => 'discount',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '118',
          'field_id' => '118',
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
          'sort_index' => '20',
          'table_name' => 'discount',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '119',
          'field_id' => '119',
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
          'fieldname' => 'discount',
          'comment' => 'Скидка на товар в %',
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
          'sort_index' => '5',
          'table_name' => 'discount',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '120',
          'field_id' => '120',
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
          'comment' => 'Название скидки',
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
          'sort_index' => '10',
          'table_name' => 'discount',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    9 => 
    array (
      'id' => '10',
      'module_id' => '1',
      'name' => 'brands',
      'description' => 'Производители',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'brands',
      'sort_index' => '1154',
      'table_name' => 'brands',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '121',
          'field_id' => '121',
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
          'table_name' => 'brands',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '122',
          'field_id' => '122',
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
          'sourse_field_id' => '124',
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
          'sort_index' => '30',
          'table_name' => 'brands',
          'sourse_table_name' => 'brands',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '123',
          'field_id' => '123',
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
          'sourse_field_id' => '124',
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
          'table_name' => 'brands',
          'sourse_table_name' => 'brands',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '124',
          'field_id' => '124',
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
          'comment' => 'Название производителя',
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
          'table_name' => 'brands',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '125',
          'field_id' => '125',
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
          'sort_index' => '85',
          'table_name' => 'brands',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '126',
          'field_id' => '126',
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
          'sourse_field_id' => '124',
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
          'sort_index' => '87',
          'table_name' => 'brands',
          'sourse_table_name' => 'brands',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '127',
          'field_id' => '127',
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
          'comment' => 'Title - заголовок',
          'sourse_field_id' => '124',
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
          'sort_index' => '80',
          'table_name' => 'brands',
          'sourse_table_name' => 'brands',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    10 => 
    array (
      'id' => '11',
      'module_id' => '1',
      'name' => 'delivery',
      'description' => 'Варианты доставки',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'delivery',
      'sort_index' => '1220',
      'table_name' => 'delivery',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '128',
          'field_id' => '128',
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
          'sort_index' => '20',
          'table_name' => 'delivery',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '129',
          'field_id' => '129',
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
          'comment' => 'Название доставки',
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
          'sort_index' => '10',
          'table_name' => 'delivery',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '130',
          'field_id' => '130',
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
          'fieldname' => 'enable',
          'comment' => 'Активно',
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
          'sort_index' => '5',
          'table_name' => 'delivery',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    11 => 
    array (
      'id' => '12',
      'module_id' => '1',
      'name' => 'courses',
      'description' => 'Курсы валют',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'courses',
      'sort_index' => '1192',
      'table_name' => 'courses',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '131',
          'field_id' => '131',
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
          'fieldname' => 'quotation',
          'comment' => 'Курс',
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
          'sort_index' => '5',
          'table_name' => 'courses',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '132',
          'field_id' => '132',
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
          'fieldname' => 'sell_currency_id',
          'comment' => 'Продаваемя валюта',
          'sourse_field_id' => '113',
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
          'sort_index' => '10',
          'table_name' => 'courses',
          'sourse_table_name' => 'currencies',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '133',
          'field_id' => '133',
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
          'fieldname' => 'by_currency_id',
          'comment' => 'Покупаемя валюта',
          'sourse_field_id' => '113',
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
          'sort_index' => '7',
          'table_name' => 'courses',
          'sourse_table_name' => 'currencies',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '134',
          'field_id' => '134',
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
          'sort_index' => '20',
          'table_name' => 'courses',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    12 => 
    array (
      'id' => '13',
      'module_id' => '1',
      'name' => 'pay_systems',
      'description' => 'Платёжные системы',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'pay_systems',
      'sort_index' => '1155',
      'table_name' => 'pay_systems',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '135',
          'field_id' => '135',
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
          'fieldname' => 'enable',
          'comment' => 'Активно',
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
          'sort_index' => '10',
          'table_name' => 'pay_systems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '136',
          'field_id' => '136',
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
          'fieldname' => 'secret_key',
          'comment' => 'Секретный пароль оплаты',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '200',
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
          'sort_index' => '16',
          'table_name' => 'pay_systems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '137',
          'field_id' => '137',
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
          'edittype_id' => '1',
          'fieldname' => 'name',
          'comment' => 'Имя платёжной ситемы',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '250',
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
          'sort_index' => '90',
          'table_name' => 'pay_systems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '138',
          'field_id' => '138',
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
          'table_name' => 'pay_systems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '139',
          'field_id' => '139',
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
          'fieldname' => 'pereschet',
          'comment' => 'Коэффициент перерасчета цены',
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
          'sort_index' => '18',
          'table_name' => 'pay_systems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '140',
          'field_id' => '140',
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
          'fieldname' => 'purse',
          'comment' => 'Кошелёк',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '450',
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
          'table_name' => 'pay_systems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '141',
          'field_id' => '141',
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
          'sort_index' => '50',
          'table_name' => 'pay_systems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        7 => 
        array (
          'id' => '142',
          'field_id' => '142',
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
          'fieldname' => 'login',
          'comment' => 'Логин',
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
          'sort_index' => '60',
          'table_name' => 'pay_systems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        8 => 
        array (
          'id' => '143',
          'field_id' => '143',
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
          'fieldname' => 'shop_id',
          'comment' => 'Индетификатор сайта',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '200',
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
          'table_name' => 'pay_systems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        9 => 
        array (
          'id' => '144',
          'field_id' => '144',
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
          'fieldname' => 'func_name',
          'comment' => 'Название php-функции обработчика',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '200',
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
          'sort_index' => '15',
          'table_name' => 'pay_systems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        10 => 
        array (
          'id' => '145',
          'field_id' => '145',
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
          'fieldname' => 'scid',
          'comment' => 'Номер витрины в ЦПП',
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
          'sort_index' => '5',
          'table_name' => 'pay_systems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        11 => 
        array (
          'id' => '146',
          'field_id' => '146',
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
          'fieldname' => 'currency_id',
          'comment' => 'Переводить по курсу в валюту',
          'sourse_field_id' => '113',
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
          'sort_index' => '2',
          'table_name' => 'pay_systems',
          'sourse_table_name' => 'currencies',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        12 => 
        array (
          'id' => '147',
          'field_id' => '147',
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
          'comment' => 'Отображаемое название платёжной системы',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '250',
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
          'sort_index' => '80',
          'table_name' => 'pay_systems',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    13 => 
    array (
      'id' => '14',
      'module_id' => '1',
      'name' => 'regions',
      'description' => 'Регионы',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'regions',
      'sort_index' => '1521',
      'table_name' => 'regions',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '148',
          'field_id' => '148',
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
          'sourse_field_id' => '155',
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
        1 => 
        array (
          'id' => '149',
          'field_id' => '149',
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
          'id' => '150',
          'field_id' => '150',
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
          'sort_index' => '90',
          'table_name' => 'regions',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    14 => 
    array (
      'id' => '15',
      'module_id' => '1',
      'name' => 'city',
      'description' => 'Город',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'city',
      'sort_index' => '1290',
      'table_name' => 'city',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '151',
          'field_id' => '151',
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
          'sourse_field_id' => '150',
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
          'sort_index' => '80',
          'table_name' => 'city',
          'sourse_table_name' => 'regions',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '152',
          'field_id' => '152',
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
        2 => 
        array (
          'id' => '153',
          'field_id' => '153',
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
        3 => 
        array (
          'id' => '154',
          'field_id' => '154',
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
          'sourse_field_id' => '155',
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
          'table_name' => 'city',
          'sourse_table_name' => 'country',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    15 => 
    array (
      'id' => '16',
      'module_id' => '1',
      'name' => 'country',
      'description' => 'Страна',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'country',
      'sort_index' => '1312',
      'table_name' => 'country',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '155',
          'field_id' => '155',
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
          'id' => '156',
          'field_id' => '156',
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
    16 => 
    array (
      'id' => '17',
      'module_id' => '1',
      'name' => 'discount_user_by_q',
      'description' => 'Оптовые скидки',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'discount_user_by_q',
      'sort_index' => '1152',
      'table_name' => 'discount_user_by_q',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '157',
          'field_id' => '157',
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
          'edittype_id' => '3',
          'fieldname' => 'currency_id',
          'comment' => 'Валюта',
          'sourse_field_id' => '113',
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
          'sort_index' => '80',
          'table_name' => 'discount_user_by_q',
          'sourse_table_name' => 'currencies',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '158',
          'field_id' => '158',
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
          'fieldname' => 'discount_perc',
          'comment' => 'Скидка %',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '10',
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
          'sort_index' => '70',
          'table_name' => 'discount_user_by_q',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '159',
          'field_id' => '159',
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
          'table_name' => 'discount_user_by_q',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '160',
          'field_id' => '160',
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
          'fieldname' => 'pieces_before',
          'comment' => 'Количество товара',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '10',
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
          'sort_index' => '90',
          'table_name' => 'discount_user_by_q',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '161',
          'field_id' => '161',
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
          'fieldname' => 'discount_active',
          'comment' => 'Скидка активна',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '27',
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
          'sort_index' => '60',
          'table_name' => 'discount_user_by_q',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    17 => 
    array (
      'id' => '18',
      'module_id' => '1',
      'name' => 'timezones',
      'description' => 'Временные зоны',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'timezones',
      'sort_index' => '1522',
      'table_name' => 'timezones',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '162',
          'field_id' => '162',
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
          'len' => '300',
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
          'table_name' => 'timezones',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '163',
          'field_id' => '163',
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
          'sort_index' => '80',
          'table_name' => 'timezones',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '164',
          'field_id' => '164',
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
      ),
    ),
    18 => 
    array (
      'id' => '19',
      'module_id' => '1',
      'name' => 'help',
      'description' => 'Техподдержка',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'help',
      'sort_index' => '1561',
      'table_name' => 'help',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '165',
          'field_id' => '165',
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
          'fieldname' => 'answer_attach',
          'comment' => 'Вложение администратора',
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
          'sort_index' => '60',
          'table_name' => 'help',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '166',
          'field_id' => '166',
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
          'fieldname' => 'show_answer',
          'comment' => 'Выводить ответ',
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
          'sort_index' => '50',
          'table_name' => 'help',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '167',
          'field_id' => '167',
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
          'fieldname' => 'answer',
          'comment' => 'Ответ администратора',
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
          'sort_index' => '70',
          'table_name' => 'help',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '168',
          'field_id' => '168',
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
          'fieldname' => 'question_attach',
          'comment' => 'Вложение пользователя',
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
          'sort_index' => '80',
          'table_name' => 'help',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '169',
          'field_id' => '169',
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
          'edittype_id' => '7',
          'fieldname' => 'question',
          'comment' => 'Вопрос пользователя',
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
          'sort_index' => '90',
          'table_name' => 'help',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '170',
          'field_id' => '170',
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
          'fieldname' => 'user_id',
          'comment' => 'Пользователь',
          'sourse_field_id' => '5',
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
          'sort_index' => '92',
          'table_name' => 'help',
          'sourse_table_name' => 'users',
          'sourse_field_name' => 'email',
          'hide_by_field_caption' => '',
        ),
        6 => 
        array (
          'id' => '171',
          'field_id' => '171',
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
          'table_name' => 'help',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        7 => 
        array (
          'id' => '172',
          'field_id' => '172',
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
          'table_name' => 'help',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    19 => 
    array (
      'id' => '20',
      'module_id' => '1',
      'name' => 'units',
      'description' => 'Единицы измерения',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'units',
      'sort_index' => '1562',
      'table_name' => 'units',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '173',
          'field_id' => '173',
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
          'table_name' => 'units',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '174',
          'field_id' => '174',
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
          'comment' => 'Единица измерения',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '50',
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
          'table_name' => 'units',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    20 => 
    array (
      'id' => '21',
      'module_id' => '1',
      'name' => 'products_types',
      'description' => 'Типы номенклатуры',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'products_types',
      'sort_index' => '1566',
      'table_name' => 'products_types',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '175',
          'field_id' => '175',
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
          'comment' => 'Тип номенклатуры',
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
          'sort_index' => '90',
          'table_name' => 'products_types',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '176',
          'field_id' => '176',
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
          'table_name' => 'products_types',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    21 => 
    array (
      'id' => '22',
      'module_id' => '1',
      'name' => 'distribution_channel',
      'description' => 'Каналы сбыта',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'distribution_channel',
      'sort_index' => '1567',
      'table_name' => 'distribution_channel',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '177',
          'field_id' => '177',
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
          'table_name' => 'distribution_channel',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '178',
          'field_id' => '178',
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
          'comment' => 'Канал сбыта',
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
          'sort_index' => '90',
          'table_name' => 'distribution_channel',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    22 => 
    array (
      'id' => '23',
      'module_id' => '1',
      'name' => 'products_types_kinds',
      'description' => 'Виды номенклатуры',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'products_types_kinds',
      'sort_index' => '1565',
      'table_name' => 'products_types_kinds',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '179',
          'field_id' => '179',
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
          'table_name' => 'products_types_kinds',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '180',
          'field_id' => '180',
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
          'comment' => 'Вид номенклатуры',
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
          'sort_index' => '90',
          'table_name' => 'products_types_kinds',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '181',
          'field_id' => '181',
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
          'fieldname' => 'type_id',
          'comment' => 'Тип номенклатуры',
          'sourse_field_id' => '175',
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
          'sort_index' => '95',
          'table_name' => 'products_types_kinds',
          'sourse_table_name' => 'products_types',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    23 => 
    array (
      'id' => '24',
      'module_id' => '1',
      'name' => 'products_kinds',
      'description' => 'Виды товаров',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'products_kinds',
      'sort_index' => '1563',
      'table_name' => 'products_kinds',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '182',
          'field_id' => '182',
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
          'table_name' => 'products_kinds',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '183',
          'field_id' => '183',
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
          'comment' => 'Вид товара',
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
          'sort_index' => '90',
          'table_name' => 'products_kinds',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    24 => 
    array (
      'id' => '25',
      'module_id' => '1',
      'name' => 'orders_composition',
      'description' => 'Состав заказа',
      'show_type' => '1',
      'additional_buttons' => 'ComputeOrderTotal',
      'loaded_name' => 'orders_composition',
      'sort_index' => '1003',
      'table_name' => 'orders_composition',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '184',
          'field_id' => '184',
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
          'table_name' => 'orders_composition',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '185',
          'field_id' => '185',
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
          'fieldname' => 'order_id',
          'comment' => 'Заказ',
          'sourse_field_id' => '32',
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
          'sort_index' => '90',
          'table_name' => 'orders_composition',
          'sourse_table_name' => 'orders',
          'sourse_field_name' => 'id',
          'hide_by_field_caption' => '',
        ),
        2 => 
        array (
          'id' => '186',
          'field_id' => '186',
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
          'fieldname' => 'product_id',
          'comment' => 'Товар',
          'sourse_field_id' => '74',
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
          'table_name' => 'orders_composition',
          'sourse_table_name' => 'products',
          'sourse_field_name' => 'caption',
          'hide_by_field_caption' => '',
        ),
        3 => 
        array (
          'id' => '187',
          'field_id' => '187',
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
          'fieldname' => 'amount',
          'comment' => 'Количество',
          'sourse_field_id' => '0',
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
          'sort_index' => '70',
          'table_name' => 'orders_composition',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        4 => 
        array (
          'id' => '188',
          'field_id' => '188',
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
          'fieldname' => 'price',
          'comment' => 'Стоимость',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '10',
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
          'sort_index' => '60',
          'table_name' => 'orders_composition',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        5 => 
        array (
          'id' => '189',
          'field_id' => '189',
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
          'edittype_id' => '3',
          'fieldname' => 'currency_id',
          'comment' => 'Валюта',
          'sourse_field_id' => '113',
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
          'sort_index' => '50',
          'table_name' => 'orders_composition',
          'sourse_table_name' => 'currencies',
          'sourse_field_name' => 'name',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
    25 => 
    array (
      'id' => '26',
      'module_id' => '1',
      'name' => 'ur_statuses',
      'description' => 'Юридические статусы',
      'show_type' => '1',
      'additional_buttons' => '',
      'loaded_name' => 'ur_statuses',
      'sort_index' => '1749',
      'table_name' => 'ur_statuses',
      'fields_settings' => 
      array (
        0 => 
        array (
          'id' => '190',
          'field_id' => '190',
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
          'table_name' => 'ur_statuses',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
        1 => 
        array (
          'id' => '191',
          'field_id' => '191',
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
          'comment' => 'Название юридического статуса',
          'sourse_field_id' => '0',
          'delete' => '0',
          'own_filter' => '0',
          'datatype_id' => '1',
          'len' => '50',
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
          'table_name' => 'ur_statuses',
          'sourse_field_name' => '',
          'sourse_table_name' => '',
          'hide_by_field_caption' => '',
        ),
      ),
    ),
  ),
  'MODULE' => 
  array (
    'id' => '1',
    'name' => 'InternetShop',
    'version' => '1',
    'description' => 'Итернет-магазин',
    'loaded' => '1',
    'need_save' => '0',
    'loaded_name' => 'InternetShop',
    'sort_index' => '1',
  ),
  'TABLES_DATA' => 
  array (
    'users' => 
    array (
    ),
    'orders' => 
    array (
    ),
    'discount_user' => 
    array (
    ),
    'categories' => 
    array (
    ),
    'products' => 
    array (
    ),
    'products_comments' => 
    array (
    ),
    'orders_status' => 
    array (
      0 => 
      array (
        'id' => '1',
        'name' => 'Ожидает проверки',
        'code' => '',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '45',
      ),
      1 => 
      array (
        'id' => '2',
        'name' => 'Выполняется',
        'code' => '',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '40',
      ),
      2 => 
      array (
        'id' => '3',
        'name' => 'Ожидает оплаты',
        'code' => '',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '35',
      ),
      3 => 
      array (
        'id' => '5',
        'name' => 'Готов к отправке',
        'code' => '',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '25',
      ),
      4 => 
      array (
        'id' => '6',
        'name' => 'Ожидает поставки',
        'code' => '',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '20',
      ),
      5 => 
      array (
        'id' => '7',
        'name' => 'Доставлен',
        'code' => '',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
      6 => 
      array (
        'id' => '8',
        'name' => 'Отклонен',
        'code' => '',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      7 => 
      array (
        'id' => '9',
        'name' => 'Возвращен',
        'code' => '',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
      8 => 
      array (
        'id' => '10',
        'name' => 'Успешно обработан',
        'code' => 'F',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '50',
      ),
      9 => 
      array (
        'id' => '11',
        'name' => 'Принят',
        'code' => 'N',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '55',
      ),
    ),
    'currencies' => 
    array (
      0 => 
      array (
        'id' => '1',
        'name' => 'Рубли',
        'sign' => 'руб.',
        'sign_fraction' => 'коп.',
        'code' => 'руб',
        'general' => '1',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '25',
      ),
      1 => 
      array (
        'id' => '2',
        'name' => 'Доллары',
        'sign' => '$',
        'sign_fraction' => 'цент.',
        'code' => 'USD',
        'general' => '0',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      2 => 
      array (
        'id' => '3',
        'name' => 'Евро',
        'sign' => '€',
        'sign_fraction' => 'евроцент.',
        'code' => 'EUR',
        'general' => '0',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
      3 => 
      array (
        'id' => '4',
        'name' => 'Гривна',
        'sign' => 'гр.',
        'sign_fraction' => 'коп.',
        'code' => '',
        'general' => '0',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '20',
      ),
    ),
    'discount' => 
    array (
      0 => 
      array (
        'id' => '1',
        'name' => 'Скидка дня',
        'discount' => '15',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
      1 => 
      array (
        'id' => '2',
        'name' => 'Скидка месяца',
        'discount' => '30',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      2 => 
      array (
        'id' => '3',
        'name' => 'Скидка',
        'discount' => '20',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
    ),
    'brands' => 
    array (
    ),
    'delivery' => 
    array (
      0 => 
      array (
        'id' => '1',
        'name' => 'Самовывоз',
        'enable' => '1',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
      1 => 
      array (
        'id' => '2',
        'name' => 'Почта России',
        'enable' => '1',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      2 => 
      array (
        'id' => '3',
        'name' => 'Курьером',
        'enable' => '1',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
    ),
    'courses' => 
    array (
      0 => 
      array (
        'id' => '1',
        'sell_currency_id' => '4',
        'by_currency_id' => '2',
        'quotation' => '0.125',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
      1 => 
      array (
        'id' => '2',
        'sell_currency_id' => '4',
        'by_currency_id' => '3',
        'quotation' => '0.1',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      2 => 
      array (
        'id' => '3',
        'sell_currency_id' => '4',
        'by_currency_id' => '1',
        'quotation' => '2.5369',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
      3 => 
      array (
        'id' => '4',
        'sell_currency_id' => '2',
        'by_currency_id' => '4',
        'quotation' => '7.9727',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '20',
      ),
      4 => 
      array (
        'id' => '5',
        'sell_currency_id' => '2',
        'by_currency_id' => '3',
        'quotation' => '0.73',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '25',
      ),
      5 => 
      array (
        'id' => '6',
        'sell_currency_id' => '2',
        'by_currency_id' => '1',
        'quotation' => '31.43',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '30',
      ),
      6 => 
      array (
        'id' => '7',
        'sell_currency_id' => '3',
        'by_currency_id' => '4',
        'quotation' => '10.85',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '35',
      ),
      7 => 
      array (
        'id' => '8',
        'sell_currency_id' => '3',
        'by_currency_id' => '2',
        'quotation' => '1.36',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '40',
      ),
      8 => 
      array (
        'id' => '9',
        'sell_currency_id' => '3',
        'by_currency_id' => '1',
        'quotation' => '42.76',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '45',
      ),
      9 => 
      array (
        'id' => '10',
        'sell_currency_id' => '1',
        'by_currency_id' => '4',
        'quotation' => '0.25',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '50',
      ),
      10 => 
      array (
        'id' => '11',
        'sell_currency_id' => '1',
        'by_currency_id' => '2',
        'quotation' => '0.03',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '55',
      ),
      11 => 
      array (
        'id' => '12',
        'sell_currency_id' => '1',
        'by_currency_id' => '3',
        'quotation' => '0.02',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '60',
      ),
      12 => 
      array (
        'id' => '13',
        'sell_currency_id' => '1',
        'by_currency_id' => '3',
        'quotation' => '0.02',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '65',
      ),
    ),
    'pay_systems' => 
    array (
      0 => 
      array (
        'id' => '1',
        'name' => 'Robokassa',
        'caption' => 'Другие варианты (Visa, Mastercard, PayPal, QIWI...)',
        'shop_id' => '',
        'login' => 'demo',
        'password' => 'Morbid11',
        'pereschet' => '1',
        'secret_key' => 'Visions22',
        'func_name' => 'robokassa',
        'enable' => '1',
        'purse' => '',
        'scid' => '',
        'currency_id' => '0',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '25',
      ),
      1 => 
      array (
        'id' => '2',
        'name' => 'Наличными при встрече',
        'caption' => 'Наличными при встрече',
        'shop_id' => '',
        'login' => '',
        'password' => '',
        'pereschet' => '0',
        'secret_key' => '',
        'func_name' => 'Cash',
        'enable' => '1',
        'purse' => '',
        'scid' => '',
        'currency_id' => '0',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      2 => 
      array (
        'id' => '3',
        'name' => 'INTERKASSA',
        'caption' => 'Другие варианты (Visa, Mastercard, PayPal, QIWI...)',
        'shop_id' => '2E7E9B37-1318-0BC6-B3F3-55DFA364132B',
        'login' => '',
        'password' => '',
        'pereschet' => '1',
        'secret_key' => 'nahhmw3nfBGjFxK9',
        'func_name' => 'Interkassa',
        'enable' => '1',
        'purse' => '',
        'scid' => '',
        'currency_id' => '0',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
      3 => 
      array (
        'id' => '4',
        'name' => 'Webmoney',
        'caption' => 'Webmoney WMR',
        'shop_id' => '',
        'login' => '',
        'password' => '',
        'pereschet' => '1',
        'secret_key' => 'hostmake',
        'func_name' => 'Webmoney',
        'enable' => '0',
        'purse' => 'R123456789123',
        'scid' => '',
        'currency_id' => '1',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '80',
      ),
      4 => 
      array (
        'id' => '5',
        'name' => 'Yandex.Деньги',
        'caption' => 'Yandex.Деньги',
        'shop_id' => '1234567891234',
        'login' => 'admin@localhost.ru',
        'password' => '',
        'pereschet' => '1',
        'secret_key' => '',
        'func_name' => 'YandexMoney',
        'enable' => '0',
        'purse' => '',
        'scid' => '',
        'currency_id' => '0',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '28',
      ),
      5 => 
      array (
        'id' => '6',
        'name' => 'Webmoney',
        'caption' => 'Webmoney WMZ',
        'shop_id' => '',
        'login' => '',
        'password' => '',
        'pereschet' => '0',
        'secret_key' => '',
        'func_name' => 'Webmoney',
        'enable' => '0',
        'purse' => 'Z145179295679',
        'scid' => '',
        'currency_id' => '2',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '70',
      ),
      6 => 
      array (
        'id' => '7',
        'name' => 'Webmoney',
        'caption' => 'Webmoney WMU',
        'shop_id' => '',
        'login' => '',
        'password' => '',
        'pereschet' => '0',
        'secret_key' => '',
        'func_name' => 'Webmoney',
        'enable' => '0',
        'purse' => '',
        'scid' => '',
        'currency_id' => '4',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '45',
      ),
      7 => 
      array (
        'id' => '8',
        'name' => 'Webmoney',
        'caption' => 'Webmoney WME',
        'shop_id' => '',
        'login' => '',
        'password' => '',
        'pereschet' => '0',
        'secret_key' => '',
        'func_name' => 'Webmoney',
        'enable' => '0',
        'purse' => '',
        'scid' => '',
        'currency_id' => '3',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '50',
      ),
    ),
    'regions' => 
    array (
      0 => 
      array (
        'id' => '1',
        'name' => 'Донецкая область',
        'country_id' => '1',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
      1 => 
      array (
        'id' => '2',
        'name' => 'Волновахская область',
        'country_id' => '1',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      2 => 
      array (
        'id' => '3',
        'name' => 'Московская область',
        'country_id' => '2',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
    ),
    'city' => 
    array (
      0 => 
      array (
        'id' => '1',
        'country_id' => '2',
        'region_id' => '3',
        'name' => 'Москва',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
    ),
    'country' => 
    array (
      0 => 
      array (
        'id' => '1',
        'name' => 'Украина',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
      1 => 
      array (
        'id' => '2',
        'name' => 'Россия',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
    ),
    'discount_user_by_q' => 
    array (
    ),
    'timezones' => 
    array (
      0 => 
      array (
        'id' => '1',
        'caption' => 'UTC-12 Линия перемены дат',
        'timezone' => '-12',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
      1 => 
      array (
        'id' => '2',
        'caption' => 'UTC-11 Самоа',
        'timezone' => '-11',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      2 => 
      array (
        'id' => '3',
        'caption' => 'UTC-10 Гавайи',
        'timezone' => '-10',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
      3 => 
      array (
        'id' => '4',
        'caption' => 'UTC-9 Аляска',
        'timezone' => '-9',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '20',
      ),
      4 => 
      array (
        'id' => '5',
        'caption' => 'UTC-8 Североамериканское тихоокеанское время (США и Канада)',
        'timezone' => '-8',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '25',
      ),
      5 => 
      array (
        'id' => '6',
        'caption' => 'UTC-7 Горное время (США и Канада), Мексика (Чиуауа, Ла-Пас, Мацатлан)',
        'timezone' => '-7',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '30',
      ),
      6 => 
      array (
        'id' => '7',
        'caption' => 'UTC-6 Центральное время (США и Канада), Центральноамериканское время, Мексика (Гвадалахара, Мехико, Монтеррей)',
        'timezone' => '-6',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '35',
      ),
      7 => 
      array (
        'id' => '8',
        'caption' => 'UTC-5 Североамериканское восточное время (США и Канада), Южноамериканское тихоокеанское время (Богота, Лима, Кито)',
        'timezone' => '-5',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '40',
      ),
      8 => 
      array (
        'id' => '9',
        'caption' => 'UTC-4:30 Каракас',
        'timezone' => '-4.3',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '45',
      ),
      9 => 
      array (
        'id' => '10',
        'caption' => 'UTC-4 Атлантическое время (Канада), Южноамериканское тихоокеанское время (Ла-Пас, Сантьяго)',
        'timezone' => '-4',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '50',
      ),
      10 => 
      array (
        'id' => '11',
        'caption' => 'UTC-3:30 Ньюфаундленд',
        'timezone' => '-3.3',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '55',
      ),
      11 => 
      array (
        'id' => '12',
        'caption' => 'UTC-3 Южноамериканское восточное время (Бразилиа, Буэнос-Айрес, Джорджтаун), Гренландия',
        'timezone' => '-3',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '60',
      ),
      12 => 
      array (
        'id' => '13',
        'caption' => 'UTC-2 Среднеатлантическое время',
        'timezone' => '-2',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '65',
      ),
      13 => 
      array (
        'id' => '14',
        'caption' => 'UTC-1 Азорские острова, Кабо-Верде',
        'timezone' => '-1',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '70',
      ),
      14 => 
      array (
        'id' => '15',
        'caption' => 'UTC+0 Западноевропейское время (Дублин, Эдинбург, Лиссабон, Лондон), Касабланка, Монровия',
        'timezone' => '0',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '75',
      ),
      15 => 
      array (
        'id' => '16',
        'caption' => 'UTC+1 Центральноевропейское время (Амстердам, Берлин, Берн, Брюссель, Вена, Копенгаген, Мадрид, Париж, Рим, Стокгольм, Белград, Братислава, Будапешт, Варшава, Любляна, Прага, Сараево, Скопье, Загреб), Западное центральноафриканское время',
        'timezone' => '1',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '80',
      ),
      16 => 
      array (
        'id' => '17',
        'caption' => 'UTC+2 Восточноевропейское время (Афины, Бухарест, Вильнюс, Киев, Кишинев, Минск, Рига, София, Таллин, Хельсинки, Калининград), Египет, Израиль, Ливан, Турция, ЮАР',
        'timezone' => '2',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '85',
      ),
      17 => 
      array (
        'id' => '18',
        'caption' => 'UTC+3 Московское время, Восточноафриканское время (Найроби, Аддис-Абеба), Ирак, Кувейт, Саудовская Аравия',
        'timezone' => '3',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '90',
      ),
      18 => 
      array (
        'id' => '19',
        'caption' => 'UTC+3:30 Тегеранское время',
        'timezone' => '3.3',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '95',
      ),
      19 => 
      array (
        'id' => '20',
        'caption' => 'UTC+4 Самарское время, Объединённые Арабские Эмираты, Оман, Азербайджан, Армения, Грузия',
        'timezone' => '4',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '100',
      ),
      20 => 
      array (
        'id' => '21',
        'caption' => 'UTC+4:30 Афганистан',
        'timezone' => '4.3',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '105',
      ),
      21 => 
      array (
        'id' => '22',
        'caption' => 'UTC+5 Екатеринбургское время, Западноазиатское время (Исламабад, Карачи, Ташкент)',
        'timezone' => '5',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '110',
      ),
      22 => 
      array (
        'id' => '23',
        'caption' => 'UTC+5:30 Индия, Шри-Ланка',
        'timezone' => '5.3',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '115',
      ),
      23 => 
      array (
        'id' => '24',
        'caption' => 'UTC+5:45 Непал',
        'timezone' => '5.45',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '120',
      ),
      24 => 
      array (
        'id' => '25',
        'caption' => 'UTC+6 Новосибирск, Омское время, Центральноазиатское время (Бангладеш, Казахстан)',
        'timezone' => '6',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '125',
      ),
      25 => 
      array (
        'id' => '26',
        'caption' => 'UTC+6:30 Мьянма',
        'timezone' => '6.3',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '130',
      ),
      26 => 
      array (
        'id' => '27',
        'caption' => 'UTC+7 Красноярское время, Юго-Восточная Азия (Бангкок, Джакарта, Ханой)',
        'timezone' => '7',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '135',
      ),
      27 => 
      array (
        'id' => '28',
        'caption' => 'UTC+8 Иркутское время, Улан-Батор, Куала-Лумпур, Гонконг, Китай, Сингапур, Тайвань, западноавстралийское время (Перт)',
        'timezone' => '8',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '140',
      ),
      28 => 
      array (
        'id' => '29',
        'caption' => 'UTC+9 Якутское время, Корея, Япония',
        'timezone' => '9',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '145',
      ),
      29 => 
      array (
        'id' => '30',
        'caption' => 'UTC+9:30 Центральноавстралийское время (Аделаида, Дарвин)',
        'timezone' => '9.3',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '150',
      ),
      30 => 
      array (
        'id' => '31',
        'caption' => 'UTC+10 Владивостокское время, Восточноавстралийское время (Брисбен, Канберра, Мельбурн, Сидней), Тасмания, Западно-тихоокеанское время (Гуам, Порт-Морсби)',
        'timezone' => '10',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '155',
      ),
      31 => 
      array (
        'id' => '32',
        'caption' => 'UTC+11 Магаданское время, Центрально-тихоокеанское время (Соломоновы острова, Новая Каледония)',
        'timezone' => '11',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '160',
      ),
      32 => 
      array (
        'id' => '33',
        'caption' => 'UTC+12 Камчатское время, Маршалловы острова, Фиджи, Новая Зеландия',
        'timezone' => '12',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '165',
      ),
      33 => 
      array (
        'id' => '34',
        'caption' => 'UTC+13 Тонга',
        'timezone' => '13',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '170',
      ),
      34 => 
      array (
        'id' => '35',
        'caption' => 'UTC+14 Острова Лайн (Кирибати)',
        'timezone' => '14',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '175',
      ),
    ),
    'help' => 
    array (
    ),
    'units' => 
    array (
      0 => 
      array (
        'id' => '1',
        'caption' => 'упак',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
      1 => 
      array (
        'id' => '2',
        'caption' => 'кг',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      2 => 
      array (
        'id' => '3',
        'caption' => 'пара',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
      3 => 
      array (
        'id' => '4',
        'caption' => 'шт',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '20',
      ),
      4 => 
      array (
        'id' => '5',
        'caption' => 'компл',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '25',
      ),
      5 => 
      array (
        'id' => '6',
        'caption' => '100 шт',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '30',
      ),
    ),
    'products_types' => 
    array (
      0 => 
      array (
        'id' => '1',
        'caption' => 'Товар',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
    ),
    'distribution_channel' => 
    array (
      0 => 
      array (
        'id' => '27',
        'caption' => 'Розница',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
      1 => 
      array (
        'id' => '28',
        'caption' => 'Опт',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      2 => 
      array (
        'id' => '29',
        'caption' => 'Реализация',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
    ),
    'products_types_kinds' => 
    array (
      0 => 
      array (
        'id' => '3',
        'type_id' => '1',
        'caption' => 'Товар',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
    ),
    'products_kinds' => 
    array (
      0 => 
      array (
        'id' => '48',
        'caption' => 'Конфеты',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '5',
      ),
      1 => 
      array (
        'id' => '49',
        'caption' => 'Демисезонная обувь',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
      2 => 
      array (
        'id' => '50',
        'caption' => 'Вентиляторы',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
      3 => 
      array (
        'id' => '51',
        'caption' => 'Летняя обувь',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '20',
      ),
      4 => 
      array (
        'id' => '52',
        'caption' => 'Зимняя обувь',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '25',
      ),
      5 => 
      array (
        'id' => '53',
        'caption' => 'Кондиционеры',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '30',
      ),
      6 => 
      array (
        'id' => '54',
        'caption' => 'Спортивная обувь',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '35',
      ),
      7 => 
      array (
        'id' => '55',
        'caption' => 'Крупа',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '40',
      ),
      8 => 
      array (
        'id' => '56',
        'caption' => 'Масло',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '45',
      ),
      9 => 
      array (
        'id' => '57',
        'caption' => 'Холодильники',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '50',
      ),
      10 => 
      array (
        'id' => '58',
        'caption' => 'Молоко',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '55',
      ),
      11 => 
      array (
        'id' => '59',
        'caption' => 'Мясорубки',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '60',
      ),
      12 => 
      array (
        'id' => '60',
        'caption' => 'Печенье',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '65',
      ),
      13 => 
      array (
        'id' => '61',
        'caption' => 'Вафли',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '70',
      ),
      14 => 
      array (
        'id' => '62',
        'caption' => 'Пылесосы',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '75',
      ),
      15 => 
      array (
        'id' => '63',
        'caption' => 'Сахар',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '80',
      ),
      16 => 
      array (
        'id' => '64',
        'caption' => 'Кухонные комбайны',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '85',
      ),
      17 => 
      array (
        'id' => '65',
        'caption' => 'Кофеварки',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '90',
      ),
      18 => 
      array (
        'id' => '66',
        'caption' => 'Миксеры',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '95',
      ),
      19 => 
      array (
        'id' => '67',
        'caption' => 'Соковыжималки',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '100',
      ),
      20 => 
      array (
        'id' => '68',
        'caption' => 'Телевизоры',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '105',
      ),
      21 => 
      array (
        'id' => '69',
        'caption' => 'Электрочайники',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '110',
      ),
    ),
    'orders_composition' => 
    array (
    ),
    'ur_statuses' => 
    array (
      0 => 
      array (
        'id' => '1',
        'caption' => 'Частное лицо',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '15',
      ),
      1 => 
      array (
        'id' => '2',
        'caption' => 'Юридическое лицо',
        'page_id' => '0',
        'tag_id' => '1',
        'lang_id' => '1',
        'sort_index' => '10',
      ),
    ),
  ),
  'TABLES_DATA_SYSTEM' => 
  array (
    'cms_multiselect_data' => 
    array (
      0 => 
      array (
        'field_id' => '1783',
        'data_id' => '8',
        'value_id' => '10',
      ),
      1 => 
      array (
        'field_id' => '1783',
        'data_id' => '8',
        'value_id' => '8',
      ),
    ),
  ),
  'TABLES_DATA_MULTISELECT' => 
  array (
    'cms_multiselect_data' => 
    array (
    ),
  ),
);
?>