<h1><?php echo __('Add Link');?></h1>

<?php echo $this->Form->create('Link', array('action' => 'admin_add')); ?>
<fieldset>
	<legend><?php echo __('Link'); ?></legend>
<?php
	echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
	echo $this->Form->input('name');
	echo $this->Form->input('url');
	echo $this->Form->input('description');
	echo $this->Form->submit('save');
?>
</fieldset>
<?php
	echo $this->Form->end();
	echo $this->element('backlink', array('admin' => true));
?>
