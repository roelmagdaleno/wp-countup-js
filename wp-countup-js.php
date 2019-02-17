<?php

/*
Plugin Name: WP CountUP JS
Plugin URI:  https://roelmagdaleno.com/plugins/countup-js
Description: You can create a lot of animated numerical counters and display it into your site.
Version:     4.0.2
Author:      Roel Magdaleno
Author URI:  https://roelmagdaleno.com
License:     GPLv2
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * The plugin dir path.
 */
define( 'WP_COUNTUP_JS_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The plugin dir path.
 */
define( 'WP_COUNTUP_JS_URL', plugin_dir_url( __FILE__ ) );

/**
 * Require all the useful classes to make
 * the plugin work.
 *
 * @since  4.0.0
 */
require_once WP_COUNTUP_JS_PATH . 'includes/required-classes.php';

/**
 * Execute the respective code when the user
 * activate the plugin.
 *
 * @since  4.0.0
 */
register_activation_hook( __FILE__, array( 'WP_CountUp_JS_Activator', 'activate' ) );

/**
 * Start the main functionality.
 *
 * @since  4.0.0
 */
new WP_CountUp_JS_Main();
