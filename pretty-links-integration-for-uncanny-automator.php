<?php
/*
 * Plugin Name: Pretty Links Integration for Uncanny Automator
 * Plugin URI: https://automatorplugin.com
 * Description: A sample integration for Pretty links
 * Version: 1.0.0
 * Author: Uncanny Owl
 * Author URI: https://uncannyowl.com
**/

add_action( 'automator_add_integration', 'sample_integration_load_files' );

define( 'UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH', trailingslashit( __DIR__ ) );
define( 'UNCANNY_AUTOMATOR_PRETTY_LINKS_URL', plugin_dir_url( __FILE__ ) );

function sample_integration_load_files() {

	// If this class doesn't exist, Uncanny Automator plugin needs to be updated.
	if ( ! class_exists( '\Uncanny_Automator\Integration' ) ) {
		return;
	}

	require_once UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH . 'src/sample-integration.php';
	new Sample_Integration();

	require_once UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH . 'src/triggers/sample-trigger.php';
	new Post_Created_Sample_Trigger();

}
