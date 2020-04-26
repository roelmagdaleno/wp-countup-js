<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_CUJS_Gutenberg_Block' ) ) {
	class WP_CUJS_Gutenberg_Block {
		/**
		 * The script handle to register in queue.
		 *
		 * @since  4.1.0
		 * @access private
		 */
		private const SCRIPT_HANDLE = 'wp-cujs-block.js';

		public function __construct() {
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_block_assets' ) );
			add_action( 'init', array( $this, 'register_block_type' ) );
		}

		public function enqueue_editor_block_assets() {
			$in_footer = true;

			wp_enqueue_script(
				'countUp.min.js',
				WP_COUNTUP_JS_URL . 'assets/js/vendor/countUp.min.js',
				null,
				'2.0.4',
				$in_footer
			);

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
				array( 'wp-blocks', 'wp-editor', 'wp-element' ),
				WP_COUNTUP_JS_VERSION,
				$in_footer
			);

			wp_enqueue_style(
				'wp-cujs-block.css',
				plugins_url( 'admin/css/wp-cujs-block.css', __DIR__ ),
				null,
				WP_COUNTUP_JS_VERSION
			);

			$settings        = get_option( 'countupjs-option-page' );
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

			register_block_type( 'wp-countup-js/counter', array(
				'editor_script' => 'wp-cujs-gutenberg-block-script',
			) );
		}

		public function register_block_type() {
			$args = array( 'editor_script' => self::SCRIPT_HANDLE );
			register_block_type( WP_COUNTUP_JS_GUTENBERG_NAMESPACE, $args );
		}
	}
}
