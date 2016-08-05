<?php
class EmailConfig {

	public $default = array(
		'transport' => 'Mail',
		'host' => 'smtp.1und1.de',
		'username' => 'noreply@the-asstereoidiots.de',
		'password' => 'fucksys',
		'port' => 25,
		'timeout' => 30
	);

	public function __construct() {
		if (Configure::read('Production') === false) {
			$this->default['transport'] = 'Smtp';
		}
	}
}