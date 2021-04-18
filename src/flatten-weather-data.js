export default function flatten_weather_data(city) {
  if (!city) {
    return;
  }
  const temp = Math.round(10 * (city.main.temp - 273.15)) / 10;
  const tmin = Math.round(10 * (city.main.temp_min - 273.15)) / 10;
  const tmax = Math.round(10 * (city.main.temp_max - 273.15)) / 10;

  const description = city.weather[0].description;

  const openWeatherBaseURL = " https://openweathermap.org";
  const country = city.sys.country;
  const countryDetails = `${city.name}, ${country}`;
  const cityURL = `${openWeatherBaseURL}/city/${city.id}`;
  const weatherIconName = city.weather[0].icon;
  const gust = city.wind.speed;
  const pressure = city.main.pressure;
  const cloud = city.clouds.all;

  const weatherIcon = `${openWeatherBaseURL}/img/wn/${weatherIconName}@2x.png`;
  const flag = `${openWeatherBaseURL}/images/flags/${country.toLowerCase()}.png`;

  const latitude = city.coord.lat;
  const longitude = city.coord.lon;
  const coordinate = `${openWeatherBaseURL}/weathermap?zoom=12&lat=${latitude}&lon=${longitude}`;

  const weatherData = {
    weatherIcon,
    cityURL,
    countryDetails,
    flag,
    description,
    temp,
    tmin,
    tmax,
    gust,
    cloud,
    pressure,
    coordinate,
    latitude,
    longitude,
  };

  return weatherData;
}
