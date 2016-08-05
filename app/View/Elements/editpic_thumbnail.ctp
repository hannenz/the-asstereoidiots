<?php
	echo $this->Html->tag(
		'li',
		$this->Html->image('gallery' . DS . 'thumbnails' . DS . $pic['Pic']['filename'], array('class' => 'smallThumbnail')),
		array('id' => 'pictures_' . $pic['Pic']['id'])
	);
?>
