<h2 style="color:#27221F; font-size: 24px; letter-spacing:-1px; font-family:Helvetica,Arial,sans-serif;">Termine</h2>
<h3 style="color:#27221F; font-size: 20px; letter-spacing:-1px; font-family:Helvetica,Arial,sans-serif;">Terminänderung</h3>
<p style="font-family:'Lucida Grande',Verdana,Helvetica,Arial,sans-serif; line-height: 15px; font-size: 11px;"><?php echo $data['username']; ?> hat den Termin <?php echo $this->Html->link($data['old']['Event']['title'], 'http://' . $_SERVER['SERVER_NAME'] . '/admin/events/view/' . $data['old']['Event']['id']);?> (<?php echo strftime('%d.%m.%Y %H:%M', strtotime($data['old']['Event']['start'])); ?>) <?php echo $data['status']; ?></p>
<h4 style="color:#27221F; font-size:16px; font-family:Helvetica,Arial,sans-serif;">Neuer Termin:</h4>
<p style="font-family:'Lucida Grande',Verdana,Helvetica,Arial,sans-serif; line-height: 15px; font-size: 11px;"><?php echo $data['event']['Event']['title']; ?><br>
<p style="font-family:'Lucida Grande',Verdana,Helvetica,Arial,sans-serif; line-height: 15px; font-size: 11px;"><?php echo strftime('%d.%m.%Y %H:%M', strtotime($data['event']['Event']['start'])); ?></p>
<p style="font-family:'Lucida Grande',Verdana,Helvetica,Arial,sans-serif; line-height: 15px; font-size: 11px;"><?php echo nl2br($data['event']['Event']['details']); ?></p>
