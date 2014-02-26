window.onscroll = function (e) {
    var header = document.getElementById('fixed-header');
    var position = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
    var target   = document.getElementsByTagName('main')[0].offsetParent.offsetTop;
    var hgroup   = header.getElementsByTagName('hgroup')[0];

    header.style.top = position * -1 / 6 + 40 + "px";
    hgroup.style.top = position * -1 / 3 + "px";
    console.log(position);
    
    // if(position >= target) {
    //     header.style.opacity = "0";
    // }
    // else {
    //     header.style.opacity = "1";
    // }
}