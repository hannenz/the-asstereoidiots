<!doctype html>
<html>
	<head>
		<title><?php echo __('Filebrowser'); ?></title>
		<?php
		echo $this->Html->charset();
		echo $this->Html->css(array(
			'filebrowser',
			'uploader'
		));
		echo $this->Html->script(array(
			'jquery.min',
			'jquery-ui.custom.min',
			'jquery.html5_upload',
			'uploader'
		));
		echo $scripts_for_layout;
		?>

	</head>
	<body>
		<?php echo $content_for_layout; ?>
	</body>
</html>

