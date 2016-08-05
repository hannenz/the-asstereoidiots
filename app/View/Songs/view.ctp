<h1><?php echo $song['Song']['title']; ?></h1>
<p><?php echo nl2br($song['Song']['lyrics']); ?></p>
<ul>
	<?php foreach ($song['Track'] as $track) {
		echo $this->Html->tag('li', $track['filename']);
	}
	?>
</ul>
<?php echo $this->element('backlink'); ?>
