<h1><?php echo __('Edit Comment'); ?></h1>
<?php echo $this->Form->create('Comment', array('action' => 'admin_edit'))?>
<fieldset>
	<legend><?php echo __('Comment'); ?></legend>
	<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Comment']['id'])); ?>
	<?php echo $this->Form->input('name', array('label' => __('Name'))); ?>
	<?php echo $this->Form->input('email', array('label' => __('E-Mail'))); ?>
	<?php echo $this->Form->input('body', array('label' => __('Comment'))); ?>
	<?php echo $this->Form->submit(__('Submit comment'));?>
</fieldset>
<?php echo $this->Form->end(); ?>

<?php echo $this->element('backlink', array('admin' => true)); ?>
