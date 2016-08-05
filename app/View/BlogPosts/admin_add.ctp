<h1><?php echo __('Add Post'); ?></h1>
<p>So ihr Kabatrinker. Ab jetzt kann man zu einem Blogpost auch ein Bild hochladen. Lobet und preiset den Programmierer!!</p>
<?php echo $this->Form->create('BlogPost', array('action' => 'admin_add', 'type' => 'file')); ?>
<fieldset>
	<legend><?php echo __('Post'); ?></legend>
<?php
	echo $this->Form->input('subject');
	echo $this->Form->input('body', array('rows' => 10));
//	echo $this->Form->input('upload', array('type' => 'file', 'label' => __('Upload picture', true	)));
	echo $this->Form->input('newsletter', array('type' => 'checkbox', 'label' => __('Send newsletter')));
	echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
	echo $this->Form->submit('Absenden');
?>
</fieldset>

<?php
	echo $this->Form->end();
	echo $this->element('backlink', array('admin' => true));
?>

<?php
	echo $this->Html->script(array(
			'ckeditor/ckeditor',
			'ckeditor/adapters/jquery'
		),
		array('inline' => false)
	);
	?>
<script>
	$(document).ready(function(){
		CKEDITOR.config.toolbar = 'Basic';
		CKEDITOR.config.toolbar_Basic = [
			{
				name : 'mytoolbar',
				items : [
					'Bold', 'Italic', 'Underline', 'RemoveFormat', '-',
					'NumberedList', 'BulletedList', '-',
					'Image', 'Link'
				]
			}
		];
		$('#BlogPostBody').ckeditor({
			toolbar : 'Basic',
			filebrowserBrowseUrl : '/admin/users/files',
			filebrowserUploadUrl : '/uploader/uploads/add/User/UserFile/' + $('#BlogPostUserId').val() + '/default_element'
		});
	});
</script>
