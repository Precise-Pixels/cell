var down = false;
var scrollLeft = 0;
var x = 0;

var timeline = document.getElementById('timeline');

timeline.addEventListener('touchstart', start);
timeline.addEventListener('mousedown', start);

timeline.addEventListener('touchend', end);
timeline.addEventListener('mouseup', end);

timeline.addEventListener('touchmove', move);
timeline.addEventListener('mousemove', move);

timeline.addEventListener('touchcancel', leave);
timeline.addEventListener('mouseleave', leave);

function start(e) {
    e.preventDefault();
    down = true;
    scrollLeft = this.scrollLeft;
    x = e.clientX || e.touches[0].clientX;
}

function end(e) {
    e.preventDefault(); 
    down = false;
}

function move(e) {
    e.preventDefault();
    if(down) {
        this.scrollLeft = scrollLeft + x - (e.clientX || e.touches[0].clientX);
    }
}

function leave(e) {
    e.preventDefault(); 
    down = false;
}