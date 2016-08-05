
<?php
	echo $this->Html->tag('h1', __('New album'));
	echo $this->Form->create('Album', array('action' => 'add', 'type' => 'file'));
	echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
?>
<label for="data[Album][show_id]">Connect Show</label>
<?php
	echo $this->Form->select('show_id', $shows, array('label' => __('Connect show')));
	echo $this->Form->input('name', array('label' => __('Name')));


	echo $this->UploaderForm->file('Picture', array('multiple' => true));

	echo $this->Form->end(__('submit'));
	echo $this->element('backlink', array('admin' => true));

	echo $this->Html->script(array(
			'jquery.html5_upload',
			'uploader'
		),
		array('inline' => false)
	);
	echo $this->Html->css('uploader', null, array('inline' => false));
?>

<?php ob_start(); ?>
<script>
$(document).ready(function(){
	$('#AlbumShowId').change(function(){
		var name = $('#AlbumName');
		var value = $('#AlbumShowId option:selected').text();

		name.val(value);
	});
});
</script>
<?php
$this->addScript(ob_get_contents(), false);
ob_end_clean();
?>
