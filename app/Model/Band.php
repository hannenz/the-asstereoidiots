<?php
	App::uses('AppModel', 'Model');

	class Band extends AppModel {

		var $actsAs = array('Containable');

		var $belongsTo = array('User');

		var $hasAndBelongsToMany = array(
			'Show'
		);

		var $validate = array(
			'name' => array(
				'rule' => 'notEmpty'
			),
			'email' => array(
				'rule' => 'email',
				'required' => false,
				'allowEmpty' => true,
				'message' => 'enter a valid email address'
			),
			'url' => array(
				'rule' => 'url',
				'required' => false,
				'allowEmpty' => true,
				'message' => 'enter a valid url'
			)
		);
	}
?>
