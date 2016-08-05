<h1><?php echo __('Add Video'); ?></h1>

<?php echo $this->Form->create('Video', array('action' => 'admin_add', 'type' => 'file')); ?>
<fieldset>
	<legend><?php echo __('Video'); ?></legend>
	<?php echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id'))); ?>
	<?php echo $this->Form->input('title');?>
	<?php echo $this->Form->input('comment'); ?>
</fieldset>
<fieldset><legend><?php echo __('Type'); ?></legend>
	<?php echo $this->Form->input('type', array('type' => 'select', 'options' => array('upload' => 'Upload', 'youtube' => 'YouTube', 'file' => 'File')));?>
	<br>
	<?php echo $this->Form->input('html', array('label' => __('Embedd Youtube HTML'))); ?>
	<?php echo $this->UploaderForm->file('Videofile'); ?>
	<?php echo $this->Form->input('Video.filename', array('label' => __('Register an FTP-uploaded file'))); ?>
	<?php echo $this->Form->submit(__('save')); ?>
</fieldset>
<?php echo $this->Form->end();?>

<?php echo $this->element('backlink', array('admin' => true)); ?>

<?php
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
ob_start();
?>
<script type="text/javascript">
function foo(){
	switch($('#VideoType').val()){
		case 'youtube':
			$('#VideoHtml').parents('div.input').show();
			$('div.input.uploader.file').hide();
			$('#VideoFilename').parents('div.input').hide();
			break;
		case 'upload':
			$('#VideoHtml').parents('div.input').hide();
			$('div.input.uploader.file').show();
			$('#VideoFilename').parents('div.input').hide();
			break;
		case 'file':
			$('#VideoHtml').parents('div.input').hide();
			$('div.input.uploader.file').hide();
			$('#VideoFilename').parents('div.input').show();
			break;
	}
}

$(document).ready(function(){
	foo();
	$('#VideoType').change(function(){
		foo();
	});

});
</script>
<?php
$this->addScript(ob_get_contents(), false);
ob_end_clean();
?>
