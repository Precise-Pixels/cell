// Full height homepage
var primaryHeader   = document.getElementById('primary-header');
var secondaryHeader = document.getElementById('secondary-header');
primaryHeader.style.height = (window.innerHeight || document.documentElement.clientHeight) + 'px';
secondaryHeader.style.marginTop = (parseInt(primaryHeader.style.height) + 40) + 'px';

window.addEventListener('resize', function() {
    primaryHeader.style.height = (window.innerHeight || document.documentElement.clientHeight) + 'px';
    secondaryHeader.style.marginTop = (parseInt(primaryHeader.style.height) + 40) + 'px';
});

// Animated scroll
var pageFlow = document.getElementById('page-flow');

pageFlow.addEventListener('click', function(e) {
    e.preventDefault();
    var position = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
    var target   = document.getElementById('firststeps').offsetParent.offsetTop;
    var timer = setInterval(function() {
        window.scrollTo(0, position);
        position += 40;
        if(position >= target) {
            clearInterval(timer);
        }
    }, 10);
});

// Google Maps
google.maps.event.addDomListener(window, 'load', init);

function init() {
    // Setup the map
    var map = new google.maps.Map(document.getElementById('homepage-map'), {
        center: new google.maps.LatLng(43, 10),
        zoom: 2,
        maxZoom: 10,
        minZoom: 2,
        mapTypeId: 'minimal',
        zoomControl: false,
        panControl: false,
        mapTypeControl: false,
        streetViewControl: false,
        backgroundColor: '#333'
    });

    var styles = [
        {
            "featureType": "water",
            "stylers": [
                { "color": "#333333" }
            ]
        }, {
            "featureType": "landscape",
            "stylers": [
                { "color": "#222222" }
            ]
        }, {
            "featureType": "administrative",
            "stylers": [
                { "visibility": "off" }
            ]
        }, {
            "featureType": "road",
            "stylers": [
                { "visibility": "off" }
            ]
        }, {
            "featureType": "poi",
            "stylers": [
                { "visibility": "off" }
            ]
        }, {
            "featureType": "transit",
            "elementType": "geometry",
            "stylers": [
                { "visibility": "off" }
            ]
        }
    ];

    var mapStyle = new google.maps.StyledMapType(styles, 'minimal');
    map.mapTypes.set('minimal', mapStyle);

    // Resize event
    google.maps.event.addDomListener(window, 'resize', function() {
        map.setCenter(new google.maps.LatLng(43, 10));
    });

    // Get and set markers
    var locations = [];

    var request = new XMLHttpRequest;
    request.open('GET', '/php/getHomepageMapMarkers.php', true);
    request.send();

    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            locations = JSON.parse(request.responseText);
            plotMarkers();
            updateData();
        } else if(request.status != 200) {
            console.log('An error has occurred.');
        }
    }

    request.onerror = function() {
        console.log('A connection error has occurred.');
    };

    function plotMarkers() {
        locLength = locations.length;

        for(var i = 0; i < locLength; i++) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i]['latitude'], locations[i]['longitude']),
                icon: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAAQCAYAAADAvYV+AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NTI4QjZGNzk5RjAyMTFFMzkwNjQ5REUyRTNDMDIzOUIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NTI4QjZGN0E5RjAyMTFFMzkwNjQ5REUyRTNDMDIzOUIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo1MjhCNkY3NzlGMDIxMUUzOTA2NDlERTJFM0MwMjM5QiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo1MjhCNkY3ODlGMDIxMUUzOTA2NDlERTJFM0MwMjM5QiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Phg9G0IAAAE5SURBVHjajJIxSwNBEIXvTgWNQkC0s4oWCRYWprEROxsbiyBI6gQs/BX+AgvhrI0gBtKkSSfWkaAgSIgpcnbaBDQRRNfv4UQuisGB797N7tuZvd3znXOeIls8TiLrkIZpeIE7uKyHha48vswYF3jPw6T3O17hhAUP/mohTJDswQzcwwU8wjxswCI8w9E4jzUztuCUCh9WMaJjCd2FJflkzthkDRyGnO1b+y3buMyZgMcs9Kio1ilYhjHTlI335JPZef8LJ3MECdrrg9pwC++mbRvXIUQyN2zlpo6Stufogalv44qGjk7724fkiKPTpRwOLmWFZHvEfit0ug4suYHOH8aOzX9dt/0bc0gRJmLGNwip+jRktgVZZCtmrmKsD5LgR8sraNp70/LvGKps1aeQHTijaj8+9ynAACOPb9kr2cNdAAAAAElFTkSuQmCC',
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    window.location.href = '/user/' + locations[i]['username'] + '/env/' + locations[i]['envId'];
                }
            })(marker, i));
        }
    }

    function updateData() {
        var environments       = document.getElementById('homepage-map-data--environments');
        var percentage         = document.getElementById('homepage-map-env-icon-perc');
        environments.innerHTML = locLength;
        percentage.innerHTML   = (locLength / 167076 * 100).toFixed(2) + '%';
    }
}