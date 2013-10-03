var min_bp_c = 1000;

$('#nav').click(function() {
    if($(window).width() < min_bp_c) {
        $(this).toggleClass('nav--open');
    }
});