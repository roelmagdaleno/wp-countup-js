<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_CUJS_Gutenberg_Block' ) ) {
	/**
	 * Register our custom Gutenberg block in WordPress.
	 *
	 * @since 4.1.0
	 */
	class WP_CUJS_Gutenberg_Block {
		/**
		 * The script handle to register in queue.
		 *
		 * @since  4.1.0
		 * @access private
		 */
		private const SCRIPT_HANDLE = 'wp-cujs-block.js';

		/**
		 * Initialize the actions to register our Gutenberg block
		 * in WordPress and to enqueue the scripts.
		 *
		 * @since 4.1.0
		 */
		public function __construct() {
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_block_assets' ) );
			add_action( 'init', array( $this, 'register_block_type' ) );
		}

		/**
		 * Enqueue the scripts in the post block editor.
		 *
		 * @since 4.1.0
		 * @since 4.2.4 Remove Gutenberg dependencies, those aren't needed anymore.
		 */
		public function enqueue_editor_block_assets() {
			$in_footer = true;

			wp_enqueue_script(
				'wp-countup-js-plugin',
				WP_COUNTUP_JS_URL . 'assets/js/wp-countup-show-counter.min.js',
				null,
				WP_COUNTUP_JS_VERSION,
				$in_footer
			);

			wp_enqueue_script(
				self::SCRIPT_HANDLE,
				plugins_url( 'admin/js/wp-cujs-block.js', __DIR__ ),
				null,
				WP_COUNTUP_JS_VERSION,
				$in_footer
			);

			wp_enqueue_style(
				'wp-cujs-block.css',
				plugins_url( 'admin/css/wp-cujs-block.css', __DIR__ ),
				null,
				WP_COUNTUP_JS_VERSION
			);

			$settings        = WP_CUJS::get_instance()->settings;
			$plugin_settings = array(
				'useEasing'   => isset( $settings['use_easing'] ),
				'useGrouping' => isset( $settings['use_grouping'] ),
				'separator'   => $settings['use_separator'],
				'decimal'     => $settings['use_decimal'],
				'prefix'      => $settings['use_prefix'],
				'suffix'      => $settings['use_sufix'],
			);

			$args = array(
				'resetCounterWhenViewAgain' => isset( $settings['reset_counter_when_view_again'] ),
				'endInsideShortcode'        => isset( $settings['end_inside_shortcode'] ),
				'pluginSettings'            => $plugin_settings,
			);

			wp_localize_script( self::SCRIPT_HANDLE, 'WP_CU_JS', $args );
		}

		/**
		 * Register the our block in WordPress.
		 *
		 * Our namespace is from WP_COUNTUP_JS_GUTENBERG_NAMESPACE constant
		 * and is equal to "roelmagdaleno/wp-countup-js".
		 *
		 * @since 4.1.0
		 */
		public function register_block_type() {
			$args = array( 'editor_script' => self::SCRIPT_HANDLE );
			register_block_type( WP_COUNTUP_JS_GUTENBERG_NAMESPACE, $args );
		}
	}
}
