import './header.scss';
import $ from 'jquery';

$(document).ready(()=>{
    window.location.hash.substr(1)
    if (window.location.hash.substr(1) === "login-button")
        $("#login-button").click();
});

//Открытие меню
$(".header__menu").click(function () {
    $(".header__menu-inner").addClass("header__menu-inner_active");
    $(".header__menu-burger").addClass("header__menu-burger_active");
    $(".header__blur").addClass("header__blur_active");
    setTimeout(function(){
        $('.header__blur_active').addClass('header__blur_move');
    },1000);
    $("body").addClass("body_active");
});


//Закрытие меню
$(".header__menu-close").click(function () {
    $(".header__menu-inner").removeClass("header__menu-inner_active");
    $(".header__menu-burger").removeClass("header__menu-burger_active");
    $(".header__blur").removeClass("header__blur_active");
    $("body").removeClass("body_active");
});





//Корзина открывашка
$(".header__cart").click(function () {
    $( ".header__cart-inner" ).slideToggle();
});

//Корзина закрывашка
$(".header__cart-content-close").click(function () {
    $( ".header__cart-inner" ).slideUp();
});

//Корзина закрывашка
$("#continue").click(function () {
    $( ".header__cart-inner" ).slideUp();
    $( ".header__cart-inner" ).slideUp();
});


//Подсчет в мини-корзине


//Общая сумма в мини-корзине


//Обработка клика на +
$('.header__cart-item-plus').click(cartItemPlusHandler);
function cartItemPlusHandler(){

    var quantity = parseFloat($(this).parent().parent().attr("data-quantity")).toFixed(2)*1;
    var price = parseFloat($(this).parent().parent().attr("data-price")).toFixed(2)*1;

    var inp = parseFloat(quantity).toFixed(2)*1;
    var total = parseFloat(inp + 1);


    $(this).parent().parent().attr("data-quantity", total);
    $(this).prev().val(total);


    var price2 = (parseFloat(price*total).toFixed(2))*1;

    $(this).parent().parent().attr("data-total", price2);


    $(this).parent().prev().find(".real-price").text(" " + price2);

    const sum = parseFloat($('.header__cart-content-metryc-content.active .header__cart-item').get().reduce((acc, n) => acc + +n.dataset.total, 0).toFixed(2))*1;
    $(this).parent().parent().parent().parent().parent().next().find(".header__cart-order-price").text(" " + sum);





}
//Обработка клика на -
$('.header__cart-item-minus').click(cartItemMinusHandler);
function cartItemMinusHandler(){

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


        $(this).parent().prev().find(".real-price").text(" " + price2);

        const sum = parseFloat($('.header__cart-content-metryc-content.active .header__cart-item').get().reduce((acc, n) => acc + +n.dataset.total, 0).toFixed(2))*1;
        $(this).parent().parent().parent().parent().parent().next().find(".header__cart-order-price").text(" " + sum);

    }
}
//get set cookies
function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
function setCookie(name, value, options = {}) {

    options = {
        path: '/',
        // при необходимости добавьте другие значения по умолчанию
        ...options
    };

    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    }

    let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

    for (let optionKey in options) {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }

    document.cookie = updatedCookie;
}

//change currency
$('.wmc-currency').on('click', changeCurrency);
function changeCurrency() {
    if (currencies_data === undefined || $(this).hasClass('wmc-active') ) return;

    if(getCookie('wmc_current_currency') === undefined)
        setCookie('wmc_current_currency',currencies_data['default']);

    $(this).siblings().removeClass('wmc-active');
    $(this).addClass('wmc-active');

    let targetCurrency = currencies_data['currencies'][$(this).data('currency-symbol')];
    let currentCurrency = currencies_data['currencies'][getCookie('wmc_current_currency')];

    $('.price-currency').each(function(i, item){
        $(item).find('.currency').text(targetCurrency['custom']);
        let priceWrapper = $(item).find('.price');
        let price = Number($(priceWrapper).text());
        price = price / currentCurrency['rate'] * targetCurrency['rate'];
        $(priceWrapper).text(price.toFixed(2));
    });

    setCookie('wmc_current_currency', $(this).data('currency-symbol'));
}

//toggle weight
$('.toggle-weight li').on('click', changeWeight);

