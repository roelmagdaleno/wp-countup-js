<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'WP_CUJS' ) ) {
	/**
	 * A WordPress plugin about CountUp.js by
	 * Inorganik.
	 *
	 * https://inorganik.github.io/countUp.js/
	 *
	 * @since  4.0.0
	 */
	class WP_CUJS {
		/**
		 * Initialize all plugin functionality.
		 *
		 * @since  4.0.0
		 */
		public function __construct() {
			new WP_CUJS_Shortcode();

			if ( ! is_admin() ) {
				return;
			}

			new WP_CUJS_Options_Page();
		}
	}
}
