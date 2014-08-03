$(function(){
    $(window).scroll(function(){
        if ($(window).scrollTop() > 5 ){
            $("#caja-flotante").fadeOut();
        }else{
            $("#caja-flotante").fadeIn();
        }
    });
});
