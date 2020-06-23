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
                    console.log('login form done: ',response);
                    if(response.displayName !== undefined){
                        $('#user_name').text(response.displayName);
                        $('#banner-main__form').hide();
                        $('#link_to_reg').hide();
                    }
                    if (response.redirect){
                        window.location.href = response.redirect;
                    }
                    if (response.error !== undefined){
                        $('#login_errors').html(response.error);
                    }
                })
                .fail(function (response) {
                    console.log('login form error: ',response);
                });
        }
    });

    $('#sign-up').on('submit', function (event) {
        event.preventDefault();
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
                        console.log('registr form done: ',response);

                        if( response.error !== undefined){
                            $('#reg_errors').html(response.error);
                        }else if(response.data.result === true){
                            $('#user_name').text(response.data.displayName);
                            $('#banner-main__form').hide();
                            $('#link_to_reg').hide();
                        }
                        if (response.data.redirect){
                            window.location.href = response.redirect;
                        }
                    })
                    .fail(function (response) {
                        console.log('registration form error: ',response);
                    });
            }
        }
    });
});