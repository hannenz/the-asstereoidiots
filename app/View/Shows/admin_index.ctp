<h1><?php echo __('Shows'); ?></h1>
<p><?php echo $this->Html->link(__('Add Show'), '/admin/shows/add', array('class' => 'button')); ?></p>

<?php echo $this->element('pagination'); ?>

<table class="admin-index-table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort(__('Bill'), 'bill'); ?></th>
			<th><?php echo $this->Paginator->sort(__('Showtime'), 'showtime'); ?></th>
			<th><?php echo $this->Paginator->sort(__('Location'), 'Location.name'); ?></th>

			<!--th><?php echo __('Album'); ?></th>
			<th><?php echo __('Setlist'); ?></th-->

			<th><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($shows as $show): ?>
		<tr>
			<?php
				echo $this->Html->tableCells(array(
					$this->Html->image(!empty($show['Bill'][0]['icon']) ? $show['Bill'][0]['icon'] : '/img/defaultbill.jpg', array('class' => 'thumbnail')),
					strftime('%x', strtotime($show['Show']['showtime'])),
					$show['Location']['full_name'],
/*
					$this->Html->link($show['Album']['name'], '/admin/albums/edit/'.$show['Album']['id']),
					$this->Html->link($show['Setlist']['name'], '/admin/setlists/edit/'.$show['Setlist']['id']),
*/
					$this->element('actions', array('id' => $show['Show']['id']))
				), array(
					'class' => 'odd'
				));
			?>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<?php
	echo $this->element('pagination');
	echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));
?>
