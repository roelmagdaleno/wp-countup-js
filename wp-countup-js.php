<?php

/*
Plugin Name:       WP CountUP JS
Plugin URI:        https://github.com/roelmagdaleno/wp-countup-js
Description:       Display multiple animated counters into your WordPress site.
Version:           4.2.4
Requires at least: 5.7.4
Author:            Roel Magdaleno
Author URI:        https://roelmagdaleno.com
License:           GPLv3
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

// Require the necessary files to run the classes.
require_once 'includes/required-classes.php';

$instance = new WP_CUJS();
register_activation_hook( __FILE__, array( $instance, 'install_default_options' ) );
