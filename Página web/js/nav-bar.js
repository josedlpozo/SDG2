/**
 * Created by josedlpozo on 30/3/15.
 */
$(document).ready(function(){
    $(window).bind('scroll', function() {
        var navHeight = $(window).height() - $(window).height()*0.75;
        console.log($(window).height() - (+$(window).height())*0.25);
        console.log($(window).height());
        console.log($(window).scrollTop() + "TOP");
        if ($(window).scrollTop() > navHeight && $(window).width()>740) {
            $('nav').addClass('fixed');
        }
        else {
            $('nav').removeClass('fixed');
        }
    });
});