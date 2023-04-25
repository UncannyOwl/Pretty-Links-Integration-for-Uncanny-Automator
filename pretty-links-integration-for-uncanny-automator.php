<?php
/**
 * Plugin Name: Pretty Links Integration for Uncanny Automator
 * Plugin URI: https://automatorplugin.com
 * Description: A sample integration for Pretty links
 * Version: 1.0.0
 * Author: Uncanny Owl
 * Author URI: https://uncannyowl.com
 *
 * @package Uncanny_Automator\Pretty_Links
 **/

define( 'UNCANNY_AUTOMATOR_PRETTY_LINKS_VERSION', '1.0.0' );
define( 'UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH', trailingslashit( __DIR__ ) );
define( 'UNCANNY_AUTOMATOR_PRETTY_LINKS_URL', plugin_dir_url( __FILE__ ) );

// We're using anonymous function return here as we don't really want to reuse a function.
// We're hooking into 'automator_add_integration' action hook function to make sure Uncanny Automator
// has finished loading the required dependencies in order for our Integration to work properly.
add_action( 'automator_add_integration', 'uncanny_automator_pretty_links_integration_init' );

if ( ! function_exists( 'uncanny_automator_pretty_links_integration_init' ) ) {

	/**
	 * Initialize and instantiates the objects responsible for creating the Integration.
	 *
	 * @return void
	 */
	function uncanny_automator_pretty_links_integration_init() {

		// If this class doesn't exist, Uncanny Automator plugin needs to be updated.
		if ( ! class_exists( '\Uncanny_Automator\Integration' ) ) {
			return;
		}

		// You may use Psr4 Autoloading or any callback to spl_autoload_register to handle file loading.
		// But for this example, we'll manually load the files 😉.
		require_once UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH . 'src/integration/class-integration.php';

		// You may shorten the class name by providing the namespace with the use keyword above this file.
		// For this example, we'll use the absolute namespace path, we won't also use namespace in the main plugin file.
		// You may namespace the main plugin file of course if you want to.
		( new \Uncanny_Automator\Pretty_Links\Integration\Integration() );

        // Trigger 1: A pretty link of {{a specific redirect type}} is created.
		require_once UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH . 'src/trigger/class-redirect-of-specific-type-created-trigger.php';
		// On class instantiation, the parent class calls the setup_trigger method.
		( new \Uncanny_Automator\Pretty_Links\Trigger\Redirect_Of_Specific_Type_Created_Trigger() );

         // Trigger 2: A pretty link of is created.
		require_once UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH . 'src/trigger/class-redirect-of-any-type-created-trigger.php';
		// On class instantiation, the parent class calls the setup_trigger method.
		( new \Uncanny_Automator\Pretty_Links\Trigger\Redirect_Of_Any_Type_Created_Trigger() );

	}
}
