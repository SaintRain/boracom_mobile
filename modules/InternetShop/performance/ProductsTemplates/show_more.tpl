<div fastedit::>
<table align='center' style="width:100%" border='0' cellspacing='0' cellpadding='0'>
    <tr>
        <td  style="height:1px;background-color:#e1e5e8">
        </td>
    </tr>
    <tr>
        <td fastedit:{$table_name}:{$product.id}>
            <br/>
            <div id="pimg{$product.id}_div" style="float:left;width:150px;">
              <a {if $product.image} class="colorbox" href="/modules/InternetShop/management/storage/images/products/image/{$product.id}/{$product.image}"
              {else}href="#"{/if}>
                    <img id="pimg{$product.id}" alt="{$product.caption}" title="{$product.caption}" border="0" src="/{if $product.image}modules/InternetShop/management/storage/images/products/image/{$product.id}/preview/{$product.image}{else}modules/InternetShop/img/nopic.gif{/if}" />
                </a>
            {if $settings.show_comments}
                <div style="margin-left:20px;text-align:left;width:110px;height:20px;background-image:url('/modules/InternetShop/img/stars_null.png');background-repeat:repeat-x;">
                    <div style="width:{$points_width}px;height:20px;background-image:url('/modules/InternetShop/img/stars.png');background-repeat:repeat-x;">
                    </div>
                </div>
          <span style="margin-left:45px;font-size:11px;color:#966e4e">
              {if $comments_pages.records_count}{$comments_pages.records_count} {'голосов'|ftext}{else}{'нет голосов'|ftext}{/if}
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
            {$product.description}
                <br/>
                <div style="clear:both;white-space:nowrap;width:100%">
                {if $product.discount_type}
                    <span class="price_caption">
                        {'Скидка:'|ftext}
                    </span>

            <span class="discount">
              {$product.discount}%
            </span>
                    &nbsp;&nbsp;
                {/if}

                    <span class="price_caption">
                    {'Цена:'|ftext}
                    </span>

            <span class="price">
              {$product.price} {$currency.sign}
            </span>

                {if $product.old_price &&  $product.old_price!='0,00'}
                    <span class="price_caption">
              &nbsp;&nbsp;{'Старая цена:'|ftext}
            </span>

            <span class="price_old">
              {$product.old_price} {$currency.sign}
            </span>
                {/if}
                </div>
                <div style="clear:both;width:100%;text-align:right;">
                    <a href="javascript: addToCart('{$product.id}')">
                        <img style="text-a;ign:right" alt="" src="{'/img/buy.png'|ftext}" border="0" />
                    </a>
                    <input type="hidden" style="width:20px" value="1" id="ind{$product.id}" name="ind{$product.id}" />
                </div>

                <div style="clear:both;text-align:right;" id="inShop{$product.id}">
                </div>

                <table style="width:100%" border='0' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td align='left' valign='top'>
                        {if $product.images}
                            <h1>
                                {'Доболнительные изображения товара:'|ftext}
                            </h1>
                            {assign var="k" value=0}
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
                                                <td>
                                                    <a class="colorbox" href="/modules/InternetShop/management/storage/images/products/images/{$product.id}/{$img.name}">
                                                        <img class="ramka" style="margin:3px" src="/modules/InternetShop/management/storage/images/products/images/{$product.id}/preview/{$img.name}" border="0" alt="{$img.description}" />
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                            <span style="font-size:11px">
                                {$img.description}
                            </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                {/foreach}
                                {if $k
                                <3}
                                    <td style="width:100%" colspan="100%">
                                    </td>
                                {/if}
                            </tr>
                            </table>
                        {/if}
                        </td>
                    </tr>
                </table>
                <br/>
                <script type="text/javascript">
                    $(document).ready(showProductAded({
                        $product.id}
                    ));
                </script>
        </td>
    </tr>
    <tr>
        <td style="height:1px;background-color:#e1e5e8" valign="middle" align="center">
        </td>
    </tr>
</table>

