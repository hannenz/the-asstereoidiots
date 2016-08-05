<?php
class Release extends AppModel {
	var $name = 'Release';
	var $actsAs = array(
		'Uploader.Uploadable' => array(
			'Cover' => array(
				'max' => 1,
				'allow' => 'image/*',
				'files' => array(
					'full' => array(
						'path' => 'files/Covers',
						'action' => array(
							'Image' => array(
								'resize' => array('width' => '1200')
							)
						)
					),
					'thumb' => array(
						'path' => 'files/Covers/thumbs',
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

	var $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
		)
	);
	var $order = array(
		'Release.year' => 'DESC'
	);
	var $belongsTo = array('User');
	var $hasMany = array(
		'Tracklist' => array(
			'foreignKey' => 'foreign_key',
			'order' => array('Tracklist.pos' => 'ASC'),
			'conditions' => array('Tracklist.model' => 'Release')
		),
		'Comment' => array(
			'conditions' => array('Comment.model' => 'Release'),
			'foreignKey' => 'foreign_key',
			'order' => array('Comment.created' => 'DESC'),
			'dependent' => true
		)
	);

	function beforeDelete($cascade = true){
		$release = $this->read(null, $this->id);
		@unlink(WWW_ROOT . 'img' . DS . 'covers' . DS . $release['Release']['cover']);
		return (true);

		foreach ($release['Tracklist'] as $tracklist){
			$this->Tracklist->delete($tracklist['id']);
		}
		return (true);
	}
}
?>
