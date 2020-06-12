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

    $('#go_to_next').on('click', function (e) {
        e.preventDefault();

        let linkToNextPart = $(this).attr('href');
        let answered = 0;
        let right = 0 ;
        $('.test__content-check input:checked').each(function (i, elem ) {
            answered++;

            let wrapper = $(elem).parents('.test__content-check');
            console.log('wrapper', wrapper);
            console.log(wrapper.hasClass('wrapper.hasClass','correct'));
            if (wrapper.hasClass('correct')){
                right++;
            }
        })

        let data = {
            action: 'finishTest',
            answered: answered,
            right : right,
            test_id : $('#test-wrapper').data('test_id')
        };

        $.ajax({
            type: 'POST',
            url: mastak_ajax.url,
            data: data,
            dataType: 'json'
        }).done( (response) =>  {
            console.log(response);
            if(!response.success) return;
            window.location.href = linkToNextPart;
        } ).fail(function () {
        });
    })


});