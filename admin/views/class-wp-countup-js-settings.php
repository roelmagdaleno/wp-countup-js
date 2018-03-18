<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'WP_CountUp_JS_Settings' ) ) {
	/**
	 * Create the respective plugin settings.
	 *
	 * @since  4.0.0
	 */
	class WP_CountUp_JS_Settings {
		/**
		 * The plugin settings.
		 *
		 * @since  4.0.0
		 * @access private
		 *
		 * @var    array   $plugin_settings   The plugin settings.
		 */
		private $plugin_settings;

		/**
		 * Add the respective hook to start to
		 * create the settings.
		 *
		 * @since  4.0.0
		 */
		public function __construct() {
			$this->plugin_settings = get_option( 'countupjs-option-page' );
			add_action( 'admin_init', array( $this, 'load_settings_fields' ) );
		}

		/**
		 * Register the settings and add the section.
		 *
		 * @since  4.0.0
		 */
		public function load_settings_fields() {
			register_setting(
				'countupjs-option-page',
				'countupjs-option-page'
			);

			add_settings_section(
				'wp_cup_settings_section',
				'CountUp.js Options',
				array( $this, 'create_settings_fields' ),
				'countupjs-option-page'
			);
		}

		/**
		 * Get the settings fields, loop it, and add the
		 * setting fields using the Settings API.
		 *
		 * @since  4.0.0
		 */
		public function create_settings_fields() {
			$settings = $this->get_settings();

			foreach ( $settings as $setting_id => $setting_args ) {
				add_settings_field(
					$setting_id,
					$setting_args['label'],
					array( $this, 'render_settings_field' ),
					'countupjs-option-page',
					'wp_cup_settings_section',
					$setting_args
				);
			}
		}

		/**
		 * Render the current setting field.
		 * Now we are just using a checkbox and a textfield.
		 *
		 * @since  4.0.0
		 *
		 * @param  array   $settings_args   The current settings args.
		 */
		public function render_settings_field( $settings_args ) {
			switch ( $settings_args['type'] ) {
				case 'checkbox':
					echo $this->render_checkbox( $settings_args );
					break;
				case 'text':
					echo $this->render_textfield( $settings_args );
					break;
			}
		}

		/**
		 * Render a checkbox.
		 *
		 * @since  4.0.0
		 * @access private
		 *
		 * @use    $this->check_option_value( $setting_id, $option_name )
		 *
		 * @param  array   $settings_args   The current settings args.
		 * @return string                   The rendered checkbox.
		 */
		private function render_checkbox( $settings_args ) {
			$input_name = 'countupjs-option-page[' . $settings_args['id'] . ']';
			$is_checked = checked( $this->check_option_value( $settings_args['id'], 'countupjs-option-page' ), '1', false );
			$output     = '<label for="' . esc_attr( $settings_args['id'] ) . '"> <input type="checkbox" id="' . esc_attr( $settings_args['id'] ) . '" name="' . esc_attr( $input_name ) . '" value="1" ' . $is_checked . ' /> ' . $settings_args['help_tip'] . ' </label>';

			return $output;
		}

		/**
		 * Render a textfield.
		 *
		 * @since  4.0.0
		 * @access private
		 *
		 * @use    $this->check_option_value( $setting_id, $option_name )
		 *
		 * @param  array   $settings_args   The current settings args.
		 * @return string                   The rendered checkbox.
		 */
		private function render_textfield( $settings_args ) {
			$input_name  = 'countupjs-option-page[' . $settings_args['id'] . ']';
			$input_value = $this->check_option_value( $settings_args['id'], 'countupjs-option-page' );
			$output      = '<input type="text" id="' . esc_attr( $settings_args['id'] ) . '" name="' . esc_attr( $input_name ) . '" value="' . esc_attr( $input_value ) . '" class="regular-text"> ' . $settings_args['help_tip'];

			return $output;
		}

		/**
		 * Check the current value for a checkbox or textfield.
		 *
		 * @since  4.0.0
		 * @access private
		 *
		 * @param  string   $setting_id    The current setting id.
		 * @param  string   $option_name   The option name.
		 * @return string                  The current option value.
		 */
		private function check_option_value( $setting_id, $option_name ) {
			if ( is_array( $this->plugin_settings ) && empty( $this->plugin_settings ) ) {
				return null;
			}

			if ( ! isset( $this->plugin_settings[ $setting_id ] ) ) {
				return null;
			}

			return $this->plugin_settings[ $setting_id ];
		}

		/**
		 * Get the plugin settings.
		 *
		 * @since  4.0.0
		 * @access private
		 *
		 * @return array   The plugin settings.
		 */
		private function get_settings() {
			$settings = array(
				'end_inside_shortcode'          => array(
					'label'     => 'Use the end number inside the shortcode?',
					'id'        => 'end_inside_shortcode',
					'label_for' => 'end_inside_shortcode',
					'type'      => 'checkbox',
					'help_tip'  => 'If this option is checked, you must use the shortcode like this: [countup start="0" more options here]55[/countup]',
				),
				'reset_counter_when_view_again' => array(
					'label'     => 'Reset the counter when view again?',
					'id'        => 'reset_counter_when_view_again',
					'label_for' => 'reset_counter_when_view_again',
					'type'      => 'checkbox',
					'help_tip'  => 'If this option is checked, the counter will reset if you scroll and view it again.',
				),
				'use_easing'                    => array(
					'label'     => 'Use Easing?',
					'id'        => 'use_easing',
					'label_for' => 'use_easing',
					'type'      => 'checkbox',
					'help_tip'  => 'Check this setting to activate the easing.',
				),
				'use_grouping'                  => array(
					'label'     => 'Use Grouping?',
					'id'        => 'use_grouping',
					'label_for' => 'use_grouping',
					'type'      => 'checkbox',
					'help_tip'  => 'Check this setting to activate the grouping.',
				),
				'use_separator'                 => array(
					'label'     => 'Separator',
					'id'        => 'use_separator',
					'label_for' => 'use_separator',
					'type'      => 'text',
					'help_tip'  => 'If you put a comma, it will return: 1,300',
				),
				'use_decimal'                   => array(
					'label'     => 'Decimal',
					'id'        => 'use_decimal',
					'label_for' => 'use_decimal',
					'type'      => 'text',
					'help_tip'  => 'If you put a dot, it will return: 1,300.00',
				),
				'use_prefix'                    => array(
					'label'     => 'Prefix',
					'id'        => 'use_prefix',
					'label_for' => 'use_prefix',
					'type'      => 'text',
					'help_tip'  => 'If you use a prefix, it will return: prefix1200',
				),
				'use_sufix'                     => array(
					'label'     => 'Suffix',
					'id'        => 'use_sufix',
					'label_for' => 'use_sufix',
					'type'      => 'text',
					'help_tip'  => 'If you use a suffix, it will return: 1200suffix',
				),
			);

			return $settings;
		}
	}

	new WP_CountUp_JS_Settings();
}
