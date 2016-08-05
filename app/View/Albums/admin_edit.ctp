<?php
	echo $this->Html->tag('h2', __('Edit album'));
	echo $this->Form->create('Album', array('action' => 'edit'));
	echo $this->Form->input('Album.id');
?>
	<label for="data[Album][show_id]">Connect Show</label>
<?php
	echo $this->Form->select('show_id', $shows);
	echo $this->Form->input('name', array('label' => __('Name')));

	echo $this->UploaderForm->file('Picture', array('multiple' => true));
	echo $this->Form->submit(__('Delete selected pictures'), array('name' => 'uploader_delete'));
	echo $this->Form->submit(__('Save Album'));
	echo $this->Form->end();
	echo $this->element('backlink', array('admin' => true));
	echo $this->Html->tag('p', $this->Html->link(__('View album'), '/albums/view/'. $this->request->data['Album']['id'], array('class' => 'button')));

	echo $this->Html->script(array(
			'jquery.html5_upload',
			'uploader'
		),
		array('inline' => false)
	);
	echo $this->Html->css('uploader', null, array('inline' => false));


?>
