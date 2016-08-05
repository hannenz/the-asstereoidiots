<?php echo $data['username']; ?> hat den Termin <?php echo $this->Html->link($data['old']['Event']['title'], 'http://' . $_SERVER['SERVER_NAME'] . '/admin/events/view/' . $data['old']['Event']['id']);?> (<?php echo strftime('%d.%m.%Y %H:%M', strtotime($data['old']['Event']['start'])); ?>) <?php echo $data['status']; ?>

Neuer Termin:

<?php echo $data['event']['Event']['title']; ?>
<?php echo strftime('%d.%m.%Y %H:%M', strtotime($data['event']['Event']['start'])); ?>
<?php echo $data['event']['Event']['details']; ?>
