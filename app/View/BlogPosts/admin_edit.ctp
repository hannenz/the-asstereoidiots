<h1><?php echo __('Edit Post'); ?></h1>
<?php echo $this->Form->create('BlogPost', array('action' => 'admin_edit')); ?>
<fieldset>
	<legend><?php echo __('Post'); ?></legend>
<?php
	echo $this->Form->input('User.id', array('value' => $this->Session->read('Auth.User.id')));
	echo $this->Form->input('subject');
	echo $this->Form->input('body', array('rows' => 10));
	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['BlogPost']['id']));
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
					'Image', 'Link', '_',
					'Source'
				]
			}
		];

		$('#BlogPostBody').ckeditor({
			toolbar : 'Basic',
			filebrowserBrowseUrl : '/admin/users/files/image',
			filebrowserUploadUrl : '/uploader/uploads/add/User/UserFile/' + $('#UserId').val() + '/default_element',
			filebrowserWindowWidth : 400
		});
	});
</script>
