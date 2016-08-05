<?php

class User extends AppModel {
	var $name = 'User';

	var $actsAs = array(
		'Containable',
		'Uploader.Uploadable' => array(
			'UserFile' => array(
				'files' => array(
					'file' => array(
						'path' => 'files/UserFiles'
					)
				)
			),
			'Portrait' => array(
				'max' => 1,
				'allow' => array('image/*'),
				'files' => array(
					'Portrait' => array(
						'path' => 'files/Portraits',
						'action' => array(
							'Image' => array(
								'resize' => array(
									'width' => 300
								)
							)
						)
					)
				)
			)
		)
	);
	var $hasMany = array(
		'EventUser'
	);
	var $hasAndBelongsToMany = array(
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'message_id',
			'joinTable' => 'messages_users',
			'order' => array('Message.created' => 'DESC')
		)
	);
}
?>
