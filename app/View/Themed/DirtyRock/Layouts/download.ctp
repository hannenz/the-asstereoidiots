<!doctype html>
<html class="no-js" lang="de">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>[DirtyiRock] <?php echo $title_for_layout; ?></title>
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

			echo $this->Html->script(array(
				'jquery.min.js'
			));
		?>
	</head>
	<body class="downloadcode">

		<div class="outer-container">
			<div class="container">
					<?php echo $this->Session->flash (); ?>
				<div class="main-content">
					<?php echo $content_for_layout; ?>
				</div>

				<footer class="main-footer">
					<p class="info">Probleme beim Download? Mail an <a href="mailto:info@the-asstereoidiots.de">info@the-asstereoidiots.de</a></p>
					<nav class="footer-nav">
						<?php echo $this->Html->link ('Impressum', ['controller' => 'pages', 'action' => 'display', 'impressum']); ?>
						<?php echo $this->Html->link ('Datenschutz', ['controller' => 'pages', 'action' => 'display', 'privacy']); ?>
					</nav>
				</footer>
			</div>
		</div>
		
		<?php echo $this->Html->script ('/dist/js/main.min', []); ?>
		<script>

		var gaProperty = 'UA-61857113-1';
		var disableStr = 'ga-disable-' + gaProperty;
		if (document.cookie.indexOf(disableStr + '=true') > -1) {
		  window[disableStr] = true;
		}
		function gaOptout() {
		  document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
		  window[disableStr] = true;
		}

		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-61857113-1', 'auto');
		ga('set', 'anonymizeIp', true);
		ga('send', 'pageview');

		</script>
	</body>
</html>
