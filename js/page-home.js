var primaryHeader = document.getElementById('primary-header');
primaryHeader.style.height = (window.innerHeight || document.documentElement.clientHeight) - 40 + 'px';

window.onresize = function() {
    primaryHeader.style.height = (window.innerHeight || document.documentElement.clientHeight) - 40 + 'px';
}; 