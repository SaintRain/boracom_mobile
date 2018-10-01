<div fastedit:{$table_name}:{$category.id}>
  <div style="margin-left:0px;margin-right:10px">    
      <a href="javascript:history.back();">
        &larr; {'Вернуться назад'|ftext}
      </a>
    <br/>
    <br/>
    <b>
      <span color="#035f6e">
        {$category.caption}
      </span>
    </b>
    <br/>
    <br/>
      <span color="#035f6e">
        {$category.description}
      </span>
    <br/>
        
    {if $category.images}
    {foreach from=$category.images item=img}
    <div style="float:left;width:{$width}%;margin:5px">
      <div style="float:left;width:100%;height:160px;border:1px #e1e5e8 solid;">        
        <a href="/modules/Photogallery/management/storage/images/data/images/{$category.id}/{$img.name}" class="colorbox">          
          <img alt="{$img.description}" style="margin:3px" src="/modules/Photogallery/management/storage/images/data/images/{$category.id}/preview/{$img.name}" border="0" />
        </a>
      </div>
      <div style="float:left;width:100%;font-size:11px;margin-top:5px">                
          {$img.description}
      </div>      
    </div>
    {/foreach}
    {/if}       	             
  </div>
</div>


{literal} 
<script type="text/javascript">
if(window.jQuery==undefined) {
	document.write(unescape("%3Cscript src='/tools/js/jquery.js' type='text/javascript'%3E%3C/script%3E"));
	}
</script>
<link media="screen" rel="stylesheet" href="/tools/colorbox/example1/colorbox.css" />
<script type="text/javascript" src="/tools/colorbox/colorbox/jquery.colorbox.js"></script> 
<script type="text/javascript">$(document).ready(function(){$(".colorbox").colorbox({rel:'colorbox'});			});</script> 
{/literal}