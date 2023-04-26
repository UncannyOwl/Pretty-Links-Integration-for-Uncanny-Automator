<?php
/**
 * Holds the class \Uncanny_Automator\Pretty_Links\Trigger\class Tokens_Example_Redirect_Of_Specific_Type_Created_Trigger extends \Uncanny_Automator\Recipe\Trigger {
 *
 * Demonstrate how you can define and parse Tokens that are comming from Triggers.
 *
 * @package Uncanny_Automator\Pretty_Links\Trigger
 *
 * @since 1.0.0
 */

namespace Uncanny_Automator\Pretty_Links\Trigger;

/**
 * This class handles the Trigger definition and validation of Trigger: \
 * "A pretty link of {{a specific redirect type}} is created (with tokens example)"
 *
 * Demonstrate how you can define and parse Tokens that are comming from a specific Trigger.
 *
 * @link https://developer.automatorplugin.com/create-a-custom-automator-integration/ Integration
 * @link https://developer.automatorplugin.com/adding-a-custom-trigger-to-uncanny-automator/ Triggers
 * @link https://developer.automatorplugin.com/adding-a-custom-trigger-to-uncanny-automator#passing-data-via-tokens Tokens
 *
 * @package Uncanny_Automator\Pretty_Links\Trigger
 *
 * @version 1.0.0
 */
class Tokens_Example_Redirect_Of_Specific_Type_Created_Trigger extends \Uncanny_Automator\Recipe\Trigger {

	/**
	 * Defines the tokens for this Trigger. We are not yet parsing this tokens, we are just allowing it to be
	 * displayed in the UI. If you have lots of Triggers, it might make sense to create a new function, class,
	 * anonymous return function, or a file that returns an array of tokens.
	 *
	 * The most important thing is that you return the tokens with the following format specified in the @param
	 * $tokens doc of this method.
	 *
	 * @param array<array{'value': string, 'integration': string, 'meta': mixed[], 'recipe_id':integer, 'triggers_meta':mixed[]}> $trigger The Trigger arguments.
	 *
	 * @param mixed[]                                                                                                             $tokens Empty array if no existing tokens attached to the same Trigger, otherwise the existing tokens. See @return for token format.
	 *
	 * @return array<
	 *  array{
	 *      'tokenId': string,
	 *      'tokenName': string,
	 *      'tokenType': string
	 *  }>
	 */
	public function define_tokens( $trigger, $tokens ): array {

		// Push 'Redirect ID' token.
		$tokens[] = array(
			'tokenId'   => 'REDIRECT_ID',
			'tokenName' => __( 'Redirect ID', 'automator-sample' ),
			'tokenType' => 'int', // Token type can be 'text', 'int', 'email', 'url'.
		);

		// Push 'Redirect URL' token.
		$tokens[] = array(
			'tokenId'   => 'REDIRECT_URL',
			'tokenName' => __( 'Redirect URL', 'automator-sample' ),
			'tokenType' => 'url',
		);

		// Finally, return the tokens. Don't forget this step.
		return $tokens;

	}

	/**
	 * Populate the tokens with actual values when a trigger runs.
	 *
	 * @param mixed[] $trigger The Trigger args.
	 * @param mixed[] $hook_args The accepted action hook arguments.
	 *
	 * @return mixed[]
	 */
	public function hydrate_tokens( $trigger, $hook_args ) {

		list( $redirect_id, $args ) = $hook_args;

		// Tokens values is a list of {{tokenId}} => {{the value you want to give}}.
		$token_values = array(
			'REDIRECT_ID'  => $redirect_id, // 'REDIRECT_ID' refers to the first token we defined in the define_tokens method.
			'REDIRECT_URL' => isset( $args['url'] ) ? $args['url'] : '', // 'REDIRECT_URL' refers to the second token we defined in the define_tokens method.
		);

		return $token_values;

	}

	/**
	 * Setups the Trigger properties.
	 *
	 * @link https://developer.automatorplugin.com/adding-a-custom-trigger-to-uncanny-automator/
	 *
	 * @return void
	 */
	protected function setup_trigger() {

		// Unique integration code.
		$this->set_integration( 'PRETTY_LINKS' );

		// Unique trigger code.
		$this->set_trigger_code( 'TOKENS_EXAMPLE_REDIRECT_OF_SPECIFIC_TYPE_CREATED' );

		// Reuseable trigger meta, can be used as the ID of a field OR group of fields.
		$this->set_trigger_meta( 'REDIRECT_TYPE' );

		// Options 'anonymous' or 'user'.
		$this->set_trigger_type( 'anonymous' );

		// Sentence that appears in UI once selected (sentence with selectable blue boxes).
		$this->set_sentence(
			sprintf(
				/* translators: Trigger sentence */
				esc_attr__(
					'A pretty link of {{a specific redirect type:%1$s}} is created (with tokens example)',
					'automator-sample'
				),
				$this->get_trigger_meta() // Returns string 'REDIRECT_TYPE'.
			)
		);

		// Sentence that appears in the trigger list drop down.
		$this->set_readable_sentence(
			esc_attr__(
				'A pretty link of {{a specific redirect type}} is created (with tokens example)',
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
