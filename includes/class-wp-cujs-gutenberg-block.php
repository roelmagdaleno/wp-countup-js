<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_CUJS_Gutenberg_Block' ) ) {
	class WP_CUJS_Gutenberg_Block {
		public function __construct() {
			add_action( 'enqueue_block_editor_assets', array( $this, 'register_block' ) );
		}

		public function register_block() {
			$in_footer = true;

			wp_register_script(
				'wp-cujs-gutenberg-block-script',
				plugins_url( 'assets/js/wp-cujs-block.js', __DIR__ ),
				array( 'wp-blocks', 'wp-editor', 'wp-element', ),
				WP_COUNTUP_JS_VERSION,
				$in_footer
			);

			register_block_type( 'wp-countup-js/counter', array(
				'editor_script' => 'wp-cujs-gutenberg-block-script',
			) );
		}
	}
}
