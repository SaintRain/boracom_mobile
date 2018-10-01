<table style="position:realitive" border="0" cellpadding="0" cellspacing="0" >
<tr>
<td>
{if $smarty.get.hide_menu_propetries}
	<h5 id="pageHeaderCaption" style="padding-right:10px;padding-left:10px;margin-top:10px; margin-bottom:10px"> {$MSGTEXT.edit_style} 
	<a class="headLink" href="#">{if $page.description}{$page.description}{else}{$page.name}{/if}</a> {$MSGTEXT.on_page}<span style="color:yellow">«{$edit_block.virtualtagname}»</span></h5>
{else}
	<h5 id="pageHeaderCaption">{if $smarty.get.hide_menu}&nbsp;{/if}{$MSGTEXT.edit_style} «<a class="headLink" href="?act=pages&page_id={$page.id}&pageCategoryId={$page.page_category}">{if $page.description}{$page.description}{else}{$page.name}{/if}</a>»{$MSGTEXT.on_page} <span style="color:yellow">«{$edit_block.virtualtagname}»</span></h5>
{/if}
</td>
<td>&nbsp;&nbsp;</td>
<td>
<div class="menu_propetries" style="margin-top:-17px">
    <ul> 
        <li>        
        <a class="hide" href=""><img  border="0" src="images/menu_properties.png" /></a>
            <ul class="menu_ten">            
            	{foreach name='block' from=$blocks item=block}
            	<li style="cursor:pointer;width:100%" onclick="{if $block.block_name && $block.general_table_id>0}location.href='?act=modules&do=managedata&page_id={$page.id}&tag_id={$block.virtualtag_id}&page=1{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}'{else}alert('{if $block.block_name==''}{$MSGTEXT.cannot_edit_empty_tag}{else}{$MSGTEXT.cannot_edit_block}{/if}');{/if}" id="zakladka_center{$smarty.foreach.block.iteration}_{$smarty.foreach.zakladka.iteration}" >            	            	
                	<a
					{if $block.virtualtag_id==$smarty.get.tag_id} style="background:#d3ecff;" {/if}
                	{if $block.block_id>0}
						{if $block.global==1 && $block.general_table_id>0}
							class="zakladka_blue"
						{else}
						{if $block.global==2 && $block.general_table_id>0}
							class="zakladka_maroon"
        					{else}
        						{if $block.block_name && $block.general_table_id>0}
        							{if $block.virtualtag_id==$smarty.get.tag_id} 
        								
        							{else}
        								class="zakladka"
        							{/if}
        						{else}
        							class="zakladka_disabled"
        						{/if}
        					{/if}
        				{/if}
        				{else}
        					class="zakladka_disabled"
        				{/if}>&nbsp;&nbsp;{$block.virtualtagname}&nbsp;&nbsp;</a>        	        	
        		</li>            	            	
        		{/foreach}            	            
       </li>            	            	
    </ul> 
</div>
</td>
</tr>
</table>


<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
  <tr>
    <td height="2px" class="tabs_lc_top"><img height="2px" width="2px" src="images/zero.gif"></td>
    <td width="100%" height="2px" class="topline"><img height="2px" src="images/zero.gif"></td>
    <td width="2px" height="2px" class="tabs_rc_top"><img height="2px" width="2px" src="images/zero.gif"></td>
  </tr>
</table>


{literal}
<script type="text/javascript">
var predObg='';
function setActiveTab(obg) {
	obg.bgColor='blue';
	if (predObg!='') predObg.bgColor='red';
	predObg=obg;
}

function setLang(el) {
	var time = Math.random();
	value	= el.value;

	xmlHttp.open("GET", "ajax.php?func=updateGSettins&caption=SETTINGS_LANGUAGE_OF_MATERIALS&value="+value+"&time="+time ,false);
	xmlHttp.onreadystatechange=setContentToEditField;
	xmlHttp.send(null);
}

function setContentToEditField() {
	if (xmlHttp.readyState == 4) {
		var response = xmlHttp.responseText;
		{/literal}
		location.href="index.php?act=modules&do=managedata&page_id={$smarty.get.page_id}&tag_id={$smarty.get.tag_id}{if $smarty.get.id}&id={$smarty.get.id}{/if}{if $smarty.get.p}&p={$smarty.get.p}{/if}{if $smarty.get.t_name}&t_name={$smarty.get.t_name}{/if}{if $smarty.get.hide_menu}&hide_menu=true{/if}{if $smarty.get.fastEdit}&fastEdit=true{/if}";
		{literal}
	}
}
</script>
{/literal}