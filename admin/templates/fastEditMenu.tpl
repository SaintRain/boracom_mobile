{literal}<style>
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

</style>{/literal}
<script language="JavaScript">
var SETTINGS_ADMIN_PATH                     = "{$smarty.const.SETTINGS_ADMIN_PATH}";//путь к админзоне
var MSGTEXT                                 = new Array();
MSGTEXT["fedit_menu_all_records_from"]		= "{$MSGTEXT.fedit_menu_all_records_from}";
MSGTEXT["fedit_menu_edit_current_record"]	= "{$MSGTEXT.fedit_menu_edit_current_record}";
MSGTEXT["fedit_menu_settings"]				= "{$MSGTEXT.fedit_menu_settings}";
</script>
<script type="text/javascript" src="/{$smarty.const.SETTINGS_ADMIN_PATH}/js/fastEdit.js"></script>
<div id="___GoodCMS_contextMenuId" class="___GoodCMS_menu_place"></div>