<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Товарный чек №{$order.id} от {$date}г.</title>
{literal}
  <style>
    td {
      font-size: 12px;
    }	
  </style>
{/literal}
</head>
<body onload="window.print();">

<center>
	<div style="width:800px;text-align:left;">
	<table cellpadding="2" cellspacing="1" >
		<tr><td><b>Поставщик:</b></td><td>{$settings.receipt_postavshik}</td></tr>
		<tr><td>Р/с:</td><td>{$settings.receipt_rashetniy_shet}</td></tr>
		<tr><td>БИК:</td><td>{$settings.receipt_BIK}</td></tr>
		<tr><td>ИНН:</td><td>{$settings.receipt_INN}</td></tr>
		<tr><td>Юр. адрес:</td><td>{$settings.receipt_uridicheskiy_address}</td></tr>
	</table>

      <center>
        <h4 style="margin:0px">
          Товарный чек №{$order.id} от {$date}г.
        </h4>
      </center>

	<table cellpadding="2" cellspacing="1" style="border:0px" >
		<tr><td><b>Плательщик:</b></td><td>{$order.second_name} {$order.name} {$order.otchestvo}</td></tr>
	</table>

	<table cellpadding="2" cellspacing="0" style="width:100%;margin-top:5px;border: 1px solid black;">
		<tr style="background-color:#efefef">
		<td style="width:5%;border: 1px solid black"><b>№</b></td>
		<td style="width:40%;border: 1px solid black"><b>Наименование</b></td>
		<td style="width:5%;border: 1px solid black"><b>Единица</b></td>
		<td style="width:10%;border: 1px solid black"><b>Кол-во</b></td>
		<td style="width:10%;border: 1px solid black"><b>Цена</b></td>
		<td style="width:15%;border: 1px solid black"><b>Сумма без НДС</b></td>
		<td style="width:15%;border: 1px solid black"><b>Сумма НДС</b></td>
		</tr>
		{foreach name="products" from=$products item=item}
			<tr>
			<td style="border: 1px solid black;">{$smarty.foreach.products.iteration}</td>
			<td style="border: 1px solid black;">{$item.article} {$item.caption}</td>
			<td style="border: 1px solid black;">{$item.unit_id_caption}</td>
			<td style="border: 1px solid black;">{$item.amount}</td>
			<td style="border: 1px solid black;">{$item.price}</td>
			<td style="border: 1px solid black;">{$item.price_bez_nds}</td>
			<td style="border: 1px solid black;">{$item.price_nds}</td>
			</tr>
		{/foreach}
	</table>

      <table cellpadding="0" cellspacing="0" style="width:100%;border:0px">
		<tr>
          <td>
            <table cellpadding="2" cellspacing="1" style="border:0px;margin-right:20px" align="right">
              <tr>
                <td>
                  <b>
                    Итого без НДС:
                  </b>
                </td>
                <td>
                  {$price_bez_nds_total}
                </td>
              </tr>
              <tr>
                <td>
                  <b>
                    НДС:
                  </b>
                </td>
                <td>
                  {$nds_total}
                </td>
              </tr>
              <tr>
                <td>
                  <b>
                    Итого с НДС:
                  </b>
                </td>
                <td>
                  {$price_s_nds_total}
                </td>
              </tr>
            </table>
          </td>
      </tr>
      </table>

      <table cellpadding="2" cellspacing="1" style="border:0px">
		<tr>
          <td>
            <b>
              Итого с НДС прописью:
            </b>
          </td>
          <td>
            {$total_summ} {$currency.sign} {$total_ostatok} {$currency.sign_fraction}
          </td>
      </tr>
      </table>
      <br/>
      <br/>

	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
		<td><b>Выдал</b></td><td>_____________________</td>
		<td style="width:100%"></td>
		<td><b>Получил</b></td><td>_____________________</td>
		</tr>
	</table>
</div>
</center>
</body>
</html>