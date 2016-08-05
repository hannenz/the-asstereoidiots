<?php
class Comment extends AppModel {
	var $name = 'Comment';
	var $validate = array(
		'body' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter a message'
		),
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Please enter your name'
		),
		'email' => array(
			'rule' => 'email',
			'message' => 'Please enter a valid email address'
		),
		'captcha' => array(
			'rule' => '/(the )?(asstereoidiots)/i',
			'message' => 'Please type the bandname of the idiots'
		)
	);
	var $order = array('created' => 'DESC');
	
	public function beforeSave($options = Array()){
		return false;
	}
}
?>
