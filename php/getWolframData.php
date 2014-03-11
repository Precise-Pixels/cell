<?php

$url = $_POST['u'];

$xml = simplexml_load_file($url);

$hasData = $xml->attributes()->success;

if($hasData == 'true') {
    $dataCategories = array(
        $categoryLocation = array(),
        $categoryNearby   = array(),
        $categoryTime     = array(),
        $categoryWeather  = array(),
        $categoryPeople   = array()
    );

    $dataCategories['categoryLocation']['location']           = $xml->xpath('pod[@id="Location"]');

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

    $dataCategories['categoryPeople']['population']           = $xml->xpath('pod[@id="Population:CityData"]');
    $dataCategories['categoryPeople']['notablePeople']        = $xml->xpath('pod[@id="NotablePeople:CityData"]');

    // Remove all the empty arrays
    $dataCategories = array_map('array_filter', $dataCategories);
    $dataCategories = array_filter($dataCategories);

    foreach($dataCategories as $key=>$categoryPods) {
        switch($key) {
            case 'categoryLocation':
                $class = 'env-data-pod--location';
                $icon = 'ico-home';
                break;
            case 'categoryNearby':
                $class = 'env-data-pod--nearby';
                $icon = 'ico-home';
                break;
            case 'categoryTime':
                $class = 'env-data-pod--time';
                $icon = 'ico-home';
                break;
            case 'categoryWeather':
                $class = 'env-data-pod--weather';
                $icon = 'ico-home';
                break;
            case 'categoryPeople':
                $class = 'env-data-pod--people';
                $icon = 'ico-home';
                break;
        }

        echo '<div class="env-data-pod ' . $class . '">';

        foreach($categoryPods as $pod) {
            echo '<h2>' . '<i  class=" '. $icon .' "></i>' . $pod[0]->attributes()->title . '</h2>' . '<p>' . $pod[0]->subpod->plaintext . '<p>';
        }

        echo '</div>';
    }
}