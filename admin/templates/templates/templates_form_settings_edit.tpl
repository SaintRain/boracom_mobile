<script language="JavaScript">
var el=new Array()
var el2=new Array()
var el3=new Array()
{foreach from=$tags item=list}

{if $list.block_id}
el['{$list.id}']={$list.block_id};
{else}
el['{$list.id}']=0;
{/if}

{if $list.global}
el2['{$list.id}']={$list.global};
{else}
el2['{$list.id}']=0;
{/if}

{if $list.include_tpl_id}
el3['{$list.id}']={$list.include_tpl_id};
{else}
el3['{$list.id}']=0;
{/if}

{/foreach}
{literal}


function check_submit() {
	form=GetElementById('data form');

	if (form.tag_id.selectedIndex==-1) {
		alert("{/literal}{$MSGTEXT.templates_form_settings_no_select_tag}{literal}");
		return false;
	}
	if (form.block_id.selectedIndex==-1) {
		alert("{/literal}{$MSGTEXT.templates_form_settings_no_select_mod}{literal}");
		return false;
	}

	return true;
}

function setRadioValue(val) {

	if (val) {
		GetElementById('tpl_include').checked=true;
	}
	else {
		GetElementById('include_tpl_id').options[0].selected=true;
	}
}

function checkBlockSelect(obj) {
	var tpls				= GetElementById('include_tpl_id');

	if (tpls.options.selectedIndex>0) {
		obj.selectedIndex=0;
		alert("{/literal}{$MSGTEXT.templates_form_settings_tpl_alert}{literal}");
	}
}

function set_block(obj) {

	if (obj.selectedIndex>-1) {
		ind=obj.options[obj.selectedIndex].value;
		GetElementById('tagname').value=obj.options[obj.selectedIndex].text;
		obj2=GetElementById('block_id');
		sel=false;
		for (i=0; i<obj2.options.length; i++)
		if 	(obj2.options[i].value==el[ind]) {
			obj2.selectedIndex=i;
			sel=true;
			break;
		}
		if (sel==false) obj2.selectedIndex=0;
		set_name(obj);
	}

}




function check_set_name() {
	obj=GetElementById('tag_id');
	if (obj.selectedIndex>-1) set_name(obj);
}


function set_name(obj) {
	sindex=obj.options[obj.selectedIndex].value;

	if (el2[sindex]==1)	 k=1;
	else
	if (el2[sindex]==2)	 k=2;

	else k=0;

	gl=GetElementById('global_'+k);
	gl.checked=true;

	var tpls				= GetElementById('include_tpl_id');
	var selected_tpl_index	= 0;
	for (i=0;i<tpls.options.length; i++) {
		if (tpls.options[i].value==el3[sindex]) {
			selected_tpl_index=i;
			break;
		}
	}


	tpls.options[selected_tpl_index].selected=true;
	if (selected_tpl_index>0) {
		var obj2=GetElementById('block_id');
		obj2.selectedIndex=0;
		gl=GetElementById('tpl_include');
		gl.checked=true;
	}

}


function setOtnoshenie() {
	if (check_submit()) {
		GetElementById('data form').submit();
	}
}
</script>
{/literal}

{foreach from=$errorMsgs item=error}
<p style="color:yellow">{$error}</p>
{/foreach}

