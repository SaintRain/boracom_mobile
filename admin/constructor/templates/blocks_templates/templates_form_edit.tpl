<p style="margin-bottom:10px"><font color="yellow"> {foreach from=$editError item=item}
  {$item}<br>
  {/foreach}
  {$message}</font>
  </p>
<form action="?act=b_temp_c&do={$do}&b_id={$b_id}" method="POST" style="margin:0px">
  <input value="{$id}" name="id" id="id" type="hidden">
  <input value="{$loaded_name}" name="loaded_name" id="loaded_name" type="hidden">
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr>
      <td>
      <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td>
            <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td>
                  <table cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td>{$MSGTEXT.blocks_templates_form_ed_name} <font color="yellow">*</font><br>
                          <input type="text" style="width:250px" name="name" id="name" value="{$name}">
                          <select name="tpl_prefix">
                          <option {if $tpl_prefix=='.tpl'} selected {/if} value=".tpl">.tpl</option>
                          <option {if $tpl_prefix=='.xsl'} selected {/if} value=".xsl">.xsl</option>
                          <option {if $tpl_prefix=='.xml'} selected {/if} value=".xml">.xml</option>                                                    
                          </select>
                          </td>
                        <td width="10px"></td>
                      </tr>
                    </table>
                    </td>
                <tr>
                  <td>{$MSGTEXT.blocks_templates_form_ed_description} <font color="yellow">*</font><br>
                    <textarea class="editarea_field" style="height:50px" name="description" id="description">{$description}</textarea></td>
                </tr>
                <tr style="display:none">
                  <td>{$MSGTEXT.blocks_templates_form_ed_content} </font><br>
                    <textarea class="editarea_field" rows="37%" name="content" id="textarea_1" >{$content}</textarea></td>
                </tr>
                <tr>
                  <td> 
                  {if $do=='insert'}
                    <input class="button" type="submit" value="{$MSGTEXT.blocks_templates_form_create}" style="width:130px" >
                    {else}
                    <input class="button" type="submit" value="{$MSGTEXT.blocks_templates_form_save}" style="width:130px" >
                    {/if}
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