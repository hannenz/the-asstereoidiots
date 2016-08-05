<?php echo $this->Html->tag('h1', __('Edit Video')); ?>
<?php echo $this->Form->create('Video', array('action' => 'admin_edit', 'type' => 'file')); ?>
<fieldset>
	<?php
		echo $this->Html->tag('legend', __('Info'));
		echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Video']['id']));
		echo $this->Form->input('type', array('type' => 'hidden'));
		echo $this->Form->input('title');
		echo $this->Form->input('comment');
	?>
</fieldset>
<fieldset>
		<?php
		echo $this->Html->tag('legend', __('Video source'));
		if ($this->request->data['Video']['type'] == 'youtube'){
			echo $this->Form->input('html');
		}
		else if ($this->request->data['Video']['type'] == 'upload'){
			echo $this->UploaderForm->file('Videofile');
		}
		else if ($this->request->data['Video']['type'] == 'file'){
			echo $this->Form->input('filename');
		}
		echo $this->Form->submit(__('save'));
?>
</fieldset>
<?php
echo $this->Form->end();
echo $this->element('backlink', array('admin' => true));
echo $this->Html->css(array(
		'uploader'
	),
	null,
	array('inline' => false)
);
echo $this->Html->script(array(
		'jquery.html5_upload',
		'uploader'
	),
	array('inline' => false)
);

?>
