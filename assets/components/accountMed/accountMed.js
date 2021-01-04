import './accountMed.scss';
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


$("#accountMed__form").validate({
    rules:{
        name:{
            required: true,
            alphabetsnspace: true
        },
        place:{
            required: true,
            alphabetsnspace: true
        },
        prof:{
            required: true,
            alphabetsnspace: true
        },
        spec:{
            required: true,
            alphabetsnspace: true
        }

    },
    messages:{
        name:{
            required: "Необходимое поле",
            alphabetsnspace: "Только буквы"
        },
        place:{
            required: "Необходимое поле",
            alphabetsnspace: "Только буквы"
        },
        prof:{
            required: "Необходимое поле",
            alphabetsnspace: "Только буквы"
        },
        spec:{
            required: "Необходимое поле",
            alphabetsnspace: "Только буквы"
        }
    }
});
