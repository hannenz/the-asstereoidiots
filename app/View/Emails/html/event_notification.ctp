<h2 style="color:#27221F; font-size: 24px; letter-spacing:-1px; font-family:Helvetica,Arial,sans-serif;">Termine</h2>
<p style="font-family:'Lucida Grande',Verdana,Helvetica,Arial,sans-serif; line-height: 15px; font-size: 11px;"><?php echo $data['username']; ?> hat den Termin <?php echo $this->Html->link($data['event']['Event']['title'], 'http://' . $_SERVER['SERVER_NAME'] . '/admin/events/view/' . $data['event']['Event']['id']);?> (<?php echo strftime('%a, %d.%m.%Y %H:%M', strtotime($data['event']['Event']['start'])); ?>) <?php echo $data['status']; ?></p>
<?php if ($data['confirmed']): ?>
	<p style="font-family:'Lucida Grande',Verdana,Helvetica,Arial,sans-serif; line-height: 15px; font-size: 11px;">Damit ist der Termin bestätigt</p>
<?php endif; ?>
