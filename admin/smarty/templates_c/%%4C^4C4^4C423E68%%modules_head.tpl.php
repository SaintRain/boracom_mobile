<?php /* Smarty version 2.6.26, created on 2018-09-07 06:40:10
         compiled from modules/modules_head.tpl */ ?>
<table style="position:realitive" border="0" cellpadding="0" cellspacing="0" >
<tr>
<td>
<?php if ($_GET['hide_menu_propetries']): ?>
	<h5 id="pageHeaderCaption" style="padding-right:10px;padding-left:10px;margin-top:10px; margin-bottom:10px"> <?php echo $this->_tpl_vars['MSGTEXT']['edit_style']; ?>
 
	<a class="headLink" href="#"><?php if ($this->_tpl_vars['page']['description']): ?><?php echo $this->_tpl_vars['page']['description']; ?>
<?php else: ?><?php echo $this->_tpl_vars['page']['name']; ?>
<?php endif; ?></a> <?php echo $this->_tpl_vars['MSGTEXT']['on_page']; ?>
<span style="color:yellow">«<?php echo $this->_tpl_vars['edit_block']['virtualtagname']; ?>
»</span></h5>
<?php else: ?>
	<h5 id="pageHeaderCaption"><?php if ($_GET['hide_menu']): ?>&nbsp;<?php endif; ?><?php echo $this->_tpl_vars['MSGTEXT']['edit_style']; ?>
 «<a class="headLink" href="?act=pages&page_id=<?php echo $this->_tpl_vars['page']['id']; ?>
&pageCategoryId=<?php echo $this->_tpl_vars['page']['page_category']; ?>
"><?php if ($this->_tpl_vars['page']['description']): ?><?php echo $this->_tpl_vars['page']['description']; ?>
<?php else: ?><?php echo $this->_tpl_vars['page']['name']; ?>
<?php endif; ?></a>»<?php echo $this->_tpl_vars['MSGTEXT']['on_page']; ?>
 <span style="color:yellow">«<?php echo $this->_tpl_vars['edit_block']['virtualtagname']; ?>
»</span></h5>
<?php endif; ?>
</td>
<td>&nbsp;&nbsp;</td>
<td>
<div class="menu_propetries" style="margin-top:-17px">
    <ul> 
        <li>        
        <a class="hide" href=""><img  border="0" src="images/menu_properties.png" /></a>
            <ul class="menu_ten">            
            	<?php $_from = $this->_tpl_vars['blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['block']):
        $this->_foreach['block']['iteration']++;
?>
            	<li style="cursor:pointer;width:100%" onclick="<?php if ($this->_tpl_vars['block']['block_name'] && $this->_tpl_vars['block']['general_table_id'] > 0): ?>location.href='?act=modules&do=managedata&page_id=<?php echo $this->_tpl_vars['page']['id']; ?>
&tag_id=<?php echo $this->_tpl_vars['block']['virtualtag_id']; ?>
&page=1<?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>'<?php else: ?>alert('<?php if ($this->_tpl_vars['block']['block_name'] == ''): ?><?php echo $this->_tpl_vars['MSGTEXT']['cannot_edit_empty_tag']; ?>
<?php else: ?><?php echo $this->_tpl_vars['MSGTEXT']['cannot_edit_block']; ?>
<?php endif; ?>');<?php endif; ?>" id="zakladka_center<?php echo $this->_foreach['block']['iteration']; ?>
_<?php echo $this->_foreach['zakladka']['iteration']; ?>
" >            	            	
                	<a
					<?php if ($this->_tpl_vars['block']['virtualtag_id'] == $_GET['tag_id']): ?> style="background:#d3ecff;" <?php endif; ?>
                	<?php if ($this->_tpl_vars['block']['block_id'] > 0): ?>
						<?php if ($this->_tpl_vars['block']['global'] == 1 && $this->_tpl_vars['block']['general_table_id'] > 0): ?>
							class="zakladka_blue"
						<?php else: ?>
						<?php if ($this->_tpl_vars['block']['global'] == 2 && $this->_tpl_vars['block']['general_table_id'] > 0): ?>
							class="zakladka_maroon"
        					<?php else: ?>
        						<?php if ($this->_tpl_vars['block']['block_name'] && $this->_tpl_vars['block']['general_table_id'] > 0): ?>
        							<?php if ($this->_tpl_vars['block']['virtualtag_id'] == $_GET['tag_id']): ?> 
        								
        							<?php else: ?>
        								class="zakladka"
        							<?php endif; ?>
        						<?php else: ?>
        							class="zakladka_disabled"
        						<?php endif; ?>
        					<?php endif; ?>
        				<?php endif; ?>
        				<?php else: ?>
        					class="zakladka_disabled"
        				<?php endif; ?>>&nbsp;&nbsp;<?php echo $this->_tpl_vars['block']['virtualtagname']; ?>
&nbsp;&nbsp;</a>        	        	
        		</li>            	            	
        		<?php endforeach; endif; unset($_from); ?>            	            
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


<?php echo '
<script type="text/javascript">
var predObg=\'\';
function setActiveTab(obg) {
	obg.bgColor=\'blue\';
	if (predObg!=\'\') predObg.bgColor=\'red\';
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
		'; ?>

		location.href="index.php?act=modules&do=managedata&page_id=<?php echo $_GET['page_id']; ?>
&tag_id=<?php echo $_GET['tag_id']; ?>
<?php if ($_GET['id']): ?>&id=<?php echo $_GET['id']; ?>
<?php endif; ?><?php if ($_GET['p']): ?>&p=<?php echo $_GET['p']; ?>
<?php endif; ?><?php if ($_GET['t_name']): ?>&t_name=<?php echo $_GET['t_name']; ?>
<?php endif; ?><?php if ($_GET['hide_menu']): ?>&hide_menu=true<?php endif; ?><?php if ($_GET['fastEdit']): ?>&fastEdit=true<?php endif; ?>";
		<?php echo '
	}
}
</script>
'; ?>