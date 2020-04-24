<?php

/*
Plugin Name: WP CountUP JS
Plugin URI:  https://roelmagdaleno.com/plugins/countup-js
Description: Create animated incremental numerical counters and display it into your site.
Version:     4.1
Author:      Roel Magdaleno
Author URI:  https://roelmagdaleno.com
License:     GPLv2
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Require all the useful classes to make
 * the plugin work.
 *
 * @since  4.0.0
 */
require_once 'includes/required-classes.php';

/**
 * Execute the respective code when the user
 * activate the plugin.
 *
 * @since  4.0.0
 */
register_activation_hook( __FILE__, array( 'WP_CUJS_Activator', 'activate' ) );

/**
 * Start the main functionality.
 *
 * @since  4.0.0
 */
new WP_CUJS();
