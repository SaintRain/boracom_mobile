<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>{$MSGTEXT.admin_login_cms}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="StyleSheet" href="css/general.css">
{literal}
<script language="JavaScript">
function CheckEnter(form) {
	s=document.forms[form].admin_login.value;
	if (s=='') {alert('{/literal}{$MSGTEXT.admin_login_type_login}{literal}'); return false};
	s=document.forms[form].admin_password.value;
	if (s=='') {alert('{/literal}{$MSGTEXT.admin_login_type_pass}{literal}'); return false};
	return true;
}

function set_lang(obj){
	location.href="main.php?lang="+obj.value;
}

//если сессия закончилась перенаправляем из фреймов на авторизацию
if (parent.frames.length>1) {
	parent.location='login.php';
}
</script>
{/literal}
</head>
<body leftmargin="0px" topmargin="0px" bgcolor="#70a8d1">
<table style="height:218px; width:100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-image: url('images/zerro.gif');"></td>
  </tr>
</table>
<table border='0' cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td>
    <table align="center" cellpadding="1" cellspacing="0" bgcolor="#4D6E8A" border="0">
        <tr>
          <td>
          <div class="ten_light">
            <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
              <tr>
                <td>
                <table width="300px" style="height:170px" align="center" class="formbackground" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="2" align="center" nowrap><p><b> <a title="GoodCMS" style="text-decoration:none" href="http://www.goodcms.net" target="_blank">{$MSGTEXT.admin_login_input_in_menu}</b></a></p></td>
                    </tr>
                    {if $error}
                    <tr>
                      <td align="center" colspan="2"><p style="color:yellow">{$error}</p></td>
                    </tr>
                    {/if}
                    <tr>
                      <td align="center" width="130px"><img width="100"  src="images/login.png" align="middle" border="0"></td>
                      <td align="left"><table align="left" border="0" cellpadding="1" cellspacing="0">
                          <tr>
                          <td>
                          
                          <form name="enter" action="{$host}/{$smarty.const.SETTINGS_ADMIN_PATH}/login.php" method="post" onSubmit="return CheckEnter('enter')">
                            <input type="hidden" value="'" name="check_magic_quotes_gpc">
                            <input type="text" name="admin_login" maxlength='20' style="width:80px">
                            </td>
                            <td>&nbsp;{$MSGTEXT.admin_login_login}</td>
                            </tr>
                            
                            <tr>
                              <td><input name="admin_password" maxlength='20' type="password" style="width:80px"></td>
                              <td>&nbsp;{$MSGTEXT.admin_login_pass}</font></td>
                            </tr>
                            <tr>
                              <td><select onchange="set_lang(this)" name="lang" style="width:100%;">                                  
								{foreach name="langs" key=file_name from=$langs item=item}
                                  <option {if $smarty.get.lang}{if $smarty.get.lang==$smarty.foreach.langs.iteration} selected {/if}{else}{if $file_name==$smarty.const.SETTINGS_LANGUAGE} selected {/if}{/if} value="{$smarty.foreach.langs.iteration}">{$item}</option>                                  
								{/foreach}
                                </select></td>
                              <td>&nbsp;{$MSGTEXT.admin_login_lang}</font></td>
                            </tr>
                            <tr>
                              <td nowrap align="center"><a style="font-size:11px" href="?act=forget_form{if $smarty.get.lang}&lang={$smarty.get.lang}{/if}">{$MSGTEXT.admin_login_forgotten_pass}</a></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td colspan="2" style="height:5px"></td>
                            </tr>
                            <tr>
                              <td><input type="submit" class="button" style="width:82px" value="{$MSGTEXT.admin_login_enter}"></td>
                              <td></td>
                            </tr>
                          </form>
                        </table>
                        </td>
                    </tr>
                  </table>
                  </td>
              </tr>
            </table>
            </td>
        </tr>
      </table>
      </div>
      </td>
  </tr>
</table>
</body>
</html>