jQuery.ajaxSetup({async:false});
var cookieValue = '';


function GetElementById(id) {
    if (document.getElementById) {
        return (document.getElementById(id));
    }
    else if (document.all) {
        return (document.all[id]);
    }
    else {
        if ((navigator.appname.indexOf("Netscape") != -1) && parseInt(navigator.appversion == 4)) {
            return (document.layers[id]);
        }
    }
}

function SetCookie(vars) {
    var time = Math.random();
    $.get("/modules/InternetShop/ajax/ajax.php", {'func':'SetCookie', 'shop_cart_module':$.toJSON(vars), 'time':time});
}


function getCookie(vars) {
    var time = Math.random();

    $.get("/modules/InternetShop/ajax/ajax.php",
        {'func':'getCookie', 'shop_cart_module':$.toJSON(vars), 'time':time},
        function (response) {
            //  alert(response);
            if (response) {
                cookieValue = $.evalJSON(response);
            }
            else {
                cookieValue = false;
            }
        })

    return cookieValue;
}


function getTotalSumm() {
    var time = Math.random();

    $.get("/modules/InternetShop/ajax/ajax.php",
        {'func':'getTotalSumm', 'time':time},
        function (response) {
            var t = $.evalJSON(response);
            SetCookie({totalSummInDefault:t.total_summ, totalSumm:t.total_summ2, totalSummDiscount_by_q:t.discount_by_q_summ, totalCount:t.total_count});
            printTotalSumm();
        }
    )
}


function printTotalSumm(vmas) {

    var vmas = getCookie({totalCount:true, totalSummDiscount_by_q:true, totalSumm:true, totalSummInDefault:true});

    if (vmas) {
        var kolichestvo = vmas.totalCount;
        var sk_by_q = vmas.totalSummDiscount_by_q;
        var cost = vmas.totalSumm;
        var costDefault = vmas.totalSummInDefault;
    }
    else {
        var kolichestvo = 0;
        var cost = 0;
    }


    /*
     var kolichestvo = unescape(getCookie("totalCount"));
     var sk_by_q		= unescape(getCookie("totalSummDiscount_by_q"));
     */
    if (kolichestvo > 0) {
        if (GetElementById('shopcart_info_empty')) {
            GetElementById('shopcart_info_empty').style.display = 'none';
            GetElementById('shopcart_info').style.display = 'block';
        }

        //	var cost 		= unescape(getCookie("totalSumm"));
        //	var costDefault = unescape(getCookie("totalSummInDefault"));

        if (GetElementById('total_summ')) {
            if (cost != 0) GetElementById('total_summ').innerHTML = cost;
            GetElementById('total_count').innerHTML = kolichestvo;
        }

        if (GetElementById('shopcart_total_summ')) {

            cost = removeSpaces(costDefault+'');

            GetElementById('shopcart_total_summ').innerHTML = number_format(cost, round_price_to, ',', ' ');
            if (discount_percent > 0) {
                sk = Math.ceil((cost / 100) * discount_percent);
            }
            else sk = 0;

            GetElementById('shopcart_discount').innerHTML = number_format(sk, round_price_to, ',', ' ');
            var total_sum = cost - (parseInt(sk) + parseInt(sk_by_q));

            GetElementById('shopcart_total').innerHTML = number_format(total_sum, round_price_to, ',', ' ');

            if (GetElementById('shopcart_discount_by_q_summ')) {

                GetElementById('shopcart_discount_by_q_summ').innerHTML = number_format(sk_by_q, round_price_to, ',', ' ');
            }
        }
    }
    else {
        if (GetElementById('shopcart_total')) {
            location.href = location.href;
        }
        else {
            if (GetElementById('shopcart_info_empty')) {

                GetElementById('shopcart_info_empty').style.display = 'block';
                GetElementById('shopcart_info').style.display = 'none';
                //var cost = unescape(getCookie("totalSumm"));
                if (cost != 0) GetElementById('total_summ').innerHTML = cost;
                else GetElementById('total_summ').innerHTML = '0';

                GetElementById('total_count').innerHTML = kolichestvo;
            }
        }
    }
}


