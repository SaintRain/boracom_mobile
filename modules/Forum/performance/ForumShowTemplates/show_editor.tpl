<div fastedit::>
  <br/>
  <br/>
  {if $errors}
  {foreach from=$errors item=error}
  <p style="color:red">
    {$error|ftext}
  </p>
  {/foreach}
  <br/>
  {/if}
  
  {if $message_is_updated}
  <h1 style="text-align:center">
	{if $smarty.post.edit_type=='insert'}      
        {'Ваше сообщение добавленно!'|ftext}
      {else}       
        {'Изменения сохранены!'|ftext}      
      {/if}  
  </h1>
  {/if}
  
  {if $user}
  <form {if !$messages && !$errors} style="display:none"{/if} id="editor_form_place" action="?act=update_message&forum_id={$forum.id}{if $them.id}&them_id={$them.id}{/if}&page={$pageRecords.page_count}#editor_form" method="post" enctype="multipart/form-data">    
	<p>
      <input type="hidden" name="translit" id="translit" value="" />
      <input type="hidden" name="title" id="title" value="" />
      <input type="hidden" name="metadescription" id="metadescription" value="" />
      <input type="hidden" name="metakeywords" id="metakeywords" value="" />
      <input type="hidden" name="datetime" id="datetime" value="" />      
      <input type="hidden" name="data_id" id="data_id" value="{$data_id}" />
      <input type="hidden" name="user_id" value="{$user.id}" />      
      <input type="hidden" name="edit_type" id="edit_type" value="{if $edit_type}{$edit_type}{else}insert{/if}" />
      <input type="hidden" name="datetime" value="" />
      <input type="hidden" name="is_them" id="is_them" value="{if $is_them}{$is_them}{else}{if !$messages}true{/if}{/if}" />
      </p>
      <table id="editor_form" style="margin-top:5px;width:100%" border="0" cellpadding="2" cellspacing="2">
		<tr id="caption_display" {if $messages && ($smarty.post.is_them!='true' || !$errors)} style="display:none"{/if}>
          <td style="width:80px">
            <b>
              {'Тема:'|ftext}
            </b>
          </td>
          <td>
            <input value="{$caption}" name="caption" id="caption" style="width:500px" />
          </td>
      </tr>
      <tr id="important_display" {if $messages && ($smarty.post.is_them!='true' || !$errors)} style="display:none"{/if}>
        <td align="right" style="white-space:nowrap">
          <b>
            {'Важная тема:'|ftext}
          </b>
        </td>
        <td>
          <input {if $important} checked {/if} type="checkbox" value="1" name="important" id="important" />
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <textarea name="description" id="description">
            {$description}
          </textarea>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input name="attach" type="file" />
        </td>
      </tr>
      <tr>
        <td colspan="2" style="height:10px">
          &nbsp;
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input id="submit_forum_button" style="width:150px" class="button" type="submit" value="{if $smarty.post.edit_type=='update' && $errors}{'Сохранить'|ftext}{else}{'Добавить'|ftext}{/if}" />
        </td>
      </tr>
      </table>
  </form>
  {$editor}
  {else}  
    <h2 style="text-align:center">
      {'Необходима авторизация, чтобы добавлять сообщения.'|ftext}
    </h2>
  {/if}

  <br/>
</div>

{literal}
<script type="text/javascript">

function setQUOTE(id) {
	var message_html =document.getElementById("message_description_id_"+id).innerHTML;
	message_html='<BLOCKQUOTE style="color:gray;background-color:#e9eaea;border:1px solid #d7d8d8"><div style="margin:5px;">'+message_html+'</div></BLOCKQUOTE><p> </p>';
	tinyMCE.get('description').focus();
	tinyMCE.activeEditor.setContent(message_html);
	document.location.href='#editor_form';
}

function setEdit(id, data_id, is_them) {
	var message_html =document.getElementById("message_description_id_"+id).innerHTML;

	if (is_them) {		
		document.getElementById("caption").value=document.getElementById("caption_hidden").value;
		if (document.getElementById("important_hidden").value==1)  document.getElementById("important").checked=true;
		else document.getElementById("important").checked=false;		
		document.getElementById("caption_display").style.display='table-row';
		document.getElementById("important_display").style.display='table-row';
	}
	else {
		document.getElementById("caption").value='';
		document.getElementById("caption_display").style.display='none';
		document.getElementById("important_display").style.display='none';
	}
	
	document.getElementById("is_them").value=is_them;
	document.getElementById("data_id").value=data_id;
	document.getElementById("edit_type").value='update';
	document.getElementById("submit_forum_button").value="{/literal}{'Сохранить'|ftext}{literal}";
	tinyMCE.get('description').focus();
	tinyMCE.activeEditor.setContent(message_html);
	document.location.href='#editor_form';
}

function setAnswer() {
	tinyMCE.get('description').focus();
	document.getElementById("is_them").value=false;
	tinyMCE.activeEditor.setContent('');
	document.getElementById("edit_type").value='insert';
	document.getElementById("caption_display").style.display='none';
	document.getElementById("important_display").style.display='none';	
	document.getElementById("submit_forum_button").value="{/literal}{'Добавить'|ftext}{literal}";	
	document.location.href='#editor_form';
}

function showHideEditor() {
	document.getElementById("editor_form_place").style.display='block';
	document.location.href='#editor_form';	
}
</script>
{/literal}
