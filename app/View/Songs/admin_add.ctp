<h1><?php echo __('Add Song'); ?></h1>
<?php echo $this->Form->create('Song', array('action' => 'admin_add')); ?>
<fieldset>
<?php
	echo $this->Html->tag('legend', __('Song'));
	echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
	echo $this->Form->input('title');
	echo $this->Form->input('artist', array('default' => 'The Asstereoidiots'));
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
