<?php
	$length = $song['Song']['length'];

	echo $this->Html->tag(
		'li',
		$song['Song']['title']
		. $this->Html->tag('span', " [$length]", array('class' => 'song-length')),
		array(
			'id' => 'all_songs_'.$song['Song']['id'],
			'length' => $length,
			'class' => "songlist-item"
		)
	);
?>
