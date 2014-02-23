var down = false;
var scrollLeft = 0;
var x = 0;

var timeline = document.getElementById('timeline');

timeline.addEventListener('mousedown', function(e) {
    down = true;
    scrollLeft = this.scrollLeft;
    x = e.clientX; 
});

timeline.addEventListener('mouseup', function() {
    down = false;
});

timeline.addEventListener('mousemove', function(e) {
    e.preventDefault();
    if(down) {
        this.scrollLeft = scrollLeft + x - e.clientX;
    }
});

timeline.addEventListener('mouseleave', function() {
    down = false;
});