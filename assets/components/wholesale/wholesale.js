import './wholesale.scss';
import $ from 'jquery';
import '../../../node_modules/jquery-viewport-checker/src/jquery.viewportchecker';


//Анимация черники
$(document).ready(function(){
    $('.wholesale__item').viewportChecker({
        classToAdd: 'wholesale__item_active',
        callbackFunction: function(elem, action){

            setTimeout(function(){
                $('.wholesale__item.wholesale__item_active').addClass('wholesale__item_move');
            },1000);
        },
    });

});
