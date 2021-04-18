function Forecast(props) {
  const {
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
  } = props.weatherData;

  return (
    <div className="weather">
      <div className="weather-icon-wrapper">
        <div className="weather-icon">
          <img src={weatherIcon} />
        </div>
      </div>
      <div className="weather-details">
        <div className="city-info">
          <div className="city">
            <span className="city-link">
              <a href={cityURL}>{countryDetails}</a>
            </span>
            <img src={flag} className="flag" />
            <i className="description">{description}</i>
          </div>
        </div>
        <div className="weather-status">
          <span className="badge-info">{temp} °С</span>
          <span className="temperature">
            <i>temperature</i>from {tmin} to {tmax} °С
          </span>
          <span className="wind">
            <i>wind</i>
            {gust} m/s
          </span>
          <span className="clouds">
            <i>clouds</i>
            {cloud} %
          </span>
          <span className="pressure">{pressure} hpa</span>
        </div>
        <div className="coordinate-info">
          <p className="geo-coords">
            <span>Geo coords </span>
            <a href={coordinate}>
              [{latitude} , {longitude}]
            </a>
          </p>
        </div>
      </div>
    </div>
  );
}

export default Forecast;
