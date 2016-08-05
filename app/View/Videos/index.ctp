<ul id="videosList">
	<?php foreach ($videos as $video):?>
		<li>
			<?php
			$img = $this->Html->image(
				count($video['Videofile']) > 0 ? $video['Videofile'][0]['icon'] : 'default.jpg',
				array('class' => 'poster')
			);
			echo $this->Html->link($img, array('controller' => 'videos', 'action' => 'view', $video['Video']['id']), array('title' => $video['Video']['title'], 'escape' => false));
			?>
			<h4><?php echo $video['Video']['title']; ?></h4>
			<p><?php echo $video['Video']['comment']; ?></p>
		</li>
	<?php endforeach ?>
</ul>


<div style="clear:both; height:3em;"></div>

<div id="video-content"></div>


<?php
echo $this->Html->css(array(
		'/js/fancybox/source/jquery.fancybox',
		'/js/mediaelement/build/mediaelementplayer'
	),
	null,
	array('inline' => false)
);
echo $this->Html->script(array(
		'fancybox/source/jquery.fancybox.pack',
		'mediaelement/build/mediaelement-and-player.min'
	),
	array('inline' => false)
);
ob_start();
?>
<script type="text/javascript">
$(document).ready(function(){
	$('#videosList li a').fancybox({
		type : 'ajax',
		scrolling : 'no',
		afterShow : function(){
			$('video').mediaelementplayer();
		}
	});
});
</script>
<?php
$this->addScript(ob_get_contents(), false);
ob_end_clean();
?>
