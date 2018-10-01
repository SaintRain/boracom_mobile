<?php /* Smarty version 2.6.26, created on 2014-09-14 09:52:42
         compiled from E:/Zend/Apache2/htdocs/honda/admin/templates/fastEditMenu.tpl */ ?>
<?php echo '<style>
.___GoodCMS_area {
	left: inherit;
    right: inherit;
    width: inherit;
    height: inherit;
    top: inherit;
	border:inherit;
	font-size:inherit;
	font-family:inherit;
	font-style: inherit;
	font-weight:inherit;
	line-height:inherit;
	color:inherit;
	text-align: inherit;
	text-decoration: inherit;
	float:inherit;
	clear:inherit;
	overflow:inherit;
	/*display:inherit;*/
	white-space:inherit;
	z-index:inherit;
}
.___GoodCMS_menu_place{
	-webkit-box-shadow: 0 0 20px black;
	-moz-box-shadow: 0 0 20px black;
	box-shadow: 0 0 20px black;
	position:absolute;
	z-index:300000000000000000;
	top:0px;
	left:0px;
	padding: 0px;
	border: solid 1px white;
	background-color:#e8f8ff;
	display:none;
	clear:both;
	overflow:visible;
}
    
table#t_width {
    margin-top: 0px !important;
    margin-bottom: 0px !important;
}
</style>'; ?>

<script language="JavaScript">
var SETTINGS_ADMIN_PATH                     = "<?php echo @SETTINGS_ADMIN_PATH; ?>
";//путь к админзоне
var MSGTEXT                                 = new Array();
MSGTEXT["fedit_menu_all_records_from"]		= "<?php echo $this->_tpl_vars['MSGTEXT']['fedit_menu_all_records_from']; ?>
";
MSGTEXT["fedit_menu_edit_current_record"]	= "<?php echo $this->_tpl_vars['MSGTEXT']['fedit_menu_edit_current_record']; ?>
";
MSGTEXT["fedit_menu_settings"]				= "<?php echo $this->_tpl_vars['MSGTEXT']['fedit_menu_settings']; ?>
";
</script>
<script type="text/javascript" src="/<?php echo @SETTINGS_ADMIN_PATH; ?>
/js/fastEdit.js"></script>
<div id="___GoodCMS_contextMenuId" class="___GoodCMS_menu_place"></div>