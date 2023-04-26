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

/**
 * Hooks into `automator_add_integration` action hook to register our Integration.
 *
 * The action hook 'automator_add_integration' contains no arguments, priority can be left with 10 as the default.
 */
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

		// === Part 1: Integration === //

		// You may shorten the class name by providing the namespace with the use keyword above this file.
		// For this example, we'll use the absolute namespace path, we won't also use namespace in the main plugin file.
		// You may namespace the main plugin file of course if you want to.
		( new \Uncanny_Automator\Pretty_Links\Integration\Integration() );

		// === Part 2: Triggers === //
		// Trigger 1: A pretty link of {{a specific redirect type}} is created.
		require_once UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH . 'src/trigger/class-redirect-of-specific-type-created-trigger.php';
		// Trigger: A pretty link of {{a specific redirect type}} is created.
		( new \Uncanny_Automator\Pretty_Links\Trigger\Redirect_Of_Specific_Type_Created_Trigger() );

		// Trigger 2: A pretty link of is created.
		require_once UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH . 'src/trigger/class-redirect-of-any-type-created-trigger.php';
		// Trigger: A pretty link of is created.
		( new \Uncanny_Automator\Pretty_Links\Trigger\Redirect_Of_Any_Type_Created_Trigger() );

		// Trigger 3: A pretty link of is created (with tokens example).
		// Demonstrates how you can write token for a specific integration.
		require_once UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH . 'src/trigger/class-tokens-example-redirect-of-specific-type-created-trigger.php';
		// Trigger: A pretty link of is created (with tokens example).
		( new \Uncanny_Automator\Pretty_Links\Trigger\Tokens_Example_Redirect_Of_Specific_Type_Created_Trigger() );

		// === Part 3: Actions === //
		require_once UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH . 'src/action/class-create-link-action.php';
		// Create a pretty link with {{a specific target URL}}.
		( new \Uncanny_Automator\Pretty_Links\Action\Create_Link_Action() );

		require_once UNCANNY_AUTOMATOR_PRETTY_LINKS_PATH . 'src/action/class-tokens-example-create-link-action.php';
		// Create a pretty link with {{a specific target URL}}.
		( new \Uncanny_Automator\Pretty_Links\Action\Tokens_Example_Create_Link_Action() );

	}
}
