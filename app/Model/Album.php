<?php
	class Album extends AppModel {
		var $name = 'Album';

		var $actsAs = array(
			'Containable',
			'Uploader.Uploadable' => array(
				'Picture' => array(
					'allow' => array('image/jpeg', 'image/png', 'image/gif'),
					'files' => array(
						'full' => array(
							'path' => 'files/Pictures',
							'action' => array(
								'Image' => array(
									'resize' => array(
										'width' => 1000
									)
								)
							)
						),
						'thumb' => array(
							'path' => 'files/Pictures/thumbs',
							'action' => array(
								'Image' => array(
									'crop',
									'resize' => array(
										'width' => 100
									)
								)
							)
						)
					)
			)
				)
		);

		var $belongsTo = array(
			'User',
			'Show'
		);

		var $validate = array(
			'name' => array(
				'rule' => 'notEmpty'
			)
		);

		var $order = array(
			'Album.created' => 'DESC'
		);
	}
?>
