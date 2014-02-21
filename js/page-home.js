var primaryHeader = document.getElementById('primary-header');
var secondaryHeader = document.getElementById('secondary-header');
primaryHeader.style.height = (window.innerHeight || document.documentElement.clientHeight) - 40 + 'px';
secondaryHeader.style.marginTop = (parseInt(primaryHeader.style.height) + 40) + "px";

window.onresize = function() {
    primaryHeader.style.height = (window.innerHeight || document.documentElement.clientHeight) - 40 + 'px';
    secondaryHeader.style.marginTop = (parseInt(primaryHeader.style.height) + 40) + "px";
};