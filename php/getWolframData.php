<?php

$url = $_POST['u'];

$xml = simplexml_load_file($url);

$hasData = $xml->attributes()->success;

if($hasData == 'true') {
    $dataCategories = array(
        $categoryNearby  = array(),
        $categoryTime    = array(),
        $categoryWeather = array()
    );

    $dataCategories['categoryNearby']['nearestCity']          = $xml->xpath('pod[@id="CartographicNearestCity"]');
    $dataCategories['categoryNearby']['nearbyCities1']        = $xml->xpath('pod[@id="CityHierarchyInfo:CityData"]');
    $dataCategories['categoryNearby']['nearbyCities2']        = $xml->xpath('pod[@id="CartographicCities"]');
    $dataCategories['categoryNearby']['nearestSea']           = $xml->xpath('pod[@id="OceansHierarchyInfo:CityData"]');
    $dataCategories['categoryNearby']['nearestIsland']        = $xml->xpath('pod[@id="CartographicNearestIsland"]');
    $dataCategories['categoryNearby']['nearbyAirports']       = $xml->xpath('pod[@id="AirportHierarchyInfo:CityData"]');
    $dataCategories['categoryNearby']['nearbyServices']       = $xml->xpath('pod[@id="CartographicServices"]');
    $dataCategories['categoryNearby']['nearbyFeatures']       = $xml->xpath('pod[@id="CartographicFeatures"]');
    $dataCategories['categoryNearby']['nearbyFeature']        = $xml->xpath('pod[@id="FeaturesHierarchyInfo:CityData"]');

    $dataCategories['categoryTime']['currentLocalTime1']      = $xml->xpath('pod[@id="CartographicCurrentTime"]');
    $dataCategories['categoryTime']['currentLocalTime2']      = $xml->xpath('pod[@id="CurrentTime:CityData"]');

    $dataCategories['categoryWeather']['localWeather']        = $xml->xpath('pod[@id="CartographicWeather"]');
    $dataCategories['categoryWeather']['currentWeather']      = $xml->xpath('pod[@id="WeatherPod:CityData"]');
    $dataCategories['categoryWeather']['daylightInformation'] = $xml->xpath('pod[@id="DaylightInformation"]');
    $dataCategories['categoryWeather']['uvIndex']             = $xml->xpath('pod[@id="UVIndex"]');

    // Remove all the empty arrays
    $dataCategories = array_map('array_filter', $dataCategories);
    $dataCategories = array_filter($dataCategories);

    foreach($dataCategories as $key=>$categoryPods) {
        switch($key) {
            case 'categoryNearby':
                $class = 'env-data-pod--nearby';
                $title = 'NEARBY';
                $icon = 'ico-nearby';
                break;
            case 'categoryTime':
                $class = 'env-data-pod--time';
                $title = 'TIME';
                $icon = 'ico-time';
                break;
            case 'categoryWeather':
                $class = 'env-data-pod--weather';
                $title = 'WEATHER';
                $icon = 'ico-weather';
                break;
        }

        echo '<div class="env-interface-element env-data-pod ' . $class . '">';
        
            echo '<h1><i class=" '. $icon .' "></i>' . $title . '</h1>';
        
        foreach($categoryPods as $pod) {
            echo '<h2>' . $pod[0]->attributes()->title . '</h2><p>' . $pod[0]->subpod->plaintext . '<p>';
        }

        echo '</div>';
    }
}