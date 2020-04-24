<?php

/*
Plugin Name: WP CountUP JS
Plugin URI:  https://github.com/roelmagdaleno/wp-countup-js
Description: Create animated incremental numerical counters and display it into your site.
Version:     4.1.0
Author:      Roel Magdaleno
Author URI:  https://roelmagdaleno.com
License:     GPLv2
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

// Require the necessary files to run the classes.
require_once 'includes/required-classes.php';

new WP_CUJS();