function changeWeight() {
    let targetUnit = $(this).data('targetWeightUnit');
    let myCookie = getCookie('weight_unit');

    if (targetUnit.localeCompare(myCookie) === 0) return;

    $(`[data-target-weight-unit='${targetUnit}']`).addClass('active')
        .siblings().removeClass('active');

    $('.variation-weight').each(function () {
        $(this).text($(this).data('weight')[targetUnit]);
    });
    setCookie('weight_unit', targetUnit);
}

//user login and register
$('#form_login_modal').on('submit', function (event) {
    event.preventDefault();
    blockPopup();
    let serializeData = $('#form_login_modal').serializeArray();
    if (mastak_ajax.account_url) {
        $.ajax({
            type: 'POST',
            url: mastak_ajax.account_url.toString().replace('%%endpoint%%', 'login'),
            data: serializeData,
            dataType: 'json'
        })
            .done( response => {
                unblockPopup();
                // console.log('login form done: ',response);
                if(response['user']){
                    $('#close-reg-log-popup').click();
                    $('#header__cabinet-text').text(response['user']['displayName']);
                    $('#login-button').attr('style', 'display: none !important');
                    $('#go-to-acc-button').css("display","flex");

                    $('#aside__cabinet-text').text(response['user']['displayName']);
                    $('#login-button-aside').attr('style', 'display: none !important');
                    $('#go-to-acc-button-aside').css("display","flex");
                }
                if( response['result'] === false)
                    displayResult.bind(this)(response['error']);
            })
            .fail(function (response) {
                console.log('login form error: ',response);
                // if(response['error'].length > 0 )
                // displayResult(response['error']);
                // console.log(response);
                unblockPopup();
            });
    }
});

$('#form_registration_modal').on('submit', function (event) {
    event.preventDefault();
    blockPopup();
    let serializeData = $('#form_registration_modal').serializeArray();

    let pass = serializeData.find(input => input['name'] === "password");
    let checkPass = serializeData.find(input => input['name'] === "password_again");
    if (pass['value'].localeCompare(checkPass["value"]) === 0) {
        if (mastak_ajax.account_url) {
            $.ajax({
                type: 'POST',
                url: mastak_ajax.account_url.toString().replace('%%endpoint%%', 'registration'),
                data: serializeData,
                dataType: 'json'
            })
                .done( response => {
                    unblockPopup();
                    console.log('registr form done: ',response);

                    if( response['result'] === false){
                        displayResult.bind(this)(response['error']);
                        return;
                    }else if(response['success'] === true){
                        $('#close-reg-log-popup').click();
                        $('#header__cabinet-text').text(response['data']['user']['displayName']);
                        $('#login-button').attr('style', 'display: none !important');
                        $('#go-to-acc-button').css("display","flex");
                    }
                })
                .fail(function (response) {
                    console.log('registration form error: ',response);
                    unblockPopup();
                    // console.log(response);
                });
        }else{
            displayResult('connection error');
            unblockPopup();
        }
    }else{
        displayResult.bind(this)("passwords are not equal" );
        unblockPopup();
    }
});
function blockPopup() {
    $('.popup__content').find('.ajax_loader_wrapper').addClass('ajax_loader_wrapper-active');
}
function unblockPopup() {
    $('.popup__content').find('.ajax_loader_wrapper').removeClass('ajax_loader_wrapper-active');
}
function displayResult(result) {
    // let wrapper = $(this).parent().find('.result-wrapper .result');
    $(this).parent().find('.result-wrapper .result').html('');
    $(this).parent().find('.result-wrapper .result').append(result);
}



//product ajax
$('.ms_add_to_cart').on('click', addCartItemHandler);

/*
* Event delete mini cart item
*/
$('.header__cart-item-close').on('click', deleteMiniCartItemHandler);

/*
* Event change quantity of product in mini cart
*/
$('.header__cart-item-minus, .header__cart-item-plus').on('click', changeQuantityOfProductHandler);


