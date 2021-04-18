<?php 
if(!function_exists("flatten_weather_data")){
  function flatten_weather_data($city) {
 
    $temp = round(10 * ($city->main->temp - 273.15)) / 10;
    $tmin = round(10 * ($city->main->temp_min - 273.15)) / 10;
    $tmax = round(10 * ($city->main->temp_max - 273.15)) / 10;

    $description = $city->weather[0]->description;
    $openWeatherBaseURL = "https://openweathermap.org";
    $country = $city->sys->country;
    $countryDetails = "{$city->name}, {$country}";
    $cityURL = "{$openWeatherBaseURL}/city/{$city->id}";
    $weatherIconName = $city->weather[0]->icon;
    $gust = $city->wind->speed;
    $pressure = $city->main->pressure;
    $cloud = $city->clouds->all;
    $weatherIcon = "{$openWeatherBaseURL}/img/wn/{$weatherIconName}@2x.png";
    $country_lwr =strtolower($country);
    $flag = "{$openWeatherBaseURL}/images/flags/{$country_lwr}.png";
    $latitude = $city->coord->lat;
    $longitude = $city->coord->lon;
    $coordinate = "{$openWeatherBaseURL}/weathermap?zoom=12&lat={$latitude}&lon={$longitude}";

    $weatherData = [
        "weatherIcon"    => $weatherIcon,
        "cityURL"        => $cityURL,
        "countryDetails" => $countryDetails,
        "flag"           => $flag,
        "description"    => $description,
        "temp"           => $temp,
        "tmin"           => $tmin,
        "tmax"           => $tmax,
        "gust"           => $gust,
        "cloud"          => $cloud,
        "pressure"       => $pressure,
        "coordinate"     => $coordinate,
        "latitude"       => $latitude,
        "longitude"      => $longitude,
    ];

    return $weatherData;
  }
}
?>