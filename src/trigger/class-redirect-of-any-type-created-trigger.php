<?php
/**
 * This file holds the class \Uncanny_Automator\Pretty_Links\Trigger\Redirect_Of_Any_Type_Created_Trigger
 *
 * @package Uncanny_Automator\Pretty_Links\Trigger
 * @since 1.0.0
 */

namespace Uncanny_Automator\Pretty_Links\Trigger;

/**
 * This class handles the Trigger definition and validation of Trigger: \
 * "A pretty link is created"
 *
 * @link https://developer.automatorplugin.com/create-a-custom-automator-integration/
 * @link https://developer.automatorplugin.com/adding-a-custom-trigger-to-uncanny-automator/
 *
 * @package Uncanny_Automator\Pretty_Links\Trigger
 *
 * @version 1.0.0
 */
class Redirect_Of_Any_Type_Created_Trigger extends \Uncanny_Automator\Recipe\Trigger {

	/**
	 * Setups the Trigger properties.
	 *
	 * @link https://developer.automatorplugin.com/adding-a-custom-trigger-to-uncanny-automator/
	 * @return void
	 */
	protected function setup_trigger() {

		// Unique integration code.
		$this->set_integration( 'PRETTY_LINKS' );

		// Unique trigger code. You may declare the value as a class constant, up to you.
		$this->set_trigger_code( 'REDIRECT_OF_SPECIFIC_TYPE_CREATED' );

		// Reuseable trigger meta, can be used as the ID of a field OR group of fields.
		$this->set_trigger_meta( 'REDIRECT_TYPE' );

		// Options 'anonymous' or 'user'.
		$this->set_trigger_type( 'anonymous' );

		// Sentence that appears in UI once selected (sentence with selectable blue boxes).
		$this->set_sentence(
				/* translators: Trigger sentence */
			esc_attr__( 'A pretty link is created', 'automator-sample' )
		);

		// Sentence that appears in the trigger list drop down.
		$this->set_readable_sentence(
		/* translators: Trigger sentence */
			esc_attr__( 'A pretty link is created', 'automator-sample' )
		);

		// The action hook to listen into. Pretty links invokes 'prli-create-link' with two arguments when a link is created.
		$this->add_action( 'prli-create-link', 10, 2 );

	}

	/**
	 * Validates the Trigger. This method would allow you to narrow down the execution of the Trigger.\
	 *
	 * For example, we only want to fire the Trigger if the redirect type is 302.
	 *
	 * @param array{'ID': int, 'post_status': string, 'meta': mixed[]} $trigger The arguments supplied by the Trigger itself.
	 * @param mixed[]                                                  $hook_args The action hook arguments passed into this method.
	 *
	 * @return bool True, always. We want to fire the trigger regardless of the $trigger and $hook_args.
	 */
	public function validate( $trigger, $hook_args ) {

		return true;

	}

}
