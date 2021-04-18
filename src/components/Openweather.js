import apiFetch from "@wordpress/api-fetch";

import { useState, useEffect } from "@wordpress/element";

import flatten_weather_data from "../flatten-weather-data.js";
import Forecast from "./Forecast.js";

export default function Openweather() {
  const [weatherDataByZip, setWeatherDataByZip] = useState(null);
  const [error, setError] = useState("");

  useEffect(() => {
    const path = `/ama-weather/v1/zipcode/`;

    apiFetch({ path })
      .then((response) => {
        if (!response || response.cod !== 200) {
          setError(
            __(
              city.message || "No weather found for that location",
              "ama-weather"
            )
          );
          return;
        }
        setWeatherDataByZip(response);
      })
      .catch((error) => {
        setError(__(error.message, "ama-weather"));
      });
  }, []);

  if (error) {
    return <div>Sorry there was an error : {error}</div>;
  }

  let forecastData = flatten_weather_data(weatherDataByZip);
  if (!forecastData) {
    return (
      <div className="weather-wrapper">
        <div className="ama-weather-loading">Loading ...</div>
      </div>
    );
  }

  return (
    <div className="weather-wrapper">
      <Forecast weatherData={forecastData} />
    </div>
  );
}
