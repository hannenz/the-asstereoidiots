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
				'/dist/css/main'
			));

			echo $this->Html->script(array(
				'jquery.min.js'
			));
		?>
	</head>
	<body class="downloadcode">

		<div class="outer-container">
			<div class="container">
				<div class="main-content">
					<?php echo $content_for_layout; ?>
				</div>

				<footer class="main-footer">
					<nav class="footer-nav">
						<?php echo $this->Html->link ('Impressum', ['controller' => 'pages', 'action' => 'display', 'impressum']); ?>
						<?php echo $this->Html->link ('Datenschutz', ['controller' => 'pages', 'action' => 'display', 'privacy']); ?>
					</nav>
				</footer>
			</div>
		</div>
		
		<script src="/js/main.js"></script>
	</body>
</html>
