import './product-main.scss';
import $ from 'jquery';

//Открытие карточки

$(".product-main__item-more").click(function () {
    $(this).next().slideToggle({
        direction: "up"
    }, 300);

    $(this).parent().toggleClass("product-main__item_active");
    $(this).find(".product-main__item-more-plus").toggleClass("product-main__item-more-plus_active");

    $(this).toggleClass("product-main__item-more_active");
});





//Закрытие карточки

$(".product-main__item-close").click(function () {

    $(this).parent().slideToggle({
        direction: "up"
    }, 300);

    $(this).parent().parent().removeClass("product-main__item_active");
    $(this).parent().parent().find(".product-main__item-more-plus").removeClass("product-main__item-more-plus_active");

    $(this).parent().parent().find(".product-main__item-more").toggleClass("product-main__item-more_active");
});

//Подсчет в товаре


//Обработка клика на +
$('.product-main__cart-item-plus').click(function(){

    var quantity = parseFloat($(this).parent().parent().attr("data-quantity")).toFixed(2)*1;
    var price = parseFloat($(this).parent().parent().attr("data-price")).toFixed(2)*1;

    var inp = parseFloat(quantity).toFixed(2)*1;
    var total = parseFloat(inp + 1);


    $(this).parent().parent().attr("data-quantity", total);
    $(this).prev().val(total);


    var price2 = (parseFloat(price*total).toFixed(2))*1;

    $(this).parent().parent().attr("data-total", price2);


    const sum = parseFloat($(this).parent().parent().parent().parent().parent().find(".product-main__cart-item").get().reduce((acc, n) => acc + +n.dataset.total, 0).toFixed(2))*1;
    $(this).parent().parent().parent().parent().next().find(".product-main__cart-order-price").text(" " + sum);





});



//Обработка клика на -
$('.product-main__cart-item-minus').click(function(){

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


        const sum = parseFloat($(this).parent().parent().parent().parent().parent().find(".product-main__cart-item").get().reduce((acc, n) => acc + +n.dataset.total, 0).toFixed(2))*1;
        $(this).parent().parent().parent().parent().next().find(".product-main__cart-order-price").text(" " + sum);

    }
});
