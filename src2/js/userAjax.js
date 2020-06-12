/* global jQuery */
jQuery(document).ready(function ($) {
    /* global mastak_ajax */

    $('#form_login_modal').on('submit', function (event) {
        event.preventDefault();
        // blockPopup();
        let serializeData = $('#form_login_modal').serializeArray();
        if (mastak_ajax.account_url) {
            $.ajax({
                type: 'POST',
                url: mastak_ajax.account_url.toString().replace('%%endpoint%%', 'login'),
                data: serializeData,
                dataType: 'json'
            })
                .done( response => {
                    // unblockPopup();
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
                    // unblockPopup();
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
                        // unblockPopup();
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
                        // unblockPopup();
                    });
            }else{
                displayResult('connection error');
                // unblockPopup();
            }
        }else{
            displayResult.bind(this)("passwords are not equal" );
            // unblockPopup();
        }
    });
    // function blockPopup() {
    //     $('.popup__content').find('.ajax_loader_wrapper').addClass('ajax_loader_wrapper-active');
    // }
    // function unblockPopup() {
    //     $('.popup__content').find('.ajax_loader_wrapper').removeClass('ajax_loader_wrapper-active');
    // }
    function displayResult(result) {
        // let wrapper = $(this).parent().find('.result-wrapper .result');
        $(this).parent().find('.result-wrapper .result').html('');
        $(this).parent().find('.result-wrapper .result').append(result);
    }
});