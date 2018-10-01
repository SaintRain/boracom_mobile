<html>
<head>
<title>{$MSGTEXT.title_general}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="css/leftFrame.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="dtree/dtree.js"></script>
{literal}
<script language="JavaScript">
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
		window.parent.basefrm.location.reload();
		return false;
	}
};

window.document.onkeydown = doDown;


function setCurrentModule(obj) {
	parent.document.location='main.php?act=m_c&m_id='+obj.value;
}


function reselectTree(url) {
	for (var n=0; n<d.aNodes.length; n++) {
		if (d.aNodes[n].url==url) {
			d.setCookie('cs' + d.obj, d.aNodes[n].id);
			d.openTo(d.aNodes[n].id, true, false);
			eNew = document.getElementById("sd" + n);
			eNew.className = "nodeSel";
			d.selectedNode = n;
			break;
		}
	}
}
</script>
{/literal}
</head>
<body target="basefrm" onmouseup="parent.frames.basefrm.endPoint();">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="5px" rowspan="100%" class="left"><img width="5px" src="images/zero.gif"></td>
    <td height="50px" align="left" valign="top"><a target="_blank" href="http://www.goodcms.net"><img  style="margin-left:5px;margin-top:5px" src="images/logo.png" border="0" alt="{$MSGTEXT.created_by}"></a></td>
  </tr>
  <tr>
    <td valign="top" height="40px">              
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10px"></td>
        </tr>
        <tr>
          <td height="10px" valign="top">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
          <td><img width="5px" src="images/zero.gif"></td>
          <td width="100%">
          <select id="module_id" onchange="setCurrentModule(this)" style="background-color:#FFF9E5;width:100%">
              <option value="0" style="color:gray">{$MSGTEXT.leftFrame_const_select_mod}
              {foreach from=$allModules item=module}
              <option value="{$module.id}" {if $smarty.session.___GoodCMS.m_id==$module.id} selected {/if} >{$module.name}
              {/foreach}
            </select>
            </td>
            <td><img width="5px" src="images/zero.gif"></td>
           </tr> 
           </table>
            </td>
        </tr>
      </table>
      </td>
  </tr>
  <tr><td valign="top" width="100%">
       <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
          <td><img width="5px" src="images/zero.gif"></td>
          <td>
    <a style="display:none" href="http://www.treemenu.net/" target="_blank"></a> {if $smarty.session.___GoodCMS.m_id<>0} 
    
    <script language="JavaScript">
    
    d = new dTree('d');
    d.add("?act=m_c",-1,"{$MSGTEXT.leftFrame_const_mod_properties}",'?act=m_c&m_id={$smarty.session.___GoodCMS.m_id}','','','dtree/img/mnu_fileman.gif','dtree/img/mnu_fileman.gif');    
    d.add('?act=t_c', "?act=m_c","{$MSGTEXT.leftFrame_const_table}",'?act=t_c','','','dtree/img/base.gif','dtree/img/base_select.gif');
    {foreach from=$allTables item=table}
    d.add("?act=t_c&t_id={$table.id}",'?act=t_c',"{$CurrentModule.name|lower}_{$table.name}","?act=t_c&t_id={$table.id}",'','','dtree/img/instable.gif','dtree/img/t_settings.gif');
    {/foreach}
    
    d.add('?act=b_c', '?act=m_c','{$MSGTEXT.leftFrame_const_block}','?act=b_c','','','dtree/img/base.gif','dtree/img/base_select.gif');
    {foreach from=$allBlocks item=block}
    d.add("?act=b_c&b_id={$block.id}",		'?act=b_c',					"{$block.description}",		"?act=b_c&b_id={$block.id}",	'',	'', 'dtree/img/base2.gif','dtree/img/base3.gif');
    d.add("?act=b_temp_c&b_id={$block.id}",	"?act=b_c&b_id={$block.id}","{$MSGTEXT.leftFrame_const_tamplate}{if $block.tpl_count>0} ({$block.tpl_count}){/if}",					"?act=b_temp_c&b_id={$block.id}",	'', '', 'dtree/img/iblock.gif','dtree/img/iblock.gif');
    {/foreach}
    
    d.add('?act=b_s_c', "?act=m_c",'{$MSGTEXT.leftFrame_const_variebles_block}','?act=b_s_c','','','dtree/img/base.gif','dtree/img/base_select.gif');
    
    document.write(d);

    {if $smarty.session.___GoodCMS.pageID}
    var pageID="{$smarty.session.___GoodCMS.pageID}";
    {literal}

    for (var n=0; n<d.aNodes.length; n++) {

    	if (d.aNodes[n].id==pageID) {
    		d.setCookie('cs' + d.obj, d.aNodes[n].id);
    		d.openTo(d.aNodes[n].id, true, false);

    		eNew = document.getElementById("sd" + n);
    		eNew.className = "nodeSel";
    		d.selectedNode = n;
    		break;
    	}
    }
    {/literal}
    {/if}
    
    </script>
    {/if}
		</td>
        <td><img width="5px" src="images/zero.gif"></td>
        </tr>
        
        </table>
      </td>
  </tr>
</table>
</body>
</html>