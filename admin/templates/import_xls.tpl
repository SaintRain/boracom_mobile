<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>{$MSGTEXT.import_xls_title}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="StyleSheet" href="css/general.css">
</head>
<body LEFTMARGIN="0pt" TOPMARGIN="0pt" bgcolor="#70a8d1">
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="background-image: url('images/zero.gif');"></td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>  
  <td>  
   <table class="formborder" border="0"  cellpadding="1" cellspacing="0" align="center">
    <tr><td>
    <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
    <tr><td>
      <table width="450px" style="height:170px" align="center" class="formbackground" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2" align="center"><p><b>{$MSGTEXT.import_xls_caption}</b>
            <p> {if $msgs}
            <p style='color:#b1ff88'><b>{$msgs}</p>
            {else} <font color="Yellow">{$MSGTEXT.import_xls_help}</font>
            </p>
            {/if}</td>
        </tr>
        {if $error}
        <tr>
          <td align="center" colspan="2"><p style="color:red">{$error}</p></td>
        </tr>
        {/if}
        <tr>
          <td align="center" valign="middle" width="130px"><img src="images/xls/excel.png" align="middle" border="0"><br>&nbsp;</td>
          <td align="left"><table align="left" border="0" cellpadding="1" cellspacing="0">
              <tr>
                <td align="right"><form action="import_xls.php?page_id={$smarty.get.page_id}&tag_id={$smarty.get.tag_id}&lang_id={$lang_id}&t_name={$smarty.get.t_name}" method="post" enctype="multipart/form-data">
                    <tr>
                        <td align="right"><input type="file" name="filename" style="width:200px"></td>
                      </tr>
                    <tr>
                        <td style="height:5px"></td>
                      </tr>
                    <tr>
                        <td align="left"><input type="submit" class="button" style="width:200px" value="{$MSGTEXT.import_xls_load}"></td>
                      </tr>
                  </form>
            </table>
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