<?php

class Post_Created_Sample_Trigger extends \Uncanny_Automator\Recipe\Trigger {

	/**
	 * Setups the Trigger properties.
	 *
	 * @link https://developer.automatorplugin.com/adding-a-custom-trigger-to-uncanny-automator/
	 * @return void
	 */
	protected function setup_trigger() {

		// Define the Trigger's info.
		$this->set_integration( 'PRETTY_LINKS' );
		$this->set_trigger_code( 'POST_CREATED_SAMPLE' );
		$this->set_trigger_meta( 'REDIRECT_TYPE' );
		$this->set_trigger_type( 'anonymous' );

		// Trigger sentence.
		$this->set_sentence(
			sprintf(
				esc_attr__(
					'A pretty link of {{a specific redirect type:%1$s}} is created',
					'automator-sample'
				),
				'REDIRECT_TYPE'
			)
		);

		$this->set_readable_sentence(
			esc_attr__(
				'A pretty link of {{a specific redirect type}} is created',
				'automator-sample'
			)
		);

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
	 *      'options_show_id': string,
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
			'option_code'     => 'REDIRECT_TYPE',
			'label'           => __( 'Redirect type', 'automator-sample' ),
			'required'        => true,
			'options'         => $options_value,
			'placeholder'     => __( 'Please select a post type', 'automator-sample' ),
			'options_show_id' => false,
		);

		return array(
			$redirect_types_dropdown,
		);
	}

	public function validate( $trigger, $hook_args ) {

		return true;
	}

}
