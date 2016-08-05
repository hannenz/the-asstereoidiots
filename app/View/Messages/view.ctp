<div class="message">
	<dl class="message-header clearfix">
		<dt><?php echo __('From');?></dt>
		<dd><?php echo $message['Sender']['name']; ?></dd>
		<dt><?php echo __('To'); ?></dt>
		<dd><?php echo $this->Text->toList($recipients); ?></dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd><?php echo strftime('%x %H:%M', strtotime($message['Message']['created'])); ?></dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd><?php echo $message['Message']['subject']; ?></dd>
	</dl>
		<div class="message-body"><?php echo nl2br($message['Message']['body']); ?></div>
	
	<ul class="message-actions">
		<?php
			echo $this->Html->tag('li', $this->Html->link(__('reply'), '/messages/reply/' . $message['Message']['id']));
			echo $this->Html->tag('li', $this->Html->link(__('mark unread'), '/messages/mark_unread/' . $message['Message']['id']));
			echo $this->Html->tag('li', $this->Html->link(__('delete'), '/messages/delete/' . $message['Message']['id'], array(), __('Are you sure?')));
			echo $this->Html->tag('li', $this->Html->link(__('back'), '/messages/inbox', array('class' => 'back-link')));
		?>
	</ul>
</div>
