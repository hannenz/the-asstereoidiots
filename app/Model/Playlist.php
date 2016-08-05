<?php
class Playlist extends AppModel {
	var $name = 'Playlist';
	var $hasMany = array(
		'Tracklist' => array(
			'foreignKey' => 'foreign_key',
			'order' => array('Tracklist.pos' => 'ASC'),
			'conditions' => array('Tracklist.model' => 'Playlist'),
		)
	);
}
?>
