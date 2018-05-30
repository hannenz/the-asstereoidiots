<!doctype html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $title_for_layout; ?>
		</title>
		<meta name="viewport" content="width=device-with,initial-scale=1,user-scalable=no" />
		<link href='//fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
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
		<link rel="stylesheet" media="only screen and (max-width: 800px)" href="/css/mobile.css" />
		<?php
			echo $this->Html->script(array(
				'jquery.min',
				'jquery-ui.custom.min',
				'jquery.form.cookie.min',
			));
			echo $scripts_for_layout;
		?>
<script>
$(document).ready(function(){

	var dashboard = $('#dashboard');
	var c = $.cookie('dashboard');

	if (c == null){
		c = 0;
		$.cookie('dashboard', c);

	}
	if (c == 0){
		dashboard.css({ 'bottom' : 0 });
	}
	else {
		dashboard.css({ 'bottom' : -200 });
	}

	$('#dashboard-trigger').click(toggleDashboard);

	var input = $('form :input:visible:enabled:first');
	if (input.attr('id') != 'CommentName'){
		input.focus();
	}

	if($('#socialshareprivacy').length > 0){
        $('#socialshareprivacy').socialSharePrivacy();
    }

    function toggleDashboard(){
		if (c > 0){
			dashboard.animate({ 'bottom' : 0 }, 250);
			c = 0;
		}
		else {
			dashboard.animate({ 'bottom' : -200}, 250);
			c = 1;
		}
		$.cookie('dashboard', c);
		return false;
	}


	// $('a#Login').click(function(){
	// 	var url = $(this).attr('href');
	// 	$.get(url, function(response){
	// 		var closeButton = $('<a href="#" id="loginBoxClose">close</a>');
	// 		var loginBox = $('<div id="loginBox"><div id="loginBoxContainer">'+response+'</div></div>');
	// 		var overlay = $('<div id="overlay" />');
	// 		overlay.append(loginBox);
	// 		closeButton.click(function(){ overlay.remove() }).prependTo(loginBox);
	// 		$('body').append(overlay);

	// 		$('#UserUsername').focus();

	// 		onFormSuccess();

	// 		function onFormSuccess(loginResponse, status, xhr, $form){

	// 			if (loginResponse && $(loginResponse).find('.flash-error-message').length == 0){
	// 				loginBox.remove();
	// 				location.reload();
	// 			}

	// 			loginBox.find('#UserLoginForm').ajaxForm({
	// 				beforeSubmit : function(){
	// 					$('#loginBoxContainer .flash-error-message').remove();
	// 				},
	// 				target : $('#loginBoxContainer'),
	// 				success : onFormSuccess
	// 			});
	// 		}
	// 	});
	// 	return false;
	// });

});
</script>
	</head>
	<body class="<?php echo $current; ?>">

		<div id="fb-root"></div>
		<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = 'https://connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.11&appId=502390706445153';
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
		<div id="container">
			<div id="header-wrapper">
				<?php if ($this->Session->check('Auth.User')):?>
					<div id="dashboard">
						<?php
							echo $this->Html->div('dashboard', $this->element('dashboard'));
							echo $this->Html->link(__('Dashboard'), '#', array('id' => 'dashboard-trigger'));
						?>
					</div>
				<?php endif ?>
				<div id="header">
					<?php $userId = $this->Session->read('Auth.User.id'); if (empty($userId)) echo $this->Html->link('login', '/login', array('id' => 'Login')); ?>
					<?php echo $this->Html->image('header.jpg'); ?>
					<h1>The Asstereoidiots</h1>
					<ul>
						<li><?php echo $this->Html->link('deutsch', '/lang/deu', array('class' => $current_language == 'deu' ? 'selected-language' : '')); ?></li>
						<li><?php echo $this->Html->link('english', '/lang/eng', array('class' => $current_language == 'eng' ? 'selected-language' : '')); ?></li>
					</ul>
				</div>
				<div id="nav">
					<ul>
						<?php echo $this->Html->tag('li', $this->Html->link(__('home'), '/', array('id' => 'home'))); ?>
						<?php echo $this->Html->tag('li', $this->Html->link(__('band'), '/band', array('id' => 'band'))); ?>
						<?php echo $this->Html->tag('li', $this->Html->link(__('shows'), '/shows', array('id' => 'shows'))); ?>
						<?php echo $this->Html->tag('li', $this->Html->link(__('pictures'), '/albums', array('id' => 'fotos'))); ?>
						<?php echo $this->Html->tag('li', $this->Html->link(__('music'), '/music', array('id' => 'music'))); ?>
						<?php echo $this->Html->tag('li', $this->Html->link(__('videos'), '/videos', array('id' => 'video'))); ?>
						<?php echo $this->Html->tag('li', $this->Html->link(__('contact'), '/contact', array('id' => 'contact'))); ?>
						<?php echo $this->Html->tag('li', $this->Html->link(__('links'), '/links', array('id' => 'links'))); ?>
					</ul>
				</div>
			</div>

			<div id="flash"><?php echo $this->Session->flash();?></div>

			<div id="content-wrap">
				<div id="content">
					<?php
					echo $content_for_layout;
					?>

				</div>
				<div id="sidebar">
					<?php if (count($upcoming_shows) > 0): ?>
						<div class="sideblock">
							<h2><?php echo __('Live'); ?></h2>
							<dl class="vevent">
								<?php foreach ($upcoming_shows as $show): ?>
									<dt class="dtstart" title="<?php echo $show['Show']['showtime']; ?>"><?php echo strftime('%x', strtotime($show['Show']['showtime'])); ?></dt>
									<dd>
										<?php
										echo $this->Html->div('summary', 'The Asstereoidiots live', array('style' => 'display:none'));
										echo $this->Html->div('location', $this->Html->link($show['Location']['full_name'], '/shows/'.$show['Show']['slug']));
										//echo $this->Html->link(__('more'), '/shows/view/'.$show['Show']['id']);
										?>
									</dd>
								<?php endforeach ?>
							</dl>
							<div style="clear:both"></div>
						</div>
					<?php endif ?>
					<div class="sideblock">
						<!--h2><?php echo __('Stay tuned'); ?></h2-->
						<ul class="sidebarlinks social">
							<li><?php echo $this->Html->link('rss', '/blog_posts/news.rss', array('title' => __('RSS feed: Tour dates, news and other stuff'), 'class' => 'social rss')); ?></li>
							<li><?php echo $this->Html->link('newsletter', '/subscribers/subscribe', array('title' => __('Subscribe to the newsletter'), 'class' => 'social newsletter')); ?></li>
							<li><?php echo $this->Html->link('jamendo', 'http://www.jamendo.com/de/artist/The_Asstereoidiots', array('title' => __('Free album and mp3 download on Jamendo'), 'class' => 'social jamendo')); ?></li>
							<li><?php echo $this->Html->link('facebook', 'http://listn.to/theasstereoidiots', array('title' => __('Facebook'), 'class' => 'social facebook')); ?></li>
							<li><?php echo $this->Html->link('google+', 'https://plus.google.com/105803995139839983242', array('title' => __('Google+'), 'class' => 'social googleplus')); ?></li>
						</ul>
					</div>
					<div class="sideblock">
					
						<!-- <div class="fb&#45;page" data&#45;href="https://www.facebook.com/theasstereoidiots/" data&#45;tabs="timeline" data&#45;width="238" data&#45;height="800" data&#45;small&#45;header="false" data&#45;adapt&#45;container&#45;width="true" data&#45;hide&#45;cover="false" data&#45;show&#45;facepile="true"><blockquote cite="https://www.facebook.com/theasstereoidiots/" class="fb&#45;xfbml&#45;parse&#45;ignore"><a href="https://www.facebook.com/theasstereoidiots/">THE ASSTEREOIDIOTS</a></blockquote></div> -->
					
						<!--
						<h2><?php echo __('Comments'); ?></h2>
						<ul class="comments">
							<?php foreach ($latest_comments as $comment):?>
							<li>
								<p class="news-body"><?php echo nl2br($this->Text->truncate($comment['Comment']['body'], 100, array('ending' => '&hellip;', 'exact' => false, 'html' => true))); ?> <?php echo $this->Html->link(__('more'), '/comments/view/'.$comment['Comment']['id']); ?></p>
								<p class="news-meta"><?php echo $comment['Comment']['name']; ?> | <?php echo $this->TimeL8n->niceShort($comment['Comment']['created']); ?></p>
							</li>
							<?php endforeach ?>
						</ul>
						<ul class="sidebarlinks">
							<?php echo $this->Html->tag('li', $this->Html->link(__('View all comments'), '/comments/index'), array('class' => 'view-comments')); ?>
							<?php echo $this->Html->tag('li', $this->Html->link(__('Leave a comment'), '/comments/add'), array('class' => 'add-comment')); ?>
						</ul>
						-->
					</div>
				</div>
			</div>

			<div id="footer">
				<div>
					&copy;2011 the asstereoidiots.de | <?php echo $this->Html->link('CakePHP', 'http://cakephp.org') . ' v' . Configure::version(); ?> | <?php echo $this->Html->link('hannenz.de', 'http://www.hannenz.de'); ?> webdesign &amp; programmierung | <?php echo $this->Html->link('impressum', '/impressum'); ?>
				</div>
				<a href="https://plus.google.com/105803995139839983242" rel="publisher">Google+</a> <a href="https://www.facebook.com/theasstereoidiots">Facebook</a> | <?php echo $this->Html->link('Datenschutz', array('controller' => 'pages', 'action' => 'display', 'privacy', 'admin' => false)); ?>
			</div>
		</div>
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
