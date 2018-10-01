<div fastedit::>  
  {foreach name="products" from=$datalist item=item}
  <div style="float:left;width:33%;margin-right:10px;" fastedit:{$table_name}:{$item.id}>        
    <div style="height:220px;">
      {if $item.image}
      <a href="?act=more&id={$item.id}">
        <img alt="{$item.caption}" class="ramka" style="margin:3px" src="/modules/Photogallery/management/storage/images/data/image/{$item.id}/preview/{$item.image}" border="0" />
      </a>
      {/if}
    </div>
    <div>
      <a href="?act=more&id={$item.id}">
        <b>
          {$item.caption}
        </b>
      </a>
    </div>               
  </div>
  {/foreach}    
</div>