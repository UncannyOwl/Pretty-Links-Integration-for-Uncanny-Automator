<?php
/**
 * Holds the class \Uncanny_Automator\Pretty_Links\Trigger\Tokens_Example_Create_Link_Action
 *
 * Demonstrates how you can define and parse Tokens that are comming from Triggers.
 *
 * @package Uncanny_Automator\Pretty_Links\Trigger
 *
 * @since 1.0.0
 */

namespace Uncanny_Automator\Pretty_Links\Action;

/**
 * This class handles the Action definition and processing of Action: \
 * "Create a pretty link with {{a specific target URL}} (with tokens example)"
 *
 * @link https://developer.automatorplugin.com/create-a-custom-automator-integration/ Integration
 * @link https://developer.automatorplugin.com/adding-a-custom-action-to-uncanny-automator/ Actions
 *
 * @package Uncanny_Automator\Pretty_Links\Trigger
 *
 * @version
 */
class Tokens_Example_Create_Link_Action extends \Uncanny_Automator\Recipe\Action {

	/**
	 * Let us defined the Action Tokens here. Use the method 'define_tokens'.
	 *
	 * The method process_action will decide when and how this Action tokens values are populated.
	 *
	 * Scroll down a bit, and see the method process_action. Look for '$this->hydrate_tokens'.
	 *
	 * @return array<string[]>
	 */
	public function define_tokens() {
		// The method define_tokens must return an assoc array containing the token definitions.
		return array(
			// The key here is our Action Token ID.
			'LINK_ID' => array(
				// The name of the Action Token that appears in the token selector.
				'name' => __( 'Link ID', 'automator-sample' ),
				// Can be url, text, int, email.
				'type' => 'int',
			),
		);
	}

	/**
	 * Setups the action basic properties like Integration, Sentence, etc.
	 *
	 * @return void
	 */
	protected function setup_action() {

		// Specifies the integration of the Action. Must be unique.
		$this->set_integration( 'PRETTY_LINKS' );

		// Unique trigger code. You may declare the value as a class constant, up to you.
		$this->set_action_code( 'TOKEN_EXAMPLE_PRETTY_LINKS_CREATE_LINK' );

		// Reuseable trigger meta, can be used as the ID of a field OR group of fields.
		$this->set_action_meta( 'TOKEN_EXAMPLE_PRETTY_LINKS_CREATE_LINK_META' );

		// This action does not require a user. Remove this if your action requires a user.
		$this->set_requires_user( false );

		// Sentence that appears in the trigger list drop down.
		$this->set_sentence(
			sprintf(
				/* translators: Action sentence */
				esc_attr__(
					'Create a pretty link with {{a specific target URL:%1$s}} (with token example)',
					'automator-sample'
				),
				'TARGET_URL:' . $this->get_action_meta()
			)
		);

		// Sentence that appears in the trigger list drop down.
		$this->set_readable_sentence( esc_attr__( 'Create a pretty link with {{a specific target URL}} (with token example)', 'automator-sample' ) );

	}

	/**
	 * Defines the options.
	 *
	 * @return array<array{
	 *  'text': string,
	 *  'value': mixed
	 * }>
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

		// The "Redirect title" field.
		$field_redirect_title = array(
			'input_type'  => 'text',
			'option_code' => 'TITLE',
			'label'       => __( 'Title', 'automator-sample' ),
			'required'    => true,
		);

		// The "Redirect type" field.
		$field_redirect_types = array(
			'input_type'      => 'select',
			'option_code'     => $this->get_action_meta(), // Returns string: 'REDIRECT_TYPE'. This option code should match the sentence above.
			'label'           => __( 'Redirect type', 'automator-sample' ),
			'required'        => true,
			'options'         => $options_value,
			'placeholder'     => __( 'Please select a post type', 'automator-sample' ),
			'options_show_id' => false, // Whether to show the option value in the dropdown.
		);

		// The "Target URL" field.
		$field_target_url = array(
			'input_type'  => 'url',
			'option_code' => 'TARGET_URL', // Returns string: 'REDIRECT_TYPE'. This option code should match the sentence above.
			'label'       => __( 'Target URL', 'automator-sample' ),
			'description' => __( 'This is the URL that your Pretty Link will redirect to.', 'automator-sample' ),
			'required'    => true,
		);

		return array(
			$field_redirect_title,
			$field_redirect_types,
			$field_target_url,
		);

	}

	/**
	 * Processes the action.
	 *
	 * @link https://developer.automatorplugin.com/adding-a-custom-action-to-uncanny-automator/ Processing the action.
	 *
	 * @param int     $user_id The user ID. Use this argument to passed the User ID instead of get_current_user_id().
	 * @param mixed[] $action_data The action data.
	 * @param int     $recipe_id The recipe ID.
	 * @param mixed[] $args The args.
	 * @param mixed[] $parsed The parsed variables.
	 *
	 * @return bool True if the action is successful. Returns false, otherwise.
	 */
	protected function process_action( $user_id, $action_data, $recipe_id, $args, $parsed ) {

		$params = array();
		// The "Redirect title" value.
		$title = isset( $parsed['TITLE'] ) ? sanitize_text_field( $parsed['TITLE'] ) : '';
		// The "Redirect type" value.
		$redirect_type = isset( $parsed[ $this->get_action_meta() ] ) ? sanitize_text_field( $parsed[ $this->get_action_meta() ] ) : '';
		// The "Target URL" value.
		$target_url = isset( $parsed['TARGET_URL'] ) ? esc_url_raw( $parsed['TARGET_URL'] ) : '';

		if ( ! class_exists( '\PrliLink' ) ) {
			$this->add_log_error( 'Class \PrliLink is not found. Make sure Pretty Links plugin is installed and activated.' );
			return false; // Return false if error ocurred during the action completion.
		}

		$prli = new \PrliLink();

		// Assign values to the $pretty_link_values assoc array that will be passed to the PrliLink::create() method later.
		$params['name']          = $title;
		$params['slug']          = $prli->generateValidSlug();
		$params['url']           = $target_url;
		$params['redirect_type'] = $redirect_type;

		// Pass the constructured array of $params.
		$pretty_link_id = $prli->create( $params );

		if ( ! empty( $pretty_link_id ) ) {
			// Time to hydrate the action tokens.
			// Populate the custom token value.
			$this->hydrate_tokens(
				array(
					'LINK_ID' => $pretty_link_id, // The 'LINK_ID' is defined in define_tokens method above.
				)
			);
			return true; // Success. Action will be completed.
		}

		$this->add_log_error( 'Pretty Link was not able to create a URL. Please check PHP error log for possible reason.' );
		return false;

	}

}
