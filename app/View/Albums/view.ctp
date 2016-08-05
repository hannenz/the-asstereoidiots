<?php
echo $this->Html->css(array(
		'/js/fancybox/source/jquery.fancybox',
		'/js/fancybox/source/helpers/jquery.fancybox-thumbs',
		'/js/fancybox/source/helpers/jquery.fancybox-buttons'
	),
	null,
	array('inline' => false)
);
echo $this->Html->script(array(
		'fancybox/source/jquery.fancybox',
		'fancybox/source/helpers/jquery.fancybox-thumbs',
		'fancybox/source/helpers/jquery.fancybox-buttons',
		'fancybox/lib/jquery.mousewheel-3.0.6.pack'
	),
	array('inline' => false)
);

echo $this->Html->tag('h2', $album['Album']['name']);

foreach ($album['Picture'] as $pic){
	echo $this->Html->link(
		$this->Html->image($pic['files']['thumb']),
		($pic['files']['full']),
		array('class' => 'fancybox', 'rel' => 'gallery', 'escape' => false, 'title' => $pic['title'])
	);
}
?>

<div style="height:6em;"></div>
<?php if ($album['Album']['show_id'] > 0):?>
	<h3><?php echo __('This pictures where taken at the show:'); ?></h3>
	<ul class="item-list">
		<li>
		<?php
		$show = array(
			'Show' => array(
				'id' => $album['Show']['id'],
				'showtime' => $album['Show']['showtime'],
				'comment' => ''
			),
			'Bill' => $album['Show']['Bill'],
			'Location' => $album['Show']['Location'],
			'Band' => $album['Show']['Band']
		);
		echo $this->element('show', array('show' => $show));
		?>
		</li>
	</ul>
<?php endif ?>
<?php
echo $this->Html->link('<< '.__('Back'), array('action' => 'index'));
?>
<?php
ob_start();
?>
<script>
$(document).ready(function(){

	$('a.fancybox:not(:first)').hide()
	$('a.fancybox:first').before($('<p>Click on the thumbnail to start the slideshow</p>'));

	$('a.fancybox').fancybox({
		padding : 0,
		helpers : {
			title : {
				type : 'outside'
			},
			overlay : {
				opacity : 0.8
			},
			thumbs : {
				width : 50,
				height : 50
			},
			buttons : {
			}
		}
	});
});
</script>
<?php
$this->addScript(ob_get_contents(), false);
ob_end_clean();
?>
