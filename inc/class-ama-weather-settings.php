<?php
/**
 *
 * Retrieve settings options
 * $ama_weather_options = get_option('ama_weather_options'); // Array of All Options
 * $ama_wx_api_key = $ama_weather_options[$this->api_option_key]; // API key
 * $ama_wx_zip_code = $ama_weather_options[$this->zip_code_option_key]; // Zip Code
 */
if(! class_exists('Ama_Weather_Settings')){
	class Ama_Weather_Settings extends Ama_Weather {
		private $ama_weather_options = array();
		
		private $page_title = 'Ama Weather Settings';
		private $menu_title = 'Ama Weather';    
		private $plugin_menu_slug  = 'ama-weather-settings';


		public function __construct() {
			add_action( 'admin_menu', array( $this, 'ama_weather_add_plugin_page' ) );
			add_action( 'admin_init', array( $this, 'ama_weather_plugin_page_init' ) );
		}


		public function ama_weather_add_plugin_page() {
			add_plugins_page(
				$this->page_title,
				$this->menu_title,
				'manage_options', // capability
				$this->plugin_menu_slug,
				array( $this, 'ama_weather_create_admin_page' )
			);
		}

		public function ama_weather_create_admin_page() {
			$this->ama_weather_options = get_option( $this->option_name ); ?>

			<div class="wrap ama-wx-settings-wrapper">
				<h2><?php echo $this->page_title?></h2>
				<p>Configure the desired zip code and API key</p>
				<?php settings_errors(); ?>

				<form method="post" action="options.php">
					<?php
						settings_fields( 'ama_weather_option_group' );
						do_settings_sections( 'ama-weather-admin-page' );
						submit_button();
					?>
				</form>
			</div>
		<?php }

		/*-------------------------------------------*/
		/*	Register Setting
		/*-------------------------------------------*/
		
		public function ama_weather_plugin_page_init() {
			register_setting(
				'ama_weather_option_group',
				$this->option_name,
				array( $this, 'ama_weather_save_options' )
			);

			add_settings_section(
				'ama_weather_setting_section',
				'Settings', // title
				array( $this, 'ama_weather_section_info' ),
				'ama-weather-admin-page' // page
			);


			add_settings_field(
				$this->api_option_key,
				'API key',
				array( $this, 'ama_wx_api_key_callback' ),
				'ama-weather-admin-page',
				'ama_weather_setting_section'
			);
			

			add_settings_field(
				$this->zip_code_option_key,
				'Zip Code',
				array( $this, 'ama_wx_zip_code_callback' ),
				'ama-weather-admin-page',
				'ama_weather_setting_section'
			);
		}

		public function ama_weather_save_options($input) {

			$ama_weather_trancient_key = $this->generate_transient_key_zip();
			delete_transient($ama_weather_trancient_key);
			
			$sanitized_values = $this->ama_weather_options;
			if (isset( $input[$this->api_option_key])) {
				$sanitized_values[$this->api_option_key] = sanitize_text_field( $input[$this->api_option_key]);
			}

			if ( isset( $input[$this->zip_code_option_key] ) ) {
				$sanitized_values[$this->zip_code_option_key] = sanitize_text_field( $input[$this->zip_code_option_key] );
			}

			return $sanitized_values;
		}

		public function ama_weather_section_info() { ?>

			<p>Access the current weather data for any location on Earth including over 200,000 cities!</p>
			<p><a href="https://openweathermap.org/">OpenWeatherMap</a></p>
			<p>Weather API URL : <?php echo $this->get_api_url(); ?></p>
			
		<?php }

		public function ama_wx_api_key_callback() {
			printf(
				'<input class="regular-text" type="text" name="ama_weather_options[ama_wx_api_key]" id="ama_wx_api_key" value="%s">',
				isset( $this->ama_weather_options[$this->api_option_key] ) ? esc_attr( $this->ama_weather_options[$this->api_option_key]) : ''
			);
		}

		public function ama_wx_zip_code_callback() {
			printf(
				'<input class="regular-text" type="text" name="ama_weather_options[ama_wx_zip_code]" id="ama_wx_zip_code" value="%s">',
				isset( $this->ama_weather_options[$this->zip_code_option_key] ) ? esc_attr( $this->ama_weather_options[$this->zip_code_option_key]) : ''
			);
		}
	}
}
