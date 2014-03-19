// Calculate the dimensions of a square that always fits in the viewport (with added padding)
var igSectionWrapper = document.getElementById('ig-section-wrapper');
calculateSquare();

window.addEventListener('resize', function() {
    calculateSquare();
});

function calculateSquare() {
    var windowWidth  = (window.innerWidth || document.documentElement.clientWidth);
    var windowHeight = (window.innerHeight || document.documentElement.clientHeight) - 40;

    if(windowWidth > windowHeight) {
        igSectionWrapper.style.width = igSectionWrapper.style.height = windowHeight - 120 + 'px';
    } else {
        igSectionWrapper.style.width = igSectionWrapper.style.height = windowWidth - 80 + 'px';
    }
}

// Handle interaction
var igSections     = document.getElementById('ig-sections');
var igPrev         = document.getElementById('ig-prev');
var igNext         = document.getElementById('ig-next');
var currentSection = 1;

igPrev.addEventListener('click', function() {
    prevSection();
});

igNext.addEventListener('click', function() {
    nextSection();
});

window.addEventListener('mousewheel', function(e) {
    if(e.wheelDelta > 0) {
        prevSection();
    } else {
        nextSection();
    }
});

window.addEventListener('keydown', function(e) {
    if(e.which == 38) {
        prevSection();
    } else if(e.which == 40) {
        nextSection();
    }
});

function prevSection() {
    if(currentSection == 1) { return false; }
    currentSection--;
    updateSection();
}

function nextSection() {
    if(currentSection == 4) { return false; }
    currentSection++;
    updateSection();
}

function updateSection() {
    igSections.className = 'ig-current-section--' + currentSection;
}

// Add a class when CSS transition is complete
igSections.addEventListener(whichTransitionEvent(), function() {
    igSections.className += ' ig-transition-complete';
});

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