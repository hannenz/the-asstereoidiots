<ul id="albums-index">
	<?php foreach ($albums as $album):?>
		<li>
			<?php echo $this->Html->image($album['Picture'][0]['files']['thumb'], array('url' => array('action' => 'view', $album['Album']['id']))); ?>
			<?php echo $this->Html->link($album['Album']['name'], array('action' => 'view', $album['Album']['id'])); ?>
			<p class="news-meta"><?php echo __('%u pictures', count($album['Picture'])); ?></p>
		</li>
	<?php endforeach ?>
</ul>
