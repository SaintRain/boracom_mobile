<div class="ten">
  <form id="searchform" action="?act=pages" method="POST">
    <table cellpadding="1" class="formborder" cellspacing="0" border="0" bgcolor="#22364F">
      <tr>
        <td>
        <table cellpadding="4" cellspacing="0" border="0" bgcolor="#86bae0" >
            <tr>
              <td>
              <table cellpadding="2" cellspacing="0" border="0">
                  <tr>
                    <td align="left" style="color:#22364F;font-family:Arial;font-size:12px;"><b>{$MSGTEXT.find_page_enter_name_page}:</b></td>
                    <td align="right"><img border=0 style="cursor:pointer" onclick="hideFormBlocks()" src="images/close.gif"></td>
                  </tr>
                  <tr>
                    <td colspan="2"><input type="text" value="" id="searchpage"  name="searchpage" style="width:300px;background-color:white"></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><input style="width:110px" type="submit" value="{$MSGTEXT.find_page_search}" class="button">
                      &nbsp;&nbsp;
                      <input style="width:110px" onclick="hideFormBlocks()" type="button" value="{$MSGTEXT.find_page_cancel}" class="button">
                      </td>
                  </tr>
                </table>
                </td>
            </tr>
          </table>
          </td>
      </tr>
    </table>
  </form>
</div>