import './products.scss';
import $ from 'jquery';

//Отступ для контента
$(window).on('resize load', paddingResize);

function paddingResize() {
    let pt = $('.header').outerHeight();
    console.log(pt);
    $('.products').css({
        'padding-top': pt
    });
}


//Подсчет в товаре


//Обработка клика на +
$('.products__cart-item-plus').click(function(){

    var quantity = parseFloat($(this).parent().parent().attr("data-quantity")).toFixed(2)*1;
    var price = parseFloat($(this).parent().parent().attr("data-price")).toFixed(2)*1;

    var inp = parseFloat(quantity).toFixed(2)*1;
    var total = parseFloat(inp + 1);


    $(this).parent().parent().attr("data-quantity", total);
    $(this).prev().val(total);

    var price2 = (parseFloat(price*total).toFixed(2))*1;

    $(this).parent().parent().attr("data-total", price2);


    const sum = parseFloat($(this).parent().parent().parent().find(".products__cart-item").get().reduce((acc, n) => acc + +n.dataset.total, 0).toFixed(2))*1;

    console.log(sum);

    $(this).parent().parent().parent().find(".products__cart-order-price").text(" " + sum);
});



//Обработка клика на -
$('.products__cart-item-minus').click(function(){

    var quantity = parseFloat($(this).parent().parent().attr("data-quantity")).toFixed(2)*1;
    var price = parseFloat($(this).parent().parent().attr("data-price")).toFixed(2)*1;

    var inp = parseFloat(quantity).toFixed(2)*1;
    var total = parseFloat(inp - 1);


    if(inp==0){

    }
    else{


        $(this).parent().parent().attr("data-quantity", total);
        $(this).next().val(total);

        var price2 = (parseFloat(price*total).toFixed(2))*1;

        $(this).parent().parent().attr("data-total", price2);


        const sum = parseFloat($(this).parent().parent().parent().find(".products__cart-item").get().reduce((acc, n) => acc + +n.dataset.total, 0).toFixed(2))*1;
        $(this).parent().parent().parent().find(".products__cart-order-price").text(" " + sum);

    }
});
