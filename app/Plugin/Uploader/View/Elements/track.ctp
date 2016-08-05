<?php
	echo $this->Form->input(null, array(
		'type' => 'checkbox',
		'label' => false,
		'value' => $upload['id'],
		'name' => 'uploadsToDelete[]',
		'hiddenField' => false,
		'id' => false
	));
	echo $this->Html->image($upload['icon'], array('class' => 'track-icon'));
	echo $this->Html->div('track-filename', $upload['name']);
	echo $this->Html->div('track-size', $this->Number->toReadableSize($upload['size']));
	echo $this->Html->div('track-type', $upload['type']);
?>
<ul class="uploader-list-actions">
	<li><?php echo $this->Html->link(__('edit'), array('plugin' => 'uploader', 'controller' => 'uploads', 'action' => 'edit', $upload['id'], 'admin' => false), array('title' => __d('uploader', 'Edit this upload'), 'class' => 'uploader-list-edit')); ?></li>
	<li><?php echo $this->Html->link(__('up'), array('plugin' => 'uploader', 'controller' => 'uploads', 'action' => 'move', $upload['id'], -1, 'admin' => false), array('title' => __d('uploader', 'Move up'), 'class' => 'uploader-list-up')); ?></li>
	<li><?php echo $this->Html->link(__('down'), array('plugin' => 'uploader', 'controller' => 'uploads', 'action' => 'move', $upload['id'], 1, 'admin' => false), array('title' => __d('uploader', 'Move down'), 'class' => 'uploader-list-down')); ?></li>
	<li><?php echo $this->Html->link(__('delete'), array('plugin' => 'uploader', 'controller' => 'uploads', 'action' => 'delete', $upload['id'], 'track', 'admin' => false), array('title' => __d('uploader', 'Delete this upload'), 'class' => 'uploader-list-delete'), __d('uploader', 'Do you really want to delete this upload?')); ?></li>
</ul>
