var igSectionWrapper = document.getElementById('ig-section-wrapper');
calculateSquare();

window.addEventListener('resize', function() {
    calculateSquare();
});

function calculateSquare() {
    var windowWidth      = (window.innerWidth || document.documentElement.clientWidth);
    var windowHeight     = (window.innerHeight || document.documentElement.clientHeight) - 40;

    if(windowWidth > windowHeight) {
        igSectionWrapper.style.width = igSectionWrapper.style.paddingBottom = windowHeight - 120 + 'px';
    } else {
        igSectionWrapper.style.width = igSectionWrapper.style.paddingBottom = windowWidth - 80 + 'px';
    }
}

var igSections = document.getElementsByClassName('ig-section');
var igSectionsLength = igSections.length;
var igSection1 = document.getElementById('ig-section--1');
var igSection2 = document.getElementById('ig-section--2');
var igSection3 = document.getElementById('ig-section--3');
var igSection4 = document.getElementById('ig-section--4');
var currentSection = 0;

console.log(igSections);

window.addEventListener('mousewheel', function(e) {
    if(e.wheelDelta > 0) {
        prevSection();
    } else {
        nextSection();
    }
});

function prevSection() {
    if(currentSection == 0) { return false; }
    currentSection--;
    updateClasses();
}

function nextSection() {
    if(currentSection == 3) { return false; }
    currentSection++;
    updateClasses();
}

function updateClasses() {
    for(var i = 0; i < igSectionsLength; i++) {
        if(i == currentSection) {
            igSections[i].className = 'ig-section ig-section--current';
        } else if(i == currentSection - 1) {
            igSections[i].className = 'ig-section ig-section--prev';
        } else {
            igSections[i].className = 'ig-section';
        }
    }
}

igSection1.addEventListener(whichTransitionEvent(), transitionComplete);
igSection2.addEventListener(whichTransitionEvent(), transitionComplete);
igSection3.addEventListener(whichTransitionEvent(), transitionComplete);
igSection4.addEventListener(whichTransitionEvent(), transitionComplete);

function whichTransitionEvent() {
    var t;
    var el = document.createElement('element');
    var transitions = {
      'transition':'transitionend',
      'OTransition':'oTransitionEnd',
      'MozTransition':'transitionend',
      'WebkitTransition':'webkitTransitionEnd'
    }

    for(t in transitions) {
        if(el.style[t] !== undefined) {
            return transitions[t];
        }
    }
}

function transitionComplete() {

}