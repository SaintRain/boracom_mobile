{literal} 
<script language="JavaScript">
function Mysubmit(form) {
	s=form.login.value;
	if (s=='') {
		{/literal}
		form.login.focus(); alert("{$MSGTEXT.enter_login}"); return false
		{literal}
	};
	s=form.email.value;
	if (s.indexOf('@',0)==-1) {form.email.focus(); {/literal}alert("{$MSGTEXT.incorrect_email}"){literal}; return false};
	s=form.password.value;
	s2=form.password2.value;
	if (s!=s2) {form.password2.focus(); {/literal}alert("{$MSGTEXT.pas_is_different}");{literal} return false};
	if (s=='') {
		form.password.focus(); {/literal}alert("{$MSGTEXT.type_password}");{literal} return false
	};
	return true;
}
</script> 
{/literal}
<form id="data form" action="?act=administrators&do=insert" method="POST" onsubmit="return Mysubmit(this)" style="margin:0">
  <table class="formborder" border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td>
	<table width="100%" align="center" cellpadding="1" cellspacing="0" bgcolor="#74a9d3" border="0">
	<tr>
	<td>       
      <table class="formbackground" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td>{$MSGTEXT.login}: <font color="Yellow">*</font></td>
            <td><input type="text" style="width:300px" name="login" value=""></td>
          </tr>
          <tr>
            <td>{$MSGTEXT.email}: <font color="Yellow">*</font></td>
            <td><input type="text" style="width:300px" name="email" value=""></td>
          </tr>
          <tr>
            <td>{$MSGTEXT.password}: <font color="Yellow">*</font></td>
            <td><input type="password" style="width:300px" name="password" value=""></td>
          </tr>
          <tr>
            <td>{$MSGTEXT.confirmation}: <font color="Yellow">*</font></td>
            <td><input type="password" style="width:300px" name="password2" value=""></td>
          </tr>
          <tr>
            <td><a href="index.php?act=administrators&do=group_edit">{$MSGTEXT.group}</a>: <font color="Yellow">*</font></td>
            <td><select name="group_id" style="width:300px">
                <option style="color:gray" value="0">{$MSGTEXT.superadmin}
                {foreach from=$admin_groups item=group}
                <option value="{$group.id}">{$group.name}</option>
                {/foreach}
              </select></td>
          </tr>
          <tr>
            <td>{$MSGTEXT.your_ip} </td>
            <td align="left">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><input type="text" style="width:150px;"  name="ip" value="{$ip}"></td>
                  <td width="10px"></td>
                  <td><input type="checkbox" name="check_ip" {if $check_ip==1} checked {/if} value="1"></td>
                  <td>&nbsp;{$MSGTEXT.check_ip}</td>
                </tr>
              </table></td>
          </tr>
                    
          <tr>
            <td></td>
            <td>
			  <table border="0" cellpadding="0" cellspacing="0">
                <tr>                  
                  <td><input type="checkbox" class="checkbox" name="read_only" {if $read_only==1} checked {/if} value="1"></td>
                  <td>&nbsp;{$MSGTEXT.read_only}</td>
                </tr>
              </table>             
            </td>
          </tr>
                    
          <tr>
            <td colspan="100%" height="10px"></td>            
          </tr>          
          
          <tr>
            <td></td>
            <td><input class="button" type="submit" value="{$MSGTEXT.add}" style="width:130px" ></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
    </td>
    </tr>
  </table>  
</form>