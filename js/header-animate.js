window.onscroll = function (e) {
    var headerTop   = document.getElementById('top-bar');
    var header      = document.getElementById('fixed-header');
    var prim-header = document.getElementById('primary-header');
    var hgroup      = header.getElementsByTagName('hgroup')[0];
    var position    = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
    var target      = document.getElementsByTagName('section')[0].offsetParent.offsetTop;

    header.style.top      = position * -1 / 3 + "px";
    prim-header.style.top = position * -1 / 3 + "px";
    hgroup.style.top      = position * -1 / 2 + "px";
    console.log(position);

    if ( position >= target ) {
       headerTop.style.background = "#333";     
    }
    else {
       headerTop.style.background = "none"; 
    }
}