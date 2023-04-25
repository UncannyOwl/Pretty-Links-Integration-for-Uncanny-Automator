<?php
/*
 * Plugin Name: Pretty Links Integration for Uncanny Automator
 * Plugin URI: https://automatorplugin.com
 * Description: A sample integration for Pretty links
 * Version: 1.0.0
 * Author: Uncanny Owl
 * Author URI: https://uncannyowl.com
**/

define( 'UNCANNY_AUTOMATOR_PRETTY_LINKS_VERSION', '1.0.0' );
define( 'UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH', trailingslashit( __DIR__ ) );
define( 'UNCANNY_AUTOMATOR_PRETTY_LINKS_URL', plugin_dir_url( __FILE__ ) );

add_action( 'automator_add_integration', 'sample_integration_load_files' );

function sample_integration_load_files() {

	// If this class doesn't exist, Uncanny Automator plugin needs to be updated.
	if ( ! class_exists( '\Uncanny_Automator\Integration' ) ) {
		return;
	}

	require_once UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH . 'src/sample-integration.php';
	new Sample_Integration();

	require_once UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH . 'src/trigger/class-specific-type-created-trigger.php';
	// You may shorten the class name by providing the namespace with the use keyword above this file.
	// For this example, we'll use the absolute namespace path.
	new \Uncanny_Automator\Pretty_Links\Trigger\Specific_Type_Created_Trigger();

}