function deleteFromCart(productId) {

    //var vmas = getCookie({shopingcart:true});
    //shopingcart = vmas.shopingcart;

    //shopingcart		= unescape(getCookie("shopingcart"));

    if (shopingcart != 'false') {
        elements = shopingcart.split(";");

        buf = "";
        razdelitel = '';
        for (i2 = 0; i2 < elements.length - 1; i2 = i2 + 2) {
            if (elements[i2] != productId) {
                buf = buf + razdelitel + elements[i2] + ';' + elements[i2 + 1];
                razdelitel = ';';
            }
        }

        GetElementById('str_' + productId).style.display = 'none';
        if (!buf) {
            var time = Math.random();
            $.get("/modules/InternetShop/ajax/ajax.php", {'func':'SetEmpty', 'time':time});
            location.href=location.href;
        }
        else {
            shopingcart=buf;
            SetCookie({shopingcart:buf});
        }

        //SetCookie("shopingcart", buf);
    }

    getTotalSumm();
}


function updateCartForm(perehod) {

    //обновляем стоимость товаров по введённому количеству
    var formObject = GetElementById('data');
    var res = true;
    var cost = 0;
    for (i = 0; i < formObject.elements.length; i++) {

        if (formObject.elements[i].id) {

            inpId = formObject.elements[i].id;

            if (inpId.substr(0, 5) == 'count') {
                inpId = inpId.substr(5, inpId.length);
                formObject.elements[i].value;

                if (!updateCart(inpId, formObject.elements[i].value)) {
                    res = false;
                }
                else if (GetElementById('pstoim_' + inpId)) {

                    var product_cost = removeSpaces(GetElementById('pstoim_' + inpId).innerHTML);
                    var newPrice = product_cost * formObject.elements[i].value;
                    cost = cost + newPrice;

                    GetElementById('psum_' + inpId).innerHTML = number_format(newPrice, round_price_to, ',', ' ');
                }
            }
        }
    }

    //удаляем товары, если пользователь отметил их
    for (i = 0; i < formObject.elements.length; i++) {
        if (formObject.elements[i].id) {
            inpId = formObject.elements[i].id;

            if (inpId.substr(0, 7) == 'deleted') {
                if (formObject.elements[i].checked == true)
                    deleteFromCart(formObject.elements[i].value);
            }
        }
    }

    //считаем общую сумму в основной валюте
    if (GetElementById('shopcart_total_summ')) {

        GetElementById('shopcart_total_summ').innerHTML = number_format(cost, round_price_to, ',', ' ');
        if (discount_percent > 0) {
            sk = Math.ceil((cost / 100) * discount_percent);
        }
        else sk = 0;

        GetElementById('shopcart_discount').innerHTML = number_format(sk, round_price_to, ',', ' ');
        var total_sum = cost - sk;
        GetElementById('shopcart_total').innerHTML = number_format(total_sum, round_price_to, ',', ' ');
    }


    if (res) {
        if (perehod) location.href = '/shopcart';
    }


    if (!perehod) {
        getTotalSumm();
    }
}


function addToCart(productId) {

    productCount = GetElementById('ind' + productId).value;

    if (productCount > 0) {
        /*
        var vars = ["shopingcart"];
        var vmas = getCookie(vars);
        var shopingcart = unescape(vmas['shopingcart']);
        */
        //shopingcart		= unescape(getCookie("shopingcart"));

        var uje_dobavlen = false;
        if (shopingcart == 'false') shopingcart = '';
        else {
            elements = shopingcart.split(";");

            for (i = 0; i < elements.length - 1; i = i + 2) {
                if (parseInt(elements[i]) == parseInt(productId)) {
                    uje_dobavlen = true;
                    if (parseInt(productCount) < 1000000) {
                        var productCountTotal = elements[i + 1];

                    }
                    else {
                        alert('Указано слишком большое количество товара!');
                    }

                    //alert(productCountTotal);
                    break;
                }
            }
        }



        if (uje_dobavlen == false) {
            if (shopingcart.length > 0) razdelitel = ';'
            else razdelitel = '';
            shopingcart = shopingcart + razdelitel + productId + ';' + productCount;

            SetCookie({shopingcart:shopingcart});
            //SetCookie("shopingcart", shopingcart);
            getTotalSumm();
            showProductAded(productId);

            imageFly(productId);


          //  alert('Товар добавлен!');
        }
        else {
            //alert('Товар был добавлен ранее!');
            productCountTotal = parseInt(productCountTotal)
            var productCountTotal = productCountTotal + 1;
            if (updateCart(productId, productCountTotal)) {
                getTotalSumm();

                showProductAded(productId);
                imageFly(productId);
                //alert('Товар добавлен!');
            }
        }
    }
    else {
        alert('Количество заказываемого товара должно быть больше нуля!');
    }
}


