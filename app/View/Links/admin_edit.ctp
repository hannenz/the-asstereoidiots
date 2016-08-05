<h1><?php echo __('Edit Link');?></h1>

<?php echo $this->Form->create('Link', array('action' => 'admin_edit')); ?>
<fieldset>
	<legend><?php echo __('Link'); ?></legend>
<?php
	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Link']['id']));
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
