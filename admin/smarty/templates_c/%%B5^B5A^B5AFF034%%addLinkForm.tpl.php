<?php /* Smarty version 2.6.26, created on 2018-09-19 05:46:00
         compiled from addLinkForm.tpl */ ?>
<div class="ten">
  <table cellpadding="1" class="formborder" cellspacing="0" border="0" bgcolor="#22364F">
    <tr>
      <td>
      <table cellpadding="4" cellspacing="0" border="0" bgcolor="#86bae0" >
          <tr>
            <td>
            <table cellpadding="2" cellspacing="0" border="0">
                <tr>
                  <td align="left" style="color:#22364F;font-family:Arial;font-size:12px;"><b><?php echo $this->_tpl_vars['MSGTEXT']['add_link_form_name']; ?>
</b></td>
                  <td align="right"><img border="0" style="cursor:pointer" onclick="hideFormBlocks()" src="images/close.gif"></td>
                </tr>
                <tr>
                  <td colspan="2"><input type="text" value="" id="linkName" name="linkName" style="width:300px;background-color:white"></td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><input style="width:110px" onclick="addUrl()" type="button" value="<?php echo $this->_tpl_vars['MSGTEXT']['add_link_form_add']; ?>
" class="button">
                    &nbsp;&nbsp;
                    <input style="width:110px" onclick="hideFormBlocks()" type="button" value="<?php echo $this->_tpl_vars['MSGTEXT']['add_link_form_cancel']; ?>
" class="button"></td>
                </tr>
              </table>
              </td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</div>