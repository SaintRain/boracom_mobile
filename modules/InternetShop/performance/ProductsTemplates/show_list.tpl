<div fastedit::>
{if $products}
  <div style="float:left;margin-top:3px;width:30%;height:23px">
    {'Показывать товаров по'|ftext}&nbsp; 
    <a {if $smarty.session.records_for_products_page==5}class="step_selected"{else}class="step"{/if} href="?category_id={$category.id}&for_page=5">5</a>/ 
    <a {if $smarty.session.records_for_products_page==10}class="step_selected"{else}class="step"{/if} href="?category_id={$category.id}&for_page=10">10</a>/ 
    <a {if $smarty.session.records_for_products_page==15}class="step_selected"{else}class="step"{/if} href="?category_id={$category.id}&for_page=15">15</a>
  </div>
  <div style="float:left;width:70%;text-align:right;height:23px">
    {'Страница:'|ftext}
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
    <div id="pimg{$product.id}_div" style="float:left;width:150px;">
      <a href="?act=more&category_id={$product.category_id}&id={$product.id}">
        <img id="pimg{$product.id}" alt="{$product.caption}" title="{$product.caption}" border="0" src="/{if $product.image}modules/InternetShop/management/storage/images/products/image/{$product.id}/preview/{$product.image}{else}modules/InternetShop/img/nopic.gif{/if}" />
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
    {'Показывать товаров по'|ftext}&nbsp; 
    <a {if $smarty.session.records_for_products_page==5}class="step_selected"{else}class="step"{/if} href="?category_id={$category.id}&for_page=5">5</a>/ 
    <a {if $smarty.session.records_for_products_page==10}class="step_selected"{else}class="step"{/if} href="?category_id={$category.id}&for_page=10">10</a>/ 
    <a {if $smarty.session.records_for_products_page==15}class="step_selected"{else}class="step"{/if} href="?category_id={$category.id}&for_page=15">15</a>
  </div>
  <div style="float:left;width:70%;margin-top:5px;text-align:right;">
    {'Страница:'|ftext}
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
	<h1>{'В данной категории нет товаров'|ftext}</h1>
{/if}
</div>