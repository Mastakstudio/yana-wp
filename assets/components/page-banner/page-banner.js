import './page-banner.scss';
import $ from 'jquery';


$('.page-banner__content-item').click(function () {

    $(this).next().slideToggle();
    $(this).parent().toggleClass('page-banner__item_active')
    $(this).find(".page-banner__button").toggleClass('page-banner__button_active')

})
