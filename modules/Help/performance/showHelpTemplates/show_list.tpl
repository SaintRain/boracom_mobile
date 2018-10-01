<script type="text/javascript" src="/modules/Help/Treeview/ua.js"></script>
<script type="text/javascript" src="/modules/Help/Treeview/ftiens4.js"></script>

<table fastedit:: style="width:100%" border="0" cellpadding="0" cellspacing="5">
<tr>
<td style="width:25%" valign="top" align="left">
<noindex>
<a style="display:none" rel="nofollow"  href="http://www.treemenu.net/" target="_blank"></a>
</noindex>

{literal}
<script type="text/javascript">
function cleare_help_search(obj) {
	if (obj.value=="Поиск...") {
		obj.value='';
		obj.style.color='black';
	}
}

function getAllTree(tree, clean_url) {
	var i=0;
	for (i=0; i < tree.nChildren; i++) {
		nodeObj=tree.children[i];

		if (nodeObj.link) hlink=nodeObj.link;
		else hlink=nodeObj.hreference;


		if (hlink==clean_url) {
			var lastClicked=nodeObj;
			nodeObj.forceOpeningOfAncestorFolders();
			highlightObjLink(nodeObj);
			return true;
		}

		if (nodeObj.nChildren>0) {
			getAllTree(nodeObj, clean_url);
		}
	}
	return false;
}

{/literal}

  var ICONPATH='/modules/Help/Treeview/img/';
var USETEXTLINKS = 1
var STARTALLOPEN = 0
var HIGHLIGHT = 1
var PRESERVESTATE = 1
var GLOBALTARGET='S';
var WRAPTEXT=0;
var HIGHLIGHT_COLOR="black";
var PRESERVESTATE=1;
var USEFRAMES=0;

foldersTree = gFld("<b>Справочная информация</b>", "/help")
{foreach name="cat" from=$categories item=list}
{if $list.deep==0}
  parent{$list.id} = insFld(foldersTree, gFld("{$list.caption}",  {if $list.description}'{"?id=`$list.id`"|furl}'{else}'#'{/if}))
{else}
{if $list.folder}
parent{$list.id} = insFld(parent{$list.parent_id}, gFld("{$list.caption}", {if $list.description}'{"?id=`$list.id`"|furl}'{else}'#'{/if}))
{else}
parent{$list.id}= insDoc(parent{$list.parent_id}, gLnk("T", "{$list.caption}",'{"?id=`$list.id`"|furl}'))
{/if}
{/if}
{/foreach}

var initializeTREE=initializeDocument();

{if $id}
getAllTree(initializeTREE, '{"?id=`$id`"|furl}');
{/if}
</SCRIPT>

</td>
<td><img alt="" width="20px" src='/modules/Help/img/zero.gif' /></td>
<td style="height:1px;background-color:#eaeaea"><img alt="" width="1px" src='/modules/Help/img/zero.gif' /></td>
<td><img alt="" width="20px" src='/modules/Help/img/zero.gif' /></td>
<td style="width:75%" valign="top" align="left">
  <form action="" method="get" style="margin:0px">	
      <table cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td>
            <input name="search_text" class="search_field" style="color:gray;width:500px" onclick="cleare_help_search(this)" value="{'Поиск...'|ftext}" />
          </td>
          <td style="width:5px">
            &nbsp;&nbsp;
          </td>
          <td align="left">
            <input class="search_button" type="submit" title="{'Поиск по документации'|ftext}" value="ПОИСК" />
          </td>
        </tr>
      </table>
  </form>
    {if $found_data}
    	{$found_data}
    {else}
    	<div fastedit:{$tablename}:{$id}>    
	    <h3>{$view_data.caption}</h3>
		{$view_data.description}
		</div>
	{/if}
	</td>
</tr>
</table>

<div style="display:none">
    {foreach name="cat" from=$categories item=list}
    <a title="{$list.caption}" href="?id={$list.id}">{$list.caption}</a>
    {/foreach}
</div>
  