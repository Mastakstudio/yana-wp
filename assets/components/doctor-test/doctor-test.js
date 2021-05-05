import './doctor-test.scss';
import $ from 'jquery';

let offsetTop = $('.doctor-test__wrap').offset().top;

$(".doctor-test__pattern1").css("margin-top",offsetTop);
$(".doctor-test__pattern2").css("margin-top",offsetTop);
let height = parseInt($(".doctor-test__wrap").height());

$(".doctor-test__pattern1").css("height", height);
$(".doctor-test__pattern2").css("height", height);

