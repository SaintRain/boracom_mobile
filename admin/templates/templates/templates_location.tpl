<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<body style="background:#70a8d1">
{literal} 
<script language="JavaScript">
gotoLink('?act=pages&page_id={/literal}{$page_id}&pageCategoryId={$pageCategoryId}{literal}');
window.close();

function gotoLink(url) {
	s=window.opener
	if (s.parent.frames.treeframe) {
		s.parent.frames.treeframe.reselectTree(url)
		s.location=url;
	}
}
</script>
{/literal}
</body>
</html>