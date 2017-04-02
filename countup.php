<?php
  /*
  Plugin Name: WP CountUP JS
  Plugin URI: https://roelmagdaleno.com/plugins/countup-js
  Description: You can create a lot of animated numerical counters and display it into your site.
  Version: 3.1
  Author: Roel Magdaleno
  Author URI: https://roelmagdaleno.com
  License: GPLv2
  */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/*-----------------------------------
* Adding Menu to Settings Menu
*----------------------------------*/
add_action( 'admin_menu', 'wp_cup_options_to_settings_menu' );

function wp_cup_options_to_settings_menu() {
	add_options_page(
		'CountUp.js Options',
		'CountUP.js',
		'manage_options',
		'countup-js',
		'countup_theme'
	);
}

  /*-----------------------------------
  * Theme Display
  *----------------------------------*/
function countup_theme() {
?>
	<div class="wrap">
		<form method="post" action="options.php">
			<?php
			settings_fields( 'countupjs-option-page' );
			do_settings_sections( 'countupjs-option-page' );
			submit_button();
			?>
		</form>
	</div>
<?php
}

/*-----------------------------------
* CountUp.js Activated & Deactivated
*----------------------------------*/
//Activated
function wp_cup_activated() {
	if( !get_option( 'countupjs-option-page' ) ){
		$default_settings = array(
			'use_easing'    => 'true',
			'use_grouping'  => 'true',
			'use_separator' => ',',
			'use_decimal'   => '.',
			'use_prefix'    => '',
			'use_sufix'     => '',
		);

		add_option( 'countupjs-option-page', $default_settings );
	}
}

//Uninstalled
function wp_cup_uninstall() {
	delete_option( 'countupjs-option-page' );
}

//Register Hooks
register_activation_hook( __FILE__, 'wp_cup_activated' );
register_uninstall_hook( __FILE__, 'wp_cup_uninstall' );

/*-----------------------------------
* Setting Registration
*----------------------------------*/
 function wp_cup_initialize_theme_options(){
	add_settings_section(
		'wp_cup_settings_section',
		'CountUp.js Options',
		'wp_cup_options_callback',
		'countupjs-option-page'
	);

	add_settings_field(
		'end_inside_shortcode',
		'Use the end number inside the shortcode?',
		'wp_cup_use_end_number_inside_shortcode',
		'countupjs-option-page',
		'wp_cup_settings_section',
		array( 'If this option is checked, you should use the shortcode like this: [countup start="0" more options here]55[/countup]' )
	);

	//Checkbox
	add_settings_field(
		'use_easing',
		'Use Easing?',
		'wp_cup_easing_callback',
		'countupjs-option-page',
		'wp_cup_settings_section',
		array( 'Activate this setting to activate the easing.' )
	);

	//Checkbox
	add_settings_field(
		'use_grouping',
		'Use Grouping?',
		'wp_cup_grouping_callback',
		'countupjs-option-page',
		'wp_cup_settings_section',
		array( 'Activate this setting to activate the grouping.' )
	);

	//Textfield
	add_settings_field(
		'use_separator',
		'Separator',
		'wp_cup_separator_callback',
		'countupjs-option-page',
		'wp_cup_settings_section',
		array( "If you put a comma, returns: 1,300" )
	);

	//Textfield
	add_settings_field(
		'use_decimal',
		'Decimal',
		'wp_cup_decimal_callback',
		'countupjs-option-page',
		'wp_cup_settings_section',
		array( "If you put a dot, returns: 1,300.00" )
	);

	//Textfield
	add_settings_field(
		'use_prefix',
		'Prefix',
		'wp_cup_prefix_callback',
		'countupjs-option-page',
		'wp_cup_settings_section',
		array( "If you use a prefix, returns: prefix1200" )
	);

	//Textfield
	add_settings_field(
		'use_sufix',
		'Sufix',
		'wp_cup_sufix_callback',
		'countupjs-option-page',
		'wp_cup_settings_section',
		array( "If you use a suffix, returns: 1200suffix" )
	);

	//Register the fields with WordPress
	register_setting( 'countupjs-option-page', 'countupjs-option-page' );
}

add_action( 'admin_init', 'wp_cup_initialize_theme_options' );

/*-----------------------------------
* Section Callbacks
*----------------------------------*/
function wp_cup_options_callback() {
	echo '<p>This options are completely optional, so feel free to activate or deactivate the easing and grouping, and fill the textfields.</p>';
}

function wp_cup_get_values( $value, $default_value ) {
	$options = get_option( 'countupjs-option-page' );
	$value   = ! isset( $options[ $value ] ) ? $default_value : $options[ $value ];

	return $value;
}

/*-----------------------------------
* Field Callbacks
*----------------------------------*/
function wp_cup_easing_callback( $args ) {
	$value = wp_cup_get_values( 'use_easing', 'false' );
	$html  = '<input type="checkbox" id="use_easing" name="countupjs-option-page[use_easing]" value="true" ' . checked( 'true', $value, false ) . '/>';
	$html .= '<label for="use_easing">'  . $args[0] . '</label>';

	echo $html;
}

