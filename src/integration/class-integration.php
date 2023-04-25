<?php
/**
 * This file holds the class \Uncanny_Automator\Pretty_Links\Integration\Integration
 *
 * @package Uncanny_Automator\Pretty_Links\Integration
 * @since 1.0.0
 */

namespace Uncanny_Automator\Pretty_Links\Integration;

/**
 * This class handles the integration setup:
 *
 * @link https://developer.automatorplugin.com/create-a-custom-automator-integration/
 * @link https://developer.automatorplugin.com/adding-a-custom-trigger-to-uncanny-automator/
 *
 * @package Uncanny_Automator\Pretty_Links\Integration
 *
 * @version 1.0.0
 */
class Integration extends \Uncanny_Automator\Integration {

	/**
	 * Setups the Integration.
	 *
	 * @return void
	 */
	protected function setup() {

		// The unique integration code.
		$this->set_integration( 'PRETTY_LINKS' );
		// The integration name. You can translate if you want to.
		$this->set_name( 'Pretty Links' );
		// The icon URL. Absolute URL path to the image file.
		$this->set_icon_url( UNCANNY_AUTOMATOR_PRETTY_LINKS_URL . 'assets/images/pretty-links-icon.svg' );

	}

}
