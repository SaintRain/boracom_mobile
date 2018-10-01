{literal} 
<script language="JavaScript">
function selectMe(obj_number) {
	GetElementById('zakladka_left'+obj_number).className		= 'lcmenu_selected';
	GetElementById('zakladka_center'+obj_number).className		= 'fonbcmenu_selected';
	GetElementById('zakladka_right'+obj_number).className		= 'rcmenu_selected';

}


function unselectMe(obj_number) {
	GetElementById('zakladka_left'+obj_number).className		= 'lcmenu';
	GetElementById('zakladka_center'+obj_number).className		= 'fonbcmenu';
	GetElementById('zakladka_right'+obj_number).className		= 'rcmenu';
}
</script>
{/literal}
{if !$smarty.get.hide_menu}
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  {foreach name="zakladka" from=$zakladky_bd item=zakladka}
  <tr>
      <td width="100%" colspan="100%" valign="bottom">
    <table style="margin:0px;width:100%" align="left" cellpadding="0" cellspacing="0" border="0">
      <tr> {foreach name='block' from=$zakladka item=block}
        <td id="zakladka_left{$smarty.foreach.block.iteration}_{$smarty.foreach.zakladka.iteration}" height="25px" width="7px" class="lcmenu{if $block.id==$smarty.get.id}_a{/if}"><img width="7px" src="images/zero.gif"></td>
          <td align="left" style="cursor:pointer;{if $smarty.foreach.block.last} width:100%{/if}" onclick="location.href='index.php?act=dumper&page&id={$block.id}'" id="zakladka_center{$smarty.foreach.block.iteration}_{$smarty.foreach.zakladka.iteration}" {if $block.id!=$smarty.get.id}} onmousemove="selectMe('{$smarty.foreach.block.iteration}_{$smarty.foreach.zakladka.iteration}')" onmouseout="unselectMe('{$smarty.foreach.block.iteration}_{$smarty.foreach.zakladka.iteration}')" {/if} nowrap class="fonbcmenu{if $block.id==$smarty.get.id}_a{/if}" onclick="setActiveTab(this)">
        <font {if $block.id==$smarty.get.id} class="zakladka_active"{else}class="zakladka"{/if}>{$block.virtualtagname}</font>
        </td>      
        <td id="zakladka_right{$smarty.foreach.block.iteration}_{$smarty.foreach.zakladka.iteration}" width="7px" height="25px" class="rcmenu{if $block.id==$smarty.get.id}_a{/if}"><img width="7px" src="images/zero.gif"></td>
        {/foreach} </tr>
    </table>
      </td>
  </tr>
  {/foreach}
  <tr>
    <td width="2px" class="leftline"><img width="2px" src="images/zero.gif"></td>
    <td width="100%"><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td valign="top" height="11px" width="100%" class="bottomcmenu"></td>
        </tr>
      </table></td>
    <td width="2px" class="rightline"><img width="2px" src="images/zero.gif"></td>
  </tr>
</table>
{/if}
{literal} 
<script type="text/javascript">
var predObg='';
function setActiveTab(obg) {
	obg.bgColor='blue';
	if (predObg!='') predObg.bgColor='red';
	predObg=obg;
}
</script>
{/literal}
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="2px" class="leftline"><img width="2px" src="images/zero.gif"></td>
    <td bgcolor="#66a4d3"><table width="100%" cellpadding="5" cellspacing="5" border="0">
        <tr>
          <td valign="top"> {$zakladky_bd_content} </td>
        </tr>
      </table></td>
    <td width="2px" class="rightline"><img width="2px" src="images/zero.gif"></td>
  </tr>
  <tr>
    <td idth="2px" height="2px" class="tabs_lc"><img height="2px" width="2px" src="images/zero.gif"></td>
    <td width="100%" height="2px" class="bottomline"><img height="2px" src="images/zero.gif"></td>
    <td width="2px" height="2px" class="tabs_rc"><img height="2px" width="2px" src="images/zero.gif"></td>
  </tr>
</table>