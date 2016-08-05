<?php
	class Subscriber extends AppModel {
		var $name = 'Subscriber';
		var $validate = array(
			'email' => array(
				'validEmail' 	=> array('rule' => 'email',		'message' => 'Please enter a valid Email Address'	),
				'uniqueEmail' 	=> array('rule' => 'isUnique',	'message' => 'This Email has already subscribed'	)
			)
		);
	}
?>
