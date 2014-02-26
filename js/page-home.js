// Full height homepage
var primaryHeader   = document.getElementById('primary-header');
var secondaryHeader = document.getElementById('secondary-header');
primaryHeader.style.height = (window.innerHeight || document.documentElement.clientHeight) - 40 + 'px';
secondaryHeader.style.marginTop = (parseInt(primaryHeader.style.height) + 40) + 'px';

window.onresize = function() {
    primaryHeader.style.height = (window.innerHeight || document.documentElement.clientHeight) - 40 + 'px';
    secondaryHeader.style.marginTop = (parseInt(primaryHeader.style.height) + 40) + 'px';
};

// Animated scroll
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

// Google Maps
google.maps.event.addDomListener(window, 'load', init);

function init() {
    // Setup the map
    var map = new google.maps.Map(document.getElementById('homepage-map'), {
        center: new google.maps.LatLng(43, 10),
        zoom: 2,
        maxZoom: 10,
        minZoom: 2,
        mapTypeId: google.maps.MapTypeId.SATELLITE,
        zoomControl: false,
        panControl: false,
        mapTypeControl: false,
        streetViewControl: false
    });

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
        } else if(request.status != 200) {
            console.log('An error has occurred.');
        }
    }

    request.onerror = function() {
        console.log('A connection error has occurred.');
    };

    function plotMarkers() {
        for(var i = 0; i < locations.length; i++) {
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i]['latitude'], locations[i]['longitude']),
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    fillColor: '#369',
                    fillOpacity: .5,
                    strokeColor: '#9CF',
                    strokeWeight: 2,
                    strokeOpacity: .3,
                    scale: 8
                },
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    window.location.href = '/user/' + locations[i]['username'] + '/env/' + locations[i]['envId'];
                }
            })(marker, i));
        }
    }
}