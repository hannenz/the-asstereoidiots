<h3 style="color:#27221F; font-size: 18px; font-family:Helvetica,Arial,sans-serif;">Du hast eine neue private Nachricht von <?php echo $data['sender']; ?> erhalten.</h3>

<h4 style="color:#27221F; font-size:14px;"><strong>Betreff:</strong> <?php echo $subject; ?></h4>
<p style="background-color:#eee; padding:8px; font-family:'Lucida Grande',Verdana,Helvetica,Arial,sans-serif; line-height: 15px; font-size: 14px;"><?php echo nl2br($data['message']['Message']['body']); ?></p>
<p style="font-family:'Lucida Grande',Verdana,Helvetica,Arial,sans-serif; line-height: 15px; font-size: 14px;"><?php echo $this->Html->link('Zum Posteingang', 'http://' . $_SERVER['SERVER_NAME'] . '/messages/inbox'); ?></p>
