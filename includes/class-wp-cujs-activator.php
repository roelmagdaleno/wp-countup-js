<<<<<<< develop:includes/class-wp-countup-js-activator.php
<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'WP_CountUp_JS_Activator' ) ) {
	/**
	 * Handle the activation process for the plugin.
	 *
	 * @since  4.0.0
	 */
	class WP_CountUp_JS_Activator {
		/**
		 * Create the options if it doesn't exists.
		 *
		 * @since  4.0.0
		 */
		public static function activate() {
			$plugin_settings = get_option( 'countupjs-option-page' );

			if ( $plugin_settings ) {
				return;
			}

			$default_settings = array(
				'use_easing'    => 'true',
				'use_grouping'  => 'true',
				'use_separator' => ',',
				'use_decimal'   => '.',
				'use_prefix'    => '',
				'use_sufix'     => '',
			);

			add_option( 'countupjs-option-page', $default_settings );
		}
	}
}
=======
<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'WP_CUJS_Activator' ) ) {
	/**
	 * Handle the activation process for the plugin.
	 *
	 * @since  4.0.0
	 */
	class WP_CUJS_Activator {
		/**
		 * Create the options if it doesn't exists.
		 *
		 * @since  4.0.0
		 */
		public static function activate() {
			$plugin_settings = get_option( 'countupjs-option-page' );

			if ( $plugin_settings ) {
				return;
			}

			$default_settings = array(
				'use_easing'    => 'true',
				'use_grouping'  => 'true',
				'use_separator' => ',',
				'use_decimal'   => '.',
				'use_prefix'    => '',
				'use_sufix'     => '',
			);

			add_option( 'countupjs-option-page', $default_settings );
		}
	}
}
>>>>>>> IMPROVE: Namings were simplified. JS files are loaded when shortcode is called.:includes/class-wp-cujs-activator.php
