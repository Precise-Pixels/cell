// Thanks: http://www.maptiler.org/google-maps-coordinates-tile-bounds-projection/
var currentTile;
var currentZoom;
var lat1;
var lat2;
var lon1;
var lon2;
var centreLat;
var centreLon;
var resolution   = 30;
var tileSize     = 320;
var requiredZoom = 10;

function init() {
    var latLng;
    var singleClick = false;

    // Setup the map
    var map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: new google.maps.LatLng(0, 0),
        zoom: 2,
        maxZoom: 10,
        minZoom: 2,
        mapTypeId: google.maps.MapTypeId.SATELLITE,
        streetViewControl: false
    });

    currentZoom = map.getZoom();

    // Draw map grid overlay
    map.overlayMapTypes.insertAt(0, tilelayer);

    // Get the centre and bounding coordinates surrounding the clicked area
    getMapTileCoords = function() {
        if(singleClick && currentZoom == requiredZoom) {
            var tile  = new google.maps.Point();
            var point = new google.maps.Point();
            var zoom  = map.getZoom();
            var proj  = map.getProjection();

            point = proj.fromLatLngToPoint(latLng);

            currentTile = tile;

            tile.x = Math.floor((point.x / tileSize) * Math.pow(2, zoom));
            tile.y = Math.floor((point.y / tileSize) * Math.pow(2, zoom));

            if (tile.x < 0 || tile.y < 0) return;
            if (tile.x >= (1 << zoom) || tile.y >= (1 << zoom)) return;

            var latLng1 = proj.fromPointToLatLng(new google.maps.Point(tile.x * tileSize / Math.pow(2, zoom), (tile.y + 1) * tileSize / Math.pow(2, zoom)));
            var latLng2 = proj.fromPointToLatLng(new google.maps.Point((tile.x + 1) * tileSize / Math.pow(2, zoom), tile.y * tileSize / Math.pow(2, zoom)));

            // Bounding and centre coordinates
            lat1 = latLng1.lat();
            lat2 = latLng2.lat();
            lon1 = latLng1.lng();
            lon2 = latLng2.lng();
            centreLat = lat2 - ((lat2 - lat1) / 2);
            centreLon = lon2 - ((lon2 - lon1) / 2);

            // console.log([lat1, lon1, lat2, lon2, centreLat, centreLon]);

            var selectedTile = document.getElementById('selected-tile');
            selectedTile.src = 'http://maps.googleapis.com/maps/api/staticmap?center=' + centreLat + ',' + centreLon + '&zoom=' + (requiredZoom + 1) + '&size=' + tileSize * 2 + 'x' + tileSize * 2 + '&scale=1&maptype=satellite&sensor=false&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4';
            // Clear and load map grid overlay
            map.overlayMapTypes.setAt(0, null);
            map.overlayMapTypes.insertAt(0, tilelayer);

            // If 'no tile selected' warning is present, remove it
            var warnNoTile = document.getElementById('env-warn-tile');
            if(warnNoTile) {
                warnNoTile.parentNode.removeChild(warnNoTile);
            }
        }
    };

    clearSingleClick = function() {
        singleClick = false;
    };

    // Event listeners
    google.maps.event.addListener(map, 'click', function(e) {
        singleClick = true;
        latLng = e.latLng;
        setTimeout('getMapTileCoords()', 300);
    });

    google.maps.event.addListener(map, 'dblclick', function() {
        clearSingleClick();
    });

    google.maps.event.addListener(map, 'zoom_changed', function() {
        currentZoom = map.getZoom();
    });

    var envForm      = document.getElementById('env-form');
    var cloneBtn     = document.getElementById('clone-btn');
    var envNameInput = document.getElementById('env-name');
    var warnNoTile   = document.createElement('p');
    var warnNoName   = document.createElement('p');

    warnNoTile.id = 'env-warn-tile';
    warnNoName.id = 'env-warn-name';
    warnNoTile.className = warnNoName.className = 'full warn';
    warnNoTile.appendChild(document.createTextNode('Please select an area on the map.'));
    warnNoName.appendChild(document.createTextNode('Please enter a name for your environment.'));

    cloneBtn.addEventListener('click', function(e) {
        if(!e.target.className.match(/btn--spinner/)) {
            if(currentTile != undefined) {
                if(envNameInput.checkValidity()) {
                    e.target.className += ' btn--spinner';

                    var warnNoNameElem = document.getElementById('env-warn-name');
                    if(warnNoNameElem) {
                        warnNoNameElem.parentNode.removeChild(warnNoNameElem);
                    }

                    generateEnv(lat1, lon1, lat2, lon2);
                } else {
                    envForm.appendChild(warnNoName);
                }
            } else {
                envForm.appendChild(warnNoTile);
            }
        }
    });
}

// Setup map grid overlay
var tilelayer = new google.maps.ImageMapType({
    getTileUrl: function(tile, zoom) {

        if (tile.x < 0 || tile.y < 0) return '/img/tile-edge.png';
        if (tile.x >= (1 << zoom) || tile.y >= (1 << zoom)) return '/img/tile-edge.png';

        if(zoom == requiredZoom) {
            imageurl = '/img/tile.png';
        }

        if(currentTile != undefined) {
            if(tile.x == currentTile.x && tile.y == currentTile.y && currentZoom == requiredZoom) {
                imageurl = '/img/tile-selected.png';
            }
        }

        return imageurl;
    },
    tileSize: new google.maps.Size(tileSize, tileSize)
});

