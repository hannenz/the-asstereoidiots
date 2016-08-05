<?php
class Tracklist extends AppModel {
	var $name = 'Tracklist';
	var $order = array('Tracklist.pos' => 'ASC');

	var $belongsTo = array(
		'Release' => array('foreignKey' => 'foreign_key'),
		'Playlist' => array('foreignKey' => 'foreign_key'),
		'Track'
	);
}
?>
