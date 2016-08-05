<?php
	echo $this->Form->create('Tracklist', array('action' => 'admin_add'));
	echo $this->Form->input('Tracklist.model', array('type' => 'select', 'options' => array('Release' => 'Release', 'Setlist' => 'Setlist', 'Playlist' => 'Playlist')));
	echo $this->Form->input('Song.id', array('type' => 'select', 'options' => $songs));
	echo $this->Form->input('foreign_key', array('type' => 'select', 'options' => $releases));
	echo $this->Form->input('Tracklist.pos');
	echo $this->Form->end('save');
?>
