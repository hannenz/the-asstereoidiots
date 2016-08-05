<h1><?php echo __('Photo Albums'); ?></h1>
<p><?php echo $this->Html->link(__('Add Photo Album'), '/admin/albums/add', array('class' => 'button add')); ?></p>

<?php echo $this->element('pagination'); ?>

<table class="admin-index-table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort(__('Bill'), 'bill'); ?></th>
			<th><?php echo $this->Paginator->sort(__('name'), 'Album.name'); ?></th>
			<th><?php echo $this->Paginator->sort(__('Show'), 'Show.Location.name'); ?></th>
			<th><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($albums as $album): ?>
		<tr>
			<?php
				$location = '';
				if (!empty($album['Show']['id'])){
					$location = sprintf("%s<br>%s", $album['Show']['Location']['full_name'], strftime('%x', strtotime($album['Show']['showtime'])));
				}
				echo $this->Html->tableCells(array(
					$this->Html->image($album['Picture'][0]['files']['thumb'], array('class' => 'thumbnail')),
					$album['Album']['name'],
					$location,
					$this->element('actions', array('id' => $album['Album']['id']))
				), array(
					'class' => 'odd'
				));
			?>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<?php echo $this->element('pagination'); ?>
