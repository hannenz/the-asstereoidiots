<?php
	$upcoming = strtotime($show['Show']['showtime']) >= time();
/*	$bands = array();
	foreach ($show['Band'] as $band){
		$bands[] = $band['name'];
	}
*/
	$bands = Set::extract('/Band/name', $show);

?>

<?php
$bill = '/img/defaultbill.jpg';
if (!empty($show['Bill'][0]['icon'])){
	$bill = $show['Bill'][0]['icon'];
}
else if (!empty($show['Bill'][0]['filename']) && file_exists(WWW_ROOT.'files'.DS.'Bills'.DS.$show['Bill'][0]['filename'])){
	$bill = DS . 'files' . DS. 'Bills' . DS . $show['Bill'][0]['filename'];
}

//$bill = !empty($show['Bill'][0]['icon']) ? $show['Bill'][0]['icon'] : '/img/defaultbill.jpg';
//echo $this->Html->tag('div', $this->Html->image($bill), array('class' => 'list-item-image'));
?>


<div class="show-teaser">
	<figure class="show-teaser__bill">
		<?php echo $this->Html->image($bill, array('url' => array('action' => 'detail', $show['Show']['id']))); ?>
	</figure>
	<div class="show-teaser__datetime">
		<span class="show-teaser__date"><?php echo strftime('%d. %B %Y', strtotime($show['Show']['showtime'])); ?></span>
	</div>
	<h3 class="show-teaser__title"><?php echo $this->Html->link($show['Location']['full_name'], array('action' => 'detail', $show['Show']['id'])); ?></h3>
	<div class="show-teaser__description">
		<?php
			if (count ($bands) > 0){
				echo "rocking with ".$this->Text->toList($bands, 'and');
				echo $this->Html->tag('br');
			}
			echo $this->Text->truncate(nl2br($show['Show']['comment']), 50, array('exact' => 'false', 'ending' => '&hellip;', 'html' => true));
			if (isset($show['Album']['id'])){
				echo $this->Html->link(__('Pictures available'), '/albums/view/'.$show['Album']['id'], array('class' => 'pictures-link'));
			}
		?>
	</div>		
</div>


