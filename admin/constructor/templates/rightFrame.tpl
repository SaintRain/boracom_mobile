<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>{$MSGTEXT.title_general}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="css/general.css" type="text/css" rel="stylesheet">
{if !$hide_menu}
<script type="text/javascript" >
{literal}

var NameBrouser = getNameBrouser();
function getNameBrouser() {
	var ua = navigator.userAgent.toLowerCase();
	if (ua.indexOf("msie") != -1 && ua.indexOf("opera") == -1 && ua.indexOf("webtv") == -1) { return "msie"}
	if (ua.indexOf("opera") != -1) { return "opera"}
	if (ua.indexOf("gecko") != -1) {return "gecko";}
	if (ua.indexOf("safari") != -1) {return "safari";}
	if (ua.indexOf("konqueror") != -1) {return "konqueror";}
	return "unknown";
}


function doDown (e) {
	reloadPage=false;
	if (NameBrouser=='msie') {
		if (event.keyCode == 116) {
			event.keyCode = 0;
			event.cancelBubble = true;
			reloadPage=true;		}
	}
	else {
		if (e.keyCode == 116) {
			e.stopPropagation();
			reloadPage=true;
		}
	}
	if (reloadPage) {
		window.parent.treeframe.location.reload();
		window.parent.basefrm.location.reload()
		return false;
	}
};
window.document.onkeydown = doDown;
{/literal}

var MSGTEXT= new Array();
MSGTEXT["lib_js_hide_menu"]="{$MSGTEXT.lib_js_hide_menu}";
MSGTEXT["lib_js_show_menu"]="{$MSGTEXT.lib_js_show_menu}";
var qs="{$qs}";
</script>
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript" src="js/images.js"></script>
{/if}

</head>
<body {if !$hide_menu}onmouseup="endPoint()"{/if}>
<div id="frameBlock" align="center" style="display:none; z-index:100000; position:absolute; width:100%; height:100%;opacity:0.7;-moz-opacity:0.7;filter:alpha(opacity=70); background: white; "></div>
<div id="frameBlock2" align="center" style="display:none; z-index:100100; position:absolute; width:100%; height:100%;">
  <table height="100%" border="0" >
    <tr>
      <td valign="middle"><font id="frameContentBlock"></font></td>
    </tr>
  </table>
