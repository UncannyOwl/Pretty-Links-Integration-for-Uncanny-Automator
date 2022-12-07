<?php
/*
 * Plugin Name: Pretty Links Integration for Uncanny Automator
 * Plugin URI: https://automatorplugin.com
 * Description: A sample integration for Pretty links
 * Version: 1.0.0
 * Author: Uncanny Owl
 * Author URI: https://uncannyowl.com
**/

/**
 * Step 1: Start by hooking your callable method or function to `automator_configuration_complete` hook.
 *
 * Hooking to `automator_configuration_complete_hook` ensures that Uncanny Automator is loaded.
 *
 * The hook `automator_configuration_complete` takes no argument.
 *
 * You can pass any integer value as a priority. Let's use 10 as an example.
 *
 * You may change `my_prefix` to your own prefix.
 */
add_action( 'automator_configuration_complete', 'my_prefix_register_integration', 10 );

// Using `function_exists` to prevent function name collision.
if ( ! function_exists( 'my_prefix_register_integration' ) ) {

	function my_prefix_register_integration() {

		// Step 2: Add the integration by using Uncanny Automator's built-in function called `automator_add_integration_directory`.

		// The function `automator_add_integration_directory` takes two arguments here.

		// First argument is our integration unique code. You may pass whatever you like.

		// The second argument is the location to the integration directory. Make sure that directory exists :)

		automator_add_integration_directory( 'pretty-links', __DIR__ . '/integration/pretty-links' );

	}
}

/**
 * Next step: Activate the plugin if you haven't already. Check for fatal errors and fix those errors first if you got one.
 *
 * Otherwise, create a new directory called `pretty-links` in your plugin's root location under `integration` directory.
 *
 * Create the `integration` directory as well.
 *
 * Good luck!
 */
