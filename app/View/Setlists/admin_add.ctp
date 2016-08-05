<?php
	echo $this->Form->create('Setlist', array('action' => 'admin_add'));
?>
<fieldset>
	<legend><?php echo $this->Html->tag('h1', __('Add setlist'));?> </legend>
<?php
	echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
	echo $this->Form->input('name');
	echo $this->Form->submit(__('save'));
?>
</fieldset>
<?php
	echo $this->Form->end();
	echo $this->element('backlink', array('admin' => true)); 
?>
