// Handle interaction
var igSlides = document.getElementById('ig-slides');
var igPrev   = document.getElementById('ig-prev');
var igNext   = document.getElementById('ig-next');
var currentSlide = 1;

igPrev.addEventListener('click', function() {
    prevSlide();
});

igNext.addEventListener('click', function() {
    nextSlide();
});

window.addEventListener('mousewheel', function(e) {
    if(e.wheelDelta > 0) {
        prevSlide();
    } else {
        nextSlide();
    }
});

window.addEventListener('keydown', function(e) {
    if(e.which == 38) {
        prevSlide();
    } else if(e.which == 40) {
        nextSlide();
    }
});

function prevSlide() {
    if(currentSlide == 1) { return false; }
    currentSlide--;
    updateSlide();
}

function nextSlide() {
    if(currentSlide == 4) { return false; }
    currentSlide++;
    updateSlide();
}

function updateSlide() {
    igSlides.className = 'ig-current-slide--' + currentSlide;
}

// Add a class when CSS transition is complete
igSlides.addEventListener(whichTransitionEvent(), function() {
    igSlides.className += ' ig-transition-complete';
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