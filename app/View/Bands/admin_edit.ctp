<?php echo $this->Form->create('Band', array('action' => 'admin_edit'))?>
<fieldset>
	<legend><?php echo __('Edit Band'); ?></legend>
<?php
	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Band']['id']));
	echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
	echo $this->Form->input('name');
	echo $this->Form->input('url');
	echo $this->Form->input('contact');
	echo $this->Form->input('email');
	echo $this->Form->input('phone');
	echo $this->Form->submit();
?>
</fieldset>
<?php
	echo $this->Form->end();
	echo $this->element('backlink', array('admin' => true)); 
?>
