
<table class="admin-index-table">
	<thead>
		<?php echo $this->Html->tableHeader(array(
			'Email',
			'Message'
		));
		?>
	</thead>
	<tbody>
		<?php
			foreach ($out as $email => $message){
				echo $this->Html->tableCells(array(
					$email,
					$message
				));
			}
		?>
	</tbody>
</table>
