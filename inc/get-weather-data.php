
<?php 
/**
 * Outputs AMA Weather data on the JSON endpoint
 */
if(!function_exists("get_weather_data")){
  function get_weather_data() {
    $ama_weather = new Ama_Weather();

    /**
     * Store response as a transient in the WordPress database to avoid making the 
     * same request multiple times in a short period of time 
     * 
     * This data will expire after 20 minutes.
     */
    $transient_key_zip = $ama_weather->generate_transient_key_zip();
    $api_url = $ama_weather->get_api_url()."?".http_build_query($ama_weather->get_weather_options());

    if ( false === ( $data = get_transient($transient_key_zip) ) ) {
   
        /**
        * Fetches Live data from the Weather API
        */
        $data = wp_remote_get( $api_url);
            
        if ( ! is_wp_error( $data ) ) {
            $data = json_decode( $data['body'] );
        }

        $response = new WP_REST_Response( $data );

        /**
         * Cache response
         */
        set_transient( $transient_key_zip, $response, 60 * 20 );
    } else {
        return get_transient($transient_key_zip);
    }

    return $response;
}  
}

?>