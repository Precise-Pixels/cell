var down = false;
var scrollLeft = 0;
var x = 0;

var timeline        = document.getElementById('timeline');
var timelineWrapper = document.getElementById('timeline-wrapper');

timelineWrapper.addEventListener('mousedown', function(e) {
    down = true;
    scrollLeft = timeline.scrollLeft;
    x = e.clientX; 
});

timelineWrapper.addEventListener('mouseup', function() {
    down = false;
});

timelineWrapper.addEventListener('mousemove', function(e) {
    e.preventDefault();
    if(down && e.which == 1) {
        timeline.scrollLeft = scrollLeft + x - e.clientX;
    }
});

timelineWrapper.addEventListener('mouseleave', function() {
    down = false;
});