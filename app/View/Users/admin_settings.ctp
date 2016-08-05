<h1>Settings for <?php echo $this->Session->read('Auth.User.name');?></h1>
<?php
	echo $this->Form->create('User', array('action' => 'admin_settings', array('type' => 'file')));
?>
<fieldset><legend><?php echo __('General settings'); ?></legend>
<?php
	echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $this->request->data['User']['id']));
	echo $this->Form->input('User.name');
	echo $this->Form->input('User.username');
	echo $this->Form->input('User.email');
	echo $this->Form->input('User.notifyme', array('type' => 'checkbox', 'label' => __('Send Email notifications')));
	echo $this->Form->submit(__('Save settings'));
?>
</fieldset>
<fieldset>
	<legend><?php echo __('Portrait'); ?></legend>
	<?php echo $this->UploaderForm->file('Portrait'); ?>
</fieldset>
<fieldset>
	<legend><?php echo __('Files'); ?></legend>
	<?php echo $this->UploaderForm->file('UserFile', array('multiple' => true)); ?>
</fieldset>
<?php
	echo $this->Form->end();
?>

<?php echo $this->Form->create('User', array('action' => 'admin_change_password')); ?>
<fieldset><legend><?php echo __('Change password'); ?></legend>
<?php
	echo $this->Form->input('User.id', array('type' => 'hidden', 'value' => $this->request->data['User']['id']));
	echo $this->Form->input('User.pw1', array('type' => 'password', 'label' => __('New password')));
	echo $this->Form->input('User.pw2', array('type' => 'password', 'label' => __('Repeat new password')));
	echo $this->Form->submit(__('Change password'));
?>
</fieldset>
<?php
	echo $this->Form->end();
	echo $this->Html->css('uploader', null, array('inline' => false));
	echo $this->Html->script(array(
			'uploader',
			'jquery.html5_upload'
		),
		array('inline' => false)
	);
?>
