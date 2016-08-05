<h1><?php echo __('Add Release'); ?></h1>
<?php echo $this->Form->create('Release', array('action' => 'admin_add', 'type' => 'file')); ?>
<fieldset>
	<legend><?php echo __('Release'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
		echo $this->Form->input('title');
		echo $this->Form->input('comment');
		echo $this->Form->input('year');
	?>
		<label for="ReleaseCover"><?php echo __('Cover'); ?></label>
	<?php
		echo $this->UploaderForm->file('Cover');
		echo $this->Form->submit(__('save'));
	?>
</fieldset>
<?php echo $this->Form->end();?>
<?php
echo $this->Html->css('uploader', null, array('inline' => false));
echo $this->Html->script(array(
	'jquery.html5_upload',
	'uploader'
));
echo $this->element('backlink', array('admin' => true));
?>
