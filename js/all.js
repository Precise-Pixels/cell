var headerTop     = document.getElementById('top-bar');
var header        = document.getElementById('fixed-header') || document.getElementById('primary-header');
var hgroup        = header.getElementsByTagName('hgroup')[0];
var target        = document.getElementsByTagName('section')[0].offsetParent.offsetTop;
var siteNavToggle = document.getElementById('site-nav-toggle');
var userNavToggle = document.getElementById('user-nav-toggle');

window.addEventListener('scroll', function () {

    var position  = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;

    header.style.top = position * -1 / 3 + 'px';
    hgroup.style.top = position * -1 / 2 + 'px';

    if ( position >= target ) {
       headerTop.style.backgroundColor = '#333';
    }
    else {
       headerTop.style.backgroundColor = 'transparent'; 
    }
});

function changeTopbarBkg() {

    if (siteNavToggle.checked || userNavToggle.checked) {
        headerTop.style.backgroundColor = '#333';
    }
    else {
        headerTop.style.backgroundColor = 'transparent';
    }
}

siteNavToggle.addEventListener('click', changeTopbarBkg);
userNavToggle.addEventListener('click', changeTopbarBkg);