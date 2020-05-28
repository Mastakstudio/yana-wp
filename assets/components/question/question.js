import './question.scss';
import $ from 'jquery';
import "jquery-validation"


//Валидация формы


$("#questionForm").validate({
    rules:{
        name:{
            required: true,
        },
        text:{
            required: true,
        },
    },
    messages:{
        name:{
            required: "Необходимое поле",
        },
        text:{
            required: "Необходимое поле",
        },
    }
});


