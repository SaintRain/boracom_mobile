<br/>
<h4 style="text-align:center;margin:0px">
  {'Товарный чек №'|ftext}{$order.id} {'от'|ftext} {$date}{'г.'|ftext}
</h4>

<table cellpadding="2" cellspacing="1" style="border:0px" >
  <tr>
    <td>
      <b>
        {'Плательщик:'|ftext}
      </b>
    </td>
    <td>
      {$order.second_name} {$order.name} {$order.otchestvo}
    </td>
  </tr>
</table>

<table cellpadding="2" cellspacing="1" style="width:100%;margin-top:5px;background-color:#e1e5e8">
  <tr style="background-color:#efefef">
    <td style="width:5%">
      <b>№</b>
    </td>
    <td style="width:40%">
      <b>
        {'Наименование'|ftext}
      </b>
    </td>
    <td style="width:5%">
      <b>
        {'Единица'|ftext}
      </b>
    </td>
    <td style="width:10%">
      <b>
        {'Кол-во'|ftext}
      </b>
    </td>
    <td style="width:10%">
      <b>
        {'Цена'|ftext}
      </b>
    </td>
    <td style="width:15%">
      <b>
        {'Сумма без НДС'|ftext}
      </b>
    </td>
    <td style="width:15%">
      <b>
        {'Сумма НДС'|ftext}
      </b>
    </td>
  </tr>
  {foreach name="products_comp" from=$products item=item}
  <tr style="width:100%;background-color:white">
    <td>
      {$smarty.foreach.products_comp.iteration}
    </td>
    <td>
      {$item.article} {$item.caption}
    </td>
    <td>
      {$item.unit_id_caption}
    </td>
    <td>
      {$item.amount}
    </td>
    <td>
      {$item.price}
    </td>
    <td>
      {$item.price_bez_nds}
    </td>
    <td>
      {$item.price_nds}
    </td>
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
              {'Итого без НДС:'|ftext}
            </b>
          </td>
          <td>
            {$price_bez_nds_total}
          </td>
        </tr>
        <tr>
          <td>
            <b>
              {'НДС:'|ftext}
            </b>
          </td>
          <td>
            {$nds_total}
          </td>
        </tr>
        <tr>
          <td>
            <b>
              {'Итого с НДС:'|ftext}
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
        {'Итого с НДС прописью:'|ftext}
      </b>
    </td>
    <td>
      {$total_summ} {$currency.sign} {$total_ostatok} {$currency.sign_fraction}
    </td>
  </tr>
</table>
<br/>