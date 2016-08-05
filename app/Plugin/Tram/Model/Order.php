<?php
class Order extends TramAppModel {
	public $validate = array(
		'firstname' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'Gib bitte Deinen Vornamen an'
		),
		'lastname' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'Gib bitte Deinen Nachnamen an'
		),
		'address' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'Gib bitte Deine Adresse an'
		),
		'zip' => array(
			'rule' => '/^[0-9]{5}$/',
			'required' => true,
			'message' => 'Gib bitte eine g&uuml;ltige Postleitzahl an'
		),
		'city' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'Gib bitte Deine Stadt an'
		),
		'email' => array(
			'rule' => array('email', true),
			'required' => true,
			'message' => 'Gib bitte eine gültige E-Mail Adresse an'
		),
		'email2' => array(
			'rule' => 'confirmEmail',
			'required' => true,
			'message' => 'Bitte gib zwei mal die gleiche E-Mail Adresse ein'
		),
		'amount' => array(
			'rule' => array('between', 1, 5),
			'message' => 'Gib eine Zahl zwischen 1 und 5 ein'
		),
		'confirmed' => array(
			'required' => true,
			'rule' => array('equalTo', '1'),
			'message' => 'Du musst bestätigen, dass Du mit den Bedingungen einverstanden bist'
		)
	);

	public function confirmEmail($check){
		return ($this->data['Order']['email'] == $check['email2']);
	}

	public function beforeSave(){

		$time = substr((string)time(), -8);
		$ip = explode('.', (string)$_SERVER['REMOTE_ADDR'], 4);
		$code = sprintf('%s-%s%s%s%s', $time, $ip[0][0], $ip[1][0], $ip[2][0], $ip[3][0]);

		$this->data['Order']['code'] = $code;
		return true;
	}
}
