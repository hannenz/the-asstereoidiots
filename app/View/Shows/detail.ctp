<?php
$bill = '/img/bills/default.jpg';
if (!empty($show['Show']['bill'])){
	if (file_exists(IMAGES.'bills' . DS . $show['Show']['bill'])){
		$bill = '/img/bills/'.$show['Show']['bill'];
	}
}
$bands = array();
foreach ($show['Band'] as $band){
	$bands[] = (!empty($band['url'])) ? $this->Html->link($band['name'], $band['url']) : $band['name'];
}
?>

<?php echo $this->Html->link($this->Html->image($bill, array('class' => 'detailImage')), $bill, array('class' => 'divbox', 'escape' => false)); ?>

<dl id="showDetails">
	<dt><?php echo __('Showtime'); ?></dt>
	<dd><?php echo strftime('%x', strtotime($show['Show']['showtime'])); ?></dd>
	<dt><?php echo __('Location'); ?></dt>
	<dd>
		<?php
			echo $show['Location']['name'];
			if (!empty($show['Location']['address1'])) echo '<br>' . $show['Location']['address1'];
			if (!empty($show['Location']['address2'])) echo '<br>' . $show['Location']['address2'];
			echo '<br>' . $show['Location']['full_city'];
			if (!empty($show['Location']['url'])) echo '<br>' . $this->Html->link($show['Location']['url'], $show['Location']['url']);
		?>

		<?php
			$loc = '';
			if (!empty ($show['Location']['address1'])) {
				$loc .= $show['Location']['address1'];
			}
			if (!empty ($show['Location']['address2'])) {
				$loc .= $show['Location']['address2'];
			}
			if (!empty ($show['Location']['zip'])) {
				$loc .= $show['Location']['zip'];
			}
			if (!empty ($show['Location']['city'])) {
				$loc .= $show['Location']['city'];
			}
			echo $this->Html->para($loc);
		?>
		<? if (!empty ($loc)):?>
			<iframe class="show-location-map" width="300" height="300" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyByDxt9so1IK9NumRWGQmSUHbtLNMHZqF8&q=<?php echo $loc; ?>"></iframe>
		<?php endif ?>
	</dd>
	<?php
		if (count($bands) > 0){
			echo $this->Html->tag('dt', __('Rocking with'));
			echo $this->Html->tag('dd', $this->Text->toList($bands, 'and'));
		}
		if (!empty($show['Show']['comment'])){
			echo $this->Html->tag('dt', __('Comment'));
			echo $this->Html->tag('dd', $show['Show']['comment']);
		}

		$settings = Configure::read('settings');
		if ($settings['Setting']['enable_show_ratings'] > 0 && strtotime($show['Show']['showtime']) < time()){
			echo $this->Html->tag('dt', __('Rating'));
			echo $this->Html->tag('dd', $this->element('rating', array('plugin' => 'rating', 'model' => 'Show', 'id' => $show['Show']['id'])));
		}
		if (isset($album)){
			echo $this->Html->tag('dt', __('Pictures'));
			echo $this->Html->tag('dd', $this->element('albumteaser', array('album' => $album)));
		}
		if ($show['Show']['setlist_public'] && isset($show['Setlist']['id'])){
			echo $this->Html->tag('dt', __('Setlist'));
			echo $this->Html->tag('dd', $this->element('setlist', array('tracks' => $setlist['Track'])));
		}
	?>
</dl>


<div style="clear:both; height:3em;/*border-bottom:1px solid #ccc; */"></div>




<?php echo $this->element('editdelete', array('name' => $show['User']['username'], 'date' => $show['Show']['created'], 'id' => $show['Show']['id'], 'controller' => 'shows'))?>

<?php if (strtotime($show['Show']['showtime']) <= mktime()): ?>
	<?php echo $this->element('comment', array('comments' => $show['Comment'], 'id' => $show['Show']['id'])); ?>
<? endif ?>
<?php echo $this->element('backlink'); ?>


<script type="text/javascript">
$(document).ready(function(){
	$('a.divbox').divbox();
});
</script>
