<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

if ( ! class_exists( 'WP_CUJS_Options' ) ) {
	/**
	 * Create the plugin options page.
	 *
	 * @since  4.0.0
	 */
	class WP_CUJS_Options {
		/**
		 * The plugin settings.
		 *
		 * @since  4.1.0
		 * @access private
		 *
		 * @var    array   $settings   The plugin settings.
		 */
		private $settings;

		/**
		 * The plugin admin page slug.
		 *
		 * @since  4.1.0
		 * @access private
		 */
		private const ADMIN_PAGE = 'countup-js';

		/**
		 * The plugin option name to store our settings.
		 *
		 * @since  4.1.0
		 * @access private
		 */
		private const OPTION_NAME = 'countupjs-option-page';

		/**
		 * Set the required actions to create the
		 * options page.
		 *
		 * @since  4.0.0
		 */
		public function __construct() {
			$this->settings = WP_CUJS::get_instance()->settings;

			add_action( 'admin_menu', array( $this, 'register_submenu' ) );
			add_action( 'admin_init', array( $this, 'add_fields' ) );
		}

		/**
		 * Add the settings field into the admin page.
		 *
		 * @since 4.1.0
		 */
		public function add_fields() {
			register_setting( self::ADMIN_PAGE, self::OPTION_NAME );

			$section_id = 'wp_cup_settings_section';

			add_settings_section(
				$section_id,
				'Settings',
				'__return_false',
				self::ADMIN_PAGE
			);

			foreach ( $this->settings() as $setting_id => $setting_data ) {
				$label = isset( $setting_data['title'] )
					? '<label for="' . $setting_id . '">' . $setting_data['title'] . '</label>'
					: '';

				add_settings_field(
					$setting_id,
					$label,
					array( $this, 'generate_field' ),
					self::ADMIN_PAGE,
					$section_id,
					$setting_data
				);
			}
		}

		/**
		 * Render the field.
		 *
		 * The render process doesn't happen here but in its own field class.
		 * We will use the field input type to render it.
		 *
		 * @since 4.1.0
		 *
		 * @param array   $setting_data   The current field setting data.
		 */
		public function generate_field( $setting_data ) {
			$setting_data['current'] = $this->settings[ $setting_data['id'] ] ?? '';

			$class = 'WP_CUJS_HTML_' . ucfirst( $setting_data['type'] );
			echo ( new $class() )->render( $setting_data ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Create the options page.
		 *
		 * @since 4.0.0
		 */
		public function register_submenu() {
			add_options_page(
				'CountUp.js Options',
				'CountUP.js',
				'manage_options',
				self::ADMIN_PAGE,
				array( $this, 'show_submenu_page' )
			);
		}

		/**
		 * Render the options plugin page.
		 *
		 * @since 4.0.0
		 */
		public function show_submenu_page() {
			echo '<div class="wrap">';
			echo '<form method="POST" action="options.php">';

			settings_fields( self::ADMIN_PAGE );
			do_settings_sections( self::ADMIN_PAGE );
			submit_button();

			echo '</form>';
			echo '</div>';
		}

		/**
		 * The plugin settings to render the form.
		 *
		 * @since  4.1.0
		 * @access private
		 *
		 * @return array   The plugin settings to render the form.
		 */
		private function settings() {
			return array(
				'end_inside_shortcode'          => array(
					'id'       => 'end_inside_shortcode',
					'name'     => 'end_inside_shortcode',
					'title'    => 'Use number inside shortcode',
					'type'     => 'checkbox',
					'help_tip' => 'If this option is checked, you must use the shortcode like this: <code>[countup start="0" more options here]55[/countup]</code>',
				),
				'reset_counter_when_view_again' => array(
					'id'       => 'reset_counter_when_view_again',
					'name'     => 'reset_counter_when_view_again',
					'title'    => 'Reset counter after view',
					'type'     => 'checkbox',
					'help_tip' => 'If this option is checked, the counter will reset if you scroll and view it again.',
				),
				'use_easing'                    => array(
					'id'       => 'use_easing',
					'name'     => 'use_easing',
					'title'    => 'Use Easing?',
					'type'     => 'checkbox',
					'help_tip' => 'Check this setting to activate the easing.',
				),
				'use_grouping'                  => array(
					'id'       => 'use_grouping',
					'name'     => 'use_grouping',
					'title'    => 'Use Grouping?',
					'type'     => 'checkbox',
					'help_tip' => 'Check this setting to activate the grouping.',
				),
				'use_separator'                 => array(
					'id'       => 'use_separator',
					'name'     => 'use_separator',
					'title'    => 'Separator',
					'type'     => 'text',
					'help_tip' => 'If you put a comma, it will return: <code>1,300</code>',
				),
				'use_decimal'                   => array(
					'id'       => 'use_decimal',
					'name'     => 'use_decimal',
					'title'    => 'Decimal',
					'type'     => 'text',
					'help_tip' => 'If you put a dot, it will return: <code>1,300.00</code>',
				),
				'use_prefix'                    => array(
					'id'       => 'use_prefix',
					'name'     => 'use_prefix',
					'title'    => 'Prefix',
					'type'     => 'text',
					'help_tip' => 'If you use a prefix, it will return: <code>prefix1200</code>',
				),
				'use_sufix'                     => array(
					'id'       => 'use_sufix',
					'name'     => 'use_sufix',
					'title'    => 'Suffix',
					'type'     => 'text',
					'help_tip' => 'If you use a suffix, it will return: <code>1200suffix</code>',
				),
			);
		}
	}
}
