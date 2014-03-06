<?php

$url = $_POST['u'];

$xml = simplexml_load_file($url);

$hasData = $xml->attributes()->success;

if($hasData == 'true') {
    $dataArray = array();

    $dataArray['location']            = $xml->xpath('pod[@id="Location"]');

    $dataArray['nearestCity']         = $xml->xpath('pod[@id="CartographicNearestCity"]');
    $dataArray['nearbyCities1']       = $xml->xpath('pod[@id="CityHierarchyInfo:CityData"]');
    $dataArray['nearbyCities2']       = $xml->xpath('pod[@id="CartographicCities"]');
    $dataArray['nearestSea']          = $xml->xpath('pod[@id="OceansHierarchyInfo:CityData"]');
    $dataArray['nearestIsland']       = $xml->xpath('pod[@id="CartographicNearestIsland"]');
    $dataArray['nearbyAirports']      = $xml->xpath('pod[@id="AirportHierarchyInfo:CityData"]');
    $dataArray['nearbyServices']      = $xml->xpath('pod[@id="CartographicServices"]');
    $dataArray['nearbyFeatures']      = $xml->xpath('pod[@id="CartographicFeatures"]');
    $dataArray['nearbyFeature']       = $xml->xpath('pod[@id="FeaturesHierarchyInfo:CityData"]');

    $dataArray['currentLocalTime1']   = $xml->xpath('pod[@id="CartographicCurrentTime"]');
    $dataArray['currentLocalTime2']   = $xml->xpath('pod[@id="CurrentTime:CityData"]');

    $dataArray['localWeather']        = $xml->xpath('pod[@id="CartographicWeather"]');
    $dataArray['currentWeather']      = $xml->xpath('pod[@id="WeatherPod:CityData"]');
    $dataArray['daylightInformation'] = $xml->xpath('pod[@id="DaylightInformation"]');
    $dataArray['uvIndex']             = $xml->xpath('pod[@id="UVIndex"]');

    $dataArray['population']          = $xml->xpath('pod[@id="Population:CityData"]');
    $dataArray['notablePeople']       = $xml->xpath('pod[@id="NotablePeople:CityData"]');

    foreach($dataArray as $dataPod) {
        if($dataPod) {
            echo '<div class="env-data-pod">' . $dataPod[0]->attributes()->title . '<br>' . $dataPod[0]->subpod->plaintext . '</div>';
        }
    }
}