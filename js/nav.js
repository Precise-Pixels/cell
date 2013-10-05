var min_bp_b = 800;

$('#nav').click(function() {
    if($(window).width() < min_bp_b) {
        $(this).toggleClass('nav--open');
    }
});