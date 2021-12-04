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
			$this->settings = get_option( WP_COUNTUP_JS_OPTION_NAME, array() );

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_filter( 'script_loader_tag', array( $this, 'add_module_attribute' ), 10, 3 );

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
		 * The countUp.min.js file (2.0.8) is exported as a ES6 module
		 * that's why we need to add the module attribute in the script and
		 * the same for our own script.
		 *
		 * @since  4.1.0
		 *
		 * @param  string   $tag      The current script tag to render in HTML.
		 * @param  string   $handle   The current handle script name.
		 * @return string             The script tag with module type.
		 */
		public function add_module_attribute( $tag, $handle, $src ) {
			$valid_handles = array(
				'wp-countup-js-plugin',
			);

			if ( ! in_array( $handle, $valid_handles, true ) ) {
				return $tag;
			}

			return '<script type="module" src="' . esc_attr( $src ) . '"></script>'; // phpcs:ignore
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

			wp_enqueue_script(
				'wp-countup-js-plugin',
				WP_COUNTUP_JS_URL . 'assets/js/wp-countup-show-counter.min.js',
				null,
				WP_COUNTUP_JS_VERSION,
				true
			);

			$this->localize();
		}

		/**
		 * Localize the required attributes for JavaScript in frontend.
		 * Those attributes will be used for our JS file to start its functionality.
		 *
		 * @since 4.2.2
		 */
		public function localize() {
			$plugin_settings = array(
				'useEasing'   => isset( $this->settings['use_easing'] ),
				'useGrouping' => isset( $this->settings['use_grouping'] ),
				'separator'   => $this->settings['use_separator'],
				'decimal'     => $this->settings['use_decimal'],
				'prefix'      => $this->settings['use_prefix'],
				'suffix'      => $this->settings['use_sufix'],
			);

			$args = array(
				'resetCounterWhenViewAgain' => isset( $this->settings['reset_counter_when_view_again'] ),
				'endInsideShortcode'        => isset( $this->settings['end_inside_shortcode'] ),
				'pluginSettings'            => $plugin_settings,
			);

			wp_localize_script( 'wp-countup-js-plugin', 'WP_CU_JS', $args );
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
			if ( ! empty( $this->settings ) ) {
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

			update_option( WP_COUNTUP_JS_OPTION_NAME, $default_settings, 'no' );
		}
	}
}
