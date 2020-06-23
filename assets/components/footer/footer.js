import './footer.scss';
import $ from 'jquery';
import 'remodal'


$(document).on('opening', '.footer__remodal', function () {
    $('.footer__remodal').parent().addClass('footer__remodal-wrapper');
});
