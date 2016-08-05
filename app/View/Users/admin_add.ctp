<h1><?php echo __('Add User');?></h1>

<?php echo $this->Form->create('User', array('action' => 'admin_add')); ?>
<fieldset>
	<legend><?php echo __('User'); ?></legend>
<?php
	echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
	echo $this->Form->input('username');
	echo $this->Form->input('password');
	echo $this->Form->input('password2');
	echo $this->Form->input('name');
	echo $this->Form->input('face');
	echo $this->Form->input('email');
	echo $this->Form->input('notifyme', array(
		'type' => 'checkbox'
	));
?>
</fieldset>
<?php
	echo $this->Form->end(__('Save'));
	echo $this->element('backlink', array('admin' => true));
?>
