<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

delete_option( 'countupjs-option-page' );
delete_site_option( 'countupjs-option-page' );
