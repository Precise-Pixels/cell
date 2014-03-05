// Navigation overlay
var navOverlay    = document.getElementById('nav-overlay');
var siteNavToggle = document.getElementById('site-nav-toggle');
var userNavToggle = document.getElementById('user-nav-toggle');

navOverlay.addEventListener('click', function() {
    siteNavToggle.checked = false;
    userNavToggle.checked = false;
});