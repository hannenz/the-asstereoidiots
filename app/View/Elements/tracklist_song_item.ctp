<?php
	$song = $track['Song'];
	if (isset($track['Track'])){
		$song = $track['Song'];
		$track = $track['Track'];
	}
	$length = $track['length'];
	$id = $track['id'];
	$year = $track['date'];
	echo $this->Html->tag(
		'li',
		$song['title'] . ' (' . strftime('%Y', strtotime($year)) . ')'
		. $this->Html->tag('span', " [$length]", array('class' => 'song-length')),
		array(
			'id' => 'all_tracks_'.$id,
			'length' => $length
		)
	);
?>
