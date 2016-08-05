<?php echo $this->Html->link(__('Upload files'), array('controller' => 'users', 'action' => 'upload_files', $funcNum, 'admin' => true), array('id' => 'upload-link'))	; ?>
<table>
	<caption><?php echo $title ?></caption>
	<thead>
		<?php
		echo $this->Html->tableHeaders(array(
			__('Icon'),
			__('Filename'),
			__('Size'),
			__('Type'),
			__('User')
		));
		?>
	</thead>
	<tbody>
		<?php
		foreach ($files as $file){
			echo $this->Html->tableCells(array(
				$this->Html->link(
					$this->Html->image($file['icon']),
					$file['files']['file'],
					array('target' => '_blank', 'class' => 'browser-select-link', 'escape' => false)
				),
				$this->Html->link($file['name'], $file['files']['file'], array('target' => '_blank', 'class' => 'browser-select-link')),
				$this->Number->toReadableSize($file['size']),
				$file['type'],
				$file['User']['name']
			));
		}
		?>
	</tbody>
</table>
<?php echo $this->Form->input('funcnum', array('type' => 'hidden', 'value' => $funcNum));?>
<script>
	$(document).ready(function(){
		var funcNum = $('#funcnum').val();
		$('.browser-select-link').click(function(){
			var fileUrl = $(this).attr('href');
			window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
			window.close();
			return false;
		});

		$('#upload-link').click(function(){
			$('body').load($(this).attr('href'));
			return false;
		});
	});
</script>