{if $comments_pages}
    {if $comments_pages.page_count != ''}
    <table style="width:100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
    <td align='left' valign='center'><h3>{'Отзыв, комментарий'|ftext}:</h3>
        {foreach name="com" from=$comments_records item=list}
            <tr style="height:9px">
                <td></td>
            </tr>
            <tr>
                <td align='left' valign='middle' fastedit:{$table_name_comments}:{$list.id}>
                    <table style="width:100%;background-color:#eff9ff" align='center' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td style="height:25px" align='left' valign='middle'><b>{$list.datetime}&nbsp;&nbsp;  {'оценка:'|ftext} {$list.points}&nbsp;&nbsp; {$list.user_name}:</b></td>
                        </tr>
                        <tr>
                            <td align='left' valign='top'>{$list.comment}</td>
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
                            {'Страница:'|ftext}
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
        <td align='left' valign='center' id="comments_form">
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
            <h3>{'Оставить отзыв'|ftext}</h3>
            <form action='?act=insert_comments&category_id={$smarty.get.category_id}&id={$product.id}#comments_form' method="post">
            {if $comment_is_added}
                <br/>
                <center><h2>{'Благодарим за отзыв! Ваше мнение очень важно для нас. Ваш отзыв обязательно будет размещен, после проверки администратора.'|ftext} </h2></center>
                <br/>
            {/if}
                <p>
                    <input type="hidden" name="datetime" value="" />
                    <input type="hidden" name="product_id" value="{$product.id}" />
                </p>
                <table style="width:100%"  cellpadding="2" cellspacing="2" border="0">
                    <tr>
                        <td style="width:100px">{'Имя:'|ftext}&nbsp;<span style="color:#5acbff">*<span></td>
                        <td><input value="{if $user_name}{$user_name}{else}{$smarty.session.logined_user.contact_name}{/if}"  name="user_name" style="width:330px" /></td>
                    </tr>
                    <tr>
                        <td>{'E-mail:'|ftext}&nbsp;<span style="color:#5acbff">*<span></td>
                        <td><input value="{if $user_email}{$user_email}{else}{$smarty.session.logined_user.email}{/if}" name="user_email" style="width:330px" /></td>
                    </tr>
                    <tr>
                        <td>{'Ваше мнение:'|ftext}&nbsp;<span style="color:#5acbff">*<span></td>
                        <td><select name="points" style="width:330px">
                            <option {if $points==0} selected {/if} value="0" style="color:gray">{'Выберите оценку товару'|ftext}</option>
                            <option {if $post.points==1} selected {/if} value="1">{'Ужасно'|ftext}</option>
                            <option {if $points==2} selected {/if} value="2">{'Плохо'|ftext}</option>
                            <option {if $points==3} selected {/if} value="3">{'Нормально'|ftext}</option>
                            <option {if $points==4} selected {/if} value="4">{'Хорошо'|ftext}</option>
                            <option {if $points==5} selected {/if} value="5">{'Отлично'|ftext}</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="white-space:nowrap" valign="top">{'Комментарий:'|ftext}&nbsp;<span style="color:#5acbff">*<span></td>
                        <td><textarea style="width:330px" rows="5" name="comment" id="comment">{$comment}</textarea></td>
                    </tr>
                {if $settings.kcaptcha==1}
                    <tr>
                        <td align='left' valign='center' style="width:100px">{'Введите код:'|ftext}&nbsp;<span style="color:#5acbff">*<span></td>
                        <td align="left" valign="top">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align='left' valign='center' style="width:120px"><img width="120px" height="50px" id="kcaptcha_img" alt="{'Включите отображеине изображений'|ftext}" src='/tools/kcaptcha/index.php' border='0' /></td>
                                    <td  valign='center' align="center"><input name="kcaptcha" style="width:80px" class="i_black" />
                                        <br/>
                                        <a class="news_navigations" href="javascript:reloadKcaptcha('kcaptcha_img')">{'поменять код'|ftext}</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                {/if}
                    <tr>
                        <td style="height:30px"></td>
                        <td valign="bottom"><input  class="button" type="submit" value="{'Добавить комментарий'|ftext}" name='send_com' /></td>
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
                <div style="clear:left;margin-left:20px;width:110px;height:20px;background-image:url('/modules/InternetShop/img/stars_null.png');background-repeat:repeat-x;">
                    <div style="width:{if $product.comments_points_width}{$product.comments_points_width}{else}0{/if}px;height:20px;background-image:url('/modules/InternetShop/img/stars.png');background-repeat:repeat-x;">
                    </div>
                </div>
        <span style="margin-left:45px;font-size:11px;color:#966e4e">
            {if $product.comments_count}{$product.comments_count} {'голосов'|ftext}{else}{'нет голосов'|ftext}{/if}
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
                        {'Скидка:'|ftext}
                    </span>

        <span class="discount">
          {$product.discount}%
        </span>
                {/if}

                <span class="price_caption">
          &nbsp;&nbsp;{'Цена:'|ftext}
        </span>

        <span class="price">
          {$product.price} {$currency.sign}
        </span>

                {if $product.old_price}
                    <span class="price_caption">
            &nbsp;&nbsp;{'Старая цена:'|ftext}
          </span>

          <span class="price_old">
            {$product.old_price} {$currency.sign}
          </span>
                {/if}
            </div>
            <div style="clear:both;width:100%;text-align:right;">
                <a href="javascript: addToCart('{$product.id}')">
                    <img style="text-a;ign:right" alt="" src="{'/img/buy.png'|ftext}" border="0" />
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
<link media="screen" rel="stylesheet" href="/tools/colorbox/example1/colorbox.css" />
<script type="text/javascript" src="/tools/colorbox/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript">$(document).ready(function(){$(".colorbox").colorbox({rel:'colorbox'});			});</script>
{/literal}
