import './account.scss';
import $ from 'jquery';
import "jquery-validation"
import Inputmask from "inputmask";

if(document.getElementById("date")!=undefined){
    var selector = document.getElementById("date");

    var im = new Inputmask("99.99.9999");
    im.mask(selector);
}

//Валидация формы

$.validator.addMethod("alphabetsnspace", function(value, element) {
    return this.optional(element) || /^[а-яА-Я.]+$/.test(value);
});

$.validator.addMethod("numbersspace", function(value, element) {
    return this.optional(element) || /^[0-9.]+$/.test(value);
});


$("#account__form").validate({
    rules:{
        name:{
            required: true,
            alphabetsnspace: true
        },
        surname:{
            required: true,
            alphabetsnspace: true
        },
        date:{
            required: true,
            alphabetsnspace: true
        }

    },
    messages:{
        name:{
            required: "Необходимое поле",
            alphabetsnspace: "Только буквы"
        },
        surname:{
            required: "Необходимое поле",
            alphabetsnspace: "Только буквы"
        }
    }
});
