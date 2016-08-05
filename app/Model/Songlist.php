<?php
class Songlist extends AppModel {
	var $name = 'Songlist';
	var $order = array('Songlist.pos' => 'ASC');
	var $actsAs = array('Containable');
	
	var $belongsTo = array(
		'Setlist' => array('foreignKey' => 'foreign_key'),
		'Song'
	);
}
?>
