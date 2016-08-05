<?php
class Track extends AppModel {
	var $name = 'Track';

	var $actsAs = array(
		'Uploader.Uploadable' => array(
			'Audiofile' => array(
				'allow' => 'audio/*',
				'max' => 1,
				'files' => array(
					'Audiofile' => array(
						'path' => 'files/Audiofiles'
					)
				)
			)
		)
	);

	var $hasMany = array('Tracklist');

	var $belongsTo = array('User', 'Song');

	function beforeSave($options = Array()){
		$a = split(':', $this->data['Track']['length']);
		$m = 1;
		$seconds = 0;
		while ($n = array_pop($a)){
			$seconds += $n * $m;
			$m *= 60;
		}
		$this->data['Track']['length'] = $seconds;
		return (true);
	}

	function seconds2str($seconds){
		return (sprintf("%u:%02u", $seconds / 60, $seconds % 60));
	}
}
?>
