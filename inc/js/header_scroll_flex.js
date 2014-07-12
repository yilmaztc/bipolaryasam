var windowsize;
var animate_speed = 150;

jQuery(document).ready(function($) {
    var scrollTop = $(".top_header_wrap").height();
//    var mobilscrollTop = $("#header_relative").height();
    windowsize = $(window).width();



    var mobile_menu             = $(".mobile_menu");
    var mobile_menu_height      = $(".mobile_menu .mobile_menu_ul").height();
    mobile_menu.css({
        top         : "-" + mobile_menu_height + "px",
        display     : "none",
        visibility  : "visible"
    });
    $(".mobile_menu_bar").click(function(){
        if(!$(this).hasClass("selected")){
            $(this).addClass("selected");
            mobile_menu.animate({
                top:0
            },animate_speed);
        }
        else {
            $(this).removeClass("selected");
            mobile_menu.animate({
                top: "-" + mobile_menu_height + "px"
            },animate_speed);
        }
    });


});

jQuery(window).resize(function($) {
    windowsize = jQuery(window).width();
})
