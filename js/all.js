// Top Bar parallax / hide
var headerTop     = document.getElementById('top-bar');
var header        = document.getElementById('fixed-header') || document.getElementById('primary-header');
var target        = document.getElementsByTagName('main')[0].offsetTop;
var siteNavToggle = document.getElementById('site-nav-toggle');
var userNavToggle = document.getElementById('user-nav-toggle');
var position;

if (header != null) {
    var hgroup = header.getElementsByTagName('hgroup')[0];
}

window.addEventListener('scroll', function () {
    position = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;

    if (header != null) {
        header.style.top = position * -1 / 3 + 'px';
        hgroup.style.top = position * -1 / 2 + 'px';
    }

    changeTopbarBkg();

});

function changeTopbarBkg() {
    if (position >= target || siteNavToggle.checked || userNavToggle.checked) {
        headerTop.className = 'top-bar-background';
    } else {
        headerTop.className = 'top-bar-background-none';
    }
}

siteNavToggle.addEventListener('click', changeTopbarBkg);
userNavToggle.addEventListener('click', changeTopbarBkg);

// Navigation overlay
var navOverlay    = document.getElementById('nav-overlay');
var siteNavToggle = document.getElementById('site-nav-toggle');
var userNavToggle = document.getElementById('user-nav-toggle');

navOverlay.addEventListener('click', function() {
    siteNavToggle.checked = false;
    userNavToggle.checked = false;
});