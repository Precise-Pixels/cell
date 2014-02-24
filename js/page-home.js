var primaryHeader   = document.getElementById('primary-header');
var secondaryHeader = document.getElementById('secondary-header');
primaryHeader.style.height = (window.innerHeight || document.documentElement.clientHeight) - 40 + 'px';
secondaryHeader.style.marginTop = (parseInt(primaryHeader.style.height) + 40) + 'px';

window.onresize = function() {
    primaryHeader.style.height = (window.innerHeight || document.documentElement.clientHeight) - 40 + 'px';
    secondaryHeader.style.marginTop = (parseInt(primaryHeader.style.height) + 40) + 'px';
};

var pageFlow = document.getElementById('page-flow');

pageFlow.addEventListener('click', function(e) {
    e.preventDefault();
    var position = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
    var target   = document.getElementById('firststeps').offsetParent.offsetTop;
    var timer = setInterval(function() {
        window.scrollTo(0, position);
        position += 50;
        if(position >= target) {
            clearInterval(timer);
        }
    }, 10);
});