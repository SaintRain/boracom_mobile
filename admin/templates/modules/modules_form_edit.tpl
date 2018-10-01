{if $errors}
{foreach from=$errors item=error}
<p style="margin-top:5px;color:yellow">{$error}</p>
{/foreach}
{/if}
<p style="margin-top:10px;margin-bottom:10px">
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><a href="?act=modules&do=form_import">{$MSGTEXT.import_module}</a> &rarr; </td>
    <td width="20px"></td>
    <td><a href="?act=modules&do=copy_module_form">{$MSGTEXT.create_copy_of_module}</a> &rarr;</td>
  </tr>
</table>
</p>
<form id="data form" action="?act=modules&do=saveedit" method="POST" style="margin:0">
  <input name="id" value="{$id}" type="hidden">
  <input name="name" value="{$name}" type="hidden">
  <p style="margin-bottom:10px"><font color="Yellow">{$message}</font></p>
  <table width="100%" class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
          <table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
              <tr>
                  <td>
                  <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td>{$MSGTEXT.module}: <b>{$name}</b>
              <p style="margin-top:10px">{$MSGTEXT.description_of_module}:<br>
                <input type="text" name="description" style="width:100%;" value="{$description}">
            </td>
          </tr>
          <tr>
            <td><input class="button" type="submit" value="{$MSGTEXT.save}" style="width:130px"></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
      </td>
    </tr>
  </table>
</form>