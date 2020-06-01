import './tags.scss';
import $ from 'jquery';
import viewportChecker from './../../../node_modules/jquery-viewport-checker/src/jquery.viewportchecker';

$(document).ready(function(){

    $('.tags__animate').viewportChecker(
    );

    $('.tags__item').viewportChecker(
        {
            classToAdd: 'visible addView',
        }
    );

    $('.tags__item.addView .tags__item-title').each(function(i){
        let row = $(this);
        setTimeout(function() {
            row.addClass('tags__item-title_active');
        }, 200*i);
    })

    $( window ).scroll(function() {
        $('.tags__item.addView .tags__item-title').each(function(i){
            let row = $(this);
            setTimeout(function() {
                row.addClass('tags__item-title_active');
            }, 200*i);
        })
    });


});