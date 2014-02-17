// Thanks: http://www.maptiler.org/google-maps-coordinates-tile-bounds-projection/
var currentTile;
var currentZoom;

function init() {
    var latLng;
    var singleClick = false;

    // Setup the map
    var map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: new google.maps.LatLng(51.358061573190916, 1.42822265625),
        zoom: 16,
        maxZoom: 16,
        minZoom: 3,
        mapTypeId: google.maps.MapTypeId.SATELLITE,
        streetViewControl: false
    });

    currentZoom = map.getZoom();

    // Load map grid overlay
    map.overlayMapTypes.insertAt(0, tilelayer);

    // Get the centre and bounding coordinates surrounding the clicked area
    getMapTileCoords = function() {
        if(singleClick && currentZoom == 16) {
            var tile  = new google.maps.Point();
            var point = new google.maps.Point();
            var zoom  = map.getZoom();
            var proj  = map.getProjection();

            point = proj.fromLatLngToPoint(latLng);

            currentTile = tile;

            tile.x = Math.floor((point.x / 256.0) * Math.pow(2, zoom));
            tile.y = Math.floor((point.y / 256.0) * Math.pow(2, zoom));

            if (tile.x < 0 || tile.y < 0) return;
            if (tile.x >= (1 << zoom) || tile.y >= (1 << zoom)) return;

            var latLng1 = proj.fromPointToLatLng(new google.maps.Point(tile.x * 256 / Math.pow(2, zoom), (tile.y + 1) * 256 / Math.pow(2, zoom)));
            var latLng2 = proj.fromPointToLatLng(new google.maps.Point((tile.x + 1) * 256 / Math.pow(2, zoom), tile.y * 256 / Math.pow(2, zoom)));

            // Bounding and centre coordinates
            var lat1 = latLng1.lat();
            var lat2 = latLng2.lat();
            var lon1 = latLng1.lng();
            var lon2 = latLng2.lng();
            var centreLat = lat2 - ((lat2 - lat1) / 2);
            var centreLon = lon2 - ((lon2 - lon1) / 2);

            // console.log([lat1, lon1, lat2, lon2, centreLat, centreLon]);

            var selectedTile = document.getElementById('selected-tile');
            selectedTile.src = 'http://maps.googleapis.com/maps/api/staticmap?center=' + centreLat + ',' + centreLon + '&zoom=16&size=256x256&scale=1&maptype=satellite&sensor=false';
            // Clear and load map grid overlay
            map.overlayMapTypes.setAt(0, null);
            map.overlayMapTypes.insertAt(0, tilelayer);

//

            // The width and height of the tile
            var tileHeight = lat2 - lat1;
            var tileWidth  = lon2 - lon1;

            // Divide the tile into 20x20 points
            var tileHeightDivision = tileHeight / 20;
            var tileWidthDivision  = tileWidth / 20;

            var latLonString = '';
            var latLonArray = [];

            // Concatinate the coordinates of all the division points together
            for (y = 0; y < 20; y++) {
                for (x = 0; x < 20; x++) {
                    var latDivision = (lat1 + (tileHeightDivision * y)).toFixed(4);
                    var lonDivision = (lon1 + (tileWidthDivision * x)).toFixed(4);

                    latLonString += latDivision + ',' + lonDivision + '|';
                    latLonArray.push(new google.maps.LatLng(latDivision, lonDivision));
                }
            }

            var latLonArrayLength = latLonArray.length;

            var positionalRequest4 = {
                'locations': latLonArray.splice(latLonArrayLength/4*3,latLonArrayLength/4*4)
            };

            var positionalRequest3 = {
                'locations': latLonArray.splice(latLonArrayLength/4*2,latLonArrayLength/4*3)
            };

            var positionalRequest2 = {
                'locations': latLonArray.splice(latLonArrayLength/4,latLonArrayLength/4*2)
            };

            var positionalRequest1 = {
                'locations': latLonArray.splice(0,latLonArrayLength/4)
            };

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
                                            getElevations();
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
                console.log(allResults);
                for(var i = 0; i < allResults.length; i++) {
                    elevations.push(allResults[i].elevation);
                }
                console.log(elevations);
            }
//
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
}

var tilelayer = new google.maps.ImageMapType({
    getTileUrl: function(tile, zoom) {

        if (tile.x < 0 || tile.y < 0) return 'tile-edge.png';
        if (tile.x >= (1 << zoom) || tile.y >= (1 << zoom)) return 'tile-edge.png';

        imageurl = '/img/tile.png';

        if(currentTile != undefined) {
            if(tile.x == currentTile.x && tile.y == currentTile.y && currentZoom == 16) {
                imageurl = '/img/tile-selected.png';
            }
        }

        return imageurl;
    },
    tileSize: new google.maps.Size(256, 256)
});

google.maps.event.addDomListener(window, 'load', init);