$(document).ready(function() {
    //$('.full-menu').hide();
    $('#btn-menu2').click(function() {
        $('.menu').toggleClass("close");
        //$('.full-menu').removeClass("hide");
        $('.full-menu').toggleClass("hide", 100, "easeOutSine");
        //$('.full-menu').slideToggle(500);
    });
});