<?php echo $this->Form->create('Location', array('action' => 'admin_add'))?>
<fieldset>
	<legend><?php echo __('Add Location'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id'))); 
		echo $this->Form->input('name');
		echo $this->Form->input('address1');
		echo $this->Form->input('address2');
		echo $this->Form->input('country');
		echo $this->Form->input('zip');
		echo $this->Form->input('city');
		echo $this->Form->input('contact');
		echo $this->Form->input('phone1');
		echo $this->Form->input('phone2');
		echo $this->Form->input('email');
		echo $this->Form->input('url');
		echo $this->Form->submit(__('save')); 
	?>
</fieldset>

<?php echo $this->element('backlink', array('admin' => true)); ?>
