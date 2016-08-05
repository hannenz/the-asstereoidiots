<?php
	echo $this->Html->tag('h1', $setlist['Setlist']['name']);
	echo $this->element('setlist', array('tracks' => $setlist['Track']));
	echo $this->element('backlink', array('admin' => true)); 
?>
