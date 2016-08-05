<div id="<?php echo $id; ?>" class="inbox-container" >
	<table class="admin-index-table inbox">
		<thead>
			<tr>
				<th><?php echo __('Date')?></th>
				<th><?php echo __('From')?></th>
				<th><?php echo __('Subject')?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($messages as $message){
					if (isset($message['Message'])){
						$sender = $message['Sender'];
						$message = $message['Message'];
						$message['Sender'] = $sender;
					}
					if (isset($message['MessagesUser']) && $message['MessagesUser']['trashed'] == 1){
						continue;
					}
					$class = '';
					if (isset($message['MessagesUser']) && $message['MessagesUser']['read'] != 1){
						$class = 'unread';
					}
					echo $this->Html->tableCells(array(
						strftime('%x %H:%M', strtotime($message['created'])),
						$message['Sender']['name'],
						$this->Html->link($message['subject'], array('controller' => 'messages', 'action' => 'view', $message['id']), array('class' => 'message-view-link')),
					), array('class' => $class), array('class' => $class));
				}
			?>
		</tbody>
	</table>
</div>
