<div class="release-detail">
	<h1><?php echo $release['Release']['title']; ?> (<?php echo $release['Release']['year']; ?>)</h1>
	<?php
	echo $this->Html->link($this->Html->image($release['Cover'][0]['files']['thumb'], array('class' => 'detailImage')), $release['Cover'][0]['files']['full'], array('escape' => false, 'class' => 'fancybox'));
	?>
	<p class="description"><?php echo nl2br($release['Release']['comment']); ?></p>
	<div style="clear:both"></div>
	<div class="release-tracklist">
		<!--h2><?php echo __('Tracklist'); ?></h2-->
		<?php echo $this->element('tracklist', array('tracklist' => $tracklist)); ?>
	</div>
	<?php echo $this->element('editdelete', array('controller' => 'releases', 'id' => $release['Release']['id'], 'name' => $release['User']['name'], 'date' => $release['Release']['created']));?>
	<?php echo $this->element('comment', array('comments' => $release['Comment'], 'id' => $release['Release']['id'])); ?>
</div>
