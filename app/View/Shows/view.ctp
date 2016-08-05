<?php
// Inject 3d-party assets

/* FancyBox */
$this->Html->script('fancybox/source/jquery.fancybox.pack', array('inline' => false));
$this->Html->css('/js/fancybox/source/jquery.fancybox', null, array('inline' => false));

/* LeafletJs assets (map generation) */
$this->Html->css('http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css', null, array('inline' => false));
$this->Html->script(array(
		'http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js',
		'show_view.js'
	),
	 array('inline' => false)
);

$billThumb = !empty($show['Bill'][0]['files']['thumb'])
	? $show['Bill'][0]['files']['thumb']
	: '/img/defaultbill.jpg'
;
$bill = !empty($show['Bill'][0]['files']['full'])
	? $show['Bill'][0]['files']['full']
	: '/img/defaultbill.jpg'
;

$bands = array();
foreach ($show['Band'] as $band){
	$bands[] = (!empty($band['url'])) ? $this->Html->link($band['name'], $band['url']) : $band['name'];
}
?>

<div class="vevent">
	<?php #echo $this->Html->tag('h2', __('The Asstereoidiots live at %s %s', $show['Location']['name'], $show['Location']['city']), array('class' => 'summary')); ?>
	<?php 
	echo $this->Html->image($bill); 
	//echo $this->Html->link($this->Html->image($billThumb, array('class' => 'detailImage')), $bill, array('class' => 'fancybox', 'escape' => false)); ?>
	<dl id="showDetails">
		<dt><?php echo __('Date'); ?></dt>
		<dd class="dtstart" title="<?php echo $show['Show']['showtime']; ?>"><?php echo strftime('%d. %B %Y', strtotime($show['Show']['showtime'])); ?></dd>
		<?php
		$showtime = strftime('%H:%M', strtotime($show['Show']['showtime']));
		if ($showtime != "00:00"):?>
			<dt><?php echo __('Showtime');  ?></dt>
			<dd><?php echo $showtime ?></dd>
		<?php endif ?>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php
				echo $this->Html->div('location', sprintf('%s %s', $show['Location']['name'], $show['Location']['city']));
				echo $this->Html->div('street-address', join('<br>', array($show['Location']['address1'], $show['Location']['address2'])));
				echo $this->Html->div('locality', $show['Location']['full_city']);
				if (!empty($show['Location']['url'])){
					echo $this->Html->div('adr', $this->Html->link($show['Location']['url'], $show['Location']['url'], array('class' => 'extended-address')));
				}
			?>
		</dd>
		<?php
			if (count($bands) > 0){
				echo $this->Html->tag('dt', __('Rocking with'));
				echo $this->Html->tag('dd', $this->Text->toList($bands, 'and'));
			}
			if (!empty($show['Show']['comment'])){
				echo $this->Html->tag('dt', __('Comment'));
				echo $this->Html->tag('dd', nl2br($show['Show']['comment']));
			}

			$settings = Configure::read('settings');
			if ($settings['Setting']['enable_show_ratings'] > 0 && strtotime($show['Show']['showtime']) < time()){
				echo $this->Html->tag('dt', __('Rating'));
				echo $this->Html->tag('dd', $this->element('rating', array('plugin' => 'rating', 'model' => 'Show', 'id' => $show['Show']['id'])));
			}
			if (isset($show['Album']['id'])){
				echo $this->Html->tag('dt', __('Pictures'));
		?>
				<dd>
					<?php
					echo $this->Html->image(DS . 'files' . DS . 'Pictures' . DS . 'thumbs' . DS . $show['Album']['Picture'][0]['filename'], array('url' => array('controller' => 'albums', 'action' => 'view', $show['Album']['id'])));
					?>
				</dd>
		<?php
			}
			if ($show['Show']['setlist_public'] && isset($show['Setlist']['id'])){
				echo $this->Html->tag('dt', __('Setlist'));
				echo $this->Html->tag('dd', $this->element('setlist', array('tracks' => $setlist['Track'])));
			}
		?>
	</dl>

	<?php
		$loc = preg_replace('/\s{2,}/', ' ', trim (join (' ', array($show['Location']['name'], $show['Location']['address1'], $show['Location']['address2'], $show['Location']['zip'], $show['Location']['city']))));
		echo $this->Form->input(false, array('type' => 'hidden', 'id' => 'js-show-location', 'value' => urlencode($loc)));
	?>

</div>


<?php
echo $this->element('editdelete', array('name' => $show['User']['name'], 'date' => $show['Show']['created'], 'id' => $show['Show']['id'], 'controller' => 'shows'));
echo $this->element('comment', array('comments' => $show['Comment'], 'id' => $show['Show']['id']));
echo $this->element('backlink');