<form name='dataform' id="data form"  action="?act=templates&do=settings_save_edit{if $smarty.get.hide_menu}&hide_menu=true{/if}" method="POST" style="margin:0px" onsubmit="return check_submit()">
  <input name="templates_id" id="templates_id" type="hidden" value="{$templates_id}">
  <input name="tagname" id="tagname" type="hidden" value="{$tagname}">
  <input name="page_id" id="page_id" type="hidden" value="{$smarty.get.page_id}">
  {if $message}
  <p style="margin-bottom:10px"><font id="messagetext" color="yellow">{$message}</font></p>
  <script language="JavaScript">Morphing("messagetext", false)</script> 
  {/if}
  <table class="formborder" border="0" width="100%" cellpadding="1" cellspacing="0">
    <tr>
      <td>
 <table align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0"  style="width:100%">
          <tr>
            <td>      
      <table width="100%" class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td rowspan="2" style="width:10px"></td>
            <td width="40%" align="left" valign="top">{$MSGTEXT.templates_form_settings_tag_in_tpl} <b>«{$tamplate_name}»</b></td>
            <td width="60%" valign="top"> {$MSGTEXT.templates_form_settings_plug_block} </td>
          </tr>
          <tr>
            <td>
              <select onchange="set_block(this)" name="tag_id" id="tag_id" style="width:100%; height:450px;" size="30">                
				{foreach from=$tags item=list}
                <option {if $sel1} {if $sel1==$list.id} selected {assign var="global" value=$list.global} {/if} {/if} 
				 {if $list.block_id=='' || $list.block_id==0 || $list.include_tpl_id>0}  style="color:gray;"   {else} {if $list.global==1} style="color:blue;" {else} {if $list.global==2} style="color:maroon"{/if}{/if}
				{/if} value="{$list.id}">{section name=tags loop=$list.deep step=1}&nbsp;&nbsp;&nbsp;&nbsp;{/section}{$list.virtualtagname}{if $list.include_tpl_id>0} &darr;{/if}
                {if ($list.block_id=='' || $list.block_id==0) && $list.include_tpl_id==0} {if $list.global==1}&larr; {$MSGTEXT.templates_form_settings_glob}{else} {if $list.global==2}&larr; {$MSGTEXT.templates_form_settings_sglob}{/if}{/if}{/if}{/foreach}
              </select>
              </td>
            <td><select onChange="checkBlockSelect(this)" name="block_id" id="block_id" style="width:100%;height:450px" size="30">
                <option {if $sel2=='0'} selected {/if} style='color:gray;' value="0">{$MSGTEXT.templates_form_settings_no_block}
                {foreach from=$blocks item=list}
                <option {if $sel2==$list.block_id} selected {/if} {if $list.type!=1} style="color:maroon" {/if} value="{$list.block_id}">
                {if $list.module_description!=''} {$list.module_description}
                {else}
               		{$list.module_name}
                {/if}
                &rarr; 
                {if $list.block_description!=''} {$list.block_description}
                {else}
                	{$list.block_name}
                {/if} <br>
                {/foreach}
              </select>
              </td>
          </tr>
          <tr>
            <td></td>
            <td nowrap valign="top">
              <p style="margin:5px">              
              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                <td>{$MSGTEXT.templates_form_settings_this_tag_is}</td>
                  <td><input onChange="setRadioValue(false)" type="radio" style="margin-top:0px" name="global" id="global_0"  value="0" {if $global==0}checked{/if}></td>
                  <td>&nbsp;{$MSGTEXT.templates_form_settings_simple}</td>
                  <td width="10px"></td>
                  <td><input onChange="setRadioValue(false)" type="radio" style="margin-top:0px" name="global" id="global_1"   value="1" {if $global==1}checked{/if}></td>
                  <td>&nbsp;<font color="blue">{$MSGTEXT.templates_form_settings_global}</font></td>
                  <td width="10px"></td>
                  <td><input onChange="setRadioValue(false)" type="radio" style="margin-top:0px" name="global" id="global_2"   value="2" {if $global==2}checked{/if}></td>
                  <td>&nbsp;<font color="Maroon">{$MSGTEXT.templates_form_settings_superglobal}</font></td>
                      <tr>            
              </table>
              </p>
              <p style="margin-top:20px">
              <input class="button" type="Submit" value="{$MSGTEXT.templates_form_settings_save}" style="width:130px" >
              </p>
              </td>
              <td valign="top">
                {if $all_tpls}
                <table border="0" style="margin-top:5px" cellpadding="0" cellspacing="0">
                	<tr>
                	<td  valign="middle">                
	                	<input type="radio" style="margin-top:0px" name="global" id="tpl_include" value="0">&nbsp;{$MSGTEXT.templates_form_settings_include_tpl}&nbsp;               
                	</td>
                	<td >
	                	<select onChange="setRadioValue(true)" name="include_tpl_id" id="include_tpl_id" style="width:100%">
	                	<option value="0" style="color:gray">{$MSGTEXT.templates_form_settings_not_set}</option>
    	            	{foreach from=$all_tpls item=tpl}
        	        		<option value="{$tpl.id}">{$tpl.description}</option>
	            	    {/foreach}
    	            	</select>
        	        </td>
        	        </tr>
        	         </table>
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
<script>
check_set_name();
</script>