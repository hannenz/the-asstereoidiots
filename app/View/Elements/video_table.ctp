<table class="admin-index-table">
	<thead>
		<?php echo $this->Html->tableHeaders(
			array(
				__('Poster'),
				__('Title'),
				__('Actions')
			)
		); ?>
	</thead>
	<tbody>
		<?php
			foreach ($videos as $video){
				echo $this->Html->tableCells(
					array(
						$this->Html->image(
							count ($video['Videofile']) > 0  ? $video['Videofile'][0]['icon'] : 'default.jpg',
							array('class' => 'thumbnail')
						),
						$video['Video']['title'],
						$this->element('actions', array('id' => $video['Video']['id']))
					),
					array('class' => 'odd', 'id' => 'videos_' . $video['Video']['id']),
					array('id' => 'videos_' . $video['Video']['id'])
				);
			}
		?>
	</tbody>
</table>
