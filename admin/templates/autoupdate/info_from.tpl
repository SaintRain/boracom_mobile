<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>{$MSGTEXT.autoupdate_info_title}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="StyleSheet" href="css/general.css">
</head>
<body LEFTMARGIN="0pt" TOPMARGIN="0pt" bgcolor="#70a8d1">
<br>
<table  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-image: url('images/zero.gif');"></td>
  </tr>
</table>
<table border='0' cellpadding="0" cellspacing="0" width="100%">
  <tr>
  <td align="center">  
  
   <table class="formborder" border="0"  cellpadding="1" cellspacing="0">
    <tr><td>
    <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
    <tr><td>     
      <table width="450px" style="height:170px" align="center" class="formbackground" border="0" cellpadding="5" cellspacing="0">
        <tr>
          <td colspan="2" align="center"><p style='margin-left:0px; margin-top:10px; margin-bottom:0'><b>{$autoupdate_caption}</b>
            <p style="margin-top:5px"> </p></td>
        </tr>
        {if $msgs}
        {foreach from=$msgs item=msg}
        <tr>
          <td align="center" colspan="2"><p style='margin:10px; color:yellow'>{$msg}</p></td>
        </tr>
        {/foreach}
        {/if}
        
        {if $errors}
        {foreach from=$errors item=error}
        <tr>
          <td align="center" colspan="2"><p style='margin:10px; color:red'>{$error}</p></td>
        </tr>
        {/foreach}
        {/if}
        <tr>
          <td align="left">
          {if $info_text}
          <form id="data" style="margin:0" action="autoupdate.php?updateProcess=true" method="post" enctype="multipart/form-data">
              <table width="100%" align="center" border="0" cellpadding="0" cellspacing="2">                
           		<tr>
                  <td colspan="2" height="10px"><i>{$MSGTEXT.autoupdate_info_update_new_desc}</i></td>
                </tr>              
                <tr>
                  <td colspan="2" height="10px">{$info_text}</td>
                </tr>
                <tr>
                  <td colspan="2" style="height:10px"></td>
                </tr>
                <tr>
                  <td colspan="2" style="height:1px" bgcolor="#558ab1"></td>
                </tr>
                <tr>
                  <td colspan="2" style="height:5px"></td>
                </tr>
                {if $can_update}
                <tr id="find_updates">
                  <td colspan="2" align="center"><input  type="submit" class="button" style="width:200px" value="{$MSGTEXT.autoupdate_info_button}"></td>
                </tr>
                {/if}
              </table>
            </form>
            {/if}
        </tr>
        </td>        
      </table>
      </tr>
        </td>        
      </table>      
    </td>
    </tr>    
  </table>
  </td>
  </tr>  
</table>
</body>
</html>