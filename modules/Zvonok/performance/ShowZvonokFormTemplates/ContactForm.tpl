<br/>
<br/>
<form fastedit:{$table_name}: id="contact_form" style="margin-top:0px" action="#contact_form" method='post' enctype='multipart/form-data' onreset="return confirm('{'Вы действительно хотите очистить форму?'|ftext}')">
  <p>
    <input type="hidden" name="contact" value="send" />
  </p>
  <table border='0' cellpadding='0' cellspacing='2'>
    {if $errors}
    <tr>
      <td></td>
      <td colspan="2" align="left">                
        {foreach from=$errors item=error}
        <div>          
          <p style="color:red">
            {$error|ftext}
          </p>
        </div>
        {/foreach}
        <div style="height:15px"></div>        
      </td>
    </tr>
    {/if}	    
    
{foreach from=$fields item=item}
    {assign var="fieldname" value="field_`$item.id`"}
    <tr> 
    	{if $item.type=='Input'}
      <td align="left" valign="middle" class="contacts_formtext">
        {$item.caption|ftext}{if $item.nnull} 
        <span style="color:red">
          *
        </span>
        {/if}&nbsp;&nbsp;
      </td>
      		<td  align="left" colspan="2"><input name="{$fieldname}" class="{if $item.class}{$item.class}{else}contacts_input{/if}"  value="{$post.$fieldname}"  style="width:{if $item.width}{$item.width}{else}100%{/if};{if $item.height}height:{$item.height}{/if};{$item.style}" />
        {else}
       	{if $item.type=='Textarea'}      
    		<td align="left" valign="top" class="contacts_formtext">{$item.caption|ftext}{if $item.nnull} <span style="color:red">*</span>{/if}&nbsp;&nbsp;</td>
		    <td  align="left" colspan="2"><textarea name="{$fieldname}" class="{if $item.class}{$item.class}{else}contacts_textarea{/if}" style="width:{if $item.width}{$item.width}{else}100%{/if};height:{if $item.height}{$item.height}{else}100px{/if};{$item.style}">{$post.$fieldname}</textarea>
        {else}
        {if $item.type=='Checkbox'}      
      		<td align="left" valign="top"></td>
      		<td  align="left" colspan="2"><input type="checkbox" {if $post.$fieldname}checked{/if}  value="true" name="{$fieldname}"  class="{if $item.class}{$item.class}{else}contacts_checkbox{/if}"  style="{if $item.width}width:{$item.width};{/if}{if $item.height}height:{$item.height}{/if};{$item.style}" />
        	&nbsp;&nbsp;{$item.caption|ftext}
        {else}
        {if $item.type=='Radio'}      
      		<td align="left" valign="middle" class="contacts_formtext">{$item.caption|ftext}{if $item.nnull} <span style="color:red">*</span>{/if}&nbsp;&nbsp;</td>
      		<td align="left" colspan="2"> {foreach from=$item.select_values item=sv}
        	<input {if $post.$fieldname==$sv}checked{/if} type="radio" value="{$sv}" name="{$fieldname}" class="{if $item.class}{$item.class}{else}contacts_checkbox{/if}" style="{if $item.width}width:{$item.width};{/if}{if $item.height}height:{$item.height}{/if};{$item.style}" />
        	&nbsp;&nbsp;{$sv}
        	{/foreach}						        
        {else}
        {if $item.type=='File'}      
      		<td align="left" valign="middle" style="white-space:nowrap" class="contacts_formtext">{$item.caption|ftext}{if $item.nnull} <span style="color:red">*</span>{/if}&nbsp;&nbsp;</td>
      		<td  align="left" colspan="2"><input type="file" name="{$fieldname}" class="{if $item.class}{$item.class}{else}contacts_file{/if}" style="width:{if $item.width}{$item.width}{else}100%{/if};{if $item.height}height:{$item.height}{/if};{$item.style}" />
        {else}
        {if $item.type=='Select'}      
      		<td align="left" valign="middle" class="contacts_formtext">{$item.caption|ftext}{if $item.nnull} <span style="color:red">*</span>{/if}&nbsp;&nbsp;</td>
      		<td  align="left">
      		<select {if $item.checked}checked{/if} type="radio" value="{$item.id}" name="{$fieldname}" class="{if $item.class}{$item.class}{else}contacts_checkbox{/if}" style="{if $item.width}width:{$item.width};{/if}{if $item.height}height:{$item.height}{/if};{$item.style}">         
				{foreach from=$item.select_values item=sv}						
					<option {if $post.$fieldname==$sv} selected {/if} value="{$sv}">{$sv}</option>          
				{/foreach}						
        	</select>
        {else}
        {if $item.type=='MultiSelect'}      
      		<td align="left" valign="middle" class="contacts_formtext">{$item.caption|ftext}{if $item.nnull} <span style="color:red">*</span>{/if}&nbsp;&nbsp;</td>
      		<td  align="left">
      		<select multiple {if $item.checked}checked{/if} type="radio" value="{$item.id}" name="{$fieldname}[]" class="{if $item.class}{$item.class}{else}contacts_checkbox{/if}" style="{if $item.width}width:{$item.width};{/if}{if $item.height}height:{$item.height}{/if};{$item.style}">          
			{foreach from=$item.select_values item=sv}							
          		<option {if is_array($post.$fieldname)}{if in_array($sv, $post.$fieldname) } selected {/if}{/if} value="{$sv}">{$sv}</option>          
			{/foreach}							
        	</select>
        {else}						
        {if $item.type=='Text'}      
      		<td align="left" valign="middle" class="contacts_formtext"></td>
      		<td  align="left" ><span class="{if $item.class}{$item.class}{else}contacts_formtext{/if}" style="{if $item.width}width:{$item.width};{/if}{if $item.height}height:{$item.height}{/if};{$item.style}">{$item.caption|ftext}</span> {/if}
        {/if}
        {/if}
        {/if} 
        {/if}
        {/if}
        {/if}
        {/if}
       </td>
    </tr>
    {/foreach}    
        
    {if $settings.kcaptcha==1}
    <tr>    
    <td align='left' valign='middle' style="width:100px;white-space:nowrap">{'Введите текст:'|ftext}&nbsp;<span style="color:red">*</span></td>
      <td align="left" valign="top">                    
        <div style="float:left">
          <img style="margin:5px;border:0px"  width="120px" height="50px" id="kcaptcha_img" alt="{'Включите отображение изображений'|ftext}" src='/modules/{$moduleInfo.module_name}/kcaptcha/index.php' />
        </div>
        <div style="float:left">
          <br/>
          <input name="kcaptcha" style="width:115px" />
          <br/>
          <a class="news_navigations" href="javascript:reloadKcaptcha()">
            {'поменять картинку'|ftext}
          </a>          
        </div>                            
      </td>
      </tr>    
    {/if}
    <tr>
      <td colspan="3" style="height:10px"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" valign="bottom" align="left">        
        <input class="button" style="float:left;width:120px;" type="reset" value="{'Очистить'|ftext}" />
        <input class="button" style="float:left;margin-left:10px;width:120px;" type="submit" value="{'Отправить'|ftext}" />
      </td>
    </tr>
  </table>
</form>

{literal} 
<script type="text/javascript"> 
function  reloadKcaptcha() {	
	var time = Math.random();			
 	document.getElementById('kcaptcha_img').src="/modules/{/literal}{$moduleInfo.module_name}{literal}/kcaptcha/index.php?t="+time;    
}
</script> 
{/literal} 