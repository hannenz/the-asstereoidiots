<?php
class Song extends AppModel {
	var $name = 'Song';
	var $actsAs = array(
		'Containable'
	);

	var $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
		)
	);

	var $belongsTo = array('User');
	var $order = array('Song.title' => 'ASC');
	var $hasMany = array(
		'Comment' => array(
			'conditions' => array('Comment.model' => 'Track'),
			'order' => array('Comment.created' => 'DESC'),
			'foreignKey' => 'foreign_key',
			'dependent' => true
		),
		'Track' => array(
			'foreignKey' => 'song_id',
		),
		'Songlist'
	);

	function beforeSave($options = Array()){
		$a = split(':', $this->data['Song']['length']);
		$m = 1;
		$seconds = 0;
		while ($n = array_pop($a)){
			$seconds += $n * $m;
			$m *= 60;
		}
		$this->data['Song']['length'] = $seconds;
		return (true);
	}

	function afterFind($results, $primary = false){
		if (!isset($results[0])){
			return ($results);
		}
		if (count($results) > 0){
			foreach ($results as $key => $result){
				if (isset($result['Song']['length'])){
					if ($result['Song']['length'] == 0){
						if(isset($result['Audiofile']) && count($result['Audiofile']) > 0){
							$results[$key]['Song']['length'] = $result['Audiofile'][0]['length'];
						}
						else {
							$this->Track->recursive = -1;
							$tracks = $this->Track->find('all', array(
								'conditions' => array(
									'Track.song_id' => $result['Song']['id']
								)
							));
							if (isset($tracks[0])){
								$results[$key]['Song']['length'] = $tracks[0]['Track']['length'];
							}
							else {
								$results[$key]['Song']['length'] = '00:00';
							}
						}
					}
					else{
						$results[$key]['Song']['length'] = $this->seconds2str($result['Song']['length']);
					}
				}
				else if (isset($result['length'])){
					$results[$key]['length'] = $this->seconds2str($result['length']);
				}
			}
		}
		$this->Track->recursive = 1;
		return ($results);
	}

	function seconds2str($seconds){
		return (sprintf("%02u:%02u", $seconds / 60, $seconds % 60));
	}
}
?>
