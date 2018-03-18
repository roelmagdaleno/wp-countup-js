<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'WP_CountUp_JS_Options_Page' ) ) {
	/**
	 * Create the plugin options page.
	 *
	 * @since  4.0.0
	 */
	class WP_CountUp_JS_Options_Page {
		/**
		 * Set the required actions to create the
		 * options page.
		 *
		 * @since  4.0.0
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'create_options_page' ) );
		}

		/**
		 * Create the options page.
		 *
		 * @since  4.0.0
		 */
		public function create_options_page() {
			add_options_page(
				'CountUp.js Options',
				'CountUP.js',
				'manage_options',
				'countup-js',
				array( $this, 'render_page' )
			);
		}

		/**
		 * Render the options plugin page.
		 *
		 * @since  4.0.0
		 */
		public function render_page() {
			echo '<div class="wrap">';
			echo '<form method="POST" action="options.php">';

			settings_fields( 'countupjs-option-page' );
			do_settings_sections( 'countupjs-option-page' );
			submit_button();

			echo '</form>';
			echo '</div>';
		}
	}
}
