<h1><?php echo __('Add track'); ?></h1>

<?php echo $this->Form->create('Track', array('action' => 'admin_add', 'type' => 'file'));?>
<fieldset>
	<legend><?php echo __('Upload track'); ?></legend>
	<?php
	echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
	echo $this->Form->input('song_id', array('value' => $song_id, 'empty' => true));
	echo $this->Form->input('newsong', array('label' => __('New song')));
	echo $this->UploaderForm->file('Audiofile', array('element' => 'track'));
	echo $this->Form->input('length');
	echo $this->Form->input('date', array('type' => 'text'));
	echo $this->Form->submit(__('save'));
	?>
</fieldset>
<?php
echo $this->Form->end();
echo $this->element('backlink', array('admin' => true));
echo $this->Html->scriptBlock('$(document).ready(function(){ $("#TrackDate").datepicker({ dateFormat : "yy-mm-dd", changeYear : true }); });');
?>

<?php
echo $this->Html->css(array(
	'uploader',
	'Aristo/Aristo'
), null, array('inline' => false));
echo $this->Html->script(array(
		'jquery.html5_upload',
		'uploader'
		), array('inline' => false)
);
ob_start();
?>
<script>
$(document).ready(function(){
	var tns = $('#TrackNewsong').parents('div.input');

	$('#TrackSongId').change(function(){
		if ($(this).val() == 0){
			tns.show();
		}
		else {
			tns.hide();
		}
	}).trigger('change');
});
</script>
<?php
$this->addScript(ob_get_contents(), false);
ob_end_clean();
?>
