jQuery(document).ready(function ($) {

        let data = {
            action: 'morePosts',
            offset: $('.blog__grid-item.grid-item').length
        };
        if(mastak_ajax !== undefined){
            $.ajax({
                type: 'POST',
                url: mastak_ajax.ajax_url,
                data: data,
                success: function (response) {
                    // console.log(response);
                    let buff = JSON.parse(response);
                    console.log(buff);
                    $('.blog__grid.grid').append(buff['posts']);
                },
                error: function (x, y, z) {
                    console.log(x);
                    $('.partnership__response').text('ОШИБКА!');
                }
            });
        }else{
            let content = $('.blog__grid.grid').html();
            $('.blog__grid.grid').append(content);
        }
});