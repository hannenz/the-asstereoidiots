<?php
echo $this->Form->create('User', array('admin_files', array('type' => 'file')));
echo $this->Form->input('User.id');
echo $this->Form->input('funcnum', array('value' => $funcNum));
echo $this->UploaderForm->file('UserFile', array('multiple' => true, 'element' => 'default_element'));
echo $this->Form->end();
ob_start();
?>
<script>
	$(document).ready(function(){
		var funcNum = $('#funcnum').val();
		$('.uploader-filename a').click(function(){
			var fileUrl = $(this).attr('href');
			window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
			window.close();
			return false;
		});
	});
</script>
<?php
$this->addScript(ob_get_contents(), false);
ob_end_clean();
?>
