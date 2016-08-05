<ul>
	<?php foreach ($links as $link): ?>
		<li>
			<p>
			<strong><?php echo $this->Html->link($link['Link']['name'], $link['Link']['url'], array ('class' => 'urlLink'))?></strong><br>
			<?php echo $link['Link']['description']?>
			<?php echo $this->element('editdelete', array('name' => $link['User']['username'], 'id' => $link['Link']['id'], 'date' => $link['Link']['created']))?>
			</p>
		</li>
	<? endforeach ?>
</ul>
