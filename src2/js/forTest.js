'use strict';
/* global jQuery */

jQuery(document).ready(function ($) {
    var successRemodal = $('#modal_next_part').remodal();
    var failedRemodal = $('#modal_failed').remodal();


    $('.test__content-check input').on('change', function () {
        let answersWrapper = $(this).parents('.test__content-item-check');
        let answerWrapper = $(this).parents('.test__content-check');
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
            var result = getTestData();
            var inst = null;

            if (result.success){
                disableModal();
                inst = successRemodal;
            }
            else
                inst = failedRemodal;

            updateTestResult(result);
            inst.open();

        }

    });
    $('#restart_test').on('click', function (e) {
        e.preventDefault();
        $('.test__content-check').each(function (i, item) {
            if ($(item).hasClass('correct')) $(item).removeClass('correct');
            if ($(item).hasClass('error')) $(item).removeClass('error');
        });
        $('.test__content-item-check').css('pointer-events','');
        $('.test__content-check input:checked').prop('checked', false);

        var questions = $('.test__content-item');
        questions.hide();
        $(questions[0]).show();
        failedRemodal.close();
    })

    function getTestData() {
        let answers = $('.test__content-check input:checked');
        let answered = answers.length;
        let right = 0 ;

        answers.each(function (i, elem ) {
            if ($(elem).parents('.test__content-check').hasClass('correct'))
                right++;
        });

        return {
            success: answered === right,
            answered: answered,
            right : right,
            test_id : $('#test-wrapper').data('test_id')
        };

    }

    function updateTestResult(data) {
        data.action = 'finishTest';

        $.ajax({
            type: 'POST',
            url: mastak_ajax.url,
            data: data,
            dataType: 'json'
        }).done( (response) =>  {
            if(!response.success) return;
            unDisableModal();
        } ).fail(function () {
        });
    }

    function disableModal() {
        $('.mastak_loader_wrapper').addClass('active_loader');
    }
    function unDisableModal() {
        $('.active_loader').removeClass('active_loader');
    }

});