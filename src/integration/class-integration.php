<?php
namespace Uncanny_Automator\Pretty_Links\Integration;

class Integration extends \Uncanny_Automator\Integration {

	protected function setup() {

		$this->set_integration( 'PRETTY_LINKS' );
		$this->set_name( 'Pretty Links' );
		$this->set_icon_url(
			UNCANNY_AUTOMATOR_PRETTY_LINKS_URL
			. 'assets/images/pretty-links-icon.svg'
		);

	}
}
