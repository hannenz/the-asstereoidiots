<table>
	<tbody>
		<?php foreach ($setlist as $song){
			echo $this->Html->tableCells(array(
				$song['pos'],
				$song['Song']['title']
			));
		}
		?>
	</tbody>
</table>
