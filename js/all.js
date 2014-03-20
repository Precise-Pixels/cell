// Feature detection
var Detector = {
    webgl:     ( function() { try { var canvas = document.createElement('canvas'); return !! window.WebGLRenderingContext && (canvas.getContext('webgl') || canvas.getContext('experimental-webgl')); } catch(e) { return false; } } )(),
    webrtc:    ( function() { try { return navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia } catch(e) { return false; } } )(),
    cssfilter: ( function() { try { var el = document.createElement('div'); el.style.cssText = '-webkit-filter:blur(2px);filter:blur(2px);'; return !!el.style.length && ((document.documentMode === undefined || document.documentMode > 9)); } catch(e) { return false; } } )()
}

if(Detector.webgl)     { document.documentElement.className = document.documentElement.className.replace('no-webgl', 'webgl'); };
if(Detector.webrtc)    { document.documentElement.className = document.documentElement.className.replace('no-webrtc', 'webrtc'); };
if(Detector.cssfilter) { document.documentElement.className = document.documentElement.className.replace('no-cssfilter', 'cssfilter'); };

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

// Console FYP notice
console.info('___________________________________________________________________\n  _____     _ _   _____           _           _        _\n / ____|   | | | |_   _|         | |         | |      (_)\n| |     ___| | |   | |  _ __   __| |_   _ ___| |_ _ __ _  ___  ___\n| |    / _ \\ | |   | | | \'_ \\ / _` | | | / __| __| \'__| |/ _ \\/ __|\n| |___|  __/ | |  _| |_| | | | (_| | |_| \\__ \\ |_| |  | |  __/\\__ \\ \n \\_____\\___|_|_| |_____|_| |_|\\__,_|\\__,_|___/\\__|_|  |_|\\___||___/\n\nThankyou for visiting Cell Industries!\n\nCell Industries is a Multimedia Technology and Design\nUniversity of Kent final year project by\nPrecise Pixels  (http://precisepixels.co.uk):\n\nJacob Hammond   (http://jacobhammond.co.uk)\nJames Lee       (http://jalproductions.co.uk)\nJoseph Williams (http://faooful.com)\n\nFor more information, please visit: http://cell-industries.co.uk/fyp\n____________________________________________________________________');
