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
		 * The plugin settings.
		 *
		 * @since  4.1.0
		 * @var    array   $settings   The plugin settings.
		 */
		public $settings;

		/**
		 * Get the existent instance so we won't
		 * instantiate it over and over again.
		 *
		 * @since  4.1.0
		 * @access private
		 *
		 * @var    WP_CUJS   $instance   The main class instance.
		 */
		private static $instance;

		/**
		 * Get the existent parser instance so we won't instantiate it over and over again.
		 * This is a singleton pattern.
		 *
		 * @ince   4.1.0
		 *
		 * @return WP_CUJS   The current class instance.
		 */
		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Register the necessary hooks and initialize instances
		 * to make the plugin work.
		 *
		 * @since 4.0.0
		 */
		public function __construct() {
			self::$instance = $this;
			$this->settings = get_option( 'countupjs-option-page', array() );

			register_activation_hook( __FILE__, array( $this, 'install_default_options' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

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
		 * Enqueue the main scripts so the counter can work in the
		 * page that is inserted.
		 *
		 * But first we need to decide if the scripts need to be
		 * enqueued.
		 *
		 * @since 4.1.0
		 */
		public function enqueue_scripts() {
			if ( ! $this->should_enqueue_assets() ) {
				return;
			}

			$in_footer       = true;
			$plugin_settings = array(
				'useEasing'   => isset( $this->settings['use_easing'] ),
				'useGrouping' => isset( $this->settings['use_grouping'] ),
				'separator'   => $this->settings['use_separator'],
				'decimal'     => $this->settings['use_decimal'],
				'prefix'      => $this->settings['use_prefix'],
				'suffix'      => $this->settings['use_sufix'],
			);

			/**
			 * We're only enqueuing this script because already contains
			 * the countUp.min.js file as import module.
			 *
			 * We were enqueueing the countUp.min.js script before but it
			 * was loading twice in the website.
			 *
			 * @since 4.1.0
			 */
			wp_enqueue_script(
				'wp-countup-js-plugin',
				WP_COUNTUP_JS_URL . 'assets/js/wp-countup-show-counter.min.js',
				array( 'jquery' ),
				WP_COUNTUP_JS_VERSION,
				$in_footer
			);

			wp_localize_script( 'wp-countup-js-plugin', 'WP_CU_JS', array(
				'resetCounterWhenViewAgain' => isset( $this->settings['reset_counter_when_view_again'] ),
				'endInsideShortcode'        => isset( $this->settings['end_inside_shortcode'] ),
				'pluginSettings'            => $plugin_settings,
			) );
		}

		/**
		 * Whether to enqueue the assets on frontend or not.
		 *
		 * First we look into the post if the shortcode "countup" exists
		 * after that we can do another check if the post has the block
		 * "roelmagdaleno/wp-countup-js".
		 *
		 * @since  4.1.0
		 * @access private
		 *
		 * @return bool   Whether to enqueue the assets on frontend or not.
		 */
		private function should_enqueue_assets() {
			global $post;

			if ( ! $post ) {
				return false;
			}

			if ( has_shortcode( $post->post_content, 'countup' ) ) {
				return true;
			}

			return has_block( WP_COUNTUP_JS_GUTENBERG_NAMESPACE, $post->post_content );
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
			if ( empty( $this->settings ) ) {
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
