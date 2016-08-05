<h1><?php echo __('Edit User');?></h1>

<?php echo $this->Form->create('User', array('action' => 'admin_edit')); ?>
<fieldset>
	<legend><?php echo __('User'); ?></legend>
<?php
	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['User']['id']));
	echo $this->Form->input('username');
	echo $this->Form->input('name');
	echo $this->Form->input('face');
	echo $this->Form->input('email');
	echo $this->Form->input('notifyme');
?>
</fieldset>
<?php
	echo $this->Form->end();
	echo $this->element('backlink', array('admin' => true));
?>
