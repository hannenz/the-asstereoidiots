<h1><?php echo __('Compose Message'); ?></h1>
<?php
	echo $this->Form->create('Message', array('action' => 'compose'));
?>
<fieldset>
<?php
	echo $this->Form->input('sender', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
	echo $this->Form->input('subject');
	echo $this->Form->input('body', array('rows' => 12));

	echo $this->Html->tag('label', __('Recipients'));
	foreach ($recipients as $id => $recipient){
		$checked = 'checked';
		if (isset($this->request->data['Recipient']['Recipient']) && in_array($id, $this->request->data['Recipient']['Recipient'])){
			$checked = 'checked="checked"';
		}
		echo '<input class="recipient-checkbox" type="checkbox" name="data[Recipient][Recipient][]" value="'.$id.'" '.$checked.'/>';
		echo $this->Html->tag('label', $recipient, array('class' => 'recipient-label'));
	}

	echo $this->Form->submit(__('Send message'));
?>
</fieldset>
<?php
	echo $this->Form->end();
?>

<?php echo $this->Html->link(__('back'), '/messages/inbox', array('class' => 'button back')); ?>
