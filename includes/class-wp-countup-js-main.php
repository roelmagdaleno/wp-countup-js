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
		 * The current plugin version.
		 *
		 * @since  4.0.0
		 * @access private
		 *
		 * @var    string   $version   The current plugin version.
		 */
		private $version;

		/**
		 * Initialize all plugin functionality.
		 *
		 * @since  4.0.0
		 */
		public function __construct() {
			$this->version = '4.0.0';

			add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
			new WP_CountUp_JS_Shortcode();

			if ( is_admin() ) {
				new WP_CountUp_JS_Options_Page();
			}
		}

		/**
		 * Register the necessary scripts to make the
		 * plugin work.
		 *
		 * @since  4.0.0
		 */
		public function register_scripts() {
			$options         = get_option( 'countupjs-option-page' );
			$plugin_settings = array(
				'useEasing'   => isset( $options['use_easing'] ),
				'useGrouping' => isset( $options['use_grouping'] ),
				'separator'   => $options['use_separator'],
				'decimal'     => $options['use_decimal'],
				'prefix'      => $options['use_prefix'],
				'suffix'      => $options['use_sufix'],
			);

			wp_enqueue_script( 'wp-countup-js-core', WP_COUNTUP_JS_URL . 'public/js/countUp.js', array( 'jquery' ), $this->version );
			wp_enqueue_script( 'wp-countup-js-plugin', WP_COUNTUP_JS_URL . 'public/js/showCounter.js', array( 'jquery' ), $this->version );

			wp_localize_script( 'wp-countup-js-plugin', 'WP_CountUp_JS', array(
				'resetCounterWhenViewAgain' => isset( $options['reset_counter_when_view_again'] ),
				'endInsideShortcode'        => isset( $options['end_inside_shortcode'] ),
				'pluginSettings'            => $plugin_settings,
			) );
		}
	}
}
