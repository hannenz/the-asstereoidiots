
<?php echo $this->Form->create('User', array('action' => 'login')); ?>

<fieldset>
	<legend><?php echo __('Login'); ?></legend>
	<?php
				echo $this->Session->flash();
				echo $this->Session->flash('auth');
	echo $this->Form->input('username', array('label' => __('Username')));
	echo $this->Form->input('password', array('label' => __('Password')));
	echo $this->Form->input('auto_login', array('type' => 'checkbox', 'checked' => 'checked', 'label' => __('Remember me?')));
	echo $this->Form->submit(__('login'));
	?>
</fieldset>
<?php echo $this->Form->end();?>
<?php echo $this->Html->scriptBlock('$("#UserUsername").focus();'); ?>
