<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'WP_CountUp_JS_Shortcode' ) ) {
	/**
	 * Execute the shortcode functionality.
	 *
	 * @since  4.0.0
	 */
	class WP_CountUp_JS_Shortcode {
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
			add_shortcode( 'countup', array( $this, 'show_counter' ) );
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
				'scroll'    => 'true',
				'easing'    => ' ',
				'grouping'  => ' ',
				'separator' => ' ',
				'decimal'   => ' ',
				'prefix'    => ' ',
				'suffix'    => ' ',
			);
			$shortcode_atts = shortcode_atts( $shortcode_args, $attributes );

			// The HTML counter.
			$counter  = '<div class="counter"';
			$counter .= ' data-start="' . esc_attr( $shortcode_atts['start'] ) . '"';
			$counter .= ' data-decimals="' . esc_attr( $shortcode_atts['decimals'] ) . '"';
			$counter .= ' data-duration="' . esc_attr( $shortcode_atts['duration'] ) . '"';
			$counter .= ' data-scroll="' . esc_attr( $shortcode_atts['scroll'] ) . '"';
			$counter .= ' data-easing="' . esc_attr( $shortcode_atts['easing'] ) . '"';
			$counter .= ' data-grouping="' . esc_attr( $shortcode_atts['grouping'] ) . '"';
			$counter .= ' data-separator="' . esc_attr( $shortcode_atts['separator'] ) . '"';
			$counter .= ' data-decimal="' . esc_attr( $shortcode_atts['decimal'] ) . '"';
			$counter .= ' data-prefix="' . esc_attr( $shortcode_atts['prefix'] ) . '"';
			$counter .= ' data-suffix="' . esc_attr( $shortcode_atts['suffix'] ) . '"';

			if ( ! isset( $this->settings['end_inside_shortcode'] ) ) {
				$counter .= ' data-end="' . esc_attr( $shortcode_atts['end'] ) . '"';
				$counter .= '>';
			}

			if ( isset( $this->settings['end_inside_shortcode'] ) ) {
				$counter .= '>' . do_shortcode( $content );
			}

			$counter .= '</div>';

			return $counter;
		}
	}
}
