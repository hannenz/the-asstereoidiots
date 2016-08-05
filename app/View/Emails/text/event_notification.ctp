<p><?php echo $data['username']; ?> hat den Termin <?php echo $this->Html->link($data['event']['Event']['title'], 'http://' . $_SERVER['SERVER_NAME'] . '/admin/events/view/' . $data['event']['Event']['id']);?> (<?php echo strftime('%d.%m.%Y %H:%M', strtotime($data['event']['Event']['start'])); ?>) <?php echo $data['status']; ?></p>

<?php if ($data['confirmed']){
	echo $this->Html->tag('p', 'Damit ist der Termin bestätigt');
}
?>