function imageFly(productId) {

    var basketX 	= $("#shopcart_info").offset().left;
    var basketY 	= $("#shopcart_info").offset().top;
    var imageX 		= $("#pimg"+productId).offset().left;
    var imageY 		= $("#pimg"+productId).offset().top;

    $("#pimg"+productId)
        .clone()
        .css({'position' : 'absolute', 'z-index' : '100', 'left':imageX, 'top':imageY})
        .prependTo("#pimg"+productId+'_div')
        .animate({opacity: 0.5,
            top: basketY,
            left: basketX,
            width: 50
            }, 700, function() {
            $(this).remove();
        });
}


function updateCart(productId, productCount) {

    if (productCount > 0) {
        if (parseInt(productCount) < 1000000) {

            //var vmas = getCookie({shopingcart:true});
            //shopingcart = vmas.shopingcart;

            //shopingcart		=  unescape(getCookie("shopingcart"));
            if (shopingcart != 'false') {
                elements = shopingcart.split(";");

                buf = '';
                razdelitel = '';
                for (i2 = 0; i2 < elements.length - 1; i2 = i2 + 2) {
                    if (elements[i2] == productId) {
                        elements[i2 + 1] = productCount;
                    }

                    buf = buf + razdelitel + elements[i2] + ';' + elements[i2 + 1];
                    razdelitel = ';';
                }
                shopingcart=buf;
                SetCookie({shopingcart:buf});
                //SetCookie("shopingcart", buf);

                return true;
            }
        }
        else {
            alert('Указано слишком большое количество товара!');
        }
    }
    else {
        alert('Количество заказываемого товара должно быть больше нуля!');
        return false;
    }
}

function showProductAded(productId) {

    productCount = 0;
    uje_dobavlen = false;
    if (shopingcart == 'false') {
        shopingcart = '';
    }
    else {
        elements = shopingcart.split(";");

        for (i = 0; i < elements.length - 1; i = i + 2) {

            if (elements[i] == productId) {
                var productCount = elements[i + 1];
                uje_dobavlen = true;
                break;
            }
        }
    }

    if (uje_dobavlen && productCount > 0) {

        if (GetElementById('inShop' + productId)) {
            GetElementById('inShop' + productId).innerHTML = productCount + " уже в <a href='/shopcart'>корзине</a>&nbsp;&nbsp;";
        }
        if (GetElementById('inShopdiscount' + productId)) {
            GetElementById('inShopdiscount' + productId).innerHTML = productCount + " уже в корзине";
        }
    }
}

function setCurrency(obj) {
    var vars = {currency_id:obj.value};
    var time = Math.random();

    $.get("/modules/InternetShop/ajax/ajax.php",
        {'func':'SetCookie', 'shop_cart_module':$.toJSON(vars), 'time':time},
        function (response) {
            window.location.reload();
        }
    )
}


function number_format(number, decimals, dec_point, thousands_sep) {

    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function removeSpaces(s) {

    if (s) {
    var spaceRe = / +/g;
    var spaceRe2 = /,+/g;
        s=s.replace(spaceRe, "");
        s=s.replace(spaceRe2, ".");
        return s;
    }
    else {
        return s;
    }
}


function reloadKcaptcha(object_id) {
    var time = Math.random();
    document.getElementById(object_id).src = "/tools/kcaptcha/index.php?t=" + time;
}


$(document).ready(function () {


    //Вызывается когда вводятся символы в поле с id quantity
    $(".numbers_only").keypress(function (e) {
        //Если символ - не цифра, ввыодится сообщение об ошибке, другие символы не пишутся
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //Вывод сообщения об ошибке
            return false;
        }
    });

  //  printTotalSumm();
});