<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_CUJS_HTML_Checkbox' ) ) {
	/**
	 * Handle the construction and rendering of the
	 * <input> checkbox element.
	 *
	 * @since 4.1.0
	 */
	class WP_CUJS_HTML_Checkbox {
		/**
		 * Render the <input> checkbox.
		 *
		 * @since  4.1.0
		 *
		 * @param  array   $setting_data   The current field setting data.
		 * @return string                  The constructed <input> checkbox element.
		 */
		public function render( $setting_data ) {
			$html  = '<label> <input type="checkbox" ';
			$html .= 'id="' . esc_attr( $setting_data['id'] ) . '" ';
			$html .= 'name="countupjs-option-page[' . esc_attr( $setting_data['name'] ) . ']" ';
			$html .= checked( 'on', $setting_data['current'], false ) . ' /> ';
			$html .= $setting_data['help_tip'] . '</label>';

			return $html;
		}
	}
}
