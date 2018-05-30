<fieldset>
	<legend><?php echo __('Jukebox'); ?></legend>
	<ul>
	<?php
		foreach ($playlist as $tracklist){
			echo $this->Html->tag('li', $this->Html->tag('h3', $tracklist['Track']['Song']['title']) . $this->Html->tag('audio', '', array(
				'src' => DS . 'files' . DS . 'Audiofiles' . DS . $tracklist['Track']['Audiofile'][0]['filename'],
				'controls' => 'controls',
			)));
		}
	?>
	</ul>
</fieldset>

<p><?php echo __('Visit The Asstereoidiots at %s for more music and album download', $this->Html->link('Jamendo', 'https://www.jamendo.com/artist/355897/the-asstereoidiots')); ?></p>


<fieldset>
	<legend><?php echo __('Releases'); ?></legend>
	<ul id="releasesList" class="float-list">
		<?php
		foreach ($releases as $release){
			echo $this->Html->tag('li',
				$this->Html->link(
					$this->Html->image($release['Cover'][0]['icon'], array('class' => 'left thumbnail')),
					array('controller' => 'releases', 'action' => 'view', $release['Release']['id']),
					array('title' => $release['Release']['title'], 'escape' => false)
				)
			);
		}
		?>
	</ul>
</fieldset>


<div id="release-content"></div>


<?php
echo $this->Html->css(array(
		'/js/mediaelement/build/mediaelementplayer.min',
		'/js/fancybox/source/jquery.fancybox'
	),
	null,
	array('inline' => false)
);
echo $this->Html->script(array(
		'mediaelement/build/mediaelement-and-player.min.js',
		'fancybox/source/jquery.fancybox.pack'
	),
	array('inline' => false)
);
ob_start();
?>
<script>
	$(document).ready(function(){
		$('#releasesList a').click(on_click);
		$('audio').mediaelementplayer();
		$('#releasesList a:first').click();

		function on_click(){
			$('#release-content').fadeOut();
			$.get($(this).attr('href'), function(response){
				$('#release-content').html(response);
				$('#release-content').fadeIn();
				$('.fancybox').fancybox({
					padding : 0
				});
			});
			return (false);
		}
	});
</script>
<?php 
$this->addScript(ob_get_contents(), false);
ob_end_clean();
?>

