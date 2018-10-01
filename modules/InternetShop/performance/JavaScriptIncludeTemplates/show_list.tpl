{literal}
<script type="text/javascript">
if(window.jQuery==undefined) {
	document.write(unescape("%3Cscript src='/tools/js/jquery.js' type='text/javascript'%3E%3C/script%3E"));
	}
  	document.write(unescape("%3Cscript src='/tools/js/jquery.json.js' type='text/javascript'%3E%3C/script%3E"));  
</script>
{/literal}
<script type="text/javascript" src="/modules/{$moduleInfo.module_name}/shopcart.js"></script>
<script type="text/javascript">
var round_price_to  = {$round_price_to};
{if $shopingcart}
var shopingcart 	= {$shopingcart};
{else}
var shopingcart 	= "";
{/if}
</script>

