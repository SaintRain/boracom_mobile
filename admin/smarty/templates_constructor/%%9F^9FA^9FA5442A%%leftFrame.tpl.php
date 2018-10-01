<?php /* Smarty version 2.6.26, created on 2014-09-14 09:29:57
         compiled from leftFrame.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'leftFrame.tpl', 112, false),)), $this); ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['MSGTEXT']['title_general']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="css/leftFrame.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="dtree/dtree.js"></script>
<?php echo '
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
	if (NameBrouser==\'msie\') {
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
	parent.document.location=\'main.php?act=m_c&m_id=\'+obj.value;
}


function reselectTree(url) {
	for (var n=0; n<d.aNodes.length; n++) {
		if (d.aNodes[n].url==url) {
			d.setCookie(\'cs\' + d.obj, d.aNodes[n].id);
			d.openTo(d.aNodes[n].id, true, false);
			eNew = document.getElementById("sd" + n);
			eNew.className = "nodeSel";
			d.selectedNode = n;
			break;
		}
	}
}
</script>
'; ?>

</head>
<body target="basefrm" onmouseup="parent.frames.basefrm.endPoint();">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="5px" rowspan="100%" class="left"><img width="5px" src="images/zero.gif"></td>
    <td height="50px" align="left" valign="top"><a target="_blank" href="http://www.goodcms.net"><img  style="margin-left:5px;margin-top:5px" src="images/logo.png" border="0" alt="<?php echo $this->_tpl_vars['MSGTEXT']['created_by']; ?>
"></a></td>
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
              <option value="0" style="color:gray"><?php echo $this->_tpl_vars['MSGTEXT']['leftFrame_const_select_mod']; ?>

              <?php $_from = $this->_tpl_vars['allModules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>
              <option value="<?php echo $this->_tpl_vars['module']['id']; ?>
" <?php if ($_SESSION['___GoodCMS']['m_id'] == $this->_tpl_vars['module']['id']): ?> selected <?php endif; ?> ><?php echo $this->_tpl_vars['module']['name']; ?>

              <?php endforeach; endif; unset($_from); ?>
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
    <a style="display:none" href="http://www.treemenu.net/" target="_blank"></a> <?php if ($_SESSION['___GoodCMS']['m_id'] <> 0): ?> 
    
    <script language="JavaScript">
    
    d = new dTree('d');
    d.add("?act=m_c",-1,"<?php echo $this->_tpl_vars['MSGTEXT']['leftFrame_const_mod_properties']; ?>
",'?act=m_c&m_id=<?php echo $_SESSION['___GoodCMS']['m_id']; ?>
','','','dtree/img/mnu_fileman.gif','dtree/img/mnu_fileman.gif');    
    d.add('?act=t_c', "?act=m_c","<?php echo $this->_tpl_vars['MSGTEXT']['leftFrame_const_table']; ?>
",'?act=t_c','','','dtree/img/base.gif','dtree/img/base_select.gif');
    <?php $_from = $this->_tpl_vars['allTables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['table']):
?>
    d.add("?act=t_c&t_id=<?php echo $this->_tpl_vars['table']['id']; ?>
",'?act=t_c',"<?php echo ((is_array($_tmp=$this->_tpl_vars['CurrentModule']['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
_<?php echo $this->_tpl_vars['table']['name']; ?>
","?act=t_c&t_id=<?php echo $this->_tpl_vars['table']['id']; ?>
",'','','dtree/img/instable.gif','dtree/img/t_settings.gif');
    <?php endforeach; endif; unset($_from); ?>
    
    d.add('?act=b_c', '?act=m_c','<?php echo $this->_tpl_vars['MSGTEXT']['leftFrame_const_block']; ?>
','?act=b_c','','','dtree/img/base.gif','dtree/img/base_select.gif');
    <?php $_from = $this->_tpl_vars['allBlocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
    d.add("?act=b_c&b_id=<?php echo $this->_tpl_vars['block']['id']; ?>
",		'?act=b_c',					"<?php echo $this->_tpl_vars['block']['description']; ?>
",		"?act=b_c&b_id=<?php echo $this->_tpl_vars['block']['id']; ?>
",	'',	'', 'dtree/img/base2.gif','dtree/img/base3.gif');
    d.add("?act=b_temp_c&b_id=<?php echo $this->_tpl_vars['block']['id']; ?>
",	"?act=b_c&b_id=<?php echo $this->_tpl_vars['block']['id']; ?>
","<?php echo $this->_tpl_vars['MSGTEXT']['leftFrame_const_tamplate']; ?>
<?php if ($this->_tpl_vars['block']['tpl_count'] > 0): ?> (<?php echo $this->_tpl_vars['block']['tpl_count']; ?>
)<?php endif; ?>",					"?act=b_temp_c&b_id=<?php echo $this->_tpl_vars['block']['id']; ?>
",	'', '', 'dtree/img/iblock.gif','dtree/img/iblock.gif');
    <?php endforeach; endif; unset($_from); ?>
    
    d.add('?act=b_s_c', "?act=m_c",'<?php echo $this->_tpl_vars['MSGTEXT']['leftFrame_const_variebles_block']; ?>
','?act=b_s_c','','','dtree/img/base.gif','dtree/img/base_select.gif');
    
    document.write(d);

    <?php if ($_SESSION['___GoodCMS']['pageID']): ?>
    var pageID="<?php echo $_SESSION['___GoodCMS']['pageID']; ?>
";
    <?php echo '

    for (var n=0; n<d.aNodes.length; n++) {

    	if (d.aNodes[n].id==pageID) {
    		d.setCookie(\'cs\' + d.obj, d.aNodes[n].id);
    		d.openTo(d.aNodes[n].id, true, false);

    		eNew = document.getElementById("sd" + n);
    		eNew.className = "nodeSel";
    		d.selectedNode = n;
    		break;
    	}
    }
    '; ?>

    <?php endif; ?>
    
    </script>
    <?php endif; ?>
		</td>
        <td><img width="5px" src="images/zero.gif"></td>
        </tr>
        
        </table>
      </td>
  </tr>
</table>
</body>
</html>