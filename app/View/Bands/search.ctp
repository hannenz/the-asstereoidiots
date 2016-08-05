<?php if (isset($result)): ?>
	<?php if (count($result) > 0): ?>
	<h3><?php echo __('Bands in the database')?></h3>
	<ul>
		<?php foreach ($result as $band): ?>
			<li id="bands_<?php echo $band['Band']['id']; ?>"><?php echo $this->Html->link($band['Band']['name'], '#', array('id' => $band['Band']['id'])); ?></li>
		<?php endforeach ?>
	</ul>
	<?php endif ?>
	<h3><?php echo __('Create a new band')?></h3>
	<?php echo $this->Html->link($query, '/admin/bands/addonthefly/'.$query, array('id' => 'bandfly'))?>
<?php endif ?>