</div>
{if !$hide_menu}
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" style="position:absolute">
  <td onmousedown="startPoint()" class="flitter" valign="top" align="left"><img onmousedown="endPoint(event)" name="show_hide_but" onmouseover="on('show_hide_but')" onmouseout= "off()" id="hidebutton" onclick="show_hide('adminmenu')" style="margin-top:180px; margin-left:0px; z-index:100;" class="ukaz" border="0" title="{if $smarty.const.SETTINGS_LEFT_FRAME_WIDTH==0 || $smarty.cookies.display_ctr_menu=='false'}{$MSGTEXT.show_menu}{else}{$MSGTEXT.hide_menu}{/if}" src="images/m_hide.png"></td>
  <td><img width="15px" src="images/zero.gif"></td>
  <td style="width:100%;height:100%" valign="top">
  <table border="0" width="100%" height="100%"  cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td valign="top" height="100%">
      <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td>
            		 <table height="26px" align="left" cellpadding="0" cellspacing="0" border="0">                      
                        <td><a target="_top" href="../main.php?act=modules&page"><img alt="{$MSGTEXT.leftFrame_const_back_cms}" title="{$MSGTEXT.leftFrame_const_back_cms}" src="images/back.png" border="0"></a>
                        <td width="5px">&nbsp;</td>
                        <td nowrap><a class="links" target="_top" href="../main.php?act=modules&page">{$MSGTEXT.leftFrame_const_back_cms}</a></td>
                        <td width="15px">&nbsp;</td>
                  
                        <td><a href="?act=m_c&do=add"><img alt="{$MSGTEXT.rightFrame_const_create_mod}" title="{$MSGTEXT.rightFrame_const_create_mod}" src="images/blockdevice.png" border="0"></a>
                        <td width="5px">&nbsp;</td>
                        <td nowrap><a class="links" href="?act=m_c&do=add">{$MSGTEXT.rightFrame_const_create_mod}</a></td>
                        <td width="15px">&nbsp;</td>
                                                
                        <td valign="middle"><a href="?act=t_c&do=add"><img border="0" title="{$MSGTEXT.rightFrame_const_create_table}" src='images/instable.gif'></a></td>
                        <td width="5px">&nbsp;</td>
                        <td valign="middle" nowrap><a class="links" href="?act=t_c&do=add">{$MSGTEXT.rightFrame_const_create_table}</a>&nbsp; </td>
                        <td width="15px">&nbsp;</td>                    
                    
                        <td valign="middle"><a href="?act=b_c&do=add"><img border="0" title="{$MSGTEXT.rightFrame_const_create_block}" src='images/block.gif'></a></td>
                        <td width="5px">&nbsp;</td>
                        <td valign="middle" nowrap><a class="links" href="?act=b_c&do=add">{$MSGTEXT.rightFrame_const_create_block}</a>&nbsp; </td>
                        <td width="15px">&nbsp;</td>                                                                  
                  
                        <td valign="middle"><a  href="?act=m_c&do=import_work_module"><img border="0" title="{$MSGTEXT.rightFrame_const_mod_in_admin}" src='images/load_module.png'></a></td>
                        <td width="5px">&nbsp;</td>
                        <td nowrap><a class="links" href="?act=m_c&do=import_work_module">{$MSGTEXT.rightFrame_const_mod_in_admin}</a>&nbsp; </td>
                        <td width="15px">&nbsp;</td>
                  
                    {if $CurrentModule.loaded==1}
                  
                        <td valign="middle"><a href="?act=m_c&do=save_work_module"><img border="0" title="{$MSGTEXT.rightFrame_const_save_change}" width="16px" src='images/commit.png'></a></td>
                        <td width="5px">&nbsp;</td>
                        <td  nowrap><a class="links" style="{if $CurrentModule.need_save>0}color:#800000{/if}" href="?act=m_c&do=save_work_module">{$MSGTEXT.rightFrame_const_save_change}</a>&nbsp; </td>
                        <td width="15px">&nbsp;</td>
                  
                    {/if}                    
                    
                    {if $smarty.session.___GoodCMS.m_id}
                        <td valign="middle"><a href="act=compiler&m_id={$smarty.session.___GoodCMS.m_id}"><img border="0" title="{$MSGTEXT.rightFrame_const_compile_mod}" src='images/compile.png'></a></td>
                        <td width="5px">&nbsp;</td>
                        <td valign="middle" nowrap><a class="links" style="{if $CurrentModule.need_save==1 && $CurrentModule.loaded==0}color:red{/if}" href="?act=compiler&m_id={$smarty.session.___GoodCMS.m_id}">{$MSGTEXT.rightFrame_const_compile_mod}</a>&nbsp; </td>                                         
                    {/if} 
                    </table>
                    </td>
                <tr>
              </table>
              {/if}
              <h5 {if $hide_menu} style="padding-right:10px;padding-left:10px;margin-top:-70px"{/if}>{$content_head}</h5>
              {include file="$content_template"}
              {include file="$pages_template"} </td>
            <td><img src="images/zero.gif" width="2px"></td>
          </tr>
          
	<tr>
		<td valign="bottom" align="right">
		<table cellpadding="2" cellspacing="0" border="0" style="margin-top:50px">
			<tr>
				<td>
				<table align="right" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td><img border="0" hspace="5" src="{if $smarty.session.___GoodCMS.CMS_CTR_ACTIVE}images/activated.png{else}images/notactivated.png{/if}"></td>
						<td style="font-size: 10px" color="#23326C">{if $smarty.session.___GoodCMS.CMS_CTR_ACTIVE}<b>{$MSGTEXT.the_ctr_is_activated}</b>{else}<a
							style="color: red" target="_blank" href="http://www.goodcms.net">{$MSGTEXT.to_activate_the_ctr}</a>{/if}</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td align="right" style="font-size: 10px" color="#23326C">GoodCMS Constructor v{$smarty.const.CMS_VERSION} All rights reserved © 2012</td>
			</tr>
		</table>	
	</tr>
	          
        </table>
        
<script language="JavaScript">	
var newLeftFrameWidth={$smarty.const.SETTINGS_CTR_LEFT_FRAME_WIDTH};	 
</script>
        
	
	
	
</body>
</html>