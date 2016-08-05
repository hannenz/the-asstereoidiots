<h1><?php echo __('Edit Song'); ?></h1>
<?php echo $this->Form->create('Song', array('action' => 'admin_edit')); ?>
<fieldset>
<?php
	echo $this->Html->tag('legend', __('Song'));
	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Song']['id']));
	echo $this->Form->input('title');
	echo $this->Form->input('artist');
	echo $this->Form->input('lyrics');
	echo $this->Form->input('comment');
	echo $this->Form->input('length');
	echo $this->Form->submit(__('save'));
?>
</fieldset>
<?php
	echo $this->Form->end();
	echo $this->element('backlink', array('admin' => true));
?>
