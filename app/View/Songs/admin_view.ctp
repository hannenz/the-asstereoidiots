<?php
Configure::write('debug', 2);
debug ($song);
die();
?>
<h1><?php echo $song['Song']['title']; ?></h1>
<dl>
	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo $song['Song']['title']; ?></dd>
	<dt><?php echo __('Artist'); ?></dt>
	<dd><?php echo $song['Song']['artist']; ?></dd>
	<dt><?php echo __('Comment'); ?></dt>
	<dd><?php echo $song['Song']['comment']; ?></dd>
	<dt><?php echo __('Lyrics'); ?></dt>
	<dd><?php echo $song['Song']['lyrics']; ?></dd>
	<dt><?php echo __('Rating'); ?></dt>
	<dd><?php echo $this->element('rating', array('plugin' => 'rating', 'model' => 'Song', 'id' => $song['Song']['id']));?></dd>
	<dt><?php echo __('Tracks'); ?></dt>
	<dd>
		<ul>
			<?php foreach ($song['Track'] as $track): ?>
				<?php echo $this->Html->tag('li', $track['filename']); ?>
			<?php endforeach ?>
		</ul>
	</dd>
</dl>
<div style="clear:both"></div>

<ul class="actions">
	<?php
		echo $this->Html->tag('li', $this->Html->link(__('edit'), '/admin/songs/edit/'.$song['Song']['id']));
		echo $this->Html->tag('li', $this->Html->link(__('delete'), '/admin/songs/delete/'.$song['Song']['id'], array(), __('Are you sure?')));
		echo $this->Html->tag('li', $this->Html->link(__('Add track'), '/admin/tracks/add/'.$song['Song']['id']));
	?>
</ul>

<?php echo $this->element('backlink', array('admin' => true)); ?>

