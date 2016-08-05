<?php
class Setlist extends AppModel {
	var $name = 'Setlist';

	var $actsAs = array('Containable');

	var $belongsTo = array('User');
	var $hasMany = array(
		'Songlist' => array(
			'foreignKey' => 'foreign_key',
			'order' => array('Songlist.pos' => 'ASC'),
		)
	);
	var $validate = array(
		'name' => array(
			'rule' => 'notEmpty'
		)
	);

	function beforeDelete($cascade = true){
		$setlist = $this->read(null, $this->id);
		foreach ($setlist['Songlist'] as $songlist){
			$this->Songlist->delete($songlist['id']);
		}
		return (true);
	}
}
?>
