<form action="" method="POST" enctype="multipart/form-data">
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    {foreach from=$fields item=field}
    {if $field.edittype_id==1 || $field.edittype_id==2 ||  $field.edittype_id==3 || $field.edittype_id==4 || $field.edittype_id==5 || $field.edittype_id==7 || $field.edittype_id==8 || $field.edittype_id==9 || $field.edittype_id==11}
    <tr>
      <td class="form_text" valign="top" align="left">{$field.comment}:{if $field.not_null==1} <font color="#5a7bca">*</font>{/if}</td>
      <td> {if $field.edittype_id==1}
        <input type="text" value="{literal}{${/literal}{$field.fieldname}{literal}}{/literal}" name="{$field.fieldname}" id="{$field.fieldname}" class="form_element">
        {/if}
        {if $field.edittype_id==2 || $field.edittype_id==7 || $field.edittype_id==8}
        <textarea name="{$field.fieldname}" id="{$field.fieldname}" rows="4" class="form_element">{literal}{${/literal}{$field.fieldname}{literal}}{/literal}</textarea>
        {/if}
        {if $field.edittype_id==3}
        <select name="{$field.fieldname}" id="{$field.fieldname}" class="form_element">          
{literal}{foreach from=${/literal}{$field.sourse_table_name_no_prefix}{literal} item=item}
          <option {if $item.id==${/literal}{$field.fieldname}{literal}} selected {/if} value="{$item.id}">{$item.name}</option>          
{/foreach}{/literal}

        </select>
        {/if}
        {if $field.edittype_id==4}
        <select multiple size="10" name="{$field.fieldname}" id="{$field.fieldname}" class="form_element">          
{literal}{foreach from=${/literal}{$field.sourse_table_name_no_prefix}{literal} item=item}
          <option {if $item.id==${/literal}{$field.fieldname}{literal}} selected {/if} value="{$item.id}">{$item.name}</option>          
{/foreach}{/literal}
        </select>
        {/if}
        {if $field.edittype_id==5}
        <input {literal}{if ${/literal}{$field.fieldname}{literal}} checked {/if}{/literal} type="checkbox" value="1" name="{$field.fieldname}" id="{$field.fieldname}">
        {/if}
        {if $field.edittype_id==9 || $field.edittype_id==11}
        <input type="file" value="" name="{$field.fieldname}" id="{$field.fieldname}" class="form_element">
        {/if} </td>
    </tr>
    {/if}
    {/foreach}
  </table>
</form>