<? if (isset($result)): ?>
	<? if (count($result) > 0): ?>
		<h3><?php echo __('Locations in the database')?></h3>
		<ul>
		<? foreach ($result as $location){
				$loc = $location['Location']['name'].' '.$location['Location']['country'].'-'.$location['Location']['zip'].' '.$location['Location']['city'];
				echo $this->Html->tag('li', $this->Html->link($loc, '#', array('id' => $location['Location']['id'])));
		}
		?>
		</ul>
	<? endif ?>
	
	<? if (strlen($query) > 2): ?>
		<h3><?php echo __('Create a new location:')?></h3>
		<?php echo $this->Html->link($query, '/admin/locations/addonthefly/'.$query, array('id' => 'locfly')); ?>
	<? endif ?>
<? endif ?>
