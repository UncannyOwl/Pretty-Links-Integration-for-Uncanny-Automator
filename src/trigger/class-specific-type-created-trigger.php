<?php
/**
 * This file holds the class \Uncanny_Automator\Pretty_Links\Trigger\Specific_Type_Created_Trigger
 *
 * @package Uncanny_Automator\Pretty_Links\Trigger
 * @since 1.0.0
 */

namespace Uncanny_Automator\Pretty_Links\Trigger;

/**
 * This class handles the Trigger definition and validation of Trigger: \
 * "A pretty link of {{a specific redirect type}} is created"
 *
 * @link https://developer.automatorplugin.com/create-a-custom-automator-integration/
 * @link https://developer.automatorplugin.com/adding-a-custom-trigger-to-uncanny-automator/
 *
 * @package Uncanny_Automator\Pretty_Links\Trigger
 *
 * @version 1.0.0
 */
class Specific_Type_Created_Trigger extends \Uncanny_Automator\Recipe\Trigger {

	/**
	 * Setups the Trigger properties.
	 *
	 * @link https://developer.automatorplugin.com/adding-a-custom-trigger-to-uncanny-automator/
	 * @return void
	 */
	protected function setup_trigger() {

		// Unique integration code.
		$this->set_integration( 'PRETTY_LINKS' );

		// Unique trigger code.
		$this->set_trigger_code( 'POST_CREATED_SAMPLE' );

		// Reuseable trigger meta, can be used as the ID of a field OR group of fields.
		$this->set_trigger_meta( 'REDIRECT_TYPE' );

		// Options 'anonymous' or 'user'.
		$this->set_trigger_type( 'anonymous' );

		// Sentence that appears in UI once selected (sentence with selectable blue boxes).
		$this->set_sentence(
			sprintf(
				/* translators: Trigger sentence */
				esc_attr__(
					'A pretty link of {{a specific redirect type:%1$s}} is created',
					'automator-sample'
				),
				$this->get_trigger_meta() // Returns string 'REDIRECT_TYPE'.
			)
		);

		// Sentence that appears in the trigger list drop down.
		$this->set_readable_sentence(
			esc_attr__(
				'A pretty link of {{a specific redirect type}} is created',
				'automator-sample'
			)
		);

		// The action hook to listen into. Pretty links invokes 'prli-create-link' with two arguments when a link is created.
		$this->add_action( 'prli-create-link', 10, 2 );

	}

	/**
	 * Prepares the option fields for our Trigger.
	 *
	 * This method should return an array<mixed[]> of fields.
	 *
	 * @link https://developer.automatorplugin.com/adding-a-custom-trigger-to-uncanny-automator/
	 *
	 * @return array<
	 *  array{
	 *      'input_type': string,
	 *      'option_code': string,
	 *      'label': string,
	 *      'required': boolean,
	 *      'options': array<array{'text': string, 'value': mixed}>,
	 *      'placeholder': string,
	 *      'options_show_id': boolean,
	 *    }
	 *  >
	 */
	public function options() {

		// For the purpose of readability. This are the options value passed into the $redirect_types_dropdown['options'].
		$options_value = array(
			array(
				'text'  => esc_attr_x( '301', 'Pretty Links redirect type: 301', 'automator-sample' ),
				'value' => 301,
			),
			array(
				'text'  => esc_attr_x( '302', 'Pretty Links redirect type: 302', 'automator-sample' ),
				'value' => 302,
			),
			array(
				'text'  => esc_attr_x( '307', 'Pretty Links redirect type: 307', 'automator-sample' ),
				'value' => 307,
			),
		);

		$redirect_types_dropdown = array(
			'input_type'      => 'select',
			'option_code'     => $this->get_trigger_meta(), // Returns string: 'REDIRECT_TYPE'. This option code should match the sentence above.
			'label'           => __( 'Redirect type', 'automator-sample' ),
			'required'        => true,
			'options'         => $options_value,
			'placeholder'     => __( 'Please select a post type', 'automator-sample' ),
			'options_show_id' => false, // Whether to show the option value in the dropdown.
		);

		return array(
			$redirect_types_dropdown,
		);
	}

	/**
	 * Validates the Trigger. This method would allow you to narrow down the execution of the Trigger.\
	 *
	 * For example, we only want to fire the Trigger if the redirect type is 302.
	 *
	 * @param array{'ID': int, 'post_status': string, 'meta': mixed[]} $trigger The arguments supplied by the Trigger itself.
	 * @param mixed[]                                                  $hook_args The action hook arguments passed into this method.
	 *
	 * @return bool
	 */
	public function validate( $trigger, $hook_args ) {

		// Fail the Trigger if $trigger is not of array type.
		if ( ! is_array( $trigger ) ) {
			return false;
		}

		// Fail the Trigger if the REDIRECT_TYpe is not set.
		if ( ! isset( $trigger['meta']['REDIRECT_TYPE'] ) ) {
			return false;
		}

		// The action hook 'prli-create-link' contains two arguments. The ID and the arguments.
		list( $id, $args ) = $hook_args;

		// Fail the trigger if incoming redirect type from action hook is not set.
		if ( ! isset( $args['redirect_type'] ) ) {
			return false;
		}

		return absint( $trigger['meta']['REDIRECT_TYPE'] ) === absint( $args['redirect_type'] );

	}

}
