<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'WP_CUJS' ) ) {
	/**
	 * A WordPress plugin about CountUp.js by Inorganik.
	 *
	 * https://inorganik.github.io/countUp.js/
	 *
	 * @since 4.0.0
	 */
	class WP_CUJS {
		/**
		 * Register the necessary hooks and initialize instances
		 * to make the plugin work.
		 *
		 * @since 4.0.0
		 */
		public function __construct() {
			register_activation_hook( __FILE__, array( $this, 'install_default_options' ) );

			new WP_CUJS_Shortcode();
			new WP_CUJS_Gutenberg_Block();

			if ( ! is_admin() ) {
				return;
			}

			add_filter( 'plugin_action_links', array( $this, 'add_settings_action_link' ), 10, 2 );
			add_filter( 'network_admin_plugin_action_links', array( $this, 'add_settings_action_link' ), 10, 2 );

			new WP_CUJS_Options();
		}

		/**
		 * Add the "Settings" action link to our plugin inside
		 * of the plugins table.
		 *
		 * @since  4.1.0
		 *
		 * @param  array    $actions        An array of plugin action links.
		 * @param  string   $plugin_file    Path to the plugin file relative to the plugins directory.
		 * @return array                    The plugin action links with Settings for our plugin.
		 */
		public function add_settings_action_link( $actions, $plugin_file ) {
			if ( false !== strpos( $plugin_file, 'wp-countup-js.php' ) ) {
				$url                 = admin_url( 'options-general.php?page=countup-js' );
				$actions['settings'] = '<a href="' . esc_attr( $url ) . '">Settings</a>';
			}

			return $actions;
		}

		/**
		 * Add the default plugin options when user activates the
		 * plugin for the first time.
		 *
		 * @since 4.1.0
		 */
		public function install_default_options() {
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

			update_option( 'countupjs-option-page', $default_settings, 'no' );
		}
	}
}
