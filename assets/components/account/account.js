import './account.scss';
import $ from 'jquery';
import "jquery-validation"
import 'jquery-ui/ui/widgets/datepicker';


var datefield = document.createElement("input")

datefield.setAttribute("type", "date")

if (datefield.type != "date"){ //if browser doesn't support input type="date", initialize date picker widget:
    $(document).ready(function() {
        $('#date').datepicker();
    });
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
        serial:{
            required: true,
            alphabetsnspace: true,
            minlength: 2,
            maxlength: 2
        },
        number:{
            required: true,
            digits: true,
            minlength: 7,
            maxlength: 7
        },
        who:{
            required: true,
            alphabetsnspace: true
        },
        when:{
            required: true,
            numbersspace: true
        },

    },
    messages:{
        name:{
            required: "Необходимое поле",
            alphabetsnspace: "Только буквы"
        },
        surname:{
            required: "Необходимое поле",
            alphabetsnspace: "Только буквы"
        },
        serial:{
            required: "Необходимое поле",
            alphabetsnspace: "Только буквы",
            minlength: "Минимум 2 буквы",
            maxlength: "Максимум 2 буквы"
        },
        number:{
            required: "Необходимое поле",
            digits: "Только цифры",
            minlength: "Минимум 7 цифр",
            maxlength: "Максимум 7 цифр"
        },
        who:{
            required: "Необходимое поле",
            alphabetsnspace: "Только буквы"
        },
        when:{
            required: "Необходимое поле",
            numbersspace: "Только цифры"
        },
    }
});