google.maps.event.addDomListener(window, 'load', init);

function generateEnv(lat1, lon1, lat2, lon2) {
    // The width and height of the tile
    var tileHeight = lat2 - lat1;
    var tileWidth  = lon2 - lon1;

    // Divide the tile into 20x20 points
    var tileHeightDivision = tileHeight / resolution;
    var tileWidthDivision  = tileWidth / resolution;

    var latLonArray = [];

    // Concatinate the coordinates of all the division points together
    for (var y = resolution; y >= 0; y--) {
        for (var x = 0; x < resolution; x++) {
            var latDivision = (lat1 + (tileHeightDivision * y)).toFixed(4);
            var lonDivision = (lon1 + (tileWidthDivision * x)).toFixed(4);

            latLonArray.push(new google.maps.LatLng(latDivision, lonDivision));
        }
    }

    var latLonArrayLength = latLonArray.length;

    var positionalRequest1 = { 'locations': latLonArray.slice(0,latLonArrayLength/5) };
    var positionalRequest2 = { 'locations': latLonArray.slice(latLonArrayLength/5,latLonArrayLength/5*2) };
    var positionalRequest3 = { 'locations': latLonArray.slice(latLonArrayLength/5*2,latLonArrayLength/5*3) };
    var positionalRequest4 = { 'locations': latLonArray.slice(latLonArrayLength/5*3,latLonArrayLength/5*4) };
    var positionalRequest5 = { 'locations': latLonArray.slice(latLonArrayLength/5*4,latLonArrayLength/5*5) };

    var allResults = [];

    var elevator = new google.maps.ElevationService();

    // Chain elevation calls together so results are requested in the correct order
    elevator.getElevationForLocations(positionalRequest1, function(results, status) {
        if(status == google.maps.ElevationStatus.OK) {
            allResults = allResults.concat(results);

            elevator.getElevationForLocations(positionalRequest2, function(results, status) {
                if(status == google.maps.ElevationStatus.OK) {
                    allResults = allResults.concat(results);

                    elevator.getElevationForLocations(positionalRequest3, function(results, status) {
                        if(status == google.maps.ElevationStatus.OK) {
                            allResults = allResults.concat(results);

                            elevator.getElevationForLocations(positionalRequest4, function(results, status) {
                                if(status == google.maps.ElevationStatus.OK) {
                                    allResults = allResults.concat(results);

                                    elevator.getElevationForLocations(positionalRequest5, function(results, status) {
                                        if(status == google.maps.ElevationStatus.OK) {
                                            allResults = allResults.concat(results);
                                            getElevations();
                                        } else {
                                            console.log('Elevation request 5 failed due to: ' + status);
                                        }
                                    });
                                } else {
                                    console.log('Elevation request 4 failed due to: ' + status);
                                }
                            });
                        } else {
                            console.log('Elevation request 3 failed due to: ' + status);
                        }
                    });
                } else {
                    console.log('Elevation request 2 failed due to: ' + status);
                }
            });
        } else {
            console.log('Elevation request 1 failed due to: ' + status);
        }
    });

    var elevations = [];

    function getElevations() {
        for(var i = 0; i < allResults.length; i++) {
            elevations.push(allResults[i].elevation);
        }
        generateHeightMap(elevations);
    }

    function generateHeightMap(elevations) {
        var elevationsGreyscale = [];
        var elevationsString = '';

        var l = elevations.length;

        // Get minimum and maximum elevations from array
        var elevationsMin = Math.min.apply(null, elevations);
        var elevationsMax = Math.max.apply(null, elevations);

        // Normalise the min and max so that the minimum is 0
        var normaliseMax = elevationsMax - elevationsMin;

        // Loop through all the heights
        // Calculate the percentatage of the given value between the min and normalised max
        // Multiple by 255 to convert that value into an 8-bit greyscale value between 0 and 255
        for(var i = 0; i < l; i++) {
            elevationsGreyscale.push( Math.round((elevations[i] - elevationsMin) / normaliseMax * 255) );
        }

        // Convert the array to a string to send to the PHP
        // Delimited by a comma, except every [resolution]th value which are delimited by a space
        for(var i = 0; i < l; i++) {
            elevationsString += elevationsGreyscale[i]+'';
            elevationsString += ((i+1) % resolution === 0 && i != 0) ? '-' : ','; 
        }

        // Remove the last dash
        elevationsString = elevationsString.substring(0, elevationsString.length - 1);

        // console.log(elevations);
        // console.log(elevationsGreyscale);
        // console.log(elevationsString);

        // Send elevationsString to PHP to generate and store image
        var data = 'cLat=' + centreLat + '&cLon=' + centreLon + '&h=' + elevationsString + '&r=' + resolution + '&t=' + tileSize * 4 + '&n=' + encodeURIComponent(document.getElementsByName('env-name')[0].value);

        var request = new XMLHttpRequest;
        request.open('POST', '/php/cloneEnv.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(data);

        request.onreadystatechange = function(data) {
            if(request.readyState == 4 && request.status == 200) {
                window.location.href = request.getResponseHeader('X-Env-URL');
            } else if(request.status != 200) {
                console.log('An error has occurred.');
            }
        }

        request.onerror = function() {
            console.log('A connection error has occurred.');
        };
    }
}