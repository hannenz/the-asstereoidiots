<h1><?php echo __('Edit Release'); ?></h1>
<?php echo $this->Form->create('Release', array('action' => 'admin_edit', 'type' => 'file')); ?>
<fieldset>
	<legend><?php echo __('Release'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
		echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Release']['id']));
		echo $this->Form->input('title');
		echo $this->Form->input('comment');
		echo $this->Form->input('year');
		echo $this->UploaderForm->file('Cover');
		echo $this->Form->submit(__('save'));
	?>
</fieldset>
<fieldset>
	<legend><?php echo __('Tracks'); ?></legend>
	<?php echo $this->Html->tag('div', $this->element('tracklist', array('tracklist' => $tracklist)), array('id' => 'ReleaseTracklist')); ?>
	<?php echo $this->Html->link(__('Edit Tracklist'), '/admin/tracklists/edit/Release/'.$this->request->data['Release']['id']);?>
</fieldset>
<?php echo $this->Form->end();?>

<?php
echo $this->Html->css('uploader', null, array('inline' => false));
echo $this->Html->script(array(
	'jquery.html5_upload',
	'uploader'
));
echo $this->element('backlink', array('admin' => true));
ob_start();
?>
<script>
function on_update(){
	var data = $(this).sortable('serialize');
	$.post($('#base').html() + 'admin/tracks/reorder/' + $('#ReleaseId').val(), data, function(response){
		$('#ReleaseTracklist').html(response);
		$('.tracklist').sortable({ items : 'tr', update : on_update });
	});
}

$(document).ready(function(){
	$('.tracklist').sortable({
		items : 'tr',
		update : on_update
	});
});
</script>
<?php
$this->addScript(ob_get_contents(), false);
ob_end_clean();
?>
