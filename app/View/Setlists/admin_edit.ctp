<?php
	echo $this->Form->create('Setlist', array('action' => 'admin_edit'));
?>
<fieldset>
	<legend><?php echo __('Edit Setlist'); ?></legend>
<?php
	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Setlist']['id']));
	echo $this->Form->input('name');
	echo $this->Form->submit(__('save'));
?>
</fieldset>
<?php echo $this->Form->end(); ?>
<fieldset><legend><?php echo __('Songlist'); ?></legend>
<?php echo $this->element('setlist', array('setlist' => $this->request->data['Songlist'])); ?>
</fieldset>
<?php echo $this->Html->tag('p', $this->Html->link(__('Edit Songlist'), '/admin/songlists/edit/'.$this->request->data['Setlist']['id'])); ?>

<?php echo $this->element('backlink', array('admin' => true)); ?>
