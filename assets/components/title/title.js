import './title.scss';
import $ from 'jquery';
import viewportChecker from './../../../node_modules/jquery-viewport-checker/src/jquery.viewportchecker';

$(document).ready(function(){
    $('.title').viewportChecker();
});