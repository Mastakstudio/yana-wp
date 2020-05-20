import './popup-order.scss';
import $ from 'jquery';
import "jquery-validation";
import {Validator} from './../../utils/_validator';
import * as intlTelInput from 'intl-tel-input';
import "../../../node_modules/intl-tel-input/build/js/utils.js";

var input = document.querySelector("#phone");
var iti = intlTelInput(input, {
    initialCountry: "us",
    utilsScript: "../../../node_modules/intl-tel-input/build/js/utils.js",
    autoPlaceholder: "aggressive",
});

var  nameOrder = null;
//Открытие попапа
$(".products__add-link").click(function () {
    $(".popup-order").addClass("popup-order_active");
    setTimeout(function(){
        $('.popup-order_active').addClass('popup-order_move');
    },1000);
    $("body").addClass("body_active");
    nameOrder = $(this).parent().parent().parent().find(".products__item-title").text();
});


//Закрытие попапа
$(".popup-order__close").click(function () {
    $(".popup-order").removeClass("popup-order_active");
    $(".popup-order").removeClass("popup-order_move");
    $("body").removeClass("body_active");
});

let $button = $('.popup-order__button');
let $name = $('[name="username"]');
let $phone = $('[name="usertel"]');
let $email = $('[name="useremail"]');
let $vol = $('[name="vol"]');
let $card = $('[name="card"]');
let $mess = $('[name="usermessage"]');

let $form = $('#formOrder');


$button.on('click', sendData);

function sendData(event) {
    event.preventDefault();
    $('.contact-form__group').removeClass('contact-form__group_error');
    let name = $name.val();
    let email = $email.val();
    let phone = $phone.val();
    let vol = $vol.val();
    let card = $card.val();
    let mess = $mess.val();
    let nameOrder2 = nameOrder;

    if (name.length === 0) {
        let $parent = $name.parent();
        $parent.addClass('contact-form__group_error');
        $parent.find('.contact-form__error-message').html(Validator.ERROR_EMPTY_FIELD);
        return;
    }

    if (phone.length === 0) {
        let $parent = $phone.parent();
        $parent.addClass('contact-form__group_error');
        $parent.find('.contact-form__error-message').html(Validator.ERROR_EMPTY_FIELD);
        return;
    }


    if (email.length === 0) {
        let $parent = $email.parent();
        $parent.addClass('contact-form__group_error');
        $parent.find('.contact-form__error-message').html(Validator.ERROR_EMPTY_FIELD);
        return;
    }


    if (!Validator.email(email)) {
        let $parent = $email.parent();
        $parent.addClass('contact-form__group_error');
        $parent.find('.contact-form__error-message').html(Validator.ERROR_EMAIL_FIELD);
        return;
    }


    sendingMail({
        name: name,
        email: email,
        message: mess,
        phone: phone,
        type: vol,
        card: card,
        nameOrder: nameOrder2,
        action: 'sendForm'
    });

};

function sendingMail(data) {
    console.log(data);

    $button.html('Send...').off('click', sendData);

    $.ajax(mailAjax.url, {
        data: data,
        method: 'post',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            if (response.status === 1) {
                successResponce()
            } else {
                alert('Error connection.\n Please try again later.');
                $('.button').html('Types').on('click', sendData);
            }

        },
        error: function (x) {
            console.log(x);
            alert('Error connection.\n Please try again later.');
            $('.button').html('Types').on('click', sendData);
        }
    });

}

