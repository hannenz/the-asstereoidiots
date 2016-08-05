<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />

	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />
	<title>Rock'n'Roll Tram * 10th Anniversary & CD-Pre-Release * THE ASSTEREOIDIOTS</title>
	<?php
	echo $this->Html->css(array(
		'/tram/css/foundation.min',
		'/tram/css/app'
	));
	echo $this->Html->script(array(
		'/tram/js/modernizr.foundation'
	));
	echo $this->fetch('css');
	?>
	<!--[if lt IE 9]>
		<?php echo $this->Html->script('/tram/js/ie'); ?>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<!--[if lt IE 8]>
		<div style="background:yellow; color:#000000; font-size:18px;">Die Seite sieht scheisse aus? Versuchs doch mal mit Firefox, Vollidiot! <small>Tipp von Pixelfreunde Wodenau e.V</small></div>
	<![endif]-->
	<?php if ($ticketsLeft <= 0 && empty($isLoggedIn)): ?>
		<div id="soldout">Ausverkauft!</div>
	<?php endif; ?>

	<!-- container -->
	<header id="main-header">
		<div class="container">
			<div class="row" id="main-content">
				<div class="four columns">
					<a href="/tram">
						<div id="header" class="panel">
							<h1>Rock'n'Roll Tram</h1>
							<span class="with">with</span><br>
							<?php echo $this->Html->image('/tram/img/logo3.png', array('title' => 'THE ASSTEREOIDIOTS', 'alt' => 'THE ASSTEREOIDIOTS')); ?>
							<h3>10<sup>th</sup> Anniversary &amp; CD-Pre-Release</h3>
							<strong class="dtstart" title="2012-05-26T19:30:00+06:00">Sa, 26. Mai 2012 &middot; 19:30 Uhr</strong><br>
							<span class="location">Hbf Ulm &middot; Stra&szlig;enbahnhaltestelle</span><br>
							<?php echo $this->Html->image('/tram/img/stoerer.png', array('id' => 'stoerer')); ?>
						</div>
					</a>
				</div>
				<div class="eight columns">
					<div id="slider">
						<?php
						foreach (array('Ass_web_feier.jpg', 'photo2.jpg', 'photo5.jpg', 'photo4.jpg', 'photo7.jpg', 'Tram_Web_Ass.jpg', 'Tram_Web.jpg', 'Tram_Web_date.jpg') as $img){
							echo $this->Html->div('', $this->Html->image('/tram/img/'.$img));
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div id="main-content" class="container">
		<div id="FlashMessage" class="row">
			<?php echo $this->Session->flash(); ?>
		</div>
		<?php echo $content_for_layout; ?>
	</div>
	<footer id="main-footer">
		<div class="container">
			<div class="row">
				<div class="four columns">
					<h4>Brought to you by</h4>
					<ul class="sponsoring ">
						<li><?php echo $this->Html->image('/tram/img/flyfarm.png', array('alt' => 'Flyfarm Street Entertainment')); ?></li>
						<li><?php echo $this->Html->image('/tram/img/aufsmaul.png', array('alt' => 'Paar aufs Maul Mate-Bier', 'url' => 'http://paaraufsmaul.de/')); ?></li>
					</ul>
				</div>

				<div class="four columns">
					<h4>Impressum</h4>
					THE ASSTEREOIDIOTS<br>
					Johannes Braun<br>
					Berthold-Hupmann-Stra&szlig;e 50<br>
					D-88400 Biberach<br>
					<a href="mailto:info@the-asstereoidiots.de">info@the-asstereoidiots.de</a>
					<br>
					<br>
					Webdesign: Pixelfreunde Wodenau e.V.
				</div>
				<div class="four columns">
					<h4>Links</h4>
					<ul>
						<li><a href="http://www.the-asstereoidiots.de" target="_blank">THE ASSTEREOIDIOTS</a> Homepage</li>
						<li><a href="http://www.facebook.com/theasstereoidiots" target="_blank">Facebook</a> Band Page</li>
						<!--li><a href="#" target="_blank">Google+</a> Band Page</li-->
						<!--li><a href="#" target="_blank">Jamendo</a> Music Download</li-->
						<li><a href="http://www.myspace.com/5horserodeo" target="_blank">5 Horse Rodeo</a> Homepage</li>
						<li><a href="http://www.facebook.com/BTCHLFTR" target="_blank">Bitchlifter</a> Band Page</li>
						<li><a href="http://paaraufsmaul.de" target="_blank">Paar aufs Maul</a> Homepage</li>
						<li><a href="http://hemperium.de" target="_blank">Hemperium</a> Homepage</li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<div id="bottom">&nbsp;</div>
	<?php
	echo $this->Html->script(array(
		'/tram/js/jquery.min',
		'/tram/js/foundation.min',
		'/tram/js/app'
	));
	echo $scripts_for_layout;
	echo $this->fetch('script');
	?>
	<script>
		$(document).ready(function(){
			$('#slider').orbit({
				timer : true,
				directionalNav : true
			});
		});
	</script>
	<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
</body>
</html>
