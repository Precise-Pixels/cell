// addEventListener polyfill IE6+
// https://gist.github.com/jonathantneal/2869388
!window.addEventListener && (function (window, document) {
    function Event(e, element) {
        var instance = this;
 
        for (property in e) {
            instance[property] = e[property];
        }
 
        instance.currentTarget =  element;
        instance.target = e.srcElement || element;
        instance.timeStamp = +new Date;
 
        instance.preventDefault = function () {
            e.returnValue = false;
        };
        instance.stopPropagation = function () {
            e.cancelBubble = true;
        };
    }
 
    function addEventListener(type, listener) {
        var
        element = this,
        listeners = element.listeners = element.listeners || [],
        index = listeners.push([listener, function (e) {
            listener.call(element, new Event(e, element));
        }]) - 1;
 
        element.attachEvent('on' + type, listeners[index][1]);
    }
 
    function removeEventListener(type, listener) {
        for (var element = this, listeners = element.listeners || [], length = listeners.length, index = 0; index < length; ++index) {
            if (listeners[index][0] === listener) {
                element.detachEvent('on' + type, listeners[index][1]);
            }
        }
    }
 
    window.addEventListener = document.addEventListener = addEventListener;
    window.removeEventListener = document.removeEventListener = removeEventListener;
 
    if ('Element' in window) {
        Element.prototype.addEventListener    = addEventListener;
        Element.prototype.removeEventListener = removeEventListener;
    } else {
        var
        head = document.getElementsByTagName('head')[0],
        style = document.createElement('style');
 
        head.insertBefore(style, head.firstChild);
 
        style.styleSheet.cssText = '*{-ms-event-prototype:expression(!this.addEventListener&&(this.addEventListener=addEventListener)&&(this.removeEventListener=removeEventListener))}';
    }
})(window, document) && scrollBy(0, 0);

// Navigation checkbox hack fallback
window.onload = function() {
    var headerTop      = document.getElementById('top-bar');
    var siteNavBtn     = document.getElementById('site-nav-btn');
    var siteNavBtnIcon = document.getElementById('site-nav-btn-icon');
    var siteNavOpen    = false;

    siteNavBtn.attachEvent('onclick', toggleSiteNav);
    siteNavBtnIcon.attachEvent('onclick', toggleSiteNav);

    function toggleSiteNav() {
        if(siteNavOpen) {
            headerTop.className = headerTop.className.replace(' site-nav--open', '');
            siteNavOpen = false;
        } else {
            headerTop.className += ' site-nav--open';
            siteNavOpen = true;
        }
    }
}