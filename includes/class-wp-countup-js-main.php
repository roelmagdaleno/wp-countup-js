<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'WP_CountUp_JS_Main' ) ) {
	/**
	 * A WordPress plugin about CountUp.js by
	 * Inorganik.
	 *
	 * https://inorganik.github.io/countUp.js/
	 *
	 * @since  4.0.0
	 */
	class WP_CountUp_JS_Main {
		/**
		 * Initialize all plugin functionality.
		 *
		 * @since  4.0.0
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );

			new WP_CountUp_JS_Shortcode();
			new WP_CountUp_JS_Options_Page();
		}

		/**
		 * Register the necessary scripts to make the
		 * plugin work.
		 *
		 * @since  4.0.0
		 */
		public function register_scripts() {
			$plugin_settings = array(
				'useEasing'   => isset( $options['use_easing'] ),
				'useGrouping' => isset( $options['use_grouping'] ),
				'separator'   => $options['use_separator'],
				'decimal'     => $options['use_decimal'],
				'prefix'      => $options['use_prefix'],
				'suffix'      => $options['use_sufix'],
			);

			wp_register_script( 'wp-countup-js-core', WP_COUNTUP_JS_PATH . 'public/js/countUp.js', array( 'jquery' ) );
			wp_enqueue_script( 'wp-countup-js-core' );

			wp_register_script( 'wp-countup-js-plugin', WP_COUNTUP_JS_PATH . 'public/js/showCounter.js', array( 'jquery' ) );
			wp_enqueue_script( 'wp-countup-js-plugin' );

			wp_localize_script( 'wp-countup-js-plugin', 'WP_CountUp_JS', array(
				'endInsideShortcode' => isset( $options['end_inside_shortcode'] ),
				'pluginSettings'     => $plugin_settings,
			) );
		}
	}
}
