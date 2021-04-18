<?php
require_once dirname( __FILE__ ) . '/get-weather-data.php';

/**
 * Sets up a JSON endpoint
 * 
 * Valid Endpoint: /wp-json/ama-weather/v1/zipcode/
 * http://localhost/wp-json/ama-weather/v1/zipcode/
 */
function ama_weather_zip_api_init() {
    $namespace = 'ama-weather/v1';
    register_rest_route( $namespace, '/zipcode/', array(
        'methods' => 'GET',
        'callback' => 'handle_zipcode_route',
    ) );

}
add_action( 'rest_api_init', 'ama_weather_zip_api_init' );


function handle_zipcode_route(WP_REST_Request $req ) {
    //$params = $req->get_url_params();
    return get_weather_data();
}


