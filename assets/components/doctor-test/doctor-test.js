import './doctor-test.scss';
import $ from 'jquery';

let offsetTop = $('#ID1').offset().top;
let offsetWrap = $('.doctor-test__wrap').offset().top;
$(".doctor-test__pattern1").css("margin-top",offsetTop);
$(".doctor-test__pattern2").css("margin-top",offsetTop);
let razn = offsetWrap - offsetTop;
let height = parseInt($(".doctor-test__wrap").height());

$(".doctor-test__pattern1").css("height", height-razn);
$(".doctor-test__pattern2").css("height", height-razn);

