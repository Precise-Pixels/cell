window.onscroll = function (e) {
    var headerTop = document.getElementById('top-bar');
    var header    = document.getElementById('fixed-header') || document.getElementById('primary-header');
    var hgroup    = header.getElementsByTagName('hgroup')[0];
    var position  = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
    var target    = document.getElementsByTagName('section')[0].offsetParent.offsetTop;

    header.style.top = position * -1 / 3 + 'px';
    hgroup.style.top = position * -1 / 2 + 'px';

    if ( position >= target ) {
       headerTop.style.backgroundColor = '#333';
    }
    else {
       headerTop.style.backgroundColor = 'none'; 
    }
}

function nav_topbar_bkg() { 
    if (document.getElementById('site-nav-toggle').checked || document.getElementById('user-nav-toggle').checked) {
        document.getElementById('top-bar').style.backgroundColor = '#333';
    }
    else {
        document.getElementById('top-bar').style.backgroundColor = 'transparent';
    }
}

document.getElementById('site-nav-toggle').addEventListener('click', nav_topbar_bkg);
document.getElementById('user-nav-toggle').addEventListener('click', nav_topbar_bkg);