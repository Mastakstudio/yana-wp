jQuery(document).ready(function ($) {
    $( '#questionForm' ).on('submit', function (event) {
        event.preventDefault();

        let formName = $(this).find('[name="name"]').val();
        let formPhoneNumber = $(this).find('[name="text"]').val();
        let comment = $(this).find('[name="comment"]').val();

        let data = {
            action: 'sendFormTo',
            formName: formName,
            formPhoneNumber: formPhoneNumber,
            comment: comment
        };
        console.log(mastak_ajax.url);
        $.ajax({
            type: 'POST',
            url: mastak_ajax.url,
            data: data,
            dataType: 'json'
        }).done(function (response) {
            console.log(response);
            $('#question_result').text(response.text);
            $('#questionForm').trigger("reset");
        }).fail( function (x, y, z) {
            console.log(x);
            $('#question_result').text(x.statusText);
        });
    });


});
// form#questionForm.question_form