<?php /* Smarty version 2.6.26, created on 2018-09-14 07:44:39
         compiled from templates/templates_location.tpl */ ?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<body style="background:#70a8d1">
<?php echo ' 
<script language="JavaScript">
gotoLink(\'?act=pages&page_id='; ?>
<?php echo $this->_tpl_vars['page_id']; ?>
&pageCategoryId=<?php echo $this->_tpl_vars['pageCategoryId']; ?>
<?php echo '\');
window.close();

function gotoLink(url) {
	s=window.opener
	if (s.parent.frames.treeframe) {
		s.parent.frames.treeframe.reselectTree(url)
		s.location=url;
	}
}
</script>
'; ?>

</body>
</html>