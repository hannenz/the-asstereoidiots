<div id ="UpcomingShows">
	<!--h2><?php echo __('Upcoming Shows'); ?></h2-->
	<ul class="item-list clearfix">
		<?php
			foreach ($upcomingShows as $show){
				echo $this->Html->tag('li', $this->element('show', array('show' => $show, 'upcoming' => true)));
			}
		?>
	</ul>
</div>

<h2><?php echo __('Accomplished Shows'); ?></h2>

<div id="loadme">
	<div id="loadme-inner">
		<?php echo $yearpager?>
		<br><br>
		<ul id="accomplishedShows" class="item-list clearfix">
		<?php foreach ($accomplishedShows as $show): ?>
			<li><?php echo $this->element('show', array('show' => $show, 'upcoming' => false))?></li>
		<?php endforeach ?>
		</ul>
		<?php echo $yearpager?>
	</div>
</div>

<?php ob_start();?>
<script>
function on_yearpager_clicked(){
	var href = $(this).attr('href');
	$('#loadme').fadeOut();
	$('#loadme').load(href + ' #loadme-inner', function(){
		$('.yearpager a').click(on_yearpager_clicked);
		$('#loadme').fadeIn();

	});
	return (false);
}

$(document).ready(function(){
	$('.yearpager a').click(on_yearpager_clicked);
});
</script>
<?php
$this->addScript(ob_get_contents(), false);
ob_end_clean();
?>
