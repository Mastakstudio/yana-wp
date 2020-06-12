'use strict';
/* global jQuery */
jQuery(document).ready(function ($) {
    $('.test__content-check input').on('change', function () {
        let answerWrapper = $(this).parents('.test__content-check');
        let answersWrapper = $(this).parents('.test__content-item-check');
        let nextQuestion = $(this).parents('.test__content-item').next();

        if ($(this).data('is-correct') === true)
            $(answerWrapper).addClass('correct');
        else{
            $(answerWrapper).addClass('error');
            $(answersWrapper).find('input[data-is-correct="true"]').addClass('correct');
        }

        $(answersWrapper).css('pointer-events','none');

        console.log(nextQuestion[0]);
        if (nextQuestion[0]){
            $(nextQuestion).show("slow");
        }else{
            $("#modal_next_part").addClass("active");
        }

    })
    $("#close_modal").on('click', function () {
        $('#modal_next_part').removeClass('active');
    });
});