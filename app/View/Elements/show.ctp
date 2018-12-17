<?php
	$upcoming = strtotime($show['Show']['showtime']) >= time();
	//~ $settings = Configure::read('settings');
	$bands = array();
	foreach ($show['Band'] as $band){
		$bands[] = $band['name'];
	}
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
echo $this->Html->tag('div', $this->Html->image($bill), array('class' => 'list-item-image'));
?>
<div class="list-item-content">
	<h3><?php echo $this->Html->link(strftime('%x', strtotime($show['Show']['showtime'])) . ' ' . $show['Location']['full_name'], '/shows/'.$show['Show']['slug'], array('escape' => false)); ?></h3>
	<p class="news-body">
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
	</p>
</div>

