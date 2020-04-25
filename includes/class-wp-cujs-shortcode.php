<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'WP_CUJS_Shortcode' ) ) {
	/**
	 * Execute the shortcode functionality.
	 *
	 * @since  4.0.0
	 */
	class WP_CUJS_Shortcode {
		/**
		 * The plugin settings.
		 *
		 * @since  4.0.0
		 * @access private
		 *
		 * @var    array   $settings   The plugin settings.
		 */
		private $settings;

		/**
		 * Set the plugin settings and add the
		 * shortcode functionality.
		 *
		 * @since  4.0.0
		 */
		public function __construct() {
			$this->settings = get_option( 'countupjs-option-page' );

			add_filter( 'script_loader_tag', array( $this, 'add_module_attribute' ), 10, 2 );
			add_shortcode( 'countup', array( $this, 'show_counter' ) );
		}

		/**
		 * The countUp.min.js file (2.0.4) is exported as a ES6 module
		 * that's why we need to add the module attribute in the script and
		 * the same for our own script.
		 *
		 * @since  4.1.0
		 *
		 * @param  string   $tag      The current script tag to render in HTML.
		 * @param  string   $handle   The current handle script name.
		 * @return string             The script tag with module type.
		 */
		public function add_module_attribute( $tag, $handle ) {
			$valid_handles = array(
				'countUp.min.js',
				'wp-countup-js-plugin',
			);

			if ( ! in_array( $handle, $valid_handles, true ) ) {
				return $tag;
			}

			return str_replace( ' src', ' type="module" src', $tag );
		}

		/**
		 * Return the rendered counter.
		 *
		 * @since  4.0.0
		 * @since  4.0.2   Now we can execute shortcodes inside the count up shortcode.
		 *
		 * @param  array     $attributes   The input user's attributes.
		 * @param  string    $content      The content to return.
		 * @return string                  The rendered counter.
		 */
		public function show_counter( $attributes, $content = null ) {
			$shortcode_args = array(
				'start'     => '0',
				'end'       => '1000',
				'decimals'  => '0',
				'duration'  => '2',
				'scroll'    => true,
				'easing'    => true,
				'grouping'  => true,
				'separator' => ',',
				'decimal'   => '.',
				'prefix'    => '',
				'suffix'    => '',
				'delay'     => '0',
			);
			$shortcode_atts = shortcode_atts( $shortcode_args, $attributes );

			$this->enqueue_scripts();

			// The HTML counter.
			$counter  = '<div class="counter" ';
			$counter .= 'data-start="' . esc_attr( $shortcode_atts['start'] ) . '"' ;
			$counter .= 'data-decimals="' . esc_attr( $shortcode_atts['decimals'] ) . '"' ;
			$counter .= 'data-duration="' . esc_attr( $shortcode_atts['duration'] ) . '"' ;
			$counter .= 'data-scroll="' . esc_attr( $shortcode_atts['scroll'] ) . '"' ;
			$counter .= 'data-easing="' . esc_attr( $shortcode_atts['easing'] ) . '"' ;
			$counter .= 'data-grouping="' . esc_attr( $shortcode_atts['grouping'] ) . '"' ;
			$counter .= 'data-separator="' . esc_attr( $shortcode_atts['separator'] ) . '"' ;
			$counter .= 'data-decimal="' . esc_attr( $shortcode_atts['decimal'] ) . '"' ;
			$counter .= 'data-prefix="' . esc_attr( $shortcode_atts['prefix'] ) . '"' ;
			$counter .= 'data-suffix="' . esc_attr( $shortcode_atts['suffix'] ) . '"' ;
			$counter .= 'data-delay="' . esc_attr( $shortcode_atts['delay'] ) . '" ';

			if ( ! isset( $this->settings['end_inside_shortcode'] ) ) {
				$counter .= 'data-end="' . esc_attr( $shortcode_atts['end'] ) . '">';
			}

			if ( isset( $this->settings['end_inside_shortcode'] ) ) {
				$counter .= '>' . do_shortcode( $content );
			}

			$counter .= '</div>';

			return $counter;
		}

		/**
		 * Register the necessary scripts to make the
		 * plugin work.
		 *
		 * @since  4.0.0
		 */
		protected function enqueue_scripts() {
			$options         = get_option( 'countupjs-option-page' );
			$in_footer       = true;
			$plugin_settings = array(
				'useEasing'   => isset( $options['use_easing'] ),
				'useGrouping' => isset( $options['use_grouping'] ),
				'separator'   => $options['use_separator'],
				'decimal'     => $options['use_decimal'],
				'prefix'      => $options['use_prefix'],
				'suffix'      => $options['use_sufix'],
			);

			wp_enqueue_script(
				'countUp.min.js',
				WP_COUNTUP_JS_URL . 'assets/js/vendor/countUp.min.js',
				array( 'jquery' ),
				'2.0.4',
				$in_footer
			);

			wp_enqueue_script(
				'wp-countup-js-plugin',
				WP_COUNTUP_JS_URL . 'assets/js/wp-countup-show-counter.js',
				array( 'jquery' ),
				WP_COUNTUP_JS_VERSION,
				$in_footer
			);

			wp_localize_script( 'wp-countup-js-plugin', 'WP_CU_JS', array(
				'resetCounterWhenViewAgain' => isset( $options['reset_counter_when_view_again'] ),
				'endInsideShortcode'        => isset( $options['end_inside_shortcode'] ),
				'pluginSettings'            => $plugin_settings,
			) );
		}
	}
}
