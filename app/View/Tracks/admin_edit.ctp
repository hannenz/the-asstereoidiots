<h1><?php echo __('Edit Track'); ?></h1>

<?php echo $this->Form->create('Track', array('action' => 'admin_edit', 'type' => 'file'));?>
<fieldset>
	<legend><?php echo __('Track'); ?></legend>
	<?php
	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Track']['id']));
	echo $this->Form->input('song_id', array('value' => $song_id));

	echo $this->UploaderForm->file('Audiofile', array('element' => 'track'));

	echo $this->Form->input('Track.length');
	echo $this->Form->input('Track.date', array('type' => 'text'));
	echo $this->Form->submit(__('save'));
	?>
</fieldset>
<?php
echo $this->Form->end();
echo $this->element('backlink', array('admin' => true));
echo $this->Html->scriptBlock('$(document).ready(function(){ $("#TrackDate").datepicker({ dateFormat : "yy-mm-dd", changeYear : true }); });');
?>
