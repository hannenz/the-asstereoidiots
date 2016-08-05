<?php
	class Link extends AppModel {
		var $name = 'Link';
		var $belongsTo = array('User');
		var $validate = array(
			'name'	=> array(
				'rule' => 'notEmpty'
			),
			'url'	=> array(
				'rule' => 'url'
			)
		);
	}
?>
