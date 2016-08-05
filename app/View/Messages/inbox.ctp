<?php echo $this->Session->flash('email'); ?>
<h1><?php echo __('Messages'); ?></h1>
<?php echo $this->Html->link(__('New message'), '/messages/compose', array('class' => 'button add')); ?>

<p><?php echo sprintf(__('%u messages, %u unread'), count($messages), $unread); ?></p>

<div id="tabs">
	<ul>
		<li><?php echo $this->Html->link(__('Inbox'), '#tab-inbox'); ?></li>
		<li><?php echo $this->Html->link(__('Sent'), '#tab-sent'); ?></li>
		<li><?php echo $this->Html->link(__('Trash'), '#tab-trash'); ?></li>
	</ul>
	<?php echo $this->element('messages_table', array('messages' => $messages, 'id' => 'tab-inbox')); ?>
	<?php echo $this->element('messages_table', array('messages' => $my_messages, 'id' => 'tab-sent')); ?>
	<?php echo $this->element('messages_table', array('messages' => $trashed_messages, 'id' => 'tab-trash')); ?>
</div>

<div id="message-view"></div>

<?php
echo $this->Html->css('Aristo/Aristo', null, array('inline' => false));
?>

<?php ob_start(); ?>
<script>
$(document).ready(function(){
	$('a.message-view-link').click(function(){
		var tr = $(this).parents('tr.unread');
		$('#message-view').load($(this).attr('href'), function(){
			$('a.back-link').parent('li').hide();
			$(tr).removeClass('unread');
		});
		return (false);
	});
	$('#tabs').tabs();
});
</script>
<?php
$this->addScript(ob_get_contents(), false);
ob_end_clean();
?>
