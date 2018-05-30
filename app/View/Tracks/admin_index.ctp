<h1><?php echo __('Tracks'); ?></h1>

<?php
	echo $this->Html->link(__('Add track'), '/admin/tracks/add', array('class' => 'button add'));
	echo $this->element('pagination');
?>
<table class="admin-index-table">
	<thead>
		<?php
		echo $this->Html->tableHeaders(
			array(
//				__('Filename'),
				__('Song'),
				__('Year'),
				__('Length'),
				__('Actions')
			)
		);
		?>
	</thead>
	<tbody>
		<?php foreach ($tracks as $track): ?>
			<tr>
				<td>
					<strong style="text-transform:uppercase"><?php echo $track['Song']['title']; ?></strong><br>
					<?php if (!empty($track['Audiofile'][0]['name'])): ?>
						<audio src="/files/Audiofiles/<?php echo $track['Audiofile'][0]['filename']; ?>" controls></audio>
					<?php else: ?>
						<?php echo __('No Audiofile'); ?>
					<?php endif ?>
				</td>
				<td>
					<?php echo strftime('%Y', strtotime($track['Track']['date'])); ?>
				</td>
				<td>
					<?php printf("%02u:%02u", $track['Track']['length'] / 60, $track['Track']['length'] % 60); ?>
				</td>
				<td>
					<?php echo $this->element('actions', array('id' => $track['Track']['id'])); ?>
				</td>
			</tr>
		<?php endforeach ?>



		<?php
			// foreach ($tracks as $track){
			// 	echo $this->Html->tableCells(
			// 		array(
			// 			!empty($track['Audiofile'][0]['name']) ? $track['Audiofile'][0]['name'] : __('No Audiofile'),
			// 			$track['Song']['title'],
			// 			strftime('%Y', strtotime($track['Track']['date'])),
			// 			$track['Track']['length'],
			// 			$this->element('actions', array('id' => $track['Track']['id']))
			// 		),
			// 		array('class' => 'odd')
			// 	);
			// }
		?>
	</tbody>
</table>

<?php
	echo $this->element('pagination');
	echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));
?>
