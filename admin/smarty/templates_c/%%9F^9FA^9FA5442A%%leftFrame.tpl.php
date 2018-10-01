<?php /* Smarty version 2.6.26, created on 2018-09-07 05:39:05
         compiled from leftFrame.tpl */ ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['MSGTEXT']['title_general']; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="css/leftFrame.css" type="text/css" rel="stylesheet">
<script src="Treeview/ua.js"></script>
<script src="Treeview/ftiens4.js"></script>
<script src="js/leftFrame.js"></script>
</head>
<body target="basefrm" onmouseup="parent.frames.basefrm.endPoint();">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="5px" rowspan="100%" class="left"><img width="5px" src="images/zero.gif"></td>
    <td align="left" valign="top"><a target="_blank" href="http://www.goodcms.net"><img style="margin-left:5px" src="images/logo.png" border="0" alt="<?php echo $this->_tpl_vars['MSGTEXT']['created_by']; ?>
"></a></td>
  </tr>
  <tr>
    <td valign="top" width="100%" height="100%">
    <div style="margin:5px">
      <a style="display:none" href="http://www.treemenu.net/" target="_blank"></a> 
<script language="JavaScript">
ICONPATH='Treeview/img/';
USETEXTLINKS = 1
STARTALLOPEN = 0
HIGHLIGHT = 1
PRESERVESTATE = 1
GLOBALTARGET='basefrm';
WRAPTEXT=1;

foldersTree = gFld("<?php echo $this->_tpl_vars['MSGTEXT']['categories_of_pages']; ?>
", "index.php?act=pages&do=category_form")
foldersTree.treeID = "main";
e00 = aux0	= foldersTree;

e2=insDoc(aux0, gLnk("R", "<b><?php echo $this->_tpl_vars['MSGTEXT']['administrators']; ?>
</b>", "index.php?act=administrators&page"));
e3=insDoc(aux0, gLnk("R", "<b><?php echo $this->_tpl_vars['MSGTEXT']['templates']; ?>
</b>", "index.php?act=templates&page"));
e4=insDoc(aux0, gLnk("R", "<b><?php echo $this->_tpl_vars['MSGTEXT']['settings']; ?>
</b>", "index.php?act=settings&page"));
e5=insDoc(aux0, gLnk("R", "<b><?php echo $this->_tpl_vars['MSGTEXT']['modules']; ?>
</b>", "index.php?act=modules&page"));
e9=insDoc(aux0, gLnk("R", "<b><?php echo $this->_tpl_vars['MSGTEXT']['mailer']; ?>
</b>", "index.php?act=mailer&page"));
e6=insDoc(aux0, gLnk("R", "<b><?php echo $this->_tpl_vars['MSGTEXT']['css_styles']; ?>
</b>", "index.php?act=css&page"));
e7=insDoc(aux0, gLnk("R", "<b><?php echo $this->_tpl_vars['MSGTEXT']['work_with_bd']; ?>
</b>", "index.php?act=dumper&page&id=1"));
e8=insDoc(aux0, gLnk("T", "<b><?php echo $this->_tpl_vars['MSGTEXT']['logout']; ?>
</b>", "index.php?act=logout"));
e0=insDoc(aux0, gLnk("R", "<?php echo $this->_tpl_vars['MSGTEXT']['all_pages']; ?>
", "index.php?act=pages"));
e1=insDoc(aux0, gLnk("R", "<?php echo $this->_tpl_vars['MSGTEXT']['pages_without_category']; ?>
", "index.php?act=pages&pageCategoryId=0"));

e00.iconSrc = ICONPATH + "base.gif"
e0.iconSrc = ICONPATH + "parent.gif"
e1.iconSrc = ICONPATH + "parent.gif"
e2.iconSrc = ICONPATH + "admins.png"
e3.iconSrc = ICONPATH + "templates.png"
e4.iconSrc = ICONPATH + "settings.png"
e5.iconSrc = ICONPATH + "modules.png"
e6.iconSrc = ICONPATH + "css.png"
e7.iconSrc = ICONPATH + "database.png"
e8.iconSrc = ICONPATH + "logout.png"
e9.iconSrc = ICONPATH + "email.png"

e8.maySelect=0;

<?php if ($this->_tpl_vars['pCategoriesAndPages']): ?>
<?php $_from = $this->_tpl_vars['pCategoriesAndPages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cat'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cat']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list']):
        $this->_foreach['cat']['iteration']++;
?>
<?php if ($this->_tpl_vars['list']['id']): ?>
<?php if ($this->_foreach['cat']['iteration'] == 1): ?>
aux<?php echo $this->_tpl_vars['list']['id']; ?>
= insFld(aux0, gFld("<?php echo $this->_tpl_vars['list']['name']; ?>
", "index.php?act=pages&pageCategoryId=<?php echo $this->_tpl_vars['list']['id']; ?>
"));
<?php else: ?>
aux<?php echo $this->_tpl_vars['list']['id']; ?>
= insFld(aux<?php echo $this->_tpl_vars['list']['parent']; ?>
, gFld("<?php echo $this->_tpl_vars['list']['name']; ?>
", "index.php?act=pages&pageCategoryId=<?php echo $this->_tpl_vars['list']['id']; ?>
"));
<?php endif; ?><?php endif; ?>
<?php if ($this->_tpl_vars['list']['pages']): ?>
<?php $_from = $this->_tpl_vars['list']['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
insDoc(aux<?php if ($this->_tpl_vars['list']['id']): ?><?php echo $this->_tpl_vars['list']['id']; ?>
<?php else: ?>0<?php endif; ?>, gLnk("R", "<?php if ($this->_tpl_vars['page']['description']): ?><?php if ($this->_tpl_vars['page']['selected']): ?><div class='page_selected'><?php echo $this->_tpl_vars['page']['description']; ?>
</div><?php else: ?><?php echo $this->_tpl_vars['page']['description']; ?>
<?php endif; ?><?php else: ?><?php if ($this->_tpl_vars['page']['selected']): ?><div class='page_selected'><?php echo $this->_tpl_vars['page']['name']; ?>
</div><?php else: ?><?php echo $this->_tpl_vars['page']['name']; ?>
<?php endif; ?><?php endif; ?>", "index.php?act=pages&page_id=<?php echo $this->_tpl_vars['page']['id']; ?>
&pageCategoryId=<?php if ($this->_tpl_vars['list']['id']): ?><?php echo $this->_tpl_vars['list']['id']; ?>
<?php else: ?>0<?php endif; ?>"));

<?php endforeach; endif; unset($_from); ?><?php endif; ?><?php endforeach; endif; unset($_from); ?><?php endif; ?>

var initializeTREE=initializeDocument();

<?php if ($this->_tpl_vars['format_url']): ?>
	reselectTree('<?php echo $this->_tpl_vars['format_url']; ?>
');
<?php endif; ?>

</SCRIPT>
	</td>
  	</tr>
	</table>
</div>
</body>
</html>