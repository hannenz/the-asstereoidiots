		<?php if ($video['Video']['type'] != 'youtube'):?>
			<video controls="controls" width="600" height="400" preload="none">
				<?php
				foreach ($video['Videofile'] as $videofile){
					echo $this->Html->tag('source', '', array(
						'type' => 'video/mp4',
						'src' => $videofile['files']['Videofile']
					));
				}
				?>
			<video>
		<?php else: ?>
			<?php echo $video['Video']['html']; ?>
		<?php endif ?>
<?php
//~ echo $this->Html->css(array(
		//~ '/js/mediaelement/build/mediaelementplayer'
	//~ ),
	//~ null,
	//~ array('inline' => false)
//~ );
//~ echo $this->Html->script(array(
		//~ 'mediaelement/build/mediaelement-and-player.min'
	//~ ),
	//~ array('inline' => false)
//~ );
?>

<?php #echo $this->Html->scriptBlock('$(document).ready(function(){$("video").mediaelementplayer({});});');?>