/*
* Handler add mini cart item
*/
function addCartItemHandler(event) {
    let selectors = null;
    let selectorsList = {
        'home': {
            'wrapperSelector': '.product-main__item',
            'variationSelector': '.product-main__cart-item',
            'quantitySelector':'.product-main__cart-item-number'
        },
        'archive':{
            'wrapperSelector': '.products__item',
            'variationSelector': '.products__cart-item',
            'quantitySelector':'.products__cart-item-number'
        },
        'single':{
            'wrapperSelector': '.product__item',
            'variationSelector': '.product__cart-item',
            'quantitySelector':'.product__cart-item-number'
        }
    };
    if($(this).hasClass('product-main__item-more')){
        let flagTag =  this.children[0];
        if (!$(flagTag).hasClass('product-main__item-more-plus_active')) return;
        selectors = selectorsList.home;
    }
    else if($(this).hasClass('products__more'))
        selectors = selectorsList.archive;
    else if($(this).hasClass('product__more'))
        selectors = selectorsList.single;
    else return;

    activateLoader();

    let productBody = $(this).closest(selectors.wrapperSelector);
    let productId = productBody.data('product-id');
    let selectedVariations = $(productBody).find(selectors.variationSelector);

    let variationsDataMap = selectedVariations.map((i, item) => {
        try{
            if($(item).find(selectors.quantitySelector).length !== 0)
                return {
                    variationId : item.dataset.variationId,
                    quantity : $(item).find(selectors.quantitySelector)[0].value};
            else
                return {
                    variationId : item.dataset.variationId,
                    quantity : 0};
        }catch(ex){
            console.log(ex);
        }
    }).toArray();
    let variationsDataFilter = variationsDataMap.filter(item => item.quantity > 0 );

    if (variationsDataFilter.length < 1){
        deactivateLoader();
        return;
    }

    let data = {
        'productId': productId,
        'selectedVariations': variationsDataFilter
    };

    if (mastak_ajax.cart_url === undefined) return;
    $.ajax({
        type: 'POST',
        url: mastak_ajax.cart_url.toString().replace('%%endpoint%%', 'add_to_cart'),
        data: data,
        dataType: 'json'
    })
        .done(function (response) {
            // console.log(response);
            if (!response) return;
            if (response.error) return;

            if (response['data']['generate_parent_wrapper'])
                $("#mini-cart-items-list").append(response['data']['view']);
            else
                $(`#parent-${response['data']['product_id']}`).append(response['data']['view']);

            response['data']['variation'].forEach(obj => {
                // console.log('obj', obj);
                // console.log('obj.is_new_item', obj.is_new_item);
                if(obj.is_new_item) {
                    setCartItemHandlers(obj.product_cart_key);
                }
                else{
                    changeCartItemData(obj);
                }
            });

            $("#cart-total").text(response['data']['cartTotals']['priceTotal']);


            $(productBody).find('input').val(0);
            $(selectedVariations).attr('data-quantity',0);
            if($('.product-main__cart-order-price').length > 0)
                $('.product-main__cart-order-price').text(0);
            if($('.product__cart-order-price').length > 0)
                $('.product__cart-order-price').text(0);

            deactivateLoader();
            countProdsAndSetCounter();
            if ( $(".header__cart-inner").css('display') === 'none' )
                $('.header__cart').click();
        })
        .fail(function () {
            deactivateLoader();
            countProdsAndSetCounter();
        });
}

/*
* Handler delete mini cart item
*/
function deleteMiniCartItemHandler(event) {
    event.preventDefault();
    if (mastak_ajax.cart_url === undefined) return;
    activateLoader();
    let $currentCartItem = $(this).closest('.header__cart-item');

    $.ajax({
        type: 'POST',
        url: mastak_ajax.cart_url.toString().replace('%%endpoint%%', 'remove_from_cart'),
        data: {'cart_item_key': $currentCartItem.data('cart-item-key')},
        dataType: 'json'
    }).done( (response) =>  {
        // console.log(response);
        if(!response.success) return;

        $("#cart-total").text(response['data']['cartTotals']['total']);
        let prodWrapper = $(this).parents('.header__cart-content-inner')[0];

        if(prodWrapper.children.length <= 2 ) prodWrapper.replaceWith('');
        else $currentCartItem.replaceWith('');
        deactivateLoader();
        countProdsAndSetCounter();
    } ).fail(function () {
        deactivateLoader();
        countProdsAndSetCounter();
    });
}

