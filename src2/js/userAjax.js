/* global jQuery */
jQuery(document).ready(function ($) {
    /* global mastak_ajax */

    $('#sign-in').on('submit', function (event) {
        event.preventDefault();
        // blockPopup();
        let serializeData = $('#sign-in').serializeArray();
        if (mastak_ajax.account_url) {
            $.ajax({
                type: 'POST',
                url: mastak_ajax.account_url.toString().replace('%%endpoint%%', 'login'),
                data: serializeData,
                dataType: 'json'
            })
                .done( response => {
                    // unblockPopup();
                    console.log('login form done: ',response);
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
                });
        }
    });

    $('#sign-up').on('submit', function (event) {
        event.preventDefault();
        // blockPopup();
        let serializeData = $(this).serializeArray();

        let pass = serializeData.find(input => input['name'] === "password");
        let checkPass = serializeData.find(input => input['name'] === "confirmPassword");
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

                        // response.data.displayName
                        // response.data.result
                        // #banner-main__form
                        // #link_to_reg
                        // #user_name

                        if( response.data.result === false){
                            return;
                        }else if(response.data.result === true){
                            $('#user_name').text(response.data.displayName);
                            $('#banner-main__form').hide();
                            $('#link_to_reg').hide();
                        }
                    })
                    .fail(function (response) {
                        console.log('registration form error: ',response);
                        // unblockPopup();
                    });
            }else{
                // displayResult('connection error');
                // unblockPopup();
            }
        }else{
            // displayResult.bind(this)("passwords are not equal" );
            // unblockPopup();
        }
    });
    // function blockPopup() {
    //     $('.popup__content').find('.ajax_loader_wrapper').addClass('ajax_loader_wrapper-active');
    // }
    // function unblockPopup() {
    //     $('.popup__content').find('.ajax_loader_wrapper').removeClass('ajax_loader_wrapper-active');
    // }
    // function displayResult(result) {
    //     // let wrapper = $(this).parent().find('.result-wrapper .result');
    //     $(this).parent().find('.result-wrapper .result').html('');
    //     $(this).parent().find('.result-wrapper .result').append(result);
    // }
});