<?php 
if(! class_exists('Ama_Weather')){
    class Ama_Weather {
        
        protected $option_name = 'ama_weather_options';
        protected $zip_code_option_key = 'ama_wx_zip_code';
        protected $api_option_key = 'ama_wx_api_key';
        protected $api_url = "http://api.openweathermap.org/data/2.5/weather";

        
        public function generate_transient_key_zip(){
            $options = $this->get_weather_options();
        
            // Creates a unique key from zipcode to set or retrieve transient
            return "ama-weather_".$options['zip']."_".password_hash($options['appid'],PASSWORD_DEFAULT);
        }
        public function get_weather_options(){
            $ama_weather_options = get_option($this->option_name);
            
            /**
             * Match keys with the query used by the API 
             * @see https://openweathermap.org/current#zip
             */
            return array(
                'appid'  => esc_attr($ama_weather_options[$this->api_option_key]),
                'zip' => esc_attr($ama_weather_options[$this->zip_code_option_key])
            );

        }

        public function get_api_url(){
            return $this->api_url;
        }
    }
}

?>