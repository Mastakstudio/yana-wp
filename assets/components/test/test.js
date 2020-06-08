import './test.scss';
import $ from 'jquery';

$('.test__dop-text-title').click(function () {

    $(this).next().slideToggle();
    $(this).find(".test__button").toggleClass('test__button_active')

})