function wp_cup_grouping_callback( $args ) {
	$value = wp_cup_get_values( 'use_grouping', 'false' );
	$html  = '<input type="checkbox" id="use_grouping" name="countupjs-option-page[use_grouping]" value="true" ' . checked( 'true', $value, false ) . '/>';
	$html .= '<label for="use_grouping">'  . $args[0] . '</label>';

	echo $html;
}

function wp_cup_separator_callback( $args ) {
	$value = wp_cup_get_values( 'use_separator', ',' );
	$html  = "<input type='text' id='use_separator' name='countupjs-option-page[use_separator]' value='$value'>";
	$html .= '<label for="use_separator">'  . $args[0] . '</label>';

	echo $html;
}

function wp_cup_decimal_callback( $args ) {
	$value = wp_cup_get_values( 'use_separator', ',' );
	$html  = "<input type='text' id='use_decimal' name='countupjs-option-page[use_decimal]' value='$value'>";
	$html .= '<label for="use_decimal">'  . $args[0] . '</label>';

	echo $html;
}

function wp_cup_prefix_callback( $args ) {
	$value = wp_cup_get_values( 'use_prefix', 'abc' );
	$html  = "<input type='text' id='use_prefix' name='countupjs-option-page[use_prefix]' value='$value'>";
	$html .= '<label for="use_prefix">'  . $args[0] . '</label>';

	echo $html;
}

function wp_cup_sufix_callback( $args ) {
	$value = wp_cup_get_values( 'use_sufix', 'def' );
	$html  = "<input type='text' id='use_sufix' name='countupjs-option-page[use_sufix]' value='$value'>";
	$html .= '<label for="use_sufix">'  . $args[0] . '</label>';

	echo $html;
}

function wp_cup_use_end_number_inside_shortcode( $args ) {
	$value = wp_cup_get_values( 'end_inside_shortcode', 'false' );
	$html  = '<input type="checkbox" id="end_inside_shortcode" name="countupjs-option-page[end_inside_shortcode]" value="true" ' . checked( 'true', $value, false ) . '/>';
	$html .= '<label for="end_inside_shortcode">'  . $args[0] . '</label>';

	echo $html;
}

/*-----------------------------------
* CountUp.js Plugin
*----------------------------------*/
function wp_cup_register_scripts() {
	$options  = get_option( 'countupjs-option-page' );
	$settings = array(
		'useEasing'   => isset( $options['use_easing'] ) ? true : false,
		'useGrouping' => isset( $options['use_grouping'] ) ? true : false,
		'separator'   => $options['use_separator'],
		'decimal'     => $options['use_decimal'],
		'prefix'      => $options['use_prefix'],
		'suffix'      => $options['use_sufix'],
	);

	wp_register_script( 'wp_cup_countup_js', plugins_url( 'js/countUp.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'wp_cup_countup_js' );

	wp_register_script( 'wp_cup_initializer', plugins_url( 'js/show_counter.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'wp_cup_initializer' );

	wp_localize_script( 'wp_cup_initializer', 'wp_cup_settings', array(
		'end_inside_shortcode' => isset( $options['end_inside_shortcode'] ) ? true : false,
		'settings'             => $settings,
	) );
}

add_action( 'wp_enqueue_scripts', 'wp_cup_register_scripts' );

/*-----------------------------------
* Shortcode [countup arg1="" arg2="" ...]
*----------------------------------*/
add_shortcode( 'countup', 'wp_cup_show_counter' );

function wp_cup_show_counter( $atts, $content = null ) {
	//Get options saved from CountUp.js Options
	$options  = get_option( 'countupjs-option-page' );
	$args     = array(
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
	$a        = shortcode_atts( $args, $atts );

	//This div contains the end of the counter, it is represented by a data-count.
	if ( isset( $options['end_inside_shortcode'] ) ) {
		$output = '<div class="counter" data-start="' . esc_attr( $a['start'] ) . '" data-decimals="' . esc_attr( $a['decimals'] ) . '" data-duration="' . esc_attr( $a['duration'] ) . '" data-scroll="' . esc_attr( $a['scroll'] ) . '" data-easing="' . esc_attr( $a['easing'] ) . '" data-grouping="' . esc_attr( $a['grouping'] ) . '" data-separator="' . esc_attr( $a['separator'] ) . '" data-decimal="' . esc_attr( $a['decimal'] ) . '" data-prefix="' . esc_attr( $a['prefix'] ) . '" data-suffix="' . esc_attr( $a['suffix'] ) . '" >' . $content . '</div>';
	} else {
		$output = '<div class="counter" data-start="' . esc_attr( $a['start'] ) . '" data-count="' . esc_attr( $a['end'] ) . '" data-decimals="' . esc_attr( $a['decimals'] ) . '" data-duration="' . esc_attr( $a['duration'] ) . '" data-scroll="' . esc_attr( $a['scroll'] ) . '" data-easing="' . esc_attr( $a['easing'] ) . '" data-grouping="' . esc_attr( $a['grouping'] ) . '" data-separator="' . esc_attr( $a['separator'] ) . '" data-decimal="' . esc_attr( $a['decimal'] ) . '" data-prefix="' . esc_attr( $a['prefix'] ) . '" data-suffix="' . esc_attr( $a['suffix'] ) . '" ></div>';
	}

	//Return Output.
	return $output;
}
