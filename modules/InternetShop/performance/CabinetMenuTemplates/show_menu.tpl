<table fastedit:: cellpadding="2" cellspacing="2" border="0">
  <tr>
    <td>
      <a {if !$smarty.get.act || $smarty.get.act=='profile' || $smarty.get.act=='update_profile'} style="font-size:16px;font-weight:bold"{else} style="font-size:16px"{/if} href="?act=profile">
        {'Мои данные'|ftext}
      </a>
    </td>
    <td style="width:10px">
    </td>
    <td>
      <a {if $smarty.get.act=='orders'} style="font-size:16px;font-weight:bold"{else} style="font-size:16px"{/if} href="?act=orders">
        {'Мои заказы'|ftext}
      </a>
    </td>
    <td style="width:10px">
    </td>
    <td>
      <a {if $smarty.get.act=='help' || $smarty.get.act=='help_add_q'} style="font-size:16px;font-weight:bold"{else} style="font-size:16px"{/if} href="?act=help">
        {'Техподдержка'|ftext}
      </a>
    </td>
    <td style="width:10px">
    </td>
    <td>
      <a style="font-size:16px;" href="?act=logout">
        {'Выйти'|ftext}
      </a>
    </td>
  </tr>
</table>

<table style="width:100%" cellpadding="0" cellspacing="0" border="0">
  <tr style="height:14px">
    <td align='left' valign='center' class="cont_line">
      <img alt="" src='/modules/InternetShop/img/zero.gif' width="9px" height="14px" border='0' hspace='0'/>
    </td>
  </tr>
</table>