/*
* Handler change quantity of product in mini cart
*/
function changeQuantityOfProductHandler(event) {
    event.preventDefault();
    if ( mastak_ajax.cart_url === undefined ) return;

    let currentCartItem = $(this).closest('.header__cart-item');
    let data = {
        'cart_item_key' : currentCartItem.data('cart-item-key'),
        'parent_product_id' : $(this).closest('.header__cart-content-inner').data('parent-id'),
        'variable_id' : currentCartItem.data('id'),
        'quantity' : Number(currentCartItem.attr('data-quantity'))
    };

    $.ajax({
        type: 'POST',
        url: mastak_ajax.cart_url.toString().replace('%%endpoint%%', 'change_cart_item_quantity'),
        data: data,
        dataType: 'json'
    }).done(()=>{ countProdsAndSetCounter() })
        .fail(response => {
            // console.log(response);
        });
}

function activateLoader() {
    $('.ajax_loader_wrapper').addClass('ajax_loader_wrapper-active');
}
function deactivateLoader() {
    $('.ajax_loader_wrapper-active').removeClass('ajax_loader_wrapper-active');
}

function setCartItemHandlers(itemKey, data){
    let item =$(`#cart-item-key-${itemKey}`);
    //Подсчет в мини-корзине
    // Общая сумма в мини-корзине
    // Обработка клика на +
    $(item).find('.header__cart-item-plus').on('click',function(){
        let quantity = parseFloat($(this).parent().parent().attr("data-quantity")).toFixed(2)*1;
        let price = parseFloat($(this).parent().parent().attr("data-price")).toFixed(2)*1;

        let inp = parseFloat(quantity).toFixed(2)*1;
        let total = parseFloat(inp + 1);

        $(this).parent().parent().attr("data-quantity", total);
        $(this).prev().val(total);

        let price2 = (parseFloat(price*total).toFixed(2))*1;

        $(this).parent().parent().attr("data-total", price2);
        $(this).parent().prev().find(".real-price").text(" " + price2);

        const sum = parseFloat($('.header__cart-content-metryc-content.active .header__cart-item').get().reduce((acc, n) => acc + +n.dataset.total, 0).toFixed(2));
        $(this).parent().parent().parent().parent().parent().next().find(".header__cart-order-price").text(" " + sum);
        countProdsAndSetCounter();
    });
    // Обработка клика на -
    $(item).find('.header__cart-item-minus').on('click',function() {
        let quantity = parseFloat($(this).parent().parent().attr("data-quantity")).toFixed(2) * 1;
        let price = parseFloat($(this).parent().parent().attr("data-price")).toFixed(2) * 1;

        let inp = parseFloat(quantity).toFixed(2) * 1;
        let total = parseFloat(inp - 1);

        if (inp == 0) {
        } else {
            $(this).parent().parent().attr("data-quantity", total);
            $(this).next().val(total);

            var price2 = (parseFloat(price * total).toFixed(2)) * 1;

            $(this).parent().parent().attr("data-total", price2);
            $(this).parent().prev().find(".real-price").text(" " + price2);

            const sum = parseFloat($('.header__cart-content-metryc-content.active .header__cart-item').get().reduce((acc, n) => acc + +n.dataset.total, 0).toFixed(2));
            $(this).parent().parent().parent().parent().parent().next().find(".header__cart-order-price").text(" " + sum);
        }
        countProdsAndSetCounter();
    });

    $(item).find('.header__cart-item-close').on('click', deleteMiniCartItemHandler);
    countProdsAndSetCounter();
}
function changeCartItemData(cartItem) {

    let item =$(`#cart-item-key-${cartItem.product_cart_key}`);
    $(item).attr("data-quantity",cartItem.quantity);
    $(item).attr("data-total", Number(cartItem.quantity) * Number(cartItem.price));
    $(item).find('.header__cart-item-content-price.real-price').text(cartItem.price);
    $(item).find('.header__cart-item-number').val(cartItem.quantity);
}
function countProdsAndSetCounter() {
    let itemsCount = $('.header__cart-inner').find('input.header__cart-item-number').toArray();
    if (itemsCount.length > 0){
        let totalCount = itemsCount.reduce((acc, currentItem) =>{
            return acc += Number(currentItem.value);
        }, 0);
        $('#cart-items').text(totalCount);
        $('#cart-items').css("display", "block");
    }else{
        $('#cart-items').css("display", "none");
    }
}