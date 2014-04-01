document.cookie = 'preventRecapture=false; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/';

if(Detector.webgl) {
    var newEnvInterface = document.getElementById('new-env-interface');
    var newEnvInterfaceMarkup = document.getElementById('new-env-interface-markup').text;
    newEnvInterface.innerHTML = newEnvInterfaceMarkup;

    // Thanks: http://www.maptiler.org/google-maps-coordinates-tile-bounds-projection/
    var map;
    var currentTile;
    var currentZoom;
    var lat1;
    var lat2;
    var lon1;
    var lon2;
    var centreLat;
    var centreLon;
    var resolution   = 40;
    var tileSize     = 320;
    var requiredZoom = 10;

    function init() {
        var latLng;
        var singleClick = false;

        // Setup the map
        map = new google.maps.Map(document.getElementById('new-env-map'), {
            center: new google.maps.LatLng(33, 34),
            zoom: 2,
            maxZoom: 10,
            minZoom: 2,
            mapTypeId: google.maps.MapTypeId.SATELLITE,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.HYBRID, google.maps.MapTypeId.TERRAIN]
            },
            panControl: false,
            streetViewControl: false,
            backgroundColor: '#222'
        });

        currentZoom = map.getZoom();

        // Create the search box and link it to the UI element
        var input = document.getElementById('pac-input');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var searchBox = new google.maps.places.SearchBox(input);

        google.maps.event.addListener(searchBox, 'places_changed', function() {
            var place = searchBox.getPlaces()[0];
            if(!place.geometry) {
                // on Enter key we can't help the user
                return;
            }
            input.value = '';
            // If the place has a geometry, then present it on a map
            if(place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setZoom(requiredZoom);
            }
            map.setCenter(place.geometry.location);

        });

        // Bias the SearchBox results towards places that are within the bounds of the current map's viewport
        google.maps.event.addListener(map, 'bounds_changed', function() {
            var bounds = map.getBounds();
            searchBox.setBounds(bounds);
        });

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

                var selectedTile = document.getElementById('selected-tile');
                selectedTile.src = 'http://maps.googleapis.com/maps/api/staticmap?center=' + centreLat + ',' + centreLon + '&zoom=' + (requiredZoom + 1) + '&size=' + tileSize * 2 + 'x' + tileSize * 2 + '&scale=1&maptype=satellite&sensor=false&key=AIzaSyCNlx7Q6EFJ2nlJfkAnMIsCm94fdSzaqf4';

                redrawOverlayMap();

                // If 'no tile selected' warning is present, remove it
                var warnNoTile = document.getElementById('new-env-warn-tile');
                if(warnNoTile) {
                    warnNoTile.parentNode.removeChild(warnNoTile);
                }
            }
        };

        // Prevent overpanning
        var allowedBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(-85, -180),
            new google.maps.LatLng(85, 180)
        );
        var lastValidCenter = map.getCenter();

        google.maps.event.addListener(map, 'center_changed', function() {
            if (allowedBounds.contains(map.getCenter())) {
                // Still within valid bounds, so save the last valid position
                lastValidCenter = map.getCenter();
                return;
            }

            // Not valid anymore, return to last valid position
            map.panTo(lastValidCenter);
        });

        clearSingleClick = function() {
            singleClick = false;
        };

        // Clear and load map grid overlay
        redrawOverlayMap = function() {
            map.overlayMapTypes.setAt(0, null);
            map.overlayMapTypes.insertAt(0, tilelayer);
        }

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

            // Change cursor to pointer if at required zoom level
            if(currentZoom == requiredZoom) {
                map.setOptions({ draggableCursor: 'pointer' });
            } else {
                map.setOptions({ draggableCursor: null });
            }
        });

        google.maps.event.addListener(map, 'maptypeid_changed', function() {
            redrawOverlayMap();
        });

        var envForm         = document.getElementById('new-env-form');
        var cloneBtn        = document.getElementById('clone-btn');
        var envNameInput    = document.getElementById('new-env-name');
        var warnNoTile      = document.createElement('p');
        var warnUnavailable = document.createElement('p');
        var warnNoName      = document.createElement('p');
        var warnProfanity   = document.createElement('p');

        warnNoTile.className = warnUnavailable.className = warnNoName.className = warnProfanity.className = 'full warn';
        warnNoTile.id           = 'new-env-warn-tile';
        warnUnavailable.id      = 'new-env-warn-unavailable';
        warnNoName.id           = 'new-env-warn-name';
        warnProfanity.id        = 'new-env-warn-profanity';
        warnNoTile.innerHTML    = '<i class="ico-warning"></i>Please select an area on the map.';
        warnNoName.innerHTML    = '<i class="ico-warning"></i>Please enter a name for your environment.';
        warnProfanity.innerHTML = '<i class="ico-warning"></i>No profanity please.';

        cloneBtn.addEventListener('click', function(e) {
            validate();
        });

        envNameInput.addEventListener('keydown', function(e) {
            if(e.which == 13) {
                e.preventDefault();
                validate();
            }
        });

        function validate() {
            var preloader = document.getElementById('full-page-overlay--loading');
            preloader.className += ' full-page-overlay--loading';

            if(currentTile != undefined) {
                // Check if selected tile is already cloned
                var data = 'cLat=' + centreLat + '&cLon=' + centreLon;
                var request = new XMLHttpRequest;
                request.open('POST', '/php/checkTileAvailability.php', true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.send(data);

                request.onreadystatechange = function() {
                    if(request.readyState == 4 && request.status == 200) {
                        var tileAvailable = request.responseText;

                        if(tileAvailable == 'true') {
                            var warnUnavailableElem = document.getElementById('new-env-warn-unavailable');
                            if(warnUnavailableElem) {
                                warnUnavailableElem.parentNode.removeChild(warnUnavailableElem);
                            }

                            if(envNameInput.checkValidity()) {
                                // Check if environment name is profanity free
                                var data = 'str=' + document.getElementById('new-env-name').value;
                                var request2 = new XMLHttpRequest;
                                request2.open('POST', '/php/checkProfanity.php', true);
                                request2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                request2.send(data);

                                request2.onreadystatechange = function() {
                                    if(request2.readyState == 4 && request2.status == 200) {
                                        var containsProfanity = request2.responseText;

                                        if(!containsProfanity) {
                                            generateEnv(lat1, lon1, lat2, lon2);
                                        } else {
                                            var warnNoNameElem = document.getElementById('new-env-warn-name');
                                            if(warnNoNameElem) {
                                                warnNoNameElem.parentNode.removeChild(warnNoNameElem);
                                            }
                                            hidePreloader();
                                            envForm.appendChild(warnProfanity);
                                        }
                                    }
                                }
                            } else {
                                hidePreloader();
                                envForm.appendChild(warnNoName);
                            }
                        } else {
                            warnUnavailable.innerHTML = 'Your selected area has already been cloned. Please select another area or <a href="' + tileAvailable.replace('false', '') + '" target="_blank">view the selected area</a>.';
                            hidePreloader();
                            envForm.appendChild(warnUnavailable);

                            var warnNoNameElem = document.getElementById('new-env-warn-name');
                            if(warnNoNameElem) {
                                warnNoNameElem.parentNode.removeChild(warnNoNameElem);
                            }
                        }
                    }
                }

            } else {
                hidePreloader();
                envForm.appendChild(warnNoTile);
            }

            function hidePreloader() {
                preloader.className = preloader.className.replace(' full-page-overlay--loading', '');
            }
        }
    }

    // Setup map grid overlay
    var tilelayer = new google.maps.ImageMapType({
        getTileUrl: function(tile, zoom) {
            var imageurl;

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

            if(imageurl) {
                return imageurl;
            }
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

        // Request elevations bit by bit in a loop until complete
        var elevator = new google.maps.ElevationService();
        var latLonArrayLength = latLonArray.length;
        var allResults = [];
        var requestCurrent = 0;
        var requestLimit = 180;

        requestElevations();

        function requestElevations() {
            if(requestCurrent >= latLonArrayLength) { getElevations(); return false; }

            var positionalRequest = { 'locations': latLonArray.slice(requestCurrent, requestCurrent + requestLimit) };

            (function() {
                elevator.getElevationForLocations(positionalRequest, function(results, status) {
                    setTimeout(function() {
                        if(status == google.maps.ElevationStatus.OK) {
                            allResults = allResults.concat(results);
                            requestCurrent = requestCurrent + requestLimit;
                        }
                        requestElevations();
                    }, 100);
                });
            })();
        }

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

            // Split environments into bands depending upon the range of elevations
            // Emphasise the flatter areas to give them a slightly exaggerated form
            // NOTE: The range at Mount Everest is ~5900

            var band = 255;

            switch(true) {
                case (normaliseMax < 200):
                    band = 40;
                    break;
                case (normaliseMax < 500):
                    band = 70;
                    break;
                case (normaliseMax < 1000):
                    band = 100;
                    break;
                case (normaliseMax < 2000):
                    band = 200;
                    break;
                case (normaliseMax < 6000):
                    band = 255;
                    break;
            }

            // Loop through all the heights
            // Calculate the percentatage of the given value between the min and normalised max
            // Multiple by 255 to convert that value into an 8-bit greyscale value between 0 and 255
            for(var i = 0; i < l; i++) {
                elevationsGreyscale.push( Math.round((elevations[i] - elevationsMin) / normaliseMax * band) );
            }

            // Convert the array to a string to send to the PHP
            // Delimited by a comma, except every [resolution]th value which are delimited by a space
            for(var i = 0; i < l; i++) {
                elevationsString += elevationsGreyscale[i]+'';
                elevationsString += ((i+1) % resolution === 0 && i != 0) ? '-' : ','; 
            }

            // Remove the last dash
            elevationsString = elevationsString.substring(0, elevationsString.length - 1);

            // Send elevationsString to PHP to generate and store image
            var data = 'cLat=' + centreLat + '&cLon=' + centreLon + '&h=' + elevationsString + '&r=' + resolution + '&t=' + tileSize * 4 + '&n=' + encodeURIComponent(document.getElementById('new-env-name').value);

            var request = new XMLHttpRequest;
            request.open('POST', '/php/cloneEnv.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.send(data);

            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    window.location.href = '/capturing-environment';
                } else if(request.status != 200) {
                    console.log('An error has occurred.');
                }
            }

            request.onerror = function() {
                console.log('A connection error has occurred.');
            };
        }
    }
}