<?php

$url = $_POST['u'];

$xml = simplexml_load_file(urlencode($url));

$hasData = $xml->attributes()->success;

if($hasData == 'true') {
    $dataCategories = array(
        $categoryNearby  = array(),
        $categoryTime    = array(),
        $categoryWeather = array()
    );

    $dataCategories['categoryTime']['currentLocalTime1']      = $xml->xpath('pod[@id="CartographicCurrentTime"]');
    $dataCategories['categoryTime']['currentLocalTime2']      = $xml->xpath('pod[@id="CurrentTime:CityData"]');

    $dataCategories['categoryWeather']['localWeather']        = $xml->xpath('pod[@id="CartographicWeather"]');
    $dataCategories['categoryWeather']['currentWeather']      = $xml->xpath('pod[@id="WeatherPod:CityData"]');
    $dataCategories['categoryWeather']['daylightInformation'] = $xml->xpath('pod[@id="DaylightInformation"]');
    $dataCategories['categoryWeather']['uvIndex']             = $xml->xpath('pod[@id="UVIndex"]');

    $dataCategories['categoryNearby']['nearestCity']          = $xml->xpath('pod[@id="CartographicNearestCity"]');
    $dataCategories['categoryNearby']['nearbyCities1']        = $xml->xpath('pod[@id="CityHierarchyInfo:CityData"]');
    $dataCategories['categoryNearby']['nearbyCities2']        = $xml->xpath('pod[@id="CartographicCities"]');
    $dataCategories['categoryNearby']['nearestSea']           = $xml->xpath('pod[@id="OceansHierarchyInfo:CityData"]');
    $dataCategories['categoryNearby']['nearestIsland']        = $xml->xpath('pod[@id="CartographicNearestIsland"]');
    $dataCategories['categoryNearby']['nearbyAirports']       = $xml->xpath('pod[@id="AirportHierarchyInfo:CityData"]');
    $dataCategories['categoryNearby']['nearbyServices']       = $xml->xpath('pod[@id="CartographicServices"]');
    $dataCategories['categoryNearby']['nearbyFeatures']       = $xml->xpath('pod[@id="CartographicFeatures"]');
    $dataCategories['categoryNearby']['nearbyFeature']        = $xml->xpath('pod[@id="FeaturesHierarchyInfo:CityData"]');

    // Remove all the empty arrays
    $dataCategories = array_map('array_filter', $dataCategories);
    $dataCategories = array_filter($dataCategories);

    // Parse certain pods to improve readability
    function parsePlainText($key, $pod) {
        $plaintext = $pod[0]->subpod->plaintext;

        switch($key) {
            case 'nearbyCities2':
                $replaceWith = '</li><li>';
                $i           = 0;

                $plaintext = preg_replace('/\(straight-line distance to city centers\)/', '', $plaintext);
                preg_match_all('/people/', $plaintext, $matches, PREG_OFFSET_CAPTURE);

                foreach($matches[0] as $match) {
                    if($i == count($matches[0]) - 1) { continue; }
                    $plaintext = substr_replace($plaintext, $replaceWith, strlen($match[0]) + $match[1] + 1 + $i * strlen($replaceWith), 0);
                    $i++;
                }

                return '<ul><li>' . $plaintext . '</li></ul>';
                break;

            case 'nearbyFeatures':
                $replaceWith = '</li><li>';
                $i           = 0;

                $plaintext = preg_replace('/\(straight-line distance to feature center\)/', '', $plaintext);
                preg_match_all('/miles [a-zA-Z0-9\-]+/', $plaintext, $matches, PREG_OFFSET_CAPTURE);

                foreach($matches[0] as $match) {
                    if($i == count($matches[0]) - 1) { continue; }
                    $plaintext = substr_replace($plaintext, $replaceWith, strlen($match[0]) + $match[1] + 1 + $i * strlen($replaceWith), 0);
                    $i++;
                }

                return '<ul><li>' . $plaintext . '</li></ul>';
                break;

            case 'localWeather':
                return preg_replace('/\|/', ',', $plaintext);
                break;

            default:
                return $plaintext;
        }
    }

    foreach($dataCategories as $key=>$categoryPods) {
        switch($key) {
            case 'categoryNearby':
                $class = 'env-data-pod--nearby';
                $title = 'NEARBY';
                $icon  = 'ico-nearby';
                break;
            case 'categoryTime':
                $class = 'env-data-pod--time';
                $title = 'TIME';
                $icon  = 'ico-time';
                break;
            case 'categoryWeather':
                $class = 'env-data-pod--weather';
                $title = 'WEATHER';
                $icon  = 'ico-weather';
                break;
        }

        echo '<div class="env-interface-element env-data-pod ' . $class . '">';
        
            echo '<h1><i class=" '. $icon .' "></i>' . $title . '</h1>';
        
        foreach($categoryPods as $key=>$pod) {
            echo '<h2>' . $pod[0]->attributes()->title . '</h2><p>' . parsePlainText($key, $pod) . '</p>';
        }

        echo '</div>';
    }
}