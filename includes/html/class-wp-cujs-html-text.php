<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_CUJS_HTML_Text' ) ) {
	/**
	 * Handle the construction and rendering of the
	 * <input> text element.
	 *
	 * @since 4.1.0
	 */
	class WP_CUJS_HTML_Text {
		/**
		 * Render the <input> text.
		 *
		 * @since  4.1.0
		 *
		 * @param  array   $setting_data   The current field setting data.
		 * @return string                  The constructed <input> text element.
		 */
		public function render( $setting_data ) {
			$html  = '<label> <input type="text" ';
			$html .= 'id="' . esc_attr( $setting_data['id'] ) . '" ';
			$html .= 'name="countupjs-option-page[' . esc_attr( $setting_data['name'] ) . ']" ';
			$html .= 'value="' . esc_attr( $setting_data['current'] ) . '" /> ';
			$html .= $setting_data['help_tip'] . '</label>';

			return $html;
		}
	}
}
