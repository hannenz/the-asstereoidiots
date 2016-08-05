<?php
class Order extends AppModel {
	public $validate = array(
		'firstname' => array(
			'rule' => 'notEmpty',
			'required' => true
		),
		'lastname' => array(
			'rule' => 'notEmpty',
			'required' => true
		),
		'address' => array(
			'rule' => 'notEmpty',
			'required' => true
		),
		'zip' => array(
			'rule' => '/^[0-9]{5}$/',
			'required' => true
		),
		'city' => array(
			'rule' => 'notEmpty',
			'required' => true
		),
		'email' => array(
			'rule' => array('email', true),
			'required' => true
		),
		'pieces' => array(
			'rule' => array('between', 1, 3)
		)
	);
}
