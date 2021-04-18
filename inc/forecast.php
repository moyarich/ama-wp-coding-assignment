
<?php 
/**
 * Displays the Weather forecast
 */

if(!function_exists('forecast')){
  function forecast($weatherData) {

 [
  'weatherIcon'    => $weatherIcon,
  'cityURL'        => $cityURL,
  'countryDetails' => $countryDetails,
  'flag'           => $flag,
  'description'    => $description,
  'temp'           => $temp,
  'tmin'           => $tmin,
  'tmax'           => $tmax,
  'gust'           => $gust,
  'cloud'          => $cloud,
  'pressure'       => $pressure,
  'coordinate'     => $coordinate,
  'latitude'       => $latitude,
  'longitude'      => $longitude,
  ] = $weatherData;

  return "
    <div class='weather'>
      <div class='weather-icon-wrapper'>
        <div class='weather-icon'>
          <img src={$weatherIcon} />
        </div>
      </div>
      <div class='weather-details'>
        <div class='city-info'>
          <div class='city'>
            <span class='city-link'>
              <a href={$cityURL}>{$countryDetails}</a>
            </span>
            <img src={$flag} class='flag' />
            <i class='description'>{$description}</i>
          </div>
        </div>
        <div class='weather-status'>
          <span class='badge-info'>{$temp} °С</span>
          <span class='temperature'>
            <i>temperature</i>from {$tmin} to {$tmax} °С
          </span>
          <span class='wind'>
            <i>wind</i>
            {$gust} m/s
          </span>
          <span class='clouds'>
            <i>clouds</i>
            {$cloud} %
          </span>
          <span class='pressure'>{$pressure} hpa</span>
        </div>
        <div class='coordinate-info'>
          <p class='geo-coords'>
            <span>Geo coords </span>
            <a href={$coordinate}>
              [{$latitude} , {$longitude}]
            </a>
          </p>
        </div>
      </div>
    </div>";

  }
}

?>