<!doctype html>
<html class="no-js" lang="de">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			[Dirty] <?php echo $title_for_layout; ?>
		</title>
		<meta name="viewport" content="width=device-with,initial-scale=1,user-scalable=no" />
		<?php
			echo $this->Html->meta('icon');
			echo $this->Html->meta('keywords', 'asstereoidiots,band,rock\'n\'roll,assrock,punkrock');
			echo $this->Html->meta('description', 'The Asstereoidiots - High Powered Hellfired Assrock Punk\'n\'Roll');
			echo $this->Html->meta(array('name' => 'author', 'content' => 'hannenz webdesign und programmierung'));
			echo $this->Html->meta(array('name' => 'publisher', 'content' => 'The Asstereoidiots'));
			echo $this->Html->meta(array('name' => 'copyright', 'content' => 'The Asstereoidiots'));
			echo $this->Html->meta(array('name' =>'content-language', 'content' => 'DE'));
			echo $this->Html->meta(array('name'  => 'robots', 'content' => 'INDEX,FOLLOW'));
			echo $this->Html->meta(array('name' => 'revisit-after', 'content' => '1 week'))."\n";
			echo $this->Html->meta(array('property' => 'og:title', 'content' => $og_title));
			echo $this->Html->meta(array('property' => 'og:site_property', 'content' => 'The Asstereoidiots'));
			echo $this->Html->meta(array('property' => 'og:type', 'content' => $og_type));
			echo $this->Html->meta(array('property' => 'og:url', 'content' => $og_url));
			echo $this->Html->meta(array('property' => 'og:image', 'content' => $og_image));
			echo $this->Html->meta(array('property' => 'og:description', 'content' => $og_description));

	 	echo $this->Html->css(array(
				'/dist/css/main.css'
			));
		?>
		<?php
			// echo $this->Html->script(array(
			// 	'jquery.min',
			// 	'jquery-ui.custom.min',
			// 	'jquery.form.cookie.min',
			// ));
			// echo $scripts_for_layout;
		?>
	</head>
	<body>
		<div class="intro">
		</div>

		<div class="logo" style="background-image:url(/img/logo.svg);"></div>

		<nav class="main-nav">
			<?php echo $this->Html->link ('Shows', ['controller' => 'shows', 'action' => 'index']); ?>
			<?php echo $this->Html->link ('Band', ['controller' => 'pages', 'action' => 'display', 'band']); ?>
			<?php echo $this->Html->link ('Media', ['controller' => 'media', 'action' => 'index']); ?>
			<?php echo $this->Html->link ('Contact', ['controller' => 'pages', 'action' => 'display', 'contact']); ?>
		</nav>

		<div class="container">
			<?php //echo $this->Session->flash (); ?>
			<?php echo $content_for_layout; ?>
		</div>
		
		<script src="/dist/js/main.min.js"></script>
	</body>
</html>
