<html>
<head>
<title>{$MSGTEXT.title_general}</title>
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
    <td align="left" valign="top"><a target="_blank" href="http://www.goodcms.net"><img style="margin-left:5px" src="images/logo.png" border="0" alt="{$MSGTEXT.created_by}"></a></td>
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

foldersTree = gFld("{$MSGTEXT.categories_of_pages}", "index.php?act=pages&do=category_form")
foldersTree.treeID = "main";
e00 = aux0	= foldersTree;

e2=insDoc(aux0, gLnk("R", "<b>{$MSGTEXT.administrators}</b>", "index.php?act=administrators&page"));
e3=insDoc(aux0, gLnk("R", "<b>{$MSGTEXT.templates}</b>", "index.php?act=templates&page"));
e4=insDoc(aux0, gLnk("R", "<b>{$MSGTEXT.settings}</b>", "index.php?act=settings&page"));
e5=insDoc(aux0, gLnk("R", "<b>{$MSGTEXT.modules}</b>", "index.php?act=modules&page"));
e9=insDoc(aux0, gLnk("R", "<b>{$MSGTEXT.mailer}</b>", "index.php?act=mailer&page"));
e6=insDoc(aux0, gLnk("R", "<b>{$MSGTEXT.css_styles}</b>", "index.php?act=css&page"));
e7=insDoc(aux0, gLnk("R", "<b>{$MSGTEXT.work_with_bd}</b>", "index.php?act=dumper&page&id=1"));
e8=insDoc(aux0, gLnk("T", "<b>{$MSGTEXT.logout}</b>", "index.php?act=logout"));
e0=insDoc(aux0, gLnk("R", "{$MSGTEXT.all_pages}", "index.php?act=pages"));
e1=insDoc(aux0, gLnk("R", "{$MSGTEXT.pages_without_category}", "index.php?act=pages&pageCategoryId=0"));

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

{if $pCategoriesAndPages}
{foreach name="cat" from=$pCategoriesAndPages item=list}
{if $list.id}
{if $smarty.foreach.cat.iteration==1}
aux{$list.id}= insFld(aux0, gFld("{$list.name}", "index.php?act=pages&pageCategoryId={$list.id}"));
{else}
aux{$list.id}= insFld(aux{$list.parent}, gFld("{$list.name}", "index.php?act=pages&pageCategoryId={$list.id}"));
{/if}{/if}
{if $list.pages}
{foreach from=$list.pages item=page}
insDoc(aux{if $list.id}{$list.id}{else}0{/if}, gLnk("R", "{if $page.description}{if $page.selected}<div class='page_selected'>{$page.description}</div>{else}{$page.description}{/if}{else}{if $page.selected}<div class='page_selected'>{$page.name}</div>{else}{$page.name}{/if}{/if}", "index.php?act=pages&page_id={$page.id}&pageCategoryId={if $list.id}{$list.id}{else}0{/if}"));

{/foreach}{/if}{/foreach}{/if}

var initializeTREE=initializeDocument();

{if $format_url}
	reselectTree('{$format_url}');
{/if}

</SCRIPT>
	</td>
  	</tr>
	</table>
</div>
</body>
</html>