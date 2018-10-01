<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
    "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>{$MSGTEXT.forget_send_login_cms}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="StyleSheet" href="css/general.css">
{literal}
<script language="JavaScript">
function Mysubmit(form) {
 s=form.email.value;
 if (s.indexOf('@',0)==-1) {form.email.focus(); alert('{/literal}{$MSGTEXT.forget_form_invalid_email}{literal}'); return false};
 return true;
}


function GetElementById(id){
	if (document.getElementById) {
		return (document.getElementById(id));
	} else if (document.all) {
		return (document.all[id]);
	} else {
		if ((navigator.appname.indexOf("Netscape") != -1) && parseInt(navigator.appversion == 4)) {
			return (document.layers[id]);
		}
	}
}
 

function reloadKaptcha() {	
	var time = Math.random();			
 	GetElementById("kaptcha_img").src="kcaptcha/index.php?t="+time; 
}

</script>
{/literal}
</head>
<body LEFTMARGIN="0pt" TOPMARGIN="0pt" bgcolor="#70a8d1">
<table style="height:218px; width:100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-image: url('images/zero.gif');"></td>
  </tr>
</table>
<table border='0' cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td>
    <form action="?act=forget_send" method="POST" onsubmit="return Mysubmit(this)">
        <table align="center" class="formborder" border="0" cellpadding="1" cellspacing="0">
        <tr>
        <td>
        <div class="ten_light">
          <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
            <tr>
            <td>
            
            <table width="300px" style="height:170px" align="center" class="formbackground" border="0" cellpadding="0" cellspacing="0">
              <tr>
              <td align="center">
              
              <table class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td align="center"><b>{$MSGTEXT.forget_form_pass_send}</b></td>
                </tr>
                <tr>
                  <td style="height:10px"></td>
                </tr>
                <tr>
                  <td align="center">{$MSGTEXT.forget_form_email}&nbsp;&nbsp;
                    <input type="text" align="right" style="width:198px" name="email"></td>
                </tr>
                <tr>
                <td align="center">
                
                <table border=0 cellpadding=0 cellspacing=0 align="center">
                  <tr>
                    <td colspan="3" height="5px"></td>
                  </tr>
                  <tr>
                    <td valign="top" align="left"></td>
                    <td align="left" colspan="2">
                  <tr>
                    <td rowspan="3"><img hspace="0" id="kaptcha_img" align="left" alt="{$MSGTEXT.forget_form_include_image}" src=""></td>
                  </tr>
                  <tr>
                    <td width="8px"></td>
                    <td valign="bottom" align="left">{$MSGTEXT.forget_form_image_code}:</td>
                  </tr>
                  <tr>
                    <td width="8px"></td>
                    <td valign="bottom" align="left"><input type="text" name="kcaptha" style="width:110px" value="">
                      <br>
                      <a href="javascript:reloadKaptcha()" style="font-size:11px">{$MSGTEXT.forget_form_change_image}</a>
                      </td>
                  </tr>
                  </td>
                  </tr>
                  
                </table>
                <tr>
                  <td style="height:4px"></td>
                </tr>
                <tr>
                  <td align="center"><input class="button" type="submit" value="{$MSGTEXT.forget_form_send}" style="width:120px;">
                    <input class="button" type="button" onclick="javascript:location.href='main.php{if $smarty.get.lang}?lang={$smarty.get.lang}{/if}';" value="{$MSGTEXT.forget_form_cancel}" style="width:120px"></td>
                </tr>
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
      </form></td>
  </tr>
</table>
</td>
</tr>
</table>
<script language="JavaScript">reloadKaptcha();</script>
</body>
</html>
