<!doctype html>
<html class="no-js" lang="de">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $title_for_layout; ?>
		</title>
		<meta name="viewport" content="width=device-with,initial-scale=1,user-scalable=no" />
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
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
				'normalize',
				'main'
			));
		?>
		<link rel="stylesheet" media="(max-width: 800px)" href="/css/mobile.css" />
		<?php
			echo $this->Html->script(array(
				'jquery.min',
				'jquery-ui.custom.min',
				'jquery.form.cookie.min',
			));
			echo $scripts_for_layout;
		?>
	</head>
	<body>
		<!-- <div class="intro"> -->
		<!-- </div> -->

		<div class="logo" style="background-image:url(/img/logo.svg);"></div>

		<nav class="main-nav">
			<a href="#shows">Shows</a>
			<a href="#">Band</a>
			<a href="#">Media</a>
			<a href="#">Contact</a>
		</nav>

		<section id="shows">
			<div class="container">
<?php echo $this->Session->flash (); ?>
				<?php echo $content_for_layout; ?>
			</div>
		</section>
		
		<script src="/js/main.js"></script>
	</body>
</html>
