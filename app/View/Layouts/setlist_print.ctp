<!doctype html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->css(array(
			'setlist_print.css',
		));
		echo $scripts_for_layout;
	?>
</head>
<body>
	<?php echo $content_for_layout; ?>
</body>
</html>
